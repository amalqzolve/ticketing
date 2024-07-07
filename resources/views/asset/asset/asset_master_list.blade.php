@extends('asset.common.layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/public/assets/css/pages/wizard/wizard-3.css" rel="stylesheet" type="text/css" />

<style type="text/css">
   .progress {
     width: 150px;
     height: 150px;
     line-height: 150px;
     background: none;
     margin: 0 auto;
     box-shadow: none;
     position: relative;
}
 .progress:after {
     content: "";
     width: 100%;
     height: 100%;
     border-radius: 50%;
     border: 7px solid #eee;
     position: absolute;
     top: 0;
     left: 0;
}
 .progress > span {
     width: 50%;
     height: 100%;
     overflow: hidden;
     position: absolute;
     top: 0;
     z-index: 1;
}
 .progress .progress-left {
     left: 0;
}
 .progress .progress-bar {
     width: 100%;
     height: 100%;
     background: none;
     border-width: 7px;
     border-style: solid;
     position: absolute;
     top: 0;
     
}
#pro>div:nth-child(1) .progress .progress-bar{ 
  border-color: blue;
}
#pro>div:nth-child(1) .progress
{
    color: blue;
}
#pro>div:nth-child(2) .progress .progress-bar{ 
  border-color: green;
}
#pro>div:nth-child(2) .progress
{
    color: green;
}
#pro>div:nth-child(3) .progress .progress-bar{ 
  border-color: red;
}
#pro>div:nth-child(3) .progress
{
    color: red;
}
#pro>div:nth-child(4) .progress .progress-bar{ 
  border-color: gray;
}
#pro>div:nth-child(4) .progress
{
    color: gray;
}
#pro>div:nth-child(5) .progress .progress-bar{ 
  border-color: orange;
}
#pro>div:nth-child(5) .progress
{
    color: orange;
}

