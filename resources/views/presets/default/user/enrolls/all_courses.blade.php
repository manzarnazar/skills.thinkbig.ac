@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row mx-lg-0">
        <div class="col-lg-12">
            <div class="tbl-wrap">
                <div class="col-12 d-lg-flex justify-content-end align-items-center mb-3">
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
            <h4>@lang('All Courses')</h4>
        </div>
        <div class="row gy-4 mx-lg-0 mb-5">
            @forelse ($courses as $item)
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6">
                    <div class="base-card">
                        @if (@$item->discount)
                            <span class="dis-tag">-{{ @$item->discount }}% </span>
                        @endif

                        <div class="thumb-wrap">
                            <img src="{{ getImage(getFilePath('course_image') . '/' . $item->image) }}" alt="...">
                        </div>
                        <div class="content-wrap">
                            <p class="category">{{ __(@$item->category->name) }}</p>
                            <a href="{{ route('course.details', [slug($item->name), $item->id]) }}">
                                <h6 class="title">{{ __(@$item->name) }}</h6>
                            </a>
                            <ul class="product-status">
                                <li>
                                    <i class="fa-solid fa-clock"></i>
                                    <p>{{ str_replace('ago', '', diffForHumans(@$item->created_at)) }}
                                    </p>
                                </li>
                                <li>
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <p>{{ __(@$item->enrolls->count()) }} @lang('Students')</p>
                                </li>
                            </ul>
                        </div>
                        <div class="carn-btm">
                            <ul class="star-wrap rating-wrap">
                                @php
                                    $averageRatingHtml = calculateAverageRating(@$item->average_rating);
                                    if (!empty($averageRatingHtml['ratingHtml'])) {
                                        echo $averageRatingHtml['ratingHtml'];
                                    }
                                @endphp

                                <li>
                                    <p> {{ @$item->average_rating ?? 0 }}.0
                                        ({{ @$item->review_count ?? 0 }})
                                    </p>
                                </li>
                            </ul>

                            <div class="price-wrap">
                                @if (@$item->discount)
                                    <h6 class="price">
                                        {{ @$general->cur_sym }}{{ priceCalculate(@$item->price, @$item->discount) }}
                                    </h6>
                                @elseif(@$item->price == 0.0)
                                    <h6 class="price">@lang('Free')</h6>
                                @else
                                    <h6 class="price">{{ @$item->price }}</h6>
                                @endif


                                @if (@$item->discount)
                                    <p class="dis-price">
                                        {{ @$general->cur_sym }}{{ @$item->price }}
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
    @if ($courses->hasPages())
        <div class="card-footer text-end mb-4">
            {{ $courses->links() }}
        </div>
    @endif
@endsection
