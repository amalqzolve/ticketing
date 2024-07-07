@extends('qpurchase.common.layout')

@section('content')
<link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
foreach ($purchaseorder as $key => $value) {

   $id = $value->id;
   $rfq_id = $value->so_id;
   $customer_id = $value->id;
   $currency = $value->currency;
   $currencyvalue = $value->currencyvalue;
   $supname = $value->name;
   $attention = $value->attention;
   $salesman1 = $value->salesman;
   $quotedate = $value->quotedate;
   $valid_till = $value->valid_till;
   $totalamount = $value->totalamount;
   $discount = $value->discount;
   $amountafterdiscount = $value->amountafterdiscount;
   $totalvatamount = $value->vatamount;
   $grandtotalamount = $value->grandtotalamount;
   $terms = $value->terms;
   $notes = $value->notes;
   $internal_reference = $value->internal_reference;
   $preparedby = $value->preparedby;
   $approvedby = $value->approvedby;
   $tpreview = $value->tpreview;
   $qtnref = $value->qtnref;
   $po_wo_ref = $value->po_wo_ref;
   $ctype = $value->ctype;
}

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
               PO
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
                              <input type="text" class="form-control kt_datetimepickerr" name="rfqdate" id="rfqdate" value="{{ $quotedate2 }}">



                              <!-- </div> -->
                           </div>
                        </div>
                     </div>


                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>
                                 Valid Till</label>
                              <?php
                              $valid_till1 = strtotime($valid_till);
                              $valid_till2 = date('d-m-Y', $valid_till1);
                              ?>
                           </div>
                           <div class="col-md-8 input-group-sm">

                              <input type="text" class="form-control kt_datetimepickerr" name="valid_till" id="valid_till" value="{{ $valid_till2 }}">




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
                              <label>@lang('app.PO/WO Ref')</label>
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

                              <input type="text" class="form-control" name="attention" id="attention" value="{{ $attention }}">



                              <!-- </div> -->
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
                                 <option value="{{$data->id}}" <?php if ($salesman1 == $data->id) {
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

                     <!--  </div>
                        <div class="row" > -->



                     <!--  <div class="new1"></div> -->








                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Prepared By')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <select class="form-control kt-selectpicker" id="preparedby">
                                 <option value="">select</option>
                                 @foreach($salesmen as $data)
                                 <option value="{{$data->id}}" <?php if ($preparedby == $data->id) {
                                                                  echo 'selected';
                                                               } ?>>{{$data->name}}</option>
                                 @endforeach
                              </select>



                              <!-- </div> -->
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
                                 <option value="{{$data->id}}" <?php if ($approvedby == $data->id) {
                                                                  echo 'selected';
                                                               } ?>>{{$data->name}}</option>
                                 @endforeach
                              </select>


                              <!-- </div> -->
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


                              <!-- </div> -->
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
                           <label>@lang('app.Terms and Conditions')</label>
                        </div>
                        <div class="col-md-9 input-group-sm">

                           <select class="form-control single-select kt-selectpicker" id="terms" name="terms">
                              <option value="">select</option>
                              @foreach($termslist as $data)
                              <option value="{{$data->id}}" <?php if ($terms == $data->id) {
                                                               echo 'selected';
                                                            } ?>>{{$data->term}}</option>
                              @endforeach
                           </select>


                           <!-- </div> -->
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
                  <div class="row" style="padding-bottom: 6px;">

                     <input type="hidden" name="suppliernames" id="suppliernames" value="{{$supid}}">

                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>{{ __('customer.Category') }}</label>
                           </div>
                           <div class="col-md-8  input-group input-group-sm">

                              <input type="text" class="form-control single-select Cust_category" id="cust_category" name="cust_category" readonly value="{{$category}}">


                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group row  pr-md-3">
                           <div class="col-md-4">
                              <label>{{ __('customer.Type') }}</label>
                           </div>
                           <div class="col-md-8 input-group input-group-sm">

                              <input type="text" class="form-control single-select" id="cust_type" name="cust_type" readonly value="{{$type}}">



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
               <!-- -->

            </div>


            <div class="row p-0" style="background-color:#f2f3f8;">
               <div>
                  <hr style="height: 15px;
                     background-color: #f2f3f8;
                     width: 100%;
                     position: absolute;
                     left: 0;
                     border: 0;">


                  <br>
                  <br>
                  <div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
                     <table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%; ">
                        <thead class="thead-light">
                           <tr>
                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="30px">#</th>

                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="250px">@lang('app.Item Name')</th>
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
                              <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                           </tr>

                           </tr>
                        </thead>
                        <tbody>
                           @foreach($purchaseorder_product as $key=>$cinvoice_products)

                           <tr>
                              @foreach($productlist as $data)
                              @if($cinvoice_products->itemname == $data->product_id)
                              <td>{{$key+1}}</td>
                              <td><input class="form-control kt-selectpicker productname" id="productname{{$key+1}}" name="productname[]" data-id="{{$key+1}}" value="{{$data->product_name}}" readonly>
                                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id" data-id="{{$key+1}}" value="{{$data->product_id}}">

                                 <input type="hidden" name="orquantity[]" id="orquantity{{$key+1}}" data-id="{{$key+1}}" value="{{$data->available_stock}}">
                                 @endif
                                 @endforeach
                              </td>
                              <td><textarea class="form-control" rows="1" name="product_description[]" id="product_description{{$key+1}}" data-id="{{$key+1}}">{{$cinvoice_products->description}}</textarea></td>
                              <td><select class="form-control kt-selectpicker" id="unit{{$key+1}}" name="unit[]" data-id="{{$key+1}}">
                                    <option value="">select</option>
                                    @foreach($unitlist as $data)
                                    @if($cinvoice_products->unit == $data->id)
                                    <option value="{{$data->id}}" selected="">{{$data->unit_code}}</option>
                                    @endif @endforeach
                                 </select></td>
                              <td><input type="text" class="form-control quantity integerVal" name="quantity[]" id="quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->quantity}}"></td>
                              <td><input type="text" class="form-control rate integerVal" name="rate[]" id="rate{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->rate}}"></td>
                              <td><input type="text" class="form-control amount" name="amount[]" id="amount{{$key+1}}" data-id="{{$key+1}}" readonly value="{{$cinvoice_products->amount}}"></td>
                              <td><input type="text" class="form-control discountamount integerVal" name="discountamount[]" id="discountamount{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->rdiscount}}"></td>

                              <td>
                                 <select class="form-control form-control-sm single-select vat_percentage kt-selectpicker" data-id="{{$key+1}}" name="vat_percentage[]" id="vat_percentage{{$key+1}}">
                                    <option value="0">Select</option>
                                    @foreach($vatlist as $data)
                                    <option value="{{$data->total}}" <?php if ($cinvoice_products->vat_percentage == $data->total) {
                                                                        echo 'selected';
                                                                     } ?>>{{$data->total}}</option>
                                    @endforeach
                                 </select>
                              </td>



                              <td><input type="text" class="form-control vatamount" name="vatamount[]" id="vatamount{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->vatamount}}"></td>
                              <td><input type="text" class="form-control row_total" name="row_total[]" id="row_total{{$key+1}}" data-id="{{$key+1}}" readonly value="{{$cinvoice_products->totalamount}}"></td>
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
                              <a href="{{url('/')}}/Add-Product" target="_blank" class="btn btn-light btn-elevate btn-icon-sm float-right mr-2"><!--  <i class="la la-plus"></i> -->
                                 New Product
                              </a>



                           </td>

                        </tr>
                     </table>



                  </div>
                  <hr style="height: 15px;
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
                        <label>@lang('app.Total Amount Before Tax')</label>
                     </div>
                     <div class="col-md-8 input-group-sm">

                        <input type="text" class="form-control" name="totalamount" id="totalamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$totalamount}}">


                        <!-- </div> -->
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

                        <input type="text" class="form-control" name="amountafterdiscount" id="amountafterdiscount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$amountafterdiscount}}">


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

                        <input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$totalvatamount}}">

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

                        <input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly value="{{$grandtotalamount}}" style="
                                        background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem;
    font-weight: bold; color: #646c9a; padding-top: 0px;">


                        <!-- </div> -->
                     </div>
                  </div>
               </div>

            </div>





            <input type="hidden" name="rfq_id" id="rfq_id" value="{{$rfq_id}}">
            <input type="hidden" name="branch" id="branch" value="{{$branch}}">
            <input type="hidden" name="enquiryrfqid" id="enquiryrfqid" value="">
            <input type="hidden" name="enquiryid" id="enquiryid" value="">
            <input type="hidden" name="id" id="id" value="{{$id}}">

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
                        <button type="button" class="btn btn-primary" id="enquiry_po_update_issue"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
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

