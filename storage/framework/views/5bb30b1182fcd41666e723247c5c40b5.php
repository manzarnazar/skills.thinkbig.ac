<div class="tab-content">
    <div class="tab-pane fade active show">
        <div class="row justify-content-center gy-4">
            <?php $__empty_1 = true; $__currentLoopData = $courses ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6">
                    <div class="base-card">
                        <?php if(@$item->discount > 0): ?>
                            <span class="dis-tag">-<?php echo e(@$item->discount); ?>%</span>
                        <?php endif; ?>
                        <div class="thumb-wrap">
                            <img src="<?php echo e(getImage(getFilePath('course_image') . '/' . $item->image)); ?>"
                                alt="course-image">
                        </div>
                        <div class="content-wrap">
                            <p class="category"><?php echo e(@$item->category?->name); ?></p>
                            <a href="<?php echo e(route('course.details', [slug($item->name), $item->id])); ?>">
                                <h6 class="title"><?php echo e(strLimit(@$item->name, 23)); ?></h6>
                            </a>
                            <ul class="product-status">
                                <li>
                                    <i class="fa-solid fa-clock"></i>
                                    <p><?php echo e(str_replace('ago', '', diffForHumans(@$item->created_at))); ?>

                                    </p>
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
                                    // echo showRatings($item->average_rating) 
                                ?>

                                <li>
                                    <p> <?php echo e(@$item->average_rating ?? 0); ?>.0 (<?php echo e(@$item->review_count ?? 0); ?>)</p>
                                </li>

                            </ul>
                            <div class="price-wrap">
                                <?php if(@$item->discount): ?>
                                    <h6 class="price">
                                        <?php echo e(@$general->cur_sym); ?><?php echo e(priceCalculate(@$item->price, @$item->discount)); ?>

                                    </h6>
                                    <p class="dis-price"><?php echo e(@$general->cur_sym); ?><?php echo e(@$item->price); ?></p>
                                <?php elseif(@$item->price == 0.0): ?>
                                    <h6 class="price"><?php echo app('translator')->get('Free'); ?></h6>
                                <?php else: ?>
                                    <h6 class="price"><?php echo e(@$general->cur_sym); ?><?php echo e(@$item->price); ?></h6>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <h5 class="text-center"><?php echo app('translator')->get('No Course found'); ?></h5>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /home/thingpfd/skills.thinkbig.ac/application/resources/views/presets/default/components/instructor/category_course.blade.php ENDPATH**/ ?>