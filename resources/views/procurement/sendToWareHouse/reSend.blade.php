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
                    Send to Warehouse
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
                        <a class="nav-link " data-toggle="tab" href="#kt_tabs_2_2">Supplier Details</a>
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
                                        <label>Supplier Name </label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" name="" id="" class="form-control" value="{{$MaterialRequest->sup_name}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Transfer Type</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="transfer_type" name="transfer_type">
                                            <option value="">Select</option>
                                            <option value="Send To Warehouse">Send To Warehouse</option>
                                            @if($MaterialRequest->projectname!='')
                                            <option value="Send To Project">Send To Project</option>
                                            <option value="Allocate To Project">Allocate To Project</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label id="lblTo">
                                            <?php $flg = -1; ?>
                                            @if($MaterialRequest->transfer_type=='Send To Warehouse')
                                            <?php $flg = 0; ?>
                                            Warehouse
                                            @endif
                                            @if(($MaterialRequest->transfer_type=='Send To Project')||($MaterialRequest->transfer_type=='Allocate To Project'))
                                            <?php $flg = 1; ?>
                                            Project
                                            @endif
                                        </label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <div id="warehouseDiv" style="display:none">
                                            <select class="form-control single-select kt-selectpicker" id="warehouses" name="warehouses">
                                                <option value="">Select</option>
                                                @foreach ($warehouses as $key => $value)
                                                <option value="{{$value->id}}" {{($MaterialRequest->warehouse_id==$value->id)?'selected':''}}>{{$value->warehouse_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="projectDiv" style="display:none">
                                            <input type="text" name="" id="" class="form-control" value="{{$MaterialRequest->projectname}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Transfer Date </label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" id="warehouse_transfer_date" name="warehouse_transfer_date" value="{{isset($MaterialRequest->warehouse_transfer_date)?date('d-m-Y',strtotime($MaterialRequest->warehouse_transfer_date)):date('d-m-Y')}}" class="form-control kt_datetimepickerr">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane p-3 " id="kt_tabs_2_2" role="tabpanel">
                        <div class="row">
                            <input type="hidden" name="materialRequestid" id="materialRequestid" value="{{$MaterialRequest->epr_id}}">
                            <input type="hidden" name="poId" id="poId" value="{{$MaterialRequest->po_id}}">
                            <input type="hidden" name="grnId" id="grnId" value="{{$MaterialRequest->grn_id}}">
                            <input type="hidden" name="id" id="id" value="{{$MaterialRequest->id}}">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Requested @lang('app.Date')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
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
                                        <input type="text" name="" id="" class="form-control" value="{{$MaterialRequest->ma_category_name}}" readonly>
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
                                        <input type="text" name="" id="" class="form-control" value="{{$MaterialRequest->cust_name}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Project</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" name="" id="" class="form-control" value="{{$MaterialRequest->projectname}}" readonly>
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
                                        <textarea class="form-control" name="internalreference" id="internalreference">{{$MaterialRequest->internalreference}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Printable notes</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea class="form-control" name="notes" id="notes">{{$MaterialRequest->notes}}</textarea>
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
                                        <option value="{{$data->id}}" {{($MaterialRequest->terms==$data->id)?'selected':''}}>{{$data->term}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-12 input-group-sm">

                                    <div class="kt-tinymce">
                                        <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target">{!! $MaterialRequest->description !!}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>






                <div class="row p-0" style="background-color:#f2f3f8;">
                    <input type="hidden" id="deleted_elements" name="deleted_elements">
                    <div>
                        <hr style="height: 15px; background-color: #f2f3f8;  width: 100%; position: absolute; left: 0; border: 0;">
                        <br>
                        <br>
                        <div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">

                            <table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="30px">#</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">@lang('app.Item Name')</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">@lang('app.Description')</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px">@lang('app.Unit')</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px">GRN Qty</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="115px">Deleiverd quantity</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="115px">Received quantity</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="115px">Balance quantity</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $totalQty=0;
                                    $deliverd=0;
                                    $recivedQty=0;
                                    $balanceQty=0;
                                    @endphp
                                    @foreach($MaterialRequestProducts as $key=>$cinvoice_products)
                                    @php
                                    $totalQty+= $cinvoice_products['totalquantity'];
                                    $deliverd+= $cinvoice_products['deliverdquantity'];
                                    $recivedQty+=$cinvoice_products['receivedquantity'];
                                    $balanceQty+=$cinvoice_products['balancequantity'];
                                    @endphp
                                    <tr>
                                        <td style="text-align: center;">{{$key+1}}</td>
                                        <td> <input type="hidden" class="form-control eprPoProductId" name="eprPoProductId[]" id="eprPoProductId{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products['epr_po_product_id']}}" readonly>
                                            <input type="hidden" class="form-control grnProductId" name="grnProductId[]" id="grnProductId{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products['grn_product_id']}}" readonly>
                                            <input class="form-control kt-selectpicker productname" id="productname{{$key+1}}" name="productname[]" data-id="{{$key+1}}" value="{{$cinvoice_products['itemname']}}" readonly>
                                        </td>
                                        <td><textarea class="form-control" rows="1" name="product_description[]" id="product_description{{$key+1}}" data-id="{{$key+1}}" readonly>{{$cinvoice_products['description']}}</textarea></td>
                                        <td><input type="hidden" class="form-control unit" name="unit[]" id="unit{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products['unit']}}" readonly>
                                            <input class="form-control kt-selectpicker unitName" id="unitName{{$key+1}}" name="unitName[]" data-id="{{$key+1}}" value="{{$cinvoice_products['unit_name']}}" readonly>
                                        </td>
                                        <td><input type="text" class="form-control totalQty" name="totalQty[]" id="totalQty{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products['totalquantity']}}" readonly></td>
                                        <td><input type="text" class="form-control deleiverdQty" name="deleiverdQty[]" id="deleiverdQty{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products['deliverdquantity']}}" readonly></td>
                                        <td><input type="text" class="form-control receivedQty" name="receivedQty[]" id="receivedQty{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products['receivedquantity']}}"></td>
                                        <td><input type="text" class="form-control balanceQty" name="balanceQty[]" id="balanceQty{{$key+1}}" data-id="{{$key+1}}" value="{{$cinvoice_products['balancequantity']}}" readonly></td>
                                        <td>
                                            <div class="kt-demo-icon__preview remove" data-id="{{$key+1}}" style="width: fit-content;    margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span> </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0;  margin-top: 0;">
                    </div>
                </div>


                <div class="row mt-5">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label>GRN Quantity</label>
                            </div>
                            <div class="col-md-8 input-group-sm">
                                <input type="text" class="form-control" name="total_po_qty" id="total_po_qty" readonly="" style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$totalQty}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label>Deleiverd Quantity</label>
                            </div>
                            <div class="col-md-8 input-group-sm">
                                <input type="text" class="form-control" name="total_deleiverd_qty" id="total_deleiverd_qty" readonly="" style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$deliverd}}">
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label>Received Quantity</label>
                            </div>
                            <div class="col-md-8 input-group-sm">
                                <input type="text" class="form-control" name="total_qty" id="total_qty" readonly="" style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$recivedQty}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label>Balance Quantity</label>
                            </div>
                            <div class="col-md-8 input-group-sm">
                                <input type="text" class="form-control " name="total_balance_qty" id="total_balance_qty" readonly="" style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$balanceQty}}">
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
                                <button type="button" class="btn btn-primary" id="save_details"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg> &nbsp;Send</button>

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
<script src="{{url('/')}}/resources/js/procurement/sendToWareHouse/reSend.js" type="text/javascript"></script>

