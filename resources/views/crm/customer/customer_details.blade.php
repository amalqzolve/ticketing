@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ __('app.Customer Information') }}

                </h3>

            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('Customer Add')
                        <a href="{{url('/')}}/newcustomer" class="btn btn-brand btn-elevate btn-icon-sm"> <i class="la la-plus"></i>
                            {{ __('app.New Record') }}</a>@endcan

                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>{{ __('customer.Export') }}</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">@lang('app.CHOOSE AN OPTION')</span>
                                    </li>
                                    <li class="kt-nav__item" id="customerdetails_list_crm_print"> <span href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">@lang('app.Print')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="customerdetails_list_crm_copy"> <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">@lang('app.Copy')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="customerdetails_list_crm_csv">
                                        <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.CSV')</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="customerdetails_list_crm_pdf">
                                        <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.PDF')</span>
                                        </a>
                                        </span>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <!-- <a href="{{url('/')}}/customertrash" type="button"
							class="btn btn-secondary btn-hover-warning btn-icon-sm">
							@lang('app.Trash') 
						</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-striped table-hover table-checkable" id="customerdetails_list_crm">
                <thead>
                    <tr role="row">
                        <th>
                            @lang('customer.Sl. No')
                        </th>
                        <th>@lang('customer.Customer Name')</th>
                        <th>@lang('customer.Name Alias')</th>
                        <th>@lang('customer.Email')</th>
                        <th>@lang('customer.Mobile Number')</th>
                        <th>@lang('customer.Category')</th>
                        <th>@lang('customer.Group')</th>
                        <th>@lang('customer.Customer Code')</th>


                        <th>@lang('customer.Actions')</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script> -->
<script src="{{url('/')}}/resources/js/crm/customer.js" type="text/javascript"></script>




<script src="{{ URL::asset('assets') }}/datatables/datatables.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/datatables.buttons.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/buttons.flash.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/jszip.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/pdfmake.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js"></script>
<script type="text/javascript" src="costomScript.js"></script>




<script type="text/javascript">
    var customerdetails_list_crm_table = $('#customerdetails_list_crm').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'csv',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'excel',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'pdf',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                },
                pageSize: 'A4',
                orientation: 'landscape',
                customize: function(doc) {
                    doc.pageMargins = [50, 50, 50, 50];
                    //   doc.content[1].table.widths = [ '10%', '20%', '10%', '20%', '40%'];
                }
            },

            {
                extend: 'print',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            }
        ],

        ajax: {
            "url": 'customerdetails',
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
                data: 'ar_cust_name',
                name: 'ar_cust_name'
            },
            {
                data: 'email1',
                name: 'email1'
            },
            {
                data: 'mobile1',
                name: 'mobile1'
            },
            {
                data: 'custcategory',
                name: 'custcategory'
            },
            {
                data: 'grouptitle',
                name: 'grouptitle'
            },
            {
                data: 'cust_code',
                name: 'cust_code'
            },



            {
                data: 'action',
                name: 'action',
                render: function(data, type, row) {
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="customer_pdf?id=' + row.id + '" data-type="edit" target="blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >@lang("app.PDF")</span>\
                        </span></li></a>\
                        <a href="edit_customers?id=' + row.id + '" data-type="edit"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >@lang("app.Edit")</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_customerdetails" id=' + row.id + ' data-id=' + row.id + '>@lang("app.Delete")</span></span></li>\
                       </ul></div></div></span>';

                }
            },

        ]
    });

    $("#customerdetails_list_crm_print").on("click", function() {
        customerdetails_list_crm_table.button('.buttons-print').trigger();
    });


    $("#customerdetails_list_crm_copy").on("click", function() {
        customerdetails_list_crm_table.button('.buttons-copy').trigger();
    });

    $("#customerdetails_list_crm_csv").on("click", function() {
        customerdetails_list_crm_table.button('.buttons-csv').trigger();
    });

    $("#customerdetails_list_crm_pdf").on("click", function() {
        customerdetails_list_crm_table.button('.buttons-pdf').trigger();
    });

    $('.CustomerManagement').addClass('kt-menu__item--open');
    $('.customerdetails').addClass('kt-menu__item--active');
</script>


@endsection