@extends('boq.common.layout')
@section('content')
<style>
   .qqqqq {
      background-color: orange;
   }
</style>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script> -->
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
               <a href="view-childen?id={{$assent_id}}" class="">
                  {{ str_limit($parent_name, $limit = 85, $end = '...') }}
               </a>
            </h3>
         </div>
         <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
               <div class="kt-portlet__head-actions">
                  <div class="dropdown dropdown-inline">
                     @if($boq->status =='')
                     <a class="btn btn-brand btn-elevate btn-icon-sm bulk" style="width: 176px;display: none;">
                        Bulk Edit
                     </a>&nbsp;
                     <input type="hidden" name="iddds" id="iddds" value="iddds">
                     <a href="{{url('/')}}/boqaddparent/{{$parent}}" class="btn btn-brand btn-elevate btn-icon-sm" style="width: 176px;">
                        New Group
                     </a>&nbsp;
                     <a href="{{url('/')}}/boqadd/{{$parent}}" class="btn btn-brand btn-elevate btn-icon-sm" style="width: 176px;">
                        BOQ Line Item
                     </a>&nbsp;

                     <a href="{{url('/')}}/exportdata_child/{{$parent}}" class="btn btn-brand btn-elevate btn-icon-sm" style="width: 176px;">
                        Import Data
                     </a>&nbsp;
                     @endif
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
         <input type="hidden" name="parent" id="parent" value="{{$parent}}">
         <table class="table table-striped table-hover table-checkable dataTable no-footer" id="maindetails_list">
            <thead>
               <tr>
                  <th>@if($boq->status =='') <input type="checkbox" class="checkall" id="checkall" value="" /> @endif</th>
                  <th>Sl.No</th>
                  <th>System ID</th>
                  <th>Ref</th>
                  <th>BOQ Line Item</th>
                  <th>Unit</th>
                  <th>BOQ.QTY</th>
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
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/boq/listChild.js" type="text/javascript"></script>

<script>
   $(document.body).on("click", ".bulk", function() {
      var ids = $('#iddds').val();
      window.location = "{{url('/')}}/boq_bulk_edit?parent={{$assent_id}}&&ids=" + ids;
   });
</script>

@endsection