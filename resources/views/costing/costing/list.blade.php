@extends('costing.common.layout')
@section('content')

<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
   <br />
   <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
         <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
               <i class="kt-font-brand flaticon-home-2"></i>
            </span>
            <h3 class="kt-portlet__head-title">Estimation</h3>
         </div>
         <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
               <div class="kt-portlet__head-actions">
                  <!-- <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_5"><i class="la la-plus"></i>{{ __('customer.New Record') }}</button> -->
                  <div class="dropdown dropdown-inline">
                    
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
      </div>
      <div class="kt-portlet__body">
         <table class="table table-striped table-hover table-checkable dataTable no-footer" id="maindetails_list">
            <thead>
               <tr>
                  <th>Sl.No</th>
                  <th>BOQ ID</th>
                  <th>Tender ID</th>
                  <th>Client</th>
                  <th>BOQ Name</th>
                  <th>Estimated Amount</th>
                  <th>Estimation Status</th>
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
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<!-- <script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script> -->
<script src="{{url('/')}}/resources/js/costing/list.js" type="text/javascript"></script>
@endsection