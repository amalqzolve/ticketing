@extends('warehouse.common.layout')
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
											{{ __('rackmanagement.Rack Management Lists') }}
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												
                       <a href="{{url('/')}}/Add-RackManagement" class="btn btn-brand btn-elevate btn-icon-sm">
													<i class="la la-plus"></i>
													{{ __('rackmanagement.New Record') }}
												</a>
												<div class="dropdown dropdown-inline">
													<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="la la-download"></i> {{ __('rackmanagement.Export') }}
													</button>
													<div class="dropdown-menu dropdown-menu-right">
														<ul class="kt-nav">
															<li class="kt-nav__section kt-nav__section--first">
																<span class="kt-nav__section-text">{{ __('rackmanagement.Choose an option') }}</span>
															</li>
															<li class="kt-nav__item" id="rackmanagement_list_print">
																<span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">{{ __('rackmanagement.Print') }}</span>
																</span>
															</li>
															<li class="kt-nav__item" id="rackmanagement_list_copy">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">{{ __('rackmanagement.Copy') }}</span>
																</span>
															</li>
															<li class="kt-nav__item" id="rackmanagement_list_csv">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-text-o"></i>
																	<span class="kt-nav__link-text">{{ __('rackmanagement.CSV') }}</span>
																</a>
															</li>
															<li class="kt-nav__item" id="rackmanagement_list_pdf">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																	<span class="kt-nav__link-text">{{ __('rackmanagement.PDF') }}</span>
																</span>
															</li>
														</ul>
													</div>
												</div>
												<a href="{{url('/')}}/Trash-RackManagement" class="btn btn-secondary btn-hover-warning">
                                    {{ __('rackmanagement.Trash') }}
                                </a>

											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="rackmanagement_list">
    <thead>
        <tr>
            <th>{{ __('rackmanagement.S.No') }}</th>
            <th>{{ __('rackmanagement.Store') }}</th>
            <th>{{ __('rackmanagement.Rack Name') }}</th>
            <th>Rack Code</th>
            <th>System ID</th>
            <th>{{ __('rackmanagement.Action') }}</th>
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
<script src="{{url('/')}}/resources/js/inventory/rack.js" type="text/javascript"></script>
@endsection
