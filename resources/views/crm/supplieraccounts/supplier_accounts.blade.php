@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					@lang('customer.Accounting Configuration')
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>{{ __('supplier.Export') }}</button>
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
											<span class="kt-nav__link-text">@lang('app.Copy')</span>
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
						</div>&nbsp;
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped  table-hover table-checkable" id="supplierdetails_list">
				<thead>
					<tr role="row">

						<th class="dt-left sorting_disabled">{{ __('customer.S.No') }}</th>
						<th class="dt-left sorting_disabled">{{ __('customer.Code') }}</th>
						<th class="dt-left sorting_disabled">{{ __('customer.Name') }}</th>
						<th class="dt-left sorting_disabled">{{ __('customer.Ledger Information') }}</th>
						<th class="dt-left sorting_disabled">{{ __('customer.Action') }}</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>.
<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<input type="hidden" name="id" id="id" value="">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('customer.Supplier Accounts Information Detail Form') }} </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="group-form" name="group-form">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-2">
										<label>@lang('customer.Select Ledger')<span style="color: red">*</span></label>
									</div>
									<div class="col-md-10 input-group input-group-sm">
										<select class="form-control kt-selectpicker single-select" name="accounts_ledger" id="accounts_ledger">
											<option value="">Select</option>
											@foreach($allLedger as $ledger)
											<option value="{{($ledger['parent_id']!='~')?'': $ledger['id'] }}" {{($ledger['parent_id']!='~')?'disabled':''}}>
												@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
													@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg> {{ __('customer.Cancel') }}</button>
				<button id="Group_submit" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
						<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
						<polyline points="22 4 12 14.01 9 11.01"></polyline>
					</svg> {{ __('customer.Save') }}</button>

			</div>
		</div>
	</div>
	</form>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>

<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>


<script src="{{url('/')}}/resources/js/crm/supplier_accounts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.js"></script>
<script type="text/javascript">
	$('.SupplierManagement').addClass('kt-menu__item--open');
	$('.supplieraccounts').addClass('kt-menu__item--active');
</script>
@endsection