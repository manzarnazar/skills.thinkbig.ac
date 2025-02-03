<!-- ==================== Header End Here ==================== -->
<?php
    $pages = App\Models\Page::where('tempname', $activeTemplate)->get();
?>

<!--========================== Header section Start ==========================-->
<div class="header-main-area <?php echo e(!Route::is('home') ? 'header-two' : ''); ?>">
    <div class="header" id="header">
        <div class="container position-relative">
            <div class="row">
                <div class="header-wrapper">
                    <!-- ham menu -->
                    <i class="fa-sharp fa-solid fa-bars-staggered ham__menu" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"></i>

                    <!-- logo -->
                    <div class="header-menu-wrapper align-items-center d-flex">
                        <div class="logo-wrapper">
                            <a href="<?php echo e(route('home')); ?>" class="normal-logo" id="normal-logo"> <img
                                    src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="...">
                            </a>
                        </div>
                    </div>
                    <!-- / logo -->
                    <div class="menu-right-wrapper">
                        <div class="menu-wrapper">
                            <ul class="main-menu">
                                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($page->name != 'Blog'): ?>
                                        <li class="nav-item">
                                            <a class="<?php echo e(Request::url() == url('/') . '/' . $page->slug ? 'active' : ''); ?>"
                                                href="<?php echo e(route('pages', [$page->slug])); ?>"><?php echo e($page->name); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>

                    <ul class="login d-lg-flex d-none align-items-center gap-3">
                        <li class="language">
                            <div class="language-box">
                                <i class="fa-solid fa-globe"></i>
                                <select class="select langSel">
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($language->code); ?>"
                                            <?php if(Session::get('lang') === $language->code): ?> selected <?php endif; ?>>
                                            <?php echo e(__(ucfirst($language->name))); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </li>

                        <?php if(!auth()->user() && !auth('instructor')->user()): ?>
                            <li class="login-registration-list__item">
                                <a href="<?php echo e(route('user.login')); ?>"><?php echo app('translator')->get('Sign In'); ?><i
                                        class="fa-solid fa-angles-right"></i></a>
                            </li>
                        <?php endif; ?>

                        <?php if(auth()->user()): ?>
                            <li class="login-registration-list__item">
                                <a href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('Dashboard'); ?> </a>
                            </li>
                        <?php endif; ?>

                        <?php if(auth('instructor')->user()): ?>
                            <li class="login-registration-list__item">
                                <a href="<?php echo e(route('instructor.home')); ?>"><?php echo app('translator')->get('Dashboard'); ?> </a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--========================== Header section End ==========================-->

<!--========================== Sidebar mobile menu wrap Start ==========================-->
<div class="offcanvas offcanvas-start text-bg-light" tabindex="-1" id="offcanvasExample">
    <div class="offcanvas-header">
        <div class="logo">
            <div class="header-menu-wrapper align-items-center d-flex">
                <div class="logo-wrapper">
                    <a href="<?php echo e(route('home')); ?>" class="normal-logo" id="offcanvas-logo-normal">
                        <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo_white.png')); ?>" alt="logo">
                    </a>
                </div>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php if(auth()->guard()->check()): ?>
            <div class="user-info">
                <div class="user-thumb">
                    <a href="<?php echo e(route('user.home')); ?>">
                        <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . auth()->user()?->image, getFileSize('userProfile'))); ?>"
                            alt="user-thumb" />
                    </a>

                </div>
                <a href="<?php echo e(route('user.home')); ?>">
                    <h4><?php echo e(auth()->user()->fullname); ?></h4>
                </a>
            </div>
        <?php endif; ?>
        <ul class="side-Nav">
            <li>
                <a class="<?php echo e(Route::is('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a>
            </li>
            <li>
                <a class="<?php echo e(Route::is('categories') ? 'active' : ''); ?>"
                    href="<?php echo e(route('categories')); ?>"><?php echo app('translator')->get('Categories'); ?></a>
            </li>
            <li>
                <a class="<?php echo e(Route::is('course') ? 'active' : ''); ?>"
                    href="<?php echo e(route('course')); ?>"><?php echo app('translator')->get('Course'); ?></a>
            </li>
            <li>
                <a class="<?php echo e(Route::is('blog') ? 'active' : ''); ?>" href="<?php echo e(route('blog')); ?>"><?php echo app('translator')->get('Blog'); ?> </a>
            </li>
            <li>
                <a class="<?php echo e(Route::is('contact') ? 'active' : ''); ?>" href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?>
                </a>
            </li>

            <?php if(auth()->user()): ?>
                <li>
                    <a href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('Dashboard'); ?> </a>
                </li>
            <?php endif; ?>

            <?php if(auth('instructor')->user()): ?>
                <li>
                    <a href="<?php echo e(route('instructor.home')); ?>"><?php echo app('translator')->get('Dashboard'); ?> </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>
                <li>
                    <a href="<?php echo e(route('user.login')); ?>"><?php echo app('translator')->get('Login'); ?> </a>
                </li>
                <li>
                    <a href="<?php echo e(route('user.register')); ?>" class="login-btn"><?php echo app('translator')->get('Signup'); ?></a>
                </li>
            <?php endif; ?>
            <li class="language">
                <div class="language-box side-box">
                    <i class="fa-solid fa-globe"></i>
                    <select class="select langSel">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($language->code); ?>" <?php if(Session::get('lang') === $language->code): ?> selected <?php endif; ?>>
                                <?php echo e(__(ucfirst($language->name))); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </li>
        </ul>
    </div>
</div>

<!--========================== Sidebar mobile menu wrap End ==========================-->
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/presets/default/components/header.blade.php ENDPATH**/ ?>