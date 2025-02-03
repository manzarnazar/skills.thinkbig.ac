
<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('SI'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Image'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><strong><?php echo e(__($category->name)); ?></strong></td>
                                        <td><img class="category_image"
                                                src="<?php echo e(getImage(getFilePath('category') . '/' . $category->image)); ?>"
                                                alt="category_image"></td>

                                        <td>
                                            <?php if($category->status == 1): ?>
                                                <span
                                                    class="text--small badge font-weight-normal badge--success"><?php echo app('translator')->get('Active'); ?></span>
                                            <?php else: ?>
                                                <span
                                                    class="text--small badge font-weight-normal badge--danger"><?php echo app('translator')->get('Pending'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <button title="<?php echo app('translator')->get('Edit'); ?>" href="javascript:void(0)"
                                                    class="btn btn-sm btn--primary ms-1 editButtons"
                                                    data-category="<?php echo e(json_encode($category->only('name', 'image', 'status'))); ?>"
                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-url="<?php echo e(route('admin.category.update', $category->id)); ?>"
                                                    onclick="editButton(this)">
                                                    <i class="la la-pen"></i>
                                                </button>
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


    
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="createModalLabel"> <?php echo app('translator')->get('Add New Category'); ?></h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="las la-times"></i></button>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo e(route('admin.category.store')); ?>"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="modal-body">
                        <div class="row form-group">
                            <label><?php echo app('translator')->get('Category Name'); ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?php echo e(old('name')); ?>" name="name"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Category Image (50x50)'); ?></label>
                            <div class="col-sm-12">
                                <input type="file" name="image" id="images" accept=".png, .jpg, .jpeg"
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <div id="image_preview" class="image_preview-wrapper">

                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label><?php echo app('translator')->get(' Status'); ?></label>
                            <div class="col-sm-12">
                                <select name="status" id="setDefault" class="form-control">
                                    <option value="1"><?php echo app('translator')->get('Active'); ?></option>
                                    <option value="0"><?php echo app('translator')->get('Disable'); ?></option>
                                </select>
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



    
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel"><?php echo app('translator')->get('Edit Category'); ?></h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="las la-times"></i></button>
                </div>
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('put'); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Category Name'); ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="<?php echo e(old('name')); ?>" name="name"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Category Image (50x50)'); ?></label>
                            <div class="col-sm-12">
                                <input type="file" name="image" id="editImages" accept=".png, .jpg, .jpeg .gif"
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

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Status'); ?></label>
                            <div class="col-sm-12">
                                <select name="status" id="setDefault" class="form-control">
                                    <option value="1"><?php echo app('translator')->get('Active'); ?></option>
                                    <option value="0"><?php echo app('translator')->get('Pending'); ?></option>
                                </select>
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
        <a class="btn btn-sm btn--primary me-4" data-bs-toggle="modal" data-bs-target="#createModal"><i
                class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?></a>
        <form method="GET" class="form-inline">
            <div class="input-group justify-content-end">
                <input type="text" name="search" class="form-control bg--white search-color" placeholder="<?php echo app('translator')->get('Search by Username'); ?>"
                    value="<?php echo e(request()->search); ?>">
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
        function editButton(object) {
            var modal = $('#editModal');
            var form = $(modal).find('form');
            var img = $(modal).find('img');

            var category = $(object).data('category');
            var url = $(object).data('url');

            $(modal).find('input[name=name]').val(category.name);
            var status = $(object).data('url');
            var imagePath = "<?php echo e(url('/')); ?>" + '/' + "<?php echo e(getFilePath('category')); ?>" + '/' + category.image;
            img.attr('src', imagePath);
            form.attr('action', url);
        }

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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/categories/log.blade.php ENDPATH**/ ?>