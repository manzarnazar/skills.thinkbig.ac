
<?php $__env->startSection('panel'); ?>
    <div class="row">
        <?php echo $__env->make('admin.components.tabs.course', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Image'); ?></th>
                                    <th><?php echo app('translator')->get('Title'); ?></th>
                                    <th><?php echo app('translator')->get('Price'); ?></th>
                                    <th><?php echo app('translator')->get('Discount'); ?></th>
                                    <th><?php echo app('translator')->get('Created at'); ?></th>
                                    <th><?php echo app('translator')->get('Admin Status'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <img class="course_category_image"
                                                src="<?php echo e(getImage(getFilePath('course_image') . '/' . $item->image)); ?>"
                                                alt="category_image">
                                        </td>
                                        <td><strong><?php echo e(__(@$item->name)); ?></strong></td>
                                        <td>
                                            <strong>
                                                <?php echo e($general->cur_sym); ?><?php echo e(__(@$item->price)); ?></strong>
                                        </td>
                                        <td>
                                            <strong>
                                                <?php echo e($general->cur_sym); ?><?php echo e(__(@$item->discount) ?? 'N/A'); ?></strong>
                                        </td>

                                        <td> <?php echo e(showDateTime($item->created_at)); ?> <br>
                                            <?php echo e(diffForHumans($item->created_at)); ?>

                                        </td>

                                        <td>
                                            <?php if($item->admin_status == 1): ?>
                                                <span
                                                    class="text--small badge font-weight-normal badge--success"><?php echo app('translator')->get('Approved'); ?></span>
                                            <?php else: ?>
                                                <span
                                                    class="text--small badge font-weight-normal badge--danger"><?php echo app('translator')->get('Pending'); ?></span>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?php if($item->status == 1): ?>
                                                <span
                                                    class="text--small badge font-weight-normal badge--success"><?php echo app('translator')->get('Active'); ?></span>
                                            <?php else: ?>
                                                <span
                                                    class="text--small badge font-weight-normal badge--danger"><?php echo app('translator')->get('Pending'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="course_category_update">
                                                <a class="btn btn-sm btn--primary ms-1"
                                                    data-url="<?php echo e(route('admin.course.instructor.approved', $item->id)); ?>"
                                                    data-data="<?php echo e(json_encode($item)); ?>"><?php echo app('translator')->get('Approved'); ?></a>
                                            </span>
                                   
                                            <a class="btn btn-sm btn--primary ms-1"
                                                href="<?php echo e(route('admin.lesson.instructor', $item->id)); ?>" title="Course List"><i
                                                    class="la la-list-ul"></i></a>
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
                <?php if($courses->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo paginateLinks($courses) ?>
                    </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('Add Course Category'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class=" mb-2"><?php echo app('translator')->get('Status'); ?></label>
                                    <select class="form--control form-select" name="admin_status" id="category" required>
                                        <option value="1"><?php echo app('translator')->get('Approve'); ?></option>
                                        <option value="0"><?php echo app('translator')->get('Reject'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary btn-global" id="btn-save"
                            value="add"><?php echo app('translator')->get('Save'); ?></button>
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
    <div class="d-flex flex-wrap justify-content-end align-items-center">
        <form method="GET" class="form-inline">
            <div class="input-group justify-content-end">
                <input type="text" name="search" class="form-control bg--white search-color" placeholder="<?php echo app('translator')->get('Search by Username'); ?>"
                    value="<?php echo e(request()->search); ?>">
                <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
<?php $__env->stopPush(); ?>



<?php $__env->startPush('script'); ?>

    <script>
        $('.course_category_update').on('click', function() {
            var modal = $('#exampleModal');
            var modalTitle = modal.find('.modal-title').text('<?php echo app('translator')->get('Approved Course Category'); ?>');
            var url = $(this).children().data('url');
            var data = $(this).children().data('data');
            modal.find('form').attr('action', url);
            modal.find('select[name="admin_status"]').val(data.admin_status);
            modal.find('form').find('button[type="submit"]').text('<?php echo app('translator')->get('Save'); ?>');
            modal.modal('show');
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/courses/instructor.blade.php ENDPATH**/ ?>