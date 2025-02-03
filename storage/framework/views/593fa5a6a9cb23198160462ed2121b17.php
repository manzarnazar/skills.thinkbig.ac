<?php $__env->startSection('panel'); ?>
<div class="row mb-none-30">
    <a id="refresh"></a>
    <div class="col-md-12 mb-30">
        <form action="" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row my-3 mx-1 border p-3">
                        <div class="col-md-4 d-flex flex-column justify-content-center">
                            <label><?php echo app('translator')->get('Logo'); ?></label>
                            <div class="file-upload-wrapper" data-text="<?php echo app('translator')->get('Select your file!'); ?>">
                                <input type="file" accept=".png, .jpg, .jpeg" name="logo" class="file-upload-field" id="imageInput">
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center bg--dark">
                            <img src=" <?php echo e(getImage(getFilePath('logoIcon').'/logo.png', '?'
                                    .time())); ?>" alt="<?php echo e(config('app.name')); ?>" id="imagePreview">
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center bg--gray">
                            <img src=" <?php echo e(getImage(getFilePath('logoIcon').'/logo.png', '?'
                                    .time())); ?>" alt="<?php echo e(config('app.name')); ?>" id="imagePreview2">
                        </div>
                    </div>

                    <div class="row my-3 mx-1 border p-3">
                        <div class="col-md-4 d-flex flex-column justify-content-center">
                            <label><?php echo app('translator')->get('Logo White'); ?></label>
                            <div class="file-upload-wrapper" data-text="<?php echo app('translator')->get('Select your file!'); ?>">
                                <input type="file" accept=".png, .jpg, .jpeg" name="logo_white" class="file-upload-field" id="whiteImageInput" />
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center bg--dark">
                            <img src=" <?php echo e(getImage(getFilePath('logoIcon').'/logo_white.png', '?'
                                    .time())); ?>" alt="<?php echo e(config('app.name')); ?>" id="whiteImagePreview">
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center bg--gray">
                            <img src=" <?php echo e(getImage(getFilePath('logoIcon').'/logo_white.png', '?'
                                    .time())); ?>" alt="<?php echo e(config('app.name')); ?>" id="whiteImagePreview2">
                        </div>
                    </div>  
                    <div class="row my-3 mx-1 border p-3">
                        <div class="col-4 d-flex flex-column justify-content-center">
                            <label><?php echo app('translator')->get('Favicon'); ?></label>
                            <div class="file-upload-wrapper" data-text="<?php echo app('translator')->get('Select your file!'); ?>">
                                <input type="file" accept=".png, .jpg, .jpeg" name="favicon"
                                    class="file-upload-field" id="imageInputFav">
                            </div>
                        </div>
                        <div class="col-8 d-flex align-items-center justify-content-center">
                                                <img src=" <?php echo e(getImage(getFilePath('logoIcon') .'/favicon.png', '?'
                            .time())); ?>" alt="<?php echo e(config('app.name')); ?>" width="70" id="imagePreviewFav">
                        </div>
                    </div>
                    <div class="form-group mb-0 text-end">
                        <button type="submit" class="btn bg--primary btn-global"><?php echo app('translator')->get('Save'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
    $(document).ready(function () {
        "use strict";
        $("#imageInput").change(function () {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#imagePreview").attr("src", e.target.result);
                    $("#imagePreview2").attr("src", e.target.result);
                };

                reader.readAsDataURL(file);
            } else {
                $("#imagePreview").attr("src", "");
                $("#imagePreview2").attr("src", "");
            }
        });

        $("#whiteImageInput").on('change',function () {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#whiteImagePreview").attr("src", e.target.result);
                    $("#whiteImagePreview2").attr("src", e.target.result);
                };

                reader.readAsDataURL(file);
            } else {
                $("#whiteImagePreview").attr("src", "");
                $("#whiteImagePreview2").attr("src", "");
            }
        });

        // favicon
        $("#imageInputFav").change(function () {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#imagePreviewFav").attr("src", e.target.result);
                    $("#imagePreviewFav").show();
                };

                reader.readAsDataURL(file);
            } else {
                $("#imagePreviewFav").attr("src", "");
                $("#imagePreviewFav").hide();
            }
        });
    });
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/setting/logo_icon.blade.php ENDPATH**/ ?>