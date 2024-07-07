@extends('procurement.common.layout')
@section('content')
<br>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">MR Category View</h3>
            </div>
        </div>


        <div class="kt-portlet__body">

            <table class="table table-striped table-hover table-checkable dataTable no-footer">
                @foreach($data as $settings)

                <tr>
                    <td>{{ __('app.Name') }}:</td>
                    <td>{{$settings->name}}</td>
                </tr>
                <tr>
                    <td>Decription:</td>
                    <td>{{$settings->decription}}</td>
                </tr>


                @endforeach
            </table>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6 kt-align-right">
                        <button type="reset" class="btn btn-secondary cancel" onclick="back()">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/procurement/mrcategory.js" type="text/javascript"></script>

@endsection