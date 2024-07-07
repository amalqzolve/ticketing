@extends('request_and_approval.common.layout')

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

    <div class="row">
        <div class="col-md-12 pl-5 pr-5 ">
            <!--1-->
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
                               <h1>{{$totalRequest}}</h1>
                               <span>Total Requet Created</span>
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
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users icon">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                  <circle cx="9" cy="7" r="4"></circle>
                                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                               </svg>
                            </div>
                            <div class="widget-details">
                               <h1>{{$draftRequest}}</h1>
                               <span>Request On Draft</span>
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
                               <h1>{{$approvalPendingRequest}}</h1>
                               <span>Request Waiting For Approval</span>
                            </div>
                         </div>
                      </div>
                   </a>
                </div>
             </div>
             <!--/1-->
             <!--2-->
             <div class="row mt-3">
                <div class="col-md-6">
                   <a class="client-widget-link" data-filter="has_unpaid_invoices" href="http://localhost/trading/salesmanroutesettings">
                      <div class="card">
                         <div class="card-body p20">
                            <div class="widget-title p0 text-default">
                               <strong>Request Approved  </strong>
                            </div>
                            <div class="clearfix">
                               <span class="text-off float-start mt-3 text-default"></span>
                               <h1 class="float-end m0 text-default">{{$approvedRequest}}</h1>
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
                               <strong>Request Rejected</strong>
                            </div>
                            <div class="clearfix">
                               <span class="text-off float-start mt-3 text-default"></span>
                               <h1 class="float-end m0 text-default">{{$rejectedRequest}}</h1>
                            </div>

                         </div>
                      </div>
                   </a>
                </div>


             </div>
             <!--/2-->

             <!--3-->
             <div class="row mt-3">
                <div class="col-md-6">
                   <a class="client-widget-link" data-filter="has_unpaid_invoices" href="http://localhost/trading/salesmanroutesettings">
                      <div class="card">
                         <div class="card-body p20">
                            <div class="widget-title p0 text-default">
                               <strong>Request Waiting for my Decision</strong>
                            </div>
                            <div class="clearfix">
                               <span class="text-off float-start mt-3 text-default"></span>
                               <h1 class="float-end m0 text-default">{{$approvalPendingOnMySideRequest}}</h1>
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
                               <strong>Decision Taken</strong>
                            </div>
                            <div class="clearfix">
                               <span class="text-off float-start mt-3 text-default"></span>
                               <h1 class="float-end m0 text-default">{{$decisionTaken}}</h1>
                            </div>

                         </div>
                      </div>
                   </a>
                </div>


             </div>
             <!--/3-->
        </div>
    </div>

@endsection

@section('script')
<script>
    $('.dashboard').addClass('kt-menu__item--active');
</script>
@endsection
