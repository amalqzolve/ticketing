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
                    Purchase Order
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{url('qdirect_po')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i> New Record </a>
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
            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="datatbl">
                <thead>
                    <tr>
                        <th>@lang('app.Sl.No')</th>
                        <th>PO ID</th>
                        <th>PO Date</th>
                        <th>Supplier</th>
                        <th>@lang('app.Grand Total')</th>
                        <th>GRN Status</th>
                        <th>Invoice Status</th>
                        <th>PO Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($purchaseorder as $key=>$purchaseorders)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$purchaseorders->id}}</td>
                        <td>{{$purchaseorders->quotedate}}</td>
                        <td>{{$purchaseorders->sup_name}}</td>
                        <td>{{$purchaseorders->grandtotalamount}}</td>
                        <td>{{$purchaseorders->status}}</td>
                        <td>{{$purchaseorders->updated_at}}</td>
                        <td>
                            <span style="overflow: visible; position: relative; width: 80px;">
                                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                        <i class="fa fa-cog"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            @if($purchaseorders->status == 'Approved')
                                            <a href="qpurchaseorder_pdf?id={{$purchaseorders->id}}" data-type="edit" data-target="#kt_form" target="_blank">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                                                        <span class="kt-nav__link-text" data-id="{{$purchaseorders->id}}">PDF</span>
                                                    </span>
                                                </li>
                                            </a>
                                            <a href="qpurchase_order_issue?id={{$purchaseorders->id}}" data-type="edit" data-target="#kt_form">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                                        <span class="kt-nav__link-text" data-id="{{$purchaseorders->id}}">PO Issue</span>
                                                    </span>
                                                </li>
                                            </a>
                                            @endif


                                            @if($purchaseorders->status == 'Draft')
                                            <a href="qpurchase_order_edit?id={{$purchaseorders->id}}" data-type="edit" data-target="#kt_form">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                                        <span class="kt-nav__link-text" data-id="{{$purchaseorders->id}}">Edit</span>
                                                    </span>
                                                </li>
                                            </a>
                                            <a data-type="approved" data-target="#kt_form">
                                                <li class="kt-nav__item purchaseorder_approve" id='{{$purchaseorders->id}}'>
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                                                        <span class="kt-nav__link-text" data-id="{{$purchaseorders->id}}" id='{{$purchaseorders->id}}'>Approve</span>
                                                    </span>
                                                </li>
                                            </a>

                                            @endif
                                            @if($purchaseorders->status == 'Po Issued')
                                            <a href="qpurchaseorder_pdf?id={{$purchaseorders->id}}" data-type="edit" data-target="#kt_form" target="_blank">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                                                        <span class="kt-nav__link-text" data-id="{{$purchaseorders->id}}">PDF</span>
                                                    </span>
                                                </li>
                                            </a>
                                            @if($purchaseorders->grn != 1)
                                            <a href="convertgrn?id={{$purchaseorders->id}}" data-type="edit" data-target="#kt_form">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                                        <span class="kt-nav__link-text" data-id="{{$purchaseorders->id}}">Generate GRN</span>
                                                    </span>
                                                </li>
                                            </a>
                                            @endif
                                            @if($purchaseorders->pi != 1)
                                            <a href="convertpi?id={{$purchaseorders->id}}" data-type="edit" data-target="#kt_form">
                                                <li class="kt-nav__item">
                                                    <span class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                                        <span class="kt-nav__link-text" data-id="{{$purchaseorders->id}}">Generate Purchase Invoice</span>
                                                    </span>
                                                </li>
                                            </a>
                                            @endif
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    var datatbl = $('#datatbl').DataTable({
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
            "url": 'qpurchase_order',
            "type": "POST",
            "data": function(data) {
                data._token = $('#token').val()
            }
        },
        order: [
            [1, 'desc']
        ],
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'quotedate',
                name: 'quotedate'
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
                data: 'grandtotalamount',
                name: 'grandtotalamount'
            },
            {
                data: 'grnStatus',
                name: 'grnStatus',
            },
            {
                data: 'invoiceStatus',
                name: 'invoiceStatus',
            },
            {
                data: 'poStatus',
                name: 'poStatus',
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
            targets: [0, 5, 6, 7, 8]
        }, {
            width: '70px',
            "orderable": false,
            "searchable": false,
            targets: [6, 7, 8]
        }, {
            width: '70px',
            targets: [1]
        }],

    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('[type="search"]').addClass("form-control form-control-sm mt-3");
        $('div.dataTables_wrapper div.dataTables_length select').addClass("form-control form-control-sm mt-3");
    });
</script>


<!--end::Page Scripts -->
<script type="text/javascript">
    $(document).on('click', '.purchaseorder_approve', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Approve This Purchase Order",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Approve",
            cancelButtonText: "Cancel"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "Purchaseorder-Approve",
                    dataType: "json",
                    data: {
                        _token: $('#token').val(),
                        id: id,
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success('Purchase Order Approved successfuly');
                            window.location.href = "qpurchase_order";
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