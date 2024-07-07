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
												Salesman Report
										</h3>
									</div>

								</div>
<?php
$date = date('d-m-Y');
$totalcost =0;
$grandtotalamount = 0;
?>
								<div class="kt-portlet__body">

<!--begin: Datatable -->

	@csrf
<div class="row">
<?php 

	$totalinvoiceamount = 0;
	$exvat = 0;
	$vat = 0;
	$no =0;
	foreach($data as $key=>$details1)
	{
		$totalinvoiceamount+= $details1->grandtotalamount;
		$exvat += $details1->totalamount;
		$vat += $details1->vatamount;
		$no = $key+1;
	}
	?>

	

<table class="table table-striped table-hover table-checkable dataTable no-footer" id="soadetails_list">
	<thead>
		<tr>
			<th>@lang('app.Sl.No')</th>
			<th>Invoice Number</th>
			<th>PO Number</th>
			<th>Invoice Date</th>
			<th>Sale Type</th>
			<th>Saleorder ID</th>
			<th>Customer</th>
			<th>Vat Amount</th>
			<th>Grand Total</th>
			<th>Status</th>
			

		</tr>
	</thead>

	<tbody>
@foreach($data as $key=>$datas)
<tr>
	<td>{{$key+1}}</td>
	<td>{{$datas->id}}</td>
	<td>{{$datas->po_ref}}</td>
	<td>{{$datas->quotedate}}</td>
	<td>{{$datas->sale_type}}</td>
	<td>{{$datas->saleorder_id}}</td>
	<td>{{$datas->cust_name}}</td>
	<td>{{$datas->vatamount}}</td>
	<td>{{$datas->grandtotalamount}}</td>
	<td>{{$datas->status}}</td>
	

</tr>
@endforeach
	</tbody>


</table>
<div class="row mt-5">
										<div class="col-lg-6">
										</div>
										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Total Invoice')</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
										<input type="text" class="form-control" name="totalamount" id="totalamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;" value="{{$no}}">
										
															
										<!-- </div> -->
										</div>
										</div>
										</div>
										<div class="col-lg-6">
										</div>
										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Total Invoice Amount')</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
										<input type="text" class="form-control discount" name="discount" id="discount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;" value="{{number_format($totalinvoiceamount,2,'.',',')}}">
										
															
										<!-- </div> -->
										</div>
										</div>
										</div>
										
										
										<div class="col-lg-6">
										</div>
										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Total Vat Amount')</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
										<input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;"value="{{number_format($vat,2,'.',',')}}">										
															
										<!-- </div> -->
										</div>
										</div>
										</div>
										<div class="col-lg-6">
										</div>
										

									   </div>


</div>

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
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
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


@endsection
