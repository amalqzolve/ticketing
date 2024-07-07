@extends('sell.common.layout')
@section('content')
<style>
    #table-wrapper {
        position: relative;
    }

    #table-scroll {
        height: 150px;
        overflow: auto;
        margin-top: 20px;
    }

    #table-wrapper {
        width: 100%;

    }

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
        /* color: #595d6e; */
    }

    #productdetails_list_wrapper {
        height: 300px;
        overflow-y: scroll;
    }

    .table-responsive {
        overflow-x: scroll;
    }
</style>
<?php
foreach ($invoice as $invoices) {
    $id = $invoices->id;
    $quotedate = $invoices->quotedate;
    $valid_till = $invoices->valid_till;
    $qtn_ref = $invoices->qtn_ref;
    $po_ref = $invoices->po_ref;
    $delivery_period = $invoices->delivery_period;
    $attention = $invoices->attention;
    $salesman = $invoices->salesman;
    $currency = $invoices->currency;
    $currencyvalue = $invoices->currencyvalue;
    $preparedby = $invoices->preparedby;
    $approvedby = $invoices->approvedby;
    $payment_terms = $invoices->payment_terms;
    $discount_type = $invoices->discount_type;
    $customer = $invoices->customer;
    $terms_conditions = $invoices->terms_conditions;
    $notes = $invoices->notes;
    $internal_reference = $invoices->internal_reference;
    $tpreview = $invoices->tpreview;
    $totalamount = $invoices->totalamount;
    $discount = $invoices->discount;
    $amountafterdiscount = $invoices->amountafterdiscount;
    $vatamount = $invoices->vatamount;
    $grandtotalamount = $invoices->grandtotalamount;
    $sale_method = $invoices->sale_method;
    $soid = $invoices->saleorder_id;
    $paid_amount = $invoices->paid_amount;
    $balance_amount = $invoices->balance_amount;
    $useadvance = $invoices->useadvance;
    $invoice_number = $invoices->invoice_number;
    $invoice_date = date('d-m-Y', strtotime($invoices->quotedate));
    $valid_till = date('d-m-Y', strtotime($invoices->valid_till));
}
foreach ($customers as $customers) {
    $cust_code = $customers->cust_code;
    $cust_type = $customers->type;
    $cust_group = $customers->group;
    $cust_category = $customers->customer_category;
    $cust_name = $customers->cust_name;
    $cust_add1 = $customers->cust_add1;
    $cust_add2 = $customers->cust_add2;
    $cust_country = $customers->cntry_name;
    $cust_region = $customers->cust_region;
    $cust_city = $customers->cust_city;
    $cust_zip = $customers->cust_zip;
    $mobile = $customers->mobile1;
    $vatno = $customers->vatno;
    $buyerid_crno = $customers->buyerid_crno;
}
foreach ($quotation as $quotations) {
    $qnotes = $quotations->notes;
    $qintre = $quotations->internal_reference;
    $qpreparedby = $quotations->preparedby;
    $sonotes = $quotations->sonotes;
    $sointre = $quotations->sointernal_reference;
    $sopreparedby = $quotations->sopreparedby;
    $quote_id = $quotations->quote_id;
    $soid = $quotations->id;
    $qdate = $quotations->qdate;
    $sodate = $quotations->sodate;
}

