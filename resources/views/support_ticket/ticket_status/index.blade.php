@extends('support_ticket.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					@lang('support_ticket.Ticket Status')
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#ticketstatuscreate_modal">
							<i class="la la-plus"></i>
							@lang('support_ticket.New Record')
						</button>
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-download"></i> @lang('support_ticket.Export')
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">
										<span class="kt-nav__section-text">@lang('support_ticket.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="export-button-print">
										<span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('support_ticket.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-copy">
										<span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('support_ticket.Copy')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-csv">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('support_ticket.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="export-button-pdf">
										<span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">@lang('support_ticket.PDF')</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
						<!-- <a href="settingstaxTrash" class="btn btn-secondary btn-hover-warning  btn-icon-sm">
							@lang('app.Trash')
						</a> -->

					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped table-hover table-checkable dataTable no-footer" id="ticketstatus_tbl">
				<thead>
					<tr>
						<th><strong>@lang('support_ticket.Sl. No')</strong></th>
						<th><strong>@lang('support_ticket.Status')</strong></th>
						<th><strong>@lang('support_ticket.Action')</strong></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>

	</div>
</div>

<!-- begin ::  Create Ticket Status Modal -->
<div class="modal fade" id="ticketstatuscreate_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">@lang('support_ticket.Create Ticket Status')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form" method="POST" id="ticketstatus_createForm" autocomplete="off">
				@csrf
				<div class="modal-body">

					<div class="form-group">
						<label for="tickstatus_name" class="form-control-label">@lang('support_ticket.Status'):</label>
						<input type="text" class="form-control" name="tickstatus_name" id="tickstatus_name" required>
						@error('tickstatus_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="tickstatus_desc" class="form-control-label">@lang('support_ticket.Description'):</label>
						<textarea class="form-control" name="tickstatus_desc" id="tickstatus_desc"></textarea>
					</div>

				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('support_ticket.Close')</button>
                    <button type="submit" class="btn btn-primary" name="ticketstatussubmit" id="ticketstatussubmit">@lang('support_ticket.Submit')</button> -->

					<button id="ticketstatussubmit" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
						<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
							<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
							<polyline points="22 4 12 14.01 9 11.01"></polyline>
						</svg>
						&nbsp;@lang('support_ticket.Submit')
					</button>

				</div>
			</form>
		</div>
	</div>
</div>
<!-- end   :: Create Ticket Status Modal -->

<!-- begin ::  Update Ticket Status Modal -->
<div class="modal fade" id="ticketstatusedit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">@lang('support_ticket.Update Ticket Status')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form" method="POST" id="ticketstatus_editForm" autocomplete="off">
				@csrf
				<div class="modal-body">

					<input type="hidden" class="form-control" name="e_tickstatus_id" id="e_tickstatus_id">

					<div class="form-group">
						<label for="e_tickstatus_name" class="form-control-label">@lang('support_ticket.Status'):</label>
						<input type="text" class="form-control" name="e_tickstatus_name" id="e_tickstatus_name" required>
						@error('e_tickstatus_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="e_tickstatus_desc" class="form-control-label">@lang('support_ticket.Description'):</label>
						<textarea class="form-control" name="e_tickstatus_desc" id="e_tickstatus_desc"></textarea>
					</div>

				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('support_ticket.Close')</button>
					<button type="submit" class="btn btn-primary" name="ticketstatusupdate" id="ticketstatusupdate">@lang('support_ticket.Update')</button> -->
					<button id="ticketstatusupdate" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
						<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
							<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
							<polyline points="22 4 12 14.01 9 11.01"></polyline>
						</svg>
						&nbsp;@lang('support_ticket.Update')
					</button>

				</div>
			</form>
		</div>
	</div>
</div>
<!-- end   :: Update Ticket Status Modal -->

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
<script>
	$('.settings').addClass('kt-menu__item--open kt-menu__item--here');
	$('.ticketstats').addClass('kt-menu__item--active');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>

<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/support_ticket/ticketstatus.js" type="text/javascript"></script>
@endsection