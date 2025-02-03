

<?php $__env->startSection('panel'); ?>
    <?php echo $__env->make('admin.components.tabs.deposit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row justify-content-center gy-4">
        <?php if(request()->routeIs('admin.deposit.list') ||
                request()->routeIs('admin.deposit.method') ||
                request()->routeIs('admin.users.deposits') ||
                request()->routeIs('admin.users.deposits.method')): ?>
            <div class="col-lg-12 mt-5">
                <div class="row gy-4">
                    <div class="col-xxl-3 col-sm-6">
                        <a href="<?php echo e(route('admin.deposit.successful')); ?>">
                            <div class="card prod-p-card background-pattern-white bg--primary">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-0">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white"><?php echo app('translator')->get('Successful Payments'); ?></h6>
                                            <h3 class="m-b-0 text-white">
                                                <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($successful)); ?>

                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <a href="<?php echo e(route('admin.deposit.pending')); ?>">
                            <div class="card prod-p-card background-pattern-white bg--white">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-0">
                                        <div class="col">
                                            <h6 class="m-b-5"><?php echo app('translator')->get('Pending Payments'); ?></h6>
                                            <h3 class="m-b-0"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($pending)); ?>

                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <a href="<?php echo e(route('admin.deposit.rejected')); ?>">
                            <div class="card prod-p-card background-pattern-white bg--primary">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-0">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white"><?php echo app('translator')->get('Rejected Payments'); ?></h6>
                                            <h3 class="m-b-0 text-white">
                                                <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($rejected)); ?>

                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <a href="<?php echo e(route('admin.deposit.initiated')); ?>">
                            <div class="card prod-p-card background-pattern-white">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-0">
                                        <div class="col">
                                            <h6 class="m-b-5"><?php echo app('translator')->get('Initiated Payments'); ?></h6>
                                            <h3 class="m-b-0"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($initiated)); ?>

                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-md-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Gateway'); ?></th>
                                    <th><?php echo app('translator')->get('Transaction'); ?></th>
                                    <th><?php echo app('translator')->get('User'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Conversion'); ?></th>
                                    <th><?php echo app('translator')->get('Created at'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $details = $deposit->detail ? json_encode($deposit->detail) : null;
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold"> <a
                                                    href="<?php echo e(appendQuery('method', @$deposit->gateway->alias)); ?>"><?php echo e(__(@$deposit->gateway->name)); ?></a>
                                            </span>
                                        </td>

                                        <td>
                                            <?php echo e($deposit->trx); ?>

                                        </td>
                                        <td>
                                            <a class="text-muted"
                                                href="<?php echo e(appendQuery('search', @$deposit->user->username)); ?>"><?php echo e(@$deposit->user->fullname); ?></a>
                                        </td>
                                        <td>
                                            <strong title="<?php echo app('translator')->get('Amount with charge'); ?>">
                                                <?php echo e(showAmount($deposit->amount + $deposit->charge)); ?>

                                                <?php echo e(__($general->cur_text)); ?>

                                            </strong>
                                        </td>
                                        <td>
                                            <strong><?php echo e(showAmount($deposit->final_amo)); ?>

                                                <?php echo e(__($deposit->method_currency)); ?></strong>
                                        </td>
                                        <td>
                                            <?php echo e(showDateTime($deposit->created_at)); ?>

                                        </td>
                                        <td>
                                            <?php echo $deposit->statusBadge ?>
                                        </td>
                                        <td>
                                            <a title="<?php echo app('translator')->get('Details'); ?>"
                                                href="<?php echo e(route('admin.deposit.details', $deposit->id)); ?>"
                                                class="btn btn-sm btn--primary ms-1">
                                                <i class="la la-eye"></i>
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
                <?php if($deposits->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo paginateLinks($deposits) ?>
                    </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if(!request()->routeIs('admin.users.deposits') && !request()->routeIs('admin.users.deposits.method')): ?>
        <form action="" method="GET">
            <div class="form-inline float-sm-end ms-0 ms-xl-2 ms-lg-0">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg--white" placeholder="<?php echo app('translator')->get('Search by Username or Trx'); ?>"
                        value="<?php echo e(request()->search ?? ''); ?>">
                    <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .nav-tabs {
            border: 0;
        }

        .nav-tabs li a {
            border-radius: 4px !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/deposit/log.blade.php ENDPATH**/ ?>