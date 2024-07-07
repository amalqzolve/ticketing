
@extends('crm.common.layout')
 @section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br/>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
				<h3 class="kt-portlet__head-title">
											{{ __('vendor.DocumentsDetailsList') }}
										</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i> {{ __('vendor.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">{{ __('vendor.ChooseAnOption') }}</span>
									</li>
									<li class="kt-nav__item" id="export-button-print"> <span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">{{ __('vendor.print') }}</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-copy"> <span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">{{ __('vendor.Copy') }}</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-csv">
										<a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">CSV</span>
										</a>
									</li>
									<li class="kt-nav__item" id="export-button-pdf"> <span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																	<span class="kt-nav__link-text">PDF</span>
										</span>
									</li>
								</ul>
							</div>
						</div>&nbsp;
						<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_2"><i class="la la-plus"></i>{{ __('vendor.NewRecord') }}</button>
						<a href="VendorDocTrash" type="button" class="btn btn-danger btn-elevate btn-icon-sm"> <i class="la la-trash"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped table-hover table-checkable"
			 id="vendordocdetails_list">
				<thead>
					<tr>
						<th>{{ __('vendor.Sno') }}</th>
						<th>{{ __('vendor.action') }}</th>
						<th>{{ __('vendor.name') }}</th>
						<th>{{ __('vendor.Description') }}</th>
						<th>{{ __('vendor.documents') }}</th>
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
<div class="modal fade" id="kt_modal_4_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php 
	foreach ($data as $data) {
	 $vendor_id=$data->id; $vendorname = $data->name; $description = $data->description; $documents = $data->file_data; }
	  ?>
	<input type="hidden" name="id" id="id" value="">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('vendor.DocumentDetailsform') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="user-form" name="user-form">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-4">
								<?php $vname=isset($vendorname) ? $vendorname : ''; ?>
								<label>{{ __('vendor.VendorCategory') }}</label>
								<select class="form-control single-select" id="vendorname" name="vendorname">
									<option value="">{{ __('vendor.Select') }}</option>@foreach($list as $lists) @if($vname!= $lists->vendor_name)
									<option value="{{$lists->vendor_name}}">{{$lists->vendor_name}}</option>@endif else
									<option value="{{$lists->vendor_name}}" selected>{{$lists->vendor_name}}</option>@endforeach</select>
							</div>
							<div class="col-lg-4">
								<label>{{ __('vendor.Description') }}:</label>
								<input type="text" class="form-control" placeholder="{{ __('vendor.EnterDescription') }}" id="description" name="description">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4">
								<label class="">{{ __('vendor.documents') }}:</label>
								<input type="text" name="fileData" id="fileData" />
								<input type="text" name="UniqueID" id="UniqueID" />
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
				<button id="Docdetail_submit" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">{{ __('vendor.Submit') }}</button>
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
<script src="{{url('/')}}/assets/js/pages/crud/datatables/basic/VendorDoc.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/js/select2.js"></script>

<script src="{{url('/')}}/assets/js/pages/crud/datatables/basic/basic.js" type="text/javascript"></script>
@endsection