@extends('projects.common.layout')
@section('content')


<!-- models -->
<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Add Milestone</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="data-from" name="data-from">
					<input type="hidden" name="id" id="id" value="">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Title <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Title') }} " id="note_title" name="note_title" autocomplete="off">
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Note date<span style="color: red">*</span> </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<input type="text" class="form-control kt_datetimepicker" value="{{date('d-m-Y')}}" name="note_date" id="note_date">
									</div>
								</div>
							</div>


							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-2">
										<label>Description </label>
									</div>
									<div class="col-md-10">
										<div class="input-group  input-group-sm">
											<textarea class="form-control" name="note_description" id="note_description" cols="30" rows="8" maxlength="1000"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Lebals </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<select class="form-control single-select kt-selectpicker" id="labels" name="labels[]" multiple="">
											@foreach($labels as $labelss)
											<option value="{{$labelss->id}}">{{$labelss->title}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-6"></div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>&nbsp; </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
										<div class="kt-checkbox-list">
											<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
												<input type="checkbox" id="public_flg" name="public_flg" value="1"> &nbsp; &nbsp; &nbsp; &nbsp; Mark as public Note
												<!-- checked="checked" -->
												<span></span>
											</label>
										</div>
									</div>
								</div>
							</div>




						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">{{ __('customer.Cancel') }}</button>
				<button type="button" id="btnSaveNote" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
						<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
						<polyline points="22 4 12 14.01 9 11.01"></polyline>
					</svg>
					&nbsp;Save
				</button>
			</div>
		</div>
	</div>
	</form>
</div>
<!-- ./models -->

<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">{{$project->projectname}}</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">

					</div>
				</div>
			</div>
		</div>


		<!--begin::Portlet-->
		<div class="kt-portlet kt-portlet--tabs">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-toolbar">
					<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-primary nav-tabs-line-2x" role="tablist">
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('project-overview',$projectId)}}" role="tab">
								<i class="la la-television"></i> Overview
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('project-task-list',$projectId)}}" role="tab">
								<i class="la la-list"></i> Task List
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('project-task-list-kanaban',$projectId)}}" role="tab">
								<i class="la la-hand-rock-o"></i>Task Kanaban
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('project-task-list-gantt',$projectId)}}" role="tab">
								<i class="la la-tasks"></i>Task Gantt
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('project-milestones',$projectId)}}" role="tab">
								<i class="la la-spinner"></i>Milestones
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="{{URL::to('project-notes',$projectId)}}" role="tab">
								<i class="la la-file-text"></i>Notes
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-files',$projectId)}}" role="tab">
								<i class="la la-files-o"></i>Files
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-comments',$projectId)}}" role="tab">
								<i class="la la-comments-o"></i>Comments
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-customer-feedback',$projectId)}}" role="tab">
								<i class="la la-paper-plane-o"></i>Customer Feedback
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('project-material-request',$projectId)}}" role="tab">
								<i class="la la-anchor"></i>Material Request
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-materials-alocated',$projectId)}}" role="tab">
								<i class="la la la-chain"></i>Allocated Materials
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-materials',$projectId)}}" role="tab">
								<i class="la la-at"></i>Project Materials
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-invoices',$projectId)}}" role="tab">
								<i class="la la-align-justify"></i>Invoices
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-payments',$projectId)}}" role="tab">
								<i class="la la-shopping-cart"></i>Payments
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-expences',$projectId)}}" role="tab">
								<i class="la la-money"></i>Expences
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-contracts',$projectId)}}" role="tab">
								<i class="la la-exclamation"></i>Contracts
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-cost-centre',$projectId)}}" role="tab">
								<i class="la la-dollar"></i>Cost Centre
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-time-sheet',$projectId)}}" role="tab">
								<i class="la la-user-times"></i>Time Sheet
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-debit-note',$projectId)}}" role="tab">
								<i class="la la-fast-backward"></i>Debit Note
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-credit-note',$projectId)}}" role="tab">
								<i class="la la-fast-forward"></i>Credit Note
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-adwance',$projectId)}}" role="tab">
								<i class="la la-rotate-right"></i>Adwance
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-receipt',$projectId)}}" role="tab">
								<i class="la la-rotate-left"></i>Receipt
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-progressive-report',$projectId)}}" role="tab">
								<i class="la la-star-half-full"></i>Progressive Report
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-completion-report',$projectId)}}" role="tab">
								<i class="la la-star"></i>Completion Report
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="kt-portlet__body">
				<div class="tab-content">

					<div class="tab-pane active" role="tabpanel">
						<input type="hidden" name="project_id" id="project_id" value="{{$project->id}}">
						<div class="kt-portlet__head ">
							<div class="kt-portlet__head-label">
								<h5 class="kt-portlet__head-title">Notes</h5>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									<div class="kt-portlet__head-actions">
										@can('project add-project-note')
										<button type="button" id="btnAdd" class="btn btn-default btn-brand btn-elevate btn-icon-sm" data-type="add"><i class="la la-plus"></i>New Note</button>
										@endcan
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="project_id" id="project_id" value="{{$project->id}}">
						<table class="table table-striped  table-hover table-checkable" id="notesTbl">
							<thead>
								<tr>
									<th>{{ __('customer.Sl. No') }}</th>
									<th>Note Date</th>
									<th>Tittle</th>
									<th>Description</th>
									<th>lebals</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

							</tbody>

						</table>
					</div>

				</div>
			</div>
		</div>
		<!--end::Portlet-->

	</div>

</div>


@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/projects/projectFunctions/notes.js" type="text/javascript"></script>
@endsection