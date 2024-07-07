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
		
		
	</style>

	<script src="https://www.w3schools.com/lib/w3.js"></script>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mb-5">
	<br />
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
	      	<div class="col-md-6">
	      		<h5 class="mt-4">CURRENT CASH BALANCE</h5>
	      		<h1><b>
	      			SR0.00
	      		</b></h1>
	      	</div>
	      	<div class="col-md-6 text-right pt-5">
	      		<p class="mt-5">Last updated: Never</p>
	      	</div>
	      </div>

	      <div class="row">
	      	<div class="col-12">
	      		<div class="col-12 card shadow mb-3">
	      			<div class="card-body">
	      				<div class=" row">
	      					<div class="col-1">
		      					
									<!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 460 460" style="enable-background:new 0 0 460 460;" xml:space="preserve">
									<g id="XMLID_1034_">
										<polygon id="XMLID_1035_" style="fill:#8799B3;" points="210,149.998 230,299.992 440,299.992 440,169.998 	"/>
										<polygon id="XMLID_1036_" style="fill:#A3B1C4;" points="230,39.999 210,169.998 440,169.998 440,40.006 	"/>
										<polygon id="XMLID_1037_" style="fill:#A3B1C4;" points="20,169.998 20,299.992 230,299.992 230,169.998 130,139.998 	"/>
										<polygon id="XMLID_1038_" style="fill:#BEC8D6;" points="20,40.006 20,169.998 230,169.998 230,39.999 	"/>
										<path id="XMLID_1039_" style="fill:#354A67;" d="M230,80.002c49.71,0,90,40.29,90,90c0,49.7-40.29,90-90,90l-20-90L230,80.002z"/>
										<path id="XMLID_1040_" style="fill:#466289;" d="M230,80.002v180c-49.71,0-90-40.3-90-90C140,120.292,180.29,80.002,230,80.002z"/>
										<polygon id="XMLID_1041_" style="fill:#354A67;" points="460,440.002 230,440.002 220,400.002 460,410.002 	"/>
										<polygon id="XMLID_1042_" style="fill:#466289;" points="460,410.002 230,410.002 220,370.002 460,380.002 	"/>
										<polygon id="XMLID_1043_" style="fill:#354A67;" points="460,379.998 230,379.998 220,339.998 460,349.998 	"/>
										<polygon id="XMLID_1044_" style="fill:#466289;" points="460,349.998 230,349.998 220,309.998 460,319.998 	"/>
										<polygon id="XMLID_1045_" style="fill:#466289;" points="230,440.002 0,440.002 0,410.002 115,400.002 230,410.002 	"/>
										<polygon id="XMLID_1046_" style="fill:#6B81A1;" points="230,410.002 0,410.002 0,380.002 115,370.002 230,380.002 	"/>
										<polygon id="XMLID_1047_" style="fill:#466289;" points="230,379.998 0,379.998 0,349.998 115,339.998 230,349.998 	"/>
										<polygon id="XMLID_1048_" style="fill:#6B81A1;" points="230,349.998 0,349.998 0,319.998 230,309.998 	"/>
										<path id="XMLID_1049_" style="fill:#233145;" d="M230,19.998l-20,15l20,15h145.128c9.039,25.57,29.302,45.833,54.872,54.872
											v130.256c-25.57,9.039-45.833,29.302-54.872,54.872H230l-20,15l20,15h230v-300L230,19.998L230,19.998z"/>
										<path id="XMLID_1050_" style="fill:#354A67;" d="M84.872,49.998H230v-30H0v300h230v-30H84.872
											C75.833,264.428,55.57,244.165,30,235.127V104.87C55.57,95.831,75.833,75.568,84.872,49.998z"/>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
								   </svg>

		      				</div>
		      				<div class="col-7">
		      					<h5 class="mt-2"><b>Money in </b>
								this month</h5>

		      				</div>
		      				<div class="col-4 text-right">
		      					<h4 class="mt-2">SR0.00</h4>
		      				</div>
	      				</div>
	      				<div class="row pt-4">
	      					<div class="col-6">
	      						<p>Overdue invoices (0)</p>
	      					</div>
	      					<div class="col-6 text-right">
	      						<p>SR0.00</p>
	      					</div>
	      				</div>
	      				<div class="row">
	      					<div class="col-12 border border-top-0 border-right-0 border-left-0">
	      						<a href="#">View paid invoices</a>
	      					</div>
	      				</div>
	      				<div class="row pt-4">
	      					<div class="col-6">
	      						<p>Open invoices (0))</p>
	      					</div>
	      					<div class="col-6 text-right">
	      						<p>SR0.00</p>
	      					</div>
	      				</div>
	      				<div class="row">
	      					<div class="col-12 border border-top-0 border-right-0 border-left-0">
	      						<a href="#">View paid invoices</a>
	      					</div>
	      				</div>
	      				<div class="row pt-3 pb-3">
	      					<div class="col-12 dropdown ">
	      						<button type="button" class="btn btn-light rounded-pill float-right dropdown-toggle" data-toggle="dropdown">View Reports </button>
	      						<div class="dropdown-menu dropdown-menu-right p-0">
								    <a class="dropdown-item" href="#">Open invoices report</a>
								    <a class="dropdown-item" href="#">Customer balance detail report</a>
								</div>
	      					</div>
	      				</div>
	      				
	      			</div>
	      		</div>


	      		<div class="col-12 card shadow mb-5">
	      			<div class="card-body">
	      				<div class=" row">
	      					<div class="col-1">
		      					
									<!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 460 460" style="enable-background:new 0 0 460 460;" xml:space="preserve">
									<g id="XMLID_1034_">
										<polygon id="XMLID_1035_" style="fill:#8799B3;" points="210,149.998 230,299.992 440,299.992 440,169.998 	"/>
										<polygon id="XMLID_1036_" style="fill:#A3B1C4;" points="230,39.999 210,169.998 440,169.998 440,40.006 	"/>
										<polygon id="XMLID_1037_" style="fill:#A3B1C4;" points="20,169.998 20,299.992 230,299.992 230,169.998 130,139.998 	"/>
										<polygon id="XMLID_1038_" style="fill:#BEC8D6;" points="20,40.006 20,169.998 230,169.998 230,39.999 	"/>
										<path id="XMLID_1039_" style="fill:#354A67;" d="M230,80.002c49.71,0,90,40.29,90,90c0,49.7-40.29,90-90,90l-20-90L230,80.002z"/>
										<path id="XMLID_1040_" style="fill:#466289;" d="M230,80.002v180c-49.71,0-90-40.3-90-90C140,120.292,180.29,80.002,230,80.002z"/>
										<polygon id="XMLID_1041_" style="fill:#354A67;" points="460,440.002 230,440.002 220,400.002 460,410.002 	"/>
										<polygon id="XMLID_1042_" style="fill:#466289;" points="460,410.002 230,410.002 220,370.002 460,380.002 	"/>
										<polygon id="XMLID_1043_" style="fill:#354A67;" points="460,379.998 230,379.998 220,339.998 460,349.998 	"/>
										<polygon id="XMLID_1044_" style="fill:#466289;" points="460,349.998 230,349.998 220,309.998 460,319.998 	"/>
										<polygon id="XMLID_1045_" style="fill:#466289;" points="230,440.002 0,440.002 0,410.002 115,400.002 230,410.002 	"/>
										<polygon id="XMLID_1046_" style="fill:#6B81A1;" points="230,410.002 0,410.002 0,380.002 115,370.002 230,380.002 	"/>
										<polygon id="XMLID_1047_" style="fill:#466289;" points="230,379.998 0,379.998 0,349.998 115,339.998 230,349.998 	"/>
										<polygon id="XMLID_1048_" style="fill:#6B81A1;" points="230,349.998 0,349.998 0,319.998 230,309.998 	"/>
										<path id="XMLID_1049_" style="fill:#233145;" d="M230,19.998l-20,15l20,15h145.128c9.039,25.57,29.302,45.833,54.872,54.872
											v130.256c-25.57,9.039-45.833,29.302-54.872,54.872H230l-20,15l20,15h230v-300L230,19.998L230,19.998z"/>
										<path id="XMLID_1050_" style="fill:#354A67;" d="M84.872,49.998H230v-30H0v300h230v-30H84.872
											C75.833,264.428,55.57,244.165,30,235.127V104.87C55.57,95.831,75.833,75.568,84.872,49.998z"/>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
								   </svg>

		      				</div>
		      				<div class="col-7">
		      					<h5 class="mt-2"><b>Money out </b>
								this month</h5>

		      				</div>
		      				<div class="col-4 text-right">
		      					<h4 class="mt-2">SR0.00</h4>
		      				</div>
	      				</div>
	      				<div class="row pt-4">
	      					<div class="col-6">
	      						<p>Overdue Bills (0)</p>
	      					</div>
	      					<div class="col-6 text-right">
	      						<p>SR0.00</p>
	      					</div>
	      				</div>
	      				<div class="row">
	      					<div class="col-12 border border-top-0 border-right-0 border-left-0">
	      						<a href="#">View paid invoices</a>
	      					</div>
	      				</div>
	      				<div class="row pt-4">
	      					<div class="col-6">
	      						<p>Open Bills (0))</p>
	      					</div>
	      					<div class="col-6 text-right">
	      						<p>SR0.00</p>
	      					</div>
	      				</div>
	      				<div class="row">
	      					<div class="col-12 border border-top-0 border-right-0 border-left-0">
	      						<a href="#">View paid invoices</a>
	      					</div>
	      				</div>
	      				<div class="row pt-3 pb-3">
	      					<div class="col-12 dropdown ">
	      						<button type="button" class="btn btn-light rounded-pill float-right dropdown-toggle" data-toggle="dropdown">View Reports </button>
	      						<div class="dropdown-menu dropdown-menu-right p-0">
								    <a class="dropdown-item" href="#">Expenses by supplier summary report</a>
								    <a class="dropdown-item" href="#">Unpaid bills report</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


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