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
                                            Show Role
                                        </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions"> <a class="btn btn-danger btn-elevate btn-icon-sm" href="{{ route('roles.index') }}"> Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group"> <strong>Name:</strong>
                        {{ $role->name }}</div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group"> <strong>Permissions:</strong>
                        @if(!empty($rolePermissions)) @foreach($rolePermissions as $v)
                        <label class="label label-success">{{ $v->name }},</label>@endforeach @endif</div>
                </div>
            </div>
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