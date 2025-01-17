@extends('projects.common.layout')
@section('content')
<link href="{{ URL::asset('assets/plugins/custom/kanban/kanban.bundle.css') }}" rel="stylesheet" type="text/css" />

<link rel=stylesheet href="{{url('public/assets/ganttcart/platform.css')}}" type="text/css">
<link rel=stylesheet href="{{url('public/assets/ganttcart/libs/jquery/dateField/jquery.dateField.css')}}" type="text/css">

<link rel=stylesheet href="{{url('public/assets/ganttcart/gantt.css')}}" type="text/css">
<link rel=stylesheet href="{{url('public/assets/ganttcart/ganttPrint.css')}}" type="text/css" media="print">
<link rel=stylesheet href="{{url('public/assets/ganttcart/libs/jquery/valueSlider/mb.slider.css')}}" type="text/css" media="print">

<style>
    .resEdit {
        padding: 15px;
    }

    .resLine {
        width: 95%;
        padding: 3px;
        margin: 5px;
        border: 1px solid #d0d0d0;
    }

    body {
        overflow: hidden;
    }

    .ganttButtonBar h1 {
        color: #000000;
        font-weight: bold;
        font-size: 28px;
        margin-left: 10px;
    }
</style>

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
                            <a class="nav-link" href="{{url::to('task-list')}}" role="tab">
                                <i class="la la-list"></i> List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url::to('task-list-kanaban')}}" role="tab">
                                <i class="la la-anchor"></i> Kanaban
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="{{url::to('task-list-gantt')}}" role="tab">
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

                    <div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">
                    </div>

                    <div class="tab-pane active" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">

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
                        <div id="workSpace" style="padding:0px; overflow-y:auto; overflow-x:hidden;border:1px solid #e5e5e5;position:relative;margin:0 5px">
                        </div>
                        Under Development
                    </div>

                </div>
            </div>

        </div>





    </div>
</div>



@endsection
@section('script')

<!--  -->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->

<script src="{{url('public/assets/ganttcart/libs/jquery/jquery.livequery.1.1.1.min.js')}}"></script>
<script src="{{url('public/assets/ganttcart/libs/jquery/jquery.timers.js')}}"></script>

<script src="{{url('public/assets/ganttcart/libs/utilities.js')}}"></script>
<script src="{{url('public/assets/ganttcart/libs/forms.js')}}"></script>
<script src="{{url('public/assets/ganttcart/libs/date.js')}}"></script>
<script src="{{url('public/assets/ganttcart/libs/dialogs.js')}}"></script>
<script src="{{url('public/assets/ganttcart/libs/layout.js')}}"></script>
<script src="{{url('public/assets/ganttcart/libs/i18nJs.js')}}"></script>
<script src="{{url('public/assets/ganttcart/libs/jquery/dateField/jquery.dateField.js')}}"></script>
<script src="{{url('public/assets/ganttcart/libs/jquery/JST/jquery.JST.js')}}"></script>
<script src="{{url('public/assets/ganttcart/libs/jquery/valueSlider/jquery.mb.slider.js')}}"></script>

<script type="text/javascript" src="{{url('public/assets/ganttcart/libs/jquery/svg/jquery.svg.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/assets/ganttcart/libs/jquery/svg/jquery.svgdom.1.8.js')}}"></script>


<script src="{{url('public/assets/ganttcart/ganttUtilities.js')}}"></script>
<script src="{{url('public/assets/ganttcart/ganttTask.js')}}"></script>
<script src="{{url('public/assets/ganttcart/ganttDrawerSVG.js')}}"></script>
<script src="{{url('public/assets/ganttcart/ganttZoom.js')}}"></script>
<script src="{{url('public/assets/ganttcart/ganttGridEditor.js')}}"></script>
<script src="{{url('public/assets/ganttcart/ganttMaster.js')}}"></script>

<!--  -->
<script src="{{url('/')}}/resources/js/projects/task/gantt.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/projects/task/addEdit.js" type="text/javascript"></script>
@include('projects.task.addTask')

<script type="text/javascript">
    var ge;
    $(function() {
        var canWrite = true; //this is the default for test purposes

        // here starts gantt initialization
        ge = new GanttMaster();
        ge.set100OnClose = true;

        ge.shrinkParent = true;

        ge.init($("#workSpace"));
        loadI18n(); //overwrite with localized ones

        //in order to force compute the best-fitting zoom level
        delete ge.gantt.zoom;

        // var project = loadFromLocalStorage();

        var project = {!! json_encode($taskStates) !!};

        if (!project.canWrite)
            $(".ganttButtonBar button.requireWrite").attr("disabled", "true");

        ge.loadProject(project);
        ge.checkpoint(); //empty the undo stack

        initializeHistoryManagement(ge.tasks[0].id);
    });


    // GanttMaster.prototype.changeTaskDeps = function(task) {
    //     console.log('changeTaskDeps');
    // };

    // GanttMaster.prototype.changeTaskDates = function(task, start, end) {
    //     console.debug("changeTaskDates", task, start, end)
    // };


    // GanttMaster.prototype.moveTask = function(task, newStart) {
    //     console.log('moveTask');
    // };



    function getDemoProject() {
        //console.debug("getDemoProject")
        ret = 'aaa';


        //actualize data
        // var offset = new Date().getTime() - ret.tasks[0].start;
        // for (var i = 0; i < ret.tasks.length; i++) {
        //     ret.tasks[i].start = ret.tasks[i].start + offset;
        // }
        return ret;
    }



    function loadGanttFromServer(taskId, callback) {

        //this is a simulation: load data from the local storage if you have already played with the demo or a textarea with starting demo data
        var ret = loadFromLocalStorage();

        //this is the real implementation
        /*
      //var taskId = $("#taskSelector").val();
      var prof = new Profiler("loadServerSide");
      prof.reset();
    
      $.getJSON("ganttAjaxController.jsp", {CM:"LOADPROJECT",taskId:taskId}, function(response) {
        //console.debug(response);
        if (response.ok) {
          prof.stop();
    
          ge.loadProject(response.project);
          ge.checkpoint(); //empty the undo stack
    
          if (typeof(callback)=="function") {
            callback(response);
          }
        } else {
          jsonErrorHandling(response);
        }
      });
      */

        return ret;
    }

    function upload(uploadedFile) {
        var fileread = new FileReader();

        fileread.onload = function(e) {
            var content = e.target.result;
            var intern = JSON.parse(content); // Array of Objects.
            //console.log(intern); // You can index every object

            ge.loadProject(intern);
            ge.checkpoint(); //empty the undo stack

        };

        fileread.readAsText(uploadedFile);
    }

    function saveGanttOnServer() {

        //this is a simulation: save data to the local storage or to the textarea
        //saveInLocalStorage();

        var prj = ge.saveProject();

        download(JSON.stringify(prj, null, '\t'), "MyProject.json", "application/json");

        /*
    
      delete prj.resources;
      delete prj.roles;
    
      var prof = new Profiler("saveServerSide");
      prof.reset();
    
      if (ge.deletedTaskIds.length>0) {
        if (!confirm("TASK_THAT_WILL_BE_REMOVED\n"+ge.deletedTaskIds.length)) {
          return;
        }
      }
    
      $.ajax("ganttAjaxController.jsp", {
        dataType:"json",
        data: {CM:"SVPROJECT",prj:JSON.stringify(prj)},
        type:"POST",
    
        success: function(response) {
          if (response.ok) {
            prof.stop();
            if (response.project) {
              ge.loadProject(response.project); //must reload as "tmp_" ids are now the good ones
            } else {
              ge.reset();
            }
          } else {
            var errMsg="Errors saving project\n";
            if (response.message) {
              errMsg=errMsg+response.message+"\n";
            }
    
            if (response.errorMessages.length) {
              errMsg += response.errorMessages.join("\n");
            }
    
            alert(errMsg);
          }
        }
    
      });
      */
    }

    // Function to download data to a file
    function download(data, filename, type) {
        var file = new Blob([data], {
            type: type
        });
        if (window.navigator.msSaveOrOpenBlob) // IE10+
            window.navigator.msSaveOrOpenBlob(file, filename);
        else { // Others
            var a = document.createElement("a"),
                url = URL.createObjectURL(file);
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            setTimeout(function() {
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            }, 0);
        }
    }

    function newProject() {
        clearGantt();
    }


    function clearGantt() {
        ge.reset();
    }

    //-------------------------------------------  Get project file as JSON (used for migrate project from gantt to Teamwork) ------------------------------------------------------
    function getFile() {
        $("#gimBaPrj").val(JSON.stringify(ge.saveProject()));
        $("#gimmeBack").submit();
        $("#gimBaPrj").val("");

        /*  var uriContent = "data:text/html;charset=utf-8," + encodeURIComponent(JSON.stringify(prj));
         neww=window.open(uriContent,"dl");*/
    }


    function loadFromLocalStorage() {
        var ret;
        // if (localStorage) {
        //     if (localStorage.getObject("teamworkGantDemo")) {
        //         ret = localStorage.getObject("teamworkGantDemo");
        //     }
        // }

        //if not found create a new example task
        if (!ret || !ret.tasks || ret.tasks.length == 0) {
            console.log('aSASD');
            ret = getDemoProject();
        }
        return ret;
    }


    function saveInLocalStorage() {
        var prj = ge.saveProject();

        if (localStorage) {
            localStorage.setObject("teamworkGantDemo", prj);
        }
    }


    //-------------------------------------------  Open a black popup for managing resources. This is only an axample of implementation (usually resources come from server) ------------------------------------------------------
    function editResources() {

        //make resource editor
        var resourceEditor = $.JST.createFromTemplate({}, "RESOURCE_EDITOR");
        var resTbl = resourceEditor.find("#resourcesTable");

        for (var i = 0; i < ge.resources.length; i++) {
            var res = ge.resources[i];
            resTbl.append($.JST.createFromTemplate(res, "RESOURCE_ROW"))
        }


        //bind add resource
        resourceEditor.find("#addResource").click(function() {
            resTbl.append($.JST.createFromTemplate({
                id: "new",
                name: "resource"
            }, "RESOURCE_ROW"))
        });

        //bind save event
        resourceEditor.find("#resSaveButton").click(function() {
            var newRes = [];
            //find for deleted res
            for (var i = 0; i < ge.resources.length; i++) {
                var res = ge.resources[i];
                var row = resourceEditor.find("[resId=" + res.id + "]");
                if (row.length > 0) {
                    //if still there save it
                    var name = row.find("input[name]").val();
                    if (name && name != "")
                        res.name = name;
                    newRes.push(res);
                } else {
                    //remove assignments
                    for (var j = 0; j < ge.tasks.length; j++) {
                        var task = ge.tasks[j];
                        var newAss = [];
                        for (var k = 0; k < task.assigs.length; k++) {
                            var ass = task.assigs[k];
                            if (ass.resourceId != res.id)
                                newAss.push(ass);
                        }
                        task.assigs = newAss;
                    }
                }
            }

            //loop on new rows
            var cnt = 0
            resourceEditor.find("[resId=new]").each(function() {
                cnt++;
                var row = $(this);
                var name = row.find("input[name]").val();
                if (name && name != "")
                    newRes.push(new Resource("tmp_" + new Date().getTime() + "_" + cnt, name));
            });

            ge.resources = newRes;

            closeBlackPopup();
            ge.redraw();
        });


        var ndo = createModalPopup(400, 500).append(resourceEditor);
    }

    function initializeHistoryManagement(taskId) {

        //retrieve from server the list of history points in millisecond that represent the instant when the data has been recorded
        //response: {ok:true, historyPoints: [1498168800000, 1498600800000, 1498687200000, 1501538400000, …]}
        $.getJSON(contextPath + "/applications/teamwork/task/taskAjaxController.jsp", {
            CM: "GETGANTTHISTPOINTS",
            OBJID: taskId
        }, function(response) {

            //if there are history points
            if (response.ok == true && response.historyPoints && response.historyPoints.length > 0) {

                //add show slider button on button bar
                var histBtn = $("<button>").addClass("button textual icon lreq30 lreqLabel").attr("title", "SHOW_HISTORY").append("<span class=\"teamworkIcon\">&#x60;</span>");

                //clicking it
                histBtn.click(function() {
                    var el = $(this);
                    var ganttButtons = $(".ganttButtonBar .buttons");

                    //is it already on?
                    if (!ge.element.is(".historyOn")) {
                        ge.element.addClass("historyOn");
                        ganttButtons.find(".requireCanWrite").hide();

                        //load the history points from server again
                        showSavingMessage();
                        $.getJSON(contextPath + "/applications/teamwork/task/taskAjaxController.jsp", {
                            CM: "GETGANTTHISTPOINTS",
                            OBJID: ge.tasks[0].id
                        }, function(response) {
                            jsonResponseHandling(response);
                            hideSavingMessage();
                            if (response.ok == true) {
                                var dh = response.historyPoints;
                                if (dh && dh.length > 0) {
                                    //si crea il div per lo slider
                                    var sliderDiv = $("<div>").prop("id", "slider").addClass("lreq30 lreqHide").css({
                                        "display": "inline-block",
                                        "width": "500px"
                                    });
                                    ganttButtons.append(sliderDiv);

                                    var minVal = 0;
                                    var maxVal = dh.length - 1;

                                    $("#slider").show().mbSlider({
                                        rangeColor: '#2f97c6',
                                        minVal: minVal,
                                        maxVal: maxVal,
                                        startAt: maxVal,
                                        showVal: false,
                                        grid: 1,
                                        formatValue: function(val) {
                                            return new Date(dh[val]).format();
                                        },
                                        onSlideLoad: function(obj) {
                                            this.onStop(obj);

                                        },
                                        onStart: function(obj) {},
                                        onStop: function(obj) {
                                            var val = $(obj).mbgetVal();
                                            showSavingMessage();
                                            /**
                                             * load the data history for that milliseconf from server
                                             * response in this format {ok: true, baselines: {...}}
                                             *
                                             * baselines: {61707: {duration:1,endDate:1550271599998,id:61707,progress:40,startDate:1550185200000,status:"STATUS_WAITING",taskId:"3055"},
                                             *            {taskId:{duration:in days,endDate:in millis,id:history record id,progress:in percent,startDate:in millis,status:task status,taskId:"3055"}....}}                     */

                                            $.getJSON(contextPath + "/applications/teamwork/task/taskAjaxController.jsp", {
                                                CM: "GETGANTTHISTORYAT",
                                                OBJID: ge.tasks[0].id,
                                                millis: dh[val]
                                            }, function(response) {
                                                jsonResponseHandling(response);
                                                hideSavingMessage();
                                                if (response.ok) {
                                                    ge.baselines = response.baselines;
                                                    ge.showBaselines = true;
                                                    ge.baselineMillis = dh[val];
                                                    ge.redraw();
                                                }
                                            })

                                        },
                                        onSlide: function(obj) {
                                            clearTimeout(obj.renderHistory);
                                            var self = this;
                                            obj.renderHistory = setTimeout(function() {
                                                self.onStop(obj);
                                            }, 200)

                                        }
                                    });
                                }
                            }
                        });


                        // closing the history
                    } else {
                        //remove the slider
                        $("#slider").remove();
                        ge.element.removeClass("historyOn");
                        if (ge.permissions.canWrite)
                            ganttButtons.find(".requireCanWrite").show();

                        ge.showBaselines = false;
                        ge.baselineMillis = undefined;
                        ge.redraw();
                    }

                });
                $("#saveGanttButton").before(histBtn);
            }
        })
    }

    function showBaselineInfo(event, element) {
        //alert(element.attr("data-label"));
        $(element).showBalloon(event, $(element).attr("data-label"));
        ge.splitter.secondBox.one("scroll", function() {
            $(element).hideBalloon();
        })
    }

    // ge.changeTaskDates(task, start, end) {
    //     console.log('zddddddddddddddd');
    // }
