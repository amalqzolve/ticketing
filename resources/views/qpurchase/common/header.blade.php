<!DOCTYPE html>
@php $locale = session()->get('locale'); $usr=Auth::user(); @endphp
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

    <link href="{{ URL::asset('assets') }}/style.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Skins -->

    <link rel="shortcut icon" href="{{ URL::asset('assets') }}/media/logos/qfavicon.ico" />

    <!--  -->
    <link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/public/assets/css/pages/wizard/wizard-3.css" rel="stylesheet" type="text/css" />

    <!--  -->
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

        .select-dropdown-error {
            border: 1px solid #fd397a !important;

        }

        .kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form {
            width: 95%;
        }

        .kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form {
            width: 95% !important;
            padding: 0rem 0 5rem !important;
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
            color: #fff;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #5d78ff !important;
            color: #fff;
            opacity: 0.6;
        }

        .kt-footer {
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        table.dataTable thead>tr>th {
            white-space: nowrap !important;
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

        .dataTables_wrapper .dataTable td {
            white-space: nowrap !important;
        }

        /* .datepicker {
            z-index: 100 !important;
        } */

        .kt-wizard-v1[data-ktwizard-state="last"] [data-ktwizard-type="action-submit"] {
            width: 111px !important;
        }

        .dataTables_scrollBody {
            padding-bottom: 192px !important;
        }


        .kt-section .kt-section__content.kt-section__content--solid {
            display: none;
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

        .right-gap {
            margin-right: 120Px !important;
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

            <img alt="Logo" src="{{ URL::asset('assets') }}/media/logos/logo-light.png" />

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

                        <img alt="Logo" src="{{ URL::asset('assets') }}/media/logos/logo-light.png" />

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

                            <li class="kt-menu__item  {{ request()->is('qpurchase_dashboard') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{url('qpurchase_dashboard')}}" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">@lang('app.Dashboard')</span>
                                </a>
                            </li>


                            <li class="kt-menu__item qpurchase_order {{ request()->is('qpurchase_order') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{url('/')}}/qpurchase_order" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M6.84712709,9 L17.1528729,9 C17.6417121,9 18.0589022,9.35341304 18.1392668,9.83560101 L19.611867,18.671202 C19.7934571,19.7607427 19.0574178,20.7911977 17.9678771,20.9727878 C17.8592143,20.9908983 17.7492409,21 17.6390792,21 L6.36092084,21 C5.25635134,21 4.36092084,20.1045695 4.36092084,19 C4.36092084,18.8898383 4.37002252,18.7798649 4.388133,18.671202 L5.86073316,9.83560101 C5.94109783,9.35341304 6.35828794,9 6.84712709,9 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">Purchase Order</span>
                                </a>
                            </li>

                            <li class="kt-menu__item qpurchasegrn {{ request()->is('qpurchasegrn') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{url('/')}}/qpurchasegrn" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M6.84712709,9 L17.1528729,9 C17.6417121,9 18.0589022,9.35341304 18.1392668,9.83560101 L19.611867,18.671202 C19.7934571,19.7607427 19.0574178,20.7911977 17.9678771,20.9727878 C17.8592143,20.9908983 17.7492409,21 17.6390792,21 L6.36092084,21 C5.25635134,21 4.36092084,20.1045695 4.36092084,19 C4.36092084,18.8898383 4.37002252,18.7798649 4.388133,18.671202 L5.86073316,9.83560101 C5.94109783,9.35341304 6.35828794,9 6.84712709,9 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">Goods Receipt Note</span>
                                </a>
                            </li>

                            <li class="kt-menu__item qpurchaseinvoice {{ request()->is('qpurchaseinvoice') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{url('/')}}/qpurchaseinvoice" class="kt-menu__link "><span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M6.84712709,9 L17.1528729,9 C17.6417121,9 18.0589022,9.35341304 18.1392668,9.83560101 L19.611867,18.671202 C19.7934571,19.7607427 19.0574178,20.7911977 17.9678771,20.9727878 C17.8592143,20.9908983 17.7492409,21 17.6390792,21 L6.36092084,21 C5.25635134,21 4.36092084,20.1045695 4.36092084,19 C4.36092084,18.8898383 4.37002252,18.7798649 4.388133,18.671202 L5.86073316,9.83560101 C5.94109783,9.35341304 6.35828794,9 6.84712709,9 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">{{ __('app.Purchase Invoice') }}</span>
                                </a>
                            </li>

                            <!-- <li class="kt-menu__item qpurchaselist" aria-haspopup="true"><a href="{{url('/')}}/qpurchaselist" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="2" y="6" width="21" height="12" rx="6" />
                                                <circle fill="#000000" cx="17" cy="12" r="4" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text"> Purchase Bills</span>
                                </a>
                            </li> -->




                            <!-- <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="4" y="4" width="4" height="4" rx="1" />
                                                <path d="M5,10 L7,10 C7.55228475,10 8,10.4477153 8,11 L8,13 C8,13.5522847 7.55228475,14 7,14 L5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 L14,7 C14,7.55228475 13.5522847,8 13,8 L11,8 C10.4477153,8 10,7.55228475 10,7 L10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,10 L13,10 C13.5522847,10 14,10.4477153 14,11 L14,13 C14,13.5522847 13.5522847,14 13,14 L11,14 C10.4477153,14 10,13.5522847 10,13 L10,11 C10,10.4477153 10.4477153,10 11,10 Z M17,4 L19,4 C19.5522847,4 20,4.44771525 20,5 L20,7 C20,7.55228475 19.5522847,8 19,8 L17,8 C16.4477153,8 16,7.55228475 16,7 L16,5 C16,4.44771525 16.4477153,4 17,4 Z M17,10 L19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 L17,14 C16.4477153,14 16,13.5522847 16,13 L16,11 C16,10.4477153 16.4477153,10 17,10 Z M5,16 L7,16 C7.55228475,16 8,16.4477153 8,17 L8,19 C8,19.5522847 7.55228475,20 7,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,17 C4,16.4477153 4.44771525,16 5,16 Z M11,16 L13,16 C13.5522847,16 14,16.4477153 14,17 L14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 L10,17 C10,16.4477153 10.4477153,16 11,16 Z M17,16 L19,16 C19.5522847,16 20,16.4477153 20,17 L20,19 C20,19.5522847 19.5522847,20 19,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,17 C16,16.4477153 16.4477153,16 17,16 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">Vouchers</span>
                                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="kt-menu__submenu ">
                                    <span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/buy_vouchers" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Voucher Entry</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('voucehersettings')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Voucher Settings</span></a></li>
                                    </ul>
                                </div>
                            </li> -->

                            <!-- <li class="kt-menu__item" aria-haspopup="true">
                                <a href="{{url('/')}}/qpurchase_creditnote" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="2" y="6" width="21" height="12" rx="6" />
                                                <circle fill="#000000" cx="17" cy="12" r="4" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">Credit Note</span>
                                </a>
                            </li> -->

                            <li class="kt-menu__item qpurchase-return" aria-haspopup="true">
                                <a href="{{url('qpurchase-return')}}" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="2" y="6" width="21" height="12" rx="6" />
                                                <circle fill="#000000" cx="17" cy="12" r="4" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">Purchase Return</span>
                                </a>
                            </li>

                            <li class="kt-menu__item  kt-menu__item--submenu PaymentVoucher" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="4" y="4" width="4" height="4" rx="1" />
                                                <path d="M5,10 L7,10 C7.55228475,10 8,10.4477153 8,11 L8,13 C8,13.5522847 7.55228475,14 7,14 L5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 L14,7 C14,7.55228475 13.5522847,8 13,8 L11,8 C10.4477153,8 10,7.55228475 10,7 L10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,10 L13,10 C13.5522847,10 14,10.4477153 14,11 L14,13 C14,13.5522847 13.5522847,14 13,14 L11,14 C10.4477153,14 10,13.5522847 10,13 L10,11 C10,10.4477153 10.4477153,10 11,10 Z M17,4 L19,4 C19.5522847,4 20,4.44771525 20,5 L20,7 C20,7.55228475 19.5522847,8 19,8 L17,8 C16.4477153,8 16,7.55228475 16,7 L16,5 C16,4.44771525 16.4477153,4 17,4 Z M17,10 L19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 L17,14 C16.4477153,14 16,13.5522847 16,13 L16,11 C16,10.4477153 16.4477153,10 17,10 Z M5,16 L7,16 C7.55228475,16 8,16.4477153 8,17 L8,19 C8,19.5522847 7.55228475,20 7,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,17 C4,16.4477153 4.44771525,16 5,16 Z M11,16 L13,16 C13.5522847,16 14,16.4477153 14,17 L14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 L10,17 C10,16.4477153 10.4477153,16 11,16 Z M17,16 L19,16 C19.5522847,16 20,16.4477153 20,17 L20,19 C20,19.5522847 19.5522847,20 19,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,17 C16,16.4477153 16.4477153,16 17,16 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                    </span><span class="kt-menu__link-text">Payment Voucher</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <!-- <li class="kt-menu__item qpurchase-opening-balance-index" aria-haspopup="true"><a href="{{url('/')}}/qpurchase-opening-balance-index" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Opening Balance</span></a></li> -->
                                        <li class="kt-menu__item qpurchase_advancepayment" aria-haspopup="true"><a href="{{url('/')}}/qpurchase_advancepayment" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Advance Payment</span></a></li>
                                        <li class="kt-menu__item qpurchase-bill-settlement-list" aria-haspopup="true"><a href="{{url('qpurchase-bill-settlement-list')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Bill Settlement</span></a></li>
                                        <li class="kt-menu__item qpurchase-refund-list" aria-haspopup="true"><a href="{{url('qpurchase-refund-list')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Refund</span></a></li>
                                    </ul>
                                </div>
                            </li>


                            <!-- <li class="kt-menu__item" aria-haspopup="true">
                                <a href="{{url('/')}}/salesmanage" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="2" y="6" width="21" height="12" rx="6" />
                                                <circle fill="#000000" cx="17" cy="12" r="4" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">Sales Management</span>
                                </a>
                            </li> -->

                            <!-- <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="4" y="4" width="4" height="4" rx="1" />
                                                <path d="M5,10 L7,10 C7.55228475,10 8,10.4477153 8,11 L8,13 C8,13.5522847 7.55228475,14 7,14 L5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 L14,7 C14,7.55228475 13.5522847,8 13,8 L11,8 C10.4477153,8 10,7.55228475 10,7 L10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,10 L13,10 C13.5522847,10 14,10.4477153 14,11 L14,13 C14,13.5522847 13.5522847,14 13,14 L11,14 C10.4477153,14 10,13.5522847 10,13 L10,11 C10,10.4477153 10.4477153,10 11,10 Z M17,4 L19,4 C19.5522847,4 20,4.44771525 20,5 L20,7 C20,7.55228475 19.5522847,8 19,8 L17,8 C16.4477153,8 16,7.55228475 16,7 L16,5 C16,4.44771525 16.4477153,4 17,4 Z M17,10 L19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 L17,14 C16.4477153,14 16,13.5522847 16,13 L16,11 C16,10.4477153 16.4477153,10 17,10 Z M5,16 L7,16 C7.55228475,16 8,16.4477153 8,17 L8,19 C8,19.5522847 7.55228475,20 7,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,17 C4,16.4477153 4.44771525,16 5,16 Z M11,16 L13,16 C13.5522847,16 14,16.4477153 14,17 L14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 L10,17 C10,16.4477153 10.4477153,16 11,16 Z M17,16 L19,16 C19.5522847,16 20,16.4477153 20,17 L20,19 C20,19.5522847 19.5522847,20 19,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,17 C16,16.4477153 16.4477153,16 17,16 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">Cost Settings</span>
                                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/buy_account_head" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Account Head</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/CostHead" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">@lang('app.Cost Head')</span></a></li>
                                    </ul>
                                </div>
                            </li> -->


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
                                            <img class="kt-hidden2" alt="Pic" src="{{url('public')}}/{{ $usr->image }}">
                                        </div>
                                        <div class="kt-user-card__name">

                                        </div>

                                    </div>
                                    <div class="kt-notification__custom kt-space-between">
                                        <a class="btn btn-label btn-label-brand btn-sm btn-bold" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                        <li class="btn btn-clean btn-sm btn-bold changeProfile">Profile Settings</li>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!--end: User Bar -->
                    </div>

                    <!-- end:: Header Topbar -->
                </div>

                <!-- end:: Header -->