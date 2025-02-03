<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.report.transaction') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.report.transaction')); ?>"><?php echo app('translator')->get('User'); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructor.report.transaction') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructor.report.transaction')); ?>"><?php echo app('translator')->get('Instructor'); ?>
                </a>
            </li>

        </ul>
    </div>
</div>
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/components/tabs/transaction.blade.php ENDPATH**/ ?>