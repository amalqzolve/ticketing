<!DOCTYPE html>
@php $locale = session()->get('locale'); @endphp
<html lang="{{$locale}}">

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
</head>
<style>
   /* html {
      overflow-x: hidden;
   }

   body {
      font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif !important;
      line-height: 1;
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

   .dataTables_wrapper .dataTables_paginate .current {
      background-color: #5d78ff !important;
      color: #fff;
   }

   .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background-color: #5d78ff !important;
      color: #fff;
      opacity: 0.6;
   }

   .kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item .kt-wizard-v1__nav-body .kt-wizard-v1__nav-icon {
      font-size: 2.7rem !important;
   }

   .kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form .kt-form__actions [data-ktwizard-type="action-prev"] {
      right: 213px !important;
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

   label {
      display: inline-block;
      margin-bottom: 0.25rem;
      margin-top: 0.5rem;
   }

   @media (min-width: 1025px) {
      .kt-header--fixed.kt-subheader--fixed.kt-subheader--enabled .kt-wrapper {
         padding-top: 60px;
      }
   }

   input[type="search"] {
      padding: 1px 2px;
      height: 29px;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #e2e5ec;
      border-radius: 4px;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
   }

   .btn {
      padding: 0.35rem 1rem;
   }

   .form-control {
      height: calc(1.5em + 1rem + 2px) !important;
      padding: 0.5rem 1rem !important;
      font-size: 0.875rem !important;
      line-height: 1.5 !important;
      border-radius: 0.2rem !important;
   }

   .paginate_button:hover {
      cursor: pointer;
   }

   label {
      margin-bottom: 0.25rem;
   }

   input[type="radio"],
   input[type="checkbox"] {
      height: calc(0.5em + 1rem + 2px) !important;
   }

   #kt_header_mobile_toggler {
      display: none;
   }

   .kt-header-mobile .kt-header-mobile__toolbar .kt-header-mobile__toggler {
      right: 101px;
   }

   .dataTables_length {
      position: absolute;
   }

   .select2-selection.select2-selection--single.is-invalid {
      border: 1px solid #ff003b;
   }

   .is-invalid {
      border: 1px solid #ff003b;
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

   table.dataTable thead>tr>th {
      white-space: nowrap !important;
   }

   .btn.kt-spinner:not(.kt-spinner--center) {
      padding-left: 1rem;
   }

   .kt-wizard-v1[data-ktwizard-state="last"] [data-ktwizard-type="action-submit"] {
      right: 60px !important;
   }

   .dataTables_scrollBody {
      padding-bottom: 123px !important;
   }

   .dataTables_wrapper .dataTable {
      margin-bottom: 123px !important;
   }



   .btn.kt-spinner.kt-spinner--right {
      right: 0px !important;
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
      width: 150px !important;
      padding: 0.35rem 1rem;
   }

   .ribbon-2 {
      padding: 10px 6px 5px 26px;
   }

   input[type="search"]:focus-visible {
      border-color: #9aabff !important;
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

   div.dataTables_wrapper div.dataTables_filter {
      text-align: right;
   }

   .kt-portlet {
      margin-bottom: 0 !important;
   }

   .kt-wizard-v3 .kt-wizard-v3__wrapper .kt-form .kt-wizard-v3__content {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
   }

   .dataTable tr>th:last-child,
   .dataTable tr>td:last-child {
      width: 55px !important;
   }

   .dataTable tr>td:last-child>span,
   .dataTable tr>td:last-child>span>div.dropdown,
   .dataTable tr>td:last-child>span>div.dropdown>a.btn {
      width: 55px !important;
      display: block;
   }

  */


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

   .datepicker {
      z-index: 100 !important;
   }

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

   .hideButton {
      display: none
   }

   .error {
      color: red
   }
</style>

