<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.deposit.list') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.deposit.list')); ?>"><?php echo app('translator')->get('All'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.deposit.approved') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.deposit.approved')); ?>"><?php echo app('translator')->get('Approved'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.deposit.pending') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.deposit.pending')); ?>"><?php echo app('translator')->get('Pending'); ?>
                    <?php if($pendingDepositsCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($pendingDepositsCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.deposit.successful') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.deposit.successful')); ?>"><?php echo app('translator')->get('Successful'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.deposit.rejected') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.deposit.rejected')); ?>"><?php echo app('translator')->get('Rejected'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.deposit.initiated') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.deposit.initiated')); ?>"><?php echo app('translator')->get('Initiated'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.gateway.automatic.index') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.gateway.automatic.index')); ?>"><?php echo app('translator')->get('Payment Gateways'); ?>
                </a>
            </li>
        </ul>
    </div>
</div><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/components/tabs/deposit.blade.php ENDPATH**/ ?>