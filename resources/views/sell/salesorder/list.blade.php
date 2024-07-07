@extends('sell.common.layout')

@section('content')
<!-- <link href="{{ url('/') }}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

<link href="{{ url('/') }}/public/assets/css/pages/wizard/wizard-3.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets') }}/css/stylelist.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    .kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item {
        flex: 0 0 15% !important;
    }
</style>
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <div class="kt-subheader__breadcrumbs">

                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

                <span class="kt-subheader__breadcrumbs-separator"></span>



            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="#" class="btn kt-subheader__btn-primary">
                    @lang('app.Back')
                </a>
                <a href="trash_purchase" class="btn btn-secondary btn-hover-warning">
                    @lang('app.Trash')

                </a>

            </div>
        </div>
    </div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('app.Sales Order List')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">

                        <a href="{{ url('saleorder-add') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            @lang('app.New Record')
                        </a>
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> @lang('app.Export')
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-print">
                                        <span href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">@lang('app.Print')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-copy">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">@lang('app.Copy')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-csv">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.CSV')</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-pdf">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.PDF')</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="salesorderdetails_list">
                <thead>
                    <tr>
                        <th>@lang('app.S.No')</th>
                        <th>SO ID</th>
                        <th>SO Date</th>
                        <th>PO/Customer Ref</th>
                        <th>Sale Type</th>
                        <th>@lang('app.Quote ID')</th>
                        <th>@lang('app.Quote Date')</th>
                        <th>@lang('app.Customer')</th>
                        <th>Mobile</th>
                        <th>@lang('app.Order Value')</th>
                        <th>@lang('app.Invoice Order Status')</th>
                        <th>SO Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

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
<!--end::Modal-->
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<!-- <script src="{{ url('/') }}/resources/js/sales/newsalesorder.js" type="text/javascript"></script> -->
<script src="{{ url('/') }}/public/assets/js/pages/custom/wizard/wizard-3.js" type="text/javascript"></script>


<script type="text/javascript">
    var salesorderdetails_list_table = $('#salesorderdetails_list').DataTable({
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",
        //     scrollX: true,
        dom: 'Blfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        buttons: [{
                extend: 'copy',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'csv',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'excel',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdf',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                },
                pageSize: 'A4',
                orientation: 'landscape',
                customize: function(doc) {
                    doc.pageMargins = [50, 50, 50, 50];
                }
            },
            {
                extend: 'print',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }
        ],
        ajax: {
            "url": 'sell_saleorder_list',
            "type": "POST",
            "data": function(data) {
                data._token = $('#token').val()
            }
        },
        order: [
            [1, 'desc']
        ],
        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'id',
                name: 'id',
            },
            {
                data: 'podate',
                name: 'podate',
            },

            {
                data: 'po_ref',
                name: 'po_ref',
            },
            {
                data: 'sale_type',
                name: 'sale_type',
            },
            {
                data: 'quote_id',
                name: 'quote_id',
            },
            {
                data: 'quotedate',
                name: 'quotedate',
            },
            {
                data: 'cust_name',
                name: 'cust_name',
            },
            {
                data: 'mobile1',
                name: 'mobile1',
            },
            {
                data: 'grandtotalamount',
                name: 'grandtotalamount',
            },
            {
                data: 'inv_status',
                name: 'inv_status'
            },

            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
        columnDefs: [{
            "orderable": false,
            "searchable": false,
            targets: [0, 9, 10]
        }, ]

    })



    $(document).on('click', '.salesorder_confirm', function() {
        var id = $(this).attr('id');

        swal.fire({
            title: "Are you sure?",
            text: "Do you want Confirm this SalesOrder",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            /* cancelButtonText: "No"
            }).then(result => {*/
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {
                window.location = "Salesorder-Confirm?id=" + id;
            } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('[type="search"]').addClass("form-control form-control-sm mt-3");
        $('div.dataTables_wrapper div.dataTables_length select').addClass("form-control form-control-sm mt-3");
    });
</script>
<script>
    $(document).ready(function() {
        $('.sell_saleorder_list').addClass('kt-menu__item--active');
    });
</script>
@endsection