@extends('qpurchase.common.layout')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
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

$customercode = '';
$customercategory = '';
$customertype = '';
$customergroup = '';
$customername = '';
$buldingname = '';
$streetname = '';
$country = '';
$district = '';
$city = '';
$postalcode = '';
$mobileno =   '';


// foreach ($purchaseorder as $key => $value) {
$id = $purchaseorder->id;
$rfq_id = $purchaseorder->so_id;
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
$tpreview = $purchaseorder->tpreview;
$qtnref = $purchaseorder->qtnref;
$po_wo_ref = $purchaseorder->po_wo_ref;
$ctype = $purchaseorder->ctype;
$discount_type = $purchaseorder->discount_type;
// }

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
               Purchase Order => Purchase Invoice
            </h3>
         </div>
      </div>

      <div class="kt-portlet__body pl-2 pr-2 pb-0">

         <form class="kt-form" id="kt_form">
            <ul class="nav nav-tabs nav-fill" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">PO Details</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_4">Cost Head</a>
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
                              <label>Purchase Date</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <?php
                              $quotedate1 = strtotime($quotedate);
                              $quotedate2 = date('d-m-Y', $quotedate1);
                              ?>
                              <input type="text" class="form-control kt_datetimepickerr" name="quotedate" id="" value="{{ $quotedate2 }}">
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.QTN Ref')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="qtnref" id="qtnref" value="{{$qtnref}}">
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>VO/Change Orders</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="po_wo_ref" id="po_wo_ref" value="{{$po_wo_ref}}">
                           </div>
                        </div>
                     </div>




                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Attention')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="attention" id="attention" value="{{$attention}}">
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Salesman')<span style="color: red">*</span></label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <select class="form-control single-select kt-selectpicker" id="salesman">
                                 <option value="">select</option>
                                 @foreach($salesmen as $data)
                                 <option value="{{$data->id}}" @if($salesman1==$data->id) selected="";@endif>{{$data->name}}</option>
                                 @endforeach
                              </select>
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
                                 @foreach($currencylist as $data)
                                 <option value="{{$data->id}}" @if($currency==$data->id) selected="" @endif>
                                    {{$data->currency_name}}
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
                              <input type="text" class="form-control currency_value" name="currency_value" id="currency_value" value="{{$currencyvalue}}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Prepared By')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <select class="form-control kt-selectpicker" id="preparedby">
                                 <option value="">select</option>
                                 @foreach($salesmen as $data)
                                 <option value="{{$data->id}}" @if($preparedby==$data->id) selected="";@endif>{{$data->name}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Approved By')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <select class="form-control kt-selectpicker" id="approvedby">
                                 <option value="">select</option>
                                 @foreach($salesmen as $data)
                                 <option value="{{$data->id}}" @if($approvedby==$data->id) selected="";@endif>{{$data->name}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <input type="hidden" name="suppliernames" id="suppliernames" value="{{$supid}}">
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Name</label>
                           </div>
                           <div class="col-md-8 ">
                              <div class="input-group input-group-sm">
                                 <input type="text" class="form-control" id="cust_name" name="cust_name" autocomplete="off" placeholder="{{ __('customer.Customer Name/Company name') }}" readonly value="{{$sup_name}}">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Bill Entry Date')<span style="color: red">*</span></label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group input-group-sm">
                                 <input type="text" class="form-control kt_datetimepickerr" name="bill_entry_date" id="bill_entry_date" placeholder="" value="{{date('d-m-Y')}}">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Purchaser')<span style="color: red">*</span></label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group input-group-sm">
                                 <select class="form-control single-select input-group-sm kt-selectpicker purchaser" name="purchaser" id="purchaser">
                                    <option value="">Select</option>
                                    @foreach($salesmen as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Purchase Bill ID')<span style="color: red">*</span></label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group input-group-sm">
                                 <input type="text" class="form-control" name="purchasebillid" id="purchasebillid">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Purchase Method')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <select class="form-control single-select purchasemethod kt-selectpicker" id="purchasemethod">
                                 <option value="1">Cash</option>
                                 <option value="2">Credit</option>
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
                              <select class="form-control single-select kt-selectpicker" id="discount_type">
                                 <option value="1" {{($discount_type==1)?'selected':''}}>Flat</option>
                                 <option value="2" {{($discount_type==2)?'selected':''}}>Percentage</option>
                              </select>
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
                              <textarea class="form-control" name="internalreference" id="internalreference">{{$internal_reference}}</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Printable notes</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <textarea class="form-control" name="notes" id="notes">{{$notes}}</textarea>
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
                              @foreach($termslist as $data)
                              <option value="{{$data->id}}">{{$data->term}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group  row pr-md-3">
                        <div class="col-md-12 input-group-sm">
                           <div class="kt-tinymce">
                              <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane p-3" id="kt_tabs_2_4" role="tabpanel">
                  <div class="row" style="padding-bottom: 6px; margin-top: 44px;">
                     <div class="col-lg-12">
                        <div class="form-group row pl-md-3 mb-2">
                           <table class="table table-striped table-bordered table-hover" id="costhead_table">
                              <thead style=" background-color: #306584; color: white;">
                                 <tr>
                                    <th class="text-center p-1" style="background-color:  #3f4aa0;">@lang('app.S.No')</th>
                                    <th class="text-center pt-1 pb-1 pr-2 pl-2" style="background-color:  #3f4aa0; white-space: nowrap;">@lang('app.Select Voucher')</th>
                                    <th class="text-center pt-1 pb-1 pr-2 pl-2" style="background-color:  #3f4aa0; white-space: nowrap;">@lang('app.Supplier')</th>
                                    <th class="text-center p-1" style="background-color:  #3f4aa0;">@lang('app.Rate')</th>
                                    <th class="text-center p-1" style="background-color:  #3f4aa0;">@lang('app.Tax(%)')</th>
                                    <th class="text-center p-1" style="background-color:  #3f4aa0;">@lang('app.Amount')</th>
                                    <th class="text-center p-1" style="background-color:  #3f4aa0;">Notes</th>
                                    <th class="text-center p-0" style="width: 38px; padding: 0; background-color:  #3f4aa0;">
                                    </th>
                                 </tr>
                              </thead>
                              <tr>

                              </tr>
                           </table>
                        </div>
                        <div class="btn btn-primary float-right addmorecosthead" style="cursor: pointer">
                           <i class="fa fa-plus" aria-hidden="true"></i> Add
                        </div>
                     </div>
                  </div>
                  <div class="row" style="padding-bottom: 6px;">
                     <div class="col-lg-6">
                     </div>
                     <div class="col-lg-6">
                        <table class="table table-condensed">
                           <thead class="thead-light">
                              <tr>
                                 <td style="border-bottom: 1px dashed gray; color: #ff8300;">@lang('app.Total Cost Amount')</td>
                                 <td style="border-bottom: 1px dashed gray;"><input type="text" name="totalcost_amount" id="totalcost_amount" style="border: 0; text-align: right; color: #ff8300;     font-size: 20px; background-color: #fff; height: calc(0.5em + 1rem + 2px);" class="form-control form-control-sm" disabled></td>
                              </tr>

                           </thead>
                        </table>

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
                  <div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
                     <table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%; ">
                        <thead class="thead-light">
                           <tr>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;" width="30px">#</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;" width="250px">@lang('app.Item Name')</th>
                              @if($branch_settings->inventory_stock_affect_at=='at-invoice')
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;">Save</th>
                              @endif
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Description')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Unit')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px">PO Qty</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px">Balance</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px">@lang('app.Quantity')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;" width="90px">@lang('app.Rate')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Amount')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px">@lang('app.Discount')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px;">@lang('app.VAT')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important; width: ;">@lang('app.VAT Amount')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Total Amount')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($purchaseorder_product as $key=>$cinvoice_products)
                           <tr>
                              @if($cinvoice_products->pi_remaining_quantity!=0)
                              <td>{{$key+1}}</td>
                              <td>
                                 <input class="form-control kt-selectpicker productname" id="productname{{$key+1}}" name="productname[]" data-id="{{$key+1}}" value="{{$cinvoice_products->product_name}}" readonly>
                                 <input type="hidden" name="rid[]" id="rid{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->id}}">
                                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->product_id}}">
                              </td>
                              @if($branch_settings->inventory_stock_affect_at=='at-invoice')
                              <td>
                                 <input type="hidden" name="save_as_old[]" value="">
                                 <select class="form-control" name="save_as[]">
                                    <option value="existing">Existing</option>
                                    <option value="new">New Product</option>
                                 </select>
                              </td>
                              @endif
                              <td><textarea class="form-control" rows="1" name="product_description[]" id="product_description{{$key+1}}" data-id="{{$key+1}}">{{$cinvoice_products->description}}</textarea></td>
                              <td><select class="form-control kt-selectpicker" id="unit{{$key+1}}" name="unit[]" data-id="{{$key+1}}">
                                    <option value="">select</option>
                                    @foreach($unitlist as $data)
                                    <option value="{{$data->id}}" {{($cinvoice_products->unit == $data->id)?"selected":''}}>{{$data->unit_code}}</option>
                                    @endforeach
                                 </select></td>
                              <td>
                                 <input type="text" class="form-control oquantity" name="oquantity[]" id="oquantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->original_quantity}}" readonly>
                              </td>
                              <td>
                                 <input type="text" class="form-control pi_remaining_quantity" name="pi_remaining_quantity[]" id="pi_remaining_quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->pi_remaining_quantity}}" readonly>
                              </td>
                              <td>
                                 <input type="text" class="form-control quantity integerVal" name="quantity[]" id="quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->pi_remaining_quantity}}">
                                 <input type="hidden" class="form-control piquantity" name="pi_quantity[]" id="grm_quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->pi_quantity}}">

                              </td>
                              <td><input type="text" class="form-control rate" name="rate[]" id="rate{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->rate}}"></td>
                              <td><input type="text" class="form-control amount" name="amount[]" id="amount{{$key+1}}" data-id="{{$key+1}}" readonly value="{{$cinvoice_products->amount}}"></td>
                              <td><input type="text" class="form-control discountamount integerVal" name="discountamount[]" id="discountamount{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->rdiscount}}"></td>

                              <td>
                                 <select class="form-control kt-selectpicker vat_percentage" data-id="{{$key+1}}" name="vat_percentage[]" id="vat_percentage{{$key+1}}">
                                    @foreach($taxgrouplist as $data)
                                    <option value="{{$data->total}}" {{($cinvoice_products->vat_percentage == $data->total)?'selected':''}}>{{$data->total}}</option>
                                    @endforeach
                                 </select>
                              </td>

                              <td><input type="text" class="form-control vatamount" name="vatamount[]" id="vatamount{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->vatamount}}"></td>
                              <td><input type="text" class="form-control row_total" name="row_total[]" id="row_total{{$key+1}}" data-id="{{$key+1}}" readonly value="{{$cinvoice_products->totalamount}}"></td>
                              <td>
                                 <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span> </div>
                              </td>
                              @endif
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
                        <label style="    font-size: 1.5rem;  font-weight: bold; padding-top:4px">@lang('app.Total Amount')</label>
                     </div>
                     <div class="col-md-8 input-group-sm">
                        <input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly value="{{$grandtotalamount}}" style=" background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem;  font-weight: bold; color: #646c9a; padding-top: 0px;">
                     </div>
                  </div>
               </div>

            </div>

            <div class="row mt-5">
               <!-- new -->
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4"></div>
                     <div class="col-md-4 input-group-sm">
                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                           <input type="checkbox" id="markPayments" name="markPayments" value="1"> Mark Payments
                           <span></span>
                        </label>
                     </div>
                  </div>
               </div>

               <div class="col-lg-12 markPayments" style="display:none">
                  <div class="row mt-5">
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4"></div>
                           <div class="col-md-4 input-group-sm">
                              <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                 <input type="checkbox" id="use_advance" name="use_advance" value="1"> Use Advance
                                 <span></span>
                              </label>
                           </div>
                           <div class="col-md-4 useAdvance" style="display:none">
                              Credit Balance : {{$adwanceAmount}}
                              <input type="hidden" name="debitBalance" id="debitBalance" value="{{$adwanceAmount}}">
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="useAdvance" style="display:none">
                           <div class="form-group  row pr-md-3">
                              <div class="col-md-2"></div>
                              <div class="col-md-4">
                                 <label>Pay From Advance <span style="color: red">*</span></label>
                              </div>
                              <div class="col-md-4 input-group-sm">
                                 <input type="text" class="form-control integerVal amount" name="advance_amt" id="advance_amt" value="0">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <table class="table table-striped table-hover" id="modeofpaymenttable">
                     <thead style=" background-color: #306584; color: white;">
                        <tr>
                           <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 5%;">#</th>
                           <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 10%;">Method</th>
                           <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 15%;">Debit Account</th>
                           <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 35%;">@lang('app.Reference')</th>
                           <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;width: 30%;">@lang('app.Amount')</th>
                           <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 5%;">Action</th>
                        </tr>
                     </thead>
                     <tbody>

                        <tr>
                           <td class="row_count" id="rowcount" style="padding: 0; text-align: center">1</td>
                           <td style="padding: 0;">
                              <select class="form-control" name="type[]" style="height: calc(1.1em + 1.3rem + 2px)!important;">
                                 <option value="">select</option>
                                 <option value="By Cash">By Cash</option>
                                 <option value="By Card">By Card</option>
                                 <option value="By Bank">By Bank</option>
                              </select>
                           </td>
                           <td style="padding: 0;">
                              <select class="form-control" name="debitaccount[]" style="height: calc(1.1em + 1.3rem + 2px)!important;">
                                 <option value="">select</option>
                                 @foreach($debitLedjer as $ledger)
                                 <option value="{{$ledger->id}}">[{{$ledger->code}}] {{$ledger->name}} </option>
                                 @endforeach
                              </select>
                           </td>
                           <td style="padding: 0;">
                              <div class="input-group input-group-sm">
                                 <input type="text" class="form-control reference" name="reference[]" value="">
                              </div>
                           </td>
                           <td style="padding: 0;">
                              <div class="input-group input-group-sm">
                                 <input type="text" class="form-control pay_amount integerVal" name="pay_amount[]" value="0">
                              </div>
                           </td>
                           <td style="padding: 0;">
                              <div class="kt-demo-icon__preview costremove_payments">
                                 <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <table style="width:100%;">
                     <tr>
                        <td>
                           <button type="button" class="addmorepayments btn btn-brand btn-elevate btn-icon-sm  float-right"><i class="la la-plus"></i>Add More</button>
                        </td>
                     </tr>
                  </table>
                  <div class="row mt-5">
                     <div class="col-lg-6"></div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Total Paid Amount</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control paidamount " name="paidamount" id="paidamount" value="0" readonly="" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.5rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6"></div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Total Invoiced Amount</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control totalinvoicedamount " name="totalinvoicedamount" id="totalinvoicedamount" value="{{$grandtotalamount}}" readonly="" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.5rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6"></div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Balance Amount</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control balanceamount " name="balanceamount" id="balanceamount" value="{{$grandtotalamount}}" readonly="" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.5rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
                           </div>
                        </div>
                     </div>

                  </div>
               </div>

               <!-- ./new -->
            </div>

            <input type="hidden" name="branch" id="branch" value="{{$branch}}">
            <input type="hidden" name="enquiryrfqid" id="enquiryrfqid" value="">
            <input type="hidden" name="enquiryid" id="enquiryid" value="">
            <input type="hidden" name="id" id="id" value="{{$id}}">
            <input type="hidden" name="rfq_id" id="rfq_id" value="">
            <input type="hidden" name="unique_id" id="unique_id" value="{{substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8)}}">
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
                        <button type="button" class="btn btn-primary" id="pi_update_edit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                              <polyline points="22 4 12 14.01 9 11.01"></polyline>
                           </svg> &nbsp;Save</button>
                     </div>
                  </div>
               </div>
            </div>



         </form>



      </div>
   </div>
