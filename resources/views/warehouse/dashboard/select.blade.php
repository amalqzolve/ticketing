<!DOCTYPE html>

@php $locale = session()->get('locale'); @endphp
<html lang="{{$locale}}">

<!-- begin::Head -->
<head>
				<base href="">
				<meta charset="utf-8" />
								<title>{{ config('app.name', 'Laravel') }} | {{ Route::currentRouteName() }}</title>
				<meta name="description" content="Updates and statistics">
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

								<link rel="shortcut icon" href="{{ URL::asset('assets') }}/media/logos/qfavicon.ico" />
				<!--begin::Fonts -->
				<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

				<!--end::Fonts -->

				<!--begin::Page Vendors Styles(used by this page) -->
				<link href="{{ URL::asset('assets') }}/plugins/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />

				<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
				<!--end::Page Vendors Styles -->

				<!--begin::Global Theme Styles(used by all pages) -->
				<link href="{{ URL::asset('assets') }}/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
				<link href="{{ URL::asset('assets') }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
				<link href="{{ URL::asset('assets') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />

				<!--end::Global Theme Styles -->

				<!--begin::Layout Skins(used by all pages) -->
				<link href="{{ URL::asset('assets') }}/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
				<link href="{{ URL::asset('assets') }}/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
				<link href="{{ URL::asset('assets') }}/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
				<link href="{{ URL::asset('assets') }}/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />


				<link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
				<link href="{{ URL::asset('assets') }}/style.css" rel="stylesheet" type="text/css" />
				<!--end::Layout Skins -->

				<link rel="shortcut icon" href="{{ URL::asset('assets') }}/media/logos/qfavicon.ico" />
	<style>
html
{
								overflow-x: hidden;
}
				.tox-statusbar__branding {
								display: none !important;
				}

				.select2-container {
								width: 100% !important;
				}

				.select2-container--default .select2-selection--single .select2-selection__rendered {
								color: #595d6e;
								height: 30px !important;

				}
table.dataTable td, table.dataTable th
{
        padding: 0.05rem 0.3rem !important;
}

	.select-dropdown-error {
												border: 1px solid #fd397a !important;

				}

				.kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form {
								width: 95%;
				}
				.kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form
				{
								width: 95% !important;
								padding: 0rem 0 5rem !important;
				}
				/*.dataTables_wrapper .dataTables_paginate .paginate_button {
												padding: 2px 10px !important;
								margin: 2px;
								background-color: #5d78ff !important;
															color:#fff;
								border: 1px solid #1110 !important;
												border-radius: 5px;
				}
				.dataTables_wrapper .dataTables_paginate .paginate_button:hover, .dataTables_wrapper .dataTables_paginate .current {
															background-color: #0abb87 !important;
															color:#fff;
				}*/
				.kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item .kt-wizard-v1__nav-body .kt-wizard-v1__nav-icon {
				font-size: 2.7rem !important;
				}
				.kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form .kt-form__actions [data-ktwizard-type="action-prev"] {   
								right: 185px !important;
				}
			.btn-icon-sm
			{
				padding: 0.35rem 1rem;
			}
			.btn.kt-spinner.kt-spinner--right {
								padding: 0.35rem 1rem;
								right: 78px;
}
			.btn.kt-spinner.kt-spinner--right:before {
					position: absolute;
				z-index: 1000;
				left: 30px;
				right: 0px;
}
#kt_subheader
{
				display: none;
}
	.kt-nav{
				padding: .25rem 0;
	}  
	.btn.btn-icon.btn-sm, .btn-group-sm > .btn.btn-icon {
				height: 2rem;
				width: 2rem;
}
			
				@media (min-width: 1025px)
				{
				.kt-header--fixed.kt-subheader--fixed.kt-subheader--enabled .kt-wrapper {
								padding-top: 60px;
				}}

									.form-group {
				margin-bottom: 1rem;
}
.dataTables_wrapper .dataTable th, .dataTables_wrapper .dataTable td {
				font-weight: 400;
				font-size: 1rem !important;
				vertical-align: middle;
				color: #3F4254;
				padding: .05rem .30rem !important;
}
.dt-buttons 
{
				display: none;
}

