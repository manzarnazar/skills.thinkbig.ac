<?php

namespace App\Http\Controllers\Instructor\Auth;

use App\Http\Controllers\Controller;
use App\Models\InstructorLogin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('instructor.guest')->except('logout');
        $this->username = $this->findUsername();
        $this->activeTemplate = activeTemplate();
    }

    
    public function showLoginForm()
    {
      
        $pageTitle = "Login";
        return view($this->activeTemplate . 'instructor.auth.login', compact('pageTitle'));
    }

    protected function guard()
    {
        return auth()->guard('instructor');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $request->session()->regenerateToken();

        if(!verifyCaptcha()){
            $notify[] = ['error','Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the instructor name and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the instructor back to the login form. Of course, when this
        // instructor surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    public function findUsername()
    {
        $login = request()->input('username');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    protected function validateLogin(Request $request)
    {

        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

    }

    public function logout()
    {
        $this->guard('instructor')->logout();
        request()->session()->invalidate();

        $notify[] = ['success', 'You have been logged out.'];
        return to_route('instructor.login')->withNotify($notify);
    }



    public function authenticated(Request $request, $instructor)
    {
        $instructor->tv = $instructor->ts == 1 ? 0 : 1;
        $instructor->save();
        $ip = getRealIP();
        $exist = InstructorLogin::where('instructor_ip',$ip)->first();
        $instructorLogin = new InstructorLogin();
        if ($exist) {
            $instructorLogin->longitude =  $exist->longitude;
            $instructorLogin->latitude =  $exist->latitude;
            $instructorLogin->city =  $exist->city;
            $instructorLogin->country_code = $exist->country_code;
            $instructorLogin->country =  $exist->country;
        }else{
            $info = json_decode(json_encode(getIpInfo()), true);
            $instructorLogin->longitude =  @implode(',',$info['long']);
            $instructorLogin->latitude =  @implode(',',$info['lat']);
            $instructorLogin->city =  @implode(',',$info['city']);
            $instructorLogin->country_code = @implode(',',$info['code']);
            $instructorLogin->country =  @implode(',', $info['country']);
        }

        $instructorAgent = osBrowser();
        $instructorLogin->instructor_id = $instructor->id;
        $instructorLogin->instructor_ip =  $ip;

        $instructorLogin->browser = @$instructorAgent['browser'];
        $instructorLogin->os = @$instructorAgent['os_platform'];
        $instructorLogin->save();
    
        return to_route('instructor.home');
    }


}
