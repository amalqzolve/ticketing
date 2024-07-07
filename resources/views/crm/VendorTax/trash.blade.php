@extends('crm.common.layout')
 @section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br/>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">	<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart">
											</i>
										</span>
				<h3 class="kt-portlet__head-title">
											{{ __('vendor.TaxDetailsList') }}
										</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">	<i class="la la-download"></i> {{ __('vendor.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">
										<span class="kt-nav__section-text">{{ __('vendor.ChooseAnOption') }}</span>
									</li>
									<li class="kt-nav__item" id="export-button-print">
										<span href="#" class="kt-nav__link">
									<i class="kt-nav__link-icon la la-print"></i>
									<span class="kt-nav__link-text">{{ __('vendor.print') }}
									</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-copy">
										<span class="kt-nav__link">
										<i class="kt-nav__link-icon la la-copy"></i>
									<span class="kt-nav__link-text">{{ __('vendor.Copy') }}
									</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-csv">
										<a href="#" class="kt-nav__link">	<i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">CSV</span>
										</a>
									</li>
									<li class="kt-nav__item" id="export-button-pdf">
										<span class="kt-nav__link">
										<i class="kt-nav__link-icon la la-file-pdf-o"></i>
										<span class="kt-nav__link-text">PDF</span>
										</span>
									</li>
								</ul>
							</div>
						</div>&nbsp;</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped  table-hover table-checkable"
			 id="taxdetailstrash_list">
				<thead>
					<tr>
						<th>{{ __('app.Sl. No') }}</th>
						<th>{{ __('vendor.action') }}</th>
						<th>{{ __('vendor.VatNumber') }}</th>
						<th>{{ __('vendor.TaxName') }}</th>
						<th>{{ __('vendor.TaxCertificate') }}</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
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
 @section('script')
<script src="{{url('/')}}/resources/js/crm/vendorTax.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/crm/basic.js" type="text/javascript"></script>@endsection