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

$id = $pi->id;
$name = $pi->supplier_id;
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
// dd($pi->paid_from_adwance);
// $paid_from_adwance = $pi->paid_from_adwance;
// $useadvance = $pi->useadvance;
// $paid_by_cash = $pi->paid_by_cash;
// $paid_by_card = $pi->paid_by_card;
// $paid_by_bank = $pi->paid_by_bank;
// $paid_amount = $pi->paid_amount;
// $balance_amount = $pi->balance_amount;

$paid_amount = $pi->paid_amount;
$balance_amount = $pi->balance_amount;

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
               Purchase Invoice
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
                  <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_5">Supplier Details</a>
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
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Bill Entry Date')<span style="color: red">*</span></label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group input-group-sm">
                                 <input type="text" class="form-control kt_datetimepickerr" name="bill_entry_date" id="bill_entry_date" placeholder="" value="{{$bill_entry_date}}">
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
                                 <option value="{{$data->id}}" {{($salesman == $data->id)?'selected':''}}>{{$data->name}}</option>
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
                                 <option value="{{$data->id}}" {{($currency==$data->id)? 'selected':''}}>
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
                                 <option value="{{$data->id}}" {{($preparedby == $data->id)?'selected':''}}>{{$data->name}}</option>
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
                                 <option value="{{$data->id}}" {{($approvedby == $data->id)?'selected':''}}>{{$data->name}}</option>
                                 @endforeach
                              </select>
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
                                    <option value="{{$data->id}}" {{($purchaser==$data->id)?'selected':''}}>{{$data->name}}</option>
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
                                 <input type="text" class="form-control" name="purchasebillid" id="purchasebillid" value="{{$purchasebillid}}">
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
                                 <option value="1" {{($purchasemethod==1)?'selected':''}}>Cash</option>
                                 <option value="2" {{($purchasemethod==2)?'selected':''}}>Credit</option>
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
                              <option value="{{$data->id}}" {{($terms == $data->id)?'selected':''}}>{{$data->term}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group  row pr-md-3">
                        <!-- <div class="col-md-4">
                              <label>Terms and Conditions Preview</label>
                              </div>  -->
                        <div class="col-md-12 input-group-sm">
                           <div class="kt-tinymce">
                              <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target">{{$tpreview}}</textarea>
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
                                    <th class="text-center pt-1 pb-1 pr-2 pl-2" style="background-color:  #3f4aa0; white-space: nowrap;">Details</th>
                                    <th class="text-center pt-1 pb-1 pr-2 pl-2" style="background-color:  #3f4aa0; white-space: nowrap;">@lang('app.Supplier')</th>
                                    <th class="text-center p-1" style="background-color:  #3f4aa0;">@lang('app.Rate')</th>
                                    <th class="text-center p-1" style="background-color:  #3f4aa0;">@lang('app.Tax(%)')</th>
                                    <th class="text-center p-1" style="background-color:  #3f4aa0;">@lang('app.Amount')</th>
                                    <th class="text-center p-1" style="background-color:  #3f4aa0;">Notes</th>
                                    <th class="text-center p-0" style="width: 38px; padding: 0; background-color:  #3f4aa0;"></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($pi_costhead as $key=>$pi_costhead)
                                 <?php $total += $pi_costhead->amount; ?>
                                 <tr>
                                    <td class="row_count text-center pt-2" id="rowcount">{{$key+1}}</td>
                                    <td>
                                       <input type="text" class="form-control itemcost_details" name="itemcost_details[]" id="itemcost_details{{$key+1}}" data-id={{$key+1}} value="{{$pi_costhead->costheadname}}">
                                    </td>
                                    <td>
                                       <input type="text" class="form-control costsupplier" name="costsupplier[]" id="costsupplier{{$key+1}}" data-id={{$key+1}} value="{{$pi_costhead->costsupplier}}">
                                    </td>
                                    <td>
                                       <input type="text" class="form-control costrate" name="costrate[]" id="costrate{{$key+1}}" data-id={{$key+1}} value="{{$pi_costhead->rate}}">
                                    </td>
                                    <td>
                                       <select class="form-control costtax_group" name="costtax_group[]" id="costtax_group{{$key+1}}" data-id={{$key+1}}>
                                          @foreach($taxgrouplist as $data)
                                          <option data-total="{{$data->total}}" value="{{$data->id}}" {{($data->id == $pi_costhead->tax)?"selected":''}}>{{$data->taxgroup_name}}</option>
                                          @endforeach
                                       </select>
                                    <td>
                                       <input type="text" class="form-control costtax_amount" name="costtax_amount[]" id="costtax_amount{{$key+1}}" data-id={{$key+1}} readonly value="{{$pi_costhead->amount}}">
                                    </td>
                                    <td>
                                       <input type="text" class="form-control costtax_notes" name="costtax_notes[]" id="costtax_notes{{$key+1}}" data-id={{$key+1}} value="{{$pi_costhead->costtax_notes}}">
                                    </td>
                                    <td>
                                       <div class="kt-demo-icon__preview costremove pt-2">
                                          <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>
                                       </div>
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
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
                                 <td style="border-bottom: 1px dashed gray;"><input type="text" name="totalcost_amount" id="totalcost_amount" style="border: 0; text-align: right; color: #ff8300;     font-size: 20px; background-color: #fff; height: calc(0.5em + 1rem + 2px);" class="form-control form-control-sm" disabled value="{{$total}}"></td>
                              </tr>
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="tab-pane p-3" id="kt_tabs_2_5" role="tabpanel">
                  <div class="row">
                     <input type="hidden" name="customer1" id="customer1" value="{{$supid}}">
                     <input type="hidden" name="piid" id="piid" value="{{$id}}">

                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Category</label>
                           </div>
                           <div class="col-md-8  input-group input-group-sm">
                              <input type="text" class="form-control Cust_category" id="cust_category" name="cust_category" readonly value="{{$category}}">
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group row  pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Type</label>
                           </div>
                           <div class="col-md-8 input-group input-group-sm">
                              <input type="text" class="form-control single-select" id="cust_type" name="cust_type" readonly value="{{$type}}">
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
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Building No</label>
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
                              <label>Supplier Street Name</label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group  input-group-sm">
                                 <input type="text" class="form-control" id="cust_region" name="cust_region" autocomplete="off" placeholder="{{ __('customer.Street Name') }}" readonly value="{{$sup_add2}}">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier District</label>
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
                              <label>Supplier City</label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group  input-group-sm">
                                 <input type="text" class="form-control" id="cust_city" name="cust_city" autocomplete="off" placeholder="{{ __('customer.City') }}" readonly value="{{$sup_city}}">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Country</label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group  input-group-sm">
                                 <input type="text" name="cust_country" id="cust_country" class="form-control" readonly value="{{$cntry_name}}">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Postal Code</label>
                           </div>
                           <div class="col-md-8">
                              <div class="input-group  input-group-sm">
                                 <input type="text" class="form-control" id="cust_zip" name="cust_zip" autocomplete="off" placeholder="{{ __('customer.Postal Code') }}" readonly value="{{$sup_zip}}">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Mobile Number</label>
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
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;" width="30px">#</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">@lang('app.Item Name')</th>
                              @if($branch_settings->inventory_stock_affect_at=='at-invoice')
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;">Save</th>
                              @endif
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Description')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Unit')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px">@lang('app.Quantity')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;" width="90px">@lang('app.Rate')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Amount')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px">@lang('app.Discount')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important; " width="60px;">@lang('app.VAT')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.VAT Amount')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Total Amount')</th>
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($pi_product as $key=>$pi_product)
                           <tr>
                              <td>{{$key+1}}</td>
                              <td>
                                 <input class="form-control kt-selectpicker productname" id="productname{{$key+1}}" name="productname[]" data-id="{{$key+1}}" value="{{$pi_product->itemname}}" readonly>
                                 <input type="hidden" class="form-control item_details_id" name="item_details_id[]" id="item_details_id" data-id="{{$key+1}}" value="{{$pi_product->item_details_id}}">
                              </td>
                              @if($branch_settings->inventory_stock_affect_at=='at-invoice')
                              <td>
                                 <input type="hidden" name="new_product_id[]" value="{{$pi_product->new_product_id}}">
                                 <input type="hidden" name="product_transaction_id[]" value="{{$pi_product->product_transaction_id}}">
                                 <input type="hidden" name="save_as_old[]" value="{{$pi_product->save_as}}">
                                 <input type="hidden" name="quantity_old[]" value="{{$pi_product->quantity}}">
                                 <select class="form-control" name="save_as[]">
                                    <option value="existing" {{($pi_product->save_as=='existing')?'selected':''}}>Existing</option>
                                    <option value="new" {{($pi_product->save_as=='new')?'selected':''}}>New Product</option>
                                 </select>
                              </td>
                              @endif

                              <td><textarea class="form-control" rows="1" name="product_description[]" id="product_description{{$key+1}}" data-id="{{$key+1}}">{{$pi_product->description}}</textarea></td>
                              <td><select class="form-control kt-selectpicker" id="unit{{$key+1}}" name="unit[]" data-id="{{$key+1}}">
                                    <option value="">select</option>
                                    @foreach($unitlist as $data)
                                    <option value="{{$data->id}}" {{($pi_product->unit == $data->id)?'selected':''}}>{{$data->unit_code}}</option>
                                    @endforeach
                                 </select></td>
                              <td><input type="text" class="form-control quantity integerVal" name="quantity[]" id="quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$pi_product->quantity}}"></td>
                              <td><input type="text" class="form-control rate integerVal" name="rate[]" id="rate{{$key+1}}" data-id="{{$key+1}}" value="{{$pi_product->rate}}"></td>
                              <td><input type="text" class="form-control amount" name="amount[]" id="amount{{$key+1}}" data-id="{{$key+1}}" readonly value="{{$pi_product->amount}}"></td>
                              <td><input type="text" class="form-control discountamount integerVal" name="discountamount[]" id="discountamount{{$key+1}}" data-id="{{$key+1}}" value="{{$pi_product->rdiscount}}"></td>
                              <td>
                                 <select class="form-control vat_percentage kt-selectpicker" data-id="{{$key+1}}" name="vat_percentage[]" id="vat_percentage{{$key+1}}">
                                    @foreach($taxgrouplist as $data)
                                    <option value="{{$data->total}}" {{($pi_product->vat_percentage == $data->total)?'Selected':''}}>{{$data->total}}</option>
                                    @endforeach
                                 </select>
                              </td>
                              <td><input type="text" class="form-control vatamount" name="vatamount[]" id="vatamount{{$key+1}}" data-id="{{$key+1}}" value="{{$pi_product->vatamount}}"></td>
                              <td><input type="text" class="form-control row_total" name="row_total[]" id="row_total{{$key+1}}" data-id="{{$key+1}}" readonly value="{{$pi_product->totalamount}}"></td>
                              <td>
                                 <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span> </div>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     <table style="width:100%;">
                        <tr>
                           <td>
                              <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" data-type="add" data-toggle="modal" data-target="#kt_modal_4_4"><i class="la la-plus"></i>Line Iteam</button>
                              <a href="{{url('/')}}/Add-Product" target="_blank" class="btn btn-light btn-elevate btn-icon-sm float-right mr-2">
                                 New Product
                              </a>
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

            <div class="row mt-5">
               <!-- new -->
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4"></div>
                     <div class="col-md-4 input-group-sm">
                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                           <input type="checkbox" id="markPayments" name="markPayments" value="1" {{($pi->mark_payments==1)?'checked':''}}> Mark Payments
                           <span></span>
                        </label>
                     </div>
                  </div>
               </div>

               <div class="col-lg-12 markPayments" style="display:{{($pi->mark_payments==1)?'block':'none'}}">
                  <div class="row mt-5">
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4"></div>
                           <div class="col-md-4 input-group-sm">
                              <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                 <input type="checkbox" id="use_advance" name="use_advance" value="1" {{($pi->use_advance==1)?'checked':''}}> Use Advance
                                 <span></span>
                              </label>
                           </div>
                           <div class="col-md-4 useAdvance" style="display:{{($pi->use_advance==1)?'block':'none'}}">
                              Credit Balance : {{$adwanceAmount}}
                              <input type="hidden" name="debitBalance" id="debitBalance" value="{{$adwanceAmount}}">
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="useAdvance" style="display:{{($pi->use_advance==1)?'block':'none'}}">
                           <div class="form-group  row pr-md-3">
                              <div class="col-md-2"></div>
                              <div class="col-md-4">
                                 <label>Pay From Advance <span style="color: red">*</span></label>
                              </div>
                              <div class="col-md-4 input-group-sm">
                                 <input type="text" class="form-control integerVal amount" name="advance_amt" id="advance_amt" value="{{$pi->advance_amt}}">
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
                        @if(!count($pi_payments))
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
                        @else
                        @foreach($pi_payments as $key=>$invoicePayment)
                        <tr>
                           <td class="row_count" id="rowcount" style="padding: 0; text-align: center">1</td>
                           <td style="padding: 0;">
                              <select class="form-control" name="type[]" style="height: calc(1.1em + 1.3rem + 2px)!important;">
                                 <option value="">select</option>
                                 <option value="By Cash" {{($invoicePayment->type=='By Cash')?'selected':''}}>By Cash</option>
                                 <option value="By Card" {{($invoicePayment->type=='By Card')?'selected':''}}>By Card</option>
                                 <option value="By Bank" {{($invoicePayment->type=='By Bank')?'selected':''}}>By Bank</option>
                              </select>
                           </td>
                           <td style="padding: 0;">
                              <select class="form-control" name="debitaccount[]" style="height: calc(1.1em + 1.3rem + 2px)!important;">
                                 <option value="">select</option>
                                 @foreach($debitLedjer as $ledger)
                                 <option value="{{$ledger->id}}" {{($invoicePayment->debitaccount==$ledger->id)?'selected':''}}>[{{$ledger->code}}] {{$ledger->name}} </option>
                                 @endforeach
                              </select>
                           </td>
                           <td style="padding: 0;">
                              <div class="input-group input-group-sm">
                                 <input type="text" class="form-control reference" name="reference[]" value="{{$invoicePayment->reference}}">
                              </div>
                           </td>
                           <td style="padding: 0;">
                              <div class="input-group input-group-sm">
                                 <input type="text" class="form-control pay_amount integerVal" name="pay_amount[]" value="{{$invoicePayment->pay_amount}}">
                              </div>
                           </td>
                           <td style="padding: 0;">
                              <div class="kt-demo-icon__preview costremove_payments">
                                 <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>
                              </div>
                           </td>
                        </tr>
                        @endforeach
                        @endif
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
                              <input type="text" class="form-control paidamount " name="paidamount" id="paidamount" value="{{$pi->paid_amount}}" readonly="" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.5rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
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
                              <input type="text" class="form-control totalinvoicedamount " name="totalinvoicedamount" id="totalinvoicedamount" value="{{$pi->grandtotalamount}}" readonly="" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.5rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
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
                              <input type="text" class="form-control balanceamount " name="balanceamount" id="balanceamount" value="{{$pi->balance_amount}}" readonly="" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.5rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
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
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="rfq_id" id="rfq_id" value="">
            <input type="hidden" name="unique_id" id="unique_id" value="{{substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8)}}">
            <div class="kt-portlet__foot">
               <div class="kt-form__actions">
                  <div class="row">
                     <div class="col-lg-12"></div>
                     <div class="col-lg-12 kt-align-right">
                        <button type="reset" class="btn btn-secondary backHome"> <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                              <line x1="18" y1="6" x2="6" y2="18"></line>
                              <line x1="6" y1="6" x2="18" y2="18"></line>
                           </svg> &nbsp;@lang('app.Cancel')</button>
                        <button type="button" class="btn btn-primary" id="pi_update"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                              <polyline points="22 4 12 14.01 9 11.01"></polyline>
                           </svg> &nbsp;@lang('app.Update')</button>
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
                  <div class="row">
                     <div class="kt-portlet__head-toolbar">
                     </div>
                     <?php
                     $default_warehouse = '';
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
                     <input type="hidden" name="wid" id="wid" value="{{$default_warehouse}}">
                     <div class="col-9" style=" z-index: 100;">
                        <div class="form-group pt-2">
                           <select class="form-control form-control-sm setwarehouse" style="z-index: 100;" id="setwarehouse" name="setwarehouse">
                              <option value="">Select Warehouse</option>
                              @foreach($warehouses as $data)
                              <option value="{{$data->id}}" {{($data->id == $default_warehouse)?'selected':''}} data-wid="{{$data->id}}" data-wname="{{$data->warehouse_name}}" wid="{{$data->id}}" wname="{{$data->warehouse_name}}">{{$data->warehouse_name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-3"></div>
                  </div>
               </div>
               <table class="table table-striped table-hover table-checkable dataTable no-footer" id="productdetails_list_pur">
                  <thead>
                     <tr>
                        <th>{{ __('mainproducts.S.No') }}</th>
                        <th>{{ __('mainproducts.Product Code') }}</th>
                        <th>{{ __('mainproducts.Product Name') }}</th>
                        <th>{{ __('app.Description') }}</th>
                        <th>{{ __('mainproducts.Part No') }}</th>
                        <th>{{ __('mainproducts.Unit') }}</th>
                        <th>Purchase price</th>
                        <th>{{ __('mainproducts.Stock') }}</th>
                        <th>{{ __('mainproducts.WH') }}</th>
                        <th>{{ __('mainproducts.Store') }}</th>
                        <th>{{ __('mainproducts.Category') }}</th>
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
               <button type="button" class="btn btn-brand btn-elevate btn-icon-sm float-right ml-2" id="datatableadd_pur"><i class="la la-plus"></i>Add</button>
               <button type="button" class="btn btn-secondary btn-icon-sm float-right" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                     <line x1="18" y1="6" x2="6" y2="18"></line>
                     <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg> Cancel</button>


         </div>
      </div>

   </div>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>

<script src="{{url('/')}}/resources/js/qpurchase/invoicePaymentsCalculations.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/qpurchase/common/totalamountcalculation.js" type="text/javascript"></script>
<!-- <script src="{{url('/')}}/resources/js/inventory/purchaseproduct.js" type="text/javascript"></script> -->
<script src="{{url('/')}}/resources/js/qpurchase/purchaseinvoice.js" type="text/javascript"></script>

<script>
   $('.qpurchaseinvoice').addClass('kt-menu__item--active');
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
         url: "getproduct_name_details_qpurchase",
         method: "POST",
         data: {
            _token: $('#token').val(),
            id: product_name
         },
         dataType: "json",
         success: function(data) {
            $.each(data, function(key, value) {
               rowcount = $('#product_table tr').length;
               var product_name = value.product_name != null ? value.product_name : '';
               var des = value.description != null ? value.description : '-';
               var product_price = (value.product_price != null) ? value.product_price : 0;
               var product = '';
               product += '<tr>\
                 <td style="text-align: center;">' + rowcount + '</td><td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname" data-id="' + rowcount + '" value="' + product_name + '" readonly>\
                 <div>\
                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id" data-id="' + rowcount + '" value="' + value.product_id + '">\
                 </td>\
                 @if($branch_settings->inventory_stock_affect_at=="at-invoice")\
                 <td>\
                  <input type="hidden" name="new_product_id[]" value="">\
                  <input type="hidden" name="product_transaction_id[]" value="">\
                     <input type="hidden" name="save_as_old[]" value="">\
                     <input type="hidden" name="quantity_old[]" value="">\
                     <select class="form-control" name="save_as[]">\
                        <option value="existing">Existing</option>\
                        <option value="new">New Product</option>\
                     </select>\
                  </td>\
                  @endif \
                 <td><textarea class="form-control" id="product_description' + rowcount + '" name="product_description[]" rows="1" data-id=' + rowcount + ' style=" height: 30px !important;">' + des + '</textarea>\
                 </td>\
                 <td>\
                 <div>\
                 <select class="form-control form-control-sm single-select unit kt-selectpicker"  data-id="' + rowcount + '" name="unit[]" id="unit' + rowcount + '">\
                 <option value="">select</option>\
                  @foreach($unitlist as $data)\
                     <option value="{{$data->id}}">{{$data->unit_code}}</option>\
                  @endforeach\
                 </select>\
                  </div>\
                 <div class="input-group input-group-sm">\
                 <input type="hidden" class="form-control unitvalue" name="unitvalue[]" id="unitvalue' + rowcount + '"  data-id="' + rowcount + '">\
                 </div>\
                 <div class="input-group input-group-sm">\
                 <input type="hidden" class="form-control quantity_value" name="quantity_value[]" id="quantity_value' + rowcount + '"  data-id="' + rowcount + '" value="1">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                  <input type="text" class="form-control quantity integerVal"  data-id="' + rowcount + '" name="quantity[]" id="quantity' + rowcount + '" value="1">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control rate integerVal" name="rate[]" id="rate' + rowcount + '"  data-id="' + rowcount + '" value="' + product_price + '">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control amount" name="amount[]"  data-id="' + rowcount + '" id="amount' + rowcount + '" readonly value="' + product_price + '">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control discountamount integerVal"  data-id="' + rowcount + '" name="discountamount[]" id="discountamount' + rowcount + '" value="0">\
                 </div>\
                 </td>\
                 <td>\
                  <select class="form-control vat_percentage kt-selectpicker" data-id="' + rowcount + '" name="vat_percentage[]" id="vat_percentage' + rowcount + '">\
                     @foreach($taxgrouplist as $data)\
                     <option value="{{$data->total}}" {{($data->default_tax == 1)?"selected":""}}>{{$data->total}}</option>\
                     @endforeach\
                 </select>\
                </td>\
                <td>\
                 <input type="text" class="form-control vatamount form-control-sm" name="vatamount[]" id="vatamount' + rowcount + '" data-id=' + rowcount + ' value="0"    readonly>\
                 </td>\
                  <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control row_total"  data-id="' + rowcount + '" name="row_total[]" id="row_total' + rowcount + '" readonly>\
                 </div>\
                 </td>\
                 <td  style="background-color: white;">\
                      <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">\
                                          <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
                                          <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>\
                                       </div>\
                        </td>\
                 </tr>';

               $('#product_table').append(product);
               $('.vat_percentage').trigger("change");
            });

            rowcount++;
         }
      })
   }


   $('body').on('change keyup', '#discount_type, .quantity, .rate, .vatamount, .discountamount, .vat_percentage', function() {
      tableForwardCalculation();
      findSum();
   });



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
            //  console.log(data);
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
                  console.log(data);

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
      var rowcount = ($("#costhead_table tr").length);
      $(".addmorecosthead").click(function() {

         var sl = ($("#costhead_table tr").length);


         var costs = '';
         costs += '<tr>\
            <td class="row_count text-center pt-2" id="rowcount">' + sl + '</td>\
            <td>\
            <input type="text" class="form-control itemcost_details" name="itemcost_details[]" id="itemcost_details' + rowcount + '"  data-id=' + rowcount + '>\
            </td>\
            <td>\
            <input type="text" class="form-control costsupplier" name="costsupplier[]" id="costsupplier' + rowcount + '"  data-id=' + rowcount + '>\
            </td>\
            <td>\
            <input type="text" class="form-control costrate integerVal" name="costrate[]" id="costrate' + rowcount + '"  data-id=' + rowcount + ' value="0">\
            </td>\
             <td>\
            <select class="form-control  costtax_group" name="costtax_group[]" id="costtax_group' + rowcount + '" data-id=' + rowcount + '>\
               @foreach($taxgrouplist as $data)\
               <option data-total="{{$data->total}}" value="{{$data->id}}"{{($data->default_tax == 1)?"selected":""}}>{{$data->taxgroup_name}}</option>\
               @endforeach\
            </select>\
            <td>\
            <input type="text" class="form-control costtax_amount" name="costtax_amount[]" id="costtax_amount' + rowcount + '"  data-id=' + rowcount + ' readonly value="0">\
            </div>\
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
      var costtax_group = getNum($('#costtax_group' + id + '').val());
      var total_taxa = $('#costtax_group' + id + '').find(':selected').attr('data-total')
      if (isNaN(costtax_group)) {
         var vat_value = parseFloat(costrate);
      } else {
         if (isNaN(total_taxa)) {
            total_taxa = 0;
         }
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
</script>

<script type="text/javascript">
   window.addEventListener("load", function() {
      tableForwardCalculation();
      findSum();
   });

   var product_list_table_pur = $('#productdetails_list_pur').DataTable({
      processing: true,
      serverSide: true,
      bPaginate: false,
      dom: 'Blfrtip',
      columnDefs: [{
         "defaultContent": "-",
         "targets": "_all"
      }],
      order: [
         [1, 'desc']
      ],
      ajax: {
         "url": 'ProductsalesListing',
         "type": "POST",
         "data": function(data) {
            data._token = $('#token').val();
            data.wid = $('#setwarehouse').val();
         }
      },
      columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
         },
         {
            data: 'product_code',
            name: 'product_code'
         },
         {
            data: 'product_name',
            name: 'product_name',
            "render": function(data, type, row, meta) {
               if (data != null && data.length > 1) {
                  return type === 'display' && data.length > 40 ?
                     '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' :
                     data;
               } else
                  return data;
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
            data: 'part_no',
            name: 'part_no'
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
            data: 'available_stock',
            name: 'available_stock'
         },
         {
            data: 'warehouse_name',
            name: 'warehouse_name'
         },
         {
            data: 'store_name',
            name: 'store_name'
         },
         {
            data: 'category_name',
            name: 'category_name'
         },
      ],
      columnDefs: [{
         "orderable": false,
         "searchable": false,
         targets: [0]
      }, ]
   });
   $(document).ready(function() {
      $('#productdetails_list_pur tbody').on('click', 'tr', function() {
         $(this).toggleClass('selected');
         $('#selected_items').val(product_list_table_pur.rows('.selected').data().length);
         var versement_each = 0;
         selectArr = new Array();
         var ids = $.map(product_list_table_pur.rows('.selected').data(), function(item) {
            versement_each += parseFloat(item.unit_price) || 0;
            var idx = $.inArray(item.product_id, selectArr);
            if (idx == -1) {
               selectArr.push(item.product_id);
            } else {
               selectArr.splice(idx, item.product_id);
            }
         });
         $('#selected_amount').val(versement_each.toFixed(2));
      });



   });
   $("#datatableadd_pur").on("click", function() {
      $('#kt_modal_4_4').modal('hide');
      product_list_table_pur.rows('.selected').nodes().to$().removeClass('selected');
      $('#selected_amount').val('');
      $('#selected_items').val('');
      createproductvialoop(selectArr);
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
            product_list_table_pur.ajax.reload();
            $('#selected_items').val('');
            $('#selected_amount').val('');
            console.log('After Ajax Call');
            $("#whead").text(wname);
         },
         error: function() {}
      });

   });

   $(document).on('change', '.newcustomer', function() {

      var customer = $(this).val();

      if (customer == 1) {
         $('#customer1').val('').trigger('change');
         $('#customer1').attr('disabled', true);
         $('#cust_category').prop("disabled", false);
         $('#cust_type').prop("disabled", false);
         //$('#cust_group').prop("disabled", false);

         $('#cust_category').val('').trigger('change');
         $('#cust_type').val('').trigger('change');
         // $('#cust_group').val('').trigger('change');
         $('#cust_name').val('');
         $('#building_no').val('');
         $('#cust_region').val('');
         $('#cust_district').val('');
         $('#cust_city').val('');
         $('#cust_zip').val('');
         $('#mobile').val('');
         $('#vatno').val('');
         $('#buyerid_crno').val('');
         $("#cust_name").prop("readonly", false);
         $('#building_no').prop("readonly", false);
         $('#cust_region').prop("readonly", false);
         $('#cust_district').prop("readonly", false);
         $('#cust_city').prop("readonly", false);
         $('#cust_zip').prop("readonly", false);
         $('#mobile').prop("readonly", false);
         $('#vatno').prop("readonly", false);
         $('#buyerid_crno').prop("readonly", false);
      }
      if (customer == 2) {
         $('#customer1').attr('disabled', false);
         $('#cust_category').prop("disabled", true)
         $('#cust_type').prop("disabled", true);
         $('#cust_group').prop("disabled", true);
         $("#cust_type").select2({
            disabled: 'readonly'
         });
         $("#cust_group").select2({
            disabled: 'readonly'
         });
         $("#cust_name").prop("readonly", true);
         $('#building_no').prop("readonly", true);
         $('#cust_region').prop("readonly", true);
         $('#cust_district').prop("readonly", true);
         $('#cust_city').prop("readonly", true);
         $('#cust_zip').prop("readonly", true);
         $('#mobile').prop("readonly", true);
         $('#vatno').prop("readonly", true);
         $('#buyerid_crno').prop("readonly", true);

      }



   });

   $(document).on('change', '#customer1', function() {
      var name = $(this).val();
      $.ajax({
         url: "getsupplierdetails_qpurchase",
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
               $('#cust_category').val(value.sup_category).trigger('change').attr('disabled', true);
               $('#cust_type').val(value.sup_type).trigger('change').attr('disabled', true);;
               $('#cust_name').val(value.sup_name);
               $('#building_no').val(value.sup_add1);
               $('#cust_region').val(value.sup_region);
               $('#cust_district').val(value.sup_add2);
               $('#cust_city').val(value.sup_city);
               $('#cust_zip').val(value.sup_zip);
               $('#mobile').val(value.mobile1);
               $('#vatno').val(value.vatno);
               $('#buyerid_crno').val(value.buyerid_crno);
               $('#cust_country').val(value.sup_country).trigger('change').attr('disabled', true);

            });

         }
      });


   });

   $('body').on('change', '.useadvance', function() {
      var useadvance = $(this).val();
      $('#paid_from_adwance').attr('readonly', true);
      if (useadvance == "1") {
         supplier_id = $('#customer1').val();
         if (supplier_id == "") {
            toastr.warning('Please select Supplier')
            $('#debitbalance').val(0);
         } else {
            $('#paid_from_adwance').attr('readonly', false);
            $.ajax({
               url: "getdebitbalance",
               method: "POST",
               data: {
                  _token: $('#token').val(),
                  supplier_id: supplier_id,
               },
               dataType: "json",
               success: function(data) {
                  $.each(data, function(key, value) {
                     var cr_amount = value.cr_amount;
                     var dr_amount = value.dr_amount;
                     var total = parseFloat(dr_amount - cr_amount);
                     $('#debitbalance').val(total);
                  });
                  sl++;
               }
            })
         }
      } else {
         $('#debitbalance').val(0);
      }
   });



   $("body").on("click", ".remove", function(event) {
      event.preventDefault();
      var row = $(this).closest('tr');
      var siblings = row.siblings();
      row.remove();
      siblings.each(function(index) {
         $(this).children().first().text(index + 1);
      });
      tableForwardCalculation();
      findSum();
   });
</script>

@endsection