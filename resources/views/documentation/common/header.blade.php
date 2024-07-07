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
		html {
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

		.kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form {
			width: 95%;
		}

		.kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form {
			width: 95% !important;
			padding: 0rem 0 5rem !important;
		}

		.dataTables_wrapper .dataTables_paginate .paginate_button {
			padding: 2px 10px !important;
			margin: 2px;
			background-color: #ebe9f2 !important;
			color: #595d6e;
			border: 1px solid #1110 !important;
			border-radius: 5px;

		}

		.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
			background-color: #5d78ff !important;
			color: #fff;
			opacity: 0.6;
			cursor: pointer;
		}

		.dataTables_wrapper .dataTables_paginate .current {
			background-color: #5d78ff !important;
			color: #fff;
		}

		.kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item .kt-wizard-v1__nav-body .kt-wizard-v1__nav-icon {
			font-size: 2.7rem !important;
		}

		.kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form .kt-form__actions [data-ktwizard-type="action-prev"] {
			right: 185px !important;
		}

		.btn-icon-sm {
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

		#kt_subheader {
			display: none;
		}

		.kt-nav {
			padding: .25rem 0;
		}

		.btn.btn-icon.btn-sm,
		.btn-group-sm>.btn.btn-icon {
			height: 2rem;
			width: 2rem;
		}

		@media (min-width: 1025px) {
			.kt-header--fixed.kt-subheader--fixed.kt-subheader--enabled .kt-wrapper {
				padding-top: 60px;
			}
		}

		.form-group {
			margin-bottom: 1rem;
		}

		.dataTables_wrapper .dataTable th,
		.dataTables_wrapper .dataTable td {
			font-weight: 400;
			font-size: 1rem !important;
			vertical-align: middle;
			color: #3F4254;
			padding: .05rem .30rem !important;
		}

		.dt-buttons {
			display: none;
		}

		.dataTables_wrapper .dataTables_paginate .pagination .page-item>.page-link {
			height: 1.75rem;
			min-width: 1.75rem;
		}

		.kt-footer {
			padding: 10px 0;
		}

		label {
			margin-bottom: 0.25rem;
		}

		input[type="radio"],
		input[type="checkbox"] {
			height: calc(0.5em + 1rem + 2px) !important;
		}

		.dataTables_length {
			position: absolute;
		}

		th>strong {
			font-weight: 500 !important;
		}

		.btn.kt-spinner.kt-spinner--right {
			padding: 0.35rem 1rem;
			right: -2px;
		}

		.dataTables_wrapper .dataTable th.sorting_desc:before,
		.dataTables_wrapper .dataTable th.sorting_desc:after,
		.dataTables_wrapper .dataTable th.orting_asc_disabled:before,
		.dataTables_wrapper .dataTable th.orting_asc_disabled:after,
		.dataTables_wrapper .dataTable th.orting_desc_disabled:before,
		.dataTables_wrapper .dataTable th.orting_desc_disabled:after,
		.dataTables_wrapper .dataTable th.sorting_asc:before,
		.dataTables_wrapper .dataTable th.sorting_asc:after,
		.dataTables_wrapper .dataTable th.sorting:before,
		.dataTables_wrapper .dataTable th.sorting:after,
		.dataTables_wrapper .dataTable td.sorting_desc:before,
		.dataTables_wrapper .dataTable td.sorting_desc:after,
		.dataTables_wrapper .dataTable td.orting_asc_disabled:before,
		.dataTables_wrapper .dataTable td.orting_asc_disabled:after,
		.dataTables_wrapper .dataTable td.orting_desc_disabled:before,
		.dataTables_wrapper .dataTable td.orting_desc_disabled:after,
		.dataTables_wrapper .dataTable td.sorting_asc:before,
		.dataTables_wrapper .dataTable td.sorting_asc:after,
		.dataTables_wrapper .dataTable td.sorting:before,
		.dataTables_wrapper .dataTable td.sorting:after {
			bottom: 0.25rem !important;
		}

		.datepicker {
			z-index: 100 !important;
		}

		.dataTables_scrollBody {
			padding-bottom: 123px !important;
		}

		.dataTables_wrapper .dataTable {
			margin-bottom: 123px !important;
		}

		.uppy-c-btn-primary {
			position: absolute;
			right: 100px !important;
			padding: 10px 22px !important;
		}

		.uppy-c-btn-link {
			position: absolute;
			right: 10px !important;
			color: #333;
			background-color: #fff;
			border-color: #ccc;
			background-color: #0000001c !important;
			color: #525252 !important;
			padding: 10px 22px !important;
		}

		.uppy-c-btn-link:hover {
			background-color: #0000002e !important;
		}

		.btn {
			width: 150px;
			padding: 0.35rem 1rem;
		}

		@media only screen and (min-width: 1580px) {
			.ribbon-2 {
				left: -3.2%;
			}
		}

		@media only screen and (min-width: 2429px) {
			.ribbon-2 {
				left: -3%;
			}
		}

		@media only screen and (max-width: 768px) {
			.ribbon-2 {
				left: 9px;
				position: absolute;
				top: 345px;
			}
		}
	</style>

