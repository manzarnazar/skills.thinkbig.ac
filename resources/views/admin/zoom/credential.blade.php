@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card b-radius--10">

                <div class="card-body p-3">
                    <div class="d-flex justify-content-end" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Setup Instruction">
                        <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.zoom.store.credential') }}" method="POST">
                        @csrf
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2">@lang('Zoom Account Id') </label>
                                        <input class="form-control" name="zoom_account_id"
                                            value="{{ __(@$admin->zoom_account_id ?? old('zoom_account_id')) }}"
                                            placeholder="@lang('Enter zoom account id')" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2">@lang('Zoom Client Id') </label>
                                        <input class="form-control" name="zoom_client_id"
                                            value="{{ __(@$admin->zoom_client_id ?? old('zoom_client_id')) }}"
                                            placeholder="@lang('Enter zoom client key')" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2">@lang('Zoom Secret Id') </label>
                                        <input class="form-control" name="zoom_secret_id"
                                            value="{{ __(@$admin->zoom_secret_id ?? old('zoom_secret_id')) }}"
                                            placeholder="@lang('Enter zoom secret key')" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end text-end">
                            <div class="col-4">
                                <button type="submit" class="btn btn--success">@lang('Save') </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('Zoom Credential setup')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">
                        @lang('1. Navigate to the vibrant world of Zoom Marketplace at') <a class="text--base"
                            href="https://marketplace.zoom.us/">https://marketplace.zoom.us/</a> @lang("and embark on your
                                                                                journey by creating your very own account.")
                    </p>
                    <p class="mb-3">
                        @lang("2. Delve deeper into the possibilities by clicking on the 'Develop' dropdown button. From there, let your
                                                                        creativity soar as you click on the illustrious 'Build Legacy App' nestled within the navigation
                                                                        section.")
                    </p>
                    <p class="mb-3">
                        @lang("3. Embrace the power of connectivity as you select 'Server-to-Server' integration. With each click, you're
                                                                        one step closer to bringing your vision to life. Create an app that reflects your unique essence, and
                                                                        meticulously set your account ID, client ID, and client secret with precision and care. Let the journey
                                                                        begin!")
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--primary" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection
