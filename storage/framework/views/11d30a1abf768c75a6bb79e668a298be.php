<div class="sidebar">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar__main-logo"><img
                    src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.dashboard')); ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link ">
                        <i class="menu-icon las la-chart-line"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Dashboard'); ?></span>
                    </a>
                </li>
                <li class="sidebar__menu-header"><?php echo app('translator')->get('Users Management'); ?></li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.users.*')); ?>">
                    <a href="<?php echo e(route('admin.users.active')); ?>" class="nav-link ">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title"><?php echo app('translator')->get('All Students'); ?></span>
                        <?php if($bannedUsersCount > 0 || $emailUnverifiedUsersCount > 0 || $mobileUnverifiedUsersCount > 0): ?>
                            <div class="blob white"></div>
                        <?php endif; ?>
                    </a>
                </li>


                <li class="sidebar__menu-header"><?php echo app('translator')->get('Instructors Management'); ?></li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.instructors.*')); ?>">
                    <a href="<?php echo e(route('admin.instructors.active')); ?>" class="nav-link ">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title"><?php echo app('translator')->get('All Instructors'); ?></span>
                        <?php if($bannedUsersCount > 0 || $emailUnverifiedUsersCount > 0 || $mobileUnverifiedUsersCount > 0): ?>
                            <div class="blob white"></div>
                        <?php endif; ?>
                    </a>
                </li>

                <li class="sidebar__menu-header"><?php echo app('translator')->get('Category Management'); ?></li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.category.*')); ?>">
                    <a href="<?php echo e(route('admin.category.all')); ?>" class="nav-link ">
                        <i class="menu-icon  las la-boxes"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Categories'); ?></span>
                    </a>
                </li>

                <li class="sidebar__menu-header"><?php echo app('translator')->get('Zoom Credentials Management'); ?></li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.credential.*')); ?>">
                    <a href="<?php echo e(route('admin.zoom.credential')); ?>" class="nav-link ">
                        <i class="menu-icon  las la-key"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Zoom Credentials'); ?></span>
                    </a>
                </li>

                <li class="sidebar__menu-header"><?php echo app('translator')->get('Course & Course Category Management'); ?></li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.course.*')); ?>">
                    <a href="<?php echo e(route('admin.course.index')); ?>" class="nav-link ">
                        <i class="menu-icon  las la-copy"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Courses'); ?></span>
                    </a>
                </li>
           
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.lesson.create.')); ?>">
                    <a href="<?php echo e(route('admin.lesson.create')); ?>" class="nav-link ">
                        <i class="menu-icon  las la-book"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Add Lessons'); ?></span>
                    </a>
                </li>
                <li class="sidebar__menu-header"><?php echo app('translator')->get('Quizzes'); ?></li> 
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.quiz.index.')); ?>">
                    <a href="<?php echo e(route('admin.quiz.index')); ?>" class="nav-link ">
                        <i class="menu-icon  las la-book"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Quizzes'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.certificate.*', 3)); ?>">
                        <i class="menu-icon las la-certificate"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Certificates'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.certificate*', 2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.certificate.edit')); ?> ">
                                <a href="<?php echo e(route('admin.certificate.edit')); ?>" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Certificate Template'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.certificate.all')); ?> ">
                                <a href="<?php echo e(route('admin.certificate.all')); ?>" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('All Certificate'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="sidebar__menu-header"><?php echo app('translator')->get('Ad Management'); ?></li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.ad.index')); ?>">
                    <a href="<?php echo e(route('admin.ad.index')); ?>" class="nav-link ">
                        <i class="menu-icon lab la-adn"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Ads'); ?></span>
                    </a>
                </li>

                <li class="sidebar__menu-header"><?php echo app('translator')->get('Socialite Credential'); ?></li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.socialite.credentials')); ?>">
                    <a href="<?php echo e(route('admin.setting.socialite.credentials')); ?>" class="nav-link">
                        <i class="menu-icon las la-users-cog"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Social Credentials'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item  <?php echo e(menuActive('admin.subscriber.*')); ?>">
                    <a href="<?php echo e(route('admin.subscriber.index')); ?>" class="nav-link"
                        data-default-url="<?php echo e(route('admin.subscriber.index')); ?>">
                        <i class="menu-icon las la-envelope"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Subscribers'); ?> </span>
                    </a>
                </li>

                <li class="sidebar__menu-header"><?php echo app('translator')->get('KYC Management'); ?></li>

                <li class="sidebar-menu-item <?php echo e(menuActive(['admin.kyc.setting'])); ?>">
                    <a href="<?php echo e(route('admin.kyc.setting')); ?>" class="nav-link">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title"><?php echo app('translator')->get('User KYC'); ?></span>
                    </a>
                </li>


                <li class="sidebar-menu-item <?php echo e(menuActive(['admin.instructor.kyc.setting'])); ?>">
                    <a href="<?php echo e(route('admin.instructor.kyc.setting')); ?>" class="nav-link">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Insrtuctor KYC'); ?></span>
                    </a>
                </li>


                <li class="sidebar__menu-header"><?php echo app('translator')->get('Transactions'); ?></li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.*')); ?>">
                    <a href="<?php echo e(route('admin.deposit.pending')); ?>" class="nav-link ">
                        <i class="menu-icon las la-wallet"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Payments'); ?></span>
                        <?php if(0 < $pendingDepositsCount): ?>
                            <div class="blob white">
                            </div>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.gateway.*')); ?>">
                    <a href="<?php echo e(route('admin.gateway.automatic.index')); ?>" class="nav-link ">
                        <i class="menu-icon las la-dollar-sign"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Payment Gateways'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.withdraw.*')); ?>">
                    <a href="<?php echo e(route('admin.withdraw.pending')); ?>" class="nav-link ">
                        <i class="menu-icon las la la-credit-card"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Withdrawals'); ?></span>
                        <?php if(0 < $pendingWithdrawCount): ?>
                            <div class="blob white">
                            </div>
                        <?php endif; ?>
                    </a>
                </li>


                <li class="sidebar__menu-header"><?php echo app('translator')->get('Report'); ?></li>
                <li
                    class="sidebar-menu-item <?php echo e(menuActive(['admin.report.transaction', 'admin.report.transaction.search'])); ?>">
                    <a href="<?php echo e(route('admin.report.transaction')); ?>" class="nav-link">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Transactions'); ?></span>
                    </a>
                </li>
                <li
                    class="sidebar-menu-item <?php echo e(menuActive(['admin.report.login.history', 'admin.report.login.ipHistory'])); ?>">
                    <a href="<?php echo e(route('admin.report.login.history')); ?>" class="nav-link">
                        <i class="menu-icon las la-sign-in-alt"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Login Activities'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.notification.history')); ?>">
                    <a href="<?php echo e(route('admin.report.notification.history')); ?>" class="nav-link">
                        <i class="menu-icon las la-bell"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Notifications'); ?></span>
                    </a>
                </li>
                <li class="sidebar__menu-header"><?php echo app('translator')->get('Help Desk'); ?></li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.*')); ?>">
                    <a href="<?php echo e(route('admin.ticket.pending')); ?>" class="nav-link ">
                        <i class="menu-icon las la la-life-ring"></i>
                        <span class="menu-title"><?php echo app('translator')->get('User Support'); ?></span>
                        <?php if(0 < $pendingTicketCount): ?>
                            <div class="blob white">
                            </div>
                        <?php endif; ?>
                    </a>
                </li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.instructor.ticket.*')); ?>">
                    <a href="<?php echo e(route('admin.instructor.ticket.pending')); ?>" class="nav-link ">
                        <i class="menu-icon las la la-life-ring"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Instrunctor Support'); ?></span>
                        <?php if(0 < $instructorPendingTicketCount): ?>
                            <div class="blob white">
                            </div>
                        <?php endif; ?>
                    </a>
                </li>

                <li class="sidebar__menu-header"><?php echo app('translator')->get('Content Management'); ?></li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.frontend.manage.*')); ?>">
                    <a href="<?php echo e(route('admin.frontend.manage.pages')); ?>" class="nav-link ">
                        <i class="menu-icon la la-pager"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Pages'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.frontend.sections*', 3)); ?>">
                        <i class="menu-icon la la-grip-horizontal"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Sections'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.frontend.sections*', 2)); ?> ">
                        <ul>
                            <?php
                                $lastSegment = collect(request()->segments())->last();
                            ?>
                            <?php $__currentLoopData = getPageSections(true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $secs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($secs['builder']): ?>
                                    <li class="sidebar-menu-item  <?php if($lastSegment == $k): ?> active <?php endif; ?> ">
                                        <a href="<?php echo e(route('admin.frontend.sections', $k)); ?>" class="nav-link">
                                            <i class="menu-icon las la-caret-right"></i>
                                            <span class="menu-title"><?php echo e(__($secs['name'])); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </li>
                <li class="sidebar__menu-header"><?php echo app('translator')->get('General Settings'); ?></li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.index')); ?>">
                    <a href="<?php echo e(route('admin.setting.index')); ?>" class="nav-link">
                        <i class="menu-icon las la-globe"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Global Settings'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.logo.icon')); ?>">
                    <a href="<?php echo e(route('admin.setting.logo.icon')); ?>" class="nav-link">
                        <i class="menu-icon las la-image"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Logo & Favicon'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item  <?php echo e(menuActive(['admin.language.manage', 'admin.language.key'])); ?>">
                    <a href="<?php echo e(route('admin.language.manage')); ?>" class="nav-link"
                        data-default-url="<?php echo e(route('admin.language.manage')); ?>">
                        <i class="menu-icon las la-language"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Language'); ?> </span>
                    </a>
                </li>
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.setting.notification*', 3)); ?>">
                        <i class="menu-icon las la-bell"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Email & Notification'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.setting.notification*', 2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.templates')); ?> ">
                                <a href="<?php echo e(route('admin.setting.notification.templates')); ?>" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('All Templates'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.global')); ?> ">
                                <a href="<?php echo e(route('admin.setting.notification.global')); ?>" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Global Template'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.email')); ?> ">
                                <a href="<?php echo e(route('admin.setting.notification.email')); ?>" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Email Config'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.sms')); ?> ">
                                <a href="<?php echo e(route('admin.setting.notification.sms')); ?>" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('SMS Config'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.extensions.index')); ?>">
                    <a href="<?php echo e(route('admin.extensions.index')); ?>" class="nav-link">
                        <i class="menu-icon las la-cogs"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Plugins'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.seo')); ?>">
                    <a href="<?php echo e(route('admin.seo')); ?>" class="nav-link">
                        <i class="menu-icon las la-project-diagram"></i>
                        <span class="menu-title"><?php echo app('translator')->get('SEO'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.cookie')); ?>">
                    <a href="<?php echo e(route('admin.setting.cookie')); ?>" class="nav-link">
                        <i class="menu-icon las la-check-circle"></i>
                        <span class="menu-title"><?php echo app('translator')->get('GDPR Policy'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.custom.css')); ?>">
                    <a href="<?php echo e(route('admin.setting.custom.css')); ?>" class="nav-link">
                        <i class="menu-icon lab la-css3-alt"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Custom CSS'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="<?php echo e(route('admin.clear.cache')); ?>" class="nav-link">
                        <i class="menu-icon las la-broom"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Clear Cache'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="menu-icon las la-code-branch"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Panel'); ?> <?php echo e(sysInfo()['admin_version']); ?></span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- sidebar end -->

<?php $__env->startPush('script'); ?>
    <script>
        if ($('li').hasClass('active')) {
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            }, 500);
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/components/sidenav.blade.php ENDPATH**/ ?>