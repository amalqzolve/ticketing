@extends('common.layout')


@section('content')

<div class="kt-subheader   kt-grid__item" id="kt_subheader">
              <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">

<!--  <h3 class="kt-subheader__title">
                    Wizard 1 </h3>
                  <span class="kt-subheader__separator kt-hidden"></span> -->

                  <div class="kt-subheader__breadcrumbs">

                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    
                      {{ Breadcrumbs::render('userInfo.index') }}

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
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
                      Show App Details
                    </h3>
                  </div>
                  
                </div>

                <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>App Name:</strong>
                                    {{ $app->app_name }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>App Description:</strong>
                                    {{ $app->app_desc }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>URL:</strong>
                                    {{ $app->url }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status:</strong>
                                    {{ $app->status }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Icon:</strong>
                                    {{ $app->uniqueid }}
                                </div>
                            </div>

                        </div>
                  <!--end: Datatable -->
                </div>
              </div>
            </div>.


<!--begin::Modal-->


<style type="text/css">
  .hideButton{
       display: none
  }
  .error{
    color: red
  }
</style>
@endsection