<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog modal-xl">

      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">

            <h4 class="modal-title">Add New Product</h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>@lang('app.Item Name')<span style="color: red">*</span></label>
                     </div>
                     <div class="col-md-8 input-group-sm">

                        <input type="text" name="itemname" id="itemname" class="form-control">


                        <!-- </div> -->
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>@lang('app.Description')<span style="color: red">*</span></label>
                     </div>
                     <div class="col-md-8 input-group-sm">

                        <textarea class="form-control" id="description" name="description"></textarea>


                        <!-- </div> -->
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>@lang('app.Unit')<span style="color: red">*</span></label>
                     </div>
                     <div class="col-md-8 input-group-sm">

                        <select class="form-control" name="productunit" id="productunit">
                           <option value="">Select</option>

                           @foreach($unitlist as $data)
                           <option value="{{$data->id}}">{{$data->unit_code}}</option>
                           @endforeach

                        </select>


                        <!-- </div> -->
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>@lang('app.Price')<span style="color: red">*</span></label>
                     </div>
                     <div class="col-md-8 input-group-sm">

                        <input type="text" name="price" id="price" class="form-control">


                        <!-- </div> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" id="productname_submit">Submit</button>

            <button type="button" class="btn btn-default closeBtn" data-dismiss="modal">Cancel</button>
         </div>
      </div>

   </div>
