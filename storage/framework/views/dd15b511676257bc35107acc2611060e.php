<?php
    $advertisementSection = getContent('advertisement.content', true);
?>

<?php $__env->startSection('content'); ?>
    <section class="all-course py-120">
        <div class="container">
            <div class="filter-box">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0"><?php echo app('translator')->get('What to learn next'); ?></h5>
                    <div class="btn_wrap">
                        <button class="btn btn--base-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-sliders"></i></button>
                    </div>
                </div>
            </div>

            <div class="discover-box">
                <div class="row align-items-center">
                    <a href="#" class="close-btn"><i class="fa-solid fa-xmark"></i></a>
                    <div class="col-12 col-mb-12 col-lg-8">
                        <h6 class="title">
                            <?php echo e(__(@$advertisementSection->data_values?->title)); ?>

                        </h6>
                    </div>
                    <div class="col-12 col-mb-12 col-lg-4 text-md-start mt-3 mt-lg-0 text-lg-end">
                        <div>
                            <a href="<?php echo e(__(@$advertisementSection->data_values?->url)); ?>"
                                class="btn btn--base-3"><?php echo app('translator')->get('Discover More'); ?></a>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->
            <div class="mb-5 mt-5">
                <h6 class="title wow animate__ animate__fadeInUp animated mb-4" data-wow-delay="0.2s">
                    <?php echo app('translator')->get('Short and sweet courses for you'); ?></h6>
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6">
                            <div class="base-card mb-5">
                                <?php if($item->discount > 0): ?>
                                    <span class="dis-tag">-<?php echo e($item->discount); ?>%</span>
                                <?php endif; ?>
                                <div class="thumb-wrap">
                                    <img src="<?php echo e(getImage(getFilePath('course_image') . '/' . $item->image)); ?>"
                                        alt="course_image">
                                </div>
                                <div class="content-wrap">
                                    <p class="category"><?php echo e(__(@$item->category->name)); ?></p>
                                    <a href="<?php echo e(route('course.details', [slug($item->name), $item->id])); ?>">
                                        <h6 class="title"><?php echo e(__(strLimit(@$item->name, 23))); ?></h6>
                                    </a>
                                    <ul class="product-status">
                                        <li>
                                            <i class="fa-solid fa-clock"></i>
                                            <p><?php echo e(str_replace('ago', '', diffForHumans(@$item->created_at))); ?></p>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-graduation-cap"></i>
                                            <p><?php echo e($item->enrolls->count()); ?> <?php echo app('translator')->get('Students'); ?></p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="carn-btm">
                                    <ul class="star-wrap rating-wrap">
                                        <?php
                                            $averageRatingHtml = calculateAverageRating($item->average_rating);
                                            if (!empty($averageRatingHtml['ratingHtml'])) {
                                                echo $averageRatingHtml['ratingHtml'];
                                            }
                                        ?>

                                        <li>
                                            <p> <?php echo e(@$item->average_rating ?? 0); ?>.0 (<?php echo e(@$item->review_count ?? 0); ?>)</p>
                                        </li>
                                    </ul>
                                    <div class="price-wrap">
                                        <?php if(@$item->discount): ?>
                                            <h6 class="price">
                                                <?php echo e($general->cur_sym); ?><?php echo e(priceCalculate(@$item->price, @$item->discount)); ?>

                                            </h6>
                                            <p class="dis-price"><?php echo e($general->cur_sym); ?><?php echo e(@$item->price); ?></p>
                                        <?php elseif(@$item->price == 0.0): ?>
                                            <h6 class="price"><?php echo app('translator')->get('Free'); ?></h6>
                                        <?php else: ?>
                                            <h6 class="price"><?php echo e($general->cur_sym); ?><?php echo e(@$item->price); ?></h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <h5 class="text-center"><?php echo app('translator')->get('No Course Found'); ?></h5>
                    <?php endif; ?>
                </div>
                <?php echo e($courses->links()); ?>

            </div>
        </div>

        <!-- filter-modal -->
        <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" 
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo app('translator')->get('Filter'); ?></h5>
                        <div class="modal-btn-wrap">
                            <button data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('course.search')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6><?php echo app('translator')->get('Search'); ?></h6>
                                    <div class="categories-search from-group mb-3">
                                        <input class="form-check-input filter-by-category me-2 w-100  form--control" name="name"
                                            type="text" value="">
                                 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h6><?php echo app('translator')->get('Price'); ?></h6>
                                    <div class="form--check">
                                        <input class="form-check-input filter-by-category" name="value"
                                            type="radio" value="0" id="free">
                                        <label class="form-check-label" for="free">
                                           <?php echo app('translator')->get('Free'); ?>
                                        </label>
                                    </div>
                                    <div class="form--check mb-3">
                                        <input class="form-check-input filter-by-category" name="value"
                                            type="radio" value="1" id="premium">
                                        <label class="form-check-label" for="premium">
                                            <?php echo app('translator')->get('Premium'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6><?php echo app('translator')->get('Ratings'); ?></h6>
                                    <div class="rating-wrap categories-search rating-stars ps-2 form--check mb-3">
                                        <input class="form-check-input filter-by-category me-2" name="review"
                                            type="radio" value="5" id="rating-5">
                                        <div>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="rating-wrap categories-search rating-stars ps-2 form--check mb-3">
                                        <input class="form-check-input filter-by-category me-2" name="review"
                                            type="radio" value="4" id="rating-4">
                                        <div>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>

                                        </div>
                                    </div>

                                    <div class="rating-wrap categories-search rating-stars ps-2 form--check mb-3">
                                        <input class="form-check-input filter-by-category me-2" name="review"
                                            type="radio" value="3" id="rating-3">
                                        <div>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>

                                    <div class="rating-wrap categories-search rating-stars ps-2 form--check mb-3">
                                        <input class="form-check-input filter-by-category me-2" name="review"
                                            type="radio" value="2" id="rating-2">
                                        <div>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>

                                    <div class="rating-wrap categories-search rating-stars ps-2 form--check mb-3">
                                        <input class="form-check-input filter-by-category me-2" name="review"
                                            type="radio" value="1" id="rating-1">
                                        <div>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h6><?php echo app('translator')->get('Categories'); ?></h6>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form--check categories-search mb-2">
                                            <input type="radio" class="form-check-input filter-by-category"
                                                name="category" value="<?php echo e($category->id); ?>"
                                                id="category<?php echo e($category->id); ?>">
                                            <label for="category<?php echo e($category->id); ?>"
                                                class="form-check-label"><?php echo e(__($category->name)); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                           
                            <div class="modal-footer">
                                <button type="reset" class="btn btn--base outline" data-bs-dismiss="modal"><?php echo app('translator')->get('Clear'); ?></button>
                                <button type="submit" class="btn btn--base"><?php echo app('translator')->get('Show Course'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        .rating-comment-item .bottom ul {
            color: #ffc107;
        }
        .rating-wrap div {
            color: #ffc107;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $('.close-btn').on('click', function() {
            $('.discover-box').addClass('d-none');
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/presets/default/course/index.blade.php ENDPATH**/ ?>