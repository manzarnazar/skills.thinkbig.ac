<!-- ==================== Breadcumb Start Here ==================== -->
<div class="breadcumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcumb__wrapper">
                    <h2 class="breadcumb__title mb-4"><?php echo e(@$pageTitle); ?></h2>
                    <ul class="breadcumb__list">
                        <li class="breadcumb__item"><a href="<?php echo e(route('home')); ?>" class="breadcumb__link"><?php echo app('translator')->get('Home'); ?></a></li>
                        <li class="breadcumb__icon"> <i class="fa-solid fa-slash"></i> </li>
                        <li class="breadcumb__item"> <span class="breadcumb__item-text"> <?php echo e(@$pageTitle); ?> </span> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==================== Breadcumb End Here ==================== --><?php /**PATH /home/thingpfd/skills.thinkbig.ac/application/resources/views/presets/default//components/breadcumb.blade.php ENDPATH**/ ?>