@extends('admin.layouts.app')

@section('panel')
    <div class="row">
    
        <div class="col-md-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th>@lang('Title')</th>
                                    <th class="text-center">@lang('Category')</th>
                                    <th class="text-center">@lang('Created at')</th>
                                    <th class="text-center">@lang('Status')</th>
                                    <th class="text-center">@lang('Live class')</th>
                                    <th class="text-center">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lessons as $item)
                                    <tr>
                                        <td>
                                            <span>{{ __(@$item->title) }}</span>
                                        </td>
                                        <td>
                                            <span>
                                                {{ __(@$item->course_category?->name) }}</span>
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


                                        <td class="text-center">
                                            <div class="button--group text-center">
                                                <a class="btn btn-sm btn--primary ms-1"
                                                    href="{{ route('admin.lesson.edit', $item->id) }}">
                                                    <i class="fa-solid fa-pen"></i></a>
                                                <a class="btn btn-sm btn--danger ms-1" href="javascript:void(0)"
                                                    data-url="{{ route('admin.lesson.delete', @$item->id) }}"
                                                    onclick="lessonDeleteModal(this)">
                                                    <i class="fa-solid fa-trash"></i></a></span>
                                            </div>

                                            @if ($item->preview_video == 3)
                                                @php
                                                    $zoomData = @$item->zoom_data;
                                                @endphp
                                                <a class="btn btn--success btn-sm mt-2"
                                                    href="{{ @$zoomData->data?->start_url }}">
                                                    <i class="fa-solid fa-video"></i></span>
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

                    @if ($lessons->hasPages())
                        <div class="card-footer text-end">
                            {{ $lessons->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">@lang('Alert')</h5>
                    <button type="button" class="btn-close btn btn--danger" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>@lang('Are you sure? You want delete this course?')</p>
                        <input type="text" hidden name="fileName" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary" data-modal="0"
                            data-bs-dismiss="modal">@lang('No')</button>
                        <button type="submit" class="btn btn--primary" data-bs-dismiss="modal"
                            data-modal="1">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <div class="d-flex flex-wrap justify-content-end">
        <a class="btn btn-sm btn--primary me-2 d-flex align-items-center"
            href="{{ route('admin.lesson.create') }}"><i class="las la-plus"></i>@lang('Add New')</a>
        <form method="GET" class="form-inline">
            <div class="input-group justify-content-end">
                <input type="text" name="search" class="form-control bg--white search-color" placeholder="@lang('Search by Username')"
                    value="{{ request()->search }}">
                <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
@endpush


@push('script')
    <script>
        function lessonDeleteModal(object) {
            var data
            var videoModal = $('#videoModal');
            var url = $(object).data('url');
            videoModal.find('form').attr('action', url);
            videoModal.modal('show');
        }
    </script>
@endpush
