<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.gateway.automatic.index') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.gateway.automatic.index')); ?>"><?php echo app('translator')->get('Automatic Gateways'); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.gateway.manual.index') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.gateway.manual.index')); ?>"><?php echo app('translator')->get('Manual Gateways'); ?></a>
            </li>
        </ul>
    </div>
</div><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/components/tabs/gateway.blade.php ENDPATH**/ ?>