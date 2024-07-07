@extends('settings.common.layout') @section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	li.nav-item {
		width: 140px;
}
</style>


<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
		</div>
	   
	</div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Custom Fields
				</h3>
			</div>

		</div> 

		<div class="kt-portlet__body">

			
							
								 <div class="row" style="padding-bottom: 6px;">
									
				
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Labels <span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
								   <select class="form-control single-select kt-selectpicker" id="labels" name="labels[]" multiple="">
								 <option value="">Select</option>
								 <option value="part_no">Part No</option>
								 <option value="model_no">Model No</option>
								 <option value="serial_number">Serial Number</option>
								 <option value="hsn_code">HS Code</option>
								 <option value="lotno">Lot No</option>
								 <option value="cfds">SFDA</option>
								 <option value="catno">Catelogue No</option>
								 <option value="manufacturing_date">Manufacturing Date</option>
								 <option value="shelflife">Days for Shelf Life</option>
								 <option value="expiry_date">Expiry Date</option>
								 <option value="expiry_reminder">Expiry Reminder</option>
								 <option value="warranty_date">Warranty Date</option>
								 <option value="warranty_reminder">Warranty Reminder</option>
								 <option value="upc">UPC</option>
								 <option value="ean">EAN</option>
								 <option value="jan">JAN</option>
								 <option value="isbn">ISBN</option>
								 <option value="mpn">MPN</option>
								 <option value="product_code">Product Code</option>
								 <option value="sku">SKU</option>
								 <option value="barcode">Barcode</option>
								 <option value="product_price">Product Price</option>
								 <option value="selling_price">Sales Price</option>
								 <option value="sup_vendorname">Supplier Name</option>
								 <option value="manufacturer">Manufacturer</option>
								 <option value="brand">Brand</option>
								 <option value="warehouse">Warehouse</option>
								 <option value="countryoforigin">Country of Origin</option>
								 <option value="cfds">SFDA</option>
								 <option value="batch_lot_no">Batch Name</option>
								 

								   </select>
									
									</div>
									</div>
									</div>
									
									
								
									

								 </div>
								 <div class="kt-portlet__foot pr-0">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="submit" name="customfieldsubmit" id="customfieldsubmit" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Save</button>
															<button type="button" class="btn btn-secondary float-right mr-2"  onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel</button>
														</div>
													</div>
												</div>
									
						</div>

						</div>
					</div>
				</div>





		</div>
	</div>
</div>
<style type="text/css">
	.hideButton {
		display: none
	}
	
	.error {
		color: red
	}
</style>
<!--end::Modal-->
@endsection @section('script')
<script type="text/javascript">
   function goPrev()
	{
  window.history.back();
  }

				$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
})
	$(document).ready(function() {
	$(".ponumber").select2({
  tags: true
})
});



</script>

</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/settings/custom.js" type="text/javascript"></script>

@endsection