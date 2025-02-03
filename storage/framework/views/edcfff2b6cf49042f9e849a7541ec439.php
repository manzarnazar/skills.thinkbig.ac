
<?php $__env->startSection('content'); ?>
    <?php
        $policyPages = getContent('policy_pages.element', false, null, true);
        $credentials = gs()->socialite_credentials;
    ?>

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
                        <div class="close--btn">
                            <div class="wrap">
                                <a href="index.html"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                        </div>
                        <h4 class="title"><?php echo app('translator')->get('Create Your Account'); ?></h4>
                        <form action="<?php echo e(route('user.register')); ?>" class="verify-gcaptcha" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="mb-4 form-group">
                                <small class="text-danger usernameExist"></small>
                                <label for="username" class="mb-2 form--label"><?php echo app('translator')->get('User Name'); ?></label>
                                <input type="text" class="form--control checkUser" id="username"
                                    placeholder="<?php echo app('translator')->get('User Name'); ?>" name="username" value="<?php echo e(old('username')); ?>" required>
                            </div>

                            <div class="mb-4 form-group">
                                <small class="text-danger emailExist"></small>
                                <label for="email" class="mb-2 form--label"><?php echo app('translator')->get('Email'); ?></label>
                                <input type="text" class="form--control" id="email" placeholder="<?php echo app('translator')->get('Email'); ?>"
                                    name="email" value="<?php echo e(old('email')); ?>">
                            </div>


                            <div class="mb-4 form-group">
                                <label class="mb-2 form--label"><?php echo app('translator')->get('Country'); ?></label>
                                <div class="col-sm-12">
                                    <select class="form--control form-select" name="country">
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-mobile_code="<?php echo e($country->dial_code); ?>"
                                                value="<?php echo e($country->country); ?>" data-code="<?php echo e($key); ?>">
                                                <?php echo e(__($country->country)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4 form-group">
                                <label for="mobile" class="mb-2 form--label required"><?php echo app('translator')->get('Mobile Number'); ?></label>
                                <div class="input-group">
                                    <span class="input-group-text bg--base text-white b-none mobile-code">
                                    </span>
                                    <input type="hidden" name="mobile_code">
                                    <input type="hidden" name="country_code">
                                    <input type="number" id="mobile"
                                        class="form--control form-control form--control checkUser" placeholder="Phone"
                                        name="mobile" value="<?php echo e(old('mobile')); ?>"
                                        aria-label="Dollar amount (with dot and two decimal places)" required>
                                </div>
                                <small class="text-danger mobileExist"></small>
                            </div>

                            <div class="mb-4 form-group">
                                <label for="your-password" class="mb-2 form--label"><?php echo app('translator')->get('Password'); ?></label>
                                <div class="input-group">
                                    <input id="your-password" type="password" class="form-control form--control"
                                        name="password" placeholder="Password" required>
                                    <?php if($general->secure_password): ?>
                                        <div class="input-popup">
                                            <p class="error lower"><?php echo app('translator')->get('1 small letter minimum'); ?></p>
                                            <p class="error capital"><?php echo app('translator')->get('1 capital letter minimum'); ?></p>
                                            <p class="error number"><?php echo app('translator')->get('1 number minimum'); ?></p>
                                            <p class="error special"><?php echo app('translator')->get('1 special character minimum'); ?></p>
                                            <p class="error minimum"><?php echo app('translator')->get('6 character password'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="password-show-hide toggle-password-change fas fa-eye-slash"
                                        data-target="your-password"> </div>
                                </div>
                            </div>

                            <div class="mb-4 form-group">
                                <label for="confirm-password" class="mb-2 form--label"><?php echo app('translator')->get('Confirm Password'); ?></label>
                                <div class="input-group">
                                    <input id="confirm-password" type="password" class="form-control form--control"
                                        name="password_confirmation" placeholder="Confirm Password" required>
                                    <div class="password-show-hide toggle-password-change fas fa-eye-slash"
                                        data-target="confirm-password"> </div>
                                </div>
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
                            <?php if($general->agree): ?>
                                <div class="mb-4 form-group">
                                    <div class="form--check">
                                        <input class="form-check-input" type="checkbox" id="agree"
                                            <?php if(old('agree')): echo 'checked'; endif; ?> name="agree" required>
                                        <div class="form-check-label">
                                            <label>
                                                <?php echo app('translator')->get('I agree with'); ?> <?php $__currentLoopData = $policyPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('policy.pages', [slug($policy->data_values->title), $policy->id])); ?>"
                                                        class="text--base"><?php echo e(__($policy->data_values->title)); ?></a>
                                                    <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <button type="submit" id="recaptcha" class="btn btn--base w-100">
                                <?php echo app('translator')->get('Sign Up'); ?></button>
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
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                                <p><?php echo app('translator')->get('Already have an account ? '); ?><a href="<?php echo e(route('user.login')); ?>"> <?php echo app('translator')->get('Login'); ?></a></p>
                            </div>
                        </form>
                    </div>
                    <!-- sign in components /> -->
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle"><?php echo app('translator')->get('You are with us'); ?></h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center"><?php echo app('translator')->get('You already have an account please Login '); ?></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn-sm"
                        data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <a href="<?php echo e(route('user.login')); ?>" class="btn btn--base btn-sm"><?php echo app('translator')->get('Login'); ?></a>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        .country-code .input-group-text {
            background: #fff !important;
        }

        .country-code select {
            border: none;
        }

        .country-code select:focus {
            border: none;
            outline: none;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/common/js/secure_password.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function($) {
            <?php if($mobileCode): ?>
                $(`option[data-code=<?php echo e($mobileCode); ?>]`).attr('selected', '');
            <?php endif; ?>

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            <?php if($general->secure_password): ?>
                $('input[name=password]').on('input', function() {
                    secure_password($(this));
                });

                $('[name=password]').focus(function() {
                    $(this).closest('.form-group').addClass('hover-input-popup');
                });

                $('[name=password]').focusout(function() {
                    $(this).closest('.form-group').removeClass('hover-input-popup');
                });
            <?php endif; ?>

            $('.checkUser').on('focusout', function(e) {
                var url = '<?php echo e(route('user.checkUser')); ?>';
                var value = $(this).val();
                var token = '<?php echo e(csrf_token()); ?>';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/skills.thinkbig.ac/application/resources/views/presets/default/user/auth/register.blade.php ENDPATH**/ ?>