@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<!-- model -->
<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" href="#">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('supplier.Bank Management') }} </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="group-form" name="group-form">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-12">
								<div class="form-group  row pr-md-3">
									<div class="col-md-2">
										<label>{{ __('supplier.Users') }}</label>
									</div>
									<div class="col-md-10 input-group-sm">
										<select class="form-control single-select kt-selectpicker" name="supplier" id="supplier">
											<option value="">--select--</option>
											@foreach($supplier as $value)
											<option value="{{$value->id}}">{{$value->sup_name}}</option>
											@endforeach
										</select>
										<!--  -->
									</div>
								</div>
							</div>

						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				@can('Bank Account Add')
				<button id="addRec" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">{{ __('app.New Record') }}</button>@endcan
				<!-- <button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">{{ __('customer.Cancel') }}</button> -->
			</div>
		</div>
	</div>
</div>
<!-- ./model -->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart">
					</i>
				</span>
				<h3 class="kt-portlet__head-title">
					{{ __('supplier.Supplier Bank Details') }}
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_5"><i class="la la-plus"></i>{{ __('customer.New Record') }}</button>
						<div class="dropdown dropdown-inline">


							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>{{ __('supplier.Export')}}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="supplierTbl_list_print"> <span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="supplierTbl_list_copy"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('app.Copy')
											</span>
										</span>
									</li>
									<li class="kt-nav__item" id="supplierTbl_list_csv">
										<a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="supplierTbl_list_pdf"> <span class="kt-nav__link">
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
			<table class="table table-striped  table-hover table-checkable" id="supplierTbl" style="cursor:pointer">
				<thead>
					<tr role="row" style="cursor: pointer;">

						<th class="dt-left sorting_disabled">{{ __('supplier.Sl. No') }}</th>
						<th class="dt-left sorting_disabled">{{__('supplier.Supplier Name') }}</th>
						<th class="dt-left sorting_disabled">{{ __('supplier.Supplier Code') }}</th>
						<th class="dt-left sorting_disabled">{{ __('customer.Group') }}</th>
						<th class="dt-left sorting_disabled">{{ __('customer.Category') }}</th>
						<th class="dt-left sorting_disabled">{{ __('supplier.Total Bank Accounts') }}</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>.

@endsection
@section('script')
<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/datatables.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/datatables.buttons.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/buttons.flash.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/jszip.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/pdfmake.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js"></script>

<script src="{{url('/')}}/resources/js/crm/bankAccount/list.js" type="text/javascript"></script>

<script>
	$('.SupplierManagement').addClass('kt-menu__item--open');
	$('.supplier-bank-account').addClass('kt-menu__item--active');
</script>
@endsection