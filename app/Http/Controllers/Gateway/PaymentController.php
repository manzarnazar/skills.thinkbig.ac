<?php

namespace App\Http\Controllers\Gateway;

use App\Models\User;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Deposit;
use App\Lib\FormProcessor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\GatewayCurrency;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\InstructorNotification;

class PaymentController extends Controller
{

    public function deposit()
    {
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        $pageTitle = 'Deposit Methods';
        return view($this->activeTemplate . 'user.payment.deposit', compact('gatewayCurrency', 'pageTitle'));
    }

    public function depositInsert(Request $request)
    {

        $request->validate([
            'course_id' => 'required|numeric',
            'amount' => 'required|numeric|gt:0',
            'method_code' => 'required',
            'currency' => 'required',
        ]);

        $course = Course::where('id', $request->course_id)->where('status', 1)->first();
        if (!$course) {
            $notify[] = ['error', 'Your course is not valid'];
            return back()->withNotify($notify);
        }
        $price = $course->price;
        if ($course->discount) {
            $price = priceCalculate($course->price, @$course->discount);
        }

        $user = auth()->user();
        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->where('method_code', $request->method_code)->where('currency', $request->currency)->first();

        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }

        if ($gate->min_amount > $price || $gate->max_amount < $price) {
            $notify[] = ['error', 'Please follow deposit limit'];
            return back()->withNotify($notify);
        }

        $charge = $gate->fixed_charge + ($price * $gate->percent_charge / 100);
        $payable = $price + $charge;
        $final_amo = $payable * $gate->rate;


        //--------------------------------------------- Deposit data ---------------------------------------------
        $deposit = new Deposit();
        $deposit->user_id = $user->id;
        $deposit->course_id = $course->id;
        $deposit->owner_id = $course->owner_id;
        $deposit->owner_type = $course->owner_type;
        $deposit->method_code = $gate->method_code;
        $deposit->method_currency = strtoupper($gate->currency);
        $deposit->amount = $price;
        $deposit->charge = $charge;
        $deposit->rate = $gate->rate;
        $deposit->final_amo = $final_amo;
        $deposit->btc_amo = 0;
        $deposit->btc_wallet = "";
        $deposit->trx = getTrx();
        $deposit->try = 0;
        $deposit->status = 0;
        $deposit->save();



        //--------------------------------------------- Enroll data ---------------------------------------------
        $enroll = new Enroll();
        $enroll->user_id = $user->id;
        $enroll->course_id = $course->id;
        $enroll->deposit_id = $deposit->id;
        $enroll->owner_id = $course->owner_id;
        $enroll->owner_type = $course->owner_type;
        $enroll->name = $course->name;
        $enroll->discount = $course->discount;
        $enroll->price = $course->price;
        $enroll->total_amount = $price;
        $enroll->status = 0;
        $enroll->save();


