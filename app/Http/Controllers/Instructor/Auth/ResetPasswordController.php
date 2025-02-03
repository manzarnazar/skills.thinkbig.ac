<?php

namespace App\Http\Controllers\Instructor\Auth;

use App\Http\Controllers\Controller;
use App\Models\InstructorPasswordReset;
use App\Models\Instructor;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;


    public function __construct()
    {
        $this->middleware('guest');
        $this->activeTemplate = activeTemplate();
    }

    public function showResetForm(Request $request, $token = null)
    {
        $email = session('fpass_email');
        $token = session()->has('token') ? session('token') : $token;
        if (InstructorPasswordReset::where('token', $token)->where('email', $email)->count() != 1) {
            $notify[] = ['error', 'Invalid token'];
            return to_route('instructor.password.request')->withNotify($notify);
        }
        return view($this->activeTemplate . 'instructor.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email, 'pageTitle' => 'Reset Password']
        );
    }

    public function reset(Request $request)
    {

        session()->put('fpass_email', $request->email);
        $request->validate($this->rules(), $this->validationErrorMessages());
        $reset = InstructorPasswordReset::where('token', $request->token)->orderBy('created_at', 'desc')->first();
        if (!$reset) {
            $notify[] = ['error', 'Invalid verification code'];
            return to_route('instructor.login')->withNotify($notify);
        }
        $instructor = Instructor::where('email', $reset->email)->first();
        $instructor->password = bcrypt($request->password);
        $instructor->save();

        $instructorIpInfo = getIpInfo();
        $instructorBrowser = osBrowser();
        notify($instructor, 'PASS_RESET_DONE', [
            'operating_system' => @$instructorBrowser['os_platform'],
            'browser' => @$instructorBrowser['browser'],
            'ip' => @$instructorIpInfo['ip'],
            'time' => @$instructorIpInfo['time']
        ],['email']);


        $notify[] = ['success', 'Password changed successfully'];
        return to_route('instructor.login')->withNotify($notify);
    }



    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        $passwordValidation = Password::min(6);
        $general = gs();
        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required','confirmed',$passwordValidation],
        ];
    }

}
