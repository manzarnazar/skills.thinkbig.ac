@php
    $faqSection = getContent('faq.content', true);
    $faqSectionElements = getContent('faq.element', false, 4);
@endphp


<!-- faq-section -->
<section class="faq-section pt-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-content">
                    <div class="title-wrap">
                        <div class="row">
                            <div class="col-lg-4">
                                <h2 class="title mb-3 wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                                    {{ __(@$faqSection->data_values?->title) }}</h2>
                                <p class="subtitle wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                                    {{ __($faqSection->data_values?->subtitle) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 my-auto">
                <div class="accordion custom--accordion accordion-flush" id="accordionFlushExample">
                    @forelse (@$faqSectionElements ?? [] as $item)
                        <div class="accordion-item wow animate__ animate__fadeInUp animated" data-wow-delay="0.2s">
                            <div class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse{{ $loop->iteration }}" aria-expanded="false"
                                    aria-controls="flush-collapse{{ $loop->iteration }}">
                                    {{ __(@$item->data_values?->question) }}
                                </button>
                            </div>
                            <div id="flush-collapse{{ $loop->iteration }}"
                                class="accordion-collapse collapse {{ $loop->iteration === 1 ? 'show' : '' }}"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @php
                                        echo __(@$item->data_values?->answer);
                                    @endphp
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>

            <div class="col-lg-6 my-auto">
                <div class="faq-right">
                    <div class="thumb-wrap">
                        <img src="{{getImage(getFilePath('faq') . '/' .@$faqSection->data_values?->image_one)}}" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  faq-section -->
