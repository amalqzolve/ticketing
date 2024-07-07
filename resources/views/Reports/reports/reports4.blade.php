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
		.active > .mbox
		{
			border-style: solid !important;
    		border-width: 0px 0px 6px 0px !important;
		}
		.jumb
		{
			height: 100px;
		}
		
	</style>

	<script src="https://www.w3schools.com/lib/w3.js"></script>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mb-5">
	<br />
	<div class="container-fluid">
      
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
			 <div class="row p-3 jumb" id="re">
                	


                	<ul class="nav nav-justified w-100">
					  <li class="nav-item">
					    <a class="nav-link pt-0 pb-0 pr-1 pl-1 boxborder active" data-toggle="tab" href="#home">
					    	<div class="col-12 bg-info text-white pt-2 mbox" style="border-color: #438893">
	                			<h3 class="m-0">SR0</h3>
	                			<p class="pb-2 mb-0">0 ESTIMATE</p>
	                		</div>
					    </a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link pt-0 pb-0 pr-1 pl-1 boxborder" data-toggle="tab" href="#menu1">
					    	<div class="col-12 bg-warning text-white pt-2 mbox" style="border-color: #a59051">
	                			<h3 class="m-0">SR0</h3>
	                			<p class="pb-2 mb-0">0 ESTIMATE</p>
	                		</div>
					    </a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link pt-0 pb-0 pr-1 pl-1 boxborder" data-toggle="tab" href="#menu2">
					    	<div class="col-12 bg-secondary text-white pt-2 mbox" style="border-color: #404549">
	                			<h3 class="m-0">SR0</h3>
	                			<p class="pb-2 mb-0">0 ESTIMATE</p>
	                		</div>
					    </a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link pt-0 pb-0 pr-1 pl-1 boxborder" data-toggle="tab" href="#menu2">
					    	<div class="col-12 bg-primary text-white pt-2 mbox" style="border-color: #305276">
	                			<h3 class="m-0">SR0</h3>
	                			<p class="pb-2 mb-0">0 ESTIMATE</p>
	                		</div>
					    </a>
					  </li>
					</ul>
                


                </div>
                <div class="row  tab-content pb-5">
						  <div class="tab-pane col-12 active" id="home">
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
						  <div class="tab-pane col-12 fade" id="menu1">FWER4T</div>
						  <div class="tab-pane col-12 fade" id="menu2">FRETRE</div>
						
                	
                </div>
                
		</div>


	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script> 
	$(document).ready(function(){
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