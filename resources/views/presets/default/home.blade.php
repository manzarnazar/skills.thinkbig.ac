@extends($activeTemplate . 'layouts.frontend')
@section('content')

    {{-- ------------------------------------Header section------------------------------------ --}}
    @include($activeTemplate . 'sections.banner')
    {{-- --------------------------------------End header section------------------------------------ --}}

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
