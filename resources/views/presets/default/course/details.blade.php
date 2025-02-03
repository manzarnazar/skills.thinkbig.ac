@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <!-- product details section -->
    <section class="product-info">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="info-wrap">
                        <div class="product-tag">
                            <p class="tag-name">{{ @$course->category?->name }}</p>
                        </div>
                        <h1 class="title">{{ @$course->name }}</h1>
                        <ul class="rating-wrap">
                            @php
                                $averageRatingHtml = calculateAverageRating($course->average_rating);
                                if (!empty($averageRatingHtml['ratingHtml'])) {
                                    echo $averageRatingHtml['ratingHtml'];
                                }
                            @endphp
                            <li>
                                <p> ({{ $course->review_count }} @lang('ratings')) {{ $course->enrolls->count() }}
                                    @lang('Students')</p>
                            </li>
                        </ul>
                        <ul class="key-wrap">
                            <li>
                                <i class="fa-solid fa-clock"></i>
                                <p>{{ str_replace('ago', '', diffForHumans(@$course->created_at)) }}</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-graduation-cap"></i>
                                <p>{{ $course->enrolls->count() }} @lang('Students')</p>
                            </li>

                            <li>
                                <i class="fa-solid fa-file-video"></i>
                                <p>{{ @$course->lessons->count() }} @lang('Lessons')</p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- product details section -->
    <!-- < product details  -->
    <section class="product-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="key learn">
                        <h1 class="title">@lang("What you'll learn")</h1>
                        <div class="discription">
                            @php
                                echo __($course->learn_description);
                            @endphp
                        </div>
                    </div>
                    <div class="key curriculum">
                        <h1 class="title">@lang('Curriculum')</h1>
                        <div class="discription">
                            @php
                                echo __($course->curriculum);
                            @endphp
                        </div>

                        @if ($course->lessons->count() > 0)
                            <div class="curriculam-list">
                                <ul class="list-group">
                                    @foreach ($course->lessons as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            onclick="lessonPreview(this, {{ @$course->id }}, {{ $item->id }})">
                                            <div class="d-flex align-items-center">
                                                <i class="fa-regular fa-circle-play pre-i me-2"></i>
                                                <span>{{ __($item->title) }}</span>
                                            </div>
                                            @if ($item->value == 0)
                                                <p class="mb-0">@lang('Free') <i class="fa-solid fa-lock-open"></i>
                                                </p>
                                            @else
                                                <p class="mb-0">@lang('Premium') <i class="fa-solid fa-lock"></i></p>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="key requirements">
                        <h1 class="title">@lang('Descriptions')</h1>
                        <div class="discription wyg">
                            @php
                                echo __($course->description);
                            @endphp
                        </div>
                    </div>
                    @if ($course->quizzes->count() > 0)
                        <div class="mb-4">
                            <a href="{{ route('user.quiz.courseQuiz', $course->id) }}"
                                class="btn btn--base">@lang('Quizzes')</a>
                        </div>
                    @endif
                    <div class="key rating mb-0">
                      
                            <h1 class="title mb-4"><i class="fa-solid fa-star"></i>({{ $course->average_rating }})
                                @lang('Write a review')</h1>
                      
                        <div class="row">
                            @forelse ($reviews as $item)
                                <div class="col-12">
                                    <div class="review-card">
                                        <div class="user-info">
                                            <div class="thumb-wrap">
                                                <img src="{{ getImage(getFilePath('userProfile') . '/' . @$item->user?->image, getFileSize('userProfile')) }}"
                                                    alt="user_image">
                                            </div>
                                            <div class="user-name">
                                                <h1 class="name">{{ @$item->user?->fullname }}</h1>
                                                <div class="d-lg-flex d-md-flex d-block">
                                                    <ul class="rating-list rating-wrap">
                                                        @php
                                                            $averageRatingHtml = calculateIndividualRating(
                                                                $item->rating,
                                                            );
                                                            if (!empty($averageRatingHtml['ratingHtml'])) {
                                                                echo $averageRatingHtml['ratingHtml'];
                                                            }
                                                        @endphp
                                                        <li>
                                                            <p>({{ __($item->rating) }}.0)</p>
                                                        </li>
                                                    </ul>
                                                    <p class="mx-md-2 mt-lg-0 mt-md-0 mt-2">
                                                        {{ diffForHumans($item->created_at) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <p class="discription">{!! @$item->message !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h5 class="text-center no-review">@lang('No Reviews')</h5>
                            @endforelse
                            <div class="row gy-4">
                                @if ($reviews->hasPages())
                                    <div class="py-4">
                                        {{ paginateLinks($reviews) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    {{-- -----------------------------reviews----------------------------- --}}
                    <div class="review-box">
                        <form action="{{ route('user.reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="rating" id="rating" value="0">
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <div class="d-flex">
                                <div>
                                    <h5 class="title-three"> @lang('Giving Rating'):</h5>
                                </div>
                                <div class="rating-wrap rating-stars ps-2">
                                    <div>
                                        <i class="far fa-star" data-rating="1"></i>
                                        <i class="far fa-star" data-rating="2"></i>
                                        <i class="far fa-star" data-rating="3"></i>
                                        <i class="far fa-star" data-rating="4"></i>
                                        <i class="far fa-star" data-rating="5"></i>
                                    </div>
                                </div>
                            </div>

                            <textarea class="form--control" name="message" placeholder="@lang('Write Your Review')" id="message"></textarea>

                            <div class="col-sm-12 mt-4">
                                <button type="submit" class="btn btn--base button w-100">@lang('Submit Review')</button>
                            </div>
                        </form>
                    </div>
                    {{-- -----------------------------reviews end----------------------------- --}}
                    

                </div>
                <div class="col-lg-3">
                    <div class="details-wrap">
                        <div class="details-card1">
                            <div class="thumb-wrap">
                                <img src="{{ getImage(getFilePath('course_image') . '/' . $course->image) }}"
                                    alt="@lang('course image')">
                            </div>

                            <div class="content-wrap">
                                @if (auth()->user() && $course->checkedPurchase())
                                    <span class="purchase-action">@lang('Already Purchased')</span>
                                @else
                                    <a href="{{ route('user.enroll.enroll', $course->id) }}"
                                        class="btn btn--base-3">@lang('Enroll Now')
                                        {{ $general->cur_sym . $course->price }} <i
                                            class="fa-solid fa-angles-right"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="details-card2 mt-5">
                            <h1 class="title">@lang('This Course Includes')</h1>
                            <ul class="key-wrap">
                                @foreach ($course->course_outline as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        <p>{{ $item }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="ad-card mt-5">
                            <a href="{{ $ad->link }}">
                                <img src="{{ getImage(getFilePath('ads') . '/' . $ad->image) }}" alt="ads">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- ------------------------------------------- Modal ------------------------------------------- --}}
        <div class="modal fade modal-lg designModal" id="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body coustom-modal-body custom-video-preview">
                        <div class="modal-btn-wrap d-flex justify-content-end">
                            <button data-bs-dismiss="modal" aria-label="Close" onclick="modalClose()"><i
                                    class="fa-solid fa-xmark "></i></button>
                        </div>
                        <video id="player" playsinline controls data-poster="">
                            <source src="#" type="video/mp4">
                            <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en"
                                default />
                        </video>
                    </div>
                </div>
            </div>
        </div>

        {{-- ------------------------------------------- video url Modal ------------------------------------------- --}}
        <div class="modal fade modal-lg designModal" id="videoUrlModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-end py-1">
                        <div class="modal-btn-wrap">
                            <button data-bs-dismiss="modal" aria-label="Close" onclick="videoUrlModalClose()"><i
                                    class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>

                    <div class="modal-body coustom-modal-body custom-video-preview">

                    </div>
                </div>
            </div>
        </div>

        {{-- ------------------------------------------- Meeting Modal ------------------------------------------- --}}
        <div class="modal fade modal-lg designModal" id="meetingModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title">@lang('Meeting Info')</h5>
                        <div class="modal-btn-wrap">
                            <button data-bs-dismiss="modal" aria-label="Close" onclick="mettingModalClose()"><i
                                    class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>

                    <div class="modal-body coustom-modal-body custom-video-preview mb-2">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product details  /> -->
@endsection


@push('style')
    <style>
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

        .rating-comment-item .bottom ul {
            color: #ffc107;
        }

        .rating-wrap div {
            color: #ffc107;
        }
    </style>



    <style>
        /* Modal styles */
        .designModal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 9999;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Modal content */
        .designModal .modal-content {
            width: 100%;
        }

        /* Close button */
        .designModal .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .designModal .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endpush

@push('script')
    <script>
        function lessonPreview(object, course_id, id) {

            var modal = $('#exampleModal');
            var video = modal.find('video');
            var source = video.find('source');
            var poster = modal.find('.plyr__poster');
            var videoDataAttr = modal.find('video').data('poster');
            var uploadPath = "{{ asset(getFilePath('videoUpload')) }}";

            $.ajax({
                url: "{{ route('lesson.preview') }}",
                type: "POST",
                data: {
                    id: id,
                    course_id: course_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == 'success' && response.code == 1) {
                        if (response.data.upload_video != null) {
                            $('.custom-video-preview').removeClass('d-none');
                            $('.custom-video-link').addClass('d-none');
                            source.attr('src', uploadPath + '/videoUpload/' + response.data.upload_video);
                            modal.find('video').attr('data-poster', response.image);
                            poster.css('background-image', `url(${response.image})`);
                            video[0].load();
                            modal.show();
                        } else if (response.data.preview_video == 3 && response.data.upload_video == null) {
                            let meetingModal = $('#meetingModal');
                            const dateString = response.data.zoom_data.data.start_time;
                            const date = new Date(dateString);

                            // Define options for formatting
                            const options = {
                                year: "numeric",
                                month: "2-digit",
                                day: "2-digit",
                                hour: "2-digit",
                                minute: "2-digit",
                                second: "2-digit",
                                hour12: true
                            };

                            // Format the date using Intl.DateTimeFormat
                            const formattedDate = new Intl.DateTimeFormat("en-US", options).format(date);


                            meetingModal.find('.modal-body').html(`
                            <div class="modal-body coustom-modal-body custom-video-preview mb-2">
                                <div class="d-flex justify-content-between px-4 py-2">
                                    <p>@lang('Topic')</p>
                                    <p>${response.data.zoom_data.data.topic}</p>
                                </div>
                                <div class="d-flex justify-content-between px-4 py-2">
                                    <p>@lang('Agenda')</p>
                                    <p>${response.data.zoom_data.data.agenda}</p>
                                </div>
                                <div class="d-flex justify-content-between px-4 py-2">
                                    <p>@lang('Duration')</p>
                                    <p>${response.data.zoom_data.data.duration} min</p>
                                </div>
                                <div class="d-flex justify-content-between px-4 py-2">
                                    <p>@lang('Meeting id')</p>
                                    <p>${response.data.zoom_data.data.id}</p>
                                </div>
                                <div class="d-flex justify-content-between px-4 py-2">
                                    <p>@lang('Password')</p>
                                    <p>${response.data.zoom_data.data.password}</p>
                                </div>
                                <div class="d-flex justify-content-between px-4 py-2">
                                    <p>@lang('Date')</p>
                                    <p>${formattedDate}</p>
                                </div>
                                <div class="d-flex justify-content-between px-4 py-2">
                                    <p>@lang('Meeting Url')</p>
                                    <a href="${response.data.zoom_data.data.start_url}"><u>Click Here</u></a>
                                    
                                </div>
                            </div>
                        `);
                            meetingModal.show();
                        } else {
                            let videoUrlModal = $('#videoUrlModal');
                            videoUrlModal.find('.modal-body').html(`
                                <div class="ratio ratio-21x9">
                                    <iframe src="${response.data.video_url}" title="YouTube video" allowfullscreen></iframe>
                                </div>
                            `);
                            videoUrlModal.show();
                        }
                    }
                    if (response.status == 'error' && response.code == 0) {
                        Toast.fire({
                            icon: response.status,
                            title: response.message
                        });
                    }
                }
            });
        }

        function modalClose() {
            var modal = $('#exampleModal');
            modal.hide();
        }

        function mettingModalClose() {
            var modal = $('#meetingModal');
            modal.hide();
        }

        function videoUrlModalClose() {
            var modal = $('#videoUrlModal');
            modal.hide();
        }
        // rating set
        $(document).ready(function() {
            'use strict'
            $('.rating-stars i').on('click', function() {
                var rating = parseInt($(this).data('rating'));
                $('#rating').val(rating);
                updateStars(rating);
            });
            $('#rating').on('input', function() {
                var rating = $(this).val();
                updateStars(rating);
            });

            function updateStars(rating) {
                var stars = $('.rating-stars i');
                stars.removeClass('fas').addClass('far');
                stars.each(function(index) {
                    if (index < rating) {
                        $(this).removeClass('far').addClass('fas');
                    }
                });
            }
        });
        // end rating set
    </script>

    <script>
        $('.show-more').on('click', function() {
            $('.accordion-item').removeClass('d-none');
            $('.accordion-item').css('visibility', 'visible');
            $('.accordion-item').css('animation-name', 'fadeInUp');
            $(this).remove();
        })
    </script>
@endpush
