

<?php $__env->startSection('panel'); ?>
<?php echo $__env->make('admin.components.tabs.gateway', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">

    <div class="col-lg-12">
        <div class="card b-radius--10 ">

            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Gateway'); ?></th>
                                <th><?php echo app('translator')->get('Status'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $gateways->sortBy('alias'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(__($gateway->name)); ?></td>

                                <td>
                                    <?php if($gateway->status == 1): ?>
                                    <span
                                        class="text--small badge font-weight-normal badge--success"><?php echo app('translator')->get('Enabled'); ?></span>
                                    <?php else: ?>
                                    <span
                                        class="text--small badge font-weight-normal badge--warning"><?php echo app('translator')->get('Disabled'); ?></span>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <div class="button--group">
                                        <a title="<?php echo app('translator')->get('Edit'); ?>"
                                            href="<?php echo e(route('admin.gateway.automatic.edit', $gateway->alias)); ?>"
                                            class="btn btn-sm btn--primary editGatewayBtn">
                                            <i class="la la-pencil"></i>
                                        </a>


                                        <?php if($gateway->status == 0): ?>
                                        <button title="<?php echo app('translator')->get('Enable'); ?>"
                                            class="btn btn-sm btn--success ms-1 confirmationBtn"
                                            data-question="<?php echo app('translator')->get('Are you sure to enable this gateway?'); ?>"
                                            data-action="<?php echo e(route('admin.gateway.automatic.activate',$gateway->code)); ?>">
                                            <i class="la la-check-circle"></i>
                                        </button>
                                        <?php else: ?>
                                        <button title="<?php echo app('translator')->get('Disable'); ?>"
                                            class="btn btn-sm btn--danger ms-1 confirmationBtn"
                                            data-question="<?php echo app('translator')->get('Are you sure to disable this gateway?'); ?>"
                                            data-action="<?php echo e(route('admin.gateway.automatic.deactivate',$gateway->code)); ?>">
                                            <i class="la la-eye-slash"></i>
                                        </button>
                                        <?php endif; ?>
                                    </div>
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
        </div><!-- card end -->
    </div>
</div>

<?php if (isset($component)) { $__componentOriginalbd5922df145d522b37bf664b524be380 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbd5922df145d522b37bf664b524be380 = $attributes; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ConfirmationModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbd5922df145d522b37bf664b524be380)): ?>
<?php $attributes = $__attributesOriginalbd5922df145d522b37bf664b524be380; ?>
<?php unset($__attributesOriginalbd5922df145d522b37bf664b524be380); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbd5922df145d522b37bf664b524be380)): ?>
<?php $component = $__componentOriginalbd5922df145d522b37bf664b524be380; ?>
<?php unset($__componentOriginalbd5922df145d522b37bf664b524be380); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
<div class="d-flex flex-wrap justify-content-end">
    <div class="d-inline">
        <div class="input-group justify-content-end">
            <input type="text" name="search_table" class="form-control bg--white" placeholder="<?php echo app('translator')->get('Search'); ?>...">
            <button class="btn btn--primary input-group-text"><i class="fa fa-search"></i></button>
        </div>
    </div>
</div>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/gateways/automatic/list.blade.php ENDPATH**/ ?>