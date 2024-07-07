@extends('crm.common.layout')
 @section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br/>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
				<h3 class="kt-portlet__head-title">
											{{ __('vendor.DocumentsDetailsList') }}
										</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i> {{ __('vendor.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">{{ __('vendor.ChooseAnOption') }}</span>
									</li>
									<li class="kt-nav__item" id="export-button-print"> <span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">{{ __('vendor.print') }}</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-copy"> <span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">{{ __('vendor.Copy') }}</span>
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
						</div>&nbsp;
						<a href="VendorDocTrash" type="button" class="btn btn-danger btn-elevate btn-icon-sm"> <i class="la la-trash"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped table-hover table-checkable">
				<tbody>
					<tr>
						<td>{{ __('customer.Name') }}</td>
						<td colspan="3">:
							<?php echo $data->name ?></td>
					</tr>
					<tr>
						<td>{{ __('customer.Title') }}</td>
						<td colspan="3">:
							<?php echo $data->title ?></td>
					</tr>
					<tr>
						<td>{{ __('customer.Description') }}</td>
						<td colspan="3">:
							<?php echo $data->description ?></td>
					</tr>
					<tr>
						<td>{{ __('customer.Documents') }}</td>
						<td colspan="3">:
							<?php echo $data->file_data ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>.
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
<script src="{{url('/')}}/assets/js/pages/crud/datatables/basic/VendorDoc.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/js/pages/crud/datatables/basic/basic.js" type="text/javascript"></script>
@endsection