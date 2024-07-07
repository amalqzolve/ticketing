<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
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
                                            <input type="text" class="form-control" placeholder="{{ __('customer.Title') }} " id="title" name="title" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Description</label>
                                    </div>
                                    <div class="col-md-8 pl-4">
                                        <div class="input-group  input-group-sm">
                                            <input type="text" class="form-control" placeholder="Description" id="description" name="description" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Project <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 pl-4">
                                        <div class="input-group  input-group-sm">
                                            <select class="form-control single-select kt-selectpicker" id="project_id" name="project_id">
                                                <option value="">--select--</option>
                                                @foreach($project as $projects)
                                                <option value="{{$projects->id}}">{{$projects->projectname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Points</label>
                                    </div>
                                    <div class="col-md-8 pl-4">
                                        <div class="input-group  input-group-sm">
                                            <input type="text" class="form-control" placeholder="Points" id="points" name="points" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Milestone </label>
                                    </div>
                                    <div class="col-md-8 pl-4">
                                        <div class="input-group  input-group-sm">
                                            <select class="form-control single-select kt-selectpicker" id="milestone" name="milestone">
                                                <option value="">--select--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Assign to <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 pl-4">
                                        <div class="input-group  input-group-sm">
                                            <select class="form-control single-select kt-selectpicker" id="assign_to" name="assign_to">
                                                <option value="">--select--</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Status <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 pl-4">
                                        <div class="input-group  input-group-sm">
                                            <select class="form-control single-select kt-selectpicker" id="state_id" name="state_id">
                                                <option value="">--select--</option>
                                                @foreach($state as $states)
                                                <option value="{{$states->id}}">{{$states->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Priority</label>
                                    </div>
                                    <div class="col-md-8 pl-4">
                                        <div class="input-group  input-group-sm">
                                            <!-- <input type="text" class="form-control" placeholder="Priority"  autocomplete="off"> -->
                                            <select id="priority" name="priority" class="form-control kt-selectpicker">
                                                <option value="">--sellect--</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Major">Major</option>
                                                <option value="Critical">Critical</option>
                                                <option value="Blocker">Blocker</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Labels</label>
                                    </div>
                                    <div class="col-md-8 pl-4">
                                        <div class="input-group  input-group-sm">
                                            <!-- <input type="text" class="form-control" placeholder="labels" id="labels" name="labels" autocomplete="off"> -->
                                            <select class="form-control single-select kt-selectpicker" id="labels" name="labels[]" multiple="">
                                                @foreach($labels as $labelss)
                                                <option value="{{$labelss->id}}">{{$labelss->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Start date <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 pl-4">
                                        <div class="input-group  input-group-sm">
                                            <input type="text" class="form-control kt_datetimepicker" placeholder="Start date " id="start_date" name="start_date" value="{{date('d-m-Y')}}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Deadline <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 pl-4">
                                        <div class="input-group  input-group-sm">
                                            <input type="text" class="form-control kt_datetimepicker" placeholder="Deadline" id="deadline" name="deadline" value="{{date('d-m-Y')}}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="btnSaveAndNext" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    &nbsp;Save & Next
                </button>
                <button id="btnSaveTask" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
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