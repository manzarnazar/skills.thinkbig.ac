@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body px-4">
                    <form method="post" action="{{route('admin.ad.update',$ad->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="fw-bold">@lang('Name') </label>
                                    <input type="text" class="form-control" name="name" placeholder="@lang('Name')"
                                         value="{{$ad->name}}" required />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="fw-bold">@lang('Image') </label>
                                    <input type="file" class="form-control" name="image" />
                                </div>
                            </div>

                         
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="fw-bold">@lang('Link') </label>
                                    <input type="text" class="form-control" name="link" value="{{$ad->link}}" required />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold">@lang('Width') </label>
                                    <input type="text" class="form-control" placeholder="@lang('Widht')"
                                        name="width" value="{{$ad->width}}" required readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold">@lang('Height') </label>
                                    <input type="text" class="form-control" placeholder="@lang('Height')"
                                        name="height" value="{{$ad->height}}" required  readonly />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <img src="{{ getImage(getFilePath('ads') . '/' . @$ad->image) }}" alt="@lang('adImage')">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-end">
                                <button type="submit" class="btn btn--primary btn-global">@lang('Update')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
