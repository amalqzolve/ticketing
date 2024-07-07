@extends('crm.common.layout')
 @section('content')
<link href="assets/css/skins/header/base/wheelpicker.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br/>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
		<i class="kt-font-brand flaticon2-line-chart"></i>
		</span>
				<h3 class="kt-portlet__head-title">
         {{ __('salesman.Sales Department') }}
               </h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">	<i class="la la-download"></i> {{ __('app.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">	<span class="kt-nav__section-text">Choose an option</span>
									</li>
									<li class="kt-nav__item" id="export-button-print">	<span href="#" class="kt-nav__link">
		<i class="kt-nav__link-icon la la-print"></i>
		<span class="kt-nav__link-text">Print</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-copy">	<span class="kt-nav__link">
		  <i class="kt-nav__link-icon la la-copy"></i>
		  <span class="kt-nav__link-text">Copy</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-csv">
										<a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">CSV</span>
										</a>
									</li>
									<li class="kt-nav__item" id="export-button-pdf">	<span class="kt-nav__link">
		<i class="kt-nav__link-icon la la-file-pdf-o"></i>
		<span class="kt-nav__link-text">PDF</span>
										</span>
									</li>
								</ul>
							</div>
						</div>&nbsp;
						<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_12"><i class="la la-plus"></i>{{ __('app.New Records') }}</button>
						<a href="{{url('/')}}/salesdepartmenttrashshows" type="button" class="btn btn-danger btn-elevate btn-icon-sm"> <i class="la la-trash"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped  table-hover table-checkable" id="salesdepartment_list">
				<thead>
					<tr>
						<th>{{ __('app.Sl. No') }}</th>
						<th>{{ __('app.Action') }}</th>
						<th>{{ __('salesman.Title') }}</th>
						<th>{{ __('salesman.Description') }}</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
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
<div class="modal fade" id="kt_modal_4_12" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<input type="hidden" name="id" id="id" value="">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('salesman.Sale Department details form') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="salesdepartment-form" name="salesdepartment-form">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-4">
								<label>{{ __('salesman.Title') }}:<span class="kt-font-danger kt-font-boldest">*</span>&nbsp;</label>
								<input type="text" class="form-control" placeholder="{{ __('salesman.Enter Title') }} " id="title" name="title" autocomplete="off">
							</div>
							<div class="col-lg-4">
								<label>{{ __('salesman.Description') }}:<span class="kt-font-danger kt-font-boldest">*</span>&nbsp;</label>
								<input type="text" class="form-control" placeholder=" {{ __('salesman.Enter Description') }}" id="description" name="description" autocomplete="off">
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="saledepartment_submit" class="btn btn-primary float-right mr-2">{{ __('salesman.Submit') }}</button>
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">{{ __('salesman.Cancel') }}</button>
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
<script src="{{url('/')}}/resources/js/crm/sales_dpt.js" type="text/javascript"></script>@endsection