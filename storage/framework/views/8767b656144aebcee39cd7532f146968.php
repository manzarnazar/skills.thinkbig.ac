
<?php $__env->startSection('content'); ?>
    <?php if(!auth()->check()): ?>
        <?php echo $__env->make($activeTemplate . '/components/breadcumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <div class="mt-5 container <?php echo e(auth()->user() ? '' : 'mb-5'); ?>">
        <div class="row justify-content-center gy-4">
            <div class="<?php echo e(auth()->user() ? 'col-xl-12 col-lg-12' : 'col-lg-12 mt-4'); ?>">
                <div class="base--card">
                    <div class="dashboard-card-wrap mt-0">
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="view-ticket-head d-flex justify-content-between">
                                    <h5>
                                        <?php echo $myTicket->statusBadge; ?>
                                        [<?php echo app('translator')->get('Ticket'); ?>#<?php echo e($myTicket->ticket); ?>] <?php echo e($myTicket->subject); ?>

                                    </h5>
                                
                                    <?php if($myTicket->status != 3 && $myTicket->user): ?>
                                        <button class="btn button bg--danger btn--sm btn-suuport confirmationBtn border-0"
                                            type="button" data-question="<?php echo app('translator')->get('Are you sure to close this ticket?'); ?>"
                                            data-action="<?php echo e(route('ticket.close', $myTicket->id)); ?>"><i
                                                class="fa fa-lg fa-times-circle"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if($myTicket->status != 4): ?>
                                <form method="post" action="<?php echo e(route('ticket.reply', $myTicket->id)); ?>"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="message" class="form--label"><?php echo app('translator')->get('Message'); ?></label>
                                            <div class="input--group textarea">
                                                <textarea id="message" class="form--control" name="message" placeholder="<?php echo app('translator')->get('Please enter your Message'); ?>"><?php echo e(old('message')); ?> </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 text-end">
                                        <button type="button" class="btn btn--base btn--sm mt-3 addFile">
                                            <i class="fas fa-plus"></i><?php echo app('translator')->get('Add New'); ?>
                                        </button>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="attachment_wrapper mb-4">
                                            <div class="form-group profile mb-15">
                                                <label for="attachments" class="form--label"><?php echo app('translator')->get('Attachments:-'); ?> </label>
                                                <p class="ticket-attachments-message text-muted">
                                                    <?php echo app('translator')->get('Allowed File Extensions'); ?>:<span class="text-danger"> .<?php echo app('translator')->get('jpg'); ?>,
                                                        .<?php echo app('translator')->get('jpeg'); ?>,
                                                        .<?php echo app('translator')->get('png'); ?>, .<?php echo app('translator')->get('pdf'); ?>, .<?php echo app('translator')->get('doc'); ?>,
                                                        .<?php echo app('translator')->get('docx'); ?>
                                                    </span>
                                                </p>
                                                <div class="single-input form-group mt-3 mb-1">
                                                    <input class="form--control" id="attachments" type="file"
                                                        name="attachments[]" id="inputAttachments">
                                                </div>
                                                <div id="fileUploadsContainer"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-end">
                                        <button type="submit" class="btn btn--base"> <i class="fa fa-reply"></i>
                                            <?php echo app('translator')->get('Reply'); ?></button>
                                    </div>
                                </form>
                            <?php endif; ?>
                            <div class="col-lg-12">
                                <div class="support_reply_bottom">
                                    <h4 class="mb-4"><?php echo app('translator')->get('Recent Message'); ?></h4>
                                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($message->admin_id == 0): ?>
                                            <div class="support_reply__single mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4><?php echo app('translator')->get('You'); ?></h4>
                                                        <p class="mb-2">
                                                            <i><?php echo e($message->message); ?></i>
                                                        </p>
                                                        <?php if($message->attachments->count() > 0): ?>
                                                            <div class="mt-2">
                                                                <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <a href="<?php echo e(route('ticket.download', encrypt($image->id))); ?>"
                                                                        class="me-3"><i class="fa fa-file"></i>
                                                                        <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?> </a>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <h6><?php echo e($message->created_at->format('l, dS F Y @ H:i')); ?>

                                                        </h6>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="support_reply__single">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4><?php echo app('translator')->get('Admin'); ?></h4>
                                                        <p class="mb-2">
                                                            <i><?php echo e($message->message); ?></i>
                                                        </p>
                                                        <?php if($message->attachments->count() > 0): ?>
                                                            <div class="mt-2">
                                                                <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <a href="<?php echo e(route('ticket.download', encrypt($image->id))); ?>"
                                                                        class="me-3"><i class="fa fa-file"></i>
                                                                        <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?> </a>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <h6><?php echo e($message->created_at->format('l, dS F Y @ H:i')); ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<?php $__env->startPush('style'); ?>
    <style>
        .input-group-text:focus {
            box-shadow: none !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            var fileAdded = 0;
            $('.addFile').on('click', function() {
                if (fileAdded >= 4) {
                    notify('error', 'You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                    <div class="input-group my-3">
                        <input type="file" name="attachments[]" class="form-control form--control" required />
                        <button class="input-group-text text-white btn--danger remove-btn"><i class="las la-times"></i></button>
                    </div>
                `)
            });
            $(document).on('click', '.remove-btn', function() {
                fileAdded--;
                $(this).closest('.input-group').remove();
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/skills.thinkbig.ac/application/resources/views/presets/default/user/support/view.blade.php ENDPATH**/ ?>