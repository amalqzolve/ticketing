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
                @lang('support_ticket.Email Settings')
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
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
			<table class="table table-striped table-hover table-checkable dataTable no-footer" id="emailsettings_tbl">
				<thead>
					<tr>
						<th><strong>@lang('support_ticket.Sl. No')</strong></th>
						<th><strong>@lang('support_ticket.Host')</strong></th>
						<th><strong>@lang('support_ticket.Port')</strong></th>
						<th><strong>@lang('support_ticket.SMTP Secure')</strong></th>
						<th><strong>@lang('support_ticket.Sender')</strong></th>
						<th><strong>@lang('support_ticket.Action')</strong></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>

	</div>
</div>

<!-- begin ::  Update Email Settings Modal -->
<div class="modal fade" id="emailsettingedit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('support_ticket.Update Email Settings')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="kt-form" method="POST" id="emailsettngs_editForm" autocomplete="off">
                @csrf
                <div class="modal-body">

					<input type="hidden" class="form-control" name="e_email_id" id="e_email_id" >
                    
                        <div class="form-group">
                            <label for="e_mailhost" class="form-control-label">@lang('support_ticket.Host'):</label>
                            <input type="text" class="form-control" name="e_mailhost" id="e_mailhost" required>
                            @error('e_mailhost')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
						<div class="form-group">
                            <label for="e_mailsmtpusername" class="form-control-label">@lang('support_ticket.SMTP Username'):</label>
                            <input type="text" class="form-control" name="e_mailsmtpusername" id="e_mailsmtpusername" required>
                            @error('e_mailsmtpusername')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
						<div class="form-group">
                            <label for="e_mailsmtppasswrd" class="form-control-label">@lang('support_ticket.SMTP Password'):</label>
                            <input type="password" class="form-control" name="e_mailsmtppasswrd" id="e_mailsmtppasswrd" required>
                            @error('e_mailsmtppasswrd')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
						<div class="form-group">
                            <label for="e_mailsmtpsecure" class="form-control-label">@lang('support_ticket.SMTP Secure'):</label>
                            <select class="form-control single-select" name="e_mailsmtpsecure" id="e_mailsmtpsecure">
								<option value="">Select</option>
								<option value="1">Yes</option>
								<option value="2">No</option>
							</select>
                            @error('e_mailsmtpsecure')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
						<div class="form-group">
                            <label for="e_mailport" class="form-control-label">@lang('support_ticket.Port'):</label>
                            <input type="text" class="form-control" name="e_mailport" id="e_mailport" required>
                            @error('e_mailport')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
						<div class="form-group">
                            <label for="e_mailsender" class="form-control-label">@lang('support_ticket.Sender Email'):</label>
                            <input type="text" class="form-control" name="e_mailsender" id="e_mailsender" required>
                            @error('e_mailsender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('support_ticket.Close')</button>
                    <button type="submit" class="btn btn-primary" name="emailsettingsupdate" id="emailsettingsupdate">@lang('support_ticket.Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end   :: Update Email Settings Modal -->

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
    $('.emailsettng').addClass('kt-menu__item--active');

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
<script src="{{url('/')}}/resources/js/support_ticket/emailsettings.js" type="text/javascript"></script>
@endsection