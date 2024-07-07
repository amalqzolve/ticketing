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
foreach ($supplierDetails as $names) {
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
               {{$grn->code}}/{{$grn->br_id}}
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
            <input type="hidden" name="id" id="id" value="{{$grn->id}}">
            <input type="hidden" name="po_id" id="po_id" value="{{$grn->po_id}}">
            <input type="hidden" name="inv_id" id="inv_id" value="{{$grn->inv_id}}">
            <input type="hidden" name="source" id="source" value="{{$grn->source}}">
            <ul class="nav nav-tabs nav-fill" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_4">Grn Details</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_5">Supplier Details</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_2">Other Information</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3">Terms and Conditions</a>
               </li>
            </ul>
            <div class="tab-content">

               <div class="tab-pane p-3 active" id="kt_tabs_2_4" role="tabpanel">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>GRN Date</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control kt_datetimepickerr" name="grn_date" id="grn_date" value="{{date('d-m-Y',strtotime($grn->grn_date))}}">
                           </div>
                        </div>
                     </div>



                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Attention</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="attention" id="attention" value="{{$grn->attention}}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Vehicle Details</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="vehicle" id="vehicle" value="{{$grn->vehicle}}" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Driver Details</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="driver" id="driver" value="{{$grn->driver}}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3" data-select2-id="11">
                           <div class="col-md-4">
                              <label>Prepared By </label>
                           </div>
                           <div class="col-md-8 input-group-sm" data-select2-id="10">
                              <select class="form-control kt-selectpicker" id="preparedby" name="preparedby">
                                 <option value="">select</option>
                                 @foreach($salesmen as $data)
                                 <option value="{{$data->id}}" {{ ($grn->preparedby==$data->id)?'selected':'' }}>{{$data->name}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Note</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" name="deliverynote" id="deliverynote" value="{{$grn->deliverynote}}" readonly>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="tab-pane p-3" id="kt_tabs_2_2" role="tabpanel">
                  <div class="row">
                     @if($grn->source=='By PO')
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>PO ID</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control " value="{{ $otherInformation->id }}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>PO Date</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control " value="{{ date('d-m-Y', strtotime($otherInformation->quotedate)) }}" readonly>
                           </div>
                        </div>
                     </div>


                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Valid Till</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control " value="{{ date('d-m-Y', strtotime($otherInformation->valid_till)) }}" readonly>
                           </div>
                        </div>
                     </div>


                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.QTN Ref')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" value="{{$otherInformation->qtnref}}" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.PO/WO Ref')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" value="{{$otherInformation->po_wo_ref}}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Attention')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" value="{{ $otherInformation->attention }}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>SO @lang('app.Prepared By')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <select class="form-control kt-selectpicker" disabled>
                                 <option value="">select</option>
                                 @foreach($salesmen as $data)
                                 <option value="{{$data->id}}" {{($otherInformation->preparedby == $data->id)?'selected':''}}>{{$data->name}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     @endif
                     @if($grn->source=='By Invoice')
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Invoice ID</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control " value="{{ $otherInformation->id }}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Invoice Entry Date</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control " value="{{ ($otherInformation->bill_entry_date!='')?date('d-m-Y', strtotime($otherInformation->bill_entry_date)):'' }}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.QTN Ref')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" value="{{$otherInformation->qtnref}}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>VO/Change Orders</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control " value="{{ $otherInformation->po_wo_ref }}" readonly>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>@lang('app.Attention')</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" value="{{ $otherInformation->attention }}" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Purchase Bill ID</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <input type="text" class="form-control" value="{{ $otherInformation->purchasebillid }}" readonly>
                           </div>
                        </div>
                     </div>



                     <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                           <div class="col-md-4">
                              <label>Purchaser</label>
                           </div>
                           <div class="col-md-8 input-group-sm">
                              <select class="form-control kt-selectpicker" disabled>
                                 <option value="">select</option>
                                 @foreach($salesmen as $data)
                                 <option value="{{$data->id}}" {{($otherInformation->purchaser == $data->id)?'selected':""}}>{{$data->name}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     @endif

                  </div>
               </div>
               <div class="tab-pane p-3" id="kt_tabs_2_3" role="tabpanel">
                  <div class="col-lg-12">
                     <div class="form-group  row pr-md-3">
                        <div class="col-md-12 input-group-sm">
                           {!! $grn->tpreview !!}
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane p-3" id="kt_tabs_2_5" role="tabpanel">
                  <div class="row" style="padding-bottom: 6px;">
                     <input type="hidden" name="supplier_id" id="supplier_id" value="{{$supid}}">
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
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="30px">#</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="150px">@lang('app.Item Name')</th>
                              @if($branch_settings->inventory_stock_affect_at=='at-delivey-or-grn')
                              <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap; padding: 2px 7px !important;" width="50px">Save</th>
                              @endif
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="150px">@lang('app.Description')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="50px">@lang('app.Unit')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="80px">Total Qty</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="80px">Received Qty</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="80px">@lang('app.Quantity')</th>
                              <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="80px">Balance Qty</th>
                              <!-- <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="30px">@lang('app.Action')</th> -->
                           </tr>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $totalSoQty = 0;
                           $totalReceivedQuantity = 0;
                           $totalQty = 0;
                           ?>
                           @foreach($products as $key=>$cinvoice_products)
                           <tr>
                              <td>{{$key+1}}</td>
                              <td>
                                 <input class="form-control kt-selectpicker productname" id="productname{{$key+1}}" name="productname[]" data-id="{{$key+1}}" value="{{$cinvoice_products->productname}}" readonly>
                                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id" data-id="{{$key+1}}" value="{{$cinvoice_products->item_details_id}}">
                                 <input type="hidden" class="form-control single-select purchase_order_products_id" name="purchase_order_products_id[]" id="purchase_order_products_id" data-id="{{$key+1}}" value="{{isset($cinvoice_products->purchase_order_products_id)?$cinvoice_products->purchase_order_products_id:''}}">
                                 <input type="hidden" class="form-control single-select purchase_invoice_products_id" name="purchase_invoice_products_id[]" id="purchase_invoice_products_id" data-id="{{$key+1}}" value="{{isset($cinvoice_products->purchase_invoice_products_id)?$cinvoice_products->purchase_invoice_products_id:''}}">
                              </td>
                              @if($branch_settings->inventory_stock_affect_at=='at-delivey-or-grn')
                              <td>
                                 <input type="hidden" name="quantity_old[]" value="{{$cinvoice_products->quantity}}">
                                 <input type="hidden" name="save_as_old[]" value="{{$cinvoice_products->save_as}}">
                                 <input type="hidden" name="new_product_id[]" value="{{$cinvoice_products->new_product_id}}">
                                 <input type="hidden" name="product_transaction_id[]" value="{{$cinvoice_products->product_transaction_id}}">
                                 <select class="form-control" name="save_as[]">
                                    <option value="existing" {{($cinvoice_products->save_as=='existing')?'selected':''}}>Existing</option>
                                    <option value="new" {{($cinvoice_products->save_as=='new')?'selected':''}}>New Product</option>
                                 </select>
                                 <input type="hidden" name="product_price[]" value="{{$cinvoice_products->totalamount/$cinvoice_products->total_qty}}">
                              </td>
                              @endif
                              <td><textarea class="form-control" rows="1" name="product_description[]" id="product_description{{$key+1}}" data-id="{{$key+1}}" readonly>{{$cinvoice_products->product_description}}</textarea></td>
                              <td><select class="form-control kt-selectpicker" id="unit{{$key+1}}" name="unit[]" data-id="{{$key+1}}" disabled>
                                    <option value="">select</option>
                                    @foreach($unitlist as $data)
                                    @if($cinvoice_products->unit == $data->id)
                                    <option value="{{$data->id}}" selected="">{{$data->unit_code}}</option>
                                    @endif
                                    @endforeach
                                 </select></td>
                              <td><input type="text" class="form-control total_quantity" name="total_quantity[]" id="total_quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->total_qty}}" readonly></td>
                              <td><input type="text" class="form-control recquantity" name="recquantity[]" id="recquantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->total_qty - ($cinvoice_products->grn_remaining_quantity+ $cinvoice_products->quantity)}}" readonly></td>
                              <td><input type="text" class="form-control integerVal quantity" name="quantity[]" id="quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->quantity}}" readonly></td>
                              <td><input type="text" class="form-control balance_quantity" name="balance_quantity[]" id="balance_quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->grn_remaining_quantity}}" readonly></td>
                              <!-- <td>
                                 <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span> </div>
                              </td> -->
                           </tr>
                           <?php
                           $totalSoQty += $cinvoice_products->total_qty;
                           $totalReceivedQuantity += $cinvoice_products->total_qty - ($cinvoice_products->grn_remaining_quantity + $cinvoice_products->quantity);
                           $totalQty += $cinvoice_products->quantity
                           ?>
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
                        <label>Total So Quantity</label>
                     </div>
                     <div class="col-md-8 input-group-sm">
                        <input type="text" class="form-control" name="grandtotal_so_quantity" id="grandtotal_so_quantity" value="{{$totalSoQty}}" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
               </div>
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>Total Received Quantity</label>
                     </div>
                     <div class="col-md-8 input-group-sm">
                        <input type="text" class="form-control" name="grandtotal_received_quantity" id="grandtotal_received_quantity" value="{{$totalReceivedQuantity}}" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
               </div>
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>Total Quantity</label>
                     </div>
                     <div class="col-md-8 input-group-sm">
                        <input type="text" class="form-control" name="grandtotal_quantity" id="grandtotal_quantity" value="{{$totalQty}}" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
               </div>
               <div class="col-lg-6">
                  <div class="form-group  row pr-md-3">
                     <div class="col-md-4">
                        <label>Total Balance Quantity</label>
                     </div>
                     <div class="col-md-8 input-group-sm">
                        <input type="text" class="form-control" name="grandtotal_balance_quantity" id="grandtotal_balance_quantity" value="{{$totalSoQty-($totalReceivedQuantity+$totalQty)}}" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
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

<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/qpurchase/grn.js" type="text/javascript"></script>
<script>
   $('.qpurchasegrn').addClass('kt-menu__item--active');
   $('body').on('keyup', '.quantity', function() {
      var id = $(this).attr('data-id');
      row_calculate(id);
      totalCalculate();
   });

   function row_calculate(id) {
      var total_quantity = parseInt(getNum($('#total_quantity' + id + '').val()));
      var recquantity = parseInt(getNum($('#recquantity' + id + '').val()));
      var quantity = parseInt(getNum($('#quantity' + id + '').val()));
      var balanceQty = total_quantity - (recquantity + quantity);
      if (balanceQty < 0)
         $('#balance_quantity' + id + '').addClass('is-invalid');
      else
         $('#balance_quantity' + id + '').removeClass('is-invalid');
      $('#balance_quantity' + id + '').val(balanceQty);
   }

   function totalCalculate() {

      var grandtotal_so_quantity = 0;
      var grandtotal_quantity = 0;
      $("input[name^='quantity[]']").each(function(input) {
         grandtotal_quantity += parseInt(getNum($(this).val()));
      });
      var grandtotal_balance_quantity = 0;
      $("input[name^='balance_quantity[]']").each(function(input) {
         grandtotal_balance_quantity += parseInt(getNum($(this).val()));
      });

      $('#grandtotal_quantity').val(grandtotal_quantity);
      $('#grandtotal_balance_quantity').val(grandtotal_balance_quantity);

   }
</script>
@endsection