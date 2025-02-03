@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
    <section class="account py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-12">
                    <div class="account-form base--card mt-5">
                        <div class="account-form__content mb-4">
                            <h3 class="account-form__title mb-2 text-center">{{ __($pageTitle) }}</h3>
                        </div>
                        <form method="POST" action="{{ route('instructor.data.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-sm-6 mb-4">
                                    <label class="form--label">@lang('First Name')</label>
                                    <input type="text" class="form-control form--control" name="firstname"
                                        value="{{ old('firstname') }}" placeholder="@lang('First Name')" required>
                                </div>

                                <div class="form-group col-sm-6 mb-4">
                                    <label class="form--label">@lang('Last Name')</label>
                                    <input type="text" class="form-control form--control" name="lastname"
                                        value="{{ old('lastname') }}" placeholder="@lang('Last Name')" required>
                                </div>
                                <div class="form-group col-sm-6 mb-4">
                                    <label class="form--label">@lang('Address')</label>
                                    <input type="text" class="form-control form--control" name="address"
                                        value="{{ old('address') }}" placeholder="@lang('Address')">
                                </div>
                                <div class="form-group col-sm-6 mb-4">
                                    <label class="form--label">@lang('State')</label>
                                    <input type="text" class="form-control form--control" name="state"
                                        value="{{ old('state') }}" placeholder="@lang('State')">
                                </div>
                                <div class="form-group col-sm-6 mb-4">
                                    <label class="form--label">@lang('Zip Code')</label>
                                    <input type="text" class="form-control form--control" name="zip"
                                        value="{{ old('zip') }}" placeholder="@lang('Zip')">
                                </div>

                                <div class="form-group col-sm-6 mb-4">
                                    <label class="form--label">@lang('City')</label>
                                    <input type="text" class="form-control form--control" name="city"
                                        value="{{ old('city') }}" placeholder="@lang('City')">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class=" btn btn--base w-100">
                                    @lang('Save')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
