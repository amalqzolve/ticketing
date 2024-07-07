@extends('resourcemanagement.common.layout')
@section('content')

<style>
   .dataTables_wrapper .dataTable .selected th,
   .dataTables_wrapper .dataTable .selected td {
      background-color: #f4e92b !important;
   }

   #employeesTbl_wrapper {
      height: 300px;
      overflow-y: scroll;
   }
</style>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

<!-- model -->
<div class="modal fade" id="kt_modal_4_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="min-width: 1024px;">
   <input type="hidden" name="id" id="id" value="">
   <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> All Employees</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form class="kt-form kt-form--label-right" id="category-form" name="category-form">
               <div class="kt-portlet__body">

                  <table class="table table-striped table-hover table-checkable dataTable no-footer" id="employeesTbl">
                     <thead>
                        <tr>
                           <th>{{ __('mainproducts.S.No') }}</th>
                           <th>Employee Name</th>
                           <th>Employee ID</th>
                           <th>Job Title</th>
                           <th>Department</th>
                           <th>Employee Category</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>

                  <button type="button" class="btn btn-brand btn-elevate btn-icon-sm float-right ml-2" id="datatableadd"><i class="la la-plus"></i>Add</button>
                  <button type="button" class="btn btn-secondary btn-icon-sm float-right" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                     </svg> Cancel</button>


               </div>
            </form>
         </div>

      </div>
   </div>

</div>
<!--./ model -->

<form class="kt-form" id="data-form-team">
   <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
      <br />
      <div class="kt-portlet kt-portlet--mobile">
         <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
               <span class="kt-portlet__head-icon">
                  <i class="kt-font-brand flaticon-home-2"></i>
               </span>
               <h3 class="kt-portlet__head-title">
                  Edit Team
               </h3>
            </div>
         </div>
         <div class="kt-portlet__body">

            <div class="row" style="padding-bottom: 6px;">
               <input type="hidden" name="id" id="id" value="{{$team->id}}">
               <div class="col-lg-6">
                  <div class="form-group row pr-md-3">
                     <div class="col-md-4 pt-2">
                        <label style="white-space: nowrap;">Team Name<span style="color: red">*</span></label>
                     </div>
                     <div class="col-md-8">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control" name="name" id="name" placeholder="Team Name" value="{{$team->name}}" autocomplete="off">
                        </div>
                     </div>
                  </div>
               </div>


               <div class="col-lg-6">
                  <div class="form-group row pr-md-3">
                     <div class="col-md-4 pt-2">
                        <label>Description</label>
                     </div>
                     <div class="col-md-8">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control" name="decription" id="decription" placeholder="Description" value="{{$team->decription}}" autocomplete="off">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row" style="padding-bottom: 6px;">
               <div class=" pr-1 pl-1" style="width:100%">
                  <table class="table table-striped table-bordered table-hover" id="product_table" style="width:100%">
                     <thead class="thead-light">
                        <tr>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="25px">#</th>
                           <th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Employee Name</th>
                           <th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Employee ID</th>
                           <th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Job Title</th>
                           <th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Department</th>
                           <th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Employee Category</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                        </tr>
                     </thead>
                     <br>
                     <tbody>
                        @foreach ($members as $key => $value)
                        <tr>
                           <td style="text-align: center;">{{$key+1}}</td>
                           <td>
                              <div class="input-group input-group-sm">
                                 <input type="hidden" class="form-control single-select employee_id" name="employee_id[]" id="employee_id" value="{{$value->id}}" readonly>
                                 {{$value->employee_name_field}}
                                 <div>
                           </td>
                           <td>
                              <div class="input-group input-group-sm">
                                 {{$value->employeeid}}
                                 <div>
                           </td>
                           <td>
                              <div class="input-group input-group-sm">
                                 {{$value->jobtitle}}
                                 <div>
                           </td>
                           <td>
                              <div class="input-group input-group-sm">
                                 {{$value->name}}
                                 <div>
                           </td>
                           <td>
                              <div class="input-group input-group-sm">
                                 {{$value->category}}
                                 <div>
                           </td>
                           <td style="background-color: white;">
                              <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">
                                 <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">
                                    <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>
                              </div>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  <table style="width:100%">
                     <tr>
                        <td>
                           <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" id="newrow"><i class="la la-plus"></i>Add Members</button>
                        </td>
                     </tr>
                  </table>


               </div>
               <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0; margin-top: 0;">

            </div>
         </div>


         <div class="kt-portlet__foot">
            <div class="kt-form__actions">
               <div class="row">
                  <div class="col-lg-6">
                  </div>
                  <div class="col-lg-6 kt-align-right">
                     <button id="btnSave" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                           <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                           <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        &nbsp;Save
                     </button>
                     <button type="button" class="btn btn-secondary  mr-2 backHome">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                           <line x1="18" y1="6" x2="6" y2="18"></line>
                           <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        {{ __('app.Cancel') }}
                     </button>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
</form>
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
<script src="{{url('/')}}/resources/js/resourcemanagement/team/edit.js" type="text/javascript"></script>
@endsection