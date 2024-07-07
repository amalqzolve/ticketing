@extends('projects.common.layout')
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


<!-- models -->
<div class="modal fade" id="kt_modal_4_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="min-width: 1024px;">
    <input type="hidden" name="id" id="id" value="">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Stock Details</h5>
                <!-- {{ __('mainproducts.Product List') }} -->
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
                                    <th>{{ __('mainproducts.Unit') }}</th>
                                    <th>Stock</th>
                                    <th>WH</th>
                                    <th>Store</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
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
<!-- ./models -->


<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Generate Material Request
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body pl-2 pr-2 pb-0">

            <form class="kt-form" id="kt_form" name="kt_form">

                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">MR Details</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_tabs_2_2">Document Details</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3">@lang('app.Other Information')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_4">Terms and Conditions</a>
                    </li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane p-2 active" id="kt_tabs_2_1" role="tabpanel">

                        <!-- DOCUMENT DETAILS -->
                        <input type="hidden" id="project" name="project" value="{{$projects->id}}">
                        <input type="hidden" id="client" name="client" value="{{$projects->client}}">
                        <!-- ./DOCUMENT DETAILS -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Transfer Requisition @lang('app.Date') <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" name="t_req_date" id="t_req_date" value="{{date('d-m-Y')}}">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Delivery terms</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="delivery_terms" id="delivery_terms" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Required @lang('app.Date') <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" name="dateofsupply" id="dateofsupply" value="{{date('d-m-Y')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Requested @lang('app.Date') <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" name="quotedate" id="quotedate" value="{{date('d-m-Y')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Request type </label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" id="request_type" name="request_type" value="4">
                                        <input type="text" name="" id="" class="form-control" value="Project Purpose" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>MR Category <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select class="form-control single-select kt-selectpicker" id="mr_category" name="mr_category">
                                            <option value="">Select</option>
                                            @foreach ($materialCategory as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Request Priority</label>
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
                                        <label>Request against</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="hidden" id="request_against" name="request_against" value="3">
                                        <input type="text" name="" id="" class="form-control" value="Stock Request" readonly>
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
                                        <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row p-0" style="background-color:#f2f3f8;">
                    <div class="col-12">
                        <hr style="height: 15px; background-color: #f2f3f8;  width: 100%; position: absolute; left: 0; border: 0;">
                        <br> <br>
                        <div style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px; overflow-x:auto;">
                            <table class="table table-striped table-bordered table-hover" id="product_table" style="table-layout:fixed; width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;padding: 2px 7px !important;" width="30px">#</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;padding: 2px 7px !important;" width="250px">@lang('app.Item Name')</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;padding: 2px 7px !important;" width="250px">@lang('app.Description')</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;padding: 2px 7px !important;" width="70px">@lang('app.Unit')</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;padding: 2px 7px !important;" width="75px">@lang('app.Quantity')</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;padding: 2px 7px !important;" width="85px">Warehouse</th>
                                        <th style="background-color:  #3f4aa0; color: white; white-space: nowrap;padding: 2px 7px !important;" width="50px">@lang('app.Action')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <table style="width:100%">
                                <tr>
                                    <td style="width: 73%;">&nbsp;</td>
                                    <td>
                                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" id="addNewItem"><i class="la la-plus"></i>Line Item</button>&nbsp;
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0; margin-top: 0;">
                    </div>
                </div>


                <div class="row mt-5">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4"> </div>
                            <div class="col-md-8 input-group-sm">
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-8 input-group-sm"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group  row pr-md-3">
                            <div class="col-md-4">
                                <label style="font-size: 1.5rem; font-weight: bold; padding-top:4px">Total Quantity</label>
                            </div>
                            <div class="col-md-8 input-group-sm">
                                <input type="text" class="form-control" name="total_qty" id="total_qty" readonly="" value="0" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
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

                                <button type="button" class="btn btn-primary" id="save"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
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
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/resources/js/projects/materialRequest/submit.js" type="text/javascript"></script>
<script>
    $('body').on('change', '.quantity', function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));
        var id = $(this).attr('data-id');
        totalCalculate();
    });

    function totalCalculate() {
        var gtotal = 0;
        $('.quantity').each(function() {
            var id = $(this).attr('data-id');
            var total = $('#quantity' + id + '').val();
            gtotal += parseInt(total);
        });
        $('#total_qty').val(gtotal);
    }

    function getNum(val) {
        if (isNaN(val) || val == false || val == null || val == undefined || val == "") {
            return 0;
        }
        return val;
    }



    function createproductvialoop(product_name_array) {
        for (i = 0; i < product_name_array.length; ++i)
            createproduct(product_name_array[i]);
    }

    function createproduct(product_name) {
        $.ajax({
            url: "../get-product-from-id",
            method: "POST",
            data: {
                _token: $('#token').val(),
                id: product_name
            },
            dataType: "json",
            success: function(data) {
                var qty = 0;
                $.each(data, function(key, value) {
                    qty++;
                    var rowcount = $('#product_table tr').length;
                    var alreadyAdded = 0;
                    var des = value.description != null ? value.description : '-';
                    var totalqty;
                    var req_qty;
                    var balanceQty;
                    if ($('#request_against').val() == 1) {
                        $("input[name^='product_id[]']").each(function(input) {
                            if ($(this).val() == value.id) {
                                alreadyAdded = 1;
                            }
                        });
                        totalqty = value.quantity;
                        req_qty = value.epr_requested_quantity;
                        balanceQty = totalqty - req_qty - 1;
                    } else {
                        totalqty = '-';
                        req_qty = '-';
                        balanceQty = '-';
                    }
                    var product = '';

                    var wName = (value.warehouse != null) ? value.warehouse : '-';
                    var wId = (value.warehouse_id != null) ? value.warehouse_id : '';
                    product += '<tr>\
                 <td style="text-align: center;">' + rowcount + '</td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="hidden" class="form-control single-select product_id kt-selectpicker" name="product_id[]" id="product_id" data-id="' + rowcount + '" value="' + value.id + '" readonly>\
                 <input type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname" data-id="' + rowcount + '" value="' + value.product_name + '" readonly>\
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
                 <td>\
                 <div class="input-group input-group-sm">\
                  <input type="text" class="form-control warehouse"  data-id="' + rowcount + '" name="warehouse[]" id="warehouse' + rowcount + '" value="' + wName + '" readonly>\
                  <input type="hidden" class="form-control warehouse_id"  data-id="' + rowcount + '" name="warehouse_id[]" id="warehouse_id' + rowcount + '" value="' + wId + '">\
                 </div>\
                 </td>\
                 <td  style="background-color: white;">\
                      <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">\
                                          <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
                                          <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>\
                                       </div>\
                        </td>\
                 </tr>';
                    if (!alreadyAdded)
                        $('#product_table').append(product);

                    $('#total_qty').val(rowcount);
                    rowcount++;

                });

            }
        })
    }
</script>
@endsection