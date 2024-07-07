@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon-home-2"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                           {{ __('app.New Department') }} 
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                <form class="kt-form" id="manufacture-form">
                                  <input type="hidden" name="id" id="id" value="{{$data->id}}">
                                 <div class="row" style="padding-bottom: 6px;">
                                    <div class="col-lg-6">
                                    <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('customer.Name') }}<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                    <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('customer.Name') }}" autocomplete="off" value="{{$data->name}}">
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <div class="form-group row  pl-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('app.Note') }}</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                     <textarea class="form-control" placeholder="{{ __('app.Note') }}" id="note" name="note" autocomplete="off">{{$data->note}}</textarea>
                                    </div>
                                    </div>
                                    </div>
<input type="hidden" class="form-control" name="branch" id="branch" value="{{$branch}}">
                               
                                    <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                    <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                 <div class="kt-portlet__foot">
                                                <div class="kt-form__actions">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6 kt-align-right">
                                                            <button id="department_submit" class="btn btn-primary">{{ __('app.Save') }}</button>
                                                            <button type="button" class="btn btn-secondary float-right mr-2"  onclick="goPrev()">{{ __('app.Cancel') }}</button>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </form>
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
@section('script')
<script type="text/javascript">
   function goPrev()
    {
  window.history.back();
  }
</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
 <script src="{{url('/')}}/resources/js/crm/department.js" type="text/javascript"></script>
 <script src="{{url('/')}}/resources/js/select2.js" type="text/javascript"></script>

@endsection
