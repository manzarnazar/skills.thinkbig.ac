@php
    $testimonialSection = getContent('testimonial.content', true);
    $testimonialElementSection = getContent('testimonial.element', false, 3);
@endphp
<section class="testimonial-section pt-120">
    <div class="testimonial-wrap">
        <span class="bg-elemet1">
            <img src="{{ getImage(getFilePath('testimonial') . '/' . @$testimonialSection->data_values?->shape_image_one) }}"
                alt="image">
        </span>
        <span class="bg-elemet2">
            <img src="{{ getImage(getFilePath('testimonial') . '/' . @$testimonialSection->data_values?->shape_image_two) }}"
                alt="image">
        </span>
        <span class="bg-elemet3">
            <img src="{{ getImage(getFilePath('testimonial') . '/' . @$testimonialSection->data_values?->shape_image_three) }}"
                alt="image">
        </span>

        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-9">
                    <div class="row testimonial-slider">
                        @forelse ($testimonialElementSection ?? [] as $item)
                            <div class="testimonial-card">
                                <div class="icon-thumb">
                                    <img src="{{asset('assets/images/frontend/testimonial/testemonial-icon.png')}}"
                                        alt="image">
                                </div>
                                <div class="content-wrap">
                                    <h6 class="title">{{ __(@$item->data_values?->title) }}</h6>
                                </div>
                                <div class="user-thumb">
                                    <img src="{{ getImage(getFilePath('testimonial') . '/' . @$item->data_values?->image_one) }}"
                                        alt="image">
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





