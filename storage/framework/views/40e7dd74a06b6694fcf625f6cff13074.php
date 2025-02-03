

<?php $__env->startSection('panel'); ?>
<div class="row">
    <?php echo $__env->make('admin.components.tabs.transaction', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-lg-12">
        <div class="show-filter mb-3 text-end">
            <button type="button" class="btn btn--primary showFilterBtn btn-sm"><i class="las la-filter"></i>
                <?php echo app('translator')->get('Filter'); ?></button>
        </div>
        <div class="card responsive-filter-card mb-4">
            <div class="card-body">
                <form action="">
                    <div class="d-flex flex-wrap gap-4">
                        <div class="flex-grow-1">
                            <label><?php echo app('translator')->get('Transactions number or Username'); ?></label>
                            <input type="text" name="search" value="<?php echo e(request()->search); ?>" class="form-control"
                                placeholder="<?php echo app('translator')->get('Transactions number or Username'); ?>">
                        </div>
                        <div class="flex-grow-1">
                            <label><?php echo app('translator')->get('Remark'); ?></label>
                            <select class="form-control" name="remark">
                                <option value=""><?php echo app('translator')->get('Any'); ?></option>
                                <?php $__currentLoopData = $remarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $remark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($remark->remark); ?>" <?php if(request()->remark == $remark->remark): echo 'selected'; endif; ?>><?php echo e(__(keyToTitle($remark->remark))); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="flex-grow-1">
                            <label><?php echo app('translator')->get('Type'); ?></label>
                            <select name="type" class="form-control">
                                <option value=""><?php echo app('translator')->get('All'); ?></option>
                                <option value="+" <?php if(request()->type == '+'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Plus'); ?></option>
                                <option value="-" <?php if(request()->type == '-'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Minus'); ?></option>
                            </select>
                        </div>
                        <div class="flex-grow-1">
                            <label><?php echo app('translator')->get('Date'); ?></label>
                            <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - "
                                data-language="en" class="datepicker-here form-control" data-position='bottom right'
                                placeholder="<?php echo app('translator')->get('Date from - to'); ?>" autocomplete="off" value="<?php echo e(request()->date); ?>">
                        </div>
                        <div class="flex-grow-1 align-self-end">
                            <button class="btn btn--primary h-40 w-100"><i class="fas fa-check"></i>
                                <?php echo app('translator')->get('Apply'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('User'); ?></th>
                                <th><?php echo app('translator')->get('Transaction number'); ?></th>
                                <th><?php echo app('translator')->get('Date'); ?></th>
                                <th><?php echo app('translator')->get('Amount'); ?></th>
                                <th><?php echo app('translator')->get('Post Balance'); ?></th>
                                <th><?php echo app('translator')->get('Details'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(appendQuery('search',@$trx->user?->username)); ?>"><?php echo e(@$trx->user?->username); ?></a>
                                </td>

                                <td>
                                    <strong><?php echo e(@$trx->trx); ?></strong>
                                </td>

                                <td>
                                    <?php echo e(showDateTime($trx->created_at)); ?>

                                </td>

                                <td class="budget">
                                    <span class="fw-bold">
                                        <?php echo e($trx->trx_type); ?> <?php echo e(showAmount($trx->amount)); ?> <?php echo e($general->cur_text); ?>

                                    </span>
                                </td>

                                <td class="budget">
                                    <?php echo e(showAmount($trx->post_balance)); ?> <?php echo e(__($general->cur_text)); ?>

                                </td>

                                <td><?php echo e(__($trx->details)); ?></td>
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
            <?php if($transactions->hasPages()): ?>
            <div class="card-footer py-4">
                <?php echo e(paginateLinks($transactions)); ?>

            </div>
            <?php endif; ?>
        </div><!-- card end -->
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style-lib'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/datepicker.min.css')); ?>">
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script-lib'); ?>
<script src="<?php echo e(asset('assets/admin/js/datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/datepicker.en.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
<script>
    (function ($) {
        "use strict";
        if (!$('.datepicker-here').val()) {
            $('.datepicker-here').datepicker();
        }
    })(jQuery)
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/reports/transactions.blade.php ENDPATH**/ ?>