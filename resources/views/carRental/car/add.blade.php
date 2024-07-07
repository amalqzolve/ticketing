@extends('carRental.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
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
                    New Car Details
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body pl-2 pr-2 pb-0">
            <form class="kt-form" id="car-form">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">Car Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_4">Fare Details</a>
                    </li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane p-2 active" id="kt_tabs_2_1" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Car Name<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="car_name" placeholder="Car Name" id="car_name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Model <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="model" placeholder="Model" id="model">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Car Category <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="car_category_id" name="car_category_id">
                                            <option value="">Select</option>
                                            @foreach ($carCategory as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Number Plate <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="number_plate" placeholder="Number plate" id="number_plate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Registration Number</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="registration_number" placeholder="Registration Number" id="registration_number">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Chais Number</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="chais_number" placeholder="Chais Number" id="chais_number">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Color</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="color" placeholder="Color" id="color">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Made</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="made" placeholder="Made" id="made">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Brand</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="brand" placeholder="Brand" id="brand">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Present Odometer</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="present_odometer" placeholder="Present Odometer" id="present_odometer">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Type</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="type" placeholder="Type" id="type">
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Ownership</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="ownership_type" name="ownership_type">
                                            <option value="">Select</option>
                                            <option value="Personal">Personal</option>
                                            <option value="Company">Company</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Owner Name</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="owner_name" placeholder="Owner Name" id="owner_name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="phone" placeholder="Phone" id="phone">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="email" placeholder="Email" id="email">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="address" placeholder="Address" id="address">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane p-3" id="kt_tabs_2_4" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Monthly Charge<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="monthly_charge" placeholder="Monthly charge" id="monthly_charge">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Monthly KM Limit<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="monthly_limit" placeholder="Monthly KM limit" id="monthly_limit">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Add.Fare / 1 KM<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="monthly_additional_charge" placeholder="Monthly Additional Charge" id="monthly_additional_charge" value="0.00">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Daily Charge<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="dayily_charge" placeholder="Dayily charge" id="dayily_charge">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Daily KM Limit<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="daily_limit" placeholder="Daily KM limit" id="daily_limit">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Add.Fare / 1 KM <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="dayily_additional_charge" placeholder="Additional Charge" id="dayily_additional_charge" value="0.00">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Hourly Charge <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="hourly_charge" placeholder="Hourly charge" id="hourly_charge">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Hourly KM Limit <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="hourly_limit" placeholder="Hourly KM limit" id="hourly_limit">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Add.Fare / 1 KM <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="hourly_additional_charge" placeholder="Additional Charge" id="hourly_additional_charge" value="0.00">
                                    </div>
                                </div>
                            </div>


                            <!-- <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Contract Charge <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="contract_charge" placeholder="Contract charge" id="contract_charge">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Contract KM Limit <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="contract_limit" placeholder="Contract KM limit" id="contract_limit">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                        <label>Add.Fare / 1 KM <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control integerVal" name="contract_additional_charge" placeholder="Contract Charge" id="contract_additional_charge" value="0.00">
                                    </div>
                                </div>
                            </div> -->

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
                                <button type="button" id="car-submit" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
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
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/carRental/car.js" type="text/javascript"></script>
@endsection