@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row mx-lg-0 gy-4">
        @if (!auth()->user()->ts)
            <div class="col-xl-5 col-lg-5">
                <div class="base--card">
                    <div class="two-fact-wrapper">
                        <div class="two-fact-left">
                            <h5>@lang('Two Factor Authenticator')</h5>
                            <div class="qr-img mb-4 mx-auto text-center">
                                <img class="mx-auto" src="{{ $qrCodeUrl }}" alt="">
                            </div>
                            <div class="two-fact-left__content">
                                <p>@lang('Use the QR code or setup key on your Google Authenticator app to add your account.')</p>
                            </div>
                            <div class="two-fact-left__bottom">
                                <div class="top">
                                    <h6>@lang('Setup Key')</h6>
                                    <span><i class="fa fa-info-circle"></i></span>
                                </div>
                                <div class="bottom">
                                    
                                    <div class="input-group">
                                        <input type="text" class="form-control form--control referralURL" readonly id="key"
                                        name="key" value="{{ $secret }}">
                                        <button type="button" class="input-group-text btn btn--base copytext"
                                            style="border-radius: 0px" id="copyBoard">
                                            <i class="fa fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xl-7 col-lg-7">
            <div class="profile-right-wrap">
                <div class="row gy-3">
                    <div class="col-sm-12">
                        @if (auth()->user()->ts)
                            <div class="base--card">
                                <div class="profile-right">
                                    <h5 class="mb-4">@lang('Disable 2FA Security')</h5>
                                </div>
                                <form action="{{ route('user.twofactor.disable') }}" method="POST">
                                    <div class="card-body">
                                        @csrf
                                        <input type="hidden" name="key" value="{{ $secret }}">
                                        <div class="form-group">
                                            <label class="form-label">@lang('Google Authenticatior OTP')</label>
                                            <input type="text" class="form-control form--control" name="code"
                                                required>
                                        </div>
                                        <p class="mb-2">
                                            @lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')
                                        </p>
                                        <button type="submit" class="btn btn--base w-100 mt-4">@lang('Save')</button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="base--card">
                                <div class="profile-right">
                                    <h5 class="mb-4">@lang('Enable 2FA Security')</h5>
                                </div>

                                <form action="{{ route('user.twofactor.enable') }}" method="POST">
                                    <div class="card-body">
                                        @csrf
                                        <input type="hidden" name="key" value="{{ $secret }}">
                                        <div class="form-group">
                                            <label class="form-label">@lang('Google Authenticatior OTP')</label>
                                            <input type="text" class="form-control form--control" name="code"
                                                required>
                                        </div>
                                        <p class="mb-2">
                                            @lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')
                                        </p>
                                        <button type="submit" class="btn btn--base w-100 mt-4">@lang('Save')</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- End Dashboard -->
    @endsection

    @push('style')
        <style>
            .copied::after {
                background-color: #{{ $general->base_color }};
            }
        </style>
    @endpush

    @push('script')
        <script>
            (function($) {
                "use strict";
                $('#copyBoard').on('click', function() {
                    var copyText = document.getElementsByClassName("referralURL");
                    copyText = copyText[0];
                    copyText.select();
                    copyText.setSelectionRange(0, 99999);
                    /*For mobile devices*/
                    document.execCommand("copy");
                    copyText.blur();
                    this.classList.add('copied');
                    setTimeout(() => this.classList.remove('copied'), 1500);
                });
            })(jQuery);
        </script>
    @endpush
