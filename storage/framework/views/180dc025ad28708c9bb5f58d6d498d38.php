
<?php $__env->startSection('content'); ?>
    <!-- ==================== Blog Details Start ==================== -->
    <?php echo $__env->make($activeTemplate . '/components/breadcumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="blog-details-section py-60">
        <div class="container">
            <div class="row pt-4 gy-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-details">
                        <div class="blog-item">
                            <div class="blog-item__thumb">
                                <img src="<?php echo e(getImage(getFilePath('blog') . '/' . @$blog->data_values?->blog_image)); ?>"
                                    alt="blog-img">
                            </div>
                            <div class="blog-item__content pt-3">
                                <ul class="text-list inline">
                                    <li class="text-list__item">
                                        <span class="text-list__item-icon"><i class="fas fa-calendar-alt"></i>
                                        </span> <?php echo e(showDateTime(@$blog->data_values?->created_at, 'd M Y')); ?>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog-details__content">
                            <h3 class="blog-details__title"><?php echo e(__(@$blog->data_values?->title)); ?></h3>
                            <p class="blog-details__desc"> <?php echo (__(strWords(@$blog->data_values?->description,150)) )?></p>
                            <blockquote>
                                <?php echo (__(@$blog->data_values?->blockquote))?>
                            </blockquote>
                            <p class="blog-details__desc"><?php echo ('<p>' . __(strSub(@$blog->data_values?->description,150)))?></p>

                            <div class="blog-details__share mt-4 d-flex align-items-center flex-wrap mb-4">
                                <h5 class="social-share__title mb-0 me-sm-3 me-1 d-inline-block"><?php echo app('translator')->get('Share This'); ?></h5>
                                <ul class="social-list blog-details">
                                    <li class="social-list__item"><a
                                            href="https://www.facebook.com/share.php?u=<?php echo e(Request::url()); ?>&title=<?php echo e(slug(@$blog->data_values?->title)); ?>"
                                            class="social-list__link"><i class="fab fa-facebook-f"></i></a> </li>
                                    <li class="social-list__item"><a
                                            href="https://twitter.com/intent/tweet?status=<?php echo e(slug(@$blog->data_values?->title)); ?>+<?php echo e(Request::url()); ?>"
                                            class="social-list__link"> <i class="fab fa-twitter"></i></a></li>
                                    <li class="social-list__item"><a
                                            href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo e(Request::url()); ?>&title=<?php echo e(slug(@$blog->data_values?->title)); ?>&source=behands"
                                            class="social-list__link" class="social-list__link"> <i
                                                class="fab fa-linkedin-in"></i></a></li>
                                    <li class="social-list__item"><a
                                            href="https://www.pinterest.com/pin/create/button/?url=<?php echo e(Request::url()); ?>&description=<?php echo e(slug(@$blog->data_values->title)); ?>"
                                            class="social-list__link"> <i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- ============================= Blog Details Sidebar Start ======================== -->
                    <div class="blog-sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title"><?php echo app('translator')->get('Search'); ?></h5>
                            <div class="blog-search-box w-100">
                                <div class="form-group">
                                    <input type="email" autocomplete="off" class="form--control searchTerm"
                                        data-wow-delay="0.3s" name="search" value="<?php echo e(request()->search); ?>"
                                        placeholder="<?php echo app('translator')->get('Search...'); ?>">
                                  
                                </div>
                                <div class="search-result-box">
                                    <div class="search-wrap2" id="search-results"></div>
                                </div>

                            </div>
                        </div>
                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title"><?php echo app('translator')->get('Recent Blogs'); ?></h5>
                            <?php $__currentLoopData = $blogElementSection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="latest-blog">
                                    <div class="latest-blog__thumb">
                                        <a
                                            href="<?php echo e(route('blog.details', [slug($item->data_values->title), $item->id])); ?>">
                                            <img src="<?php echo e(getImage(getFilePath('blog') . '/thumb_' . @$item->data_values?->blog_image)); ?>"
                                                alt="blog-image">
                                        </a>
                                    </div>
                                    <div class="latest-blog__content">
                                        <h6 class="latest-blog__title">
                                            <a
                                                href="<?php echo e(route('blog.details', [slug($item->data_values->title), $item->id])); ?>">
                                                <?php echo e(__(@$item->data_values?->title)); ?>

                                            </a>
                                        </h6>
                                        <span
                                            class="latest-blog__date"><?php echo e(showDateTime($item->created_at, 'M d Y')); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <!-- ============================= Blog Details Sidebar End ======================== -->
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Blog Details End ==================== -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(document).ready(function() {
            "use strict";
            let searchTimeout;
            $('.searchTerm').on('keyup', function() {
                clearTimeout(searchTimeout);
                $('.search-result-box').addClass('show');
                var searchTerm = $(this).val();
                if (searchTerm.length >= 1) {
                    $('#search-results').html(
                        '<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'
                    );
                    searchTimeout = setTimeout(function() {
                        $.ajax({
                            url: "<?php echo e(route('blog.search')); ?>",
                            type: "GET",
                            data: {
                                searchTerm: searchTerm
                            },
                            success: function(response) {

                                var results = '';
                                var websiteUrl = "<?php echo e(url('/')); ?>/";
                                const slugify = str => str
                                    .toLowerCase()
                                    .trim()
                                    .replace(/[^\w\s-]/g, '')
                                    .replace(/[\s_-]+/g, '-')
                                    .replace(/^-+|-+$/g, '');
                                if (response.blogs.length > 0) {
                                    $.each(response.blogs, function(index, value) {
                                        let slug = slugify(value.data_values
                                            .title);
                                        var date = new Date(value.created_at);
                                        var monthNames = ["Jan", "Feb", "Mar",
                                            "Apr", "May", "Jun", "Jul",
                                            "Aug", "Sep", "Oct", "Nov",
                                            "Dec"
                                        ];
                                        var month = monthNames[date.getMonth()];
                                        var day = date.getDate();
                                        var year = date.getFullYear();
                                        var formattedDate = month + ' ' + day +
                                            ', ' + year;
                                        results += '<div class="new mb-3">';
                                        results += '<a href="' + websiteUrl +
                                            'blog/' + slug + '/' + value.id +
                                            '">';
                                        results += '<p class="title">' + value
                                            .data_values.title + '</p>';
                                        results +=
                                            '<ul class="text-list inline">';
                                        results +=
                                            '<li class="text-list__item text-dark"><span class="text-list__item-icon"><i class="fas fa-calendar-alt"></i> </span>' +
                                            formattedDate + '</li>';
                                        results += '</ul>';
                                        results += '</a>';
                                        results += '</div>';
                                    });
                                } else {
                                    results += '<div class="new">';
                                    results += '<p class="text-center mt-3">' + "<?php echo app('translator')->get('No blog found'); ?>" + '</p>';
                                    results += '</div>';
                                }
                                $('#search-results').html(results);
                            }
                        });
                    }, 2000);
                } else {
                    $('.search-result-box').removeClass('show');
                    $('#search-results').empty();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/presets/default/blog/blog-details.blade.php ENDPATH**/ ?>