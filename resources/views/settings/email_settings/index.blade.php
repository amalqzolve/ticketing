@extends('settings.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/crm/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					@lang('settings.EmailSettings')
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<!-- <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#termsandconditions"><i class="la la-plus"></i>{{ __('app.New Records') }}</button> -->
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i> {{ __('app.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="export-button-print"> <span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-copy"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('app.Copy')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="export-button-csv">
										<a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="export-button-pdf"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">@lang('app.PDF')</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
						<!-- <a href="{{url('/')}}/settingstermstrashdetails" type="button" class="btn btn-secondary btn-hover-warning btn-icon-sm">@lang('app.Trash')
						</a> -->
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped  table-hover table-checkable" id="emailsettings_list">
				<thead>
					<tr>
						<th><strong>{{ __('app.Sl. No') }}</strong></th>
						<th><strong>{{ __('app.Host') }}</strong></th>
						<th><strong>{{ __('app.Port') }}</strong></th>
						<th><strong>{{ __('app.SMTPSecure') }}</strong></th>
						<th><strong>{{ __('app.Sender') }}</strong></th>
						<th><strong>{{ __('app.Action') }}</strong></th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>.
<div class="modal fade" id="emailsettings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<input type="hidden" name="id" id="id" value="">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">@lang('settings.EmailSettings')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="payment-form" name="payment-form">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-3">
										<label>@lang('app.Host')<span style="color: red">*</span></label>
									</div>
									<div class="col-md-9">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" id="mail_host" name="mail_host" autocomplete="off" placeholder=" Host  ">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-3">
										<label>@lang('app.SMTP Username')<span style="color: red">*</span></label>
									</div>
									<div class="col-md-9">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" id="mail_usrname" name="mail_usrname" autocomplete="off" placeholder=" SMTP Username  ">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-3">
										<label>@lang('app.SMTP Password')<span style="color: red">*</span></label>
									</div>
									<div class="col-md-9">
										<div class="input-group  input-group-sm">
											<input type="password" class="form-control" id="mail_passwrd" name="mail_passwrd" autocomplete="off" placeholder=" SMTP Password  ">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-3">
										<label>@lang('app.SMTPSecure')<span style="color: red">*</span></label>
									</div>
									<div class="col-md-9">
										<div class="input-group  input-group-sm">
											<select class="form-control" name="mail_smtpsecure" id="mail_smtpsecure">

												<option value="Yes">Yes</option>
												<option value="No">No</option>

											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-3">
										<label>@lang('app.Port')<span style="color: red">*</span></label>
									</div>
									<div class="col-md-9">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" id="mail_port" name="mail_port" autocomplete="off" placeholder=" Port  ">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-3">
										<label>@lang('app.Sender Email')<span style="color: red">*</span></label>
									</div>
									<div class="col-md-9">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" id="mail_sender" name="mail_sender" autocomplete="off" placeholder=" Sender Email  ">
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="emailsetng_submit" class="btn btn-primary float-right mr-2">@lang('app.Save')</button>
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">@lang('customer.Cancel')</button>
			</div>
		</div>
	</div>
	</form>
</div>
<style type="text/css">
	.hideButton {
		display: none
	}

	.error {
		color: red
	}
</style>@endsection @section('script')

<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/settings/EmailSettings.js" type="text/javascript"></script>@endsection