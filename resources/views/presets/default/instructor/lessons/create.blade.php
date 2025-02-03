@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
    <div class="row justify-content-center mx-lg-0">
        <div class="col-lg-12 justify-content-center">
            <div class="base--card">
                <div class="col-lg-12">
                    <form action="{{ route('instructor.lesson.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="form-group mb-3">
                                    <label class=" mb-2">@lang('Title') </label>
                                    <input class="form-control form--control" name="title"
                                        value="{{ __(@$lesson->title ?? old('title')) }}" placeholder="Enter a title"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6">
                                <div class="form-group mb-3">
                                    <label class=" mb-2">@lang('Course') </label>
                                    <select class="form--control form-select" name="course_id" id="course"
                                        onchange="course(this);">
                                        <option value="0">@lang('Select One')</option>
                                        @foreach ($courses ?? [] as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == @$lesson->course_id ? 'selected' : '' }}>
                                                {{ __($item->name) }}
                                            </option>
                                        @endforeach>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Select Value') </label>
                                    <select name="value" class="form--control form-select" id="value" required>
                                        <option value="">@lang('Select One')</option>
                                        <option value="0" {{ @$lesson->value == 0 ? 'selected' : old('value') }}>
                                            @lang('Free')</option>
                                        <option value="1" {{ @$lesson->value == 1 ? 'selected' : old('value') }}>
                                            @lang('Premium')
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Selece Level') </label>
                                    <select class="form--control form-select" name="level" id="level" required>
                                        <option value="">@lang('Select One')</option>
                                        <option value="1" {{ @$lesson->level == 1 ? 'selected' : old('level') }}>
                                            @lang('Beginner')</option>
                                        <option value="2"{{ @$lesson->level == 2 ? 'selected' : old('level') }}>
                                            @lang('intermediate')</option>
                                        <option value="3"{{ @$lesson->level == 3 ? 'selected' : old('level') }}>
                                            @lang('Advance')</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Select Status') </label>
                                    <select class="form--control form-select" name="status" id="status" required>
                                        <option value="">@lang('Select One')</option>
                                        <option value="1" {{ @$lesson->status == 1 ? 'selected' : old('status') }}>
                                            @lang('Active')</option>
                                        <option value="0"{{ @$lesson->status == 0 ? 'selected' : old('status') }}>
                                            @lang('Pending')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Preview Video')</label>
                                    <select class="form--control form-select" name="preview_video" id="preview_video"
                                        required>
                                        <option value="1">@lang('Upload')</option>
                                        <option value="2">@lang('Video Url')</option>
                                        <option value="3">@lang('Live Class')</option>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-xl-12">
                            <div class="form-group mb-3">
                                <div>
                                    <label class="mb-2">@lang('Upload Video')</label>
                                    <input class="form--control" type="file" name="upload_video" id="browseFile">
                                </div>

                                <div style="display: none" class="progress mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                        style="width:75%; height:100%">75%
                                    </div>
                                </div>

                                <div class="video-show p-4 text-end" style="display: none">
                                    <a href="javascript:void(0)" class="uploadVideoDelete uploadvideo-icon" onclick="modalShow();">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </a>
                                    <video id="videoPreview" src="" controls
                                        style="width:100%; height:50% auto"></video>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 d-none">
                            <div class="form-group mb-3">
                                <label class="mb-2">@lang('Video Url')</label>
                                <input class="form--control" type="text" name="video_url">
                            </div>
                        </div>

                        <div class="row d-none live_class_inputs">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Agenda')</label>
                                    <input class="form--control" type="text" name="agenda" placeholder="Agenda name"
                                        value={{ @$zoomData->agenda }}>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Class Topic')</label>
                                    <input class="form--control" type="text" name="class_topic"
                                        placeholder="Class name of topic" value={{ @$zoomData->class_topic }}>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Zoom email')</label>
                                    <input class="form--control" type="email" name="email" placeholder="Zoom email"
                                        value={{ @$zoomData->email }}>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Approximate Time')</label>
                                    <input class="form--control" type="number" name="approximate_time"
                                        placeholder="Approximate meeting duration (minute)"
                                        value={{ @$zoomData->agenda }}>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Approval Type')</label>
                                    <select class="form--control form-select" name="approval_type" id="approval_type"
                                        required>
                                        <option value="0">@lang('Automatic')</option>
                                        <option value="1">@lang('Manually')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Type')</label>
                                    <select class="form--control form-select" name="type" id="type" required>
                                        <option value="1">@lang('Instant')</option>
                                        <option value="2">@lang('Scheduled')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Starting Time')</label>
                                    <input class="form--control" type="datetime-local" name="start_time"
                                        value={{ @$zoomData->agenda }}>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Password')</label>
                                    <input class="form--control" type="text" name="password"
                                        placeholder="Zoom meeting password" value={{ @$zoomData->agenda }}>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="mb-2">@lang('Description')</label>
                                <textarea class="form--control trumEdit" name="description"></textarea>
                            </div>
                        </div>
                </div>

                <div class="row justify-content-end text-end">
                    <div class="col-4 mt-4">
                        <button type="submit" class="btn btn--base">@lang('Save')</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="videoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">@lang('Alert')</h5>
                    <button type="button" class="btn-close btn btn--danger" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure? You delete upload video?')</p>
                    <input type="text" hidden name="fileName" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-modal="0"
                        data-bs-dismiss="modal">@lang('No')</button>
                    <button type="button" class="btn btn--primary" data-bs-dismiss="modal" data-modal="1"
                        onclick="uploadeVideoDelete(this);">@lang('Yes')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

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

