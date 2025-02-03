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
                                    <th class="text-center">@lang('Created at')</th>
                                    <th class="text-center">@lang('Status')</th>
                                    <th class="text-center">@lang('Live class')</th>
                                    <th class="text-center">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lesson as $item)
                                    <tr>
                                      

                                        <td>
                                            <span>{{ __(@$item->title) }}</span>
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
                                                    href="{{ route('course.details', [slug(@$item->course_category->name),@$item->course_category->id]) }}">
                                                    <i class="fa-solid fa-eye"></i></a>
                                            </div>
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

                    @if ($lesson->hasPages())
                        <div class="card-footer text-end">
                            {{ $lesson->links() }}
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
