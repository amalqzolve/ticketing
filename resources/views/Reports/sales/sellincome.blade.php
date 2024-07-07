@extends('Reports.common.layout')

@section('content')
<!-- <link href="{{url('/')}}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
                                   <div class="kt-subheader__breadcrumbs">

										<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

										<span class="kt-subheader__breadcrumbs-separator"></span>

									   
									</div>
								</div>
								<div class="kt-subheader__toolbar">
                            <div class="kt-subheader__wrapper">
                                <a href="#" class="btn kt-subheader__btn-primary">
                                    @lang('app.Back') 
                                </a>
                                <a href="trash_purchase" class="btn btn-secondary btn-hover-warning">
                                    @lang('app.Trash ')

                                </a>
                               
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
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											Income Report
										</h3>
									</div>
									
								</div>
<?php
$date = date('d-m-Y h:i');
?>
								<div class="kt-portlet__body">

<!--begin: Datatable -->
<form method="POST" action="{{ route('sellincomereportsubmit') }}">
	@csrf
<div class="row">

	
									  <div class="col-lg-5">
										<div class="form-group  row pr-md-3">
										<div class="col-md-3">
										<label>@lang('app.From Date')</label>
										</div>  
										<div class="col-md-9 input-group-sm">
									   
								<input type="text" class="form-control ktdatepicker" name="fromdate" id="fromdate">               
										</div>
										</div>
										</div>
										<div class="col-lg-5">
										<div class="form-group  row pr-md-3">
										<div class="col-md-3">
										<label>@lang('app.To Date')</label>
										</div>  
										<div class="col-md-9 input-group-sm">
									   
								<input type="text" class="form-control ktdatepicker" name="todate" id="todate">               
										</div>
										</div>
										</div>

  <div class="col-lg-12">
															<label class="">Mode of payments :&nbsp;</label>
															
																<select class="form-control kt-select2" id="mode" name="mode[]"  multiple="multiple">
													        	
													        	    
                            <option value="1">Cash</option>
                              <option value="2">Card</option>
                                <option value="3">Bank</option>
                                  <option value="4">Cheque</option>




                              



													            </select>
														</div>

	                           </div>
										
<br>
<br>
<div class="row">
<div class="col-lg-2">
	  <button type="submit" id="purchasesubmit" class="btn btn-primary" style="float:right;">Submit</button>
</div> </div>
</div>
</form>
<!--end: Datatable -->

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
<!--end::Modal-->
@endsection
@section('script')
<script type="text/javascript">
	     $(".kt_datetimepickerr").datepicker({
    format: 'dd-mm-yyyy'

}).on('changeDate', function(e){
    $(this).datetimepicker('hide');
});

$('.ktdatepicker').datepicker({
   todayHighlight: true,
   format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
    $(this).datepicker('hide');
});


</script>
	
</script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
    $('#mode').select2();
});


</script>
@endsection
