<?php
    $contactSection = getContent('contact.content', true);
?>


<?php $__env->startSection('content'); ?>
    <?php echo $__env->make($activeTemplate . '/components/breadcumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- ==================== Contact Form & Map Start ==================== -->
    <section class="contact-section bg--white pb-100">
        <div class="container">
            <div class="row get-in-touch justify-content-center gy-4">
                <div class="col-lg-5 m-0">
                    <div class="contact-card card-left">
                        <div class="contact-right-side">
                            <h1 class="title"><?php echo e(__(@$contactSection->data_values?->title)); ?></h1>
                            <ul>
                                <li>
                                    <div class="icon-wrap">
                                        <i class="fa-solid fa-phone-volume"></i>
                                    </div>
                                    <div class="content-wrap">
                                        <p class="title"><?php echo app('translator')->get('Call Us At'); ?></p>
                                        <a>
                                            <h6><?php echo e(__(@$contactSection->data_values?->mobile)); ?></h6>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-wrap">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </div>
                                    <div class="content-wrap">
                                        <p class="title"><?php echo app('translator')->get('Email US ON'); ?></p>
                                        <a>
                                            <h6><?php echo e(__(@$contactSection->data_values?->email)); ?></h6>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-wrap">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="content-wrap">
                                        <p class="title"><?php echo app('translator')->get('Find US'); ?></p>
                                        <a>
                                            <h6><?php echo e(__(@$contactSection->data_values?->location)); ?></h6>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <div class="description"><?php echo (__(@$contactSection->data_values?->short_description))?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class=" contact-card wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                        <form method="post" autocomplete="off" class="verify-gcaptcha">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4 form-group">
                                        <label class="mb-3 form--label"><?php echo app('translator')->get('Name'); ?></label>
                                        <input class="form--control" name="name" placeholder="<?php echo app('translator')->get('Name'); ?>"
                                            value="<?php if(auth()->user()): ?><?php echo e(auth()->user()->fullname); ?><?php else: ?><?php echo e(old('name')); ?><?php endif; ?>"
                                            <?php if(auth()->user()): ?> readonly <?php endif; ?> required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4 form-group">
                                        <label class="mb-3 form--label"><?php echo app('translator')->get('Email'); ?></label>
                                        <input class="form--control" placeholder="<?php echo app('translator')->get('Email'); ?>"
                                            name="email" value="<?php if(auth()->user()): ?><?php echo e(auth()->user()->email); ?><?php else: ?><?php echo e(old('email')); ?><?php endif; ?>"<?php if(auth()->user()): ?> readonly <?php endif; ?>
                                            required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-4 form-group">
                                        <label class="mb-3 form--label"><?php echo app('translator')->get('Subject'); ?></label>
                                        <input class="form--control" placeholder="<?php echo app('translator')->get('Subject'); ?>" name="subject"
                                            value="<?php echo e(old('subject')); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 form-group">
                                <label class="mb-3 form--label"><?php echo app('translator')->get('Message'); ?></label>
                                <textarea class="form--control" name="message" placeholder="<?php echo app('translator')->get('Type message'); ?>"></textarea>
                            </div>
                            <?php if (isset($component)) { $__componentOriginalff0a9fdc5428085522b49c68070c11d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff0a9fdc5428085522b49c68070c11d6 = $attributes; } ?>
<?php $component = App\View\Components\Captcha::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Captcha::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $attributes = $__attributesOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $component = $__componentOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__componentOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>
                            <button class="btn btn--base-3 w-100"><?php echo e(@$contactSection->data_values?->button_name); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Contact Form & Map End ==================== -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/skills.thinkbig.ac/application/resources/views/presets/default/contact.blade.php ENDPATH**/ ?>