@extends('projects.common.layout')
@section('content')
<style>
    .navatar {
        width: 60px;
        height: 60px;
        display: block;
        background-color: gray;
        background-size: cover;
    }

    .navatar2 {
        width: 45px;
        height: 45px;
        display: block;
        background-color: gray;
        background-size: cover;
    }
</style>
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
                            <a class="nav-link " href="{{URL::to('project-notes',$projectId)}}" role="tab">
                                <i class="la la-file-text"></i>Notes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{URL::to('project-files',$projectId)}}" role="tab">
                                <i class="la la-files-o"></i>Files
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="{{URL::to('project-comments',$projectId)}}" role="tab">
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
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">

                    <div class="tab-pane active" role="tabpanel">
                        <input type="hidden" name="project_id" id="project_id" value="{{$project->id}}">
                        <!--Commenting  Section -->
                        @can('project post-project-main-comment')
                        <div class="media border p-3">
                            <div class="mr-3 mt-3 rounded-circle navatar" style="background-image: url('{{url::to('public')}}/{{Auth::user()->image}}');"></div>
                            <div class="media-body">
                                <form action="" id="data-from-main-comment">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="5" id="comment" name="comment" maxlength="500" placeholder="Write a comment...."></textarea>
                                        <div class="col-12 p-2 border" id="div">
                                            <input type="hidden" name="projectCommentFileData" id="projectCommentFileData" value="" />

                                            <div class="row">
                                                <div class="col-10">

                                                    <div id="Uppy">
                                                    </div>

                                                </div>
                                                <div class="col-2">
                                                    <button type="button" id="btnPostMainComment" class="btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                        </svg>
                                                        &nbsp;Post Comment
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="UppyProgressBar"></div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        @endcan
                        <!--Commenting  Section -->
                        <!--Comment  List -->
                        @foreach ($projectComments as $key => $value)
                        <div class="media border p-3 grp" id="">
                            @if($value->image!='')
                            <div class="mr-3 mt-3 rounded-circle navatar" style="background-image: url('{{url::to('public')}}/{{$value->image}}');"></div>
                            @else
                            <div class="mr-3 mt-3 rounded-circle navatar" style="background-image: url('https://www.w3schools.com/bootstrap4/img_avatar4.png');"></div>
                            @endif
                            <div class="media-body">
                                @can('project delete-project-main-comment')
                                <div class="float-right dropdown " id="div">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item commentTrash" href="#" id="{{$value->id}}">Delete</a>
                                    </div>
                                </div>
                                @endcan

                                <h4>{{$value->name}} <small><i>{{ \Carbon\Carbon::parse($value->entry_date)->format('d M ,Y h:i:s a') }}</i></small></h4>
                                <p>{{$value->comment}}</p>
                                @if($value->file_path != '')
                                <img src="{{url::to('public/project_comment_files',$project->id)}}/{{$value->file_path}}" style="width: 25%;" />
                                @endif
                                <div class="col-12 pt-2">
                                    @can('project post-project-replay-comment')
                                    <button class="btn btn-light btn-sm rply" id="rply"><i class="fa fa-reply" aria-hidden="true"></i> Replay</button>
                                    @endcan
                                    @if(count($value->sub_comments)>=1)
                                    <button type="button" id="btn_{{$value->id}}" data-id="{{$value->id}}" class="btn btn-light btn-sm vcmt"><i class="fa fa-comment" aria-hidden="true"></i> View {{count($value->sub_comments)}} Comment</button>
                                    @endif
                                </div>

                                <div class="media p-3">

                                </div>
                                <span style="display: none;">
                                    @foreach($value->sub_comments as $key => $subComments)
                                    <div class="media p-3">
                                        @if($subComments->image!='')
                                        <div class="mr-3 mt-3 rounded-circle navatar2" style="background-image: url('{{url::to('public')}}/{{$subComments->image}}');"></div>
                                        @else
                                        <div class="mr-3 mt-3 rounded-circle navatar2" style="background-image: url('https://www.w3schools.com/bootstrap4/img_avatar3.png');"></div>
                                        @endif
                                        <div class="media-body">
                                            @can('project delete-project-replay-comment')
                                            <div class="float-right dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item subCommentTrash" href="#" id="{{$subComments->id}}">Delete</a>
                                                </div>
                                            </div>
                                            @endcan
                                            <h4>{{$subComments->name}} <small><i> {{ \Carbon\Carbon::parse($subComments->entry_date)->format('d M ,Y h:i:s a') }}</i></small></h4>
                                            <p>{{$subComments->sub_comment}}</p>
                                            @if($subComments->sub_file_path != '')
                                            <img src="{{url::to('public/project_sub_comment_files',$project->id)}}/{{$subComments->sub_file_path}}" style="width: 25%;" />
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </span>
                                <div class="media p-3 cmnt" style="display:none;" id="3">

                                    <div class="mr-3 mt-3 rounded-circle navatar2" style="background-image: url('https://www.w3schools.com/bootstrap4/img_avatar3.png');"></div>
                                    <div class="media-body">
                                        <div class="form-group">
                                            <form action="{{url::to('public')}}" method="POST">
                                                <input type="hidden" id="comment_id" name="comment_id" value="{{$value->id}}">
                                                <input type="hidden" name="sub_file_path" value="">
                                                <textarea class="form-control sub_comment" name="sub_comment" rows="5" placeholder="Write a comment...."></textarea>
                                                <div class="col-12 p-2 border">
                                                    <input type="file" name="replayFiles" hidden>
                                                    <button type="button" class="btn btn-light btn-sm rounded myfile"><i class="fa fa-camera" aria-hidden="true"></i> Upload File</button>
                                                    <button type="button" class="btn btn-brand float-right kt-spinner--left kt-spinner--sm kt-spinner--light btnPostSubComment">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                        </svg>
                                                        &nbsp;Post Replay
                                                    </button>
                                                    <div class="col-12" id="progress"></div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- </div> -->
                        </div>
                        @endforeach
                        <!--Comment  List -->
                    </div>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>

</div>


@endsection
@section('script')
<script src="{{url('/')}}/resources/js/projects/projectFunctions/comments.js" type="text/javascript"></script>
@endsection