</div>


<div class="modal fade" id="serviceModal" role="dialog">
   <div class="modal-dialog modal-xl">

      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Add New Service</h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>@lang('app.Service Name')<span style="color: red">*</span></label>
                     </div>
                     <div class="col-md-8 input-group-sm">

                        <input type="text" name="servicename" id="servicename" class="form-control">


                        <!-- </div> -->
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>@lang('app.Description')<span style="color: red">*</span></label>
                     </div>
                     <div class="col-md-8 input-group-sm">

                        <textarea class="form-control" id="servicedescription" name="servicedescription"></textarea>


                        <!-- </div> -->
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>@lang('app.Unit')<span style="color: red">*</span></label>
                     </div>
                     <div class="col-md-8 input-group-sm">

                        <select class="form-control" name="serviceunit" id="serviceunit">
                           <option value="">Select</option>

                           @foreach($unitlist as $data)
                           <option value="{{$data->id}}">{{$data->unit_code}}</option>
                           @endforeach

                        </select>


                        <!-- </div> -->
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>@lang('app.Price')<span style="color: red">*</span></label>
                     </div>
                     <div class="col-md-8 input-group-sm">

                        <input type="text" name="serviceprice" id="serviceprice" class="form-control">


                        <!-- </div> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" id="servicename_submit">Submit</button>

            <button type="button" class="btn btn-default closeBtn" data-dismiss="modal">Cancel</button>
         </div>
      </div>

   </div>
</div>