#pro>div:nth-child(6) .progress .progress-bar{ 
  border-color: purple;
}
#pro>div:nth-child(6) .progress
{
    color: purple;
}
#pro
{
    background-color: #f1f3f4;
}


 .progress .progress-left .progress-bar {
     left: 100%;
     border-top-right-radius: 75px;
     border-bottom-right-radius: 75px;
     border-left: 0;
     -webkit-transform-origin: center left;
     transform-origin: center left;
}
 .progress .progress-right {
     right: 0;
}
 .progress .progress-right .progress-bar {
     left: -100%;
     border-top-left-radius: 75px;
     border-bottom-left-radius: 75px;
     border-right: 0;
     -webkit-transform-origin: center right;
     transform-origin: center right;
}
 .progress .progress-value {
     display: flex;
     border-radius: 50%;
     font-size: 36px;
     text-align: center;
     line-height: 20px;
     align-items: center;
     justify-content: center;
     height: 100%;
     font-weight: 300;
     width: 100%;
}
 .progress .progress-value div {
     margin-top: 10px;
}
 .progress .progress-value span {
     font-size: 12px;
     text-transform: uppercase;
}
/* This for loop creates the necessary css animation names Due to the split circle of progress-left and progress right, we must use the animations on each side. */
 .progress[data-percentage="10"] .progress-right .progress-bar {
     animation: loading-1 1.5s linear forwards;
}
 .progress[data-percentage="10"] .progress-left .progress-bar {
     animation: 0;
}
 .progress[data-percentage="20"] .progress-right .progress-bar {
     animation: loading-2 1.5s linear forwards;
}
 .progress[data-percentage="20"] .progress-left .progress-bar {
     animation: 0;
}
 .progress[data-percentage="30"] .progress-right .progress-bar {
     animation: loading-3 1.5s linear forwards;
}
 .progress[data-percentage="30"] .progress-left .progress-bar {
     animation: 0;
}
 .progress[data-percentage="40"] .progress-right .progress-bar {
     animation: loading-4 1.5s linear forwards;
}
 .progress[data-percentage="40"] .progress-left .progress-bar {
     animation: 0;
}
 .progress[data-percentage="50"] .progress-right .progress-bar {
     animation: loading-5 1.5s linear forwards;
}
 .progress[data-percentage="50"] .progress-left .progress-bar {
     animation: 0;
}
 .progress[data-percentage="60"] .progress-right .progress-bar {
     animation: loading-5 1.5s linear forwards;
}
 .progress[data-percentage="60"] .progress-left .progress-bar {
     animation: loading-1 1.5s linear forwards 1.5s;
}
 .progress[data-percentage="70"] .progress-right .progress-bar {
     animation: loading-5 1.5s linear forwards;
}
 .progress[data-percentage="70"] .progress-left .progress-bar {
     animation: loading-2 1.5s linear forwards 1.5s;
}
 .progress[data-percentage="80"] .progress-right .progress-bar {
     animation: loading-5 1.5s linear forwards;
}
 .progress[data-percentage="80"] .progress-left .progress-bar {
     animation: loading-3 1.5s linear forwards 1.5s;
}
 .progress[data-percentage="90"] .progress-right .progress-bar {
     animation: loading-5 1.5s linear forwards;
}
 .progress[data-percentage="90"] .progress-left .progress-bar {
     animation: loading-4 1.5s linear forwards 1.5s;
}
 .progress[data-percentage="100"] .progress-right .progress-bar {
     animation: loading-5 1.5s linear forwards;
}
 .progress[data-percentage="100"] .progress-left .progress-bar {
     animation: loading-5 1.5s linear forwards 1.5s;
}
 @keyframes loading-1 {
     0% {
         -webkit-transform: rotate(0deg);
         transform: rotate(0deg);
    }
     100% {
         -webkit-transform: rotate(36);
         transform: rotate(36deg);
    }
}
 @keyframes loading-2 {
     0% {
         -webkit-transform: rotate(0deg);
         transform: rotate(0deg);
    }
     100% {
         -webkit-transform: rotate(72);
         transform: rotate(72deg);
    }
}
 @keyframes loading-3 {
     0% {
         -webkit-transform: rotate(0deg);
         transform: rotate(0deg);
    }
     100% {
         -webkit-transform: rotate(108);
         transform: rotate(108deg);
    }
}
 @keyframes loading-4 {
     0% {
         -webkit-transform: rotate(0deg);
         transform: rotate(0deg);
    }
     100% {
         -webkit-transform: rotate(144);
         transform: rotate(144deg);
    }
}
 @keyframes loading-5 {
     0% {
         -webkit-transform: rotate(0deg);
         transform: rotate(0deg);
    }
     100% {
         -webkit-transform: rotate(180);
         transform: rotate(180deg);
    }
}
 .progress {
     margin-bottom: 2em;
}
p {
    margin: -9px 0 10px;
}


.fadeIn {
  -webkit-animation-name: fadeIn;
  animation-name: fadeIn;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  }
  @-webkit-keyframes fadeIn {
  0% {opacity: 0;}
  100% {opacity: 1;}
  }
  @keyframes fadeIn {
  0% {opacity: 0;}
  100% {opacity: 1;}
  }
        .widget-icon {
    float: left;
    background-color: #4466F2;
    height: 55px;
    width: 55px;
    display: flex;
    border-radius: 5px;
    align-items: center;
    justify-content: center;
    text-align: center;
}
.widget-details {
    text-align: right;
    position: absolute;
    right: 20px;
}
.bg-orange {
    background-color: #FFB822;
     color: #fff;
}
.bg-primary {
    background-color: #6690F4 !important;
    color: #fff;
}
.bg-info {
    background-color: #22B9FF !important;
     color: #fff;
}
.widget-details h1 {
    margin: 0;
    color: #000;
}
.widget-details span {
    color: #595959;
}
.text-default {
    color: #4e5e6a !important;
}

