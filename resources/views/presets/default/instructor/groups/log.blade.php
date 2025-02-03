@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
    <div class="row mx-lg-0">
        <div class="col-lg-12">
            <div class="row w-100 pb-4">
                <div class="col-lg-12">
                    
                    <div class="tbl-wrap d-flex gap-3 flex-row justify-content-between align-items-center">
                        <div>
                            <a class="btn btn--base me-4 create_group" data-bs-toggle="modal"
                                data-bs-target="#createModal"><i class="las la-plus"></i>@lang('Add New')</a>
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
            </div>

            <div class="table-area m-0">
                <table class="table table--responsive--lg">
                    <thead>
                        <tr>
                            <th class="text-center">@lang('SI')</th>
                            <th class="text-center">@lang('Name')</th>
                            <th class="text-center">@lang('Course')</th>
                            <th class="text-center">@lang('Created at')</th>
                            <th class="text-center">@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($groups as $item)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <span>
                                        {{ __(@$item->name) }}</span>
                                </td>
                                <td class="text-center">
                                    <span>
                                        {{ __(@$item->course?->name) }}</span>
                                </td>

                                <td class="text-center">
                                    {{ showDateTime($item->created_at) }} <br>
                                    {{ diffForHumans($item->created_at) }}
                                </td>

                                <td>
                                    <div class="update_group">
                                        <button title="@lang('Edit')" href="javascript:void(0)"
                                            class="btn btn--base btn--sm" data-data="{{ json_encode($item) }}"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            data-url="{{ route('instructor.group.update', $item->id) }}">
                                            <i class="la la-pen"></i>
                                        </button>
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
    @if ($groups->hasPages())
        <div class="card-footer text-end">
            {{ $groups->links() }}
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('Add Course Category')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('instructor.group.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="content">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-2">@lang('Title') </label>
                                                <input class="form--control" name="name" value=""
                                                    placeholder="Enter a title" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-2">@lang('Course') </label>
                                                <select class="form--control form-select" name="course_id" id="course"
                                                    required>
                                                    <option value="0" selected>@lang('Select One')</option>
                                                    @foreach ($courses as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == @$group->course_id ? 'selected' : '' }}>
                                                            {{ __($item->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grp-btn-wrap mt-4 justify-content-end d-flex">
                                        <button type="button" class="btn btn--danger btn--sm me-2"
                                            data-bs-dismiss="modal">@lang('Close')</button>
                                        <button class="btn btn--base btn--sm" type="submit">@lang('Save')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $('.update_group').on('click', function() {
            var modal = $('#exampleModal');
            var modalTitle = modal.find('.modal-title').text('@lang('Update Group')');
            var url = $(this).children().data('url');
            var data = $(this).children().data('data');
            modal.find('form').attr('action', url);
            modal.find('form').prepend(`@method('put')`);
            modal.find('input[name="name"]').val(data.name);
            modal.find('select[name="course_id"]').val(data.course_id);
            modal.find('form').find('button[type="submit"]').text('@lang('Update')');
            modal.modal('show');

        });

        $('.create_group').on('click', function() {
            var modal = $('#exampleModal');
            var modalTitle = modal.find('.modal-title').text('@lang('Create Group')');
            var url = "{{ route('instructor.group.store') }}";
            modal.find('form').attr('action', url);
            modal.find('input[name="name"]').val('');
            modal.find('select[name="course_id"]').val(0);
            modal.find('form').find('button[type="submit"]').text('@lang('Save')');
            modal.modal('show');
        });
    </script>
@endpush