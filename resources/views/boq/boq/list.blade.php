@extends('boq.common.layout')
@section('content')
<style>
   .datepicker {
      z-index: 100000 !important;
   }

   /* .dataTables_wrapper .dataTable td:nth-child(5) {
     white-space: nowrap; 
  width: 100px !important;
  overflow: hidden;
  text-overflow: ellipsis;
  display:inline-block
} */
</style>

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
               BOQ
            </h3>
         </div>
         <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
               <div class="kt-portlet__head-actions">
                  <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_5"><i class="la la-plus"></i>{{ __('customer.New Record') }}</button>

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
                  <th>Tender ID</th>
                  <th>BOQ ID</th>
                  <th>BOQ Type</th>
                  <th>Client</th>
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
   <div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">
                  BOQ</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form class="kt-form kt-form--label-right" id="group-form" name="group-form">
                  <div class="kt-portlet__body">
                     <div class="form-group row">

                        <div class="col-lg-6">
                           <div class="form-group row pl-0">
                              <div class="col-md-4">
                                 <label>BOQ Type<span style="color: red">*</span></label>
                              </div>
                              <div class="col-md-8 input-group input-group-sm">
                                 <select class="form-control single-select kt-selectpicker" name="boq_type" id="boq_type">
                                    <option value="">Select</option>
                                    <option value="1" selected>Tender</option>
                                    <option value="2">Project</option>
                                 </select>
                              </div>
                           </div>
                        </div>




                        <div class="col-lg-6">
                           <div class="form-group row pl-0">
                              <div class="col-md-4">
                                 <label>Client<span style="color: red">*</span></label>
                              </div>
                              <div class="col-md-8 input-group input-group-sm">
                                 <select class="form-control single-select kt-selectpicker" name="client" id="client">
                                    <option value="">Select</option>
                                    @foreach ($customers as $key => $value)
                                    <option value="{{$value->id}}">{{$value->cust_name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>


                        <div class="col-lg-6">
                           <div class="form-group row pl-0 tenderDiv">
                              <div class="col-md-4">
                                 <label>Tender<span style="color: red">*</span></label>
                              </div>
                              <div class="col-md-8 input-group input-group-sm">
                                 <select class="form-control single-select kt-selectpicker" name="tender" id="tender">
                                    <option value="">Select</option>
                                    @foreach ($tender as $key => $value)
                                    <option value="{{$value->id}}">TNDR {{$value->id}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>

                           <div class="form-group row pl-0 projectDiv" style="display:none;">
                              <div class="col-md-4">
                                 <label>Project<span style="color: red">*</span></label>
                              </div>
                              <div class="col-md-8 input-group input-group-sm">
                                 <select class="form-control single-select kt-selectpicker" name="projectname" id="projectname">
                                    <option value="">Select</option>

                                 </select>
                              </div>
                           </div>

                        </div>

                        <div class="col-lg-6">
                           <div class="form-group row pr-md-1">
                              <div class="col-md-4">
                                 <label style="text-align: left;">BOQ Date<span style="color: red">*</span></label>
                              </div>
                              <div class="col-md-8">
                                 <div class="input-group  input-group-sm">
                                    <input type="text" class="form-control kt_datetimepickerr" placeholder="" id="date" name="date" autocomplete="off" value="{{date('d-m-Y')}}">
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="form-group row pr-md-1">
                              <div class="col-md-4 ">
                                 <label style="text-align: left;">BOQ Name</label>
                              </div>
                              <div class="col-md-8">
                                 <div class="input-group  input-group-sm">
                                    <input type="text" class="form-control" placeholder="" id="name" name="name" autocomplete="off">
                                 </div>
                              </div>
                           </div>
                        </div>


                        <div class="col-lg-6">
                           <div class="form-group row">
                              <div class="col-md-4 ">
                                 <label>Description</label>
                              </div>
                              <div class="col-md-8 ">
                                 <div class="input-group  input-group-sm">
                                    <textarea class="form-control" placeholder="" id="description" name="description" autocomplete="off" rows="1"></textarea>
                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">

               <button type="reset" class="btn btn-secondary  mr-2 closeBtn" data-dismiss="modal">
                  <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                     <line x1="18" y1="6" x2="6" y2="18"></line>
                     <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
                  {{ __('customer.Cancel') }}
               </button>
               <button id="boq_submit" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light ">
                  <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                     <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                     <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  {{ __('app.Save') }}
               </button>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="kt_modal_4_5_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <input type="hidden" name="id" id="id" value="">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">
                  BOQ</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form class="kt-form kt-form--label-right" id="group-form" name="group-form">
                  <div class="kt-portlet__body">
                     <div class="form-group row">
                        <div class="col-lg-12">
                           <div class="form-group row pr-md-1">
                              <div class="col-md-5 pl-md-4">
                                 <label style="text-align: left;">Name<span style="color: red">*</span></label>
                              </div>
                              <div class="col-md-7 pl-4">
                                 <div class="input-group  input-group-sm">
                                    <input type="text" class="form-control" placeholder="" id="name1" name="name1" autocomplete="off">
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-lg-12">
                           <div class="form-group row pl-md-3">
                              <div class="col-md-4">
                                 <label>Select Project<span style="color: red">*</span></label>
                              </div>
                              <div class="col-md-8 input-group input-group-sm">
                                 <select class="form-control single-select kt-selectpicker" name="projectname1" id="projectname1">
                                    <option value="">Select</option>
                                    @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->projectname}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="col-lg-12">
                           <div class="form-group row  pl-md-3">
                              <div class="col-md-12">
                                 <label>Description</label>
                              </div>
                              <div class="col-md-12">
                                 <div class="input-group  input-group-sm">
                                    <textarea class="form-control" placeholder="" id="description1" name="description1" autocomplete="off"></textarea>
                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button id="boq_update" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">{{ __('app.Update') }}</button>
               <button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">{{ __('customer.Cancel') }}</button>
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



   /*edwin*/
   /*
.client {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  min-width: 50rem;
  z-index: 1;
}*/
   /*   #maindetails_list tr > *:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  min-width: 50rem;
  z-index: 1;
}
*/
   /*#maindetails_list tr > *:first-child::before {
  content: "";
  position: absolute;
  top: 0; 
  right: 0; 
  bottom: 0; 
  left: 0;
  background-color: #eee;
  z-index: -1;
}*/
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
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/boq/boq.js" type="text/javascript"></script>
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