</div>

<div class="modal fade" id="myModal" role="dialog"></div>

<div class="modal fade" id="serviceModal" role="dialog"></div>

<div class="modal fade" id="kt_modal_4_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="min-width: 1024px;">
   <input type="hidden" name="id" id="id" value="">
   <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('mainproducts.Product List') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form class="kt-form kt-form--label-right" id="category-form" name="category-form">
               <div class="kt-portlet__body">

                  <table class="table table-striped table-hover table-checkable dataTable no-footer" id="productdetails_list">
                     <thead>
                        <tr>
                           <th>{{ __('mainproducts.S.No') }}</th>
                           <th>{{ __('mainproducts.Product Name') }}</th>
                           <th>Description</th>
                           <th>{{ __('mainproducts.Product Code') }}</th>
                           <th>{{ __('mainproducts.Barcode') }}</th>
                           <th>{{ __('mainproducts.Unit') }}</th>
                           <th>Product price</th>
                           <th>Selling price</th>
                           <th>Stock</th>
                           <th>WH</th>
                           <th>Store</th>
                           <th>Category</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>

                  <table class="table" style="width:50%; margin-left:50%;">
                     <thead class="thead-light">
                        <tr>
                           <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total items selected</td>
                           <td style="border-bottom: 1px dashed gray; text-align: right;">
                              <input type="text" id="selected_items" readonly class="form-control input form-control-sm" style="border:0; text-align: right; background-color: #fff; height: calc(0.5em + 1rem + 2px);font-size: 20px; font-weight:bold;">
                           </td>
                        </tr>

                        <tr>
                           <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total amount</td>
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


