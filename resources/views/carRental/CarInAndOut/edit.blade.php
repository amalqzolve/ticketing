@extends('carRental.common.layout')

@section('content')
<style>
	.nav-tabs {
		border-bottom: 0px;
	}

	.nav-tabs .nav-link {
		border: 3px solid transparent;
	}

	.nav-tabs .nav-link:hover,
	.nav-tabs .nav-link:focus {
		border-color: #f8fcff #fefeff #979fa8;
	}

	.nav-tabs .nav-link.active,
	.nav-tabs .nav-item.show .nav-link {
		border-color: #ffffff #ffffff #2275d7;
	}
</style>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Edit Car Rental {{$rental->id}}
				</h3>
			</div>

		</div>

		<div class="kt-portlet__body pl-2 pr-2 pb-0">
			<form class="kt-form" id="car-in-and-out-form" autocomplete="off">
				<ul class="nav nav-tabs nav-fill" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">Customer Details</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kt_tabs_2_2">Renter Details</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3">Rental Details</a>
					</li>
				</ul>


				<div class="tab-content">

					<div class="tab-pane p-3 active" id="kt_tabs_2_1" role="tabpanel">
						<div class="row">
							<input type="hidden" name="id" id="id" value="{{$rental->id}}">
							<div class="col-lg-6">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>@lang('app.Customer') </label>
									</div>
									<div class="col-md-8  input-group-sm">
										<select class="form-control single-select kt-selectpicker customer" id="customer" disabled="" name="customer">
											<option value="">select</option>
											@foreach($customers as $data)
											<option value="{{$data->id}}" {{($rental->customer_id==$data->id)?'selected':''}}>{{$data->cust_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Customer Category') }}</label>
									</div>
									<div class="col-md-8  input-group input-group-sm">
										<select class="form-control single-select Cust_category" id="cust_category" name="cust_category" disabled="">
											<option value="">{{ __('customer.Select') }}</option>
											@foreach($areaList as $item)
											<option value="{{$item->id}}" {{($rental->cust_category==$item->id)?'selected':''}}>{{$item->customer_category}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Customer Code') }}</label>
									</div>
									<div class="col-md-8">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control branch" name="cust_code" id="cust_code" placeholder="{{ __('customer.Customer Code') }}" value="{{$rental->cust_code}}" autocomplete="off" readonly="">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row  pr-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Customer Type') }}</label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<select class="form-control single-select" id="cust_type" name="cust_type" disabled="">
											<option value="">{{ __('customer.Select') }}</option>
											@foreach ($areaLists as $key)
											<option value="{{$key->id}}" {{($rental->cust_type==$key->id)?'selected':''}}>{{$key->title}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Customer Group') }}</label>
									</div>
									<div class="col-md-8  input-group input-group-sm">
										<select class="form-control single-select" name="cust_group" id="cust_group" disabled="">
											<option value="">{{ __('customer.Select') }}</option>
											@foreach($group as $item)
											<option value="{{$item->id}}" {{($rental->cust_group==$item->id)?'selected':''}}>{{$item->title}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Building No') }}</label>
									</div>
									<div class="col-md-8 ">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control" value="{{$rental->building_no}}" id="building_no" name="building_no" autocomplete="off" placeholder="{{ __('customer.Building No') }}" readonly>
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
											<input type="text" class="form-control" value="{{$rental->cust_region}}" id="cust_region" name="cust_region" autocomplete="off" placeholder="{{ __('customer.Street Name') }}" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.District') }}</label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" value="{{$rental->cust_district}}" id="cust_district" name="cust_district" autocomplete="off" placeholder="{{ __('customer.District') }}" readonly>
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
											<input type="text" class="form-control" value="{{$rental->cust_city}}" id="cust_city" name="cust_city" autocomplete="off" placeholder="{{ __('customer.City') }}" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Country') }}</label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<select name="cust_country" id="cust_country" class="form-control single-select" disabled>
												<option value="">{{ __('customer.Select') }}</option>
												@foreach($countries as $coun)
												<option value="{{$coun->id}}" {{($rental->cust_country==$coun->id)?'selected':''}}>{{$coun->cntry_name}}</option>
												@endforeach
											</select>
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
											<input type="text" class="form-control" value="{{$rental->cust_zip}}" id="cust_zip" name="cust_zip" autocomplete="off" placeholder="{{ __('customer.Postal Code') }}" readonly>
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
											<input type="text" class="form-control" value="{{$rental->mobile}}" placeholder="{{ __('customer.Mobile') }}" id="mobile" name="mobile" autocomplete="off" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Vat No') }}</label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" value="{{$rental->vatno}}" placeholder="{{ __('customer.Vat No') }}" id="vatno" name="vatno" autocomplete="off" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>Buyer ID / CR No</label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="Buyer ID / CR No" value="{{$rental->buyerid_crno}}" id="buyerid_crno" name="buyerid_crno" autocomplete="off" readonly>
										</div>
									</div>
								</div>
							</div>


						</div>
					</div>

					<div class="tab-pane p-2 " id="kt_tabs_2_2" role="tabpanel">
						<div class="row">

							<div class="col-lg-4">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Renter ID <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control" value="{{$rental->renter_iqama}}" name="renter_iqama" id="renter_iqama" placeholder="Renter ID">
									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>ID Issue Date </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" value="{{($rental->iqama_issue_date!='')?\Carbon\Carbon::parse($rental->iqama_issue_date)->format('d-m-Y'):''}}" name="iqama_issue_date" id="iqama_issue_date" placeholder="ID Issue Date">
									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>ID Expiry Date <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" name="iqama_exp_date" id="iqama_exp_date" value="{{($rental->iqama_exp_date!='')?\Carbon\Carbon::parse($rental->iqama_exp_date)->format('d-m-Y'):''}}" placeholder="ID Expiry Date">
									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Licence Number <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control" name="renter_licence_number" id="renter_licence_number" value="{{$rental->renter_licence_number}}" placeholder="Licence Number">
									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Licence Issue Date </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" name="renter_licence_issue_date" id="renter_licence_issue_date" value="{{($rental->renter_licence_issue_date!='')?\Carbon\Carbon::parse($rental->renter_licence_issue_date)->format('d-m-Y'):''}}" placeholder="Licence Issue Date">
									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Expiry Date <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" name="renter_licence_exp_date" id="renter_licence_exp_date" value="{{($rental->renter_licence_exp_date!='')?\Carbon\Carbon::parse($rental->renter_licence_exp_date)->format('d-m-Y'):''}}" placeholder="Expiry Date">
									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Additional Driver Name </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control" name="additional_driver_name" id="additional_driver_name" value="{{$rental->additional_driver_name}}" placeholder="Additional Driver Name">
									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Issue Date </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker " name="additional_driver_licence_issue_date" id="additional_driver_licence_issue_date" value="{{($rental->additional_driver_licence_issue_date!='')?\Carbon\Carbon::parse($rental->additional_driver_licence_issue_date)->format('d-m-Y'):''}}" placeholder="Issue Date">
									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label> Expiry Date </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" name="additional_driver_licence_exp_date" id="additional_driver_licence_exp_date" value="{{($rental->additional_driver_licence_exp_date!='')?\Carbon\Carbon::parse($rental->additional_driver_licence_exp_date)->format('d-m-Y'):''}}" placeholder="Expiry Date">
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="tab-pane p-2 " id="kt_tabs_2_3" role="tabpanel">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Booking Date <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" name="isue_date" id="isue_date" value="{{($rental->isue_date!='')?\Carbon\Carbon::parse($rental->isue_date)->format('d-m-Y'):''}}" placeholder="Booking Date">
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Booking Expiry date </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" name="exp_date" id="exp_date" value="{{($rental->exp_date!='')?\Carbon\Carbon::parse($rental->exp_date)->format('d-m-Y'):''}}" placeholder="Booking Expiry date">
									</div>
								</div>
							</div>


							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Trip Start Date <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" name="trip_start_date" id="trip_start_date" value="{{($rental->trip_start_date!='')?\Carbon\Carbon::parse($rental->trip_start_date)->format('d-m-Y'):''}}" placeholder="Trip Start Date">
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Trip End Date </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" name="trip_end_date" id="trip_end_date" value="{{($rental->trip_end_date!='')?\Carbon\Carbon::parse($rental->trip_end_date)->format('d-m-Y'):''}}" placeholder="Trip End Date">
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Trip Start Odometer <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control integerVal" name="trip_start_odometer" id="trip_start_odometer" value="{{$rental->trip_start_odometer}}" placeholder="Trip Start Odometer">
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Trip End Odometer </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control integerVal" name="trip_end_odometer" id="trip_end_odometer" value="{{$rental->trip_end_odometer}}" placeholder="Trip End Odometer">
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Car Details <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<select class="form-control single-select kt-selectpicker" id="car_id" name="car_id">
											<option value="">Select</option>
											@foreach($cars as $car)
											<option value="{{$car->id}}" {{($rental->car_id==$car->id)?'selected':''}}>{{$car->number_plate}}~{{$car->car_name}} </option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Rental Type <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<select class="form-control single-select kt-selectpicker" id="rental_type" name="rental_type">
											<option value="">Select</option>
											<option value="Monthly" {{($rental->rental_type=='Monthly')?'selected':''}}>Monthly</option>
											<option value="Daily" {{($rental->rental_type=='Daily')?'selected':''}}>Daily</option>
											<option value="Hourly" {{($rental->rental_type=='Hourly')?'selected':''}}>Hourly</option>
											<!-- <option value="Contract" {{($rental->rental_type=='Contract')?'selected':''}}>Contract</option> -->
										</select>
									</div>
								</div>
							</div>
							<div class="card col-12">
								<div class="card-body row">
									<div class="col-lg-4">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Rate </label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="rate" id="rate" value="{{$rental->rate}}" readonly>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Limit(Km) </label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="limit" id="limit" value="{{$rental->limit}}" readonly>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Aditional Amount(per Km) </label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="aditional_amount" id="aditional_amount" value="{{$rental->aditional_amount}}" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>



						</div>
					</div>

				</div>

				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-12">

							</div>
							<div class="col-lg-12 kt-align-right">
								<button type="reset" class="btn btn-secondary backHome"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
										<line x1="18" y1="6" x2="6" y2="18"></line>
										<line x1="6" y1="6" x2="18" y2="18"></line>
									</svg> &nbsp;@lang('app.Cancel')</button>
								<button type="button" id="btnSaveCarInOut" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
										<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
										<polyline points="22 4 12 14.01 9 11.01"></polyline>
									</svg>
									&nbsp;Save
								</button>

							</div>
						</div>
					</div>
				</div>



			</form>



		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{url('/')}}/resources/js/carRental/CarInAndOut/edit.js" type="text/javascript"></script>
@endsection