@extends('common.layout')


@section('content')

			<!-- end:: Header -->
			<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

				<!-- begin:: Subheader -->
				<div class="kt-subheader   kt-grid__item" id="kt_subheader">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title">
								Wizard 1 </h3>
							<span class="kt-subheader__separator kt-hidden"></span>
							<div class="kt-subheader__breadcrumbs">
								<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
								<span class="kt-subheader__breadcrumbs-separator"></span>
								<a href="" class="kt-subheader__breadcrumbs-link">
									Pages </a>
								<span class="kt-subheader__breadcrumbs-separator"></span>
								<a href="" class="kt-subheader__breadcrumbs-link">
									Wizard 1 </a>

								<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
							</div>
						</div>
						<div class="kt-subheader__toolbar">
							<div class="kt-subheader__wrapper">
								<a href="#" class="btn kt-subheader__btn-primary">
									Actions &nbsp;

									<!--<i class="flaticon2-calendar-1"></i>-->
								</a>
								<div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="left">
									<a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
												<path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
											</g>
										</svg>

										<!--<i class="flaticon2-plus"></i>-->
									</a>
									<div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">

										<!--begin::Nav-->
										<ul class="kt-nav">
											<li class="kt-nav__head">
												Add anything or jump to:
												<i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
											</li>
											<li class="kt-nav__separator"></li>
											<li class="kt-nav__item">
												<a href="#" class="kt-nav__link">
													<i class="kt-nav__link-icon flaticon2-drop"></i>
													<span class="kt-nav__link-text">Order</span>
												</a>
											</li>
											<li class="kt-nav__item">
												<a href="#" class="kt-nav__link">
													<i class="kt-nav__link-icon flaticon2-calendar-8"></i>
													<span class="kt-nav__link-text">Ticket</span>
												</a>
											</li>
											<li class="kt-nav__item">
												<a href="#" class="kt-nav__link">
													<i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
													<span class="kt-nav__link-text">Goal</span>
												</a>
											</li>
											<li class="kt-nav__item">
												<a href="#" class="kt-nav__link">
													<i class="kt-nav__link-icon flaticon2-new-email"></i>
													<span class="kt-nav__link-text">Support Case</span>
													<span class="kt-nav__link-badge">
																<span class="kt-badge kt-badge--success">5</span>
															</span>
												</a>
											</li>
											<li class="kt-nav__separator"></li>
											<li class="kt-nav__foot">
												<a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
												<a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
											</li>
										</ul>

										<!--end::Nav-->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- end:: Subheader -->

				<!-- begin:: Content -->
				<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
					<div class="kt-portlet">
						<div class="kt-portlet__body kt-portlet__body--fit">
							<div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="step-first">
								<div class="kt-grid__item">

									<!--begin: Form Wizard Nav -->
									<div class="kt-wizard-v1__nav">

										<!--doc: Remove "kt-wizard-v1__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
										<div class="kt-wizard-v1__nav-items kt-wizard-v1__nav-items--clickable">
											<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
												<div class="kt-wizard-v1__nav-body">
													<div class="kt-wizard-v1__nav-icon">
														<i class="flaticon-bus-stop"></i>
													</div>
													<div class="kt-wizard-v1__nav-label">
														General Info
													</div>
												</div>
											</div>
											<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
												<div class="kt-wizard-v1__nav-body">
													<div class="kt-wizard-v1__nav-icon">
														<i class="flaticon-list"></i>
													</div>
													<div class="kt-wizard-v1__nav-label">
														Customer Info
													</div>
												</div>
											</div>
											<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
												<div class="kt-wizard-v1__nav-body">
													<div class="kt-wizard-v1__nav-icon">
														<i class="flaticon-responsive"></i>
													</div>
													<div class="kt-wizard-v1__nav-label">
														Contact Info
													</div>
												</div>
											</div>
											<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
												<div class="kt-wizard-v1__nav-body">
													<div class="kt-wizard-v1__nav-icon">
														<i class="flaticon-globe"></i>
													</div>
													<div class="kt-wizard-v1__nav-label">
														Invoices Info
													</div>
												</div>
											</div>
											<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
												<div class="kt-wizard-v1__nav-body">
													<div class="kt-wizard-v1__nav-icon">
														<i class="flaticon-truck"></i>
													</div>
													<div class="kt-wizard-v1__nav-label">
														Credentials
													</div>
												</div>
											</div>

										{{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
										{{--                                                <div class="kt-wizard-v1__nav-body">--}}
										{{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
										{{--                                                        <i class="flaticon-globe"></i>--}}
										{{--                                                    </div>--}}
										{{--                                                    <div class="kt-wizard-v1__nav-label">--}}
										{{--                                                        Portal--}}
										{{--                                                    </div>--}}
										{{--                                                </div>--}}
										{{--                                            </div>--}}
										{{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
										{{--                                                <div class="kt-wizard-v1__nav-body">--}}
										{{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
										{{--                                                        <i class="flaticon-globe"></i>--}}
										{{--                                                    </div>--}}
										{{--                                                    <div class="kt-wizard-v1__nav-label">--}}
										{{--                                                        Type--}}
										{{--                                                    </div>--}}
										{{--                                                </div>--}}
										{{--                                            </div>--}}
										{{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
										{{--                                                <div class="kt-wizard-v1__nav-body">--}}
										{{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
										{{--                                                        <i class="flaticon-globe"></i>--}}
										{{--                                                    </div>--}}
										{{--                                                    <div class="kt-wizard-v1__nav-label">--}}
										{{--                                                        Transaction--}}
										{{--                                                    </div>--}}
										{{--                                                </div>--}}
										{{--                                            </div>--}}
										{{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
										{{--                                                <div class="kt-wizard-v1__nav-body">--}}
										{{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
										{{--                                                        <i class="flaticon-globe"></i>--}}
										{{--                                                    </div>--}}
										{{--                                                    <div class="kt-wizard-v1__nav-label">--}}
										{{--                                                        Credit limit--}}
										{{--                                                    </div>--}}
										{{--                                                </div>--}}
										{{--                                            </div>--}}
										{{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
										{{--                                                <div class="kt-wizard-v1__nav-body">--}}
										{{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
										{{--                                                        <i class="flaticon-globe"></i>--}}
										{{--                                                    </div>--}}
										{{--                                                    <div class="kt-wizard-v1__nav-label">--}}
										{{--                                                        Payment Terms--}}
										{{--                                                    </div>--}}
										{{--                                                </div>--}}
										{{--                                            </div>--}}
										{{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
										{{--                                                <div class="kt-wizard-v1__nav-body">--}}
										{{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
										{{--                                                        <i class="flaticon-globe"></i>--}}
										{{--                                                    </div>--}}
										{{--                                                    <div class="kt-wizard-v1__nav-label">--}}
										{{--                                                        Accounting--}}
										{{--                                                    </div>--}}
										{{--                                                </div>--}}
										{{--                                            </div>--}}

										{{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
										{{--                                                <div class="kt-wizard-v1__nav-body">--}}
										{{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
										{{--                                                        <i class="flaticon-globe"></i>--}}
										{{--                                                    </div>--}}
										{{--                                                    <div class="kt-wizard-v1__nav-label">--}}
										{{--                                                        SOA--}}
										{{--                                                    </div>--}}
										{{--                                                </div>--}}
										{{--                                            </div>--}}
										{{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
										{{--                                                <div class="kt-wizard-v1__nav-body">--}}
										{{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
										{{--                                                        <i class="flaticon-globe"></i>--}}
										{{--                                                    </div>--}}
										{{--                                                    <div class="kt-wizard-v1__nav-label">--}}
										{{--                                                        VAT--}}
										{{--                                                    </div>--}}
										{{--                                                </div>--}}
										{{--                                            </div>--}}

										{{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
										{{--                                                <div class="kt-wizard-v1__nav-body">--}}
										{{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
										{{--                                                        <i class="flaticon-globe"></i>--}}
										{{--                                                    </div>--}}
										{{--                                                    <div class="kt-wizard-v1__nav-label">--}}
										{{--                                                        Document--}}
										{{--                                                    </div>--}}
										{{--                                                </div>--}}
										{{--                                            </div>--}}
										{{--                                        </div>--}}
										{{--                                    </div>--}}

										<!--end: Form Wizard Nav -->
										</div>
										<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">

											<!--begin: Form Wizard Form-->
											<form class="kt-form" id="kt_form">

												<!--begin: Form Wizard Step 1-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
													<div class="kt-heading kt-heading--md">Customer Details </div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">
															<div class="row">
																<label class="col-3 col-form-label">Auto Code</label>
																<div class="col-lg-3">


																	<div class="col-6">
														<span class="kt-switch kt-switch--icon">
															<label>
																<input type="checkbox" checked="checked" name="">
																<span></span>
															</label>
														</span>
																	</div>
{{-- <span class="kt-switch kt-switch--icon">--}}
{{--   <label>--}}
{{--    <input type="checkbox" name="">--}}
{{--       <span></span>--}}
{{--   </label>--}}
{{-- </span>--}}
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Customer Code</label>
																		<input type="text" class="form-control" name="address1" placeholder="Customer Code" >

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Customer Type</label>
																		<select class="form-control single-select">
																			<option value="">Select</option>
																			<option value="1">Wholesale Customer</option>
																			<option value="2">Retail Customer</option>
																		</select>

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Customer Category</label>
																		<select class="form-control single-select">
																			<option value="">Select</option>
																			<option value="1">Co-orporate</option>
																			<option value="2">Company</option>
																		</select>

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Sales man</label>
																		<select class="form-control single-select">
																			<option value="">Select</option>
																			<option value="1">Ram</option>
																			<option value="2">Roy</option>
																		</select>

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Key Accounts</label>
																		<select class="form-control single-select">
																			<option value="">Select</option>
																			<option value="1">Ram</option>
																			<option value="2">Roy</option>
																		</select>

																	</div>
																</div>



															</div>

														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 1-->

												<!--begin: Form Wizard Step 2-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Contact Details</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Customer Name/Company name</label>
																		<input type="text" class="form-control" name="state" placeholder="Customer Name" value="Contact Name">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Contact Person</label>
																		<input type="text" class="form-control" name="state" placeholder="Contact Person" value="Contact Person">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Address 1</label>
																		<textarea type="text" class="form-control"></textarea>

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Address 2</label>
																		<textarea type="text" class="form-control"></textarea>

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Country</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Country">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Region</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Region">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>City</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter City">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Zipcode</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Zipcode">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Email</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Email">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Secondary Email</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Email">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Office Phone 1</label>
																		<input type="text" class="form-control" name="state" placeholder="Phone 1">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Office Phone 2</label>
																		<input type="text" class="form-control" name="state" placeholder="Phone 2">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Mobile 1</label>
																		<input type="text" class="form-control" name="state" placeholder="Mobile">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Mobile 2</label>
																		<input type="text" class="form-control" name="state" placeholder="Mobile">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Fax</label>
																		<input type="text" class="form-control" name="state" placeholder="Fax">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Website</label>
																		<input type="text" class="form-control" name="state" placeholder="Website">

																	</div>
																</div>
															</div>


														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 2-->

												<!--begin: Form Wizard Step 3-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Contact Person</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">
															<div class="row">
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Contact Person</label>
																		<div class="kt-input-icon">
																			<input type="text" class="form-control" placeholder="Enter your address">
																			<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
																		</div>

																	</div>
																</div>
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Contact Person in Charge</label>
																		<div class="kt-input-icon">
																			<input type="text" class="form-control" placeholder="Enter your address">
																			<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
																		</div>

																	</div>
																</div>

																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Mobile</label>
																		<div class="kt-input-icon">
																			<input type="text" class="form-control" placeholder="Enter your address">
																			<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
																		</div>

																	</div>
																</div>
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Office Number</label>
																		<div class="kt-input-icon">
																			<input type="text" class="form-control" placeholder="Enter your address">
																			<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
																		</div>

																	</div>
																</div>

																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Email</label>
																		<div class="kt-input-icon">
																			<input type="text" class="form-control" placeholder="Enter your address">
																			<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
																		</div>

																	</div>
																</div>
																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Department</label>
																		<div class="kt-input-icon">
																			<input type="text" class="form-control" placeholder="Enter your address">
																			<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
																		</div>

																	</div>
																</div>

																<div class="col-xl-6">
																	<div class="form-group">
																		<label>Location</label>
																		<div class="kt-input-icon">
																			<input type="text" class="form-control" placeholder="Enter your address">
																			<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
																		</div>

																	</div>
																</div>
																<div class="col-xl-6">
																	<div class="form-group">
																		<button class="btn">+ Add More</button>
																	</div>
																</div>

															</div>

														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 3-->

												<!--begin: Form Wizard Step 4-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Invoice Address
														<label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
															<input type="checkbox"> Same as customer address
															<span></span>
														</label>
													</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Address 1</label>
																		<textarea type="text" class="form-control"></textarea>

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Address 2</label>
																		<textarea type="text" class="form-control"></textarea>

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Country</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Country">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Region</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Region">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>City</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter City">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Zipcode</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Zipcode">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Email</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Email">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Secondary Email</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Email">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Office Phone 1</label>
																		<input type="text" class="form-control" name="state" placeholder="Phone 1">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Office Phone 2</label>
																		<input type="text" class="form-control" name="state" placeholder="Phone 2">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Mobile 1</label>
																		<input type="text" class="form-control" name="state" placeholder="Mobile">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Mobile 2</label>
																		<input type="text" class="form-control" name="state" placeholder="Mobile">

																	</div>
																</div>
															</div>
															<div class="clearfix"></div>

															<div class="kt-heading kt-heading--md">Shipping Address
																<label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
																	<input type="checkbox"> Same as customer address
																	<span></span>
																</label>
															</div>
															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Address 1</label>
																		<textarea type="text" class="form-control"></textarea>

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Address 2</label>
																		<textarea type="text" class="form-control"></textarea>

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Country</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Country">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Region</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Region">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>City</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter City">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Zipcode</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Zipcode">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Email</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Email">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Secondary Email</label>
																		<input type="text" class="form-control" name="state" placeholder="Enter Email">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Office Phone 1</label>
																		<input type="text" class="form-control" name="state" placeholder="Phone 1">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Office Phone 2</label>
																		<input type="text" class="form-control" name="state" placeholder="Phone 2">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Mobile 1</label>
																		<input type="text" class="form-control" name="state" placeholder="Mobile">

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Mobile 2</label>
																		<input type="text" class="form-control" name="state" placeholder="Mobile">

																	</div>
																</div>
															</div>


														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 4-->

												<!--begin: Form Wizard Step 5-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Other Details</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Portal URL</label>
																		<div class="input-group">
																			<input type="text" class="form-control" placeholder="Please enter Portal"/>

																		</div>

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Username</label>
																		<input type="text" class="form-control" name="city" placeholder="Please Enter User Name" >

																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Email</label>
																		<div class="input-group">
																			<input type="text" class="form-control" placeholder="Please enter Email"/>

																		</div>


																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Password</label>
																		<input type="text" class="form-control" name="city" placeholder="Please Enter User Name" >

																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 5-->

												<!--begin: Form Wizard Step 6-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Customer Portal details</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Portal URL</label>
																		<input type="url" class="form-control" name="city" placeholder="Portal URL" value="https://www.google.com/">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Username</label>
																		<input type="text" class="form-control" name="city" placeholder="Username" value="Username">

																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Password</label>
																		<input type="password" class="form-control" name="city" placeholder="Password" value="Password">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Registered Email</label>
																		<input type="email" class="form-control" name="city" placeholder="Registered Email" value="Registered Email">

																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Portal created on</label>
																		<input type="text" class="form-control" name="city" placeholder="Portal created on" value="Portal created on">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>password Modified History</label>
																		<input type="text" class="form-control" name="city" placeholder="password Modified History" value="password Modified History">

																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Modification History IP Address</label>
																		<input type="text" class="form-control" name="city" placeholder="Modification History IP Address" value="Modification History IP Address">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Send portal link to registered email</label>
																		<input type="text" class="form-control" name="city" placeholder="Send portal link to registered email" value="Send portal link to registered email">

																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-5">
																	<div class="form-group">
																		<label>update registered email</label>
																		<input type="text" class="form-control" name="city" placeholder="update registered email" value="update registered email">

																	</div>
																</div>
																<div class="col-lg-5">
																	<div class="form-group">
																		<label>update user login</label>
																		<input type="text" class="form-control" name="city" placeholder="update user login" value="update user login">

																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">


																		<label class="col-1 col-form-label">account</label>
																		<div class="col-1">
 <span class="kt-switch kt-switch--icon">
   <label>
	<input type="checkbox" name="">
	   <span></span>
   </label>
 </span>
																		</div>


																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 6-->

												<!--begin: Form Wizard Step 7-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Customer Type Details (Listings only)</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">
															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Customer type</label>
																		<input type="text" class="form-control" name="city" placeholder="Customer type" value="Customer type">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>customer type description</label>
																		<input type="text" class="form-control" name="city" placeholder="customer type description" value="customer type description">

																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-lg-12">
																	<div class="form-group">
																		<label>Customer type</label>
																		<textarea class="form-control" name="city" placeholder="Customer type">
																		</textarea>

																	</div>
																</div>

															</div>
														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 7-->

												<!--begin: Form Wizard Step 8-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Customer Transaction Details - (listings only)</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Total Sales</label>
																		<input type="text" class="form-control" name="city" placeholder="Total Sales" value="Total Sales">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Total Invoice Amount</label>
																		<input type="text" class="form-control" name="city" placeholder="Total Invoice Amount" value="Total Invoice Amount">

																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Paid Invoices</label>
																		<input type="text" class="form-control" name="city" placeholder="Paid Invoices" value="Paid Invoices">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Due invoices</label>
																		<input type="text" class="form-control" name="city" placeholder="Due invoices" value="Due invoices">

																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Over Due invoices</label>
																		<input type="text" class="form-control" name="city" placeholder="Over Due invoices" value="Over Due invoices">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Partially Paid invoices</label>
																		<input type="text" class="form-control" name="city" placeholder="Partially Paid invoices" value="Partially Paid invoices">

																	</div>
																</div>
															</div>


														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 8-->

												<!--begin: Form Wizard Step 9-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Customer Credit limit Details</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Credit Limit on number of invoices</label>
																		<input type="text" class="form-control" name="city" placeholder="Credit Limit on number of invoices" value="Credit Limit on number of invoices">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>credit limit on Total Amount</label>
																		<input type="text" class="form-control" name="city" placeholder="credit limit on Total Amount" value="credit limit on Total Amount">

																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Credit limit period on each invoice</label>
																		<input type="text" class="form-control" name="city" placeholder="Credit limit period on each invoice" value="Credit limit period on each invoice">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>credit limit exceed penal charges %</label>
																		<input type="text" class="form-control" name="city" placeholder="credit limit exceed penal charges %" value="credit limit exceed penal charges %">

																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 9-->

												<!--begin: Form Wizard Step 10-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Customer Payment Terms Details</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">

															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<label>Term – 1</label>
																		<input type="text" class="form-control" name="city" placeholder="Term – 1" value="Term – 1">

																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<label>percentage on invoice amount</label>
																		<input type="text" class="form-control" name="city" placeholder="percentage on invoice amount" value="percentage on invoice amount">

																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<label>Term Period from Invoice</label>
																		<input type="text" class="form-control" name="city" placeholder="Term Period from Invoice" value="Term Period from Invoice">

																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Add More until it reaches 100 %</label>
																		<input type="text" class="form-control" name="city" placeholder="Add More until it reaches 100 %" value="Add More until it reaches 100 %">

																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Customer Payment Details Note</label>
																		<input type="text" class="form-control" name="city" placeholder="Customer Payment Details Note" value="Customer Payment Details Note">

																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 10-->



												<!--begin: Form Wizard Step 11-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Customer Payment Terms Details</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">


															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Total debit</label>
																		<input type="text" class="form-control" name="city" placeholder="Total debit" value="Total debit">
																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Total Credit</label>
																		<input type="text" class="form-control" name="city" placeholder="Total Credit" value="Total Credit">
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Opening Balance</label>
																		<input type="text" class="form-control" name="city" placeholder="Opening Balance" value="Opening Balance">
																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Closing Balance</label>
																		<input type="text" class="form-control" name="city" placeholder="Closing Balance" value="Closing Balance">
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Outstanding amount</label>
																		<input type="text" class="form-control" name="city" placeholder="Outstanding amount" value="Outstanding amount">
																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">

																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 11-->

												<!--begin: Form Wizard Step 12-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Customer SOA Details</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">


															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Customer SOA</label>
																		<input type="text" class="form-control" name="city" placeholder="Customer SOA" value="Customer SOA">
																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Customer SOA Detailed</label>
																		<input type="text" class="form-control" name="city" placeholder="Customer SOA Detailed" value="Customer SOA Detailed">
																	</div>
																</div>
															</div>



														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 12-->

												<!--begin: Form Wizard Step 13-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Customer VAT Details</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">


															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>VAT Number</label>
																		<input type="text" class="form-control" name="city" placeholder="VAT Number" value="VAT Number">
																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Tax Name</label>
																		<input type="text" class="form-control" name="city" placeholder="Tax Name" value="Tax Name">
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>VAT Certificate</label>
																		<input type="text" class="form-control" name="city" placeholder="VAT Certificate" value="VAT Certificate">
																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">

																	</div>
																</div>
															</div>



														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 13-->




												<!--begin: Form Wizard Step last-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Customer Documents</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="row">
															<div class="col-lg-12">
																<button type="button" id="addata" class="btn btn-dark btn-elevate btn-pill btn-sm pull-right">Add</button>
															</div>
														</div>
														<div class="kt-wizard-v1__form" id="fmappend">

															<span id="htmldata">
																<div class="row" >
																	<div class="col-lg-6">
																		<div class="form-group">
																			<label>Document Name</label>
																			<input type="text" class="form-control" name="city" placeholder="Document Name" value="Document Name">
																				</div>
																	</div>
																	<div class="col-lg-6">
																		<div class="form-group">
																			<label>Upload</label>
																			<input type="file" class="form-control" name="city" placeholder="Upload" >
																			<span class="form-text text-muted">Please Upload.</span>
																		</div>
																	</div>
																</div>
															</span>



														</div>
													</div>
												</div>

												<!--end: Form Wizard Step last-->


												<!--begin: Form Actions -->
												<div class="kt-form__actions">
													<button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
														<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> &nbsp; Previous
													</button>
													<button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
														Submit &nbsp; <i class="fa fa-paper-plane" aria-hidden="true"></i>
													</button>
													<button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
														Next Step &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
													</button>
												</div>

												<!--end: Form Actions -->
											</form>

											<!--end: Form Wizard Form-->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						<script>
							$(document).ready(function(){
								$("#addata").click(function(){
									$data= $("#htmldata").html();
									//alert($data);
									$("#fmappend").append($data);
								});
							});
						</script>

						<!-- end:: Content -->
					</div>

					<!-- begin:: Footer -->
					<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
						<div class="kt-container  kt-container--fluid ">
							<div class="kt-footer__copyright">
								2019&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic" target="_blank" class="kt-link">Keenthemes</a>
							</div>
							<div class="kt-footer__menu">
								<a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
								<a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
								<a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
							</div>
						</div>
					</div>

					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Quick Panel -->
		<div id="kt_quick_panel" class="kt-quick-panel">
			<a href="#" class="kt-quick-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></a>
			<div class="kt-quick-panel__nav">
				<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">
					<li class="nav-item active">
						<a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_notifications" role="tab">Notifications</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_logs" role="tab">Audit Logs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_settings" role="tab">Settings</a>
					</li>
				</ul>
			</div>
			<div class="kt-quick-panel__content">
				<div class="tab-content">
					<div class="tab-pane fade show kt-scroll active" id="kt_quick_panel_tab_notifications" role="tabpanel">
						<div class="kt-notification">
							<a href="#" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon2-line-chart kt-font-success"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										New order has been received
									</div>
									<div class="kt-notification__item-time">
										2 hrs ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon2-box-1 kt-font-brand"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										New customer is registered
									</div>
									<div class="kt-notification__item-time">
										3 hrs ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon2-chart2 kt-font-danger"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										Application has been approved
									</div>
									<div class="kt-notification__item-time">
										3 hrs ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon2-image-file kt-font-warning"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										New file has been uploaded
									</div>
									<div class="kt-notification__item-time">
										5 hrs ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon2-drop kt-font-info"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										New user feedback received
									</div>
									<div class="kt-notification__item-time">
										8 hrs ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon2-pie-chart-2 kt-font-success"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										System reboot has been successfully completed
									</div>
									<div class="kt-notification__item-time">
										12 hrs ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon2-favourite kt-font-danger"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										New order has been placed
									</div>
									<div class="kt-notification__item-time">
										15 hrs ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification__item kt-notification__item--read">
								<div class="kt-notification__item-icon">
									<i class="flaticon2-safe kt-font-primary"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										Company meeting canceled
									</div>
									<div class="kt-notification__item-time">
										19 hrs ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon2-psd kt-font-success"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										New report has been received
									</div>
									<div class="kt-notification__item-time">
										23 hrs ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon-download-1 kt-font-danger"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										Finance report has been generated
									</div>
									<div class="kt-notification__item-time">
										25 hrs ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon-security kt-font-warning"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										New customer comment recieved
									</div>
									<div class="kt-notification__item-time">
										2 days ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon2-pie-chart kt-font-warning"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">
										New customer is registered
									</div>
									<div class="kt-notification__item-time">
										3 days ago
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="tab-pane fade kt-scroll" id="kt_quick_panel_tab_logs" role="tabpanel">
						<div class="kt-notification-v2">
							<a href="#" class="kt-notification-v2__item">
								<div class="kt-notification-v2__item-icon">
									<i class="flaticon-bell kt-font-brand"></i>
								</div>
								<div class="kt-notification-v2__itek-wrapper">
									<div class="kt-notification-v2__item-title">
										5 new user generated report
									</div>
									<div class="kt-notification-v2__item-desc">
										Reports based on sales
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification-v2__item">
								<div class="kt-notification-v2__item-icon">
									<i class="flaticon2-box kt-font-danger"></i>
								</div>
								<div class="kt-notification-v2__itek-wrapper">
									<div class="kt-notification-v2__item-title">
										2 new items submited
									</div>
									<div class="kt-notification-v2__item-desc">
										by Grog John
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification-v2__item">
								<div class="kt-notification-v2__item-icon">
									<i class="flaticon-psd kt-font-brand"></i>
								</div>
								<div class="kt-notification-v2__itek-wrapper">
									<div class="kt-notification-v2__item-title">
										79 PSD files generated
									</div>
									<div class="kt-notification-v2__item-desc">
										Reports based on sales
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification-v2__item">
								<div class="kt-notification-v2__item-icon">
									<i class="flaticon2-supermarket kt-font-warning"></i>
								</div>
								<div class="kt-notification-v2__itek-wrapper">
									<div class="kt-notification-v2__item-title">
										$2900 worth producucts sold
									</div>
									<div class="kt-notification-v2__item-desc">
										Total 234 items
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification-v2__item">
								<div class="kt-notification-v2__item-icon">
									<i class="flaticon-paper-plane-1 kt-font-success"></i>
								</div>
								<div class="kt-notification-v2__itek-wrapper">
									<div class="kt-notification-v2__item-title">
										4.5h-avarage response time
									</div>
									<div class="kt-notification-v2__item-desc">
										Fostest is Barry
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification-v2__item">
								<div class="kt-notification-v2__item-icon">
									<i class="flaticon2-information kt-font-danger"></i>
								</div>
								<div class="kt-notification-v2__itek-wrapper">
									<div class="kt-notification-v2__item-title">
										Database server is down
									</div>
									<div class="kt-notification-v2__item-desc">
										10 mins ago
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification-v2__item">
								<div class="kt-notification-v2__item-icon">
									<i class="flaticon2-mail-1 kt-font-brand"></i>
								</div>
								<div class="kt-notification-v2__itek-wrapper">
									<div class="kt-notification-v2__item-title">
										System report has been generated
									</div>
									<div class="kt-notification-v2__item-desc">
										Fostest is Barry
									</div>
								</div>
							</a>
							<a href="#" class="kt-notification-v2__item">
								<div class="kt-notification-v2__item-icon">
									<i class="flaticon2-hangouts-logo kt-font-warning"></i>
								</div>
								<div class="kt-notification-v2__itek-wrapper">
									<div class="kt-notification-v2__item-title">
										4.5h-avarage response time
									</div>
									<div class="kt-notification-v2__item-desc">
										Fostest is Barry
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="tab-pane kt-quick-panel__content-padding-x fade kt-scroll" id="kt_quick_panel_tab_settings" role="tabpanel">
						<form class="kt-form">
							<div class="kt-heading kt-heading--sm kt-heading--space-sm">Customer Care</div>
							<div class="form-group form-group-xs row">
								<label class="col-8 col-form-label">Enable Notifications:</label>
								<div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--success kt-switch--sm">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_1">
											<span></span>
										</label>
									</span>
								</div>
							</div>
							<div class="form-group form-group-xs row">
								<label class="col-8 col-form-label">Enable Case Tracking:</label>
								<div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--success kt-switch--sm">
										<label>
											<input type="checkbox" name="quick_panel_notifications_2">
											<span></span>
										</label>
									</span>
								</div>
							</div>
							<div class="form-group form-group-last form-group-xs row">
								<label class="col-8 col-form-label">Support Portal:</label>
								<div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--success kt-switch--sm">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_2">
											<span></span>
										</label>
									</span>
								</div>
							</div>
							<div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>
							<div class="kt-heading kt-heading--sm kt-heading--space-sm">Reports</div>
							<div class="form-group form-group-xs row">
								<label class="col-8 col-form-label">Generate Reports:</label>
								<div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--danger">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_3">
											<span></span>
										</label>
									</span>
								</div>
							</div>
							<div class="form-group form-group-xs row">
								<label class="col-8 col-form-label">Enable Report Export:</label>
								<div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--danger">
										<label>
											<input type="checkbox" name="quick_panel_notifications_3">
											<span></span>
										</label>
									</span>
								</div>
							</div>
							<div class="form-group form-group-last form-group-xs row">
								<label class="col-8 col-form-label">Allow Data Collection:</label>
								<div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--danger">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_4">
											<span></span>
										</label>
									</span>
								</div>
							</div>
							<div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>
							<div class="kt-heading kt-heading--sm kt-heading--space-sm">Memebers</div>
							<div class="form-group form-group-xs row">
								<label class="col-8 col-form-label">Enable Member singup:</label>
								<div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--brand">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_5">
											<span></span>
										</label>
									</span>
								</div>
							</div>
							<div class="form-group form-group-xs row">
								<label class="col-8 col-form-label">Allow User Feedbacks:</label>
								<div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--brand">
										<label>
											<input type="checkbox" name="quick_panel_notifications_5">
											<span></span>
										</label>
									</span>
								</div>
							</div>
							<div class="form-group form-group-last form-group-xs row">
								<label class="col-8 col-form-label">Enable Customer Portal:</label>
								<div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--brand">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_6">
											<span></span>
										</label>
									</span>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- end::Quick Panel -->

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->

		<!-- begin::Sticky Toolbar -->
		<ul class="kt-sticky-toolbar" style="margin-top: 30px;">
			<li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" id="kt_demo_panel_toggle" data-toggle="kt-tooltip" title="Check out more demos" data-placement="right">
				<a href="#" class=""><i class="flaticon2-drop"></i></a>
			</li>
			<li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--brand" data-toggle="kt-tooltip" title="Layout Builder" data-placement="left">
				<a href="https://keenthemes.com/metronic/preview/demo1/builder.html" target="_blank"><i class="flaticon2-gear"></i></a>
			</li>
			<li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--warning" data-toggle="kt-tooltip" title="Documentation" data-placement="left">
				<a href="https://keenthemes.com/metronic/?page=docs" target="_blank"><i class="flaticon2-telegram-logo"></i></a>
			</li>
			<li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--danger" id="kt_sticky_toolbar_chat_toggler" data-toggle="kt-tooltip" title="Chat Example" data-placement="left">
				<a href="#" data-toggle="modal" data-target="#kt_chat_modal"><i class="flaticon2-chat-1"></i></a>
			</li>
		</ul>

		<!-- end::Sticky Toolbar -->

		<!-- begin::Demo Panel -->
		<div id="kt_demo_panel" class="kt-demo-panel">
			<div class="kt-demo-panel__head">
				<h3 class="kt-demo-panel__title">
					Select A Demo

					<!--<small>5</small>-->
				</h3>
				<a href="#" class="kt-demo-panel__close" id="kt_demo_panel_close"><i class="flaticon2-delete"></i></a>
			</div>
			<div class="kt-demo-panel__body">
				<div class="kt-demo-panel__item kt-demo-panel__item--active">
					<div class="kt-demo-panel__item-title">
						Demo 1
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo1.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo1/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo1/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 2
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo2.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo2/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo2/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 3
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo3.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo3/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo3/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 4
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo4.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo4/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo4/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 5
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo5.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo5/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo5/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 6
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo6.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo6/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo6/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 7
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo7.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo7/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo7/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 8
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo8.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo8/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo8/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 9
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo9.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo9/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo9/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 10
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo10.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo10/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo10/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 11
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo11.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo11/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo11/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 12
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo12.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="https://keenthemes.com/metronic/preview/demo12/index.html" class="btn btn-brand btn-elevate " target="_blank">Default</a>
							<a href="https://keenthemes.com/metronic/preview/demo12/rtl/index.html" class="btn btn-light btn-elevate" target="_blank">RTL Version</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 13
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo13.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="#" class="btn btn-brand btn-elevate disabled">Coming soon</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 14
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo14.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="#" class="btn btn-brand btn-elevate disabled">Coming soon</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 15
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo15.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="#" class="btn btn-brand btn-elevate disabled">Coming soon</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 16
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo16.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="#" class="btn btn-brand btn-elevate disabled">Coming soon</a>
						</div>
					</div>
				</div>
				<div class="kt-demo-panel__item ">
					<div class="kt-demo-panel__item-title">
						Demo 17
					</div>
					<div class="kt-demo-panel__item-preview">
						<img src="assets/media//demos/preview/demo17.jpg" alt="" />
						<div class="kt-demo-panel__item-preview-overlay">
							<a href="#" class="btn btn-brand btn-elevate disabled">Coming soon</a>
						</div>
					</div>
				</div>
				<a href="https://1.envato.market/EA4JP" target="_blank" class="kt-demo-panel__purchase btn btn-brand btn-elevate btn-bold btn-upper">
					Buy Metronic Now!
				</a>
			</div>
		</div>

		<!-- end::Demo Panel -->

		<!--Begin:: Chat-->
		<div class="modal fade- modal-sticky-bottom-right" id="kt_chat_modal" role="dialog" data-backdrop="false">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="kt-chat">
						<div class="kt-portlet kt-portlet--last">
							<div class="kt-portlet__head">
								<div class="kt-chat__head ">
									<div class="kt-chat__left">
										<div class="kt-chat__label">
											<a href="#" class="kt-chat__title">Jason Muller</a>
											<span class="kt-chat__status">
												<span class="kt-badge kt-badge--dot kt-badge--success"></span> Active
											</span>
										</div>
									</div>
									<div class="kt-chat__right">
										<div class="dropdown dropdown-inline">
											<button type="button" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="flaticon-more-1"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-md">

												<!--begin::Nav-->
												<ul class="kt-nav">
													<li class="kt-nav__head">
														Messaging
														<i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
													</li>
													<li class="kt-nav__separator"></li>
													<li class="kt-nav__item">
														<a href="#" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-group"></i>
															<span class="kt-nav__link-text">New Group</span>
														</a>
													</li>
													<li class="kt-nav__item">
														<a href="#" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-open-text-book"></i>
															<span class="kt-nav__link-text">Contacts</span>
															<span class="kt-nav__link-badge">
																<span class="kt-badge kt-badge--brand  kt-badge--rounded-">5</span>
															</span>
														</a>
													</li>
													<li class="kt-nav__item">
														<a href="#" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-bell-2"></i>
															<span class="kt-nav__link-text">Calls</span>
														</a>
													</li>
													<li class="kt-nav__item">
														<a href="#" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-dashboard"></i>
															<span class="kt-nav__link-text">Settings</span>
														</a>
													</li>
													<li class="kt-nav__item">
														<a href="#" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-protected"></i>
															<span class="kt-nav__link-text">Help</span>
														</a>
													</li>
													<li class="kt-nav__separator"></li>
													<li class="kt-nav__foot">
														<a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
														<a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
													</li>
												</ul>

												<!--end::Nav-->
											</div>
										</div>
										<button type="button" class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
											<i class="flaticon2-cross"></i>
										</button>
									</div>
								</div>
							</div>
							<div class="kt-portlet__body">
								<div class="kt-scroll kt-scroll--pull" data-height="410" data-mobile-height="225">
									<div class="kt-chat__messages kt-chat__messages--solid">
										<div class="kt-chat__message kt-chat__message--success">
											<div class="kt-chat__user">
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/100_12.jpg" alt="image">
												</span>
												<a href="#" class="kt-chat__username">Jason Muller</span></a>
												<span class="kt-chat__datetime">2 Hours</span>
											</div>
											<div class="kt-chat__text">
												How likely are you to recommend our company<br> to your friends and family?
											</div>
										</div>
										<div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
											<div class="kt-chat__user">
												<span class="kt-chat__datetime">30 Seconds</span>
												<a href="#" class="kt-chat__username">You</span></a>
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/300_21.jpg" alt="image">
												</span>
											</div>
											<div class="kt-chat__text">
												Hey there, we’re just writing to let you know that you’ve<br> been subscribed to a repository on GitHub.
											</div>
										</div>
										<div class="kt-chat__message kt-chat__message--success">
											<div class="kt-chat__user">
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/100_12.jpg" alt="image">
												</span>
												<a href="#" class="kt-chat__username">Jason Muller</span></a>
												<span class="kt-chat__datetime">30 Seconds</span>
											</div>
											<div class="kt-chat__text">
												Ok, Understood!
											</div>
										</div>
										<div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
											<div class="kt-chat__user">
												<span class="kt-chat__datetime">Just Now</span>
												<a href="#" class="kt-chat__username">You</span></a>
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/300_21.jpg" alt="image">
												</span>
											</div>
											<div class="kt-chat__text">
												You’ll receive notifications for all issues, pull requests!
											</div>
										</div>
										<div class="kt-chat__message kt-chat__message--success">
											<div class="kt-chat__user">
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/100_12.jpg" alt="image">
												</span>
												<a href="#" class="kt-chat__username">Jason Muller</span></a>
												<span class="kt-chat__datetime">2 Hours</span>
											</div>
											<div class="kt-chat__text">
												You were automatically <b class="kt-font-brand">subscribed</b> <br>because you’ve been given access to the repository
											</div>
										</div>
										<div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
											<div class="kt-chat__user">
												<span class="kt-chat__datetime">30 Seconds</span>
												<a href="#" class="kt-chat__username">You</span></a>
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/300_21.jpg" alt="image">
												</span>
											</div>
											<div class="kt-chat__text">
												You can unwatch this repository immediately <br>by clicking here: <a href="#" class="kt-font-bold kt-link"></a>
											</div>
										</div>
										<div class="kt-chat__message kt-chat__message--success">
											<div class="kt-chat__user">
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/100_12.jpg" alt="image">
												</span>
												<a href="#" class="kt-chat__username">Jason Muller</span></a>
												<span class="kt-chat__datetime">30 Seconds</span>
											</div>
											<div class="kt-chat__text">
												Discover what students who viewed Learn <br>Figma - UI/UX Design Essential Training also viewed
											</div>
										</div>
										<div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
											<div class="kt-chat__user">
												<span class="kt-chat__datetime">Just Now</span>
												<a href="#" class="kt-chat__username">You</span></a>
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/300_21.jpg" alt="image">
												</span>
											</div>
											<div class="kt-chat__text">
												Most purchased Business courses during this sale!
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="kt-portlet__foot">
								<div class="kt-chat__input">
									<div class="kt-chat__editor">
										<textarea placeholder="Type here..." style="height: 50px"></textarea>
									</div>
									<div class="kt-chat__toolbar">
										<div class="kt_chat__tools">
											<a href="#"><i class="flaticon2-link"></i></a>
											<a href="#"><i class="flaticon2-photograph"></i></a>
											<a href="#"><i class="flaticon2-photo-camera"></i></a>
										</div>
										<div class="kt_chat__actions">
											<button type="button" class="btn btn-brand btn-md  btn-font-sm btn-upper btn-bold kt-chat__reply">reply</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--ENd:: Chat-->

@endsection

@section('script')
	<script src="{{ URL::asset('assets') }}/js/pages/custom/wizard/wizard-1.js" type="text/javascript"></script>
@endsection