@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/qpurchase/invoicePaymentsCalculations.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/qpurchase/common/totalamountcalculation.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/qpurchase/purchaseorder.js" type="text/javascript"></script>
<script>
   $('.qpurchase_order').addClass('kt-menu__item--active');

   $('body').on('keyup', '.quantity', function() {
      var id = $(this).attr('data-id');
      tableForwardCalculation();
      checkBalanceAvailable(id);
      findSum();
   });

   $('body').on('change keyup', '#discount_type, .rate, .vatamount, .discountamount, .vat_percentage', function() {
      tableForwardCalculation();
      findSum();
   });


   function checkBalanceAvailable(id) {
      var quantity = $('#quantity' + id + '').val();
      var remainQty = $('#pi_remaining_quantity' + id + '').val();
      console.log('quantity' + quantity);
      console.log('remainQty' + remainQty);
      var error = 0;
      if (parseInt(remainQty) < parseInt(quantity)) {
         $('#quantity' + id + '').addClass('is-invalid');
         error++;
      } else
         $('#quantity' + id + '').removeClass('is-invalid');

   }

   $(document.body).on("change", "#currency", function() {
      var cid = $(this).val();
      $.ajax({
         url: "getcurrency_qpurchase",
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
            cvalue = getNum(cvalue);
            $('#currency_value').val(cvalue);
         }
      })
   });


   $(document).ready(function() {
      $(document).on('change', '.supplier_vendor_names', function() {

         var name = $(this).val();
         var provider = $('input[name="vendor_supplier"]:checked').val();
         if (provider == 1) {
            $.ajax({
               url: "getvendordetails",
               method: "POST",
               data: {
                  _token: $('#token').val(),
                  id: name
               },
               dataType: "json",
               success: function(data) {
                  $.each(data, function(key, value) {
                     $('#customer').val('');
                     $('#cust_category').val(value.category);
                     $('#cust_type').val(value.type);
                     $('#cust_group').val(value.group);
                     $('#cust_name').val(value.vendor_name);
                     $('#building_no').val(value.vendor_add1);
                     $('#cust_region').val(value.vendor_region);
                     $('#cust_district').val('');
                     $('#cust_city').val(value.vendor_city);
                     $('#cust_zip').val(value.vendor_zip);
                     $('#mobile').val(value.mobile1);
                     $('#vatno').val(value.vat_no);
                     $('#buyerid_crno').val(value.cr_no);
                     $('#cust_country').val(value.cntry_name);

                  });

               }
            });
         }
         if (provider == 2) {
            $.ajax({
               url: "getsupplierdetails",
               method: "POST",
               data: {
                  _token: $('#token').val(),
                  id: name
               },
               dataType: "json",
               success: function(data) {
                  console.log(data);

                  $.each(data, function(key, value) {
                     $('#customer').val('');
                     $('#cust_category').val(value.category);
                     $('#cust_type').val(value.type);
                     $('#cust_group').val(value.group);
                     $('#cust_name').val(value.sup_name);
                     $('#building_no').val(value.sup_add1);
                     $('#cust_region').val(value.sup_region);
                     $('#cust_district').val(value.sup_add2);
                     $('#cust_city').val(value.sup_city);
                     $('#cust_zip').val(value.sup_zip);
                     $('#mobile').val(value.mobile1);
                     $('#vatno').val(value.vat_no);
                     $('#buyerid_crno').val(value.cr_no);
                     $('#cust_country').val(value.cntry_name);

                  });

               }
            });
         }

      });

   });
   $(document.body).on("change", "input[type=radio][name=vendor_supplier]", function() {
      var checkedValue = $('input[name="vendor_supplier"]:checked').val();
      $.ajax({
         url: "getsupplier_vendor",
         method: "POST",
         data: {
            _token: $('#token').val(),
            id: checkedValue
         },
         dataType: "json",
         success: function(data) {
            console.log(data);
            $('select[name="supplier_vendor_names"]').empty();
            $('select[name="supplier_vendor_names"]').append('<option value="">select</option>');
            $.each(data, function(key, value) {
               $('select[name="supplier_vendor_names"]').append('<option value="' + value.id + '">' + value.name + '</option>');
            });
         }
      })
   });


   $("body").on("click", ".costremove", function(event) {
      event.preventDefault();
      var row = $(this).closest('tr');
      var siblings = row.siblings();
      row.remove();
      siblings.each(function(index) {
         $(this).children().first().text(index);
      });
      costtotal_calculate();
   });


   $(document).ready(function() {
      var rowcount = ($("#costhead_table > tbody > tr").length);
      $(".addmorecosthead").click(function() {
         var sl = ($("#costhead_table > tbody > tr").length);
         var costs = '';
         costs += '<tr>\
            <td class="row_count text-center pt-2" id="rowcount">' + sl + '</td>\
            <td>\
            <input type="text" class="form-control costsupplier" name="itemcost_details[]" id="itemcost_details' + rowcount + '"  data-id=' + rowcount + '>\
            </td>\
            <td>\
            <input type="text" class="form-control costsupplier" name="costsupplier[]" id="costsupplier' + rowcount + '"  data-id=' + rowcount + '>\
            </td>\
            <td>\
            <input type="text" class="form-control costrate integerVal" name="costrate[]" id="costrate' + rowcount + '"  data-id=' + rowcount + ' value="0">\
            </td>\
             <td>\
            <select class="form-control form-control-sm single-select costtax_group kt-selectpicker" name="costtax_group[]" id="costtax_group' + rowcount + '" data-id=' + rowcount + '>\
           <option value="">Select</option>\
            @foreach($taxgrouplist as $data)\
              <option data-total="{{$data->total}}" value="{{$data->id}}" {{($data->default_tax == 1)?"selected":""}} > {{$data->taxgroup_name}} </option>\
            @endforeach\
            </select>\
            <td>\
            <input type="text" class="form-control costtax_amount" name="costtax_amount[]" id="costtax_amount' + rowcount + '"  data-id=' + rowcount + ' readonly value="0">\
            </td>\
            <td>\
            <input type="text" class="form-control costtax_notes" name="costtax_notes[]" id="costtax_notes' + rowcount + '"  data-id=' + rowcount + ' >\
            </td>\
            <td>\
            <div class="kt-demo-icon__preview costremove pt-2">\
            <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>\
            </div>\
            </td>\
            </tr>';
         $('#costhead_table').append(costs);
         rowcount++;
      });

   });
   $('body').on('change', '.costtax_group', function() {
      var id = $(this).attr('data-id');
      costrow_calculate(id);
   });

   function costrow_calculate(id) {
      var costrow_total = 0;
      var costrate = getNum($('#costrate' + id + '').val());

      var costtax_group = $('#costtax_group' + id + '').val();
      var total_taxa = $('#costtax_group' + id + '').find(':selected').attr('data-total')



      if (isNaN(costtax_group)) {
         var vat_value = parseFloat(costrate);
      } else {
         if (isNaN(total_taxa)) {
            total_taxa = 0;
         }
         //  var rowcost_taxamount = (total_taxa / 100) * costrate;
         var vat_values = ((costrate * total_taxa) / 100);
         var vat_value = parseFloat(vat_values) + parseFloat(costrate);
         var rowcost_taxamount = costrate - ((costrate / 100) * costtax_group);

      }
      $('#costtax_amount' + id + '').val(vat_value);
      costtotal_calculate();

   }

   $('body').on('keyup', '.costrate', function() {
      var id = $(this).attr('data-id');
      costrow_calculate(id);
   });




   function costtotal_calculate() {
      var totalcosttax_amount = 0;
      $('.costtax_amount').each(function() {
         var id = $(this).attr('data-id');
         var tax_amount = $('#costtax_amount' + id + '').val();
         totalcosttax_amount += parseFloat(tax_amount);
      });

      $('#totalcost_amount').val(totalcosttax_amount);
   }
   $(document.body).on("change", ".itemcost_details", function() {
      var costhead = $(this).val();
      var cc = $(this).attr('data-id');
      $.ajax({
         url: "getvoucherdetails",
         method: "POST",
         data: {
            _token: $('#token').val(),
            id: costhead
         },
         dataType: "json",
         success: function(data) {
            $.each(data, function(key, value) {
               $('#costrate' + cc + '').val(value.totalamount);
               $('#costsupplier' + cc + '').val(value.sup_name);
            });
            costrow_calculate(cc);
         }
      })
   });
</script>

<script type="text/javascript">
   window.addEventListener("load", function() {
      tableForwardCalculation();
      findSum();
   });
</script>
@endsection