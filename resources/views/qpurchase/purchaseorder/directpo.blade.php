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

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
   <br />
   <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
         <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
               <i class="kt-font-brand flaticon-home-2"></i>
            </span>
            <h3 class="kt-portlet__head-title">
               New PO
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
                  <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_2">@lang('app.Other Information')</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3">Terms and Conditions</a>
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
                              <input type="text" class="form-control kt_datetimepickerr" name="quotedate" id="quotedate" value="{{date('d-m-Y')}}">
                           </div>
                        </div>
                     </div>


                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>
                                 Valid Till</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control kt_datetimepickerr" name="valid_till" id="valid_till" value="{{date('d-m-Y')}}">
                           </div>
                        </div>
                     </div>






                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.QTN Ref')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">

                              <input type="text" class="form-control" name="qtnref" id="qtnref">
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>VO/Change Order</label>
                           </div>
                           <div class="col-md-8 input-group-sm">

                              <input type="text" class="form-control" name="po_wo_ref" id="po_wo_ref">
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Attention')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">

                              <input type="text" class="form-control" name="attention" id="attention">



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
                                 <option value="{{$data->id}}">{{$data->name}}</option>
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
                                 <option value="{{$data->id}}" {{($data->currency_default == 1)?"selected":''}}>{{$data->currency_name}}</option>
                                 <?php $currency_default = ($data->currency_default == 1) ? $data->value : ''; ?>
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
                              <input type="text" class="form-control currency_value" name="currency_value" id="currency_value" value="{{isset($currency_default)?$currency_default:''}}" readonly>
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
                                 <option value="{{$data->id}}">{{$data->name}}</option>
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
                                 <option value="{{$data->id}}">{{$data->name}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Discount Type<span style="color: red">*</span> </label>
                           </div>
                           <div class="col-md-8  input-group-sm">
                              <select class="form-control kt-selectpicker" id="discount_type">
                                 <option value="1" selected>Flat</option>
                                 <option value="2">Percentage</option>
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
                              <textarea class="form-control" name="internalreference" id="internalreference"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Printable notes</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <textarea class="form-control" name="notes" id="notes"></textarea>
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
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Source</label>
                           </div>
                           <div class="col-md-8  input-group input-group-sm">
                              <select class="form-control kt-selectpicker supplier_source" id="supplier_source">
                                 <option value="1">New Supplier</option>
                                 <option value="2">Database</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier</label>
                           </div>
                           <div class="col-md-8  input-group input-group-sm">
                              <select class="form-control single-select kt-selectpicker supplier" id="supplier" name="supplier" disabled>
                                 <option value="">select</option>
                                 @foreach($suppliers as $data)
                                 <option value="{{$data->id}}">{{$data->sup_name}} [{{$data->sup_code}}]</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Category</label>
                           </div>
                           <div class="col-md-8  input-group input-group-sm">
                              <select class="form-control single-select kt-selectpicker sup_category" id="sup_category" name="sup_category">
                                 <option value="">Select</option>
                                 @foreach($suppliercatogry as $item)
                                 <option value="{{$item->id}}">{{$item->title}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group row  pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Group</label>
                           </div>
                           <div class="col-md-8 input-group input-group-sm">
                              <select class="form-control single-select kt-selectpicker" id="sup_group" name="sup_group">
                                 <option value="">Select</option>
                                 @foreach ($supplierGroup as $key)
                                 <option value="{{$key->id}}">{{$key->title}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group row  pr-md-3">
                           <div class="col-md-4">
                              <label>Supplier Type</label>
                           </div>
                           <div class="col-md-8 input-group input-group-sm">
                              <select class="form-control single-select kt-selectpicker" id="sup_type" name="sup_type">
                                 <option value="">Select</option>
                                 @foreach ($supplierType as $key)
                                 <option value="{{$key->id}}">{{$key->title}}</option>
                                 @endforeach
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
                                 <input type="text" class="form-control" id="sup_name" name="sup_name" autocomplete="off" placeholder="Supplier Name">
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
                                 <input type="text" class="form-control" id="building_no" name="building_no" autocomplete="off" placeholder="Supplier Building No">
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
                                 <input type="text" class="form-control" id="sup_region" name="sup_region" autocomplete="off" placeholder="Supplier Street Name">
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
                                 <input type="text" class="form-control" id="sup_district" name="sup_district" autocomplete="off" placeholder="Supplier District">
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
                                 <input type="text" class="form-control" id="sup_city" name="sup_city" autocomplete="off" placeholder="Supplier City">
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
                                 <select name="sup_country" id="sup_country" class="form-control single-select kt-selectpicker">
                                    <option value="">Select</option>
                                    @foreach($country as $coun)
                                    <option value="{{$coun->id}}">{{$coun->cntry_name}}</option>
                                    @endforeach
                                 </select>
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
                                 <input type="text" class="form-control" id="sup_zip" name="sup_zip" autocomplete="off" placeholder="Supplier Postal Code">
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
                                 <input type="text" class="form-control" placeholder="Supplier Mobile Number" id="mobile" name="mobile" autocomplete="off">
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
                                 <input type="text" class="form-control" placeholder="Supplier Vat No" id="vatno" name="vatno" autocomplete="off">
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
                                 <input type="text" class="form-control" placeholder="Buyer ID / CR No" id="buyerid_crno" name="buyerid_crno" autocomplete="off">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>


            <div class="row p-0" style="background-color:#f2f3f8;">
               <div class="col-12">
                  <hr style="height: 15px;background-color: #f2f3f8;width: 100%;position: absolute;left: 0;border: 0;">
                  <br>
                  <br>
                  <div class="col-12 pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
                     <div class="col-12 p-0 table-responsive mb-2">
                        <table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%">
                           <thead class="thead-light">
                              <tr>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="30px">#</th>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">@lang('app.Item Name')</th>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="150px">@lang('app.Description')</th>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="70px">@lang('app.Unit')</th>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px">@lang('app.Quantity')</th>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="90px">@lang('app.Rate')</th>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="100px">@lang('app.Amount')</th>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px">@lang('app.Discount')</th>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="60px;">@lang('app.Vat (%)')</th>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="100px">@lang('app.VAT Amount')</th>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="100px">@lang('app.Total Amount')</th>
                                 <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                     <table style="width:100%">
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
                        <input type="text" class="form-control" name="totalamount" id="totalamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
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
                        <input type="text" class="form-control discount" name="discount" id="discount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
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
                        <input type="text" class="form-control" name="amountafterdiscount" id="amountafterdiscount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
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
                        <input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
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
                        <input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
                     </div>
                  </div>
               </div>
            </div>





            <input type="hidden" name="branch" id="branch" value="{{$branch}}">
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
                        <button type="button" class="btn btn-primary" id="dpo_submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
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
                              <option value="{{$data->id}}" {{($data->id == $default_warehouse)?"selected":''}} data-wid="{{$data->id}}" data-wname="{{$data->warehouse_name}}" wid="{{$data->id}}" wname="{{$data->warehouse_name}}">{{$data->warehouse_name}}</option>
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
                        <th>{{ __('mainproducts.Product Code') }}</th>
                        <th>{{ __('mainproducts.Product Name') }}</th>
                        <th>{{ __('app.Description') }}</th>
                        <th>{{ __('mainproducts.Part No') }}</th>
                        <th>{{ __('mainproducts.Unit') }}</th>
                        <th>Purchase Price</th>
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
               <button type="button" class="btn btn-brand btn-elevate btn-icon-sm float-right ml-2" id="datatableadd"><i class="la la-plus"></i>Add</button>
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
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/qpurchase/common/totalamountcalculation.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/qpurchase/purchaseorder.js" type="text/javascript"></script>
<script>
   $('.qpurchase_order').addClass('kt-menu__item--active');
   $('.kt-selectpicker').select2();
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
               var des = (value.description != null) ? value.description : '';
               var product_price = (value.product_price != null) ? value.product_price : 0;
               var product = '';
               product += '<tr>\
                 <td style="text-align: center;">' + rowcount + '</td><td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname" data-id="' + rowcount + '" value="' + product_name + '" readonly>\
                 <div>\
                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id" data-id="' + rowcount + '" value="' + value.product_id + '">\
                 </td>\
                 <td><textarea class="form-control" id="product_description' + rowcount + '" name="product_description[]" rows="1" data-id=' + rowcount + ' style=" height: 30px !important;">' + des + '</textarea>\</td>\
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
            });

            rowcount++;
         }
      })
   }

   $('body').on('change keyup', '#discount_type, .quantity, .rate, .vatamount, .discountamount, .vat_percentage', function() {
      tableForwardCalculation();
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
      $(document).on('change', '.supplier_source', function() {
         var supplier_source = $(this).val();
         if (supplier_source == 1) { //new supplier

            $('#supplier').val('');
            $('#sup_category').val('');
            $('#sup_group').val('');
            $('#sup_type').val('');
            $('#sup_name').val('');
            $('#building_no').val('');
            $('#sup_region').val('');
            $('#sup_district').val('');
            $('#sup_city').val('');
            $('#sup_country').val('');
            $('#sup_zip').val('');
            $('#mobile').val('');
            $('#vatno').val('');
            $('#buyerid_crno').val('');

            $('#supplier').attr('disabled', true);
            $('#sup_category').attr('disabled', false);
            $('#sup_group').attr('disabled', false);
            $('#sup_type').attr('disabled', false);
            $('#sup_name').prop("readonly", false);
            $('#building_no').prop("readonly", false);
            $('#sup_region').prop("readonly", false);
            $('#sup_district').prop("readonly", false);
            $('#sup_city').prop("readonly", false);
            $('#sup_country').prop("disabled", false);
            $('#sup_zip').prop("readonly", false);
            $('#mobile').prop("readonly", false);
            $('#vatno').prop("readonly", false);
            $('#buyerid_crno').prop("readonly", false);

            $('.kt-selectpicker').select2();
         }
         if (supplier_source == 2) { //supplier from DB
            $('#supplier').val('');
            $('#sup_category').val('');
            $('#sup_group').val('');
            $('#sup_type').val('');
            $('#sup_name').val('');
            $('#building_no').val('');
            $('#sup_region').val('');
            $('#sup_district').val('');
            $('#sup_city').val('');
            $('#sup_country').val('');
            $('#sup_zip').val('');
            $('#mobile').val('');
            $('#vatno').val('');
            $('#buyerid_crno').val('');

            $('#supplier').attr('disabled', false);
            $('#sup_category').attr('disabled', true);
            $('#sup_group').attr('disabled', true);
            $('#sup_type').attr('disabled', true);
            $('#sup_name').prop("readonly", true);
            $('#building_no').prop("readonly", true);
            $('#sup_region').prop("readonly", true);
            $('#sup_district').prop("readonly", true);
            $('#sup_city').prop("readonly", true);
            $('#sup_country').prop("disabled", true);
            $('#sup_zip').prop("readonly", true);
            $('#mobile').prop("readonly", true);
            $('#vatno').prop("readonly", true);
            $('#buyerid_crno').prop("readonly", true);

            $('.kt-selectpicker').select2();
         }
      });
   });
