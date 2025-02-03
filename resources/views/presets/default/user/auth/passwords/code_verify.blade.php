@extends($activeTemplate . 'layouts.frontend')
@section('content')
<section class="account py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 d-flex justify-content-center">
                    <div class="account-form base--card mt-5">
                        <div class="verification-code-wrapper">
                            <div class="verification-area">
                                <h3 class="pb-3 border-bottom">@lang('Verify Email Address')</h3>
                                <form action="{{ route('user.password.verify.code') }}" method="POST" class="submit-form">
                                    @csrf
                                    <p class="verification-text">@lang('A 6 digit verification code sent to your email address'): {{ showEmailAddress($email) }}</p>
                                    <input type="hidden" name="email" value="{{ $email }}">
                                    @include($activeTemplate . 'components.verification_code')
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn--base w-100">@lang('Save')</button>
                                    </div>
                                    <div class="form-group">
                                        @lang('Please check including your Junk/Spam Folder. if not found, you can')
                                        <a href="{{ route('user.password.request') }}" class="text--base">@lang('Try to send again')</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
