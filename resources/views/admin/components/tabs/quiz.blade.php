<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.quiz.index') ? 'active' : '' }}"
                    href="{{route('admin.quiz.index')}}">@lang('My Quiz')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.quiz.instructor') ? 'active' : '' }}"
                    href="{{route('admin.quiz.instructor')}}">@lang('Instructor Quiz')
                </a>
            </li>

        </ul>
    </div>
</div>
