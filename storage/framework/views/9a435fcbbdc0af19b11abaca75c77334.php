<!-- 404 section -->
<!-- header -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> <?php echo e($general->siteName(__('404'))); ?></title>
    <!-- Bootstrap CSS -->
    <link href="<?php echo e(asset('assets/common/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue . 'css/main.css')); ?>">
</head>

<body>

    <!--==================== Preloader End ====================-->
    <!--========================== Sidebar mobile menu wrap End ==========================-->
    <section class="account">
        <div class="account-inner">
            <div class="container">
                <div class="row gy-4 justify-content-center align-items-center" style="height: 90vh">
                    <div class="col-lg-6">
                        <div class="error-wrap text-center">
                           
                            <div class="error__text">
                                <span><?php echo app('translator')->get('4'); ?></span>
                                <span><?php echo app('translator')->get('0'); ?></span>
                                <span><?php echo app('translator')->get('4'); ?></span>
                            </div>
                            <h2 class="error-wrap__title mb-3"><?php echo app('translator')->get('Page Not Found'); ?></h2>
                            <p class="error-wrap__desc"><?php echo app('translator')->get('Page you are looking have been deleted or does not exist'); ?></p>
                            <a href="<?php echo e(route('home')); ?>" class="btn btn--base">
                                <i class="la la-undo"></i> <?php echo app('translator')->get('Go Home'); ?> 
                               
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  404 section /> -->
</body>

</html>
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/errors/404.blade.php ENDPATH**/ ?>