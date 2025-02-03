<!-- ==================== Header End Here ==================== -->
@php
    $pages = App\Models\Page::where('tempname', $activeTemplate)->get();
@endphp

<!--========================== Header section Start ==========================-->
<div class="header-main-area {{ !Route::is('home') ? 'header-two' : '' }}">
    <div class="header" id="header">
        <div class="container position-relative">
            <div class="row">
                <div class="header-wrapper">
                    <!-- ham menu -->
                    <i class="fa-sharp fa-solid fa-bars-staggered ham__menu" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"></i>

                    <!-- logo -->
                    <div class="header-menu-wrapper align-items-center d-flex">
                        <div class="logo-wrapper">
                            <a href="{{ route('home') }}" class="normal-logo" id="normal-logo"> <img
                                    src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="...">
                            </a>
                        </div>
                    </div>
                    <!-- / logo -->
                    <div class="menu-right-wrapper">
                        <div class="menu-wrapper">
                            <ul class="main-menu">
                                @foreach ($pages as $page)
                                    @if ($page->name != 'Blog')
                                        <li class="nav-item">
                                            <a class="{{ Request::url() == url('/') . '/' . $page->slug ? 'active' : '' }}"
                                                href="{{ route('pages', [$page->slug]) }}">{{ $page->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <ul class="login d-lg-flex d-none align-items-center gap-3">
                        <li class="language">
                            <div class="language-box">
                                <i class="fa-solid fa-globe"></i>
                                <select class="select langSel">
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->code }}"
                                            @if (Session::get('lang') === $language->code) selected @endif>
                                            {{ __(ucfirst($language->name)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </li>

                        @if (!auth()->user() && !auth('instructor')->user())
                            <li class="login-registration-list__item">
                                <a href="{{ route('user.login') }}">@lang('Sign In')<i
                                        class="fa-solid fa-angles-right"></i></a>
                            </li>
                        @endif

                        @if (auth()->user())
                            <li class="login-registration-list__item">
                                <a href="{{ route('user.home') }}">@lang('Dashboard') </a>
                            </li>
                        @endif

                        @if (auth('instructor')->user())
                            <li class="login-registration-list__item">
                                <a href="{{ route('instructor.home') }}">@lang('Dashboard') </a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--========================== Header section End ==========================-->

<!--========================== Sidebar mobile menu wrap Start ==========================-->
<div class="offcanvas offcanvas-start text-bg-light" tabindex="-1" id="offcanvasExample">
    <div class="offcanvas-header">
        <div class="logo">
            <div class="header-menu-wrapper align-items-center d-flex">
                <div class="logo-wrapper">
                    <a href="{{ route('home') }}" class="normal-logo" id="offcanvas-logo-normal">
                        <img src="{{ getImage(getFilePath('logoIcon') . '/logo_white.png') }}" alt="logo">
                    </a>
                </div>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @auth
            <div class="user-info">
                <div class="user-thumb">
                    <a href="{{ route('user.home') }}">
                        <img src="{{ getImage(getFilePath('userProfile') . '/' . auth()->user()?->image, getFileSize('userProfile')) }}"
                            alt="user-thumb" />
                    </a>

                </div>
                <a href="{{ route('user.home') }}">
                    <h4>{{ auth()->user()->fullname }}</h4>
                </a>
            </div>
        @endauth
        <ul class="side-Nav">
            <li>
                <a class="{{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">@lang('Home')</a>
            </li>
            <li>
                <a class="{{ Route::is('categories') ? 'active' : '' }}"
                    href="{{ route('categories') }}">@lang('Categories')</a>
            </li>
            <li>
                <a class="{{ Route::is('course') ? 'active' : '' }}"
                    href="{{ route('course') }}">@lang('Course')</a>
            </li>
            <li>
                <a class="{{ Route::is('blog') ? 'active' : '' }}" href="{{ route('blog') }}">@lang('Blog') </a>
            </li>
            <li>
                <a class="{{ Route::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">@lang('Contact')
                </a>
            </li>

            @if (auth()->user())
                <li>
                    <a href="{{ route('user.home') }}">@lang('Dashboard') </a>
                </li>
            @endif

            @if (auth('instructor')->user())
                <li>
                    <a href="{{ route('instructor.home') }}">@lang('Dashboard') </a>
                </li>
            @endif

            @guest
                <li>
                    <a href="{{ route('user.login') }}">@lang('Login') </a>
                </li>
                <li>
                    <a href="{{ route('user.register') }}" class="login-btn">@lang('Signup')</a>
                </li>
            @endguest
            <li class="language">
                <div class="language-box side-box">
                    <i class="fa-solid fa-globe"></i>
                    <select class="select langSel">
                        @foreach ($languages as $language)
                            <option value="{{ $language->code }}" @if (Session::get('lang') === $language->code) selected @endif>
                                {{ __(ucfirst($language->name)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </li>
        </ul>
    </div>
</div>

<!--========================== Sidebar mobile menu wrap End ==========================-->
