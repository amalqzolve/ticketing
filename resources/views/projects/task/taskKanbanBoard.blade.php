@extends('projects.common.layout')
@section('content')
<link href="{{ URL::asset('assets/plugins/custom/kanban/kanban.bundle.css') }}" rel="stylesheet" type="text/css" />


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
                        @can('project add-task')
                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_5"><i class="la la-plus"></i>{{ __('customer.New Record') }}</button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="kt-portlet__body"> -->
        <!-- <div class="kt-portlet__body"> -->

        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-primary nav-tabs-line-2x">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url::to('task-list')}}">
                                <i class="la la-list"></i> List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="{{url::to('task-list-kanaban')}}" role="tab">
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
                    <div class="tab-pane " id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">

                    </div>
                    <div class="tab-pane active" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">
                        <div class="form-group row">
                            <div class="col-lg-1">&nbsp;</div>
                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Project <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 pl-4">
                                        <div class="input-group  input-group-sm">
                                            <select class="form-control kt-selectpicker" id="project_id_filter" name="project_id_filter">
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
                        <!-- <input type="text" id="states" name="states" value="{{ json_encode($taskStates) }}"> -->

                        <div id="myKanban"></div>
                    </div>
                    <div class="tab-pane" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">

                    </div>

                </div>
            </div>
        </div>



        <!-- <button id="addDefault">Add "Default" board</button>
            <br />
            <button id="addToDo">Add element in "To Do" Board</button>
            <br />
            <button id="addToDoAtPosition">Add element in "To Do" Board at position 2</button>
            <br />
            <button id="removeBoard">Remove "Done" Board</button>
            <br />
            <button id="removeElement">Remove "My Task Test"</button> -->
    </div>



</div>
<!-- </div> -->



@endsection
@section('script')
<script src="{{ URL::asset('assets/plugins/custom/kanban/kanban.bundle.js') }}" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/projects/task/listKanaban.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/projects/task/addEdit.js" type="text/javascript"></script>

<script>
    var KanbanTest = new jKanban({
        element: "#myKanban",
        gutter: "10px",
        widthBoard: "450px",
        itemHandleOptions: {
            enabled: true,
        },
        click: function(el) {
            console.log("Trigger on all items click!");
            var task_id = el.dataset.eid;
            loadModel(task_id);
        },
        dropEl: function(el, target, source, sibling) {
            // console.log('ssss'+target.parentElement.getAttribute('data-id'));
            // console.log(el, target, source, sibling)
            saveChanges(el, target, source, sibling);
        },
        boards: {!!json_encode($taskStates) !!}

    });

    function saveChanges(el, target, source, sibling) {
        var task_id = el.dataset.eid;
        var state_id_to = target.parentElement.getAttribute('data-id');
        var state_id_from = source.parentElement.getAttribute('data-id');

        console.log('task_id' + task_id);
        console.log('state_id_to' + state_id_to);
        console.log('state_id_from' + state_id_from);
        $.ajax({
            type: "POST",
            url: "task-sate-change",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                task_id: task_id,
                state_id_from: state_id_from,
                state_id_to: state_id_to,
            },
            success: function(data) {
                if (data.status == 1) {
                    console.log('changed');
                } else {
                    alert(data.msg);
                }
            },
            error: function(jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
</script>
@include('projects.task.addTask')
@endsection