@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive--sm">
                        <table class="table align-items-center table--light">
                            <thead>
                                <tr>
                                    <th>@lang('Short Code')</th>
                                    <th>@lang('Description')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($template->shortcodes ?? [] as $shortcode => $key)
                                    <tr>
                                        <th><span class="short-codes">@php echo "{{ ". $shortcode ." }}" @endphp</span></th>
                                        <td>{{ __($key) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-muted text-center">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- card end -->

        </div>
    </div>

    <form action="{{ route('admin.certificate.update', $template->id) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header bg--primary">
                        <h5 class="card-title text-white">@lang('Certificate Template')</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="fw-bold">@lang('Template') <span class="text-danger">*</span></label>
                                    <textarea name="template" rows="10" class="form-control" id="summernote" placeholder="@lang('Your message using short-codes')">{{ $template->template }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="form-group text-end">
            <button type="submit" class="btn btn--primary btn-global mt-4">@lang('Save')</button>
        </div>
    </form>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.setting.notification.templates') }}" class="btn btn-sm btn--primary"><i
            class="las la-undo"></i> @lang('Back') </a>
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('assets/admin/css/summernote-lite.min.css')}}">
    <style>
        .note-editable{
            height: 100% !important;
        }
    </style>
     
@endpush
@push('script')
    <script src="{{asset('assets/admin/js/summernote-lite.min.js')}}"></script>
    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endpush
