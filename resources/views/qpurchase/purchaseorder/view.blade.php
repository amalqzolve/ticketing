@extends('qpurchase.common.layout')

@section('content')
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
      /* color: #595d6e; */
   }

   #productdetails_list_wrapper {
      height: 300px;
      overflow-y: scroll;
   }
</style>
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

<?php

$id = $purchaseorder->id;
$rfq_id = $purchaseorder->so_id;
$customer_id = $purchaseorder->id;
$currency = $purchaseorder->currency;
$currencyvalue = $purchaseorder->currencyvalue;
$supname = $purchaseorder->name;
$attention = $purchaseorder->attention;
$salesman1 = $purchaseorder->salesman;
$quotedate = $purchaseorder->quotedate;
$valid_till = $purchaseorder->valid_till;
$totalamount = $purchaseorder->totalamount;
$discount = $purchaseorder->discount;
$amountafterdiscount = $purchaseorder->amountafterdiscount;
$totalvatamount = $purchaseorder->vatamount;
$grandtotalamount = $purchaseorder->grandtotalamount;
$terms = $purchaseorder->terms;
$notes = $purchaseorder->notes;
$internal_reference = $purchaseorder->internal_reference;
$preparedby = $purchaseorder->preparedby;
$approvedby = $purchaseorder->approvedby;
$discount_type = $purchaseorder->discount_type;
$tpreview = $purchaseorder->tpreview;
$qtnref = $purchaseorder->qtnref;
$po_wo_ref = $purchaseorder->po_wo_ref;
$ctype = $purchaseorder->ctype;


