@extends('boq.common.layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
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
               BOQ - Estimation Completed
            </h3>
         </div>
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
         <table class="table table-striped table-hover table-checkable dataTable no-footer" id="maindetails_list">
            <thead>
               <tr>
                  <th>Sl.No</th>
                  <th>System ID</th>
                  <th>Type</th>
                  <th>Client</th>
                  <th>Tender Id</th>
                  <th>Project</th>
                  <th>BOQ Name</th>
                  <!-- <th>Code</th> -->
                  <th>Description</th>
                  <th>Status</th>
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
<script src="{{url('/')}}/resources/js/boq/estimationCompletedList.js" type="text/javascript"></script>
<script type="text/javascript">
   // $('#maindetails_list').on('click', '.viewchilden', function() {
   //    window.location.href = $(this).data('href');
   // });

   $(document).on('click', '.boqupdate', function() {

      var info_id = $(this).attr("data-id");
      $.ajax({
         url: "boqupdate",
         method: "POST",
         data: {
            _token: $('#token').val(),
            info_id: info_id
         },
         dataType: "json",
         success: function(data) {
            $('#name1').val(data['users'].category_name);
            $('#description1').val(data['users'].description);
            $('#projectname1').val(data['users'].projectname1);

            /*  $('#amount1').val(data['users'].amount);*/
            $('#id').val(info_id);
         }
      })
   });

   $(document).on('change', '#client', function() {
      var id = $(this).val();
      $.ajax({
         type: "POST",
         url: "load-project-from-client",
         dataType: "json",
         data: {
            _token: $('#token').val(),
            id: id,
         },
         success: function(data) {
            $('#projectname').empty().trigger("change");
            var newOption = new Option('--select--', '', false, false);
            if (data.status == 1) {
               $('#projectname').append(newOption).trigger('change');
               $.each(data.data, function(i, val) {
                  var newOption = new Option(val.projectname, val.id, false, false);
                  $('#projectname').append(newOption).trigger('change');
               });
            } else
               console.log('Error !!');

         },
         error: function(jqXhr, json, errorThrown) {
            console.log('Error !!');
         }
      });
   });
</script>
@endsection