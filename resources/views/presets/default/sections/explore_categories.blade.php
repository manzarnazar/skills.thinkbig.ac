@php
    $exploreCategoriesSectionElement = getContent('explore_categories.content', true);
    $categories = App\Models\Category::with('courses')->where('status', 1)->orderBy('id', 'desc')->get();
@endphp
<!-- hero section -->
<section class="{{ Route::is('categories') ? 'category-section2' : 'category-section' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-content">
                    <div class="title-wrap">
                        <div class="row justify-content-between">
                            <div class="col-xl-4 col-lg-6">
                                <h2 class="title mb-3 wow animate__ animate__fadeInUp animated" data-wow-delay="0.2s">
                                    {{ __(@$exploreCategoriesSectionElement->data_values?->title) }}</h2>
                                <p class="subtitle wow animate__ animate__fadeInUp animated" data-wow-delay="0.3s">
                                    {{ __(@$exploreCategoriesSectionElement->data_values?->subheading) }}</p>
                            </div>
                            @if (Route::is('home'))
                                <div class="col-lg-5 d-flex justify-content-end">
                                    <a class="section-link" href="{{route('categories')}}">@lang('All Categories')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-4">
            @forelse ($categories ?? [] as $item)
                <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <a href="{{route('course',$item->id)}}" class="category-card">
                        <div class="icon-wrap">
                            <img src="{{ getImage(getFilePath('category') . '/' . @$item?->image) }}"
                                alt="category-image">
                        </div>
                        <div class="content-wrap">
                            <h6 class="title">{{ __(@$item->name) }}</h6>
                            <p class="sub-title">{{@$item->courses->count()}} @lang('Courses')</p>
                        </div>
                    </a>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
