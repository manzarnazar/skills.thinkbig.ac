@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
    <div class="row justify-content-center mx-lg-0">
        <div class="col-lg-12 justify-content-center">
            <div class="base--card">
                <div class="col-lg-12">
                    <form action="{{ route('instructor.course.update', $course->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                    style="background-image: url({{ getImage(getFilePath('course_image') . '/' . @$course->image) }});">
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit mb-3">
                                                <input type="file" class="profilePicUpload" name="image"
                                                    id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1"
                                                    class="btn btn--primary">@lang('Upload')</label>
                                                <small class="pt-4">@lang('Recommend image size')
                                                    {{ getFileSize('course_image') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-xl-8">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">@lang('Name') </label>
                                            <input class="form--control" name="name" value="{{ $course->name }}"
                                                placeholder="Enter a title" required>
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
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Price') </label>
                                    <input class="form--control" type="number" name="price" value="{{ $course->price }}"
                                        placeholder="Enter a price" min="0" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Discount') </label>
                                    <input class="form--control" type="number" name="discount"
                                        value="{{ $course->discount }}" placeholder="Enter a discount" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                                        <button type="button" class="btn btn--base btn--sm addFile">
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
                                                            id="inputCourseOutline" class="form-control form--control"
                                                            placeholder="Hostel Facilaties" value="{{ $item }}"
                                                            required />
                                                        <button class="input-group-text btn--danger remove-btn border-0"><i
                                                                class="las la-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mt-4">
                                <div class="form-group mb-3">
                                    <label class=" mb-2">@lang("What you'll Learn")</label>
                                    <textarea class="form--control trumEdit" name="learn_description">{{ $course->learn_description }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-4">
                                <div class="form-group mb-3">
                                    <label class=" mb-2">@lang('Course Curriculum')</label>
                                    <textarea class="form--control trumEdit" name="curriculum">{{ $course->curriculum }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-3">
                            <div class="form-group mb-3">
                                <label class=" mb-2">@lang('Description')</label>
                                <textarea class="form--control trumEdit" name="description">{{ $course->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 text-end">
                            <button type="submit" class="btn btn--base" id="btn-save"
                                value="add">@lang('Update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script-lib')
    <script src="{{ asset('assets/common/js/ckeditor.js') }}"></script>
@endpush

@push('style')
    <style>
        .image-upload .thumb .profilePicPreview {
            width: 100%;
            height: 210px;
            display: block;
            border-radius: 10px;
            background-size: cover !important;
            background-position: top;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden;
        }

        @media (max-width:1500px) {
            .image-upload .thumb .profilePicPreview {
                height: 152px;
            }
        }

        .image-upload .thumb .profilePicPreview.logoPicPrev {
            background-size: contain !important;
            background-position: center;
        }

        .image-upload .thumb .profilePicUpload {
            font-size: 0;
            display: none;
        }

        .image-upload .thumb .avatar-edit label {
            text-align: center;
            line-height: 32px;
            font-size: 18px;
            cursor: pointer;
            padding: 2px 25px;
            width: 100%;
            border-radius: 5px;
            box-shadow: 0 5px 10px 0 rgb(0 0 0 / 16%);
            transition: all 0.3s;
            margin-top: 6px;
        }

        .image-upload .thumb .profilePicPreview .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            text-align: center;
            width: 34px;
            height: 34px;
            font-size: 23px;
            border-radius: 50%;
            background-color: hsl(var(--base));
            color: #ffffff;
            display: none;
            opacity: .8;
        }

        .image-upload .thumb .profilePicPreview .remove-image:hover {
            opacity: 1;
        }

        .image-upload .thumb .profilePicPreview.has-image .remove-image {
            display: block;
        }
    </style>
@endpush

@push('script')
    <script>
        // image preview
        function proPicURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = $(input).parents('.thumb').find('.profilePicPreview');
                    $(preview).css('background-image', 'url(' + e.target.result + ')');
                    $(preview).addClass('has-image');
                    $(preview).hide();
                    $(preview).fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".profilePicUpload").on('change', function() {
            proPicURL(this);
        });

        $(".remove-image").on('click', function() {
            $(this).parents(".profilePicPreview").css('background-image', 'none');
            $(this).parents(".profilePicPreview").removeClass('has-image');
            $(this).parents(".thumb").find('input[type=file]').val('');
        });
    </script>

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