.m0 {
    margin: 0 !important;
}
.float-end {
    float: right!important;
}
.list-group-item:last-child {
    border-bottom-right-radius: inherit;
    border-bottom-left-radius: inherit;
}

.list-group-item:first-child {
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
}
.list-group-item {
    border: none;
    padding: 10px 15px;
}
.text-default {
    color: #4e5e6a !important;
}
.list-group-item {
    position: relative;
    display: block;
    padding: .5rem 1rem;
    color: #212529;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,.125);
}
.card .card-body {
    padding: 15px;
}
.pt0 {
    padding-top: 0px !important;
}
.ps {
    overflow: hidden !important;
    overflow-anchor: none;
    -ms-overflow-style: none;
    touch-action: auto;
    -ms-touch-action: auto;
}
.rounded-bottom {
    border-bottom-right-radius: .25rem!important;
    border-bottom-left-radius: .25rem!important;
}
.card-body {
    flex: 1 1 auto;
}
.kt-header--fixed.kt-subheader--fixed.kt-subheader--enabled .kt-wrapper {
    padding-top: 65px !important;
}
.avatar img {
    height: auto;
    max-width: 100%;
    border-radius: 50%;
}

.avatar-xs {
    width: 30px;
    height: 30px;
}
.avatar {
    display: inline-block;
    white-space: nowrap;
}
.mr10 {
    margin-right: 10px;
}
.kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item .kt-wizard-v3__nav-body .kt-wizard-v3__nav-bar{
    height: 1px !important; 
    background-color: #fff !important;  
}
.kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item:hover  .kt-wizard-v3__nav-body .kt-wizard-v3__nav-bar{
    background-color: gray !important;  
}
.kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item .kt-wizard-v3__nav-body .kt-wizard-v3__nav-label{
        font-weight: 400 !important;
}
.kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item[data-ktwizard-state="current"] .kt-wizard-v3__nav-body .kt-wizard-v3__nav-label{
    font-weight: bold !important;
}

.kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item[data-ktwizard-state="current"] .kt-wizard-v3__nav-body .kt-wizard-v3__nav-bar:after{
        height: 2px !important;
}
.kt-footer 
{
    padding: 7px !important;
}
.list-group-flush .list-group-item:last-child {
    border-bottom: 0;
}
.kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item{
    flex: 0 0 15% !important;
}

</style>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
                     <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                           <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <i class="kt-font-brand flaticon-home-2"></i>
                              </span>
                              <h3 class="kt-portlet__head-title">
                                Asset Master
                              </h3>
                           </div>
                           <div class="kt-portlet__head-toolbar">
                              <div class="kt-portlet__head-wrapper">
                                 <div class="kt-portlet__head-actions">
                             
                                    
                 <!--   <a href="{{url('/')}}/asset_download" class="btn btn-brand btn-elevate btn-icon-sm" style="width: 176px;">
                                      
                                       Templete Download
                                    </a>&nbsp;
                                     <a href="{{url('/')}}/exportassetdata" class="btn btn-brand btn-elevate btn-icon-sm" style="width: 176px;">
                                      Import Data
                                    </a>&nbsp; -->

                                    <div class="dropdown dropdown-inline">
                                       <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="la la-download"></i> Options
                                       </button>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          <ul class="kt-nav">
                                      



                                             <li class="kt-nav__section kt-nav__section--first">
                                                <span class="kt-nav__section-text">{{ __('product.Choose an option') }}</span>
                                             </li>
                                             <li class="kt-nav__item" id="productdetails_list_print">
                                                <span href="#" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-print"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.Print') }}</span>
                                                </span>
                                             </li>
                                             <li class="kt-nav__item" id="productdetails_list_copy">
                                                <span class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-copy"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.Copy') }}</span>
                                                </span>
                                             </li>
                                             <li class="kt-nav__item" id="productdetails_list_csv">
                                                <a href="#" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.CSV') }}</span>
                                                </a>
                                             </li>
                                             <li class="kt-nav__item" id="productdetails_list_pdf">
                                                <span class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.PDF') }}</span>
                                                </span>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                    
                                         
                                           

                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="kt-portlet__body">
