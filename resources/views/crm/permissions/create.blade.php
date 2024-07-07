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
                                            Add Permission
                                        </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions"> <a class="btn btn-danger btn-elevate btn-icon-sm" href="{{ route('users.index') }}"> Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">{{ Form::open(array('url' => 'permissions')) }}
            <div class="form-group">{{ Form::label('name', 'Name') }} {{ Form::text('name', '', array('class' => 'form-control')) }}</div>
            <br>@if(!$roles->isEmpty()) //If no roles exist yet
            <h4>Assign Permission to Roles</h4>
            @foreach ($roles as $role) {{ Form::checkbox('roles[]', $role->id ) }} {{ Form::label($role->name, ucfirst($role->name)) }}
            <br>@endforeach @endif
            <br>{{ Form::submit('Add', array('class' => 'btn btn-primary')) }} {{ Form::close() }}</div>
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