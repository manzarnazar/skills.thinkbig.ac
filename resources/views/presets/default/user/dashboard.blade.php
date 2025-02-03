@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="mx-3 mb-4">
        <div class="dash-box">
            <div class="row">
                <div class="col-lg-6 my-auto">
                    <h2 class="mb-0">@lang('Welcome Back')<span>
                            {{ auth()->user()->fullname ?? auth('instructor')->user()->username }}</span></h2>
                </div>
                <div class="col-lg-6 dash-thumb-top  mt-4 mt-lg-0 mt-md-0">
                    <img class="img-fluid d-flex ms-auto" src="{{ asset('assets/images/instructor/profile/dashboard.png') }}"
                        alt="images">
                </div>
            </div>
        </div>
    </div>
    <div class="row gy-4 mx-lg-0">
        <div class="col-xxl-3 col-xl-4 col-lg-6 col-sm-6">
            <a class="d-block" href="{{ route('user.deposit.history') }}">
                <div class="dashboard-card">
                    <div class="card-shape">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill-opacity="1"
                                d="M0,32L30,69.3C60,107,120,181,180,186.7C240,192,300,128,360,138.7C420,149,480,235,540,229.3C600,224,660,128,720,101.3C780,75,840,117,900,138.7C960,160,1020,160,1080,176C1140,192,1200,224,1260,240C1320,256,1380,256,1410,256L1440,256L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
                            </path>
                        </svg>
                    </div>
                    <div class="dashboard-card__content">
                        <h5 class="dashboard-card__amount">{{ $deposit->approved()->count() }}</h5>
                        <h5 class="dashboard-card__title">@lang('Approved Payments')</h5>
                    </div>
                    <div class="dashboard-card__icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-xxl-3 col-xl-4 col-lg-6 col-sm-6">
            <a class="d-block" href="{{ route('user.enroll.courses') }}">
                <div class="dashboard-card">
                    <div class="card-shape">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill-opacity="1"
                                d="M0,32L30,69.3C60,107,120,181,180,186.7C240,192,300,128,360,138.7C420,149,480,235,540,229.3C600,224,660,128,720,101.3C780,75,840,117,900,138.7C960,160,1020,160,1080,176C1140,192,1200,224,1260,240C1320,256,1380,256,1410,256L1440,256L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
                            </path>
                        </svg>
                    </div>
                    <div class="dashboard-card__content">
                        <h5 class="dashboard-card__amount">{{ @$enroll->pending()->count() }}</h5>
                        <h5 class="dashboard-card__title">@lang('Enroll Course')</h5>
                    </div>
                    <div class="dashboard-card__icon">
                        <i class="fa-solid fa-book-journal-whills"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-xl-4 col-lg-6 col-sm-6">
            <a class="d-block" href="{{ route('user.enroll.courses') }}">
                <div class="dashboard-card">
                    <div class="card-shape">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill-opacity="1"
                                d="M0,32L30,69.3C60,107,120,181,180,186.7C240,192,300,128,360,138.7C420,149,480,235,540,229.3C600,224,660,128,720,101.3C780,75,840,117,900,138.7C960,160,1020,160,1080,176C1140,192,1200,224,1260,240C1320,256,1380,256,1410,256L1440,256L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
                            </path>
                        </svg>
                    </div>
                    <div class="dashboard-card__content">
                        <h5 class="dashboard-card__amount">{{ @$enroll->approved()->count() }}</h5>
                        <h5 class="dashboard-card__title">@lang('Purchase Course')</h5>
                    </div>
                    <div class="dashboard-card__icon">

                        <i class="fa-solid fa-book-open"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-xl-4 col-lg-6 col-sm-6">
            <a class="d-block" href="{{ route('ticket.open') }}">
                <div class="dashboard-card">
                    <div class="card-shape">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill-opacity="1"
                                d="M0,32L30,69.3C60,107,120,181,180,186.7C240,192,300,128,360,138.7C420,149,480,235,540,229.3C600,224,660,128,720,101.3C780,75,840,117,900,138.7C960,160,1020,160,1080,176C1140,192,1200,224,1260,240C1320,256,1380,256,1410,256L1440,256L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
                            </path>
                        </svg>
                    </div>
                    <div class="dashboard-card__content">
                        <h5 class="dashboard-card__amount">{{ $ticket->open()->count() }}</h5>
                        <h5 class="dashboard-card__title">@lang('Open Ticket')</h5>
                    </div>
                    <div class="dashboard-card__icon">
                        <i class="fa-solid fa-comment-dots"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="chart mb-4">
            <div class="chart-bg">
                <div id="chart"></div>
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
                                    <p>{{ str_replace('ago', '', diffForHumans(@$item->course->created_at)) }}</p>
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
                                        {{ @$general->cur_sym }}{{ @$item->course->price }}
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


    <!-- pagination -->
    @if ($enrolls->hasPages())
        <div class="card-footer text-end">
            {{ $enrolls->links() }}
        </div>
    @endif
    <!-- / pagination -->
@endsection

@push('script')
    <script>
        "use strict";
        // [ account-chart ] start
        (function() {
            var options = {
                chart: {
                    type: 'bar',
                    stacked: false,
                    height: '310px'
                },
                stroke: {
                    width: [0, 3],
                    curve: 'smooth'
                },
                colors: ['#00adad', '#67BAA7'],
                plotOptions: {
                    bar: {
                        columnWidth: '50%'
                    }
                },
                colors: ['#ff99007a', '#E91E63'],
                series: [{
                    name: '@lang('Enrolls')',
                    type: 'column',
                    data: @json($enrollChart['values'])
                }, {
                    name: '@lang('Payments')',
                    type: 'area',
                    data: @json($depositChart['values'])
                }],
                fill: {
                    opacity: [0.85, 1],
                },
                labels: @json($enrollChart['labels']),
                markers: {
                    size: 0
                },
                xaxis: {
                    type: 'text'
                },
                yaxis: {
                    min: 0
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0);
                            }
                            return y;

                        }
                    }
                },
                legend: {
                    labels: {
                        useSeriesColors: true
                    },
                    markers: {
                        customHTML: [
                            function() {
                                return ''
                            },
                            function() {
                                return ''
                            }
                        ]
                    }
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#chart"),
                options
            );
            chart.render();
        })();
    </script>
@endpush
