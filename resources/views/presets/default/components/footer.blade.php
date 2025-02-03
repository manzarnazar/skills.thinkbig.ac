@php
    $footerSection = getContent('footer.content', true);
    $contactSection = getContent('contact.content', true);
    $footerSectionElements = getContent('footer.element', false);
    $pages = App\Models\Page::where('tempname', $activeTemplate)->get();
    $policyElements = getContent('policy_pages.element', false);
@endphp




<!-- blog section -->
<!-- ==================== Footer Start Here ==================== -->
<footer class="footer-area">
    <div class="footer-top py-115">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <div class="footer-item__logo wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                            <a href="{{ route('home') }}" class="footer-logo-normal" id="footer-logo-normal"> <img
                                    src="{{ getImage(getFilePath('logoIcon') . '/logo_white.png') }}"
                                    alt="logo"></a>
                        </div>
                        <div class="footer-item__desc wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                            @php echo @$contactSection->data_values?->short_description;@endphp
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Quick Links')</h5>
                        <ul class="footer-menu">
                            @foreach (@$pages as $page)
                                @if ($page->slug == 'course')
                                    <li class="footer-menu__item">
                                        <a href="{{ route('pages', [$page->slug]) }}" class="footer-menu__link"><i
                                                class="fa-solid fa-angles-right"></i>
                                            {{ $page->name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                            <li class="footer-menu__item"><a href="{{ url('/cookie-policy') }}"
                                    class="footer-menu__link"><i class="fa-solid fa-angles-right"></i>
                                    @lang('Cookie Policy')</a>
                            </li>
                            @if (@$general->agree == 1)
                                @foreach (@$policyElements as $element)
                                    <li class="footer-menu__item">
                                        <a href="{{ route('policy.pages', [slug($element->data_values->title), $element->id]) }}"
                                            class="footer-menu__link"><i class="fa-solid fa-angles-right"></i>
                                            @php
                                                echo $element->data_values?->title;
                                            @endphp
                                        </a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Contact Us')</h5>
                        <div class="footer-contact-info mb-3">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                            <p><a
                                    href="tel:{{ $contactSection->data_values->mobile }}">{{ @$contactSection->data_values?->mobile }}</a>
                            </p>
                        </div>
                        <div class="footer-contact-info mb-3">
                            <i class="fa-regular fa-envelope"></i>
                            <p><a
                                    href="mailto:{{ @$contactSection->data_values?->email }}">@lang('Call us:'){{ @$contactSection->data_values?->email }}</a>
                            </p>
                        </div>
                        <ul class="social-list wow animate__animated animate__fadeInUp" data-wow-delay="1s">
                            @foreach ($footerSectionElements as $item)
                                <li class="social-list__item">
                                    <a href="{{ @$item->data_values?->url }}" class="social-list__link icon-wrapper">
                                        <div class="icon">
                                            @php
                                                echo @$item->data_values?->icon;
                                            @endphp
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Newsletter')</h5>
                        <p class="footer-item__desc">
                            @php
                                echo @$footerSection->data_values?->short_description;
                            @endphp
                        </p>
                        <div class="subscribe-box">
                            <form action="{{ route('subscribe') }}" method="POST">
                                @csrf
                                <input class="form--control footer-input" type="text"
                                    placeholder="@lang('Email Address')">
                                <button class="sub-btn" type="submit"><i
                                        class="fa-regular fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Top End-->

    <!-- bottom Footer -->
    <div class="bottom-footer py-3">
        <div class="container">
            <div class="row text-center gy-2">
                <div class="col-lg-12">
                    <div class="bottom-footer-text">&copy; @lang('Copyright') {{ now()->year }}
                        @lang('. All rights reserved.')</div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ==================== Footer End Here ==================== -->
