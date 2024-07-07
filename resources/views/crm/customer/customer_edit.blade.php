@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content" style="padding-bottom: 0;">
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
								<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" id="customerinfo">
									<div class="kt-wizard-v1__nav-body">
										<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-list"></i>
										</div>
										<div class="kt-wizard-v1__nav-label">{{ __('customer.Customer Info') }}</div>
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
										<div class="kt-wizard-v1__nav-label">{{ __('customer.Accounting Configuration') }}</div>
									</div>
								</div>

								<!-- <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
									<div class="kt-wizard-v1__nav-body">
										<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-truck"></i>
										</div>
										<div class="kt-wizard-v1__nav-label">Credentials</div>
									</div>
								</div> -->
								<!--end: Form Wizard Nav -->
							</div>
							<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
								@php
								foreach ($data as $key=>$value)
								{
								$cust_id = $data->id;
								$cust_code = $data->cust_code;
								$cust_type = $data->cust_type;
								$cust_group = $data->cust_group;
								$name_areas = $data->name_areas;
								$cust_category = $data->cust_category;
								$salesmans = $data->salesman;
								$key_account = $data->key_account;
								$cust_note = $data->cust_note;
								$cust_name = $data->cust_name;
								$cust_add1 = $data->cust_add1;
								$cust_add2 = $data->cust_add2;
								$cust_country = $data->cust_country;
								$cust_region = $data->cust_region;
								$cust_city = $data->cust_city;
								$cust_zip = $data->cust_zip;
								$email1 = $data->email1;
								$email2 = $data->email2;
								$office_phone1 = $data->office_phone1;
								$office_phone2 = $data->office_phone2;
								$mobile1 = $data->mobile1;
								$mobile2 = $data->mobile2;
								$fax = $data->fax;
								$website = $data->website;
								$contact_person = $data->contact_person;
								$contact_person_incharge = $data->contact_person_incharge;
								$mobile = $data->mobile;
								$office = $data->office;
								$contact_department = $data->contact_department;
								$email = $data->email;
								$location = $data->location;
								$portal = $data->portal;
								$username = $data->username;
								$registerd_email = $data->registerd_email;
								$password = $data->password;
								$custcontact_person=$data->custcontact_person;
								$cust_name_alias = $data->cust_name_alias;
								$Checkedinvoice_value= $data->Checkedinvoice_value;
								$invoice_add1 = $data->invoice_add1;
								$invoice_add2 = $data->invoice_add2;
								$invoice_country = $data->invoice_country;
								$invoice_region = $data->invoice_region;
								$invoice_city = $data->invoice_city;
								$invoice_zip = $data->invoice_zip;
								$invoice_email1 = $data->invoice_email1;
								$invoice_email2 = $data->invoice_email2;
								$invoice_office_phone1 = $data->invoice_office_phone1;
								$invoice_office_phone2 = $data->invoice_office_phone2;
								$invoice_mobile1 = $data->invoice_mobile1;
								$invoice_mobile2 = $data->invoice_mobile2;
								$Checkedshipping_value= $data->Checkedshipping_value;
								$shipping1= $data->shipping1;
								$shipping2= $data->shipping2;
								$shipping_country= $data->shipping_country;
								$shipping_region= $data->shipping_region;
								$shipping_city= $data->shipping_city;
								$shipping_zip= $data->shipping_zip;
								$shipping_email2= $data->shipping_email2;
								$shipping_email1= $data->shipping_email1;
								$shipping_office_phone1= $data->shipping_office_phone1;
								$shipping_office_phone2= $data->shipping_office_phone2;
								$shipping_mobile2= $data->shipping_mobile2;
								$shipping_mobile1= $data->shipping_mobile1;
								$arname = $data->ar_cust_name;
								$arcustadd1 = $data->ar_cust_add1;
								$arcustadd2 = $data->ar_cust_add2;
								$ar_cust_country = $data->ar_cust_country;
								$ar_cust_region = $data->ar_cust_region;
								$ar_cust_city = $data->ar_cust_city;
								$ar_cust_zip = $data->ar_cust_zip;
								$additionalno = $data->additionalno;
								$ar_additionalno = $data->ar_additionalno;
								$province_state = $data->province_state;
								$ar_province_state = $data->ar_province_state;
								$vatno = $data->vatno;
								$buyerid_crno = $data->buyerid_crno;
								$ar_vatno = $data->ar_vatno;
								$ar_buyerid_crno = $data->ar_buyerid_crno;
								$account_ledger=$data->account_ledger;
								}

								@endphp


								<form class="kt-form" id="kt_form">
									<input type="hidden" name="id" id="id" value="{{$cust_id}}">
									<div class="kt-wizard-v1__content p-0" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">{{ __('customer.Customer Details') }}</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>
										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">
											<div class="kt-wizard-v1__form">
												<div class="separator separator-dashed separator-border-2 mb-5"></div>
												<div class="row" style="padding-bottom: 6px;">
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Customer Category') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8  input-group input-group-sm">
																<select class="form-control single-select Cust_category" id="cust_category" name="cust_category">
																	<option value="">{{ __('customer.Select') }}
																	</option>@foreach($category as $item)
																	<option value="{{$item->id}}" @if($cust_category==$item->id) {{"selected"}}
																		@endif>
																		{{$item->customer_category}}
																	</option>@endforeach
																</select>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Customer Code') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">

																	<input type="text" class="form-control CustomerCode" name="cust_code" id="cust_code" placeholder="{{ __('customer.Customer Code') }}" autocomplete="off" value="{{$cust_code}}" readonly="">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row  pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Customer Type') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8 input-group input-group-sm">
																<select class="form-control single-select" id="cust_type" name="cust_type">
																	<option value="">{{ __('customer.Select') }}
																	</option>@foreach($type as $item)
																	<option value="{{$item->id}}" @if($cust_type==$item->id) {{"selected"}} @else
																		@endif>
																		{{$item->title}}
																	</option>@endforeach
																</select>
															</div>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Customer Group') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8  input-group input-group-sm">
																<select class="form-control single-select" name="cust_group" id="cust_group">
																	<option value="">{{ __('customer.Select') }}
																	</option>@foreach($group as $grp)
																	<option value="{{$grp->id}}" @if($cust_group==$grp->
																		id) {{"selected"}} @endif>
																		{{$grp->title}}
																	</option>@endforeach
																</select>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Sales man') }}</label>
															</div>
															<div class="col-md-8 input-group input-group-sm">
																<select class="form-control single-select" id="salesman" name="salesman">
																	<option value="">{{ __('customer.Select') }}
																	</option>@foreach($salesman as $sales)
																	<option value="{{$sales->id}}" @if($salesmans==$sales->id) {{"selected"}}
																		@endif>
																		{{$sales->name}}
																	</option>@endforeach
																</select>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Key Accounts') }}</label>
															</div>
															<div class="col-md-8 input-group input-group-sm">
																<select class="form-control single-select" id="key_account" name="key_account">
																	<option value="">{{ __('customer.Select') }}
																	</option>
																	@foreach($keyaccountants as $item)
																	<option value="{{$item->id}}" <?php if ($key_account == $item->id) {
																										echo "selected";
																									}
																									?>>
																		{{$item->name}}
																	</option>@endforeach


																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">{{ __('customer.Customer Details') }}</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>
										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">
											<div class="kt-wizard-v1__form">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Customer Name') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8 ">
																<div class="input-group input-group-sm">

																	<input type="text" class="form-control" id="cust_name" name="cust_name" autocomplete="off" placeholder="{{ __('customer.Customer Name/Company name') }}" value="{{$cust_name}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Customer Name') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8 ">
																<div class="input-group input-group-sm">

																	<input type="text" class="form-control" id="ar_cust_name" name="ar_cust_name" autocomplete="off" placeholder="{{ __('customer.Customer Name/Company name') }}{{ __('customer.Arabic') }}" value="{{$arname}}">
																</div>
															</div>
														</div>
													</div>
													<!-- <div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>Customer Name Alias</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control"
																		id="cust_name_alias" name="cust_name_alias"
																		autocomplete="off"
																		placeholder="{{ __('customer.Customer Name Alias') }}"
																		value="{{$cust_name_alias}}">
																</div>
															</div>
														</div>
													</div> -->
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Building No') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" autocomplete="off" id="cust_add1" class="form-control" name="cust_add1" value="{{$cust_add1}}" placeholder="{{ __('customer.Building No') }}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Building No') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" autocomplete="off" id="ar_cust_add1" class="form-control" name="ar_cust_add1" placeholder="{{ __('customer.Building No') }}{{ __('customer.Arabic') }}" value="{{$arcustadd1}}">
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

																	<input type="text" autocomplete="off" id="cust_add2" class="form-control" name="cust_add2" value="{{$cust_add2}}" placeholder="{{ __('customer.Street Name') }}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Street Name') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" autocomplete="off" id="ar_cust_add2" class="form-control" name="ar_cust_add2" placeholder="{{ __('customer.Street Name') }}{{ __('customer.Arabic') }}" value="{{$arcustadd2}}">
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

																	<input type="text" class="form-control" id="cust_region" name="cust_region" autocomplete="off" placeholder="{{ __('customer.District') }}" value="{{$cust_region}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.District') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="ar_cust_region" name="ar_cust_region" autocomplete="off" placeholder="{{ __('customer.District') }}{{ __('customer.Arabic') }}" value="{{$ar_cust_region}}">
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

																	<input type="text" class="form-control" id="province_state" name="province_state" autocomplete="off" placeholder="{{ __('customer.Province / State') }}" value="{{$province_state}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Province / State') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="ar_province_state" name="ar_province_state" autocomplete="off" placeholder="{{ __('customer.Province / State') }}{{ __('customer.Arabic') }}" value="{{$ar_province_state}}">
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

																	<input type="text" class="form-control" id="cust_city" name="cust_city" autocomplete="off" placeholder="{{ __('customer.City') }}" value="{{$cust_city}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.City') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="ar_cust_city" name="ar_cust_city" autocomplete="off" placeholder="{{ __('customer.City') }}{{ __('customer.Arabic') }}" value="{{$ar_cust_city}}">
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
																	<select name="cust_country" id="cust_country" class="form-control single-select">
																		<option value="">{{ __('customer.Select') }}
																		</option>
																		@foreach($country as $coun)
																		<option value="{{$coun->id}}" @if($cust_country==$coun->id) {{"selected"}}
																			@endif>
																			{{$coun->cntry_name}}
																		</option>
																		@endforeach
																	</select>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Country') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	<input type="text" name="ar_cust_country" id="ar_cust_country" placeholder="{{ __('customer.Country') }}{{ __('customer.Arabic') }}" class="form-control" value="{{$ar_cust_country}}">
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

																	<input type="text" class="form-control" id="cust_zip" name="cust_zip" autocomplete="off" placeholder="{{ __('customer.Postal Code') }}" value="{{$cust_zip}}">
																</div>
															</div>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Postal Code') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="ar_cust_zip" name="ar_cust_zip" autocomplete="off" value="{{$ar_cust_zip}}" placeholder="{{ __('customer.Postal Code') }}{{ __('customer.Arabic') }}">
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

																	<input type="text" class="form-control" id="additionalno" name="additionalno" autocomplete="off" placeholder="Additional No" value="{{$additionalno}}">
																</div>
															</div>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Additional Number') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="ar_additionalno" name="ar_additionalno" autocomplete="off" placeholder="{{ __('customer.Additional Number') }}{{ __('customer.Arabic') }}" value="{{$ar_additionalno}}">
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

																	<input type="text" class="form-control" id="vatno" name="vatno" autocomplete="off" placeholder="Vat Number" value="{{$vatno}}">
																</div>
															</div>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Vat No') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="ar_vatno" name="ar_vatno" autocomplete="off" placeholder="{{ __('customer.Vat No') }}{{ __('customer.Arabic') }}" value="{{$ar_vatno}}">
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

																	<input type="text" class="form-control" id="buyerid_crno" name="buyerid_crno" autocomplete="off" placeholder="{{ __('customer.Buyer ID / CR No') }}" value="{{$buyerid_crno}}">
																</div>
															</div>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Buyer ID / CR No') }}{{ __('customer.Arabic') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="ar_buyerid_crno" name="ar_buyerid_crno" autocomplete="off" placeholder="{{ __('customer.Buyer ID / CR No') }}{{ __('customer.Arabic') }}" value="{{$ar_buyerid_crno}}">
																</div>
															</div>
														</div>
													</div>


												</div>
											</div>
										</div>
									</div>







									<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">{{ __('customer.Customer Details') }}</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>
										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">
											<div class="kt-wizard-v1__form">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Primary Email') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="email1" name="email1" autocomplete="off" placeholder="{{ __('customer.Primary Email') }}" value="{{$email1}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Secondary Email') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" id="email2" name="email2" autocomplete="off" placeholder="{{ __('customer.Secondary Email') }}" value="{{$email2}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Office Phone No: 1') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="number" class="form-control" id="office_phone1" name="office_phone1" autocomplete="off" placeholder="{{ __('customer.Office Phone 1') }}" value="{{$office_phone1}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Office Phone No: 2') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="number" class="form-control" id="office_phone2" name="office_phone2" autocomplete="off" placeholder="{{ __('customer.Office Phone 2') }}" value="{{$office_phone2}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Mobile No: 1') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="number" class="form-control" id="mobile1" name="mobile1" autocomplete="off" placeholder="{{ __('customer.Mobile 1') }}" value="{{$mobile1}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Mobile No: 2') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="number" class="form-control" id="mobile2" name="mobile2" autocomplete="off" placeholder="{{ __('customer.Mobile 2') }}" value="{{$mobile2}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Fax') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm ">

																	<input type="text" class="form-control" id="fax" name="fax" autocomplete="off" placeholder="{{ __('customer.Fax') }}" value="{{$fax}}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Website') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm ">

																	<input type="text" class="form-control" id="website" name="website" autocomplete="off" placeholder="{{ __('customer.Website') }}" value="{{$website}}">
																</div>
															</div>
														</div>
													</div>

												</div>

											</div>
										</div>
									</div>
									<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">{{ __('customer.Customer Details') }}</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>
										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">
											<div class="kt-wizard-v1__form">
												<div class="row">

													<div class="col-md-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Contact Person') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">

																	<input type="text" class="form-control" placeholder="{{ __('customer.Contact Person') }} " id="contact_persons" name="contact_persons" autocomplete="off">
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

																	<input type="number" class="form-control" placeholder="{{ __('customer.Mobile') }}" id="mobile" name="mobile" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Office Number') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm ">

																	<input type="number" class="form-control" placeholder="{{ __('customer.Office Number') }}" id="office" name="office" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Primary Email') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" placeholder="{{ __('customer.Primary Email') }}" id="email" name="email">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Department') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">

																	<input type="text" class="form-control" placeholder="{{ __('customer.Department') }}" id="contact_department" name="contact_department" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Designation') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm ">

																	<input type="text" class="form-control" placeholder="{{ __('customer.Designation') }}" id="location" name="location" autocomplete="off">
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
																	<th>{{ __('customer.Contact Person') }}</th>
																	<th>{{ __('customer.Mobile Number') }}</th>
																	<th>{{ __('customer.Office Number') }}</th>
																	<th>{{ __('customer.Email') }}</th>
																	<th>{{ __('customer.Department') }}</th>
																	<th>{{ __('customer.Designation') }}</th>
																	<th>{{ __('customer.Action') }}</th>
																</tr>
															</thead>

															<tbody id="tbadd">
																@foreach ($datas as $key=>$datas)
																<tr class="addmore">
																	<td></td>
																	<td>
																		<input type="text" value="{{$datas->contact_personvalue}}" id="contact_personvalue" name="contact_person[0]" placeholder="Contact Person Incharge" class="skill form-control contact_personvalue" readonly="" />
																	</td>
																	<td>
																		<input type="number" value="{{$datas->mobiles}}" id="mobiles" name="mobiles[0]" placeholder="Mobile Number" class="skill form-control mobiles" readonly="" />
																	</td>
																	<td>
																		<input type="number" value="{{$datas->offices}}" id="offices" name="offices[0]" placeholder="Office Number" class="skill form-control offices" readonly="" />
																	</td>
																	<td>
																		<input type="text" value="{{$datas->emails}}" id="emails" name="emails[0]" placeholder="Email" class="skill form-control emails" readonly="" />
																	</td>
																	<td>
																		<input type="text" value="{{$datas->departments}}" id="departments" name="departments[0]" placeholder="Department" class="skill form-control departments" readonly="" />
																	</td>
																	<td>
																		<input type="text" value="{{$datas->locations}}" id="locations" name="locations[0]" placeholder="Location" class="skillValue form-control locations" readonly="" />
																	</td>
																	<td>
																		<button type="button" name="remove" id="remove" class="btn btn-danger btn_remove">X</button>
																	</td>
																</tr>
																@endforeach
															</tbody>

														</table>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">{{ __('customer.Customer Details') }}</div>
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
																				<?php
																				$lSelected = '';
																				if (($account_ledger == $ledger['id']) && ($ledger['parent_id'] == '~'))
																					$lSelected = 'selected';
																				?>
																				<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$lSelected}}>
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


									<!-- <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">Customer Details</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>
										<div class="kt-form__section kt-form__section--first w3-animate-right"
											id="animation">
											<div class="kt-wizard-v1__form">
												<div class="row">
												
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>Username</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm kt-input-icon kt-input-icon--right"
																	id="spintog">
																
																	<input type="text" class="form-control"
																		placeholder="{{ __('customer.Username') }}"
																		id="username" name="username" autocomplete="off"
																		value="{{$username}}"> <span
																		class="kt-input-icon__icon kt-input-icon__icon--right">
																		<span>
																			<div class="spinner-border" id="spin"
																				style="z-index: 10000; display:none;">
																			</div> 
																		</span>
																	</span>
																</div>
															</div>
														</div>
													</div>
													
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>Password</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																
																	<input type="password" class="form-control"
																		placeholder="{{ __('customer.Password') }}"
																		id="password " name="password"
																		autocomplete="off" value="{{$password}}">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div> -->
									<input type="hidden" class="form-control branch" name="branch" id="branch" value="<?php echo $branch; ?>">
									<div class="kt-form__actions">
										<button class="btn btn-default btn-elevate btn-icon-sm" data-ktwizard-type="action-prev" is="p"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> &nbsp;
											{{ __('customer.previous') }}</button>
										<button class="btn btn-brand btn-elevate btn-icon-sm" id="Customer_submit" data-ktwizard-type="action-submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
												<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
												<polyline points="22 4 12 14.01 9 11.01"></polyline>
											</svg> {{ __('customer.update') }} </i>
										</button>
										<button class="btn btn-brand btn-elevate btn-icon-sm" data-ktwizard-type="action-next" id="n">{{ __('vendor.NextStep') }} &nbsp;
											<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>

	@endsection
	@section('script')
	<script src="{{url('/')}}/public/assets/js/pages/custom/wizard/wizard-1.js" type="text/javascript"></script>
	<script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>
	<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
	<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
	<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
	<script src="{{ URL::asset('assets') }}/js/select2.js"></script>
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

			$('.single-select').select2();
			var i = 1;
			$("#add_more_table").click(function() {

				var cnt = $("#contact_persons").val();
				var mob = $("#mobile").val();
				var off = $("#office").val();
				var ema = $("#email").val();
				var dep = $("#contact_department").val();
				var loc = $("#location").val();
				if (cnt == "") {
					$("#officeinfo").trigger("click");
					toastr.warning('Please Enter Contact Name');
					return false;
				} else {
					var adcode = "<tr class='addmore'><td><input type='hidden' id='' name='slno[0]'  class='slno' value=" + i + "></td><td><input type='text' id='contact_personvalue' name='contact_personvalue[0]'  class='form-control contact_personvalue' value=" + cnt + "></td><td><input type='number' id='mobiles' name='mobiles[0]'  class=' form-control mobiles' value=" + mob + "></td><td><input type='number' id='offices' name='offices[0]'  class='form-control offices' value=" + off + "></td><td><input type='text' id='emails' name='emails[0]'  class='form-control emails' value=" + ema + "></td><td><input type='text' id='departments' name='departments[0]'  class='form-control departments' value=" + dep + "></td><td><input type='text' id='locations' name='locations[0]'  class='form-control locations' value=" + loc + "></td><td><button class='btn btn-dark' id='remove'><i class='fa fa-trash' style='padding-right: 0;'></i></button></td></tr>";
					$("#tbadd").append(adcode);
				}

				// if($cnt){
				// 	$("#tbadd").append($adcode);
				// }else{
				// 	toastr.warning('Contact person is required.');
				// }

				$("#contact_persons").val("");
				$("#mobile").val("");
				$("#office").val("");
				$("#email").val("");
				$("#contact_department").val("");
				$("#location").val("");
			});
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
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(document).on('change', '.Cust_category', function() {


				var cat_id = $(this).val();
				$.ajax({
					type: 'POST',
					url: 'getcategorycode',
					data: {
						_token: $('#token').val(),
						'id': cat_id
					},
					success: function(data) {
						console.log(data);
						$.each(data, function(key, value) {
							$("#cust_code").val(value.cust_code + '/' + value.increment);
						});
					},
					error: function() {}
				});


			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#Checkedinvoice").change(function() {
				if (this.checked) {

					$("#Checkedinvoice_value").val(1);
					$val = $("#cust_add1").val();
					$val1 = $("#cust_add2").val();
					$val2 = $("#cust_country").val();
					$val3 = $("#cust_region").val();
					$val4 = $("#cust_city").val();
					$val5 = $("#cust_zip").val();
					$val6 = $("#email1").val();
					$val7 = $("#email2").val();
					$val8 = $("#office_phone1").val();
					$val9 = $("#office_phone2").val();
					$val10 = $("#mobile1").val();
					$val11 = $("#mobile2").val();
					$('#invoice_add1').val($val);
					$('#invoice_add2').val($val1);
					$("#invoice_country").val($val2).trigger('change');
					$('#invoice_region').val($val3);
					$('#invoice_city').val($val4);
					$('#invoice_zip').val($val5);
					$('#invoice_email1').val($val6);
					$('#invoice_email2').val($val7);
					$('#invoice_office_phone1').val($val8);
					$('#invoice_office_phone2').val($val9);
					$('#invoice_mobile1').val($val10);
					$('#invoice_mobile2').val($val11);
				} else {
					$("#Checkedinvoice_value").val(0);
					$('#invoice_add1').val("");
					$('#invoice_add2').val("");
					$("#invoice_country").val('').trigger('change');
					$('#invoice_region').val("");
					$('#invoice_city').val("");
					$('#invoice_zip').val("");
					$('#invoice_email1').val("");
					$('#invoice_email2').val("");
					$('#invoice_office_phone1').val("");
					$('#invoice_office_phone2').val("");
					$('#invoice_mobile1').val("");
					$('#invoice_mobile2').val("");
				}
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#Checkedshipping").change(function() {
				if (this.checked) {
					$("#Checkedshipping_value").val(1);
					$val12 = $("#cust_add1").val();
					$val13 = $("#cust_add2").val();
					$val14 = $("#cust_country").val();
					$val15 = $("#cust_region").val();
					$val16 = $("#cust_city").val();
					$val17 = $("#cust_zip").val();
					$val18 = $("#email1").val();
					$val19 = $("#email2").val();
					$val20 = $("#office_phone1").val();
					$val21 = $("#office_phone2").val();
					$val22 = $("#mobile1").val();
					$val23 = $("#mobile2").val();
					$('#shipping1').val($val12);
					$('#shipping2').val($val13);
					$("#shipping_country").val($val14).trigger('change');
					$('#shipping_region').val($val15);
					$('#shipping_city').val($val16);
					$('#shipping_zip').val($val17);
					$('#shipping_email1').val($val18);
					$('#shipping_email2').val($val19);
					$('#shipping_office_phone1').val($val20);
					$('#shipping_office_phone2').val($val21);
					$('#shipping_mobile1').val($val22);
					$('#shipping_mobile2').val($val23);
				} else {
					$("#Checkedshipping_value").val(0);
					$('#shipping1').val("");
					$('#shipping2').val("");
					$("#shipping_country").val('').trigger('change');
					$('#shipping_region').val("");
					$('#shipping_city').val("");
					$('#shipping_zip').val("");
					$('#shipping_email2').val("");
					$('#shipping_email1').val("");
					$('#shipping_office_phone1').val("");
					$('#shipping_office_phone2').val("");
					$('#shipping_mobile2').val("");
					$('#shipping_mobile1').val("");
				}
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
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
						$('#email2').val("");
						toastr.warning('Please Enter Valid Email.');
					}
				});
			});

			$('#email').focusout(function() {
				$('#email').filter(function() {
					var email = $('#email').val();
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if (!emailReg.test(email)) {
						$('#email').val("");
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
						toastr.warning('Please Eter Valid Email.');
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
					$("#mobile2").val("");
					//toastr.warning('Please Enter Valid Phone Number.');
				}
			});
		});
		$('#mobile').focusout(function() {
			$('#mobile').filter(function() {
				var a = $("#mobile").val();
				var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
				if (!filter.test(a)) {
					$("#mobile").val("");
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
		// $(function()
		// 		{
		// 	$("#idcheck").change(function()
		// 		{
		// 		var st= this.checked;
		// 			if(st)
		// 			{
		// 				$("#cust_code").prop("disabled",false);
		// 					$("#cust_code").val("");
		// 			}
		// 			else
		// 			{
		// 					$("#cust_code").prop("disabled",true);
		// 					$("#cust_code").val("");
		// 			}
		// 		});
		// 		});

		$(document).on('click', '#Customer_submit', function(e) {
			e.preventDefault();
			$(this).removeClass('kt-spinner');
			cust_code = $('#cust_code').val();
			cust_group = $('#cust_group').val();
			cust_name_alias = $('#cust_name_alias').val();
			cust_type = $('#cust_type').val();
			cust_category = $('#cust_category').val();
			salesman = $('#salesman').val();
			key_account = $('#key_account').val();
			cust_name = $('#cust_name').val();
			cust_country = $('#cust_country').val();



			if (cust_category == "") {
				$('#cust_category').next().find('.select2-selection').addClass('select-dropdown-error');
				toastr.warning('Customer Category is Required.');
				$("#generalinfo").trigger("click");
				return false;
			} else {
				$('#cust_category').next().find('.select2-selection').removeClass('select-dropdown-error');
			}
			if (cust_code == "") {
				$('#cust_code').addClass('is-invalid');
				toastr.warning('customer Code is Required.');
				$("#generalinfo").trigger("click");
				return false;
			} else {
				$('#cust_code').removeClass('is-invalid');
			}
			if (cust_type == "") {
				$('#cust_type').next().find('.select2-selection').addClass('select-dropdown-error');
				toastr.warning('Customer Type is Required.');
				$("#generalinfo").trigger("click");
				return false;
			} else {
				$('#cust_type').next().find('.select2-selection').removeClass('select-dropdown-error');
			}
			if (cust_group == "") {
				$('#cust_group').next().find('.select2-selection').addClass('select-dropdown-error');
				toastr.warning('Customer Group is Required.');
				$("#generalinfo").trigger("click");
				return false;
			} else {
				$('#cust_group').next().find('.select2-selection').removeClass('select-dropdown-error');
			}

			if (cust_name == "") {
				$('#cust_name').addClass('is-invalid');
				toastr.warning('Cusomer Name is Required.');
				$("#customerinfo").trigger("click");
				return false;
			} else {
				$('#cust_name').removeClass('is-invalid');
			}
			if (cust_country == "") {
				$('#cust_country').next().find('.select2-selection').addClass('select-dropdown-error');
				toastr.warning('Country is Required.');
				$("#customerinfo").trigger("click");
				return false;
			} else {
				$('#cust_country').next().find('.select2-selection').removeClass('select-dropdown-error');
			}

			if ($('#email1').val() == "") {
				$('#email1').addClass('is-invalid');
				toastr.warning('Email is Required.');
				$("#contactinfo").trigger("click");
				return false;
			} else {
				$('#email1').removeClass('is-invalid');
			}



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



			var slno = [];
			var contact_personvalue = [];
			var mobiles = [];
			var offices = [];
			var emails = [];
			var departments = [];
			var locations = [];
			$(".addmore").each(function() {
				contact_personvalue.push($(this).find(".contact_personvalue").val());
				slno.push($(this).find(".slno").val());
				mobiles.push($(this).find(".mobiles").val());
				offices.push($(this).find(".offices").val());
				emails.push($(this).find(".emails").val());
				departments.push($(this).find(".departments").val());
				locations.push($(this).find(".locations").val());
			});
			if (slno.length <= 0) {
				/*toastr.warning('Minimum One Contact Information Added');
				$("#contactinfo").trigger("click");
				return false;*/
			}
			$(this).addClass('kt-spinner');
			$(this).prop("disabled", true);

			$.ajax({
				type: "POST",
				url: "CustomerSubmit",
				dataType: "json",
				data: {
					_token: $('#token').val(),
					info_id: $('#id').val(),
					cust_code: $('#cust_code').val(),
					cust_group: $('#cust_group').val(),
					custcontact_person: $('#custcontact_person').val(),
					cust_name_alias: $('#cust_name_alias').val(),
					cust_type: $('#cust_type').val(),
					cust_category: $('#cust_category').val(),
					salesman: $('#salesman').val(),
					key_account: $('#key_account').val(),
					cust_name: $('#cust_name').val(),
					cust_add1: $('#cust_add1').val(),
					cust_add2: $('#cust_add2').val(),
					cust_country: $('#cust_country').val(),
					cust_region: $('#cust_region').val(),
					cust_city: $('#cust_city').val(),
					cust_zip: $('#cust_zip').val(),
					email1: $('#email1').val(),
					email2: $('#email2').val(),
					office_phone1: $('#office_phone1').val(),
					office_phone2: $('#office_phone2').val(),
					mobile1: $('#mobile1').val(),
					mobile2: $('#mobile2').val(),
					fax: $('#fax').val(),
					website: $('#website').val(),
					contact_department: $('#contact_department').val(),
					email: $('#email').val(),
					location: $('#location').val(),

					portal: $('#portal').val(),
					username: $('#username').val(),
					registerd_email: $('#registerd_email').val(),
					password: $('#password').val(),
					branch: $('#branch').val(),
					contact_personvalue: contact_personvalue,
					mobiles: mobiles,
					offices: offices,
					emails: emails,
					departments: departments,
					locations: locations,
					arcust_name: $('#ar_cust_name').val(),
					arcust_add1: $('#ar_cust_add1').val(),
					arcust_add2: $('#ar_cust_add2').val(),
					arcust_country: $('#ar_cust_country').val(),
					arcust_region: $('#ar_cust_region').val(),
					arcust_city: $('#ar_cust_city').val(),
					ar_cust_zip: $('#ar_cust_zip').val(),
					additionalno: $('#additionalno').val(),
					ar_additionalno: $('#ar_additionalno').val(),
					ar_vatno: $('#ar_vatno').val(),
					ar_buyerid_crno: $('#ar_buyerid_crno').val(),
					vatno: $('#vatno').val(),
					province_state: $('#province_state').val(),
					ar_province_state: $('#ar_province_state').val(),
					crno: $('#buyerid_crno').val(),

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
					console.log(data);
					if (data == false) {
						$('#Customer_submit').removeClass('kt-spinner');
						$('#Customer_submit').prop("disabled", false);
						toastr.warning('Customer is Already Exist');
						$("#contactinfo").trigger("click");
					} else {
						$('#Customer_submit').removeClass('kt-spinner');
						$('#Customer_submit').prop("disabled", false);
						toastr.success('Customer Details Added Successfully!.');
						window.location.href = "customerdetails";
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
					toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
				}
			});

			return false;

		});
	</script>
	<script>
		$('.CustomerManagement').addClass('kt-menu__item--open');
		$('.customerdetails').addClass('kt-menu__item--active');
	</script>

	@endsection