<div class="modal fade" id="kt_modal_4_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="min-width: 1024px;">

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
                     <div class="col-3">

                     </div>
                  </div>
               </div>
               <table class="table table-striped table-hover table-checkable dataTable no-footer" id="productdetails_list">
                  <thead>
                     <tr>
                        <th>{{ __('mainproducts.S.No') }}</th>
                        <th>{{ __('mainproducts.Product Name') }}</th>
                        <th>{{ __('app.Description') }}</th>
                        <th>{{ __('mainproducts.Part No') }}</th>
                        <th>{{ __('mainproducts.Product Code') }}</th>
                        <!-- <th>{{ __('mainproducts.Barcode') }}</th> -->
                        <th>{{ __('mainproducts.Unit') }}</th>
                        <!-- <th>Product price</th> -->
                        <th>Purchase Price</th>
                        <th>{{ __('mainproducts.Stock') }}</th>
                        <th>{{ __('mainproducts.WH') }}</th>
                        <th>{{ __('mainproducts.Store') }}</th>
                        <!--  <th>Rack</th> -->
                        <th>{{ __('mainproducts.Category') }}</th>

                        <!-- <th>Status</th> -->
                        <!--  <th>ID</th> -->
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
         url: "getproduct_name_details_qpurchase",
         method: "POST",
         data: {
            _token: $('#token').val(),
            id: product_name
         },
         dataType: "json",
         success: function(data) {
            $.each(data, function(key, value) {
               var product_name = (value.product_name != null) ? value.product_name : 0;
               var des = value.description != null ? value.description : '-';
               var selling_price = (value.selling_price != null) ? value.selling_price : 0;
               rowcount = $('#product_table tr').length;
               var product = '';
               product += '<tr>\
                 <td>' + rowcount + '</td><td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname" data-id="' + rowcount + '" value="' + product_name + '" readonly>\
                 <div>\
                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id" data-id="' + rowcount + '" value="' + value.product_id + '">\
                 </td>\
                 <td><textarea class="form-control" id="product_description' + rowcount + '" name="product_description[]" rows="1" data-id=' + rowcount + ' style=" height: 30px !important;">' + des + '</textarea>\</td>\
                 <td>\
                 <div>\
                 <select class="form-control single-select unit kt-selectpicker"  data-id="' + rowcount + '" name="unit[]" id="unit' + rowcount + '">\
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
                 <input type="text" class="form-control rate integerVal" name="rate[]" id="rate' + rowcount + '"  data-id="' + rowcount + '" value="' + selling_price + '">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control amount" name="amount[]"  data-id="' + rowcount + '" id="amount' + rowcount + '" readonly value="' + selling_price + '">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control discountamount integerVal"  data-id="' + rowcount + '" name="discountamount[]" id="discountamount' + rowcount + '" value="0">\
                 </div>\
                 </td>\
                <td>\
                 <select class="form-control form-control-sm single-select vat_percentage kt-selectpicker" data-id="' + rowcount + '" name="vat_percentage[]" id="vat_percentage' + rowcount + '">\
                  @foreach($vatlist as $data)\
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
               $("#unit" + rowcount).val(value.unit).change();
               $("#unitvalue" + rowcount).val(value.unit);
            });

            rowcount++;
         }
      })
   }



   $('body').on('change', '.quantity', function() {
      var id = $(this).attr('data-id');
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
      totaldiscamount = getNum(totaldiscamount);
      $('#discount').val(totaldiscamount);
      //

      /*var amountafterdiscount = 0;
      var grandtotalamount = 0;
            var discount = $('#discount').val();
            var totalamount = $('#totalamount').val();
            var totalvatamount = $('#totalvatamount').val();

            var discountamount = (parseFloat(totalamount) - parseFloat(discount)) ;
            amountafterdiscount = parseFloat(totalamount) - parseFloat(discountamount);
            grandtotalamount = parseFloat(amountafterdiscount) + parseFloat(totalvatamount);
         
         $('#amountafterdiscount').val(amountafterdiscount);
         $('#grandtotalamount').val(grandtotalamount);*/
      //
   }


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

      //$new_width = ($percentage / 100) * $totalWidth;
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
      /* $('#amountafterdiscount').val("");
         $('#discount').val("");
         $('#grandtotalamount').val("");*/

   }

   $('body').on('change', '.discount', function() {

      final_calculate1();


   });

   function final_calculate1() {

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


      var amountafterdiscount = 0;
      var grandtotalamount = 0;
      var discount = $('#discount').val();
      var totalamount = $('#totalamount').val();
      var totalvatamount = $('#totalvatamount').val();

      var discountamount = $('#discount').val();
      //var discountamount = (parseFloat(totalamount) - parseFloat(discount)) ;
      amountafterdiscount = parseFloat(totalamount) - parseFloat(discountamount);
      grandtotalamount = parseFloat(amountafterdiscount) + parseFloat(totalvatamount);
      //alert('total - '+totalamount);    alert('discountamount - '+ discountamount); alert('amountafterdiscount - '+amountafterdiscount); alert('totalvatamount - '+totalvatamount);
      amountafterdiscount = getNum(amountafterdiscount);
      grandtotalamount = getNum(grandtotalamount);
      $('#amountafterdiscount').val(amountafterdiscount.toFixed(2));
      $('#grandtotalamount').val(grandtotalamount.toFixed(2));
   }


   //$("#currency").select2({disabled:'readonly'});
   $(".vatamount").prop("readonly", true);
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
</script>
<!-- <script src="{{url('/')}}/resources/js/sales/purchase.js" type="text/javascript"></script> -->
<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/qpurchase/purchaseorder.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<!-- <script src="{{url('/')}}/resources/js/inventory/purchaseproduct.js" type="text/javascript"></script> -->
<script type="text/javascript">
   var product_list_table = $('#productdetails_list').DataTable({
      processing: true,
      serverSide: false,
      bPaginate: false,
      dom: 'Blfrtip',
      columnDefs: [{
         "defaultContent": "-",
         "targets": "_all"
      }],
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
            data: 'product_code',
            name: 'product_code'
         },
         {
            data: 'unit',
            name: 'unit'
         },
         {
            data: 'selling_price',
            name: 'selling_price'
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



   $("#datatableadd").on("click", function() {
      $('#kt_modal_4_4').modal('hide');
      product_list_table.rows('.selected').nodes().to$().removeClass('selected');
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
            product_list_table.ajax.reload();
            $('#selected_items').val('');
            $('#selected_amount').val('');
            console.log('After Ajax Call');
            $("#whead").text(wname);
         },
         error: function() {}
      });

   });
</script>
@endsection