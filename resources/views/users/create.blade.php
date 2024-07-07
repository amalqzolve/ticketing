@extends('settings.common.layout')

@section('content')

<div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    

<!--                                    <h3 class="kt-subheader__title">
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
                                            Create New User
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                
                                                <a class="btn btn-danger btn-elevate btn-icon-sm" href="{{ route('users.index') }}"> Back</a>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                



                                <div class="kt-portlet__body">

                                    <!--begin: Datatable -->
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>


       <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Branch:</strong>
             <select class="form-control single-select" id="branch" name="branch">
                         
                              @foreach($branches as $branch)
                              <option value="{{$branch->id}}"
                                 

                                >{{$branch->label}}</option>
                              @endforeach
                            </select>
        </div>
    </div>




    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            <select class="form-control single-select" id="roles" name="roles[]" multiple="">
                         
                              @foreach($roles as $roless)
                              <option value="{{$roless}}">{{$roless}}
                              @endforeach
                            </select>
<!-- 
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!} -->
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
                                    <!--end: Datatable -->
                                </div>
                            </div>
                        </div>


 

<style type="text/css">
    .hideButton{
       display: none
    }
    .error{
        color: red
    }
    div#kt_footer {
    display: none;
}
</style>
<!--end::Modal-->                       
@endsection
