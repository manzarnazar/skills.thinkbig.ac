@extends($activeTemplate . 'instructor.layouts.' . $layout)
@section('content')
    <div class="mt-5 mx-4 {{ auth('instructor')->user() ? '' : 'mt-5' }}">
        <div class="row justify-content-center gy-4">
            <div class="{{ auth('instructor')->user() ? 'col-xl-12 col-lg-12' : 'col-lg-12 mt-4' }}">
                <div class="base--card">
                    <div class="dashboard-card-wrap mt-0">
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="view-ticket-head d-flex justify-content-between">
                                    <h5>
                                        @php echo $myTicket->statusBadge; @endphp
                                        [@lang('Ticket')#{{ $myTicket->ticket }}] {{ $myTicket->subject }}
                                    </h5>
                                      
                                    @if ($myTicket->status != 3 && auth('instructor')->user())
                                        <button class="btn button bg--danger btn--sm btn-suuport confirmationBtn border-0"
                                            type="button" data-question="@lang('Are you sure to close this ticket?')"
                                            data-action="{{ route('instructor.ticket.close', $myTicket->id) }}"><i
                                                class="fa fa-lg fa-times-circle"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            @if ($myTicket->status != 4)
                                <form method="post" action="{{ route('instructor.ticket.reply', $myTicket->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="message" class="form--label">@lang('Message')</label>
                                            <div class="input--group textarea">
                                                <textarea id="message" class="form--control" name="message" placeholder="Please enter your Message">{{ old('message') }} </textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="attachment_wrapper mb-4">
                                            <div class="form-group profile mb-15">
                                                <label for="attachments" class="form--label">@lang('Attachments:-') </label>
                                                <p class="ticket-attachments-message text-muted">
                                                    @lang('Allowed File Extensions'):<span class="text-danger"> .@lang('jpg'),
                                                        .@lang('jpeg'),
                                                        .@lang('png'), .@lang('pdf'), .@lang('doc'),
                                                        .@lang('docx')
                                                    </span>
                                                </p>
                                                <div class="single-input form-group mt-3 mb-1">
                                                    <input class="form--control" id="attachments" type="file"
                                                        name="attachments[]" id="inputAttachments">
                                                </div>
                                                <div id="fileUploadsContainer"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-end mb-2">
                                        <button type="button" class="btn btn--base btn--sm mt-3 addFile">
                                            <i class="fas fa-plus"></i>@lang('Add New')
                                        </button>
                                    </div>
                                    <div class="col-sm-12 text-start">
                                        <button type="submit" class="btn btn--base"> <i class="fa fa-reply"></i>
                                            @lang('Reply')</button>
                                    </div>
                                </form>
                            @endif
                            <div class="col-lg-12">
                                <div class="support_reply_bottom">
                                    <h4 class="mb-4">@lang('Recent Message')</h4>
                                    @foreach ($messages as $message)
                                        @if ($message->admin_id == 0)
                                            <div class="support_reply__single mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>@lang('You')</h4>
                                                        <p class="mb-2">
                                                            <i>{{ $message->message }}</i>
                                                        </p>
                                                        @if ($message->attachments->count() > 0)
                                                            <div class="mt-2">
                                                                @foreach ($message->attachments as $k => $image)
                                                                    <a href="{{ route('ticket.download', encrypt($image->id)) }}"
                                                                        class="me-3"><i class="fa fa-file"></i>
                                                                        @lang('Attachment') {{ ++$k }} </a>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        <h6>{{ $message->created_at->format('l, dS F Y @ H:i') }}
                                                        </h6>
                                                    </div>

                                                </div>
                                            </div>
                                        @else
                                            <div class="support_reply__single">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>@lang('Admin')</h4>
                                                        <p class="mb-2">
                                                            <i>{{ $message->message }}</i>
                                                        </p>
                                                        @if ($message->attachments->count() > 0)
                                                            <div class="mt-2">
                                                                @foreach ($message->attachments as $k => $image)
                                                                    <a href="{{ route('instructor.ticket.download', encrypt($image->id)) }}"
                                                                        class="me-3"><i class="fa fa-file"></i>
                                                                        @lang('Attachment') {{ ++$k }} </a>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        <h6>{{ $message->created_at->format('l, dS F Y @ H:i') }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-confirmation-modal></x-confirmation-modal>
    @endsection
    @push('style')
        <style>
            .input-group-text:focus {
                box-shadow: none !important;
            }
        </style>
    @endpush
    @push('script')
        <script>
            (function($) {
                "use strict";
                var fileAdded = 0;
                $('.addFile').on('click', function() {
                    if (fileAdded >= 4) {
                        notify('error', 'You\'ve added maximum number of file');
                        return false;
                    }
                    fileAdded++;
                    $("#fileUploadsContainer").append(`
                    <div class="input-group my-3">
                        <input type="file" name="attachments[]" class="form-control form--control" required />
                        <button class="input-group-text btn-danger remove-btn"><i class="las la-times"></i></button>
                    </div>
                `)
                });
                $(document).on('click', '.remove-btn', function() {
                    fileAdded--;
                    $(this).closest('.input-group').remove();
                });
            })(jQuery);
        </script>
    @endpush
