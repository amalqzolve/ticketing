
@extends('crm.common.layout')
	@section('content')
		<link href="{{ URL::asset('assets') }}/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
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
																				<div class="kt-wizard-v1__nav-label">{{ __('vendor.GeneralInfo') }}
																				</div>
																		</div>
																</div>
																<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current" id="vendorinfo">
																		<div class="kt-wizard-v1__nav-body">
																				<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-list"></i>
																				</div>
																				<div class="kt-wizard-v1__nav-label">{{ __('vendor.vendorInfo') }}</div>
																		</div>
																</div>
																<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
																		<div class="kt-wizard-v1__nav-body">
																				<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-globe"></i>
																				</div>
																				<div class="kt-wizard-v1__nav-label">Office Info
																				</div>
																		</div>
																</div>
																<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" id="contactinfo">
																		<div class="kt-wizard-v1__nav-body">
																				<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-responsive"></i>
																				</div>
																				<div class="kt-wizard-v1__nav-label">{{ __('vendor.ContactInfo') }}
																				</div>
																		</div>
																</div>
																
																<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
																		<div class="kt-wizard-v1__nav-body">
																				<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-truck"></i>
																				</div>
																				<div class="kt-wizard-v1__nav-label">{{ __('vendor.credentials') }}
																				</div>
																		</div>
																</div>
														</div>
														<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
																<?php 
																foreach ($data as $key=>$value) {
																		$vendor_id = $data->id; $vendor_code = $data->vendor_code; $vendor_type = $data->vendor_type; $vendor_category = $data->vendor_category; $vendor_grp = $data->vendor_group; $salesmans = $data->salesman; $key_account = $data->key_account; $vendor_note = $data->vendor_note; $vendor_name = $data->vendor_name; $contact_person = $data->contact_person; $vendor_add1 = $data->vendor_add1; $vendor_add2 = $data->vendor_add2; $vendor_country = $data->vendor_country; $vendor_region = $data->vendor_region; $vendor_city = $data->vendor_city; $vendor_zip = $data->vendor_zip; $email1 = $data->email1; $email2 = $data->email2; $office_phone1 = $data->office_phone1; $office_phone2 = $data->office_phone2; $mobile1 = $data->mobile1; $mobile2 = $data->mobile2; $fax = $data->fax; $website = $data->website; $contact_persons = $data->contact_persons; $mobile = $data->mobile; $office = $data->office; $contact_department = $data->contact_department; $email = $data->email; $location = $data->location; $portal = $data->portal; $username = $data->username; $registerd_email = $data->registerd_email; $password = $data->password; $vendor_name_alias = $data->vendor_name_alias; 
																		$vendor_name_alias_ar= $data->vendor_name_alias_ar;
																$vendor_name_ar = $data->vendor_name_ar;
																$vendor_add1_ar = $data->vendor_add1_ar;
																$vendor_add2_ar = $data->vendor_add2_ar;
																$vendor_country_ar = $data->vendor_country_ar;
																$vendor_region_ar = $data->vendor_region_ar;
																$vendor_city_ar = $data->vendor_city_ar;
																$vendor_zip_ar = $data->vendor_zip_ar;
																$province_state = $data->province_state;
																$province_state_ar = $data->province_state_ar;
																$additionalno = $data->additionalno;
																$ar_additionalno = $data->ar_additionalno;
																$vatno = $data->vatno;
																$ar_vatno= $data->ar_vatno;
																$buyerid_crno= $data->buyerid_crno;
																$ar_buyerid_crno= $data->ar_buyerid_crno;
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
																}
																?>
																<form class="kt-form" id="kt_form">
																		<div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
																				<div class="box" style="padding-top: 10px;">
																						<div class="ribbon-2">{{ __('customer.Vendor Details') }}</div>
																				</div>
																				<div class="kt-form__section kt-form__section--first">
																						<div class="kt-wizard-v1__form">
															<div class="row">
																<div class="col-lg-6">                          
														<div class="form-group row pr-md-3">
														<div class="col-md-4">
														<label>{{ __('vendor.VendorCategory') }}<span style="color: red">*</span></label>
														</div>
														<div class="col-md-8  input-group input-group-sm">
														<select class="form-control single-select VendorCategory" id="vendor_category" name="vendor_category">
														<option value="">{{ __('vendor.Select') }}
														</option>@foreach($categry as $item)
														<option value="{{$item->id}}"
														@if($vendor_category==$item->id) {{"selected"}}
														@endif>
														{{$item->vendor_category}}</option>@endforeach
														</select>
													</div>
													</div>
													</div>
														<div class="col-lg-6">                          
														<div class="form-group row pl-md-3">
														<div class="col-md-4">
														<label>{{ __('vendor.VendorCode') }}<span style="color: red">*</span></label>                                                           </div>
														<div class="col-md-8">
														<div class="input-group input-group-sm">
														
														<input type="text" class="form-control" name="vendor_code" id="vendor_code" placeholder="{{ __('vendor.VendorCode') }}" value="<?php echo $vendor_code; ?>" readonly>
														</div>
														</div>
														</div>
														</div>
														<?php                                                           
														$vendor_type=isset($vendor_type) ? $vendor_type : ''; ?>
														<div class="col-lg-6">
														<div class="form-group row pr-md-3">
														<div class="col-md-4">
														<label>{{ __('vendor.VendorType') }}<span style="color: red">*</span></label>
														</div>
														<div class="col-md-8 input-group input-group-sm">
														<select class="form-control single-select" id="vendor_type" name="vendor_type">
														<option value="">{{ __('vendor.Select') }}
														</option>@foreach($type as $item)
														<option value="{{$item->id}}"
														@if($vendor_type==$item->id) {{"selected"}} @else
														@endif>
														{{$item->vendor_type}}</option>@endforeach
														</select>                                                       
														</div>
														</div>
														</div>
														<?php $vendorcat=isset($vendor_category) ? $vendor_category : ''; ?>
														
													<?php $vendor_grp=isset($vendor_grp) ? $vendor_grp : ''; ?>
													<div class="col-lg-6">
													<div class="form-group row pl-md-3">
													<div class="col-md-4">                                  
													<label>Vendor Group<span style="color: red">*</span></label>                            
												</div>
												<div class="col-md-8  input-group input-group-sm">
												<select class="form-control single-select" id="vendor_group" name="vendor_group">
												<option value="">{{ __('vendor.Select') }}</option>@foreach($vendor_group as $key) @if($vendor_grp!= $key->id)
												<option value="{{$key->id}}">{{$key->title}}</option>@endif else
												<option value="{{$key->id}}" selected>{{$key->title}}</option>@endforeach</select>
												</div>
												</div>
												</div>
												<?php $salesmans=isset($salesmans) ? $salesmans : ''; ?>
												<div class="col-lg-6">
												<div class="form-group row pr-md-3">
												<div class="col-md-4">
																						<label>Sales man</label>
																														</div>
																														<div class="col-md-8 input-group input-group-sm">
																																<select class="form-control single-select" id="salesman" name="salesman">
																																		<option value="">{{ __('vendor.Select') }}</option>@foreach($salesman as $key) @if($salesmans!= $key->id)
																																		<option value="{{$key->id}}">{{$key->name}}</option>@endif else
																																		<option value="{{$key->id}}" selected>{{$key->name}}</option>@endforeach</select>
																														</div>
																												</div>
																										</div>
																										<div class="col-lg-6">
																												<div class="form-group row pl-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.KeyAccounts') }}</label>
																														</div>
																														<div class="col-md-8 input-group input-group-sm">
																																<select class="form-control single-select" id="key_account" name="key_account">
																																		<option value="">{{ __('vendor.Select') }}</option>@foreach($groups as $sales)
																																		<option value="{{$sales->id}}" <?php if($key_account==$sales->id) { echo "selected"; }?> >{{$sales->name}}</option>@endforeach</select>
																														</div>
																												</div>
																										</div>
																								</div>
																						</div>
																				</div>
																		</div>
																		<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
																				<div class="box" style="padding-top: 10px;">
																						<div class="ribbon-2">{{ __('customer.Vendor Details') }}</div>
																				</div>
																				<div class="kt-form__section kt-form__section--first">
																						<div class="kt-wizard-v1__form">
																								<div class="row">
																										<div class="col-lg-6">
																												<div class="form-group row pr-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.VendorName') }}<span style="color: red">*</span></label>
																														</div>
																														<div class="col-md-8 ">
																																<div class="input-group input-group-sm">
																																	
																																		<input type="text" class="form-control" id="vendor_name" name="vendor_name" autocomplete="off" placeholder="{{ __('vendor.VendorName') }}" value="<?php echo $vendor_name; ?>">
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>Vendor Name(Ar)<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8 ">
																<div class="input-group input-group-sm">
																
																	<input type="text" class="form-control" id="vendor_name_ar" name="vendor_name_ar" autocomplete="off" placeholder="{{ __('vendor.VendorName') }}" value="<?php echo $vendor_name_ar; ?>">
																</div>
															</div>
														</div>
													</div>
																										<div class="col-lg-6">
																												<div class="form-group row pr-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.Vendor Alias') }}</label>
																														</div>
																														<div class="col-md-8">
																																<div class="input-group  input-group-sm">
																																
																																		<input type="text" class="form-control" id="vendor_name_alias" name="vendor_name_alias" 
																																		autocomplete="off" placeholder="{{ __('vendor.Vendor Alias') }}" value="<?php echo $vendor_name_alias; ?>">
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>Vendor Alias(Ar)</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																
																	<input type="text" class="form-control" id="vendor_name_alias_ar" name="vendor_name_alias_ar" autocomplete="off" placeholder="{{ __('vendor.Vendor Alias') }}" value="<?php echo $vendor_name_alias_ar; ?>">
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
																																		
																																		<input type="text" class="form-control" autocomplete="off" id="vendor_add1" name="vendor_add1" onchange="myFunctions(this.value)" value="<?php echo $vendor_add1; ?>">
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Building No(Arabic)') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control" autocomplete="off" id="vendor_add1_ar" placeholder="Address1" name="vendor_add1_ar" onchange="myFunctions(this.value)" value="<?php echo $vendor_add1_ar; ?>">
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
																																	
																																		<input type="text" class="form-control" autocomplete="off" id="vendor_add2" name="vendor_add2" onchange="myFunctionadd(this.value)" value="<?php echo $vendor_add2; ?>">
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Street Name(Arabic)') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control" autocomplete="off" id="vendor_add2_ar" placeholder="Address2" name="vendor_add2_ar" onchange="myFunctionadd(this.value)"value="<?php echo $vendor_add2_ar; ?>">
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
																																	
																																		<input type="text" class="form-control" id="vendor_region" name="vendor_region" autocomplete="off" placeholder="{{ __('vendor.EnterRegion') }}" onchange="myFunctionregion(this.value)" value="<?php echo $vendor_region; ?>">
																																</div>
																														</div>
																												</div>
																										</div>
																											<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.District(Arabic)') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																
																	<input type="text" class="form-control" id="vendor_region_ar" name="vendor_region_ar" autocomplete="off" placeholder="{{ __('vendor.EnterRegion') }}" onchange="myFunctionregion(this.value)" value="<?php echo $vendor_region_ar; ?>">
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
																	
																	<input type="text" class="form-control"
																		id="province_state" name="province_state"
																		autocomplete="off"
																		placeholder="{{ __('customer.Province / State') }}" value="<?php echo $province_state; ?>">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Province / State(Ar)') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control"
																		id="province_state_ar" name="province_state_ar"
																		autocomplete="off"
																		placeholder="{{ __('customer.Province / State') }}" value="<?php echo $province_state_ar; ?>">
																</div>
															</div>
														</div>
													</div>
														<div class="col-lg-6">
																												<div class="form-group row pr-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.city') }}</label>
																														</div>
																														<div class="col-md-8">
																																<div class="input-group  input-group-sm">
																																		
																																		<input type="text" class="form-control" id="vendor_city" name="vendor_city" autocomplete="off" placeholder="{{ __('vendor.EnterCity') }}" 
																																		onchange="myFunctioncity(this.value)"
																																			value="<?php echo $vendor_city; ?>">
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.City(Arabic)') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control" id="vendor_city_ar" name="vendor_city_ar" autocomplete="off" placeholder="{{ __('vendor.city') }}" onchange="myFunctioncity(this.value)" value="<?php echo $vendor_city_ar; ?>">
																</div>
															</div>
														</div>
													</div>
																										<div class="col-lg-6">
																												<div class="form-group row pr-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.country') }}<span style="color: red">*</span></label>
																														</div>
																														<div class="col-md-8">
																																<div class="input-group  input-group-sm">
																																		<!-- <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-globe"
																												aria-hidden="true"></i></span>
																																		</div> -->
																																		<select name="vendor_country" id="vendor_country" class="form-control single-select">
																																				<option value="">{{ __('customer.Select') }}</option>@foreach($country as $coun)
																																				<option value="{{$coun->id}}" <?php 
																																				if($vendor_country==$coun->id) { echo "selected"; } 
																																				?>>{{$coun->cntry_name}}</option>@endforeach</select>
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Country(Arabic)') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	<input type="text" name="vendor_country_ar" id="vendor_country_ar"
																		class="form-control" placeholder="country" value="<?php echo $vendor_country_ar; ?>">
																</div>
															</div>
														</div>
													</div>
																									
																										<div class="col-lg-6">
																												<div class="form-group row pr-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.zipcode') }}</label>
																														</div>
																														<div class="col-md-8">
																																<div class="input-group  input-group-sm">
																																	
																																		<input type="text" class="form-control" id="vendor_zip" name="vendor_zip" autocomplete="off" placeholder="{{ __('vendor.EnterZipcode') }}" 
																																		onchange="myFunctionzip(this.value)" 
																																		value="<?php echo $vendor_zip; ?>">
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>Zip Code(Ar)</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																
																	<input type="text" class="form-control" id="vendor_zip_ar" name="vendor_zip_ar" autocomplete="off" placeholder="{{ __('vendor.Zip Code') }}" onchange="myFunctionzip(this.value)" value="<?php echo $vendor_zip_ar; ?>">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>Additional Number</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control"
																		id="additionalno" name="additionalno" autocomplete="off"
																		placeholder="Additional Number" value="<?php echo $additionalno; ?>">
																</div>
															</div>
														</div>
													</div>

																		<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>Additional Number (Ar)</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control"
																		id="ar_additionalno" name="ar_additionalno" autocomplete="off"
																		placeholder="Additional Number" value="<?php echo $ar_additionalno; ?>">
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
																	
																	<input type="text" class="form-control"
																		id="vatno" name="vatno" autocomplete="off"
																		placeholder="Vat Number" value="<?php echo $vatno; ?>">
																</div>
															</div>
														</div>
													</div>


													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>Vat No (Ar)</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control"
																		id="ar_vatno" name="ar_vatno" autocomplete="off"
																		placeholder="Vat Number" value="<?php echo $ar_vatno; ?>">
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
																	
																	<input type="text" class="form-control"
																		id="buyerid_crno" name="buyerid_crno" autocomplete="off"
																		placeholder="{{ __('customer.Buyer ID / CR No') }}" value="<?php echo $buyerid_crno; ?>">
																</div>
															</div>
														</div>
													</div>

																	<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>Buyer ID / CR No (Ar)</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control"
																		id="ar_buyerid_crno" name="ar_buyerid_crno" autocomplete="off"
																		placeholder="{{ __('customer.Buyer ID / CR No') }}" value="<?php echo $ar_buyerid_crno; ?>">
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
											<div class="ribbon-2">Vendor Details</div>
										</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v1__form">
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('supplier.Primary Email') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																
																	<input type="text" class="form-control" id="email1" name="email1" onchange="myFunction(this.value)" autocomplete="off" placeholder="{{ __('vendor.Primary Email') }}" value="<?php echo $email1; ?>">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('vendor.SecondaryEmail') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control" id="email2" name="email2" autocomplete="off" placeholder="{{ __('vendor.SecondaryEmail') }}" onchange="myFunctionemail(this.value)" value="<?php echo $email2; ?>">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('vendor.Office Phone No: 1') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																
																	<input type="text" class="form-control" id="office_phone1" name="office_phone1" autocomplete="off" placeholder="{{ __('vendor.Phone1') }}" onchange="myFunctionphone(this.value)" value="<?php echo $office_phone1; ?>">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('vendor.Office Phone No: 2') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control" id="office_phone2" name="office_phone2" autocomplete="off" placeholder="{{ __('vendor.Phone2') }}" onchange="myFunctionphone2(this.value)" value="<?php echo $office_phone2; ?>">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('vendor.Mobile No: 1') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	
																	<input type="text" class="form-control" id="mobile1" name="mobile1" autocomplete="off" placeholder="{{ __('vendor.mobile') }}" onchange="myFunctionmobile(this.value)" value="<?php echo $mobile1; ?>">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('vendor.Mobile No: 2') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
															
																	<input type="text" class="form-control" id="mobile2" name="mobile2" autocomplete="off" placeholder="{{ __('vendor.mobile') }}" onchange="myFunctionmobile1(this.value)" value="<?php echo $mobile2; ?>">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('vendor.fax') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm ">
																
																	<input type="text" class="form-control" id="fax" name="fax" autocomplete="off" placeholder="{{ __('vendor.fax') }}" value="<?php echo $fax; ?>">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('vendor.website') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm ">
																
																	<input type="text" class="form-control" id="website" name="website" autocomplete="off" placeholder="{{ __('vendor.website') }}" value="<?php echo $website; ?>">
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
																						<div class="ribbon-2">{{ __('customer.Vendor Details') }}</div>
																				</div>
																				<div class="kt-form__section kt-form__section--first">
																						<div class="kt-wizard-v1__form">
																								<div class="row">
																										<div class="col-md-6">
																												<div class="form-group row pr-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.ContactPerson') }}</label>
																														</div>
																														<div class="col-md-8">
																																<div class="input-group input-group-sm">
																																		
																																		<input type="text" class="form-control" placeholder="{{ __('vendor.ContactPerson') }}" id="contact_persons" name="contact_persons" autocomplete="off">
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-md-6">
																												<div class="form-group row pl-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.mobile') }}</label>
																														</div>
																														<div class="col-md-8">
																																<div class="input-group  input-group-sm">
																																	
																																		<input type="text" class="form-control" placeholder="{{ __('vendor.EnterMobile') }}" id="mobile" name="mobile" autocomplete="off">
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-md-6">
																												<div class="form-group row pr-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.OfficeNumber') }}</label>
																														</div>
																														<div class="col-md-8">
																																<div class="input-group input-group-sm ">
																																		
																																		<input type="text" class="form-control" placeholder="{{ __('vendor.EnterOfficeNumber') }}" id="office" name="office" autocomplete="off">
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
																																		
																																		<input type="text" class="form-control" 
																																		placeholder="{{ __('customer.Primary Email') }}" id="email" name="email" autocomplete="off">
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-md-6">
																												<div class="form-group row pr-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.department') }}</label>
																														</div>
																														<div class="col-md-8">
																																<div class="input-group  input-group-sm">
																																		
																																		<input type="text" class="form-control" placeholder="{{ __('vendor.EnterDepartment') }}" id="contact_department" name="contact_department" autocomplete="off">
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-md-6">
																												<div class="form-group row pl-md-3">
																														<div class="col-md-4">
																																<label>{{ __('app.Designation') }}</label>
																														</div>
																														<div class="col-md-8">
																																<div class="input-group input-group-sm ">
																																	
																																		<input type="text" class="form-control" placeholder="{{ __('app.Designation') }}" id="location" name="location" autocomplete="off">
																																</div>
																														</div>
																												</div>
																										</div>
																										<div class="col-md-12">
																												<div class="form-group">
																														<button class="btn btn-sm btn-default btn-bold pull-right" 
																														id="add_more_table">{{ __('vendor.+Save And Add') }}</button>
																														<br>
																														<br>
																												</div>
																										</div>
																								</div>
																								<div class="row">
																										<div class="col-md-12">
																												<table class="table table-striped " id="addmore_table">
																														<thead>
																																<tr id="addmore">
																																	<td></td>
																																		<td id="person">{{ __('vendor.ContactPerson') }}</td>
																																		<td id="mobilenumber">{{ __('vendor.MobileNumber') }}</td>
																																		<td id="officenumber">{{ __('vendor.OfficeNumber') }}</td>
																																		<td id="emailnumber">{{ __('vendor.email') }}</td>
																																		<td id="departmentnumber">{{ __('vendor.department') }}
																																		</td>
																																		<td id="locationnumber">{{ __('app.Designation') }}</td>
																																		<td>{{ __('vendor.action') }}</td>
																																</tr>
																														</thead>
																														<?php foreach ($datas as $key=>$datas){ ?>
																														<tbody id="tbadd">
																																<tr class="addmore">
																																	<td></td>
																																		<td>
											
																																				<input type="text" value="<?php echo $datas->contact_person_incharges ?>" id="contact_personcharges" name="contact_personcharges[0]" placeholder="{{ __('vendor.ContactPersonIncharge') }}" class="skill form-control contact_personcharges" />
																																		</td>
																																		<td>
																																				<input type="text" value="<?php echo $datas->mobiles ?>" id="mobiles" name="mobiles[0]" placeholder="{{ __('vendor.MobileNumber') }}" class="skill form-control mobiles" />
																																		</td>
																																		<td>
																																				<input type="text" value="<?php echo $datas->offices ?>" id="offices" name="offices[0]" placeholder="{{ __('vendor.OfficeNumber') }}" class="skill form-control offices" />
																																		</td>
																																		<td>
																																				<input type="text" value="<?php echo $datas->emails ?>" id="emails" name="emails[0]" placeholder="{{ __('vendor.email') }}" class="skill form-control emails" />
																																		</td>
																																		<td>
																																				<input type="text" value="<?php echo $datas->departments ?>" id="departments" name="departments[0]" placeholder="{{ __('vendor.department') }}" class="skill form-control departments" />
																																		</td>
																																		<td>
																																				<input type="text" value="<?php echo $datas->locations ?>" id="locations" name="locations[0]" placeholder="{{ __('vendor.location') }}" class="skillValue form-control locations" />
																																		</td>
																																		<td>
																																				<button type="button" name="remove" id='remove' 
																																				class="btn btn-danger btn_remove">X</button>
																																		</td>
																																</tr>
																														</tbody>
																														<?php } ?>
																												</table>
																										</div>
																								</div>
																						</div>
																				</div>
																		</div>
																
																		<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
																				<div class="box" style="padding-top: 10px;">
																						<div class="ribbon-2">{{ __('customer.Vendor Details') }}</div>
																				</div>
																				<div class="kt-form__section kt-form__section--first">
																						<div class="kt-wizard-v1__form">
																								<div class="row">
																									
																										<div class="col-lg-6">
																												<div class="form-group row pl-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.Username') }}</label>
																														</div>
																														<div class="col-md-8">
																																<div class="input-group  input-group-sm kt-input-icon kt-input-icon--right" id="spintog">
																																		
																																		<input type="text" class="form-control" placeholder="{{ __('vendor.EnterUsername') }}" id="username" name="username" autocomplete="off" value="<?php echo $username; ?>"> <span class="kt-input-icon__icon kt-input-icon__icon--right">
																				<span>
																								<div class="spinner-border" id="spin" style="z-index: 10000; 
																								display:none;"></div>
																				</span>
																																		</span>
																																</div>
																														</div>
																												</div>
																										</div>
																										
																										<div class="col-lg-6">
																												<div class="form-group row pl-md-3">
																														<div class="col-md-4">
																																<label>{{ __('vendor.password') }}</label>
																														</div>
																														<div class="col-md-8">
																																<div class="input-group  input-group-sm">
																																		
																																	
																																		<input type="password" class="form-control" placeholder="{{ __('vendor.EnterPassword') }}" id="password " 
																																		name="password" autocomplete="off" value="<?php echo $password; ?>">
																																</div>
																														</div>
																												</div>
																										</div>
																								</div>
																						</div>
																				</div>
																		</div>
																		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
																		<script>
																				$(document).ready(function(){
																								$("#eye1").click(function(){
																								$(this).hide();
																								$("#eye0").show();
																								$("#pass").attr("type","text");
																									});
																								$("#eye0").click(function(){
																								$(this).hide();
																								$("#eye1").show();
																								$("#pass").attr("type","password");
																								});
																									var i=1; 
																																						$("#add_more_table").click(function(){
																																																														
																																												$cnt=$("#contact_persons").val();
																																												$mob=$("#mobile").val();
																																												$off=$("#office").val();
																																												$ema=$("#email").val();
																																												$dep=$("#contact_department").val();
																																												$loc=$("#location").val();
																																												
																																												$adcode="<tr class='addmore'><td><input type='hidden' id='' name='slno[0]'  class='slno' value="+i+"></td><td><input type='text' id='contact_personcharges' name='contact_personcharges[0]'  class='skill form-control contact_personcharges' value="+$cnt+"></td><td><input type='text' id='mobiles' name='mobiles[0]'  class='skill form-control mobiles' value="+$mob+"></td><td><input type='text' id='offices' name='offices[0]'  class='skill form-control offices' value="+$off+"></td><td><input type='text' id='emails' name='emails[0]'  class='skill form-control emails' value="+$ema+"></td><td><input type='text' id='departments' name='departments[0]'  class='skill form-control departments' value="+$dep+"></td><td><input type='text' id='locations' name='locations[0]'  class='skill form-control locations' value="+$loc+"></td><td><button class='btn btn-dark' id='remove'><i class='fa fa-trash' style='padding-right: 0;'></i></button></td></tr>";
																																											
																																												$("#tbadd").append($adcode);
																																												$("#contact_persons").val("");
																																												$("#mobile").val("");
																																												$("#office").val("");
																																												$("#email").val("");
																																												$("#contact_department").val("");
																																												$("#location").val("");
																																												});
																																						i++;
																																											$("#spintog").focusin(function(){
																																											$("#spin").show();
																																													});
																																												$("#spintog").focusout(function(){
																																												$("#spin").hide();
																																												});
																																												});
																																												$(document).on("click","#remove",function() {
																																												$(this).parent().addClass("delete");
																																												$(".delete").parent().remove();
																																												});
																		</script>
																		<div class="kt-form__actions">
																				<button class="btn btn-default btn-elevate btn-icon-sm" data-ktwizard-type="action-prev"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> &nbsp; {{ __('vendor.previous') }}</button>
																				<input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id']; ?>">
																				<button id="vendor_submit" class="btn btn-brand btn-elevate btn-icon-sm" data-ktwizard-type="action-submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> {{ __('vendor.update') }}
																				</button>
																				<button class="btn btn-brand btn-elevate btn-icon-sm" data-ktwizard-type="action-next">{{ __('vendor.NextStep') }} &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
																				</button>
																		</div>
																</form>
														</div>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>
		<input type="hidden" class="form-control"name="branch" id="branch" value="{{$branch}}">
