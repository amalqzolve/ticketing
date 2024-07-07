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
										<span class="kt-nav__link-text">{{ __('vendor.print') }}</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-copy">
									<span class="kt-nav__link">
										<i class="kt-nav__link-icon la la-copy"></i>
										<span class="kt-nav__link-text">{{ __('vendor.Copy') }}</span>
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
						</div>&nbsp;
						<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_2">
						<i class="la la-plus"></i>{{ __('vendor.NewRecord') }}</button>
						<a href="userTaxTrash" type="button" class="btn btn-danger btn-elevate btn-icon-sm">	<i class="la la-trash"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped  table-hover table-checkable"
			 id="taxdetails_list">
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
			</table>
		</div>
	</div>
</div>.
<div class="modal fade" id="kt_modal_4_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<input type="hidden" name="id" id="id" value="">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('vendor.TaxInformationDetailsform') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="user-form" name="user-form">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-4">
								<label>{{ __('vendor.VatNumber:') }}</label>
								<input type="text" class="form-control" placeholder="{{ __('vendor.EnterVatNumber') }} " id="vat_no" name="vat_no">
							</div>
							<div class="col-lg-4">
								<label>{{ __('vendor.TaxName:') }}</label>
								<input type="text" class="form-control" placeholder="{{ __('vendor.EnterTaxName') }}" id="vat_name" name="vat_name">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4">
								<label class="">{{ __('vendor.VatCertificate:') }}</label>
								<input type="hidden" name="fileData" id="fileData" />
								<input type="hidden" name="UniqueID" id="UniqueID" />
							</div>
						</div>
						<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
						<div class="form-group row">
							<div class="col-lg-12">
								<div id="choose-files">
									<form action="/upload">
										<input type="file" id="files" name="files[]" />
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-lg-4"></div>
								<div class="col-lg-8"></div>
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button id="Taxdetail_submit" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">{{ __('vendor.Submit') }}</button>
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">{{ __('vendor.Cancel') }}</button>
			</div>
		</div>
	</div>
	</form>
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
<script src="{{url('/')}}/resources/js/crm/vendorTax.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/crm/basic.js" type="text/javascript"></script>@endsection