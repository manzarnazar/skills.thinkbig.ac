<!-- 404 section -->
<!-- header -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> {{ $general->siteName(__('404')) }}</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/common/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}">
</head>

<body>

    <!--==================== Preloader End ====================-->
    <!--========================== Sidebar mobile menu wrap End ==========================-->
    <section class="account">
        <div class="account-inner">
            <div class="container">
                <div class="row gy-4 justify-content-center align-items-center" style="height: 90vh">
                    <div class="col-lg-6">
                        <div class="error-wrap text-center">
                           
                            <div class="error__text">
                                <span>@lang('4')</span>
                                <span>@lang('0')</span>
                                <span>@lang('4')</span>
                            </div>
                            <h2 class="error-wrap__title mb-3">@lang('Page Not Found')</h2>
                            <p class="error-wrap__desc">@lang('Page you are looking have been deleted or does not exist')</p>
                            <a href="{{route('home')}}" class="btn btn--base">
                                <i class="la la-undo"></i> @lang('Go Home') 
                               
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  404 section /> -->
</body>

</html>
