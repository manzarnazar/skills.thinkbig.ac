<!-- Sidebar  -->

<!-- < dashboard side bar -->
<div class="dashboard_profile">
    <div class="dashboard_profile__details">
        <div class="sidebar-menu">
            <span class="sidebar-menu__close"><i class="las la-times"></i></span>
            <div class="logo-wrapper px-3">
                <a href="{{ route('home') }}" class="normal-logo" id="normal-logo"> <img
                        src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="logo-image"></a>
            </div>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-list__item">
                    <a href="{{ route('user.home') }}" class="sidebar-menu-list__link {{ Route::is('user.home') ? 'active' : '' }}">
                        <span class="icon"><i class="fa-solid fa-house"></i></span>
                        <span class="text">@lang('Dashboard')</span>
                    </a>
                </li>


                <li class="sidebar-menu-list__item">
                    <a href="{{route('user.enroll.all.courses')}}" class="sidebar-menu-list__link {{ isActiveRoute('user.enroll.all.courses') ? 'active' : '' }}">
                        <span class="icon"><i class="fa-solid fa-book"></i></span>
                        <span class="text">@lang('All Courses')</span>
                    </a>
                </li>

                <li class="sidebar-menu-list__item">
                    <a href="{{route('user.enroll.courses')}}" class="sidebar-menu-list__link {{ isActiveRoute('user.enroll.courses') ? 'active' : '' }}">
                        <span class="icon"><i class="fa-solid fa-book-open"></i></span>
                        <span class="text">@lang('Enroll Courses')</span>
                    </a>
                </li>


               
                <li class="sidebar-menu-list__item has-dropdown {{ isActiveRoute('user.quiz.list') || isActiveRoute('user.quiz.course') || isActiveRoute('user.quiz.details') || isActiveRoute('user.quiz.result') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="sidebar-menu-list__link {{ isActiveRoute('user.quiz.list') || isActiveRoute('user.quiz.course') || isActiveRoute('user.quiz.details') || isActiveRoute('user.quiz.result') ? 'active' : '' }}">
                        <span class="icon"><i class="fa-solid fa-gauge-high"></i></span>
                        <span class="text">@lang('Quizzes')</span>
                    </a>
                    <div class="sidebar-submenu {{ isActiveRoute('user.quiz.list') || isActiveRoute('user.quiz.course') || isActiveRoute('user.quiz.details') || isActiveRoute('user.quiz.result')  ? 'd-block' : '' }}">
                        <ul class="sidebar-submenu-list">
                            <li class="sidebar-submenu-list__item">
                                <a href="{{ route('user.quiz.result') }}"
                                    class="sidebar-submenu-list__link">@lang('My Quiz Result')</a>
                            </li>
                          
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-list__item has-dropdown {{ isActiveRoute('user.deposit') ? 'active' : '' }}">
                    <a href="javascript:void(0)"
                        class="sidebar-menu-list__link {{ isActiveRoute('user.deposit') ? 'active' : '' }}">
                        <span class="icon"><i class="fa-solid fa-wallet"></i></span>
                        <span class="text">@lang('Payments')</span>
                    </a>
                    <div class="sidebar-submenu {{ isActiveRoute('user.deposit') ? 'd-block' : '' }}">
                        <ul class="sidebar-submenu-list">
                            <li class="sidebar-submenu-list__item">
                                <a href="{{ route('user.deposit.history') }}"
                                    class="sidebar-submenu-list__link">@lang('Payment History')</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-list__item has-dropdown {{ isActiveRoute('user.profile.setting') || isActiveRoute('user.change.password') || isActiveRoute('user.twofactor') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="sidebar-menu-list__link">
                        <span class="icon"><i class="fa-solid fa-user"></i></span>
                        <span class="text">@lang('Account')</span>
                    </a>
                    <div class="sidebar-submenu {{ isActiveRoute('user.profile.setting') || isActiveRoute('user.change.password') || isActiveRoute('user.twofactor') ? 'd-block' : '' }}">
                        <ul class="sidebar-submenu-list">
                            <li class="sidebar-submenu-list__item">
                                <a href="{{ route('user.profile.setting') }}"
                                    class="sidebar-submenu-list__link">@lang('Profile Setting')</a>
                            </li>
                            <li class="sidebar-submenu-list__item">
                                <a href="{{ route('user.change.password') }}"
                                    class="sidebar-submenu-list__link">@lang('Change Password') </a>
                            </li>
                            <li class="sidebar-submenu-list__item">
                                <a href="{{ route('user.twofactor') }}"
                                    class="sidebar-submenu-list__link">@lang('2Fa Security')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="sidebar-menu-list__item">
                    <a href="{{ route('user.transactions') }}"
                        class="sidebar-menu-list__link {{ Route::is('user.transactions') ? 'active' : '' }}">
                        <span class="icon"><i class="fa-solid fa-money-bill"></i></span>
                        <span class="text">@lang('Transactions')</span>
                    </a>
                </li>

                <li class="sidebar-menu-list__item">
                    <a href="{{ route('ticket') }}" class="sidebar-menu-list__link {{ Route::is('ticket') ? 'active' : '' }}">
                        <span class="icon"><i class="fa-solid fa-headset"></i></span>
                        <span class="text">@lang('Support Ticket')</span>
                    </a>
                </li>
                <li class="sidebar-menu-list__item">
                    <a href="{{ route('user.logout') }}" class="sidebar-menu-list__link">
                        <span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                        <span class="text">@lang('Log Out')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- dashboard side bar /> -->