.dataTables_wrapper .dataTables_paginate .pagination .page-item > .page-link
{
								height: 1.75rem;
				min-width: 1.75rem;
}
.kt-footer {
				padding: 10px 0;
}
	label
		{
				margin-bottom: 0.25rem;
		}
input[type="radio"], input[type="checkbox"]
{
								height: calc(0.5em + 1rem + 2px)  !important;
}
.dataTables_length
												{
																position: absolute;
												}



													.dataTables_wrapper .dataTables_paginate .paginate_button {
																padding: 2px 10px !important;
												margin: 2px;
												background-color: #ebe9f2 !important;
																			color: #595d6e;
												border: 1px solid #1110 !important;
																border-radius: 5px;
								}
							.dataTables_wrapper .dataTables_paginate .current {
																			background-color: #5d78ff !important;
																			color:#fff;
								}
									.dataTables_wrapper .dataTables_paginate .paginate_button:hover
									{
												background-color: #5d78ff !important;
																			color:#fff;
																							opacity: 0.6;
									}
									.kt-footer{
																position: fixed;
				width: 100%;
				bottom: 0;
									}
									table.dataTable thead > tr > th
									{
												white-space: nowrap !important;
									}
									.dataTables_wrapper .dataTable th.sorting_desc:before, .dataTables_wrapper .dataTable th.sorting_desc:after, .dataTables_wrapper .dataTable th.orting_asc_disabled:before, .dataTables_wrapper .dataTable th.orting_asc_disabled:after, .dataTables_wrapper .dataTable th.orting_desc_disabled:before, .dataTables_wrapper .dataTable th.orting_desc_disabled:after, .dataTables_wrapper .dataTable th.sorting_asc:before, .dataTables_wrapper .dataTable th.sorting_asc:after, .dataTables_wrapper .dataTable th.sorting:before, .dataTables_wrapper .dataTable th.sorting:after, .dataTables_wrapper .dataTable td.sorting_desc:before, .dataTables_wrapper .dataTable td.sorting_desc:after, .dataTables_wrapper .dataTable td.orting_asc_disabled:before, .dataTables_wrapper .dataTable td.orting_asc_disabled:after, .dataTables_wrapper .dataTable td.orting_desc_disabled:before, .dataTables_wrapper .dataTable td.orting_desc_disabled:after, .dataTables_wrapper .dataTable td.sorting_asc:before, .dataTables_wrapper .dataTable td.sorting_asc:after, .dataTables_wrapper .dataTable td.sorting:before, .dataTables_wrapper .dataTable td.sorting:after {
				bottom: 0.25rem !important;
}
.dataTables_wrapper .dataTable td
								{
																white-space: nowrap !important;
								}
								.datepicker
{
				z-index: 100 !important;
}
.kt-wizard-v1[data-ktwizard-state="last"] [data-ktwizard-type="action-submit"]{
								width: 111px !important;
}
.dataTables_scrollBody
{
								padding-bottom: 123px !important;
}
.dataTables_wrapper .dataTable{
				margin-bottom:  123px !important;
}
.kt-section .kt-section__content.kt-section__content--solid
{
				display: none;
}
.uppy-c-btn-primary{
								position: absolute;
				right: 100px !important;
					padding: 10px 22px !important;
}
.uppy-c-btn-link{
								position: absolute;
				right: 10px !important;
				color: #333;
				background-color: #fff;
				border-color: #ccc;
				background-color: #0000001c !important;
				color: #525252 !important;
					padding: 10px 22px !important;
}
.uppy-c-btn-link:hover  
{
								background-color: #0000002e !important;
}
.btn{
	padding: 1px 1rem;
	line-height: 0.5;
	width: 100%;
}
.imgover:hover img
{
	filter: blur(2px);
}

				</style>


