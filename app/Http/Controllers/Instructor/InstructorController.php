<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Job;
use App\Models\Form;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Deposit;
use App\Lib\FormProcessor;
use App\Models\Withdrawal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Lib\GoogleAuthenticator;
use App\Http\Controllers\Controller;


class InstructorController extends Controller
{
    public function home()
    {
        $pageTitle = 'Dashboard';
        $enroll = new Enroll();
        $ticket = new SupportTicket();
        $remarks = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::where('instructor_id', auth('instructor')->id())->orderBy('id', 'desc')->paginate(getPaginate());
        $course_ids = Enroll::pluck('course_id')->unique()->toArray();

        $enrolls = $enroll
        
        ->with('course', 'course.category')
        ->whereIn('course_id',$course_ids)
        ->where('owner_id',auth('instructor')->id())
        ->orderBy('id', 'desc')
        ->get()
        ->unique('course_id')
        ->paginate(getPaginate());


        $enrollCount = $enroll->with('course', 'course.category')->where('owner_id', auth('instructor')->id())->count();
        $withdraw = Withdrawal::where('user_id', auth('instructor')->id());
        $withdrawls = $withdraw->paginate(getPaginate());
        $totalCourses = Course::where('owner_id', auth('instructor')->id())->where('owner_type', 2)->count();
        $approvedWithdrawMoney = $withdraw->where('status', 1)->sum('final_amount');
        $pendingWithdrawMoney = $withdraw->where('status', 2)->sum('final_amount');
        $rejectWithdrawMoney = $withdraw->where('status', 3)->sum('final_amount');


        // Monthly Enroll & Payment Report Graph
        $enrollCharts = Enroll::selectRaw("COUNT(id) as id, MONTHNAME(created_at) as month_name, MONTH(created_at) as month_num")
            ->whereYear('created_at', date('Y'))
            ->whereStatus(1)
            ->where('owner_id', auth('instructor')->id())
            ->where('owner_type', 2)
            ->groupBy('month_name', 'month_num')
            ->orderBy('month_num')
            ->get();
        $enrollChart['labels'] = $enrollCharts->pluck('month_name');
        $enrollChart['values'] = $enrollCharts->pluck('id');

        $withdrawCharts = Withdrawal::selectRaw("SUM(amount) as amount, MONTHNAME(created_at) as month_name, MONTH(created_at) as month_num")
            ->whereYear('created_at', date('Y'))
            ->whereStatus(1)
            ->where('user_id', auth('instructor')->id())
            ->groupBy('month_name', 'month_num')
            ->orderBy('month_num')
            ->get();
        $withdrawChart['labels'] = $withdrawCharts->pluck('month_name');
        $withdrawChart['values'] = $withdrawCharts->pluck('amount');

        return view($this->activeTemplate . 'instructor.dashboard', compact(
            'pageTitle',
            'remarks',
            'transactions',
            'enrolls',
            'enroll',
            'enrollCount',
            'ticket',
            'approvedWithdrawMoney',
            'pendingWithdrawMoney',
            'rejectWithdrawMoney',
            'withdrawls',
            'totalCourses',
            'enrollChart',
            'withdrawChart'
        ));
    }

    public function depositHistory(Request $request)
    {
        $pageTitle = 'Payment History';
        $deposits = auth('instructor')->user()->deposits();
        if ($request->search) {
            $deposits = $deposits->where('trx', $request->search);
        }
        $deposits = $deposits->with(['gateway'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'instructor.deposit_history', compact('pageTitle', 'deposits'));
    }

    public function show2faForm()
    {
        $general = gs();
        $ga = new GoogleAuthenticator();
        $user = auth('instructor')->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $general->site_name, $secret);
        $pageTitle = '2FA Setting';
        return view($this->activeTemplate . 'instructor.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $user = auth('instructor')->user();
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user, $request->code, $request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts = 1;
            $user->save();
            $notify[] = ['success', 'Google authenticator activated successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }

    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = auth('instructor')->user();
        $response = verifyG2fa($user, $request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts = 0;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator deactivated successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

    public function transactions(Request $request)
    {
        $pageTitle = 'Transactions';
        $remarks = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::where('instructor_id', auth('instructor')->id());

        if ($request->search) {
            $transactions = $transactions->where('trx', $request->search);
        }

        if ($request->type) {
            $transactions = $transactions->where('trx_type', $request->type);
        }

        if ($request->remark) {
            $transactions = $transactions->where('remark', $request->remark);
        }

        $transactions = $transactions->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'instructor.transactions', compact('pageTitle', 'transactions', 'remarks'));
    }

    public function kycForm()
    {
        if (auth('instructor')->user()->kv == 2) {
            $notify[] = ['error', 'Your KYC is under review'];
            return to_route('instructor.home')->withNotify($notify);
        }
        if (auth('instructor')->user()->kv == 1) {
            $notify[] = ['error', 'You are already KYC verified'];
            return to_route('instructor.home')->withNotify($notify);
        }
        $pageTitle = 'KYC Form';
        $form = Form::where('act', 'instructor_kyc')->first();
        return view($this->activeTemplate . 'instructor.kyc.form', compact('pageTitle', 'form'));
    }

    public function kycData()
    {
        $instructor = auth('instructor')->user();
        $pageTitle = 'KYC Data';
        return view($this->activeTemplate . 'instructor.kyc.info', compact('pageTitle', 'instructor'));
    }

    public function kycSubmit(Request $request)
    {
        $form = Form::where('act', 'instructor_kyc')->first();
        $formData = $form->form_data;
        $formProcessor = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);
        $user = auth('instructor')->user();
        $user->kyc_data = $userData;
        $user->kv = 2;
        $user->save();

        $notify[] = ['success', 'KYC data submitted successfully'];
        return to_route('instructor.home')->withNotify($notify);
    }

    public function attachmentDownload($fileHash)
    {
        $filePath = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $general = gs();
        $title = slug($general->site_name) . '- attachments.' . $extension;
        $mimetype = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }

    public function userData()
    {
        $user = auth('instructor')->user();
        if ($user->reg_step == 1) {
            return to_route('instructor.home');
        }
        $pageTitle = 'Instructor Data';
        return view($this->activeTemplate . 'instructor.user_data', compact('pageTitle', 'user'));
    }

    public function userDataSubmit(Request $request)
    {

        $user = auth('instructor')->user();
        if ($user->reg_step == 1) {
            return to_route('instructor.home');
        }
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->address = [
            'country' => @$user->address->country,
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'city' => $request->city,
        ];
        $user->reg_step = 1;
        $user->save();

        $notify[] = ['success', 'Registration process completed successfully'];
        return to_route('instructor.home')->withNotify($notify);
    }
}
