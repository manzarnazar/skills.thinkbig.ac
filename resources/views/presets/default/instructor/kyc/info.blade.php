@extends($activeTemplate . 'instructor.layouts.master')
@section('content')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="body-area">
                <h5>@lang('KYC Form')</h5>
                    @if($instructor->kyc_data)
                    <ul class="list-group">
                      @foreach($instructor->kyc_data as $val)
                      @continue(!$val->value)
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{__($val->name)}}
                        <span>
                            @if($val->type == 'checkbox')
                                {{ implode(',',$val->value) }}
                            @elseif($val->type == 'file')
                                <a href="{{ route('instructor.attachment.download',encrypt(getFilePath('verify').'/'.$val->value)) }}" class="me-3 btn--base btn--sm"><i class="fa fa-file"></i>  @lang('Attachment') </a>
                            @else
                            <p>{{__($val->value)}}</p>
                            @endif
                        </span>
                      </li>
                      @endforeach
                    </ul>
                    @else
                    <h5 class="text-center">@lang('KYC data not found')</h5>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