<div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="first">
        <div class="kt-grid__item">
            <div class="kt-wizard-v3__nav border border-0">
                <div class="kt-wizard-v3__nav-items kt-wizard-v3__nav-items--clickable pl-2">
                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                      <div class="kt-wizard-v3__nav-body pb-0">
                         <div class="kt-wizard-v3__nav-label">
                            <!-- <span>1</span> --> Asset Master 
                         </div>
                         <div class="kt-wizard-v3__nav-bar"></div>
                      </div>
                   </div>
                   <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="">
                      <div class="kt-wizard-v3__nav-body pb-0">
                         <div class="kt-wizard-v3__nav-label">
                            <!-- <span>1</span> -->    Group
                         </div>
                         <div class="kt-wizard-v3__nav-bar"></div>
                      </div>
                   </div>
                   <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="">
                      <div class="kt-wizard-v3__nav-body pb-0">
                         <div class="kt-wizard-v3__nav-label">
                            <!-- <span>1</span> -->    Category
                         </div>
                         <div class="kt-wizard-v3__nav-bar"></div>
                      </div>
                   </div>
                  
                   
                   <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
                      <div class="kt-wizard-v3__nav-body pb-0">
                         <div class="kt-wizard-v3__nav-label">
                            <!-- <span>3</span> -->     Type
                         </div>
                         <div class="kt-wizard-v3__nav-bar"></div>
                      </div>
                   </div>
                   <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
                      <div class="kt-wizard-v3__nav-body pb-0">
                         <div class="kt-wizard-v3__nav-label">
                            <!-- <span>3</span> -->     Warehouse
                         </div>
                         <div class="kt-wizard-v3__nav-bar"></div>
                      </div>
                   </div>

                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
                      <div class="kt-wizard-v3__nav-body pb-0">
                         <div class="kt-wizard-v3__nav-label">
                            <!-- <span>3</span> -->     Location
                         </div>
                         <div class="kt-wizard-v3__nav-bar"></div>
                      </div>
                   </div>
                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
                      <div class="kt-wizard-v3__nav-body pb-0">
                         <div class="kt-wizard-v3__nav-label">
                            <!-- <span>3</span> -->     Project
                         </div>
                         <div class="kt-wizard-v3__nav-bar"></div>
                      </div>
                   </div>
                    
                  

                   
                </div>
            </div>
        </div>
        
            <div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
               <div class="mt-3">
   <div class="kt-portlet__body kt-portlet__body--fit">
     <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
     
 <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                                            <!--begin: Form Wizard Form-->
<form class="kt-form" id="kt_form" style="width: 100%; padding:0;">
              
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="maindetails_list">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Asset Name</th>
            <th>Asset ID</th>
            <th>Tag ID</th>
            <th>Group</th>
            <th>Category</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Warehouse</th>
            <th>Store</th>
            <th>Unit</th>
            <th>Qty</th>
            <th>Availability Status</th>
            <th>O&M Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>


       @foreach($assets as $asset)
<tr >
   <td >{{$i}}</td>
   <td   style="cursor: pointer;"  class="viewchilden">{{ $asset->asset_name  }}</td>
      <td   style="cursor: pointer;"  class="viewchilden">{{ $asset->asset_code  }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->tag }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->groupname }}</td>
        <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->categoryname }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->typename }}</td>
        <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->brand_name }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->warehouse_name }}</td>
         <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->store_name }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->unit_name }}</td>
        <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->quantity }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">
         <?php
        if($asset->availability_status==1)
            { 
            ?>
            <span style="color:green">Active</span>
            <?php
            }
            else
            {
            ?>
            <span style="color: red">Inactive</span> 
            <?php
            }
            ?>
       </td>
        <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->om_status }}</td>
      
          <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <a href="{{url('/')}}/asetview?id={{$asset->id}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-background"></i>
                        <span class="kt-nav__link-text" data-id="" >View</span>
                        </span></li></a>
                         <a href="{{url('/')}}/asetdocumentview?id={{$asset->id}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-background"></i>
                        <span class="kt-nav__link-text" data-id="" >Document Vault</span>
                        </span></li></a>
                        
                       </ul></div></div></span></td>
