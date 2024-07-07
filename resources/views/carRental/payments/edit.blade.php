@extends('carRental.common.layout')

@section('content')
<style>
    #table-wrapper {
        position: relative;
    }

    #table-scroll {
        height: 150px;
        overflow: auto;
        margin-top: 20px;
    }

    #table-wrapper {
        width: 100%;
    }

    .inputpicker-overflow-hidden {
        overflow: hidden;
        width: 100%;
    }

    .inputpicker-div>.inputpicker-input {
        font-size: 11px;
    }

    .inputpicker-arrow {
        top: 8px;
    }

    div.new1 {
        background-color: #f2f3f8;
        height: 20px;
        width: 100%;
        right: -36px;
        position: absolute;
        display: block;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

    .pluseb {
        background-color: #5d78ff;
        height: 100%;
        padding-top: 22%;
        text-align: center;
    }

    .pluseb:hover {
        background-color: #2a4eff;
    }

    .uppy-size--md .uppy-Dashboard-inner {
        width: 100%;
        height: 550px;
    }

    .table-bordered th,
    .table-bordered td {
        border: 0px solid #ebedf2;
        padding: 0px !important;
    }

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

    .mbtn {
        background-color: white;
        color: #74788d;

    }

    .mbtn:hover {
        color: #ffffff;
        background: #5d78ff;
        border-color: #5d78ff;

    }

    .mbdg1 {
        background: #fff;
        color: #a1a3a5;
    }

    .mbdg1:hover {
        background: #0ABB87;
        color: #fff;
    }

    .mbdg2 {
        background: #fff;
        color: #a1a3a5;
    }

    .mbdg2:hover {
        background: #FD397A;
        color: #fff;
    }

    .table-responsive {
        overflow-x: scroll;
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
                    Payment (TRIP-{{$car_in_out_id}})
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body pl-2 pr-2 pb-0">
            <form class="kt-form" id="dataForm">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">Payment Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_4">Car Rental Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_2">@lang('app.Other Information')</a>
                    </li>

                </ul>


                <div class="tab-content">
                    <div class="tab-pane p-2 active" id="kt_tabs_2_1" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Date')<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" name="id" id="id" value="{{$adwance->id}}">
                                        <input type="hidden" name="car_in_out_id" id="car_in_out_id" value="{{$carInAndOut->id}}">
                                        <input type="hidden" name="carInoutId_encrypted" value="{{$carInoutId_encrypted}}">
                                        <input type="text" class="form-control kt_datetimepicker" name="quotedate" id="quotedate" value="{{($adwance->quotedate!='')?\Carbon\Carbon::parse($adwance->quotedate)->format('d-m-Y'):''}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Method')<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="method" name="method">
                                            <option value="1" {{($adwance->method==1)?'selected':''}}>Cash</option>
                                            <option value="2" {{($adwance->method==2)?'selected':''}}>Credit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Salesman')<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="salesman" name="salesman">
                                            <option value="">select</option>
                                            @foreach($salesmen as $data)
                                            <option value="{{$data->id}}" {{($data->id==$adwance->salesman)?'selected':''}}>{{$data->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Currency')<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <select class="form-control single-select currency kt-selectpicker" name="currency" id="currency">
                                            <option value="">Select</option>
                                            @foreach($currencylist as $data)
                                            <option value="{{$data->id}}" {{($data->id==$adwance->currency)?'selected':''}}>{{$data->currency_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Currency Value')</label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <?php
                                        foreach ($currencylist as $data) {
                                            if ($data->currency_default == 1)
                                                $currency_default = $data->value;
                                        }
                                        ?>
                                        <input type="text" class="form-control currency_value" name="currencyvalue" id="currencyvalue" value="{{$adwance->currencyvalue}}" readonly="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Discount Type</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="discount_type" name="discount_type">
                                            <option value="1" {{($adwance->discount_type==1)?'selected':''}}>Flat</option>
                                            <option value="2" {{($adwance->discount_type==2)?'selected':''}}>Percentage</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Prepared By')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="preparedby" name="preparedby">
                                            <option value="">select</option>
                                            @foreach($salesmen as $data)
                                            <option value="{{$data->id}}" {{($data->id==$adwance->preparedby)?'selected':''}}>{{$data->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Approved By')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="approvedby" name="approvedby">
                                            <option value="">select</option>
                                            @foreach($salesmen as $data)
                                            <option value="{{$data->id}}" {{($data->id==$adwance->approvedby)?'selected':''}}>{{$data->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="kt_tabs_2_2" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Notes')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea class="form-control" name="notes" id="notes">{{$adwance->notes}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>@lang('app.Internal Reference')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea class="form-control" name="internalreference" id="internalreference">{{$adwance->notes}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane p-3" id="kt_tabs_2_4" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Issue Date </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control " id="isue_date" value="{{$carInAndOut->isue_date}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Expiry date </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control " id="exp_date" value="{{$carInAndOut->exp_date}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Car Details </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="car_id">
                                            <option value="">Select</option>
                                            @foreach($cars as $car)
                                            <option value="{{$car->id}}" {{($car->id==$carInAndOut->car_id)?'selected':''}}>{{$car->registration_number}}~{{$car->car_name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Rental Type </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <select class="form-control" id="rental_type" readonly>
                                            <option value="">Select</option>
                                            <option value="Monthly" {{($carInAndOut->rental_type=='Monthly')?'selected':''}}>Monthly</option>
                                            <option value="Daily" {{($carInAndOut->rental_type=='Daily')?'selected':''}}>Daily</option>
                                            <option value="Hourly" {{($carInAndOut->rental_type=='Hourly')?'selected':''}}>Hourly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Rate </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" id="rate" value="{{$carInAndOut->rate}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Limit(Km) </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="limit" id="limit" value="{{$carInAndOut->limit}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Aditional Amount(per Km) </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control" name="aditional_amount" id="aditional_amount" value="{{$carInAndOut->aditional_amount}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Trip Start Date </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control " name="trip_start_date" id="trip_start_date" value="{{$carInAndOut->trip_start_date}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Trip End Date </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control " name="trip_end_date" id="trip_end_date" value="{{$carInAndOut->trip_end_date}}">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Renter Name </label>
                                    </div>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <input type="text" class="form-control " name="renter_name" id="renter_name" value="{{$carInAndOut->renter_name}}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>






                <div class="row p-0" style="background-color:#f2f3f8;">
                    <div class="col-12 p-0">
                        <hr style="height: 15px;  background-color: #f2f3f8;width: 100%; position: absolute; left: 0; border: 0;">
                        <br>
                        <br>
                        <div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
                            <table class="table table-striped table-bordered table-hover" id="product_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">#</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; width: 16%;   padding: 2px 7px !important;">@lang('app.Item Name')</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Description')</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" name="name" id="name" value="Car Rental (CAR # {{$carInAndOut->car_id}})" readonly></td>
                                        <td><input type="text" class="form-control" name="description" id="description" value="{{$adwance->description}}"></td>
                                        <td><input type="text" class="form-control integerVal valChanged" name="amount" id="amount" value="{{$adwance->amount}}"></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0; margin-top: 0;">
                    </div>
                </div>



                <!-- <div class="row mt-5">


                </div> -->
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



                                <button type="button" id="advance_submit" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
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
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/carRental/Payments/add.js" type="text/javascript"></script>
@endsection