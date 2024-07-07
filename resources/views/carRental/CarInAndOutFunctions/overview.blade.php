@extends('carRental.common.layout')
@section('content')

<style type="text/css">
   .fadeIn {
      -webkit-animation-name: fadeIn;
      animation-name: fadeIn;
      -webkit-animation-duration: 1s;
      animation-duration: 1s;
      -webkit-animation-fill-mode: both;
      animation-fill-mode: both;
   }

   @-webkit-keyframes fadeIn {
      0% {
         opacity: 0;
      }

      100% {
         opacity: 1;
      }
   }

   @keyframes fadeIn {
      0% {
         opacity: 0;
      }

      100% {
         opacity: 1;
      }
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
      float: right !important;
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
      border: 1px solid rgba(0, 0, 0, .125);
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
      border-bottom-right-radius: .25rem !important;
      border-bottom-left-radius: .25rem !important;
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

   .kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item .kt-wizard-v3__nav-body .kt-wizard-v3__nav-bar {
      height: 1px !important;
      background-color: #fff !important;
   }

   .kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item:hover .kt-wizard-v3__nav-body .kt-wizard-v3__nav-bar {
      background-color: gray !important;
   }

   .kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item .kt-wizard-v3__nav-body .kt-wizard-v3__nav-label {
      font-weight: 400 !important;
   }

   .kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item[data-ktwizard-state="current"] .kt-wizard-v3__nav-body .kt-wizard-v3__nav-label {
      font-weight: bold !important;
   }

   .kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item[data-ktwizard-state="current"] .kt-wizard-v3__nav-body .kt-wizard-v3__nav-bar:after {
      height: 2px !important;
   }

   .kt-footer {
      padding: 7px !important;
   }

   .list-group-flush .list-group-item:last-child {
      border-bottom: 0;
   }
</style>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
   <br />
   <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
         <div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
               <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">TRIP {{$carInAndOut->id}}</h3>
         </div>
         <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
               <div class="kt-portlet__head-actions">

               </div>
            </div>
         </div>
      </div>


      <!--begin::Portlet-->
      <div class="kt-portlet kt-portlet--tabs">
         <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
               <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-primary nav-tabs-line-2x" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" data-toggle="tab" href="{{URL::to('car-rental/trip-overview',$id)}}" role="tab">
                        <i class="la la-television"></i> Overview
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="{{URL::to('car-rental/trip-agreements',$id)}}" role="tab">
                        <i class="la la-exclamation"></i>Agreements
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="{{URL::to('car-rental/trip-attachments',$id)}}" role="tab">
                        <i class="la la la-chain"></i>Attachments
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="{{URL::to('car-rental/trip-notes',$id)}}" role="tab">
                        <i class="la la-file-text"></i>Notes
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="{{URL::to('car-rental/trip-additional-cost',$id)}}" role="tab">
                        <i class="la la la-at"></i>Additional Cost
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="{{URL::to('car-rental/trip-advance',$id)}}" role="tab">
                        <i class="la la-search-plus"></i>Payments
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="{{URL::to('car-rental/trip-proforma-invoice',$id)}}" role="tab">
                        <i class="la la-database"></i>Proforma Invoice
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="{{URL::to('car-rental/trip-invoices',$id)}}" role="tab">
                        <i class="la la-align-justify"></i>Invoices
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="{{URL::to('car-rental/trip-statement-of-accounts',$id)}}" role="tab">
                        <i class="la la-rotate-left"></i>Statement Of Accounts
                     </a>
                  </li>


               </ul>
            </div>
         </div>

      </div>




      <!--end::Portlet-->


   </div>

   <!--Deen 05/05/23-->

   <div class="kt-wizard-v3__content fadeIn  mb-5 " data-ktwizard-type="step-content" data-ktwizard-state="current">
      <div class="row mt-3">
         <div class="col-md-4">
            <a href="http://localhost/trading/customerdetails" class="white-link">
               <div class="card  dashboard-icon-widget">
                  <div class="card-body">
                     <div class="widget-icon bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase icon">
                           <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                           <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                     </div>
                     <div class="widget-details">
                        <h1>{{$totalAttachments}}</h1>
                        <span>Total Attachments</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>
         <div class="col-md-4">
            <a href="http://localhost/trading/supplierdetails" class="white-link">
               <div class="card  dashboard-icon-widget">
                  <div class="card-body">
                     <div class="widget-icon bg-orange">
                        <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                        <svg fill="#fff" width="25px" height="25px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                           <path d="m1783.68 1468.235-315.445 315.445v-315.445h315.445Zm-541.327-338.823v112.94h-903.53v-112.94h903.53Zm338.936-338.824V903.53H338.824V790.59h1242.465ZM621.176 0c93.403 0 169.412 76.01 169.412 169.412 0 26.09-6.437 50.484-16.94 72.62L999.98 468.255l-79.962 79.962-226.221-226.334c-22.137 10.504-46.532 16.942-72.622 16.942-93.402 0-169.411-76.01-169.411-169.412C451.765 76.009 527.775 0 621.176 0Zm395.295 225.882v112.942h790.588v1016.47h-451.765v451.765H112.941V338.824h225.883V225.882H0V1920h1421.478c45.176 0 87.755-17.619 119.717-49.581l329.224-329.11c31.962-32.076 49.581-74.655 49.581-119.831V225.882h-903.53Z" fill-rule="evenodd" />
                        </svg>
                     </div>
                     <div class="widget-details">
                        <h1>{{$totalNotes}}</h1>
                        <span>Total Notes</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-md-4">
            <a class="contact-widget-link" data-filter="logged_in_seven_days" href="http://localhost/trading/salesmandetailssettings">
               <div class="card dashboard-icon-widget">
                  <div class="card-body">
                     <div class="widget-icon bg-success text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon">
                           <polyline points="9 11 12 14 22 4"></polyline>
                           <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                     </div>
                     <div class="widget-details">
                        <h1>{{$additionalCost}}</h1>
                        <span>Additional Cost</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>


      </div>

      <div class="row mt-3">
         <div class="col-md-4">
            <a href="http://localhost/trading/customerdetails" class="white-link">
               <div class="card  dashboard-icon-widget">
                  <div class="card-body">
                     <div class="widget-icon bg-info">
                        <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <rect x="3" y="6" width="18" height="13" rx="2" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M3 10H20.5" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M7 15H9" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                     </div>
                     <div class="widget-details">
                        <h1>{{$paymentsGenerated}}</h1>
                        <span>Payments Generated</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>
         <div class="col-md-4">
            <a href="http://localhost/trading/supplierdetails" class="white-link">
               <div class="card  dashboard-icon-widget">
                  <div class="card-body">
                     <div class="widget-icon bg-dark">
                        <svg fill="#fff" height="30px" width="30px" version="1.1" id="XMLID_21_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve">
                           <g id="payment-square">
                              <g>
                                 <path d="M17,22H7c-2.8,0-5-2.2-5-5V7c0-2.8,2.2-5,5-5h10c2.8,0,5,2.2,5,5v10C22,19.7,19.8,22,17,22z M7,4C5.3,4,4,5.3,4,7v10
                                   c0,1.7,1.3,3,3,3h10c1.7,0,3-1.3,3-3V7c0-1.7-1.3-3-3-3H7z" />
                              </g>
                              <g>
                                 <path d="M14,9h-4c-0.6,0-1,0.4-1,1v4c0,0.6,0.4,1,1,1h4c0.6,0,1-0.4,1-1v-4C15,9.4,14.6,9,14,9z" />
                              </g>
                           </g>
                        </svg>
                     </div>
                     <div class="widget-details">
                        <h1>{{$proformaInvoicedAmount}}</h1>
                        <span>Proforma Invoiced Amount</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-md-4">
            <a class="contact-widget-link" data-filter="logged_in_seven_days" href="http://localhost/trading/salesmandetailssettings">
               <div class="card dashboard-icon-widget">
                  <div class="card-body">
                     <div class="widget-icon bg-danger text-white">
                        <svg fill="#fff" height="30px" width="30px" version="1.1" id="Filled_Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                           <g id="Volume-Low-Filled">
                              <path d="M1,12V8h5l6-5v18l-6-5H1V12 M20,12c0-2.76-2.24-5-5-5v2c1.65,0,3,1.35,3,3s-1.35,3-3,3v2C17.76,17,20,14.76,20,12z" />
                           </g>
                        </svg>
                     </div>
                     <div class="widget-details">
                        <h1>{{$totalInvoicedAmount}}</h1>
                        <span>Total Invoiced Amount</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>


      </div>


      <div class="row mt-3">
         <div class="col-md-6">
            <a class="client-widget-link" data-filter="has_unpaid_invoices" href="http://localhost/trading/salesmanroutesettings">
               <div class="card">
                  <div class="card-body p20">
                     <div class="widget-title p0 text-default">
                        <strong>Booking Date </strong>
                     </div>
                     <div class="clearfix">
                        <span class="text-off float-start mt-3 text-default"></span>
                        <h2 class="float-end m0 text-default">{{$carInAndOut->isue_date}}</h2>
                     </div>

                  </div>
               </div>
            </a>
         </div>
         <div class="col-md-6">
            <a class="client-widget-link" data-filter="has_partially_paid_invoices" href="http://localhost/trading/settingsDepartment">
               <div class="card">
                  <div class="card-body p20">
                     <div class="widget-title p0 text-default">
                        <strong>Booking Expiry date</strong>
                     </div>
                     <div class="clearfix">
                        <span class="text-off float-start mt-3 text-default"></span>
                        <h2 class="float-end m0 text-default">{{$carInAndOut->exp_date}}</h2>
                     </div>

                  </div>
               </div>
            </a>
         </div>

      </div>

      <div class="row mt-3">
         <div class="col-md-6">
            <div class="card">
               <div class="card-body p20">
                  <h1>Car Details</h1>
                  <ul class="list-group">
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        Car Details
                        @foreach($cars as $car)
                        <span class="badge badge-primary badge-pill">{{($car->id==$carInAndOut->car_id)?$car->registration_number. '~'.$car->car_name:''}}</span>
                        @endforeach
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        Rental Type
                        <span class="badge badge-primary badge-pill">{{$carInAndOut->rental_type}}</span>
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        Rate
                        <span class="badge badge-primary badge-pill">{{$carInAndOut->rate}}</span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="card">
               <div class="card-body p20">
                  <h1>Running Details</h1>
                  <ul class="list-group">
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        Aditional Amount(per Km)
                        <span class="badge badge-primary badge-pill">{{$carInAndOut->aditional_amount}}</span>
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        Trip Start Date
                        <span class="badge badge-primary badge-pill">{{$carInAndOut->trip_start_date}}</span>
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        Trip End Date
                        <span class="badge badge-primary badge-pill">{{$carInAndOut->trip_end_date}}</span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>

      <div class="row mt-3">
         <div class="col-md-6">
            <a class="client-widget-link" data-filter="has_unpaid_invoices" href="http://localhost/trading/salesmanroutesettings">
               <div class="card">
                  <div class="card-body p20">
                     <div class="widget-title p0 text-default">
                        <strong>Start Odometer </strong>
                     </div>
                     <div class="clearfix">
                        <span class="text-off float-start mt-3 text-default"></span>
                        <h2 class="float-end m0 text-default">{{$carInAndOut->trip_start_odometer}}</h2>
                     </div>

                  </div>
               </div>
            </a>
         </div>
         <div class="col-md-6">
            <a class="client-widget-link" data-filter="has_partially_paid_invoices" href="http://localhost/trading/settingsDepartment">
               <div class="card">
                  <div class="card-body p20">
                     <div class="widget-title p0 text-default">
                        <strong>End Odometer</strong>
                     </div>
                     <div class="clearfix">
                        <span class="text-off float-start mt-3 text-default"></span>
                        <h2 class="float-end m0 text-default">{{($carInAndOut->trip_end_odometer=='')?'-':$carInAndOut->trip_end_odometer}}</h2>
                     </div>

                  </div>
               </div>
            </a>
         </div>

      </div>



   </div>




   <!--/ Deen 05/05/23-->

</div>


@endsection
@section('script')
<script src="{{url('/')}}/resources/js/carRental/CarInAndOutFunctions/overview.js" type="text/javascript"></script>
@endsection