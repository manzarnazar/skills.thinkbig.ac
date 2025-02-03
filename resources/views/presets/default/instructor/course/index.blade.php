@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
    <div class="row mx-lg-0">
        <div class="col-lg-12">
            <div class="tbl-wrap">
                <div class="col-12 d-lg-flex justify-content-between align-items-center mb-3">
                    <div>
                        <a class="btn btn--base create_course_category" href="{{ route('instructor.course.create') }}"><i
                                class="fa-solid fa-plus"></i>
                            @lang('Add New')
                        </a>
                    </div>
                    <div>
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
    </div>

    <div>
        <div class="title ms-3 mb-4">
            <h4>@lang('My Courses')</h4>
        </div>
        <div class="row gy-4 mx-lg-0 mb-5">
            @forelse ($courses as $item)
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6">
                    <div class="base-card">
                        @if ($item->admin_status == 1)
                            <span class="dis-tag">@lang('Approved')</span>
                        @else
                            <span class="dis-tag">@lang('Pending')</span>
                        @endif
                   
                        <div class="view-cta">
                            {{-- <a class="btn btn--base btn--sm" href="{{ route('instructor.lesson.create') }}"
                                title="@lang('Course list')"><i class="fa-solid fa-plus"></i></a></span> --}}

                            <a class="btn btn--base btn--sm text-white" href="{{ route('instructor.course.edit', $item->id) }}"
                                title="@lang('Edit')"><i class="fa-solid fa-pen"></i></a></span>
                            <a class="btn btn--base btn--sm" href="{{ route('instructor.lesson.lessons', $item->id) }}"
                                title="@lang('Course list')"><i class="fa-solid fa-list-ul"></i></a></span>

                        </div>
                        <div class="thumb-wrap">
                            <img src="{{ getImage(getFilePath('course_image') . '/' . $item->image) }}" alt="...">
                        </div>
                        <div class="content-wrap">
                            <div class="d-flex justify-content-between">
                                <p class="category">{{ __(@$item->category->name) }}</p>
                                <a class="btn btn--sm" href="{{ route('instructor.lesson.lessons', $item->id) }}"
                                    title="@lang('Course list')">@lang('view')</a>
                            </div>
                            <a href="{{ route('course.details', [slug($item->name), $item->id]) }}">
                                <h6 class="title">{{ __(@$item->name) }}</h6>
                            </a>
                            <ul class="product-status">
                                <li>
                                    <i class="fa-solid fa-clock"></i>
                                    <p>{{ str_replace('ago', '', diffForHumans(@$item->created_at)) }}</p>
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
        <div class="card-footer text-end">
            {{ $courses->links() }}
        </div>
    @endif
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
