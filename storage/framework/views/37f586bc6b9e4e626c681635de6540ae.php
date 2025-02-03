
<?php $__env->startSection('panel'); ?>
<div class="row">
    <?php echo $__env->make('admin.components.tabs.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('User'); ?></th>
                                <th><?php echo app('translator')->get('Sent'); ?></th>
                                <th><?php echo app('translator')->get('Sender'); ?></th>
                                <th><?php echo app('translator')->get('Subject'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <?php if($log->user): ?>
                                    <a href="<?php echo e(route('admin.users.detail', $log->user_id)); ?>"><?php echo e($log->user->fullname); ?></a>
                                    <?php else: ?>
                                    <span class="fw-bold"><?php echo app('translator')->get('System'); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e(showDateTime($log->created_at)); ?>

                                </td>
                                <td>
                                    <span class="fw-bold"><?php echo e(__($log->sender)); ?></span>
                                </td>
                                <td><?php echo e(__($log->subject)); ?></td>
                                <td>
                                    <button title="<?php echo app('translator')->get('Details'); ?>" class="btn btn-sm btn--primary notifyDetail"
                                        data-type="<?php echo e($log->notification_type); ?>" <?php if($log->notification_type ==
                                        'email'): ?> data-message="<?php echo e(route('admin.report.email.details',$log->id)); ?>" <?php else: ?>
                                        data-message="<?php echo e($log->message); ?>" <?php endif; ?> data-sent_to="<?php echo e($log->sent_to); ?>"
                                        target="_blank"><i class="las la-eye"></i></button>
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
            <?php if($logs->hasPages()): ?>
            <div class="card-footer py-4">
                <?php echo e(paginateLinks($logs)); ?>

            </div>
            <?php endif; ?>
        </div><!-- card end -->
    </div>
</div>


<div class="modal fade" id="notifyDetailModal" tabindex="-1" aria-labelledby="notifyDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notifyDetailModalLabel"><?php echo app('translator')->get('Notification Details'); ?></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="las la-times"></i></button>
            </div>
            <div class="modal-body">
                <h3 class="text-center mb-3"><?php echo app('translator')->get('To'); ?>: <span class="sent_to"></span></h3>
                <div class="detail"></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
<?php if(@$user): ?>
<a href="<?php echo e(route('admin.users.notification.single',$user->id)); ?>" class="btn btn--primary btn-sm"><i
        class="las la-paper-plane"></i> <?php echo app('translator')->get('Send Notification'); ?></a>
<?php else: ?>
<form action="" method="GET" class="form-inline float-sm-end">
    <div class="input-group">
        <input type="text" name="search" class="form-control bg--white" placeholder="<?php echo app('translator')->get('Search Username'); ?>"
            value="<?php echo e(request()->search); ?>">
        <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
    </div>
</form>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
    $('.notifyDetail').on('click', function () {
        var message = $(this).data('message');
        var sent_to = $(this).data('sent_to');
        var modal = $('#notifyDetailModal');
        if ($(this).data('type') == 'email') {
            var message = `<iframe src="${message}" height="500" width="100%" title="Iframe Example"></iframe>`
        }
        $('.detail').html(message)
        $('.sent_to').text(sent_to)
        modal.modal('show');
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/reports/notification_history.blade.php ENDPATH**/ ?>