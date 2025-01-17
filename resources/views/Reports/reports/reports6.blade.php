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
		.timeline {
    position: relative;
    width: 100%;
    max-width: 1140px;
    margin: 0 auto;
    padding: 15px 0;
}

.timeline::after {
    content: '';
    position: absolute;
    width: 2px;
    background: #006E51;
    top: 0;
    bottom: 0;
    left: 50%;
    margin-left: -1px;
}

.tl-container {
    padding: 15px 30px;
    position: relative;
    background: inherit;
    width: 50%;
}

.tl-container.left {
    left: 0;
}

.tl-container.right {
    left: 50%;
}

.tl-container::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    top: calc(50% - 8px);
    right: -8px;
    background: #ffffff;
    border: 2px solid #006E51;
    border-radius: 16px;
    z-index: 1;
}

.tl-container.right::after {
    left: -8px;
}

.tl-container::before {
  content: '';
  position: absolute;
  width: 50px;
  height: 2px;
  top: calc(50% - 1px);
  right: 8px;
  background: #006E51;
  z-index: 1;
}

.tl-container.right::before {
  left: 8px;
}

.tl-container .date {
    position: absolute;
    display: inline-block;
    top: calc(50% - 8px);
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    color: #006E51;
    text-transform: uppercase;
    letter-spacing: 1px;
    z-index: 1;
}

.tl-container.left .date {
    right: -75px;
}

.tl-container.right .date {
    left: -75px;
}

.tl-container .icon {
    position: absolute;
    display: inline-block;
    width: 40px;
    height: 40px;
    padding: 9px 0;
    top: calc(50% - 20px);
    background: #F6D155;
    border: 2px solid #006E51;
    border-radius: 40px;
    text-align: center;
    font-size: 18px;
    color: #006E51;
    z-index: 1;
}

.tl-container.left .icon {
    right: 56px;
}

.tl-container.right .icon {
    left: 56px;
}

.tl-container .content {
    padding: 30px 90px 30px 30px;
    background: #F6D155;
    position: relative;
    border-radius: 0 500px 500px 0;
}

.tl-container.right .content {
    padding: 30px 30px 30px 90px;
    border-radius: 500px 0 0 500px;
}

.tl-container .content h2 {
    margin: 0 0 10px 0;
    font-size: 18px;
    font-weight: normal;
    color: #006E51;
}

.tl-container .content p {
    margin: 0;
    font-size: 16px;
    line-height: 22px;
    color: #000000;
}

@media (max-width: 767.98px) {
    .timeline::after {
        left: 90px;
    }

    .tl-container {
        width: 100%;
        padding-left: 120px;
        padding-right: 30px;
    }
    
    .tl-container.right {
        left: 0%;
    }

    .tl-container.left::after, 
    .tl-container.right::after {
        left: 82px;
    }
    
    .tl-container.left::before,
    .tl-container.right::before {
        left: 100px;
        border-color: transparent #006E51 transparent transparent;
    }
    
    .tl-container.left .date,
    .tl-container.right .date {
        right: auto;
        left: 15px;
    }
    
    .tl-container.left .icon,
    .tl-container.right .icon {
        right: auto;
        left: 146px;
    }
    
    .tl-container.left .content,
    .tl-container.right .content {
        padding: 30px 30px 30px 90px;
        border-radius: 500px 0 0 500px;
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
			 	<div class="col-12">
			 	
			 		

			 		<div class="timeline">
					    <div class="tl-container left">
					        <div class="date">15 Dec</div>
					        <i class="icon fa fa-home"></i>
					        <div class="content">
					            <h2>Lorem ipsum dolor sit amet</h2>
					            <p>
					                Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
					            </p>
					        </div>
					    </div>
					    <div class="tl-container right">
					        <div class="date">22 Oct</div>
					        <i class="icon fa fa-gift"></i>
					        <div class="content">
					            <h2>Lorem ipsum dolor sit amet</h2>
					            <p>
					                Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
					            </p>
					        </div>
					    </div>
					    <div class="tl-container left">
					        <div class="date">10 Jul</div>
					        <i class="icon fa fa-user"></i>
					        <div class="content">
					            <h2>Lorem ipsum dolor sit amet</h2>
					            <p>
					                Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
					            </p>
					        </div>
					    </div>
					    <div class="tl-container right">
					        <div class="date">18 May</div>
					        <i class="icon fa fa-running"></i>
					        <div class="content">
					            <h2>Lorem ipsum dolor sit amet</h2>
					            <p>
					                Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
					            </p>
					        </div>
					    </div>
					    <div class="tl-container left">
					        <div class="date">10 Feb</div>
					        <i class="icon fa fa-cog"></i>
					        <div class="content">
					            <h2>Lorem ipsum dolor sit amet</h2>
					            <p>
					                Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
					            </p>
					        </div>
					    </div>
					    <div class="tl-container right">
					        <div class="date">01 Jan</div>
					        <i class="icon fa fa-certificate"></i>
					        <div class="content">
					            <h2>Lorem ipsum dolor sit amet</h2>
					            <p>
					                Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
					            </p>
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