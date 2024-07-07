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
                      Edit Role
                    </h3>
      </div>
    </div>
    <div class="kt-portlet__body">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
       <strong>Whoops!</strong> There were some problems with your input.
        <br>
        <br>
        <ul>
          @foreach ($errors->all() as $error)
          <li>
          {{ $error }}
        </li>
      @endforeach
    </ul>
      </div>
      @endif {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>Permission:</strong>
            <br/>@foreach($permission as $value)
            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }} {{ $value->name }}</label>
            <br/>
          @endforeach
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>{!! Form::close() !!}</div>
  </div>
</div>.
<style type="text/css">
  .hideButton{
         display: none
    }
    .error{
      color: red
    }
</style>
@endsection