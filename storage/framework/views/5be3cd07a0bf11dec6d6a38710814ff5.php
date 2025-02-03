<?php
    $testimonialSection = getContent('testimonial.content', true);
    $testimonialElementSection = getContent('testimonial.element', false, 3);
?>
<section class="testimonial-section pt-120">
    <div class="testimonial-wrap">
        <span class="bg-elemet1">
            <img src="<?php echo e(getImage(getFilePath('testimonial') . '/' . @$testimonialSection->data_values?->shape_image_one)); ?>"
                alt="image">
        </span>
        <span class="bg-elemet2">
            <img src="<?php echo e(getImage(getFilePath('testimonial') . '/' . @$testimonialSection->data_values?->shape_image_two)); ?>"
                alt="image">
        </span>
        <span class="bg-elemet3">
            <img src="<?php echo e(getImage(getFilePath('testimonial') . '/' . @$testimonialSection->data_values?->shape_image_three)); ?>"
                alt="image">
        </span>

        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-9">
                    <div class="row testimonial-slider">
                        <?php $__empty_1 = true; $__currentLoopData = $testimonialElementSection ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="testimonial-card">
                                <div class="icon-thumb">
                                    <img src="<?php echo e(asset('assets/images/frontend/testimonial/testemonial-icon.png')); ?>"
                                        alt="image">
                                </div>
                                <div class="content-wrap">
                                    <h6 class="title"><?php echo e(__(@$item->data_values?->title)); ?></h6>
                                </div>
                                <div class="user-thumb">
                                    <img src="<?php echo e(getImage(getFilePath('testimonial') . '/' . @$item->data_values?->image_one)); ?>"
                                        alt="image">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<?php /**PATH /home/thingpfd/skills.thinkbig.ac/application/resources/views/presets/default/sections/testimonial.blade.php ENDPATH**/ ?>