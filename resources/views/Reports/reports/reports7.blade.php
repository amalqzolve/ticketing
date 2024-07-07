@extends('Reports.common.layout')
@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

	<style type="text/css">
		body {
		    background: #f2f3f8;
		}
		.horizontal-tabs-steps {
  position: relative;
}

.horizontal-tabs-steps .nav-item {
  z-index: 1;
  position: relative;
}

.horizontal-tabs-steps .nav-item:after {
  content: "";
  border-top: 5px dotted #73b6ff;
  position: absolute;
  z-index: 0;
  top: 12px;
  width: 265px;
  left: 0px;
  transition: border 1s ease-out;
  transition-delay: 0s, 0s, 0.1s;
}

.horizontal-tabs-steps .nav-item:last-child:after {
  content: "";
  border-top: 0px dotted #4da3ff;
}

.horizontal-tabs-steps .nav-item.complete-step:after {
  content: "";
  border-top: 5px dotted #4d7ed2;
  position: absolute;
  z-index: 0;
  top: 12px;
  width: 265px;
  left: 0px;
  transition: border 1s ease-out;
  transition-delay: 0s, 0s, 0.1s
}

.horizontal-tabs-steps .nav-link {
  background: #fff;
  border-radius: 50%;
  width: 31px;
  height: 31px;
  color: #3c4858;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 12px;
  border: 2px solid #4d7ed2;
  z-index: 1;
  position: relative;
}

.horizontal-tabs-steps .nav-link:hover {
  background: #22437c;
  border: 2px solid #22437c;
  color: #fff !important;
  transition: 0.3s all;
}

.horizontal-tabs-steps .nav-link:hover .horizontal-tabs-steps .nav-link span {
  color: #fff !important;
}

.horizontal-tabs-steps .nav-item h6 {
  font-size: 12px;
}

.horizontal-tabs-steps .nav-item.show .nav-link, .horizontal-tabs-steps .nav-link.active {
  color: #fff;
  background-color: #22437c;
  border-color: #22437c;
  width: 31px;
  height: 31px;
  border-radius: 50%;
}

.horizontal-tabs-steps .nav-link.active span {
  color: #fff;
  font-weight: 500 !important;
}

.horizontal-tabs-steps .checked-steps span {
  display: none;
}

.horizontal-tabs-steps .checked-steps {
  background-color: #22437c !important;
  border: 1px solid #22437c !important;
  color: #fff !important;
}

.horizontal-tabs-steps .checked-steps:after {
  content: "\f00c";
  font-family: FontAwesome;
  color: #fff;
}

/*********** Steps End***************/

/*********** Platform Content start***************/
.platform-content .tab-pane h3 {
  font-size: 15px;
  font-weight: 500 !important;
}

.platform-content .tab-pane p {
  font-size: 12px;
}

.vertical-tabs-steps.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
  color: #fff;
  background-color: #22437c;
  border-color: #22437c;
  font-size: 12px !important;
}

.vertical-tabs-steps .nav-link {
  color: #3c4858;
  border: 1px solid #4d7ed2;
  font-size: 12px !important;
  margin-bottom: 45px;
  border-radius: 15px 15px 0px 15px;
  padding: 10px;
  text-align: center;  
  background: #fff;
  position: relative;
  z-index: 1;  
  width: 80px;
}

.vertical-tabs-steps .nav-link.checked-steps {
  text-align: left;
}

.vertical-tabs-steps .nav-link:hover {
  color: #fff;
  background-color: #22437c !important;
  border-color: #22437c;
  transition: 0.3s all;
}

.vertical-tabs-steps .nav-item {
  position: relative;
}

.vertical-tabs-steps .nav-item:last-child:after {
  content: "";
  border-bottom: 0px !important;
}

.vertical-tabs-steps .nav-item:after {
  content: "";
  border-bottom: 3px dotted #73b6ff;
  position: absolute;
  width: 95px;
  transform: rotate(90deg);
  z-index: 0;
  left: -10px;
  top: 50px;
  transition: border 1s ease-out;
  transition-delay: 0s, 0s, 0.1s;
}

.vertical-tabs-content {
  padding: 0px 15px;
}

.vertical-tabs-content p {
  font-size: 12px;
}

.vertical-tabs-steps .checked-steps {
  background-color: #22437c !important;
  border: 1px solid #22437c !important;
  color: #fff !important;
}

.vertical-tabs-steps .checked-steps:after {
  content: "\f00c";
  font-family: FontAwesome;
  color: #fff;
  position: absolute;
  right: 10px;
}

