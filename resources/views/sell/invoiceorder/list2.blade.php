@extends('sell.common.layout')



@section('content')
<!-- <link href="{{url('/')}}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets') }}/css/stylelist.css" rel="stylesheet" type="text/css" />
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
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
                    Pendind Bills
                </h3>

            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
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

            <!--begin: Datatable -->
            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="invoiceorderdetails_list2">
                <thead>
                    <tr>
                        <th>@lang('app.S.No')</th>
                        <!-- <th>@lang('app.Invoice ID')</th> -->
                        <th>Invoice Number</th>
                        <th>PO Number</th>
                        <th>@lang('app.Invoice Date')</th>
                        <th>@lang('app.Sale Type')</th>
                        <th>@lang('app.Sale Order ID')</th>
                        <th>@lang('app.Customer')</th>
                        <th>Mobile</th>
                        <th>@lang('app.Salesman')</th>
                        <th>@lang('app.Grand Total')</th>
                        <th>Due Amount</th>
                        <!-- <th>@lang('app.Status')</th> -->
                        <th>Action</th>


                    </tr>
                </thead>

                <tbody>

                </tbody>


            </table>

            <!--end: Datatable -->

        </div>
    </div>
</div>

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
<script src="{{url('/')}}/resources/js/sell/invoice.js" type="text/javascript"></script>
<script type="text/javascript">
    $('.payments').addClass('kt-menu__item--open');
    $('.pending_bills').addClass('kt-menu__item--active');

    $(document).ready(function() {
        var invoiceorderdetails_list_table = $('#invoiceorderdetails_list2').DataTable({
            processing: true,
            serverSide: true,
            pagingType: "full_numbers",
            dom: 'Blfrtip',
            pageLength: 25,
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
                        doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
                        doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
                        doc.content[1].table.widths = ['10%', '11%', '11%', '11%',
                            '11%', '11%', '11%', '5%', '5%', '5%', '5%'
                        ];
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
                "url": 'pending_bills',
                "type": "POST",
                "data": function(data) {
                    data._token = $('#token').val()
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'invoice_number',
                    name: 'invoice_number'
                },
                {
                    data: 'po_ref',
                    name: 'po_ref'
                },
                {
                    data: 'invoice_date',
                    name: 'invoice_date'
                },
                {
                    data: 'sale_type',
                    name: 'sale_type'
                },
                {
                    data: 'invoice_number',
                    name: 'invoice_number'
                },
                {
                    data: 'cust_name',
                    name: 'cust_name'
                },
                {
                    data: 'mobile1',
                    name: 'mobile1'
                },
                {
                    data: 'salesman_name',
                    name: 'salesman_name'
                },
                {
                    data: 'grandtotalamount',
                    name: 'grandtotalamount'
                },
                {
                    data: 'balance_amount',
                    name: 'balance_amount'
                },
                // {
                //     data: 'status',
                //     name: 'status',
                //     render: function(data, type, row) {
                //         if (row.status == 'Draft') {
                //             return '<span style="color: gray">Draft</span>';

                //         }
                //         if (row.status == 'Approved') {
                //             return '<span style="color: green">Approved</span>';

                //         }
                //         if (row.status == 'Returned') {
                //             return '<span style="color: red">Returned</span>';

                //         }

                //     }
                // },
                {
                    data: 'action',
                    name: 'action',
                    render: function(data, type, row) {
                        var j = '';

                        j = '<a href="salesinvoice-PDF?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-printer"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';


                        return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">' + j + '\
                        </ul></div></div></span>';
                    }
                },


            ]
        });


    });

    $(document).on('click', '.invoice_approve', function() {
        var id = $(this).attr('id');

        swal.fire({
            title: "Are you sure?",
            text: "Do you want Approve this Invoice",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            /* cancelButtonText: "No"
        }).then(result => {*/
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {
                window.location = "Invoice-Approve?id=" + id;
            } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });



    $(document).on('click', '.invoice_delete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Delete this Invoice",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {

                window.location = "Invoice-Delete?id=" + id;
            } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });
</script>

@endsection