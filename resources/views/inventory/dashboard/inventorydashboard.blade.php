@extends('inventory.common.layout')

@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
{{-- <div class="kt-subheader   kt-grid__item" id="kt_subheader">
							                        <div class="kt-container  kt-container--fluid ">
								                    <div class="kt-subheader__main">
                                                    <div class="kt-subheader__breadcrumbs">
								                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
								                    <span class="kt-subheader__breadcrumbs-separator"></span>
									                {{ Breadcrumbs::render('ProductListing') }} 
							                        </div> 
						                            </div>
						                            
							                        </div>
						                            </div> --}}

	                                                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                                                    <br/>
                                                    <div class="row">
        <div class="col-xl-3 col-lg-4 order-lg-2 order-xl-1">

            <!--begin:: Widgets/Profit Share-->
            <div class="kt-portlet kt-portlet--height-fluid new newcolor1">
                <div class="kt-widget14">
                    <div class="kt-widget14__header">
                        <h3 class="kt-widget14__title">
                           Total Products
                        </h3>
                        <!-- <span class="kt-widget14__desc">
                            Profit Share between customers
                        </span> -->
                    </div>
                    <div class="kt-widget14__content">
                         <h1><?php echo $products;?></h1>
                    </div>
                </div>
            </div>

            <!--end:: Widgets/Profit Share-->
        </div>
        <div class="col-xl-3 col-lg-4 order-lg-2 order-xl-1">

            <!--begin:: Widgets/Profit Share-->
            <div class="kt-portlet kt-portlet--height-fluid new newcolor1">
                <div class="kt-widget14">
                    <div class="kt-widget14__header">
                        <h3 class="kt-widget14__title">
                           Total Enabled Products
                        </h3>
                        <!-- <span class="kt-widget14__desc">
                            Profit Share between customers
                        </span> -->
                    </div>
                    <div class="kt-widget14__content">
                         <h1><?php echo $productsenabld;?></h1>
                    </div>
                </div>
            </div>

            <!--end:: Widgets/Profit Share-->
        </div></div>
							                        <div class="kt-portlet kt-portlet--mobile">
								                    <div class="kt-portlet__head kt-portlet__head--lg">
									                <div class="kt-portlet__head-label">
										            <span class="kt-portlet__head-icon">
											        <i class="kt-font-brand flaticon-home-2"></i>
										            </span>
										            <h3 class="kt-portlet__head-title">
											        {{ __('mainproducts.Product List') }}
										            </h3>
									               </div>
									               <div class="kt-portlet__head-toolbar">
										           <div class="kt-portlet__head-wrapper">
											       <div class="kt-portlet__head-actions">
												   
												 
												 
												
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
<!--begin: Datatable -->
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="productdetails_list">
    <thead>
        <tr>
            <th>{{ __('mainproducts.S.No') }}</th>
            <th>{{ __('mainproducts.Product Name') }}</th>
            <th>{{ __('mainproducts.Product Code') }}</th>
            <th>{{ __('mainproducts.Barcode') }}</th>
            <th>{{ __('mainproducts.Unit') }}</th>
            <th>{{ __('mainproducts.Category') }}</th>
            <th>{{ __('mainproducts.Product Status') }}</th>
            <th>{{ __('app.Available Stock') }}</th>
           
        </tr>
    </thead>
    <tbody>
    </tbody>  
</table>
<!--end: Datatable -->
							</div>
							</div>
						    </div>

<style type="text/css">
	.hideButton{
       display: none
	}
	.error{
		color: red
	}
</style>
<!--end::Modal-->
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script> 
 <script src="{{url('/')}}/resources/js/inventory/dashboard.js" type="text/javascript"></script>
<!--  <script src="{{url('/')}}/resources/js/inventory/prodelete.js" type="text/javascript"></script> -->

@endsection
