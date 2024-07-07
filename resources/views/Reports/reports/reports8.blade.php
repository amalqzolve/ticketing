@extends('Reports.common.layout')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

	<style type="text/css">
		body {
		    background: #f2f3f8;
		}
		.timeline {
  position: relative;
  width: 100%;
  padding: 30px 0;
}

.timeline .timeline-container {
  position: relative;
  width: 100%;
}

.timeline .timeline-end,
.timeline .timeline-start,
.timeline .timeline-year {
  position: relative;
  width: 100%;
  text-align: center;
  z-index: 1;
}

.timeline .timeline-end p,
.timeline .timeline-start p,
.timeline .timeline-year p {
  display: inline-block;
  width: 80px;
  height: 80px;
  margin: 0;
  padding: 30px 0;
  text-align: center;
  background: linear-gradient(#4F84C4, #00539C);
  border-radius: 100px;
  box-shadow: 0 0 5px rgba(0, 0, 0, .4);
  color: #ffffff;
  font-size: 14px;
  text-transform: uppercase;
}

.timeline .timeline-year {
  margin: 30px 0;
}

.timeline .timeline-continue {
  position: relative;
  width: 100%;
  padding: 60px 0;
}

.timeline .timeline-continue::after {
  position: absolute;
  content: "";
  width: 1px;
  height: 100%;
  top: 0;
  left: 50%;
  margin-left: -1px;
  background: #4F84C4;
}

.timeline .row.timeline-left,
.timeline .row.timeline-right .timeline-date {
  text-align: right;
}

.timeline .row.timeline-right,
.timeline .row.timeline-left .timeline-date {
  text-align: left;
}

.timeline .timeline-date {
  font-size: 14px;
  font-weight: 600;
  margin: 41px 0 0 0;
}

.timeline .timeline-date::after {
  content: '';
  display: block;
  position: absolute;
  width: 14px;
  height: 14px;
  top: 45px;
  background: linear-gradient(#4F84C4, #00539C);
  box-shadow: 0 0 5px rgba(0, 0, 0, .4);
  border-radius: 15px;
  z-index: 1;
}

.timeline .row.timeline-left .timeline-date::after {
  left: -7px;
}

.timeline .row.timeline-right .timeline-date::after {
  right: -7px;
}

.timeline .timeline-box,
.timeline .timeline-launch {
  position: relative;
  display: inline-block;
  margin: 15px;
  padding: 20px;
  border: 1px solid #dddddd;
  border-radius: 6px;
  background: #ffffff;
}

.timeline .timeline-launch {
  width: 100%;
  margin: 15px 0;
  padding: 0;
  border: none;
  text-align: center;
  background: transparent;
}

.timeline .timeline-box::after,
.timeline .timeline-box::before {
  content: '';
  display: block;
  position: absolute;
  width: 0;
  height: 0;
  border-style: solid;
}

.timeline .row.timeline-left .timeline-box::after,
.timeline .row.timeline-left .timeline-box::before {
  left: 100%;
}

.timeline .row.timeline-right .timeline-box::after,
.timeline .row.timeline-right .timeline-box::before {
  right: 100%;
}

.timeline .timeline-launch .timeline-box::after,
.timeline .timeline-launch .timeline-box::before {
  left: 50%;
  margin-left: -10px;
}

.timeline .timeline-box::after {
  top: 26px;
  border-color: transparent transparent transparent #ffffff;
  border-width: 10px;
}

.timeline .timeline-box::before {
  top: 25px;
  border-color: transparent transparent transparent #dddddd;
  border-width: 11px;
}

.timeline .row.timeline-right .timeline-box::after {
  border-color: transparent #ffffff transparent transparent;
}

.timeline .row.timeline-right .timeline-box::before {
  border-color: transparent #dddddd transparent transparent;
}

.timeline .timeline-launch .timeline-box::after {
  top: -20px;
  border-color: transparent transparent #dddddd transparent;
}

.timeline .timeline-launch .timeline-box::before {
  top: -19px;
  border-color: transparent transparent #ffffff transparent;
  border-width: 10px;
  z-index: 1;
}

.timeline .timeline-box .timeline-icon {
  position: relative;
  width: 40px;
  height: auto;
  float: left;
}

.timeline .timeline-icon i {
  font-size: 25px;
  color: #4F84C4;
}

.timeline .timeline-box .timeline-text {
  position: relative;
  width: calc(100% - 40px);
  float: left;
}

.timeline .timeline-launch .timeline-text {
  width: 100%;
}

.timeline .timeline-text h3 {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 3px;
}

.timeline .timeline-text p {
  font-size: 14px;
  font-weight: 400;
  margin-bottom: 0;
}

@media (max-width: 768px) {
  .timeline .timeline-continue::after {
    left: 40px;
  }

  .timeline .timeline-end,
  .timeline .timeline-start,
  .timeline .timeline-year,
  .timeline .row.timeline-left,
  .timeline .row.timeline-right .timeline-date,
  .timeline .row.timeline-right,
  .timeline .row.timeline-left .timeline-date,
  .timeline .timeline-launch {
    text-align: left;
  }

  .timeline .row.timeline-left .timeline-date::after,
  .timeline .row.timeline-right .timeline-date::after {
    left: 47px;
  }

  .timeline .timeline-box,
  .timeline .row.timeline-right .timeline-date,
  .timeline .row.timeline-left .timeline-date {
    margin-left: 55px;
  }

  .timeline .timeline-launch .timeline-box {
    margin-left: 0;
  }

  .timeline .row.timeline-left .timeline-box::after {
    left: -20px;
    border-color: transparent #ffffff transparent transparent;
  }

  .timeline .row.timeline-left .timeline-box::before {
    left: -22px;
    border-color: transparent #dddddd transparent transparent;
  }

  .timeline .timeline-launch .timeline-box::after,
  .timeline .timeline-launch .timeline-box::before {
    left: 30px;
    margin-left: 0;
  }
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
			 <div class="row">
			 	<div class="col-12 p-3">


			 		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
				    Open modal
				  </button>
				</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">			 	
			 		<div class="timeline">
					    <div class="container">
					        <div class="row">
					            <div class="col-lg-12">
					                <div class="timeline-container">
					                    <div class="timeline-end">
					                        <p>Now</p>
					                    </div>
					                    <div class="timeline-continue">

					                        <div class="row timeline-right">
					                            <div class="col-md-6">
					                                <p class="timeline-date">
					                                    01 Jun 2020
					                                </p>
					                            </div>
					                            <div class="col-md-6">
					                                <div class="timeline-box">
					                                    <div class="timeline-icon">
					                                        <i class="fa fa-gift"></i>
					                                    </div>
					                                    <div class="timeline-text">
					                                        <h3>Lorem ipsum dolor</h3>
					                                        <p>Lorem ipsum dolor sit amet elit ornare velit non</p>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>

					                        <div class="row timeline-left">
					                            <div class="col-md-6 d-md-none d-block">
					                                <p class="timeline-date">
					                                    01 Jan 2020
					                                </p>
					                            </div>
					                            <div class="col-md-6">
					                                <div class="timeline-box">
					                                    <div class="timeline-icon d-md-none d-block">
					                                        <i class="fa fa-business-time"></i>
					                                    </div>
					                                    <div class="timeline-text">
					                                        <h3>Lorem ipsum dolor</h3>
					                                        <p>Lorem ipsum dolor sit amet elit ornare velit non</p>
					                                    </div>
					                                    <div class="timeline-icon d-md-block d-none">
					                                        <i class="fa fa-business-time"></i>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="col-md-6 d-md-block d-none">
					                                <p class="timeline-date">
					                                    01 Jan 2020
					                                </p>
					                            </div>
					                        </div>

					                        <div class="row">
					                            <div class="col-12">
					                                <div class="timeline-year">
					                                    <p>2020</p>
					                                </div>
					                            </div>
					                        </div>

					                        <div class="row timeline-right">
					                            <div class="col-md-6">
					                                <p class="timeline-date">
					                                    01 Dec 2019
					                                </p>
					                            </div>
					                            <div class="col-md-6">
					                                <div class="timeline-box">
					                                    <div class="timeline-icon">
					                                        <i class="fa fa-briefcase"></i>
					                                    </div>
					                                    <div class="timeline-text">
					                                        <h3>Lorem ipsum dolor</h3>
					                                        <p>Lorem ipsum dolor sit amet elit ornare velit non</p>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>

					                        <div class="row timeline-left">
					                            <div class="col-md-6 d-md-none d-block">
					                                <p class="timeline-date">
					                                    01 Sep  2019
					                                </p>
					                            </div>
					                            <div class="col-md-6">
					                                <div class="timeline-box">
					                                    <div class="timeline-icon d-md-none d-block">
					                                        <i class="fa fa-cogs"></i>
					                                    </div>
					                                    <div class="timeline-text">
					                                        <h3>Lorem ipsum dolor</h3>
					                                        <p>Lorem ipsum dolor sit amet elit ornare velit non</p>
					                                    </div>
					                                    <div class="timeline-icon d-md-block d-none">
					                                        <i class="fa fa-cogs"></i>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="col-md-6 d-md-block d-none">
					                                <p class="timeline-date">
					                                    01 Sep  2019
					                                </p>
					                            </div>
					                        </div>

					                        <div class="row timeline-right">
					                            <div class="col-md-6">
					                                <p class="timeline-date">
					                                    01 Jun 2019
					                                </p>
					                            </div>
					                            <div class="col-md-6">
					                                <div class="timeline-box">
					                                    <div class="timeline-icon">
					                                        <i class="fa fa-running"></i>
					                                    </div>
					                                    <div class="timeline-text">
					                                        <h3>Lorem ipsum dolor</h3>
					                                        <p>Lorem ipsum dolor sit amet elit ornare velit non</p>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>

					                        <div class="row timeline-left">
					                            <div class="col-md-6 d-md-none d-block">
					                                <p class="timeline-date">
					                                    01 Mar 2019
					                                </p>
					                            </div>
					                            <div class="col-md-6">
					                                <div class="timeline-box">
					                                    <div class="timeline-icon d-md-none d-block">
					                                        <i class="fa fa-home"></i>
					                                    </div>
					                                    <div class="timeline-text">
					                                        <h3>Lorem ipsum dolor</h3>
					                                        <p>Lorem ipsum dolor sit amet elit ornare velit non</p>
					                                    </div>
					                                    <div class="timeline-icon d-md-block d-none">
					                                        <i class="fa fa-home"></i>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="col-md-6 d-md-block d-none">
					                                <p class="timeline-date">
					                                    01 Mar 2019
					                                </p>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="timeline-start">
					                        <p>Launch</p>
					                    </div>
					                    <div class="timeline-launch">
					                        <div class="timeline-box">
					                            <div class="timeline-text">
					                                <h3>Launched our company on 01 Jan 2019</h3>
					                                <p>Lorem ipsum dolor sit amet</p>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					        
					    </div>
					</div>
					</div>

      <!-- Modal footer -->

      <div class="modal-footer text-center">
      	<div class="col-md-12 text-center">
      		<button type="button" class="btn btn-default" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel</button>
      	</div>
        
      </div>

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