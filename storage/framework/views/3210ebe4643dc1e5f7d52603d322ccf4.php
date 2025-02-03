<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructors.active') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructors.active')); ?>"><?php echo app('translator')->get('Active'); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructors.banned') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructors.banned')); ?>"><?php echo app('translator')->get('Banned'); ?>
                    <?php if($bannedInstructorsCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($bannedInstructorsCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructors.email.unverified') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructors.email.unverified')); ?>"><?php echo app('translator')->get('Email Unverified'); ?>
                    <?php if($emailUnverifiedInstructorsCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($emailUnverifiedInstructorsCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructors.mobile.unverified') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructors.mobile.unverified')); ?>"><?php echo app('translator')->get('Mobile Unverified'); ?>
                    <?php if($mobileUnverifiedInstructorsCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($mobileUnverifiedInstructorsCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructors.kyc.unverified') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructors.kyc.unverified')); ?>"><?php echo app('translator')->get('Kyc Unverified'); ?>
                    <?php if($kycUnverifiedInstructorsCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($kycUnverifiedInstructorsCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructors.kyc.pending') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructors.kyc.pending')); ?>"><?php echo app('translator')->get('Kyc Pending'); ?>
                    <?php if($kycPendingInstructorsCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($kycPendingInstructorsCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructors.with.balance') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructors.with.balance')); ?>"><?php echo app('translator')->get('With Balance'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructors.all') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructors.all')); ?>"><?php echo app('translator')->get('All Instructors'); ?>
                </a>
            </li>
         
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructors.notification.all') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructors.notification.all')); ?>"><?php echo app('translator')->get('Notification to Instructors'); ?>
                </a>
            </li>
        </ul>
    </div>
</div><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/components/tabs/instructor.blade.php ENDPATH**/ ?>