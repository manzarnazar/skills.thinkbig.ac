<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.course.index') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.course.index')); ?>"><?php echo app('translator')->get('My courses'); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.course.instructor') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.course.instructor')); ?>"><?php echo app('translator')->get('Instructor Course'); ?>
                </a>
            </li>

        </ul>
    </div>
</div>
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/components/tabs/course.blade.php ENDPATH**/ ?>