@extends('pos.common.layout')

@section('content')
<link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>

      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<style>
.inputpicker-overflow-hidden
   {
   overflow: hidden;
   width: 100%;
   }
   .inputpicker-div > .inputpicker-input
   {
   font-size: 11px;
   }
   .inputpicker-arrow{
   top:8px;
   }
   div.new1 {
   background-color: #f2f3f8;
   height: 20px;
   width: 100%;
   right: -36px;
   position: absolute;
   display: block;
   }
   .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
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
   .uppy-size--md .uppy-Dashboard-inner
   {
   width: 100% ;
   height: 550px;
   }
   .table-bordered th, .table-bordered td {
    border: 0px solid #ebedf2;
    padding: 0px !important;
}
.nav-tabs {
    border-bottom: 0px;
}
.nav-tabs .nav-link {
    border: 3px solid transparent;}
.nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
    border-color: #f8fcff #fefeff #979fa8;
}
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link{
   border-color: #ffffff #ffffff #2275d7;
}
.mbtn
{
   background-color: white;
   color: #74788d;

}
.mbtn:hover
{
       color: #ffffff;
    background: #5d78ff;
    border-color: #5d78ff;
   
}
.mbdg1
{
       background: #fff;
    color: #a1a3a5;
}
.mbdg1:hover
{
    background: #0ABB87;
    color: #fff;
}
.mbdg2
{
       background: #fff;
    color: #a1a3a5;
}
.mbdg2:hover
{
    background: #FD397A;
    color: #fff;
}
.dataTables_wrapper .dataTable .selected th, .dataTables_wrapper .dataTable .selected td {
    background-color: #f4e92b !important;
    /* color: #595d6e; */
}
#productdetails_list_wrapper
{
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
<br/>
                     <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                           <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <i class="kt-font-brand flaticon-home-2"></i>
                              </span>
                              <h3 class="kt-portlet__head-title">
                                Sales Order
                              </h3>
                           </div>
                           
                        </div>

                        <div class="kt-portlet__body pl-2 pr-2 pb-0">

                        <form class="kt-form" id="kt_form">

                  
                                 <ul class="nav nav-tabs nav-fill" role="tablist">
                                    <li class="nav-item">
                                       <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">@lang('app.Invoice Details')</a>
                                    </li>
                                    <li class="nav-item">
                                       <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_4">Customer Details</a>
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
                                        <div class="row" >


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
                              
                        <input type="text" class="form-control kt_datetimepickerr" name="dateofsupply" id="dateofsupply" value="{{date('d-m-Y')}}">               

                              
                                             
                              <!-- </div> -->
                              </div>
                              </div>
                              </div>



                                          <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>Customer Source</label>
                              </div> 
                          <!--     <div class="col-md-4 input-group-sm">
                              
                                 <select class="form-control" id="method">
                                 <option value="">select</option>
      
            <option value="1" selected="selected">Cash</option>
          <option value="2">Credit</option>
                              </select>
                              
                                             
                           
                              </div> -->
                              <div class="col-md-8 input-group-sm">
                              
                                 <select class="form-control kt-selectpicker newcustomer" id="newcustomer">
                                 <option value="">select</option>
            <option value="1">New Customer</option>
          <option value="2">Database</option>
                              </select>
                              
                                             
                              <!-- </div> -->
                              </div>  
                              </div>
                              </div>


       <!--    <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>New Customer</label>
                              </div> 
                              
                              </div>
                              </div> -->

                             <div class="col-lg-6">
                              <div class="form-group row pr-md-3">
                              <div class="col-md-4">
                              <label>@lang('app.Customer') </label>
                              </div> 
                              <div class="col-md-8  input-group-sm">
                                 <select class="form-control single-select kt-selectpicker customer" id="customer" disabled="" name="customer">
                                    <option value="">select</option>
         @foreach($customers as $data)
            <option value="{{$data->id}}">{{$data->cust_name}}</option>
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
                              
                        <input type="text" class="form-control" name="qtnref" id="qtnref">               
                              </div>
                              </div>
                              </div>
                              <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>@lang('app.PO/WO Reference')</label>
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
                              <option value="{{$data->id}}"
                                 <?php

                               if ($data->currency_default == 1)
                               {
                                  echo "selected"; 
                               }

                               ?>>         
                              {{$data->currency_name}}</option>
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
                              <?php 
                              $currency_default='';
                              ?>

                              @foreach($currencylist as $data)
                             <?php
                              if($data->currency_default == 1)
                              {
                                 $currency_default=$data->value;
                              } ?>
                           @endforeach
                           
                           <input type="text" class="form-control currency_value" name="currency_value" id="currency_value" value="{{$currency_default}}" readonly="">
                        
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
                              <select class="form-control kt-selectpicker" id="preparedby">
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
                              
                                             
                              <!-- </div> -->
                              </div> 
                              </div>
                              </div>
<!-- 
<div class="col-lg-6">
                              <div class="form-group row pr-md-3">
                              <div class="col-md-4">
                              <label>@lang('app.Reference')<span style="color: red">*</span> </label>
                              </div> 
                              <div class="col-md-8  input-group-sm">
                              <input type="text" class="form-control" name="reference" id="reference">               
                              </div>
                              </div>
                             </div> -->
                              
                             
                           

                                    </div>
                                 </div>
                                    <div class="tab-pane p-3" id="kt_tabs_2_2" role="tabpanel">

                        <div class="row" >
                              <!-- <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>@lang('app.Shipping Address')</label>
                              </div>  
                              <div class="col-md-8 input-group-sm">
                              
                                 <textarea class="form-control" name="shipping_address" id="shipping_address"></textarea>
                              
                                          

                              </div>
                              </div>
                              </div> -->

                         <!--      <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>@lang('app.Billing Address')</label>
                              </div>  
                              <div class="col-md-8 input-group-sm">
                              
                                 <textarea class="form-control" name="billing_address" id="billing_address"></textarea>
                              
                                          

                              </div>
                              </div>
                              </div> -->

                            <!--      <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>@lang('app.Contact Phone')</label>
                              </div>  
                              <div class="col-md-8 input-group-sm">
                              
                                    <input type="text" class="form-control" name="contact_phone" id="contact_phone">
                              

                              </div>
                              </div>
                              </div> -->


                              <div class="col-lg-12">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>@lang('app.Notes')</label>
                              </div>  
                              <div class="col-md-8 input-group-sm">
                              
                                 <textarea class="form-control" name="notes" id="notes"></textarea>
                              
                                             
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
            <option value="{{$data->id}}">{{$data->term}}</option>
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
                              </div>   -->
                              <div class="col-md-12 input-group-sm">
                              
                                    <div class="kt-tinymce">
                                    <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target">
                        
                    </textarea>
                                 </div>

                              </div>
                              </div>
                              </div>
               </div>
               <div class="tab-pane p-3" id="kt_tabs_2_4" role="tabpanel">
                  <div class="row" >
                        <div class="col-lg-6">
                                          <div class="form-group row pr-md-3">
                                             <div class="col-md-4">
                                                <label>{{ __('customer.Customer Category') }}</label>
                                             </div>
                                             <div class="col-md-8  input-group input-group-sm">
                                                <select class="form-control single-select Cust_category"
                                                   id="cust_category" name="cust_category">
                                                   <option value="">{{ __('customer.Select') }}
                                                   </option>@foreach($areaList as $item)
                                                   <option value="{{$item->id}}">
                                                      {{$item->customer_category}}</option>@endforeach
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                       <input type="hidden" class="form-control branch" name="branch" id="branch" value="<?php echo $branch;?>">
                                          <div class="form-group row pl-md-3">
                                             <div class="col-md-4">
                                                <label>{{ __('customer.Customer Code') }}</label>
                                             </div>
                                    <div class="col-md-8">
                                    <div class="input-group input-group-sm">
                                    
                                                   <input type="text" class="form-control branch"
                                                      name="cust_code" id="cust_code"
                                                      placeholder="{{ __('customer.Customer Code') }}"
                                                      autocomplete="off" readonly="">
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
                                                <select class="form-control single-select"
                                                   id="cust_type" name="cust_type">
                                                   <option value="">{{ __('customer.Select') }}
                                                   </option>@foreach ($areaLists as $key)
                                                   <option value="{{$key->id}}">{{$key->title}}
                                                   </option>@endforeach
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group row pl-md-3">
                                             <div class="col-md-4">
                                                <label>{{ __('customer.Customer Group') }}</label>
                                             </div>
                                             <div class="col-md-8  input-group input-group-sm">
                                                <select class="form-control single-select"
                                                   name="cust_group" id="cust_group">
                                                   <option value="">{{ __('customer.Select') }}
                                                   </option>@foreach($group as $item)
                                                   <option value="{{$item->id}}">{{$item->title}}
                                                   </option>@endforeach
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group row pr-md-3">
                                             <div class="col-md-4">
                                                <label>{{ __('customer.Customer Name') }}</label>
                                             </div>
                                             <div class="col-md-8 ">
                                                <div class="input-group input-group-sm">
                                                   
                                                   <input type="text" class="form-control"
                                                      id="cust_name" name="cust_name"
                                                      autocomplete="off"
                                                      placeholder="{{ __('customer.Customer Name/Company name') }}">
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
                                                   
                                                   <input type="text" class="form-control"
                                                      id="building_no" name="building_no"
                                                      autocomplete="off" placeholder="{{ __('customer.Building No') }}" >
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
                                                   
                                                   <input type="text" class="form-control"
                                                      id="cust_region" name="cust_region"
                                                      autocomplete="off"
                                                      placeholder="{{ __('customer.Street Name') }}" >
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
                                                   
                                                   <input type="text" class="form-control"
                                                      id="cust_district" name="cust_district"
                                                      autocomplete="off"
                                                      placeholder="{{ __('customer.District') }}" >
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
                                                   
                                                   <input type="text" class="form-control"
                                                      id="cust_city" name="cust_city"
                                                      autocomplete="off"
                                                      placeholder="{{ __('customer.City') }}" >
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
                                                   <select name="cust_country" id="cust_country"
                                                      class="form-control single-select">

                                                      <option value="">{{ __('customer.Select') }}
                                                      </option>@foreach($country as $coun)
                                                      <option value="{{$coun->id}}">
                                                         {{$coun->cntry_name}}</option>@endforeach
                                                   </select>
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
                                                   
                                                   <input type="text" class="form-control"
                                                      id="cust_zip" name="cust_zip" autocomplete="off"
                                                      placeholder="{{ __('customer.Postal Code') }}" >
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
                                                
                                                   <input type="text" class="form-control"
                                                      placeholder="{{ __('customer.Mobile') }}"
                                                      id="mobile" name="mobile" autocomplete="off" >
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
                                                      placeholder="{{ __('customer.Vat No') }}"
                                                      id="vatno" name="vatno" autocomplete="off">
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
                                                
                                                   <input type="text" class="form-control"
                                                      placeholder="{{ __('customer.Buyer ID / CR No') }}"
                                                      id="buyerid_crno" name="buyerid_crno" autocomplete="off" >
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                  </div>
               </div>
                                 </div>






                                 <div class="row p-0" style="background-color:#f2f3f8;" >
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
                           
                          <table class="table table-striped table-bordered table-hover" id="product_table"  style="table-layout:fixed; width:100%">
                                    <thead  class="thead-light" >
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
                                    </thead>
                                    <tbody>
                                    
                                       
                                    </tbody>
                                 </table>
                                 <table style="width:100%">
                                    <tr>
                                          <td>
                                             <!-- <button type="button" class="btn btn-primary btn-sm addproduct">Add New</button>&nbsp; &nbsp; &nbsp; &nbsp;</td> -->
                                             <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" data-type="add" data-toggle="modal" data-target="#kt_modal_4_4"><i class="la la-plus"></i>Line Iteam</button>
                                 
                                       <a href="{{url('/')}}/Add-Product" target="_blank" class="btn btn-light btn-elevate btn-icon-sm float-right mr-2">
                                     <!--  <i class="la la-plus"></i> -->
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
                              
                              <input type="text" class="form-control" name="totalamount" id="totalamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                              
                                             
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
                              
                              <input type="text" class="form-control discount" name="discount" id="discount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                              
                                             
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
                              
                              <input type="text" class="form-control" name="amountafterdiscount" id="amountafterdiscount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                              
                                             
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
                              
                              <input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">                             
                                             
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
    font-weight: bold; color: #646c9a; padding-top: 0px;">
                              
                                             
                              <!-- </div> -->
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

                                             <button type="reset" class="btn btn-secondary backHome"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>  &nbsp;@lang('app.Cancel')</button>


                                             <button type="button" class="btn btn-primary" id="quotation_submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>   &nbsp;@lang('app.Save')</button>
                                             
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
         <div class="row" >
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
                              <label>@lang('app.Description')
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
                                          <option value="{{$data->id}}">{{$data->unit_name}}</option>
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
          <button type="button" class="btn btn-default" id="productname_submit">Save</button>

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
         <div class="row" >
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
                                          <option value="{{$data->id}}">{{$data->unit_name}}</option>
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
          <button type="button" class="btn btn-default" id="servicename_submit">Save</button>

          <button type="button" class="btn btn-default closeBtn" data-dismiss="modal">Cancel</button>
        </div>
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
            <!-- <th>Rack</th> -->
            <th>Category</th>
           <!--  <th>Type</th>
            <th>Status</th> -->
            <!-- <th>ID</th> -->
        </tr>
    </thead>
    <tbody>
    </tbody>  
</table>
               
                  <table class="table" style="width:50%; margin-left:50%;">
                              <thead class="thead-light" >
                              <tr>
                                 <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total items selected</td><td style="border-bottom: 1px dashed gray; text-align: right;">
                                    <input type="text" id="selected_items" readonly="" class="form-control input form-control-sm"  style="border:0; text-align: right; background-color: #fff; height: calc(0.5em + 1rem + 2px);font-size: 20px; font-weight:bold;"></td>
                              </tr>

                              <tr >
                                 <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total amount</td><td style="border-bottom: 1px dashed gray;text-align: right;">
                                    <input type="text" id="selected_amount" readonly="" class="form-control form-control-sm"  style="border:0; text-align: right; background-color: #fff; height: calc(0.5em + 1rem + 2px);font-size: 20px; font-weight:bold;">
                                    
                                 </td>
                              </tr>

                           </thead>
                           </table>    
 <button type="button" class="btn btn-brand btn-elevate btn-icon-sm float-right ml-2" id="datatableadd"><i class="la la-plus"></i>Add</button>
 <button type="button" class="btn btn-secondary btn-icon-sm float-right" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel</button>


               </div>
         </div>
      
      </div>
   </div>

</div>

<style type="text/css">
   .hideButton{
      display: none
   }
   .error{
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
//var rowcount = 1;
$(document.body).on("change", ".product_names", function() 
  {
   product_name = $(this).val();
   createproduct(product_name);
   });


function createproductvialoop(product_name_array){

   for(i=0; i<product_name_array.length; ++i){
    
    createproduct(product_name_array[i]);
}

}


 
function createproduct(product_name){
      //var product_name = $(this).val();
  // alert(product_name);
      
      
        
      $.ajax({
      url: "getproduct_name_details_quotation",
      method: "POST",
      data: {
         _token: $('#token').val(),
         id:product_name
      },
      dataType: "json",
      success: function(data) { 
   
         $.each(data, function(key, value) {
            rowcount = $('#product_table tr').length;
           /* alert(rowcount);*/
 var des = value.description !="" ? value.description : '';
         var selling_price = (value.selling_price !=null) ? value.selling_price : 0;
          var product = '';
         product += '<tr>\
                 <td style="text-align: center;">'+rowcount+'</td><td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname" data-id="'+rowcount+'" value="'+value.product_name+'">\
                 <div>\
                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id" data-id="'+rowcount+'" value="'+value.product_id+'">\
                 </td>\
                 <td><textarea class="form-control" id="product_description'+rowcount+'" name="product_description[]" rows="1" data-id='+rowcount+' style=" height: 30px !important;">'+des+'</textarea>\</td>\
                 <td>\
                 <div>\
                 <select class="form-control form-control-sm single-select unit kt-selectpicker"  data-id="'+rowcount+'" name="unit[]" id="unit'+rowcount+'">\
                 <option value="">select</option>\
         @foreach($unitlist as $data)\
              <option value="{{$data->id}}">{{$data->unit_name}}</option>\
              @endforeach\
                 </select>\
                  </div>\
                 <div class="input-group input-group-sm">\
                 <input type="hidden" class="form-control unitvalue" name="unitvalue[]" id="unitvalue'+rowcount+'"  data-id="'+rowcount+'">\
                 </div>\
                 <div class="input-group input-group-sm">\
                 <input type="hidden" class="form-control quantity_value" name="quantity_value[]" id="quantity_value'+rowcount+'"  data-id="'+rowcount+'" value="1">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                  <input type="text" class="form-control quantity"  data-id="'+rowcount+'" name="quantity[]" id="quantity'+rowcount+'" value="1">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control rate" name="rate[]" id="rate'+rowcount+'"  data-id="'+rowcount+'" value="'+selling_price+'">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control amount" name="amount[]"  data-id="'+rowcount+'" id="amount'+rowcount+'" readonly value="'+selling_price+'">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control discountamount"  data-id="'+rowcount+'" name="discountamount[]" id="discountamount'+rowcount+'" value="0">\
                 </div>\
                 </td>\
                 @foreach($vatlist as $data)\
                        <?php
      if($data->default_tax == 1)
      { ?>
                              <td><input type="text" class="form-control vat_percentage form-control-sm" name="vat_percentage[]" id="vat_percentage'+rowcount+'" data-id='+rowcount+' value="{{$data->total}}" ></td>\
                           <?php
      }
       ?>
                           @endforeach\
                <td>\
                 <input type="text" class="form-control vatamount form-control-sm" name="vatamount[]" id="vatamount'+rowcount+'" data-id='+rowcount+' value="0"    readonly>\
                 </td>\
                  <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control row_total"  data-id="'+rowcount+'" name="row_total[]" id="row_total'+rowcount+'" readonly>\
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
                 $("#unit"+rowcount).val(value.unit).change();
                  $("#unitvalue"+rowcount).val(value.unit);
                 
            
                  });

        rowcount++;
      }
   })
}

// $(document).ready(function(){

// $(".productname").select2();

//      var rowcount = ($("#product_table > tbody > tr").length);
//      var i1=true;
//    $(".addproduct").click(function() 
//       {
//  $('.productname').each(function() {

//         if ($(this).val() === '') {
//           i1=false;
//            return false;


//         }
//         else {
//               i1=true;
//          }

//              });
//          if(i1==true){

//                 var sl = ($("#product_table > tbody > tr").length);
//           var sl = sl + 1;
         

   


//          var products = '';
//          products += '<tr>\
//                  <td class="row_count" id="rowcount">'+ sl +'</td>\
//                  <td>\
//                  <select class="form-control kt-selectpicker productname" id="productname'+sl+'" name="productname[]" data-id='+sl+'><option value="">Select</option>';


//  $.ajax({
//         type: "POST",
//         url: "getallproductdetails",
//         dataType: "json",
//         data: {
//             _token: $('#token').val(),
//         },
//         success: function(data) {
       

//               $.each(data, function(key, value) {

// $("#productname"+sl).append("<option value='"+value.product_id+"'>"+value.product_name+"</option>");
             


//             });

//    //$("#productname"+sl).trigger('change');


//         },
//         error: function(jqXhr, json, errorThrown) {
         
//           console.log(errorThrown);
           
//         }
//     });
            
   
         
   

//             products +='</select>\
//                  </td>\
//                  <input type="hidden" name="orquantity[]" id="orquantity'+sl+'">\
//                  <td>\
//                  <textarea class="form-control" id="product_description'+sl+'" name="product_description[]" data-id='+sl+'></textarea>\
//                  </td>\
//                   <td>\
//                  <select class="form-control kt-selectpicker" id="unit'+sl+'" name="unit[]" data-id='+sl+'>\
//          <option value="">select</option>\
//          @foreach($unitlist as $data)\
//             <option value="{{$data->id}}">{{$data->unit_name}}</option>\
//             @endforeach</select>\</td>\
//                   <td>\
//                 <input type="text" class="form-control quantity" name="quantity[]" id="quantity'+sl+'" value="1" data-id='+sl+'>\
//                  </td>\
//                   <td>\
//                  <input type="text" class="form-control rate" name="rate[]" id="rate'+sl+'" data-id='+sl+'>\
//                  </td>\
//                  <td>\
//                 <input type="text" class="form-control amount" name="amount[]" id="amount'+sl+'" data-id='+sl+' readonly>\
//                  </td>\
//                   <td><input type="text" class="form-control discountamount" name="discountamount[]" id="discountamount'+sl+'"  data-id='+sl+' value="0"></td>\
//                   @foreach($vatlist as $data)\
//                         <?php
//                               if($data->default_tax == 1)
//                               { ?>
//                               <td><input type="text" class="form-control vat_percentage" name="vat_percentage[]" id="vat_percentage'+sl+'" data-id='+sl+' value="{{$data->total}}" ></td>\
//                            <?php
//                         }
//                            ?>
//                            @endforeach\
//                            <td>\
//                  <input type="text" class="form-control vatamount" name="vatamount[]" id="vatamount'+sl+'" data-id='+sl+' value="0" readonly>\
//                  </td>\
//                  <td>\
//                  <input type="text" class="form-control row_total" name="row_total[]" id="row_total'+sl+'" data-id='+sl+' readonly>\
//                  </td>\
//                  <td>\
//                      <div class="kt-demo-icon__preview remove">\
//                        <i class="fa fa-trash" id="" style="color: red;padding-left: 30%;"></i>\
//                     </div>\
//                       </td>\
//                  </tr>';
      
//                   $('#product_table').append(products);
//                   rowcount++;
//                      $('.kt-selectpicker').select2();
//         } else{
//           toastr.warning("Please Select any Product!"); return false;
//         }
      


         
   
// });
   
//  });

//    $(document.body).on("change", ".productname", function() 
//    {
//       var productid = $(this).val();
//       var id = $(this).attr('data-id');
      
      
//       $.ajax({
//       url: "getproductdetails",
//       method: "POST",
//       data: {
//          _token: $('#token').val(),
//          id:productid
//       },
//       dataType: "json",
//       success: function(data) {
//          $.each(data, function(key, value) {
//                   $('#rate'+id+'').val(value.selling_price);
//                   $('#product_description'+id+'').val(value.description);
//                   $('#unit'+id+'').select2("val", value.unit);
//                   $('#quantity'+id+'').val(1);
//                   $('#amount'+id+'').val("");
//                   $('#vatamount'+id+'').val(0);
//                   $('#row_total'+id+'').val("");
//                   $('#totalamount').val("");
//                   $('#discount').val("");
//                   $('#amountafterdiscount').val("");
//                   $('#totalvatamount').val("");
//                   $('#grandtotalamount').val("");
//                   $('#orquantity'+id+'').val(value.available_stock);
//                   });
//          row_vatcalculate(id);
//          row_calculate(id);
         

//       }
//    })
//    });

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


 function discount_calculate()
     {
         var totaldiscamount = 0;
      $('.discountamount').each(function()
      {
         var id = $(this).attr('data-id');
         var damount = $('#discountamount'+id+'').val();
      
         totaldiscamount += parseFloat(damount);

      });
      totaldiscamount=getNum(totaldiscamount);
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


 function row_vatcalculate(id)
     {
   var vatpercentage= $('#vat_percentage'+id+'').val();
     vatpercentage=getNum(vatpercentage);
      var quantity = $('#quantity'+id+'').val();
   quantity=getNum(quantity);
      var rate     = $('#rate'+id+'').val();
 rate=getNum(rate);
      var rdiscount     = $('#discountamount'+id+'').val();
 rdiscount=getNum(rdiscount);

      var total    = parseFloat(quantity * rate) -parseFloat(rdiscount);


      vat_amount = (vatpercentage / 100) * total;
       vat_amount=getNum(vat_amount);
       $('#vatamount'+id+'').val(vat_amount.toFixed(2));

       //

         var vatamounts = 0;
      $('.vatamount').each(function()
      {
         var id = $(this).attr('data-id');
         var vatamount = $('#vatamount'+id+'').val();
      
         vatamounts += parseFloat(vatamount);

      });
      vatamounts=getNum(vatamounts);
      $('#totalvatamount').val(vatamounts.toFixed(2));

      //
}

     function row_calculate(id)
     {
      

      var quantity = $('#quantity'+id+'').val();
      var rate     = $('#rate'+id+'').val();
      var vatamount= $('#vatamount'+id+'').val();

//$new_width = ($percentage / 100) * $totalWidth;
   var disamount= $('#discountamount'+id+'').val();



      var total    = parseFloat(quantity * rate);
      var rowtotal = parseFloat(total-disamount) + parseFloat(vatamount)
total=getNum(total);
rowtotal=getNum(rowtotal);
      $('#amount'+id+'').val(total.toFixed(2));
      $('#row_total'+id+'').val(rowtotal.toFixed(2));
      row_vatcalculate(id);
      totalamount_calculate();
      discount_calculate();
      final_calculate1();
     }

    $('body').on('change', '.vatamount', function() {
   
      var vatamounts = 0;
      $('.vatamount').each(function()
      {
         var id = $(this).attr('data-id');
         var vatamount = $('#vatamount'+id+'').val();
      
         vatamounts += parseFloat(vatamount);

      });
      vatamounts=getNum(vatamounts);
      $('#totalvatamount').val(vatamounts.toFixed(2));
   });

function totalamount_calculate()
{
      var totalamount = 0;
      $('.amount').each(function()
      {
         var id = $(this).attr('data-id');
         var amount = $('#amount'+id+'').val();
      
         totalamount += parseFloat(amount);

      });
         totalamount=getNum(totalamount);
      $('#totalamount').val(totalamount.toFixed(2));
   /* $('#amountafterdiscount').val("");
      $('#discount').val("");
      $('#grandtotalamount').val("");*/

}

    $('body').on('change', '.discount', function() {
   
final_calculate1();

      
   });
function final_calculate1(){

      //

      var vatamounts = 0;
      $('.vatamount').each(function()
      {
         var id = $(this).attr('data-id');
         var vatamount = $('#vatamount'+id+'').val();
      
         vatamounts += parseFloat(vatamount);

      });
       vatamounts=getNum(vatamounts);
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
       amountafterdiscount=getNum(amountafterdiscount);
        grandtotalamount=getNum(grandtotalamount);
      $('#amountafterdiscount').val(amountafterdiscount.toFixed(2)); 
      $('#grandtotalamount').val(grandtotalamount.toFixed(2));
}



$(".vatamount").prop("readonly",true);

//$("#currency").select2({disabled:'readonly'});
 $(document.body).on("change", "#currency", function() 
    {
        var cid = $(this).val();
        
        $.ajax({
        url: "getcurrencydatavalue",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:cid
        },
        dataType: "json",
        success: function(data) {
          //  console.log(data);
            var termcondition ='';
          $.each(data, function(key, value) {
            
           cvalue =value.value;
                        });
          cvalue=getNum(cvalue);
          $('#currency_value').val(cvalue);

        }
    })
    });

   $(document).ready(function(){
        $(document).on('change','.Cust_category',function()
        {

            var cat_id=$(this).val();
         $.ajax({
             type:'POST',
             url:'getcategorycode',
             data:{
               _token: $('#token').val(),
               'id':cat_id
            },
             success:function(data){
               console.log(data);
                  $.each(data, function(key, value) {
                     $("#cust_code").val(value.customer_category+ '/'+value.increment);
                  });
             },
             error:function()
             {
             }
         });
          
      
        });
      });
   $(document).ready(function(){
        $(document).on('change','.newcustomer',function()
        {

            var customer = $(this).val();
            
            if(customer == 1)
            {
               $('#customer').val('').trigger('change');
               $('#customer').attr('disabled',true);
                            $('#cust_category').val('').trigger('change');
           $('#cust_type').val('').trigger('change');
           $('#cust_group').val('').trigger('change');
                                 $('#cust_name').val('');
                                 $('#cust_code').val('');
           $('#building_no').val('');
           $('#cust_region').val('');
           $('#cust_district').val('');
           $('#cust_city').val('');
           $('#cust_zip').val('');
           $('#mobile').val('');
           $('#vatno').val('');
           $('#buyerid_crno').val('');
            }
            if(customer == 2)
            {
               $('#customer').attr('disabled',false);
            }
            
          
      
        });
      });
   
</script>
        
   
   
</script>
<!-- <script src="{{url('/')}}/resources/js/sales/purchase.js" type="text/javascript"></script> -->
<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/quotation.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
 <script src="{{url('/')}}/resources/js/inventory/purchaseproduct.js" type="text/javascript"></script>
 <script type="text/javascript">
      const channel = new BroadcastChannel("inventory");

    channel.addEventListener("message", e => {
      //alert(e.data);
       if(e.data=='success'){
         
  //        load_product();
  //productname
         product_list_table.ajax.reload();
    //      $( "#productname" ).trigger( "click" );
       }
    /*    if(e.data){
         load_product();
         product_list_table.ajax.reload();
         // alert(1);

       }*/
    }); 


$(document.body).on("keyup  change", ".rate", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   


$(document.body).on("keyup  change", ".amount", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   


$(document.body).on("keyup  change", ".discountamount", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   


$(document.body).on("keyup  change", ".vat_percentage", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   

$(document.body).on("keyup  change", ".vatamount", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   

$(document.body).on("keyup  change", ".row_total", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   

$(document.body).on("keyup  change", ".quantity", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   

function getNum(val) {

   if (isNaN(val)||val == false||val ==null||val == undefined||val =="") {
     return 0;
   }
   return val;
}

 </script>
@endsection

