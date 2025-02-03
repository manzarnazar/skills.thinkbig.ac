<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.instructors.active') ? 'active' : '' }}"
                    href="{{route('admin.instructors.active')}}">@lang('Active')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.instructors.banned') ? 'active' : '' }}"
                    href="{{route('admin.instructors.banned')}}">@lang('Banned')
                    @if($bannedInstructorsCount)
                    <span class="badge rounded-pill bg--white text-muted">{{$bannedInstructorsCount}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.instructors.email.unverified') ? 'active' : '' }}"
                    href="{{route('admin.instructors.email.unverified')}}">@lang('Email Unverified')
                    @if($emailUnverifiedInstructorsCount)
                    <span class="badge rounded-pill bg--white text-muted">{{$emailUnverifiedInstructorsCount}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.instructors.mobile.unverified') ? 'active' : '' }}"
                    href="{{route('admin.instructors.mobile.unverified')}}">@lang('Mobile Unverified')
                    @if($mobileUnverifiedInstructorsCount)
                    <span class="badge rounded-pill bg--white text-muted">{{$mobileUnverifiedInstructorsCount}}</span>
                    @endif
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.instructors.kyc.unverified') ? 'active' : '' }}"
                    href="{{route('admin.instructors.kyc.unverified')}}">@lang('Kyc Unverified')
                    @if($kycUnverifiedInstructorsCount)
                    <span class="badge rounded-pill bg--white text-muted">{{$kycUnverifiedInstructorsCount}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.instructors.kyc.pending') ? 'active' : '' }}"
                    href="{{route('admin.instructors.kyc.pending')}}">@lang('Kyc Pending')
                    @if($kycPendingInstructorsCount)
                    <span class="badge rounded-pill bg--white text-muted">{{$kycPendingInstructorsCount}}</span>
                    @endif
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.instructors.with.balance') ? 'active' : '' }}"
                    href="{{route('admin.instructors.with.balance')}}">@lang('With Balance')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.instructors.all') ? 'active' : '' }}"
                    href="{{route('admin.instructors.all')}}">@lang('All Instructors')
                </a>
            </li>
         
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.instructors.notification.all') ? 'active' : '' }}"
                    href="{{route('admin.instructors.notification.all')}}">@lang('Notification to Instructors')
                </a>
            </li>
        </ul>
    </div>
</div>