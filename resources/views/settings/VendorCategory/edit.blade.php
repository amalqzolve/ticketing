@extends('crm.common.layout')
 @section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br/>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">	<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
				<h3 class="kt-portlet__head-title">
											{{ __('vendor.Vendor Category') }}
										</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">	<i class="la la-download"></i> {{ __('vendor.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">	<span class="kt-nav__section-text">{{ __('vendor.ChooseAnOption') }}</span>
									</li>
									<li class="kt-nav__item" id="export-button-print">	<span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">{{ __('vendor.print') }}</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-copy">	<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">{{ __('vendor.Copy') }}</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-csv">
										<a href="#" class="kt-nav__link">	<i class="kt-nav__link-icon la la-file-text-o"></i>
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
						</div>&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	 foreach ($data as $key=>$value) { $vendor_id = $data->id; $vendor_category = $data->vendor_category; $description = $data->description; $color= $data->color; } 
	 ?>
	<form class="kt-form kt-form--label-right" id="vendor-form" name="vendor-form">
		<div class="kt-portlet__body">
			<div class="form-group row">
				<div class="col-lg-4">
					<label>{{ __('vendor.Category:') }}</label>
					<input type="text" class="form-control" placeholder="{{ __('vendor.EnterVendorCategory') }}" id="vendor_category" name="vendor_category" autocomplete="off" value="<?php echo $vendor_category;  ?>">
				</div>
				<div class="col-lg-4">
					<label>{{ __('vendor.Description:') }}</label>
					<input type="text" class="form-control" placeholder="{{ __('vendor.Enter VendorDescription') }}" id="description" name="description" autocomplete="off" value="<?php echo $description;  ?>">
				</div>
				<div class="col-lg-4">
					<label class="">{{ __('vendor.Color:') }}</label>
					<input type="text" class="form-control" placeholder="{{ __('vendor.Pick Color') }}" id="color" name="color" value="<?php echo $color; ?>">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id']; ?>">
			<button class="btn btn-primary float-right mr-2" id="VendorCategory_submit">{{ __('vendor.update') }}</button>
			<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">{{ __('vendor.Cancel') }}</button>
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
<script src="{{url('/')}}/resources/js/crm/vendorCategory.js" type="text/javascript"></script>
@endsection