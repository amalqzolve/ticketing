@extends('procurement.common.layout')
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

    .dataTables_wrapper .dataTable .selected th,
    .dataTables_wrapper .dataTable .selected td {
        background-color: #f4e92b !important;
        /* color: #595d6e; */
    }

    #productdetails_list_wrapper {
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
                    Generate Request for Quotation
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body pl-2 pr-2 pb-0">

            <form class="kt-form" id="kt_form" name="kt_form">

                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">Quotation Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_tabs_2_2">Document Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3">@lang('app.Other Information')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_4">Terms and Conditions</a>
                    </li>
                </ul>


                <div class="tab-content">

                    <div class="tab-pane p-2 active" id="kt_tabs_2_1" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>RFQ @lang('app.Date')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" name="rfq_date" id="rfq_date" value="{{date('d-m-Y')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>RFQ Valid Till</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" name="rfq_valid_till" id="rfq_valid_till" value="{{date('d-m-Y')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Supplier Name <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select input-group-sm kt-selectpicker supplier_vendor_names kt-select2" name="supplier_vendor_names[]" id="supplier_vendor_names" multiple="">
                                            @foreach($supplier as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->sup_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane p-3 " id="kt_tabs_2_2" role="tabpanel">
                        <div class="row">
                            <input type="hidden" name="materialRequestid" id="materialRequestid" value="{{$MaterialRequest->id}}">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Requested @lang('app.Date')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" class="form-control kt_datetimepickerr" name="quotedate" id="quotedate" value="{{date('d-m-Y',strtotime($MaterialRequest->quotedate))}}">
                                        <input type="text" name="" id="" class="form-control" value="{{date('d-m-Y',strtotime($MaterialRequest->quotedate))}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Required @lang('app.Date')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" class="form-control kt_datetimepickerr" name="dateofsupply" id="dateofsupply" value="{{date('d-m-Y',strtotime($MaterialRequest->dateofsupply))}}">
                                        <input type="text" name="" id="" class="form-control" value="{{date('d-m-Y',strtotime($MaterialRequest->dateofsupply))}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Request type</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" id="request_type" name="request_type" value="{{$MaterialRequest->request_type}}">
                                        <input type="text" name="" id="" class="form-control" value="{{($MaterialRequest->request_type==1)?'Internal use':''}}{{($MaterialRequest->request_type==2)?'Department use':''}}{{($MaterialRequest->request_type==3)?'Personal use':''}}{{($MaterialRequest->request_type==4)?'Project Purpose':''}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>MR Category</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" id="mr_category" name="mr_category" value="{{$MaterialRequest->mr_category}}">
                                        <input type="text" name="" id="" class="form-control" value="@foreach ($materialCategory as $key => $value) {{($MaterialRequest->mr_category==$value->id)?$value->name:''}} @endforeach" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Request Priority</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" id="request_priority" name="request_priority" value="{{$MaterialRequest->request_priority}}">
                                        <input type="text" name="" id="" class="form-control" value="{{($MaterialRequest->request_priority==1)?'Low':''}}{{($MaterialRequest->request_priority==2)?'Medium':''}}{{($MaterialRequest->request_priority==3)?'High':''}}{{($MaterialRequest->request_priority==4)?'Top Priority':''}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Request against</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" id="request_against" name="request_against" value="{{$MaterialRequest->request_against}}">
                                        <input type="text" name="" id="" class="form-control" value="{{($MaterialRequest->request_against==1)?'BOQ':''}}{{($MaterialRequest->request_against==2)?'Non BOQ':''}}{{($MaterialRequest->request_against==3)?'Stock Request':''}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Client</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" id="client" name="client" value="{{$MaterialRequest->client}}">
                                        <input type="text" name="" id="" class="form-control" value="@foreach ($customers as $key => $value) {{($MaterialRequest->client==$value->id)?$value->cust_name:''}} @endforeach" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Project</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" id="project" name="project" value="{{$MaterialRequest->project}}">
                                        <input type="text" name="" id="" class="form-control" value="@foreach ($projects as $key => $value) {{($MaterialRequest->project==$value->id)?$value->projectname:''}} @endforeach" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane p-3" id="kt_tabs_2_3" role="tabpanel">
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
                            <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Printable notes</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea class="form-control" name="notes" id="notes"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="kt_tabs_2_4" role="tabpanel">
                        <div class="col-lg-12">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-3">
                                    <label>@lang('app.Terms and Conditions')</label>
                                </div>
                                <div class="col-md-9 input-group-sm">
                                    <select class="form-control single-select kt-selectpicker" id="terms" name="terms">
                                        <option value="">select</option>
                                        @foreach($termslist as $data)
                                        <option value="{{$data->id}}">{{$data->term}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-12 input-group-sm">
                                    <div class="kt-tinymce">
                                        <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target" readonly>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>






                <div class="row p-0" style="background-color:#f2f3f8;">
                    <div>
                        <hr style="height: 15px; background-color: #f2f3f8;  width: 100%; position: absolute; left: 0; border: 0;">
                        <br>
                        <br>
                        <div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">

                            <table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="30px">#</th>

                                        <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="250px">@lang('app.Item Name')</th>
                                        <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Description')</th>
                                        <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Unit')</th>
                                        <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px">@lang('app.Quantity')</th>
                                        <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($MaterialRequestProducts as $key=>$cinvoice_products)
                                    <tr>
                                        <td style="text-align: center;">{{$key+1}}</td>
                                        <td><input type="hidden" class="form-control kt-selectpicker eprProductId" id="eprProductId{{$key+1}}" name="eprProductId[]" data-id="{{$key+1}}" value="{{$cinvoice_products->id}}"> <input class="form-control kt-selectpicker productname" id="productname{{$key+1}}" name="productname[]" data-id="{{$key+1}}" value="{{$cinvoice_products->itemname}}" readonly>
                                        </td>
                                        <td><textarea class="form-control" rows="1" name="product_description[]" id="product_description{{$key+1}}" data-id="{{$key+1}}">{{$cinvoice_products->description}}</textarea></td>
                                        <td><select class="form-control kt-selectpicker" id="unit{{$key+1}}" name="unit[]" data-id="{{$key+1}}">
                                                <option value="">select</option>
                                                @foreach($unitlist as $data)
                                                @if($cinvoice_products->unit == $data->id)
                                                <option value="{{$data->id}}" selected="">{{$data->unit_name}}</option>
                                                @endif @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control quantity" name="quantity[]" id="quantity{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products->quantity}}"></td>
                                        <td>
                                            <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span> </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr style="height: 15px;
                     background-color: #f2f3f8;
                     width: 100%;
                     position: absolute;
                     left: 0;
                     border: 0;
                     margin-top: 0;">

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


                                <button type="button" class="btn btn-primary" id="epr_update"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
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
<script src="{{url('/')}}/resources/js/procurement/rfq/save.js" type="text/javascript"></script>
@endsection