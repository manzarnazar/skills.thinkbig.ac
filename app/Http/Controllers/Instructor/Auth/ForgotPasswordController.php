<?php

namespace App\Http\Controllers\Instructor\Auth;

use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use App\Models\InstructorPasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your Instructors. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
        $this->activeTemplate = activeTemplate();
    }


    public function showLinkRequestForm()
    {
        $pageTitle = "Account Recovery";
        return view($this->activeTemplate . 'instructor.auth.passwords.email', compact('pageTitle'));
    }

    public function sendResetCodeEmail(Request $request)
    {

        $request->validate([
            'value'=>'required'
        ]);
        $fieldType = $this->findFieldType();
        $instructor = Instructor::where($fieldType, $request->value)->first();
       

        if (!$instructor) {
            $notify[] = ['error', 'Couldn\'t find any account with this information'];
            return back()->withNotify($notify);
        }

        InstructorPasswordReset::where('email', $instructor->email)->delete();
        $code = verificationCode(6);
        $password = new InstructorPasswordReset();
        $password->email = $instructor->email;
        $password->token = $code;
        $password->created_at = \Carbon\Carbon::now();
        $password->save();


        $instructorIpInfo = getIpInfo();
        $instructorBrowserInfo = osBrowser();
        
        notify($instructor, 'PASS_RESET_CODE', [
            'code' => $code,
            'operating_system' => @$instructorBrowserInfo['os_platform'],
            'browser' => @$instructorBrowserInfo['browser'],
            'ip' => @$instructorIpInfo['ip'],
            'time' => @$instructorIpInfo['time']
        ],['email']);

  

        $email = $instructor->email;
        session()->put('pass_res_mail',$email);
        $notify[] = ['success', 'Password reset email sent successfully'];
        return to_route('instructor.password.code.verify')->withNotify($notify);
    }

    public function findFieldType()
    {
        $input = request()->input('value');

        $fieldType = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $input]);
        return $fieldType;
    }

    public function codeVerify(){
        $pageTitle = 'Verify Email';
        $email = session()->get('pass_res_mail');
        if (!$email) {
            $notify[] = ['error','Oops! session expired'];
            return to_route('instructor.password.request')->withNotify($notify);
        }
        return view($this->activeTemplate.'instructor.auth.passwords.code_verify',compact('pageTitle','email'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'email' => 'required'
        ]);
        $code =  str_replace(' ', '', $request->code);

        if (InstructorPasswordReset::where('token', $code)->where('email', $request->email)->count() != 1) {
            $notify[] = ['error', 'Verification code doesn\'t match'];
            return to_route('instructor.password.request')->withNotify($notify);
        }
       
        $notify[] = ['success', 'You can change your password.'];
        session()->flash('fpass_email', $request->email);
        return to_route('instructor.password.reset', $code)->withNotify($notify);
    }

}
