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


    <link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets') }}/style.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Skins -->

    <link rel="shortcut icon" href="{{ URL::asset('assets') }}/media/logos/qfavicon.ico" />
    <style>
        html {
            overflow-x: hidden;
        }

        .myavt {
            width: 200px;
            height: 200px;
            display: block;
            border-radius: 50%;
            position: relative;
            top: -45px;
            background-size: cover;
            background-repeat: no-repeat;
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

        .datepicker {
            z-index: 10600 !important;
        }

        .kt-wizard-v1[data-ktwizard-state="last"] [data-ktwizard-type="action-submit"] {
            width: 111px !important;
        }

        .dataTables_scrollBody {
            padding-bottom: 192px !important;
        }

        /* .dataTables_wrapper .dataTable {
            margin-bottom: 123px !important;
        } */

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

        /* pre loader */
        /* * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        } */

        /* body {
            background: #ddd;
            height: 100%;
            overflow-x: hidden;
        } */

        .text {
            color: brown;
            font-size: 220px;
            text-align: center;
        }

        .open {
            color: green;
            background: #000;
            padding: 10px;
            border-radius: 20px;
        }

        /* Preloader */
        .container-preloader {
            align-items: center;
            cursor: none;
            display: flex;
            height: 100%;
            justify-content: center;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            z-index: 900;
        }

        .container-preloader .animation-preloader {
            position: absolute;
            z-index: 100;
        }

        /* Spinner Loading */
        .container-preloader .animation-preloader .spinner {
            animation: spinner 1s infinite linear;
            border-radius: 50%;
            border: 10px solid rgba(0, 0, 0, 0.2);
            border-top-color: green;
            /* It is not in alphabetical order so that you do not overwrite it */
            height: 7em;
            margin: 0 auto 3.5em auto;
            width: 7em;
        }

        /* Loading text */
        .container-preloader .animation-preloader .txt-loading {
            font: bold 2em 'Montserrat', sans-serif;
            text-align: center;
            user-select: none;
        }

        .container-preloader .animation-preloader .txt-loading .characters:before {
            animation: characters 4s infinite;
            color: orange;
            content: attr(preloader-text);
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            transform: rotateY(-90deg);
        }

        .container-preloader .animation-preloader .txt-loading .characters {
            color: rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .container-preloader .animation-preloader .txt-loading .characters:nth-child(2):before {
            animation-delay: 0.2s;
        }

        .container-preloader .animation-preloader .txt-loading .characters:nth-child(3):before {
            animation-delay: 0.4s;
        }

        .container-preloader .animation-preloader .txt-loading .characters:nth-child(4):before {
            animation-delay: 0.6s;
        }

        .container-preloader .animation-preloader .txt-loading .characters:nth-child(5):before {
            animation-delay: 0.8s;
        }

        .container-preloader .animation-preloader .txt-loading .characters:nth-child(6):before {
            animation-delay: 1s;
        }

        .container-preloader .animation-preloader .txt-loading .characters:nth-child(7):before {
            animation-delay: 1.2s;
        }

        .container-preloader .loader-section {
            /* background-color: #ffffff; */
            background-color: #ffffff0f;
            height: 100%;
            position: fixed;
            top: 0;
            width: calc(50% + 1px);
        }

        .container-preloader .loader-section.section-left {
            left: 0;
        }

        .container-preloader .loader-section.section-right {
            right: 0;
        }

        /* Fade effect on loading animation */
        .loaded .animation-preloader {
            opacity: 0;
            transition: 0.3s ease-out;
        }

        /* Curtain effect */
        .loaded .loader-section.section-left {
            transform: translateX(-101%);
            transition: 0.7s 0.3s all cubic-bezier(0.1, 0.1, 0.1, 1.000);
        }

        .loaded .loader-section.section-right {
            transform: translateX(101%);
            transition: 0.7s 0.3s all cubic-bezier(0.1, 0.1, 0.1, 1.000);
        }

        /* Animation of the preloader */
        @keyframes spinner {
            to {
                transform: rotateZ(360deg);
            }
        }

        /* Animation of letters loading from the preloader */
        @keyframes characters {

            0%,
            75%,
            100% {
                opacity: 0;
                transform: rotateY(-90deg);
            }

            25%,
            50% {
                opacity: 1;
                transform: rotateY(0deg);
            }
        }

        /* Laptop size back (laptop, tablet, cell phone) */
        @media screen and (max-width: 767px) {

            /* Preloader */
            /* Spinner Loading */
            .container-preloader .animation-preloader .spinner {
                height: 8em;
                width: 8em;
            }

            /* Text Loading */
            .container-preloader .animation-preloader .txt-loading {
                font: bold 3.5em 'Montserrat', sans-serif;
            }
        }

        @media screen and (max-width: 500px) {

            /* Prelaoder */
            /* Spinner Loading */
            .container-preloader .animation-preloader .spinner {
                height: 7em;
                width: 7em;
            }

            /*Loading text */
            .container-preloader .animation-preloader .txt-loading {
                font: bold 2em 'Montserrat', sans-serif;
            }
        }

        .origin {
            text-decoration: none;
            font-size: 45px;
        }

        /* pre loader */

        /*css time line  */
        .timeline {
            list-style-type: none;
            display: flex;
            align-items: center;
            /* justify-content: center; */
            overflow-x: scroll;
        }

        .li {
            transition: all 200ms ease-in;
        }

        .timestamp {
            margin-bottom: 20px;
            padding: 0px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-weight: 100;
        }

        .status {
            padding: 0px 40px;
            display: flex;
            justify-content: center;
            border-top: 2px solid #D6DCE0;
            position: relative;
            transition: all 200ms ease-in;
        }

        .status h4 {
            font-weight: 600;
        }

        .status:before {
            content: "";
            width: 25px;
            height: 25px;
            background-color: white;
            border-radius: 25px;
            border: 1px solid #ddd;
            position: absolute;
            top: -15px;
            left: 42%;
            transition: all 200ms ease-in;
        }

        .li.complete .status {
            border-top: 2px solid #66DC71;
        }

        .li.complete .status:before {
            background-color: #66DC71;
            border: none;
            transition: all 200ms ease-in;
        }

        .li.complete .status h4 {
            color: #66DC71;
        }



        .li.returned .status {
            border-top: 2px solid #666cdc;
        }

        .li.returned .status:before {
            background-color: #666cdc;
            border: none;
            transition: all 200ms ease-in;
        }

        .li.returned .status h4 {
            color: #666cdc;
        }

        .li.rejected .status {
            border-top: 2px solid red;
        }

        .li.rejected .status:before {
            background-color: #ea2424;
            border: none;
            transition: all 200ms ease-in;
        }

        .li.rejected .status h4 {
            color: #ea2424;
        }



        @media (min-device-width: 320px) and (max-device-width: 700px) {
            .timeline {
                list-style-type: none;
                display: block;
            }

            .li {
                transition: all 200ms ease-in;
                display: flex;
                width: inherit;
            }

            .timestamp {
                width: 100px;
            }

            .status:before {
                left: -8%;
                top: 30%;
                transition: all 200ms ease-in;
            }
        }

        /*  css time line */

        /* data table style  issue */
        .dataTables_scrollHeadInner {
            width: 100% !important;
        }

        .table-responsive {
            min-height: 65vh;
        }

        /* .kt-portlet {
            margin-bottom: 57px;
        } */

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            cursor: pointer;
        }

        .dataTables_wrapper .dataTable td:first-child,
        .dataTables_wrapper .dataTable td:last-child {
            width: 30px !important;
        }

        div.dataTables_wrapper div.dataTables_info {
            padding-top: 0 !important;
            white-space: nowrap;
        }

        /* .kt-wizard-v3 .kt-wizard-v3__nav .kt-wizard-v3__nav-items .kt-wizard-v3__nav-item .kt-wizard-v3__nav-body
        {
            padding: 0rem 0.5rem !important;
        } */
        /* ./ data table style  issue */
    </style>


</head>

<!-- end::Head -->

<!-- begin::Body -->

<body dir="{{($locale =='ar' ? 'rtl' : 'ltr')}}" class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" name="public_path" id="public_path" value="{{ public_path()}}">
    <input type="hidden" name="base_url" id="base_url" value="{{ URL::asset('assets') }}">
    <input type="hidden" name="cur_url" id="cur_url" value="{{ url('/') }}">

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

                            <!--  kt-menu__item--active -->
                            <li class="kt-menu__item warehouse" aria-haspopup="true">
                                <a href="{{url('/warehouse')}}" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">{{ __('app.Dashboard') }}</span>
                                </a>
                            </li>

                            <li class="kt-menu__item  " aria-haspopup="true">
                                <a href="{{url('/')}}/stockMaster1" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">{{ __('warehouse.Stock Master') }}</span>
                                </a>
                            </li>
                            <li class="kt-menu__item  " aria-haspopup="true">
                                <a href="{{url('/')}}/directstocktransfer" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">{{ __('warehouse.Direct Stock Transfer') }}</span>
                                </a>
                            </li>
                            <li class="kt-menu__item  " aria-haspopup="true">
                                <a href="{{url('/')}}/transferapproval" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">{{ __('warehouse.Transfer Approval') }}</span>
                                </a>
                            </li>
                            <li class="kt-menu__item  " aria-haspopup="true">
                                <a href="{{url('/')}}/transferrequests" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span><span class="kt-menu__link-text">{{ __('warehouse.Transfer Requests') }}</span>
                                </a>
                            </li>

                            <!-- 
<li class="kt-menu__item  " aria-haspopup="true">
								<a href="{{url('/')}}/stocktransfer" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span><span class="kt-menu__link-text"> Stock Transfer</span>
								</a>
							</li>
 -->

                            <li class="kt-menu__item  " aria-haspopup="true">
                                <a href="{{url('/')}}/stockin" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">{{ __('warehouse.Purchase Approvals') }} </span>
                                </a>
                            </li>



                            <!-- <li class="kt-menu__item  " aria-haspopup="true">
								<a href="{{url('/')}}/stock_transfer_request_list" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span><span class="kt-menu__link-text">Stock Transfer Requests</span>
								</a>
							</li> -->

                            <!-- 		<li class="kt-menu__item  " aria-haspopup="true"><a href="{{url('/')}}/stockin_history" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span><span class="kt-menu__link-text"> Stock IN</span></a></li> -->
                            <li class="kt-menu__item  " aria-haspopup="true">
                                <a href="{{url('/')}}/stockout" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">{{ __('warehouse.Stock Out') }}</span>
                                </a>
                            </li>

                            <!-- <li class="kt-menu__item  " aria-haspopup="true"><a href="" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span><span class="kt-menu__link-text">Material Request</span></a></li> -->
                            <!-- <li class="kt-menu__item  " aria-haspopup="true"><a href="" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span><span class="kt-menu__link-text">MR Processed</span></a></li> -->
                            <!-- <li class="kt-menu__item  " aria-haspopup="true"><a href="" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span><span class="kt-menu__link-text">Material Dispatch</span></a></li> -->





                            <!-- 	<li class="kt-menu__item  " aria-haspopup="true"><a href="{{url('/')}}/stock_transfer_request_processed" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span><span class="kt-menu__link-text">Received Requestion </span></a></li> -->


                            <!-- <li class="kt-menu__item  " aria-haspopup="true"><a href="{{url('/')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span><span class="kt-menu__link-text">Purchase Order</span></a></li> -->
                            <!-- <li class="kt-menu__item  " aria-haspopup="true"><a href="
                      	" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span><span class="kt-menu__link-text">Delivery Note</span></a></li> -->
                            <!-- <li class="kt-menu__item  " aria-haspopup="true"><a href="" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg></span><span class="kt-menu__link-text">Goods Receipt Note</span></a></li> -->



                            <li class="kt-menu__item  " aria-haspopup="true">
                                <a href="{{url('/stock_adjust_list')}}" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">{{ __('warehouse.Stock Adjustment') }}</span>
                                </a>
                            </li>

                            <li class="kt-menu__item  " aria-haspopup="true">
                                <a href="{{url('/transaction_history')}}" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span><span class="kt-menu__link-text">{{ __('warehouse.Transaction History') }}</span>
                                </a>
                            </li>

                            <li class="kt-menu__item  " aria-haspopup="true">
                                <a href="{{url('/movement_history')}}" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text"> {{ __('warehouse.Movement History') }}</span>
                                </a>
                            </li>
                            <li class="kt-menu__item  " aria-haspopup="true">
                                <a href="{{url('/stock_status')}}" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">{{ __('warehouse.Stock Status') }}</span>
                                </a>
                            </li>
                            <li class="kt-menu__item  " aria-haspopup="true">
                                <a href="{{url('/expired_items')}}" class="kt-menu__link ">
                                    <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">{{ __('warehouse.Expired Items') }}</span>
                                </a>
                            </li>


                            <li class="kt-menu__item  kt-menu__item--submenu procurement" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
                                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg></span><span class="kt-menu__link-text">{{ __('warehouse.Procurement') }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item epr-transfer-request" aria-haspopup="true"><a href="{{url('epr-transfer-request')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('warehouse.EPR From Procurement') }}</span></a></li>

                                        <li class="kt-menu__item stock-transfer-approve-list" aria-haspopup="true"><a href="{{url('stock-transfer-approve-list-warehouse')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('warehouse.Stock Transfer Approval') }}</span></a></li>

                                        <li class="kt-menu__item transfer-stock-list" aria-haspopup="true"><a href="{{url('transfer-stock-list')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('warehouse.Delivery Orders') }}</span></a></li>

                                        <li class="kt-menu__item procurementStockIn" aria-haspopup="true"><a href="{{url('procurement-stock-in')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('warehouse.GRN To Warehouse') }}</span></a></li>

                                    </ul>
                                </div>
                            </li>


                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                    <span class="kt-menu__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M5,2 L19,2 C20.1045695,2 21,2.8954305 21,4 L21,6 C21,7.1045695 20.1045695,8 19,8 L5,8 C3.8954305,8 3,7.1045695 3,6 L3,4 C3,2.8954305 3.8954305,2 5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L16,6 C16.5522847,6 17,5.55228475 17,5 C17,4.44771525 16.5522847,4 16,4 L11,4 Z M7,6 C7.55228475,6 8,5.55228475 8,5 C8,4.44771525 7.55228475,4 7,4 C6.44771525,4 6,4.44771525 6,5 C6,5.55228475 6.44771525,6 7,6 Z" fill="#000000" opacity="0.3" />
                                                <path d="M5,9 L19,9 C20.1045695,9 21,9.8954305 21,11 L21,13 C21,14.1045695 20.1045695,15 19,15 L5,15 C3.8954305,15 3,14.1045695 3,13 L3,11 C3,9.8954305 3.8954305,9 5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L16,13 C16.5522847,13 17,12.5522847 17,12 C17,11.4477153 16.5522847,11 16,11 L11,11 Z M7,13 C7.55228475,13 8,12.5522847 8,12 C8,11.4477153 7.55228475,11 7,11 C6.44771525,11 6,11.4477153 6,12 C6,12.5522847 6.44771525,13 7,13 Z" fill="#000000" />
                                                <path d="M5,16 L19,16 C20.1045695,16 21,16.8954305 21,18 L21,20 C21,21.1045695 20.1045695,22 19,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,18 C3,16.8954305 3.8954305,16 5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L16,20 C16.5522847,20 17,19.5522847 17,19 C17,18.4477153 16.5522847,18 16,18 L11,18 Z M7,20 C7.55228475,20 8,19.5522847 8,19 C8,18.4477153 7.55228475,18 7,18 C6.44771525,18 6,18.4477153 6,19 C6,19.5522847 6.44771525,20 7,20 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="kt-menu__link-text">{{ __('warehouse.Store') }}</span>
                                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        @can('Store Management')
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/StoreManagement" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('warehouse.Store Management') }}</span></a></li>
                                        @endcan
                                        @can('Store Managers')
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/StoreManagers" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('warehouse.Store Managers') }}</span></a></li>
                                        @endcan
                                        @can('Store Keepers')
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/Storekeepers" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('warehouse.Store Keepers') }}</span></a></li>
                                        @endcan

                                        @can('Store In Charge')
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/Storeincharge" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('warehouse.Store In Charge') }}</span></a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M7,5 L17,5 C17.5522847,5 18,5.44771525 18,6 C18,6.55228475 17.5522847,7 17,7 L7,7 C6.44771525,7 6,6.55228475 6,6 C6,5.44771525 6.44771525,5 7,5 Z M7,9 L17,9 C17.5522847,9 18,9.44771525 18,10 C18,10.5522847 17.5522847,11 17,11 L7,11 C6.44771525,11 6,10.5522847 6,10 C6,9.44771525 6.44771525,9 7,9 Z M7,13 L17,13 C17.5522847,13 18,13.4477153 18,14 C18,14.5522847 17.5522847,15 17,15 L7,15 C6.44771525,15 6,14.5522847 6,14 C6,13.4477153 6.44771525,13 7,13 Z M7,17 L17,17 C17.5522847,17 18,17.4477153 18,18 C18,18.5522847 17.5522847,19 17,19 L7,19 C6.44771525,19 6,18.5522847 6,18 C6,17.4477153 6.44771525,17 7,17 Z" fill="#000000" opacity="0.3" />
                                                <path d="M5.5,2 C6.32842712,2 7,2.67157288 7,3.5 L7,20.5 C7,21.3284271 6.32842712,22 5.5,22 C4.67157288,22 4,21.3284271 4,20.5 L4,3.5 C4,2.67157288 4.67157288,2 5.5,2 Z M18.5,2 C19.3284271,2 20,2.67157288 20,3.5 L20,20.5 C20,21.3284271 19.3284271,22 18.5,22 C17.6715729,22 17,21.3284271 17,20.5 L17,3.5 C17,2.67157288 17.6715729,2 18.5,2 Z" fill="#000000" />
                                            </g>
                                        </svg></span><span class="kt-menu__link-text">{{ __('warehouse.Rack') }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        @can('Rack Management')
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/RackManagement" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('warehouse.Rack Management') }}</span></a></li>
                                        @endcan

                                        @can('Rack Managers')
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/rackmanager" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('warehouse.Rack Managers') }}</span></a></li>
                                        @endcan

                                        @can('Rack In Charge')
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/rackincharge" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('warehouse.Rack In Charge') }}</span></a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>



                            <!-- <li class="kt-menu__item {{ request()->is('AssetNotifciations') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{url('/')}}/AssetNotifciations" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M6.84712709,9 L17.1528729,9 C17.6417121,9 18.0589022,9.35341304 18.1392668,9.83560101 L19.611867,18.671202 C19.7934571,19.7607427 19.0574178,20.7911977 17.9678771,20.9727878 C17.8592143,20.9908983 17.7492409,21 17.6390792,21 L6.36092084,21 C5.25635134,21 4.36092084,20.1045695 4.36092084,19 C4.36092084,18.8898383 4.37002252,18.7798649 4.388133,18.671202 L5.86073316,9.83560101 C5.94109783,9.35341304 6.35828794,9 6.84712709,9 Z" fill="#000000"/>
    </g>
</svg></span><span class="kt-menu__link-text">Notifciations</span></a></li> -->





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

                            <!--New Change 09/03/2023 -->

                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl shadow">

                                <!--begin: Head -->
                                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ url('') }}/public/misc/bg-1.jpg); height:100px;">
                                    <div class="kt-user-card__avatar">
                                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->

                                    </div>
                                    <div class="kt-user-card__name">

                                    </div>
                                    <div class="kt-user-card__badge">

                                    </div>
                                </div>
                                <div class="col-12" style="height: 168px;">
                                    <div class="mx-auto myavt" style="background-image: url('{{url('public')}}/{{ $usr->image }}');">

                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="kt-notification__item-details pb-3">
                                        <div class="kt-notification__item-icon text-center mx-auto">
                                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                                        </div>
                                        <div class="kt-notification__item-title kt-font-bold text-center">
                                            {{ Auth::user()->name }}
                                        </div>

                                    </div>
                                    <!-- <div class="kt-notification__item-detailss pb-3">

                                        <div class="kt-notification__item-title kt-font-bold  text-center">
                                            Department
                                        </div>
                                        <div class="kt-notification__item-time text-center">
                                            Stock
                                        </div>
                                    </div> -->
                                    <!-- <div class="kt-notification__item-details s pb-3">

                                        <div class="kt-notification__item-title kt-font-bold text-center">
                                            Discription
                                        </div>
                                        <div class="kt-notification__item-time text-center">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </div>
                                    </div> -->
                                </div>


                                <!--end: Head -->

                                <!--begin: Navigation -->
                                <div class="kt-notification">




                                    <div class="kt-notification__custom kt-space-between">
                                        <a class="btn btn-label btn-label-brand btn-sm btn-bold" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                        <button class="btn btn-label btn-label-brand btn-sm btn-bold changeProfile">Profile Settings</button>
                                    </div>
                                </div>

                                <!--end: Navigation -->
                            </div>

                            <!--New Change 09/03/2023 -->



                            <!--<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(public/assets/media/misc/bg-1.jpg)">
                                    <div class="kt-user-card__avatar">
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


                            </div>-->
                        </div>

                        <!--end: User Bar -->
                    </div>

                    <!-- end:: Header Topbar -->
                </div>

                <!-- end:: Header -->

                <!-- pre loadder -->
                <div id="preloaderContainer" style="display: none;">
                    <div id="container" class="container-preloader">
                        <div class="animation-preloader">
                            <div class="spinner"></div>
                            <div class="txt-loading">
                                <span preloader-text="P" class="characters">P</span>
                                <span preloader-text="R" class="characters">R</span>
                                <span preloader-text="O" class="characters">O</span>
                                <span preloader-text="C" class="characters">C</span>
                                <span preloader-text="E" class="characters">E</span>
                                <span preloader-text="S" class="characters">S</span>
                                <span preloader-text="S" class="characters">S</span>
                                <span preloader-text="I" class="characters">I</span>
                                <span preloader-text="N" class="characters">N</span>
                                <span preloader-text="G" class="characters">G</span>
                                <span preloader-text="." class="characters">.</span>
                                <span preloader-text="." class="characters">.</span>
                                <span preloader-text="." class="characters">.</span>
                            </div>
                        </div>
                        <div class="loader-section section-left"></div>
                        <div class="loader-section section-right"></div>
                    </div>
                </div>
                <!-- ./pre loader -->