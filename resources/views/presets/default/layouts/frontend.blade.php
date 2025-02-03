<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $general->siteName(__($pageTitle)) }}</title>
    @include('includes.seo')
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/common/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/common/css/all.min.css') }}" rel="stylesheet">
    <!-- Slick Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('assets/common/css/line-awesome.min.css') }}">
    <!-- Slick CSS-->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
    <!-- Animate CSS-->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/animate.min.css') }}">
    <!-- Odometer CSS-->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/odometer.css') }}">
    <!-- Magnific Popup CSS-->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/magnific-popup.css') }}">
    <!-- plyr -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/plyr.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}">
    <!-- Custom CSS-->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/custom.css') }}">
    
    @stack('style-lib')
    @stack('style')

    <link rel="stylesheet"
        href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color1={{ $general->base_color }}&color2={{ $general->secondary_color }}">
</head>

<body>
    <!--==================== Preloader Start ====================-->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <span class="loader"></span>
            </div>
        </div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="sidebar-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    @if (
        !Route::is('user.login') &&
            !Route::is('user.register') &&
            !Route::is('user.password.email') &&
            !Route::is('instructor.login') &&
            !Route::is('instructor.register') &&
            !Route::is('instructor.password.email'))
        {{-- ------------------------------------Header section------------------------------------ --}}
        @include($activeTemplate . 'components.header')
        {{-- --------------------------------------End header section------------------------------------ --}}
    @endif

    @php
        $pages = App\Models\Page::where('tempname', $activeTemplate)->get();
    @endphp

    @yield('content')

    @if (!Route::is('user.login') && !Route::is('user.register') && !Route::is('user.password.email')&& !Route::is('instructor.login') && !Route::is('instructor.register') && !Route::is('instructor.password.email'))
        {{-- ------------------------------------Header section------------------------------------ --}}
        @include($activeTemplate . 'components.footer')
        {{-- --------------------------------------End header section------------------------------------ --}}
    @endif

    {{-- -------------------------------- cockie popup section -------------------------------- --}}
    @include($activeTemplate . 'components.cookie_popup')
    {{-- --------------------------------------End cockie popup section------------------------------------ --}}

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('assets/common/js/jquery-3.7.1.min.js') }}"></script>

  

    <!-- moment js -->
    <script src="{{ asset($activeTemplateTrue . 'js/moment.min.js') }}"></script>
    <!-- Slick js -->
    <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
    <!-- Odometer js -->
    <script src="{{ asset($activeTemplateTrue . 'js/odometer.min.js') }}"></script>
    <!-- jquery appear js -->
    <script src="{{ asset($activeTemplateTrue . 'js/jquery.appear.min.js') }}"></script>
    <!-- wow js -->
    <script src="{{ asset($activeTemplateTrue . 'js/wow.min.js') }}"></script>
    <!-- Magnific Popup js -->
    <script src="{{ asset($activeTemplateTrue . 'js/jquery.magnific-popup.min.js') }}"></script>
    <!-- plyr -->
    <script src="{{ asset($activeTemplateTrue . 'js/plyr.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset($activeTemplateTrue . 'js/main.js') }}"></script>
    <script src="{{ asset('assets/common/js/bootstrap.bundle.min.js') }}"></script>

    @stack('script-lib')
    @stack('script')
    @include('includes.plugins')
    @include('includes.notify')
    @include('includes.language_js')

</body>

</html>
