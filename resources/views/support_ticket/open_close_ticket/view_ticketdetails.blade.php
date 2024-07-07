@extends('support_ticket.common.layout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid  mb-5">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Task info #31
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
            <div class="row border border-top-0 border-left-0 border-right-0">
                <div class="col-md-8">

                    <div class="col-12 p-2">
                        <strong>Sync with google calander</strong>
                    </div>
                    <div class="col-12 p-2">
                        <strong class="pr-2">Project:</strong>
                        <a href="" class="pl-3"> Bhinnek App</a>
                    </div>
                    <div class="col-12 p-2 border border-right-0 border border-left-0 border border-bottom-0">
                        <strong class="pr-2">Checklist:</strong>
                        <a href="" class="pl-3"> 0/0</a>
                    </div>
                    <div class="col-12 pt-2 pl-2 pr-2 pb-3 border border-right-0 border border-left-0 border border-top-0">
                        <ul class="list-group mb-2" id="list1">

                          </ul>
                        <input type="text" class="form-control form-control-sm bg-light" placeholder="Add Item"
                         id="input1">
                        <div class="row mt-3" id="panel1" style="display: none;">
                          <div class="col-12">
                            <button class="btn btn-info btn-sm" id="add1"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Add</button>
                            <button class="btn btn-secondary btn-sm" id="h1"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                          </div>
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <strong>Sub tasks</strong>
                    </div>
                    <div class="col-12 p-2 ">
                        <ul class="list-group mb-2" id="list2">

                        </ul>
                        <input type="text" class="form-control form-control-sm bg-light" placeholder="Create Sub Task"
                        id="input2">
                        <div class="row mt-3"  id="panel2" style="display: none;">
                          <div class="col-12">
                            <button class="btn btn-info btn-sm" id="add2"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Create</button>
                            <button class="btn btn-secondary btn-sm"  id="h2"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                          </div>
                        </div>
                    </div>
                    <div class="col-12 2 pt-2 pl-2 pr-2 pb-3 border border-right-0 border border-left-0 border border-top-0">
                      <div class="dropdown">
                        <button class="btn btn-secondary" style="white-space: nowrap;"  data-toggle="dropdown">
                          Add Dependency
                        </button>
                        <div class="dropdown-menu p-0">
                          <button class="dropdown-item" id="b1">Link 1</button>
                          <button class="dropdown-item" id="b2">Link 2</button>
                        </div>
                      </div>


                      <div class="row mt-3" id="d1" style="display: none">
                        <div class="col-12">
                          <b>Dependency</b>
                          <div class="row col-12 p-3">
                            <b>Blocked By</b>
                            <select class="form-control form-control-sm bg-light" >
                              <optgroup></optgroup>
                              <optgroup></optgroup>
                              <optgroup></optgroup>
                              <optgroup></optgroup>
                            </select>
                          </div>

                        </div>
                      </div>

                      <div class="row mt-3" id="d2" style="display: none">
                        <div class="col-12">
                          <b>Dependency</b>
                          <div class="row col-12 p-3">
                            <b>Blocked</b>
                            <select class="form-control form-control-sm bg-light" >
                              <optgroup></optgroup>
                              <optgroup></optgroup>
                              <optgroup></optgroup>
                              <optgroup></optgroup>
                            </select>
                          </div>

                        </div>
                      </div>


                    </div>
                    <div class="col-12 p-2 ">
                      <div class="media border p-3">
                        <img src="https://www.w3schools.com/bootstrap4/img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:40px;">
                        <div class="media-body">
                            <div class="form-group">
                                <textarea class="form-control bg-light" rows="5" id="comment"></textarea>
                                <div class="col-12 bg-light border pt-2 pb-2">
                                    <button type="button" id="upbtn"
                                    class="btn btn-sm btn-outline-secondary  m-1">
                                        <i class="fa fa-camera-retro" aria-hidden="true"></i> Upload
                                    </button>
                                    <input type="file" name="" id="upld" style="display: none;">

                                    <button type="button" class="btn btn-sm btn-primary float-right"><span style="white-space: nowrap"><i class="fa fa-paper-plane" aria-hidden="true"></i>Send Comment</span></button>

                                </div>
                              </div>
                        </div>
                      </div>

                    </div>

                </div>
                <div class="col-md-4">
                    <div class="media p-3">
                        <img src="https://www.w3schools.com/bootstrap4/img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                        <div class="media-body pt-3">
                          <h4>John Doe</h4>
                            <p>
                                <span class="badge badge-secondary">1</span>
                                <span class="badge badge-warning text-white">New</span>
                            </p>
                        </div>
                      </div>
                      <div class="col-12 pt-2 pb-2">
                        <div class="dropdown">
                          <strong class="pr-2">Milestone:</strong>
                          <a href="#" class="pl-3"  data-toggle="dropdown"> Add Milestone</a>
                          <div class="dropdown-menu p-2">
                            <select class="form-control form-control-sm">
                              <option></option>
                              <option></option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 pt-2 pb-2">
                        <div class="dropdown">
                          <strong class="pr-2">Start date:</strong><a href="" class="pl-3" data-toggle="dropdown"> 10-06-2022</a>
                          <div class="dropdown-menu p-2">
                            <input type="text" name="" id=""  class="form-control form-control-sm kt_datetimepickerr" >
                          </div>
                        </div>
                      </div>
                      <div class="col-12 pt-2 pb-2">
                        <div class="dropdown">
                          <strong class="pr-2">Deadline:</strong><a href="" class="pl-3"  data-toggle="dropdown"> 25-06-2022</a>
                          <div class="dropdown-menu p-2">
                            <input type="text" name="" id=""  class="form-control form-control-sm kt_datetimepickerr" >
                          </div>
                        </div>
                      </div>
                      <div class="col-12 pt-2 pb-2">
                        <div class="dropdown">
                          <strong class="pr-2">Priority:</strong>
                          <a href=""   data-toggle="dropdown" class="pl-3">
                              <span class="badge badge-info text-white rounded-circle" ><i class="fa fa-circle-thin"  aria-hidden="true"></i></span>
                              Critical
                          </a>
                          <div class="dropdown-menu p-2">
                            <select class="form-control form-control-sm">
                              <option value="">Minor</option>
                              <option value="">Major</option>
                              <option value="">Critical</option>
                              <option value="">Blocked</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 pt-2 pb-2">
                        <div class="dropdown">
                            <strong class="pr-2">Label:</strong><a href=""   data-toggle="dropdown" class="pl-3"> Add Label</a>
                            <div class="dropdown-menu  p-2">
                                <input type="text" name="" id=""  class="form-control form-control-sm " >
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <button class="btn btn-primary btn-sm w-100">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-secondary btn-sm w-100">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>

                              </div>
                        </div>
                      </div>
                      <div class="col-12 pt-2 pb-2">
                        <div class="dropdown">
                            <strong class="pr-2">Collaborators:</strong>
                            <a href="" class="pl-3"   data-toggle="dropdown">Add Collaborators</a>
                            <div class="dropdown-menu  p-2">
                                <input type="text" name="" id=""  class="form-control form-control-sm " >
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <button class="btn btn-primary btn-sm w-100">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-secondary btn-sm w-100">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>

                              </div>
                        </div>
                      </div>
                      <div class="col-12 pt-2 pb-2">
                        <button type="button" class="btn btn-success"><i class="fa fa-clock-o" aria-hidden="true"></i> Start Timer</button>
                      </div>
                      <div class="col-12 pt-2 pb-2">
                        <strong class="pr-2">Total time logged:<a href="" class="pl-3">00:00:00</a></strong>
                      </div>
                      <div class="col-12 pt-2 pb-2">
                        <strong class="pr-2">CReminders (Private):</strong>
                        <a href="javascript:void(0)" id="flip" class="pl-3">Add reminder</a>
                        <div class="row mt-3" id="panel" style="display: none;">
                            <div class="col-12 pb-2">
                                <input type="text" name="" id="" placeholder="Title"  class="form-control form-control-sm " >
                            </div>
                            <div class="col-6 pb-2"><input type="text" name="" id="" placeholder="date"  class="form-control form-control-sm kt_datetimepickerr" ></div>
                            <div class="col-6 pb-2">
                                <input type="text" name="" id="" placeholder="time"  class="form-control form-control-sm " >
                            </div>
                            <div class="col-6 pb-2">Repeat
                                <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                            </div>
                            <div class="col-6 pb-2">
                                <input type="checkbox" class="form-check-input" value="">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm w-100">
                                    <i class="fa fa-check" aria-hidden="true"></i> Add
                                </button>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="row mt-5  border border-top-0 border-left-0 border-right-0">
                <div class="col-12 text-center">
                    <b>Activity</b>
                </div>
            </div>
            <div class="row border border-top-0 border-left-0 border-right-0">
                <div class="col-12">
                    <div class="media border border-top-0 border-left-0 border-right-0 p-3">
                        <img src="https://www.w3schools.com/bootstrap4/img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:30px;">
                        <div class="media-body">
                          <h5>John Doe <small>8-06-2022 12:50:51 am</small></h5>
                          <p><span class="badge badge-warning text-white">Updated</span>
                            Task: #20 - Sync with google calander</p>
                            <ul>
                                <li>Start date: 10-06-2022</li>
                            </ul>
                        </div>
                      </div>
                </div>
                <div class="col-12">
                    <div class="media border border-top-0 border-left-0 border-right-0 p-3">
                        <img src="https://www.w3schools.com/bootstrap4/img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:30px;">
                        <div class="media-body">
                          <h5>John Doe <small>8-06-2022 12:50:51 am</small></h5>
                          <p><span class="badge badge-warning text-white">Updated</span>
                            Task: #20 - Sync with google calander</p>
                            <ul>
                                <li>Start date: 10-06-2022</li>
                            </ul>
                        </div>
                      </div>
                </div>
                <div class="col-12">
                    <div class="media border border-top-0 border-left-0 border-right-0 p-3">
                        <img src="https://www.w3schools.com/bootstrap4/img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:30px;">
                        <div class="media-body">
                          <h5>John Doe <small>8-06-2022 12:50:51 am</small></h5>
                          <p><span class="badge badge-warning text-white">Updated</span>
                            Task: #20 - Sync with google calander</p>
                            <ul>
                                <li>Start date: 10-06-2022</li>
                            </ul>
                        </div>
                      </div>
                </div>
                <div class="col-12">
                    <div class="media border border-top-0 border-left-0 border-right-0 p-3">
                        <img src="https://www.w3schools.com/bootstrap4/img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:30px;">
                        <div class="media-body">
                          <h5>John Doe <small>8-06-2022 12:50:51 am</small></h5>
                          <p><span class="badge badge-warning text-white">Updated</span>
                            Task: #20 - Sync with google calander</p>
                            <ul>
                                <li>Start date: 10-06-2022</li>
                            </ul>
                        </div>
                      </div>
                </div>
                <div class="col-12">
                    <div class="media border border-top-0 border-left-0 border-right-0 p-3">
                        <img src="https://www.w3schools.com/bootstrap4/img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:30px;">
                        <div class="media-body">
                          <h5>John Doe <small>8-06-2022 12:50:51 am</small></h5>
                          <p><span class="badge badge-primary text-white">Added</span>
                            Task: #20 - Sync with google calander</p>
                            <ul>
                                <li>Start date: 10-06-2022</li>
                            </ul>
                        </div>
                      </div>
                </div>
            </div>
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
    .uppy-size--md .uppy-Dashboard-inner{
        min-width: 100% !important;
    }

</style>
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/support_ticket/create_ticket.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
      $("#flip").click(function(){
        $("#panel").slideToggle("slow");
      });
      $("#input1").focus(function(){
        $(this).removeClass("border border-danger");
        $("#panel1").slideDown("slow");
      });
      $("#h1").click(function(){
        $("#panel1").slideUp("slow");
      });
      $("#input2").focus(function(){
        $(this).removeClass("border border-danger");
        $("#panel2").slideDown("slow");
      });
      $("#h2").click(function(){
        $("#panel2").slideUp("slow");
      });
      $("#b1").click(function(){
        $("#d2").slideUp("slow");
        $("#d1").slideDown("slow");
      });
      $("#b2").click(function(){
        $("#d1").slideUp("slow");
        $("#d2").slideDown("slow");
      });
      $("#upbtn").click(function(){
        $("#upld").click();
      });
      $("#add1").click(function(){
            $val1=$("#input1").val();
            //alert($val1);
            if ( $val1 !== "") {
                //alert($val1);
                $("#list1").append("<li class='list-group-item'>"+$val1+"\
                    <i class='fa fa-times float-right rem' aria-hidden='true'></i>\
                    </li>");
              $("#input1").val("");
            } else{
                $("#input1").addClass("border border-danger");
            }
        });

        $("#add2").click(function(){
            $val2=$("#input2").val();
            //alert($val1);
            if ( $val2 !== "") {
                //alert($val1);
                $("#list2").append("<li class='list-group-item'>"+$val2+"\
                    <i class='fa fa-times float-right rem' aria-hidden='true'></i>\
                    </li>");

              $("#input2").val("");
            }
            else{
                $("#input2").addClass("border border-danger");
            }
        });

    });

    $(document).on("click",".rem",function() {
            //alert("click");
            $($(this).parents("li")).remove();
        });
 </script>
@endsection