.vertical-tabs-content .tab-pane h3 {
  font-size: 15px;
  font-weight: 500 !important;
}

.vertical-tabs-steps .checked-border-item.nav-item:after {
  content: "";
  border-bottom: 0px dotted #ccc !important;
  position: absolute;
  width: 95px;
  transform: rotate(90deg);
  z-index: 0;
  left: -10px;
  top: 50px;
  transition: border 1s ease-out;
  transition-delay: 0s, 0s, 0.1s;
}

.vertical-tabs-steps .nav-item.complete-step:after {
  content: "";
  border-bottom: 3px dotted #4d7ed2 !important;
  position: absolute;
  width: 95px;
  transform: rotate(90deg);
  z-index: 0;
  left: -10px;
  top: 50px;
}

/*********** Platform Content End***************/


/*********** Responsive CSS Start***************/

@media only screen and (max-width: 575px) {
  .vertical-tabs-steps .nav-link {
    width: 73px;
  }  

  .vertical-tabs-steps .nav-link.checked-steps {
    padding: 10px 7px;
  }  

  .vertical-tabs-steps .checked-steps:after {
    content: "\f00c";
    font-family: FontAwesome;
    color: #fff;
    position: absolute;
    right: 7px;
  }  
}

@media only screen and (min-width: 992px) and (max-width: 1199px) {
  .horizontal-tabs-steps .nav-item:after {
    content: "";
    width: 219px;
  } 
}

@media only screen and (min-width: 768px) and (max-width: 991px) {
  .horizontal-tabs-steps .nav-item:after {
    content: "";
    width: 160px;
  } 
}

@media only screen and (min-width: 421px) and (max-width: 767px) {
  .horizontal-tabs-steps .nav-item:after {
    content: "";
    width: 115px;
  } 
}

