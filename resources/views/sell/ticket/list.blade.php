@extends('sell.common.layout')

@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/public/assets/css/pages/wizard/wizard-3.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets') }}/css/stylelist.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item {
        flex: 0 0 12% !important;
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



<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mb-3">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Ticket List # SO- {{ $sales_order_id }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">

                        <a href="{{ url('/') }}/ticket-Add/{{ $sales_order_id }}" class="btn btn-brand btn-elevate btn-icon-sm">
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
                                    <li class="kt-nav__item" id="enquirydetails_list_print">
                                        <span href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">@lang('app.Print')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="enquirydetails_list_copy">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">@lang('app.Copy')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="enquirydetails_list_csv">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.CSV')</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="enquirydetails_list_pdf">
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
            <input type="hidden" name="sales_order_id" id="sales_order_id" value="{{$sales_order_id}}">
            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="enquirydetails_list">
                <thead>
                    <tr>
                        <th>@lang('app.Sl.No')</th>
                        <th>Ticket ID</th>
                        {{-- <th>Sales Order ID</th> --}}
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Passport Number</th>
                        <th>Country</th>
                        <th>Total Amount</th>
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
<!-- end::Global Config -->


<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ url('/') }}/public/assets/js/pages/custom/wizard/wizard-3.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('[type="search"]').addClass("form-control form-control-sm mt-3");
        $('div.dataTables_wrapper div.dataTables_length select').addClass("form-control form-control-sm mt-3");


    });
</script>
<script type="text/javascript">
    var enquirydetails_list_table = $('#enquirydetails_list').DataTable({
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
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'csv',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'excel',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'pdf',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3]
                },
                pageSize: 'A4',
                orientation: 'landscape',
                customize: function(doc) {
                    doc.pageMargins = [50, 50, 50];
                }
            },
            {
                extend: 'print',
                className: "hidden",
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }
        ],

        ajax: {
            "url": '../ticket_list/' + $('#sales_order_id').val(),
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
                render: function(data, type, row) {
                    return 'TKT ' + row.id;
                }
            },

            {
                data: 'name',
                name: 'name',
                render: function(data, type, row) {
                    var curData = row.name;
                    if (curData != null)
                        return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                    else
                        return '-';
                }
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'email',
                name: 'email',
                render: function(data, type, row) {
                    var curData = row.email;
                    if (curData != null)
                        return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                    else
                        return '-';
                }
            },
            {
                data: 'passport_no',
                name: 'passport_no',
                render: function(data, type, row) {
                    var curData = row.passport_no;
                    if (curData != null)
                        return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                    else
                        return '-';
                }
            },
            {
                data: 'country',
                name: 'country',
                render: function(data, type, row) {
                    var curData = row.country;
                    if (curData != null)
                        return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                    else
                        return '-';
                }
            },

            {
                data: 'total_amount',
                name: 'total_amount'
            },

            {
                data: 'action',
                name: 'action',
                render: function(data, type, row) {

                    var j = '';

                    j = '<a href="../ticket-edit/' + row.id +
                        '" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                                                                                    <span class="kt-nav__link">\
                                                                                    <i class="kt-nav__link-icon flaticon2-edit"></i>\
                                                                                    <span class="kt-nav__link-text" data-id="' +
                        row
                        .id + '" >Edit</span>\
                                                                                    </span></li>\
                                                                                  </a>\
                                    <a href="../ticket-pdf/' + row.id +
                        '" data-type="edit" data-target="#kt_form" target="_blank" ><li class="kt-nav__item">\
                                                                           <span class="kt-nav__link">\
                                                                           <i class="kt-nav__link-icon flaticon2-printer"></i>\
                                                                           <span class="kt-nav__link-text" data-id="' + row
                        .id + '" >PDF</span>\
                                                                          </span></li>\
                                                                          </a>';
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
                width: '50px',
                "orderable": false,
                "searchable": false,
                targets: [0, 7]
            },
            {
                width: '70px',
                targets: [1, 2, 3]
            },
            {
                width: '200px',
                targets: [4]
            },
            {
                width: '300px',
                targets: [5]
            }
        ],

    })
</script>
<script>
    $(document).ready(function() {
        $('.sell_saleorder_list').addClass('kt-menu__item--active');
    });
</script>

<!--end::Page Scripts -->
@endsection