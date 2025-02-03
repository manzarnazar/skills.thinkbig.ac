<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.setting.socialite.credentials') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.setting.socialite.credentials')); ?>"><?php echo app('translator')->get('User'); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.setting.instructor.socialite.credentials') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.setting.instructor.socialite.credentials')); ?>"><?php echo app('translator')->get('Instructor'); ?>
                </a>
            </li>

        </ul>
    </div>
</div>
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/components/tabs/socialite.blade.php ENDPATH**/ ?>