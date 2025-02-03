@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="profile-wrap ms-3">
        <div class="row justify-content-center">
            <div class="col-12 justify-content-center">
                <div class="base--card">
                    <div class="course-card">
                        <div class="card mb-3">
                           
                            <div class="col-md-12 d-flex justify-content-between">
                                <div class="thumb">
                                    <img src="{{ getImage(getFilePath('quiz_image') . '/' . @$quiz->image, getFileSize('quiz_image')) }}"
                                        class="img-fluid" alt="image">
                                </div>
                                <div class="time">
                                    <h5>@lang('Time') {{ __(getDurationForHumans(@$quiz->time)) }}
                                        @lang('Minute')</h5>
                                    <h5>@lang('Pass Mark') {{ @$quiz->pass_mark }} </h5>
                                    <h5>@lang('Course Name') {{ @$quiz->course->name }} </h5>
                                    <h5>@lang('Active Quiz'):
                                        @if (@$quiz->active_quiz == 1)
                                            @lang('Active')
                                        @else
                                            @lang('Closed')
                                        @endif

                                    </h5>
                                </div>
                            </div>

                            <div class="col-md-8 mt-md-0 my-lg-auto mt-4 my-auto">
                                <div class="content">
                                    <div>
                                        <h5 class="mt-3">{{ __(@$quiz->name) }}</h5>
                                        <div class="wyg">@php echo __(@$quiz->description) @endphp</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="javascript:void(0)" onclick="videoModal(this)" data-url="{{ route('user.quiz.start', @$quiz->id)}}" class="btn btn--base">@lang('Start')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">@lang('Confirmation Alert')</h5>
                    <button type="button" class="btn-close btn " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="GET" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>@lang('Are you sure? You want to start this Quiz?')</p>
                        <input type="text" hidden name="fileName" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--base" data-bs-dismiss="modal"
                            data-modal="1">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .course-card {
            overflow: hidden;
        }

        .course-card .card {
            padding: 15px;
        }

        .course-card .card .content {
            padding-left: 12px;
        }

        .course-card .thumb img {
            height: 300px;
            border-radius: 10px;

        }

        .wyg h1,
        h2,
        h3,
        h4 {
            color: #383838;
        }

        .wyg strong {
            color: #383838
        }

        .wyg p {
            color: #666666
        }

        .wyg ul {
            margin-left: 40px
        }

        .wyg ul li {
            list-style-type: disc;
            color: #666666
        }
    </style>
@endpush

@push('script')
    <script>
        function videoModal(object) {
            var videoModal = $('#videoModal');
            var url = $(object).data('url');
            videoModal.find('form').attr('action', url);
            videoModal.modal('show');
        }
    </script>
@endpush
