
<?php $__env->startSection('panel'); ?>
<div class="row mb-none-30">
    <div class="col-lg-12 col-md-12 mb-30">
        <div class="card">
            <div class="card-body px-4">
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                    <label class="required"> <?php echo app('translator')->get('Site Title'); ?></label>
                                </div>
                                <div class="col-md-9 col-xs-12">
                                    <input class="form-control" type="text" name="site_name" required
                                        value="<?php echo e($general->site_name); ?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                    <label class="required"><?php echo app('translator')->get('Currency'); ?></label>
                                </div>
                                <div class="col-md-9 col-xs-12">
                                    <input class="form-control" type="text" name="cur_text" required
                                        value="<?php echo e($general->cur_text); ?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                    <label class="required"><?php echo app('translator')->get('Currency Symbol'); ?></label>
                                </div>
                                <div class="col-md-9 col-xs-12">
                                    <input class="form-control" type="text" name="cur_sym" required
                                        value="<?php echo e($general->cur_sym); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                    <label> <?php echo app('translator')->get('Timezone'); ?></label>
                                </div>
                                <div class="col-md-9 col-xs-12">
                                    <select class="select2-basic form-control" name="timezone">
                                        <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php if($key == $currentTimezone): echo 'selected'; endif; ?>><?php echo e(__($timezone)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                    <label> <?php echo app('translator')->get('Site Base Color'); ?></label>
                                </div>
                                <div class="col-md-9 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-text p-0 border-0">
                                            <input type='text' class="form-control colorPicker"
                                                value="<?php echo e($general->base_color); ?>" />
                                        </span>
                                        <input type="text" class="form-control colorCode" name="base_color"
                                            value="<?php echo e($general->base_color); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                    <label> <?php echo app('translator')->get('Site Secondary Color'); ?></label>
                                </div>
                                <div class="col-md-9 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-text p-0 border-0">
                                            <input type='text' class="form-control colorPicker"
                                                value="<?php echo e($general->secondary_color); ?>" />
                                        </span>
                                        <input type="text" class="form-control colorCode" name="secondary_color"
                                            value="<?php echo e($general->secondary_color); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2 col-sm-6 mb-4">
                            <label class="fw-bold"><?php echo app('translator')->get('User Registration'); ?></label>
                            <label class="switch m-0">
                                <input type="checkbox" class="toggle-switch" name="registration" <?php echo e($general->registration ?
                                'checked' : null); ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-group col-md-2 col-sm-6 mb-4">
                            <label class="fw-bold"><?php echo app('translator')->get('Email Verification'); ?></label>
                            <label class="switch m-0">
                                <input type="checkbox" class="toggle-switch" name="ev" <?php echo e($general->ev ?
                                'checked' : null); ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-group col-md-2 col-sm-6 mb-4">
                            <label class="fw-bold"><?php echo app('translator')->get('Email Notification'); ?></label>
                            <label class="switch m-0">
                                <input type="checkbox" class="toggle-switch" name="en" <?php echo e($general->en ?
                                'checked' : null); ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-group col-md-2 col-sm-6 mb-4">
                            <label class="fw-bold"><?php echo app('translator')->get('Mobile Verification'); ?></label>
                            <label class="switch m-0">
                                <input type="checkbox" class="toggle-switch" name="sv" <?php echo e($general->sv ?
                                'checked' : null); ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-group col-md-2 col-sm-6 mb-4">
                            <label class="fw-bold"><?php echo app('translator')->get('SMS Notification'); ?></label>
                            <label class="switch m-0">
                                <input type="checkbox" class="toggle-switch" name="sn" <?php echo e($general->sn ?
                                'checked' : null); ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-group col-md-2 col-sm-6 mb-4">
                            <label class="fw-bold"><?php echo app('translator')->get('Terms & Condition'); ?></label>
                            <label class="switch m-0">
                                <input type="checkbox" class="toggle-switch" name="agree" <?php echo e($general->agree ?
                                'checked' : null); ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-end">
                            <button type="submit" class="btn btn--primary btn-global"><?php echo app('translator')->get('Save'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-lib'); ?>
<script src="<?php echo e(asset('assets/admin/js/spectrum.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/spectrum.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
    (function ($) {
        "use strict";
        $('.colorPicker').spectrum({
            color: $(this).data('color'),
            change: function (color) {
                $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
            }
        });

        $('.colorCode').on('input', function () {
            var clr = $(this).val();
            $(this).parents('.input-group').find('.colorPicker').spectrum({
                color: clr,
            });
        });

        $('.select2-basic').select2({
            dropdownParent: $('.card-body')
        });
    })(jQuery);

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/setting/general.blade.php ENDPATH**/ ?>