
<?php $__env->startSection('panel'); ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card b-radius--10 ">
            <div class="card-header text-right">
                <?php echo app('translator')->get('Main Pages'); ?> <button type="button" class="btn btn-sm btn--primary addBtn"><i class="las la-plus"></i><?php echo app('translator')->get('Add
                    New'); ?></button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Name'); ?></th>
                                <th><?php echo app('translator')->get('Slug'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $pdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(__($data->name)); ?></td>
                                <td><?php echo e(__($data->slug)); ?></td>
                                <td>
                                    <div class="button--group">
                                        <a title="<?php echo app('translator')->get('Edit'); ?>"
                                            href="<?php echo e(route('admin.frontend.manage.section', $data->id)); ?>"
                                            class="btn btn-sm btn--primary"><i class="la la-pen"></i>
                                        </a>
                                        <?php if($data->is_default == 0): ?>
                                        <button title="<?php echo app('translator')->get('Delete'); ?>" class="btn btn-sm btn--danger confirmationBtn"
                                            data-action="<?php echo e(route('admin.frontend.manage.pages.delete',$data->id)); ?>"
                                            data-question="<?php echo app('translator')->get('Are you sure to remove this page?'); ?>">
                                            <i class="las la-trash"></i>
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
    <div class="col-lg-6">
        <div class="card b-radius--10 ">
            <div class="card-header text-right">
                <?php echo app('translator')->get('Policy Pages'); ?> <a href="<?php echo e(route('admin.frontend.sections.element',$key)); ?>" class="btn btn-sm btn--primary"><i
                    class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?></a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('SL'); ?></th>
                                <?php if(@$section->element->images): ?>
                                <th><?php echo app('translator')->get('Image'); ?></th>
                                <?php endif; ?>
                                <?php $__currentLoopData = $section->element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($k !='modal'): ?>
                                <?php if($type=='text' || $type=='icon'): ?>
                                <th><?php echo e(__(keyToTitle($k))); ?></th>
                                <?php elseif($k == 'select'): ?>
                                <th><?php echo e(keyToTitle(@$section->element->$k->name)); ?></th>
                                <?php endif; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <td>1</td>
                                <td><?php echo app('translator')->get('Cookie Policy'); ?></td>
                                <td><a title="<?php echo app('translator')->get('Edit'); ?>"
                                    href="<?php echo e(route('admin.setting.cookie')); ?>"
                                    class="btn btn-sm btn--primary"><i class="la la-pencil-alt"></i>
                                </a></td>
                            </tr>
                            <?php $__empty_1 = true; $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loop->iteration + 1); ?></td>
                                <?php if(@$section->element->images): ?>
                                <?php $firstKey = collect($section->element->images)->keys()[0]; ?>
                                <td>
                                    <div class="customer-details d-block">
                                        <a href="javascript:void(0)" class="thumb">
                                            <img src="<?php echo e(getImage('assets/images/frontend/' . $key .'/'. @$data->data_values->$firstKey,@$section->element->images->$firstKey->size)); ?>"
                                                alt="<?php echo app('translator')->get('image'); ?>">
                                        </a>
                                    </div>
                                </td>
                                <?php endif; ?>
                                <?php $__currentLoopData = $section->element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($k !='modal'): ?>
                                <?php if($type == 'text' || $type == 'icon'): ?>
                                <?php if($type == 'icon'): ?>
                                <td><?php echo @$data->data_values->$k; ?></td>
                                <?php else: ?>
                                <td><?php echo e(__(@$data->data_values->$k)); ?></td>
                                <?php endif; ?>
                                <?php elseif($k == 'select'): ?>
                                <?php
                                $dataVal = @$section->element->$k->name;
                                ?>
                                <td><?php echo e(@$data->data_values->$dataVal); ?></td>
                                <?php endif; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <td>
                                    <div class="button--group">
                                        <?php if($section->element->modal): ?>
                                        <?php
                                        $images = [];
                                        if(@$section->element->images){
                                        foreach($section->element->images as $imgKey => $imgs){
                                        $images[] = getImage('assets/images/frontend/' . $key .'/'.
                                        @$data->data_values->$imgKey,@$section->element->images->$imgKey->size);
                                        }
                                        }
                                        ?>
                                        <button title="<?php echo app('translator')->get('Edit'); ?>" class="btn btn-sm btn--primary updateBtn"
                                            data-id="<?php echo e($data->id); ?>" data-all="<?php echo e(json_encode($data->data_values)); ?>"
                                            <?php if(@$section->element->images): ?>
                                            data-images="<?php echo e(json_encode($images)); ?>"
                                            <?php endif; ?>>
                                            <i class="la la-pencil-alt"></i>
                                        </button>
                                        <?php else: ?>
                                        <a title="<?php echo app('translator')->get('Edit'); ?>"
                                            href="<?php echo e(route('admin.frontend.sections.element',[$key,$data->id])); ?>"
                                            class="btn btn-sm btn--primary"><i class="la la-pencil-alt"></i>
                                        </a>
                                        <?php endif; ?>
                                        <button title="<?php echo app('translator')->get('Remove'); ?>" class="btn btn-sm btn--danger confirmationBtn"
                                            data-action="<?php echo e(route('admin.frontend.remove',$data->id)); ?>"
                                            data-question="<?php echo app('translator')->get('Are you sure to remove this item?'); ?>"><i
                                                class="la la-trash"></i></button>
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


<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <?php echo app('translator')->get('Add New Page'); ?></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="<?php echo e(route('admin.frontend.manage.pages.save')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label> <?php echo app('translator')->get('Page Name'); ?></label>
                        <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label> <?php echo app('translator')->get('Slug'); ?></label>
                        <input type="text" class="form-control" name="slug" value="<?php echo e(old('slug')); ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary btn-global"><?php echo app('translator')->get('Save'); ?></button>
                </div>
            </form>
        </div>
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

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>

<script>
    (function ($) {
        "use strict";

        $('.addBtn').on('click', function () {
            var modal = $('#addModal');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

    })(jQuery);

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/frontend/builder/pages.blade.php ENDPATH**/ ?>