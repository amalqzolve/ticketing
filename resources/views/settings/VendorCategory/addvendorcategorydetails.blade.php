@extends('crm.common.layout')
	@section('content')
<link rel="stylesheet" type="text/css" href="public/assets/css/weelpicker.css">
<link href="public/assets/css/skins/header/base/wheelpicker.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br/>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
				<h3 class="kt-portlet__head-title">
											Vendor Category 
										</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i> Export</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">Choose an option</span>
									</li>
									<li class="kt-nav__item" id="export-button-print"> <span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">Print</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-copy"> <span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">Copy</span>
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
						</div>&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="id" id="id" value="">
	<form class="kt-form kt-form--label-right" id="customer-form" name="customer-form">
		<div class="kt-portlet__body">
			<div class="form-group row">
				<div class="col-lg-4">
					<label>Vendor Category:</label>
					<input type="text" class="form-control" placeholder="{{ __('vendor.EnterVendorCategory') }}" id="vendor_category" name="vendor_category" autocomplete="off" value="<?php echo isset($view[0]->vendor_category) ? $view[0]->vendor_category : ''  ?>">
				</div>
				<div class="col-lg-4">
					<label>Vendor description:</label>
					<input type="text" class="form-control" placeholder="Enter  Vendor Description" id="description" name="description" autocomplete="off" value="<?php echo isset($view[0]->description) ? $view[0]->description : ''  ?>">
				</div>
				<div class="col-lg-4">
					<label id="c_color">Color</label>
					<input type="text" data-wheelcolorpicker="" class="form-control " id="color" name="color" value="<?php echo isset($view[0]->color) ? $view[0]->color : ''  ?>">
				</div>
				<div class="col-lg-4">
					<label>Vendor Custom Code:</label>
					<input type="text" class="form-control" placeholder="Enter  Vendor Customcode" id="customcode" name="customcode" autocomplete="off" value="<?php echo isset($view[0]->customcode) ? $view[0]->startfrom : ''  ?>">
				</div>
				<div class="col-lg-4">
					<label>Vendor Start From:</label>
					<input type="number" class="form-control" placeholder="Enter  Vendor tartfrom" id="startfrom" name="startfrom" autocomplete="off" value="<?php echo isset($view[0]->startfrom) ? $view[0]->startfrom : ''  ?>">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button id="VendorCategory_submit" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">@lang('app.Save')</button>
			<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal" onclick="closeModelcategory()">Cancel</button>
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
	function myFunction(val) {
		var input2 = $('#email1').val();
			$('#registerd_email').val(input2);
	}
</script>
<script type="text/javascript">
	function closeModelcategory() {
		alert('hai')''
        $("#kt_modal_4_4").modal("hide");
        $('#id').val("");
        $('#vendor_category').val("");
        $('#description').val("");
        $('#color').val("");
        $('#customcode').val("");

        $('#startfrom').val("");

}
</script>
<script src="{{url('/')}}/resources/js/crm/vendorCategory.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/assets/js/pages/crud/datatables/basic/weelpicker.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/assets/js/wheelpicker.js" type="text/javascript"></script>@endsection