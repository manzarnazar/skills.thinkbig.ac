@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="profile-wrap">
        <div class="row justify-content-center px-3">

            <div class="table-area m-0 mt-2">
                <table class="table table--responsive--lg">
                    <thead>
                        <tr>
                            <th class="text-center">@lang('SI')</th>
                            <th class="text-center">@lang('Name')</th>
                            <th class="text-center">@lang('Course Name')</th>
                            <th class="text-center">@lang('Questions')</th>
                            <th class="text-center">@lang('Time')</th>
                            <th class="text-center">@lang('Mark')</th>
                            <th class="text-center">@lang('Grade')</th>
                            <th class="text-center">@lang('Created At')</th>
                            <th class="text-center">@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $item)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <span>{{ __(@$item->name) }}</span>
                                </td>

                                <td>
                                    <span>{{ __(@$item->course->name) }}</span>
                                </td>

                                <td>
                                    <span>{{ __(@$item->questions->count()) }}</span>
                                </td>

                                <td class="text-center">
                                    {{ $item->time }} @lang('Minutes')
                                </td>

                                <td class="text-center">
                                    {{ $item->marking($item) }}/{{ $item->pass_mark }}
                                </td>

                                <td class="text-center">
                                    @if ($item->marking($item) >= $item->pass_mark)
                                        <span class="badge badge--success">@lang('Passed')</span>
                                    @else
                                        <span class="badge badge--danger">@lang('Failed')</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    {{ showDateTime($item->created_at, 'D, M d, Y') }}
                                </td>
                                <td>
                                    <a class="btn btn--base btn--sm" title="Course"
                                        href="{{ route('course.details', [slug($item->course->name), $item->course->id]) }}">
                                        <i class="fa-solid fa-eye"></i></a>

                                    @if ($item->marking($item) >= $item->pass_mark)
                                        <a class="btn btn--base btn--sm" title="Certificate"
                                            href="{{ route('user.student.certificate', [$item->id,$item->marking($item)]) }}">
                                            <i class="fa-solid fa-graduation-cap"></i></a>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($quizzes->hasPages())
            <div class="card-footer text-end">
                {{ $quizzes->links() }}
            </div>
        @endif
    </div>
@endsection
