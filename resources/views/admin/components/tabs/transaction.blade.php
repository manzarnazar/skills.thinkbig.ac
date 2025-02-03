<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.report.transaction') ? 'active' : '' }}"
                    href="{{route('admin.report.transaction')}}">@lang('User')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.instructor.report.transaction') ? 'active' : '' }}"
                    href="{{route('admin.instructor.report.transaction')}}">@lang('Instructor')
                </a>
            </li>

        </ul>
    </div>
</div>