foreach ($pname as $names) {
   $supid = $names->id;
   $sup_add1 = $names->sup_add1;
   $sup_add2 = $names->sup_add2;
   $sup_region = $names->sup_region;
   $sup_city = $names->sup_city;
   $sup_zip = $names->sup_zip;
   $mobile1 = $names->mobile1;
   $vat_no = $names->vatno;
   $cr_no = $names->buyerid_crno;
   $sup_name = $names->sup_name;
   $type = $names->type;
   $category = $names->category;
   $group = $names->group;
   $cntry_name = $names->cntry_name;
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
               PO [{{$purchaseorder->code}}/{{$purchaseorder->br_id}}]
            </h3>
         </div>
         <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
               <button class=" backHome btn btn-brand btn-elevate btn-icon-sm">
                  <i class="flaticon2-left-arrow-1"></i> Back </button>
            </div>
         </div>

      </div>

      <div class="kt-portlet__body pl-2 pr-2 pb-0">

         <form class="kt-form" id="kt_form">
            <ul class="nav nav-tabs nav-fill" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">PO Details</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_4">Supplier Details</a>
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
                              <label>PO Date</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <?php
                              $quotedate1 = strtotime($quotedate);
                              $quotedate2 = date('d-m-Y', $quotedate1);
                              ?>
                              <input type="text" class="form-control " name="rfqdate" id="rfqdate" value="{{ $quotedate2 }}" readonly>
                           </div>
                        </div>
                     </div>


                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Valid Till</label>
                              <?php
                              $valid_till1 = strtotime($valid_till);
                              $valid_till2 = date('d-m-Y', $valid_till1);
                              ?>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="valid_till" id="valid_till" value="{{ $valid_till2 }}" readonly>
                           </div>
                        </div>
                     </div>


                     <div class="col-lg-6">
                        <div class="form-group  row pl-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.QTN Ref')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="qtnref" id="qtnref" value="{{$qtnref}}" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.PO/WO Ref')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="po_wo_ref" id="po_wo_ref" value="{{$po_wo_ref}}" readonly>
                           </div>
                        </div>
                     </div>




                     <div class="col-lg-6">
                        <div class="form-group  row pl-md-3">
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
                              <input type="text" name="" id="" class="form-control" value="@foreach($salesmen as $data){{($salesman1 == $data->id)?$data->name:''}}@endforeach" readonly>
                           </div>
                        </div>
                     </div>


                     <div class="col-lg-6">
                        <div class="form-group row pl-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Currency')<span style="color: red">*</span></label>
                           </div>
                           <div class="col-md-8 input-group input-group-sm">
                              <input type="text" name="" id="" class="form-control" value="@foreach($currencylist as $data){{($currency == $data->id)?$data->currency_name:''}}@endforeach" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Currency Value')</label>
                           </div>
                           <div class="col-md-8 input-group input-group-sm">
                              <input type="text" class="form-control currency_value" name="currency_value" id="currency_value" value="{{$currencyvalue}}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pl-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Prepared By')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" value="@foreach($salesmen as $data){{($preparedby == $data->id)?$data->name:''}}@endforeach" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Approved By')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" value="@foreach($salesmen as $data){{($approvedby == $data->id)?$data->name:''}}@endforeach" readonly>
                           </div>
                        </div>
                     </div>


                     <div class="col-lg-6">
                        <div class="form-group row pl-md-3">
                           <div class="col-md-4">
                              <label>Discount Type<span style="color: red">*</span> </label>
                           </div>
                           <div class="col-md-8  input-group-sm">
                              <input type="text" class="form-control" value="@if($discount_type ==1){{'Flat'}}@endif @if($discount_type ==2){{'Percentage'}}@endif" readonly>
                           </div>
                        </div>
                     </div>



                  </div>
               </div>
               <div class="tab-pane p-3" id="kt_tabs_2_2" role="tabpanel">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Internal Reference</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <textarea class="form-control" name="internalreference" id="internalreference" readonly>{{$internal_reference}}</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Printable notes</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <textarea class="form-control" name="notes" id="notes" readonly>{{$notes}}</textarea>
                           </div>
                        </div>
                     </div>






                  </div>


               </div>
               <div class="tab-pane p-3" id="kt_tabs_2_3" role="tabpanel">
                  {!!$tpreview!!}
               </div>
               <div class="tab-pane p-3" id="kt_tabs_2_4" role="tabpanel">
                  <div class="row" style="padding-bottom: 6px;">
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>{{ __('customer.Category') }}</label>
                           </div>
                           <div class="col-md-8  input-group input-group-sm">
                              <input type="text" class="form-control single-select Cust_category" id="cust_category" name="cust_category" readonly value="{{$category}}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group row  pr-md-3">
                           <div class="col-md-4">
                              <label>{{ __('customer.Type') }}</label>
                           </div>
                           <div class="col-md-8 input-group input-group-sm">
                              <input type="text" class="form-control single-select" id="cust_type" name="cust_type" readonly value="{{$type}}" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row pl-md-3">
                           <div class="col-md-4">
                              <label>{{ __('customer.Group') }}</label>
                           </div>
                           <div class="col-md-8  input-group input-group-sm">
                              <input type="text" class="form-control single-select" name="cust_group" id="cust_group" value="{{$group}}" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>{{ __('customer.Name') }}</label>
                           </div>
                           <div class="col-md-8 ">
                              <div class="input-group input-group-sm">
                                 <input type="text" class="form-control" id="cust_name" name="cust_name" autocomplete="off" placeholder="{{ __('customer.Customer Name/Company name') }}" readonly value="{{$sup_name}}">
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
                                 <input type="text" class="form-control" id="building_no" name="building_no" autocomplete="off" placeholder="{{ __('customer.Building No') }}" readonly value="{{$sup_add1}}">
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
                                 <input type="text" class="form-control" id="cust_region" name="cust_region" autocomplete="off" placeholder="{{ __('customer.Street Name') }}" readonly value="{{$sup_add2}}">
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
                                 <input type="text" class="form-control" id="cust_district" name="cust_district" autocomplete="off" placeholder="{{ __('customer.District') }}" readonly value="{{$sup_region}}">
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
                                 <input type="text" class="form-control" id="cust_city" name="cust_city" autocomplete="off" placeholder="{{ __('customer.City') }}" readonly value="{{$sup_city}}">
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
                                 <input type="text" name="cust_country" id="cust_country" class="form-control single-select" readonly value="{{$cntry_name}}">
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

                                 <input type="text" class="form-control" id="cust_zip" name="cust_zip" autocomplete="off" placeholder="{{ __('customer.Postal Code') }}" readonly value="{{$sup_zip}}">
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

                                 <input type="text" class="form-control" placeholder="{{ __('customer.Mobile') }}" id="mobile" name="mobile" autocomplete="off" readonly value="{{$mobile1}}">
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

                                 <input type="text" class="form-control" placeholder="{{ __('customer.Vat No') }}" id="vatno" name="vatno" autocomplete="off" readonly value="{{$vat_no}}">
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
                                 <input type="text" class="form-control" placeholder="{{ __('customer.Buyer ID / CR No') }}" id="buyerid_crno" name="buyerid_crno" autocomplete="off" readonly value="{{$cr_no}}">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>


            <div class="row p-0" style="background-color:#f2f3f8;">
               <div>
                  <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0;">
                  <br>
                  <br>
                  <div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
                     <table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%; ">
                        <thead class="thead-light">
                           <tr>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;" width="30px">#</th>

                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;" width="250px">@lang('app.Item Name')</th>
                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Description')</th>
                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Unit')</th>
                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px">@lang('app.Quantity')</th>
                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="90px">@lang('app.Rate')</th>
                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Amount')</th>
                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px">@lang('app.Discount')</th>
                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px;">@lang('app.VAT')</th>
                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; width: ;">@lang('app.VAT Amount')</th>
                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Total Amount')</th>
                           </tr>

                           </tr>
                        </thead>
                        <tbody>
                           @foreach($purchaseorder_product as $key=>$cinvoice_products)
                           <tr>
                              <td>{{$key+1}}</td>
                              <td>
                                 <input class="form-control kt-selectpicker productname" id="productname{{$key+1}}" name="productname[]" data-id="{{$key+1}}" value="{{$cinvoice_products->product_name}}" readonly>
                              </td>
                              <td><textarea class="form-control" rows="1" name="product_description[]" id="product_description{{$key+1}}" data-id="{{$key+1}}" readonly>{{$cinvoice_products->description}}</textarea></td>
                              <td>
                                 <input type="text" name="" id="" class="form-control" value="@foreach($unitlist as $data){{($cinvoice_products->unit == $data->id)?$data->unit_code:''}}@endforeach" readonly>
                              </td>
                              <td><input type="text" class="form-control quantity " name="quantity[]" id="quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->quantity}}" readonly></td>
                              <td><input type="text" class="form-control rate " name="rate[]" id="rate{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->rate}}" readonly></td>
                              <td><input type="text" class="form-control amount " name="amount[]" id="amount{{$key+1}}" data-id="{{$key+1}}" readonly value="{{$cinvoice_products->amount}}" readonly></td>
                              <td><input type="text" class="form-control discountamount " name="discountamount[]" id="discountamount{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->rdiscount}}" readonly></td>
                              <td>
                                 <input type="text" name="" id="" class="form-control" value="@foreach($vatlist as $data){{($cinvoice_products->vat_percentage == $data->total)?$data->total:''}}@endforeach" readonly>
                              </td>
                              <td><input type="text" class="form-control vatamount" name="vatamount[]" id="vatamount{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->vatamount}}" readonly></td>
                              <td><input type="text" class="form-control row_total" name="row_total[]" id="row_total{{$key+1}}" data-id="{{$key+1}}" readonly value="{{$cinvoice_products->totalamount}}" readonly></td>
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
                        <input type="text" class="form-control" name="totalamount" id="totalamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$totalamount}}">
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
               </div>
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>Discount</label>
                     </div>
                     <div class="col-md-8 input-group-sm">
                        <input type="text" class="form-control discount" name="discount" id="discount" value="{{$discount}}" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
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
                        <input type="text" class="form-control" name="amountafterdiscount" id="amountafterdiscount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$amountafterdiscount}}">
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
                        <input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$totalvatamount}}">
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
                        <input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly value="{{$grandtotalamount}}" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
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
<script>
   $('.qpurchase_order').addClass('kt-menu__item--active');
</script>
@endsection