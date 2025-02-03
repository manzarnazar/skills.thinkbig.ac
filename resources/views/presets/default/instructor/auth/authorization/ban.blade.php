@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="account py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 mt-5">
                    <div class="base--card">
                        <div class="card-body">
                            <h3 class="text-center text-danger">@lang('You are banned')</h3>
                            <p class="fw-bold mb-1">@lang('Reason'):</p>
                            <p>{{ @$user->ban_reason }}</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('home') }}" class=" btn btn--base fw-bold home-link mt-4"> <i class="las la-long-arrow-alt-left"></i>
                            @lang('Go to Home')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