</head>

<!-- end::Head -->

<!-- begin::Body -->

<body dir="{{($locale =='ar' ? 'rtl' : 'ltr')}}" class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	<input type="hidden" name="public_path" id="public_path" value="{{ public_path()}}">
	<input type="hidden" name="base_url" id="base_url" value="{{ URL::asset('assets') }}">

	<!-- begin:: Page -->

	<!-- begin:: Header Mobile -->
	<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
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
	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

			<!-- begin:: Aside -->

			<!-- Uncomment this to display the close button of the panel
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
-->
			<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

				<!-- begin:: Aside -->
				<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
					<div class="kt-aside__brand-logo">

						<img alt="Logo" src="{{url('public')}}/login_logo/alim-sidebar-logo.png" />

					</div>
					<div class="kt-aside__brand-tools">
						<button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
							<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
										<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
									</g>
								</svg></span>
							<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
										<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
									</g>
								</svg></span>
						</button>

						<!--
	<button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
	-->
					</div>
				</div>

				<!-- end:: Aside -->

				<!-- begin:: Aside Menu -->
				<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
					<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
						<ul class="kt-menu__nav ">


							<li class="kt-menu__item help" aria-haspopup="true"><a href="{{url('/help')}}" class="kt-menu__link ">
									<span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
												<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span>

									<span class="kt-menu__link-text">Help</span></a></li>

							<li class="kt-menu__item help_articles" aria-haspopup="true"><a href="{{url('/help_articles')}}" class="kt-menu__link ">
									<span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000" />
												<path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span>

									<span class="kt-menu__link-text">Articles</span></a></li>

							@can('documentation categories menu')
							<li class="kt-menu__item help_categories" aria-haspopup="true"><a href="{{url('/help_categories')}}" class="kt-menu__link ">
									<span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000" />
												<path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg>
									</span>

									<span class="kt-menu__link-text">Categories</span></a></li>

							@endcan
						</ul>
					</div>
				</div>

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
								<div class="kt-header__topbar-user"> <span class="kt-header__topbar-welcome kt-hidden-mobile">{{ __('app.Hi,') }}</span>
									<span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->name }}</span>
									<!--   <img class="" alt="Pic" src="public/{{ Auth::user()->image }}" /> -->
									<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">
										<?php $str = Auth::user()->name; ?>
										<i class="fa fa-user-alt"></i>
									</span>
								</div>
							</div>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
								<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(public/assets/media/misc/bg-1.jpg)">
									<div class="kt-user-card__avatar">
										<!--  <img class="" alt="Pic" src="public/{{ Auth::user()->image }}" /> -->
									</div>
									<div class="kt-user-card__name" style="color: black;">{{ Auth::user()->name }}</div>

								</div>
								<div class="kt-notification">


									<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x">
										<div class="kt-user-card__avatar">
											<img class="kt-hidden2" alt="Pic" src="{{ URL::to('/') }}/public/{{Session::get('profile.0')}}">

											<!-- //Session::get('variableName'); -->


										</div>
										<div class="kt-user-card__name">

										</div>

									</div>




									<div class="kt-notification__custom kt-space-between"> <a class="btn btn-label btn-label-brand btn-sm btn-bold" style="display:none;" href="{{ route('logout') }}" onclick="event.preventDefault();
																																																					document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
										<a href="changepic?id={{ Auth::user()->id }}" target="_blank" class="btn btn-clean btn-sm btn-bold">Change Profile Picture</a>
									</div>
								</div>
							</div>
						</div>

						<!--end: User Bar -->
					</div>

					<!-- end:: Header Topbar -->
				</div>

				<!-- end:: Header -->