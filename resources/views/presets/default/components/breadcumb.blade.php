<!-- ==================== Breadcumb Start Here ==================== -->
<div class="breadcumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcumb__wrapper">
                    <h2 class="breadcumb__title mb-4">{{@$pageTitle}}</h2>
                    <ul class="breadcumb__list">
                        <li class="breadcumb__item"><a href="{{route('home')}}" class="breadcumb__link">@lang('Home')</a></li>
                        <li class="breadcumb__icon"> <i class="fa-solid fa-slash"></i> </li>
                        <li class="breadcumb__item"> <span class="breadcumb__item-text"> {{@$pageTitle}} </span> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==================== Breadcumb End Here ==================== -->