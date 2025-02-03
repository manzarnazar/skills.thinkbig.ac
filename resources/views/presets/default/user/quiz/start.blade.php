@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="mx-lg-0">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center align-items-center">
                        <h6 id="headline">@lang('Time Remaining :')</h6>
                    </div>
                </div>
            </div>
            
            <div class="tbl-wrap">
                <div class="row gy-4 mx-lg-0 mb-5">
                    @forelse ($questions as $item)
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                            <div class="base-card">
                                <div class="thumb-wrap">
                                    <img src="{{ getImage(getFilePath('quiz_question_image') . '/' . $item->image) }}"
                                        alt="...">
                                </div>
                                <div class="content-wrap">
                                    <p class="category">{{ __(@$item->question) }}</p>
                                    @foreach ($item->options ?? [] as $index => $option)
                                        <div class="col-sm-8 my-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $index }}"
                                                    id="flexCheckChecked" name="answer[]" data-quiz_id={{ $quiz->id }}
                                                    data-question_id={{ $item->id }} onchange="checkedCheckBox(this)">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    {{ $option }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                    @empty
                        <div>
                            <h5 class="text-muted text-center text--base" colspan="100%">@lang('No data found')</h5>
                        </div>
                    @endforelse
                    <div class="text-end">
                        <a href="{{route('user.quiz.status',$existQuizStatus->id)}}" class="btn btn--base">@lang('Submit')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('style')
    <style>
        #countdown ul li {
            display: inline-block;
            font-size: 1.5em;
            list-style-type: none;
            padding: 1em;
            text-transform: uppercase;
        }

        #countdown ul li span {
            display: block;
            font-size: 4.5rem;
        }
    </style>
@endpush

@push('script')
    <script>
        function checkedCheckBox(object) {
            var isChecked = $(object).prop('checked');
            if (!isChecked) {
                return; // Exit if the checkbox is already unchecked
            }
            // Uncheck other checkboxes within the same parent container
            $(object).closest('.base-card').find('input[type="checkbox"]').not(object).prop('checked', false);

            submitAnswer(object);
        }
    </script>

    <script>
        $(document).ready(function() {
            "use strict";
            var end;
            var now = moment();

            // Check if expiry time is stored in local storage
            var storedEndTime = localStorage.getItem("{{ $quiz->id }}");
            if (storedEndTime) {
                end = moment(storedEndTime);
            } else {
                end = moment().add("{{ $quiz->time }}", 'minute');
                // Store the expiry time in local storage
                localStorage.setItem("{{ $quiz->id }}", end);
            }

            function updateExpiredIn() {
                var duration = moment.duration(end.diff(now));
                if (duration.asMilliseconds() <= 0) {
                    clearInterval(intervalID); // Stop setInterval
                    $('#headline').text("Time's up!"); // Optionally, you can display a message when the time is up
                    localStorage.removeItem("{{ $quiz->id }}");
                    window.location.href = "{{route('user.quiz.status',$existQuizStatus->id)}}";
                    return;
                }
                var days = Math.floor(duration.asDays());
                var hours = Math.floor(duration.asHours()) - days * 24;
                var minutes = Math.floor(duration.asMinutes()) - days * 24 * 60 - hours * 60;
                var seconds = Math.floor(duration.asSeconds()) - days * 24 * 60 * 60 - hours * 60 * 60 - minutes *
                    60;
                var expiredIn = days + ' days ' + hours + ' hours ' + minutes + ' minutes ' + seconds + ' seconds';
                $('#headline').text(expiredIn);
            }

            // update the expired time every second
            var intervalID = setInterval(function() {
                now = moment();
                updateExpiredIn();
            }, 1000);

            // initial update
            updateExpiredIn();
        });
    </script>

    <script>
        function submitAnswer(object) {
            let quiz_id = $(object).data('quiz_id');
            let question_id = $(object).data('question_id');
            let user_answer = parseInt($(object).val());

            $.ajax({
                type: "post",
                url: "{{ route('user.quiz.answer') }}",
                data: {
                    quiz_id: quiz_id,
                    question_id: question_id,
                    user_answer: user_answer,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data == 'success') {
                        notify('success', 'Import Data Successfully');
                        window.location.href = "{{ url()->current() }}"
                    }
                }
            });

        }
    </script>
@endpush
