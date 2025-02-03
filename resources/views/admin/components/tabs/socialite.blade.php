<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.setting.socialite.credentials') ? 'active' : '' }}"
                    href="{{route('admin.setting.socialite.credentials')}}">@lang('User')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.setting.instructor.socialite.credentials') ? 'active' : '' }}"
                    href="{{route('admin.setting.instructor.socialite.credentials')}}">@lang('Instructor')
                </a>
            </li>

        </ul>
    </div>
</div>
