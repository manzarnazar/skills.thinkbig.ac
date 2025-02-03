@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
  
    <div class="row justify-content-center gy-4">
        <div class="col-lg-6">
            <div class="base--card">
                <form action="{{ route('instructor.withdraw.submit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        @php
                            echo $withdraw->method->description;
                        @endphp
                    </div>
                    <x-custom-form identifier="id"
                        identifierValue="{{ $withdraw->method->form_id }}"></x-custom-form>
                    @if (auth('instructor')->user()->ts)
                        <div class="form-group">
                            <label>@lang('Google Authenticator Code')</label>
                            <input type="text" name="authenticator_code" class="form-control form--control" required>
                        </div>
                    @endif
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn--base w-100">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


