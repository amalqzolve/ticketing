@extends('asset.common.layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
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
											Parts
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												
                       <a href="{{url('/')}}/assetparts" class="btn btn-brand btn-elevate btn-icon-sm">
													<i class="la la-plus"></i>
													{{ __('product.New Record') }}
												</a>&nbsp;

												<div class="dropdown dropdown-inline">
													<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="la la-download"></i> {{ __('product.Export') }}
													</button>
													<div class="dropdown-menu dropdown-menu-right">
														<ul class="kt-nav">
															<li class="kt-nav__section kt-nav__section--first">
																<span class="kt-nav__section-text">{{ __('product.Choose an option') }}</span>
															</li>
															<li class="kt-nav__item" id="branddetails_list_print">
																<span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">{{ __('product.Print') }}</span>
																</span>
															</li>
															<li class="kt-nav__item" id="branddetails_list_copy">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">{{ __('product.Copy') }}</span>
																</span>
															</li>
															<li class="kt-nav__item" id="branddetails_list_csv">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-text-o"></i>
																	<span class="kt-nav__link-text">{{ __('product.CSV') }}</span>
																</a>
															</li>
															<li class="kt-nav__item" id="branddetails_list_pdf">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																	<span class="kt-nav__link-text">{{ __('product.PDF') }}</span>
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
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="partsdetails_list">
    <thead>
        <tr>
            <th>{{ __('product.S.No') }}</th>
            <th>ID</th>
            
            <th>Parts Name</th>
            <th>Parts Date</th>
           
            <th>{{ __('product.Action') }}</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
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
<script src="{{url('/')}}/resources/js/asset/parts.js" type="text/javascript"></script>

@endsection
