@extends('projects.common.layout')
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
					Edit Task State
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<form class="kt-form" id="kt_form">
				<div class="row" style="padding-bottom: 6px;">
					@foreach($data as $datas)
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label> State Name<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="name" placeholder="State Name" id="name" value="{{ $datas->name }}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Data Order<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control integerVal" name="data_order" placeholder="Data Order" id="data_order" maxlength="3" value="{{ $datas->data_order }}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>style<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control kt-selectpicker" name="style" id="style">
									<option value="">--Select Style--</option>
									<option value="primary" {{($datas->style=='primary')?'selected':''}}>Primary</option>
									<option value="danger" {{($datas->style=='danger')?'selected':''}}>Danger</option>
									<option value="warning" {{($datas->style=='warning')?'selected':''}}>Warning</option>
									<option value="info" {{($datas->style=='info')?'selected':''}}>Info</option>
									<option value="light" {{($datas->style=='light')?'selected':''}}>Light</option>
									<option value="dark" {{($datas->style=='dark')?'selected':''}}>Dark</option>
								</select>
							</div>
						</div>
					</div>



					<div class="col-lg-6">
						<div class="form-group row pl-md-3">
							<div class="col-md-4">
								<label>Decription </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="decription" placeholder="Tax Percentage" id="decription" value="<?php echo $datas->decription; ?>">
							</div>
						</div>
					</div>

					<input type="hidden" id="id" name="id" value="<?php echo $datas->id; ?>">
					@endforeach
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-6">
							</div>
							<div class="col-lg-6 kt-align-right">
								<button type="reset" class="btn btn-secondary backHome">
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
										<line x1="18" y1="6" x2="6" y2="18"></line>
										<line x1="6" y1="6" x2="18" y2="18"></line>
									</svg>
									@lang('app.Cancel')
								</button>
								<button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
										<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
										<polyline points="22 4 12 14.01 9 11.01"></polyline>
									</svg>
									@lang('app.Save')
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<input type="hidden" class="form-control" name="branch" id="branch" value="{{$branch}}">
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
	function Taxedit() {
		window.history.back();
	}
</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/projects/taskState.js" type="text/javascript"></script>

@endsection