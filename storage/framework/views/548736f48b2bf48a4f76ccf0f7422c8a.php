
<?php $__env->startSection('content'); ?>
    <!--=======-** Sign In start **-=======-->
    <?php
        $credentials = gs()->instructor_socialite_credentials;
    ?>
    <!-- login section -->
    <section class="login-section">
        <div class="container-fluid px-0">
            <div class="row mx-0">
                <div class="col-xl-7 col-lg-6 px-0 d-none d-lg-block">
                    <div class="login-left-section bg--img">
                        <span class="login-element1 login-bg-img">
                            <img src="<?php echo e(asset('assets/images/frontend/login/login1.png')); ?>" alt="...">
                        </span>
                        <span class="login-element6">
                            <img src="<?php echo e(asset('assets/images/frontend/login/login5.png')); ?>" alt="...">
                        </span>
                        <span class="login-element7">
                            <img src="<?php echo e(asset('assets/images/frontend/login/login6.png')); ?>" alt="...">
                        </span>
                        <span class="login-element8">
                            <img src="<?php echo e(asset('assets/images/frontend/login/login7.png')); ?>" alt="...">
                        </span>
                        <span class="login-element9">
                            <img src="<?php echo e(asset('assets/images/frontend/login/login6.png')); ?>" alt="...">
                        </span>

                        <div class="content-wrap">
                            <div class="logo-wrap">
                                <a href="<?php echo e(route('home')); ?>"><img
                                        src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="login-image"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-6 px-0">
                    <!-- < sign in components -->
                    <div class="login-box">
                        <h4 class="title"><?php echo app('translator')->get('Welcome Back!'); ?></h4>
                        
                        <div class="d-flex mb-4">
                            <a href="<?php echo e(route('instructor.login')); ?>" class="btn btn--base me-4 <?php echo e(Route::is('instructor.login') ? 'active':'unactive'); ?>"><?php echo app('translator')->get('Instructor Login'); ?></a>
                            <a href="<?php echo e(route('user.login')); ?>" class="btn btn--base <?php echo e(Route::is('user.login') ? 'active':'unactive'); ?>" ><?php echo app('translator')->get('User Login'); ?></a>
                        </div>

                        <form method="POST" action="<?php echo e(route('instructor.login')); ?>" class="verify-gcaptcha">
                            <?php echo csrf_field(); ?>
                            <div class="mb-4 form-group">
                                <label class="mb-2 form--label"><?php echo app('translator')->get('User name'); ?></label>
                                <input class="form--control" placeholder="<?php echo app('translator')->get('Enter UserName Or Email'); ?>" name="username" id="username"
                                    requird>
                            </div>
                            <div class="mb-4 form-group">
                                <label class="mb-2 form--label"><?php echo app('translator')->get('Password'); ?></label>
                                <input class="form--control" type="password" placeholder="<?php echo app('translator')->get('Enter Your Password'); ?>" name="password" id="password"
                                    requird>
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
                            <div class="login-meta mb-4 d-flex" data-wow-delay="0.5s">
                              
                                <div class="col-12">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="form--check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="remember"><?php echo app('translator')->get('Remember Me'); ?></label>
                                        </div>
                                        <a href="{ route('instructor.password.request') }}" class="forgot-password"><?php echo app('translator')->get('Forgot Your Password?'); ?></a>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" id="recaptcha" class="btn btn--base  w-100">
                                <?php echo app('translator')->get('Login'); ?></button>
                            <div class="social-option">
                            
                                <?php if(
                                    @$credentials->google?->status == 1 ||
                                        @$credentials->facebook?->status == 1 ||
                                        @$credentials->linkedin?->status == 1): ?>
                                    <ul>
                                        <?php if(@$credentials->google?->status == 1): ?>
                                            <li>
                                                <a href="<?php echo e(route('user.social.login', 'facebook')); ?>" class="icon">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(@$credentials->facebook?->status == 1): ?>
                                            <li>
                                                <a href="<?php echo e(route('user.social.login', 'google')); ?>" class="icon">
                                                    <i class="fa-brands fa-google"></i>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(@$credentials->linkedin?->status == 1): ?>
                                            <li>
                                                <a href="<?php echo e(route('user.social.login', 'Linkedin')); ?>" class="icon">
                                                    <i class="fa-brands fa-linkedin"></i>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                                <p><?php echo app('translator')->get('Already have an account ? '); ?><a href="<?php echo e(route('instructor.register')); ?>"> <?php echo app('translator')->get('Register'); ?></a></p>
                            </div>
                        </form>
                    </div>
                    <!-- sign in components /> -->
                </div>
            </div>
        </div>
    </section>
    <!--=======-** Sign In End **-=======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/skills.thinkbig.ac/application/resources/views/presets/default/instructor/auth/login.blade.php ENDPATH**/ ?>