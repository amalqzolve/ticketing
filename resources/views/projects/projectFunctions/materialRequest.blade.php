@extends('projects.common.layout')
@section('content')

<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">



<!-- model -->
<div class="modal fade" id="modelProgress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" href="#">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Synthesis Milestone </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="statusDiv">
				</div>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>
<!-- ./model -->


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
							<a class="nav-link" href="{{URL::to('project-task-list',$projectId)}}" role="tab">
								<i class="la la-list"></i> Task List
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-task-list-kanaban',$projectId)}}" role="tab">
								<i class="la la-hand-rock-o"></i>Task Kanaban
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-task-list-gantt',$projectId)}}" role="tab">
								<i class="la la-tasks"></i>Task Gantt
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-milestones',$projectId)}}" role="tab">
								<i class="la la-spinner"></i>Milestones
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{URL::to('project-notes',$projectId)}}" role="tab">
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
							<a class="nav-link  active" data-toggle="tab" href="{{URL::to('project-material-request',$projectId)}}" role="tab">
								<i class="la la-anchor"></i>Material Request
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="{{URL::to('project-materials-alocated',$projectId)}}" role="tab">
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
								<h5 class="kt-portlet__head-title">Material Request</h5>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									<div class="kt-portlet__head-actions">
										@can('project add-task')
										<a type="button" id="btnAdd" href="{{URL::to('project-material-request-add',$projectId)}}" class="btn btn-default btn-brand btn-elevate btn-icon-sm" data-type="add"><i class="la la-plus"></i>New </a>
										@endcan
									</div>
								</div>
							</div>
						</div>
						<table class="table table-striped  table-hover table-checkable" id="materialRequestTbl">
							<thead>
								<tr>
									<th>@lang('app.Sl.No')</th>
									<th>Transfer ID</th>
									<th>PO Date</th>
									<th>EPR ID</th>
									<th>Request By</th>
									<th>Warehouse</th>
									<th>Request Type</th>
									<th>Request Against</th>
									<th>MR Category</th>
									<th>Client</th>
									<th>Project</th>
									<th>Current Status</th>
									<th>Transfer Status</th>
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
<script src="{{url('/')}}/resources/js/projects/projectFunctions/materialRequest.js" type="text/javascript"></script>
@endsection