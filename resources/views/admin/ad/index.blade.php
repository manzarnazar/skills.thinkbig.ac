@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Image')</th>
                                    <th>@lang('Link')</th>
                                    <th>@lang('Width')</th>
                                    <th>@lang('Height')</th>
                                    <th>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ads as $item)
                                    <tr>
                                        <td>{{ __($item->name) }}</td>
                                        <td><img src="{{ getImage(getFilePath('ads') . '/' . @$item->image) }}"
                                                alt="@lang('adImage')" style="width: 50px"></td>
                                        <td><a href="{{ $item->link }}">{{ __(@$item->link) }}</a></td>
                                        <td>{{ __(@$item->width) }}</td>
                                        <td>{{ __(@$item->height) }}</td>

                                        <td>
                                            <div class="button--group">
                                                <a href="{{ route('admin.ad.edit', @$item->id) }}" title="@lang('Edit')"
                                                    class="btn btn-sm btn--success">
                                                    <i class="la la-edit"></i>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __(@$emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->

                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection
