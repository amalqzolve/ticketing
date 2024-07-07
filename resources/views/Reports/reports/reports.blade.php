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
		.height
		{
			height: 70vh;
			overflow-y: scroll;
		}
		.list-group-item > a > i
		{
			visibility: hidden;
		}
		.list-group-item > a:hover > i
		{
			visibility: visible;
		}
		.change
		{
			color: gray;
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
	        <div class="row pt-3 pb-3  shadow">
	            <div class="col-md-6">
	                <h3>Reports</h3>
	            </div>
	            <div class="col-md-6">
	                <div class="col-md-12 col-sm-6 col-xs-12 float-right form-group row">
	                    <div class="col-4">
	                    	<label>Search Report</label>
	                    </div>
	                    <div class="col-8 pl-0">

	                    	<input type="text" class="form-control form-control-sm" oninput="w3.filterHTML('#newid', 'span.border', this.value)" />
	                    </div>

	                </div>
	            </div>
	        </div>
	        <div class="row ">
	            <div class="col-12 border border-top-0 border-left-0 border-right-0 shadow">
<!-- 	                <ul class="nav nav-tabs">
	                    <li class="nav-item">
	                      <a class="nav-link active" data-toggle="tab" href="#home">
	                        <strong>Standard</strong>
	                      </a>
	                    </li>
	                    <li class="nav-item">
	                      <a class="nav-link" data-toggle="tab" href="#menu1">
	                        <strong>Custom reports</strong>
	                      </a>
	                    </li>
	                    <li class="nav-item">
	                      <a class="nav-link" data-toggle="tab" href="#menu2">
	                        <strong>Management reports</strong>
	                      </a>
	                    </li>
	                  </ul> -->
	            </div>
	        </div>
	        <div class="row pt-3 mb-5   height" id="newid">
		        <div class="col-12 mt-3 ">
		        	<div class="col-md-12">
		            <div class="col-12 card ">
		            	<a href="#l1" data-toggle="collapse" class="change">
		            		<div class="col-12 pt-3 pb-3" >
				                <i class="fa fa-caret-down mr-1" aria-hidden="true"></i> Favourites
				             </div>
			         	</a>
			             <div class="col-12 collapse show" id="l1">
			             	<div class="list-group pb-4">
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Accounts receivable ageing summary <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							   <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Balance Sheet <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Customer Contact List <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Profit and Loss <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							</div>
			             </div>
		            </div>
		          </div>

		        </div>


		         <div class="col-12 mt-3 ">
		        	<div class="col-md-12">
		            <div class="col-12 card ">
		            	<a href="#l2" data-toggle="collapse"  class="change">
			            	<div class="col-12 pt-3 pb-3">
				                <i class="fa fa-caret-down mr-1" aria-hidden="true"></i> Business overview
				             </div>
				         </a>
			             <div class="col-12 collapse show" id="l2">
			             	<div class="list-group pb-4">
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Audit Log <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							   <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Balance Sheet Comparison <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Balance Sheet Detail <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Balance Sheet <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Profit and Loss as % of total income <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Profit and Loss Comparison <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Profit and Loss year-to-date comparison <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							</div>
			             </div>
		            </div>
		          </div>

		        </div>


		        <div class="col-12 mt-3 ">
		        	<div class="col-md-12">
		            <div class="col-12 card ">
		            	<a href="#l3" data-toggle="collapse"  class="change">
			            	<div class="col-12 pt-3 pb-3">
				                <i class="fa fa-caret-down mr-1" aria-hidden="true"></i> Who owes you
				             </div>
				         </a>
			             <div class="col-12 collapse show" id="l3">
			             	<div class="list-group pb-4">
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Accounts receivable ageing summary <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							   <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Collections Report <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Customer Balance Summary <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Invoice List <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Open Invoices <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Statement List <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							</div>
			             </div>
		            </div>
		          </div>

		        </div>

		        <div class="col-12 mt-3 ">
		        	<div class="col-md-12">
		            <div class="col-12 card ">
		            	<a href="#l4" data-toggle="collapse"  class="change">
			            	<div class="col-12 pt-3 pb-3">
				                <i class="fa fa-caret-down mr-1" aria-hidden="true"></i> Sales and customers
				             </div>
				         </a>
			             <div class="col-12 collapse show" id="l4">
			             	<div class="list-group pb-4">
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Customer Contact List <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							   <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Deposit Detail <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Estimates by Customer <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Product/Service List <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Sales by Customer Summary <i class="fa fa-question-circle-o" aria-hidden="true"></i> </a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Sales by Product/Service Summary <i class="fa fa-question-circle-o" aria-hidden="true"></i> </a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							</div>
			             </div>
		            </div>
		          </div>

		        </div>

		        <div class="col-12 mt-3 ">
		        	<div class="col-md-12">
		            <div class="col-12 card ">
		            	<a href="#l5" data-toggle="collapse"  class="change">
			            	<div class="col-12 pt-3 pb-3">
				                <i class="fa fa-caret-down mr-1" aria-hidden="true"></i> Expenses and suppliers
				             </div>
				         </a>
			             <div class="col-12 collapse show" id="l5">
			             	<div class="list-group pb-4">
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Cheque Detail <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							   <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Supplier Contact List <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Transaction List by Supplier <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>

							</div>
			             </div>
		            </div>
		          </div>

		        </div>

		        <div class="col-12 mt-3 ">
		        	<div class="col-md-12">
		            <div class="col-12 card ">
		            	<a href="#l6" data-toggle="collapse"  class="change">
			            	<div class="col-12 pt-3 pb-3">
				                <i class="fa fa-caret-down mr-1" aria-hidden="true"></i> Sales tax
				             </div>
				         </a>
			             <div class="col-12 collapse show" id="l6">
			             	<div class="list-group pb-4">
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Tax Liability Report <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							   <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">VAT - Tax Detail Report <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">VAT - Tax Exception Report <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">VAT - Tax Summary Report <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							</div>
			             </div>
		            </div>
		          </div>

		        </div>

		         <div class="col-12 mt-3 ">
		        	<div class="col-md-12">
		            <div class="col-12 card ">
		            	<a href="#l7" data-toggle="collapse"  class="change">
			            	<div class="col-12 pt-3 pb-3">
				                <i class="fa fa-caret-down mr-1" aria-hidden="true"></i> Employees
				             </div>
				         </a>
			             <div class="col-12 collapse show" id="l7">
			             	<div class="list-group pb-4">
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Employee Contact List <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							</div>
			             </div>
		            </div>
		          </div>

		        </div>

		        <div class="col-12 mt-3 ">
		        	<div class="col-md-12">
		            <div class="col-12 card ">
		            	<a href="#l8" data-toggle="collapse"  class="change">
			            	<div class="col-12 pt-3 pb-3">
				                <i class="fa fa-caret-down mr-1" aria-hidden="true"></i> Employees
				             </div>
				         </a>
			             <div class="col-12 collapse show" id="l8">
			             	<div class="list-group pb-4">
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Account List <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Balance Sheet Comparison <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Balance Sheet <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">General Ledger <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Journal <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Profit and Loss Comparisonl <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Profit and Loss <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Recent Transactions <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Reconciliation Reports <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							   <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Statement of Cash Flows <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Transaction List by Date <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1">
							  		<a href="">Trial Balance <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star-o mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
							</div>
			             </div>
		            </div>
		          </div>

		        </div>

		        <div class="col-12 mt-3 ">
		        	<div class="col-md-12">
		            <div class="col-12 card ">
		            	<a href="#l9" data-toggle="collapse"  class="change">
			            	<div class="col-12 pt-3 pb-3">
				                <i class="fa fa-caret-down mr-1" aria-hidden="true"></i> Payroll
				             </div>
				         </a>
			             <div class="col-12 collapse show" id="l9">
			             	<div class="list-group pb-4">
							  <span class="border border-top-0 border-right-0 border-left-0 ">
							  	<div class="list-group-item list-group-item-action border border-0  d-flex justify-content-between align-items-center dropdown pt-1 pb-1" >
							  		<a href="">Employee Contact List <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
							  		<span data-toggle="dropdown">
							  			<i class="fa fa-star mr-4"></i><i class="fa fa-ellipsis-v"  aria-hidden="true"></i>
							  		</span>
							  		<div class="dropdown-menu dropdown-menu-right p-0">
								      <a class="dropdown-item" href="#">Customise</a>
								    </div>
							  	</div>
							  </span>
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
<script>
	$(document).on("click","a.change",function() {
	    //alert("click");
	    $(this).find("i").toggleClass("fa-caret-down fa-caret-right");
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
