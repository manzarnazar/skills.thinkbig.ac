<?php
    $exploreCategoriesSectionElement = getContent('explore_categories.content', true);
    $categories = App\Models\Category::with('courses')->where('status', 1)->orderBy('id', 'desc')->get();
?>
<!-- hero section -->
<section class="<?php echo e(Route::is('categories') ? 'category-section2' : 'category-section'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-content">
                    <div class="title-wrap">
                        <div class="row justify-content-between">
                            <div class="col-xl-4 col-lg-6">
                                <h2 class="title mb-3 wow animate__ animate__fadeInUp animated" data-wow-delay="0.2s">
                                    <?php echo e(__(@$exploreCategoriesSectionElement->data_values?->title)); ?></h2>
                                <p class="subtitle wow animate__ animate__fadeInUp animated" data-wow-delay="0.3s">
                                    <?php echo e(__(@$exploreCategoriesSectionElement->data_values?->subheading)); ?></p>
                            </div>
                            <?php if(Route::is('home')): ?>
                                <div class="col-lg-5 d-flex justify-content-end">
                                    <a class="section-link" href="<?php echo e(route('categories')); ?>"><?php echo app('translator')->get('All Categories'); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-4">
            <?php $__empty_1 = true; $__currentLoopData = $categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <a href="<?php echo e(route('course',$item->id)); ?>" class="category-card">
                        <div class="icon-wrap">
                            <img src="<?php echo e(getImage(getFilePath('category') . '/' . @$item?->image)); ?>"
                                alt="category-image">
                        </div>
                        <div class="content-wrap">
                            <h6 class="title"><?php echo e(__(@$item->name)); ?></h6>
                            <p class="sub-title"><?php echo e(@$item->courses->count()); ?> <?php echo app('translator')->get('Courses'); ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/presets/default/sections/explore_categories.blade.php ENDPATH**/ ?>