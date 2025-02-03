
<?php $__env->startSection('panel'); ?>

<div class="row gy-4">
    <div class="col-xxl-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-md-5 mb-4 border-bottom pb-2"><?php echo app('translator')->get('Profile Information'); ?></h5>

                <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview"
                                                style="background-image: url(<?php echo e(getImage(getFilePath('adminProfile').'/'.$admin->image,getFileSize('adminProfile'))); ?>)">
                                                <button type="button" class="remove-image"><i
                                                        class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image"
                                                id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                            <small class="mt-2"><?php echo app('translator')->get('400x400 is recommended'); ?></small>
                                            <label for="profilePicUpload1"
                                                class="btn bg--primary text-white"><?php echo app('translator')->get('Upload
                                                Image'); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8 d-flex justify-content-between flex-column">
                            <div>
                                <div class="form-group ">
                                    <label><?php echo app('translator')->get('Name'); ?></label>
                                    <input class="form-control" type="text" name="name" value="<?php echo e($admin->name); ?>"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Email'); ?></label>
                                    <input class="form-control" type="email" name="email" value="<?php echo e($admin->email); ?>"
                                        required>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn--primary btn-global"><?php echo app('translator')->get('Save'); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xxl-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-50 border-bottom pb-2"><?php echo app('translator')->get('Change Password'); ?></h5>

                <form action="<?php echo e(route('admin.password.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('Password'); ?></label>
                        <input class="form-control" type="password" name="old_password" required>
                    </div>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('New Password'); ?></label>
                        <input class="form-control" type="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('Confirm Password'); ?></label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn--primary btn-global float-end"><?php echo app('translator')->get('Change
                        Password'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/profile.blade.php ENDPATH**/ ?>