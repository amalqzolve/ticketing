@extends('cost-center.common.layout')
@section('content')
<!-- models -->

<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Cost Group </h5>
            <button type="button" class="close closeBtn" data-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form class="kt-form kt-form--label-right" id="data-form" name="data-form">
               <input type="hidden" name="parent_id" id="parent_id" value="{{$parent}}">
               <input type="hidden" name="id" id="id" value="">
               <div class="kt-portlet__body">
                  <div class="form-group row">

                     <div class="col-lg-12">
                        <div class="form-group row pl-0">
                           <div class="col-md-2">
                              <label>Name<span style="color: red">*</span></label>
                           </div>
                           <div class="col-md-10 input-group input-group-sm">
                              <input type="text" class="form-control" name="name" id="name" maxlength="255">
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-12">
                        <div class="form-group row pl-0">
                           <div class="col-md-2">
                              <label>Code<span style="color: red">*</span></label>
                           </div>
                           <div class="col-md-10 input-group input-group-sm">
                              <input type="text" class="form-control" name="code" id="code" maxlength="50">
                           </div>
                        </div>
                     </div>


                     <div class="col-lg-12">
                        <div class="form-group row pl-0">
                           <div class="col-md-2">
                              <label>Description</label>
                           </div>
                           <div class="col-md-10 input-group input-group-sm">
                              <textarea class="form-control" name="description" id="description" cols="30" rows="3" maxlength="500"></textarea>
                           </div>
                        </div>
                     </div>


                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button id="btnSave" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light ">
               <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                  <polyline points="22 4 12 14.01 9 11.01"></polyline>
               </svg>
               {{ __('app.Save') }}
            </button>
            <button type="reset" class="btn btn-secondary  mr-2 closeBtn" data-dismiss="modal">
               <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                  <line x1="18" y1="6" x2="6" y2="18"></line>
                  <line x1="6" y1="6" x2="18" y2="18"></line>
               </svg>
               {{ __('customer.Cancel') }}
            </button>

         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="kt_modal_4_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Cost Element </h5>
            <button type="button" class="close closeBtnElement" data-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form class="kt-form kt-form--label-right" id="data-form-Element" name="data-form-Element">
               <input type="hidden" name="parent_idElement" id="parent_idElement" value="{{$parent}}">
               <input type="hidden" name="idElement" id="idElement" value="">
               <div class="kt-portlet__body">
                  <div class="form-group row">

                     <div class="col-lg-12">
                        <div class="form-group row pl-0">
                           <div class="col-md-2">
                              <label>Name<span style="color: red">*</span></label>
                           </div>
                           <div class="col-md-10 input-group input-group-sm">
                              <input type="text" class="form-control" name="nameElement" id="nameElement" maxlength="255">
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-12">
                        <div class="form-group row pl-0">
                           <div class="col-md-2">
                              <label>Code<span style="color: red">*</span></label>
                           </div>
                           <div class="col-md-10 input-group input-group-sm">
                              <input type="text" class="form-control" name="codeElement" id="codeElement" maxlength="50">
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-12">
                        <div class="form-group row pl-0">
                           <div class="col-md-2">
                              <label>Description</label>
                           </div>
                           <div class="col-md-10 input-group input-group-sm">
                              <textarea class="form-control" name="descriptionElement" id="descriptionElement" cols="30" rows="3" maxlength="500"></textarea>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button id="btnSaveElement" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light ">
               <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                  <polyline points="22 4 12 14.01 9 11.01"></polyline>
               </svg>
               {{ __('app.Save') }}
            </button>
            <button type="reset" class="btn btn-secondary  mr-2 closeBtnElement" data-dismiss="modal">
               <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                  <line x1="18" y1="6" x2="6" y2="18"></line>
                  <line x1="6" y1="6" x2="18" y2="18"></line>
               </svg>
               {{ __('customer.Cancel') }}
            </button>

         </div>
      </div>
   </div>
</div>


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
               <a href="../list-childen/{{$assent_id}}" class="" >
                  {{ str_limit($parent_name, $limit = 85, $end = '...') }}
               </a>
            </h3>
         </div>
         <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
               <div class="kt-portlet__head-actions">
                  @can('Cost Center add')
                  <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_5"><i class="la la-plus"></i>Cost Group</button>
                  @endcan
                  @can('Cost Center add')
                  <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_6"><i class="la la-plus"></i>Cost Element</button>
                  @endcan

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
         <table class="table table-striped table-hover table-checkable dataTable no-footer" id="datatable_list">
            <thead>
               <tr>
                  <th>Sl.No</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Cost</th>
                  <th>Description</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
            </tbody>
         </table>
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
   <script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
   <script src="{{url('/')}}/resources/js/cost-center/costCenter/listChild.js" type="text/javascript"></script>
   @endsection