
<?php $__env->startSection('content'); ?>
    <section class="account py-120">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="account-form base--card mt-5">
                        <div class="verification-code-wrapper">
                            <div class="verification-area">
                                <h5 class="pb-3 text-center border-bottom"><?php echo app('translator')->get('Verify Email Address'); ?></h5>
                                <form action="<?php echo e(route('user.verify.email')); ?>" method="POST" class="submit-form">
                                    <?php echo csrf_field(); ?>
                                    <p class="verification-text"><?php echo app('translator')->get('A 6 digit verification code sent to your email address'); ?>:
                                        <?php echo e(showEmailAddress(auth()->user()->email)); ?></p>
                                    <?php echo $__env->make($activeTemplate . 'components.verification_code', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Save'); ?></button>
                                    </div>
                                    <div class="mb-3">
                                        <p>
                                            <?php echo app('translator')->get('If you don\'t get any code'); ?>, <a class="text--base"
                                                href="<?php echo e(route('user.send.verify.code', 'email')); ?>">
                                                <?php echo app('translator')->get('Try again'); ?></a>
                                        </p>
                                        <?php if($errors->has('resend')): ?>
                                            <small class="text-danger d-block"><?php echo e($errors->first('resend')); ?></small>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/presets/default/user/auth/authorization/email.blade.php ENDPATH**/ ?>