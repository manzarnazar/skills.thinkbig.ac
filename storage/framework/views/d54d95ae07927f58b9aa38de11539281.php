
<?php $__env->startSection('panel'); ?>
    <?php echo $__env->make('admin.components.tabs.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('User'); ?></th>
                                    <th><?php echo app('translator')->get('Email'); ?></th>
                                    <th><?php echo app('translator')->get('Joined At'); ?></th>
                                   
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('admin.users.detail', $user->id)); ?>"><?php echo e($user->fullname); ?>

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

                                            <?php if(Request::routeIs('admin.users.kyc.pending')): ?>
                                                <a title="<?php echo app('translator')->get('Kyc Details'); ?>"
                                                    href="<?php echo e(route('admin.users.kyc.details', $user->id)); ?>"
                                                    class="btn btn-sm btn--primary">
                                                    <i class="las la-info-circle text--shadow"></i>
                                                </a>
                                            <?php endif; ?>
                                            
                                            <a title="<?php echo app('translator')->get('User Profile'); ?>" href="<?php echo e(route('admin.users.detail', $user->id)); ?>"
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
                <input type="text" name="search" class="form-control bg--white search-color" placeholder="<?php echo app('translator')->get('Search by Username'); ?>"
                    value="<?php echo e(request()->search); ?>">
                <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/users/list.blade.php ENDPATH**/ ?>