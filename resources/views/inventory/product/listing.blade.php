@extends('inventory.common.layout')

@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>

<style>
    .dataTables_wrapper .dataTable {
        padding-bottom: 0px !important;
    }
</style>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Service Master
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('Product Add')
                        <a href="{{ url('/') }}/Add-Product" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            {{ __('mainproducts.New Record') }}
                        </a>
                        @endcan


                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> {{ __('mainproducts.Export') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">{{ __('mainproducts.Choose an option') }}</span>
                                    </li>
                                    <li class="kt-nav__item" id="productdetails_list_print">
                                        <span href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">{{ __('mainproducts.Print') }}</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="productdetails_list_copy">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">{{ __('mainproducts.Copy') }}</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="productdetails_list_csv">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">{{ __('mainproducts.CSV') }}</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="productdetails_list_pdf">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">{{ __('mainproducts.PDF') }}</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a href="{{ url('/') }}/Trash-Product" class="btn btn-secondary btn-hover-warning btn-icon-sm">
                            {{ __('mainproducts.Trash') }}

                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped table-hover table-checkable dataTable no-footer table-responsive" id="productdetails_list100" style="width:100% !important;display: table;">
                <thead>
                    <tr>
                        <th>{{ __('mainproducts.S.No') }}</th>
                        <th>Service Name</th>
                        <th style="width:30% !important;">{{ __('app.Description') }}</th>
                        <th>{{ __('mainproducts.Unit') }}</th>
                        <th>Service Cost</th>
                        <th>Selling Pricessss</th>
                        <th>{{ __('mainproducts.Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <!--end: Datatable -->
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
<script src="{{ url('/') }}/resources/js/inventory/product.js" type="text/javascript"></script>
<!--  <script src="{{ url('/') }}/resources/js/inventory/prodelete.js" type="text/javascript"></script> -->
@endsection