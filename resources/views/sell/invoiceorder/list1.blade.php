@extends('sell.common.layout')



@section('content')
<!-- <link href="{{ url('/') }}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
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
        <div class="kt-subheader__toolbar"> </div>
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
                    Sales Invoice
                </h3>

            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">

                        <!-- @can('Sales Invoice Add')
                        <a href="{{ url('/') }}/Add-Invoice-Sell" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            @lang('app.New Record')
                        </a>
                        @endcan -->

                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> @lang('app.Export')
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
                                    </li>
                                    <li class="kt-nav__item" id="invoiceorderdetails_list1_print">
                                        <span href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">@lang('app.Print')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="invoiceorderdetails_list1_copy">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">@lang('app.Copy')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="invoiceorderdetails_list1_csv">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.CSV')</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="invoiceorderdetails_list1_pdf">
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
            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="invoiceorderdetails_list1">
                <thead>
                    <tr>
                        <th>@lang('app.S.No')</th>
                        <!-- <th>@lang('app.Invoice ID')</th> -->
                        <th>Invoice Number</th>
                        <th>@lang('app.Invoice Date')</th>
                        <th>@lang('app.Sale Type')</th>
                        <th>SO ID</th>
                        <th>@lang('app.Customer')</th>
                        <th>Mobile</th>
                        <th>@lang('app.Salesman')</th>
                        <th>@lang('app.Grand Total')</th>
                        <th>@lang('app.Status')</th>
                        <!-- <th>Accounting Entry</th> -->
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
<script src="{{ url('/') }}/resources/js/sell/invoice.js" type="text/javascript"></script>
<script type="text/javascript">
    var invoiceorderdetails_list_table = "";
    $(document).ready(function() {
        var invoiceorderdetails_list_table = $('#invoiceorderdetails_list1').DataTable({
            processing: true,
            serverSide: true,
            pagingType: "full_numbers",
            dom: 'Blfrtip',
            pageLength: 25,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            order: [
                [1, 'desc']
            ],
            buttons: [{
                    extend: 'copy',
                    className: "hidden",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'csv',
                    className: "hidden",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'excel',
                    className: "hidden",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'pdf',
                    className: "hidden",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                }
            ],

            ajax: {
                "url": 'sell_invoice_list',
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
                    data: 'id',
                    name: 'id',
                    // render: function(data, type, row) {
                    //     return '<u><a href="trip-bill_list/' + row.id +
                    //         '">' + data + '</a></u>';
                    // }
                },
                {
                    data: 'quotedate',
                    name: 'quotedate'
                },
                {
                    data: 'sale_type',
                    name: 'sale_type'
                },
                {
                    data: 'saleorder_id',
                    name: 'saleorder_id',
                    render: function(data, type, row) {
                        if (row.saleorder_id != null)
                            return row.saleorder_id;
                        else
                            return '--';
                    }
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
                // {
                //     data: 'status11',
                //     name: 'status11'
                // },

                {
                    data: 'status11',
                    name: 'status',
                    render: function(data, type, row) {
                        if (row.status11 == 'Draft') {
                            return '<span style="color: gray">Draft</span>';

                        }
                        if (row.status11 == 'Approved') {
                            return '<span style="color: green">Approved</span>';

                        }
                        if (row.status11 == 'Returned') {
                            return '<span style="color: red">Returned</span>';

                        }
                        if (row.status11 == 'Partially Returned') {
                            return '<span style="color: orange">Partially Returned</span>';

                        }

                    }
                },
                // {
                //     data: 'entry_id',
                //     name: 'entry_id'
                // },
                {
                    data: 'action',
                    name: 'action',
                    render: function(data, type, row) {
                        var j = '';
                        if (row.status == 'Draft') {
                            j = '<a href="salesinvoice-PDF?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-printer"></i>\
                                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                                    </span></li></a>\
                                    <a href="Invoice_edit_sell?id=' + row.id + '&&type=' + row.sale_type + '&&soid=' + row
                                .saleorder_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                                    <span class="kt-nav__link-text" data-id="' + row.id +
                                '" >Edit</span>\
                                    </span></li></a>\
                                    <a  data-type="delete" data-target="#kt_form"><li class="kt-nav__item invoice_delete" id=' +
                                row.id + '>\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-trash"></i>\
                                    <span class="kt-nav__link-text" data-id="' + row.id + '" id="' + row.id +
                                '"">Delete</span>\
                                    </span></li></a>\
                                   <a  data-type="send" data-target="#kt_form"><li class="kt-nav__item invoice_approve" id="' +
                                row
                                .id + '">\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon-multimedia"></i>\
                                    <span class="kt-nav__link-text" data-id="' + row.id + '" id="' + row.id + '">Approve</span>\
                                    </span></li></a>';
                        }
                        if (row.status == 'Approved') {
                            if (row.totalquantity == row.delivery || row.delivery > 0 && row
                                .totalquantity > row.delivery) {
                                j = '<a href="salesinvoice-PDF?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-printer"></i>\
                                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                                    </span></li></a>';
                            }
                            //  <a href="invoiceOrder-Delivery?sid=' + row.saleorder_id + '&&id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                            // <span class="kt-nav__link">\
                            //                                     <i class="kt-nav__link-icon flaticon-truck"></i>\
                            //                                     <span class="kt-nav__link-text" data-id="' + row.saleorder_id + '" >Generate Delivery Order</span>\
                            //                                     </span></li></a>
                        }


                        return '<span style="overflow: visible; position: relative; width: 80px;">\
                                    <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                    <i class="fa fa-cog"></i></a>\
                                    <div class="dropdown-menu dropdown-menu-right">\
                                    <ul class="kt-nav">' + j + '\
                                    </ul></div></div></span>';
                    }
                },


            ],
            columnDefs: [{
                "orderable": false,
                "searchable": false,
                targets: [0, 9, 10]
            }, ]
        });
        $("#invoiceorderdetails_list1_print").on("click", function() {
            invoiceorderdetails_list_table.button('.buttons-print').trigger();
        });


        $("#invoiceorderdetails_list1_copy").on("click", function() {
            invoiceorderdetails_list_table.button('.buttons-copy').trigger();
        });

        $("#invoiceorderdetails_list1_csv").on("click", function() {
            invoiceorderdetails_list_table.button('.buttons-csv').trigger();
        });

        $("#invoiceorderdetails_list1_pdf").on("click", function() {
            invoiceorderdetails_list_table.button('.buttons-pdf').trigger();
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
<script>
    $(document).ready(function() {
        $('.sell_invoice_list').addClass('kt-menu__item--active');
    });
</script>
@endsection