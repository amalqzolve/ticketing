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

	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											@lang('app.Credit Sales Report')
										</h3>

									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
											
					   
						<!-- <a href="{{url('/')}}/revisedcustominvoice" class="btn btn-brand btn-elevate btn-icon-sm">
													
													@lang('app.Revised Invoice')
												</a> -->
													
												<div class="dropdown dropdown-inline">
													<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="la la-download"></i> @lang('app.Export')
													</button>
													<div class="dropdown-menu dropdown-menu-right">
														<ul class="kt-nav">
															<li class="kt-nav__section kt-nav__section--first">
																<span class="kt-nav__section-text">@lang('app.Choose an option')</span>
															</li>
															<li class="kt-nav__item" id="export-button-print">
																<span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">@lang('app.Print')</span>
																</span>
															</li>
															<li class="kt-nav__item" id="export-button-copy">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">@lang('app.Copy')</span>
																</span>
															</li>
															<li class="kt-nav__item" id="export-button-csv">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-text-o"></i>
																	<span class="kt-nav__link-text">@lang('app.CSV')</span>
																</a>
															</li>
															<li class="kt-nav__item" id="export-button-pdf">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																	<span class="kt-nav__link-text">@lang('app.PDF')</span>
																</span>
															</li>
														</ul>
													</div>
												</div>
												


											</div>
										</div>
									</div>
								</div>

								<div class="kt-portlet__body">

<!--begin: Datatable -->
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="creditsalesreport_lists">
	<thead>
		<tr>
			<th>@lang('app.Sl.No')</th>
			<th>@lang('app.Date')</th>
			<th>@lang('app.Total Amount Excluding Vat')</th>
			<th>@lang('app.Vat Amount')</th>
			<th>@lang('app.Total Amount Including Vat')</th>
			
			
		</tr>
	</thead>

	<tbody>
@foreach($data as $key=>$value)
<tr  data-href='viewcreditsellreport?id={{$value->quotedate}}'>
	<td>{{$key+1}}</td>
	<td>{{$value->quotedate}}</td>
	<td>{{round($value->totalamounts,2)}}</td>
	<td>{{round($value->vatamounts,2)}}</td>
	<td>{{round($value->grandtotalamounts,2)}}</td>
</tr>
@endforeach
	</tbody>

	
</table>

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
<script type="text/javascript">

$('#creditsalesreport_lists').on('click', 'tbody tr', function() {
  window.location.href = $(this).data('href');
});



</script>
<style type="text/css">
	tr {
    cursor: pointer;
}
</style>
@endsection