<body dir="{{($locale =='ar' ? 'rtl' : 'ltr')}}" class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
   <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
   <input type="hidden" name="public_path" id="public_path" value="{{ public_path()}}">
   <input type="hidden" name="base_url" id="base_url" value="{{ URL::asset('assets') }}">
   <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
      <div class="kt-header-mobile__logo">
         <!-- <img alt="Logo" src="{{ URL::asset('assets') }}/media/logos/logo-light.png" /> -->
         <img alt="Logo" src="{{url('public')}}/login_logo/alim-sidebar-logo.png" />
      </div>
      <div class="kt-header-mobile__toolbar">
         <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span>
         </button>
         <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span>
         </button>
         <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i>
         </button>
      </div>
   </div>
   <div class="kt-grid kt-grid--hor kt-grid--root">
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
         <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
            <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
               <div class="kt-aside__brand-logo">
                  <!-- <img alt="Logo" src="{{ URL::asset('assets') }}/media/logos/logo-light.png" /> -->
                  <img alt="Logo" src="{{url('public')}}/login_logo/alim-sidebar-logo.png" />
               </div>
               <div class="kt-aside__brand-tools">
                  <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                     <span>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24" />
                              <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                              <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                           </g>
                        </svg>
                     </span>
                     <span>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24" />
                              <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                              <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" ransform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                           </g>
                        </svg>
                     </span>
                  </button>
               </div>
            </div>
            <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
               <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
                  <ul class="kt-menu__nav ">
                     <!-- kt-menu__item--active -->
                     <li class="kt-menu__item crm  " aria-haspopup="true">
                        <a href="{{url('crm')}}" class="kt-menu__link ">
                           <span class="kt-menu__link-icon">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                    <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                 </g>
                              </svg>
                           </span>
                           <span class="kt-menu__link-text">@lang('customer.Dashboard')</span>
                        </a>
                     </li>

                     <li class="kt-menu__item  kt-menu__item--submenu CustomerManagement" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                           <span class="kt-menu__link-icon">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M6.84712709,9 L17.1528729,9 C17.6417121,9 18.0589022,9.35341304 18.1392668,9.83560101 L19.611867,18.671202 C19.7934571,19.7607427 19.0574178,20.7911977 17.9678771,20.9727878 C17.8592143,20.9908983 17.7492409,21 17.6390792,21 L6.36092084,21 C5.25635134,21 4.36092084,20.1045695 4.36092084,19 C4.36092084,18.8898383 4.37002252,18.7798649 4.388133,18.671202 L5.86073316,9.83560101 C5.94109783,9.35341304 6.35828794,9 6.84712709,9 Z" fill="#000000" />
                                 </g>
                              </svg>
                           </span>
                           <span class="kt-menu__link-text">@lang('customer.Customer Management')</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu ">
                           <span class="kt-menu__arrow"></span>
                           <ul class="kt-menu__subnav">
                              <li class="kt-menu__item customerdetails" aria-haspopup="true"><a href="{{url('customerdetails')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text"> @lang('customer.Customer Information')</span></a></li>
                              <li class="kt-menu__item crmcustomerdocuments" aria-haspopup="true"><a href="{{url('crmcustomerdocuments')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">@lang('customer.Documents & Contracts')</span></a></li>
                              <li class="kt-menu__item customeraccounts" aria-haspopup="true"><a href="{{url('customeraccounts')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">@lang('customer.Accounting Configuration')</span></a></li>
                           </ul>
                        </div>
                     </li>

                     <li class="kt-menu__item  kt-menu__item--submenu SupplierManagement" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                           <span class="kt-menu__link-icon">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
                                    <path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000" />
                                 </g>
                              </svg>
                           </span>
                           <span class="kt-menu__link-text">@lang('supplier.Supplier Management')</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu ">
                           <span class="kt-menu__arrow"></span>
                           <ul class="kt-menu__subnav">
                              <li class="kt-menu__item supplierdetails" aria-haspopup="true"><a href="{{url('supplierdetails')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">@lang('supplier.Supplier Information')</span></a></li>
                              <li class="kt-menu__item supplierdocuments" aria-haspopup="true"><a href="{{url('supplierdocuments')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">@lang('supplier.Documents & Contracts')</span></a></li>
                              <li class="kt-menu__item supplier-bank-account" aria-haspopup="true"><a href="{{url('supplier-bank-account')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('supplier.Bank Account') }}</span></a></li>
                              <li class="kt-menu__item supplieraccounts" aria-haspopup="true"><a href="{{url('supplieraccounts')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('supplier.Accounting Configuration') }}</span></a></li>
                           </ul>
                        </div>
                     </li>

                     <li class="kt-menu__item  kt-menu__item--submenu SKMManagement" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                           <span class="kt-menu__link-icon">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                 </g>
                              </svg>
                           </span>
                           <span class="kt-menu__link-text">@lang('salesman.SKM Management')</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu ">
                           <span class="kt-menu__arrow"></span>
                           <ul class="kt-menu__subnav">
                              <li class="kt-menu__item salesmanroutesettings " aria-haspopup="true"><a href="{{url('salesmanroutesettings')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('salesman.Salesman Route Details') }}</span></a></li>
                              <li class="kt-menu__item salesmandetailssettings " aria-haspopup="true"><a href="{{url('salesmandetailssettings')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text"> {{ __('salesman.Salesman Details') }}</span></a></li>
                              <!-- <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('salesdepartment')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text"> {{ __('app.Salesman Department') }}</span></a></li>
                              <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text"> {{ __('app.Key Accounts Information') }}</span></a></li>
                              <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('salesmanaccounts')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text"> {{ __('app.Key Accounts Information') }}</span></a></li> -->
                           </ul>
                        </div>
                     </li>

                     <li class="kt-menu__item  kt-menu__item keysalesmandetailssettings" aria-haspopup="true">
                        <a href="{{url('keysalesmandetailssettings')}}" class="kt-menu__link ">
                           <span class="kt-menu__link-icon">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                    <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                 </g>
                              </svg>
                           </span>
                           <span class="kt-menu__link-text">@lang('customer.Key Accountant Managment')</span>
                        </a>
                     </li>

                     <li class="kt-menu__item  kt-menu__item--submenu CRMSettings" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M19,11 L20,11 C21.6568542,11 23,12.3431458 23,14 C23,15.6568542 21.6568542,17 20,17 L19,17 L19,20 C19,21.1045695 18.1045695,22 17,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,17 L5,17 C6.65685425,17 8,15.6568542 8,14 C8,12.3431458 6.65685425,11 5,11 L3,11 L3,8 C3,6.8954305 3.8954305,6 5,6 L8,6 L8,5 C8,3.34314575 9.34314575,2 11,2 C12.6568542,2 14,3.34314575 14,5 L14,6 L17,6 C18.1045695,6 19,6.8954305 19,8 L19,11 Z" fill="#000000" opacity="0.3" />
                                 </g>
                              </svg></span><span class="kt-menu__link-text">@lang('app.CRM Settings') </span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                           <ul class="kt-menu__subnav">

                              <li class="kt-menu__item  kt-menu__item--submenu CustomerSettings" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">@lang('app.Customer Settings')</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                 <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                       <li class="kt-menu__item settingscustomergroup" aria-haspopup="true"><a href="{{url('settingscustomergroup')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('customer.Customer Group') }}</span></a></li>
                                       <li class="kt-menu__item settingscustomercategorydetails" aria-haspopup="true"><a href="{{url('settingscustomercategorydetails')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('customer.Customer Category') }}</span></a></li>
                                       <li class="kt-menu__item settingscustomertypedetails" aria-haspopup="true"><a href="{{url('settingscustomertypedetails')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('customer.Customer Type') }}</span></a></li>
                                    </ul>
                                 </div>
                              </li>

                           </ul>
                           <!-- <ul class="kt-menu__subnav">
                              <li class="kt-menu__item  kt-menu__item--submenu SupplierSettings" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">@lang('app.Supplier Settings')</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                 <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                       <li class="kt-menu__item settingssuppliergroup" aria-haspopup="true"><a href="{{url('settingssuppliergroup')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('supplier.Supplier Group') }}</span></a></li>
                                       <li class="kt-menu__item settingssuppliercategory" aria-haspopup="true"><a href="{{url('settingssuppliercategory')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">@lang('app.Supplier Category')</span></a></li>
                                       <li class="kt-menu__item settingssupplier_type" aria-haspopup="true"><a href="{{url('settingssupplier_type')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('supplier.Supplier Type') }}</span></a></li>
                                    </ul>
                                 </div>
                              </li>

                           </ul> -->
                           <ul class="kt-menu__subnav">
                           </ul>
                        </div>
                     </li>

                     <li class="kt-menu__item  kt-menu__item--submenu DataMigrations" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                           <span class="kt-menu__link-icon">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
                                    <path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000" />
                                 </g>
                              </svg>
                           </span>
                           <span class="kt-menu__link-text">{{ __('supplier.Data Migrations') }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu ">
                           <span class="kt-menu__arrow"></span>
                           <ul class="kt-menu__subnav">
                              <li class="kt-menu__item customerdatamigration" aria-haspopup="true"><a href="{{url('customerdatamigration')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('supplier.Customer') }}</span></a></li>
                              <li class="kt-menu__item supplierdatamigration" aria-haspopup="true"><a href="{{url('supplierdatamigration')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('supplier.Supplier') }}</span></a></li>
                           </ul>
                        </div>
                     </li>

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
                  <div class="kt-header__topbar-item kt-header__topbar-item--quick-panel" data-toggle="kt-tooltip" title="Home" data-placement="right" href="">
                     <a href="{{url('/')}}" style="margin-top: 10px;">
                        <span class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn">
                           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                 <rect x="0" y="0" width="24" height="24" />
                                 <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                 <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                              </g>
                           </svg>
                        </span>
                     </a>
                  </div>
                  <div class="kt-header__topbar-item kt-header__topbar-item--langs">
                     <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">@php $locale =
                        session()->get('locale'); @endphp @switch($locale) @case('es') <span class="kt-header__topbar-icon">
                           <img class="" src="{{ URL::asset('') }}/assets/media/flags/162-germany.svg" alt="" />
                        </span>
                        @break @default <span class="kt-header__topbar-icon">
                           <img class="" src="{{ URL::asset('') }}/assets/media/flags/226-united-states.svg" alt="" />
                        </span>
                        @endswitch
                     </div>
                     <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
                        <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                           <li class="kt-nav__item">
                              <a href="setlocale/ar" class="kt-nav__link"> <span class="kt-nav__link-icon"><img src="{{ URL::asset('') }}/assets/media/flags/162-germany.svg" alt="" /></span>
                                 <span class="kt-nav__link-text">Arabic</span>
                              </a>
                           </li>
                           <li class="kt-nav__item kt-nav__item--active">
                              <a href="setlocale/en" class="kt-nav__link"> <span class="kt-nav__link-icon"><img src="{{ URL::asset('') }}/assets/media/flags/226-united-states.svg" alt="" /></span>
                                 <span class="kt-nav__link-text">English</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="kt-header__topbar-item kt-header__topbar-item--user">
                     <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                        <div class="kt-header__topbar-user">
                           <span class="kt-header__topbar-welcome kt-hidden-mobile">{{ __('app.Hi,') }}</span>
                           <span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->name }}</span>
                           <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">
                              <?php $str = Auth::user()->name; ?>
                              <i class="fa fa-user-alt"></i>
                           </span>
                        </div>
                     </div>
                     <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                        <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(public/assets/media/misc/bg-1.jpg)">
                           <div class="kt-user-card__avatar">
                           </div>
                           <div class="kt-user-card__name" style="color: black;">{{ Auth::user()->name }}</div>
                        </div>

                        <!-- <div class="kt-notification">
                        <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ URL::asset('') }}/public/assets/media/misc/bg-1.jpg)">
                           <div class="kt-user-card__avatar">
                              <img class="kt-hidden2" alt="Pic" src="{{ URL::to('/') }}/public/{{Session::get('profile.0')}}">
                           </div>
                           <div class="kt-user-card__name">
                           </div>
                        </div>
                        <div class="kt-notification__custom kt-space-between">
                           <a class="btn btn-label btn-label-brand btn-sm btn-bold" style="display:none;" href="{{ route('logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                           </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                           <a href="changepic?id={{ Auth::user()->id }}" target="_blank" class="btn btn-clean btn-sm btn-bold">Change Profile Picture</a>
                        </div>
                     </div> -->

                        <div class="kt-notification">
                           <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x">
                              <div class="kt-user-card__avatar">
                                 <img class="kt-hidden2" alt="Pic" src="{{ URL::to('/') }}/public/{{Auth::user()->image}}">
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
               </div>
            </div>