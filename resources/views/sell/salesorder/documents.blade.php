@extends('sell.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title"> Quotation Documents
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-secondary mr-2" onclick="goPrev()"> <i class="la la-undo"></i>Back</button>


						</div>&nbsp;
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped  table-hover table-checkable" id="">
				<thead>
					<tr role="row">
						<th class="dt-left sorting_disabled">{{ __('customer.S.No') }}</th>
						<th class="dt-left sorting_disabled">Description</th>
						<th class="dt-left sorting_disabled">Files</th>
						<th class="dt-left sorting_disabled">{{ __('customer.Action') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($documents as $key=>$documentss)
					<tr>
						<td>{{$key+1}}</td>
						<td>{{$documentss->caption}}</td>
						<td>{{$documentss->file}}</td>
						<td><a href="quotationdownload?id={{$documentss->id}}&&file={{$documentss->file}}&&qtnid={{$documentss->qtn_id}}" data-type="edit">
								<li class="kt-nav__item">
									<span class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon-download"></i>
										<span class="kt-nav__link-text" data-id="{{$documentss->id}}">Download</span>
									</span>
								</li>
							</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
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
@endsection
@section('script')
<script type="text/javascript">
	function goPrev() {
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

<script src="{{url('/')}}/resources/js/crm/customer.js" type="text/javascript"></script>

<script>
	$(document).ready(function() {
		$('.sell_saleorder_list').addClass('kt-menu__item--active');
	});
</script>
@endsection