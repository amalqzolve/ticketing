@extends('crm.common.layout')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ __('app.Key Accounts Information') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>{{ __('customer.Export') }}</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-print"> <span href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">@lang('app.Print')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-copy"> <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">@lang('app.Copy')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-csv">
                                        <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.CSV')</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-pdf"> <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.PDF')</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>&nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-striped  table-hover table-checkable" id="salesman_accounts_detailslist">
                <thead>
                    <tr>
                        <th>{{ __('salesman.Sl. No') }}</th>
                        <th>{{ __('salesman.Name') }}</th>
                        <th>{{ __('salesman.Place') }}</th>
                        <th>{{ __('salesman.Salesman Route') }}</th>
                        <th>{{ __('salesman.Actions') }}</th>{{--
                        <th>{{ __('salesman.Password') }}</th>
                        <th>{{ __('salesman.Address 1') }}</th>
                        <th>{{ __('salesman.Address 2') }}</th>
                        <th>{{ __('salesman.Address 3') }}</th>
                        <th>{{ __('salesman.Zip') }}</th>
                        <th>{{ __('salesman.Email') }}</th>
                        <th>{{ __('salesman.Country') }}</th>
                        <th>{{ __('salesman.Region') }}</th>
                        <th>{{ __('salesman.Place') }}</th>
                        <th>{{ __('salesman.Department') }}</th>
                        <th>{{ __('salesman.Department Head') }}</th>--}}
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>{{--
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>--}}
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>.
<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <input type="hidden" name="salesman_id" id="salesman_id" value="">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('app.Key Accounts Information')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="kt-form kt-form--label-right" id="group-form" name="group-form">
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-6">
                                        <label>Account Group</label>
                                    </div>
                                    <div class="col-md-6 input-group input-group-sm">
                                        <select class="form-control single-select" id="salesman_accounts_group" name="salesman_accounts_group">
                                            <option value="">{{ __('vendor.Select') }}</option>
                                            @foreach ($groups as $key)
                                            <option value="{{$key->id}}">{{$key->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-6">
                                        <label>Accounts Code</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group  input-group-sm">
                                            <div class="input-group-prepend"></div>
                                            <input type="text" class="form-control" id="salesman_accounts_code" name="salesman_accounts_code" autocomplete="off" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-6">
                                        <label>Ledger Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group  input-group-sm">
                                            <div class="input-group-prepend"></div>
                                            <input type="text" class="form-control" id="salesman_accounts_ledger" name="salesman_accounts_ledger" autocomplete="off" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="Group_submit_salesman" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">{{ __('customer.Submit') }}</button>
                <button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">{{ __('customer.Cancel') }}</button>
            </div>
        </div>
    </div>
    </form>
</div>

@endsection
@section('script')
<script src="{{url('/')}}/resources/js/crm/salesmandetails.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.js"></script>



@endsection