</script>

<script type="text/javascript">
   $(document).ready(function() {
      $(document).on('change', '#supplier', function() {
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
               $.each(data, function(key, value) {
                  $('#sup_category').val(value.sup_category); //.trigger('change').attr('disabled', true);
                  $('#sup_group').val(value.sup_group);
                  $('#sup_type').val(value.sup_type); //.trigger('change').attr('disabled', true);;
                  $('#sup_name').val(value.sup_name);
                  $('#building_no').val(value.sup_add1);
                  $('#sup_region').val(value.sup_region);
                  $('#sup_district').val(value.sup_add2);
                  $('#sup_city').val(value.sup_city);
                  $('#sup_country').val(value.sup_country); //.trigger('change').attr('disabled', true);
                  $('#sup_zip').val(value.sup_zip);
                  $('#mobile').val(value.mobile1);
                  $('#vatno').val(value.vatno);
                  $('#buyerid_crno').val(value.buyerid_crno);
                  $('.kt-selectpicker').select2();
               });
            }
         });
      });
   });
   var product_list_table = $('#productdetails_list').DataTable({
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

   $("body").on("click", ".remove", function(event) {
      event.preventDefault();
      var row = $(this).closest('tr');
      var siblings = row.siblings();
      row.remove();
      siblings.each(function(index) {
         $(this).children().first().text(index + 1);
      });
      tableForwardCalculation();
   });
</script>
@endsection