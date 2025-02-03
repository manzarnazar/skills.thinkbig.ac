@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-4">
                    <form action="{{ route('admin.question.store', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <div class="image-upload">
                                            <div class="thumb">
                                                <div class="avatar-preview">
                                                    <div class="profilePicPreview"
                                                        style="background-image: url({{ getImage(getFilePath('quiz_question_image') . '/' . @$question->image) }});">
                                                        <button type="button" class="remove-image"><i
                                                                class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="avatar-edit">
                                                    <input type="file" class="profilePicUpload" name="image"
                                                        id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                        <label for="profilePicUpload1"
                                                        class="btn btn--primary">@lang('Upload')</label>
                                                        <small class="pt-4">@lang('Recommend image size')
                                                            {{ getFileSize('quiz_question_image') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">@lang('Question') </label>
                                            <input class="form-control" type="text" name="question" value=""
                                                placeholder="Enter a Question" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="mb-2">@lang('Mark') </label>
                                            <input class="form-control" type="number" name="mark" value=""
                                                placeholder="Enter a Mark" required>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <div class="form-group">
                                        <div class="text-end">
                                            <button type="button" class="btn btn--primary btn--sm addFile">
                                                <i class="fa fa-plus"></i> @lang('Add New')
                                            </button>
                                        </div>
                                        <div class="row global-card align-items-center">
                                            <div class="col-sm-10 my-3">
                                                <div class="file-upload">
                                                    <label class="form-label">@lang('Options')</label>
                                                    <input type="text" name="options[]" id="inputOptions"
                                                        class="form-control form--control mb-2" required
                                                        placeholder="Options Name" />
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="correct_answer" type="checkbox"
                                                        value="0" id="flexCheckChecked" checked
                                                        onchange="checkedCheckBox(this)">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        @lang('Correct Answer')
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div id="fileUploadsContainer">

                                        </div>
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
                console.log(fileAdded);
                $("#fileUploadsContainer").append(`
                <div class="row elements global-card mt-4 align-items-center">
                    <div class="col-sm-10 my-3">
                        <div class="file-upload input-group">
                            <input type="text" name="options[]" id="inputOptions" class="form-control form--control"
                                placeholder="Options Name" required />  
                                <button class="input-group-text btn--danger remove-btn border-0"><i class="las la-times"></i></button>                                          
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="${fileAdded}"
                                id="flexCheckChecked" name="correct_answer" onchange="checkedCheckBox(this)">
                            <label class="form-check-label" for="flexCheckChecked">
                                @lang('Correct Answer')
                            </label>
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

    <script>
        function checkedCheckBox(object) {
            $('input[type="checkbox"]').not(object).prop('checked', false);
        }
    </script>
@endpush
