@extends('boq.common.layout')
@section('content')
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

    .dataTables_wrapper .dataTable .selected th,
    .dataTables_wrapper .dataTable .selected td {
        background-color: #f4e92b !important;
        /* color: #595d6e; */
    }

    #productdetails_list_wrapper {
        height: 300px;
        overflow-y: scroll;
    }

    #boqProductdetails_list_wrapper {
        height: 300px;
        overflow-y: scroll;
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
                    Edit Resource directory #RD {{$mainData->id}}
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body pl-2 pr-2 pb-0">

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="30px">#</th>
                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">Resource Name</th>
                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">Description</th>
                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">Code</th>
                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="100px">Unit</th>
                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="100px">Category</th>
                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="100px">Group</th>
                            <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="125px">Amount</th>
                            <!-- <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="60px">@lang('app.Action')</th> -->
                        </tr>
                    </thead>
                    <input type="hidden" name="id" id="id" value="{{$mainData->id}}">
                    <tbody>
                        <tr>
                            <td style="text-align: center;">1</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control single-select material_name kt-selectpicker" name="material_name" id="material_name" value="{{$mainData->material_name}}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control single-select description" name="description" id="description" value="{{$mainData->description}}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control single-select code" name="code" id="code" value="{{$mainData->code}}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control single-select unit" name="unit" id="unit" value="{{$mainData->unit}}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control single-select category kt-selectpicker" name="category" id="category" value="{{$mainData->category}}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control group" name="group" id="group" value="{{$mainData->group}}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control amount" name="amount[]" id="amount" value="{{$mainData->amount}}">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">

                        </div>
                        <div class="col-lg-12 kt-align-right">
                            <button type="reset" class="btn btn-secondary backHome">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg> &nbsp;@lang('app.Cancel')</button>

                            <button type="button" class="btn btn-primary" id="btnSave">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg> &nbsp;Update</button>
                        </div>
                    </div>
                </div>
            </div>
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
<script src="{{url('/')}}/resources/js/boq/material_directory/edit.js" type="text/javascript"></script>
@endsection