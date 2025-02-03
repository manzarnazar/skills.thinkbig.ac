<?php
    $blogSection = getContent('blog.content', true);
    $blogElementSection = getContent('blog.element', false, 6);
?>
<!-- ==================== Blog Start ==================== -->
<section class="blog-section">
    <div class="container">
        <div class="row gy-4 justify-content-center py-60">
            <?php $__currentLoopData = @$blogElementSection ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card1">
                        <div class="thumb">
                            <img src="<?php echo e(getImage(getFilePath('blog') . '/thumb_' . @$item->data_values?->blog_image)); ?>"
                                alt="blog-image" />
                        </div>
                        <div class="blog-content">
                            <a href="<?php echo e(route('blog.details', [slug($item->data_values->title), $item->id])); ?>">
                                <h5 class="title">
                                    <?php echo e(__(@$item->data_values?->title)); ?>

                                </h5>
                            </a>

                            <p class="date-time"><?php echo e(showDateTime($item->created_at, 'D, M d, Y')); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>











<!-- ==================== Blog End ==================== -->
<?php /**PATH /home/thingpfd/skills.thinkbig.ac/application/resources/views/presets/default/sections/blog.blade.php ENDPATH**/ ?>