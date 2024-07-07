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
                                            Available Permissions
                                        </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
<a href="{{ route('users.index') }}" class="btn btn-danger btn-elevate btn-icon-sm">Users</a>
                        <a href="{{ route('roles.index') }}" class="btn btn-danger btn-elevate btn-icon-sm">Roles</a>
                        <a href="{{ URL::to('permissions/create') }}" class="btn btn-danger btn-elevate btn-icon-sm">Add </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-bordered table-striped" id="permissions">
                <thead>
                    <tr>
                        <th>Permissions</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>@foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td> <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info fa fa-edit btn-sm pull-left" style="margin-right: 3px;">Edit</a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                            <button type="submit" Onclick="return ConfirmDelete()" class="btn btn-danger fa fa-trash pull-left btn-sm">Delete</button>{!! Form::close() !!}</td>
                    </tr>@endforeach</tbody>
            </table>
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