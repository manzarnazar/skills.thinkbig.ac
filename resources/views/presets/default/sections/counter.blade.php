@php
    $counterSectionElement = getContent('counter.element', false,4);
@endphp
<!-- ==================== Experience start ==================== -->
<section class="experience py-80">
    <div class="container">
        <div class="row gy-5">
            @foreach ($counterSectionElement ?? [] as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="counterup-item">
                        <h3><span class="odometer" data-odometer-final="{{@$item->data_values?->counter_digit}}">1</span>+</h3>
                        <h5>{{__(@$item->data_values?->counter_text)}}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ==================== Experience end ==================== -->
