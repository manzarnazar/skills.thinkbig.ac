
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
                                            <?php if($item->status == 1): ?>
                                                <span
                                                    class="text--small badge font-weight-normal badge--success"><?php echo app('translator')->get('Active'); ?></span>
                                            <?php else: ?>
                                                <span
                                                    class="text--small badge font-weight-normal badge--danger"><?php echo app('translator')->get('Pending'); ?></span>
                                            <?php endif; ?>

                                        </td>
                                        <td>

                                            <a class="btn btn-sm btn--primary ms-1"
                                                href="<?php echo e(route('admin.course.edit', $item->id)); ?>"
                                                data-data="<?php echo e(json_encode($item)); ?>"><i class="la la-pen"></i></a>

                                            <a class="btn btn-sm btn--primary ms-1"
                                                href="<?php echo e(route('admin.lesson.courses', $item->id)); ?>"><i
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
                <form action="<?php echo e(route('admin.course.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2"><?php echo app('translator')->get('Title'); ?> </label>
                                    <input class="form-control" name="name" value="" placeholder="Enter a title"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2"><?php echo app('translator')->get('Category'); ?> </label>
                                    <select class="form--control form-select" name="category_id" id="category" required>
                                        <option value="0"><?php echo app('translator')->get('Select One'); ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>"
                                                <?php echo e($item->id == @$course->category_id ? 'selected' : ''); ?>>
                                                <?php echo e(__($item->name)); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2"><?php echo app('translator')->get('Price'); ?> </label>
                                    <input class="form-control" type="number" name="price" value=""
                                        placeholder="Enter a price" min="0" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2"><?php echo app('translator')->get('Discount'); ?> </label>
                                    <input class="form-control" type="number" name="discount" value=""
                                        placeholder="Enter a discount" min="0">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="course-create-image">
                                    <div id="image_preview" class="image_preview-wrapper">

                                    </div>
                                </div>


                                <div>
                                    <label><?php echo app('translator')->get('Category Image (310x210)'); ?></label>
                                    <div class="col-sm-12">
                                        <input type="file" name="image[]" id="images" accept=".png, .jpg, .jpeg"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group d-none edit_image_group">
                                <label><?php echo app('translator')->get('Category Image (50x50)'); ?></label>
                                <div class="col-sm-12">
                                    <input type="file" name="image[]" id="editImages" accept=".png, .jpg, .jpeg .gif"
                                        class="form-control" onchange="imageChange()">
                                </div>

                                <div class="form-group">
                                    <div id="edit_image_preview">
                                        <div class='img-div'>
                                            <img src="" class='img-responsive image img-thumbnail'
                                                title=<?php echo app('translator')->get('Category-image'); ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class=" mb-2"><?php echo app('translator')->get('Status'); ?></label>
                                    <select class="form--control form-select" name="status" id="category" required>
                                        <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                                        <option value="1"><?php echo app('translator')->get('Active'); ?></option>
                                        <option value="0"><?php echo app('translator')->get('Pending'); ?></option>
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
        <a href="<?php echo e(route('admin.course.create')); ?>" class="btn btn-sm btn--primary create_course_category me-3"><i
                class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?></a>
        <form method="GET" class="form-inline">
            <div class="input-group justify-content-end">
                <input type="text" name="search" class="form-control bg--white search-color"
                    placeholder="<?php echo app('translator')->get('Search by Username'); ?>" value="<?php echo e(request()->search); ?>">
                <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        .image_preview-wrapper {
            display: flex;
            flex-wrap: wrap;
        }

        .img-div {
            position: relative;
            width: 150px;

            margin-right: 5px;
            margin-left: 5px;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: 150px;
            max-width: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .img-div:hover .image {
            opacity: 0.3;
        }

        .img-div:hover .middle {
            opacity: 1;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            $('.select2-auto-tokenize').select2({
                dropdownParent: $('.tag-input'),
                tags: true,
                tokenSeparators: [',']
            });
        })(jQuery);
    </script>

    <script>
        function imageChange() {
            var fileArr = [];
            if (fileArr.length > 0) fileArr = [];
            $('#edit_image_preview').html("");

            var total_file = document.getElementById("editImages").files;
            if (!total_file.length) return;
            for (var i = 0; i < total_file.length; i++) {
                if (total_file[i].size > 1048576) {
                    return false;
                } else {
                    fileArr.push(total_file[i]);
                    $('#edit_image_preview').append("<div class='img-div' id='img-div" + i + "'><img src='" +
                        URL.createObjectURL(event.target.files[i]) +
                        "' class='img-responsive image img-thumbnail'title='" + total_file[i]
                        .name + "'></div>");
                }
            }

            $('body').on('click', '#action-icon', function(evt) {
                var divName = this.value;
                var fileName = $(this).attr('role');
                $(`#${divName}`).remove();

                for (var i = 0; i < fileArr.length; i++) {
                    if (fileArr[i].name === fileName) {
                        fileArr.splice(i, 1);
                    }
                }
                document.getElementById('editImages').files = FileListItem(fileArr);
                evt.preventDefault();
            });

            function FileListItem(file) {
                file = [].slice.call(Array.isArray(file) ? file : arguments)
                for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
                if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
                for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
                return b.files
            }
        }

        $(document).ready(function() {
            "use strict";
            var fileArr = [];
            $("#images").on('change', function() {
                if (fileArr.length > 0) fileArr = [];

                $('#image_preview').html("");
                var total_file = document.getElementById("images").files;
                if (!total_file.length) return;
                for (var i = 0; i < total_file.length; i++) {
                    if (total_file[i].size > 1048576) {
                        return false;
                    } else {
                        fileArr.push(total_file[i]);
                        $('#image_preview').append("<div class='img-div' id='img-div" + i + "'><img src='" +
                            URL.createObjectURL(event.target.files[i]) +
                            "' class='img-responsive image img-thumbnail' title='" + total_file[i]
                            .name + "'><div class='middle'><button id='action-icon' value='img-div" +
                            i + "' class='btn btn-danger' role='" + total_file[i].name +
                            "'><i class='fa fa-trash'></i></button></div></div>");
                    }
                }
            });

            $('body').on('click', '#action-icon', function(evt) {
                var divName = this.value;
                var fileName = $(this).attr('role');
                $(`#${divName}`).remove();

                for (var i = 0; i < fileArr.length; i++) {
                    if (fileArr[i].name === fileName) {
                        fileArr.splice(i, 1);
                    }
                }
                document.getElementById('images').files = FileListItem(fileArr);
                evt.preventDefault();
            });

            function FileListItem(file) {
                file = [].slice.call(Array.isArray(file) ? file : arguments)
                for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
                if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
                for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
                return b.files
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/courses/index.blade.php ENDPATH**/ ?>