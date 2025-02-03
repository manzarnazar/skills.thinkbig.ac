@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
    <div class="row mx-lg-0">
        <div class="col-lg-12">
            <div class="table-area m-0">
                <table class="table table--responsive--lg">
                    <thead>
                        <tr></tr>
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
                                <td class="text-center">
                                    <span>{{ __(@$item->user?->fullname ?? @$item->user?->username) }}</span>
                                </td>

                                <td class="text-center">
                                    <span>{{ __(@$item->quiz?->questions?->count()) }}</span>
                                </td>

                                <td class="text-center">
                                    <span>{{ __(@$item->quiz?->pass_mark) }}</span>
                                </td>

                                <td class="text-center">
                                    <span>{{ @$item->correctMarking(@$item->quiz?->id, @$item->user?->id) }}/{{ __(@$item->quiz?->pass_mark) }}</span>
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
                                <td>
                                    <a class="btn btn--danger btn--sm" href="javascript:void(0)"
                                        data-url="{{ route('instructor.quiz.participant.delete', [$item->quiz?->id, $item->user?->id]) }}"
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
                </table>
            </div>
        </div>
    </div>
    @if ($quizUsers->hasPages())
        <div class="card-footer text-end">
            {{ $quizUsers->links() }}
        </div>
    @endif


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
                        <button type="submit" class="btn btn--base" data-bs-dismiss="modal"
                            data-modal="1">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

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
