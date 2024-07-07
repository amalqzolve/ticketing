@extends('procurement.common.layout')
@section('content')
<!-- <link href="{{url('/')}}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/public/assets/css/pages/wizard/wizard-3.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .dataTables_wrapper .dataTable {
        width: max-content !important;
    }
</style>



<!-- model -->
<div class="modal fade" id="modelProgress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" href="#">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Synthesis Milestone </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="statusDiv">
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- ./model -->


<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mb-3">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Purchase Index - {{$supplier->sup_name}}
                </h3>
            </div>
            <input type="hidden" name="supplierId" id="supplierId" value="{{$supplerId}}">
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
            <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="first">

                <div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
                    <div class="mt-3">
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">

                                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
                                    <div class="col-md-12">
                                        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                            <!--begin: Form Wizard Form-->
                                            <form class="kt-form " id="kt_form" style="width: 100%; padding:0;">

                                                <table class="table table-striped table-hover table-checkable dataTable no-footer " id="closedTbl" style="table-layout: fixed; width: max-content !important;">
                                                    <!-- table-responsive -->
                                                    <thead>
                                                        <tr>
                                                            <th>@lang('app.Sl.No')</th>
                                                            <th>PO ID</th>
                                                            <th>PO Date</th>
                                                            <th>EPR ID</th>
                                                            <th>Request By</th>
                                                            <th>Supplier</th>
                                                            <th>Request Type</th>
                                                            <th>Request Against</th>
                                                            <th>MR Category</th>
                                                            <th>Client</th>
                                                            <th>Project</th>
                                                            <th>Total Items</th>
                                                            <th>TotalProducts</th>
                                                            <th>Items Purchased</th>
                                                            <th>Items Balance</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    </tbody>

                                                </table>
                                            </form>
                                        </div>
                                    </div>

                                    <!--end: Form Wizard Form-->
                                </div>
                            </div>
                        </div>



                    </div>
                </div>







            </div>


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
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/procurement/po/purchaseIndexSpecific.js" type="text/javascript"></script>
<!-- end::Global Config -->


<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{url('/')}}/public/assets/js/pages/custom/wizard/wizard-3.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('[type="search"]').addClass("form-control form-control-sm mt-3");
        $('div.dataTables_wrapper div.dataTables_length select').addClass("form-control form-control-sm mt-3");


    });
</script>
<!--end::Page Scripts -->

@endsection