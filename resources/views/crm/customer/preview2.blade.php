<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title></title>

  <?php
  $pdfheader_top = 100;
  $pdffooter_bottom = 160;

  if (Session::get('pdfheader_top')) {
    $pdfheader_top = Session::get('pdfheader_top');
  }
  if (Session::get('pdffooter_bottom')) {
    $pdffooter_bottom = Session::get('pdffooter_bottom');
  }

  $salesquotation_sufix = "";
  $salesquotation = "";
  $des = "";

  $company_name = "";
  $company_cr = "";
  $company_vat = "";
  // if($companysettings!="")
  // {
  //   foreach($companysettings as $companies)
  //   {
  //     $salesquotation_sufix = $companies->salesquotation_sufix;
  //     $salesquotation = $companies->salesquotation;
  //     $company_name = $companies->company_name;
  //     $company_cr = $companies->company_cr;
  //     $company_vat = $companies->company_vat;




  //     }
  //   }



  ?>
  <?php

  // foreach ($bname as $key => $value) {
  // $blabel=$value->label;
  // }
  ?>

  <?php
  $header = "";
  $footer = "";
  foreach ($branchsettings as $key => $value) {
    $header = $value->pdfheader;
    $footer = $value->pdffooter;
  }
  ?>
  <?php
  foreach ($users as $data) {
    $custcode = $data->cust_code;
    $category = $data->custcategory;
    $group = $data->grouptitle;
    $type = $data->customertype;
    $salesman = $data->salesmanname;
    $keyaccounts = $data->account_ledger;

    $customername = $data->cust_name;
    $cust_add1 = $data->cust_add1;
    $cust_add2 = $data->cust_add2;
    $cust_region = $data->cust_region;
    $cust_city = $data->cust_city;
    $cust_country = $data->country;
    $cust_zip = $data->cust_zip;
    $vatno = $data->vatno;
    $crno = $data->buyerid_crno;
    $additionalno = $data->additionalno;
    $province_state = $data->province_state;

    $ar_cust_name = $data->ar_cust_name;
    $ar_cust_add1 = $data->ar_cust_add1;
    $ar_cust_add2 = $data->ar_cust_add2;
    $ar_cust_region = $data->ar_cust_region;
    $ar_cust_city = $data->ar_cust_city;
    $ar_cust_zip = $data->ar_cust_zip;
    $ar_vatno = $data->ar_vatno;
    $ar_buyerid_crno = $data->ar_buyerid_crno;
    $ar_cust_country = $data->ar_cust_country;
    $ar_additionalno = $data->ar_additionalno;
    $ar_vatno = $data->ar_vatno;
    $ar_crno = $data->ar_buyerid_crno;
    $ar_province_state = $data->ar_province_state;

    $email1 = $data->email1;
    $email2 = $data->email2;
    $phno1 = $data->office_phone1;
    $phno2 = $data->office_phone2;
    $mobile1 = $data->mobile1;
    $mobile2 = $data->mobile2;
    $fax = $data->fax;
    $website = $data->website;
  }

  $date = date('Y-m-d');

  ?>



  <style>
    /*@font-face {
    font-family: 'Tajawal', sans-serif;
    src: url({{ storage_path('fonts/Tajawal-Light.ttf') }}) format('truetype');
}
*/
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

    body {
      margin: 0px;
    }

    @page {
      margin: <?php echo $pdfheader_top + 103; ?>px 0px <?php echo $pdffooter_bottom; ?>px 0px;
    }

    @page {
      header: page-header;
      footer: page-footer;
    }
  </style>
  <htmlpageheader name="page-header">
    <img src='{{ asset($header) }}' border='0' width='100%'>
  </htmlpageheader>

  <htmlpagefooter name="page-footer">
    <img src='{{ asset($footer) }}' border='0' width='100%'>
  </htmlpagefooter>

  <div class="container" style="padding-right: 25px;padding-left: 25px;  padding-bottom: 0px; ">
    <div class="row" style="margin-top:0px;">
      <div style="width: 100%;padding-bottom: 0px;">


      </div>

      <div style="width: 100%; padding-top: -90px;">
        <table style="width:100%;" cellspacing="0" cellpadding="0">
          <tr>

            <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0; border-color: white; width:48%">
              <table style="width:100%;  border-color: white;" cellspacing="0" cellpadding="0">
                <tr cellspacing="0" cellpadding="0">
                  <td style="border-color: white; ">
                    <!-- <table style="margin:0; padding:0">
                    <tr>

                      
                      
                </tr>
                </table> -->
                    <table style=" padding:0">

                      <tr>

                        <td style="height:60px; border-color: white; padding:0; font-size: 25px; text-align:right;">
                          <strong>Customer Information </strong>
                        </td>
                      </tr>

                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="border-color: white;  padding-left: 5px;" colspan="2">
                    <hr style="height: 2px; color:black;  background-color: black; margin-top: px;     margin-bottom: 1px;">
                  </td>
                </tr>
              </table>





            </td>
            <td style="border-color: white;   padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 20; ">
              <!-- <h1 style="letter-spacing: 0px; margin: 0; text-align:left; margin-left: 5px; padding:0">Buyer: </h1> -->
              <table style=" width: 100%; ">
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Customer Code</td>
                  <td style="border-color: white; padding: 0;text-align: center;  font-size:11px; color: red;">{{$custcode}}</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">كود العميل
                  </td>

                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Category</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$category}}</td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">فئة

                  </td>
                </tr>





                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Group</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$group}}</td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">مجموعة

                  </td>

                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Type</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$type}}</td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">يكتب
                  </td>

                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Salesman</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$salesman}}</td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">بائع
                  </td>
                </tr>

                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Key Account</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$keyaccounts}}</td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">الرمز السري للحساب
                  </td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:12px;"> Branch</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:12px;"></td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:12px;">فرع

                  </td>
                </tr>



              </table>
            </td>
          </tr>
        </table>
        <table style="width:100%;" cellspacing="0" cellpadding="0">

          <tr>
            <td valign="top" style="border-color: white; ">

              <table style="width:100%; border-color: white;   padding: 2px; " cellspacing="0" cellpadding="0">
                <tr style=" ">
                  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 12px;"> Name </td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;"> <?php echo  $customername; ?></td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;"> <?php echo  $ar_cust_name; ?></td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 12px;"> اسم </td>
                </tr>


                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 12px;">Building No </td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;"> {{$cust_add1}}</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;"> {{$ar_cust_add1}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> رقم المبني </td>

                </tr>


                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Street Name</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$cust_add2}}</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ar_cust_add2}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> اسم الشارع </td>
                </tr>


                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">District</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$cust_region}}</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ar_cust_region}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> الحي </td>
                </tr>
                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Province/State</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$province_state}}</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ar_province_state}}</td>
                  <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 12px;"> المدينة </td>
                </tr>

                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">City</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$cust_city}}</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$cust_city}}</td>
                  <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 12px;"> المدينة </td>
                </tr>
                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Country</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$cust_country}}</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ar_cust_country}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> البلد </td>
                </tr>
                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Postal code</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$cust_zip}}</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ar_cust_zip}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> الرمز البريدي </td>
                </tr>

                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Additional No</td>
                  <td style="border-color: white; border-color: white;   padding: 0px;">{{$additionalno}}</td>
                  <td style="border-color: white; border-color: white;   padding: 0px;">{{$ar_additionalno}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;">رقم الهاتف</td>
                </tr>
                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">VAT No</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$vatno}}</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ar_vatno}}</td>
                  <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 12px;"> رقم تسجيل ضريبة القيمة المضافة </td>
                </tr>
                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Buyer ID/CR No</td>
                  <td style="border-color: white;  border-color: white;   padding: 0px; font-size: 12px;">{{$crno}}</td>
                  <td style="border-color: white;  border-color: white;   padding: 0px; font-size: 12px;">{{$ar_buyerid_crno}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> معرف آخر </td>
                </tr>


              </table>
            </td>

          </tr>
        </table>
      </div>
      <br>
      <table style="table-layout: auto; " cellspacing="0" cellpadding="0">
        <!-- <tr>
      <td  style="border-color: white;   padding: 1px">
         <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
      </td>
    </tr> -->
        <tr>
          <td style="border-color: white;   padding: 1px; text-align: center;">
            <h3 style="letter-spacing: 0px; margin: 0;">Office Information</h3>
          </td>
        </tr>
        <tr>
          <td style="border-color: white;   padding: 1px">

            <hr style="height: 4px; background-color: black; color:black;   padding: 1px; margin-top:0;     margin-bottom: 0;">
          </td>
        </tr>
      </table>
      <table style=" width: 100%; ">
        <tr>
          <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Primary Email</td>
          <td style="border-color: white; padding: 0;text-align: center;  font-size:11px;">{{$email1}}</td>
          <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">البريد الإلكتروني الرئيسي
          </td>

        </tr>
        <tr>
          <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Secondary Email</td>
          <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$email2}}</td>
          <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">البريد الإلكتروني الثانوي

          </td>
        </tr>

        <tr>
          <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Office Phone No: 1</td>
          <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$phno1}}</td>
          <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">رقم هاتف المكتب: 1

          </td>

        </tr>
        <tr>
          <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Office Phone No: 2</td>
          <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$phno2}}</td>
          <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">رقم هاتف المكتب: 2
          </td>

        </tr>
        <tr>
          <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Mobile No: 1</td>
          <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$mobile1}}</td>
          <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">رقم الجوال: 1
          </td>
        </tr>

        <tr>
          <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Mobile No: 2</td>
          <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$mobile2}}</td>
          <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">رقم الموبايل: 2
          </td>
        </tr>
        <tr>
          <td style="border-color: white; padding: 0; font-weight: bold;  font-size:12px;"> Fax</td>
          <td style="border-color: white; padding: 0;text-align:  center;  font-size:12px;">{{$fax}}</td>
          <td style="border-color: white; padding: 0;text-align:  right;  font-size:12px;">فاكس

          </td>
        </tr>
        <tr>
          <td style="border-color: white; padding: 0; font-weight: bold;  font-size:12px;"> Website</td>
          <td style="border-color: white; padding: 0;text-align:  center;  font-size:12px;">{{$website}}</td>
          <td style="border-color: white; padding: 0;text-align:  right;  font-size:12px;">موقع إلكتروني

          </td>
        </tr>



      </table>

      <br>
      <table style="table-layout: auto; " cellspacing="0" cellpadding="0">
        <!-- <tr>
      <td  style="border-color: white;   padding: 1px">
         <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
      </td>
    </tr> -->
        <tr>
          <td style="border-color: white;   padding: 1px; text-align: center;">
            <h3 style="letter-spacing: 0px; margin: 0;">Contact Information</h3>
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
            <th style="border-color: white;text-align:left;">#</th>
            <th style="border-color: white; text-align: left; width: 20%;">Contact Person</th>
            <th style="border-color: white; text-align: left;">Mobile Number</th>
            <th style="border-color: white; text-align: left;">Office Number</th>
            <th style="border-color: white; text-align: left;">Email</th>
            <th style="border-color: white; text-align: left;">Department</th>
            <th style="border-color: white; text-align: left;">Location</th>

          </tr>
          <tr class="str">
            <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="7">
              <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
            </td>

          </tr>
          @foreach($customercontact as $key=>$customercontacts)

          <tr class="str">
            <td style="border-color: white; text-align: left; padding: 2px;">{{$key+1}}</td>
            <td style="border-color: white; text-align: left; padding: 2px;">{{$customercontacts->contact_personvalue}}</td>
            <td style="border-color: white; text-align: left; padding: 2px;">{{$customercontacts->mobiles}}</td>
            <td style="border-color: white; text-align: left; padding: 2px;">{{$customercontacts->offices}}</td>
            <td style="border-color: white; text-align: left; padding: 2px;">{{$customercontacts->emails}}</td>
            <td style="border-color: white; text-align: left; padding: 2px;">{{$customercontacts->departments}}</td>
            <td style="border-color: white; text-align: left; padding: 2px;">{{$customercontacts->locations}}</td>
          </tr>
          @endforeach



        </table>
        <br>
        <table style="table-layout: auto; " cellspacing="0" cellpadding="0">
          <!-- <tr>
      <td  style="border-color: white;   padding: 1px">
         <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
      </td>
    </tr> -->
          <tr>
            <td style="border-color: white;   padding: 1px; text-align: center;">
              <h3 style="letter-spacing: 0px; margin: 0;">Documents</h3>
              <h4>(Total Documents : {{$total}}, Active : {{$ac}}, Expired : {{$exp}})</h4>
            </td>
          </tr>
          <tr>
            <td style="border-color: white;   padding: 1px">

              <hr style="height: 4px; background-color: black; color:black;   padding: 1px; margin-top:0;     margin-bottom: 0;">
            </td>
          </tr>
        </table>
        <table>
          <tr>
            <th style="border-color: white;text-align:left;">#</th>
            <th style="border-color: white; text-align: left; width: 25%;">Document Name</th>
            <th style="border-color: white; text-align: left;width: 25%;">Expiry Date</th>
            <th style="border-color: white; text-align: left;width: 25%;">Status</th>


          </tr>
          <tr class="str">
            <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="4">
              <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
            </td>

          </tr>
          @foreach($docs as $key=>$docss)

          <tr class="str">
            <td style="border-color: white; text-align: left; padding: 2px;">{{$key+1}}</td>
            <td style="border-color: white; text-align: left; padding: 2px;">{{$docss->docname}}</td>
            <td style="border-color: white; text-align: left; padding: 2px;">{{$docss->expdate1}}</td>
            <td style="border-color: white; text-align: left; padding: 2px;">@if($docss->expdate >=$date)
              <span style="color:green;">Active</span>
              @else
              <span style="color:red;">Expired</span>
            </td>
            @endif

          </tr>
          @endforeach



        </table>

        <div class="row">
          <div style="width: 100%;padding-bottom: 0px;">

            <!--  <img src='' border='0' width='100%' height='130'> -->

          </div>



          <br>

          <div class="str"></div>

          <table>
          </table>



          <table style="width:100%; font-weight:bold;" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top" style="border-color: white;">

              </td>
              <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0px 0px 0px 8px;border-color: white;" width="70%">







              </td>
            </tr>
          </table>


        </div>



        <br>


        <br><br>


        <br><br>

        <div class="row">





        </div>
      </div>

    </div>
  </div>

  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">



  </div>