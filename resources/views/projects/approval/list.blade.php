@extends('projects.common.layout')
@section('content')


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


<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Projects
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">

                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> {{ __('product.Export') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">{{ __('product.Choose an option') }}</span>
                                    </li>
                                    <li class="kt-nav__item" id="projects_list_print">
                                        <span href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">{{ __('product.Print') }}</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="projects_list_copy">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">{{ __('product.Copy') }}</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="projects_list_csv">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">{{ __('product.CSV') }}</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="projects_list_pdf">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">{{ __('product.PDF') }}</span>
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
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-primary nav-tabs-line-2x" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_1_tab_content" role="tab">
                                    <i class="la la-cog"></i> Decision Pending
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_2_tab_content" role="tab">
                                    <i class="la la-mail-forward"></i> Decision Taken
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="pendingTbl">
                                <thead>
                                    <tr>
                                        <th>{{ __('product.S.No') }}</th>
                                        <th>Client</th>
                                        <th>Project Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>PO Number</th>
                                        <th>PO Value</th>
                                        <th>PO Date</th>
                                        <th>{{ __('product.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">
                            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="approvedTbl">
                                <thead>
                                    <tr>
                                        <th>{{ __('product.S.No') }}</th>
                                        <th>Client</th>
                                        <th>Project Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>PO Number</th>
                                        <th>PO Value</th>
                                        <th>PO Date</th>
                                        <th>Last Action</th>
                                        <th>{{ __('product.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!--end::Portlet-->

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
<script src="{{url('/')}}/resources/js/projects/approval/list.js" type="text/javascript"></script>

@endsection