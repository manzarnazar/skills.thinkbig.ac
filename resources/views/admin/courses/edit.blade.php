@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-4">
                    <form action="{{ route('admin.course.update', $course->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <div class="image-upload">
                                            <div class="thumb">
                                                <div class="avatar-preview">
                                                    <div class="profilePicPreview"
                                                        style="background-image: url({{ getImage(getFilePath('course_image') . '/' . @$course->image) }});">
                                                        <button type="button" class="remove-image"><i
                                                                class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="avatar-edit">
                                                    <input type="file" class="profilePicUpload" name="image"
                                                        id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                    <small class="pt-4 text-danger mb-4">@lang('image size')
                                                        {{ getFileSize('course_image') }}</small>
                                                    <label for="profilePicUpload1"
                                                        class="btn btn--primary">@lang('Upload')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-2">@lang('Name') </label>
                                                <input class="form-control" name="name"
                                                    value="{{ $course->name ?? old('name') }}" placeholder="Enter a name"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-2">@lang('Category') </label>
                                                <select class="form--control form-select" name="category_id" id="category"
                                                    required>
                                                    <option value="0">@lang('Select One')</option>
                                                    @foreach ($categories as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == @$course->category_id ? 'selected' : '' }}>
                                                            {{ __($item->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label class="mb-2">@lang('Price') </label>
                                        <input class="form-control" type="number" name="price"
                                            value="{{ $course->price ?? old('price') }}" placeholder="Enter a price"
                                            min="0" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label class="mb-2">@lang('Discount') </label>
                                        <input class="form-control" type="number" name="discount"
                                            value="{{ $course->discount ?? old('discount') }}"
                                            placeholder="Enter a discount" min="0">
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2">@lang('Status')</label>
                                        <select class="form--control form-select" name="status" id="category" required>
                                            <option value="">@lang('Select One')</option>
                                            <option value="1"{{ $course->status == 1 ? 'selected' : '' }}>
                                                @lang('Active')</option>
                                            <option value="0"{{ $course->status == 0 ? 'selected' : '' }}>
                                                @lang('Pending')</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="text-end">
                                            <button type="button" class="btn btn-success btn--sm addFile">
                                                <i class="fa fa-plus"></i> @lang('Add New')
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="file-upload">
                                                    <label class="form-label">@lang('Course Outline')</label>
                                                    <input type="text" name="course_outline[]" id="inputCourseOutline"
                                                        class="form-control form--control mb-2" required
                                                        placeholder="Course Outline"
                                                        value="{{ $course->course_outline[0] }}" />
                                                </div>
                                            </div>

                                        </div>
                                        <div id="fileUploadsContainer">
                                            @php
                                                $outlines = $course->course_outline;
                                                unset($outlines[0]);
                                            @endphp
                                            @foreach ($outlines as $index => $item)
                                                <div class="row elements">
                                                    <div class="col-sm-12 my-3">
                                                        <div class="file-upload input-group">
                                                            <input type="text" name="course_outline[]"
                                                                id="inputCourseOutline"
                                                                class="form-control form--control"
                                                                placeholder="Hostel Facilaties" value="{{ $item }}"
                                                                required />
                                                            <button
                                                                class="input-group-text btn--danger remove-btn border-0"><i
                                                                    class="las la-times"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2">@lang("What you'll Learn")</label>
                                        <textarea class="form-control trumEdit" name="learn_description">{{ __($course->learn_description) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2">@lang('Course Curriculum')</label>
                                        <textarea class="form-control trumEdit" name="curriculum">{{ __($course->curriculum) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2">@lang('Description')</label>
                                        <textarea class="form-control trumEdit" name="description">{{ __($course->description) }}</textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn--primary btn-global" id="btn-save"
                                value="add">@lang('Save')</button>
                        </div>
                    </form>
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection

@push('style')
    <style>
        .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
            height: 200px;
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            var fileAdded = 0;
            $('.addFile').on('click', function() {
                if (fileAdded >= 20) {
                    notify('error', 'You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                    <div class="row elements">
                        <div class="col-sm-12 my-3">
                            <div class="file-upload input-group">
                                <input type="text" name="course_outline[]" id="inputCourseOutline" class="form-control form--control "
                                    placeholder="Course Outline" required />  
                                    <button class="input-group-text btn--danger remove-btn border-0"><i class="las la-times"></i></button>                                          
                            </div>
                        </div>
                    </div>
                `)

            });
            $(document).on('click', '.remove-btn', function() {
                fileAdded--;
                $(this).closest('.elements').remove();
            });
        })(jQuery);
    </script>
@endpush
