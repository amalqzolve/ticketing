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
$job_id = $pi->job_id;
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
               {{$pi->code}}/{{$pi->br_id}}
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
                              <label>Job</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <select class="form-control single-select kt-selectpicker" id="job_id">
                                 <option value="">Select</option>
                                 @foreach($jobs as $job)
                                 <option value="{{$job->id}}" {{($job->id==$job_id)?'selected':''}}>{{$job->jobname}}</option>
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
                        <!-- <div class="col-md-9 input-group-sm">

                           <select class="form-control single-select kt-selectpicker" id="terms" name="terms">
                              <option value="">select</option>
                              @foreach($termslist as $data)
                              <option value="{{$data->id}}" {{($terms == $data->id)?'selected':''}}>{{$data->term}}</option>
                              @endforeach
                           </select>
                        </div> -->
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group  row pr-md-3">
                        <!-- <div class="col-md-4">
                              <label>Terms and Conditions Preview</label>
                              </div>  -->
                        <div class="col-md-12 input-group-sm">
                           {!!$tpreview!!}
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

                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
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
<!--  -->

<script>
   $('.qpurchaseinvoice').addClass('kt-menu__item--active');
</script>

@endsection