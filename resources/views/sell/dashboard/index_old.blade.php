@extends('sell.common.layout')
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

<!--begin::Page Custom Styles(used by this page) -->
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/public/assets/css/pages/wizard/wizard-3.css" rel="stylesheet" type="text/css" />
<!--end::Page Custom Styles -->

<!--begin::Global Theme Styles(used by all pages) -->
<link href="{{url('/')}}/public/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/public/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

<!--end::Global Theme Styles -->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid ">


	<div class="kt-portlet">
		<div class="kt-portlet__body kt-portlet__body--fit">
			<div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
				<div class="kt-grid__item">

					<!--begin: Form Wizard Nav -->
					<div class="kt-wizard-v3__nav border border-0">

						<!--doc: Remove "kt-wizard-v3__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
						<div class="kt-wizard-v3__nav-items kt-wizard-v3__nav-items--clickable pl-2">
							<div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
								<div class="kt-wizard-v3__nav-body pb-0">
									<div class="kt-wizard-v3__nav-label">
										<!-- <span>1</span> --> Over View
									</div>
									<div class="kt-wizard-v3__nav-bar"></div>
								</div>
							</div>
							<div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v3__nav-body pb-0">
									<div class="kt-wizard-v3__nav-label">
										<!-- <span>2</span> --> Client
									</div>
									<div class="kt-wizard-v3__nav-bar"></div>
								</div>
							</div>
							<div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v3__nav-body pb-0">
									<div class="kt-wizard-v3__nav-label">
										<!-- <span>3</span> --> Supplier
									</div>
									<div class="kt-wizard-v3__nav-bar"></div>
								</div>
							</div>
							<div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v3__nav-body pb-0">
									<div class="kt-wizard-v3__nav-label">
										<!-- <span>3</span> --> Vendor
									</div>
									<div class="kt-wizard-v3__nav-bar"></div>
								</div>
							</div>
							<div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v3__nav-body pb-0">
									<div class="kt-wizard-v3__nav-label">
										<!-- <span>3</span> --> SKM
									</div>
									<div class="kt-wizard-v3__nav-bar"></div>
								</div>
							</div>
							<!-- <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
														<div class="kt-wizard-v3__nav-body">
															<div class="kt-wizard-v3__nav-label">
																<span>4</span> Delivery Address
															</div>
															<div class="kt-wizard-v3__nav-bar"></div>
														</div>
													</div> -->
							<!-- <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
														<div class="kt-wizard-v3__nav-body">
															<div class="kt-wizard-v3__nav-label">
																<span>5</span> Review and Submit
															</div>
															<div class="kt-wizard-v3__nav-bar"></div>
														</div>
													</div> -->

						</div>
						<hr style="height: 15px;
							                     background-color: #f2f3f8;
							                     width: 100%;
							                     position: absolute;
							                     left: 0;
							                     border: 0;" />
					</div>

					<!--end: Form Wizard Nav -->
				</div>
				<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper" style="background-color: #f2f3f8;">

					<!--begin: Form Wizard Form-->
					<form class="kt-form" id="kt_form" style="width: 100%; padding:0;">

						<!--begin: Form Wizard Step 1-->
						<div class="kt-wizard-v3__content fadeIn" data-ktwizard-type="step-content" data-ktwizard-state="current">
							<div class="row mt-3">
								<div class="col-md-3">
									<a href="#" class="white-link">
										<div class="card  dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase icon">
														<rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
														<path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>{{$activecustomers}}</h1>
													<span>Total Customers</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a href="#" class="white-link">
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
													<h1>{{$activesuppliers}}</h1>
													<span>Total Suppliers</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a class="contact-widget-link" data-filter="logged_in_today" href="#y">
										<div class="card dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon">
														<polyline points="9 11 12 14 22 4"></polyline>
														<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>{{$activevendors}}</h1>
													<span>Total Vendors</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a class="contact-widget-link" data-filter="logged_in_seven_days" href="#">
										<div class="card dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-info">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon">
														<polyline points="9 11 12 14 22 4"></polyline>
														<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>{{$activesalesmen}}</h1>
													<span>Total Salesmen</span>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>


							<div class="row mt-3">
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_unpaid_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has unpaid invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-orange" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_partially_paid_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has partially paid invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">33% of total clients</span>
													<h1 class="float-end m0 text-default">1</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="33%">
													<div class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_overdue_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has overdue invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>



							<div class="row mt-3">
								<div class="col-md-6 mb-3">
									<div class="card bg-white">
										<span class="p-4">Projects</span>
										<div class="card-body pt0 rounded-bottom ps" id="projects-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_projects" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid icon-18 me-2">
															<rect x="3" y="3" width="7" height="7"></rect>
															<rect x="14" y="3" width="7" height="7"></rect>
															<rect x="14" y="14" width="7" height="7"></rect>
															<rect x="3" y="14" width="7" height="7"></rect>
														</svg>
														Clients has open projects <span class="float-end text-primary">2</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_completed_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has completed projects <span class="float-end text-success">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_any_hold_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pause-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="10" y1="15" x2="10" y2="9"></line>
															<line x1="14" y1="15" x2="14" y2="9"></line>
														</svg>
														Clients has hold projects <span class="float-end text-warning">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_canceled_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="15" y1="9" x2="9" y2="15"></line>
															<line x1="9" y1="9" x2="15" y2="15"></line>
														</svg>
														Clients has canceled projects <span class="float-end text-danger">0</span>
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

								</div>
								<div class="col-md-6 mb-3">
									<div class="card bg-white">
										<span class="p-4">Estimates</span>
										<div class="card-body pt0 rounded-bottom ps" id="estiamte-widget-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_estimates" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box icon-18 me-2">
															<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
															<polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
															<line x1="12" y1="22.08" x2="12" y2="12"></line>
														</svg>
														Client has open estimates <span class="float-end text-warning">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_accepted_estimates" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has accepted estimates <span class="float-end text-success">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_new_estimate_requests" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-droplet icon-18 me-2">
															<path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
														</svg>
														Clients has new estimate requests <span class="float-end text-primary">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_estimate_requests_in_progress" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader icon-18 me-2">
															<line x1="12" y1="2" x2="12" y2="6"></line>
															<line x1="12" y1="18" x2="12" y2="22"></line>
															<line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
															<line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
															<line x1="2" y1="12" x2="6" y2="12"></line>
															<line x1="18" y1="12" x2="22" y2="12"></line>
															<line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
															<line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
														</svg>
														Clients has estimate requests in progress <span class="float-end text-success">0</span>
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

								</div>
								<div class="col-md-6">
									<a class="client-widget-link " data-filter="has_open_tickets" href="#">
										<div class="card  pb-3">
											<div class="card-body">
												<div class="widget-title p0 text-default">
													<strong>Clients has open tickets</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
									<br><br>
									<a class="client-widget-link" data-filter="has_new_orders" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has new orders</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">33% of total clients</span>
													<h1 class="float-end m0 text-default">1</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="33%">
													<div class="progress-bar bg-orange" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-6">
									<div class="card bg-white">
										<span class="p-4">Proposals</span>
										<div class="card-body pt0 rounded-bottom ps" id="proposals-widget-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_proposals" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee icon-18 me-2">
															<path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
															<path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
															<line x1="6" y1="1" x2="6" y2="4"></line>
															<line x1="10" y1="1" x2="10" y2="4"></line>
															<line x1="14" y1="1" x2="14" y2="4"></line>
														</svg>
														Clients has open proposals <span class="float-end text-warning">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_accepted_proposals" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has accepted proposals <span class="float-end text-success">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_rejected_proposals" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="15" y1="9" x2="9" y2="15"></line>
															<line x1="9" y1="9" x2="15" y2="15"></line>
														</svg>
														Clients has rejected proposals <span class="float-end text-danger">0</span>
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

								</div>
							</div>
							<!-- <div class="kt-heading kt-heading--md">Setup Your Current Location</div> -->
							<!-- <div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v3__form">
															<div class="form-group">
																<label>Address Line 1</label>
																<input type="text" class="form-control" name="address1" placeholder="Address Line 1" value="Address Line 1">
																<span class="form-text text-muted">Please enter your Address.</span>
															</div>
															<div class="form-group">
																<label>Address Line 2</label>
																<input type="text" class="form-control" name="address2" placeholder="Address Line 2" value="Address Line 2">
																<span class="form-text text-muted">Please enter your Address.</span>
															</div>
															<div class="row">
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Postcode</label>
																		<input type="text" class="form-control" name="postcode" placeholder="Postcode" value="3000">
																		<span class="form-text text-muted">Please enter your Postcode.</span>
																	</div>
																</div>
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>City</label>
																		<input type="text" class="form-control" name="city" placeholder="City" value="Melbourne">
																		<span class="form-text text-muted">Please enter your City.</span>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>State</label>
																		<input type="text" class="form-control" name="state" placeholder="State" value="VIC">
																		<span class="form-text text-muted">Please enter your Postcode.</span>
																	</div>
																</div>
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Country:</label>
																		<select name="country" class="form-control">
																			<option value="">Select</option>
																			<option value="AF">Afghanistan</option>
																			<option value="AX">Åland Islands</option>
																			<option value="AL">Albania</option>
																			<option value="DZ">Algeria</option>
																			<option value="AS">American Samoa</option>
																			<option value="AD">Andorra</option>
																			<option value="AO">Angola</option>
																			<option value="AI">Anguilla</option>
																			<option value="AQ">Antarctica</option>
																			<option value="AG">Antigua and Barbuda</option>
																			<option value="AR">Argentina</option>
																			<option value="AM">Armenia</option>
																			<option value="AW">Aruba</option>
																			<option value="AU" selected>Australia</option>
																			<option value="AT">Austria</option>
																			<option value="AZ">Azerbaijan</option>
																			<option value="BS">Bahamas</option>
																			<option value="BH">Bahrain</option>
																			<option value="BD">Bangladesh</option>
																			<option value="BB">Barbados</option>
																			<option value="BY">Belarus</option>
																			<option value="BE">Belgium</option>
																			<option value="BZ">Belize</option>
																			<option value="BJ">Benin</option>
																			<option value="BM">Bermuda</option>
																			<option value="BT">Bhutan</option>
																			<option value="BO">Bolivia, Plurinational State of</option>
																			<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
																			<option value="BA">Bosnia and Herzegovina</option>
																			<option value="BW">Botswana</option>
																			<option value="BV">Bouvet Island</option>
																			<option value="BR">Brazil</option>
																			<option value="IO">British Indian Ocean Territory</option>
																			<option value="BN">Brunei Darussalam</option>
																			<option value="BG">Bulgaria</option>
																			<option value="BF">Burkina Faso</option>
																			<option value="BI">Burundi</option>
																			<option value="KH">Cambodia</option>
																			<option value="CM">Cameroon</option>
																			<option value="CA">Canada</option>
																			<option value="CV">Cape Verde</option>
																			<option value="KY">Cayman Islands</option>
																			<option value="CF">Central African Republic</option>
																			<option value="TD">Chad</option>
																			<option value="CL">Chile</option>
																			<option value="CN">China</option>
																			<option value="CX">Christmas Island</option>
																			<option value="CC">Cocos (Keeling) Islands</option>
																			<option value="CO">Colombia</option>
																			<option value="KM">Comoros</option>
																			<option value="CG">Congo</option>
																			<option value="CD">Congo, the Democratic Republic of the</option>
																			<option value="CK">Cook Islands</option>
																			<option value="CR">Costa Rica</option>
																			<option value="CI">Côte d'Ivoire</option>
																			<option value="HR">Croatia</option>
																			<option value="CU">Cuba</option>
																			<option value="CW">Curaçao</option>
																			<option value="CY">Cyprus</option>
																			<option value="CZ">Czech Republic</option>
																			<option value="DK">Denmark</option>
																			<option value="DJ">Djibouti</option>
																			<option value="DM">Dominica</option>
																			<option value="DO">Dominican Republic</option>
																			<option value="EC">Ecuador</option>
																			<option value="EG">Egypt</option>
																			<option value="SV">El Salvador</option>
																			<option value="GQ">Equatorial Guinea</option>
																			<option value="ER">Eritrea</option>
																			<option value="EE">Estonia</option>
																			<option value="ET">Ethiopia</option>
																			<option value="FK">Falkland Islands (Malvinas)</option>
																			<option value="FO">Faroe Islands</option>
																			<option value="FJ">Fiji</option>
																			<option value="FI">Finland</option>
																			<option value="FR">France</option>
																			<option value="GF">French Guiana</option>
																			<option value="PF">French Polynesia</option>
																			<option value="TF">French Southern Territories</option>
																			<option value="GA">Gabon</option>
																			<option value="GM">Gambia</option>
																			<option value="GE">Georgia</option>
																			<option value="DE">Germany</option>
																			<option value="GH">Ghana</option>
																			<option value="GI">Gibraltar</option>
																			<option value="GR">Greece</option>
																			<option value="GL">Greenland</option>
																			<option value="GD">Grenada</option>
																			<option value="GP">Guadeloupe</option>
																			<option value="GU">Guam</option>
																			<option value="GT">Guatemala</option>
																			<option value="GG">Guernsey</option>
																			<option value="GN">Guinea</option>
																			<option value="GW">Guinea-Bissau</option>
																			<option value="GY">Guyana</option>
																			<option value="HT">Haiti</option>
																			<option value="HM">Heard Island and McDonald Islands</option>
																			<option value="VA">Holy See (Vatican City State)</option>
																			<option value="HN">Honduras</option>
																			<option value="HK">Hong Kong</option>
																			<option value="HU">Hungary</option>
																			<option value="IS">Iceland</option>
																			<option value="IN">India</option>
																			<option value="ID">Indonesia</option>
																			<option value="IR">Iran, Islamic Republic of</option>
																			<option value="IQ">Iraq</option>
																			<option value="IE">Ireland</option>
																			<option value="IM">Isle of Man</option>
																			<option value="IL">Israel</option>
																			<option value="IT">Italy</option>
																			<option value="JM">Jamaica</option>
																			<option value="JP">Japan</option>
																			<option value="JE">Jersey</option>
																			<option value="JO">Jordan</option>
																			<option value="KZ">Kazakhstan</option>
																			<option value="KE">Kenya</option>
																			<option value="KI">Kiribati</option>
																			<option value="KP">Korea, Democratic People's Republic of</option>
																			<option value="KR">Korea, Republic of</option>
																			<option value="KW">Kuwait</option>
																			<option value="KG">Kyrgyzstan</option>
																			<option value="LA">Lao People's Democratic Republic</option>
																			<option value="LV">Latvia</option>
																			<option value="LB">Lebanon</option>
																			<option value="LS">Lesotho</option>
																			<option value="LR">Liberia</option>
																			<option value="LY">Libya</option>
																			<option value="LI">Liechtenstein</option>
																			<option value="LT">Lithuania</option>
																			<option value="LU">Luxembourg</option>
																			<option value="MO">Macao</option>
																			<option value="MK">Macedonia, the former Yugoslav Republic of</option>
																			<option value="MG">Madagascar</option>
																			<option value="MW">Malawi</option>
																			<option value="MY">Malaysia</option>
																			<option value="MV">Maldives</option>
																			<option value="ML">Mali</option>
																			<option value="MT">Malta</option>
																			<option value="MH">Marshall Islands</option>
																			<option value="MQ">Martinique</option>
																			<option value="MR">Mauritania</option>
																			<option value="MU">Mauritius</option>
																			<option value="YT">Mayotte</option>
																			<option value="MX">Mexico</option>
																			<option value="FM">Micronesia, Federated States of</option>
																			<option value="MD">Moldova, Republic of</option>
																			<option value="MC">Monaco</option>
																			<option value="MN">Mongolia</option>
																			<option value="ME">Montenegro</option>
																			<option value="MS">Montserrat</option>
																			<option value="MA">Morocco</option>
																			<option value="MZ">Mozambique</option>
																			<option value="MM">Myanmar</option>
																			<option value="NA">Namibia</option>
																			<option value="NR">Nauru</option>
																			<option value="NP">Nepal</option>
																			<option value="NL">Netherlands</option>
																			<option value="NC">New Caledonia</option>
																			<option value="NZ">New Zealand</option>
																			<option value="NI">Nicaragua</option>
																			<option value="NE">Niger</option>
																			<option value="NG">Nigeria</option>
																			<option value="NU">Niue</option>
																			<option value="NF">Norfolk Island</option>
																			<option value="MP">Northern Mariana Islands</option>
																			<option value="NO">Norway</option>
																			<option value="OM">Oman</option>
																			<option value="PK">Pakistan</option>
																			<option value="PW">Palau</option>
																			<option value="PS">Palestinian Territory, Occupied</option>
																			<option value="PA">Panama</option>
																			<option value="PG">Papua New Guinea</option>
																			<option value="PY">Paraguay</option>
																			<option value="PE">Peru</option>
																			<option value="PH">Philippines</option>
																			<option value="PN">Pitcairn</option>
																			<option value="PL">Poland</option>
																			<option value="PT">Portugal</option>
																			<option value="PR">Puerto Rico</option>
																			<option value="QA">Qatar</option>
																			<option value="RE">Réunion</option>
																			<option value="RO">Romania</option>
																			<option value="RU">Russian Federation</option>
																			<option value="RW">Rwanda</option>
																			<option value="BL">Saint Barthélemy</option>
																			<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
																			<option value="KN">Saint Kitts and Nevis</option>
																			<option value="LC">Saint Lucia</option>
																			<option value="MF">Saint Martin (French part)</option>
																			<option value="PM">Saint Pierre and Miquelon</option>
																			<option value="VC">Saint Vincent and the Grenadines</option>
																			<option value="WS">Samoa</option>
																			<option value="SM">San Marino</option>
																			<option value="ST">Sao Tome and Principe</option>
																			<option value="SA">Saudi Arabia</option>
																			<option value="SN">Senegal</option>
																			<option value="RS">Serbia</option>
																			<option value="SC">Seychelles</option>
																			<option value="SL">Sierra Leone</option>
																			<option value="SG">Singapore</option>
																			<option value="SX">Sint Maarten (Dutch part)</option>
																			<option value="SK">Slovakia</option>
																			<option value="SI">Slovenia</option>
																			<option value="SB">Solomon Islands</option>
																			<option value="SO">Somalia</option>
																			<option value="ZA">South Africa</option>
																			<option value="GS">South Georgia and the South Sandwich Islands</option>
																			<option value="SS">South Sudan</option>
																			<option value="ES">Spain</option>
																			<option value="LK">Sri Lanka</option>
																			<option value="SD">Sudan</option>
																			<option value="SR">Suriname</option>
																			<option value="SJ">Svalbard and Jan Mayen</option>
																			<option value="SZ">Swaziland</option>
																			<option value="SE">Sweden</option>
																			<option value="CH">Switzerland</option>
																			<option value="SY">Syrian Arab Republic</option>
																			<option value="TW">Taiwan, Province of China</option>
																			<option value="TJ">Tajikistan</option>
																			<option value="TZ">Tanzania, United Republic of</option>
																			<option value="TH">Thailand</option>
																			<option value="TL">Timor-Leste</option>
																			<option value="TG">Togo</option>
																			<option value="TK">Tokelau</option>
																			<option value="TO">Tonga</option>
																			<option value="TT">Trinidad and Tobago</option>
																			<option value="TN">Tunisia</option>
																			<option value="TR">Turkey</option>
																			<option value="TM">Turkmenistan</option>
																			<option value="TC">Turks and Caicos Islands</option>
																			<option value="TV">Tuvalu</option>
																			<option value="UG">Uganda</option>
																			<option value="UA">Ukraine</option>
																			<option value="AE">United Arab Emirates</option>
																			<option value="GB">United Kingdom</option>
																			<option value="US">United States</option>
																			<option value="UM">United States Minor Outlying Islands</option>
																			<option value="UY">Uruguay</option>
																			<option value="UZ">Uzbekistan</option>
																			<option value="VU">Vanuatu</option>
																			<option value="VE">Venezuela, Bolivarian Republic of</option>
																			<option value="VN">Viet Nam</option>
																			<option value="VG">Virgin Islands, British</option>
																			<option value="VI">Virgin Islands, U.S.</option>
																			<option value="WF">Wallis and Futuna</option>
																			<option value="EH">Western Sahara</option>
																			<option value="YE">Yemen</option>
																			<option value="ZM">Zambia</option>
																			<option value="ZW">Zimbabwe</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div> -->
						</div>

						<!--end: Form Wizard Step 1-->

						<!--begin: Form Wizard Step 2-->
						<div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
							<div class="row mt-3">
								<div class="col-md-3">
									<a href="#" class="white-link">
										<div class="card  dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase icon">
														<rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
														<path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>{{$customers}}</h1>
													<span>Total clients</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a href="#" class="white-link">
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
													<h1>{{$activecustomers}}</h1>
													<span>Active Clients</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a class="contact-widget-link" data-filter="logged_in_today" href="#y">
										<div class="card dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon">
														<polyline points="9 11 12 14 22 4"></polyline>
														<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>1</h1>
													<span>Contacts logged in today</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a class="contact-widget-link" data-filter="logged_in_seven_days" href="#">
										<div class="card dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-info">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon">
														<polyline points="9 11 12 14 22 4"></polyline>
														<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>1</h1>
													<span>Contacts logged in last 7 days</span>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>


							<div class="row mt-3">
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_unpaid_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has unpaid invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-orange" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_partially_paid_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has partially paid invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">33% of total clients</span>
													<h1 class="float-end m0 text-default">1</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="33%">
													<div class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_overdue_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has overdue invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>



							<div class="row mt-3">
								<div class="col-md-6 mb-3">
									<div class="card bg-white">
										<span class="p-4">Projects</span>
										<div class="card-body pt0 rounded-bottom ps" id="projects-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_projects" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid icon-18 me-2">
															<rect x="3" y="3" width="7" height="7"></rect>
															<rect x="14" y="3" width="7" height="7"></rect>
															<rect x="14" y="14" width="7" height="7"></rect>
															<rect x="3" y="14" width="7" height="7"></rect>
														</svg>
														Clients has open projects <span class="float-end text-primary">2</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_completed_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has completed projects <span class="float-end text-success">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_any_hold_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pause-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="10" y1="15" x2="10" y2="9"></line>
															<line x1="14" y1="15" x2="14" y2="9"></line>
														</svg>
														Clients has hold projects <span class="float-end text-warning">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_canceled_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="15" y1="9" x2="9" y2="15"></line>
															<line x1="9" y1="9" x2="15" y2="15"></line>
														</svg>
														Clients has canceled projects <span class="float-end text-danger">0</span>
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

								</div>
								<div class="col-md-6 mb-3">
									<div class="card bg-white">
										<span class="p-4">Estimates</span>
										<div class="card-body pt0 rounded-bottom ps" id="estiamte-widget-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_estimates" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box icon-18 me-2">
															<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
															<polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
															<line x1="12" y1="22.08" x2="12" y2="12"></line>
														</svg>
														Client has open estimates <span class="float-end text-warning">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_accepted_estimates" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has accepted estimates <span class="float-end text-success">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_new_estimate_requests" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-droplet icon-18 me-2">
															<path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
														</svg>
														Clients has new estimate requests <span class="float-end text-primary">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_estimate_requests_in_progress" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader icon-18 me-2">
															<line x1="12" y1="2" x2="12" y2="6"></line>
															<line x1="12" y1="18" x2="12" y2="22"></line>
															<line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
															<line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
															<line x1="2" y1="12" x2="6" y2="12"></line>
															<line x1="18" y1="12" x2="22" y2="12"></line>
															<line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
															<line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
														</svg>
														Clients has estimate requests in progress <span class="float-end text-success">0</span>
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

								</div>
								<div class="col-md-6">
									<a class="client-widget-link " data-filter="has_open_tickets" href="#">
										<div class="card  pb-3">
											<div class="card-body">
												<div class="widget-title p0 text-default">
													<strong>Clients has open tickets</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
									<br><br>
									<a class="client-widget-link" data-filter="has_new_orders" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has new orders</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">33% of total clients</span>
													<h1 class="float-end m0 text-default">1</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="33%">
													<div class="progress-bar bg-orange" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-6">
									<div class="card bg-white">
										<span class="p-4">Proposals</span>
										<div class="card-body pt0 rounded-bottom ps" id="proposals-widget-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_proposals" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee icon-18 me-2">
															<path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
															<path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
															<line x1="6" y1="1" x2="6" y2="4"></line>
															<line x1="10" y1="1" x2="10" y2="4"></line>
															<line x1="14" y1="1" x2="14" y2="4"></line>
														</svg>
														Clients has open proposals <span class="float-end text-warning">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_accepted_proposals" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has accepted proposals <span class="float-end text-success">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_rejected_proposals" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="15" y1="9" x2="9" y2="15"></line>
															<line x1="9" y1="9" x2="15" y2="15"></line>
														</svg>
														Clients has rejected proposals <span class="float-end text-danger">0</span>
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

								</div>
							</div>





							<!-- <div class="kt-heading kt-heading--md">Enter the Details of your Delivery</div> -->
							<!-- <div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v3__form">
															<div class="form-group">
																<label>Package Details</label>
																<input type="text" class="form-control" name="package" placeholder="Package Details" value="Complete Workstation (Monitor, Computer, Keyboard & Mouse)">
																<span class="form-text text-muted">Please enter your Pakcage Details.</span>
															</div>
															<div class="form-group">
																<label>Package Weight in KG</label>
																<input type="text" class="form-control" name="weight" placeholder="Package Weight" value="25">
																<span class="form-text text-muted">Please enter your Package Weight in KG.</span>
															</div>
															<div class="kt-wizard-v3__form-label">Package Dimensions</div>
															<div class="row">
																<div class="col-xl-4">
																	<div class="form-group">
																		<label>Package Width in CM</label>
																		<input type="text" class="form-control" name="width" placeholder="Package Width" value="110">
																		<span class="form-text text-muted">Please enter your Package Width in CM.</span>
																	</div>
																</div>
																<div class="col-xl-4">
																	<div class="form-group">
																		<label>Package Height in CM</label>
																		<input type="text" class="form-control" name="height" placeholder="Package Length" value="90">
																		<span class="form-text text-muted">Please enter your Package Width in CM.</span>
																	</div>
																</div>
																<div class="col-xl-4">
																	<div class="form-group">
																		<label>Package Length in CM</label>
																		<input type="text" class="form-control" name="length" placeholder="Package Length" value="150">
																		<span class="form-text text-muted">Please enter your Package Length in CM.</span>
																	</div>
																</div>
															</div>
														</div>
													</div> -->
						</div>

						<!--end: Form Wizard Step 2-->

						<!--begin: Form Wizard Step 3-->
						<div class="kt-wizard-v3__content  fadeIn" data-ktwizard-type="step-content">
							<div class="row mt-3">
								<div class="col-md-3">
									<a href="#" class="white-link">
										<div class="card  dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase icon">
														<rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
														<path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>{{$suppliers}}</h1>
													<span>Total Suppliers</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a href="#" class="white-link">
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
													<h1>{{$activesuppliers}}</h1>
													<span>Active Suppliers</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a class="contact-widget-link" data-filter="logged_in_today" href="#y">
										<div class="card dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon">
														<polyline points="9 11 12 14 22 4"></polyline>
														<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>1</h1>
													<span>Contacts logged in today</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a class="contact-widget-link" data-filter="logged_in_seven_days" href="#">
										<div class="card dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-info">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon">
														<polyline points="9 11 12 14 22 4"></polyline>
														<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>1</h1>
													<span>Contacts logged in last 7 days</span>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>


							<div class="row mt-3">
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_unpaid_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has unpaid invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-orange" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_partially_paid_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has partially paid invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">33% of total clients</span>
													<h1 class="float-end m0 text-default">1</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="33%">
													<div class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_overdue_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has overdue invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>



							<div class="row mt-3">
								<div class="col-md-6 mb-3">
									<div class="card bg-white">
										<span class="p-4">Projects</span>
										<div class="card-body pt0 rounded-bottom ps" id="projects-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_projects" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid icon-18 me-2">
															<rect x="3" y="3" width="7" height="7"></rect>
															<rect x="14" y="3" width="7" height="7"></rect>
															<rect x="14" y="14" width="7" height="7"></rect>
															<rect x="3" y="14" width="7" height="7"></rect>
														</svg>
														Clients has open projects <span class="float-end text-primary">2</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_completed_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has completed projects <span class="float-end text-success">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_any_hold_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pause-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="10" y1="15" x2="10" y2="9"></line>
															<line x1="14" y1="15" x2="14" y2="9"></line>
														</svg>
														Clients has hold projects <span class="float-end text-warning">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_canceled_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="15" y1="9" x2="9" y2="15"></line>
															<line x1="9" y1="9" x2="15" y2="15"></line>
														</svg>
														Clients has canceled projects <span class="float-end text-danger">0</span>
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

								</div>
								<div class="col-md-6 mb-3">
									<div class="card bg-white">
										<span class="p-4">Estimates</span>
										<div class="card-body pt0 rounded-bottom ps" id="estiamte-widget-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_estimates" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box icon-18 me-2">
															<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
															<polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
															<line x1="12" y1="22.08" x2="12" y2="12"></line>
														</svg>
														Client has open estimates <span class="float-end text-warning">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_accepted_estimates" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has accepted estimates <span class="float-end text-success">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_new_estimate_requests" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-droplet icon-18 me-2">
															<path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
														</svg>
														Clients has new estimate requests <span class="float-end text-primary">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_estimate_requests_in_progress" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader icon-18 me-2">
															<line x1="12" y1="2" x2="12" y2="6"></line>
															<line x1="12" y1="18" x2="12" y2="22"></line>
															<line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
															<line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
															<line x1="2" y1="12" x2="6" y2="12"></line>
															<line x1="18" y1="12" x2="22" y2="12"></line>
															<line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
															<line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
														</svg>
														Clients has estimate requests in progress <span class="float-end text-success">0</span>
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

								</div>
								<div class="col-md-6">
									<a class="client-widget-link " data-filter="has_open_tickets" href="#">
										<div class="card  pb-3">
											<div class="card-body">
												<div class="widget-title p0 text-default">
													<strong>Clients has open tickets</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
									<br><br>
									<a class="client-widget-link" data-filter="has_new_orders" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has new orders</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">33% of total clients</span>
													<h1 class="float-end m0 text-default">1</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="33%">
													<div class="progress-bar bg-orange" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-6">
									<div class="card bg-white">
										<span class="p-4">Proposals</span>
										<div class="card-body pt0 rounded-bottom ps" id="proposals-widget-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_proposals" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee icon-18 me-2">
															<path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
															<path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
															<line x1="6" y1="1" x2="6" y2="4"></line>
															<line x1="10" y1="1" x2="10" y2="4"></line>
															<line x1="14" y1="1" x2="14" y2="4"></line>
														</svg>
														Clients has open proposals <span class="float-end text-warning">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_accepted_proposals" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has accepted proposals <span class="float-end text-success">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_rejected_proposals" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="15" y1="9" x2="9" y2="15"></line>
															<line x1="9" y1="9" x2="15" y2="15"></line>
														</svg>
														Clients has rejected proposals <span class="float-end text-danger">0</span>
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

								</div>
							</div>
						</div>


						<div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
							<div class="row mt-3">
								<div class="col-md-3">
									<a href="#" class="white-link">
										<div class="card  dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase icon">
														<rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
														<path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>{{$vendors}}</h1>
													<span>Total Vendors</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a href="#" class="white-link">
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
													<h1>{{$activevendors}}</h1>
													<span>Active Vendors</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a class="contact-widget-link" data-filter="logged_in_today" href="#y">
										<div class="card dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon">
														<polyline points="9 11 12 14 22 4"></polyline>
														<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>1</h1>
													<span>Contacts logged in today</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a class="contact-widget-link" data-filter="logged_in_seven_days" href="#">
										<div class="card dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-info">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon">
														<polyline points="9 11 12 14 22 4"></polyline>
														<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>1</h1>
													<span>Contacts logged in last 7 days</span>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>


							<div class="row mt-3">
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_unpaid_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has unpaid invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-orange" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_partially_paid_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has partially paid invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">33% of total clients</span>
													<h1 class="float-end m0 text-default">1</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="33%">
													<div class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_overdue_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has overdue invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>



							<div class="row mt-3">
								<div class="col-md-6 mb-3">
									<div class="card bg-white">
										<span class="p-4">Projects</span>
										<div class="card-body pt0 rounded-bottom ps" id="projects-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_projects" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid icon-18 me-2">
															<rect x="3" y="3" width="7" height="7"></rect>
															<rect x="14" y="3" width="7" height="7"></rect>
															<rect x="14" y="14" width="7" height="7"></rect>
															<rect x="3" y="14" width="7" height="7"></rect>
														</svg>
														Clients has open projects <span class="float-end text-primary">2</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_completed_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has completed projects <span class="float-end text-success">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_any_hold_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pause-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="10" y1="15" x2="10" y2="9"></line>
															<line x1="14" y1="15" x2="14" y2="9"></line>
														</svg>
														Clients has hold projects <span class="float-end text-warning">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_canceled_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="15" y1="9" x2="9" y2="15"></line>
															<line x1="9" y1="9" x2="15" y2="15"></line>
														</svg>
														Clients has canceled projects <span class="float-end text-danger">0</span>
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

								</div>
								<div class="col-md-6 mb-3">
									<div class="card bg-white">
										<span class="p-4">Estimates</span>
										<div class="card-body pt0 rounded-bottom ps" id="estiamte-widget-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_estimates" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box icon-18 me-2">
															<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
															<polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
															<line x1="12" y1="22.08" x2="12" y2="12"></line>
														</svg>
														Client has open estimates <span class="float-end text-warning">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_accepted_estimates" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has accepted estimates <span class="float-end text-success">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_new_estimate_requests" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-droplet icon-18 me-2">
															<path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
														</svg>
														Clients has new estimate requests <span class="float-end text-primary">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_estimate_requests_in_progress" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader icon-18 me-2">
															<line x1="12" y1="2" x2="12" y2="6"></line>
															<line x1="12" y1="18" x2="12" y2="22"></line>
															<line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
															<line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
															<line x1="2" y1="12" x2="6" y2="12"></line>
															<line x1="18" y1="12" x2="22" y2="12"></line>
															<line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
															<line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
														</svg>
														Clients has estimate requests in progress <span class="float-end text-success">0</span>
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

								</div>
								<div class="col-md-6">
									<a class="client-widget-link " data-filter="has_open_tickets" href="#">
										<div class="card  pb-3">
											<div class="card-body">
												<div class="widget-title p0 text-default">
													<strong>Clients has open tickets</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
									<br><br>
									<a class="client-widget-link" data-filter="has_new_orders" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has new orders</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">33% of total clients</span>
													<h1 class="float-end m0 text-default">1</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="33%">
													<div class="progress-bar bg-orange" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-6">
									<div class="card bg-white">
										<span class="p-4">Proposals</span>
										<div class="card-body pt0 rounded-bottom ps" id="proposals-widget-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_proposals" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee icon-18 me-2">
															<path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
															<path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
															<line x1="6" y1="1" x2="6" y2="4"></line>
															<line x1="10" y1="1" x2="10" y2="4"></line>
															<line x1="14" y1="1" x2="14" y2="4"></line>
														</svg>
														Clients has open proposals <span class="float-end text-warning">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_accepted_proposals" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has accepted proposals <span class="float-end text-success">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_rejected_proposals" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="15" y1="9" x2="9" y2="15"></line>
															<line x1="9" y1="9" x2="15" y2="15"></line>
														</svg>
														Clients has rejected proposals <span class="float-end text-danger">0</span>
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

								</div>
							</div>
						</div>


						<div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
							<div class="row mt-3">
								<div class="col-md-3">
									<a href="#" class="white-link">
										<div class="card  dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase icon">
														<rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
														<path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>{{$salesmen}}</h1>
													<span>Total Salesmen</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a href="#" class="white-link">
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
													<h1>{{$activesalesmen}}</h1>
													<span>Active Salesmen</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a class="contact-widget-link" data-filter="logged_in_today" href="#y">
										<div class="card dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon">
														<polyline points="9 11 12 14 22 4"></polyline>
														<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>1</h1>
													<span>Contacts logged in today</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-3">
									<a class="contact-widget-link" data-filter="logged_in_seven_days" href="#">
										<div class="card dashboard-icon-widget">
											<div class="card-body">
												<div class="widget-icon bg-info">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon">
														<polyline points="9 11 12 14 22 4"></polyline>
														<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
													</svg>
												</div>
												<div class="widget-details">
													<h1>1</h1>
													<span>Contacts logged in last 7 days</span>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>


							<div class="row mt-3">
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_unpaid_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has unpaid invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-orange" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_partially_paid_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has partially paid invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">33% of total clients</span>
													<h1 class="float-end m0 text-default">1</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="33%">
													<div class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-4">
									<a class="client-widget-link" data-filter="has_overdue_invoices" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has overdue invoices</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>



							<div class="row mt-3">
								<div class="col-md-6 mb-3">
									<div class="card bg-white">
										<span class="p-4">Projects</span>
										<div class="card-body pt0 rounded-bottom ps" id="projects-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_projects" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid icon-18 me-2">
															<rect x="3" y="3" width="7" height="7"></rect>
															<rect x="14" y="3" width="7" height="7"></rect>
															<rect x="14" y="14" width="7" height="7"></rect>
															<rect x="3" y="14" width="7" height="7"></rect>
														</svg>
														Clients has open projects <span class="float-end text-primary">2</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_completed_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has completed projects <span class="float-end text-success">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_any_hold_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pause-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="10" y1="15" x2="10" y2="9"></line>
															<line x1="14" y1="15" x2="14" y2="9"></line>
														</svg>
														Clients has hold projects <span class="float-end text-warning">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_canceled_projects" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="15" y1="9" x2="9" y2="15"></line>
															<line x1="9" y1="9" x2="15" y2="15"></line>
														</svg>
														Clients has canceled projects <span class="float-end text-danger">0</span>
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

								</div>
								<div class="col-md-6 mb-3">
									<div class="card bg-white">
										<span class="p-4">Estimates</span>
										<div class="card-body pt0 rounded-bottom ps" id="estiamte-widget-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_estimates" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box icon-18 me-2">
															<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
															<polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
															<line x1="12" y1="22.08" x2="12" y2="12"></line>
														</svg>
														Client has open estimates <span class="float-end text-warning">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_accepted_estimates" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has accepted estimates <span class="float-end text-success">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_new_estimate_requests" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-droplet icon-18 me-2">
															<path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
														</svg>
														Clients has new estimate requests <span class="float-end text-primary">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_estimate_requests_in_progress" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader icon-18 me-2">
															<line x1="12" y1="2" x2="12" y2="6"></line>
															<line x1="12" y1="18" x2="12" y2="22"></line>
															<line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
															<line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
															<line x1="2" y1="12" x2="6" y2="12"></line>
															<line x1="18" y1="12" x2="22" y2="12"></line>
															<line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
															<line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
														</svg>
														Clients has estimate requests in progress <span class="float-end text-success">0</span>
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

								</div>
								<div class="col-md-6">
									<a class="client-widget-link " data-filter="has_open_tickets" href="#">
										<div class="card  pb-3">
											<div class="card-body">
												<div class="widget-title p0 text-default">
													<strong>Clients has open tickets</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">67% of total clients</span>
													<h1 class="float-end m0 text-default">2</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="67%">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
									<br><br>
									<a class="client-widget-link" data-filter="has_new_orders" href="#">
										<div class="card">
											<div class="card-body p20">
												<div class="widget-title p0 text-default">
													<strong>Clients has new orders</strong>
												</div>
												<div class="clearfix">
													<span class="text-off float-start mt-3 text-default">33% of total clients</span>
													<h1 class="float-end m0 text-default">1</h1>
												</div>
												<div class="progress mt5" style="height: 6px;" title="33%">
													<div class="progress-bar bg-orange" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-md-6">
									<div class="card bg-white">
										<span class="p-4">Proposals</span>
										<div class="card-body pt0 rounded-bottom ps" id="proposals-widget-container" style="height: 182px; position: relative;">
											<ul class="list-group list-group-flush">
												<a class="client-widget-link" data-filter="has_open_proposals" href="#">
													<li class="list-group-item text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee icon-18 me-2">
															<path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
															<path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
															<line x1="6" y1="1" x2="6" y2="4"></line>
															<line x1="10" y1="1" x2="10" y2="4"></line>
															<line x1="14" y1="1" x2="14" y2="4"></line>
														</svg>
														Clients has open proposals <span class="float-end text-warning">0</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_accepted_proposals" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-18 me-2">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														Clients has accepted proposals <span class="float-end text-success">1</span>
													</li>
												</a>
												<a class="client-widget-link" data-filter="has_rejected_proposals" href="#">
													<li class="list-group-item border-top text-default">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle icon-18 me-2">
															<circle cx="12" cy="12" r="10"></circle>
															<line x1="15" y1="9" x2="9" y2="15"></line>
															<line x1="9" y1="9" x2="15" y2="15"></line>
														</svg>
														Clients has rejected proposals <span class="float-end text-danger">0</span>
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

								</div>
							</div>












						</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection


<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{url('/')}}/public/assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/assets/js/scripts.bundle.js" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{url('/')}}/public/assets/js/pages/custom/wizard/wizard-3.js" type="text/javascript"></script>


<!--end::Page Scripts -->

@section('script')

<!-- begin::Global Config(global config for global JS sciprts) -->
<!-- <script>
	var KTAppOptions = {
		"colors": {
			"state": {
				"brand": "#5d78ff",
				"dark": "#282a3c",
				"light": "#ffffff",
				"primary": "#5867dd",
				"success": "#34bfa3",
				"info": "#36a3f7",
				"warning": "#ffb822",
				"danger": "#fd3995"
			},
			"base": {
				"label": [
					"#c5cbe3",
					"#a1a8c3",
					"#3d4465",
					"#3e4466"
				],
				"shape": [
					"#f0f3ff",
					"#d9dffa",
					"#afb4d4",
					"#646c9a"
				]
			}
		}
	};
</script>

<script>
	$(document).ready(function() {
		initScrollbar('#projects-container', {
			setHeight: 182
		});
		initScrollbar('#estiamte-widget-container', {
			setHeight: 182
		});
		initScrollbar('#proposals-widget-container', {
			setHeight: 182
		});
		initScrollbar('#projects-container', {
			setHeight: 182
		});
		initScrollbar('#proposals-widget-container', {
			setHeight: 182
		});
		initScrollbar('#projects-container', {
			setHeight: 182
		});
		initScrollbar('#estiamte-widget-container', {
			setHeight: 182
		});
		initScrollbar('#proposals-widget-container', {
			setHeight: 182
		});
		initScrollbar('#projects-container', {
			setHeight: 182
		});
		initScrollbar('#estiamte-widget-container', {
			setHeight: 182
		});
		initScrollbar('#estiamte-widget-container', {
			setHeight: 182
		});
		initScrollbar('#proposals-widget-container', {
			setHeight: 182
		});
		initScrollbar('#proposals-widget-container', {
			setHeight: 182
		});
		initScrollbar('#projects-container', {
			setHeight: 182
		});
	});
</script> -->
@endsection