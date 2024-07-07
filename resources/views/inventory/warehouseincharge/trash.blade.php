@extends('settings.common.layout')

@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />


	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											Warehouse Incharger Trash
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												
                       
												<div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-secondary mr-2"  onclick=" window.history.back()"> <i
                                    class="la la-undo"></i>Back</button>

                                    
													<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="la la-download"></i> {{ __('warehouse.Export') }} 
													</button>
													<div class="dropdown-menu dropdown-menu-right">
																			<ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">{{ __('warehouse.Choose an option') }}</span>
                                    </li>
                                    <li class="kt-nav__item" id="WarehouseInchargeListing_trash_print"> <span href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">{{ __('warehouse.Print') }}</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="WarehouseInchargeListing_trash_copy"> <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">{{ __('warehouse.Copy') }}</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="WarehouseInchargeListing_trash_csv">
                                        <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">{{ __('warehouse.CSV') }}</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="WarehouseInchargeListing_trash_pdf"> <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">{{ __('warehouse.PDF') }}</span>
                                        </span>
                                    </li>
                                </ul>													</div>
												</div>
												


											</div>
										</div>
									</div>
								</div>

								<div class="kt-portlet__body">

<!--begin: Datatable -->
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="WarehouseInchargeListing_trash">
    <thead>
        <tr>
           <th>{{ __('warehouse.S.No') }}</th>
            <th>{{ __('warehouse.Name') }}</th>
            <th>{{ __('warehouse.Code') }}</th>
            <th>{{ __('warehouse.City') }}</th>
            <th>{{ __('warehouse.Country / Region') }}</th>
            <th>{{ __('warehouse.Phone') }}</th>
            <th>{{ __('warehouse.Email') }}</th>
            
            <th>{{ __('warehouse.Action') }}</th>
        </tr>
    </thead>

    <tbody>

    </tbody>

   <!--  <tfoot>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
    </tfoot> -->
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
 <script src="{{url('/')}}/resources/js/inventory/newwarehouseincharge.js" type="text/javascript"></script>

@endsection
