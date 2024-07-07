@extends('Reports.common.layout')

@section('content')
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
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Purchase Vat List
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a href="{{url('purchase-vat-pdf')}}?fromdate={{$fromdate}}&&todate={{$todate}}" target="_blank" class="btn btn-brand btn-elevate btn-icon-sm">
							PDF
						</a>&nbsp;
					</div>
				</div>
			</div>
		</div>
		<?php
		$date = date('d-m-Y h:i');
		?>
		<div class="kt-portlet__body">
			<!--begin: Datatable -->
			@csrf
			<div class="row">
				<?php
				$totalinvoiceamount = 0;
				$exvat = 0;
				$vat = 0;
				$no = 0;
				foreach ($details as $key => $details1) {
					$totalinvoiceamount += $details1->grandtotalamount;
					$exvat += $details1->totalamount;
					$vat += $details1->vatamount;
					$no = $key + 1;
				}
				?>
				<table class="table table-striped table-hover table-checkable dataTable no-footer" id="salesvatdetails_list">
					<thead>
						<tr>
							<th>@lang('app.Sl.No')</th>
							<th>Bill Date</th>
							<th>Invoice Id</th>
							<th>Supplier</th>
							<th>@lang('app.Vat No')</th>
							<th style="text-align:right;">Amount</th>
							<th style="text-align:right;">Discount</th>
							<th style="text-align:right;">@lang('app.Excluding Vat Amount')</th>
							<th style="text-align:right;">@lang('app.Vat Amount')</th>
						</tr>
					</thead>

					<tbody>
						@foreach($details as $key=>$details)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$details->bill_entry_date}}</td>
							<td>{{$details->id}}</td>
							<td>{{$details->sup_name}}</td>
							<td>{{$details->vatno}}</td>
							<td style="text-align:right;">{{number_format($details->totalamount,2,'.',',')}}</td>
							<td style="text-align:right;">{{number_format($details->discount,2,'.',',')}}</td>
							<td style="text-align:right;">{{number_format($details->amountafterdiscount,2,'.',',')}}</td>
							<td style="text-align:right;">{{number_format($details->vatamount,2,'.',',')}}</td>

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
								<input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;" value="{{number_format($vat,2,'.',',')}}">
								<!-- </div> -->
							</div>
						</div>
					</div>
					<div class="col-lg-6">
					</div>


				</div>

			</div>


		</div>
	</div>
</div>

@endsection
@section('script')
<script>
	$('.Purchase').addClass('kt-menu__item--open');
	$('.purchase-vat-index').addClass('kt-menu__item--active');
</script>
@endsection