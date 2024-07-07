@extends('tenders.common.layout') @section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
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
				<h3 class="kt-portlet__head-title"> Generate Project From Sales Order </h3>
			</div>

		</div>
		<form action="#" id="dataForm" name="dataForm">
			<div class="kt-portlet__body">
				<div class="row" style="padding-bottom: 6px;">
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Client <span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="hidden" id="client_id" name="client_id" value="{{$salesOrder->client_id}}">
								<select class="form-control single-select kt-selectpicker" disabled>
									<option value="">Select</option>
									@foreach($customers as $customers)
									<option value="{{$customers->id}}" {{($customers->id==$salesOrder->client_id)?'selected':''}}>{{$customers->cust_name}}</option>
									@endforeach
								</select>

							</div>
						</div>
					</div>
					
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Project Name<span style="color: red">*</span> </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="hidden" name="projectname" id="projectname" value="{{$salesOrder->projectname}}">
								<input type="text" class="form-control" value="{{$salesOrder->projectname}}" disabled>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group row pr-md-3">
							<div class="col-md-2">
								<label>Project Description </label>
							</div>
							<div class="col-md-10 input-group input-group-sm">
								<textarea class="form-control" name="description" id="description">{{$salesOrder->description}}</textarea>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Start Date<span style="color: red">*</span> </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control kt_datetimepickerr" name="startdate" id="startdate" value="{{\Carbon\Carbon::parse($salesOrder->startdate)->format('d-m-Y') }}">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>End Date<span style="color: red">*</span> </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control kt_datetimepickerr" name="enddate" id="enddate" value="{{\Carbon\Carbon::parse($salesOrder->enddate)->format('d-m-Y') }}">
							</div>
						</div>
					</div>

					
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Client's PO Number <span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" name="clients_po_number" id="clients_po_number" class="form-control" value="{{$salesOrder->clients_po_number}}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Sales Order Value<span style="color: red">*</span> </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="sovalue" id="sovalue" value="{{$salesOrder->clients_po_number}}">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Sales Order Date<span style="color: red">*</span> </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control kt_datetimepickerr" name="sodate" id="sodate" value="{{\Carbon\Carbon::parse($salesOrder->sodate)->format('d-m-Y') }}">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Labels </label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control single-select kt-selectpicker" id="labels" name="labels[]" multiple="">
									<!-- (in_array($labelss->id,$salesOrderLebals)) ? 'selected' : ''  -->
									@foreach($labels as $labelss)
									<option value="{{$labelss->id}}" >{{$labelss->title}}</option>
									@endforeach
								</select>

							</div>
						</div>
					</div>

					



				</div>
				<div class="kt-portlet__foot pr-0">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-6">
							</div>
							<div class="col-lg-6 kt-align-right">
								<button type="submit" name="projectsubmit" id="projectsubmit" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
										<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
										<polyline points="22 4 12 14.01 9 11.01"></polyline>
									</svg> Save</button>
								<button type="button" class="btn btn-secondary float-right mr-2 backHome"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
										<line x1="18" y1="6" x2="6" y2="18"></line>
										<line x1="6" y1="6" x2="18" y2="18"></line>
									</svg> Cancel</button>
							</div>
						</div>
					</div>

				</div>
		</form>
	</div>
</div>
</div>
@endsection @section('script')
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{url('/')}}/resources/js/tenders/salesOreder/addBlank.js" type="text/javascript"></script>
@endsection