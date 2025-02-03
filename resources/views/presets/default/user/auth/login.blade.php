@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <!--=======-** Sign In start **-=======-->
    @php
        $credentials = gs()->socialite_credentials;
    @endphp
    <!-- login section -->
    <section class="login-section">
        <div class="container-fluid px-0">
            <div class="row mx-0">
                <div class="col-xl-7 col-lg-6 px-0 d-none d-lg-block">
                    <div class="login-left-section bg--img">
                        <span class="login-element1 login-bg-img">
                            <img src="{{ asset('assets/images/frontend/login/login1.png') }}" alt="...">
                        </span>
                        <span class="login-element6">
                            <img src="{{ asset('assets/images/frontend/login/login5.png') }}" alt="...">
                        </span>
                        <span class="login-element7">
                            <img src="{{ asset('assets/images/frontend/login/login6.png') }}" alt="...">
                        </span>
                        <span class="login-element8">
                            <img src="{{ asset('assets/images/frontend/login/login7.png') }}" alt="...">
                        </span>
                        <span class="login-element9">
                            <img src="{{ asset('assets/images/frontend/login/login6.png') }}" alt="...">
                        </span>

                        <div class="content-wrap">
                            <div class="logo-wrap">
                                <a href="{{ route('home') }}"><img
                                        src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="login-image"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-6 px-0">
                    <!-- < sign in components -->
                    <div class="login-box">
                        <div class="close--btn">
                            <div class="wrap">
                                <a href="{{route('home')}}"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                        </div>
                        <h4 class="title">@lang('Welcome Back !')</h4>

                        <div class="d-flex mb-4">
                            <a href="{{route('instructor.login')}}" class="btn btn--base me-4 {{Route::is('instructor.login') ? 'active':'unactive'}}">@lang('Instructor Login')</a>
                            <a href="{{route('user.login')}}" class="btn btn--base {{Route::is('user.login') ? 'active':'unactive'}}" >@lang('User Login')</a>
                        </div>

                        <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha">
                            @csrf
                            <div class="mb-4 form-group">
                                <label class="mb-2 form--label">@lang('User name')</label>
                                <input class="form--control" placeholder="@lang('Enter UserName Or Email')" name="username" id="username"
                                    requird>
                            </div>
                            <div class="mb-4 form-group">
                                <label class="mb-2 form--label">@lang('Password')</label>
                                <input class="form--control" placeholder="@lang('Enter Your Password')" name="password" id="password"
                                    requird>
                            </div>
                            <x-captcha></x-captcha>
                            <div class="login-meta mb-4 d-flex" data-wow-delay="0.5s">
                                <div class="col-12">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="form--check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">@lang('Remember Me')</label>
                                        </div>
                                        <a href="{{ route('user.password.request') }}" class="forgot-password">@lang('Forgot Your Password?')</a>
                                    </div>
                                </div>
                            </div>
                          
                            <button type="submit" id="recaptcha" class="btn btn--base  w-100">
                                @lang('Login')</button>
                            <div class="social-option">
                              
                                @if (
                                    @$credentials->google?->status == 1 ||
                                        @$credentials->facebook?->status == 1 ||
                                        @$credentials->linkedin?->status == 1)
                                    <ul>
                                        @if (@$credentials->google?->status == 1)
                                            <li>
                                                <a href="{{ route('user.social.login', 'facebook') }}" class="icon">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (@$credentials->facebook?->status == 1)
                                            <li>
                                                <a href="{{ route('user.social.login', 'google') }}" class="icon">
                                                    <i class="fa-brands fa-google"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (@$credentials->linkedin?->status == 1)
                                            <li>
                                                <a href="{{ route('user.social.login', 'Linkedin') }}" class="icon">
                                                    <i class="fa-brands fa-linkedin"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                                <p>@lang('Already have an account ? ')<a href="{{ route('user.register') }}"> @lang('Register')</a></p>
                            </div>
                        </form>
                    </div>
                    <!-- sign in components /> -->
                </div>
            </div>
        </div>
    </section>
    <!--=======-** Sign In End **-=======-->
@endsection
