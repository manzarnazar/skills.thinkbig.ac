
<?php $__env->startSection('content'); ?>
<section class="account py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-10 col-md-10 col-12">
                    <div class="account-form base--card mt-5">
                        <div>
                            <h3><?php echo app('translator')->get('Forgot Your Password'); ?></h3>
                        </div>
                        <div class="mb-4">
                            <p><?php echo app('translator')->get('To recover your account please provide your email or username to find your account.'); ?>
                            </p>
                        </div>
                        <form method="POST" action="<?php echo e(route('user.password.email')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row gy-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="email" class="form--label"><?php echo app('translator')->get('Email or Username'); ?></label>
                                        <input type="text" class="form--control" id="email" name="value"
                                            value="<?php echo e(old('value')); ?>" required autofocus="off"
                                            placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-4">
                                    <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Save'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/skills.thinkbig.ac/application/resources/views/presets/default/user/auth/passwords/email.blade.php ENDPATH**/ ?>