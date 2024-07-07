@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet">
			<div class="kt-portlet__body kt-portlet__body--fit nborder">
				<div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="step-first">
					<div class="kt-grid__item">
						<div class="kt-wizard-v1__nav">
							<div class="kt-wizard-v1__nav-items kt-wizard-v1__nav-items--clickable">
								<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current" id="generalinfo">
									<div class="kt-wizard-v1__nav-body">
										<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-bus-stop"></i>
										</div>
										<div class="kt-wizard-v1__nav-label">{{ __('customer.General Info') }}</div>
									</div>
								</div>
								<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current" id="supplierinfo">
									<div class="kt-wizard-v1__nav-body">
										<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-list"></i>
										</div>
										<div class="kt-wizard-v1__nav-label">{{ __('supplier.Supplier Info') }}</div>
									</div>
								</div>
								<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" id="officeinfo">
									<div class="kt-wizard-v1__nav-body">
										<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-responsive"></i>
										</div>
										<div class="kt-wizard-v1__nav-label">{{ __('customer.Office Info') }}</div>
									</div>
								</div>
								<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" id="contactinfo">
									<div class="kt-wizard-v1__nav-body">
										<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-responsive"></i>
										</div>
										<div class="kt-wizard-v1__nav-label">{{ __('customer.Contact Info') }}</div>
									</div>
								</div>
								<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" id="accountingConfig">
									<div class="kt-wizard-v1__nav-body">
										<div class="kt-wizard-v1__nav-icon"> <i class="flaticon2-list"></i>
										</div>
										<div class="kt-wizard-v1__nav-label">Accounting</div>
									</div>
								</div>
								<!-- <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" id="contactinfo">
									<div class="kt-wizard-v1__nav-body">
										<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-responsive"></i>
										</div>
										<div class="kt-wizard-v1__nav-label">{{ __('customer.Contact Info') }}</div>
									</div>
								</div> -->

							</div>
							<?php
							if (isset($userInfo->sup_type)) {
								$suptype = $userInfo->sup_type;
							} else {
								$suptype = '';
							}
							if (isset($userInfo->sup_category)) {
								$sup_category = $userInfo->sup_category;
							} else {
								$sup_category = '';
							}
							if (isset($userInfo->salesman)) {
								$sales_man = $userInfo->salesman;
							} else {
								$sales_man = '';
							}
							if (isset($userInfo->key_account)) {
								$key_ac = $userInfo->key_account;
							} else {
								$key_ac = '';
							}
							?>
							<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
								<form class="kt-form" id="kt_form">
									<div class="kt-wizard-v1__content p-0" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">{{ __('supplier.Supplier Details') }}</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>
										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">
											<div class="kt-wizard-v1__form">
												<div class="separator separator-dashed separator-border-2 mb-5"></div>
												<div class="row">
													<input type="hidden" name="id" id="id" value="{{isset($userInfo->id)? $userInfo->id :''}}">
													<input type="hidden" name="branch" id="branch" value="{{$branch}}">
													<div class="col-lg-6">
														<div class="form-group row  pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Supplier Category') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8 input-group input-group-sm">
																<select class="form-control single-select sup_category" id="sup_category" name="sup_category">
																	<option value="">Select</option>@foreach($areaList as $item)
																	<?php if ($item->id != $sup_category) { ?>
																		<option value="{{$item->id}}">{{$item->title}}</option>
																	<?php } else { ?>
																		<option value="{{$item->id}}" selected>{{$item->title}}</option>
																		<?php } ?>@endforeach
																</select>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Supplier Code') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control" name="sup_code" id="sup_code" placeholder="{{ __('supplier.Supplier Code') }}" autocomplete="off" value="{{isset($userInfo->sup_code)? $userInfo->sup_code :''}}" readonly="">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row  pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Supplier Type') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8 input-group input-group-sm">
																<select class="form-control single-select" id="sup_type" name="sup_type">
																	<option value="">{{ __('supplier.Select') }}</option>@foreach($areaLists as $item)
																	<?php if ($item->id != $suptype) { ?>
																		<option value="{{$item->id}}">{{$item->title}}</option>
																	<?php } else { ?>
																		<option value="{{$item->id}}" selected>{{$item->title}}</option>
																		<?php } ?>@endforeach
																</select>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Supplier Group') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8  input-group input-group-sm">
																<select class="form-control single-select" name="sup_note" id="sup_note">
																	<option value="">{{ __('customer.Select') }}
																	</option>@foreach($group as $item)
																	<option value="{{$item->id}}">{{$item->title}}
																	</option>@endforeach
																</select>
															</div>
														</div>
													</div>


													<div class="col-lg-6">
														<div class="form-group row  pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Salesman') }}<label>
															</div>
															<div class="col-md-8 input-group input-group-sm">
																<select class="form-control single-select" id="salesman" name="salesman">
																	<option value="">{{ __('vendor.Select') }}</option>
																	@foreach($salesman as $item)
																	<?php if ($item->id != $sales_man) { ?>
																		<option value="{{$item->id}}">{{$item->name}}</option>
																	<?php } else { ?>
																		<option value="{{$item->id}}" selected>{{$item->name}}</option>
																	<?php } ?>
																	@endforeach
																</select>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row  pl-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Key Accounts') }}</label>
															</div>
															<div class="col-md-8 input-group input-group-sm">
																<select class="form-control single-select" id="key_account" name="key_account">
																	<option value="">{{ __('supplier.Select') }}</option>@foreach($keyaccountants as $item)
																	<?php if ($item->id != $key_ac) { ?>
																		<option value="{{$item->id}}">{{$item->name}}</option>
																	<?php } else { ?>
																		<option value="{{$item->id}}" selected>{{$item->name}}</option>
																	<?php
																	} ?>
																	@endforeach
																</select>
															</div>
														</div>
													</div>



												</div>
											</div>
										</div>
									</div>
									<div class="kt-wizard-v1__content p-0" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">{{ __('supplier.Supplier Details') }}</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>
										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">
											<div class="kt-wizard-v1__form">
												<div class="separator separator-dashed separator-border-2 mb-5"></div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Supplier Name') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8 ">
																<div class="input-group input-group-sm">

																	<input type="text" class="form-control" id="sup_name" name="sup_name" autocomplete="off" placeholder="{{ __('supplier.Supplier Name') }}" value="{{isset($userInfo->sup_name)?$userInfo->sup_name:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Supplier Name') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8 ">
																<div class="input-group input-group-sm">

																	<input type="text" class="form-control" id="sup_name_ar" name="sup_name_ar" autocomplete="off" placeholder="{{ __('supplier.Supplier Name') }}{{ __('customer.Arabic') }}" value="{{isset($userInfo->sup_name)?$userInfo->sup_name:''}}">
																</div>
															</div>
														</div>
													</div>


													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Building No') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" autocomplete="off" placeholder="{{ __('customer.Building No') }}" id="sup_add1" name="sup_add1" onchange="myFunctions(this.value)">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Building No') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" autocomplete="off" placeholder="{{ __('customer.Building No') }}{{ __('customer.Arabic') }}" id="sup_add1_ar" name="sup_add1_ar" onchange="myFunctions(this.value)">
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

																	<input type="text" class="form-control" autocomplete="off" placeholder="{{ __('customer.Street Name') }}" id="sup_add2" name="sup_add2" onchange="myFunctionadd(this.value)">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Street Name') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" autocomplete="off" placeholder="{{ __('customer.Street Name') }}{{ __('customer.Arabic') }}" id="sup_add2_ar" name="sup_add2_ar" onchange="myFunctionadd(this.value)">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.District') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="sup_region" name="sup_region" autocomplete="off" placeholder="{{ __('customer.District') }}" onchange="myFunctionregion(this.value)" value="{{isset($userInfo->sup_region)?$userInfo->sup_region:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.District') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="sup_region_ar" name="sup_region_ar" autocomplete="off" placeholder="{{ __('customer.District') }}{{ __('customer.Arabic') }}" onchange="myFunctionregion(this.value)" value="{{isset($userInfo->sup_region)?$userInfo->sup_region:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Province / State') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="sup_state" name="sup_state" autocomplete="off" placeholder="{{ __('customer.Province / State') }}" onchange="myFunctioncity(this.value)">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Province / State') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="sup_state_ar" name="sup_state_ar" autocomplete="off" placeholder="{{ __('customer.Province / State') }}{{ __('customer.Arabic') }}" onchange="myFunctioncity(this.value)">
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

																	<input type="text" class="form-control" id="sup_city" name="sup_city" autocomplete="off" placeholder="{{ __('customer.City') }}" onchange="myFunctioncity(this.value)" value="{{isset($userInfo->sup_city)?$userInfo->sup_city:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.City') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="sup_city_ar" name="sup_city_ar" autocomplete="off" placeholder="{{ __('customer.City') }}{{ __('customer.Arabic') }}" onchange="myFunctioncity(this.value)" value="{{isset($userInfo->sup_city)?$userInfo->sup_city:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Country') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	<!--  <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i
									 class="fa fa-globe" aria-hidden="true"></i></span>
															</div> -->
																	<select name="sup_country" id="sup_country" class="form-control single-select">
																		<option value="">{{ __('customer.Select') }}</option>@foreach($country as $coun)
																		<option value="{{$coun->id}}">{{$coun->cntry_name}}</option>@endforeach
																	</select>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Country') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="sup_country_ar" name="sup_country_ar" autocomplete="off" placeholder="{{ __('customer.Country') }}{{ __('customer.Arabic') }}" onchange="myFunctioncity(this.value)">
																</div>
															</div>
														</div>
													</div>


													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Zip Code') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="sup_zip" name="sup_zip" autocomplete="off" placeholder="{{ __('supplier.Zip Code') }}" onchange="myFunctionzip(this.value)" value="{{isset($userInfo->sup_zip)?$userInfo->sup_zip:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Zip Code') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="sup_zip_ar" name="sup_zip_ar" autocomplete="off" placeholder="{{ __('supplier.Zip Code') }}{{ __('customer.Arabic') }}" onchange="myFunctionzip(this.value)" value="{{isset($userInfo->sup_zip)?$userInfo->sup_zip:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Additional Number') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="additionalno" name="additionalno" autocomplete="off" placeholder="{{ __('customer.Additional Number') }}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Additional Number') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="additionalno_ar" name="additionalno_ar" autocomplete="off" placeholder="{{ __('customer.Additional Number') }}{{ __('customer.Arabic') }}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Vat No') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="vatno" name="vatno" autocomplete="off" placeholder="{{ __('customer.Vat No') }}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Vat No') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="vatno_ar" name="vatno_ar" autocomplete="off" placeholder="{{ __('customer.Vat No') }}{{ __('customer.Arabic') }}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Buyer ID / CR No') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="buyerid_crno" name="buyerid_crno" autocomplete="off" placeholder="{{ __('customer.Buyer ID / CR No') }}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Buyer ID / CR No') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="buyerid_crno_ar" name="buyerid_crno_ar" autocomplete="off" placeholder="{{ __('customer.Buyer ID / CR No') }}{{ __('customer.Arabic') }}">
																</div>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
									<div class="kt-wizard-v1__content p-0" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">{{ __('customer.Office Info') }}</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>
										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">
											<div class="kt-wizard-v1__form">
												<div class="separator separator-dashed separator-border-2 mb-5"></div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Primary Email') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="email1" name="email1" onchange="myFunction(this.value)" autocomplete="off" placeholder="{{ __('supplier.Primary Email') }}" value="{{isset($userInfo->email1)?$userInfo->email1:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Secondary Email') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="email2" name="email2" autocomplete="off" placeholder="{{ __('supplier.Secondary Email') }}" onchange="myFunctionemail(this.value)" value="{{isset($userInfo->email2)?$userInfo->email2:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Office Phone No: 1') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="office_phone1" name="office_phone1" autocomplete="off" placeholder="{{ __('supplier.Office Phone No:1') }}" onchange="myFunctionphone(this.value)" value="{{isset($userInfo->office_phone1)?$userInfo->office_phone1:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Office Phone No: 2') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="office_phone2" name="office_phone2" autocomplete="off" placeholder="{{ __('supplier.Office Phone No:1') }}" onchange="myFunctionphone2(this.value)" value="{{isset($userInfo->office_phone2)?$userInfo->office_phone2:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Mobile No: 1') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="number" class="form-control" id="mobile1" name="mobile1" autocomplete="off" placeholder="{{ __('supplier.Mobile No: 1') }}" onchange="myFunctionmobile(this.value)" value="{{isset($userInfo->mobile1)?$userInfo->mobile1:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Mobile No: 2') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="number" class="form-control" id="mobile2" name="mobile2" autocomplete="off" placeholder="{{ __('supplier.Mobile No: 2') }}" onchange="myFunctionmobile1(this.value)" value="{{isset($userInfo->mobile2)?$userInfo->mobile2:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Fax') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm ">

																	<input type="text" class="form-control" id="fax" name="fax" autocomplete="off" placeholder="{{ __('supplier.Fax') }}" value="{{isset($userInfo->fax)?$userInfo->fax:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Website') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm ">

																	<input type="text" class="form-control" id="website" name="website" autocomplete="off" placeholder="{{ __('supplier.Website') }}" value="{{isset($userInfo->website)?$userInfo->website:''}}">
																</div>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
									<div class="kt-wizard-v1__content p-0" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">{{ __('supplier.Contact Person') }}</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>
										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">
											<div class="kt-wizard-v1__form">
												<div class="separator separator-dashed separator-border-2 mb-5"></div>
												<div class="row">

													<div class="col-md-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Contact Person') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">

																	<input type="text" class="form-control" placeholder="{{ __('supplier.Contact Person') }} " id="contact_persons" name="contact_persons" autocomplete="off" onchange="myFunctionsperson(this.value)" value="{{isset($userInfo->contact_persons)?$userInfo->contact_persons:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Mobile No: 1') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="number" class="form-control" placeholder="{{ __('supplier.Mobile No: 1') }}" id="mobile" name="mobile" autocomplete="off" onchange="myFunctionmobiles(this.value)" value="{{isset($userInfo->mobile)?$userInfo->mobile:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Office Number') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm ">

																	<input type="number" class="form-control" placeholder="{{ __('supplier.Office Number') }}" id="office" name="office" autocomplete="off" onchange="myFunctionoffice(this.value)" value="{{isset($userInfo->office)?$userInfo->office:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Email') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" placeholder="{{ __('supplier.Email') }}" id="email" name="email" autocomplete="off" onchange="myFunctionsemail(this.value)" value="{{isset($userInfo->email)?$userInfo->email:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Department') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" placeholder="{{ __('supplier.Department') }}" id="contact_department" name="contact_department" autocomplete="off" onchange="myFunctionsdepartments(this.value)" value="{{isset($userInfo->contact_department)?$userInfo->contact_department:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Designation') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm ">

																	<input type="text" class="form-control" placeholder="{{ __('supplier.Designation') }}" id="location" name="location" autocomplete="off" onchange="myFunctionslocation(this.value)" value="{{isset($userInfo->location)?$userInfo->location:''}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<button class="btn btn-sm btn-default btn-bold pull-right" id="add_more_table">{{ __('app.Save And Add') }}</button>
															<br>
															<br>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<table class="table table-striped newtable">
															<thead>
																<tr>
																	<th></th>
																	<th>{{ __('supplier.Contact Person') }}</th>
																	<th>{{ __('supplier.Mobile Number') }}</th>
																	<th>{{ __('supplier.Office Number') }}</th>
																	<th>{{ __('customer.Email') }}</th>
																	<th>{{ __('customer.Department') }}</th>
																	<th>{{ __('customer.Designation') }}</th>
																	<th>{{ __('customer.Action') }}</th>
																</tr>
															</thead>
															<tbody id="tbadd"></tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">Accounting Configuration</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>
										<div class="form-group row">
											<label class="col-1 col-form-label">&nbsp;</label>
											<div class="col-11">
												<div class="kt-radio-inline">
													<label class="kt-radio kt-radio--tick kt-radio--success">
														<input type="radio" name="accountType" value="existing account" checked="checked"> Existing Account
														<span></span>
													</label>
													<label class="kt-radio kt-radio--tick kt-radio--success">
														<input type="radio" name="accountType" value="new account"> New Account
														<span></span>
													</label>
												</div>
												<div class="existingAccount" style="display: block;">
													<div class="kt-wizard-v1__form">
														<div class="row">

															<div class="col-lg-12">
																<div class="form-group row pr-md-3">
																	<div class="col-md-2">
																		<label>Ledger Account<span style="color: red">*</span></label>
																	</div>
																	<div class="col-md-10">
																		<div class="input-group  input-group-sm">
																			<select name="account_ledger" id="account_ledger" class="form-control single-select">
																				<option value="">Select Account</option>
																				@foreach($fullLedger as $ledger)
																				<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}}>
																					@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
																						@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="newAccount" style="display: none;">
													<div class="kt-wizard-v1__form">
														<div class="row">
															<div class="col-lg-12">
																<h4> Add Ledger</h4>
															</div>
															<div class="col-lg-5">
																<div class="form-group ">
																	<label>Parent Group<span style="color: red">*</span></label>
																	<div class="input-group">
																		<select name="l_group_id" id="l_group_id" class="form-control single-select">
																			<option value="">Select Group</option>
																			@foreach($fullGroups as $ledger)
																			<option value="{{$ledger['id']}}">
																				@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
																					@endforeach
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group ">
																	<label>Ledger Code</label>
																	<div class="input-group">
																		<input type="text" class="form-control" id="l_code" name="l_code" autocomplete="off" placeholder="Ledger Code" readonly>
																	</div>
																</div>
															</div>
															<div class="col-lg-5">
																<div class="form-group ">
																	<label>Ledger Name<span style="color: red">*</span></label>
																	<div class="input-group">
																		<input type="text" class="form-control" id="l_name" name="l_name" autocomplete="off" placeholder="Ledger Name">
																	</div>
																</div>
															</div>

															<div class="col-lg-4">
																<div class="form-group ">
																	<label>Opening balance<span style="color: red">*</span></label>
																	<div class="input-group">
																		<select name="l_op_balance_dc" id="l_op_balance_dc" class="form-control single-select">
																			<option value="D" selected>Dr</option>
																			<option value="C">Cr</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-lg-8">
																<div class="form-group ">
																	<label>&nbsp;</label>
																	<div class="input-group">
																		<input type="text" class="form-control integerVal" id="l_op_balance" name="l_op_balance" autocomplete="off" value="0" placeholder="Opening balance">
																	</div>
																</div>
															</div>

															<div class="col-lg-4">
																<label></label>
																<div class="col-lg-12">
																	<div class="form-group">
																		<label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
																			<input type="checkbox" id="l_type" value="1"> Bank or cash account
																			<span></span>
																		</label>
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="form-group">
																		<label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
																			<input type="checkbox" id="l_reconciliation" value="1"> Reconciliation
																			<span></span>
																		</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-8">
																<div class="form-group ">
																	<label>Notes</label>
																	<div class="input-group">
																		<textarea name="l_notes" id="l_notes" cols="30" rows="3" class="form-control"></textarea>
																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>


											</div><!-- ./col-11 -->
										</div><!-- ./form-group row -->
									</div><!-- ./kt-wizard-v1__content -->

									<!-- <div class="kt-wizard-v1__content p-0" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">{{ __('supplier.Other Details') }}</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>

									</div> -->

									<div class="kt-form__actions">
										<button class="btn btn-secondary btn-icon-sm kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> &nbsp; {{ __('supplier.Previous') }}</button>
										<button id="Supplier_submit" class="btn btn-brand btn-icon-sm kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
												<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
												<polyline points="22 4 12 14.01 9 11.01"></polyline>
											</svg> {{ __('app.Save') }}</i>
										</button>
										<button class="btn btn-brand btn-icon-sm kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">{{ __('supplier.Next Step') }} &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div></span>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<script src="{{url('/')}}/public/assets/js/pages/custom/wizard/wizard-1.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/crm/supplier.js" type="text/javascript"></script>

<script>
	$(document).ready(function() {
		$("#eye1").click(function() {
			$(this).hide();
			$("#eye0").show();
			$("#pass").attr("type", "text");
		});
		$("#eye0").click(function() {
			$(this).hide();
			$("#eye1").show();
			$("#pass").attr("type", "password");
		});
		//adcode
		$("#adm").click(function() {
			$cnt = $("#cnt").val();
			$inch = $("#inch").val();
			$mob = $("#mob").val();
			$off = $("#off").val();
			$ema = $("#ema").val();
			$dep = $("#dep").val();
			$loc = $("#loc").val();
			$adcode = "<tr><td>" + $cnt + "</td><td>" + $inch + "</td><td>" + $mob + "</td><td>" + $off + "</td><td>" + $ema + "</td><td>" + $dep + "</td><td>" + $loc + "</td><td><button class='btn btn-dark' id='remove'><i class='fa fa-trash' style='padding-right: 0;'></i></button></td></tr>";
			$("#tbadd").append($adcode);
			$("#cnt").val("");
			$("#inch").val("");
			$("#mob").val("");
			$("#off").val("");
			$("#ema").val("");
			$("#dep").val("");
			$("#loc").val("");
		});
		$("#spintog").focusin(function() {
			$("#spin").show();
		});
		$("#spintog").focusout(function() {
			$("#spin").hide();
		});
	});
</script>
<script type="text/javascript">
	var i = 1;
	$("#add_more_table").click(function() {
		$cnt = $("#contact_persons").val();
		$mob = $("#mobile").val();
		$off = $("#office").val();
		$ema = $("#email").val();
		$dep = $("#contact_department").val();
		$loc = $("#location").val();
		if ($cnt == "") {
			$("#officeinfo").trigger("click");
			toastr.warning('Please Enter Contact Name');
			return false;
		} else {
			$adcode = "<tr class='addmore'><td><input type='hidden' id='' name='slno[0]'  class='slno' value=" + i + "></td><td><input type='text' id='contact_personvalue' name='contact_personvalue[0]'  class='form-control contact_personvalue' value=" + $cnt + "></td><td><input type='text' id='mobiles' name='mobiles[0]'  class=' form-control mobiles' value=" + $mob + "></td><td><input type='text' id='offices' name='offices[0]'  class='form-control offices' value=" + $off + "></td><td><input type='text' id='emails' name='emails[0]'  class='form-control emails' value=" + $ema + "></td><td><input type='text' id='departments' name='departments[0]'  class='form-control departments' value=" + $dep + "></td><td><input type='text' id='locations' name='locations[0]'  class='form-control locations' value=" + $loc + "></td><td><button class='btn btn-dark' id='remove'><i class='fa fa-trash' style='padding-right: 0;'></i></button></td></tr>";
			$("#tbadd").append($adcode);
		}
		$("#contact_persons").val("");
		$("#mobile").val("");
		$("#office").val("");
		$("#email").val("");
		$("#contact_department").val("");
		$("#location").val("");
	});
	i++;
	$("#spintog").focusin(function() {
		$("#spin").show();
	});
	$("#spintog").focusout(function() {
		$("#spin").hide();
	});
	$(document).on("click", "#remove", function() {
		$(this).parent().addClass("delete");
		$(".delete").parent().remove();
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('change', '.sup_category', function() {
			var cat_id = $(this).val();
			$.ajax({
				type: 'POST',
				url: 'sgetcategorycode',
				data: {
					_token: $('#token').val(),
					'id': cat_id
				},
				success: function(data) {
					$.each(data, function(key, value) {
						$("#sup_code").val(value.customcode + '/' + value.increment);
					});
				},
				error: function() {}
			});

		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {


		$('input[name="accountType"]').change(function() {
			var selectedValue = $('input[name="accountType"]:checked').val();
			if (selectedValue == 'new account') {
				$('.newAccount').show();
				$('.existingAccount').hide();
				$('#account_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');
				$('#account_ledger').val('');
			} else if (selectedValue == 'existing account') {
				$('.newAccount').hide();
				$('.existingAccount').show();

				$('#l_group_id').next().find('.select2-selection').removeClass('select-dropdown-error');
				$('#l_code').removeClass('is-invalid');
				$('#l_name').removeClass('is-invalid');
				$('#l_op_balance').removeClass('is-invalid');

				$('#l_group_id').val('');
				$('#l_code').val('');
				$('#l_name').val('');
				$('#l_op_balance_dc').val('D');
				$('#l_op_balance').val(0);
				$('#l_type').prop('checked', false);
				$('#l_reconciliation').prop('checked', false);
				$('#l_notes').val('');
			}
			$('.single-select').select2();
		});

		$(document).on('change', '#l_group_id', function() {
			var cat_id = $(this).val();
			$.ajax({
				type: 'POST',
				url: 'get-accounting-next-code',
				dataType: 'json',
				data: {
					_token: $('#token').val(),
					'id': cat_id
				},
				success: function(data) {
					if (data.status == 1)
						$('#l_code').val(data.code);
					else
						toastr.warning('Code Not Found Please Contact Admin.');
				},
				error: function() {}
			});


		});


		$('#email1').focusout(function() {
			$('#email1').filter(function() {
				var email = $('#email1').val();
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (!emailReg.test(email)) {
					$('#email1').val("");
					$('#email1').addClass('is-invalid');
					toastr.warning('Please Enter Valid Email.');
				}
			});
		});
		$('#email2').focusout(function() {
			$('#email2').filter(function() {
				var email = $('#email2').val();
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (!emailReg.test(email)) {
					toastr.warning('Please Enter Valid Email.');
				}
			});
		});
		$('#invoice_email1').focusout(function() {
			$('#invoice_email1').filter(function() {
				var email = $('#invoice_email1').val();
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (!emailReg.test(email)) {
					toastr.warning('Please Enter Valid Email.');
				}
			});
		});
		$('#invoice_email2').focusout(function() {
			$('#invoice_email2').filter(function() {
				var email = $('#invoice_email2').val();
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (!emailReg.test(email)) {
					toastr.warning('Please Enter Valid Email.');
				}
			});
		});
		$('#shipping_email1').focusout(function() {
			$('#shipping_email1').filter(function() {
				var email = $('#shipping_email1').val();
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (!emailReg.test(email)) {
					toastr.warning('Please Enter Valid Email.');
				}
			});
		});
		$('#shipping_email2').focusout(function() {
			$('#shipping_email2').filter(function() {
				var email = $('#shipping_email2').val();
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (!emailReg.test(email)) {
					toastr.warning('Please Enter Valid Email.');
				}
			});
		});

		$('#registerd_email').focusout(function() {
			$('#registerd_email').filter(function() {
				var email = $('#registerd_email').val();
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (!emailReg.test(email)) {
					toastr.warning('Please Enter Valid Email.');
				}
			});
		});
	});
</script>
<script type="text/javascript">
	$('#mobile1').focusout(function() {
		$('#mobile1').filter(function() {
			var a = $("#mobile1").val();
			var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
			if (!filter.test(a)) {
				$("#mobile1").val("");
				//toastr.warning('Please Enter Valid Phone Number.');
			}
		});
	});
	$('#mobile2').focusout(function() {
		$('#mobile2').filter(function() {
			var a = $("#mobile2").val();
			var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
			if (!filter.test(a)) {
				//toastr.warning('Please Enter Valid Phone Number.');
			}
		});
	});
	$('#mobile').focusout(function() {
		$('#mobile').filter(function() {
			var a = $("#mobile").val();
			var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
			if (!filter.test(a)) {
				//toastr.warning('Please Enter Valid Phone Number.');
			}
		});
	});

	$('#office_phone1').focusout(function() {
		$('#office_phone1').filter(function() {
			var a = $("#office_phone1").val();
			var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
			if (!filter.test(a)) {
				//toastr.warning('Please Enter Valid Phone Number.');
			}
		});
	});

	$('#office_phone2').focusout(function() {
		$('#office_phone2').filter(function() {
			var a = $("#office_phone2").val();
			var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
			if (!filter.test(a)) {
				//toastr.warning('Please Enter Valid Phone Number.');
			}
		});
	});

	$('#shipping_mobile1').focusout(function() {
		$('#shipping_mobile1').filter(function() {
			var a = $("#shipping_mobile1").val();
			var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
			if (!filter.test(a)) {
				//toastr.warning('Please Enter Valid Phone Number.');
			}
		});
	});

	$('#shipping_mobile2').focusout(function() {
		$('#shipping_mobile2').filter(function() {
			var a = $("#shipping_mobile2").val();
			var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
			if (!filter.test(a)) {
				//toastr.warning('Please Enter Valid Phone Number.');
			}
		});
	});
</script>
<script type="text/javascript">
	$(document).on('click', '#Supplier_submit', function(e) {
		e.preventDefault();
		var sup_code = $('#sup_code').val();
		var sup_type = $('#sup_type').val();
		var sup_category = $('#sup_category').val();
		var salesman = $('#salesman').val();
		var key_account = $('#key_account').val();
		var sup_name = $('#sup_name').val();
		var sup_note = $('#sup_note').val();
		var sup_country = $('#sup_country').val();
		var mobile = $('#mobile').val();
		var contact_persons = $('#contact_persons').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var email1 = $('#email1').val();
		var mobile1 = $('#mobile1').val();
		//	alert(password);

		if (sup_category == "") {
			$('#sup_category').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning('Supplier Category is Required.');
			$("#generalinfo").trigger("click");
			return false;
		} else {
			$('#sup_category').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (sup_code == "") {
			$('#sup_code').addClass('is-invalid');
			toastr.warning('Supplier Code is Required.');
			$("#generalinfo").trigger("click");
			return false;
		} else {
			$('#sup_code').removeClass('is-invalid');
		}
		if (sup_type == "") {
			$('#sup_type').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning('Supplier Type is Required.');
			$("#generalinfo").trigger("click");
			return false;
		} else {
			$('#sup_type').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (sup_note == "") {
			$('#sup_note').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning('Supplier Group is Required.');
			$("#generalinfo").trigger("click");
			return false;
		} else {
			$('#sup_note').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (sup_name == "") {
			$('#sup_name').addClass('is-invalid');
			toastr.warning('Supplier Name is Required.');
			$("#supplierinfo").trigger("click");
			return false;
		} else {
			$('#sup_name').removeClass('is-invalid');
		}
		if (sup_country == "") {
			$('#sup_country').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning('Supplier Country is Required.');
			$("#supplierinfo").trigger("click");
			return false;
		} else {
			$('#sup_country').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (email1 == "") {
			$('#email1').addClass('is-invalid');
			toastr.warning('Email is Required.');
			$("#officeinfo").trigger("click");
			return false;
		} else
			$('#email1').removeClass('is-invalid');


		var accountType = $('input[name="accountType"]:checked').val();
		if (accountType == 'new account') {
			if ($('#l_group_id').val() == "") {
				$('#l_group_id').next().find('.select2-selection').addClass('select-dropdown-error');
				toastr.warning('Ledger Parent Group is Required.');
				$("#accountingConfig").trigger("click");
				return false;
			} else
				$('#l_group_id').next().find('.select2-selection').removeClass('select-dropdown-error');
			if ($('#l_code').val() == "") {
				$('#l_code').addClass('is-invalid');
				toastr.warning('Ledger Code is Required.');
				$("#accountingConfig").trigger("click");
				return false;
			} else
				$('#l_code').removeClass('is-invalid');

			if ($('#l_name').val() == "") {
				$('#l_name').addClass('is-invalid');
				toastr.warning('Ledger Name is Required.');
				$("#accountingConfig").trigger("click");
				return false;
			} else
				$('#l_name').removeClass('is-invalid');

			if ($('#l_op_balance').val() == "") {
				$('#l_op_balance').addClass('is-invalid');
				toastr.warning('Oppening Balance is Required.');
				$("#accountingConfig").trigger("click");
				return false;
			} else
				$('#l_op_balance').removeClass('is-invalid');


		} else if (accountType == 'existing account') {
			if ($('#account_ledger').val() == "") {
				$('#account_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
				toastr.warning('Ledger Account is Required.');
				$("#accountingConfig").trigger("click");
				return false;
			} else
				$('#account_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');
		}





		var info_id = $('#id').val();
		var contact_personvalue = [];
		var slno = [];
		var contact_person_incharges = [];
		var mobiles = [];
		var offices = [];
		var emails = [];
		var departments = [];
		var locations = [];
		$(".addmore").each(function() {
			contact_personvalue.push($(this).find(".contact_personvalue").val());
			contact_person_incharges.push($(this).find(".contact_person_incharge").val());
			slno.push($(this).find(".slno").val());
			mobiles.push($(this).find(".mobiles").val());
			offices.push($(this).find(".offices").val());
			emails.push($(this).find(".emails").val());
			departments.push($(this).find(".departments").val());
			locations.push($(this).find(".locations").val());
		});


		$(this).addClass('kt-spinner');
		$(this).prop("disabled", true);

		$.ajax({
			type: "POST",
			url: "SupplierSubmit",
			dataType: "json",
			data: {
				_token: $('#token').val(),
				info_id: $('#id').val(),
				sup_code: $('#sup_code').val(),
				sup_type: $('#sup_type').val(),
				sup_category: $('#sup_category').val(),
				salesman: $('#salesman').val(),
				key_account: $('#key_account').val(),
				sup_name_alias: $("#sup_name_alias").val(),
				sup_name_alias_ar: $("#sup_name_alias_ar").val(),
				sup_note: $('#sup_note').val(),
				sup_name: $('#sup_name').val(),
				sup_name_ar: $('#sup_name_ar').val(),
				sup_add1: $('#sup_add1').val(),
				sup_add1_ar: $('#sup_add1_ar').val(),
				sup_add2: $('#sup_add2').val(),
				sup_add2_ar: $('#sup_add2_ar').val(),
				sup_country: $('#sup_country').val(),
				sup_country_ar: $('#sup_country_ar').val(),
				sup_region: $('#sup_region').val(),
				sup_region_ar: $('#sup_region_ar').val(),
				sup_city: $('#sup_city').val(),
				sup_city_ar: $('#sup_city_ar').val(),
				sup_zip: $('#sup_zip').val(),
				sup_zip_ar: $('#sup_zip_ar').val(),
				email1: $('#email1').val(),
				email2: $('#email2').val(),
				office_phone1: $('#office_phone1').val(),
				office_phone2: $('#office_phone2').val(),
				mobile1: $('#mobile1').val(),
				mobile2: $('#mobile2').val(),
				fax: $('#fax').val(),
				website: $('#website').val(),
				contact_person: $('#contact_person').val(),
				contact_person_incharge: $('#contact_person_incharge').val(),
				mobile: $('#mobile').val(),
				office: $('#office').val(),
				contact_department: $('#contact_department').val(),
				email: $('#email').val(),
				location: $('#location').val(),
				name_areas: $('#name_areas').val(),
				username: $('#username').val(),
				password: $('#password').val(),
				additionalno: $('#additionalno').val(),
				additionalno_ar: $('#additionalno_ar').val(),
				vatno: $('#vatno').val(),
				vatno_ar: $('#vatno_ar').val(),
				buyerid_crno: $('#buyerid_crno').val(),
				buyerid_crno_ar: $('#buyerid_crno_ar').val(),
				sup_state: $('#sup_state').val(),
				sup_state_ar: $('#sup_state_ar').val(),
				contact_personvalue: contact_personvalue,
				contact_person_incharges: contact_person_incharges,
				mobiles: mobiles,
				offices: offices,
				emails: emails,
				departments: departments,
				locations: locations,
				branch: $('#branch').val(),

				accountType: accountType,
				account_ledger: $('#account_ledger').val(), //Existing account
				l_group_id: $('#l_group_id').val(), //new Account
				l_code: $('#l_code').val(), //new Account
				l_name: $('#l_name').val(), //new Account
				l_op_balance_dc: $('#l_op_balance_dc').val(), //new Account
				l_op_balance: $('#l_op_balance').val(), //new Account
				l_type: $('#l_type').prop('checked') ? $('#l_type').val() : 0, //new Account
				l_reconciliation: $('#l_reconciliation').prop('checked') ? $('#l_type').val() : 0, //new Account
				l_notes: $('#l_notes').val() //new Account

			},
			success: function(data) {
				if (data == false) {
					$('#Supplier_submit').removeClass('kt-spinner');
					$('#Supplier_submit').prop("disabled", false);
					toastr.warning('Supplier is Already Exist');

				} else {
					toastr.success('Supplier Details Added Successfully!.');
					window.location.href = "supplierdetails";
				}

			},
			error: function(jqXhr, json, errorThrown) {
				var errors = jqXhr.responseJSON;
				var errorsHtml = '';
				$.each(errors, function(key, value) {
					if (jQuery.isPlainObject(value)) {

						$.each(value, function(index, ndata) {
							errorsHtml += '<li>' + ndata + '</li>';
						});

					} else {

						errorsHtml += '<li>' + value + '</li>';

					}
				});

				$('#Supplier_submit').prop("disabled", false);
				toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
			}
		});

		return false;

	});
</script>
<script>
	$('.SupplierManagement').addClass('kt-menu__item--open');
	$('.supplierdetails').addClass('kt-menu__item--active');
</script>

@endsection