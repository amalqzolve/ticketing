<html>

<head>
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
  if ($companysettings != "") {
    foreach ($companysettings as $companies) {
      $salesquotation_sufix = $companies->salesquotation_sufix;
      $salesquotation = $companies->salesquotation;
      $company_name = $companies->company_name;
      $company_cr = $companies->company_cr;
      $company_vat = $companies->company_vat;
    }
  }



  ?>
  <?php

  foreach ($bname as $key => $value) {
    $blabel = $value->label;
  }
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
  foreach ($pi as $key => $value) {

    $piid = $value->id;
    $name = $value->supplier_id;
    $po_currency = $value->currency;
    $reference = $value->po_wo_ref;
    $attention = $value->attention;
    $salesman1 = $value->salesman;
    $bill_entry_date = $value->bill_entry_date;
    $validity = $value->validity;
    $totalamount = $value->totalamount;
    $discount = $value->discount;
    $amountafterdiscount = $value->amountafterdiscount;
    $totalvatamount = $value->vatamount;
    $grandtotalamount = $value->grandtotalamount;
    $terms = $value->terms;
    $notes = $value->notes;
    $preparedby = $value->preparedby;
    $approvedby = $value->approvedby;

    $status = $value->status;
    $tpreview = $value->tpreview;
    $created_at = $value->created_at;
  }
  foreach ($pname as $names) {
    $supid = $names->id;
    $sup_add1 = $names->sup_add1;
    $sup_add2 = $names->sup_add2;
    $sup_region = $names->sup_region;
    $sup_city = $names->sup_city;
    $sup_zip = $names->sup_zip;
    $mobile1 = $names->mobile1;
    $vat_no = $names->vatno;
    $cr_no = $names->buyerid_crno;
    $sup_name = $names->sup_name;
    $type = $names->type;
    $category = $names->category;
    $group = $names->group;
    $cntry_name = $names->cntry_name;
    $mobile = $names->mobile;

    $sup_name_ar = $names->sup_name_ar;
    $sup_add1_ar = $names->sup_add1_ar;
    $sup_add2_ar = $names->sup_add2_ar;
    $sup_region_ar = $names->sup_region_ar;
    $sup_city_ar = $names->sup_city_ar;
    $sup_zip_ar = $names->sup_zip_ar;
    $vatno_ar = $names->vatno_ar;
    $buyerid_crno_ar = $names->buyerid_crno_ar;
    $sup_country_ar = $names->sup_country_ar;
  }



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
                        <td rowspan="2" style="border-color: white; padding:0; width: 30%;">
                          <div class="visible-print text-center">


                            <?php

                            /*     $company_name="Rabou Liyan Trading Est";
     $company_vat='300396608300003';

   $qrtextof='Seller Name :-> '.$company_name.', Vat Number :-> '.$company_vat.', Datetime :-> '.$quotedate.', Vat Total :-> '.$totalvatamount.', Total  :->'.$grandtotalamount;


$qrtextof=str_replace('',"",$qrtextof);*/

                            $c = storage_path('app/public/QRinvoice/' . str_slug($piid) . '.svg');
                            ?>
                            <img src='{{  $c }}' style="width:80px">

                          </div>
                        </td>
                        <td colspan="2" style="border-color: white; padding:0;"></td>
                      </tr>
                      <tr>
                        <td style="height:60px; border-color: white; padding:0;">




                        </td>
                        <td style="height:60px; border-color: white; padding:0; font-size: 32px; text-align:right;">
                          <strong>Purchase Invoice </strong>
                        </td>
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
            <td style="border-color: white;   padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 20; ">
              <!-- <h1 style="letter-spacing: 0px; margin: 0; text-align:left; margin-left: 5px; padding:0">Buyer: </h1> -->
              <table style=" width: 100%; ">
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Purchase Invoice ID</td>
                  <td style="border-color: white; padding: 0;text-align: center;  font-size:11px; color: red;">{{$piid}}</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">معرف فاتورة المبيعات

                  </td>

                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Date</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$bill_entry_date}}</td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">تاريخ

                  </td>
                </tr>

                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;"> @lang('app.Currency')</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;"><?php foreach ($currencylist as $data)
                                                                                                      if ($data->id == $po_currency) {
                                                                                                        echo $data->currency_name;
                                                                                                      }
                                                                                                    ?></td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">
                  </td>

                </tr>


                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">@lang('app.Salesman')</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$salesman1}}</td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">شروط الدفع
                  </td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:12px;">@lang('app.Attention')</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:12px;">{{$attention}} </td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:12px;">
                  </td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:12px;">PO/WO Ref</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:12px;">{{ $reference }}</td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:12px;">
                  </td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:12px;"> Branch</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:12px;">{{$blabel}}</td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:12px;">

                    فرع


                  </td>
                </tr>



              </table>
            </td>
          </tr>
        </table>
        <table style="width:100%;" cellspacing="0" cellpadding="0">

          <tr>
            <td valign="top" style="border-color: white; ">
              <center>
                <h3><u>Buyer</u></h3>
                </h3>

                <table style="width:100%; border-color: white;   padding: 2px; " cellspacing="0" cellpadding="0">
                  <tr style=" ">
                    <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 12px;" width="25%"> Name </td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;"> {{$sup_name}}</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 12px;" width="30%"> الإسم </td>
                  </tr>


                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 12px;">Building No </td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;"> {{$sup_add1}}</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> رقم المبني </td>

                  </tr>


                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Street Name</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$sup_add2}}</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> اسم الشارع </td>
                  </tr>


                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">District/City</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$sup_region}}/{{$sup_city}}</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> الحي / المدينة </td>
                  </tr>


                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Country</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$cntry_name}}</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> البلد </td>
                  </tr>


                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Phone No/Postal code</td>
                    <td style="border-color: white; border-color: white;   padding: 0px;">{{$mobile}}/{{$sup_zip}}</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;">رقم الهاتف/ الرمز البريدي </td>
                  </tr>
                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">VAT No</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$vat_no}}</td>
                    <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 12px;"> رقم تسجيل ضريبة القيمة المضافة </td>
                  </tr>
                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Buyer ID</td>
                    <td style="border-color: white;  border-color: white;   padding: 0px; font-size: 12px;"> {{$cr_no}}</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> معرف آخر </td>
                  </tr>









                </table>


            </td>
            <td valign="top" style="border-color: white; ">
              <center>
                <h3><u>Seller</u></h3>
                </h3>
                <table style="width:100%; border-color: white;   padding: 2px; " cellspacing="0" cellpadding="0">
                  <tr style=" ">
                    <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 12px;" width="25%"> Name </td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;"> RABOU LIYAN TRADING EST.</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 12px;" width="30%"> الإسم </td>
                  </tr>


                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 12px;">Building No </td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;"> 2</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> رقم المبني </td>

                  </tr>


                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Street Name</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">WADI AL JARIR</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> اسم الشارع </td>
                  </tr>


                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">District</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">AL OLAYA DISTRICT</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> الحي </td>
                  </tr>

                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">City</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">RIYADH</td>
                    <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 12px;"> المدينة </td>
                  </tr>
                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Country</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">SAUDI ARABIA</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> البلد </td>
                  </tr>
                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Postal code</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;"> </td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> الرمز البريدي </td>
                  </tr>

                  <!--   <tr>
              <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold;"   width="30%">Additional No:</td>
              <td  style="border-color: white; border-color: white;   padding: 0px;"><?php //echo  '-'; 
                                                                                      ?></td>
              <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;" >      الرقم الإضافي للعنوان     </td>
            </tr> -->
                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">VAT No</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">300396608300003</td>
                    <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 12px;"> رقم تسجيل ضريبة القيمة المضافة </td>
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
            <h3 style="letter-spacing: 0px; margin: 0;">Purchase Invoice</h3>
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
            <td style="border-color: white; text-align: left;">Nature of goods service <br> تفاصيل الخدمات </td>

            <!-- <td  style="border-color: white;   padding: 1px;width: 7%;">Service</td> -->
            <td style="border-color: white;  padding: 0;  width: 5%;text-align: left;">Unit <br> وحدة </td>
            <td style="border-color: white;  padding: 0; width: 5%;text-align: right;">Quantity <br> الوحدة </td>
            <td style="border-color: white;  padding: 0; width: 8%;text-align: right;">Unit price <br>سسعر الوحدة </td>
            <td style="border-color: white;   padding: 0; text-align: right; width: 10%;">Taxable Amount <br> المبلغ الخاضع للضريبة </td>
            <!-- <td  style="border-color: white;   padding: 1px;">VAT%</td> -->
            <td style="border-color: white;  padding: 0; background-color: white !important;; text-align:center; width: 10%;">Discount <br> خصومات </td>
            <td style="border-color: white;  padding: 0;  background-color: white !important;; text-align:right; width: 5%;">Tax Rate <br> نسبة الضريبة </td>
            <td style="border-color: white; width: 7%; padding: 0;  background-color: white !important;; text-align:right; ">Tax Amount <br> مبلغ الضريبة </td>
            <td style="border-color: white;  padding: 0; white: 8%;  background-color: white !important;width: 17%; text-align:right;">Item subtotal<br>(Including VAT) <br> المجموع (شامل ضريبة القيمة المضافة) </td>

          </tr>
          <tr class="str">
            <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="11">
              <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
            </td>

          </tr>


          @foreach($pi_product as $key=>$quotation_products)
          <tr class="str">
            <td style="border-color: white;   padding: 2px; text-align: left;">{{$key+1}}</td>
            <td style="border-color: white;   padding: 2px; text-align: left;">{{$quotation_products->itemname}}</td>
            <td style="border-color: white;   padding: 2px; text-align: center;">
              @foreach($unitlist as $data)
              <?php if ($quotation_products->unit == $data->id) {
                echo $data->unit_code;
              } ?>
              @endforeach
            </td>
            <td style="border-color: white;   padding: 2px; text-align: right;">{{$quotation_products->quantity}}</td>
            <td style="border-color: white;   padding: 2px; text-align: right;"> {{number_format($quotation_products->rate,2,'.',',')}}</td>
            <td style="border-color: white;   padding: 2px; text-align: right;">{{number_format($quotation_products->amount,2,'.',',')}}</td>
            <td style="border-color: white;   padding: 2px; text-align: center; "> {{number_format($quotation_products->rdiscount,2,',','.')}}</td>
            <td style="border-color: white;   padding: 2px; text-align: center;">15%</td>
            <td style="border-color: white;   padding: 2px; text-align: right;">{{number_format($quotation_products->vatamount,2,'.',',')}}</td>
            <td style="border-color: white;   padding: 2px; text-align: right;"> {{number_format($quotation_products->totalamount,2,'.',',')}}</td>
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



                <table style="width:100%; background-color: white !important; " cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="border-color: white;    padding: 1px;" colspan="2">
                      <hr style="height: 4px; color:black; background-color: black;  padding: 1px; margin-top: 1px;     margin-bottom: 1px;">
                    </td>
                  </tr>
                  <tr style="background-color: white !important;">

                    <td style="border-color: white;background-color: white !important; width: 100%; padding: 0; ">
                      <table style="width:100%; background-color: white !important;">
                        <tr style="background-color: white !important;">
                          <td style="border-color: white; padding: 0;background-color: white !important;">Total (Excluding VAT) - الإجمالي غير شاملة ضريبة القيمة المضافة </td>
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{number_format($totalamount,2,'.',',')}}</td>
                        </tr>

                        <tr style="background-color: white !important;">
                          <td style="border-color: white; padding: 0;background-color: white !important;">Discount - مجموع خصومات </td>
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{number_format($discount,2,'.',',')}} </td>
                        </tr>


                        <tr style="background-color: white !important;">
                          <td style="border-color: white; padding: 0;background-color: white !important;">Total taxable amount(Excluding VAT) - <br> الإجمالي الخاضع للضريبة غير شاملة ضريبة القيمة المضافة </td>
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{number_format($amountafterdiscount,2,'.',',')}}</td>
                        </tr>


                        <tr style="background-color: white !important;">
                          <td style="border-color: white; padding: 0;background-color: white !important;">Total VAT - مجموع ضريبة القيمة المضافة </td>
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{number_format($totalvatamount,2,'.',',')}} </td>
                        </tr>
                        <tr style="background-color: white !important; ">
                          <td style="border-color: white; padding: 0;background-color: white !important; color:red;">Total Amount Due - إجمالي المبلغ المستحق </td>
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:right; color:red;">{{number_format($grandtotalamount,2,'.',',')}}</td>
                        </tr>
                        <tr style="background-color: white !important; ">
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:left;font-size: 8pt; !important ">
                            <p style="font-size: 8pt;!important"> only.</p>
                          </td>
                        </tr>


                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="border-color: white;    padding: 1px;" colspan="2">
                      <hr style="height: 2px; color:black;   background-color: black; margin-top: 1px;     margin-bottom: 1px;">
                    </td>
                  </tr>
                </table>



              </td>
            </tr>
          </table>


        </div>



        <br>
        <div class="row">
          <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">@lang('app.Notes')</h4>
          <p style="text-align: justify; font-size: 10px;">{{$notes}}</p><br><br>
          <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">@lang('app.Terms and Conditions')</h4>
          <p style="text-align: justify; font-size: 10px;">{!! $tpreview !!} </p>
          <br><br>
        </div>

        <!--  <br><br>
 <div class="row">
  <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">@lang('app.Terms and Conditions')</h4>
  <p style="text-align: justify; font-size: 10px;">{!! $tpreview !!} </p>

 </div>

 <br><br> -->
        <table width="100%">
          <tr>
            <td style="border-color: white;background-color: white !important; font-weight: b;"><span style="font-weight: bold;">Prepared by</span><br>
              @foreach($salesmen as $prepared)
              @if($prepared->id == $preparedby)
              {{$prepared->name}}
              @endif
              @endforeach<br>
              {{$created_at}}
            </td>
            <td style="border-color: white;background-color: white !important; text-align: center;"><span style="font-weight: bold;">Approved by</span> <br>
              @foreach($salesmen as $approved)
              @if($approved->id == $approvedby)
              {{$approved->name}}
              @endif
              @endforeach<br>
              {{$created_at}}
            </td>
            <td style="border-color: white; text-align: right;background-color: white !important;"><span style="font-weight: bold;">Received by</span> <br>
              Name, Signature & Date </td>
          </tr>
          <tr>
            <td style="border-color: white;background-color: white !important;">
              <p><br> </p>
            </td>
            <td style="border-color: white;background-color: white !important;">
              <p><br> </p>
            </td>
            <td style="border-color: white; text-align: right;background-color: white !important;">
              <p> <br> <br><!-- Name, Signature & Date --> <br> </p>
            </td>
          </tr>
        </table>
        <div class="row">





        </div>
      </div>

    </div>
  </div>

  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">



  </div>