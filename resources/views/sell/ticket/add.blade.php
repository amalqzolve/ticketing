@extends('sell.common.layout')

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h5 class="kt-portlet__head-title">
                    New Ticket
                </h5>
            </div>

        </div>

        <div class="kt-portlet__body pl-2 pr-2 pb-0">

            <form class="kt-form" id="kt_form">
                <input type="hidden" name="id" id="id" value="">
                <input type="hidden" id="sales_order_id" name="sales_order_id" value="{{ $sales_order_id }}">
                <div class="tab-content">
                    <div class="tab-pane p-2 active" id="kt_tabs_2_1" role="tabpanel">
                        <h5>Traveler Details</h5>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Contact Person<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="name" id="name" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label> Address </label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="address" id="address" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="phone" id="phone" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="email" id="email" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Country</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="country" name="country">
                                            <option value="">select</option>
                                            @foreach ($country as $data)
                                            <option value="{{ $data->id }}">{{ $data->cntry_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Passport No </label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="passport_no" id="passport_no" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Passport Issue Date</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" name="issue_date" id="issue_date" value="{{ date('d-m-Y') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>
                                            Passport Expiry Date</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" name="expiry_date" id="expiry_date" value="{{ date('d-m-Y', strtotime('+30 days')) }}">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <h5>
                            Booking Details
                        </h5>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Trip</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="trip_details" name="trip_details">
                                            <option value="">select</option>
                                            <option value="Single" selected>Single</option>
                                            <option value="Round">Round</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Booking ID</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="booking_id" id="booking_id" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Booking Status</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="booking_status" name="booking_status">
                                            <option value="">select</option>
                                            <option value="Confirmed" selected>Confirmed</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Booked">Pending</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Class</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control " name="class" id="class" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Type</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="type" id="type" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Seat</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control " name="seat" id="seat" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Boarding Time</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker_with_time" name="boarding_time" id="boarding_time" value="{{ date('d-m-Y H:i') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Notes</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="notes" id="notes" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Baggage allowances</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="baggage_allowances" id="baggage_allowances" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Add on Services</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="extra_services" id="add_on_services" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5>
                            Ticket details
                        </h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Ticket no</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="ticket_no" id="ticket_no" value="">
                                    </div>
                                </div>
                            </div>


                            {{-- </div>

                            <div class="row"> --}}
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Airlines</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="airlines" name="airlines">
                                            <option value="">select</option>
                                            @foreach ($airline as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Airline Booking Reference</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="airline_booking_reference" id="airline_booking_reference" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Agency</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="agency" id="agency" value="">
                                    </div>
                                </div>
                            </div>


                            {{-- <div class="row"> --}}
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Departure Location</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="departure" name="departure">
                                            <option value="">select</option>
                                            @foreach ($airports as $data)
                                            <option value="{{ $data->code }}">
                                                {{ $data->code }}~{{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Departure Date and Time</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker_with_time" name="departure_date" id="departure_date" value="{{ date('d-m-Y H:i') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Arrival Location</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="arrival" name="arrival">
                                            <option value="">select</option>
                                            @foreach ($airports as $data)
                                            <option value="{{ $data->code }}">
                                                {{ $data->code }}~{{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Arrival Date and Time</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepicker_with_time" name="arrival_date" id="arrival_date" value="{{ date('d-m-Y H:i') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group  row ">
                                <label class="kt-checkbox kt-checkbox--brand">
                                    <input type="checkbox" value="1" id="show_fair" name="show_fair"> Show Fare
                                    on Print
                                    <span></span>
                                </label>
                            </div>
                        </div>


                    </div>
                </div>
        </div>



        <div class="row p-0" style="background-color:#f2f3f8;">
            <div class="col-12 p-0">
                <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute;left: 0; border: 0;">
                <br>
                <br>
                <div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover" id="product_table">
                            <!-- style="table-layout:fixed; width:100%" -->
                            <thead class="thead-light">
                                <tr>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                        #</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;  width: 16%;   padding: 2px 7px !important;">
                                        Passenger Name</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                        Pasport no</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                        Issue date</th>

                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                        Expiry Date</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                        Ticket no</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                        Bookig id</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">
                                        Fare</th>
                                    <th style="background-color:  #3f4aa0;  color: white; white-space: nowrap;     padding: 2px 7px !important; ">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><input type="text" class="form-control " name="add_passenger_name[]" id="add_passenger_name" value=""></td>
                                    <td><input type="text" class="form-control " name="add_passenger_passport[]" id="add_passenger_passport" value=""></td>
                                    <td><input type="text" class="form-control kt_datetimepickerr" name="add_passenger_passport_issue_date[]" id="add_passenger_passport_issue_date" value=""></td>
                                    <td><input type="text" class="form-control kt_datetimepickerr" name="add_passenger_passport_exp_date[]" id="add_passenger_passport_exp_date" value=""></td>
                                    <td><input type="text" class="form-control " name="add_passenger_ticket_number[]" id="add_passenger_ticket_number" value=""></td>
                                    <td><input type="text" class="form-control " name="add_passenger_booking_id[]" id="add_passenger_booking_id" value=""></td>
                                    <td><input type="text" class="form-control integerVal " name="add_fare[]" id="add_fare" value=""></td>
                                    <td>
                                        <div class="col-md-6 kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">
                                            <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">
                                                <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <table style="width:100%">
                        <tr>
                            <td>
                                <button type="button" id="add_row" class="btn btn-brand btn-elevate btn-icon-sm  float-right"><i class="la la-plus"></i>Passenger</button>
                            </td>
                        </tr>
                    </table>


                </div>
                                        <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0; margin-top: 0;">


            </div>
        </div>

        <div class="row mt-5">


            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
                <div class="form-group  row pr-md-3">
                    <div class="col-md-4">
                        <label style="font-size: 1.5rem;font-weight: bold; padding-top:4px">Total Fare</label>
                    </div>
                    <div class="col-md-8 input-group-sm">
                        <input type="text" class="form-control" name="total_amount" id="total_amount" value="0" readonly style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem;font-weight: bold; color: #646c9a; padding-top: 0px;">
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
                        <button id="btnSave" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            {{ __('app.Save') }}
                        </button>

                    </div>
                </div>
            </div>
        </div>



        </form>



    </div>
</div>
</div>

<style type="text/css">
    .hideButton {
        display: none
    }

    .error {
        color: red
    }
</style>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.kt_datetimepicker_with_time').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'dd-mm-yyyy hh:ii'
        });

        $('.kt_datetimepickerr').datepicker({
            todayHighlight: true,
            format: 'dd-mm-yyyy'
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });

        $('#add_row').click(function() {
            rowcount = $('#product_table tr').length;
            var product = '';
            product += '<tr> <td>' + rowcount +
                '</td>\
                     <td><input type="text" class="form-control " name="add_passenger_name[]"\
                             id="add_passenger_name" value=""></td>\
                     <td><input type="text" class="form-control " name="add_passenger_passport[]"\
                             id="add_passenger_passport" value=""></td>\
                     <td><input type="text" class="form-control kt_datetimepickerr"\
                            name="add_passenger_passport_issue_date[]"\
                             id="add_passenger_passport_issue_date" value="{{date("d-m-Y")}}"></td>\
                           <td><input type="text" class="form-control kt_datetimepickerr"\
                            name="add_passenger_passport_exp_date[]"\
                            id="add_passenger_passport_exp_date" value="{{date("d-m-Y")}}"></td>\
                    <td><input type="text" class="form-control "\
                            name="add_passenger_ticket_number[]" id="add_passenger_ticket_number"\
                            value=""></td>\
                    <td><input type="text" class="form-control " name="add_passenger_booking_id[]"\
                            id="add_passenger_booking_id" value=""></td>\
                    <td><input type="text" \class="form-control integerVal" name="add_fare[]"\
                        id="fare" value=""></td>\
                    <td>\
                        <div class="col-md-6 kt-demo-icon__preview remove"\
                            style="width: fit-content;    margin: auto;">\
                            <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
                                <i class="fa fa-trash badge-pill" id=""\
                                    style="padding:0; cursor: pointer;"></i></span>\
                        </div>\
                    </td>\
                 </tr>';
            $('#product_table').append(product);
            findTotal();
            $('.kt_datetimepickerr').datepicker({
                todayHighlight: true,
                format: 'dd-mm-yyyy'
            }).on('changeDate', function(e) {
                $(this).datepicker('hide');
            });
        });

        $("body").on("click", ".remove", function(event) {
            event.preventDefault();
            var row = $(this).closest('tr');
            var siblings = row.siblings();
            row.remove();
            siblings.each(function(index) {
                $(this).children().first().text(index + 1);
            });
        });

        $(document).on('click', '#btnSave', function(e) {
            e.preventDefault();
            var error = 0;
            if ($('#name').val() == "") {
                $('#name').addClass('is-invalid');
                error++;
            } else
                $('#name').removeClass('is-invalid');
            if (!error) {
                $('#btnSave').addClass('kt-spinner');
                var sucess_msg;
                if ($('#id').val() != '')
                    sucess_msg = 'Created';
                else
                    sucess_msg = 'Updated';

                var add_passenger_name = [];
                $("input[name^='add_passenger_name[]']").each(function(input) {
                    add_passenger_name.push($(this).val());
                });

                var add_passenger_passport = [];
                $("input[name^='add_passenger_passport[]']").each(function(input) {
                    add_passenger_passport.push($(this).val());
                });

                var add_passenger_passport_issue_date = [];
                $("input[name^='add_passenger_passport_issue_date[]']").each(function(input) {
                    add_passenger_passport_issue_date.push($(this).val());
                });

                var add_passenger_passport_exp_date = [];
                $("input[name^='add_passenger_passport_exp_date[]']").each(function(input) {
                    add_passenger_passport_exp_date.push($(this).val());
                });

                var add_passenger_ticket_number = [];
                $("input[name^='add_passenger_ticket_number[]']").each(function(input) {
                    add_passenger_ticket_number.push($(this).val());
                });

                var add_passenger_booking_id = [];
                $("input[name^='add_passenger_booking_id[]']").each(function(input) {
                    add_passenger_booking_id.push($(this).val());
                });

                var add_fare = [];
                $("input[name^='add_fare[]']").each(function(input) {
                    add_fare.push($(this).val());
                });


                $.ajax({
                    type: "POST",
                    url: "../new-ticket-submit_sell",
                    dataType: "json",
                    data: {
                        _token: $('#token').val(),
                        id: $('#id').val(),
                        sales_order_id: $('#sales_order_id').val(),
                        name: $('#name').val(),
                        address: $('#address').val(),
                        phone: $('#phone').val(),
                        email: $('#email').val(),
                        country: $('#country').val(),
                        passport_no: $('#passport_no').val(),
                        issue_date: $('#issue_date').val(),
                        expiry_date: $('#expiry_date').val(),
                        trip_details: $('#trip_details').val(),
                        booking_id: $('#booking_id').val(),
                        booking_status: $('#booking_status').val(),
                        booking_status: $('#booking_status').val(),
                        class: $('#class').val(),
                        type: $('#type').val(),
                        seat: $('#seat').val(),
                        boarding_time: $('#boarding_time').val(),
                        notes: $('#notes').val(),
                        baggage_allowances: $('#baggage_allowances').val(),
                        extra_services: $('#extra_services').val(),
                        ticket_no: $('#ticket_no').val(),
                        airlines: $('#airlines').val(),
                        airline_booking_reference: $('#airline_booking_reference').val(),
                        agency: $('#agency').val(),
                        departure: $('#departure').val(),
                        departure_date: $('#departure_date').val(),
                        arrival: $('#arrival').val(),
                        arrival_date: $('#arrival_date').val(),
                        show_fair: ($("#show_fair").prop('checked') == true) ? 1 : '',
                        total_amount: $('#total_amount').val(),
                        add_passenger_name: add_passenger_name,
                        add_passenger_passport: add_passenger_passport,
                        add_passenger_passport_issue_date: add_passenger_passport_issue_date,
                        add_passenger_passport_exp_date: add_passenger_passport_exp_date,
                        add_passenger_ticket_number: add_passenger_ticket_number,
                        add_passenger_booking_id: add_passenger_booking_id,
                        add_fare: add_fare,
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $('#btnSave').removeClass('kt-spinner');
                            $('#btnSave').prop("disabled", false);
                            toastr.error(data.msg);
                        } else {
                            $('#btnSave').removeClass('kt-spinner');
                            $('#btnSave').prop("disabled", false);
                            toastr.success('Ticket Details' + sucess_msg + ' successfuly');
                            window.location.href = "../ticket_list/" + $('#sales_order_id')
                                .val();
                        }

                    },
                    error: function(jqXhr, json, errorThrown) {
                        console.log('Error !!');
                    }
                });
            } else
                toastr.error('Validation Error');
        });



    });


    $(document).on('keyup', "input[name^='add_fare[]']", function() {
        findTotal();
    });

    function findTotal() {
        var totalamount = 0;
        $("input[name^='add_fare[]']").each(function() {
            var currentVal = $(this).val();
            if (currentVal != '')
                totalamount += parseFloat(currentVal);
        });
        $('#total_amount').val(totalamount)
    }
</script>
<script>
    $(document).ready(function() {
        $('.sell_saleorder_list').addClass('kt-menu__item--active');
    });
</script>
@endsection