?>
<input type="hidden" name="invoice_id" id="invoice_id" value="{{ $id }}">
<input type="hidden" name="customer" id="customer" value="{{ $customer }}">
<input type="hidden" name="soid" id="soid" value="{{ $soid }}">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="#" class="btn kt-subheader__btn-primary">
                    @lang('app.Back')
                </a>
            </div>
        </div>
    </div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Sales Invoice Edit #{{$id}}
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
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_2">@lang('app.Other Information')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3"> Terms & conditions</a>
                    </li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane p-2 active" id="kt_tabs_2_1" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Date')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" name="quotedate" id="quotedate" value="{{ $invoice_date }}">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>
                                            Date of Supply</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" name="valid_till" id="valid_till" value="{{ $valid_till }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Currency')<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <select class="form-control single-select currency kt-selectpicker" name="currency" id="currency">
                                            <option value="">Select</option>
                                            @foreach ($currencylist as $data)
                                            <option value="{{ $data->id }}" @if ($currency==$data->id) selected="" @endif>
                                                {{ $data->currency_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Currency Value')</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control currency_value" name="currencyvalue" id="currencyvalue" value="{{ $currencyvalue }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Prepared By')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="preparedby">
                                            <option value="">select</option>
                                            @foreach ($salesmen as $data)
                                            <option value="{{ $data->id }}" @if ($preparedby==$data->id) selected=""; @endif>
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Method')<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="method">
                                            <option value="1" @if ($sale_method==1) selected="" @endif>Cash</option>
                                            <option value="2" @if ($sale_method==2) selected="" @endif>
                                                Credit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="tab-pane p-3" id="kt_tabs_2_2" role="tabpanel">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Quote ID')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="quoteid" id="quoteid" value="{{ $quote_id }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>SO ID</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">

                                        <input type="text" class="form-control" name="poid" id="poid" value="{{ $soid }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Quote Date')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="quotedate" id="quotedate" value="{{ $qdate }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>SO Date</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="podate" id="podate" value="{{ $sodate }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Quote Prepared By</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="qpreparedby" disabled="">
                                            <option value="">select</option>
                                            @foreach ($salesmen as $data)
                                            <option value="{{ $data->id }}" @if ($qpreparedby==$data->id) selected=""; @endif>
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>So Prepared By</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="sopreparedby" disabled="">
                                            <option value="">select</option>
                                            @foreach ($salesmen as $data)
                                            <option value="{{ $data->id }}" @if ($sopreparedby==$data->id) selected=""; @endif>
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.QTN Ref')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="qtn_ref" id="qtn_ref" value="{{ $qtn_ref }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>PO Reference</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="po_ref" id="po_ref" value="{{ $po_ref }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Attention')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="attention" id="attention" value="{{ $attention }}" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Salesman')<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="salesman" disabled="">
                                            <option value="">select</option>
                                            @foreach ($salesmen as $data)
                                            <option value="{{ $data->id }}" @if ($salesman==$data->id) selected="" @endif>
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Discount Type</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="discount_type" disabled="">
                                            <option value="1" @if ($discount_type==1) selected="" @endif>Flat</option>
                                            <option value="2" @if ($discount_type==2) selected="" @endif>
                                                Percentage</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Notes')</label>
                                    </div>
                                    <div class="col-md-4 input-group-sm">
                                        <textarea class="form-control" name="notes" id="notes">{{ $notes }}</textarea>
                                    </div>
                                    <div class="col-md-4  input-group-sm">
                                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" data-type="add" data-toggle="modal" data-target="#noteshis">Notes</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Internal Reference')</label>
                                    </div>
                                    <div class="col-md-4 input-group-sm">
                                        <textarea class="form-control" name="internal_reference" id="internal_reference">{{ $internal_reference }}</textarea>
                                    </div>
                                    <div class="col-md-4 input-group-sm">
                                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" data-type="add" data-toggle="modal" data-target="#interhis">Internal Reference</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane p-3" id="kt_tabs_2_3" role="tabpanel">
                        <div class="col-lg-12">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-3">
                                    <label> Terms & conditions</label>
                                </div>
                                <div class="col-md-9 input-group-sm">
                                    <select class="form-control single-select kt-selectpicker" id="terms_conditions" name="terms_conditions">
                                        <option value="">select</option>
                                        @foreach ($termslist as $data)
                                        <option value="{{ $data->id }}" @if ($terms_conditions==$data->id) selected="" @endif>
                                            {{ $data->term }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-12 input-group-sm">
                                    <div class="kt-tinymce">
                                        <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target">{{ $tpreview }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="kt_tabs_2_4" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Customer Category') }}</label>
                                    </div>
                                    <div class="col-md-8  input-group input-group-sm">
                                        <input type="text" class="form-control single-select Cust_category" id="cust_category" name="cust_category" value="{{ $cust_category }}" readonly>
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
                                            <input type="text" class="form-control branch" name="cust_code" id="cust_code" placeholder="{{ __('customer.Customer Code') }}" autocomplete="off" readonly value="{{ $cust_code }}">
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
                                        <input type="text" class="form-control single-select" id="cust_type" name="cust_type" value="{{ $cust_type }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>{{ __('customer.Customer Group') }}</label>
                                    </div>
                                    <div class="col-md-8  input-group input-group-sm">
                                        <input type="text" class="form-control single-select" name="cust_group" id="cust_group" value="{{ $cust_group }}" readonly>
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
                                            <input type="text" class="form-control" id="cust_name" name="cust_name" autocomplete="off" placeholder="{{ __('customer.Customer Name/Company name') }}" value="{{ $cust_name }}">
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
                                            <input type="text" class="form-control" id="building_no" name="building_no" autocomplete="off" placeholder="{{ __('customer.Building No') }}" value="{{ $cust_add1 }}" readonly>
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
                                            <input type="text" class="form-control" id="cust_region" name="cust_region" autocomplete="off" placeholder="{{ __('customer.Street Name') }}" value="{{ $cust_add2 }}" readonly>
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

                                            <input type="text" class="form-control" id="cust_district" name="cust_district" autocomplete="off" placeholder="{{ __('customer.District') }}" value="{{ $cust_region }}" readonly>
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

                                            <input type="text" class="form-control" id="cust_city" name="cust_city" autocomplete="off" placeholder="{{ __('customer.City') }}" value="{{ $cust_city }}" readonly>
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
                                            <input type="text" name="cust_country" id="cust_country" class="form-control single-select" value="{{ $cust_country }}">


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

                                            <input type="text" class="form-control" id="cust_zip" name="cust_zip" autocomplete="off" placeholder="{{ __('customer.Postal Code') }}" value="{{ $cust_zip }}" readonly>
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

                                            <input type="text" class="form-control" placeholder="{{ __('customer.Mobile') }}" id="mobile" name="mobile" autocomplete="off" value="{{ $mobile }}" readonly>
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
                                        <label>Buyer ID / CR No</label>
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
                </div>






                <div class="row p-0" style="background-color:#f2f3f8;">
                    <div class="col-12 p-0">
                        <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0;">


                        <br>
                        <br>
                        <div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="product_table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">#</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; width: 16%;   padding: 2px 7px !important;">Service</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Description')</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Unit')</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Purchase @lang('app.Rate')</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Quantity')</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Selling @lang('app.Rate')</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Amount')</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Discount')</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; display: none; padding: 2px 7px !important;">Dis Amount </th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; ">@lang('app.VAT')</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.VAT Amount')</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Total Amount')</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; "><!-- @lang('app.Action') --></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice_product as $key => $invoice_products)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <input style="width: 4cm;" type="hidden" class="form-control single-select productrowid kt-selectpicker" name="productrowid[]" id="productrowid{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{ $invoice_products->id }}">
                                                <input style="width: 4cm;" type="hidden" class="form-control single-select so_item_id kt-selectpicker" name="so_item_id[]" id="so_item_id{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{ $invoice_products->so_item_id }}">
                                                <div class="input-group input-group-sm">
                                                    <input style="width: 4cm;" type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{ $invoice_products->product_name }}" readonly>
                                                    <div>
                                                        <input type="hidden" class="form-control single-select item_id" name="item_id[]" id="item_id{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{ $invoice_products->item_id }}">
                                            </td>
                                            <td>
                                                <textarea class="form-control" id="description{{ $key + 1 }}" name="description[]" rows="1" data-id={{ $key + 1 }} style=" height: 30px !important; width:3cm;">{{ $invoice_products->description }}</textarea>
                                            </td>


                                            <td>
                                                <div>
                                                    <select style="    width: 3cm;" class="form-control form-control-sm single-select unit kt-selectpicker" data-id="{{ $key + 1 }}" name="unit[]" id="unit" disabled="">
                                                        <option value="">select</option>
                                                        @foreach ($unitlist as $data)
                                                        <option value="{{ $data->id }}" @if ($invoice_products->unit == $data->id) selected="" @endif>
                                                            {{ $data->unit_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group input-group-sm">
                                                    <input type="hidden" class="form-control unitvalue" name="unitvalue[]" id="unitvalue{{ $key + 1 }}" data-id="{{ $key + 1 }}">
                                                </div>
                                                <div class="input-group input-group-sm">
                                                    <input type="hidden" class="form-control quantity_value" name="quantity_value[]" id="quantity_value{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="1">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" style="width: 1cm; width: 1cm;" class="form-control integerVal" name="purchaserate[]" id="purchaserate{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{$invoice_products->purchaserate}}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" style="    width: 1cm;" class="form-control quantity" data-id="{{ $key + 1 }}" name="quantity[]" id="quantity{{ $key + 1 }}" value="{{ $invoice_products->quantity }}">
                                                    <input type="hidden" style="    width: 1cm;" class="form-control invoiced" data-id="{{ $key + 1 }}" name="invoiced[]" id="invoiced{{ $key + 1 }}" value="{{ $invoice_products->quantity }}">
                                                    <input type="hidden" style="    width: 1cm;" class="form-control originalquantity" data-id="{{ $key + 1 }}" name="originalquantity[]" id="originalquantity{{ $key + 1 }}" value="{{$invoice_products->quantity + $invoice_products->invoice_remaining }}">

                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" style="width: 1cm;width: 1cm;" class="form-control rate" name="rate[]" id="rate{{ $key + 1 }}" data-id="{{ $key + 1 }}" value="{{ $invoice_products->rate }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control amount" name="amount[]" data-id="{{ $key + 1 }}" id="amount{{ $key + 1 }}" value="{{ $invoice_products->amount }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control discount_type_amount" data-id="{{ $key + 1 }}" name="discount_type_amount[]" id="discount_type_amount{{ $key + 1 }}" value="{{ $invoice_products->discount }}">
                                                </div>
                                            </td>
                                            <td style=" display: none;">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control discountamount" data-id="{{ $key + 1 }}" name="discountamount[]" id="discountamount{{ $key + 1 }}" value="">
                                                </div>
                                            </td>
                                            <td>
                                                <select style="    width: 2cm;" class="form-control form-control-sm single-select vat_percentage kt-selectpicker" data-id="{{ $key + 1 }}" name="vat_percentage[]" id="vat_percentage{{ $key + 1 }}">
                                                    @foreach ($vatlist as $data)
                                                    <option value="{{ $data->total }}" @if ($invoice_products->vat_percentage == $data->total) selected="" @endif>
                                                        {{ $data->total }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control vatamount form-control-sm" name="vatamount[]" id="vatamount{{ $key + 1 }}" data-id={{ $key + 1 }} value="{{ $invoice_products->vatamount }}" readonly>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control row_total row_total_change" data-id="{{ $key + 1 }}" name="row_total[]" id="row_total{{ $key + 1 }}" value="{{ $invoice_products->totalamount }}">
                                                </div>
                                            </td>
                                            <td style="background-color: white;">
                                                <div class="row">
                                                    <div class="col-md-6 kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">
                                                        <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">
                                                            <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <table style="width:100%">
                                <tr>
                                    <td>
                                        @if ($saletype == 'Direct')
                                        <!-- <button type="button" class="btn btn-primary btn-sm addproduct">Add New</button>&nbsp; &nbsp; &nbsp; &nbsp;</td> -->
                                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" data-type="add" data-toggle="modal" data-target="#kt_modal_4_4"><i class="la la-plus"></i>Line Iteam</button>

                                        <a href="{{ url('/') }}/Add-Product" target="_blank" class="btn btn-light btn-elevate btn-icon-sm float-right mr-2">

                                            New Product
                                        </a>
                                        @endif
                                    </td>

                                </tr>
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
                                <input type="text" class="form-control" name="totalamount" id="totalamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{ $totalamount }}">
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label>Discount Amount</label>
                            </div>
                            <div class="col-md-8 input-group-sm">

                                <input type="text" class="form-control discount" name="discount" id="discount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{ $discount }}">


                                <!-- </div> -->
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

                                <input type="text" class="form-control" name="amountafterdiscount" id="amountafterdiscount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{ $amountafterdiscount }}">


                                <!-- </div> -->
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

                                <input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{ $vatamount }}">

                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label style="    font-size: 1.5rem;
    font-weight: bold; padding-top:4px">@lang('app.Total Amount')</label>
                            </div>
                            <div class="col-md-8 input-group-sm">

                                <input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly style="
                                        background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem;
    font-weight: bold; color: #646c9a; padding-top: 0px;" value="{{ $grandtotalamount }}">


                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-4">
                                    <label>Use Advance</label>
                                </div>

                                <div class="col-md-8 input-group-sm">

                                    <select class="form-control single-select kt-selectpicker useadvance" id="useadvance">
                                        <option value="1" @if ($useadvance==1) selected="" @endif>
                                            Yes</option>
                                        <option value="2" @if ($useadvance==2) selected="" @endif>No
                                        </option>
                                    </select>


                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row pr-md-3">
                                <div class="col-md-4">
                                    <label>Customer Credit Balance</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group  input-group-sm">

                                        <input type="text" class="form-control" id="creditbalance" name="creditbalance" readonly value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-4">
                                    <label>@lang('app.Paid Amount')</label>
                                </div>
                                <div class="col-md-8 input-group-sm">

                                    <input type="text" class="form-control paidamount" name="paidamount" id="paidamount" value="{{ $paid_amount }}" style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">

                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-4">
                                    <label>@lang('app.Balance Amount')</label>
                                </div>
                                <div class="col-md-8 input-group-sm">

                                    <input type="text" class="form-control" name="balanceamount" id="balanceamount" value="{{ $balance_amount }}" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">

                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>





                <input type="hidden" name="branch" id="branch" value="{{ $branch }}">
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">

                            </div>
                            <div class="col-lg-12 kt-align-right">

                                <button type="reset" class="btn btn-secondary backHome"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg> &nbsp;@lang('app.Cancel')</button>


                                <button type="button" class="btn btn-primary invoice_edit_sell_byquote" id="invoice_edit_sell_byquote"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg> &nbsp;@lang('app.Save')</button>

                            </div>
                        </div>
                    </div>
                </div>



            </form>



        </div>
    </div>
</div>



<div class="modal fade" id="kt_modal_4_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="min-width: 1024px;">
    <input type="hidden" name="id" id="id" value="">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Service</h5>




                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>


            </div>
            <div class="modal-body">
                <form class="kt-form kt-form--label-right" id="category-form" name="category-form">
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="kt-portlet__head-toolbar">


                            </div>


                            <?php
                            if (session()->has('warehouse')) {
                                $default_warehouse = Session::get('warehouse');
                                $default_warehouse_name = Session::get('default_warehouse_name');
                            } else {
                                foreach ($warehouses as $key => $value) {
                                    if ($value->warehouse_default == 1) {
                                        $default_warehouse = $value->id;
                                        $default_warehouse_name = $value->warehouse_name;
                                    }
                                }
                            }

                            ?>
                            <input type="hidden" name="wid" id="wid" value="{{ $default_warehouse }}">





                            <div class="col-9" style=" z-index: 100;">

                                <div class="form-group pt-2">

                                    <select class="form-control form-control-sm setwarehouse hideButton" style="z-index: 100;">
                                        <option>Select Warehouse</option>



                                        @foreach ($warehouses as $data)
                                        <option value="{{ $data->id }}" {{($data->id == $default_warehouse)?'selected':''}} data-wid="{{ $data->id }}" data-wname="{{ $data->warehouse_name }}" wid="{{ $data->id }}" wname="{{ $data->warehouse_name }}">{{ $data->warehouse_name }}
                                        </option>
                                        @endforeach



                                    </select>
                                </div>
                            </div>
                            <div class="col-3">

                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-checkable dataTable no-footer" id="productdetails_list">
                        <thead>
                            <tr>
                                <th>{{ __('mainproducts.S.No') }}</th>
                                <th>Service</th>
                                <th>{{ __('app.Description') }}</th>
                                <th>{{ __('mainproducts.Unit') }}</th>
                                <th>Service Cost</th>
                                <th>{{ __('mainproducts.Selling price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <table class="table" style="width:50%; margin-left:50%;">
                        <thead class="thead-light">
                            <tr>
                                <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total items
                                    selected</td>
                                <td style="border-bottom: 1px dashed gray; text-align: right;">
                                    <input type="text" id="selected_items" readonly class="form-control input form-control-sm" style="border:0; text-align: right; background-color: #fff; height: calc(0.5em + 1rem + 2px);font-size: 20px; font-weight:bold;">
                                </td>
                            </tr>

                            <tr>
                                <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total
                                    amount</td>
                                <td style="border-bottom: 1px dashed gray;text-align: right;">
                                    <input type="text" id="selected_amount" readonly class="form-control form-control-sm" style="border:0; text-align: right; background-color: #fff; height: calc(0.5em + 1rem + 2px);font-size: 20px; font-weight:bold;">

                                </td>
                            </tr>

                        </thead>
                    </table>
                    <button type="button" class="btn btn-brand btn-elevate btn-icon-sm float-right ml-2" id="datatableadd"><i class="la la-plus"></i>Add</button>
                    <button type="button" class="btn btn-secondary btn-icon-sm float-right" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg> Cancel</button>


            </div>
        </div>

    </div>
</div>

</div>

<div class="modal fade" id="kt_modal_4_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="min-width: 1024px;">
    <input type="hidden" name="id" id="id" value="">


    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Product History </h3> <br>
                <hr>


                <h6><span>Product Name</span> <input type="text" name="productnamehis" id="productnamehis" style="background-color: #ffffff00;  border: none;  text-align: right;font-weight: bold; color: #646c9a; padding-top: 0px;"><br>
                    <span>Customer Name</span> <input type="text" name="customerhis" id="customerhis" style="background-color: #ffffff00;  border: none;  text-align: right;font-weight: bold; color: #646c9a; padding-top: 0px;">
                </h6>


                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>


            </div>
            <div class="modal-body">
                <form class="kt-form kt-form--label-right" id="category-form" name="category-form">
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="kt-portlet__head-toolbar">


                            </div>






                            <div class="col-3">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="table-wrapper">
                                <div id="table-scroll">
                                    <h3>
                                        <center>Invoice</center>
                                    </h3>

                                    <table class="table table-striped table-hover table-checkable dataTable no-footer" id="productinvoicehistory">
                                        <thead>
                                            <tr>
                                                <th>{{ __('mainproducts.S.No') }}</th>
                                                <th>Invoice ID</th>

                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                                <th>Vat Amount</th>
                                                <th>Discount</th>
                                                <th>Total</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="table-wrapper">
                                <div id="table-scroll">
                                    <h3>
                                        <center>Quotation</center>
                                    </h3>
                                    <table class="table table-striped table-hover table-checkable dataTable no-footer" id="productquotationhistory">
                                        <thead>
                                            <tr>
                                                <th>{{ __('mainproducts.S.No') }}</th>
                                                <th>Quotation ID</th>

                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                                <th>Vat Amount</th>
                                                <th>Discount</th>
                                                <th>Total</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>







            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="noteshis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="min-width: 1024px;">
    <input type="hidden" name="id" id="id" value="">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notes</h5>




                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>


            </div>
            <div class="modal-body">
                <form class="kt-form kt-form--label-right" id="category-form" name="category-form">
                    <div class="kt-portlet__body">
                        <div class="body">
                            <div class="timeline">
                                <div class="containers left">
                                    <div class="content">
                                        <h2>Quotation</h2>
                                        <p>Quote Id : {{ $quote_id }}</p>
                                        <p>{{ $qnotes }}</p>
                                    </div>
                                </div>
                                <div class="containers right">
                                    <div class="content">
                                        <h2>Sales Order</h2>
                                        <p>So ID : {{ $soid }}</p>
                                        <p>{{ $sonotes }}</p>
                                    </div>
                                </div>





                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="interhis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="min-width: 1024px;">
    <input type="hidden" name="id" id="id" value="">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Internal Reference</h5>




                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>


            </div>
            <div class="modal-body">
                <form class="kt-form kt-form--label-right" id="category-form" name="category-form">
                    <div class="kt-portlet__body">
                        <div class="body">
                            <div class="timeline">
                                <div class="containers left">
                                    <div class="content">
                                        <h2>Quotation</h2>
                                        <p>Quote Id : {{ $quote_id }}</p>
                                        <p>{{ $qintre }}</p>
                                    </div>
                                </div>
                                <div class="containers right">
                                    <div class="content">
                                        <h2>Sales Order</h2>
                                        <p>So ID : {{ $soid }}</p>
                                        <p>{{ $sointre }}</p>
                                    </div>
                                </div>





                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
</div>

<style type="text/css">
    .hideButton {
        display: none
    }

    .error {
        color: red
    }
</style>
<!--end::Modal-->
@endsection

@section('script')
<script>
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



    function createproduct(product_name) {

        $.ajax({
            url: "getproduct_name_details_sell_quotation",
            method: "POST",
            data: {
                _token: $('#token').val(),
                id: product_name
            },
            dataType: "json",
            success: function(data) {

                $.each(data, function(key, value) {
                    rowcount = $('#product_table tr').length;
                    /* alert(rowcount);*/
                    var des = value.description == null ? value.description : '';
                    if (des == null) {
                        des = '-';
                    }
                    var selling_price = (value.selling_price != null) ? value.selling_price : 0;
                    var so = (value.so != null) ? value.so : 0;
                    if (so == null) {
                        so = '-';
                    }

                    if (value.available_stock == null) {
                        value.available_stock = '-';
                    }
                    var product = '';
                    product += '<tr>\
                     <td>' + rowcount + '</td><td>\
                     <div class="input-group input-group-sm">\
                     <input  style="    width: 4cm;" type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname' +
                        rowcount + '" data-id="' + rowcount + '" value="' + value.product_name +
                        ' ">\
                     <div>\
                     <input type="hidden" class="form-control single-select item_id" name="item_id[]" id="item_id' +
                        rowcount + '" data-id="' + rowcount + '" value="' + value.product_id + '">\
                     </td>\
                     <td><textarea  class="form-control" id="description' + rowcount +
                        '" name="description[]" rows="1" data-id=' + rowcount +
                        ' style=" height: 30px !important; width:3cm;">' + des +
                        '</textarea>\</td>\
                     <td>\
                     <div>\
                     <select style="    width: 3cm;" class="form-control form-control-sm single-select unit kt-selectpicker" name="unit[]" id="unitvalue' + rowcount +
                        '"  data-id="' + rowcount + '">\
                     <option value="">select</option>\
             @foreach ($unitlist as $data)\
                  <option value="{{ $data->id }}">{{ $data->unit_name }}</option>\
                  @endforeach\
                     </select>\
                      </div>\
                     <div class="input-group input-group-sm">\
                     <input type="hidden" class="form-control unitvalue" name="unitvalue[]" id="unitvalue' + rowcount +
                        '"  data-id="' + rowcount + '">\
                     </div>\
                     <div class="input-group input-group-sm">\
                     <input type="hidden" class="form-control quantity_value" name="quantity_value[]" id="quantity_value' +
                        rowcount + '"  data-id="' + rowcount + '" value="1">\
                     </div>\
                     </td>\
                     <td>\
                     <div class="input-group input-group-sm">\
                      <input type="text"  style="    width: 1cm;" class="form-control quantity"  data-id="' + rowcount +
                        '" name="quantity[]" id="quantity' + rowcount +
                        '" value="1">\
                     </div>\
                     </td>\
                     <td>\
                     <div class="input-group input-group-sm">\
                     <input type="text"  style="  style="    width: 1cm;"  width: 1cm;" class="form-control rate" name="rate[]" id="rate' + rowcount + '"  data-id="' +
                        rowcount + '" value="' + selling_price + '">\
                     </div>\
                     </td>\
                     <td>\
                     <div class="input-group input-group-sm">\
                     <input type="text" class="form-control amount" name="amount[]"  data-id="' + rowcount +
                        '" id="amount' + rowcount + '" readonly value="' + selling_price + '">\
                     </div>\
                     </td>\
                     <td>\
                     <div class="input-group input-group-sm">\
                     <input type="text" class="form-control discount_type_amount"  data-id="' + rowcount +
                        '" name="discount_type_amount[]" id="discount_type_amount' + rowcount + '" value="0">\
                     </div>\
                     </td>\
                     <td style=" display: none;">\
                     <div class="input-group input-group-sm">\
                     <input type="text" class="form-control discountamount"  data-id="' + rowcount +
                        '" name="discountamount[]" id="discountamount' + rowcount +
                        '" value="0">\
                     </div>\
                     </td>\
                    <td>\
        <select  style="    width: 2cm;" class="form-control form-control-sm single-select vat_percentage kt-selectpicker" data-id="' + rowcount +
                        '" name="vat_percentage[]" id="vat_percentage' + rowcount + '">\
                @foreach ($vatlist as $data)\
                  <option value="{{ $data->total }}" <?php if ($data->default_tax == 1) {
                                                            echo 'selected';
                                                        } ?> >{{ $data->total }}</option>\
                  @endforeach\
    </select>\
    </td>\
                    <td>\
                     <input type="text" class="form-control vatamount form-control-sm" name="vatamount[]" id="vatamount' +
                        rowcount + '" data-id=' + rowcount + ' value="0"    readonly>\
                     </td>\
                      <td>\
                     <div class="input-group input-group-sm">\
                     <input type="text" class="form-control row_total row_total_change"  data-id="' + rowcount +
                        '" name="row_total[]" id="row_total' + rowcount + '">\
                     </div>\
                     </td>\
                     <td  style="background-color: white;">\
                     <div class="row">\
                          <div class="col-md-6 kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">\
                                              <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
                                              <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>\
                                           </div>\
                                            </div>\
                            </td>\
                     </tr>';

                    $('#product_table').append(product);
                    $('.vat_percentage').trigger("change");
                    $("#unit" + rowcount).val(value.unit).change();
                    $("#unitvalue" + rowcount).val(value.unit);
                });

                rowcount++;
            }
        })
    }


    $('body').on('change', '#discount_type', function() {
        var rowcount = $('#product_table tr').length;
        for (let index = 0; index < rowcount; index++)
            row_calculate(id);
        final_calculate1();
    });

    $('body').on('keyup', '.row_total_change', function() {
        var row = $(this).attr('data-id');
        findRevercCalculation(row);

    });

    function findRevercCalculation(row) {
        var vatPercentage = getNum($('#vat_percentage' + row).val());
        var totalAmt = getNum($('#row_total' + row).val());
        var discountText = getNum($('#discount_type_amount' + row).val());
        var qty = getNum($('#quantity' + row).val());
        var amountBoforeDiscount = parseFloat(totalAmt) / (1 + (parseFloat(vatPercentage) / 100));
        var discount = 0;
        if ($('#discount_type').val() == 1) //discount as flat
            discount = parseFloat(discountText);
        else if ($('#discount_type').val() == 2) { ////discount as %
            discount = amountBoforeDiscount * (discountText / 100);
        }
        var amount = amountBoforeDiscount + discount;
        $('#amount' + row).val(amount.toFixed(2));

        var vat_amount = (vatPercentage / 100) * amount;
        $('#vatamount' + row).val(vat_amount.toFixed(2));

        var rate = amount / qty;
        $('#rate' + row).val(rate.toFixed(2));

        final_calculate1();
    }



    $('body').on('keyup', '.quantity', function() {
        var id = $(this).attr('data-id');

        var oquantity = $("#originalquantity" + id).val();
        var quantity = $("#quantity" + id).val();
        if (quantity == "" || quantity == 0) {
            $('#invoice_edit_sell_byquote').attr('disabled', true);
            toastr.warning("Invoice Quantity Cannot be 0");
        } else if (parseFloat(quantity) > parseFloat(oquantity)) {
            $('#invoice_edit_sell_byquote').attr('disabled', true);
            toastr.warning("Quantity Cannot be Greater than Balance Quantity");
        } else {
            $('#invoice_edit_sell_byquote').attr('disabled', false);
            row_vatcalculate(id);
            row_calculate(id);
        }
    });

    // $('body').on('keyup', '.quantity', function() {
    //     var id = $(this).attr('data-id');
    //     <?php
            //     if ($saletype == 'By Quote') {
            //     
            ?>
    //         var oquantity = $("#originalquantity" + id).val();
    //         var quantity = $("#quantity" + id).val();
    //         if (quantity == "" || quantity == 0) {
    //             $('#invoice_edit_sell_byquote').attr('disabled', true);
    //             toastr.warning("Invoice Quantity Cannot be 0");
    //         } else if (parseFloat(quantity) > parseFloat(oquantity)) {
    //             $('#invoice_edit_sell_byquote').attr('disabled', true);
    //             toastr.warning("Quantity Cannot be Greater than Original Quantity");
    //         } else {
    //             $('#invoice_edit_sell_byquote').attr('disabled', false);
    //             row_vatcalculate(id);
    //             row_calculate(id);
    //         }
    //     <?php
            //     } else {
            //     
            ?> row_vatcalculate(id);
    //         row_calculate(id);
    //     <?php
            //     }
            //     
            ?>
    // });
    $('body').on('keyup', '.rate', function() {
        var id = $(this).attr('data-id');
        row_vatcalculate(id);
        row_calculate(id);
        row_vatcalculate(id);
    });
    $('body').on('keyup', '.vatamount', function() {
        var id = $(this).attr('data-id');
        row_calculate(id);
        row_vatcalculate(id);
    });

    $('body').on('keyup', '.discountamount', function() {
        var id = $(this).attr('data-id');

        discount_calculate();
        row_vatcalculate(id);
        row_calculate(id);
    });


    $('body').on('keyup', '.discount_type_amount', function() {
        var id = $(this).attr('data-id');

        discount_calculate();
        row_vatcalculate(id);
        row_calculate(id);
        discount_calculate_new();
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
        totaldiscamount = getNum(totaldiscamount);
        $('#discount').val(totaldiscamount.toFixed(2));

    }


    function discount_calculate_new() {


        var discount_type = $('#discount_type').val();

        var totaldiscamount = 0;
        if (discount_type == 1) {
            $('.discount_type_amount').each(function() {
                var id = $(this).attr('data-id');
                var damount = $('#discount_type_amount' + id + '').val();
                $('#discountamount' + id + '').val(damount);

                totaldiscamount += parseFloat(damount);
                row_vatcalculate(id);
                row_calculate(id);
            });
        } else if (discount_type == 2) {
            $('.discount_type_amount').each(function() {


                var id = $(this).attr('data-id');
                var dispercentage = $('#discount_type_amount' + id + '').val();
                dispercentage = getNum(dispercentage);
                var quantity = $('#quantity' + id + '').val();
                quantity = getNum(quantity);
                var rate = $('#rate' + id + '').val();
                rate = getNum(rate);

                var total = parseFloat(quantity * rate);


                calcPerc = total * (dispercentage / 100);

                calcPerc = getNum(calcPerc);
                $('#discountamount' + id + '').val(calcPerc.toFixed(2));

                totaldiscamount += parseFloat(calcPerc);
                row_vatcalculate(id);
                row_calculate(id);
            });
        } else {

        }

        totaldiscamount = getNum(totaldiscamount);
        $('#discount').val(totaldiscamount.toFixed(2));


    }
    $('body').on('change', '#discount_type', function() {
        discount_calculate_new();
    });

    function row_vatcalculate(id) {
        var vatpercentage = $('#vat_percentage' + id + '').val();
        vatpercentage = getNum(vatpercentage);
        var quantity = $('#quantity' + id + '').val();
        quantity = getNum(quantity);
        var rate = $('#rate' + id + '').val();
        rate = getNum(rate);
        var rdiscount = $('#discountamount' + id + '').val();
        rdiscount = getNum(rdiscount);
        var total = parseFloat(quantity * rate) - parseFloat(rdiscount);


        vat_amount = (vatpercentage / 100) * total;
        vat_amount = getNum(vat_amount);
        $('#vatamount' + id + '').val(vat_amount.toFixed(2));
        //

        var vatamounts = 0;
        $('.vatamount').each(function() {
            var id = $(this).attr('data-id');
            var vatamount = $('#vatamount' + id + '').val();

            vatamounts += parseFloat(vatamount);

        });
        vatamounts = getNum(vatamounts);
        $('#totalvatamount').val(vatamounts.toFixed(2));

        //
    }

    function row_calculate(id) {


        var quantity = $('#quantity' + id + '').val();
        var rate = $('#rate' + id + '').val();
        var vatamount = $('#vatamount' + id + '').val();

        var disamount = $('#discountamount' + id + '').val();



        var total = parseFloat(quantity * rate);
        var rowtotal = parseFloat(total - disamount) + parseFloat(vatamount)
        total = getNum(total);
        rowtotal = getNum(rowtotal);
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
        vatamounts = getNum(vatamounts);
        $('#totalvatamount').val(vatamounts.toFixed(2));
    });

    function totalamount_calculate() {
        var totalamount = 0;
        $('.amount').each(function() {
            var id = $(this).attr('data-id');
            var amount = $('#amount' + id + '').val();

            totalamount += parseFloat(amount);

        });
        totalamount = getNum(totalamount);
        $('#totalamount').val(totalamount.toFixed(2));

    }

    $('body').on('keyup', '.discount', function() {

        final_calculate1();


    });

    function final_calculate1() {

        var vatamounts = 0;
        $('.vatamount').each(function() {
            var id = $(this).attr('data-id');
            var vatamount = $('#vatamount' + id + '').val();

            vatamounts += parseFloat(vatamount);

        });
        vatamounts = getNum(vatamounts);
        $('#totalvatamount').val(vatamounts.toFixed(2));


        var amountafterdiscount = 0;
        var grandtotalamount = 0;
        var discount = $('#discount').val();
        var totalamount = $('#totalamount').val();
        var totalvatamount = $('#totalvatamount').val();

        var discountamount = $('#discount').val();
        amountafterdiscount = parseFloat(totalamount) - parseFloat(discountamount);
        grandtotalamount = parseFloat(amountafterdiscount) + parseFloat(totalvatamount);
        amountafterdiscount = getNum(amountafterdiscount);
        grandtotalamount = getNum(grandtotalamount);
        $('#amountafterdiscount').val(amountafterdiscount.toFixed(2));
        $('#grandtotalamount').val(grandtotalamount.toFixed(2));
    }



    $(".vatamount").prop("readonly", true);

    $(document.body).on("change", "#currency", function() {
        var cid = $(this).val();
        $.ajax({
            url: "getcurrency_sell",
            method: "POST",
            data: {
                _token: $('#token').val(),
                id: cid
            },
            dataType: "json",
            success: function(data) {
                //  console.log(data);
                var termcondition = '';
                $.each(data, function(key, value) {

                    cvalue = value.value;
                });
                cvalue = getNum(cvalue);

                $('#currencyvalue').val(cvalue);

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
                        $("#cust_code").val(value.cust_code + '/' + value
                            .increment);
                    });
                },
                error: function() {}
            });


        });
    });
    /*  $(document).ready(function(){
           $(document).on('change','.newcustomer',function()
           {

               var customer = $(this).val();

               if(customer == 1)
               {
                  $('#customer').val('').trigger('change');
                  $('#customer').attr('disabled',true);
              $('#cust_category').val('').trigger('change').attr('disabled',false);
              $('#cust_type').val('').trigger('change').attr('disabled',false);;
              $('#cust_group').val('').trigger('change').attr('disabled',false);;
              $('#cust_name').val('').attr('readonly',false);
              $('#cust_code').val('').attr('readonly',true);
              $('#building_no').val('').attr('readonly',false);
              $('#cust_region').val('').attr('readonly',false);
              $('#cust_district').val('').attr('readonly',false);
              $('#cust_city').val('').attr('readonly',false);
              $('#cust_zip').val('').attr('readonly',false);
              $('#mobile').val('').attr('readonly',false);
              $('#vatno').val('').attr('readonly',false);
              $('#buyerid_crno').val('').attr('readonly',false);
              $('#cust_country').trigger('change').attr('disabled',false);
               }
               if(customer == 2)
               {
               $('#customer').attr('disabled',false);
               $('#cust_category').attr('disabled',true);
              $('#cust_type').attr('disabled',true);
              $('#cust_group').attr('disabled',true);
              $('#cust_country').attr('disabled',true);
               $('#cust_code').attr('readonly',true);
              $('#building_no').attr('readonly',true);
              $('#cust_region').attr('readonly',true);
              $('#cust_district').attr('readonly',true);
              $('#cust_city').attr('readonly',true);
              $('#cust_zip').attr('readonly',true);
              $('#mobile').attr('readonly',true);
              $('#vatno').attr('readonly',true);
              $('#buyerid_crno').attr('readonly',true);
              $('#cust_name').attr('readonly',true);
               }



           });
         });*/
    $(document).ready(function() {
        $(document).on('change', '.newcustomer', function() {

            var customer = $(this).val();

            if (customer == 1) {
                var default_grp = $('#default_grp').val();
                var typedefault = $('#typedefault').val();
                var catdefault = $('#catdefault').val();


                $('#customer').val('').trigger('change');
                $('#customer').attr('disabled', true);
                $('#cust_category').val(catdefault).trigger('change').attr('disabled', false);
                $('#cust_type').val(typedefault).trigger('change').attr('disabled', false);
                $('#cust_group').val(default_grp).trigger('change').attr('disabled', false);
                $('#cust_name').val('').attr('readonly', false);
                $('#cust_code').val('').attr('readonly', true);
                $('#building_no').val('').attr('readonly', false);
                $('#cust_region').val('').attr('readonly', false);
                $('#cust_district').val('').attr('readonly', false);
                $('#cust_city').val('').attr('readonly', false);
                $('#cust_zip').val('').attr('readonly', false);
                $('#mobile').val('').attr('readonly', false);
                $('#vatno').val('').attr('readonly', false);
                $('#buyerid_crno').val('').attr('readonly', false);
                $('#cust_country').trigger('change').attr('disabled', false);
            }
            if (customer == 2) {
                $('#customer').attr('disabled', false);
                $('#cust_category').attr('disabled', true);
                $('#cust_type').attr('disabled', true);
                $('#cust_group').attr('disabled', true);
                $('#cust_country').attr('disabled', true);
                $('#cust_code').attr('readonly', true);
                $('#building_no').attr('readonly', true);
                $('#cust_region').attr('readonly', true);
                $('#cust_district').attr('readonly', true);
                $('#cust_city').attr('readonly', true);
                $('#cust_zip').attr('readonly', true);
                $('#mobile').attr('readonly', true);
                $('#vatno').attr('readonly', true);
                $('#buyerid_crno').attr('readonly', true);
                $('#cust_name').attr('readonly', true);
            }



        });
    });
</script>



</script>
<script src="{{ url('/') }}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{ url('/') }}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<!-- <script src="{{ url('/') }}/resources/js/sell/quotation.js" type="text/javascript"></script> -->
<script src="{{ url('/') }}/resources/js/sell/invoice.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
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

    function getNum(val) {

        if (isNaN(val) || val == false || val == null || val == undefined || val == "") {
            return 0;
        }
        return val;
    }



    //product selection

    /**
     *Datatable for product details Information
     */
    //$.fn.dataTable.ext.errMode = 'none';

    var product_list_table = $('#productdetails_list').DataTable({
        processing: true,
        serverSide: false,
        bPaginate: false,
        dom: 'Blfrtip',
        columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
            }
            /* ,{
                           "targets": [ 11 ],
                           "visible": false
                       }*/
        ],
        //   aoColumnDefs: [{ "bVisible": false, "aTargets": [13] }],
        ajax: {
            "url": 'ProductsalesListing',
            "type": "POST",
            "data": function(data) {
                data._token = $('#token').val();
                //  data.wid = $('#wid').val();
                //
            }
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            /* { data: 'product_name', name: 'product_name' },*/
            {
                data: 'product_name',
                name: 'product_name',
                "render": function(data, type, row, meta) {
                    return type === 'display' && data.length > 40 ?
                        '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' :
                        data;
                }
            },


            {
                data: 'description',
                name: 'description',
                "render": function(data, type, row, meta) {

                    if (data != null && data.length > 1) {
                        return type === 'display' && data.length > 40 ?
                            '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' :
                            data;
                    } else {
                        return data;
                    }


                }
            },
            {
                data: 'unit',
                name: 'unit'
            },
            {
                data: 'product_price',
                name: 'product_price'
            },
            {
                data: 'selling_price',
                name: 'selling_price'
            },
            {
                data: 'available_stock',
                name: 'available_stock'
            },

        ]
    });





    $(document).ready(function() {


        $('#productdetails_list tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');

            $('#selected_items').val(product_list_table.rows('.selected').data().length);

            var versement_each = 0;
            selectArr = new Array();
            var ids = $.map(product_list_table.rows('.selected').data(), function(item) {
                versement_each += parseFloat(item.unit_price) || 0;
                // alert(versement_each);
                //
                var idx = $.inArray(item.product_id, selectArr);
                if (idx == -1) {
                    selectArr.push(item.product_id);
                } else {
                    selectArr.splice(idx, item.product_id);
                }
                //



            });


            $('#selected_amount').val(versement_each.toFixed(2));
        });



    });



    $("#datatableadd").on("click", function() {
        $('#kt_modal_4_4').modal('hide');
        product_list_table.rows('.selected').nodes().to$().removeClass('selected');
        $('#selected_amount').val('');
        $('#selected_items').val('');
        /*alert(selectArr);*/
        createproductvialoop(selectArr);

    });


    /**
     *products details DataTable Export
     */

    $("#productdetails_list_print").on("click", function() {

        product_list_table.button('.buttons-print').trigger();
    });


    $("#productdetails_list_copy").on("click", function() {
        product_list_table.button('.buttons-copy').trigger();
    });

    $("#productdetails_list_csv").on("click", function() {
        product_list_table.button('.buttons-csv').trigger();
    });

    $("#productdetails_list_pdf").on("click", function() {
        product_list_table.button('.buttons-pdf').trigger();
    });






    $('body').on('change', '.setwarehouse', function() {
        var wid = $('option:selected', this).attr('data-wid');

        var wname = $('option:selected', this).attr('data-wname');
        $.ajax({
            type: 'POST',
            url: 'setwarehouse',
            data: {
                _token: $('#token').val(),
                wid: wid,
                wname: wname

            },
            success: function(data) {

                console.log('Before Ajax Call');

                product_list_table.ajax.reload();
                $('#selected_items').val('');
                $('#selected_amount').val('');
                console.log('After Ajax Call');

                $("#whead").text(wname);



            },
            error: function() {}
        });

    });



    $("body").on("click", ".history", function(event) {
        var id = $(this).attr('data-id');
        var pid = $('#item_id' + id + '').val();
        var pdtname = $('#productname' + id + '').val();
        $('#productnamehis').val(pdtname);
        $('#productnamehis1').val(pdtname);

        var cstname = $('#cust_name').val();
        $('#customerhis').val(cstname);
        $('#customerhis1').val(cstname);

        // $('#kt_modal_4_6').modal('show');


        $.ajax({
            url: "producthistorylist_sell",
            method: "POST",
            data: {
                _token: $('#token').val(),

                pid: pid,
                customer: $('#customer').val(),
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                $("#productinvoicehistory tbody").empty();
                rowcount = $('#productinvoicehistory tr').length;
                $.each(data, function(key, value) {

                    var history = '';
                    history += '<tr>\
                     <td>' + rowcount + '</td>\
                     <td>' + value.invoice_id + '</td>\
                     <td>' + value.quantity + '</td>\
                     <td>' + value.rate + '</td>\
                     <td>' + value.amount + '</td>\
                     <td>' + value.vatamount + '</td>\
                     <td>' + value.discount + '</td>\
                     <td>' + value.totalamount + '</td>\
                     <tr>';
                    $('#productinvoicehistory').append(history);
                    rowcount++;
                });


            }
        })
        $.ajax({
            url: "productquotationhistorylist_sell",
            method: "POST",
            data: {
                _token: $('#token').val(),

                pid: pid,
                customer: $('#customer').val(),
            },
            dataType: "json",

            success: function(data) {
                console.log(data);
                $("#productquotationhistory tbody").empty();
                rowcount = $('#productquotationhistory tr').length;
                sl = $('#productquotationhistory tr').length;

                $.each(data, function(key, value) {
                    var history = '';
                    history += '<tr>\
                     <td>' + sl + '</td>\
                     <td>' + value.quote_id + '</td>\
                     <td>' + value.quantity + '</td>\
                     <td>' + value.rate + '</td>\
                     <td>' + value.amount + '</td>\
                     <td>' + value.vatamount + '</td>\
                     <td>' + value.discount + '</td>\
                     <td>' + value.totalamount + '</td>\
                     <tr>';


                    $('#productquotationhistory').append(history);
                    rowcount++;
                });
                sl++;

            }
        })
        $('#kt_modal_4_6').modal('show');




    });


    $('body').on('keyup', '.paidamount', function() {
        var paidamount = $(this).val();
        if (paidamount == "") {
            paidamount = 0;
        }
        var grandtotalamount = $('#grandtotalamount').val();
        if (parseFloat(grandtotalamount) >= parseFloat(paidamount)) {
            var balance = parseFloat(grandtotalamount) - parseFloat(paidamount);
            $('#balanceamount').val(balance);
        } else {
            toastr.warning('Paid Amount is Greater than Total Amount')
            $('#paidamount').val(0);
            $('#balanceamount').val(grandtotalamount);
        }



    });

    window.addEventListener("load", function() {
        $('.useadvance').each(function() {
            var useadvance = $(this).val();
            if (useadvance == "1") {
                customer = $('#customer').val();
                if (customer == "") {
                    toastr.warning('Please select Customer')
                    $('#creditbalance').val(0);
                } else {

                    $.ajax({
                        url: "getcreditbalance",
                        method: "POST",
                        data: {
                            _token: $('#token').val(),
                            customer: $('#customer').val(),
                        },
                        dataType: "json",
                        success: function(data) {

                            $.each(data, function(key, value) {
                                var cr_amount = value.cr_amount;
                                var dr_amount = value.dr_amount;
                                var total = parseFloat(cr_amount - dr_amount);
                                $('#creditbalance').val(total);
                            });
                            sl++;
                        }
                    })
                }
            } else {
                $('#creditbalance').val(0);
            }

        });

    });
</script>
<script type="text/javascript">
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
</script>
<script>
    $(document).ready(function() {
        $('.sell_invoice_list').addClass('kt-menu__item--active');
    });
</script>
@endsection