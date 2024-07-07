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
                    Car Rental
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

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Customer Source<span style="color: red">*</span></label>
                                    </div>

                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker newcustomer" id="newcustomer" name="newcustomer">
                                            <option value="">select</option>
                                            <option value="1" selected>New Customer</option>
                                            <option value="2">Database</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Customer') </label>
                                    </div>
                                    <div class="col-md-8  input-group-sm">
                                        <select class="form-control single-select kt-selectpicker customer" id="customer" disabled="" name="customer">
                                            <option value="">select</option>
                                            @foreach($customers as $data)
                                            <option value="{{$data->id}}">{{$data->cust_name}}</option>
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
                                        <select class="form-control single-select Cust_category" id="cust_category" name="cust_category">
                                            <option value="">{{ __('customer.Select') }}
                                            </option>@foreach($areaList as $item)
                                            <option value="{{$item->id}}" @if($item->catdefault == 1){{'selected'}}@endif>
                                                {{$item->customer_category}}
                                            </option>@endforeach
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

                                            <input type="text" class="form-control branch" name="cust_code" id="cust_code" placeholder="{{ __('customer.Customer Code') }}" autocomplete="off" readonly="">
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
                                        <select class="form-control single-select" id="cust_type" name="cust_type">
                                            <option value="">{{ __('customer.Select') }}
                                            </option>@foreach ($areaLists as $key)
                                            <option value="{{$key->id}}" @if($key->typedefault == 1){{'selected'}}@endif>{{$key->title}}
                                            </option>@endforeach
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
                                        <select class="form-control single-select" name="cust_group" id="cust_group">
                                            <option value="">{{ __('customer.Select') }}
                                            </option>@foreach($group as $item)
                                            <option value="{{$item->id}}" @if($item->default_grp == 1){{'selected'}}@endif>{{$item->title}}
                                            </option>@endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Customer Name<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 ">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="cust_name" name="cust_name" autocomplete="off" placeholder="Customer Name">
                                        </div>
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

                                            <input type="text" class="form-control" id="building_no" name="building_no" autocomplete="off" placeholder="{{ __('customer.Building No') }}">
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
                                            <input type="text" class="form-control" id="cust_region" name="cust_region" autocomplete="off" placeholder="{{ __('customer.Street Name') }}">
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
                                            <input type="text" class="form-control" id="cust_district" name="cust_district" autocomplete="off" placeholder="{{ __('customer.District') }}">
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
                                            <input type="text" class="form-control" id="cust_city" name="cust_city" autocomplete="off" placeholder="{{ __('customer.City') }}">
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
                                            <select name="cust_country" id="cust_country" class="form-control single-select">
                                                <option value="">{{ __('customer.Select') }}</option>
                                                @foreach($countries as $coun)
                                                <option value="{{$coun->id}}">{{$coun->cntry_name}}</option>
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
                                            <input type="text" class="form-control" id="cust_zip" name="cust_zip" autocomplete="off" placeholder="{{ __('customer.Postal Code') }}">
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
                                            <input type="text" class="form-control" placeholder="{{ __('customer.Mobile') }}" id="mobile" name="mobile" autocomplete="off">
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
                                            <input type="text" class="form-control" placeholder="{{ __('customer.Vat No') }}" id="vatno" name="vatno" autocomplete="off">
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
                                            <input type="text" class="form-control" placeholder="Buyer ID / CR No" id="buyerid_crno" name="buyerid_crno" autocomplete="off">
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
                                        <input type="text" class="form-control" name="renter_iqama" id="renter_iqama" placeholder="Renter ID" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Issue Date </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker" name="iqama_issue_date" id="iqama_issue_date" placeholder="Issue Date" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Expiry Date <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker" name="iqama_exp_date" id="iqama_exp_date" placeholder="Expiry Date" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Licence Number<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="renter_licence_number" id="renter_licence_number" placeholder="Licence Number" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Issue Date</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker" name="renter_licence_issue_date" id="renter_licence_issue_date" placeholder="Issue Date" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Expiry Date <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker" name="renter_licence_exp_date" id="renter_licence_exp_date" placeholder="Expiry Date" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Additional Driver Licence</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="additional_driver_name" id="additional_driver_name" placeholder="Additional Driver Licence" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Issue Date</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker " name="additional_driver_licence_issue_date" id="additional_driver_licence_issue_date" placeholder="Issue Date" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Expiry Date </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker" name="additional_driver_licence_exp_date" id="additional_driver_licence_exp_date" placeholder="Expiry Date" value="">
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
                                        <input type="text" class="form-control kt_datetimepicker" name="isue_date" id="isue_date" value="{{date('d-m-Y')}}" placeholder="Booking Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Booking Expiry date </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker" name="exp_date" id="exp_date" value="{{date('d-m-Y')}}" placeholder="Booking Expiry date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Trip Start Date <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker" name="trip_start_date" id="trip_start_date" value="{{date('d-m-Y')}}" placeholder="Trip Start Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Trip End Date </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker" name="trip_end_date" id="trip_end_date" value="" placeholder="Trip End Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Trip Start Odometer <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="trip_start_odometer" id="trip_start_odometer" value="" placeholder="Trip Start Odometer">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Trip End Odometer </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="trip_end_odometer" id="trip_end_odometer" value="" placeholder="Trip End Odometer">
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
                                            <option value="{{$car->id}}">{{$car->number_plate}}~{{$car->car_name}} </option>
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
                                            <option value="Monthly">Monthly</option>
                                            <option value="Daily">Daily</option>
                                            <option value="Hourly">Hourly</option>
                                            <!-- <option value="Contract">Contract</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-12">
                                <!-- <div class="card-header">Header</div> -->
                                <div class="card-body row">
                                    <div class="col-lg-4">
                                        <div class="form-group row pr-md-3">
                                            <div class="col-md-4">
                                                <label>Rate </label>
                                            </div>
                                            <div class="col-md-8 input-group input-group-sm">
                                                <input type="text" class="form-control" name="rate" id="rate" value="0" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group row pr-md-3">
                                            <div class="col-md-4">
                                                <label>Limit(Km) </label>
                                            </div>
                                            <div class="col-md-8 input-group input-group-sm">
                                                <input type="text" class="form-control" name="limit" id="limit" value="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group row pr-md-3">
                                            <div class="col-md-4">
                                                <label>Aditional Amount(per Km) </label>
                                            </div>
                                            <div class="col-md-8 input-group input-group-sm">
                                                <input type="text" class="form-control" name="aditional_amount" id="aditional_amount" value="0" readonly>
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
<script src="{{url('/')}}/resources/js/carRental/CarInAndOut/add.js" type="text/javascript"></script>
@endsection