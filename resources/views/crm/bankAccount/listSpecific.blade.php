@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />



<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart">
					</i>
				</span>
				<h3 class="kt-portlet__head-title" onclick="back()">
					{{$supplier->sup_name}} - Bank Details
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						@can('Supplier Bank Account Add')
						<a href="{{url('/')}}/supplier-bank-account-add?id={{$supplier->id}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							@lang('app.New Record')
						</a>@endcan

						<div class="dropdown dropdown-inline">


							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>{{ __('supplier.Export')}}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="supplierdetails_list_print"> <span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="supplierdetails_list_copy"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('app.Copy')
											</span>
										</span>
									</li>
									<li class="kt-nav__item" id="supplierdetails_list_csv">
										<a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="supplierdetails_list_pdf"> <span class="kt-nav__link">
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
			<input type="hidden" name="supplier_id" id="supplier_id" value="{{$supplier->id}}">
			<table class="table table-striped  table-hover table-checkable" id="supplierTbl">
				<thead>
					<tr role="row">
						<th class="dt-left sorting_disabled">{{ __('supplier.Sl. No') }}</th>
						<th class="dt-left ">{{ __('supplier.Supplier Name') }}</th>
						<th class="dt-left ">{{ __('supplier.Beneficiary Name') }}</th>
						<th class="dt-left ">{{ __('supplier.Bank Name') }} </th>
						<th class="dt-left ">{{ __('supplier.Branch Name') }}</th>
						<th class="dt-left ">{{ __('supplier.Branch Code') }}</th>
						<th class="dt-left ">{{ __('supplier.Account Number') }}</th>
						<th class="dt-left ">{{ __('supplier.IBAN/ Siwft') }}</th>
						<th class="dt-left sorting_disabled">{{ __('app.Action') }}</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>.
<style type="text/css">

</style>
@endsection
@section('script')
<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/crm/bankAccount/listSpecific.js" type="text/javascript"></script>
<script>
	$('.SupplierManagement').addClass('kt-menu__item--open');
	$('.supplier-bank-account').addClass('kt-menu__item--active');
</script>
@endsection