@push('script-lib')
    <script src="{{ asset('assets/common/js/ckeditor.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/resumable.min.js') }}"></script>
@endpush

@push('script')
    {{-- ---------------------- upload video file js code ---------------------- --}}
    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '{{ route('instructor.lesson.video.upload') }}',
            query: {
                _token: '{{ csrf_token() }}'
            },
            fileType: ['mp4'],
            chunkSize: 10 * 1024 *
                1024,
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function(file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function(file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
            response = JSON.parse(response)
            $('#videoPreview').attr('src', response.path);
            $('#videoPreview').attr('data-file-name', response.filename);
            $('.video-show').show();
        });

        resumable.on('fileError', function(file, response) { // trigger when there is any error
            alert('file uploading error.')
        });


        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`);
            progress.find('.progress-bar').html(`${value}%`);
            if (value == 100) {
                setTimeout(() => {
                    hideProgress();
                }, 1500);
            }

        }

        function hideProgress() {
            progress.hide();
        }
    </script>

    <script>
        function uploadeVideoDelete(object) {
            var ancor = $('.uploadVideoDelete');
            var srcValue = ancor.siblings("video").attr('src');
            var fileName = ancor.siblings("video").data('file-name');
            uploadeVideoDeleteAjax(ancor, srcValue, fileName);
        }

        function uploadeVideoDeleteAjax(ancor, srcValue, fileName) {
            $.ajax({
                url: "{{ route('instructor.lesson.video.upload.delete') }}",
                type: "POST",
                data: {
                    videoUrl: srcValue,
                    fileName: fileName,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == 'success') {
                        ancor.parent().hide();
                        hideProgress();
                        var videoPreview = $('#videoPreview');
                        videoPreview.attr('src', '');
                        Toast.fire({
                            icon: response.status,
                            title: response.message
                        });
                    } else {
                        Toast.fire({
                            icon: response.status,
                            title: response.message
                        });
                    }
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            var selectElements = $('select[name="preview_video"]');
            var inputUploadVideo = $('input[name="upload_video"]');
            var inputVideoUrl = $('input[name="video_url"]');
            var videoPreview = $('#videoPreview');
            var live_class_inputs = $('.live_class_inputs');

            selectElements.on('change', function() {
                var selectedOption = $(this).val();
                if (selectedOption == 1) {
                    inputVideoUrl.parent().parent().addClass('d-none');
                    inputVideoUrl.removeAttr('required');
                    inputUploadVideo.closest('.form-group').removeClass('d-none');
                    live_class_inputs.addClass('d-none');

                } else if (selectedOption == 2) {
                    if (videoPreview.attr('src') == '') {
                        inputUploadVideo.closest('.form-group').addClass('d-none');
                        inputUploadVideo.removeAttr('required');
                        inputVideoUrl.parent().parent().removeClass('d-none');
                        live_class_inputs.addClass('d-none');
                        console.log('assa');
                    } else {
                        var videoModal = $('#videoModal');
                        var file_name = $('.uploadVideoDelete').siblings("video").data('file-name');
                        videoModal.find('form input[name=fileName]').val(file_name);
                        videoModal.modal('show');
                    }
                } else {
                    if (videoPreview.attr('src') == '') {
                        live_class_inputs.removeClass('d-none');
                        inputVideoUrl.removeAttr('required');
                        inputVideoUrl.parent().parent().addClass('d-none');
                        inputUploadVideo.closest('.form-group').removeClass('d-none');
                    } else {
                        var videoModal = $('#videoModal');
                        var file_name = $('.uploadVideoDelete').siblings("video").data('file-name');
                        videoModal.find('form input[name=fileName]').val(file_name);
                        videoModal.modal('show');
                    }
                }
            });
        });
        // ------------------------------------modal show js------------------------------------
        function modalShow() {
            var videoModal = $('#videoModal');
            videoModal.modal('show');
        }
    </script>
@endpush
