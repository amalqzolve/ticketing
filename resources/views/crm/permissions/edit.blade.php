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
                                             Edit {{$permission->name}}
                                        </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions"> <a class="btn btn-danger btn-elevate btn-icon-sm" href="{{ route('users.index') }}"> Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">{{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}
            <div class="form-group">{{ Form::label('name', 'Permission Name') }} {{ Form::text('name', null, array('class' => 'form-control')) }}</div>
            <br>{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }} {{ Form::close() }}</div>
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