</script>





<div id="gantEditorTemplates" style="display:none;">
    <div class="__template__" type="GANTBUTTONS">

        <div class="ganttButtonBar noprint">
            <div class="buttons">

                <button onclick="$('#workSpace').trigger('undo.gantt');return false;" class="button textual icon requireCanWrite" title="undo"><span class="teamworkIcon">&#39;</span></button>
                <button onclick="$('#workSpace').trigger('redo.gantt');return false;" class="button textual icon requireCanWrite" title="redo"><span class="teamworkIcon">&middot;</span></button>
                <span class="ganttButtonSeparator requireCanWrite requireCanAdd"></span>
                <button onclick="$('#workSpace').trigger('addAboveCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanAdd" title="insert above"><span class="teamworkIcon">l</span></button>
                <button onclick="$('#workSpace').trigger('addBelowCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanAdd" title="insert below"><span class="teamworkIcon">X</span></button>
                <span class="ganttButtonSeparator requireCanWrite requireCanInOutdent"></span>
                <button onclick="$('#workSpace').trigger('outdentCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanInOutdent" title="un-indent task"><span class="teamworkIcon">.</span></button>
                <button onclick="$('#workSpace').trigger('indentCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanInOutdent" title="indent task"><span class="teamworkIcon">:</span></button>
                <span class="ganttButtonSeparator requireCanWrite requireCanMoveUpDown"></span>
                <button onclick="$('#workSpace').trigger('moveUpCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanMoveUpDown" title="move up"><span class="teamworkIcon">k</span></button>
                <button onclick="$('#workSpace').trigger('moveDownCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanMoveUpDown" title="move down"><span class="teamworkIcon">j</span></button>
                <span class="ganttButtonSeparator requireCanWrite requireCanDelete"></span>
                <button onclick="$('#workSpace').trigger('deleteFocused.gantt');return false;" class="button textual icon delete requireCanWrite" title="Elimina"><span class="teamworkIcon">&cent;</span></button>



                <button onclick="$('#workSpace').trigger('zoomMinus.gantt'); return false;" class="button textual icon " title="zoom out"><span class="teamworkIcon">)</span></button>
                <button onclick="$('#workSpace').trigger('zoomPlus.gantt');return false;" class="button textual icon " title="zoom in"><span class="teamworkIcon">(</span></button>
                <span class="ganttButtonSeparator"></span>
                <button onclick="$('#workSpace').trigger('print.gantt');return false;" class="button textual icon " title="Print"><span class="teamworkIcon">p</span></button>
                <span class="ganttButtonSeparator"></span>
                <button onclick="ge.gantt.showCriticalPath=!ge.gantt.showCriticalPath; ge.redraw();return false;" class="button textual icon requireCanSeeCriticalPath" title="CRITICAL_PATH"><span class="teamworkIcon">&pound;</span></button>
                <span class="ganttButtonSeparator requireCanSeeCriticalPath"></span>
                <button onclick="ge.splitter.resize(.1);return false;" class="button textual icon"><span class="teamworkIcon">F</span></button>
                <button onclick="ge.splitter.resize(50);return false;" class="button textual icon"><span class="teamworkIcon">O</span></button>
                <button onclick="ge.splitter.resize(100);return false;" class="button textual icon"><span class="teamworkIcon">R</span></button>
                <span class="ganttButtonSeparator"></span>
                <button onclick="$('#workSpace').trigger('fullScreen.gantt');return false;" class="button textual icon" title="FULLSCREEN" id="fullscrbtn"><span class="teamworkIcon">@</span></button>
                <button onclick="ge.element.toggleClass('colorByStatus' );return false;" class="button textual icon"><span class="teamworkIcon">&sect;</span></button>

            </div>


        </div>

    </div>

    <div class="__template__" type="TASKSEDITHEAD"><!--
  <table class="gdfTable" cellspacing="0" cellpadding="0">
    <thead>
    <tr style="height:40px">
      <th class="gdfColHeader" style="width:35px; border-right: none"></th>
      <th class="gdfColHeader" style="width:25px;"></th>
      <th class="gdfColHeader gdfResizable" style="width:100px;">code/short name</th>
      <th class="gdfColHeader gdfResizable" style="width:300px;">name</th>
      <th class="gdfColHeader"  align="center" style="width:17px;" title="Start date is a milestone."><span class="teamworkIcon" style="font-size: 8px;">^</span></th>
      <th class="gdfColHeader gdfResizable" style="width:80px;">start</th>
      <th class="gdfColHeader"  align="center" style="width:17px;" title="End date is a milestone."><span class="teamworkIcon" style="font-size: 8px;">^</span></th>
      <th class="gdfColHeader gdfResizable" style="width:80px;">End</th>
      <th class="gdfColHeader gdfResizable" style="width:50px;">dur.</th>
      <th class="gdfColHeader gdfResizable" style="width:20px;">%</th>
      <th class="gdfColHeader gdfResizable requireCanSeeDep" style="width:50px;">depe.</th>
      <th class="gdfColHeader gdfResizable" style="width:1000px; text-align: left; padding-left: 10px;">assignees</th>
    </tr>
    </thead>
  </table>
  --></div>

    <div class="__template__" type="TASKROW"><!--
  <tr id="tid_(#=obj.id#)" taskId="(#=obj.id#)" class="taskEditRow (#=obj.isParent()?'isParent':''#) (#=obj.collapsed?'collapsed':''#)" level="(#=level#)">
    <th class="gdfCell edit" align="right" style="cursor:pointer;"><span class="taskRowIndex">(#=obj.getRow()+1#)</span> <span class="teamworkIcon" style="font-size:12px;" >e</span></th>
    <td class="gdfCell noClip" align="center"><div class="taskStatus cvcColorSquare" status="(#=obj.status#)"></div></td>
    <td class="gdfCell"><input type="text" name="code" value="(#=obj.code?obj.code:''#)" placeholder="code/short name"></td>
    <td class="gdfCell indentCell" style="padding-left:(#=obj.level*10+18#)px;">
      <div class="exp-controller" align="center"></div>
      <input type="text" name="name" value="(#=obj.name#)" placeholder="name">
    </td>
    <td class="gdfCell" align="center"><input type="checkbox" name="startIsMilestone"></td>
    <td class="gdfCell"><input type="text" name="start"  value="" class="date"></td>
    <td class="gdfCell" align="center"><input type="checkbox" name="endIsMilestone"></td>
    <td class="gdfCell"><input type="text" name="end" value="" class="date"></td>
    <td class="gdfCell"><input type="text" name="duration" autocomplete="off" value="(#=obj.duration#)"></td>
    <td class="gdfCell"><input type="text" name="progress" class="validated" entrytype="PERCENTILE" autocomplete="off" value="(#=obj.progress?obj.progress:''#)" (#=obj.progressByWorklog?"readOnly":""#)></td>
    <td class="gdfCell requireCanSeeDep"><input type="text" name="depends" autocomplete="off" value="(#=obj.depends#)" (#=obj.hasExternalDep?"readonly":""#)></td>
    <td class="gdfCell taskAssigs">(#=obj.getAssigsString()#)</td>
  </tr>
  --></div>

    <div class="__template__" type="TASKEMPTYROW"><!--
  <tr class="taskEditRow emptyRow" >
    <th class="gdfCell" align="right"></th>
    <td class="gdfCell noClip" align="center"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell requireCanSeeDep"></td>
    <td class="gdfCell"></td>
  </tr>
  --></div>

    <div class="__template__" type="TASKBAR"><!--
  <div class="taskBox taskBoxDiv" taskId="(#=obj.id#)" >
    <div class="layout (#=obj.hasExternalDep?'extDep':''#)">
      <div class="taskStatus" status="(#=obj.status#)"></div>
      <div class="taskProgress" style="width:(#=obj.progress>100?100:obj.progress#)%; background-color:(#=obj.progress>100?'red':'rgb(153,255,51);'#);"></div>
      <div class="milestone (#=obj.startIsMilestone?'active':''#)" ></div>

      <div class="taskLabel"></div>
      <div class="milestone end (#=obj.endIsMilestone?'active':''#)" ></div>
    </div>
  </div>
  --></div>


    <div class="__template__" type="CHANGE_STATUS"><!--
    <div class="taskStatusBox">
    <div class="taskStatus cvcColorSquare" status="STATUS_ACTIVE" title="Active"></div>
    <div class="taskStatus cvcColorSquare" status="STATUS_DONE" title="Completed"></div>
    <div class="taskStatus cvcColorSquare" status="STATUS_FAILED" title="Failed"></div>
    <div class="taskStatus cvcColorSquare" status="STATUS_SUSPENDED" title="Suspended"></div>
    <div class="taskStatus cvcColorSquare" status="STATUS_WAITING" title="Waiting" style="display: none;"></div>
    <div class="taskStatus cvcColorSquare" status="STATUS_UNDEFINED" title="Undefined"></div>
    </div>
  --></div>




    <div class="__template__" type="TASK_EDITOR"><!--
  <div class="ganttTaskEditor">
    <h2 class="taskData">Task editor</h2>
    <table  cellspacing="1" cellpadding="5" width="100%" class="taskData table" border="0">
          <tr>
        <td width="200" style="height: 80px"  valign="top">
          <label for="code">code/short name</label><br>
          <input type="text" name="code" id="code" value="" size=15 class="formElements" autocomplete='off' maxlength=255 style='width:100%' oldvalue="1">
        </td>
        <td colspan="3" valign="top"><label for="name" class="required">name</label><br><input type="text" name="name" id="name"class="formElements" autocomplete='off' maxlength=255 style='width:100%' value="" required="true" oldvalue="1"></td>
          </tr>


      <tr class="dateRow">
        <td nowrap="">
          <div style="position:relative">
            <label for="start">start</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" id="startIsMilestone" name="startIsMilestone" value="yes"> &nbsp;<label for="startIsMilestone">is milestone</label>&nbsp;
            <br><input type="text" name="start" id="start" size="8" class="formElements dateField validated date" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DATE">
            <span title="calendar" id="starts_inputDate" class="teamworkIcon openCalendar" onclick="$(this).dateField({inputField:$(this).prevAll(':input:first'),isSearchField:false});">m</span>          </div>
        </td>
        <td nowrap="">
          <label for="end">End</label>&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="checkbox" id="endIsMilestone" name="endIsMilestone" value="yes"> &nbsp;<label for="endIsMilestone">is milestone</label>&nbsp;
          <br><input type="text" name="end" id="end" size="8" class="formElements dateField validated date" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DATE">
          <span title="calendar" id="ends_inputDate" class="teamworkIcon openCalendar" onclick="$(this).dateField({inputField:$(this).prevAll(':input:first'),isSearchField:false});">m</span>
        </td>
        <td nowrap="" >
          <label for="duration" class=" ">Days</label><br>
          <input type="text" name="duration" id="duration" size="4" class="formElements validated durationdays" title="Duration is in working days." autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DURATIONDAYS">&nbsp;
        </td>
      </tr>

      <tr>
        <td  colspan="2">
          <label for="status" class=" ">status</label><br>
          <select id="status" name="status" class="taskStatus" status="(#=obj.status#)"  onchange="$(this).attr('STATUS',$(this).val());">
            <option value="STATUS_ACTIVE" class="taskStatus" status="STATUS_ACTIVE" >active</option>
            <option value="STATUS_WAITING" class="taskStatus" status="STATUS_WAITING" >suspended</option>
            <option value="STATUS_SUSPENDED" class="taskStatus" status="STATUS_SUSPENDED" >suspended</option>
            <option value="STATUS_DONE" class="taskStatus" status="STATUS_DONE" >completed</option>
            <option value="STATUS_FAILED" class="taskStatus" status="STATUS_FAILED" >failed</option>
            <option value="STATUS_UNDEFINED" class="taskStatus" status="STATUS_UNDEFINED" >undefined</option>
          </select>
        </td>

        <td valign="top" nowrap>
          <label>progress</label><br>
          <input type="text" name="progress" id="progress" size="7" class="formElements validated percentile" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="PERCENTILE">
        </td>
      </tr>

          </tr>
          <tr>
            <td colspan="4">
              <label for="description">Description</label><br>
              <textarea rows="3" cols="30" id="description" name="description" class="formElements" style="width:100%"></textarea>
            </td>
          </tr>
        </table>

    <h2>Assignments</h2>
  <table  cellspacing="1" cellpadding="0" width="100%" id="assigsTable">
    <tr>
      <th style="width:100px;">name</th>
      <th style="width:70px;">Role</th>
      <th style="width:30px;">est.wklg.</th>
      <th style="width:30px;" id="addAssig"><span class="teamworkIcon" style="cursor: pointer">+</span></th>
    </tr>
  </table>

  <div style="text-align: right; padding-top: 20px">
    <span id="saveButton" class="button first" onClick="$(this).trigger('saveFullEditor.gantt');">Save</span>
  </div>

  </div>
  --></div>



    <div class="__template__" type="ASSIGNMENT_ROW"><!--
  <tr taskId="(#=obj.task.id#)" assId="(#=obj.assig.id#)" class="assigEditRow" >
    <td ><select name="resourceId"  class="formElements" (#=obj.assig.id.indexOf("tmp_")==0?"":"disabled"#) ></select></td>
    <td ><select type="select" name="roleId"  class="formElements"></select></td>
    <td ><input type="text" name="effort" value="(#=getMillisInHoursMinutes(obj.assig.effort)#)" size="5" class="formElements"></td>
    <td align="center"><span class="teamworkIcon delAssig del" style="cursor: pointer">d</span></td>
  </tr>
  --></div>



    <div class="__template__" type="RESOURCE_EDITOR"><!--
  <div class="resourceEditor" style="padding: 5px;">

    <h2>Project team</h2>
    <table  cellspacing="1" cellpadding="0" width="100%" id="resourcesTable">
      <tr>
        <th style="width:100px;">name</th>
        <th style="width:30px;" id="addResource"><span class="teamworkIcon" style="cursor: pointer">+</span></th>
      </tr>
    </table>

    <div style="text-align: right; padding-top: 20px"><button id="resSaveButton" class="button big">Save</button></div>
  </div>
  --></div>



    <div class="__template__" type="RESOURCE_ROW"><!--
  <tr resId="(#=obj.id#)" class="resRow" >
    <td ><input type="text" name="name" value="(#=obj.name#)" style="width:100%;" class="formElements"></td>
    <td align="center"><span class="teamworkIcon delRes del" style="cursor: pointer">d</span></td>
  </tr>
  -->
    </div>


</div>
<script type="text/javascript">
    $.JST.loadDecorator("RESOURCE_ROW", function(resTr, res) {
        resTr.find(".delRes").click(function() {
            $(this).closest("tr").remove()
        });
    });

    $.JST.loadDecorator("ASSIGNMENT_ROW", function(assigTr, taskAssig) {
        var resEl = assigTr.find("[name=resourceId]");
        var opt = $("<option>");
        resEl.append(opt);
        for (var i = 0; i < taskAssig.task.master.resources.length; i++) {
            var res = taskAssig.task.master.resources[i];
            opt = $("<option>");
            opt.val(res.id).html(res.name);
            if (taskAssig.assig.resourceId == res.id)
                opt.attr("selected", "true");
            resEl.append(opt);
        }
        var roleEl = assigTr.find("[name=roleId]");
        for (var i = 0; i < taskAssig.task.master.roles.length; i++) {
            var role = taskAssig.task.master.roles[i];
            var optr = $("<option>");
            optr.val(role.id).html(role.name);
            if (taskAssig.assig.roleId == role.id)
                optr.attr("selected", "true");
            roleEl.append(optr);
        }

        if (taskAssig.task.master.permissions.canWrite && taskAssig.task.canWrite) {
            assigTr.find(".delAssig").click(function() {
                var tr = $(this).closest("[assId]").fadeOut(200, function() {
                    $(this).remove()
                });
            });
        }

    });


    function loadI18n() {
        GanttMaster.messages = {
            "CANNOT_WRITE": "No permission to change the following task:",
            "CHANGE_OUT_OF_SCOPE": "Project update not possible as you lack rights for updating a parent project.",
            "START_IS_MILESTONE": "Start date is a milestone.",
            "END_IS_MILESTONE": "End date is a milestone.",
            "TASK_HAS_CONSTRAINTS": "Task has constraints.",
            "GANTT_ERROR_DEPENDS_ON_OPEN_TASK": "Error: there is a dependency on an open task.",
            "GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK": "Error: due to a descendant of a closed task.",
            "TASK_HAS_EXTERNAL_DEPS": "This task has external dependencies.",
            "GANNT_ERROR_LOADING_DATA_TASK_REMOVED": "GANNT_ERROR_LOADING_DATA_TASK_REMOVED",
            "CIRCULAR_REFERENCE": "Circular reference.",
            "CANNOT_DEPENDS_ON_ANCESTORS": "Cannot depend on ancestors.",
            "INVALID_DATE_FORMAT": "The data inserted are invalid for the field format.",
            "GANTT_ERROR_LOADING_DATA_TASK_REMOVED": "An error has occurred while loading the data. A task has been trashed.",
            "CANNOT_CLOSE_TASK_IF_OPEN_ISSUE": "Cannot close a task with open issues",
            "TASK_MOVE_INCONSISTENT_LEVEL": "You cannot exchange tasks of different depth.",
            "CANNOT_MOVE_TASK": "CANNOT_MOVE_TASK",
            "PLEASE_SAVE_PROJECT": "PLEASE_SAVE_PROJECT",
            "GANTT_SEMESTER": "Semester",
            "GANTT_SEMESTER_SHORT": "s.",
            "GANTT_QUARTER": "Quarter",
            "GANTT_QUARTER_SHORT": "q.",
            "GANTT_WEEK": "Week",
            "GANTT_WEEK_SHORT": "w."
        };
    }



    function createNewResource(el) {
        var row = el.closest("tr[taskid]");
        var name = row.find("[name=resourceId_txt]").val();
        var url = contextPath + "/applications/teamwork/resource/resourceNew.jsp?CM=ADD&name=" + encodeURI(name);

        openBlackPopup(url, 700, 320, function(response) {
            //fillare lo smart combo
            if (response && response.resId && response.resName) {
                //fillare lo smart combo e chiudere l'editor
                row.find("[name=resourceId]").val(response.resId);
                row.find("[name=resourceId_txt]").val(response.resName).focus().blur();
            }

        });
    }

    $(document).on("change", "#load-file", function() {
        var uploadedFile = $("#load-file").prop("files")[0];
        upload(uploadedFile);
    });
</script>

@endsection