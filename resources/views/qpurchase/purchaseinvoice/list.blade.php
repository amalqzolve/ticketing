@extends('qpurchase.common.layout')

@section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mb-3">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Purchase Invoice
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{url('/add_direct_pi')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            Add
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
            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="newpurchaseinvoicedetails_list1">
                <thead>
                    <tr>
                        <th>@lang('app.Sl.No')</th>
                        <th>ID</th>
                        <th>Date</th>
                        <th>PO ID</th>
                        <th>Supplier</th>
                        <th>Salesman</th>
                        <th>@lang('app.Grand Total')</th>
                        <th>Invoice Type</th>
                        <th>GRN Status</th>
                        <th>Invoice Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('script')
<!-- <script src="{{url('/')}}/resources/js/sales/purchaseinvoice.js" type="text/javascript"></script> -->
<script type="text/javascript">
    var newpurchaseinvoicedetails_list1_table = $('#newpurchaseinvoicedetails_list1').DataTable({
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",
        dom: 'Blfrtip',
        order: [
            [1, 'desc']
        ],
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
            "url": 'qpurchaseinvoice',
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
                name: 'id'
            },
            {
                data: 'bill_entry_date',
                name: 'bill_entry_date'
            },
            {
                data: 'po_code',
                name: 'po_code',
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
                data: 'salesman',
                name: 'salesman',
                render: function(data, type, row) {
                    var curData = row.salesman;
                    if (curData != null)
                        return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                    else
                        return '-';
                }
            },
            {
                data: 'grandtotalamount',
                name: 'grandtotalamount'
            },
            {
                data: 'invoice_type',
                name: 'invoice_type'
            },
            {
                data: 'grn_status',
                name: 'grn_status'
            },
            {
                data: 'status',
                name: 'status',
                render: function(data, type, row) {
                    if ((row.return_status == '-') || (row.return_status == 'Not Returned'))
                        return row.status;
                    else
                        return '<span style="color:orange;">' + row.return_status + '</span>';
                },
            },
            {
                data: 'action',
                name: 'action',
            },
        ],
        columnDefs: [{
            width: '50px',
            "orderable": false,
            "searchable": false,
            targets: [0, 9]
        }, ],

    });



    $(document).on('click', '.invoice_approve', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Approve This Bill Settilement",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Approve",
            cancelButtonText: "Cancel"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "qpurchase-invoice-approve",
                    dataType: "json",
                    data: {
                        _token: $('#token').val(),
                        id: id,
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success('Purchase Invoice Approved successfuly');
                            window.location.href = "qpurchaseinvoice";
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


    $(document).on('click', '.invoice_delete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Delete This Purchase Invoice",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "qpurchase_invoice_delete",
                    dataType: "json",
                    data: {
                        _token: $('#token').val(),
                        id: id,
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success('Purchase Invoice Deleted successfuly');
                            window.location.href = "qpurchaseinvoice";
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
<script type="text/javascript">
    $(document).ready(function() {
        $('[type="search"]').addClass("form-control form-control-sm mt-3");
        $('div.dataTables_wrapper div.dataTables_length select').addClass("form-control form-control-sm mt-3");
    });
</script>


<!--end::Page Scripts -->

@endsection