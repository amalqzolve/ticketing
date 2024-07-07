@extends('qpurchase.common.layout')
@section('content')
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
                    Goods Receipt Note
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
            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="tblGRN">
                <thead>
                    <tr>
                        <th>@lang('app.S.No')</th>
                        <th>GRN ID</th>
                        <th>GRN Date</th>
                        <th>Supplier</th>
                        <th>Source</th>
                        <th>Purchase Order ID</th>
                        <th>Invoice Id</th>
                        <th>Prepared By</th>
                        <th>Total GRN Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var grnTbl = $('#tblGRN').DataTable({
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",
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
            "url": 'qpurchasegrn',
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
                data: 'grn_date',
                name: 'grn_date',
            },
            {
                data: 'sup_name',
                name: 'sup_name',
                render: function(data, type, row) {
                    var curData = row.sup_name;
                    if (curData != null)
                        return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                    else
                        return '-';
                }
            },
            {
                data: 'source',
                name: 'source',
            },
            {
                data: 'po_code',
                name: 'po_code',
            },
            {
                data: 'pur_inv_code',
                name: 'pur_inv_code',
            },

            {
                data: 'salesman_name',
                name: 'salesman_name',
            },
            {
                data: 'grn_quantity',
                name: 'grn_quantity',
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
        columnDefs: [{
            "orderable": false,
            "searchable": false,
            targets: [0, 7]
        }, ]

    });


    $(document).on('click', '.grnApprove', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Approve ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Approve",
            cancelButtonText: "Cancel"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "qpurchasegrn-approve",
                    dataType: "json",
                    data: {
                        _token: $('#token').val(),
                        id: id,
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success('GRN Approved successfuly');
                            window.location.href = "qpurchasegrn";
                        } else {
                            swal.fire({
                                title: "Error !!!",
                                text: data.msg,
                                type: "error",
                            });
                        }

                    },
                    error: function(jqXhr, json, errorThrown) {
                        console.log('Error !!');
                    }
                });

            } else {
                swal.fire("Cancelled", "", "error");
            }
        })
    });

    $(document).on('click', '.grnDelete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Delete ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "qpurchasegrn-delete",
                    dataType: "json",
                    data: {
                        _token: $('#token').val(),
                        id: id,
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success('GRN Delete successfuly');
                            window.location.href = "qpurchasegrn";
                        } else {
                            swal.fire({
                                title: "Error !!!",
                                text: data.msg,
                                type: "error",
                            });
                        }
                    },
                    error: function(jqXhr, json, errorThrown) {
                        console.log('Error !!');
                    }
                });

            } else {
                swal.fire("Cancelled", "", "error");
            }
        })
    });
</script>
@endsection