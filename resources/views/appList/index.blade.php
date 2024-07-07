@extends('common.layout')

@section('content')

<div class="kt-subheader   kt-grid__item" id="kt_subheader">
              <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">


<!--                  <h3 class="kt-subheader__title">
                    Wizard 1 </h3>
                  <span class="kt-subheader__separator kt-hidden"></span> -->

                  <div class="kt-subheader__breadcrumbs">

                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

                    <span class="kt-subheader__breadcrumbs-separator"></span>

                      {{ Breadcrumbs::render('appList.index') }}

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                  </div>
                </div>
                
              </div>
            </div>






  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
              <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                  <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                      <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                      {{ trans('app.appList')}}
                    </h3>
                  </div>
                  <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                      <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                          <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-download"></i> Export
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                              <li class="kt-nav__section kt-nav__section--first">
                                <span class="kt-nav__section-text">Choose an option</span>
                              </li>
                              <li class="kt-nav__item" id="export-button-print">
                                <span href="#" class="kt-nav__link">
                                  <i class="kt-nav__link-icon la la-print"></i>
                                  <span class="kt-nav__link-text">Print</span>
                                </span>
                              </li>
                              <li class="kt-nav__item" id="export-button-copy">
                                <span class="kt-nav__link">
                                  <i class="kt-nav__link-icon la la-copy"></i>
                                  <span class="kt-nav__link-text">Copy</span>
                                </span>
                              </li>
                              <li class="kt-nav__item" id="export-button-csv">
                                <a href="#" class="kt-nav__link">
                                  <i class="kt-nav__link-icon la la-file-text-o"></i>
                                  <span class="kt-nav__link-text">CSV</span>
                                </a>
                              </li>
                              <li class="kt-nav__item" id="export-button-pdf">
                                <span class="kt-nav__link">
                                  <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                  <span class="kt-nav__link-text">PDF</span>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                        &nbsp;
                        
                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_2"><i class="la la-plus"></i>New Record</button>

                        <a href="appInfoTrash" type="button" class="btn btn-danger btn-elevate btn-icon-sm">
                          <i class="la la-trash"></i>
                        </a>

                      </div>
                    </div>
                  </div>
                </div>






                <div class="kt-portlet__body">

<!--begin: Datatable -->
<table class="table table-striped- table-bordered table-hover table-checkable" id="appdetails_list">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Action</th>
            <th>App Name</th>
            <th>App Description</th>
            <th>url</th>
            <th>Status</th>
            <th>Icon</th>
        </tr>
    </thead>

    <tbody>

    </tbody>

    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>

<!--end: Datatable -->

                </div>
              </div>
            </div>.


<!--begin::Modal-->
              <div class="modal fade" id="kt_modal_4_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <input type="hidden" name="id" id="id" value="">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">App Information details form</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      </button>
                    </div>

<!--$$$$$$$$$$$$$$$$$$--->

<div class="modal-body">
  <form class="kt-form kt-form--label-right" id="user-form" name="user-form">

      <div class="kt-portlet__body">
         <div class="form-group row">
            <div class="col-lg-4">
               <label>App Name:</label>
               <input type="text" class="form-control" placeholder="Enter Application Name " id="app_name" name="app_name" >
            </div>
            <div class="col-lg-4">
               <label>App Description:</label>
               <input type="text" class="form-control" placeholder="Enter Application Description" id="app_desc" name="app_desc">
            </div>
            <div class="col-lg-4">
               <label>URL:</label>
               <input type="text" class="form-control" placeholder="Enter url" id="url" name="url">
            </div>
         </div>
         <div class="form-group row">
            <div class="col-lg-4">
            <Label>Status</Label>
             <select required class="form-control" id="status"  name="status">              
                <option value="1">Active</option>  
                <option value="0">De-Active</option>  
            </select>
        </div>
              <input type="hidden" name="fileData" id="fileData"/>
              <input type="hidden" name="UniqueID" id="UniqueID"/>

           </div>
         <div class="form-group row">
          <label>Icon: </label>
            <div class="col-lg-12">
        <div id="choose-files">
          <form action="/upload">
            <input type="file" id="files" name="files[]"/>

          </form>
        </div>
           </div>
       </div>

      </div>
      <div class="kt-portlet__foot">
         <div class="kt-form__actions">
            <div class="row">
               <div class="col-lg-4"></div>
               <div class="col-lg-8">



               </div>
            </div>
         </div>
      </div>

</div>

<!--$$$$$$$$$$$$$$$$$$--->



<div class="modal-footer">


<button id="Appdetail_submit" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">Submit</button>
                      <button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">Cancel</button>

                    </div>
                  </div>
                </div>
              </form>
            </div>

<style type="text/css">
  .hideButton{
       display: none
  }
  .error{
    color: red
  }
</style>
<!--end::Modal-->
@endsection
@section('script')

    <script src="{{ URL::asset('assets') }}/js/pages/crud/datatables/basic/basic.js" type="text/javascript"></script>

@endsection
