@extends('Reports.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/crm/datatables/datatables.bundle.css" rel="stylesheet"
	type="text/css" />
 		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<style type="text/css">
		body {
		    background: #f2f3f8;
		}
		.boxborder >div
		{
			border-style: solid;
    		border-width: 0px 0px 0px 0px;
		}
		.boxborder:hover >div
		{
			border-style: solid;
    		border-width: 0px 0px 6px 0px;
		}
		.jumb
		{
			height: 80px;
		}
		
	</style>

	<script src="https://www.w3schools.com/lib/w3.js"></script>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mb-5">
	<br />
	<div class="container-fluid">
        <div class="jumbotron jumbotron-fluid p-4 mb-0" id="slide">
            <div class="container-fluid">
                <div class="row  jumb">
                	<div class="col-md-3 p-1 ">
                		
                		<a href="" class="boxborder" id="mbox" mboxdata="This is Test 1">
	                		<div class="col-12 bg-info text-white pt-2 " style="border-color: #438893">
	                			<h3 class="m-0">SR0</h3>
	                			<p class="pb-2 mb-0">0 ESTIMATE</p>
	                		</div>
                		</a>
                		               		
                	</div>
                	<div class="col-md-3 p-1">
                		
                		<a href="" class="boxborder" id="mbox" mboxdata="This is Test 2">
	                		<div class="col-12 bg-warning text-white pt-2" style="border-color: #a59051">
	                			<h3 class="m-0">SR0</h3>
	                			<p class="pb-2 mb-0">0 ESTIMATE</p>
	                		</div>
	                	</a>
                	</div>
                	<div class="col-md-3 p-1">
                		
                		<a href="" class="boxborder" id="mbox" mboxdata="This is Test 3">
	                		<div class="col-12 bg-secondary text-white pt-2" style="border-color: #404549">
	                			<h3 class="m-0">SR0</h3>
	                			<p class="pb-2 mb-0">0 ESTIMATE</p>
	                		</div>
	                	</a>
                	</div>
                	<div class="col-md-3 p-1">
                		
                		<a href="" class="boxborder" id="mbox" mboxdata="This is Test 4">
	                		<div class="col-12 bg-primary text-white pt-2" style="border-color: #305276">
	                			<h3 class="m-0">SR0</h3>
	                			<p class="pb-2 mb-0">0 ESTIMATE</p>
	                		</div>
	                	</a>
                	</div>

                


                </div>
                <div class="row">
                	<div class="col-md-12">
                		<p id="mdataview">
	                		Unbilled Last 365 Days
	                	</p>
                	</div>
                </div>
               
                
            </div>
        </div>
	<div class="kt-portlet kt-portlet--mobile">
		<!-- <div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Report 1
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						
							
						<div class="dropdown dropdown-inline">
							
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
									class="la la-download"></i>{{ __('customer.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span
											class="kt-nav__section-text">@lang('app.Choose an option')</span>
									</li>
									<li class="kt-nav__item" id="departmentdetails_list_print"> <span href="#"
											class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">@lang('app.Print')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="departmentdetails_list_copy"> <span class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">@lang('app.Copy')</span>
										</span>
									</li>
									<li class="kt-nav__item" id="departmentdetails_list_csv">
										<a href="#" class="kt-nav__link"> <i
												class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="departmentdetails_list_pdf"> <span class="kt-nav__link">
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
		<div class="kt-portlet__body">
			
		</div> -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 mb-5">
					<button class="btn btn-light col-1 float-right" id="slider">
						<i class="fa fa-caret-down" aria-hidden="true"></i>
					</button>
				</div>
			</div>
			<div class="row">
				<div class="col-12 mb-5">
					<table id="myTable"  class="table table-striped">
							 	<thead>
								  <tr>
								    <th>Id</th>
								    <th>Title</th>
								    <th>Content</th>
								  </tr>
								</thead>
							  
					</table>
				</div>
			</div>
		</div>


	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script> 
	$(document).ready(function(){
	  $("#slider").click(function(){
	    $("#slide").slideToggle("slow");
	  });

	  $.ajax({
	  		url:"https://jsonplaceholder.typicode.com/posts",
	  		method:"get",
	  		datatype:"json",
	  		success:function(responce){
		      $('#myTable').DataTable({
		      	data:responce,
		      	scrollX: true,
		      	columns:[
		      		{"data":"id"},
		      		{"data":"title"},
		      		{"data":"body"}
		      	]
		      });
		    }
	  	});	 
	});

	$(document).on("mouseenter","#mbox",function() {
	    $mdata= $(this).attr("mboxdata");
	   //alert($mdata);
	   $("#mdataview").text($mdata);
	});
</script>

<style type="text/css">
	.hideButton {
		display: none
	}

	.error {
		color: red
	}
</style>
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<!-- <script src="{{url('/')}}/resources/js/resourcemanagement/department.js" type="text/javascript"></script> -->
@endsection