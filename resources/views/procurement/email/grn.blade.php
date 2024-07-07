<html>

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
  table img {
    display: block;
    width: 100%;
    height: auto;
  }

  * {
    font-family: 'Tajawal', sans-serif;
  }

  h1 {
    font-size: 24px;
  }

  h4 {
    font-size: 12px;
  }

  th {
    padding: 0px !important;
  }

  p {
    margin: 0 0 -14px;
  }

  .panel {
    margin-bottom: 10px !important;
    border-color: white;
    box-shadow: none;
  }

  h1 {
    letter-spacing: 0.5em;
    text-align: center;
    text-transform: uppercase;
  }

  /* table */
  table {
    font-size: 12px;
    table-layout: fixed;
    width: 100%;
  }

  table {
    border-collapse: separate;
    border-spacing: 2px;
  }

  th,
  td {
    border-width: 1px;
    padding: 0.1em;
    position: relative;
    text-align: left;
  }

  th,
  td {
    border-radius: 0.25em;
    border-style: solid;
  }

  th {
    background: #EEE;
    border-color: #BBB;
  }

  td {
    border-color: #DDD;
  }

  /* header */
  /* table meta & balance */
  table.meta,
  table.balance {
    float: right;
    width: 36%;
  }

  table.meta:after,
  table.balance:after {
    clear: both;
    content: "";
    display: table;
  }

  /* table meta */
  table.meta th {
    width: 40%;
  }

  table.meta td {
    width: 60%;
  }

  /* table items */
  table.inventory {
    clear: both;
    width: 100%;
  }

  table.inventory th {
    text-align: center;
  }

  table.inventory td:nth-child(1) {
    width: 26%;
  }

  table.inventory td:nth-child(2) {
    width: 38%;
  }

  table.inventory td:nth-child(3) {
    text-align: right;
    width: 12%;
  }

  table.inventory td:nth-child(4) {
    text-align: right;
    width: 12%;
  }

  table.inventory td:nth-child(5) {
    text-align: right;
    width: 12%;
  }

  /* table balance */
  table.balance th,
  table.balance td {
    width: 50%;
  }

  table.balance td {
    text-align: right;
  }

  tr:hover .cut {
    opacity: 1;
  }

  @media print {
    * {
      -webkit-print-color-adjust: exact;
    }

    html {
      background: none;
      padding: 0;
    }

    body {
      box-shadow: none;
      margin: 0;
      font-family: 'Tajawal', sans-serif;
    }

    span:empty {
      display: none;
    }

    .add,
    .cut {
      display: none;
      padding: 0;
    }
  }

  @page {
    margin: 5px;
  }

  body {
    font-size: 12px;
    font-family: 'Tajawal', sans-serif;
  }

  table {
    font-size: 11px;
    font-family: 'Tajawal', sans-serif;
  }

  td {
    font-size: 12px;
    font-family: 'Tajawal', sans-serif;
  }

  .col-6 {
    width: 50%;
    float: left;
  }

  .col-40 {
    width: 40%;
    float: left;
  }

  .col-60 {
    width: 59%;
    float: left;
  }

  .col-10 {
    width: 10%;
    float: left;
  }


  .col-90 {
    width: 89%;
    float: left;
  }

  .row {
    width: 100%;
  }

  .str tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  .str table,
  .str tr,
  .str td {
    border-spacing: 0 !important;
    border: none !important;
  }

  @page {
    margin: 0px;
  }

  body {
    margin: 0px;
  }

  page {
    background: white;
    display: block;
    margin: 0 auto;
    margin-top: 0.3cm !important;
    margin-bottom: 0.3cm;
    box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
  }

  page[size="A4"] {
    width: 27cm;
    height: 29.7cm;
  }

  page[size="A4"][layout="landscape"] {
    width: 29.7cm;
    height: 21cm;
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
</style>

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

<page size="A4">
  <form action="{{ route('mark.dec.grn') }}" id="frmAction" method="POST" style="padding-block: 73px;  padding-left: 20px;  padding-right: 20px;">
    @csrf
    <input type="hidden" name="token" value="{{$token}}">
    <input type="hidden" name="doc_id" value="{{$mainData->id}}">
    <input type="hidden" name="t_id" value="{{$transactionId}}">
    <div class="container" style="padding-right: 25px;padding-left: 25px;padding-top: 0px;padding-bottom: 0px;">
      <div class="row" style="margin-top:100px;">
        <div style="width: 100%;padding-bottom: 0px;"> </div>

        <div style="width: 100%; padding-top: -90px;">
          <table style="width:100%;" cellspacing="0" cellpadding="0">
            <tr>
              <td style="border-color: white;   padding-top: 0; padding-right: 0; padding-bottom: 0;  ">
                <table style=" width: 100%; ">
                  <tr>
                    <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">GRN ID.</td>
                    <td style="border-color: white; padding: 0;text-align: left;  font-size:11px; color: red;"> GRN {{$mainData->id}}</td>
                    <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                  </tr>
                  <tr>
                    <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Created Date</td>
                    <td style="border-color: white; padding: 0;text-align: left;  font-size:11px; "> {{date('d-m-Y',strtotime($mainData->grn_created_date))}}</td>
                    <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                  </tr>
                  <tr>
                    <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">GRN Date</td>
                    <td style="border-color: white; padding: 0;text-align: left;  font-size:11px; "> {{date('d-m-Y',strtotime($mainData->grn_date))}} </td>
                    <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                  </tr>
                  <tr>
                    <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Supplier Name</td>
                    <td style="border-color: white; padding: 0;text-align: left;  font-size:11px;"> {{$mainData->sup_name}}</td>
                    <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                  </tr>
                </table>
              </td>
              <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0; border-color: white; width:48%">
                <table style="width:100%;  border-color: white;" cellspacing="0" cellpadding="0">
                  <tr cellspacing="0" cellpadding="0">
                    <td colspan="2" style="border-color: white; ">
                      <table style=" padding:0">
                        <tr>
                          <td rowspan="2" style="border-color: white; padding:0; width: 30%;">
                            <div class="visible-print text-center">
                              <?php
                              // $c = storage_path('app/public/' . str_slug($customer_id) . '.svg');
                              ?>
                            </div>
                          </td>
                          <td colspan="2" style="border-color: white; padding:0;"></td>
                        </tr>
                        <tr>
                          <td style="height:60px; border-color: white; padding:0;">
                          </td>
                          <td style="height:60px; border-color: white; padding:0; font-size: 32px; text-align:right;">
                            <strong>GRN </strong><br>
                          </td>
                        </tr>
                        <tr>
                          <td style="border-color: white; padding:0;">&nbsp;</td>
                          <td style="border-color: white; padding:0;">&nbsp;</td>
                          <td style="border-color: white; padding:0; text-align:right;"> <span style="font-weight: bold;">Generated by </span>:{{$mainData->created_name}} <br>Date: {{isset($mainData->grn_created_date)?date('d-m-Y',strtotime($mainData->grn_created_date)):''}}</td>
                        </tr>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="border-color: white;  padding-left: 5px;" colspan="2">
                <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
              </td>
            </tr>
          </table>
          </td>
          </tr>
          </table>
          <table style="width:100%; border-spacing: 0;" cellspacing="0" cellpadding="0">

            <tr>
              <td valign="top" style="border-color: white; width: 50; ">
                <center>
                  <h3> </h3>
                  </h3>

                  <table style="width:100%; border-color: white;  border-spacing: 0; /*padding: 2px;*/ " cellspacing="0" cellpadding="0">
                    <tr style=" ">
                      <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 11px;" width="12%"></td>
                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;"></td>
                    </tr>


                    <tr>
                      <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 11px;"></td>
                      <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%">:</td> -->
                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; padding:0; ">
                        <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                          <tr>
                            <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; "> <br>

                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>





                    <tr>
                      <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;"></td>
                      <!--    <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%"></td> -->
                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">
                        <table style=" width: 100%;border-collapse: collapse; border-spacing: 0; ">
                          <tr>
                            <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; ">

                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>




                    <tr>
                      <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;"></td>
                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">
                        <table style=" width: 100%; border-collapse: collapse; border-spacing: 0;">
                          <tr>
                            <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; ">


                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>

                    <tr>
                      <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;"></td>
                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">
                        <table style=" width: 100%; border-collapse: collapse; border-spacing: 0;">
                          <tr>
                            <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; ">


                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;"></td>
                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;"></td>
                    </tr>
                    <tr>
                      <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;"></td>
                      <td style="border-color: white;  border-color: white;   padding: 0px; font-size: 11px;"></td>
                    </tr>
                  </table>


              </td>
              <td valign="top" style="border-color: white; width: 50%;">
                <center>
                  <!-- <h3>تفاصيل المشتري </h3> -->
                  </h3>
                  <table style="width:100%; border-color: white;   padding: 2px; border-spacing: 0; " cellspacing="0" cellpadding="0">
                    <tr style=" ">
                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; "></td>
                      <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 11px;" width="20%">
                        <!-- :الإسم -->
                      </td>
                    </tr>


                    <tr>

                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">
                        <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                          <tr>
                            <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px; font-size: 11px; width: 60%; text-align: right;">
                              <br>
                              <br>
                              <br>
                              <br>
                            </td>

                          </tr>
                        </table>
                      </td>
                    </tr>




                    <tr>

                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">
                        <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                          <tr>
                            <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px; font-size: 11px; width: 60%; text-align: right;">
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"> </td>
                    </tr>
                    <tr>
                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">
                        <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                          <tr>
                            <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px; font-size: 11px; width: 60%; text-align: right;">
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 11px;"> </td>
                    </tr>
                    <tr>
                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; border-spacing: 0; ">
                        <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse;">
                          <tr>
                            <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px; font-size: 11px; width: 60%; text-align: right;">

                            </td>

                          </tr>
                        </table>
                      </td>
                      <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"> </td>
                    </tr>
                    <tr>
                      <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; "></td>
                      <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 11px;">
                        <!-- :                      رقم ضريبة -->
                      </td>
                    </tr>
                    <tr>
                      <td style="border-color: white;  border-color: white;   padding: 0px; font-size: 11px; text-align: right; "></td>
                      <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;">
                        <!-- :معرف المشتري -->
                      </td>
                    </tr>
                  </table>
              </td>
            </tr>
          </table>
        </div>


        <table style="table-layout: auto; " cellspacing="0" cellpadding="0">
          <tr>
            <td style="border-color: white;   padding: 1px">
              <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
            </td>
          </tr>
          <tr>
            <td style="border-color: white;   padding: 1px; text-align: center;">
              <h3 style="letter-spacing: 0px; margin: 0;">Goods Received Note </h3>
            </td>
          </tr>
          <tr>
            <td style="border-color: white;   padding: 1px">

              <hr style="height: 4px; background-color: black; color:black;   padding: 1px; margin-top:0;     margin-bottom: 0;">
            </td>
          </tr>
        </table>
        <div class="str">
          <table>
            <tr>
              <td style="border-color: white;  width: 3%;text-align:left; white-space: nowrap;">#</td>
              <td style="border-color: white; text-align: left; width: 30%;">Item </td>
              <td style="border-color: white;  padding: 0;  width: 35%;text-align: left;">Description </td>
              <td style="border-color: white;  padding: 0; width: 6%;text-align: left;">Unit </td>
              <td style="border-color: white;  padding: 0; width: 7%;text-align: right;">Qty </td>
            </tr>
            <tr class="str">
              <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="5">
                <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
              </td>

            </tr>

            @foreach($products as $key=>$cinvoice_products)
            <tr class="str">
              <td style="border-color: white;   padding: 2px;">{{$key+1}}</td>
              <td style="border-color: white;   padding: 2px;">{{$cinvoice_products->itemname}}</td>
              <td style="border-color: white;   padding: 2px;">{{$cinvoice_products->description}}</td>
              <td style="border-color: white;   padding: 2px;">{{$cinvoice_products->unit_name}}</td>
              <td style="border-color: white;   padding: 2px; text-align: right;">{{$cinvoice_products->quantity}}</td>
            </tr>
            @endforeach

          </table>

          <div class="row">
            <div style="width: 100%;padding-bottom: 0px;">
            </div>
            <br>
            <div class="str"></div>

            <table>
            </table>
          </div>



          <br>
          <div class="row">
            <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">@lang('app.Notes')</h4>
          </div>
          <div class="row">
            <p style="text-align: justify; font-size: 10px;">{{$mainData->notes}}</p>
          </div>

          <br><br>
          <div class="row">
            <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">@lang('app.Terms and Conditions')</h4><br>
          </div>
          <div class="row">
            <p style="text-align: justify; font-size: 10px;"> {!! $mainData->description!!} </p>
          </div>
          <br><br>

          <div class="row">
            @foreach ($approvalLevel as $key => $value)
            <div style="width:25%; float: left; padding-left: 1.5%;">
              <table width="100%">
                <?php
                if ($value['status'] == 2)
                  $sataus = 'Approved By';
                else if ($value['status'] == 3)
                  $sataus = 'Returned';
                else if ($value['status'] == 4)
                  $sataus = 'Rejected';
                $sign = '';
                if ($value['sign'] != null && (file_exists(public_path() . '/' . $value['sign'])))
                  $sign = $value['sign'];
                else
                  $sign = "usersigns/notfount.png";
                ?>


                <tr>
                  <td style="padding-left: 1px; width:20px; height:20px">
                    <img style="display:block; width: 100px;height: 100px;" src="{{asset($sign)}}">
                  </td>
                </tr>

                <tr>
                  <td>
                    <span style="font-weight: bold;">{{$sataus}}</span>
                    <br>Name : {{$value['name']}}
                    <br>Designation : {{$value['designation']}}
                    <br>Department : {{$value['department']}}
                    <br> Date : {{date('d-m-Y H:i:s',strtotime($value['updated_at']))}}
                  </td>
                </tr>
              </table>
            </div>
            @endforeach

          </div>

          <div class="row">
            <div class="col text-center">
              <input type="button" class="btn btn-success approve" name="approve" id="" value="Approve">&nbsp;
              <input type="button" class="btn btn-danger reject" name="reject" value="Reject">&nbsp;
              <input type="button" class="btn btn-warning revice" name="revice" value="Revice">&nbsp;
              <!-- <button type="button" class="btn btn-light">Cancel</button> -->
            </div>
          </div>

        </div>
      </div>
    </div>
    <input type="hidden" name="currentAction" id="currentAction" value="">
  </form>
</page>
<script src="{{ URL::asset('assets') }}/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/scripts.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/components/extended/toastr.js" type="text/javascript"></script>

<script>
  function loaderShow() {
    $('#preloaderContainer').show();
  }

  function loaderClose() {
    setTimeout(function() {
      $('#preloaderContainer').addClass('loaded');
      if ($('#preloaderContainer').hasClass('loaded')) {
        // It is so that once the container is gone, the entire preloader section is deleted
        $('#preloader').delay(9000).queue(function() {
          $(this).remove();
        });
      }
    }, 1000);
  }

  $(document).on('click', '.approve', function() {
    var id = $(this).attr('id');
    swal.fire({
      title: "Are you sure?",
      text: "Do you want Approve",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Approve",
      cancelButtonText: "Cancel"
    }).then(result => {
      if (result.value) {
        $('#currentAction').val('Approve');
        loaderShow();
        $('#frmAction').submit();
      } else {
        swal.fire("Cancelled", "", "error");
      }
    })
  });

  $(document).on('click', '.reject', function() {
    var id = $(this).attr('id');
    swal.fire({
      title: "Are you sure?",
      text: "Do you want Reject",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Reject",
      cancelButtonText: "Cancel"
    }).then(result => {
      if (result.value) {
        $('#currentAction').val('Reject');
        loaderShow();
        $('#frmAction').submit();
      } else {
        swal.fire("Cancelled", "", "error");
      }
    })
  });

  $(document).on('click', '.revice', function() {
    var id = $(this).attr('id');
    swal.fire({
      title: "Are you sure?",
      text: "Do you want Revice",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Revice",
      cancelButtonText: "Cancel"
    }).then(result => {
      if (result.value) {
        $('#currentAction').val('Revice');
        loaderShow();
        $('#frmAction').submit();
      } else {
        swal.fire("Cancelled", "", "error");
      }
    })
  });
</script>