@extends('materialDirectory.common.layout')
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
					Import Material Directory Data
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">

			<div class="row" style="padding-bottom: 6px;">

				<div class="col-lg-12">
					<form action="{{ route('file-import-material-directory') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
							<div class="custom-file text-left">
								<input type="file" name="file" class="custom-file-input" id="customFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
						<br>
						<div class="col-lg-9">
							<div class="kt-align-right">
								<button type="reset" class="btn btn-secondary backHome">
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
										<line x1="18" y1="6" x2="6" y2="18"></line>
										<line x1="6" y1="6" x2="18" y2="18"></line>
									</svg> &nbsp;@lang('app.Cancel')</button>

								<button type="submit" class="btn btn-primary" id="btnSave">
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
										<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
										<polyline points="22 4 12 14.01 9 11.01"></polyline>
									</svg> &nbsp;Import data</button>
							</div>
						</div>
						<div class="col-lg-3"></div>
						<br>
					</form>
				</div>

			</div>


			<div class="kt-portlet__foot">
			</div>

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
	$('.material-directory').addClass('kt-menu__item--active');
</script>
@endsection