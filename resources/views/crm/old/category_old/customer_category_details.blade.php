@extends('crm.common.layout')
 @section('content')
 <link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="public/assets/css/wheelpicker.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br/>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">	<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
				<h3 class="kt-portlet__head-title">
											{{ __('customer.Cutomer Category List') }}										</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_4"><i class="la la-plus"></i>{{ __('app.New Record') }}</button>
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">	<i class="la la-download"></i>{{ __('app.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">	<span class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="customercategorydetails_list_print">	<span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="customercategorydetails_list_copy">	<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">@lang('app.Copy')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="customercategorydetails_list_csv">
										<a href="#" class="kt-nav__link">	<i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="customercategorydetails_list_pdf">	<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																	<span class="kt-nav__link-text">@lang('app.PDF')</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
						
						<a href="{{url('/')}}/categorytrash" type="button" class="btn btn-secondary btn-hover-warning btn-icon-sm">	@lang('app.Trash')
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped table-hover table-checkable" id="customercategorydetails_list">
				<thead>
					<tr>
						<th>{{ __('customer.S.No') }}</th>
						<th>{{ __('customer.Title') }}</th>
						<th>{{ __('app.Note') }}</th>
						<th>{{ __('customer.Color') }}</th>
						<th>{{ __('customer.Custom Code') }}</th>
						<th>{{ __('customer.Start From') }}</th>
						<th>{{ __('customer.Action') }}</th>
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
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>.
<div class="modal fade" id="kt_modal_4_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<input type="hidden" name="id" id="id" value="">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('customer.Category Information details form') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="category-form" name="category-form">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Title') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Title') }} " id="customer_category" name="customer_category" autocomplete="off">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Color') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Color') }}" id="color" name="color" data-wheelcolorpicker="" autocomplete="off" style="padding-top: 0px;">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Custom Code') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Custom Code') }} " id="cust_code" name="cust_code" autocomplete="off">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>{{ __('customer.Start From') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<input type="number" min=0 class="form-control" placeholder="{{ __('customer.Start From') }} " id="start_from" name="start_from" autocomplete="off">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-2">
										<label>{{ __('app.Note') }}</label>
									</div>
									<div class="col-md-10 pl-1 pr-1">
										<div class="input-group  input-group-sm">
											<textarea class="form-control" placeholder="{{ __('app.Note') }}" id="description" name="description" autocomplete="off"></textarea>
										</div>
										<input type="hidden" class="form-control" id="branch" name="branch" value="{{$branch}}">
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button id="Category_submit" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">{{ __('app.Save') }}</button>
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" onclick="closeModelcust()">{{ __('customer.Cancel') }}</button>
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
 <script type="text/javascript">
 function closeModelcust() {

	$("#kt_modal_4_4").modal("hide");
	$('#customer_category').val("");
	$('#description').val("");
	$('#color').val("");
	$('#cust_code').val("");
	$('#start_from').val("");
	
}
</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/public/assets/js/wheelpicker.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/crm/customer.js" type="text/javascript"></script>
@endsection