@extends('inventory.common.layout')

@section('content')

<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
                                   <div class="kt-subheader__breadcrumbs">

										<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

										<span class="kt-subheader__breadcrumbs-separator"></span>

									    {{ Breadcrumbs::render('AdjustmentListing') }}

									</div>
								</div>
								<div class="kt-subheader__toolbar">
                            <div class="kt-subheader__wrapper">
                               
                                <a href="#" class="btn btn-secondary btn-hover-warning">
                                    {{ __('adjustments.Trash') }}  

                                </a>
                               
                            </div>
                        </div>
							</div>
						</div>

	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											{{ __('adjustments.Adjustment List') }} 
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												
                       <a href="{{url('/')}}/Add-Adjustment" class="btn btn-brand btn-elevate btn-icon-sm">
													<i class="la la-plus"></i>
													{{ __('adjustments.New Record') }} 
												</a>&nbsp;

												<div class="dropdown dropdown-inline">
													<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="la la-download"></i> {{ __('adjustments.Export') }} 
													</button>
													<div class="dropdown-menu dropdown-menu-right">
														<ul class="kt-nav">
															<li class="kt-nav__section kt-nav__section--first">
																<span class="kt-nav__section-text">{{ __('adjustments.Choose an option') }} </span>
															</li>
															<li class="kt-nav__item" id="export-button-print">
																<span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">{{ __('adjustments.Print') }} </span>
																</span>
															</li>
															<li class="kt-nav__item" id="export-button-copy">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">{{ __('adjustments.Copy') }} </span>
																</span>
															</li>
															<li class="kt-nav__item" id="export-button-csv">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-text-o"></i>
																	<span class="kt-nav__link-text">{{ __('adjustments.CSV') }} </span>
																</a>
															</li>
															<li class="kt-nav__item" id="export-button-pdf">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																	<span class="kt-nav__link-text">{{ __('adjustments.PDF') }}</span>
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
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="customerdetails_list">
    <thead>
        <tr>
            <th>{{ __('adjustments.S.No') }} </th>
            <th>{{ __('adjustments.Reference Number') }} </th>
            <th>{{ __('adjustments.Date') }} </th>
            <th>{{ __('adjustments.Account') }} </th>
            <th>{{ __('adjustments.Product') }} </th>
            <th>{{ __('adjustments.Value') }} </th>
            <th>{{ __('adjustments.Action') }} </th>
        </tr>
    </thead>

    <tbody>

    </tbody>

    <tfoot>
        <tr>
           
        </tr>
    </tfoot>
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
<!-- 
    <script src="{{url('/')}}/assets/js/pages/crud/datatables/basic/customer.js" type="text/javascript"></script> -->

@endsection
