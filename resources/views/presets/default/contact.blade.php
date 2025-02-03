@php
    $contactSection = getContent('contact.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include($activeTemplate . '/components/breadcumb')
    <!-- ==================== Contact Form & Map Start ==================== -->
    <section class="contact-section bg--white pb-100">
        <div class="container">
            <div class="row get-in-touch justify-content-center gy-4">
                <div class="col-lg-5 m-0">
                    <div class="contact-card card-left">
                        <div class="contact-right-side">
                            <h1 class="title">{{ __(@$contactSection->data_values?->title) }}</h1>
                            <ul>
                                <li>
                                    <div class="icon-wrap">
                                        <i class="fa-solid fa-phone-volume"></i>
                                    </div>
                                    <div class="content-wrap">
                                        <p class="title">@lang('Call Us At')</p>
                                        <a>
                                            <h6>{{ __(@$contactSection->data_values?->mobile) }}</h6>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-wrap">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </div>
                                    <div class="content-wrap">
                                        <p class="title">@lang('Email US ON')</p>
                                        <a>
                                            <h6>{{ __(@$contactSection->data_values?->email) }}</h6>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-wrap">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="content-wrap">
                                        <p class="title">@lang('Find US')</p>
                                        <a>
                                            <h6>{{ __(@$contactSection->data_values?->location) }}</h6>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <div class="description">@php echo (__(@$contactSection->data_values?->short_description))@endphp</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class=" contact-card wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                        <form method="post" autocomplete="off" class="verify-gcaptcha">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4 form-group">
                                        <label class="mb-3 form--label">@lang('Name')</label>
                                        <input class="form--control" name="name" placeholder="@lang('Name')"
                                            value="@if(auth()->user()){{ auth()->user()->fullname }}@else{{ old('name') }}@endif"
                                            @if (auth()->user()) readonly @endif required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4 form-group">
                                        <label class="mb-3 form--label">@lang('Email')</label>
                                        <input class="form--control" placeholder="@lang('Email')"
                                            name="email" value="@if(auth()->user()){{ auth()->user()->email }}@else{{ old('email') }}@endif"@if (auth()->user()) readonly @endif
                                            required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-4 form-group">
                                        <label class="mb-3 form--label">@lang('Subject')</label>
                                        <input class="form--control" placeholder="@lang('Subject')" name="subject"
                                            value="{{ old('subject') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 form-group">
                                <label class="mb-3 form--label">@lang('Message')</label>
                                <textarea class="form--control" name="message" placeholder="@lang('Type message')"></textarea>
                            </div>
                            <x-captcha></x-captcha>
                            <button class="btn btn--base-3 w-100">{{ @$contactSection->data_values?->button_name }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Contact Form & Map End ==================== -->
@endsection
