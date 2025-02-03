@extends($activeTemplate . 'layouts.master')
@section('content')
    <!-- body-wrapper-start -->
    <div class="row mx-lg-0 mb-3">
        <div class="col-lg-12">
            <div class="filter-wrap">
                <h6>@lang('Your Ticket')</h6>
                <a href="{{ route('ticket.open') }}" class="btn btn--base">
                    <i class="fa-solid fa-ticket me-2"></i> @lang('Create Ticket')
                </a>
            </div>
        </div>
    </div>
    <div class="row mx-lg-0">
        <div class="col-lg-12">
            <div class="tbl-wrap">
                <table class="table table--responsive--lg">
                    <thead>
                        <tr>
                            <th class="text-center">@lang('SL')</th>
                            <th class="text-center">@lang('Subject')</th>
                            <th class="text-center">@lang('Status')</th>
                            <th class="text-center">@lang('Priority')</th>
                            <th class="text-center">@lang('Last Reply')</th>
                            <th class="text-center">@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supports as $support)
                            <tr>
                                <td data-label="SL" class="text-center">
                                    <span> {{ $loop->iteration }} </span>
                                </td>
                                <td data-label="Subject" class="text-center">
                                    <a href="{{ route('ticket.view', $support->ticket) }}" class="fw-bold text-black">
                                        [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }}
                                    </a>
                                </td>
                                <td data-label="Status" class="text-center">
                                    <span> @php echo $support->statusBadge; @endphp </span>
                                </td>
                                <td data-label="Priority" class="text-center">
                                    @if ($support->priority == 1)
                                        <span class="badge badge--danger">@lang('Low')</span>
                                    @elseif($support->priority == 2)
                                        <span class="badge badge--success">@lang('Medium')</span>
                                    @elseif($support->priority == 3)
                                        <span class="badge badge--primary">@lang('High')</span>
                                    @endif
                                </td>
                                <td data-label="Last Reply" class="text-center">
                                    {{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }}
                                </td>

                                <td data-label="Action" class="text-center">
                                    <a class="btn btn--sm"
                                        href="{{ route('ticket.view', $support->ticket) }}">@lang('View')
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td data-label="Subject" colspan="100%" class="text-center">@lang('No Ticket Found')</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
