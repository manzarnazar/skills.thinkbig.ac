<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.report.login.history') ? 'active' : '' }}"
                    href="{{route('admin.report.login.history')}}">@lang('User')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.instructor.report.login.history') ? 'active' : '' }}"
                    href="{{route('admin.instructor.report.login.history')}}">@lang('Instructor')
                </a>
            </li>

        </ul>
    </div>
</div>
