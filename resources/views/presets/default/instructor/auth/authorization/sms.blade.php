@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="account py-120">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area base--card mt-5">
                        <h5 class="pb-3 text-center border-bottom">@lang('Verify Mobile Number')</h5>
                        <form action="{{ route('instructor.verify.mobile') }}" method="POST" class="submit-form">
                            @csrf
                            <p class="verification-text">@lang('A 6 digit verification code sent to your mobile number') : +{{ showMobileNumber(auth()->user()->mobile) }}
                            </p>
                            @include($activeTemplate . 'components.verification_code')
                            <div class="mb-3">
                                <button type="submit" class="btn btn--base w-100">@lang('Save')</button>
                            </div>
                            <div class="form-group">
                                <p>
                                    @lang('If you don\'t get any code'), <a href="{{ route('instructor.send.verify.code', 'phone') }}"
                                        class="forget-pass"> @lang('Try again')</a>
                                </p>
                                @if ($errors->has('resend'))
                                    <br />
                                    <small class="text-danger">{{ $errors->first('resend') }}</small>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
