@php
    $premiumContentSection = getContent('premium.content', true);

@endphp
<section class="premium pt-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="section-content-4">
                    <h2 class="title wow animate__ animate__fadeInUp animated" data-wow-delay="0.2s">
                        {{ __(@$premiumContentSection->data_values?->title) }}
                    </h2>
                    <p class="subtitle wow animate__ animate__fadeInUp animated" data-wow-delay="0.3s">
                        {{ __(@$premiumContentSection->data_values?->subtitle) }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs coustome-tabs mb-3 justify-content-center">
                    <li class="nav-item">
                        <button class="btn btn--base outline-2 active" onclick="category(0,this);" data-id="00">@lang('All')</button>
                    </li>
                    @forelse ($categories ?? [] as $item)
                        <li class="nav-item">
                            <button class="btn btn--base outline-2" data-id="{{ $item->id }}"
                                onclick="category({{ $item->id }},this);">{{ __(@$item->name) }}
                                ({{ @$item->courses->count() }})
                            </button>
                        </li>
                    @empty
                        <p class="text-center">@lang('No Data Found')</p>
                    @endforelse
                </ul>
                <div class="main-content">
                    @include($activeTemplate . 'components.instructor.category_course')
                </div>
            </div>
        </div>
    </div>
</section>
@push('style')
    <style>
        .rating-comment-item .bottom ul {
            color: #ffc107;
        }

        .rating-wrap div {
            color: #ffc107;
        }
    </style>
@endpush
@push('script')
    <script>
        function category(id,object) {
            var allButton = $('.outline-2');
            allButton.each(function(item,element){
                $(element).removeClass('active');
            })
            $(object).addClass('active');
            
  
            $.ajax({
                url: "{{ route('category.course') }}",
                type: "GET",
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('.main-content').html(response.html)
                    }
                    if (response.status == 'error') {
                        Toast.fire({
                            icon: response.status,
                            title: response.message
                        });
                    }
                }
            });
        }
    </script>
@endpush
