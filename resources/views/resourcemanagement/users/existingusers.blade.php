@extends('resourcemanagement.common.layout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap3.css" integrity="sha512-bNLHRc826Un+saq6KRpu7vwajbgpxwdNSQhyrBA9EZfbejyhT8J3OP8Wa5ewXt+g3pxFjn5o6l7WQNX4iAd8PA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>

				<!-- {{ Breadcrumbs::render('NewBrand') }} -->

			</div>
		</div>

	</div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					New Man Power
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<form class="kt-form" id="data-form">
				<div class="row" style="padding-bottom: 6px;">
					<div class="col-lg-12">
						<div class="form-group row pl-md-3">
							<div class="col-md-12 p-0 mb-2">
								<table class="table table-striped table-hover" id="usersTbl">
									<thead style=" background-color: #306584; color: white;">
										<tr>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; width: 30px;">#</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Employee Name</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Employee Category</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Department</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Job Title</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Employee ID</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Contract Number</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Nationality</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">National ID</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Expiry Date</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Passport Number</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Expiry Date</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Over Head(Hourly)</th>
											<th class="text-center" style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;width: 30px;"></th>
										</tr>
									</thead>
									<tr>

									</tr>
								</table>
							</div>
							<table style="width:100%;">
								<tr>
									<td>
										<button type="button" class="addmorepayments pluseb btn btn-brand btn-elevate btn-icon-sm  float-right"><i class="la la-plus"></i>Add More</button>
									</td>
								</tr>
							</table>

						</div>
					</div>

					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-lg-4">
									<input type="hidden" name="totalrows" id="totalrows" value="0">
								</div>
								<div class="col-lg-8">
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-6">

							</div>
							<div class="col-lg-6 kt-align-right">
								<!-- <button id="vansubmit" class="btn btn-primary">{{ __('app.Save') }}</button> -->
								<button id="btnSave" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light ">
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
										<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
										<polyline points="22 4 12 14.01 9 11.01"></polyline>
									</svg>
									Save
								</button>
								<button type="button" class="btn btn-secondary backHome float-right mr-2">{{ __('app.Cancel') }}</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
<script src="{{url('/')}}/resources/js/resourcemanagement/users/add.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var rowcount = ($("#usersTbl > tbody > tr").length);
		$(".addmorepayments").click(function() {
			var sl = ($("#usersTbl > tbody > tr").length);
			var payment = '';
			payment += '<tr>\
					  <td class="row_count" id="rowcount" style="padding: 0;">' + sl + '</td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <select class="form-control  employeename  " name="employeename[]" id="employeename' + rowcount + '" data-id=' + rowcount + '>\
			          <option></option>\
			           @foreach($employee as $employees)\
			          <option value="{{$employees->id}}">{{$employees->f_name}} {{$employees->l_name}}</option>\
			          @endforeach\
			          </select>\
					  <input type="hidden" name="employee_name_field[]" id="employee_name_field' + rowcount + '">\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control category" name="category[]" id="category' + rowcount + '"  data-id=' + rowcount + ' >\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <select class="form-control single-select department kt-selectpicker" name="department[]" id="department' + rowcount + '" data-id=' + rowcount + '>\
					  <option value="">select</option>\
					  @foreach($department as $departments)\
					  <option value="{{$departments->id}}">{{$departments->name}}</option>\
					  @endforeach\
					  </select>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control jobtitle" name="jobtitle[]" id="jobtitle' + rowcount + '"  data-id=' + rowcount + ' >\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control employeeid" name="employeeid[]" id="employeeid' + rowcount + '"  data-id=' + rowcount + '>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control contractno integerVal" name="contractno[]" id="contractno' + rowcount + '"  data-id=' + rowcount + ' >\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control nationality" name="nationality[]" id="nationality' + rowcount + '"  data-id=' + rowcount + ' >\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control nationalid" name="nationalid[]" id="nationalid' + rowcount + '"  data-id=' + rowcount + ' >\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control nationalidexp kt_datetimepickerr" name="nationalidexp[]" id="nationalidexp' + rowcount + '"  data-id=' + rowcount + ' >\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control passportno" name="passportno[]" id="passportno' + rowcount + '"  data-id=' + rowcount + ' >\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control passportnoexp kt_datetimepickerr" name="passportnoexp[]" id="passportnoexp' + rowcount + '"  data-id=' + rowcount + '>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control overhead integerVal" name="overhead[]" id="overhead' + rowcount + '"  data-id=' + rowcount + ' >\
					  </div>\
					  </td>\
						<td style="padding: 0;">\
					  <div class="kt-demo-icon__preview remove">\
					  <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>\
					  </div>\
					  </td>\
					  </tr>';

			$('#usersTbl').append(payment);

			$('.kt_datetimepickerr').datepicker({
				todayHighlight: true,
				format: 'dd-mm-yyyy'
			}).on('changeDate', function(e) {
				$(this).datepicker('hide');
			});

			$('#employeename' + rowcount).selectize({
				create: function(input) {
					return {
						value: '_' + input,
						text: input
					};
				}
			});
			// $('.employeename').selectize();

			$('#totalrows').val(rowcount);

			rowcount++;
			$(".kt-selectpicker").select2();
		});

	});


	$("body").on("click", ".remove", function(event) {
		event.preventDefault();
		var row = $(this).closest('tr');
		var siblings = row.siblings();
		row.remove();
		siblings.each(function(index) {
			$(this).children().first().text(index);
		});
	});
</script>
@endsection