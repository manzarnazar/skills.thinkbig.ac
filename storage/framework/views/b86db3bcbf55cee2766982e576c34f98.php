<?php
    $premiumContentSection = getContent('premium.content', true);

?>
<section class="premium pt-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="section-content-4">
                    <h2 class="title wow animate__ animate__fadeInUp animated" data-wow-delay="0.2s">
                        <?php echo e(__(@$premiumContentSection->data_values?->title)); ?>

                    </h2>
                    <p class="subtitle wow animate__ animate__fadeInUp animated" data-wow-delay="0.3s">
                        <?php echo e(__(@$premiumContentSection->data_values?->subtitle)); ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs coustome-tabs mb-3 justify-content-center">
                    <li class="nav-item">
                        <button class="btn btn--base outline-2 active" onclick="category(0,this);" data-id="00"><?php echo app('translator')->get('All'); ?></button>
                    </li>
                    <?php $__empty_1 = true; $__currentLoopData = $categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="nav-item">
                            <button class="btn btn--base outline-2" data-id="<?php echo e($item->id); ?>"
                                onclick="category(<?php echo e($item->id); ?>,this);"><?php echo e(__(@$item->name)); ?>

                                (<?php echo e(@$item->courses->count()); ?>)
                            </button>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center"><?php echo app('translator')->get('No Data Found'); ?></p>
                    <?php endif; ?>
                </ul>
                <div class="main-content">
                    <?php echo $__env->make($activeTemplate . 'components.instructor.category_course', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
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
        function category(id,object) {
            var allButton = $('.outline-2');
            allButton.each(function(item,element){
                $(element).removeClass('active');
            })
            $(object).addClass('active');
            
  
            $.ajax({
                url: "<?php echo e(route('category.course')); ?>",
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
<?php $__env->stopPush(); ?>
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/presets/default/sections/premium.blade.php ENDPATH**/ ?>