</head>

<!-- end::Head -->

<!-- begin::Body -->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed page-loading">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="public_path" id="public_path" value="{{ public_path()}}">
<input type="hidden" name="base_url" id="base_url" value="{{ URL::asset('assets') }}">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
	<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
				<div class="kt-header-mobile__logo">
								
																																																																<img alt="Logo" src="{{url('public')}}/login_logo/alim-sidebar-logo.png" />
																																																
				</div>
				<div class="kt-header-mobile__toolbar">
								<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
								<button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
								<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
				</div>
</div>

<!-- end:: Header Mobile -->
<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

												<!-- begin:: Aside -->
											

												<!-- end:: Aside Menu -->
								</div>

								<!-- end:: Aside -->
								<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

												<!-- begin:: Header -->
												<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

																<!-- begin:: Header Menu -->

																<!-- Uncomment this to display the close button of the panel
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
-->
																<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
																				<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
																							
																				</div>
																</div>

																<!-- end:: Header Menu -->

																<!-- begin:: Header Topbar -->
																<div class="kt-header__topbar">

																				<!--begin: Quick panel toggler -->

																				<div class="kt-header__topbar-item kt-header__topbar-item--quick-panel" data-toggle="kt-tooltip" title="Home" data-placement="right">
																												<a href="{{url('/')}}" style="margin-top: 10px;">
																				

																<span class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn">
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																						<rect x="0" y="0" width="24" height="24" />
																						<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
																						<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
																				</g>
																		</svg> </a></span>
																				</div>
																

																				<!--end: Quick panel toggler -->

																				<!--begin: Language bar -->
																				<div class="kt-header__topbar-item kt-header__topbar-item--langs">
																								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">

																												@php $locale = session()->get('locale'); @endphp

																												@switch($locale)

																																@case('es')

																																<span class="kt-header__topbar-icon">
																				<img class="" src="{{ URL::asset('assets') }}/media/flags/162-germany.svg" alt="" />
																		</span>
																																@break
																																@default


																																<span class="kt-header__topbar-icon">
																				<img class="" src="{{ URL::asset('assets') }}/media/flags/226-united-states.svg" alt="" />
																		</span>
																												@endswitch


																								</div>
																								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
																												<ul class="kt-nav kt-margin-t-10 kt-margin-b-10">



																																<li class="kt-nav__item">
																																				<a href="setlocale/ar" class="kt-nav__link">
																																								<span class="kt-nav__link-icon"><img src="{{ URL::asset('assets') }}/media/flags/162-germany.svg" alt="" /></span>
																																								<span class="kt-nav__link-text">Arabic</span>
																																				</a>
																																</li>



																																<li class="kt-nav__item kt-nav__item--active">
																																				<a href="setlocale/en" class="kt-nav__link">
																																								<span class="kt-nav__link-icon"><img src="{{ URL::asset('assets') }}/media/flags/226-united-states.svg" alt="" /></span>
																																								<span class="kt-nav__link-text">English</span>
																																				</a>
																																</li>







																												</ul>
																								</div>
																				</div>

																				<!--end: Language bar -->

																				<!--begin: User Bar -->
																					<div class="kt-header__topbar-item kt-header__topbar-item--user">
																																																																																<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
																																																																																																<div class="kt-header__topbar-user"> <span
																																																																																																																																class="kt-header__topbar-welcome kt-hidden-mobile">{{ __('app.Hi,') }}</span>
																																																																																																																<span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->name }}</span>
																																																																																																								<!--   <img class="" alt="Pic" src="public/{{ Auth::user()->image }}" /> -->
																																																																																																																<span
																																																																																																																																class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">
																																																																																																																																				<?php $str = Auth::user()->name; ?>
																																																																																																																																				<i class="fa fa-user-alt"></i>
																																																																																																																</span>
																																																																																																</div>
																																																																																</div>
																																																																																<div
																																																																																																class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
																																																																																																<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
																																																																																																																style="background-image: url(public/assets/media/misc/bg-1.jpg)">
																																																																																																																<div class="kt-user-card__avatar">
																																																																																																																												<!--  <img class="" alt="Pic" src="public/{{ Auth::user()->image }}" /> -->
																																																																																																																</div>
																																																																																																																<div class="kt-user-card__name" style="color: black;">{{ Auth::user()->name }}</div>
																																																																																																																
																																																																																																</div>
																																																																																																<div class="kt-notification">
																																																																																																												
																																																																																																												
																																																																																																												<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" >
																																								<div class="kt-user-card__avatar">
																																												<img class="kt-hidden2" alt="Pic" src="{{ URL::to('/') }}/public/{{Session::get('profile.0')}}">

																																												<!-- //Session::get('variableName'); -->


																																								</div>
																																								<div class="kt-user-card__name">
																																								
																																								</div>
																																								
																																				</div>


																																																																																																												
																																																																																																								
																																																																																																																<div class="kt-notification__custom kt-space-between"> <a
																																																																																																																																																class="btn btn-label btn-label-brand btn-sm btn-bold" style="display:none;" href="{{ route('logout') }}"
																																																																																																																																																onclick="event.preventDefault();
																																																																																																																																																																																																																				document.getElementById('logout-form').submit();">
																																																																																																																																																{{ __('Logout') }}
																																																																																																																																</a>
																																																																																																																																<form id="logout-form" action="{{ route('logout') }}" method="POST"
																																																																																																																																																style="display: none;">@csrf</form> 
																																																																																																																																																<a href="changepic?id={{ Auth::user()->id }}"
																																																																																																																																																target="_blank" class="btn btn-clean btn-sm btn-bold">Change Profile Picture</a>
																																																																																																																</div>
																																																																																																</div>
																																																																																</div>
																																																																</div>

																				<!--end: User Bar -->
																</div>

																<!-- end:: Header Topbar -->
												</div>

												<!-- end:: Header -->
