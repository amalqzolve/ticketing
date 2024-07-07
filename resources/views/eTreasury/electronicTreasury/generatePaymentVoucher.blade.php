@extends('eTreasury.common.layout')
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
                    Generate Payment Voucher
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body pl-2 pr-2 pb-0">

            <form class="kt-form" id="kt_form" name="kt_form">

                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">Payment Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_tabs_2_2">Document Information</a>
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
                        <input type="hidden" name="epr_id" id="epr_id" value="{{$MaterialRequest->epr_id}}">
                        <input type="hidden" name="po_id" id="po_id" value="{{$MaterialRequest->po_id}}">
                        <input type="hidden" name="invoice_id" id="invoice_id" value="{{$MaterialRequest->invoice_id}}">
                        <input type="hidden" name="supplier_payement_id" id="supplier_payement_id" value="{{$MaterialRequest->supplier_payement_id}}">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Supplier (Dr Account ) <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" name="supplier_id" id="supplier_id" class="form-control" value=" {{$MaterialRequest->supplier_id}}" readonly>
                                        <input type="text" class="form-control" value=" {{$MaterialRequest->sup_name}}" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Payment (Cr Account) <span style="color: red">*</span></label>
                                        <!-- <br> (Cr Account(from Finance Asset Account))  -->
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select name="payment_cr_account" id="payment_cr_account" class="form-control  single-select kt-selectpicker">
                                            <option value="">- Select Bank / Cash Account -</option>
                                            @foreach($accounts as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Voucher Date <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" name="voucher_date" id="voucher_date" class="form-control kt_datetimepickerr" value="{{date('d-m-Y')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Voucher Notes:</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" name="voucher_notes" id="voucher_notes" class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Voucher Reference:</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" name="voucher_reference" id="voucher_reference" class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Amount <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" name="amount" id="amount" class="form-control" value="{{$amount}}" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 ">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Payment Method <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select name="payment_method" id="payment_method" class="form-control kt-selectpicker">
                                            <option value="">---select---</option>
                                            <option value="1">Cash</option>
                                            <option value="2">Bank Transfer</option>
                                            <option value="3">Cheque</option>
                                            <option value="4">Card Payment</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="cash" class="col-lg-6 pl-0" style="display:none">
                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label> Transaction ID <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8 pr-0 pl-3 input-group-sm">
                                            <input type="text" name="cash_transaction_id" id="cash_transaction_id" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>Transaction Referance <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8 pr-0 pl-3 input-group-sm">
                                            <input type="text" name="cash_transaction_referance" id="cash_transaction_referance" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="bank" class="col-lg-6 pl-0" style="display:none">

                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>Bank Account <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8 pr-0 pl-3 input-group-sm">
                                            <select name="bank_account" id="bank_account" class="form-control  single-select kt-selectpicker">
                                                <option value="">--- Select Bank Account ---</option>
                                                @foreach ($bank as $key => $value)
                                                <option value="{{$value->id}}">{{$value->bank_name}}~~{{$value->iban_swift_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label> Transaction Id <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8 pr-0 pl-3 input-group-sm">
                                            <input type="text" name="bank_transaction_id" id="bank_transaction_id" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label> Transaction Referance <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8 pr-0 pl-3 input-group-sm">
                                            <input type="text" name="bank_transaction_referance" id="bank_transaction_referance" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="cheque" class="col-lg-6 pl-0" style="display:none">
                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label> Cheque Number <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8 pr-0 pl-3 input-group-sm">
                                            <input type="text" name="cheque_number" id="cheque_number" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>Cheque Date <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8  pr-0 pl-3 input-group-sm">
                                            <input type="text" name="cheque_date" id="cheque_date" class="form-control kt_datetimepickerr" value="{{date('d-m-Y')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label> Transaction ID <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8 pr-0 pl-3 input-group-sm">
                                            <input type="text" name="cheque_transaction_id" id="cheque_transaction_id" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>Transaction Referance <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8 pr-0 pl-3 input-group-sm">
                                            <input type="text" name="cheque_transaction_referance" id="cheque_transaction_referance" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="card" class="col-lg-6 pl-0" style="display:none">
                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label> Transaction ID <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8 pr-0 pl-3 input-group-sm">
                                            <input type="text" name="card_transaction_id" id="card_transaction_id" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group  row pr-md-3">
                                        <div class="col-md-4">
                                            <label>Transaction Referance <span style="color: red">*</span></label>
                                        </div>
                                        <div class="col-md-8 pr-0 pl-3 input-group-sm">
                                            <input type="text" name="card_transaction_reference" id="card_transaction_reference" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>

                    <div class="tab-pane p-3 " id="kt_tabs_2_2" role="tabpanel">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Requested @lang('app.Date')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{date('d-m-Y',strtotime($MaterialRequest->quotedate))}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Required @lang('app.Date')</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{date('d-m-Y',strtotime($MaterialRequest->dateofsupply))}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Request type</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{($MaterialRequest->request_type==1)?'Internal use':''}}{{($MaterialRequest->request_type==2)?'Department use':''}}{{($MaterialRequest->request_type==3)?'Personal use':''}}{{($MaterialRequest->request_type==4)?'Project Purpose':''}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>MR Category</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{$MaterialRequest->ma_categoryname}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Request Priority</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{($MaterialRequest->request_priority==1)?'Low':''}}{{($MaterialRequest->request_priority==2)?'Medium':''}}{{($MaterialRequest->request_priority==3)?'High':''}}{{($MaterialRequest->request_priority==4)?'Top Priority':''}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Request against</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{($MaterialRequest->request_against==1)?'BOQ':''}}{{($MaterialRequest->request_against==2)?'Non BOQ':''}}{{($MaterialRequest->request_against==3)?'Stock Request':''}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Client</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{$MaterialRequest->cust_name}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Project</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{$MaterialRequest->project}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>RFQ ID</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{isset($MaterialRequest->rfq_id)?'RFQ#'.$MaterialRequest->rfq_id:''}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>RFQ Genearted Date</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{isset($MaterialRequest->rfq_created_date)?date('d-m-Y',strtotime($MaterialRequest->rfq_created_date)):''}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>RFQ Number</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{$MaterialRequest->rfq_no}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>RFQ Date</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{isset($MaterialRequest->rfq_date)?date('d-m-Y',strtotime($MaterialRequest->rfq_date)):''}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>PO Number</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{isset($MaterialRequest->po_id)?'PO#'.$MaterialRequest->po_id:''}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>PO Date</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" value="{{isset($MaterialRequest->po_date)?date('d-m-Y',strtotime($MaterialRequest->po_date)):''}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Suppleier Invoice Number</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" name="" id="" class="form-control" value="{{$MaterialRequest->supplier_invoice_number}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Suppleier Invoice Date</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" name="" id="" class="form-control" value="{{isset($MaterialRequest->supplier_invoice_date)?date('d-m-Y',strtotime($MaterialRequest->supplier_invoice_date)):''}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Payement Book Date </label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" name="payement_book_date" id="payement_book_date" class="form-control" value=" {{isset($MaterialRequest->payement_book_date)?date('d-m-Y',strtotime($MaterialRequest->payement_book_date)):''}}" readonly>
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
                                        <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target">
                                            {!!$MaterialRequest->description!!}
                                        </textarea>
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
                                <button type="button" class="btn btn-primary" id="btnSave"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg> &nbsp;Save</button>
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
<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/resources/js/e_treasury/electronicTreasury/generatePaymentVoucher.js" type="text/javascript"></script>
@endsection