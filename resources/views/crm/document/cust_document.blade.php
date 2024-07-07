@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('customer.Documents & Contracts')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>@lang('customer.Export')</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">

                                    <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
                                    </li>
                                    <li class="kt-nav__item" id="customer_document_details_list_print"> <span href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">@lang('app.Print')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="customer_document_details_list_copy"> <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">@lang('app.Copy')</span>

                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="customer_document_details_list_csv">
                                        <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.CSV')</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="customer_document_details_list_pdf"> <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.PDF')</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>&nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-striped table-hover table-checkable" id="customer_document_details_list">
                <thead>
                    <tr role="row">

                        <th>@lang('customer.Sl. No')</th>

                        <th>@lang('customer.Name')</th>
                        <th>@lang('customer.Total Documents')</th>
                        <th>@lang('customer.Total Expired')</th>
                        <th>@lang('customer.Total Active')</th>

                        <th style="width: 50px;">@lang('customer.Actions')</th>
                    </tr>
                </thead>
                <tbody></tbody>

            </table>
        </div>
    </div>
</div>.

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

<script src="{{url('/')}}/resources/js/crm/customer.js" type="text/javascript"></script>

<script type="text/javascript">
    var customer_document_details_list_table = $('#customer_document_details_list').DataTable({
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
                    columns: [0, 1]
                }
            },
            {
                extend: 'csv',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1]
                }
            },
            {
                extend: 'excel',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1]
                }
            },
            {
                extend: 'pdf',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1]
                },
                pageSize: 'A4',
                orientation: 'landscape',
                customize: function(doc) {
                    doc.pageMargins = [50, 50, 50, 50];
                    doc.content[1].table.widths = ['10%', '20%', '10%', '20%', '40%'];
                }
            },
            {
                extend: 'print',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1]
                }
            }
        ],

        ajax: {
            "url": 'crmcustomerdocuments',
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
                data: 'cust_name',
                name: 'cust_name'
            },
            {
                data: 'total',
                name: 'total'
            },
            {
                data: 'exp',
                name: 'exp'
            },
            {
                data: 'ac',
                name: 'ac'
            },

            {
                data: 'action',
                name: 'action',
                render: function(data, type, row) {
                    var j = '';
                    j = '<a href="edit_customer_document?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >@lang("app.Update")</span>\
                        </span></li></a>';
                    j += '<a href="edit_customer_docs?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >@lang("app.Documents")</span>\
                        </span></li></a>';
                    if (!row.documents == '') {
                        j += '<a href="cust_doc_view?id=' + row.customer_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-folder-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.customer_id + '" >@lang("app.Attachments")</span>\
                        </span></li></a>';
                    }
                    if (row.cust_id == row.id) {
                        j += '<a href="cust_docpdf?id=' + row.id + '" data-type="edit" target="blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >@lang("app.PDF")</span>\
                        </span></li></a>';
                    }


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
</script>
<script>
    $('.CustomerManagement').addClass('kt-menu__item--open');
    $('.crmcustomerdocuments').addClass('kt-menu__item--active');
</script>
@endsection