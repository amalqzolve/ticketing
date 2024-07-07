@extends('warehouse.common.layout')

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
							                        <div class="kt-portlet kt-portlet--mobile">
								                    <div class="kt-portlet__head kt-portlet__head--lg">
									                <div class="kt-portlet__head-label">
										            <span class="kt-portlet__head-icon">
											        <i class="kt-font-brand flaticon-home-2"></i>
										            </span>
										            <h3 class="kt-portlet__head-title">
											       Expired Products
										            </h3>
									               </div>
									               <div class="kt-portlet__head-toolbar">
										           <div class="kt-portlet__head-wrapper">
											       <div class="kt-portlet__head-actions">
												 
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
											
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
<!--begin: Datatable -->
 <table class="table table-striped table-hover table-checkable dataTable no-footer" id="product_tables">
    <thead>
        <tr>
            <th>{{ __('mainproducts.S.No') }}</th>
            <th>{{ __('mainproducts.Product Name') }}</th>
            <th>Expiry Date</th>
            <th>Expiry Reminder</th>
            <th>Days</th>
        </tr>
    </thead>
    <tbody>
    	    @foreach($products1 as $key => $products)
                              <?php 
                              if($products->expiry_reminder>0){

                                /*  $last_date = Carbon::createFromFormat('Y-m-d H:i:s', $products->expiry_reminder);

                                     $current_date = Carbon::now()->toDateTimeString();

          //NUMBER DAYS BETWEEN TWO DATES CALCULATOR
          $start_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $last_date);
          $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $current_date);
          $different_days = $start_date->diffInDays($end_date);*/
$current_date = Carbon::now()->toDateTimeString();
          $datetime1 = new DateTime($products->expiry_reminder);
$datetime2 = new DateTime($current_date);
$interval = $datetime1->diff($datetime2);
$different_days= $interval->format('%a');



                              }else{
                              	 $different_days ="-";
                              }
     


                              ?>       

                                            <tr>
                                            <td class="row_count" id="rowcount">{{$key + 1}}</td>

                                            <td>{{$products->product_name}} </td>
                                            <td>{{$products->expiry_date}} </td>
                                            <td>{{$products->expiry_reminder}} </td>
                                            <td>{{$different_days}} </td>
                                           
                                           
                                            
                                             
                                        </tr>
                                        
                                        @endforeach
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
 <script src="{{url('/')}}/resources/js/inventory/statusproduct.js" type="text/javascript"></script>
<!--  <script src="{{url('/')}}/resources/js/inventory/prodelete.js" type="text/javascript"></script> -->

@endsection
