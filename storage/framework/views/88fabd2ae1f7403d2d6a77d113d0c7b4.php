<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($general->siteName($pageTitle ?? '')); ?></title>

    <link rel="shortcut icon" type="image/png" href="<?php echo e(getImage(getFilePath('logoIcon') .'/favicon.png')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap-toggle.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/line-awesome.min.css')); ?>">

    <?php echo $__env->yieldPushContent('style-lib'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/admin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/custom-style.css')); ?>">


    <?php echo $__env->yieldPushContent('style'); ?>
</head>

<body>
    <?php echo $__env->yieldContent('content'); ?>




    <script src="<?php echo e(asset('assets/common/js/jquery-3.7.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/common/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap-toggle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/jquery.slimscroll.min.js')); ?>"></script>



    <?php echo $__env->make('includes.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('script-lib'); ?>


    <script src="<?php echo e(asset('assets/admin/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/admin.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/common/js/ckeditor.js')); ?>"></script>
    
    <script>
        "use strict";
        $(".trumEdit").each(function() {
            ClassicEditor
                .create(this)
                .then(editor => {
                    window.editor = editor;
                });
        });
    </script>

    <?php echo $__env->yieldPushContent('script'); ?>


</body>

</html><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/layouts/master.blade.php ENDPATH**/ ?>