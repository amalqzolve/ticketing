@extends('crm.common.layout')
 @section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <br/>
  <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
                      <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
        <h3 class="kt-portlet__head-title">
                      Edit New User
                    </h3>
      </div>
      <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
            <div class="dropdown dropdown-inline">
              <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i> Export</button>
              <div class="dropdown-menu dropdown-menu-right">
                <ul class="kt-nav">
                  <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">Choose an option</span>
                  </li>
                  <li class="kt-nav__item" id="export-button-print"> <span href="#" class="kt-nav__link">
                                  <i class="kt-nav__link-icon la la-print"></i>
                                  <span class="kt-nav__link-text">Print</span>
                    </span>
                  </li>
                  <li class="kt-nav__item" id="export-button-copy"> <span class="kt-nav__link">
                                  <i class="kt-nav__link-icon la la-copy"></i>
                                  <span class="kt-nav__link-text">Copy</span>
                    </span>
                  </li>
                  <li class="kt-nav__item" id="export-button-csv">
                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
                      <span class="kt-nav__link-text">CSV</span>
                    </a>
                  </li>
                  <li class="kt-nav__item" id="export-button-pdf"> <span class="kt-nav__link">
                                  <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                  <span class="kt-nav__link-text">PDF</span>
                    </span>
                  </li>
                </ul>
              </div>
            </div>&nbsp; <a href="{{ route('users.create') }}" type="button" class="btn btn-brand btn-elevate btn-icon-sm"><i class="la la-plus"></i>New Record</a>
            <a href="userInfoTrash" type="button" class="btn btn-danger btn-elevate btn-icon-sm"> <i class="la la-trash"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__body">@if (count($errors) > 0)
      <div class="alert alert-danger"> <strong>Whoops!</strong> There were some problems with your input.
        <br>
        <br>
        <ul>@foreach ($errors->all() as $error)
          <li>{{ $error }}</li>@endforeach</ul>
      </div>@endif {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control user-role-select','multiple')) !!}</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>{!! Form::close() !!}</div>
  </div>
</div>.
<div class="modal fade" id="kt_modal_4_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <input type="hidden" name="id" id="id" value="">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Information details form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="kt-form kt-form--label-right" id="user-form" name="user-form">
          <div class="kt-portlet__body">
            <div class="form-group row">
              <div class="col-lg-4">
                <label>Customer Type:</label>
                <input type="text" class="form-control" placeholder="Enter Customer Type " id="cust_type" name="cust_type">
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
                <input type="text" class="form-control" placeholder="Enter Customer  Zip" id="cust_zip" name="cust_zip">
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
                <label class="">Customer Mobile Number:</label>
                <input type="text" class="form-control" placeholder="Enter  Customer  Mobile Number" id="cust_mobile" name="cust_mobile">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-4">
                <label>Customer Fax:</label>
                <input type="text" class="form-control" placeholder="Enter Customer Fax" id="cust_fax" name="cust_fax">
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
                <label class="">Customer Address2:</label>
                <textarea class="form-control edited" rows="1" id="cust_add2" name="cust_add2" placeholder="Enter Your Address"></textarea>
              </div>
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-8"></div>
              </div>
            </div>
          </div>
      </div>
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
@endsection