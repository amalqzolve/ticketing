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
                      Show App Details
                    </h3>
      </div>
    </div>
    <div class="kt-portlet__body">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>App Name:</strong>
            {{ $app->app_name }}</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>App Description:</strong>
            {{ $app->app_desc }}</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>URL:</strong>
            {{ $app->url }}</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>Status:</strong>
            {{ $app->status }}</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group"> <strong>Icon:</strong>
            {{ $app->uniqueid }}</div>
        </div>
      </div>
    </div>
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