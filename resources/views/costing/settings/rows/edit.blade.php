@extends('costing.common.layout')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Edit Category
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<form class="kt-form" id="kt_form">
				<div class="row" style="padding-bottom: 6px;">
					@foreach($data as $datas)
					<input type="hidden" name="id" id="id" value="{{$datas->id}}">
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>@lang('app.Tax Name')<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="name" placeholder="Tax Name" id="name" value="<?php echo $datas->name; ?>">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Percentage<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="percentage" placeholder="Percentage" id="percentage" value="<?php echo $datas->percentage; ?>">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group row">
							<div class="col-md-2">
								<label>Decription</label>
							</div>
							<div class="col-md-10 input-group input-group-sm">
								<input type="text" class="form-control" name="decription" placeholder="Tax Percentage" id="decription" value="<?php echo $datas->decription; ?>">
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-6">
							</div>
							<div class="col-lg-6 kt-align-right">
								<button type="submit" name="save" id="save" class="btn btn-primary">@lang('app.Save')</button>
								<button type="reset" class="btn btn-secondary backHome">@lang('app.Cancel')</button>
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
<script src="{{url('/')}}/resources/js/costing/settings/rows.js" type="text/javascript"></script>

@endsection