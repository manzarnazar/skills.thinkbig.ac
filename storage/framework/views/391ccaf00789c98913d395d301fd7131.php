

<?php $__env->startSection('content'); ?>
<!-- page-wrapper start -->
<div class="page-wrapper default-version">
    <?php echo $__env->make('admin.components.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="top-nav-bg">
        <?php echo $__env->make('admin.components.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="breadcrumb-wrapper">
            <?php echo $__env->make('admin.components.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="body-wrapper">
        <div class="bodywrapper__inner">


            <?php echo $__env->yieldContent('panel'); ?>


        </div><!-- bodywrapper__inner end -->
    </div><!-- body-wrapper end -->
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>