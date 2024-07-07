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
                                                    <style>
                                                        .dataTables_wrapper .dataTable
                                                        {
                                                                padding-bottom: 0px !important;
                                                        }
                                                    </style>

	                                                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                                                    <br/>
							                        <div class="kt-portlet kt-portlet--mobile">
								                    <div class="kt-portlet__head kt-portlet__head--lg">
									                <div class="kt-portlet__head-label">
										            <span class="kt-portlet__head-icon">
											        <i class="kt-font-brand flaticon-home-2"></i>
										            </span>
										            <h3 class="kt-portlet__head-title">
											       {{ __('mainproducts.Product Master') }}
										            </h3>
									               </div>
									               <div class="kt-portlet__head-toolbar">
										           <div class="kt-portlet__head-wrapper">
											       <div class="kt-portlet__head-actions">
												   <a href="{{url('/')}}/Add-Product" class="btn btn-brand btn-elevate btn-icon-sm">
												  <i class="la la-plus"></i>
													{{ __('mainproducts.New Record') }}
												  </a>


												 <div class="dropdown dropdown-inline">
												 <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											     <i class="la la-download"></i> {{ __('mainproducts.Export') }}
											     </button>
											     <div class="dropdown-menu dropdown-menu-right">
												 <ul class="kt-nav">
												 <li class="kt-nav__section kt-nav__section--first">
												 <span class="kt-nav__section-text">{{ __('mainproducts.Choose an option') }}</span>
												 </li>
												 <li class="kt-nav__item" id="productdetails_list_print">
												<span href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-print"></i>
												<span class="kt-nav__link-text">{{ __('mainproducts.Print') }}</span>
												</span>
												</li>
												<li class="kt-nav__item" id="productdetails_list_copy">
												<span class="kt-nav__link">
												<i class="kt-nav__link-icon la la-copy"></i>
												<span class="kt-nav__link-text">{{ __('mainproducts.Copy') }}</span>
												</span>
												</li>
												<li class="kt-nav__item" id="productdetails_list_csv">
												<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-file-text-o"></i>
												<span class="kt-nav__link-text">{{ __('mainproducts.CSV') }}</span>
												</a>
												</li>
												<li class="kt-nav__item" id="productdetails_list_pdf">
												<span class="kt-nav__link">
												<i class="kt-nav__link-icon la la-file-pdf-o"></i>
												<span class="kt-nav__link-text">{{ __('mainproducts.PDF') }}</span>
												</span>
												</li>
												</ul>
						                         </div>
												</div>
												 <a href="{{url('/')}}/Trash-Product" class="btn btn-secondary btn-hover-warning btn-icon-sm">
                                                  {{ __('mainproducts.Trash') }}

                                                  </a>
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
<!--begin: Datatable -->
<table class="table table-striped table-hover table-checkable dataTable no-footer table-responsive" id="pproductdetails_list100" style="width:100% !important;display: table;">
    <thead>
        <tr>
            <th>Inv ID</th>
            <th>Product</th>
            <th>Inv Price</th>
            <th>Rate</th>
            <th>Sold Price</th>
             
       
        </tr>
    </thead>
    <tbody>

    	<?php foreach ($data as $key => $value) { ?>
    	<tr>
            <td><?php echo$value->inv_id; ?></td>
            <td><?php echo mb_strimwidth($value->product_name, 0, 30, "...");  ?></td>
            
            <td><?php  echo $value->selling_price; ?></td>
            <td><?php  echo $value->rate; ?></td>
            <td><?php  echo ($value->amount/$value->quantity) ?></td>
             
       
        </tr>
    	<?php } ?>
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
<script src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
 <script src="{{url('/')}}/resources/js/inventory/product.js" type="text/javascript"></script>
<!--  <script src="{{url('/')}}/resources/js/inventory/prodelete.js" type="text/javascript"></script> -->


@endsection