</tr>
 <?php $i++; ?>
    @endforeach

    
          
              


    </tbody>
</table>
  </form>

                                            <!--end: Form Wizard Form-->
                                        </div>
                                    </div>
                                </div>



               </div>
            </div>
            <div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
               <div class="mt-3">
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="groupdetails_list">
    <thead>
       <tr>
            <th>S.No</th>
           
            <th>Group Name</th>
            <th>Total Assets</th>
           
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>


       @foreach($group as $asset)
<tr >
   <td >{{$i}}</td>
  
     
        <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->groupname }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{$asset->total}}</td>
       
      
          <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <a href="{{url('/')}}/asetgroupview?id={{$asset->asgroup}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-background"></i>
                        <span class="kt-nav__link-text" data-id="" >View</span>
                        </span></li></a>
                         
                        
                       </ul></div></div></span></td>
</tr>
 <?php $i++; ?>
    @endforeach

    
          
              


    </tbody>
</table>
               </div>
            </div>
            <div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
               <div class="mt-3">
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="categorydetails_list">
    <thead>
       <tr>
            <th>S.No</th>
           
            <th>Category</th>
            <th>Total Assets</th>
           
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>


       @foreach($category as $asset)
<tr >
   <td >{{$i}}</td>
  
     
        <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->categoryname }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{$asset->total}}</td>
       
      
          <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <a href="{{url('/')}}/asetcategoryview?id={{$asset->category}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-background"></i>
                        <span class="kt-nav__link-text" data-id="" >View</span>
                        </span></li></a>
                         
                        
                       </ul></div></div></span></td>
</tr>
 <?php $i++; ?>
    @endforeach

    
          
              


    </tbody>
</table>
               </div>
            </div>
            <div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
               <div class="mt-3">
     <table class="table table-striped table-hover table-checkable dataTable no-footer" id="typedetails_list">
    <thead>
       <tr>
            <th>S.No</th>
           
            <th>Type</th>
            <th>Total Assets</th>
           
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>


       @foreach($type as $asset)
<tr >
   <td >{{$i}}</td>
  
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->typename }}</td>
        <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->total }}</td>
       
      
          <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                       <a href="{{url('/')}}/asettypeview?id={{$asset->type}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-background"></i>
                        <span class="kt-nav__link-text" data-id="" >View</span>
                        </span></li></a>
                        
                       </ul></div></div></span></td>
</tr>
 <?php $i++; ?>
    @endforeach

    
          
              


    </tbody>
</table>
               </div>
            </div>
            <div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
               <div class="mt-3">
      <table class="table table-striped table-hover table-checkable dataTable no-footer" id="warehousedetails_list">
    <thead>
       <tr>
            <th>S.No</th>
            
            <th>Warehouse</th>
            <th>Total Asset</th>
           
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>


       @foreach($warehouse as $asset)
<tr >
   <td >{{$i}}</td>
  
       
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->warehouse_name }}</td>
         <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->total }}</td>
      
       
      
          <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <a href="{{url('/')}}/asetwarehouseview?id={{$asset->type}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-background"></i>
                        <span class="kt-nav__link-text" data-id="" >View</span>
                        </span></li></a>
                     
                       </ul></div></div></span></td>
</tr>
 <?php $i++; ?>
    @endforeach

    
          
              


    </tbody>
</table>
               </div>
            </div>

    <div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
               <div class="mt-3">
     <table class="table table-striped table-hover table-checkable dataTable no-footer" id="locationdetails_list">
    <thead>
       <tr>
            <th>S.No</th>
            <th>Location Name</th>
            <th>Total Assets</th>
           
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>



       @foreach($locations as $asset)
