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
                                    <th class="text-center">@lang('Question')</th>
                                    <th class="text-center">@lang('Mark')</th>
                                    <th class="text-center">@lang('Created At')</th>
                                    <th class="text-center">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($questions as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            <span>{{ __(@$item->question) }}</span>
                                        </td>

                                        <td class="text-center">
                                            {{ $item->mark }}
                                        </td>

                                        <td class="text-center">
                                            {{ showDateTime($item->created_at, 'D, M d, Y') }}
                                        </td>

                                        <td class="text-center">
                                            <a class="btn btn--danger btn-sm" href="javascript:void(0)"
                                                data-url="{{ route('admin.question.delete', [@$item->id, $quiz->id]) }}"
                                                onclick="quizDeleteModal(this)">
                                                <i class="fa-solid fa-trash"></i></a>
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
                @if ($questions->hasPages())
                    <div class="card-footer text-end">
                        {{ $questions->links() }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

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
                        <p>@lang('Are you sure? You want delete this Quiz?')</p>
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
