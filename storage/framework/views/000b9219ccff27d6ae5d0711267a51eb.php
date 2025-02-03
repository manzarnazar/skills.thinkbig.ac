<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.users.active') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.users.active')); ?>"><?php echo app('translator')->get('Active'); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.users.banned') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.users.banned')); ?>"><?php echo app('translator')->get('Banned'); ?>
                    <?php if($bannedUsersCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($bannedUsersCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.users.email.unverified') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.users.email.unverified')); ?>"><?php echo app('translator')->get('Email Unverified'); ?>
                    <?php if($emailUnverifiedUsersCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($emailUnverifiedUsersCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.users.mobile.unverified') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.users.mobile.unverified')); ?>"><?php echo app('translator')->get('Mobile Unverified'); ?>
                    <?php if($mobileUnverifiedUsersCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($mobileUnverifiedUsersCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.users.kyc.unverified') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.users.kyc.unverified')); ?>"><?php echo app('translator')->get('Kyc Unverified'); ?>
                    <?php if($kycUnverifiedUsersCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($kycUnverifiedUsersCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.users.kyc.pending') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.users.kyc.pending')); ?>"><?php echo app('translator')->get('Kyc Pending'); ?>
                    <?php if($kycPendingUsersCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($kycPendingUsersCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.users.with.balance') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.users.with.balance')); ?>"><?php echo app('translator')->get('With Balance'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.users.all') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.users.all')); ?>"><?php echo app('translator')->get('All Students'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.subscriber.index') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.subscriber.index')); ?>"><?php echo app('translator')->get('Subscribers'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.users.notification.all') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.users.notification.all')); ?>"><?php echo app('translator')->get('Notification to Students'); ?>
                </a>
            </li>
        </ul>
    </div>
</div><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/components/tabs/user.blade.php ENDPATH**/ ?>