@media only screen and (max-width: 420px) {
  .horizontal-tabs-steps .nav-item:after {
    content: "";
    width: 95px;
  } 
}
.nav-tabs .nav-item .nav-link.active, .nav-tabs .nav-item .nav-link:active, .nav-tabs .nav-item .nav-link:hover{
	color: white;
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
			 	<div class="col-12">
			 		<!---------------Platform Tour----------------->
					    <div class="platform-tour-wrapper py-3">
					      <!-- Nav tabs -->
					      <ul class="nav nav-tabs justify-content-between border-0 horizontal-tabs-steps">
					        <li class="nav-item">
					          <a class="nav-link active" data-toggle="tab" href="#step1"><span>1</span>
					          </a>
					          <h6 class="text-center mt-1">Step 1</h6>
					        </li>

					        <li class="nav-item">
					          <a class="nav-link" data-toggle="tab" href="#step2"><span>2</span></a>
					          <h6 class="text-center mt-1">Step 2</h6>
					        </li>

					        <li class="nav-item">
					          <a class="nav-link" data-toggle="tab" href="#step3"><span>3</span></a>
					          <h6 class="text-center mt-1">Step 3</h6>
					        </li>

					        <li class="nav-item">
					          <a class="nav-link" data-toggle="tab" href="#step4"><span>4</span></a>
					          <h6 class="text-center mt-1">Step 4</h6>
					        </li>

					        <li class="nav-item">
					          <a class="nav-link" data-toggle="tab" href="#step5"><span>5</span></a>
					          <h6 class="text-center mt-1">Step 5</h6>
					        </li>
					      </ul>

					      <!-- Tab panes -->
					      <div class="tab-content platform-content mt-2 mb-4">
					        <div id="step1" class="tab-pane active p-0">

					          <h3 class="mb-4">Lorem Ipsum 1</h3>
					          <!------vertical Tabs------------->

					          <div class="row">
					            <div class="col-lg-1 col-md-2 col-sm-2 col-3 vertical-tabs-steps pr-0">
					              <ul class="nav nav-tabs d-flex flex-sm-column border-0" id="myTab" role="tablist">
					                <li class="nav-item">
					                  <a class="nav-link active" data-toggle="tab" href="#step1_1" role="tab" aria-controls="home"><span>Step 1.1</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step1_2" role="tab" aria-controls="profile"><span>Step 1.2</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step1_3" role="tab" aria-controls="messages"><span>Step 1.3</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step1_4" role="tab" aria-controls="settings"><span>Step 1.4</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step1_5" role="tab" aria-controls="settings"><span>Step 1.5</span></a>
					                </li>
					              </ul> 
					            </div>

					            <div class="col-lg-11 col-md-10 col-sm-10 col-9 p-0 pl-md-2">
					              <div class="tab-content vertical-tabs-content">
					                <div class="tab-pane active" id="step1_1" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step1_2" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Vestibulum a pellentesque lorem. Nullam convallis consequat orci. Morbi dignissim tempor enim, vel facilisis nisl vestibulum vitae. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step1_3" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step1_4" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Vestibulum a pellentesque lorem. Nullam convallis consequat orci. Morbi dignissim tempor enim, vel facilisis nisl vestibulum vitae. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step1_5" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>
					              </div>
					            </div>
					          </div>
					          <!---------- vertical Tabs End----------------->
					        </div>

					        <div id="step2" class="tab-pane fade p-0">
					          <h3 class="mb-4">Lorem Ipsum 2</h3>

					          <!------vertical Tabs------------->
					          <div class="row">
					            <div class="col-lg-1 col-md-2 col-sm-2 col-3 vertical-tabs-steps pr-0">
					              <ul class="nav nav-tabs d-flex flex-sm-column border-0" id="myTab" role="tablist">
					                <li class="nav-item">
					                  <a class="nav-link active" data-toggle="tab" href="#step2_1" role="tab" aria-controls="home"><span>Step 2.1</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step2_2" role="tab" aria-controls="profile"><span>Step 2.2</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step2_3" role="tab" aria-controls="messages"><span>Step 2.3</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step2_4" role="tab" aria-controls="settings"><span>Step 2.4</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step2_5" role="tab" aria-controls="settings"><span>Step 2.5</span></a>
					                </li>
					              </ul> 
					            </div>

					            <div class="col-lg-11 col-md-10 col-sm-10 col-9 p-0 pl-md-2">
					              <div class="tab-content vertical-tabs-content">
					                <div class="tab-pane active" id="step2_1" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step2_2" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Vestibulum a pellentesque lorem. Nullam convallis consequat orci. Morbi dignissim tempor enim, vel facilisis nisl vestibulum vitae. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step2_3" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step2_4" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Vestibulum a pellentesque lorem. Nullam convallis consequat orci. Morbi dignissim tempor enim, vel facilisis nisl vestibulum vitae. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step2_5" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>
					              </div>
					            </div>
					          </div>
					          <!---------- vertical Tabs End----------------->
					        </div>

					        <div id="step3" class="tab-pane fade p-0">
					          <h3 class="mb-4">Lorem Ipsum 3</h3>
					          <!------vertical Tabs------------->
					          <div class="row">
					            <div class="col-lg-1 col-md-2 col-sm-2 col-3 vertical-tabs-steps pr-0">
					              <ul class="nav nav-tabs d-flex flex-sm-column border-0" id="myTab" role="tablist">
					                <li class="nav-item">
					                  <a class="nav-link active" data-toggle="tab" href="#step3_1" role="tab" aria-controls="home"><span>Step 3.1</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step3_2" role="tab" aria-controls="profile"><span>Step 3.2</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step3_3" role="tab" aria-controls="messages"><span>Step 3.3</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step3_4" role="tab" aria-controls="settings"><span>Step 3.4</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step3_5" role="tab" aria-controls="settings"><span>Step 3.5</span></a>
					                </li>
					              </ul> 
					            </div>

					            <div class="col-lg-11 col-md-10 col-sm-10 col-9 p-0 pl-md-2">
					              <div class="tab-content vertical-tabs-content">
					                <div class="tab-pane active" id="step3_1" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step3_2" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Vestibulum a pellentesque lorem. Nullam convallis consequat orci. Morbi dignissim tempor enim, vel facilisis nisl vestibulum vitae. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step3_3" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step3_4" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Vestibulum a pellentesque lorem. Nullam convallis consequat orci. Morbi dignissim tempor enim, vel facilisis nisl vestibulum vitae. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step3_5" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>
					              </div>
					            </div>
					          </div>
					          <!---------- vertical Tabs End----------------->
					        </div>

					        <div id="step4" class="tab-pane fade p-0">
					          <h3 class="mb-4">Lorem Ipsum 4</h3>
					          <!------vertical Tabs------------->
					          <div class="row">
					            <div class="col-lg-1 col-md-2 col-sm-2 col-3 vertical-tabs-steps pr-0">
					              <ul class="nav nav-tabs d-flex flex-sm-column border-0" id="myTab" role="tablist">
					                <li class="nav-item">
					                  <a class="nav-link active" data-toggle="tab" href="#step4_1" role="tab" aria-controls="home"><span>Step 4.1</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step4_2" role="tab" aria-controls="profile"><span>Step 4.2</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step4_3" role="tab" aria-controls="messages"><span>Step 4.3</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step4_4" role="tab" aria-controls="settings"><span>Step 4.4</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step4_5" role="tab" aria-controls="settings"><span>Step 4.5</span></a>
					                </li>
					              </ul> 
					            </div>

					            <div class="col-lg-11 col-md-10 col-sm-10 col-9 p-0 pl-md-2">
					              <div class="tab-content vertical-tabs-content">
					                <div class="tab-pane active" id="step4_1" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step4_2" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Vestibulum a pellentesque lorem. Nullam convallis consequat orci. Morbi dignissim tempor enim, vel facilisis nisl vestibulum vitae. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step4_3" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step4_4" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Vestibulum a pellentesque lorem. Nullam convallis consequat orci. Morbi dignissim tempor enim, vel facilisis nisl vestibulum vitae. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step4_5" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>
					              </div>
					            </div>
					          </div>
					          <!---------- vertical Tabs End----------------->
					        </div>

					        <div id="step5" class="tab-pane fade p-0">
					          <h3 class="mb-4">Lorem Ipsum 5</h3>
					          <!------vertical Tabs------------->
					          <div class="row">
					            <div class="col-lg-1 col-md-2 col-sm-2 col-3 vertical-tabs-steps pr-0">
					              <ul class="nav nav-tabs d-flex flex-sm-column border-0" id="myTab" role="tablist">
					                <li class="nav-item">
					                  <a class="nav-link active" data-toggle="tab" href="#step5_1" role="tab" aria-controls="home"><span>Step 5.1</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step5_2" role="tab" aria-controls="profile"><span>Step 5.2</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step5_3" role="tab" aria-controls="messages"><span>Step 5.3</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step5_4" role="tab" aria-controls="settings"><span>Step 5.4</span></a>
					                </li>

					                <li class="nav-item">
					                  <a class="nav-link" data-toggle="tab" href="#step5_5" role="tab" aria-controls="settings"><span>Step 5.5</span></a>
					                </li>
					              </ul> 
					            </div>

					            <div class="col-lg-11 col-md-10 col-sm-10 col-9 p-0 pl-md-2">
					              <div class="tab-content vertical-tabs-content">
					                <div class="tab-pane active" id="step5_1" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step5_2" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Vestibulum a pellentesque lorem. Nullam convallis consequat orci. Morbi dignissim tempor enim, vel facilisis nisl vestibulum vitae. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step5_3" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step5_4" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Vestibulum a pellentesque lorem. Nullam convallis consequat orci. Morbi dignissim tempor enim, vel facilisis nisl vestibulum vitae. </p>
					                  <img src="https://storage.googleapis.com/website-production/uploads/2017/04/demo-landing-pages.jpg" alt="" class="w-100">
					                </div>

					                <div class="tab-pane" id="step5_5" role="tabpanel">
					                  <h3>Lorem ipsum</h3>
					                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis enim justo, tincidunt tristique dolor vitae, eleifend tempus orci. </p>
					                  <img src="https://www.saleshacker.com/wp-content/uploads/2017/10/sales-demo-tips-best-practices-feature-image.jpg" alt="" class="w-100">
					                </div>
					              </div>
					            </div>
					          </div>
					          <!---------- vertical Tabs End----------------->
					        </div>
					      </div>
					    </div>  
					    <!---------------Platform Tour End----------------->

			 	</div>
			 </div>
                
                
		</div>


	</div>
</div>


<script type="text/javascript">
	    $(document).ready(function() {
	      $(".vertical-tabs-steps .nav-link, .horizontal-tabs-steps .nav-link").click(function() {
	        $(this).parent().prevAll().children('.vertical-tabs-steps .nav-link, .horizontal-tabs-steps .nav-link').addClass('checked-steps');

	        $(this).parent().nextAll().children('.vertical-tabs-steps .nav-link, .horizontal-tabs-steps .nav-link').removeClass('checked-steps');

	        $(this).removeClass('checked-steps');
	        $(this).parent().removeClass('complete-step');
	        $(this).parent().nextAll().removeClass('complete-step');

	        $(".horizontal-tabs-steps .nav-link.checked-steps, .vertical-tabs-steps .nav-link.checked-steps").parent().addClass('complete-step');
	      });
	    });
</script>
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