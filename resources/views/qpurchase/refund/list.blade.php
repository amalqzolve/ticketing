@extends('qpurchase.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Purchase Refund List
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">

                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Export
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Choose an option</span>
                                    </li>
                                    <li class="kt-nav__item" id="purchasenumber_list_print">
                                        <span href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">Print</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="purchasenumber_list_copy">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">Copy</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="purchasenumber_list_csv">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="purchasenumber_list_pdf">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
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
            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="sales_return_details_lists">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Refund Date</th>
                        <th>Supplier Name</th>
                        <th>Return ID</th>
                        <th>Return Date</th>
                        <th>Invoice ID</th>
                        <th>Amount</th>
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
    $('.PaymentVoucher').addClass('kt-menu__item--open');
    $('.qpurchase-refund-list').addClass('kt-menu__item--active');
    var sales_return_details_lists_table = $('#sales_return_details_lists').DataTable({
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
            "url": 'qpurchase-refund-list',
            "type": "POST",
            "data": function(data) {
                data._token = $('#token').val()
            }
        },
        order: [
            [1, 'desc']
        ],
        // "fnRowCallback": function(nRow, aData, iDisplayIndex) {
        //     $("td:first", nRow).html(iDisplayIndex + 1);
        //     return nRow;
        // },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'date',
                name: 'date',
            },
            {
                data: 'sup_name',
                name: 'sup_name'
            },
            {
                data: 'rtn_code',
                name: 'rtn_code',
            },
            {
                data: 'returndate',
                name: 'returndate'
            },
            {
                data: 'inv_code',
                name: 'inv_code',
            },
            {
                data: 'addtotal',
                name: 'addtotal'
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
            targets: [0, 6]
        }, ]

    })



    $(document).on('click', '.refund_approve', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Approve This Refund",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Approve",
            cancelButtonText: "Cancel"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "qpurchase-refund-approve",
                    dataType: "json",
                    data: {
                        _token: $('#token').val(),
                        id: id,
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success('Purchase Refund Approved successfuly');
                            window.location.href = "qpurchase-refund-list";
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


    $(document).on('click', '.refund_delete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Delete This Refund",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "qpurchase-refund-delete",
                    dataType: "json",
                    data: {
                        _token: $('#token').val(),
                        id: id,
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success('Purchase Refund Deleted successfuly');
                            window.location.href = "qpurchase-refund-list";
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