</span></div>
		@endsection
			@section('script')
		<script type="text/javascript">
				
				
		</script>
			<script type="text/javascript">
		$(document).ready(function(){
					$(document).on('change','.VendorCategory',function()
					{

				var cat_id=$(this).val();
				$.ajax({
						type:'POST',
						url:'vgetcategorycode',
						data:{_token: $('#token').val(),
					'id':cat_id},
						success:function(data){
							$.each(data, function(key, value) {
							$("#vendor_code").val(value.vendor_category+ '/'+value.increment);
						});
									
						},
						error:function()
						{
		
						}
				});
			
					});
			});
	</script>
	<script type="text/javascript">
		$(document).ready(function() 
		{
			$('#email1').focusout(function()
			{
			$('#email1').filter(function()
			{
			var email = $('#email1').val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if ( !emailReg.test( email ) ) 
			{
			toastr.warning('Please enter valid email.');
			} 
			});
			});

			$('#email2').focusout(function()
			{
			$('#email2').filter(function()
			{
			var email = $('#email2').val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if ( !emailReg.test( email ) ) 
			{
			toastr.warning('Please enter valid email.');
			} 
			});
			});

			$('#email').focusout(function()
			{
			$('#email').filter(function()
			{
			var email = $('#email').val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if ( !emailReg.test( email ) ) 
			{
			toastr.warning('Please enter valid email.');
			} 
			});
			});
			
			$('#invoice_email1').focusout(function()
			{
			$('#invoice_email1').filter(function()
			{
			var email = $('#invoice_email1').val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if ( !emailReg.test( email ) ) 
			{
			toastr.warning('Please enter valid email.');
			} 
			});
			});
			
			$('#invoice_email2').focusout(function()
			{
			$('#invoice_email2').filter(function()
			{
			var email = $('#invoice_email2').val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if ( !emailReg.test( email ) ) 
			{
			toastr.warning('Please enter valid email.');
			} 
			});
			});
			
			$('#shipping_email1').focusout(function()
			{
			$('#shipping_email1').filter(function()
			{
			var email = $('#shipping_email1').val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if ( !emailReg.test( email ) ) 
			{
			toastr.warning('Please enter valid email.');
			} 
			});
			});
			
			$('#shipping_email2').focusout(function()
			{
			$('#shipping_email2').filter(function()
			{
			var email = $('#shipping_email2').val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if ( !emailReg.test( email ) ) 
			{
			toastr.warning('Please enter valid email.');
			} 
			});
			});
			
			$('#registerd_email').focusout(function()
			{
			$('#registerd_email').filter(function()
			{
			var email = $('#registerd_email').val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if ( !emailReg.test( email ) ) 
			{
			toastr.warning('Please enter valid email.');
			} 
			});
			});

			


		});
	</script>
	<script type="text/javascript">
		$('#mobile1').focusout(function()
			{
			$('#mobile1').filter(function()
			{
				var a =  $("#mobile1").val();
				var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
				if (!filter.test(a)) 
				{
							//toastr.warning('Please Enter Valid Phone Number.');
				}
			});
			});
		$('#mobile2').focusout(function()
			{
			$('#mobile2').filter(function()
			{
				var a =  $("#mobile2").val();
				var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
				if (!filter.test(a)) 
				{
							//toastr.warning('Please Enter Valid Phone Number.');
				}
			});
			});
		$('#mobile').focusout(function()
			{
			$('#mobile').filter(function()
			{
				var a =  $("#mobile").val();
				var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
				if (!filter.test(a)) 
				{
							//toastr.warning('Please Enter Valid Phone Number.');
				}
			});
			});
		
		$('#invoice_mobile1').focusout(function()
			{
			$('#invoice_mobile1').filter(function()
			{
				var a =  $("#invoice_mobile1").val();
				var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
				if (!filter.test(a)) 
				{
							//toastr.warning('Please Enter Valid Phone Number.');
				}
			});
			});
		
		$('#invoice_mobile2').focusout(function()
			{
			$('#invoice_mobile2').filter(function()
			{
				var a =  $("#invoice_mobile2").val();
				var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
				if (!filter.test(a)) 
				{
							//toastr.warning('Please Enter Valid Phone Number.');
				}
			});
			});
		
		$('#shipping_mobile1').focusout(function()
			{
			$('#shipping_mobile1').filter(function()
			{
				var a =  $("#shipping_mobile1").val();
				var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
				if (!filter.test(a)) 
				{
							//toastr.warning('Please Enter Valid Phone Number.');
				}
			});
			});
		
		$('#shipping_mobile2').focusout(function()
			{
			$('#shipping_mobile2').filter(function()
			{
				var a =  $("#shipping_mobile2").val();
				var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
				if (!filter.test(a)) 
				{
							//toastr.warning('Please Enter Valid Phone Number.');
				}
			});
			});
		
	</script>
		<script type="text/javascript">
				$(document).ready(function(){
						$("#Checkedinvoice").change(function(){
								if(this.checked)
								{
														$("#Checkedinvoice_value").val(1);

														$val = $("#vendor_add1").val();
														$val1 = $("#vendor_add2").val();
														$val2 = $("#vendor_country").val();
														$val3 = $("#vendor_region").val();
														$val4 = $("#vendor_city").val();
														$val5 = $("#vendor_zip").val();
														$val6 = $("#email1").val();
														$val7 = $("#email2").val();
														$val8 = $("#office_phone1").val();
														$val9 = $("#office_phone2").val();
														$val10 = $("#mobile1").val();
														$val11 = $("#mobile2").val();
																$('#invoice_add1').val($val);
																$('#invoice_add2').val($val1);
																$('#invoice_country').val($val2).trigger('change');;
																$('#invoice_region').val($val3);
																$('#invoice_city').val($val4);
																$('#invoice_zip').val($val5);
																$('#invoice_email1').val($val6);
																$('#invoice_email2').val($val7);
																$('#invoice_office_phone1').val($val8);
																$('#invoice_office_phone2').val($val9);
																$('#invoice_mobile1').val($val10);
																$('#invoice_mobile2').val($val11);
																}
																else
																{
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
				$(document).ready(function(){
						$("#Checkedshipping").change(function(){
								if(this.checked)
								{
														$val12 = $("#vendor_add1").val();
														$val13 = $("#vendor_add2").val();
														$val14 = $("#vendor_country").val();
														$val15 = $("#vendor_region").val();
														$val16 = $("#vendor_city").val();
														$val17 = $("#vendor_zip").val();
														$val18= $("#email1").val();
														$val19 = $("#email2").val();
														$val20 = $("#office_phone1").val();
														$val21 = $("#office_phone2").val();
														$val22 = $("#mobile1").val();
														$val23 = $("#mobile2").val();
																$('#shipping1').val($val12);
																$('#shipping2').val($val13);
																$('#shipping_country').val($val14).trigger('change');;
																$('#shipping_region').val($val15);
																$('#shipping_city').val($val16);
																$('#shipping_zip').val($val17);
																$('#shipping_email1').val($val18);
																$('#shipping_email2').val($val19);
																$('#shipping_office_phone1').val($val20);
																$('#shipping_office_phone2').val($val21);
																$('#shipping_mobile1').val($val22);
																$('#shipping_mobile2').val($val23);
								}
								else
								{
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
		$(document).on('click', '#vendor_submit', function(e) {
						$(this).removeClass('kt-spinner');

												vendor_code     = $('#vendor_code').val();
												vendor_type     = $('#vendor_type').val();
												vendor_category = $('#vendor_category').val();
												salesman        = $('#salesman').val();
												vendor_group    = $('#vendor_group').val();
												key_account     = $('#key_account').val();
												vendor_name     = $('#vendor_name').val();
												vendor_country  = $('#vendor_country').val();
												contact_persons =$('#contact_persons').val();
												email1          = $('#email1').val();
												mobile1     = $('#mobile1').val();


												if (vendor_category == "") {
												$('#vendor_category').next().find('.select2-selection').addClass('is-invalid');
												toastr.warning('vendor category is required.');
												$("#generalinfo").trigger("click");
												return false;
												} else {
												$('#vendor_category').next().find('.select2-selection').removeClass('is-invalid');
												}
												if (vendor_code == "") {
												$('#vendor_code').addClass('is-invalid');
												toastr.warning('vendor code is required.');
												$("#generalinfo").trigger("click");
												return false;
												} else {
												$('#vendor_code').removeClass('is-invalid');
												}
												if (vendor_type == "") {
												$('#vendor_type').next().find('.select2-selection').addClass('is-invalid');
												toastr.warning('vendor type is required.');
												$("#generalinfo").trigger("click");
												return false;
												} else {
												$('#vendor_type').next().find('.select2-selection').removeClass('is-invalid');
												}
												if (vendor_group == "") {
												$('#vendor_group').next().find('.select2-selection').addClass('is-invalid');
												toastr.warning('vendor group is required.');
												$("#generalinfo").trigger("click");
												return false;
												} else {
												$('#vendor_group').next().find('.select2-selection').removeClass('is-invalid');
												}
												if (vendor_name == "") {
			$('#vendor_name').addClass('is-invalid');
			toastr.warning('Vendor Name is required.');
			$("#vendorinfo").trigger("click");
			return false;
			} else {
			$('#vendor_name').removeClass('is-invalid');
			}

			if (vendor_country == "") {
			$('#vendor_country').next().find('.select2-selection').addClass('is-invalid');
			toastr.warning('Country is required.');
			$("#vendorinfo").trigger("click");
			return false;
			} else {
			$('#vendor_country').next().find('.select2-selection').removeClass('is-invalid');
			}
				if (email1 == "") {
			$('#email1').addClass('is-invalid');
			toastr.warning('Vendor Name is Required.');
			$("#officeinfo").trigger("click");
			return false;
			} else {
			$('#email1').removeClass('is-invalid');
			}
			if (mobile1 == "") {
			$('#mobile1').addClass('is-invalid');
			toastr.warning('Vendor Name is Required.');
			$("#officeinfo").trigger("click");
			return false;
			} else {
			$('#mobile1').removeClass('is-invalid');
			}
	
											
				var slno = [];
				var contact_personcharges = [];
				var mobiles = [];
				var offices = [];
				var emails = [];
				var departments = [];
				var locations = [];
				$(".addmore").each(function() {
								contact_personcharges.push($(this).find(".contact_personcharges").val());
								slno.push($(this).find(".slno").val());
								mobiles.push($(this).find(".mobiles").val());
								offices.push($(this).find(".offices").val());
								emails.push($(this).find(".emails").val());
								departments.push($(this).find(".departments").val());
								locations.push($(this).find(".locations").val());
				});
		if(slno.length <=0)
	{
		toastr.warning('Minimum One Contact Information Added');
		$("#contactinfo").trigger("click");
		return false;
	}
					$(this).addClass('kt-spinner');
					$(this).prop("disabled", true);
				$.ajax({
								type: "POST",
								url: "VendorSubmit",
								dataType: "json",
								data: {
												_token: $('#token').val(),
			vendor_id: $('#id').val(),
			vendor_code: $('#vendor_code').val(),
			vendor_type: $('#vendor_type').val(),
			vendor_category: $('#vendor_category').val(),
			salesman: $('#salesman').val(),
			vendor_name_alias:$('#vendor_name_alias').val(),
			vendor_name_alias_ar:$('#vendor_name_alias_ar').val(),
			vendor_group: $('#vendor_group').val(),
			key_account: $('#key_account').val(),
			vendor_name: $('#vendor_name').val(),
			vendor_name_ar: $('#vendor_name_ar').val(),
			contact_person: $('#contact_person').val(),
			vendor_add1: $('#vendor_add1').val(),
			vendor_add1_ar: $('#vendor_add1_ar').val(),
			vendor_add2: $('#vendor_add2').val(),
			vendor_add2_ar: $('#vendor_add2_ar').val(),
			vendor_country: $('#vendor_country').val(),
			vendor_country_ar: $('#vendor_country_ar').val(),
			vendor_region: $('#vendor_region').val(),
			vendor_region_ar: $('#vendor_region_ar').val(),
			vendor_city: $('#vendor_city').val(),
			vendor_city_ar: $('#vendor_city_ar').val(),
			vendor_zip: $('#vendor_zip').val(),
			vendor_zip_ar: $('#vendor_zip_ar').val(),
			email1: $('#email1').val(),
			email2: $('#email2').val(),
			office_phone1: $('#office_phone1').val(),
			office_phone2: $('#office_phone2').val(),
			mobile1: $('#mobile1').val(),
			mobile2: $('#mobile2').val(),
			fax: $('#fax').val(),
			website: $('#website').val(),
			contact_persons: $('#contact_persons').val(),
			mobile: $('#mobile').val(),
			office: $('#office').val(),
			contact_department: $('#contact_department').val(),
			email: $('#email').val(),
			location: $('#location').val(),
			username: $('#username').val(),
			password: $('#password').val(),
			contact_person_incharges: contact_personcharges,
			mobiles: mobiles,
			offices: offices,
			emails: emails,
			departments: departments,
			locations: locations,
			branch : $('#branch').val(),
			province_state : $('#province_state').val(),
			province_state_ar : $('#province_state_ar').val(),
			additionalno : $('#additionalno').val(),
			ar_additionalno : $('#ar_additionalno').val(),
			vatno : $('#vatno').val(),
			ar_vatno : $('#ar_vatno').val(),
			buyerid_crno : $('#buyerid_crno').val(),
			ar_buyerid_crno : $('#ar_buyerid_crno').val(),
			
								},
								success: function(data) {
											toastr.success('Vendor details updated successfully!.');
												
												window.location.href = "vendors";
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
		<script src="{{url('/')}}/public/assets/js/pages/custom/wizard/wizard-1.js" type="text/javascript"></script>
		<script src="{{url('/')}}/resources/js/crm/vendor.js" type="text/javascript"></script>
		<script src="{{ URL::asset('assets') }}/js/select2.js"></script>
@endsection