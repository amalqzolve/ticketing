@extends('crm.common.layout')
@section('content')
<style>
	.custom-file-label,
	.custom-file-label::after {
		height: calc(1em + 1.3rem + 2px);
	}
</style>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Import Data
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">

			<div class="row" style="padding-bottom: 6px;">

				<div class="col-lg-12">
					<form action="{{ route('file-import-customer') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-lg-4 pt-2">
								<a href="{{url('/')}}/customer_download" class="btn btn-brand btn-block btn-elevate btn-icon-sm" style="width: 100% !important;">
									<i class="la la-download"></i>
									Template Download
								</a>
							</div>
							<div class="col-lg-4">
								<div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
									<div class="custom-file text-left">
										<input type="file" name="file" class="custom-file-input form-control-sm" id="customFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
								</div>
							</div>
							<div class="col-lg-4 pt-2">
								<button class="btn btn-primary btn-block " style="width: 100% !important;">
									<i class="la la-upload"></i>
									Upload Data
								</button>
							</div>



						</div>
					</form>
				</div>
			</div>
			<div class="kt-portlet__foot">
			</div>

		</div>
	</div>
</div>

@endsection
@section('script')
<script>
	$('.DataMigrations').addClass('kt-menu__item--open');
	$('.customerdatamigration').addClass('kt-menu__item--active');
</script>
@endsection