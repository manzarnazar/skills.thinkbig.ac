
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make($activeTemplate . '/components/breadcumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="cookie-section py-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="coockie-wrap">
                        <div class="wyg">
                            <?php
                                echo $cookie->data_values->description;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .wyg h1,
        h2,
        h3,
        h4 {
            color: #383838;
        }

        .wyg strong {
            color: #383838
        }

        .wyg p {
            color: #666666
        }

        .wyg ul {
            margin-left: 40px
        }

        .wyg ul li {
            list-style-type: disc;
            color: #666666
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/skills.thinkbig.ac/application/resources/views/presets/default/cookie.blade.php ENDPATH**/ ?>