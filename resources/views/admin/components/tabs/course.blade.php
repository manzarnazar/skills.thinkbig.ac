<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.course.index') ? 'active' : '' }}"
                    href="{{route('admin.course.index')}}">@lang('My courses')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.course.instructor') ? 'active' : '' }}"
                    href="{{route('admin.course.instructor')}}">@lang('Instructor Course')
                </a>
            </li>

        </ul>
    </div>
</div>
