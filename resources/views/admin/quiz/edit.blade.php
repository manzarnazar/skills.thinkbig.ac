@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-4">
                    <form action="{{ route('admin.quiz.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
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
                                                        style="background-image: url({{ getImage(getFilePath('quiz_image') . '/' . @$quiz->image) }});">
                                                        <button type="button" class="remove-image"><i
                                                                class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="avatar-edit">
                                                    <input type="file" class="profilePicUpload" name="image"
                                                        id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                    <small class="pt-4 text-danger mb-4">@lang('image size')
                                                        {{ getFileSize('quiz_image') }}</small>
                                                    <label for="profilePicUpload1"
                                                        class="btn btn--primary">@lang('Upload')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">@lang('Name') </label>
                                            <input class="form-control" type="text" name="name" value="{{ $quiz->name ??old('name') }}"
                                                placeholder="Enter a Name" required>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-2">@lang('Course Name') </label>
                                                <select class="form--control form-select" name="course_id" id="course_id"
                                                    required>
                                                    <option value="0">@lang('Select One')</option>
                                                    @foreach ($courses as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == @$quiz->course_id ? 'selected' : '' }}>
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
                                        <label class="mb-2">@lang('Time') <span>(@lang('Minutes'))</span></label>
                                        <input class="form-control" type="number" name="time" value="{{@$quiz->time ?? old('time')}}"
                                            placeholder="Quiz Time" min="0" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label class="mb-2">@lang('Pass Mark') </label>
                                        <input class="form-control" type="number" name="pass_mark" value="{{@$quiz->pass_mark ?? old('pass_mark')}}"
                                            placeholder="Pass Mark" min="0">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label class="mb-2">@lang('Total Qusetion') </label>
                                        <input class="form-control" type="number" name="total_question" value="{{@$quiz->total_question ?? old('total_question')}}"
                                            placeholder="How many Qusetion Included" min="0">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2">@lang('Active Quiz')</label>
                                        <select class="form--control form-select" name="active_quiz" id="active_quiz"
                                            required>
                                            <option value="">@lang('Select One')</option>
                                            <option value="1" {{ @$quiz->active_quiz == 1 ? 'selected' : '' }}>@lang('Active')</option>
                                            <option value="0" {{ @$quiz->active_quiz == 0 ? 'selected' : '' }}>@lang('Pending')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2">@lang('Description')</label>
                                        <textarea class="form-control trumEdit" name="description">@php echo __($quiz->description) @endphp</textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn--primary btn-global" id="btn-save"
                                value="add">@lang('Update')</button>
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

