@extends('inventory.common.layout')

@section('content')
    <style>
        .kt-timeline-v2:before {
            left: 10.85rem;
        }

        .kt-timeline-v2 .kt-timeline-v2__items .kt-timeline-v2__item .kt-timeline-v2__item-cricle>i {
            left: -1.00rem;
        }

        .kt-timeline-v2 .kt-timeline-v2__items .kt-timeline-v2__item .kt-timeline-v2__item-cricle {
            left: 10.65rem;
        }

        .kt-timeline-v2 .kt-timeline-v2__items .kt-timeline-v2__item .kt-timeline-v2__item-text {
            padding: 0.35rem 0 0 12rem;
        }

        .fa-genderless:before {
            content: "°";
        }

        .kt-widget17 .kt-widget17__stats {
            margin: -14.3rem auto 0 auto;
        }

        .dataTables_length,
        #kt_datatable_employeestatus_filter {
            display: none;
        }

        .newcolor1 {
            /*background-color: #efc9d5;*/
            background-color: #5d78ff;
            color: white;
        }

        .newcolor2 {
            /*background-color: #ffffec;*/
            background-color: #0abb87;
            color: white;
        }

        .newcolor3 {
            /*background-color: #ecffee;*/
            background-color: #ffb822;
            color: white;
        }

        .newcolor4 {
            /* background-color: #ecf4ff;*/
            background-color: #fd397a;
            color: white;
        }

        .new .kt-widget14 .kt-widget14__header .kt-widget14__title {
            color: white;
        }

        .kt-timeline-v2 .kt-timeline-v2__items .kt-timeline-v2__item .kt-timeline-v2__item-time {
            font-size: 1rem !important;
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

        .bg-primary {
            background-color: #5867dd !important;
        }

        .bg-primary {
            background-color: #6690F4 !important;
            color: #fff;
        }

        .bg-orange {
            background-color: #FFB822;
            color: #fff;
        }

        .bg-info {
            background-color: #5578eb !important;
        }

        .bg-info {
            background-color: #22B9FF !important;
            color: #fff;
        }

        .widget-details {
            text-align: right;
            position: absolute;
            right: 20px;
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

        .card .card-body {
            padding: 10px;
        }

        @media (min-width: 1025px) {
            .kt-header--fixed.kt-subheader--fixed.kt-subheader--enabled .kt-wrapper {
                padding-top: 69px !important;
            }
        }

        .float-end {
            float: right !important;
        }
    </style>
    <link href="{{ url('/') }}/public/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">





            </div>

        </div>
    </div>

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">



        <div class="row mt-3">
            <div class="col-md-4">
                <a href="{{ url('/') }}/ProductList" class="white-link">
                    <div class="card  dashboard-icon-widget">
                        <div class="card-body">
                            <div class="widget-icon bg-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-briefcase icon">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                            </div>
                            <div class="widget-details">
                                <h1>{{ $products }}</h1>
                                <span>Total Products</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-md-4">
                <a class="contact-widget-link" data-filter="logged_in_seven_days"
                    href="{{ url('/') }}/settingsUnitList">
                    <div class="card dashboard-icon-widget">
                        <div class="card-body">
                            <div class="widget-icon bg-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-check-square icon">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                            </div>
                            <div class="widget-details">
                                <h1>{{ $units }}</h1>
                                <span>Total Units</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- <div class="col-md-4">
                <a href="{{ url('/') }}/BrandList" class="white-link">
                    <div class="card  dashboard-icon-widget">
                        <div class="card-body">
                            <div class="widget-icon bg-orange">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-users icon">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path
                                        d="M13.5,6 C13.33743,8.28571429 12.7799545,9.78571429 11.8275735,10.5 C11.8275735,10.5 12.5,4 10.5734853,2 C10.5734853,2 10.5734853,5.92857143 8.78777106,9.14285714 C7.95071887,10.6495511 7.00205677,12.1418252 7.00205677,14.1428571 C7.00205677,17 10.4697177,18 12.0049375,18 C13.8025422,18 17,17 17,13.5 C17,12.0608202 15.8333333,9.56082016 13.5,6 Z" />
                                    <path
                                        d="M9.72075922,20 L14.2792408,20 C14.7096712,20 15.09181,20.2754301 15.2279241,20.6837722 L16,23 L8,23 L8.77207592,20.6837722 C8.90818997,20.2754301 9.29032881,20 9.72075922,20 Z"
                                        opacity="0.3" />
                                    </g>
                                </svg>
                            </div>
                            <div class="widget-details">
                                <h1>{{ $brands }}</h1>
                                <span>Total Brands</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div> 

            <div class="col-md-4">
                <a class="contact-widget-link" data-filter="logged_in_seven_days"
                    href="{{ url('/') }}/ManufacturerList">
                    <div class="card dashboard-icon-widget">
                        <div class="card-body">
                            <div class="widget-icon bg-success text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-check-square icon">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path
                                        d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z M17,16 L17,10 C17,8.34314575 15.6568542,7 14,7 L8,7 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L17,16 Z"
                                        fill-rule="nonzero" />
                                    <path
                                        d="M9.27272727,9 L13.7272727,9 C14.5522847,9 15,9.44771525 15,10.2727273 L15,14.7272727 C15,15.5522847 14.5522847,16 13.7272727,16 L9.27272727,16 C8.44771525,16 8,15.5522847 8,14.7272727 L8,10.2727273 C8,9.44771525 8.44771525,9 9.27272727,9 Z"
                                        opacity="0.3" />
                                    </g>
                                </svg>
                            </div>
                            <div class="widget-details">
                                <h1>{{ $manufacturer }}</h1>
                                <span>Total Manufacturer</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}


        </div>






        {{-- <div class="row mt-3">
            <div class="col-md-4">
                <a href="{{ url('/') }}/CategoryList" class="white-link">
                    <div class="card  dashboard-icon-widget">
                        <div class="card-body">
                            <div class="widget-icon bg-dark text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-briefcase icon">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path
                                        d="M8.08113883,20 L15.9188612,20 C16.5645068,20 17.137715,19.5868549 17.3418861,18.9743416 L19.6721428,11.9835717 C19.8694432,11.3916705 19.6797482,10.7394436 19.1957765,10.3456849 L12.9561839,5.26916104 C12.4053757,4.82102426 11.6158052,4.82050247 11.0644052,5.26791085 L4.80622561,10.345825 C4.32117072,10.7394007 4.13079092,11.3923728 4.32832067,11.984962 L6.65811388,18.9743416 C6.86228495,19.5868549 7.43549322,20 8.08113883,20 Z" />
                                </svg>
                            </div>
                            <div class="widget-details">
                                <h1>{{ $categories }}</h1>
                                <span>Total Categories</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ url('/') }}/Batchlist" class="white-link">
                    <div class="card  dashboard-icon-widget">
                        <div class="card-body">
                            <div class="widget-icon bg-danger text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-users icon">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <div class="widget-details">
                                <h1>{{ $batches }}</h1>
                                <span>Total Batches</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

          
        </div> --}}


        <!--Deen 23/03/2013 -->




        <!--<div class="row mt-3">
                                                                <div class="col-md-6">
                                                                   <a class="client-widget-link" data-filter="has_unpaid_invoices" href="http://localhost/trading/salesmanroutesettings">
                                                                      <div class="card">
                                                                         <div class="card-body p20">
                                                                            <div class="widget-title p0 text-default">
                                                                               <strong>Total Salesman Routes </strong>
                                                                            </div>
                                                                            <div class="clearfix">
                                                                               <span class="text-off float-start mt-3 text-default"></span>
                                                                               <h1 class="float-right m0 text-default">2</h1>
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
                                                                               <strong>Departments</strong>
                                                                            </div>
                                                                            <div class="clearfix">
                                                                               <span class="text-off float-start mt-3 text-default"></span>
                                                                               <h1 class="float-right m0 text-default">1</h1>
                                                                            </div>

                                                                         </div>
                                                                      </div>
                                                                   </a>
                                                                </div>

                                                             </div>




                                                             <div class="row mt-3 mb-5">
                                                                 <div class="col-md-6 mb-3">
                                                                   <div class="card bg-white">
                                                                      <span class="p-4"><strong>Customer Settings</strong></span>
                                                                      <div class="card-body pt0 rounded-bottom ps" id="projects-container" style="height: 182px; position: relative;">
                                                                         <ul class="list-group list-group-flush">
                                                                            <a class="client-widget-link" data-filter="has_open_projects" href="http://localhost/trading/settingscustomergroup">
                                                                               <li class="list-group-item text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid icon-18 me-2">
                                                                                     <rect x="3" y="3" width="7" height="7"></rect>
                                                                                     <rect x="14" y="3" width="7" height="7"></rect>
                                                                                     <rect x="14" y="14" width="7" height="7"></rect>
                                                                                     <rect x="3" y="14" width="7" height="7"></rect>
                                                                                  </svg>
                                                                                  Customer Group <span class="float-end text-primary">5</span>
                                                                               </li>
                                                                            </a>
                                                                            <a class="client-widget-link" data-filter="has_completed_projects" href="http://localhost/trading/settingscustomertypedetails">
                                                                               <li class="list-group-item border-top text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
                                                                                     <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                                                     <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                                                  </svg>
                                                                                  Customer Type <span class="float-end text-success">7</span>
                                                                               </li>
                                                                            </a>
                                                                            <a class="client-widget-link" data-filter="has_any_hold_projects" href="http://localhost/trading/settingscustomercategorydetails">
                                                                               <li class="list-group-item border-top text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pause-circle icon-18 me-2">
                                                                                     <circle cx="12" cy="12" r="10"></circle>
                                                                                     <line x1="10" y1="15" x2="10" y2="9"></line>
                                                                                     <line x1="14" y1="15" x2="14" y2="9"></line>
                                                                                  </svg>
                                                                                  Customer Category <span class="float-end text-warning">4</span>
                                                                               </li>
                                                                            </a>

                                                                         </ul>
                                                                         <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                                         </div>
                                                                         <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                                         </div>
                                                                      </div>
                                                                   </div>
                                                                   <script>
                                                                       $(document).ready(function() {
                                                                           initScrollbar('#projects-container', {
                                                                               setHeight: 182
                                                                           });
                                                                       });
                                                                   </script>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                   <div class="card bg-white">
                                                                      <span class="p-4"><strong>Supplier Settings</strong></span>
                                                                      <div class="card-body pt0 rounded-bottom ps" id="projects-container" style="height: 182px; position: relative;">
                                                                         <ul class="list-group list-group-flush">
                                                                            <a class="client-widget-link" data-filter="has_open_projects" href="http://localhost/trading/settingssuppliergroup">
                                                                               <li class="list-group-item text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid icon-18 me-2">
                                                                                     <rect x="3" y="3" width="7" height="7"></rect>
                                                                                     <rect x="14" y="3" width="7" height="7"></rect>
                                                                                     <rect x="14" y="14" width="7" height="7"></rect>
                                                                                     <rect x="3" y="14" width="7" height="7"></rect>
                                                                                  </svg>
                                                                                  Supplier Group<span class="float-end text-primary">3</span>
                                                                               </li>
                                                                            </a>
                                                                            <a class="client-widget-link" data-filter="has_completed_projects" href="http://localhost/trading/settingssupplier_type">
                                                                               <li class="list-group-item border-top text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
                                                                                     <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                                                     <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                                                  </svg>
                                                                                 Supplier Type <span class="float-end text-success">3</span>
                                                                               </li>
                                                                            </a>
                                                                            <a class="client-widget-link" data-filter="has_any_hold_projects" href="http://localhost/trading/settingssuppliercategory">
                                                                               <li class="list-group-item border-top text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pause-circle icon-18 me-2">
                                                                                     <circle cx="12" cy="12" r="10"></circle>
                                                                                     <line x1="10" y1="15" x2="10" y2="9"></line>
                                                                                     <line x1="14" y1="15" x2="14" y2="9"></line>
                                                                                  </svg>
                                                                                  Supplier Category <span class="float-end text-warning">5</span>
                                                                               </li>
                                                                            </a>

                                                                         </ul>
                                                                         <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                                         </div>
                                                                         <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                                         </div>
                                                                      </div>
                                                                   </div>
                                                                   <script>
                                                                       $(document).ready(function() {
                                                                           initScrollbar('#projects-container', {
                                                                               setHeight: 182
                                                                           });
                                                                       });
                                                                   </script>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                   <div class="card bg-white">
                                                                      <span class="p-4"><strong>Customer Documents</strong></span>
                                                                      <div class="card-body pt0 rounded-bottom ps" id="projects-container" style="height: 182px; position: relative;">
                                                                         <ul class="list-group list-group-flush">
                                                                            <a class="client-widget-link" data-filter="has_open_projects" href="http://localhost/trading/crmcustomerdocuments">
                                                                               <li class="list-group-item text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid icon-18 me-2">
                                                                                     <rect x="3" y="3" width="7" height="7"></rect>
                                                                                     <rect x="14" y="3" width="7" height="7"></rect>
                                                                                     <rect x="14" y="14" width="7" height="7"></rect>
                                                                                     <rect x="3" y="14" width="7" height="7"></rect>
                                                                                  </svg>
                                                                                  Total Documents <span class="float-end text-primary">0</span>
                                                                               </li>
                                                                            </a>
                                                                            <a class="client-widget-link" data-filter="has_completed_projects" href="http://localhost/trading/crmcustomerdocuments">
                                                                               <li class="list-group-item border-top text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
                                                                                     <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                                                     <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                                                  </svg>
                                                                                  Total Active Documents <span class="float-end text-success">0</span>
                                                                               </li>
                                                                            </a>
                                                                            <a class="client-widget-link" data-filter="has_any_hold_projects" href="http://localhost/trading/crmcustomerdocuments">
                                                                               <li class="list-group-item border-top text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pause-circle icon-18 me-2">
                                                                                     <circle cx="12" cy="12" r="10"></circle>
                                                                                     <line x1="10" y1="15" x2="10" y2="9"></line>
                                                                                     <line x1="14" y1="15" x2="14" y2="9"></line>
                                                                                  </svg>
                                                                                  Total Expired Documents <span class="float-end text-warning">0</span>
                                                                               </li>
                                                                            </a>

                                                                         </ul>
                                                                         <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                                         </div>
                                                                         <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                                         </div>
                                                                      </div>
                                                                   </div>
                                                                   <script>
                                                                       $(document).ready(function() {
                                                                           initScrollbar('#projects-container', {
                                                                               setHeight: 182
                                                                           });
                                                                       });
                                                                   </script>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                   <div class="card bg-white">
                                                                      <span class="p-4"><strong>Supplier Documents</strong></span>
                                                                      <div class="card-body pt0 rounded-bottom ps" id="estiamte-widget-container" style="height: 182px; position: relative;">
                                                                         <ul class="list-group list-group-flush">
                                                                            <a class="client-widget-link" data-filter="has_open_estimates" href="http://localhost/trading/supplierdocuments">
                                                                               <li class="list-group-item text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box icon-18 me-2">
                                                                                     <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                                                                     <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                                                     <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                                                                  </svg>
                                                                                  Total documents <span class="float-end text-warning">0</span>
                                                                               </li>
                                                                            </a>
                                                                            <a class="client-widget-link" data-filter="has_accepted_estimates" href="http://localhost/trading/supplierdocuments">
                                                                               <li class="list-group-item border-top text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
                                                                                     <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                                                     <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                                                  </svg>
                                                                                  Total Active Documents <span class="float-end text-success">0</span>
                                                                               </li>
                                                                            </a>
                                                                            <a class="client-widget-link" data-filter="has_new_estimate_requests" href="http://localhost/trading/supplierdocuments">
                                                                               <li class="list-group-item border-top text-default">
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-droplet icon-18 me-2">
                                                                                     <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                                                                                  </svg>
                                                                                  Total Expired Documents <span class="float-end text-primary">0</span>
                                                                               </li>
                                                                            </a>

                                                                         </ul>
                                                                         <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                                         </div>
                                                                         <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                                         </div>
                                                                      </div>
                                                                   </div>
                                                                   <script>
                                                                       $(document).ready(function() {
                                                                           initScrollbar('#estiamte-widget-container', {
                                                                               setHeight: 182
                                                                           });
                                                                       });
                                                                   </script>
                                                                </div>


                                                             </div>-->



        <!--/Deen 23/03/2013 -->


        <br />




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
