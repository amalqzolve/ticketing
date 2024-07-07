@extends('projects.common.layout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	.nbutton {
		width: 25px;
		height: 25px;
		display: block;
		border-radius: 50%;
	}

	.nbtred:hover {
		background-color: red;
		color: white;
	}

	.nbtgreen:hover {
		background-color: green;
		color: white;
	}

	.throgh {
		text-decoration: line-through;
	}
</style>

@can('project add-project-members')
<!-- models -->
<div class="modal fade" id="addMemberModel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog ">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Add member</h4>
				<button type="button" class="close" data-dismiss="modal"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="data-from" name="data-from">
					<div class="form-group row">
						<div class="col-lg-12">
							<div class="form-group row pr-md-3">
								<div class="col-md-4">
									<label>All Employees <span style="color: red">*</span></label>
								</div>
								<div class="col-md-8 pl-4">
									<div class="input-group  input-group-sm">
										<select class="form-control kt-selectpicker" id="new_member" name="new_member">
											<option value="">--select--</option>
											@foreach($employees as $employe)
											<option value="{{$employe->id}}">{{$employe->employee_name_field}} ({{$employe->employeeid}})</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">{{ __('customer.Cancel') }}</button>
				<button type="button" id="btnSaveMember" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
						<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
						<polyline points="22 4 12 14.01 9 11.01"></polyline>
					</svg>
					&nbsp;Save
				</button>
			</div>

		</div>
	</div>
</div>
<!-- ./models -->
@endcan




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
							<a class="nav-link active" data-toggle="tab" href="{{URL::to('project-overview',$projectId)}}" role="tab">
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
						<div class="row">
							<div class="col-md-6 row">
								<div class="col-12 row d-flex ">
									<div class="col-6 p-1">
										<div class="card">
											<div class="card-header bg-primary text-white" style="height:7pc;"></div>
											<div class="card-body p-0">
												<div id="donut_single" style="width: 100%; height: 180px; position: absolute; top: 0px;"></div>
												<div class="col-12border border-top-0 border border-left-0 border border-right-0" style="height: 50px;">
												</div>
												<div class="cpl-12  border border-left-0 border border-right-0 p-1">
													Project Leader : {{$project->lead_name}}
												</div>
												<div class="cpl-12  border border-left-0 border border-right-0 p-1">
													Start date: {{$project->enddate}}
												</div>
												<div class="cpl-12  border border-left-0 border border-right-0 p-1">
													Start date: {{$project->podate}}
												</div>
											</div>
										</div>
									</div>
									<div class="col-6 p-1 d-flex ">
										<div class="card col-12 p-0">
											<div id="donutchart" style="width: 250px; height: 100%;" class="border"></div>
										</div>
									</div>
								</div>
								<div class="col-12 pl-md-0 pr-md-3 mt-2">
									<div class="card border">
										<div class="row">
											<div class="col-6 p-3"><i class="fa fa-clock-o  fa-4x"></i></div>
											<div class="col-6 text-right p-3">
												<h3>0</h3>
												Total hours worked
											</div>
										</div>

									</div>
								</div>
								<div class="col-12 pl-md-0 pr-md-3 mt-2">
									<div class="card">
										@can('project add-project-members')
										<div class="card-header">Project Members
											<button type="button" id="btnAdd" class="btn btn-default btn-brand btn-elevate btn-icon-sm float-right" data-toggle="modal" data-target="#addMemberModel"><i class="la la-plus"></i>Add Member</button>
										</div>
										@endcan
										<div class="card-body p-0">
											@foreach($members as $member)
											<div class="media border p-1">
												<img src="https://www.w3schools.com/bootstrap4/img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
												<div class="media-body pt-2">
													<h4>{{$member->employee_name_field}} </h4>
													<i>{{$member->jobtitle}}</i>
													<input type="hidden" name="memberId[]" value="{{$member->id}}">
													@can('project delete-project-members')
													<button class="nbutton border float-right mr-2 nbtred removeMember" id="{{$member->project_members_id}}">
														<i class="fa fa-times" aria-hidden="true"></i>
													</button>
													@endcan
													<button class="nbutton border float-right mr-2 nbtgreen">
														<i class="fa fa-envelope" aria-hidden="true"></i>
													</button>

												</div>
											</div>
											@endforeach
										</div>

									</div>
								</div>



								<div class="col-12 pl-md-0 pr-md-3 mt-2">
									<div class="card">
										<div class="card-header">
											Description
										</div>
										<div class="card-body">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-12 p-0">
									<div class="card">
										<div class="card-header">
											Activity
										</div>
										<div class="card-body p-0">


											<div class="media border p-3">
												<img src="https://www.w3schools.com/bootstrap4/img_avatar4.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
												<div class="media-body">
													<h4>John Doe <small><i>Posted on February 19, 2016</i></small></h4>
													<p><span class="badge badge-warning text-white">Update</span> Lorem ipsum...</p>
													<ul>
														<li>Priority: Moved Up</li>
														<li>Status: <span class="throgh"> Progress </span> Todo</li>
													</ul>
												</div>
											</div>
											<div class="media border p-3">
												<img src="https://www.w3schools.com/bootstrap4/img_avatar4.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
												<div class="media-body">
													<h4>John Doe <small><i>Posted on February 19, 2016</i></small></h4>
													<p><span class="badge badge-warning text-white">Update</span> Lorem ipsum...</p>
													<ul>
														<li>Priority: Moved Up</li>
														<li>Status: <span class="throgh"> Progress </span> Todo</li>
													</ul>
												</div>
											</div>
											<div class="media border p-3">
												<img src="https://www.w3schools.com/bootstrap4/img_avatar4.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
												<div class="media-body">
													<h4>John Doe <small><i>Posted on February 19, 2016</i></small></h4>
													<p><span class="badge badge-warning text-white">Update</span> Lorem ipsum...</p>
													<ul>
														<li>Priority: Moved Up</li>
														<li>Status: <span class="throgh"> Progress </span> Todo</li>
													</ul>
												</div>
											</div>
											<div class="media border p-3">
												<img src="https://www.w3schools.com/bootstrap4/img_avatar4.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
												<div class="media-body">
													<h4>John Doe <small><i>Posted on February 19, 2016</i></small></h4>
													<p><span class="badge badge-warning text-white">Update</span> Lorem ipsum...</p>
													<ul>
														<li>Priority: Moved Up</li>
														<li>Status: <span class="throgh"> Progress </span> Todo</li>
													</ul>
												</div>
											</div>




										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
		<!--end::Portlet-->

	</div>

</div>

@endsection
@section('script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{url('/')}}/resources/js/projects/projectFunctions/overview.js" type="text/javascript"></script>

@endsection