@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.lesson.update', @$lesson->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="form-group mb-3">
                                    <label class=" mb-2">@lang('Title') </label>
                                    <input class="form-control" name="title"
                                        value="{{ __(@$lesson->title ?? old('title')) }}" placeholder="Enter a title"
                                        required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-xl-6">
                                <div class="form-group mb-3">
                                    <label class=" mb-2">@lang('Course') </label>
                                    <select class="form--control form-select" name="course_id" id="course">
                                        <option value="0">@lang('Select One')</option>
                                        @foreach ($course as $item)
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
                                    <label class=" mb-2">@lang('Select Status') </label>
                                    <select class="form--control form-select" name="status" id="status" required>
                                        <option value="">@lang('Select One')</option>
                                        <option value="1" {{ @$lesson->status == 1 ? 'selected' : '' }}>
                                            @lang('Active')</option>
                                        <option value="0"{{ @$lesson->status == 0 ? 'selected' : '' }}>
                                            @lang('Pending')</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-xl-6">
                                <div class="form-group mb-3">
                                    <label class=" mb-2">@lang('Select Level') </label>
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
                                    <label class="mb-2">@lang('Preview Video')</label>
                                    <select class="form--control form-select" name="preview_video" id="preview_video"
                                        required>
                                        <option value="1"
                                            {{ @$lesson->preview_video == 1 ? 'selected' : old('preview_video') }}>
                                            @lang('Upload')</option>
                                        <option value="2"
                                            {{ @$lesson->preview_video == 2 ? 'selected' : old('preview_video') }}>
                                            @lang('Video Url')
                                        </option>

                                        <option value="3" {{ @$lesson->preview_video == 3 ? 'selected' : '' }}>
                                            @lang('Live class')
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <div>
                                    <label class="mb-2">@lang('Upload Video')</label>
                                    <input class="form-control" type="file" name="upload_video" id="browseFile">
                                </div>

                                <div style="display: none" class="progress mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                        style="width:75%; height:100%">75%
                                    </div>
                                </div>

                                <div class="video-show p-4 {{ $lesson->upload_video ? '' : 'd-none' }}">
                                    <a href="javascript:void(0)" class="uploadVideoDelete" onclick="modalShow();"><i
                                        class="fa-solid fa-circle-xmark"></i></a>
                                    <video id="videoPreview" src="{{ $upload_video }}"
                                        data-file-name="{{ @$lesson->upload_video }}" data-id="{{ @$lesson->id }}"
                                        controls style="width:100%; height: 50%"></video>
                             
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 d-none">
                            <div class="form-group mb-3">
                                <label class="mb-2">@lang('Video Url')</label>
                                <input class="form-control" type="text" name="video_url"
                                    value="{{ $lesson->video_url }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="mb-2">@lang('Description')</label>
                                <textarea class="form--control trumEdit" name="description">{{ __($lesson->description) }}</textarea>
                            </div>
                        </div>


                        <div class="row justify-content-end text-end">
                            <div class="col-4 mt-4">
                                <button type="submit" class="btn btn-success">@lang('Update')</button>
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
                    <p>@lang('Are you sure? You delete this upload video?')</p>
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

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/resumable.min.js') }}"></script>
@endpush
@push('style')
    <style>
        .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
            height: 200px;
        }
    </style>
@endpush


@push('script')
    {{-- ---------------------- upload video file js code ---------------------- --}}
    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '{{ route('admin.lesson.edit.video.upload') }}',
            query: {
                _token: '{{ csrf_token() }}'
            },
            fileType: ['mp4'],
            chunkSize: 10 * 1024 *
                1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
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
            $('.video-show').removeClass('d-none');
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
            var id = ancor.siblings("video").data('id');
            uploadeVideoDeleteAjax(ancor, srcValue, fileName, id);
        }

        function uploadeVideoDeleteAjax(ancor, srcValue, fileName, id) {
            $.ajax({
                url: "{{ route('admin.lesson.edit.video.upload.delete') }}",
                type: "POST",
                data: {
                    videoUrl: srcValue,
                    fileName: fileName,
                    id: id,
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
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 2500);
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
                selectChange(inputUploadVideo, inputVideoUrl, videoPreview, live_class_inputs)

            });
            selectChange(inputUploadVideo, inputVideoUrl, videoPreview, live_class_inputs)
        });

        function selectChange(inputUploadVideo, inputVideoUrl, videoPreview, live_class_inputs) {

            var selectElements = $('select[name="preview_video"]');
            var selectedOption = $('select[name="preview_video"]').val();

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
                } else {
                    var videoModal = $('#videoModal');
                    var file_name = $('.uploadVideoDelete').siblings("video").data('file-name');
                    videoModal.find('form input[name=fileName]').val(file_name);
                    selectElements.val(1);
                    videoModal.modal('show');
                }
            } else {



                if (videoPreview.attr('src') == '') {
                    inputVideoUrl.parent().parent().addClass('d-none');
                    inputVideoUrl.removeAttr('required');
                    inputUploadVideo.removeAttr('required');
                    inputUploadVideo.closest('.form-group').removeClass('d-none');
                    live_class_inputs.removeClass('d-none');
                } else {
                    live_class_inputs.removeClass('d-none');
                    var videoModal = $('#videoModal');
                    var file_name = $('.uploadVideoDelete').siblings("video").data('file-name');
                    videoModal.find('form input[name=fileName]').val(file_name);

                }
            }
        }

        // ------------------------------------modal show js------------------------------------
        function modalShow() {
            var videoModal = $('#videoModal');
            videoModal.modal('show');
        }
    </script>
@endpush
