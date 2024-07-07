@extends('sell.common.layout')

@section('content')
    <link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
    <script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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

        /*#table-wrapper table thead th .text {
      position:absolute;
      top:-20px;
      z-index:2;
      height:20px;
      width:35%;

    }*/
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
    foreach ($saleorder as $saleorders) {
        $id = $saleorders->id;
        $quotedate = $saleorders->quotedate;
        $valid_till = $saleorders->valid_till;
        $qtn_ref = $saleorders->qtn_ref;
        $po_ref = $saleorders->po_ref;
        $delivery_period = $saleorders->delivery_period;
        $attention = $saleorders->attention;
        $salesman = $saleorders->salesman;
        $currency = $saleorders->currency;
        $currencyvalue = $saleorders->currencyvalue;
        $preparedby = $saleorders->preparedby;
        $approvedby = $saleorders->approvedby;
        $payment_terms = $saleorders->payment_terms;
        $discount_type = $saleorders->discount_type;
        $customer = $saleorders->customer;
        $terms_conditions = $saleorders->terms_conditions;
        $notes = $saleorders->notes;
        $tpreview = $saleorders->tpreview;
        $totalamount = $saleorders->totalamount;
        $discount = $saleorders->discount;
        $amountafterdiscount = $saleorders->amountafterdiscount;
        $vatamount = $saleorders->vatamount;
        $grandtotalamount = $saleorders->grandtotalamount;
        $internal_reference = $saleorders->internal_reference;
        $podate = $saleorders->podate;
        $quote_id = $saleorders->quote_id;
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
    $quantity = 0;
    $delivered = 0;
    $remaining = 0;
    ?>
    <input type="hidden" name="id" id="id" value="{{ $id }}">
    <input type="hidden" name="cid" id="cid" value="{{ $customer }}">
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
                        Generate Delivery Order
                    </h3>
                </div>

            </div>

            <div class="kt-portlet__body pl-2 pr-2 pb-0">

                <form class="kt-form" id="kt_form">


                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">Delivery Order Details</a>
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
                                            <label>Delivery Date<span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <input type="text" class="form-control kt_datetimepickerr"
                                                name="delivery_date" id="delivery_date" value="{{ date('d-m-Y') }}">
                                        </div>
                                    </div>
                                </div>



                                <div class="col-lg-6">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>@lang('app.Attention')</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <input type="text" class="form-control" name="attention" id="attention"
                                                value="{{ $attention }}">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>Vehicle Details</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <input type="text" class="form-control" name="vehicle" id="vehicle"
                                                value="">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>Driver Details</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <input type="text" class="form-control" name="driver" id="driver"
                                                value="">

                                        </div>
                                    </div>
                                </div>












                                <!-- <div class="new1"></div> -->


                                <div class="col-lg-6">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>@lang('app.Prepared By')</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">
                                            <select class="form-control single-select kt-selectpicker" id="preparedby">
                                                <option value="">select</option>
                                                @foreach ($salesmen as $data)
                                                    <option
                                                        value="{{ $data->id }}"@if ($preparedby == $data->id) selected=""; @endif>
                                                        {{ $data->name }}</option>
                                                @endforeach
                                            </select>



                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>Delivery Note</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <input type="text" class="form-control" name="deliverynote"
                                                id="deliverynote" value="">

                                        </div>
                                    </div>
                                </div>
                                <!--       <div class="col-lg-6">
                                  <div class="form-group  row pr-md-3">
                                  <div class="col-md-4">
                                  <label>@lang('app.Approved By')</label>
                                  </div>
                                  <div class="col-md-8 input-group-sm">

                                     <select class="form-control single-select kt-selectpicker" id="approvedby">
                                     <option value="">select</option>
             @foreach ($salesmen as $data)
    <option value="{{ $data->id }}"@if ($approvedby == $data->id) selected=""; @endif>{{ $data->name }}</option>
    @endforeach
                                  </select>


                            
                                  </div>
                                  </div>
                                  </div> -->







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

                                            <input type="text" class="form-control" name="quoteid" id="quoteid"
                                                value="{{ $quote_id }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>@lang('app.Quote Date')</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <input type="text" class="form-control" name="quotedate" id="quotedate"
                                                value="{{ $quotedate }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>SO ID</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <input type="text" class="form-control" name="soid" id="soid"
                                                value="{{ $id }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>SO Date</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <input type="text" class="form-control" name="sodate" id="sodate"
                                                value="{{ $podate }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>@lang('app.QTN Ref')</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <input type="text" class="form-control" name="qtn_ref" id="qtn_ref"
                                                value="{{ $qtn_ref }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>PO Reference</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <input type="text" class="form-control" name="po_ref" id="po_ref"
                                                value="{{ $po_ref }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row pr-md-3">
                                        <div class="col-md-4">
                                            <label>@lang('app.Currency')</label>
                                        </div>
                                        <div class="col-md-8 input-group input-group-sm">
                                            <select class="form-control single-select currency kt-selectpicker"
                                                name="currency" id="currency" disabled="">
                                                <option value="">Select</option>
                                                @foreach ($currencylist as $data)
                                                    <option
                                                        value="{{ $data->id }}"@if ($currency == $data->id) selected="" @endif>
                                                        {{ $data->currency_name }}</option>
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


                                            <input type="text" class="form-control currency_value"
                                                name="currencyvalue" id="currencyvalue" value="{{ $currencyvalue }}"
                                                readonly>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>@lang('app.Salesman')</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <select class="form-control single-select kt-selectpicker" id="salesman"
                                                disabled="">
                                                <option value="">select</option>
                                                @foreach ($salesmen as $data)
                                                    <option
                                                        value="{{ $data->id }}"@if ($salesman == $data->id) selected="" @endif>
                                                        {{ $data->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                
                               

                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>@lang('app.Notes')</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <textarea class="form-control" name="notes" id="notes">{{ $notes }}</textarea>


                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>Internal Reference</label>
                                        </div>
                                        <div class="col-md-8 input-group-sm">

                                            <textarea class="form-control" name="internal_reference" id="internal_reference">{{ $internal_reference }}</textarea>


                                            <!-- </div> -->
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

                                        <select class="form-control single-select kt-selectpicker" id="terms_conditions"
                                            name="terms_conditions">
                                            <option value="">select</option>
                                            @foreach ($termslist as $data)
                                                <option
                                                    value="{{ $data->id }}"@if ($terms_conditions == $data->id) selected="" @endif>
                                                    {{ $data->term }}</option>
                                            @endforeach
                                        </select>



                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <!-- <div class="col-md-4">
                                  <label>Terms and Conditions Preview</label>
                                  </div>   -->
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
                                            <label>{{ __('customer.Customer Name') }}</label>
                                        </div>
                                        <div class="col-md-8 ">
                                            <div class="input-group input-group-sm">

                                                <input type="text" class="form-control" id="cust_name"
                                                    name="cust_name" autocomplete="off"
                                                    placeholder="{{ __('customer.Customer Name/Company name') }}"
                                                    value="{{ $cust_name }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <input type="hidden" class="form-control branch" name="branch" id="branch"
                                        value="<?php echo $branch; ?>">
                                    <div class="form-group row pr-md-3">
                                        <div class="col-md-4">
                                            <label>{{ __('customer.Customer Code') }}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-group input-group-sm">

                                                <input type="text" class="form-control branch" name="cust_code"
                                                    id="cust_code" placeholder="{{ __('customer.Customer Code') }}"
                                                    autocomplete="off" readonly value="{{ $cust_code }}">
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

                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('customer.Vat No') }}" id="vatno"
                                                    name="vatno" autocomplete="off" value="{{ $vatno }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row pr-md-3">
                                        <div class="col-md-4">
                                            <label>Buyer ID / CR No</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-group  input-group-sm">

                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('customer.Buyer ID / CR No') }}" id="buyerid_crno"
                                                    name="buyerid_crno" autocomplete="off" value="{{ $buyerid_crno }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- <div class="col-lg-6">
                                  <div class="form-group  row pr-md-3">
                                  <div class="col-md-4">
                                  <label>
    Validity</label>
                                  </div>
                                  <div class="col-md-8 input-group-sm">

                            <input type="text" class="form-control kt_datetimepickerr" name="valid_till" id="valid_till" value="{{ $valid_till }}" readonly>

                                  </div>
                                  </div>
                                  </div> -->



                            </div>
                        </div>
                    </div>






                    <div class="row p-0" style="background-color:#f2f3f8;">
                        <div class="col-12 p-0">
                            <hr
                                style="height: 15px;
                     background-color: #f2f3f8;
                     width: 100%;
                     position: absolute;
                     left: 0;
                     border: 0;">


                            <br>
                            <br>
                            <div class=" pr-1 pl-1"
                                style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered table-hover" id="product_table">
                                        <!-- style="table-layout:fixed; width:100%" -->
                                        <thead class="thead-light">
                                            <tr>
                                                <th
                                                    style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                                    #</th>

                                                <th
                                                    style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;  width: 16%;   padding: 2px 7px !important;">
                                                    Service</th>
                                                <th
                                                    style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                                    @lang('app.Description')</th>


                                                <th
                                                    style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                                    Total Quantity</th>

                                                <th
                                                    style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                                    Delivered Quantity</th>

                                                <th
                                                    style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                                    Quantity to Deliver</th>

                                                <th
                                                    style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                                    Remaining Quantity</th>

                                                <th
                                                    style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; ">
                                                    @lang('app.Action') </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
