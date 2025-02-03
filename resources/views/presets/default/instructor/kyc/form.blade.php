@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="body-area">
                 
                    <form action="{{ route('instructor.kyc.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-custom-form identifier="act" identifierValue="instructor_kyc"></x-custom-form>
                        <div class="row justify-content-end text-end">
                            <div class="form-group">
                                <button type="submit" class="btn btn--base">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
