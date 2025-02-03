<div class="sidebar">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{ route('admin.dashboard') }}" class="sidebar__main-logo"><img
                    src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="@lang('image')"></a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{ menuActive('admin.dashboard') }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link ">
                        <i class="menu-icon las la-chart-line"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>
                <li class="sidebar__menu-header">@lang('Users Management')</li>
                <li class="sidebar-menu-item {{ menuActive('admin.users.*') }}">
                    <a href="{{ route('admin.users.active') }}" class="nav-link ">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('All Students')</span>
                        @if ($bannedUsersCount > 0 || $emailUnverifiedUsersCount > 0 || $mobileUnverifiedUsersCount > 0)
                            <div class="blob white"></div>
                        @endif
                    </a>
                </li>


                <li class="sidebar__menu-header">@lang('Instructors Management')</li>
                <li class="sidebar-menu-item {{ menuActive('admin.instructors.*') }}">
                    <a href="{{ route('admin.instructors.active') }}" class="nav-link ">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('All Instructors')</span>
                        @if ($bannedUsersCount > 0 || $emailUnverifiedUsersCount > 0 || $mobileUnverifiedUsersCount > 0)
                            <div class="blob white"></div>
                        @endif
                    </a>
                </li>

                <li class="sidebar__menu-header">@lang('Category Management')</li>
                <li class="sidebar-menu-item {{ menuActive('admin.category.*') }}">
                    <a href="{{ route('admin.category.all') }}" class="nav-link ">
                        <i class="menu-icon  las la-boxes"></i>
                        <span class="menu-title">@lang('Categories')</span>
                    </a>
                </li>

                <li class="sidebar__menu-header">@lang('Zoom Credentials Management')</li>
                <li class="sidebar-menu-item {{ menuActive('admin.credential.*') }}">
                    <a href="{{ route('admin.zoom.credential') }}" class="nav-link ">
                        <i class="menu-icon  las la-key"></i>
                        <span class="menu-title">@lang('Zoom Credentials')</span>
                    </a>
                </li>

                <li class="sidebar__menu-header">@lang('Course & Course Category Management')</li>
                <li class="sidebar-menu-item {{ menuActive('admin.course.*') }}">
                    <a href="{{ route('admin.course.index') }}" class="nav-link ">
                        <i class="menu-icon  las la-copy"></i>
                        <span class="menu-title">@lang('Courses')</span>
                    </a>
                </li>
           
                <li class="sidebar-menu-item {{ menuActive('admin.lesson.create.') }}">
                    <a href="{{ route('admin.lesson.create') }}" class="nav-link ">
                        <i class="menu-icon  las la-book"></i>
                        <span class="menu-title">@lang('Add Lessons')</span>
                    </a>
                </li>
                <li class="sidebar__menu-header">@lang('Quizzes')</li> 
                <li class="sidebar-menu-item {{ menuActive('admin.quiz.index.') }}">
                    <a href="{{ route('admin.quiz.index') }}" class="nav-link ">
                        <i class="menu-icon  las la-book"></i>
                        <span class="menu-title">@lang('Quizzes')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.certificate.*', 3) }}">
                        <i class="menu-icon las la-certificate"></i>
                        <span class="menu-title">@lang('Certificates')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.certificate*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.certificate.edit') }} ">
                                <a href="{{ route('admin.certificate.edit') }}" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title">@lang('Certificate Template')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.certificate.all') }} ">
                                <a href="{{ route('admin.certificate.all') }}" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title">@lang('All Certificate')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="sidebar__menu-header">@lang('Ad Management')</li>
                <li class="sidebar-menu-item {{ menuActive('admin.ad.index') }}">
                    <a href="{{ route('admin.ad.index') }}" class="nav-link ">
                        <i class="menu-icon lab la-adn"></i>
                        <span class="menu-title">@lang('Ads')</span>
                    </a>
                </li>

                <li class="sidebar__menu-header">@lang('Socialite Credential')</li>
                <li class="sidebar-menu-item {{ menuActive('admin.setting.socialite.credentials') }}">
                    <a href="{{ route('admin.setting.socialite.credentials') }}" class="nav-link">
                        <i class="menu-icon las la-users-cog"></i>
                        <span class="menu-title">@lang('Social Credentials')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item  {{ menuActive('admin.subscriber.*') }}">
                    <a href="{{ route('admin.subscriber.index') }}" class="nav-link"
                        data-default-url="{{ route('admin.subscriber.index') }}">
                        <i class="menu-icon las la-envelope"></i>
                        <span class="menu-title">@lang('Subscribers') </span>
                    </a>
                </li>

                <li class="sidebar__menu-header">@lang('KYC Management')</li>

                <li class="sidebar-menu-item {{ menuActive(['admin.kyc.setting']) }}">
                    <a href="{{ route('admin.kyc.setting') }}" class="nav-link">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('User KYC')</span>
                    </a>
                </li>


                <li class="sidebar-menu-item {{ menuActive(['admin.instructor.kyc.setting']) }}">
                    <a href="{{ route('admin.instructor.kyc.setting') }}" class="nav-link">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('Insrtuctor KYC')</span>
                    </a>
                </li>


                <li class="sidebar__menu-header">@lang('Transactions')</li>
                <li class="sidebar-menu-item {{ menuActive('admin.deposit.*') }}">
                    <a href="{{ route('admin.deposit.pending') }}" class="nav-link ">
                        <i class="menu-icon las la-wallet"></i>
                        <span class="menu-title">@lang('Payments')</span>
                        @if (0 < $pendingDepositsCount)
                            <div class="blob white">
                            </div>
                        @endif
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.gateway.*') }}">
                    <a href="{{ route('admin.gateway.automatic.index') }}" class="nav-link ">
                        <i class="menu-icon las la-dollar-sign"></i>
                        <span class="menu-title">@lang('Payment Gateways')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.withdraw.*') }}">
                    <a href="{{ route('admin.withdraw.pending') }}" class="nav-link ">
                        <i class="menu-icon las la la-credit-card"></i>
                        <span class="menu-title">@lang('Withdrawals')</span>
                        @if (0 < $pendingWithdrawCount)
                            <div class="blob white">
                            </div>
                        @endif
                    </a>
                </li>


                <li class="sidebar__menu-header">@lang('Report')</li>
                <li
                    class="sidebar-menu-item {{ menuActive(['admin.report.transaction', 'admin.report.transaction.search']) }}">
                    <a href="{{ route('admin.report.transaction') }}" class="nav-link">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('Transactions')</span>
                    </a>
                </li>
                <li
                    class="sidebar-menu-item {{ menuActive(['admin.report.login.history', 'admin.report.login.ipHistory']) }}">
                    <a href="{{ route('admin.report.login.history') }}" class="nav-link">
                        <i class="menu-icon las la-sign-in-alt"></i>
                        <span class="menu-title">@lang('Login Activities')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.report.notification.history') }}">
                    <a href="{{ route('admin.report.notification.history') }}" class="nav-link">
                        <i class="menu-icon las la-bell"></i>
                        <span class="menu-title">@lang('Notifications')</span>
                    </a>
                </li>
                <li class="sidebar__menu-header">@lang('Help Desk')</li>
                <li class="sidebar-menu-item {{ menuActive('admin.ticket.*') }}">
                    <a href="{{ route('admin.ticket.pending') }}" class="nav-link ">
                        <i class="menu-icon las la la-life-ring"></i>
                        <span class="menu-title">@lang('User Support')</span>
                        @if (0 < $pendingTicketCount)
                            <div class="blob white">
                            </div>
                        @endif
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('admin.instructor.ticket.*') }}">
                    <a href="{{ route('admin.instructor.ticket.pending') }}" class="nav-link ">
                        <i class="menu-icon las la la-life-ring"></i>
                        <span class="menu-title">@lang('Instrunctor Support')</span>
                        @if (0 < $instructorPendingTicketCount)
                            <div class="blob white">
                            </div>
                        @endif
                    </a>
                </li>

                <li class="sidebar__menu-header">@lang('Content Management')</li>

                <li class="sidebar-menu-item {{ menuActive('admin.frontend.manage.*') }}">
                    <a href="{{ route('admin.frontend.manage.pages') }}" class="nav-link ">
                        <i class="menu-icon la la-pager"></i>
                        <span class="menu-title">@lang('Pages')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.frontend.sections*', 3) }}">
                        <i class="menu-icon la la-grip-horizontal"></i>
                        <span class="menu-title">@lang('Sections')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.frontend.sections*', 2) }} ">
                        <ul>
                            @php
                                $lastSegment = collect(request()->segments())->last();
                            @endphp
                            @foreach (getPageSections(true) as $k => $secs)
                                @if ($secs['builder'])
                                    <li class="sidebar-menu-item  @if ($lastSegment == $k) active @endif ">
                                        <a href="{{ route('admin.frontend.sections', $k) }}" class="nav-link">
                                            <i class="menu-icon las la-caret-right"></i>
                                            <span class="menu-title">{{ __($secs['name']) }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="sidebar__menu-header">@lang('General Settings')</li>

                <li class="sidebar-menu-item {{ menuActive('admin.setting.index') }}">
                    <a href="{{ route('admin.setting.index') }}" class="nav-link">
                        <i class="menu-icon las la-globe"></i>
                        <span class="menu-title">@lang('Global Settings')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.setting.logo.icon') }}">
                    <a href="{{ route('admin.setting.logo.icon') }}" class="nav-link">
                        <i class="menu-icon las la-image"></i>
                        <span class="menu-title">@lang('Logo & Favicon')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item  {{ menuActive(['admin.language.manage', 'admin.language.key']) }}">
                    <a href="{{ route('admin.language.manage') }}" class="nav-link"
                        data-default-url="{{ route('admin.language.manage') }}">
                        <i class="menu-icon las la-language"></i>
                        <span class="menu-title">@lang('Language') </span>
                    </a>
                </li>
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.setting.notification*', 3) }}">
                        <i class="menu-icon las la-bell"></i>
                        <span class="menu-title">@lang('Email & Notification')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.setting.notification*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.templates') }} ">
                                <a href="{{ route('admin.setting.notification.templates') }}" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title">@lang('All Templates')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.global') }} ">
                                <a href="{{ route('admin.setting.notification.global') }}" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title">@lang('Global Template')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.email') }} ">
                                <a href="{{ route('admin.setting.notification.email') }}" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title">@lang('Email Config')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.sms') }} ">
                                <a href="{{ route('admin.setting.notification.sms') }}" class="nav-link">
                                    <i class="menu-icon las la-caret-right"></i>
                                    <span class="menu-title">@lang('SMS Config')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.extensions.index') }}">
                    <a href="{{ route('admin.extensions.index') }}" class="nav-link">
                        <i class="menu-icon las la-cogs"></i>
                        <span class="menu-title">@lang('Plugins')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.seo') }}">
                    <a href="{{ route('admin.seo') }}" class="nav-link">
                        <i class="menu-icon las la-project-diagram"></i>
                        <span class="menu-title">@lang('SEO')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.setting.cookie') }}">
                    <a href="{{ route('admin.setting.cookie') }}" class="nav-link">
                        <i class="menu-icon las la-check-circle"></i>
                        <span class="menu-title">@lang('GDPR Policy')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.setting.custom.css') }}">
                    <a href="{{ route('admin.setting.custom.css') }}" class="nav-link">
                        <i class="menu-icon lab la-css3-alt"></i>
                        <span class="menu-title">@lang('Custom CSS')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.clear.cache') }}" class="nav-link">
                        <i class="menu-icon las la-broom"></i>
                        <span class="menu-title">@lang('Clear Cache')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="menu-icon las la-code-branch"></i>
                        <span class="menu-title">@lang('Panel') {{ sysInfo()['admin_version'] }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- sidebar end -->

@push('script')
    <script>
        if ($('li').hasClass('active')) {
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            }, 500);
        }
    </script>
@endpush
