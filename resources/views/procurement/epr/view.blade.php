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
<!-- model -->
<div class="modal fade" id="kt_modal_4_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="min-width: 1024px;">
    <input type="hidden" name="id" id="id" value="">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('mainproducts.Product List') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="kt-form kt-form--label-right" id="category-form" name="category-form">
                    <div class="kt-portlet__body">

                        <table class="table table-striped table-hover table-checkable dataTable no-footer" id="productdetails_list">
                            <thead>
                                <tr>
                                    <th>{{ __('mainproducts.S.No') }}</th>
                                    <th>{{ __('mainproducts.Product Name') }}</th>
                                    <th>Description</th>
                                    <th>{{ __('mainproducts.Product Code') }}</th>
                                    <th>{{ __('mainproducts.Barcode') }}</th>
                                    <th>{{ __('mainproducts.Unit') }}</th>
                                    <th>Product price</th>
                                    <th>Selling price</th>
                                    <th>Stock</th>
                                    <th>WH</th>
                                    <th>Store</th>
                                    <!-- <th>Rack</th> -->
                                    <th>Category</th>
                                    <!--  <th>Type</th>
            <th>Status</th> -->
                                    <!-- <th>ID</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <table class="table" style="width:50%; margin-left:50%;">
                            <thead class="thead-light">
                                <tr>
                                    <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total items selected</td>
                                    <td style="border-bottom: 1px dashed gray; text-align: right;">
                                        <input type="text" id="selected_items" readonly="" class="form-control input form-control-sm" style="border:0; text-align: right; background-color: #fff; height: calc(0.5em + 1rem + 2px);font-size: 20px; font-weight:bold;">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total amount</td>
                                    <td style="border-bottom: 1px dashed gray;text-align: right;">
                                        <input type="text" id="selected_amount" readonly="" class="form-control form-control-sm" style="border:0; text-align: right; background-color: #fff; height: calc(0.5em + 1rem + 2px);font-size: 20px; font-weight:bold;">

                                    </td>
                                </tr>

                            </thead>
                        </table>
                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm float-right ml-2" id="datatableadd"><i class="la la-plus"></i>Add</button>
                        <button type="button" class="btn btn-secondary btn-icon-sm float-right" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg> Cancel</button>


                    </div>
            </div>

        </div>
    </div>

</div>

<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true" style="min-width: 1024px;">
    <input type="hidden" name="id" id="id" value="">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Boq List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="kt-form kt-form--label-right" id="category-form" name="category-form">
                    <div class="kt-portlet__body">

                        <table class="table table-striped table-hover table-checkable dataTable no-footer" id="productdetails_list111">
                            <thead>
                                <tr>
                                    <th>{{ __('mainproducts.S.No') }}</th>
                                    <th>{{ __('mainproducts.Product Name') }}</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <!-- <th>{{ __('mainproducts.Product Code') }}</th>
                                    <th>{{ __('mainproducts.Barcode') }}</th>
                                    <th>{{ __('mainproducts.Unit') }}</th>
                                    <th>Product price</th>
                                    <th>Selling price</th>
                                    <th>Stock</th>
                                    <th>WH</th>
                                    <th>Store</th>
                                    <th>Category</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <!-- <table class="table" style="width:50%; margin-left:50%;">
                            <thead class="thead-light">
                                <tr>
                                    <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total items selected</td>
                                    <td style="border-bottom: 1px dashed gray; text-align: right;">
                                        <input type="text" id="selected_items" readonly="" class="form-control input form-control-sm" style="border:0; text-align: right; background-color: #fff; height: calc(0.5em + 1rem + 2px);font-size: 20px; font-weight:bold;">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total amount</td>
                                    <td style="border-bottom: 1px dashed gray;text-align: right;">
                                        <input type="text" id="selected_amount" readonly="" class="form-control form-control-sm" style="border:0; text-align: right; background-color: #fff; height: calc(0.5em + 1rem + 2px);font-size: 20px; font-weight:bold;">

                                    </td>
                                </tr>

                            </thead>
                        </table> -->
                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm float-right ml-2" id="datatableadd"><i class="la la-plus"></i>Add</button>
                        <button type="button" class="btn btn-secondary btn-icon-sm float-right" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg> Cancel</button>


                    </div>
            </div>

        </div>
    </div>

