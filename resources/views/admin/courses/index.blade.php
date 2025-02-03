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
                                            @if ($item->status == 1)
                                                <span
                                                    class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                            @else
                                                <span
                                                    class="text--small badge font-weight-normal badge--danger">@lang('Pending')</span>
                                            @endif

                                        </td>
                                        <td>

                                            <a class="btn btn-sm btn--primary ms-1"
                                                href="{{ route('admin.course.edit', $item->id) }}"
                                                data-data="{{ json_encode($item) }}"><i class="la la-pen"></i></a>

                                            <a class="btn btn-sm btn--primary ms-1"
                                                href="{{ route('admin.lesson.courses', $item->id) }}"><i
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
                <form action="{{ route('admin.course.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Title') </label>
                                    <input class="form-control" name="name" value="" placeholder="Enter a title"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Category') </label>
                                    <select class="form--control form-select" name="category_id" id="category" required>
                                        <option value="0">@lang('Select One')</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == @$course->category_id ? 'selected' : '' }}>
                                                {{ __($item->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Price') </label>
                                    <input class="form-control" type="number" name="price" value=""
                                        placeholder="Enter a price" min="0" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2">@lang('Discount') </label>
                                    <input class="form-control" type="number" name="discount" value=""
                                        placeholder="Enter a discount" min="0">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="course-create-image">
                                    <div id="image_preview" class="image_preview-wrapper">

                                    </div>
                                </div>


                                <div>
                                    <label>@lang('Category Image (310x210)')</label>
                                    <div class="col-sm-12">
                                        <input type="file" name="image[]" id="images" accept=".png, .jpg, .jpeg"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group d-none edit_image_group">
                                <label>@lang('Category Image (50x50)')</label>
                                <div class="col-sm-12">
                                    <input type="file" name="image[]" id="editImages" accept=".png, .jpg, .jpeg .gif"
                                        class="form-control" onchange="imageChange()">
                                </div>

                                <div class="form-group">
                                    <div id="edit_image_preview">
                                        <div class='img-div'>
                                            <img src="" class='img-responsive image img-thumbnail'
                                                title=@lang('Category-image')>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class=" mb-2">@lang('Status')</label>
                                    <select class="form--control form-select" name="status" id="category" required>
                                        <option value="">@lang('Select One')</option>
                                        <option value="1">@lang('Active')</option>
                                        <option value="0">@lang('Pending')</option>
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
        <a href="{{ route('admin.course.create') }}" class="btn btn-sm btn--primary create_course_category me-3"><i
                class="las la-plus"></i>@lang('Add New')</a>
        <form method="GET" class="form-inline">
            <div class="input-group justify-content-end">
                <input type="text" name="search" class="form-control bg--white search-color"
                    placeholder="@lang('Search by Username')" value="{{ request()->search }}">
                <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
@endpush
@push('style')
    <style>
        .image_preview-wrapper {
            display: flex;
            flex-wrap: wrap;
        }

        .img-div {
            position: relative;
            width: 150px;

            margin-right: 5px;
            margin-left: 5px;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: 150px;
            max-width: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .img-div:hover .image {
            opacity: 0.3;
        }

        .img-div:hover .middle {
            opacity: 1;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.select2-auto-tokenize').select2({
                dropdownParent: $('.tag-input'),
                tags: true,
                tokenSeparators: [',']
            });
        })(jQuery);
    </script>

    <script>
        function imageChange() {
            var fileArr = [];
            if (fileArr.length > 0) fileArr = [];
            $('#edit_image_preview').html("");

            var total_file = document.getElementById("editImages").files;
            if (!total_file.length) return;
            for (var i = 0; i < total_file.length; i++) {
                if (total_file[i].size > 1048576) {
                    return false;
                } else {
                    fileArr.push(total_file[i]);
                    $('#edit_image_preview').append("<div class='img-div' id='img-div" + i + "'><img src='" +
                        URL.createObjectURL(event.target.files[i]) +
                        "' class='img-responsive image img-thumbnail'title='" + total_file[i]
                        .name + "'></div>");
                }
            }

            $('body').on('click', '#action-icon', function(evt) {
                var divName = this.value;
                var fileName = $(this).attr('role');
                $(`#${divName}`).remove();

                for (var i = 0; i < fileArr.length; i++) {
                    if (fileArr[i].name === fileName) {
                        fileArr.splice(i, 1);
                    }
                }
                document.getElementById('editImages').files = FileListItem(fileArr);
                evt.preventDefault();
            });

            function FileListItem(file) {
                file = [].slice.call(Array.isArray(file) ? file : arguments)
                for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
                if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
                for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
                return b.files
            }
        }

        $(document).ready(function() {
            "use strict";
            var fileArr = [];
            $("#images").on('change', function() {
                if (fileArr.length > 0) fileArr = [];

                $('#image_preview').html("");
                var total_file = document.getElementById("images").files;
                if (!total_file.length) return;
                for (var i = 0; i < total_file.length; i++) {
                    if (total_file[i].size > 1048576) {
                        return false;
                    } else {
                        fileArr.push(total_file[i]);
                        $('#image_preview').append("<div class='img-div' id='img-div" + i + "'><img src='" +
                            URL.createObjectURL(event.target.files[i]) +
                            "' class='img-responsive image img-thumbnail' title='" + total_file[i]
                            .name + "'><div class='middle'><button id='action-icon' value='img-div" +
                            i + "' class='btn btn-danger' role='" + total_file[i].name +
                            "'><i class='fa fa-trash'></i></button></div></div>");
                    }
                }
            });

            $('body').on('click', '#action-icon', function(evt) {
                var divName = this.value;
                var fileName = $(this).attr('role');
                $(`#${divName}`).remove();

                for (var i = 0; i < fileArr.length; i++) {
                    if (fileArr[i].name === fileName) {
                        fileArr.splice(i, 1);
                    }
                }
                document.getElementById('images').files = FileListItem(fileArr);
                evt.preventDefault();
            });

            function FileListItem(file) {
                file = [].slice.call(Array.isArray(file) ? file : arguments)
                for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
                if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
                for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
                return b.files
            }
        });
    </script>
@endpush
