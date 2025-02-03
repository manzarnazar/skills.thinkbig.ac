@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        @include('admin.components.tabs.quiz')
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th>@lang('SI')</th>
                                    <th class="text-center">@lang('User Name')</th>
                                    <th class="text-center">@lang('Number of Questions')</th>
                                    <th class="text-center">@lang('Pass Mark')</th>
                                    <th class="text-center">@lang('Mark')</th>
                                    <th class="text-center">@lang('Grade')</th>
                                    <th class="text-center">@lang('Created At')</th>
                                    <th class="text-center">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($quizUsers as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <span>{{ __(@$item->user?->fullname ?? @$item->user?->username) }}</span>
                                        </td>

                                        <td>
                                            <span>{{ __(@$item->quiz?->questions?->count()) }}</span>
                                        </td>

                                        <td>
                                            <span>{{ __(@$item->quiz?->pass_mark) }}</span>
                                        </td>

                                        <td class="text-center">
                                            {{ @$item->correctMarking(@$item->quiz?->id, @$item->user?->id) }}/{{ __(@$item->quiz?->pass_mark) }}
                                        </td>

                                        <td class="text-center">
                                            @if (@$item->correctMarking(@$item->quiz?->id, @$item->user?->id) >= @$item->quiz?->pass_mark)
                                                <span class="badge badge--success">@lang('Passed')</span>
                                            @else
                                                <span class="badge badge--danger">@lang('Failed')</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ showDateTime(@$item->created_at, 'D, M d, Y') }}
                                        </td> 

                                        <td class="text-center">
                                            <a class="btn btn--danger btn-sm" href="javascript:void(0)"
                                                data-url="{{ route('admin.quiz.participant.delete', [$item->quiz?->id, $item->user?->id]) }}"
                                                onclick="quizDeleteModal(this)">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($quizUsers->hasPages())
                    <div class="card-footer text-end">
                        {{ $quizUsers->links() }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">@lang('Confirmation Alert')</h5>
                    <button type="button" class="btn-close btn " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>@lang('Are you sure? You want delete this participant?')</p>
                        <input type="text" hidden name="fileName" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary" data-bs-dismiss="modal"
                            data-modal="1">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-confirmation-modal></x-confirmation-modal>
@endsection


@push('breadcrumb-plugins')
    <div class="d-flex flex-wrap justify-content-end align-items-center">
        <form method="GET" class="form-inline">
            <div class="input-group justify-content-end">
                <input type="text" name="search" class="form-control bg--white search-color"
                    placeholder="@lang('Search by Username')" value="{{ request()->search }}">
                <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
@endpush


@push('script')
    <script>
        function quizDeleteModal(object) {
            var data
            var videoModal = $('#videoModal');
            var url = $(object).data('url');
            videoModal.find('form').attr('action', url);
            videoModal.modal('show');
        }
    </script>
@endpush
