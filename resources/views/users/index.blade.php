@extends('settings.common.layout')


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

                      {{ Breadcrumbs::render('userInfo.index') }}

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                  </div>
                </div>
                <div class="kt-subheader__toolbar">
                  <div class="kt-subheader__wrapper">
                    <a href="#" class="btn kt-subheader__btn-primary">
                      Actions &nbsp;

                      <!--<i class="flaticon2-calendar-1"></i>-->
                    </a>
                    <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="" data-placement="left" data-original-title="Quick actions">
                      <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                            <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"></path>
                          </g>
                        </svg>

                        <!--<i class="flaticon2-plus"></i>-->
                      </a>
                      <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">

                        <!--begin::Nav-->
                        <ul class="kt-nav">
                          <li class="kt-nav__head">
                            Add anything or jump to:
                            <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
                          </li>
                          <li class="kt-nav__separator"></li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-drop"></i>
                              <span class="kt-nav__link-text">Order</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                              <span class="kt-nav__link-text">Ticket</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
                              <span class="kt-nav__link-text">Goal</span>
                            </a>
                          </li>
                          <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-new-email"></i>
                              <span class="kt-nav__link-text">Support Case</span>
                              <span class="kt-nav__link-badge">
                                <span class="kt-badge kt-badge--success">5</span>
                              </span>
                            </a>
                          </li>
                          <li class="kt-nav__separator"></li>
                          <li class="kt-nav__foot">
                            <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
                            <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Click to learn more...">Learn more</a>
                          </li>
                        </ul>

                        <!--end::Nav-->
                      </div>
                    </div>
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
                      Basic
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

                        <a href="{{ route('users.create') }}" type="button" class="btn btn-brand btn-elevate btn-icon-sm"><i class="la la-plus"></i>New Record</a>

                        <a href="userInfoTrash" type="button" class="btn btn-danger btn-elevate btn-icon-sm">
                          <i class="la la-trash"></i>
                        </a>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="kt-portlet__body">

                    @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                       <p>{{ $message }}</p>
                      </div>
                    @endif
                  <!--begin: Datatable -->
                  <table class="table table-striped- table-bordered table-hover table-checkable" id="users_list">
                  <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
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
                      <h5 class="modal-title" id="exampleModalLabel">User Information details form</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      </button>
                    </div>

<!--$$$$$$$$$$$$$$$$$$--->

<div class="modal-body">
  <form class="kt-form kt-form--label-right" id="user-form" name="user-form">

      <div class="kt-portlet__body">
         <div class="form-group row">
            <div class="col-lg-4">
               <label> Customer Type:</label>
               <input type="text" class="form-control" placeholder="Enter Customer Type " id="cust_type" name="cust_type" >
            </div>
            <div class="col-lg-4">
               <label>Customer Name:</label>
               <input type="text" class="form-control" placeholder="Enter Customer Name" id="cust_name" name="cust_name">
            </div>
            <div class="col-lg-4">
               <label>Customer Country :</label>
               <input type="text" class="form-control" placeholder="Enter Customer Country" id="cust_country" name="cust_country">
            </div>
         </div>
         <div class="form-group row">
            <div class="col-lg-4">
               <label>Customer City:</label>
               <input type="text" class="form-control" placeholder="Enter  City" id="cust_city" name="cust_city">
            </div>
            <div class="col-lg-4">
               <label>Customer Region:</label>
               <input type="text" class="form-control" placeholder="Enter Customer Region " id="cust_region" name="cust_region">
            </div>
            <div class="col-lg-4">
               <label class="">Customer Zip:</label>
               <input type="text" class="form-control" placeholder="Enter Customer  Zip"id="cust_zip" name="cust_zip">
            </div>
         </div>
         <div class="form-group row">
            <div class="col-lg-4">
               <label>Customer Email:</label>
               <input type="text" class="form-control" placeholder="Enter Customer  Email" id="cust_email" name="cust_email">
            </div>
            <div class="col-lg-4">
               <label>Customer Office Phone:</label>
               <input type="text" class="form-control" placeholder="Enter Customer   Office Phone " id="cust_officephone" name="cust_officephone">
            </div>
            <div class="col-lg-4">
               <label class="">Customer  Mobile Number:</label>
               <input type="text" class="form-control" placeholder="Enter  Customer  Mobile Number" id="cust_mobile" name="cust_mobile">
            </div>
         </div>
         <div class="form-group row">
            <div class="col-lg-4">
               <label>Customer Fax:</label>
               <input type="text" class="form-control" placeholder="Enter Customer Fax" id="cust_fax" name="cust_fax" >
            </div>
            <div class="col-lg-4">
               <label>Customer Website:</label>
               <input type="text" class="form-control" placeholder="Enter Customer Website" id="cust_website" name="cust_website">
            </div>
            <div class="col-lg-4">
               <label>Customer Address:</label>
               <textarea class="form-control edited" rows="1" id="cust_add1" name="cust_add1" placeholder="Enter Your Address"></textarea>
            </div>
         </div>
         <div class="form-group row">
            <div class="col-lg-4">
               <label class=""> Customer Address2:</label>
               <textarea class="form-control edited" rows="1" id="cust_add2" name="cust_add2" placeholder="Enter Your Address"></textarea>
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

                      <button type="submit" id="Customerdetail_submit" class="btn btn-primary float-right mr-2">Submit</button>
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

{!! $data->render() !!}

@endsection

@section('script')

@endsection
