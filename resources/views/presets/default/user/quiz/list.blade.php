@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="profile-wrap">
        <div class="row justify-content-center px-3">
            <div class="col-12 mb-3 d-flex justify-content-end">
                <form method="GET" autocomplete="off">
                    <div class="search-box">
                        <input type="text" class="form--control" name="search" placeholder="@lang('Search...')"
                            value="{{ request()->search }}">
                        <button type="submit" class="search-box__button"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="table-area m-0 mt-2">
                <table class="table table--responsive--lg">
                    <thead>
                        <tr>
                            <th class="text-center">@lang('SI')</th>
                            <th class="text-center">@lang('Name')</th>
                            <th class="text-center">@lang('Questions')</th>
                            <th class="text-center">@lang('Time')</th>
                            <th class="text-center">@lang('Pass Mark')</th>
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
                                    <span>{{ __(@$item->questions->count()) }}</span>
                                </td>

                                <td class="text-center">
                                    {{ $item->time }} @lang('Minute')
                                </td>

                                <td class="text-center">
                                    {{ $item->pass_mark }}
                                </td>

                                <td class="text-center">
                                    {{ showDateTime($item->created_at, 'D, M d, Y') }}
                                </td>

                                <td>
                                    <a class="btn btn--base btn--sm" title="Course Preview"
                                        href="{{ route('course.details', [slug($item->course->name), $item->course->id]) }}">
                                        <i class="fa-solid fa-eye"></i></a>
                                    <a class="btn btn--base btn--sm" title="Quiz"
                                        href="{{ route('user.quiz.details', $item->id) }}">
                                        <i class="fa-solid fa-forward"></i></a>

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