foreach($saleorder_products as $key=>$saleorder_productss)
{
   $remaining += $saleorder_productss->delivery_remaining;
   if($remaining > 0)
   {
   $quantity += $saleorder_productss->quantity;
   $delivered += $saleorder_productss->quantity - $saleorder_productss->delivery_remaining;
   
   ?>

                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <input type="hidden" class="form-control product_row_id"
                                                    name="product_row_id[]" id="product_row_id{{ $key + 1 }}"
                                                    data-id="{{ $key + 1 }}"
                                                    value="{{ $saleorder_productss->id }}">
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <input style="width: 4cm;" type="text"
                                                            class="form-control single-select productname kt-selectpicker"
                                                            name="productname[]" id="productname"
                                                            data-id="{{ $key + 1 }}"
                                                            value="{{ $saleorder_productss->product_name }}"
                                                            >
                                                        <div>
                                                            <input type="hidden"
                                                                class="form-control single-select item_id"
                                                                name="item_id[]" id="item_id{{ $key + 1 }}"
                                                                data-id="{{ $key + 1 }}"
                                                                value="{{ $saleorder_productss->item_id }}">
                                                </td>
                                                <td>
                                                    <textarea class="form-control" id="description{{ $key + 1 }}" name="description[]" rows="1"
                                                        data-id={{ $key + 1 }} style=" height: 30px !important; width:3cm;">{{ $saleorder_productss->description }}</textarea>
                                                </td>


                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" style="width: 1cm;"
                                                            class="form-control quantity" data-id="{{ $key + 1 }}"
                                                            name="quantity[]" id="quantity{{ $key + 1 }}"
                                                            value="{{ $saleorder_productss->quantity }}" readonly>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" style="width: 1cm;width: 1cm;"
                                                            class="form-control delivered_quantity"
                                                            name="delivered_quantity[]"
                                                            id="delivered_quantity{{ $key + 1 }}"
                                                            data-id="{{ $key + 1 }}"
                                                            value="{{ $saleorder_productss->quantity - $saleorder_productss->delivery_remaining }}"
                                                            readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control delivery_quantity"
                                                            name="delivery_quantity[]" data-id="{{ $key + 1 }}"
                                                            id="delivery_quantity{{ $key + 1 }}" value="0">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control remaining_quantity"
                                                            data-id="{{ $key + 1 }}" name="remaining_quantity[]"
                                                            id="remaining_quantity{{ $key + 1 }}"
                                                            value="{{ $saleorder_productss->delivery_remaining }}"
                                                            readonly>
                                                    </div>
                                                </td>

                                                <td style="background-color: white;">
                                                    <div class="row">
                                                        <div class="col-md-6 kt-demo-icon__preview remove"
                                                            style="width: fit-content;    margin: auto;"
                                                            data-id="{{ $key + 1 }}">
                                                            <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">
                                                                <i class="fa fa-trash badge-pill" id=""
                                                                    style="padding:0; cursor: pointer;"></i></span>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <?php
              }
}
?>

                                        </tbody>
                                    </table>
                                </div>



                            </div>
                            <hr
                                style="height: 15px;
                     background-color: #f2f3f8;
                     width: 100%;
                     position: absolute;
                     left: 0;
                     border: 0;
                     margin-top: 0;">

                        </div>
                    </div>



                    <div class="row mt-5">
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-4">
                                    <label>Total Quantity</label>
                                </div>
                                <div class="col-md-8 input-group-sm">

                                    <input type="text" class="form-control" name="grandtotal_quantity"
                                        id="grandtotal_quantity" value="{{ $quantity }}" readonly
                                        style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">


                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-4">
                                    <label>Total Delivered Quantity</label>
                                </div>
                                <div class="col-md-8 input-group-sm">

                                    <input type="text" class="form-control grandtotal_delivered_quantity"
                                        name="grandtotal_delivered_quantity" id="grandtotal_delivered_quantity"
                                        value="{{ $delivered }}" readonly
                                        style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">


                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-4">
                                    <label>Total Delivery Quantity</label>
                                </div>
                                <div class="col-md-8 input-group-sm">

                                    <input type="text" class="form-control" name="grandtotal_delivery_quantity"
                                        id="grandtotal_delivery_quantity" value="0" readonly
                                        style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">


                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-4">
                                    <label>Total Remaining Quantity</label>
                                </div>
                                <div class="col-md-8 input-group-sm">

                                    <input type="text" class="form-control" name="grandtotal_remaining_quantity"
                                        id="grandtotal_remaining_quantity" value="{{ $remaining }}" readonly
                                        style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">

                                    <!-- </div> -->
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

                                    <button type="reset" class="btn btn-secondary backHome"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-x icon-16">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg> &nbsp;@lang('app.Cancel')</button>


                                    <button type="button" class="btn btn-primary" id="saleorder_delivery_update_sell"
                                        disabled=""><svg xmlns="http://www.w3.org/2000/svg" width="15"
                                            height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-check-circle icon-16">
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
    </script>
    <script src="{{ url('/') }}/resources/js/sales/select2.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/resources/js/sales/select2.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/resources/js/sell/saleorder.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js"
        type="text/javascript"></script>
    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
    <!--end::Page Vendors -->
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $('body').on('keyup', '.delivery_quantity', function() {
            var $this = $(this);
            $this.val($this.val().replace(/[^\d.]/g, ''));
            var id = $(this).attr('data-id');
            totaldeliveryquantity(id);
            totalremainingquantity(id);
        });

        function totaldeliveryquantity(id) {
            var delivery = $('#delivery_quantity' + id + '').val();
            if (delivery == "" || delivery == 0) {
                //$('#delivery_quantity'+id+'').val(0);
                delivery = 0;
                $('#saleorder_delivery_update_sell').attr('disabled', true);
                $('#grandtotal_delivery_quantity').val(0);
                toastr.warning("Delivery Quantity Cannot be 0");
                var quantity = $('#quantity' + id + '').val();
                var delivered_quantity = $('#delivered_quantity' + id + '').val();
                var remaining = parseFloat(quantity) - parseFloat(delivered_quantity);
                var balance = parseFloat(remaining) - parseFloat(delivery);
                $('#remaining_quantity' + id + '').val(balance);
            } else {
                $('#saleorder_delivery_update_sell').attr('disabled', false);
                var remainingquantity = $('#remaining_quantity' + id + '').val();
                var quantity = $('#quantity' + id + '').val();
                var delivered_quantity = $('#delivered_quantity' + id + '').val();
                var remaining = parseFloat(quantity) - parseFloat(delivered_quantity);
                if (remaining >= delivery) {
                    var balance = parseFloat(remaining) - parseFloat(delivery);
                    $('#remaining_quantity' + id + '').val(balance);
                    var totaldelivery = 0;
                    var delivery1 = 0;
                    $('.delivery_quantity').each(function() {
                        var id1 = $(this).attr('data-id');
                        delivery1 = $('#delivery_quantity' + id1 + '').val();

                        totaldelivery += parseFloat(delivery1);

                    });

                    $('#grandtotal_delivery_quantity').val(totaldelivery);
                } else {
                    $('#remaining_quantity' + id + '').val(remaining);
                    $('#delivery_quantity' + id + '').val(0);
                    toastr.warning("Delivery Quantity cannot be greater than Remaining ");
                    $('#saleorder_delivery_update_sell').attr('disabled', true);
                    return false;
                }
            }


        }

        function totalremainingquantity(id) {
            var totalremaining = 0;
            var remaining1 = 0;
            $('.remaining_quantity').each(function() {
                var id = $(this).attr('data-id');
                remaining1 = $('#remaining_quantity' + id + '').val();

                totalremaining += parseFloat(remaining1);

            });
            $('#grandtotal_remaining_quantity').val(totalremaining);

        }
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

        $(document).on('click', '#saleorder_delivery_update_sell', function(e) {
            e.preventDefault();
            salesman = $('#salesman').val();
            cust_name = $('#cust_name').val();
            delivery_date = $('#delivery_date').val();


            if (delivery_date == "") {
                $('#delivery_date').addClass('is-invalid');
                toastr.warning("Please Enter Delivery Date!");
                return false;
            } else {
                $('#delivery_date').removeClass('is-invalid');
            }







            var product_row_id = [];

            $("input[name^='product_row_id[]']")
                .each(function(input) {
                    product_row_id.push($(this).val());
                });


            var item_id = [];

            $("input[name^='item_id[]']")
                .each(function(input) {
                    item_id.push($(this).val());
                });

            var description = [];

            $("textarea[name^='description[]']")
                .each(function(input) {
                    description.push($(this).val());
                });



            var quantity = [];

            $("input[name^='quantity[]']")
                .each(function(input) {
                    quantity.push($(this).val());
                });

            var delivery_quantity = [];

            $("input[name^='delivery_quantity[]']")
                .each(function(input) {
                    delivery_quantity.push($(this).val());
                });

            var delivered_quantity = [];

            $("input[name^='delivered_quantity[]']")
                .each(function(input) {
                    delivered_quantity.push($(this).val());
                });

            var remaining_quantity = [];

            $("input[name^='remaining_quantity[]']")
                .each(function(input) {
                    remaining_quantity.push($(this).val());
                });





            var tdelivery_quantity = 0;
            $.each(delivery_quantity, function() {
                tdelivery_quantity += parseInt(this, 10);
            });


            if (tdelivery_quantity > 0) {
                // the array is defined and has at least one element
            } else {
                toastr.warning("Please Add Any Product for Delivery!");
                return false;
            }


            $(this).addClass('kt-spinner');
            $(this).prop("disabled", true);
            if ($('#id').val()) {
                var sucess_msg = 'Updated';
            } else {
                var sucess_msg = 'Created';
            }


            $.ajax({
                type: "POST",
                url: "saleorder_generate_delivery",
                dataType: "text",
                data: {
                    _token: $('#token').val(),
                    saleorder_id: $('#id').val(),
                    qtn_ref: $('#qtn_ref').val(),
                    po_ref: $('#po_ref').val(),
                    delivery_period: $('#delivery_period').val(),
                    attention: $('#attention').val(),
                    salesman: $('#salesman').val(),
                    currency: $('#currency').val(),
                    currencyvalue: $('#currencyvalue').val(),
                    preparedby: $('#preparedby').val(),
                    approvedby: $('#approvedby').val(),
                    payment_terms: $('#payment_terms').val(),
                    discount_type: $('#discount_type').val(),
                    notes: $('#notes').val(),
                    internal_reference: $('#internal_reference').val(),
                    terms_conditions: $('#terms_conditions').val(),
                    quotedate: $('#quotedate').val(),
                    valid_till: $('#valid_till').val(),
                    product_row_id: product_row_id,
                    item_id: item_id,
                    description: description,
                    quantity: quantity,
                    delivery_quantity: delivery_quantity,
                    customer: $('#cid').val(),
                    tpreview: tinymce.get("kt-tinymce-4").getContent(),
                    dateofsupply: $('#dateofsupply').val(),
                    delivery_date: $('#delivery_date').val(),
                    vehicle: $('#vehicle').val(),
                    driver: $('#driver').val(),
                    deliverynote: $('#deliverynote').val(),
                    sodate: $('#sodate').val(),
                    delivered_quantity: delivered_quantity,
                    remaining_quantity: remaining_quantity,
                    quoteid: $('#quoteid').val()

                },
                success: function(data) {


                    //$('#saleorder_delivery_update_sell').removeClass('kt-spinner');
                    window.location.href = "sell_delivery_list";
                    toastr.success('Delivery Order Created successfuly');
                    $('#saleorder_delivery_update_sell').prop("disabled", false);


                },
                error: function(jqXhr, json, errorThrown) {

                    console.log('Error !!');
                }
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
            var totaldelivered = 0;
            var delivered = 0;
            var quantity = 0;
            var totalquantity = 0;
            var remaining = 0;
            var totalremaining = 0;
            $('.delivered_quantity').each(function() {
                var id1 = $(this).attr('data-id');
                delivered = $('#delivered_quantity' + id1 + '').val();
                totaldelivered += parseFloat(delivered);
            });

            $('#grandtotal_delivered_quantity').val(totaldelivered);
            $('.quantity').each(function() {
                var id1 = $(this).attr('data-id');
                quantity = $('#quantity' + id1 + '').val();
                totalquantity += parseFloat(quantity);
            });

            $('#grandtotal_quantity').val(totalquantity);
            $('.remaining_quantity').each(function() {
                var id1 = $(this).attr('data-id');
                remaining = $('#remaining_quantity' + id1 + '').val();
                totalremaining += parseFloat(remaining);
            });

            $('#grandtotal_remaining_quantity').val(totalremaining);
        });
    </script>
    <script>
    $(document).ready(function() {
        $('.sell_saleorder_list').addClass('kt-menu__item--active');
    });
</script>
@endsection
