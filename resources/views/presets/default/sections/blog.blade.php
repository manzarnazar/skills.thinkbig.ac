@php
    $blogSection = getContent('blog.content', true);
    $blogElementSection = getContent('blog.element', false, 6);
@endphp
<!-- ==================== Blog Start ==================== -->
<section class="blog-section">
    <div class="container">
        <div class="row gy-4 justify-content-center py-60">
            @foreach (@$blogElementSection ?? [] as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card1">
                        <div class="thumb">
                            <img src="{{ getImage(getFilePath('blog') . '/thumb_' . @$item->data_values?->blog_image) }}"
                                alt="blog-image" />
                        </div>
                        <div class="blog-content">
                            <a href="{{ route('blog.details', [slug($item->data_values->title), $item->id]) }}">
                                <h5 class="title">
                                    {{ __(@$item->data_values?->title) }}
                                </h5>
                            </a>

                            <p class="date-time">{{ showDateTime($item->created_at, 'D, M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>











<!-- ==================== Blog End ==================== -->
