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
									@lang('app.Trash') 

								</a>
							   
							</div>
						</div>
							</div>
						</div>
						<?php
						$ddate = "";
						foreach ($data as $key => $value) {
							$ddate = $value->quotedate;
						}
						?>



	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											@lang('app.Sales Report') - 
											{{ $ddate }}
										</h3>

									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
											
					  <a href="{{url('/')}}/sell_report_date_pdf?ddate={{$ddate}}" class="btn btn-brand btn-elevate btn-icon-sm" target="_blank">
													PDF
												</a>
											
												


											</div>
										</div>
									</div>
								</div>
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
								<div class="kt-portlet__body">

<!--begin: Datatable -->
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="salesreport_lists_view">
	<thead>
		<tr>
			<th>@lang('app.Sl.No')</th>
			<th>@lang('app.Invoice ID')</th>
			<th>@lang('app.Customer')</th>
			<th>@lang('app.Total Amount Excluding Vat')</th>
			<th>@lang('app.Vat Amount')</th>
			<th>@lang('app.Total Amount Including Vat')</th>
			<th>Action</th>
			
			
			
		</tr>
	</thead>

	<tbody>


@foreach($data as $key=>$value)
<tr>
	<td>{{$key+1}}</td>
	<td>{{$value->id}}</td>
	<td>{{$value->customer}}</td>
	<td>{{number_format($value->totalamount,2,'.',',')}}</td>
	<td>{{number_format($value->vatamount,2,'.',',')}}</td>
	<td>{{number_format($value->grandtotalamount,2,'.',',')}}</td>
	<td><span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <a href="salesinvoice-PDF?id={{$value->id}}" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>
                        </span></li></a>
                       </ul></div></div></span></td>
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
										<label>@lang('app.Total Excluding Vat Amount')</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
										<input type="text" class="form-control" name="amountafterdiscount" id="amountafterdiscount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;" value="{{number_format($exvat,2,'.',',')}}">
										
															
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
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<!-- <script src="{{url('/')}}/resources/js/sales/quotation.js" type="text/javascript"></script> -->

<script src="{{url('/')}}/resources/js/sales/sales_report.js" type="text/javascript"></script>
@endsection
