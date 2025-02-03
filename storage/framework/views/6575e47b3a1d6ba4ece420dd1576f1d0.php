
<?php $__env->startSection('panel'); ?>
    <?php echo $__env->make('admin.components.tabs.instructor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Instructor'); ?></th>
                                    <th><?php echo app('translator')->get('Email'); ?></th>
                                    <th><?php echo app('translator')->get('Joined At'); ?></th>
                                    <th><?php echo app('translator')->get('Balance'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('admin.instructors.detail', $user->id)); ?>"><?php echo e($user->fullname); ?>

                                                (<?php echo e($user->username); ?>)
                                            </a>
                                        </td>
                                        <td>
                                            <?php echo e($user->email); ?>

                                        </td>
                                        <td>
                                            <?php echo e(showDateTime($user->created_at)); ?>

                                        </td>
                                        <td>
                                            <span class="fw-bold">
                                                <?php echo e($general->cur_sym); ?><?php echo e(showAmount($user->balance)); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <?php if(Request::routeIs('admin.instructors.kyc.pending')): ?>
                                                <a title="<?php echo app('translator')->get('Kyc Details'); ?>"
                                                    href="<?php echo e(route('admin.instructors.kyc.details', $user->id)); ?>"
                                                    class="btn btn-sm btn--primary">
                                                    <i class="las la-info-circle text--shadow"></i>
                                                </a>
                                            <?php endif; ?>

                                            <a title="<?php echo app('translator')->get('User Profile'); ?>"
                                                href="<?php echo e(route('admin.instructors.detail', $user->id)); ?>"
                                                class="btn btn-sm btn--primary">
                                                <i class="las la-eye text--shadow"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <?php if($users->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($users)); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
    <div class="d-flex flex-wrap justify-content-end">
        <form action="" method="GET" class="form-inline">
            <div class="input-group justify-content-end">
                <input type="text" name="search" class="form-control bg--white" placeholder="<?php echo app('translator')->get('Search by Username'); ?>"
                    value="<?php echo e(request()->search); ?>">
                <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/instructors/list.blade.php ENDPATH**/ ?>