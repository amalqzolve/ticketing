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

   #productdetails_list_pur_wrapper {
      height: 300px;
      overflow-y: scroll;
   }
</style>
<?php
$total = 0;
foreach ($pi as $pi) {
   $qbuy_purchase_pi_id = $pi->id;
   $supplier_id = $pi->supplier_id;
   $qtnref = $pi->qtnref;
   $po_wo_ref = $pi->po_wo_ref;
   $attention = $pi->attention;
   $salesman = $pi->salesman;
   $currency = $pi->currency;
   $currencyvalue = $pi->currencyvalue;
   $totalamount = $pi->totalamount;
   $discount = $pi->discount;
   $amountafterdiscount  = $pi->amountafterdiscount;
   $vatamount = $pi->vatamount;
   $grandtotalamount = $pi->grandtotalamount;
   $terms = $pi->terms;
   $notes = $pi->notes;
   $preparedby = $pi->preparedby;
   $approvedby = $pi->approvedby;
   $tpreview = $pi->tpreview;
   $internal_reference = $pi->internal_reference;
   $purchasemethod = $pi->purchasemethod;
   $purchasebillid = $pi->purchasebillid;
   $purchaser = $pi->purchaser;
   $bill_entry_date = $pi->bill_entry_date;
   $discount_type = $pi->discount_type;
}
foreach ($pname as $pname) {
   $supid = $pname->id;
   $sup_add1 = $pname->sup_add1;
   $sup_add2 = $pname->sup_add2;
   $sup_region = $pname->sup_region;
   $sup_city = $pname->sup_city;
   $sup_zip = $pname->sup_zip;
   $mobile1 = $pname->mobile1;
   $vat_no = $pname->vatno;
   $cr_no = $pname->buyerid_crno;
   $sup_name = $pname->sup_name;
   $type = $pname->type;
   $category = $pname->category;
   $group = $pname->group;
   $cntry_name = $pname->cntry_name;
}
?>
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
               {{$purchase_return->code}}/{{$purchase_return->br_id}}
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

            <input type="hidden" name="id" id="id" value="{{$purchase_return->id}}">
            <input type="hidden" name="qbuy_purchase_pi_id" id="qbuy_purchase_pi_id" value="{{$qbuy_purchase_pi_id}}">
            <input type="hidden" name="supplier_id" id="supplier_id" value="{{$supplier_id}}">

            <ul class="nav nav-tabs nav-fill" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_0">Return Details</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_1">Invoice Details</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_2">Other Information</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3">Terms and Conditions</a>
               </li>


            </ul>



            <div class="tab-content">
               <div class="tab-pane p-3 active" id="kt_tabs_2_0" role="tabpanel">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Date <span style="color: red">*</span> </label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control kt_datetimepickerr" name="returndate" id="returndate" value="{{date('d-m-Y',strtotime($purchase_return->returndate))}}">
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Reason</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <textarea class="form-control" name="reason" id="reason">{{$purchase_return->reason}}</textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>


               <div class="tab-pane p-3 " id="kt_tabs_2_1" role="tabpanel">
                  <div class="row">

                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Bill Entry Date')</label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group input-group-sm">
                                 <input type="text" class="form-control" name="bill_entry_date" id="bill_entry_date" placeholder="" value="{{$bill_entry_date}}" readonly>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
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
                              <label>VO/Change Orders</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="po_wo_ref" id="po_wo_ref" value="{{$po_wo_ref}}" readonly>
                           </div>
                        </div>
                     </div>




                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Attention')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="attention" id="attention" value="{{$attention}}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Salesman')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <select class="form-control single-select kt-selectpicker" id="salesman" disabled>
                                 <option value="">select</option>
                                 @foreach($salesmen as $data)
                                 <option value="{{$data->id}}" <?php if ($salesman == $data->id) {
                                                                  echo 'selected';
                                                               } ?>>{{$data->name}}</option>
                                 @endforeach
                              </select>
                              <!-- </div> -->
                           </div>
                        </div>
                     </div>


                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Currency')</label>
                           </div>
                           <div class="col-md-8 input-group input-group-sm">
                              <select class="form-control single-select currency kt-selectpicker" name="currency" id="currency" disabled>
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
                              <select class="form-control kt-selectpicker" id="preparedby" disabled>
                                 <option value="">select</option>
                                 @foreach($salesmen as $data)
                                 <option value="{{$data->id}}" <?php if ($preparedby == $data->id) {
                                                                  echo 'selected';
                                                               } ?>>{{$data->name}}</option>
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
                              <select class="form-control kt-selectpicker" id="approvedby" disabled>
                                 <option value="">select</option>
                                 @foreach($salesmen as $data)
                                 <option value="{{$data->id}}" <?php if ($approvedby == $data->id) {
                                                                  echo 'selected';
                                                               } ?>>{{$data->name}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Purchaser')</label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group input-group-sm">
                                 <select class="form-control single-select input-group-sm kt-selectpicker purchaser" name="purchaser" id="purchaser" disabled>
                                    <option value="">Select</option>
                                    @foreach($salesmen as $data)
                                    <option value="{{$data->id}}" <?php if ($purchaser == $data->id) {
                                                                     echo 'selected';
                                                                  } ?>>
                                       {{$data->name}}
                                    </option>
                                    @endforeach

                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Purchase Bill ID')</label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group input-group-sm">
                                 <input type="text" class="form-control" name="purchasebillid" id="purchasebillid" value="{{$purchasebillid}}" readonly>
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
                              <select class="form-control single-select purchasemethod kt-selectpicker" id="purchasemethod" disabled>
                                 @if($purchasemethod == 1)
                                 <option value="1" selected="">Cash</option>
                                 <option value="2">Credit</option>
                                 @endif
                                 @if($purchasemethod == 2)
                                 <option value="1">Cash</option>
                                 <option value="2" selected="">Credit</option>
                                 @endif
                              </select>
                           </div>
                        </div>
                     </div>


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
                     <div class="col-md-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Vat No</label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group  input-group-sm">
                                 <input type="text" class="form-control" placeholder="{{ __('customer.Vat No') }}" id="vatno" name="vatno" autocomplete="off" readonly value="{{$vat_no}}">
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
                                 <input type="text" class="form-control" placeholder="{{ __('customer.Buyer ID / CR No') }}" id="buyerid_crno" name="buyerid_crno" autocomplete="off" readonly value="{{$cr_no}}">
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Discount Type</label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group  input-group-sm">
                                 <input type="hidden" name="discount_type" id="discount_type" value="{{$discount_type}}">
                                 <input type="text" class="form-control" autocomplete="off" readonly value="{{($discount_type==2)?'Percentage':'Flat'}}">
                              </div>
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
                              <textarea class="form-control" name="internalreference" id="internalreference">{{$purchase_return->internalreference}}</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Printable notes</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <textarea class="form-control" name="notes" id="notes">{{$purchase_return->notes}}</textarea>
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


                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group  row pr-md-3">
                        <div class="col-md-12 input-group-sm">
                           {{$purchase_return->tpreview}}
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
                  <div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
                     <table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%; ">
                        <thead class="thead-light">
                           <tr>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;" width="30px">#</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;" width="150px">@lang('app.Item Name')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Description')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Unit')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;" width="68px">Purchased</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;" width="65px">Returned</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;" width="65px">Balance</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px">Return Qty</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;" width="90px">@lang('app.Rate')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Amount')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px">@lang('app.Discount')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px;">@lang('app.VAT')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.VAT Amount')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Total Amount')</th>
                              <!-- <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px">@lang('app.Action')</th> -->
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($return_product as $key=>$product)
                           <tr>
                              <td>{{$key+1}}</td>
                              <td>
                                 <input class="form-control kt-selectpicker productname" id="productname{{$key+1}}" name="productname[]" data-id="{{$key+1}}" value="{{$product->itemname}}" readonly>
                                 <input type="hidden" class="form-control item_details_id" name="item_details_id[]" id="item_details_id" data-id="{{$key+1}}" value="{{$product->item_details_id}}">
                                 <input type="hidden" class="form-control qbuy_purchase_pi_products_id" name="qbuy_purchase_pi_products_id[]" id="qbuy_purchase_pi_products_id" data-id="{{$key+1}}" value="{{$product->qbuy_purchase_pi_products_id}}">
                                 <input type="hidden" name="new_product_id[]" value="{{$product->new_product_id}}">
                              </td>
                              <td><textarea class="form-control" rows="1" name="product_description[]" id="product_description{{$key+1}}" data-id="{{$key+1}}">{{$product->description}}</textarea></td>
                              <td><select class="form-control kt-selectpicker" id="unit{{$key+1}}" name="unit[]" data-id="{{$key+1}}" disabled>
                                    <option value="">select</option>
                                    @foreach($unitlist as $data)
                                    @if($product->unit == $data->id)
                                    <option value="{{$data->id}}" selected="">{{$data->unit_code}}</option>
                                    @endif @endforeach
                                 </select></td>
                              <td><input type="text" class="form-control quantity " name="pquantity[]" id="pquantity{{$key+1}}" data-id="{{$key+1}}" value="{{$product->pquantity}}" readonly></td>
                              <td><input type="text" class="form-control quantity " name="returned_qty[]" id="returned_qty{{$key+1}}" data-id="{{$key+1}}" value="{{$product->returned_qty-$product->quantity}}" readonly></td>
                              <td><input type="text" class="form-control quantity " name="bquantity[]" id="bquantity{{$key+1}}" data-id="{{$key+1}}" value="{{$product->pquantity-$product->returned_qty+$product->quantity}}" readonly></td>
                              <td><input type="text" class="form-control quantity integerVal" name="quantity[]" id="quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$product->quantity}}"></td>
                              <td><input type="text" class="form-control rate integerVal" name="rate[]" id="rate{{$key+1}}" data-id="{{$key+1}}" value="{{$product->rate}}" readonly></td>
                              <td><input type="text" class="form-control amount" name="amount[]" id="amount{{$key+1}}" data-id="{{$key+1}}" readonly value="{{$product->amount}}"></td>
                              <td><input type="text" class="form-control discountamount" name="discountamount[]" id="discountamount{{$key+1}}" data-id="{{$key+1}}" value="{{$product->discountamount}}" readonly></td>
                              <td>
                                 <select class="form-control form-control-sm single-select vat_percentage kt-selectpicker" data-id="{{$key+1}}" name="vat_percentage[]" id="vat_percentage{{$key+1}}" disabled>
                                    <option value="0">Select</option>
                                    @foreach($vatlist as $data)
                                    <option value="{{$data->total}}" {{($product->vat_percentage == $data->total)?'Selected':''}}>{{$data->total}}</option>
                                    @endforeach
                                 </select>
                              </td>
                              <td><input type="text" class="form-control vatamount" name="vatamount[]" id="vatamount{{$key+1}}" data-id="{{$key+1}}" value="{{$product->vatamount}}" readonly></td>
                              <td><input type="text" class="form-control row_total" name="row_total[]" id="row_total{{$key+1}}" data-id="{{$key+1}}" readonly value="{{$product->row_total}}"></td>

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
                        <label>@lang('app.Discount (Flat)')</label>
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
                        <input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$vatamount}}">
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
                        <input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly value="{{$grandtotalamount}}" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem;font-weight: bold; color: #646c9a; padding-top: 0px;">
                     </div>
                  </div>
               </div>
            </div>
            <div class="kt-portlet__foot">
               <div class="kt-form__actions">
                  <div class="row">
                     <div class="col-lg-12">

                     </div>
                     <div class="col-lg-12 kt-align-right">

                        <button type="reset" class="btn btn-secondary backHome"> <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                              <line x1="18" y1="6" x2="6" y2="18"></line>
                              <line x1="6" y1="6" x2="18" y2="18"></line>
                           </svg> &nbsp;Back</button>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/qpurchase/purchaseinvoice.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>

<script src="{{url('/')}}/resources/js/qpurchase/common/totalamountcalculation.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/qpurchase/return.js" type="text/javascript"></script>
<script>
   $('.qpurchase-return').addClass('kt-menu__item--active');

   $('body').on('change keyup', '.quantity , .discountamount', function() {
      tableForwardCalculation();
   });
   window.addEventListener("load", function() {
      tableForwardCalculation();
   });
</script>

@endsection