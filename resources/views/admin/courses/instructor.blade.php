@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        @include('admin.components.tabs.course')
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th>@lang('Image')</th>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Price')</th>
                                    <th>@lang('Discount')</th>
                                    <th>@lang('Created at')</th>
                                    <th>@lang('Admin Status')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($courses as $item)
                                    <tr>
                                        <td>
                                            <img class="course_category_image"
                                                src="{{ getImage(getFilePath('course_image') . '/' . $item->image) }}"
                                                alt="category_image">
                                        </td>
                                        <td><strong>{{ __(@$item->name) }}</strong></td>
                                        <td>
                                            <strong>
                                                {{$general->cur_sym}}{{ __(@$item->price) }}</strong>
                                        </td>
                                        <td>
                                            <strong>
                                                {{$general->cur_sym}}{{ __(@$item->discount) ?? 'N/A' }}</strong>
                                        </td>

                                        <td> {{ showDateTime($item->created_at) }} <br>
                                            {{ diffForHumans($item->created_at) }}
                                        </td>

                                        <td>
                                            @if ($item->admin_status == 1)
                                                <span
                                                    class="text--small badge font-weight-normal badge--success">@lang('Approved')</span>
                                            @else
                                                <span
                                                    class="text--small badge font-weight-normal badge--danger">@lang('Pending')</span>
                                            @endif

                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span
                                                    class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                            @else
                                                <span
                                                    class="text--small badge font-weight-normal badge--danger">@lang('Pending')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="course_category_update">
                                                <a class="btn btn-sm btn--primary ms-1"
                                                    data-url="{{ route('admin.course.instructor.approved', $item->id) }}"
                                                    data-data="{{ json_encode($item) }}">@lang('Approved')</a>
                                            </span>
                                   
                                            <a class="btn btn-sm btn--primary ms-1"
                                                href="{{ route('admin.lesson.instructor', $item->id) }}" title="Course List"><i
                                                    class="la la-list-ul"></i></a>
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
                @if ($courses->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($courses) @endphp
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('Add Course Category')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class=" mb-2">@lang('Status')</label>
                                    <select class="form--control form-select" name="admin_status" id="category" required>
                                        <option value="1">@lang('Approve')</option>
                                        <option value="0">@lang('Reject')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary btn-global" id="btn-save"
                            value="add">@lang('Save')</button>
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
                <input type="text" name="search" class="form-control bg--white search-color" placeholder="@lang('Search by Username')"
                    value="{{ request()->search }}">
                <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
@endpush



@push('script')

    <script>
        $('.course_category_update').on('click', function() {
            var modal = $('#exampleModal');
            var modalTitle = modal.find('.modal-title').text('@lang('Approved Course Category')');
            var url = $(this).children().data('url');
            var data = $(this).children().data('data');
            modal.find('form').attr('action', url);
            modal.find('select[name="admin_status"]').val(data.admin_status);
            modal.find('form').find('button[type="submit"]').text('@lang('Save')');
            modal.modal('show');
        });
    </script>
@endpush
