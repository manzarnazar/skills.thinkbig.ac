@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
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
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ __(@$item->course?->name) }}</td>
                                        <td class="text-center">{{ __(@$item->quiz?->name) }}</td>
                                        <td class="text-center">{{ __(@$item->user?->fullname ?? @$item->user?->username) }}
                                        </td>
                                        <td class="text-center">{{ @$item->quiz?->pass_mark }}</td>
                                        <td class="text-center"> {{ showDateTime(@$item->created_at, 'D, M d, Y') }}</td>


                                        <td class="text-center">

                                            <a title="@lang('User Profile')"
                                                href="{{ route('admin.users.detail', @$item->user->id) }}"
                                                class="btn btn-sm btn--primary">
                                                <i class="lar la-user"></i></i>
                                            </a>
                                            <a href="{{ route('course.details', [slug(@$item->course?->name), @$item->course?->id]) }}"
                                                title="@lang('Edit')" class="btn btn-sm btn--primary me-2">
                                                <i class="la la-eye"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __(@$emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection
