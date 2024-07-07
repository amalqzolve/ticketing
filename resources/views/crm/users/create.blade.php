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
                                            Create New User
                                        </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions"> <a class="btn btn-danger btn-elevate btn-icon-sm" href="{{ route('users.index') }}"> Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->@if (count($errors) > 0)
            <div class="alert alert-danger"> <strong>Whoops!</strong> There were some problems with your input.
                <br>
                <br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>@endforeach</ul>
            </div>
            @endif {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
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
                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}</div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>{!! Form::close() !!}
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
</style>
@endsection