@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
    <div class="row mx-lg-0">
        <div class="col-lg-12">
            <div class="tbl-wrap">
                <div class="d-flex gap-3 flex-row justify-content-between align-items-center mb-3">
                    <div>
                        <a class="btn btn--base create_course_category" href="{{ route('instructor.lesson.create') }}"><i
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
                            <th class="text-center">@lang('Title')</th>
                            <th class="text-center">@lang('Created at')</th>
                            <th class="text-center">@lang('Status')</th>
                            <th class="text-center">@lang('Live class')</th>
                            <th class="text-center">@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lessons as $item)
                            <tr>
                                <td class="text-center">
                                    {{$loop->iteration}}
                                </td>
                            
                                <td>
                                    <span>
                                        {{ __(@$item->title) }}</span>
                                </td>

                                <td class="text-center">
                                    {{ showDateTime($item->created_at) }} <br>
                                    {{ diffForHumans($item->created_at) }}
                                </td>

                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge badge--success">@lang('Active')</span>
                                    @else
                                        <span class="badge badge--danger">@lang('Pending')</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($item->preview_video == 3)
                                        <span class="badge badge--danger ">@lang('Live')</span>
                                    @else
                                        <span class="badge badge--success">@lang('N/A')</span>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn--base btn--sm"
                                        href="{{ route('instructor.lesson.edit', $item->id) }}">
                                        <i class="fa-solid fa-pen"></i></a>

                                    @if ($item->preview_video == 3)
                                        @php
                                            $zoomData = @$item->zoom_data;
                                        @endphp
                                        <a class="btn btn--base btn--sm" href="{{ @$zoomData->data?->start_url }}">
                                            <i class="fa-solid fa-video"></i></a>
                                    @endif

                                    <a class="btn btn--danger btn--sm" href="javascript:void(0)"
                                        data-url="{{ route('instructor.lesson.delete', @$item->id) }}"
                                        onclick="courseDeleteModal(this)">
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
    @if ($lessons->hasPages())
        <div class="card-footer text-end">
            {{ $lessons->links() }}
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
                        <p>@lang('Are you sure? You want delete this course?')</p>
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
        function courseDeleteModal(object) {
            var data
            var videoModal = $('#videoModal');
            var url = $(object).data('url');
            videoModal.find('form').attr('action', url);
            videoModal.modal('show');
        }
    </script>
@endpush
