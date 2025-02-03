@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row mx-lg-0">
        <div class="col-lg-12">
            <div class="tbl-wrap">
                <div class="col-12 mb-3 d-flex justify-content-end">
                    <form method="GET" autocomplete="off">
                        <div class="search-box">
                            <input type="text" class="form--control" name="search" placeholder="@lang('Search...')"
                                value="{{ request()->search }}">
                            <button type="submit" class="search-box__button"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="title ms-3 mb-4">
            <h4>@lang('Enroll Courses')</h4>
        </div>
        <div class="row gy-4 mx-lg-0 mb-5">
            @forelse ($enrolls as $item)
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6">
                    <div class="base-card">
                        @if (@$item->course->discount)
                            <span class="dis-tag">-{{ @$item->course->discount }}% </span>
                        @endif
                        <div class="view-cta">
                            <a href="{{ route('course.details', [slug($item->course->name), $item->course_id]) }}"
                                class="btn btn--base">@lang('view')</a>
                            @if (@$item->course->quizzes->count() > 0)
                                <a href="{{ route('user.quiz.courseQuiz', $item->course->id) }}"
                                    class="btn btn--base">@lang('Quizzes')</a>
                            @endif
                        </div>
                        <div class="thumb-wrap">
                            <img src="{{ getImage(getFilePath('course_image') . '/' . $item->course->image) }}"
                                alt="...">
                        </div>
                        <div class="content-wrap">
                            <p class="category">{{ __(@$item->course->category->name) }}</p>
                            <a href="{{ route('course.details', [slug($item->course->name), $item->course_id]) }}">
                                <h6 class="title">{{ __(@$item->course->name) }}</h6>
                            </a>
                            <ul class="product-status">
                                <li>
                                    <i class="fa-solid fa-clock"></i>
                                    <p>{{ str_replace('ago', '', diffForHumans(@$item->course->created_at)) }}
                                    </p>
                                </li>
                                <li>
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <p>{{ __(@$item->enrollCount($item->id)) }} @lang('Students')</p>
                                </li>
                            </ul>
                        </div>
                        <div class="carn-btm">
                            <ul class="star-wrap rating-wrap">
                                @php
                                    $averageRatingHtml = calculateAverageRating(@$item->course->average_rating);
                                    if (!empty($averageRatingHtml['ratingHtml'])) {
                                        echo $averageRatingHtml['ratingHtml'];
                                    }
                                @endphp
                                <li>
                                    <p> {{ @$item->course->average_rating ?? 0 }}.0
                                        ({{ @$item->course->review_count ?? 0 }})
                                    </p>
                                </li>
                            </ul>

                            <div class="price-wrap">
                                @if (@$item->course->discount)
                                    <h6 class="price">
                                        {{ @$general->cur_sym }}{{ priceCalculate(@$item->course->price, @$item->course->discount) }}
                                    </h6>
                                @elseif(@$item->course->price == 0.0)
                                    <h6 class="price">@lang('Free')</h6>
                                @else
                                    <h6 class="price">{{ @$item->course->price }}</h6>
                                @endif
                                @if (@$item->course->discount)
                                    <p class="dis-price">
                                        {{ $general->cur_sym }}{{ @$item->course->price }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div>
                    <h5 class="text-muted text-center text--base" colspan="100%">@lang('No data found')</h5>
                </div>
            @endforelse
        </div>
    </div>

    @if ($enrolls->hasPages())
        <div class="card-footer text-end">
            {{ $enrolls->links() }}
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">@lang('Details')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-modal="0"
                        data-bs-dismiss="modal">@lang('No')</button>
                </div>
            </div>
        </div>
    </div>
@endsection
