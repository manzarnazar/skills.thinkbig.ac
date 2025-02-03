<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.report.notification.history') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.report.notification.history')); ?>"><?php echo app('translator')->get('User'); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructor.report.notification.history') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructor.report.notification.history')); ?>"><?php echo app('translator')->get('Instructor'); ?>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/components/tabs/notification.blade.php ENDPATH**/ ?>