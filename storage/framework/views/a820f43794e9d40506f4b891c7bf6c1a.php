

<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card b-radius--10">

                <div class="card-body p-3">
                    <div class="d-flex justify-content-end" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Setup Instruction">
                        <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.zoom.store.credential')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2"><?php echo app('translator')->get('Zoom Account Id'); ?> </label>
                                        <input class="form-control" name="zoom_account_id"
                                            value="<?php echo e(__(@$admin->zoom_account_id ?? old('zoom_account_id'))); ?>"
                                            placeholder="<?php echo app('translator')->get('Enter zoom account id'); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2"><?php echo app('translator')->get('Zoom Client Id'); ?> </label>
                                        <input class="form-control" name="zoom_client_id"
                                            value="<?php echo e(__(@$admin->zoom_client_id ?? old('zoom_client_id'))); ?>"
                                            placeholder="<?php echo app('translator')->get('Enter zoom client key'); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class=" mb-2"><?php echo app('translator')->get('Zoom Secret Id'); ?> </label>
                                        <input class="form-control" name="zoom_secret_id"
                                            value="<?php echo e(__(@$admin->zoom_secret_id ?? old('zoom_secret_id'))); ?>"
                                            placeholder="<?php echo app('translator')->get('Enter zoom secret key'); ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end text-end">
                            <div class="col-4">
                                <button type="submit" class="btn btn--success"><?php echo app('translator')->get('Save'); ?> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('Zoom Credential setup'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">
                        <?php echo app('translator')->get('1. Navigate to the vibrant world of Zoom Marketplace at'); ?> <a class="text--base"
                            href="https://marketplace.zoom.us/">https://marketplace.zoom.us/</a> <?php echo app('translator')->get("and embark on your
                                                                                journey by creating your very own account."); ?>
                    </p>
                    <p class="mb-3">
                        <?php echo app('translator')->get("2. Delve deeper into the possibilities by clicking on the 'Develop' dropdown button. From there, let your
                                                                        creativity soar as you click on the illustrious 'Build Legacy App' nestled within the navigation
                                                                        section."); ?>
                    </p>
                    <p class="mb-3">
                        <?php echo app('translator')->get("3. Embrace the power of connectivity as you select 'Server-to-Server' integration. With each click, you're
                                                                        one step closer to bringing your vision to life. Create an app that reflects your unique essence, and
                                                                        meticulously set your account ID, client ID, and client secret with precision and care. Let the journey
                                                                        begin!"); ?>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--primary" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/zoom/credential.blade.php ENDPATH**/ ?>