        session()->put('Track', $deposit->trx);
        return to_route('user.deposit.confirm');
    }


    public function appDepositConfirm($hash)
    {
        try {
            $id = decrypt($hash);
        } catch (\Exception $ex) {
            return "Sorry, invalid URL.";
        }
        $data = Deposit::where('id', $id)->where('status', 0)->orderBy('id', 'DESC')->firstOrFail();
        $user = User::findOrFail($data->user_id);
        auth()->login($user);
        session()->put('Track', $data->trx);
        return to_route('user.deposit.confirm');
    }


    public function depositConfirm()
    {
        $track = session()->get('Track');
        $deposit = Deposit::where('trx', $track)->where('status', 0)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();

        if ($deposit->method_code >= 1000) {
            return to_route('user.deposit.manual.confirm');
        }


        $dirName = $deposit->gateway->alias;
        $new = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';

        $data = $new::process($deposit);
        $data = json_decode($data);


        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if (@$data->session) {
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }

        $pageTitle = 'Payment Confirm';
        return view($this->activeTemplate . $data->view, compact('data', 'pageTitle', 'deposit'));
    }


    public static function userDataUpdate($deposit, $isManual = null)
    {

        if ($deposit->status == 0 || $deposit->status == 2) {
            $deposit->status = 1;
            $deposit->save();

            // ---------------------------Instructor balance add---------------------------
            $instructor = Instructor::find($deposit->owner_id);
            if ($deposit->owner_type == 2) {
                $instructor->balance += $deposit->amount;
                $instructor->save();
            }

            // ---------------------------Enroll status update ---------------------------
            $enroll = Enroll::where('deposit_id',$deposit->id)->first();
            $enroll->status = 1;
            $enroll->save();


            // ---------------------------Transaction ---------------------------
            $transaction = new Transaction();
            $transaction->instructor_id = $deposit->instructor_id;
            $transaction->amount = $deposit->amount;
            $transaction->post_balance = $instructor->balance;
            $transaction->charge = $deposit->charge;
            $transaction->trx_type = '+';
            $transaction->details = 'Payment Via ' . $deposit->gatewayCurrency()->name;
            $transaction->trx = $deposit->trx;
            $transaction->remark = 'payment';
            $transaction->save();

            if (!$isManual) {
                $adminNotification = new AdminNotification();
                $adminNotification->user_id = $deposit->user_id;
                $adminNotification->title = 'Payment successful via' . $deposit->gatewayCurrency()->name;
                $adminNotification->click_url = urlPath('admin.deposit.successful');
                $adminNotification->save();
            }

            
            // ---------------------- If Course owner is admin then throw Admin Notification----------------------
            if ($enroll->owner_id == 1) {
                $adminNotification = new AdminNotification();
                $adminNotification->user_id = $deposit->user->id;
                $adminNotification->title = 'Enroll request from ' . $deposit->user->username;
                $adminNotification->click_url = urlPath('course.details', [slug($enroll->name), $enroll->course_id]);
                $adminNotification->save();
            }


            // ----------------------Instructor Notification----------------------
            if ($enroll->owner_id == 2) {
                $instructorNotification = new InstructorNotification();
                $instructorNotification->instructor_id = $enroll->owner_id;
                $instructorNotification->title = 'Enroll request from ' . $deposit->user->username;
                $instructorNotification->click_url = urlPath('course.details', [slug($enroll->name), $enroll->course_id]);
                $instructorNotification->save();
            }


            $user = User::find($deposit->user_id);
            // ---------------------------Email to Instructor---------------------------
            notify($instructor, 'ENROLL_COMPLETE', [
                'method_amount' => showAmount($deposit->final_amo),
                'amount' => showAmount($deposit->amount),
                'charge' => showAmount($deposit->charge),
                'rate' => showAmount($deposit->rate),
                'trx' => $deposit->trx,
                'user_name' => $user->fullname,

            ]);


            // ---------------------------Email to User---------------------------
            notify($user, $isManual ? 'PAYMENT_APPROVE' : 'PAYMENT_COMPLETE', [
                'trx' => $deposit->trx,
                'amount' => showAmount($deposit->amount),
                'charge' => showAmount($deposit->charge),
                'rate' => showAmount($deposit->rate),
                'method_name' => $deposit->gatewayCurrency()->name,
                'method_currency' => $deposit->method_currency,
                'method_amount' => showAmount($deposit->final_amo),
            ]);

            
        }
    }

    public function manualDepositConfirm()
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }
        if ($data->method_code > 999) {

            $pageTitle = 'Deposit Confirm';
            $method = $data->gatewayCurrency();
            $gateway = $method->method;
            return view($this->activeTemplate . 'user.payment.manual', compact('data', 'pageTitle', 'method', 'gateway'));
        }
        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {

        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }
        $gatewayCurrency = $data->gatewayCurrency();
        $gateway = $gatewayCurrency->method;
        $formData = $gateway->form->form_data;

        $formProcessor = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);


        $data->detail = $userData;
        $data->status = 2; // pending
        $data->save();


        $enroll = Enroll::where('deposit_id', $data->id)->first();
        $enroll->status = 2; // pending
        $enroll->save();


        // ---------------------- Deposit Admin Notification----------------------
        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $data->user->id;
        $adminNotification->title = 'Payment request from ' . $data->user->username;
        $adminNotification->click_url = urlPath('admin.deposit.details', $data->id);
        $adminNotification->save();


        // ---------------------- If Course owner is admin then Admin Notification----------------------
        if ($enroll->owner_id == 1) {
            $adminNotification = new AdminNotification();
            $adminNotification->user_id = $data->user->id;
            $adminNotification->title = 'Enroll request from ' . $data->user->username;
            $adminNotification->click_url = urlPath('course.details', [slug($enroll->name), $enroll->course_id]);
            $adminNotification->save();
        }


        // ----------------------Instructor Notification----------------------
        if ($enroll->owner_id == 2) {
            $instructorNotification = new InstructorNotification();
            $instructorNotification->instructor_id = $enroll->owner_id;
            $instructorNotification->title = 'Enroll request from ' . $data->user->username;
            $instructorNotification->click_url = urlPath('course.details', [slug($enroll->name), $enroll->course_id]);
            $instructorNotification->save();
        }



        notify($data->user, 'PAYMENT_REQUEST', [
            'method_name' => $data->gatewayCurrency()->name,
            'method_currency' => $data->method_currency,
            'method_amount' => showAmount($data->final_amo),
            'amount' => showAmount($data->amount),
            'charge' => showAmount($data->charge),
            'rate' => showAmount($data->rate),
            'trx' => $data->trx
        ]);

        $notify[] = ['success', 'You have Payment request has been taken'];
        return to_route('user.deposit.history')->withNotify($notify);
    }
}