<tr >
   <td >{{$i}}</td>
   <td   style="cursor: pointer;"  class="viewchilden">{{ $asset->name }}</td>
      <td   style="cursor: pointer;"  class="viewchilden">{{ $asset->total }}</td>
      <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <a href="{{url('/')}}/asetlocationview?id={{$asset->geo_location}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-background"></i>
                        <span class="kt-nav__link-text" data-id="" >View</span>
                        </span></li></a>
                     
                       </ul></div></div></span></td>
       
      
</tr>
 <?php $i++; ?>
    @endforeach

    
          
              


    </tbody>
</table>
               </div>
            </div>
                <div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
               <div class="mt-3">
     <table class="table table-striped table-hover table-checkable dataTable no-footer" id="projectdetails_list">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Project Name</th>
            <th>Total Assets</th>
            
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>


       @foreach($project as $asset)
<tr >
   <td >{{$i}}</td>
   <td   style="cursor: pointer;"  class="viewchilden">{{ $asset->project_name }}</td>
      <td   style="cursor: pointer;"  class="viewchilden">{{ $asset->total }}</td>
       
      
          <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"> <a href="{{url('/')}}/asetprojectview?id={{$asset->project}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-background"></i>
                        <span class="kt-nav__link-text" data-id="" >View</span>
                        </span></li></a>
                       </ul></div></div></span></td>
</tr>
 <?php $i++; ?>
    @endforeach

    
          
              


    </tbody>
</table>
               </div>
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
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<!-- <script src="{{url('/')}}/resources/js/boq/boq.js" type="text/javascript"></script> -->
 <script src="{{url('/')}}/public/assets/js/pages/custom/wizard/wizard-3.js" type="text/javascript"></script>
<script type="text/javascript">

   $(document).ready(function() {

      var maindetails_list_table = $('#maindetails_list').DataTable({
        processing: true,
         serverSide: false,
         pagingType: "full_numbers",
         scrollX: true,

         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
       
      });
      
      var groupdetails_list_table = $('#groupdetails_list').DataTable({
        processing: true,
         serverSide: false,
         pagingType: "full_numbers",
         /*          scrollX: true,*/

         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
       
      });
      var categorydetails_list_table = $('#categorydetails_list').DataTable({
        processing: true,
         serverSide: false,
         pagingType: "full_numbers",
         /*          scrollX: true,*/

         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
       
      });
      var typedetails_list_table = $('#typedetails_list').DataTable({
        processing: true,
         serverSide: false,
         pagingType: "full_numbers",
         /*          scrollX: true,*/

         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
       
      });
      var warehousedetails_list_table = $('#warehousedetails_list').DataTable({
        processing: true,
         serverSide: false,
         pagingType: "full_numbers",
         /*          scrollX: true,*/

         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
       
      });
      var locationdetails_list_table = $('#locationdetails_list').DataTable({
        processing: true,
         serverSide: false,
         pagingType: "full_numbers",
         /*          scrollX: true,*/

         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
       
      });
      var projectdetails_list_table = $('#projectdetails_list').DataTable({
        processing: true,
         serverSide: false,
         pagingType: "full_numbers",
         /*          scrollX: true,*/

         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
       
      });



$("#productdetails_list_print").on("click", function() {
   
    maindetails_list_table.button('.buttons-print').trigger();
});


$("#productdetails_list_copy").on("click", function() {
    maindetails_list_table.button('.buttons-copy').trigger();
});

$("#productdetails_list_csv").on("click", function() {
    maindetails_list_table.button('.buttons-csv').trigger();
});

$("#productdetails_list_pdf").on("click", function() {
    maindetails_list_table.button('.buttons-pdf').trigger();
});

  
      
      });


/*$('[type="search"]').addClass("form-control form-control-sm mt-3");
        $('div.dataTables_wrapper div.dataTables_length select').addClass("form-control form-control-sm mt-3");*/
</script>
@endsection
