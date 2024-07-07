@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<div class="modal-body">
	<?php
	foreach ($data as $key => $value) {
		$infoid = $data->id;
		$name = $data->name;
		$email = $data->email;
		$password = $data->password;
		$address1 = $data->address1;
		$address2 = $data->address2;
		$address3 = $data->address3;
		$zip = $data->zip;
		$scountry = $data->country;
		$region = $data->region;
		$place = $data->place;
		$department = $data->department;
		$department_head = $data->department_head;
		$route = $data->salesman_route;
		$parent_group = $data->account_group;
		$ledgername = $data->account_ledger;
		$ledgercode = $data->account_code;
	}
	?>

	@section('content')
	<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content" style="padding-bottom: 0;">
		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Wizard 1 </h3>
					<span class="kt-subheader__separator kt-hidden"></span>
					<div class="kt-subheader__breadcrumbs"> <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							Pages </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							Wizard 1 </a>
					</div>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper"> <a href="#" class="btn kt-subheader__btn-primary">
							Back
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
			<div class="kt-portlet">
				<div class="kt-portlet__body kt-portlet__body--fit nborder">
					<div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="step-first">
						<div class="kt-grid__item">
							<div class="kt-wizard-v1__nav">
								<div class="kt-wizard-v1__nav-items kt-wizard-v1__nav-items--clickable">
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
										<div class="kt-wizard-v1__nav-body">
											<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-bus-stop"></i>
											</div>
											<div class="kt-wizard-v1__nav-label">{{ __('customer.Salesman Information') }}</div>
										</div>
									</div>
									<!-- <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
										<div class="kt-wizard-v1__nav-body">
											<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-list"></i>
											</div>
											<div class="kt-wizard-v1__nav-label">Accounting Configuration</div>
										</div>
									</div> -->
									{{--
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}} {{--
										<div class="kt-wizard-v1__nav-body">--}} {{--
											<div class="kt-wizard-v1__nav-icon">--}} {{-- <i class="flaticon-globe"></i>--}} {{--</div>--}} {{--
											<div class="kt-wizard-v1__nav-label">--}} {{-- Portal--}} {{--</div>--}} {{--</div>--}} {{--</div>--}} {{--
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}} {{--
										<div class="kt-wizard-v1__nav-body">--}} {{--
											<div class="kt-wizard-v1__nav-icon">--}} {{-- <i class="flaticon-globe"></i>--}} {{--</div>--}} {{--
											<div class="kt-wizard-v1__nav-label">--}} {{-- Type--}} {{--</div>--}} {{--</div>--}} {{--</div>--}} {{--
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}} {{--
										<div class="kt-wizard-v1__nav-body">--}} {{--
											<div class="kt-wizard-v1__nav-icon">--}} {{-- <i class="flaticon-globe"></i>--}} {{--</div>--}} {{--
											<div class="kt-wizard-v1__nav-label">--}} {{-- Transaction--}} {{--</div>--}} {{--</div>--}} {{--</div>--}} {{--
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}} {{--
										<div class="kt-wizard-v1__nav-body">--}} {{--
											<div class="kt-wizard-v1__nav-icon">--}} {{-- <i class="flaticon-globe"></i>--}} {{--</div>--}} {{--
											<div class="kt-wizard-v1__nav-label">--}} {{-- Credit limit--}} {{--</div>--}} {{--</div>--}} {{--</div>--}} {{--
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}} {{--
										<div class="kt-wizard-v1__nav-body">--}} {{--
											<div class="kt-wizard-v1__nav-icon">--}} {{-- <i class="flaticon-globe"></i>--}} {{--</div>--}} {{--
											<div class="kt-wizard-v1__nav-label">--}} {{-- Payment Terms--}} {{--</div>--}} {{--</div>--}} {{--</div>--}} {{--
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}} {{--
										<div class="kt-wizard-v1__nav-body">--}} {{--
											<div class="kt-wizard-v1__nav-icon">--}} {{-- <i class="flaticon-globe"></i>--}} {{--</div>--}} {{--
											<div class="kt-wizard-v1__nav-label">--}} {{-- Accounting--}} {{--</div>--}} {{--</div>--}} {{--</div>--}} {{--
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}} {{--
										<div class="kt-wizard-v1__nav-body">--}} {{--
											<div class="kt-wizard-v1__nav-icon">--}} {{-- <i class="flaticon-globe"></i>--}} {{--</div>--}} {{--
											<div class="kt-wizard-v1__nav-label">--}} {{-- SOA--}} {{--</div>--}} {{--</div>--}} {{--</div>--}} {{--
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}} {{--
										<div class="kt-wizard-v1__nav-body">--}} {{--
											<div class="kt-wizard-v1__nav-icon">--}} {{-- <i class="flaticon-globe"></i>--}} {{--</div>--}} {{--
											<div class="kt-wizard-v1__nav-label">--}} {{-- VAT--}} {{--</div>--}} {{--</div>--}} {{--</div>--}} {{--
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}} {{--
										<div class="kt-wizard-v1__nav-body">--}} {{--
											<div class="kt-wizard-v1__nav-icon">--}} {{-- <i class="flaticon-globe"></i>--}} {{--</div>--}} {{--
											<div class="kt-wizard-v1__nav-label">--}} {{-- Document--}} {{--</div>--}} {{--</div>--}} {{--</div>--}} {{--</div>--}} {{--</div>--}}
								</div>
								<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
									<form class="kt-form" id="kt_form">
										<div class="kt-wizard-v1__content p-0" data-ktwizard-type="step-content">
											<div class="box" style="padding-top: 10px;">
												<div class="ribbon-2">{{ __('customer.Salesman Information') }}</div>
											</div>
											<div class="kt-heading kt-heading--md"></div>
											<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">
												<div class="kt-wizard-v1__form">
													<div class="separator separator-dashed separator-border-2 mb-5"></div>
													<div class="row" style="padding-bottom: 6px;">
														<input type="hidden" name="id" id="id" value="<?php echo $infoid ?>">
														<div class="col-lg-6">
															<div class="form-group row pl-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Name') }}<span style="color: red">*</span></label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control" placeholder="{{ __('salesman.Name') }} " id="name" name="name" autocomplete="off" value="<?php echo $name; ?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group row pr-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Email') }}<span style="color: red">*</span></label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control" placeholder="{{ __('salesman.Email') }} " id="email" name="email" autocomplete="off" value="<?php echo $email; ?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group row pl-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Address Line 1') }}</label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control" placeholder="{{ __('salesman.Address 1') }}" id="address1" name="address1" value="<?php echo $address1; ?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group row pr-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Address Line 2') }}</label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control" placeholder="{{ __('salesman.Address 2') }}" id="address2" name="address2" data-wheelcolorpicker="" autocomplete="off" style="padding-top: 0px;" value="<?php echo $address2; ?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group row pl-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Address Line 3') }}</label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control" placeholder="{{ __('salesman.Address 3') }} " id="address3" name="address3" value="<?php echo $address3; ?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group row pr-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Zip Code') }}</label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control" placeholder="{{ __('salesman.Zip') }} " id="zip" name="zip" autocomplete="off" value="<?php echo $zip; ?>">
																	</div>
																</div>
															</div>
														</div>

														<div class="col-lg-6">
															<div class="form-group row pl-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Region') }}</label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control" placeholder="{{ __('salesman.Region') }} " id="region" name="region" autocomplete="off" value="<?php echo $region; ?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group row pr-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Place') }}</label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control" placeholder="{{ __('salesman.Place') }} " id="place" name="place" autocomplete="off" value="<?php echo $place; ?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group row pl-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Country') }}</label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<select name="country" id="country" class="form-control single-select">
																			<option value="">{{ __('customer.Select') }}
																			</option>
																			@foreach($country as $coun)
																			<option value="{{$coun->id}}" @if($scountry==$coun->id) {{"selected"}}
																				@endif>
																				{{$coun->cntry_name}}
																			</option>
																			@endforeach
																		</select>


																	</div>
																</div>
															</div>
														</div>
														<!-- <div class="col-lg-6">
													<div class="form-group row pr-md-3">
														<div class="col-md-4">
															<label>{{ __('salesman.Department') }}<span style="color: red">*</span></label>
														</div>
														<div class="col-md-8">
															<div class="input-group input-group-sm">
																<select class="form-control single-select"
																	id="department" name="department">
																		<option value="">{{ __('customer.Select') }}
																	</option>@foreach($dept as $item)
																	<option value="{{$item->id}}"
																		@if($department==$item->id) {{"selected"}} @else
																		@endif>
																		{{$item->name}}</option>@endforeach
																</select>
															
															</div>
														</div>
													</div>
												</div> -->
														<!-- <div class="col-lg-6">
													<div class="form-group row pl-md-3">
														<div class="col-md-4">
															<label>{{ __('salesman.Department Head') }}</label>
														</div>
														<div class="col-md-8">
															<div class="input-group input-group-sm">
																<input type="text" class="form-control" placeholder="{{ __('salesman.Department Head') }} " id="department_head" name="department_head" autocomplete="off" value="<?php echo $department_head; ?>">
															</div>
														</div>
													</div>
												</div> -->
														<div class="col-lg-6">
															<div class="form-group row pr-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Salesman Route') }}</label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<select class="form-control single-select" id="salesman_route" name="salesman_route">
																			<option value="">{{ __('customer.Select') }}
																			</option>@foreach($salesman_route as $item)
																			<option value="{{$item->id}}" @if($route==$item->id) {{"selected"}} @else
																				@endif>
																				{{$item->routename}}
																			</option>@endforeach
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group row pl-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Salesman Commission') }}</label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<input type="number" class="form-control" value="{{$data->commission}}" placeholder="{{ __('salesman.Salesman Commission') }} " id="commission" name="commission" autocomplete="off">
																	</div>
																</div>
															</div>
														</div>




														<div class="col-lg-6">
															<div class="form-group row pr-md-3">
																<div class="col-md-4">
																	<label>{{ __('salesman.Target') }}</label>
																</div>
																<div class="col-md-8">
																	<div class="input-group input-group-sm">
																		<input type="number" class="form-control" value="{{$data->target}}" placeholder="{{ __('app.Target') }} " id="target" name="target" autocomplete="off">
																	</div>
																</div>
															</div>
														</div>








													</div>
												</div>
											</div>
										</div>
										<input type="hidden" class="form-control" value="{{$branch}}" id="branch" name="branch">

										<!-- <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
									<div class="box" style="padding-top: 10px;">
										<div class="ribbon-2">Salesman Information</div>
									</div>
									<div class="kt-heading kt-heading--md"></div>
									<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">
										<div class="kt-wizard-v1__form">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group row  pr-md-3">
														<div class="col-md-4">
															<label>Parent Group</label>
														</div>
														<div class="col-md-8 input-group input-group-sm">
															<select class="form-control single-select" id="parent_group" name="parent_group">
																<option value="">Select</option>
																<?php if ($parent_group == 1) { ?>
																<option value="1" selected>Wholesale Customer</option>
																<option value="2">Retail Customer</option>
																<?php
																}
																if ($parent_group == 2) { ?>
																<option value="1">Wholesale Customer</option>
																<option value="2" selected>Retail Customer</option>
																<?php
																} ?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group row pl-md-3">
														<div class="col-md-4">
															<label>Ledger Name</label>
														</div>
														<div class="col-md-8">
															<div class="input-group input-group-sm">
																<input type="text" class="form-control" name="ledgername" id="ledgername" placeholder="Ledger Name" value="<?php echo $ledgername; ?>">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group row pr-md-3">
														<div class="col-md-4">
															<label>Ledger Code</label>
														</div>
														<div class="col-md-8">
															<div class="input-group input-group-sm">
																<input type="text" class="form-control" name="ledgercode" id="ledgercode" placeholder="Ledger Code" value="<?php echo $ledgercode; ?>">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div> -->
										<div class="kt-portlet__foot pr-0">
											<div class="row">
												<div class="col-lg-12 p-0 kt-align-right">
													<!-- <button type="button" id="creditinvoice_pay" class="btn btn-primary" style="float:right;" disabled="">Submit</button> -->

													<button type="reset" class="btn btn-secondary backHome"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
															<line x1="18" y1="6" x2="6" y2="18"></line>
															<line x1="6" y1="6" x2="18" y2="18"></line>
														</svg> &nbsp;{{ __('app.Cancel') }}</button>


													<button type="button" class="btn btn-primary" id="Salesmandetails_Submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg> &nbsp;{{ __('app.Save') }}</button>



												</div>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@endsection
	</div>
	@section('script')
	<script type="text/javascript">
		$(document).ready(function() {
			$('.kt-select2').select2();
		});
	</script>
	<script type="text/javascript">
		$('#email').focusout(function() {
			$('#email').filter(function() {
				var email = $('#email').val();
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (!emailReg.test(email)) {
					$('#email').val("");
					toastr.warning('Please enter valid email.');
				}
			});
		});
	</script>
	<script src="{{url('/')}}/public/assets/js/pages/custom/wizard/wizard-1.js" type="text/javascript"></script>
	<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
	<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
	<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
	<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
	<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
	<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
	<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
	<script src="{{url('/')}}/resources/js/crm/salesmandetails.js" type="text/javascript"></script>
	<script src="{{url('/')}}/resources/js/select2.js" type="text/javascript"></script>
	<script src="{{ URL::asset('assets') }}/js/select2.js"></script>
	<script>
		$('.SKMManagement').addClass('kt-menu__item--open');
		$('.salesmandetailssettings').addClass('kt-menu__item--active');
	</script>
	@endsection