@yield('content')
</div>
<div class="container" style="">
<div class="card card-custom gutter-b">
									<div class="card-header">
										
									</div>
									<div class="card-body">
										<div class="row justify-content-center my-20">
											<!--begin: Pricing-->

											@foreach($warehouses as $data)

 
												
											
											<div class="col-md-3 col-xxl-3">
												<div class="pt-30 pt-md-25 pr-1 pl-1 text-center imgover">
													<!--begin::Icon-->
													
													<!--end::Icon-->
													<!--begin::Content-->
												<div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100">
													<img class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100" src="{{ URL::to('/') }}/skin/assets/media/bg/bg-9.jpg">
												</div>
        
        
											
													<button data-wid="{{$data->id}}" data-wname="{{$data->warehouse_name}}" class="btn btn-info mb-4 text-uppercase font-weight-bolder px-15 py-3 setwarehouse ">{{$data->warehouse_name}}</button>
													<!--end::Content-->  <br>
												</div>
											</div>

											 @endforeach
											<!--end: Pricing-->
										
										</div>
									</div>
								</div>
							</div>
@include('warehouse.common.footer')

@yield('script')
<script type="text/javascript">
	 $('body').on('click', '.setwarehouse', function() {

	 var wid = $(this).attr('data-wid');

	 var wname = $(this).attr('data-wname');

		
			$.ajax({
				 type:'POST',
				 url:'setwarehouse',
				 data:{
					_token: $('#token').val(),
					'wid':wid,
					'wname':wname

				},
				 success:function(data){
				 window.location = "{{url('/')}}/warehouse";
/*  console.log('Before Ajax Call');
 

 $('#selected_items').val('');
$('#selected_amount').val('');
console.log('After Ajax Call');

					$("#whead").text(wname);*/


						
				 },
				 error:function()
				 {
				 }
			});

	});
</script>
@include('warehouse.common.footerend')