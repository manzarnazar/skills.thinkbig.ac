<div class="tab-content">
    <div class="tab-pane fade active show">
        <div class="row justify-content-center gy-4">
            @forelse ($courses ?? [] as $item)
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6">
                    <div class="base-card">
                        @if (@$item->discount > 0)
                            <span class="dis-tag">-{{ @$item->discount}}%</span>
                        @endif
                        <div class="thumb-wrap">
                            <img src="{{ getImage(getFilePath('course_image') . '/' . $item->image) }}"
                                alt="course-image">
                        </div>
                        <div class="content-wrap">
                            <p class="category">{{ @$item->category?->name }}</p>
                            <a href="{{ route('course.details', [slug($item->name), $item->id]) }}">
                                <h6 class="title">{{ strLimit(@$item->name, 23) }}</h6>
                            </a>
                            <ul class="product-status">
                                <li>
                                    <i class="fa-solid fa-clock"></i>
                                    <p>{{ str_replace('ago', '', diffForHumans(@$item->created_at)) }}
                                    </p>
                                </li>
                                <li>
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <p>{{ $item->enrolls->count() }} @lang('Students')</p>
                                </li>
                            </ul>
                        </div>
                        <div class="carn-btm">
                            <ul class="star-wrap rating-wrap">
                                @php
                                    $averageRatingHtml = calculateAverageRating($item->average_rating);
                                    if (!empty($averageRatingHtml['ratingHtml'])) {
                                        echo $averageRatingHtml['ratingHtml'];
                                    }
                                    // echo showRatings($item->average_rating) 
                                @endphp

                                <li>
                                    <p> {{ @$item->average_rating ?? 0 }}.0 ({{ @$item->review_count ?? 0 }})</p>
                                </li>

                            </ul>
                            <div class="price-wrap">
                                @if (@$item->discount)
                                    <h6 class="price">
                                        {{ @$general->cur_sym }}{{ priceCalculate(@$item->price, @$item->discount) }}
                                    </h6>
                                    <p class="dis-price">{{ @$general->cur_sym }}{{ @$item->price }}</p>
                                @elseif(@$item->price == 0.0)
                                    <h6 class="price">@lang('Free')</h6>
                                @else
                                    <h6 class="price">{{ @$general->cur_sym }}{{ @$item->price }}</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h5 class="text-center">@lang('No Course found')</h5>
            @endforelse
        </div>
    </div>
</div>
