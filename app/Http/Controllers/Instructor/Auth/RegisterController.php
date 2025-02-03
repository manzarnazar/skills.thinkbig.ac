<?php

namespace App\Http\Controllers\Instructor\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Instructor;
use App\Models\InstructorLogin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new Instructors as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('registration.status')->except('registrationNotAllowed');
        $this->activeTemplate = activeTemplate();
    }

    public function showRegistrationForm()
    {
        $pageTitle = "Register";
        $info = json_decode(json_encode(getIpInfo()), true);
        $mobileCode = @implode(',', $info['code']);
        $countries = json_decode(file_get_contents(resource_path('views/includes/country.json')));
        return view($this->activeTemplate . 'instructor.auth.register', compact('pageTitle','mobileCode','countries'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $general = gs();
        $passwordValidation = Password::min(6);
        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }
        $agree = 'nullable';
        if ($general->agree) {
            $agree = 'required';
        }
        $countryData = (array)json_decode(file_get_contents(resource_path('views/includes/country.json')));
        $countryCodes = implode(',', array_keys($countryData));
        $mobileCodes = implode(',',array_column($countryData, 'dial_code'));
        $countries = implode(',',array_column($countryData, 'country'));
        $validate = Validator::make($data, [
            'email' => 'required|string|email|unique:instructors',
            'mobile' => 'required|regex:/^([0-9]*)$/',
            'password' => ['required','confirmed',$passwordValidation],
            'username' => 'required|unique:instructors|min:6',
            'captcha' => 'sometimes|required',
            'mobile_code' => 'required|in:'.$mobileCodes,
            'country_code' => 'required|in:'.$countryCodes,
            'country' => 'required|in:'.$countries,
            'agree' => $agree
        ]);
        return $validate;

    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $request->session()->regenerateToken();

        if(preg_match("/[^a-z0-9_]/", trim($request->username))){
            $notify[] = ['info', 'Instructor name can contain only small letters, numbers and underscore.'];
            $notify[] = ['error', 'No special character, space or capital letters in Instructor name.'];
            return back()->withNotify($notify)->withInput($request->all());
        }

        if(!verifyCaptcha()){
            $notify[] = ['error','Invalid captcha provided'];
            return back()->withNotify($notify);
        }


        $exist = Instructor::where('mobile',$request->mobile_code.$request->mobile)->first();

        if ($exist) {
            $notify[] = ['error', 'The mobile number already exists'];
            return back()->withNotify($notify)->withInput();
        }

        event(new Registered($instructor = $this->create($request->all())));

        $this->guard()->login($instructor);

        return $this->registered($request, $instructor)
            ?: redirect($this->redirectPath());
    }


    /**
     * Create a new instructor instance after a valid registration.
     *
     * @param  array $data
     * @return \App\instructor
     */
    protected function create(array $data)
    {
        $general = gs();

        $referBy = session()->get('reference');
        if ($referBy) {
            $referInstructor = Instructor::where('username', $referBy)->first();
        } else {
            $referInstructor = null;
        }

        //Instructor Create
        $instructor = new Instructor();
        $instructor->email = strtolower(trim($data['email']));
        $instructor->password = Hash::make($data['password']);
        $instructor->username = trim($data['username']);
        $instructor->ref_by = $referInstructor ? $referInstructor->id : 0;
        $instructor->country_code = $data['country_code'];
        $instructor->mobile = $data['mobile_code'].$data['mobile'];
        $instructor->address = [
            'address' => '',
            'state' => '',
            'zip' => '',
            'country' => isset($data['country']) ? $data['country'] : null,
            'city' => ''
        ];
        $instructor->status = 1;
        $instructor->kv = $general->kv ? 0 : 1;
        $instructor->ev = $general->ev ? 0 : 1;
        $instructor->sv = $general->sv ? 0 : 1;
        $instructor->ts = 0;
        $instructor->tv = 1;
        $instructor->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $instructor->id;
        $adminNotification->title = 'New member registered';
        $adminNotification->click_url = urlPath('admin.instructors.detail',$instructor->id);
        $adminNotification->save();


        //Login Log Create
        $ip = getRealIP();
        $exist = InstructorLogin::where('Instructor_ip',$ip)->first();
        $instructorLogin = new InstructorLogin();

        //Check exist or not
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


        return $instructor;
    }

    public function checkUser(Request $request){
        $exist['data'] = false;
        $exist['type'] = null;
        if ($request->email) {
            $exist['data'] = Instructor::where('email',$request->email)->exists();
            $exist['type'] = 'email';
        }
        if ($request->mobile) {
            $exist['data'] = Instructor::where('mobile',$request->mobile)->exists();
            $exist['type'] = 'mobile';
        }
        if ($request->instructorname) {
            $exist['data'] = Instructor::where('username',$request->instructorname)->exists();
            $exist['type'] = 'username';
        }
        return response($exist);
    }

    public function registered()
    {
        return to_route('instructor.home');
    }

}
