<?php $__env->startSection('panel'); ?>
<?php echo $__env->make('admin.components.tabs.instructor_ticket', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Subject'); ?></th>
                                <th><?php echo app('translator')->get('Opened By'); ?></th>
                                <th><?php echo app('translator')->get('Priority'); ?></th>
                                <th><?php echo app('translator')->get('Status'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(route('admin.ticket.view', $item->id)); ?>" class="fw-bold text--muted">
                                        <?php echo app('translator')->get('Ticket'); ?>#<?php echo e($item->ticket); ?> - <?php echo e(strLimit($item->subject,30)); ?> </a>
                                </td>

                                <td>
                                    <?php if($item->user_id): ?>
                                    <a href="<?php echo e(route('admin.instructors.detail', $item->user_id)); ?>">
                                        <?php echo e(@$item->instructors->fullname); ?></a>
                                    <?php else: ?>
                                    <p class="fw-bold"> <?php echo e($item->name); ?></p>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($item->priority == 1): ?>
                                    <span class="badge badge--dark"><?php echo app('translator')->get('Low'); ?></span>
                                    <?php elseif($item->priority == 2): ?>
                                    <span class="badge  badge--warning"><?php echo app('translator')->get('Medium'); ?></span>
                                    <?php elseif($item->priority == 3): ?>
                                    <span class="badge badge--danger"><?php echo app('translator')->get('High'); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo $item->statusBadge; ?>
                                </td>
                                <td>
                                    <a title="<?php echo app('translator')->get('Details'); ?>" href="<?php echo e(route('admin.ticket.view', $item->id)); ?>"
                                        class="btn btn-sm btn--primary ms-1">
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
            <?php if($items->hasPages()): ?>
            <div class="card-footer py-4">
                <?php echo e(paginateLinks($items)); ?>

            </div>
            <?php endif; ?>
        </div><!-- card end -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/instructors/support/tickets.blade.php ENDPATH**/ ?>