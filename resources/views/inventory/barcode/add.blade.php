	@extends('inventory.common.layout')
	@section('content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
	<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
	<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
	<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
	<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
	<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		input[type="radio"], input[type="checkbox"]
{
        height: calc(0.5em + 1rem + -8px)  !important;
}

@media print {
    html, body, .container, #content,
    .box-content, .col-lg-12, .table-responsive,
    .table-responsive .table, .dataTable, .box, .row  { width: 100% !important; height: auto !important; border: none !important; padding: 0 !important; margin: 0 !important; }
    .lt .sidebar-con { width: 0; display: none;  }
    body:before, body:after, .no-print,
    #header, #sidebar-left, .sidebar-nav, .main-menu,
    footer, .breadcrumb, .box-header, .box-header .fa, .box-icon, .alert, .introtext,
    .table-responsive .row, .table-responsive .table th:first-child,
    .table-responsive .table td:first-child, .table-responsive .table tfoot,
    .buttons, .modal-open #content, .modal-body .close, .pagination, .close, .staff_note {
        display: none;
    }
    .container { width: auto !important; }
    h3 { margin-top: 0; }
    .modal { position: static; }
    .modal .table-responsive { display: block; }
    .modal .table th:first-child, .modal .table td:first-child, .modal .table th, .modal .table td { display: table-cell !important; }
    .modal-content { display: block !important; background: white !important; border: none !important; }
    .modal-content .table tfoot { display: table-row-group !important; }
    .modal-header { border-bottom: 0; }
    .modal-lg { width: 100%; }
    .table-responsive .table th,
    .table-responsive .table td { display: table-cell; border-top: none !important; border-left: none !important; border-right: none !important; border-bottom: 1px solid #CCC !important; }
    a:after {
        display: none;
    }
    .print-table thead th:first-child, .print-table thead th:last-child, .print-table td:first-child, .print-table td:last-child {
        display: table-cell !important;
    }
    .fa-3x { font-size: 1.5em; }
    .border-right {
        border-right: 0 !important;
    }
    .table thead th { background: #F5F5F5 !important; background-color: #F5F5F5 !important; border-top: 1px solid #f5F5F5 !important; }
    .well { border-top: 0 !important; }
    .box-header { border: 0 !important; }
    .box-header h2 { display: block; border: 0 !important; }
    .order-table tfoot { display: table-footer-group !important; }
    .print-only { display: block !important; }
    .reports-table th, .reports-table td { display: table-cell !important; }
    table thead { display: table-header-group; }
    .white-text { color: #FFF !important;  text-shadow: 0 0 3px #FFF !important; -webkit-print-color-adjust: exact; }
    #bl .barcodes td { padding: 2px !important; }
    #bl .barcodes .bcimg { max-width: 100%; }
    #lp .labels { text-align:center;font-size:10pt;page-break-after:always;padding:1px; }
    #lp .labels img { max-width: 100%; }
    #lp .labels .name { font-size:0.8em; font-weight:bold; }
    #lp .labels .price { font-size:0.8em; font-weight:bold; }
    .well { border: none !important; box-shadow: none; }
    .table { margin-bottom: 20px !important;  }
}

/*Please modify the styles below for barcode/label printing */
.barcode { width: 8.45in; height: 10.3in; display: block; border: 1px solid #CCC; margin: 10px auto; padding-top: 0.1in; page-break-after:always; }
.barcode .item { display: block; overflow: hidden; text-align: center; border: 1px dotted #CCC; font-size: 12px; line-height: 14px; text-transform: uppercase; float: left; }
.style50 { font-size: 10px; line-height: 12px; margin: 0 auto; display: block; text-align: center; border: 1px dotted #CCC; font-size: 12px; line-height: 14px; text-transform: uppercase; page-break-after:always; }
.barcode .style30 { width: 2.625in; height: 1in; margin: 0 0.07in; padding-top: 0.05in; }
.barcode .style30:nth-child(3n+1) {  margin-left: 0.1in; }
.barcode .style20 { width: 4in; height: 1in; margin: 0 0.1in; padding-top: 0.05in; }
.barcode .style14 { width: 4in; height: 1.33in; margin: 0 0.1in; padding-top: 0.1in; }
.barcode .style10 { width: 4in; height: 2in; margin: 0 0.1in; padding-top: 0.1in; font-size: 14px; line-height: 20px; }
.barcode .barcode_site, .barcode .barcode_name, .barcode .barcode_image, .barcode .variants { display: block; }
.barcode .barcode_price, .barcode .barcode_unit, .barcode .barcode_category { display: inline-block; }
.barcode .product_image { width: 0.8in; float: left; margin: 5px; }
.barcode .style10 .product_image { width: 1in; }
.barcode .style30 .product_image { width: 0.5in; float: left; margin: 5px; }
.barcode .product_image img { max-width: 100%; }
.style50 .product_image, .style40 .product_image { display: none; }
.style50 .barcode_site, .style50 .barcode_name, .style50 .barcode_image, .style50 .barcode_price { display: block; }
.barcode .barcode_image img, .style50 .barcode_image img { max-width: 100%; }
.barcode .barcode_site { font-weight: bold; }
.barcode .barcode_site, .barcode .barcode_name { font-size: 14px; }
.barcode .style10 .barcode_site, .barcode .style10 .barcode_name { font-size: 16px; }

.barcodea4 { width: 8.25in; height: 11.6in; display: block; border: 1px solid #CCC; margin: 10px auto; padding: 0.1in 0 0 0.1in; page-break-after:always; }
.barcodea4 .item { display: block; overflow: hidden; text-align: center; border: 1px dotted #CCC; font-size: 12px; line-height: 14px; text-transform: uppercase; float: left; }
.barcodea4 .style40 { width: 1.799in; height: 1.003in; margin: 0 0.07in; padding-top: 0.05in; }
.barcodea4 .style24 { width: 2.48in; height: 1.335in; margin-left: 0.079in; padding-top: 0.05in; }
.barcodea4 .style18 { width: 2.5in; height: 1.835in; margin-left: 0.079in; padding-top: 0.05in; font-size: 13px; line-height: 20px; }
.barcodea4 .style12 { width: 2.5in; height: 2.834in; margin-left: 0.079in; padding-top: 0.05in; font-size: 14px; line-height: 20px; }
.barcodea4 .barcode_site, .barcodea4 .barcode_name, .barcodea4 .barcode_image, .barcodea4 .variants { display: block; }
.barcodea4 .barcode_price, .barcodea4 .barcode_unit, .barcodea4 .barcode_category { display: inline-block; }
.barcodea4 .product_image { width: 0.8in; float: left; margin: 5px; }
.barcodea4 .style12 .product_image { width: 100%; height:auto; max-height: 1.5in; display: block; }
.barcodea4 .style12 .product_image img { max-width: 100%; max-height: 100%; }
.barcodea4 .style24 .barcode_site, .barcodea4 .style24 .barcode_name { font-size: 14px; }
.barcodea4 .style18 .barcode_site, .barcodea4 .style18 .barcode_name { font-size: 14px; font-weight: bold; }
.barcodea4 .style12 .barcode_site, .barcodea4 .style12 .barcode_name { font-size: 15px; font-weight: bold; }

@media print {
    .tooltip, #sliding-ad { display: none !important; }
    .barcode, .barcodea4 { margin: 0; }
    .barcode, .barcode .item, .barcodea4, .barcodea4 .item, .style50, .div50 { border: none !important; }
    .div50, .modal-content { page-break-after:always; }
}

	</style>
																			<div class="kt-subheader   kt-grid__item no-print" id="kt_subheader">
																		 <div class="kt-container  kt-container--fluid ">
																		 <div class="kt-subheader__main">
																		 <div class="kt-subheader__breadcrumbs">
																		 <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
																		 <span class="kt-subheader__breadcrumbs-separator"></span>

																			<!-- {{ Breadcrumbs::render('NewBrand') }} -->

																		</div>
																		</div>

																	</div>
																	</div>

																	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid no-print">
																	<br/>
																	<div class="kt-portlet kt-portlet--mobile">
																	<div class="kt-portlet__head kt-portlet__head--lg">
																	<div class="kt-portlet__head-label">
																	<span class="kt-portlet__head-icon">
																	<i class="kt-font-brand flaticon-home-2"></i>
																	</span>
																	<h3 class="kt-portlet__head-title">
																	 {{ __('product.Barcode') }}
																	</h3>
																	</div>
																	</div>
																	<div class="kt-portlet__body no-print">
																	<!-- <form class="kt-form" id="brand_form"> -->
																 <form method="POST" action="{{ route('submit-barcode') }}" class="no-print">
																 	@csrf
																	 <div class="row" style="padding-bottom: 6px;">

																			<div class="col-lg-6">
											<div class="form-group row pr-md-3">
												<div class="col-md-4">
													<label> {{ __('product.Product Name') }}<span style="color: red">*</span></label>
												</div>
												<div class="col-md-8">
													<div class="input-group input-group-sm">
														<select class="form-control single-select productname kt-selectpicker" name="productname" id="productname" required>
															<option value="">{{ __('mainproducts.Select') }}</option>
																@foreach($product as $products)
																<option value="{{$products->product_id}}">
																	{{$products->product_name}}</option>
																@endforeach
														</select>
													</div>
												</div>
											</div>
										</div>

																			<div class="col-lg-6">
											<div class="form-group row pr-md-3">
												<div class="col-md-4">
													<label>{{ __('product.Barcode Format') }}</label>
												</div>
												<div class="col-md-8">
													<div class="input-group input-group-sm">
														<select class="form-control single-select category kt-selectpicker" name="barcode_format" id="barcode_format">
															<option value="">{{ __('mainproducts.Select') }}</option>


															<option value="code25">Code25</option>
	<option value="code39">Code39</option>
	<option value="code128" selected="selected">Code128</option>
	<option value="ean8">EAN8</option>
	<option value="ean13">EAN13</option>
	<option value="upca">UPC-A</option>
	<option value="upce">UPC-E</option>



														</select>
													</div>
												</div>
											</div>
										</div>







													<div class="col-lg-6">
	                            			<div class="form-group row pr-md-3">
	                            											<div class="col-md-4">
	                            												<label> {{ __('product.Style') }}</label>
	                            											</div>
	                            											<div class="col-md-8">
	                            												<div class="input-group input-group-sm">
	                            													<select class="form-control single-select category kt-selectpicker" name="style" id="style">




	                           <option value="40">40 per sheet (A4) (1.799" x 1.003")</option>
	                            <option value="30">30 per sheet (2.625" x 1")</option>
	                            <option value="24" selected="selected">24 per sheet (A4) (2.48" x 1.334")</option>
	                            <option value="18">18 per sheet (A4) (2.5" x 1.835")</option>
	                            <option value="14">14 per sheet (4" x 1.33")</option>
	                            <option value="12">12 per sheet (A4) (2.5" x 2.834")</option>
	                            <option value="10">10 per sheet (4" x 2")</option>



	                            													</select>
	                            												</div>
	                            											</div>
	                            										</div>
	                            									</div>







										<div class="col-lg-6">
											<div class="form-group row pr-md-3">
												<div class="col-md-4">
													<label> {{ __('product.Product Count') }}</label>
												</div>
												<div class="col-md-8">
													<div class="input-group input-group-sm">
														<input type="text" name="pcount" id="pcount" class="form-control" required>
													</div>
												</div>
											</div>
										</div>



       <div class="form-group">
                            <span style="font-weight: bold; margin-right: 15px;"> {{ __('product.Print') }}:</span>
                            <span><input name="site_name" type="checkbox" id="site_name" value="1" checked="checked" style="display:inline-block;" /></span>
                            <span><label for="site_name" class="pr-4"> {{ __('product.Company name') }}</label></span>
                            <span><input name="product_name" type="checkbox" id="product_name" value="1" checked="checked" style="display:inline-block;" /></span>
                            <label for="product_name" class="pr-4"> {{ __('product.Item Name') }}</label>
                            <input name="price" type="checkbox" id="price" value="1" checked="checked" style="display:inline-block;" />
                            <label for="price" class="pr-4"> {{ __('product.Sales Price') }}</label>
                            <input name="currencies" type="checkbox" id="currencies" value="1" style="display:inline-block;" />
                            <label for="currencies" class="pr-4"> {{ __('product.Currency') }}</label>
                            <input name="unit" type="checkbox" id="unit" value="1" style="display:inline-block;" />
                            <label for="unit" class="pr-4"> {{ __('app.Unit') }}</label>
                            <input name="category" type="checkbox" id="category" value="1" style="display:inline-block;" />
                            <label for="category" class="pr-4"> {{ __('app.Category List') }}</label>
                            
<input name="product_code" type="checkbox" id="product_code" value="1" style="display:inline-block;" />  <label for="product_code" class="pr-4"> {{ __('mainproducts.Product Code') }}</label>

<input name="sku" type="checkbox" id="sku" value="1" style="display:inline-block;" />  <label for="sku" class="pr-4">SKU</label>

<input name="supplier_name" type="checkbox" id="supplier_name" value="1" style="display:inline-block;" />  <label for="supplier_name" class="pr-4"> {{ __('app.Supplier') }}</label>

<input name="manufacturer_name" type="checkbox" id="manufacturer_name" value="1" style="display:inline-block;" />  <label for="manufacturer_name" class="pr-4"> {{ __('product.Manufacturer List') }}</label>

<input name="brand_name" type="checkbox" id="brand_name" value="1" style="display:inline-block;" />  <label for="brand_name" class="pr-4"> {{ __('product.Brand List') }}</label>

<input name="warehouse_name" type="checkbox" id="warehouse_name" value="1" style="display:inline-block;" />  <label for="warehouse_name" class="pr-4"> {{ __('app.Warehouse') }}</label>

<input name="part_no" type="checkbox" id="part_no" value="1" style="display:inline-block;" />  <label for="part_no" class="pr-4"> {{ __('mainproducts.Part No') }}</label>

<input name="model_no" type="checkbox" id="model_no" value="1" style="display:inline-block;" />  <label for="model_no" class="pr-4"> {{ __('mainproducts.Model No') }}</label>

<input name="serial_number" type="checkbox" id="serial_number" value="1" style="display:inline-block;" />  <label for="serial_number" class="pr-4"> {{ __('mainproducts.Serial Number') }}</label>

<input name="hsn_code" type="checkbox" id="hsn_code" value="1" style="display:inline-block;" />  <label for="hsn_code" class="pr-4"> {{ __('mainproducts.HS Code') }}</label>

<input name="lotno" type="checkbox" id="lotno" value="1" style="display:inline-block;" />  <label for="lotno" class="pr-4"> {{ __('mainproducts.Lot No') }}</label>

<input name="countryoforigin" type="checkbox" id="countryoforigin" value="1" style="display:inline-block;" />  <label for="countryoforigin" class="pr-4"> {{ __('mainproducts.Country of Origin') }}</label>

<input name="cfds" type="checkbox" id="cfds" value="1" style="display:inline-block;" />  <label for="cfds" class="pr-4">SFDA</label>

<input name="catno" type="checkbox" id="catno" value="1" style="display:inline-block;" />  <label for="catno" class="pr-4"> {{ __('mainproducts.Catelogue No') }}</label>

                        </div>







																		 <div class="kt-portlet__foot">
																		 <div class="kt-form__actions">

																		 </div>
																		 </div>
																		</div>

								<input type="hidden" name="branch" id="branch" value="{{$branch}}">
																	 <div class="kt-portlet__foot pr-0">
													<div class="kt-form__actions">
														<div class="row">
															<div class="col-lg-6">

															</div>
															<div class="col-lg-6 kt-align-right">
																<button id="barcodesubmit" class="btn btn-primary  float-right "><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>  {{ __('app.Save') }}</button>
																<button type="button" class="btn btn-secondary mr-2"  onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>  {{ __('app.Cancel') }}</button>


															</div>
														</div>
													</div>
												</div>
												</form>







									</div>

								</div>

							</div>

												     <div class="clearfix"></div>

                <div id="barcode-con" style="background-color: #fff;"></div>
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
		 function goPrev()
			{
		window.history.back();
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
	<script src="{{url('/')}}/resources/js/inventory/barcode.js" type="text/javascript"></script>
	<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
	<script src="{{url('/')}}/resources/js/inventory/printpage.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	$('.btnprn').printPage();
	});
	function printDiv()
	{
		// var html = $('#barcodepage').val();
		// window.print(html);
		var prtContent = document.getElementById("printme");
	        var WinPrint = window.open();
	        WinPrint.document.write(prtContent.innerHTML);
	        WinPrint.document.close();
	        WinPrint.focus();
	        WinPrint.print();

	}
	</script>
	@endsection
