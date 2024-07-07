@extends('projects.common.layout')
@section('content')
<link src="{{ URL::asset('assets/datatables/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/plugins/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">Tasks</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">

						<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_5"><i class="la la-plus"></i>{{ __('customer.New Record') }}</button>
						<div class="dropdown dropdown-inline">
							@can('project add-task')
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>{{ __('customer.Export') }}</button>
							@endcan
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="labels_details_list_print"> <span href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="labels_details_list_copy"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('app.Copy')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="labels_details_list_csv">
										<a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="labels_details_list_pdf"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">@lang('app.PDF')</span>
										</span>
									</li>
								</ul>
							</div>
						</div>

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
							<a class="nav-link active" data-toggle="tab" href="{{url::to('task-list')}}" role="tab">
								<i class="la la-list"></i> List
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{url::to('task-list-kanaban')}}">
								<i class="la la-anchor"></i> Kanaban
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{url::to('task-list-gantt')}}" role="tab">
								<i class="la la-check-circle-o"></i>Gantt
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="kt-portlet__body">
				<div class="tab-content">
					<div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">

						<div class="form-group row">
							<div class="col-lg-1">&nbsp;</div>
							<div class="col-lg-6">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>Project <span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 pl-4">
										<div class="input-group  input-group-sm">
											<select class="form-control single-select kt-selectpicker" id="project_id_filter" name="project_id_filter">
												<option value="">--select--</option>
												@foreach($project as $projects)
												<option value="{{$projects->id}}">{{$projects->projectname}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group row pr-md-3">
									<button id="btnViewTask" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
										<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
											<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
											<polyline points="22 4 12 14.01 9 11.01"></polyline>
										</svg>
										&nbsp;View
									</button>
								</div>
							</div>
						</div>

						<table class="table table-striped  table-hover table-checkable" id="taskTbl">
							<thead>
								<tr>
									<th>{{ __('customer.Sl. No') }}</th>
									<th>Tittle</th>
									<th>Start Date</th>
									<th>Deadline</th>
									<th>Milestone</th>
									<th>Project</th>
									<th>Asigned To</th>
									<th>Collaborator</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

							</tbody>

						</table>
					</div>
					<div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">

					</div>
					<div class="tab-pane" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">

					</div>
					<div class="tab-pane" id="kt_portlet_base_demo_1_4_tab_content" role="tabpanel">

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
<script src="{{url('/')}}/resources/js/projects/task/list.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/projects/task/addEdit.js" type="text/javascript"></script>
@include('projects.task.addTask')
@endsection