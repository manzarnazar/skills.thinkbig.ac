@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include($activeTemplate . '/components/breadcumb')
    @if ($sections->secs != null)
        <section class="blog pt-150 pb-80">
            @foreach (json_decode($sections->secs) as $sec)
                @include($activeTemplate . 'sections.' . $sec)
            @endforeach
        </section>
    @endif
@endsection

<!-- ==================== Blog End Here ==================== -->
