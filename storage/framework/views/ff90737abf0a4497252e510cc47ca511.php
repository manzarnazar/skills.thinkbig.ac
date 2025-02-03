
<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Image'); ?></th>
                                    <th><?php echo app('translator')->get('Link'); ?></th>
                                    <th><?php echo app('translator')->get('Width'); ?></th>
                                    <th><?php echo app('translator')->get('Height'); ?></th>
                                    <th><?php echo app('translator')->get('Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e(__($item->name)); ?></td>
                                        <td><img src="<?php echo e(getImage(getFilePath('ads') . '/' . @$item->image)); ?>"
                                                alt="<?php echo app('translator')->get('adImage'); ?>" style="width: 50px"></td>
                                        <td><a href="<?php echo e($item->link); ?>"><?php echo e(__(@$item->link)); ?></a></td>
                                        <td><?php echo e(__(@$item->width)); ?></td>
                                        <td><?php echo e(__(@$item->height)); ?></td>

                                        <td>
                                            <div class="button--group">
                                                <a href="<?php echo e(route('admin.ad.edit', @$item->id)); ?>" title="<?php echo app('translator')->get('Edit'); ?>"
                                                    class="btn btn-sm btn--success">
                                                    <i class="la la-edit"></i>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__(@$emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table><!-- table end -->

                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/ad/index.blade.php ENDPATH**/ ?>