<script>
    function totalQtyCalculate() {
        var totalamount = 0;
        $('.totalQty').each(function() {
            var id = $(this).attr('data-id');
            var amount = $('#totalQty' + id + '').val();
            totalamount += parseInt(amount);
        });
        totalamount = getNum(totalamount);
        $('#total_po_qty').val(totalamount);

        totalamount = 0;
        $('.deleiverdQty').each(function() {
            var id = $(this).attr('data-id');
            var amount = $('#deleiverdQty' + id + '').val();
            totalamount += parseInt(amount);
        });
        totalamount = getNum(totalamount);
        $('#total_deleiverd_qty').val(totalamount);

        totalamount = 0;
        $('.receivedQty').each(function() {
            var id = $(this).attr('data-id');
            var amount = $('#receivedQty' + id + '').val();
            totalamount += parseInt(amount);
        });
        totalamount = getNum(totalamount);
        $('#total_qty').val(totalamount);

        totalamount = 0;
        $('.balanceQty').each(function() {
            var id = $(this).attr('data-id');
            var amount = $('#balanceQty' + id + '').val();
            totalamount += parseInt(amount);
        });
        totalamount = getNum(totalamount);
        $('#total_balance_qty').val(totalamount);
    }

    function getNum(val) {
        if (isNaN(val) || val == false || val == null || val == undefined || val == "") {
            return 0;
        }
        return val;
    }
</script>

@endsection