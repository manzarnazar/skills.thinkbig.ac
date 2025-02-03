@php
    $worksContentSection = getContent('works.content', true);
    $worksElementSection = getContent('works.element', false, 4);
@endphp

<div class="how-work pt-120">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="thumb-wrap">
                    <img src="{{ getImage(getFilePath('works') . '/' . @$worksContentSection->data_values?->image) }}"
                        alt="image">
                    <div class="popup-video-wrap">
                        <div class="promo-video">
                            <div class="waves-block">
                                <div class="waves wave-1"></div>
                                <div class="waves wave-2"></div>
                                <div class="waves wave-3"></div>
                            </div>
                        </div>
                        <a class="play-video popup_video" data-fancybox=""
                            href="{{ @$worksContentSection->data_values?->link }}" tabindex="0">
                            @php
                                echo (__(@$worksContentSection->data_values?->icon));
                            @endphp
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-content">
                            <div class="title-wrap">
                                <div class="row justify-content-between">
                                    <div class="col-lg-6">
                                        <h1 class="title mb-3 wow animate__ animate__fadeInUp animated"
                                            data-wow-delay="0.2s">
                                            {{ __(@$worksContentSection->data_values?->title) }}</h1>
                                        <p class="subtitle wow animate__ animate__fadeInUp animated"
                                            data-wow-delay="0.3s">
                                            {{ __(@$worksContentSection->data_values?->subheading) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gy-4">
                    @forelse ($worksElementSection ?? [] as $item)
                        <div class="col-lg-6">
                            <div class="how-work-box">
                                <div class="number">
                                    <h6 class="title">{{$loop->iteration}}</h6>
                                </div>
                                <div class="content-wrap">
                                    <h6 class="title">{{@$item->data_values?->title}}</h6>
                                    <p class="sub-title">{{@$item->data_values?->short_des}}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
