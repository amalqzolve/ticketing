@extends('request_and_approval.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<style>
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
        height: auto !important;
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
                    New Request
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body pl-2 pr-2 pb-0">

            <form class="kt-form" id="data-form" name="data-form">


                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">Request Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_4">File Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_5">Approval Athority</a>
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
                                        <label>Request Tittle <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="request_tittle" id="request_tittle" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Required on <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" name="required_on" id="required_on" value="{{date('d-m-Y')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label> Priority</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="request_priority" name="request_priority">
                                            <option value="">Select</option>
                                            <option value="1">Low</option>
                                            <option value="2">Medium</option>
                                            <option value="3">High</option>
                                            <option value="4">Top Priority</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Reference </label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="reference" id="reference">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Request against <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="request_against" name="request_against">
                                            <option value="">Select</option>
                                            <option value="1" selected>Personal</option>
                                            <option value="2">Client</option>
                                            <option value="3">Project</option>
                                            <option value="4">Department</option>
                                            <option value="5">Official</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" id="noteDiv">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Note </label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="note" id="note">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6" id="clientDiv" style="display: none;">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Client</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="client" name="client">
                                            <option value="">Select</option>
                                            @foreach ($customers as $key => $value)
                                            <option value="{{$value->id}}">{{$value->cust_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6" id="projectDiv" style="display: none;">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Project</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="project" name="project">
                                            <option value="">Select</option>
                                            @foreach ($projects as $key => $value)
                                            <option value="{{$value->id}}">{{$value->projectname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" id="departmentDiv" style="display: none;">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Department</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control kt-selectpicker" id="department" name="department">
                                            <option value="">Select</option>
                                            @foreach ($projects as $key => $value)
                                            <option value="{{$value->id}}">{{$value->cust_name}}</option>
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
                                        <label>Internal Reference</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea class="form-control" name="internalreference" id="internalreference"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Printable notes</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea class="form-control" name="notes" id="notes"></textarea>
                                    </div>
                                </div>
                            </div> -->
                        </div>


                    </div>

                    <div class="tab-pane p-3" id="kt_tabs_2_5" role="tabpanel">
                        <table class="table table-striped table-bordered table-hover" id="flow_table" style="table-layout:fixed; width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;" width="60px">Sl No</th>
                                    <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;" width="250px">User</th>
                                    <!-- <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;">If Accepted Message</th>
                                    <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;">If Rejected Message</th> -->
                                    <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important;">Type</th>
                                    <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                        <table style="width:100%">
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" id="newrow" onclick="addblankRow()"><i class="la la-plus"></i>Add User</button>
                                </td>
                            </tr>
                        </table>
                    </div>


                    <div class="tab-pane p-3" id="kt_tabs_2_4" role="tabpanel">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <input type="hidden" name="projectfileData" id="projectfileData" value="" />
                                <div id="choose-project-files" style="width: 100%;">
                                    <input type="file" id="project_file" name="project_file[]" accept="image/*" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-0" style="background-color:#f2f3f8;">
                    <div class="col-12">
                        <hr style="height: 15px; background-color: #f2f3f8;  width: 100%; position: absolute; left: 0; border: 0;">
                        <br><br>
                        <div class="row col-md-12 pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
                            <div style="width: 100%; display: block;  overflow-x: scroll;">
                                <table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="30px">#</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="100px">Request</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">@lang('app.Description')</th>
                                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <table style="width:100%">
                                <tr>
                                    <td style="width: 73%;">&nbsp;</td>
                                    <td>
                                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" id="addNewItem"><i class="la la-plus"></i>Line Item</button>&nbsp;
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr style="height: 15px;background-color: #f2f3f8;width: 100%;position: absolute;left: 0;border: 0;margin-top: 0;">
                    </div>
                </div>

                <input type="hidden" name="branch" id="branch" value="">
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

                                <button type="button" class="btn btn-primary" id="epr_submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg> &nbsp;@lang('app.Save')</button>

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
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/resources/js/request_and_approval/request/add.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/asset/tablednd.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $("#flow_table").tableDnD();
    });

    function addblankRow() {
        rowcount = $('#flow_table tr').length;
        var product = '';
        product += '<tr>\
		<td style="text-align: center;">' + rowcount + '</td>\
		<td>\
		<div>\
		<select class="form-control form-control-sm single-select unit kt-selectpicker"  data-id="' + rowcount + '" name="users[]" id="user' + rowcount + '">\
		<option value="">select</option>\
		@foreach($users as $data)\
		<option value="{{$data->id}}">{{$data->name}} - {{$data->email}}</option>\
		@endforeach\
		</select>\
		</div>\
		</td>\
        <td>\
		<div class="input-group input-group-sm">\
		<select class="form-control form-control-sm single-select kt-selectpicker"  data-id="' + rowcount + '" name="approve_type[]" id="approve_type' + rowcount + '">\
        <option value="1">Approver</option>\
        <option value="2">Notifier</option>\
		<div>\
		</td>\
		<td  style="background-color: white;">\
		  <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">\
		                      <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
		                      <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>\
		                   </div>\
		    </td>\
		</tr>';

        $('#flow_table').append(product);
        $("#flow_table").tableDnD();
        refreshItems();

    }
</script>
@endsection