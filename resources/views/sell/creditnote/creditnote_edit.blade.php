@extends('sell.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<style>
    .inputpicker-overflow-hidden {
        overflow: hidden;
        width: 100%;
    }

    .inputpicker-div>.inputpicker-input {
        font-size: 11px;
    }

    .inputpicker-arrow {
        top: 8px;
    }

    div.new1 {
        background-color: #f2f3f8;
        height: 20px;
        width: 100%;
        right: -36px;
        position: absolute;
        display: block;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

    .pluseb {
        background-color: #5d78ff;
        height: 100%;
        padding-top: 22%;
        text-align: center;
    }

    .pluseb:hover {
        background-color: #2a4eff;
    }

    .uppy-size--md .uppy-Dashboard-inner {
        width: 100%;
        height: 550px;
    }

    .table-bordered th,
    .table-bordered td {
        border: 0px solid #ebedf2;
        padding: 0px !important;
    }

    .nav-tabs {
        border-bottom: 0px;
    }

    .nav-tabs .nav-link {
        border: 3px solid transparent;
    }

    .nav-tabs .nav-link:hover,
    .nav-tabs .nav-link:focus {
        border-color: #f8fcff #fefeff #979fa8;
    }

    .nav-tabs .nav-link.active,
    .nav-tabs .nav-item.show .nav-link {
        border-color: #ffffff #ffffff #2275d7;
    }

    .mbtn {
        background-color: white;
        color: #74788d;

    }

    .mbtn:hover {
        color: #ffffff;
        background: #5d78ff;
        border-color: #5d78ff;
    }

    .mbdg1 {
        background: #fff;
        color: #a1a3a5;
    }

    .mbdg1:hover {
        background: #0ABB87;
        color: #fff;
    }

    .mbdg2 {
        background: #fff;
        color: #a1a3a5;
    }

    .mbdg2:hover {
        background: #FD397A;
        color: #fff;
    }

    .dataTables_wrapper .dataTable .selected th,
    .dataTables_wrapper .dataTable .selected td {
        background-color: #f4e92b !important;
    }

    #productdetails_list_wrapper {
        height: 300px;
        overflow-y: scroll;
    }
</style>
<?php
// foreach ($cinvoice as $key => $value) {
//     $invoice_id = $value->id;
//     $customer = $value->customer;
//     $attention = $value->attention;
//     $salesman1 = $value->salesman;
//     $quotedate = $value->quotedate;
//     $totalamount = $value->totalamount;
//     $discount = $value->discount;
//     $amountafterdiscount = $value->amountafterdiscount;
//     $totalvatamount = $value->vatamount;
//     $grandtotalamount = $value->grandtotalamount;
//     $notes = $value->notes;
//     $internal_reference = $value->internal_reference;
//     $preparedby = $value->preparedby;
//     $approvedby = $value->approvedby;
//     $qtn_ref = $value->qtn_ref;
//     $po_ref = $value->po_ref;
//     $discount_type = $value->discount_type;
//     $tpreview = $value->tpreview;
//     $currency = $value->currency;
//     $currencyvalue = $value->currencyvalue;
//     $dateofsupply = $value->valid_till;
//     $method = $value->sale_method;
//     $terms_conditions = $value->terms_conditions;
// }
foreach ($customers as $invcustomer) {
    $customerid = $invcustomer->id;
    $customercode = $invcustomer->cust_code;
    $customercategory = $invcustomer->cust_category;
    $customertype = $invcustomer->cust_type;
    $customergroup = $invcustomer->cust_group;
    $customername = $invcustomer->cust_name;
    $buldingname = $invcustomer->cust_add1;
    $streetname = $invcustomer->cust_add2;
    $country = $invcustomer->cust_country;
    // $cntry_name = $invcustomer->cntry_name;
    $district = $invcustomer->cust_region;
    $city = $invcustomer->cust_city;
    $postalcode = $invcustomer->cust_zip;
    $mobileno = $invcustomer->mobile1;
    $vatno = $invcustomer->vatno;
    $buyerid_crno = $invcustomer->buyerid_crno;
}
foreach ($currencylist as $currencylist) {
    if ($creditnote->currency == $currencylist->id) {
        $cur = $currencylist->currency_name;
    }
}

?>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Credit Note
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body pl-2 pr-2 pb-0">

            <form class="kt-form" id="kt_form">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">Invoice Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_4">Customer Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_2">Other Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3">Terms and Conditions</a>
                    </li>
                </ul>



                <div class="tab-content">
                    <div class="tab-pane p-3 active" id="kt_tabs_2_1" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Date')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="quotedate" id="quotedate" value="{{ date('d-m-Y',strtotime($creditnote->quotedate)) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Date of Supply')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="valid_till" id="valid_till" value="{{ date('d-m-Y',strtotime($creditnote->valid_till)) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Method')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="method" id="method" value="{{ ($creditnote->sale_method==1)?'Cash':'Credit' }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.QTN Ref')</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="qtn_ref" id="qtn_ref" value="{{ $creditnote->qtn_ref }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>PO Reference</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="po_ref" id="po_ref" value="{{ $creditnote->po_ref }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Attention')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="attention" id="attention" value="{{ $creditnote->attention }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Salesman')<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="salesman">
                                            <option value="">select</option>
                                            @foreach ($salesmen as $data)
                                            <option value="{{ $data->id }}" {{($creditnote->salesman == $data->id)?'selected':''}}>{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Currency')</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="currency" id="currency" value="{{ $creditnote->currency }}" readonly>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Currency Value')</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control currency_value" name="currency_value" id="currency_value" value="{{ $creditnote->currencyvalue }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Discount Type</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control discount_type" name="discount_type" id="discount_type" value="{{ $creditnote->discount_type }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="kt_tabs_2_2" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Notes')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea class="form-control" name="notes" id="notes">{{ $creditnote->notes }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Internal Reference')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea class="form-control" name="internal_reference" id="internal_reference">{{ $creditnote->internal_reference }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane p-3" id="kt_tabs_2_3" role="tabpanel">

                        <div class="col-lg-12">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-3">
                                    <label>@lang('app.Terms and Conditions')</label>
                                </div>
                                <div class="col-md-9 input-group-sm">
                                    <select class="form-control single-select kt-selectpicker" id="terms" name="terms">
                                        <option value="">select</option>
                                        @foreach ($termslist as $data)
                                        <option value="{{ $data->id }}" {{($creditnote->terms_conditions == $data->id)?'selected':''}}> {{ $data->term }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-12 input-group-sm">
                                    <div class="kt-tinymce">
                                        <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target">{{ $creditnote->tpreview }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="kt_tabs_2_4" role="tabpanel">
                        <div class="row" style="padding-bottom: 6px;">
                            <input type="hidden" name="customer" id="customer" value="{{ $creditnote->customer }}">
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Customer Category') }}</label>
                                    </div>
                                    <div class="col-md-8  input-group input-group-sm">
                                        @foreach ($areaList as $item)
                                        @if ($customercategory == $item->id)
                                        <input type="text" class="form-control single-select Cust_category" id="cust_category" name="cust_category" value="{{ $item->customer_category }}" readonly>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <input type="hidden" class="form-control branch" name="branch" id="branch" value="<?php echo $branch; ?>">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Customer Code') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control branch" name="cust_code" id="cust_code" placeholder="{{ __('customer.Customer Code') }}" autocomplete="off" readonly value="{{ $customercode }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row  pr-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Customer Type') }}</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        @foreach ($areaLists as $item)
                                        @if ($customertype == $item->id)
                                        <input type="text" class="form-control single-select" id="cust_type" name="cust_type" value="{{ $item->title }}" readonly>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Customer Group') }}</label>
                                    </div>
                                    <div class="col-md-8  input-group input-group-sm">
                                        @foreach ($group as $grp)
                                        @if ($customergroup == $grp->id)
                                        <input type="text" class="form-control single-select" name="cust_group" id="cust_group" value="{{ $item->title }}" readonly>
                                        @endif
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Customer Name') }}<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 ">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="cust_name" name="cust_name" autocomplete="off" placeholder="{{ __('customer.Customer Name/Company name') }}" value="{{ $customername }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Building No') }}</label>
                                    </div>
                                    <div class="col-md-8 ">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="building_no" name="building_no" autocomplete="off" placeholder="{{ __('customer.Building No') }}" value="{{ $buldingname }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Street Name') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group  input-group-sm">
                                            <input type="text" class="form-control" id="cust_region" name="cust_region" autocomplete="off" placeholder="{{ __('customer.Street Name') }}" value="{{ $streetname }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.District') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group  input-group-sm">
                                            <input type="text" class="form-control" id="cust_district" name="cust_district" autocomplete="off" placeholder="{{ __('customer.District') }}" value="{{ $district }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.City') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group  input-group-sm">
                                            <input type="text" class="form-control" id="cust_city" name="cust_city" autocomplete="off" placeholder="{{ __('customer.City') }}" value="{{ $city }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Country') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group  input-group-sm">
                                            @foreach ($country1 as $coun)
                                            @if ($country == $coun->id)
                                            <input type="text" name="cust_country" id="cust_country" class="form-control single-select" value="{{ $coun->cntry_name }}" readonly>
                                            @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Postal Code') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group  input-group-sm">
                                            <input type="text" class="form-control" id="cust_zip" name="cust_zip" autocomplete="off" placeholder="{{ __('customer.Postal Code') }}" value="{{ $postalcode }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Mobile Number') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group  input-group-sm">
                                            <input type="text" class="form-control" placeholder="{{ __('customer.Mobile') }}" id="mobile" name="mobile" autocomplete="off" value="{{ $mobileno }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Vat No') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group  input-group-sm">
                                            <input type="text" class="form-control" placeholder="{{ __('customer.Vat No') }}" id="vatno" name="vatno" autocomplete="off" value="{{ $vatno }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Buyer ID / CR No') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group  input-group-sm">
                                            <input type="text" class="form-control" placeholder="{{ __('customer.Buyer ID / CR No') }}" id="buyerid_crno" name="buyerid_crno" autocomplete="off" value="{{ $buyerid_crno }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- -->

                </div>


                <div class="row p-0" style="background-color:#f2f3f8;">
                    <div>
                        <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0;">
                        <br>
                        <br>
                        <div class=" pr-1 pl-1" style=" width: 100%;  background-color: #f2f3f8;   margin-top: -10px;">
                            <table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%; ">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="30px">#</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">Service</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Description')</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Unit')</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="80px">Sold Qty</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="80px">Returened</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="80px">Balance</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="90px">Return Qty</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="90px">@lang('app.Rate')</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;"> @lang('app.Amount')</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px">@lang('app.Discount')</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="60px;">@lang('app.VAT')</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;"> @lang('app.VAT Amount')</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;"> Total</th>
                                        <th style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="60px">@lang('app.Action')</th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($creditnoteProduct as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><input class="form-control kt-selectpicker productname" id="productname{{ $key + 1 }}" name="productname[]" data-id="{{ $key + 1 }}" value="{{ $product->product_name }}" readonly>
                                            <input type="hidden" class="form-control single-select item_id" name="item_id[]" id="item_id" data-id="{{ $key + 1 }}" value="{{ $product->product_id }}">
                                            <input type="hidden" class="form-control single-select qsell_saleinvoice_product_id" name="qsell_saleinvoice_product_id[]" id="qsell_saleinvoice_product_id" data-id="{{ $key + 1 }}" value="{{ $product->qsell_saleinvoice_product_id }}">
                                        </td>
                                        <td>
                                            <textarea class="form-control" rows="1" name="description[]" id="description{{ $key + 1 }}" data-id="{{ $key + 1 }}">{{ $product->description }}</textarea>
                                        </td>
                                        <td>
                                            <select class="form-control kt-selectpicker" id="unit{{ $key + 1 }}" name="unit[]" data-id="{{ $key + 1 }}">
                                                <option value="">select</option>
                                                @foreach ($unitlist as $data)
                                                @if ($product->unit == $data->id)
                                                <option value="{{ $data->id }}" selected="">
                                                    {{ $data->unit_name }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control originalquantity" name="originalquantity[]" id="originalquantity{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{$product->total_invoice}}" readonly></td>
                                        <td><input type="text" class="form-control returnedquantity" name="returnedquantity[]" id="returnedquantity{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{$product->credit_created_quantity-$product->quantity}}" readonly></td>
                                        <td><input type="text" class="form-control balancequantity" name="balancequantity[]" id="balancequantity{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{($product->credit_created_quantity-$product->quantity)+$product->quantity}}" readonly></td>
                                        <td><input type="text" class="form-control quantity" name="quantity[]" id="quantity{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{$product->quantity}}"></td>
                                        <td><input type="text" class="form-control rate" name="rate[]" id="rate{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{ $product->rate }}"></td>
                                        <td><input type="text" class="form-control amount" name="amount[]" id="amount{{ $key + 1 }}" data-id="{{ $key + 1 }}" readonly value="{{ $product->amount }}"></td>
                                        <td><input type="text" class="form-control discountamount" name="discountamount[]" id="discountamount{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{ ($product->discount!='')?$product->discount:0 }}"></td>
                                        <td><input type="text" class="form-control vat_percentage" name="vat_percentage[]" id="vat_percentage{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{ $product->vat_percentage }}"></td>
                                        <td><input type="text" class="form-control vatamount" name="vatamount[]" id="vatamount{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{ $product->vatamount }}"></td>
                                        <td><input type="text" class="form-control row_total row_total_change" name="row_total[]" id="row_total{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{ $product->totalamount }}"></td>
                                        <td>
                                            <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span> </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0; margin-top: 0;">
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('app.Total Amount Before Tax')</label>
                            </div>
                            <div class="col-md-8 input-group-sm">
                                <input type="text" class="form-control" name="totalamount" id="totalamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{ $creditnote->totalamount }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('app.Discount (Flat)')</label>
                            </div>
                            <div class="col-md-8 input-group-sm">
                                <input type="text" class="form-control discount" name="discount" id="discount" value="{{ $creditnote->discount }}" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('app.Amount After Discount')</label>
                            </div>
                            <div class="col-md-8 input-group-sm">
                                <input type="text" class="form-control" name="amountafterdiscount" id="amountafterdiscount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{ $creditnote->amountafterdiscount }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('app.VAT Amount')</label>
                            </div>
                            <div class="col-md-8 input-group-sm">
                                <input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{ $creditnote->vatamount }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label style="    font-size: 1.5rem; font-weight: bold; padding-top:4px">@lang('app.Total Amount')</label>
                            </div>
                            <div class="col-md-8 input-group-sm">
                                <input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly value="{{ $creditnote->grandtotalamount }}" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="invoiceid" id="invoiceid" value="{{ $creditnote->invoiceid }}">
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">

                            </div>
                            <div class="col-lg-12 kt-align-right">

                                <button type="reset" class="btn btn-secondary backHome"> <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg> &nbsp;@lang('app.Cancel')</button>
                                <button type="button" class="btn btn-primary" id="creditnote_submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg> &nbsp;@lang('app.Submit')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ url('/') }}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{ url('/') }}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/resources/js/inventory/purchaseproduct.js" type="text/javascript"></script>
<script src="{{ url('/') }}/resources/js/sell/creditnote.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $(".quantity").each(function() {
            var id = $(this).attr('data-id');
            row_calculate(id);
            row_vatcalculate(id);
        });
    });

    $("body").on("click", ".remove", function(event) {
        event.preventDefault();
        var row = $(this).closest('tr');
        var siblings = row.siblings();
        row.remove();
        siblings.each(function(index) {
            $(this).children().first().text(index + 1);
        });
        var vatamounts = 0;
        $('.vatamount').each(function() {
            var id = $(this).attr('data-id');
            var vatamount = $('#vatamount' + id + '').val();

            vatamounts += parseFloat(vatamount);

        });
        $('#totalvatamount').val(vatamounts.toFixed(2));
        totalamount_calculate();
        discount_calculate();
        final_calculate1();
    });


    $(document).on('click', '.closeBtn', function() {

        $("#myModal").modal("hide");
        $('#itemname').val("");
        $('#description').val("");
        $('#productunit').val("");
        $('#price').val("");

        $("#serviceModal").modal("hide");
        $('#servicename').val("");
        $('#servicedescription').val("");
        $('#serviceunit').val("");
        $('#serviceprice').val("");

    });
    var rowcount = $('#product_table tr').length;

    $(document.body).on("change", ".product_names", function() {
        product_name = $(this).val();
        createproduct(product_name);
    });


    function createproductvialoop(product_name_array) {
        for (i = 0; i < product_name_array.length; ++i) {
            createproduct(product_name_array[i]);
        }
    }
    $('body').on('change', '.quantity', function() {
        var id = $(this).attr('data-id');
        var qnty = $('#quantity' + id + '').val();
        var oqnty = $('#balancequantity[]' + id + '').val();
        if (parseFloat(oqnty) < parseFloat(qnty)) {
            toastr.warning('Return Quantity is Greater than Balance Quantity');
            $('#quantity' + id + '').val('0');
            $('#rate' + id + '').val('0');
            $('#amount' + id + '').val('0');
            $('#vatamount' + id + '').val('0');
        }
        row_calculate(id);
        row_vatcalculate(id);
    });
    $('body').on('change', '.rate', function() {
        var id = $(this).attr('data-id');
        row_vatcalculate(id);
        row_calculate(id);
        row_vatcalculate(id);
    });
    $('body').on('change', '.vatamount', function() {
        var id = $(this).attr('data-id');
        row_calculate(id);
        row_vatcalculate(id);
    });

    $('body').on('change', '.discountamount', function() {
        var id = $(this).attr('data-id');
        discount_calculate();
        row_vatcalculate(id);
        row_calculate(id);
    });


    $('body').on('change', '.vat_percentage', function() {
        var id = $(this).attr('data-id');
        row_vatcalculate(id);
        row_calculate(id);

    });

    function discount_calculate() {
        var totaldiscamount = 0;
        $('.discountamount').each(function() {
            var id = $(this).attr('data-id');
            var damount = $('#discountamount' + id + '').val();
            totaldiscamount += parseFloat(damount);
        });
        $('#discount').val(totaldiscamount.toFixed(2));
    }


    function row_vatcalculate(id) {
        var vatpercentage = $('#vat_percentage' + id + '').val();
        var quantity = $('#quantity' + id + '').val();
        var rate = $('#rate' + id + '').val();
        var rdiscount = $('#discountamount' + id + '').val();
        var total = parseFloat(quantity * rate) - parseFloat(rdiscount);
        vat_amount = (vatpercentage / 100) * total;
        $('#vatamount' + id + '').val(vat_amount.toFixed(2));
        var vatamounts = 0;
        $('.vatamount').each(function() {
            var id = $(this).attr('data-id');
            var vatamount = $('#vatamount' + id + '').val();
            vatamounts += parseFloat(vatamount);
        });
        $('#totalvatamount').val(vatamounts.toFixed(2));
    }

    function row_calculate(id) {
        var quantity = $('#quantity' + id + '').val();
        var rate = $('#rate' + id + '').val();
        var vatamount = $('#vatamount' + id + '').val();
        var disamount = $('#discountamount' + id + '').val();
        var total = parseFloat(quantity * rate);
        var rowtotal = parseFloat(total - disamount) + parseFloat(vatamount)
        $('#amount' + id + '').val(total.toFixed(2));
        $('#row_total' + id + '').val(rowtotal.toFixed(2));
        row_vatcalculate(id);
        totalamount_calculate();
        discount_calculate();
        final_calculate1();
    }

    $('body').on('change', '.vatamount', function() {
        var vatamounts = 0;
        $('.vatamount').each(function() {
            var id = $(this).attr('data-id');
            var vatamount = $('#vatamount' + id + '').val();
            vatamounts += parseFloat(vatamount);
        });
        $('#totalvatamount').val(vatamounts.toFixed(2));
    });

    function totalamount_calculate() {
        var totalamount = 0;
        $('.amount').each(function() {
            var id = $(this).attr('data-id');
            var amount = $('#amount' + id + '').val();
            totalamount += parseFloat(amount);
        });
        $('#totalamount').val(totalamount.toFixed(2));

    }

    $('body').on('change', '.discount', function() {
        final_calculate1();
    });

    function final_calculate1() {
        var vatamounts = 0;
        $('.vatamount').each(function() {
            var id = $(this).attr('data-id');
            var vatamount = $('#vatamount' + id + '').val();
            vatamounts += parseFloat(vatamount);
        });
        $('#totalvatamount').val(vatamounts.toFixed(2));
        var amountafterdiscount = 0;
        var grandtotalamount = 0;
        var discount = $('#discount').val();
        var totalamount = $('#totalamount').val();
        var totalvatamount = $('#totalvatamount').val();

        var discountamount = $('#discount').val();
        amountafterdiscount = parseFloat(totalamount) - parseFloat(discountamount);
        grandtotalamount = parseFloat(amountafterdiscount) + parseFloat(totalvatamount);
        $('#amountafterdiscount').val(amountafterdiscount.toFixed(2));
        $('#grandtotalamount').val(grandtotalamount.toFixed(2));
    }
    $(".vatamount").prop("readonly", true);
    $(document.body).on("change", "#currency", function() {
        var cid = $(this).val();
        $.ajax({
            url: "getcurrencydatavalue",
            method: "POST",
            data: {
                _token: $('#token').val(),
                id: cid
            },
            dataType: "json",
            success: function(data) {
                var termcondition = '';
                $.each(data, function(key, value) {
                    cvalue = value.value;
                });
                $('#currency_value').val(cvalue);
            }
        })
    });
    $(document).ready(function() {
        $(document).on('change', '.Cust_category', function() {
            var cat_id = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'getcategorycode',
                data: {
                    _token: $('#token').val(),
                    'id': cat_id
                },
                success: function(data) {
                    console.log(data);
                    $.each(data, function(key, value) {
                        $("#cust_code").val(value.customer_category + '/' + value.increment);
                    });
                },
                error: function() {}
            });
        });
    });
</script>
<script type="text/javascript">
    const channel = new BroadcastChannel("inventory");
    channel.addEventListener("message", e => {
        if (e.data == 'success') {
            product_list_table.ajax.reload();
        }
    });


    $(document.body).on("keyup  change", ".rate", function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));
    });


    $(document.body).on("keyup  change", ".amount", function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));
    });


    $(document.body).on("keyup  change", ".discountamount", function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));
    });


    $(document.body).on("keyup  change", ".vat_percentage", function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));
    });

    $(document.body).on("keyup  change", ".vatamount", function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));
    });

    $(document.body).on("keyup  change", ".row_total", function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));
    });

    $(document.body).on("keyup  change", ".quantity", function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));
    });
</script>
<script>
    $(document).ready(function() {
        $('.creditnote_sell').addClass('kt-menu__item--active');
    });
</script>
@endsection