@extends('carRental.common.layout')

@section('content')
<!--div>Total Cars :: {{$totalCars}}</!--div>
<div>Car On Trip :: {{$carOnTrip}}</div>
<div>Car Available For Trip :: {{$carAvailableForTrip}}</div>

<div> Total Trip :: {{$totalTrip}}</div>
<div> Trip Completed :: {{$tripCompleted}}</div>
<div> Trip Confirmed :: {{$tripConfirmed}}</div>
<div> Trip Draft :: {{$tripDraft}}</div>
<div> Trip Cancelled :: {{$tripCancelled}}</div>-->

<!--Deen 06/05/23 -->

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
	</style>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid ">


    <div class="kt-portlet" style=" background-color: #ffffff00;">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="first">
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper" style="background-color: #f2f3f8;">

                    <div class="kt-wizard-v3__content fadeIn" data-ktwizard-type="step-content" data-ktwizard-state="current">
                        <div class="row mt-3">
                           <div class="col-md-4">
                              <a href="http://localhost/trading/customerdetails" class="white-link">
                                 <div class="card  dashboard-icon-widget">
                                    <div class="card-body">
                                       <div class="widget-icon bg-primary">
                                          <i class="fa fa-car fa-2x" aria-hidden="true"></i>
                                       </div>
                                       <div class="widget-details">
                                          <h1>{{$totalCars}}</h1>
                                          <span>Total Cars</span>
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
                                          <i class="fa fa-road fa-2x" aria-hidden="true"></i>
                                       </div>
                                       <div class="widget-details">
                                          <h1>{{$carOnTrip}}</h1>
                                          <span>Car On Trip</span>
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
                                          <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                                       </div>
                                       <div class="widget-details">
                                          <h1>{{$carAvailableForTrip}}</h1>
                                          <span>Car Available For Trip</span>
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
                                          <i class="fa fa-anchor fa-2x" aria-hidden="true"></i>
                                        </div>
                                        <div class="widget-details">
                                           <h1>{{$totalTrip}}</h1>
                                           <span>Total Trip</span>
                                        </div>
                                     </div>
                                  </div>
                               </a>
                            </div>
                            <div class="col-md-4">
                               <a href="http://localhost/trading/supplierdetails" class="white-link">
                                  <div class="card  dashboard-icon-widget">
                                     <div class="card-body">
                                        <div class="widget-icon bg-dark text-white">
                                          <i class="fa  fa-battery-full fa-2x" aria-hidden="true"></i>
                                        </div>
                                        <div class="widget-details">
                                           <h1>{{$tripCompleted}}</h1>
                                           <span>Trip Completed</span>
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
                                          <i class="fa fa-eject  fa-2x" aria-hidden="true"></i>
                                        </div>
                                        <div class="widget-details">
                                           <h1>{{$tripConfirmed}}</h1>
                                           <span>Trip Confirmed</span>
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
                                          <strong>Trip Draf </strong>
                                       </div>
                                       <div class="clearfix">
                                          <span class="text-off float-start mt-3 text-default"></span>
                                          <h1 class="float-end m0 text-default">{{$tripDraft}}</h1>
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
                                          <strong>Trip Cancelled</strong>
                                       </div>
                                       <div class="clearfix">
                                          <span class="text-off float-start mt-3 text-default"></span>
                                          <h1 class="float-end m0 text-default">{{$tripCancelled}}</h1>
                                       </div>

                                    </div>
                                 </div>
                              </a>
                           </div>

                        </div>






                    </div>

                </div>
            </div>
        </div>
    </div>
<!--/Deen 06/05/23-->
@endsection

@section('script')
<script>
    $('.dashboard').addClass('kt-menu__item--active');
</script>
@endsection