</div>
<!-- ./model -->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Edit Electronic purchase request
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body pl-2 pr-2 pb-0">

            <form class="kt-form" id="kt_form" name="kt_form">

                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">M R Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_2">@lang('app.Other Information')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3">Terms and Conditions</a>
                    </li>


                </ul>


                <div class="tab-content">
                    <div class="tab-pane p-2 active" id="kt_tabs_2_1" role="tabpanel">
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
                                        <input type="text" name="" id="" class="form-control" value="" readonly>
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
                                        <textarea class="form-control" name="internalreference" id="internalreference" readonly>{{$MaterialRequest->internalreference}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Printable notes</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea class="form-control" name="notes" id="notes" readonly>{{$MaterialRequest->notes}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane p-3" id="kt_tabs_2_3" role="tabpanel">
                        <div class="col-lg-12">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-3">
                                    <label>@lang('app.Terms and Conditions')</label>
                                </div>
                                <div class="col-md-9 input-group-sm">

                                    <input type="hidden" name="terms" id="terms" value="{{$MaterialRequest->terms}}">
                                    <input type="text" name="" id="" class="form-control" value="@foreach ($termslist as $key => $value) {{($MaterialRequest->terms==$value->id)?$value->term:''}} @endforeach" readonly>


                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="form-group  row pr-md-3">
                                <!-- <div class="col-md-4">
                              <label>Terms and Conditions Preview</label>
                              </div>   -->
                                <div class="col-md-12 input-group-sm">

                                    <div class="kt-tinymce">
                                        <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target" readonly>
                                            @foreach($termslist as $data)
                                            {{($MaterialRequest->terms==$data->id)? $data->description:''}}
                                            @endforeach 
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($MaterialRequestProducts as $key=>$cinvoice_products)
                                    <tr>
                                        <td style="text-align: center;">{{$key+1}}</td>
                                        <td><input class="form-control kt-selectpicker productname" id="productname{{$key+1}}" name="productname[]" data-id="{{$key+1}}" value="{{$cinvoice_products->itemname}}">
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
                                        <!-- <td>
                                            <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span> </div>
                                        </td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- <table style="width:100%">
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" id="addNewItem"><i class="la la-plus"></i>Line Item</button>
                                        <!-- data-type="add" data-toggle="modal" data-target="#kt_modal_4_4" -->
                            </td>

                            </tr>
                            </table> -->


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
<script src="{{url('/')}}/resources/js/procurement/epr/datalineEdit.js" type="text/javascript"></script>

<script>
    function createproductvialoop(product_name_array) {

        for (i = 0; i < product_name_array.length; ++i) {

            createproduct(product_name_array[i]);
        }
    }

    function createproduct(product_name) {
        $.ajax({
            url: "getproduct_name_details_quotation",
            method: "POST",
            data: {
                _token: $('#token').val(),
                id: product_name
            },
            dataType: "json",
            success: function(data) {

                $.each(data, function(key, value) {
                    rowcount = $('#product_table tr').length;

                    var des = value.description != null ? value.description : '-';
                    var selling_price = (value.selling_price != null) ? value.selling_price : 0;
                    var product = '';
                    product += '<tr>\
                 <td style="text-align: center;">' + rowcount + '</td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname" data-id="' + rowcount + '" value="' + value.product_name + '">\
                 <div>\
                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id" data-id="' + rowcount + '" value="' + value.product_id + '">\
                 </td>\
                 <td><textarea class="form-control" id="product_description' + rowcount + '" name="product_description[]" rows="1" data-id=' + rowcount + ' style=" height: 30px !important;">' + des + '</textarea>\
                 </td>\
                 <td>\
                 <div>\
                 <select class="form-control form-control-sm single-select unit kt-selectpicker"  data-id="' + rowcount + '" name="unit[]" id="unit' + rowcount + '">\
                 <option value="">select</option>\
                  @foreach($unitlist as $data)\
                   <option value="{{$data->id}}">{{$data->unit_name}}</option>\
                   @endforeach\
                 </select>\
                  </div>\
                 <div class="input-group input-group-sm">\
                 <input type="hidden" class="form-control unitvalue" name="unitvalue[]" id="unitvalue' + rowcount + '"  data-id="' + rowcount + '">\
                 </div>\
                 <div class="input-group input-group-sm">\
                 <input type="hidden" class="form-control quantity_value" name="quantity_value[]" id="quantity_value' + rowcount + '"  data-id="' + rowcount + '" value="1">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                  <input type="text" class="form-control quantity"  data-id="' + rowcount + '" name="quantity[]" id="quantity' + rowcount + '" value="1">\
                 </div>\
                 </td>\
                 <td  style="background-color: white;">\
                      <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">\
                                          <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
                                          <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>\
                                       </div>\
                        </td>\
                 </tr>';

                    $('#product_table').append(product);
                    $('.vat_percentage').trigger("change");
                    $("#unit" + rowcount).val(value.unit).change();
                    $("#unitvalue" + rowcount).val(value.unit);


                });

                rowcount++;
            }
        })
    }

    function addblankRow() {
        rowcount = $('#product_table tr').length;

        var product = '';
        product += '<tr>\
<td style="text-align: center;">' + rowcount + '</td>\
<td>\
<div class="input-group input-group-sm">\
<input type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname" data-id="' + rowcount + '" value="">\
<div>\
<input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id" data-id="' + rowcount + '" value="">\
</td>\
<td><textarea class="form-control" id="product_description' + rowcount + '" name="product_description[]" rows="1" data-id=' + rowcount + ' style=" height: 30px !important;"></textarea>\
</td>\
<td>\
<div>\
<select class="form-control form-control-sm single-select unit kt-selectpicker"  data-id="' + rowcount + '" name="unit[]" id="unit' + rowcount + '">\
<option value="">select</option>\
@foreach($unitlist as $data)\
<option value="{{$data->id}}">{{$data->unit_name}}</option>\
@endforeach\
</select>\
</div>\
<div class="input-group input-group-sm">\
<input type="hidden" class="form-control unitvalue" name="unitvalue[]" id="unitvalue' + rowcount + '"  data-id="' + rowcount + '">\
</div>\
<div class="input-group input-group-sm">\
<input type="hidden" class="form-control quantity_value" name="quantity_value[]" id="quantity_value' + rowcount + '"  data-id="' + rowcount + '" value="1">\
</div>\
</td>\
<td>\
<div class="input-group input-group-sm">\
<input type="text" class="form-control quantity"  data-id="' + rowcount + '" name="quantity[]" id="quantity' + rowcount + '" value="1">\
</div>\
</td>\
<td  style="background-color: white;">\
  <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">\
                      <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
                      <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>\
                   </div>\
    </td>\
</tr>';

        $('#product_table').append(product);
        $("#unit" + rowcount).val('').change();
        $("#unitvalue" + rowcount).val('');
    }
</script>
@endsection