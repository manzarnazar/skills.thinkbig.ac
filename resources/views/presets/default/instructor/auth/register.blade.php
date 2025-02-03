@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $policyPages = getContent('policy_pages.element', false, null, true);
        $credentials = gs()->socialite_credentials;
    @endphp

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
                                <a href="{{ route('home') }}"><img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="login-image"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-6 px-0">
                    <!-- < sign in components -->
                    <div class="login-box">
                        <div class="close--btn">
                            <div class="wrap">
                                <a href="index.html"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                        </div>
                        <h4 class="title">@lang('Create Instructor Account')</h4>
                        <form action="{{ route('instructor.register') }}" class="verify-gcaptcha" method="POST">
                            @csrf

                            <div class="mb-4 form-group">
                                <small class="text-danger usernameExist"></small>
                                <label for="username" class="mb-2 form--label">@lang('User Name')</label>
                                <input type="text" class="form--control checkUser" id="username"
                                    placeholder="@lang('Instructor Name')" name="username" value="{{ old('username') }}" required>
                            </div>

                            <div class="mb-4 form-group">
                                <small class="text-danger emailExist"></small>
                                <label for="email" class="mb-2 form--label">@lang('Email')</label>
                                <input type="text" class="form--control" id="email" placeholder="@lang('Email')"
                                    name="email" value="{{ old('email') }}">
                            </div>


                            <div class="mb-4 form-group">
                                <label class="mb-2 form--label">@lang('Country')</label>
                                <div class="col-sm-12">
                                    <select class="form--control form-select" name="country">
                                        @foreach ($countries as $key => $country)
                                            <option data-mobile_code="{{ $country->dial_code }}"
                                                value="{{ $country->country }}" data-code="{{ $key }}">
                                                {{ __($country->country) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4 form-group">
                                <label for="mobile" class="mb-2 form--label required">@lang('Mobile Number')</label>
                                <div class="input-group">
                                    <span class="input-group-text bg--base text-white b-none mobile-code">
                                    </span>
                                    <input type="hidden" name="mobile_code">
                                    <input type="hidden" name="country_code">
                                    <input type="number" id="mobile"
                                        class="form--control form-control form--control checkUser" placeholder="Phone"
                                        name="mobile" value="{{ old('mobile') }}"
                                        aria-label="Dollar amount (with dot and two decimal places)" required>
                                </div>
                                <small class="text-danger mobileExist"></small>
                            </div>

                            <div class="mb-4 form-group">
                                <label for="your-password" class="mb-2 form--label">@lang('Password')</label>
                                <div class="input-group">
                                    <input id="your-password" type="password" class="form-control form--control"
                                        name="password" placeholder="Password" required>
                                    @if ($general->secure_password)
                                        <div class="input-popup">
                                            <p class="error lower">@lang('1 small letter minimum')</p>
                                            <p class="error capital">@lang('1 capital letter minimum')</p>
                                            <p class="error number">@lang('1 number minimum')</p>
                                            <p class="error special">@lang('1 special character minimum')</p>
                                            <p class="error minimum">@lang('6 character password')</p>
                                        </div>
                                    @endif
                                    <div class="password-show-hide toggle-password-change fas fa-eye-slash"
                                        data-target="your-password"> </div>
                                </div>
                            </div>

                            <div class="mb-4 form-group">
                                <label for="confirm-password" class="mb-2 form--label">@lang('Confirm Password')</label>
                                <div class="input-group">
                                    <input id="confirm-password" type="password" class="form-control form--control"
                                        name="password_confirmation" placeholder="Confirm Password" required>
                                    <div class="password-show-hide toggle-password-change fas fa-eye-slash"
                                        data-target="confirm-password"> </div>
                                </div>
                            </div>
                            <x-captcha></x-captcha>
                            @if ($general->agree)
                                <div class="mb-4 form-group">
                                    <div class="form--check">
                                        <input class="form-check-input" type="checkbox" id="agree"
                                            @checked(old('agree')) name="agree" required>
                                        <div class="form-check-label">
                                            <label>
                                                @lang('I agree with') @foreach ($policyPages as $policy)
                                                    <a href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}"
                                                        class="text--base">{{ __($policy->data_values->title) }}</a>
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <button type="submit" id="recaptcha" class="btn btn--base w-100">
                                @lang('Sign Up')</button>
                            <div class="social-option">
                                @if (
                                    @$credentials->google?->status == 1 ||
                                        @$credentials->facebook?->status == 1 ||
                                        @$credentials->linkedin?->status == 1)
                                    <ul>
                                        @if (@$credentials->google?->status == 1)
                                            <li>
                                                <a href="{{ route('instructor.social.login', 'facebook') }}" class="icon">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (@$credentials->facebook?->status == 1)
                                            <li>
                                                <a href="{{ route('instructor.social.login', 'google') }}" class="icon">
                                                    <i class="fa-brands fa-google"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (@$credentials->linkedin?->status == 1)
                                            <li>
                                                <a href="{{ route('instructor.social.login', 'Linkedin') }}" class="icon">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                                <p>@lang('Already have an account ? ')<a href="{{ route('instructor.login') }}"> @lang('Login')</a></p>
                            </div>
                        </form>
                    </div>
                    <!-- sign in components /> -->
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">@lang('You already have an account please Login ')</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn-sm"
                        data-bs-dismiss="modal">@lang('Close')</button>
                    <a href="{{ route('instructor.login') }}" class="btn btn--base btn-sm">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('style')
    <style>
        .country-code .input-group-text {
            background: #fff !important;
        }

        .country-code select {
            border: none;
        }

        .country-code select:focus {
            border: none;
            outline: none;
        }
    </style>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/common/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            @if ($general->secure_password)
                $('input[name=password]').on('input', function() {
                    secure_password($(this));
                });

                $('[name=password]').focus(function() {
                    $(this).closest('.form-group').addClass('hover-input-popup');
                });

                $('[name=password]').focusout(function() {
                    $(this).closest('.form-group').removeClass('hover-input-popup');
                });
            @endif

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
