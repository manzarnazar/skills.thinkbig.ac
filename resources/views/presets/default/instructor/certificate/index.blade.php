@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
    <div class="row mx-lg-0">
        <div class="col-lg-12">
            <div class="tbl-wrap">
                <div class="d-flex gap-3 flex-row justify-content-between align-items-center mb-3">
                    <div></div>
                    <form method="GET" autocomplete="off">
                        <div class="search-box w-100">
                            <input type="text" class="form--control" name="search" placeholder="@lang('Search...')"
                                value="{{ request()->search }}">
                            <button type="submit" class="search-box__button"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-area m-0">
                <table class="table table--responsive--lg">
                    <thead>
                        <tr>
                            <th class="text-center">@lang('SI')</th>
                            <th class="text-center">@lang('Course Name')</th>
                            <th class="text-center">@lang('Quiz Name')</th>
                            <th class="text-center">@lang('Student Name')</th>
                            <th class="text-center">@lang('Pass Mark')</th>
                            <th class="text-center">@lang('Created At')</th>
                            <th class="text-center">@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizCertificates as $item)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="text-center">
                                    <span>{{ __(@$item->course?->name) }}</span>
                                </td>

                                <td class="text-center">
                                    <span>{{ __(@$item->quiz?->name) }}</span>
                                </td>

                                <td class="text-center">
                                    <span>{{ __(@$item->user?->fullname ?? @$item->user?->username) }}</span>
                                </td>

                                <td class="text-center">
                                    {{ @$item->quiz?->pass_mark }}
                                </td>

                                <td class="text-center">
                                    {{ showDateTime(@$item->created_at, 'D, M d, Y') }}
                                </td>

                                <td>
                                    <a class="btn btn--base btn--sm" title="Course-Details"
                                        href="{{ route('course.details', [slug(@$item->course?->name), @$item->course?->id]) }}">
                                        <i class="fa-solid fa-eye"></i></a>

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
    </div>
    @if ($quizCertificates->hasPages())
        <div class="card-footer text-end">
            {{ $quizCertificates->links() }}
        </div>
    @endif
@endsection
