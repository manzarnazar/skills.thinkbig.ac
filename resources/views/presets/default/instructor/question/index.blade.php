@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
    <div class="row mx-lg-0">
        <div class="col-lg-12">
            <div class="tbl-wrap">
                <div class="d-flex gap-3 flex-row justify-content-between align-items-center mb-3">
                    <div>
                        <a class="btn btn--base create_course_category" href="{{ route('instructor.question.create',$quiz->id) }}"><i
                                class="fa-solid fa-plus"></i>@lang('Add New')</a>
                    </div>
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
                                    {{$loop->iteration}}
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

                                <td>
                                    <a class="btn btn--base btn--sm"
                                        href="{{ route('instructor.question.edit',[$item->id,$quiz->id]) }}">
                                        <i class="fa-solid fa-pen"></i></a>
                                    <a class="btn btn--danger btn--sm" href="javascript:void(0)"
                                        data-url="{{ route('instructor.question.delete',[@$item->id,$quiz->id]) }}"
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
    @if ($questions->hasPages())
        <div class="card-footer text-end">
            {{ $questions->links() }}
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
                        <p>@lang('Are you sure? You want delete this Quiz?')</p>
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
          
            var videoModal = $('#videoModal');
            var url = $(object).data('url');
            videoModal.find('form').attr('action', url);
            videoModal.modal('show');
        }
    </script>
@endpush
