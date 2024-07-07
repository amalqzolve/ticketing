@extends('tenders.common.layout')
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
					Edit Proposal Approval synthesis
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<form class="kt-form" id="kt_form">
				<div class="row" style="padding-bottom: 6px;">

					<div class="col-lg-2"></div>
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Category Name<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control single-select kt-selectpicker" id="mrCat">
									<option value="">Select</option>
									@foreach ($MaterialCategory as $key => $value)
									<option value="{{$value->id}}" selected>{{$value->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-3"></div>

					<table class="table table-striped table-bordered table-hover" id="flow_table" style="table-layout:fixed; width:100%">
						<thead class="thead-light">
							<tr>
								<th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="60px">Sl No</th>

								<th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="250px">User</th>
								<th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">If Accepted Message</th>
								<th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">If Rejected Message</th>
								<th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mrWorkflow as $key => $value)

							<td style="text-align: center;">{{$key+1}}</td>
							<td>
								<input type="hidden" value="{{$value->id}}" name="old_id[]">
								<div>
									<select class="form-control form-control-sm single-select unit kt-selectpicker" data-id="{{$key+1}}" name="users[]" id="user{{$key+1}}">
										<option value="">select</option>
										@foreach($users as $data)
										<option value="{{$data->id}}" {{($value->user_id==$data->id)?'selected':'' }}>{{$data->name}} - {{$data->email}}</option>
										@endforeach
									</select>
								</div>
							</td>
							<td>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="ifAccepted[]" id="ifAccepted{{$key+1}}" data-id="{{$key+1}}" value="{{$value->if_accepted_note}}">
									<div>
							</td>
							<td>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="ifRejected[]" id="ifRejected{{$key+1}}" data-id="{{$key+1}}" value="{{$value->if_rejected_note}}">
									<div>
							</td>
							<td style="background-color: white;">
								<!-- <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">
									<span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">
										<i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>
								</div> -->
							</td>
							</tr>

							@endforeach
						</tbody>
					</table>
					<table style="width:100%">
						<tr>
							<td>
								<button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" id="newrow" onclick="addblankRow()"><i class="la la-plus"></i>Add User</button>
							</td>

						</tr>
					</table>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-6">
							</div>
							<div class="col-lg-6 kt-align-right">
								<button type="submit" name="tax_submit" id="saveMrWorkFlow" class="btn btn-primary">@lang('app.update')</button>
								<button type="reset" class="btn btn-secondary cancel backHome">@lang('app.Cancel')</button>
							</div>
						</div>
					</div>
				</div>
			</form>
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
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/tenders/salesProposalSynthesis/synthesisEdit.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/asset/tablednd.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$("#flow_table").tableDnD();
	});

	function addblankRow() {
		rowcount = $('#flow_table tr').length;
		var product = '';
		product += '<tr>\
		<td style="text-align: center;">' + rowcount + '</td>\
		<td>\
		<div>\
		<select class="form-control form-control-sm single-select unit kt-selectpicker"  data-id="' + rowcount + '" name="users[]" id="user' + rowcount + '">\
		<option value="">select</option>\
		@foreach($users as $data)\
		<option value="{{$data->id}}">{{$data->name}} - {{$data->email}}</option>\
		@endforeach\
		</select>\
		</div>\
		</td>\
		<td>\
		<div class="input-group input-group-sm">\
		<input type="text" class="form-control single-select productname kt-selectpicker" name="ifAccepted[]" id="ifAccepted' + rowcount + '" data-id="' + rowcount + '" value="">\
		<div>\
		</td>\
		<td>\
		<div class="input-group input-group-sm">\
		<input type="text" class="form-control single-select productname kt-selectpicker" name="ifRejected[]" id="ifRejected' + rowcount + '" data-id="' + rowcount + '" value="">\
		<div>\
		</td>\
		<td  style="background-color: white;">\
		  <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">\
		                      <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
		                      <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>\
		                   </div>\
		    </td>\
		</tr>';

		$('#flow_table').append(product);
		$("#flow_table").tableDnD();
	}
</script>
@endsection