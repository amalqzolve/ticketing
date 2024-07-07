<html>

<head>

  <?php

  foreach ($branchsettings as $key => $value) {
    $header = $value->pdfheader;
    $footer = $value->pdffooter;
  }
  ?>
  <?php
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
  </style>
  <img src='{{ asset($header) }}' border='0' width='100%'>
  <div class="container" style="padding-right: 25px;padding-left: 25px;padding-top: 0px;padding-bottom: 0px;">
    <div class="row" style="margin-top:100px;">
      <div style="width: 100%;padding-bottom: 0px;">
      </div>

      <div style="width: 100%; padding-top: -90px;">
        <table style="width:100%;" cellspacing="0" cellpadding="0">
          <tr>


            <td style="border-color: white;   padding-top: 0; padding-right: 0; padding-bottom: 0;  ">
              <table style=" width: 100%; ">
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Return ID.</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; color: red;">{{ $purchase_return->code.'/'.$purchase_return->br_id }}</td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold; font-size: 11px;">Date</td>
                  <td style="border-color: white; padding: 0;text-align:  right; font-size: 11px;">{{date('d-m-Y',strtotime($purchase_return->returndate))}}</td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold; font-size: 11px;"> Reason </td>
                  <td style="border-color: white; padding: 0;text-align: right; font-size: 11px;">{{$purchase_return->reason}}</td>
                </tr>
              </table>
            </td>
            <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0; border-color: white; width:48%">
              <table style="width:100%;  border-color: white;" cellspacing="0" cellpadding="0">
                <tr cellspacing="0" cellpadding="0">
                  <td style="border-color: white; ">
                    <table style=" padding:0">
                      <tr>
                        <td rowspan="2" style="border-color: white; padding:0; width: 30%;">
                          <div class="visible-print text-center">
                            <?php
                            $c = storage_path('app/public/' . str_slug($purchase_return->id) . '.svg');
                            ?>
                            <!-- <img src='{{  $c }}' style="width:80px" > -->
                          </div>
                        </td>
                        <td colspan="2" style="border-color: white; padding:0;"></td>
                      </tr>
                      <tr>
                        <td style="height:60px; border-color: white; padding:0;">
                        </td>
                        <td style="height:60px; border-color: white; padding:0; font-size: 27px; text-align:right;">
                          <strong>Purchase Return</strong><br>
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
          </tr>
        </table>
        <table style="width:100%; border-spacing: 0;" cellspacing="0" cellpadding="0">

          <tr>
            <td valign="top" style="border-color: white; width: 50; ">
              <center>
                <h3>Supplier Details </h3>
                </h3>

                <table style="width:100%; border-color: white;  border-spacing: 0; /*padding: 2px;*/ " cellspacing="0" cellpadding="0">
                  <tr style=" ">
                    <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 11px;" width="12%">Name:</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">{{$sup_name}}</td>
                  </tr>


                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 11px;">Address: </td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; padding:0; ">
                      <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                        <tr>
                          <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; "><?php echo  $sup_add1; ?> <br>
                            <?php echo  $sup_add2; ?><br>
                            <?php echo  $sup_region; ?><br>
                            <?php echo  $sup_city; ?><br>
                            {{$cntry_name}}<br>
                            <?php echo  $sup_zip; ?>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>





                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;">Vat No</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">
                      <table style=" width: 100%;border-collapse: collapse; border-spacing: 0; ">
                        <tr>
                          <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; ">{{$vat_no}}

                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>




                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;">Cr No</td>
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">
                      <table style=" width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                          <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; ">
                            {{$cr_no}}
                          </td>
                          }
                          }
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
                </table>


            </td>
            <td valign="top" style="border-color: white; width: 50%;">
              <center>
                <h3>تفاصيل المشتري </h3>
                </h3>
                <table style="width:100%; border-color: white;   padding: 2px; border-spacing: 0; " cellspacing="0" cellpadding="0">
                  <tr style=" ">
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">{{$sup_name_ar}}</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 11px;" width="20%">:
                      الإسم
                    </td>
                  </tr>


                  <tr>

                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">
                      <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                        <tr>
                          <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px; font-size: 11px; width: 60%; text-align: right;">
                            <?php echo  $sup_add1_ar; ?> <br>
                            <?php echo  $sup_add2_ar; ?><br>
                            <?php echo  $sup_region_ar; ?><br>
                            <?php echo  $sup_city_ar; ?><br>
                            {{$sup_country_ar}}<br>
                            <?php echo  $sup_zip_ar; ?>
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;">: العنوان </td>
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

                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">{{$vatno_ar}}</td>
                    <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 11px;">:
                      رقم ضريبة
                    </td>
                  </tr>
                  <tr>

                    <td style="border-color: white;  border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">{{$buyerid_crno_ar}}</td>
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;">:معرف المشتري
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
            <h3 style="letter-spacing: 0px; margin: 0;">Purchase Return</h3>
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
            <td style="border-color: white; text-align: left; width: 20%;">Item </td>
            <td style="border-color: white;  padding: 0;  width: 25%;text-align: left;">Description </td>
            <td style="border-color: white;  padding: 0; width: 6%;text-align: right;">Unit </td>
            <td style="border-color: white;  padding: 0; width: 7%;text-align: right;">Qty </td>
            <td style="border-color: white;   padding: 0; text-align:  right; width: 6%;">Rate </td>
            <td style="border-color: white;  padding: 0; background-color: white !important;; text-align: right; width: 7%;">Amount </td>
            <td style="border-color: white;  padding: 0;  background-color: white !important;; text-align: right; width: 7%;">Discount </td>
            <td style="border-color: white; width: 7%; padding: 0;  background-color: white !important;; text-align: right; ">VAT </td>
            <td style="border-color: white;  padding: 0; white: 6%;  background-color: white !important;width: 7%; text-align:right;">Total </td>
          </tr>
          <tr class="str">
            <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="10">
              <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
            </td>

          </tr>

          @foreach($return_product as $key=>$product)
          <tr class="str">
            <td style="border-color: white;   padding: 2px;">{{$key+1}}</td>
            <td style="border-color: white;   padding: 2px;">{{$product->itemname}}</td>
            <td style="border-color: white;   padding: 2px;">{{$product->description}}</td>
            <td style="border-color: white;   padding: 2px;"> @foreach($unitlist as $data)
              <?php if ($product->unit == $data->id) {
                echo $data->unit_code;
              } ?>
              @endforeach</td>
            <td style="border-color: white;   padding: 2px; text-align: right;">{{$product->quantity}}</td>
            <td style="border-color: white;   padding: 2px; text-align: right"> {{number_format($product->rate,2,'.',',')}}</td>
            <td style="border-color: white;   padding: 2px; text-align: right">{{number_format($product->amount,2,'.',',')}}</td>
            <td style="border-color: white;   padding: 2px; text-align: right ">{{number_format($product->discountamount,2,',','.')}}</td>
            <td style="border-color: white;   padding: 2px; text-align: right">{{number_format($product->vatamount,2,'.',',')}}</td>
            <td style="border-color: white;   padding: 2px; text-align: right"> {{number_format($product->row_total,2,'.',',')}}</td>
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
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{number_format($purchase_return->totalamount,2,'.',',')}}</td>
                        </tr>
                        <tr style="background-color: white !important;">
                          <td style="border-color: white; padding: 0;background-color: white !important;">Discount - مجموع خصومات </td>
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{number_format($purchase_return->discount,2,'.',',')}}</td>
                        </tr>
                        <tr style="background-color: white !important;">
                          <td style="border-color: white; padding: 0;background-color: white !important;">Total taxable amount(Excluding VAT) - <br> الإجمالي الخاضع للضريبة غير شاملة ضريبة القيمة المضافة </td>
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{number_format($purchase_return->totalamount,2,'.',',')}}</td>
                        </tr>
                        <tr style="background-color: white !important;">
                          <td style="border-color: white; padding: 0;background-color: white !important;">Total VAT - مجموع ضريبة القيمة المضافة </td>
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{number_format($purchase_return->totalvatamount,2,'.',',')}} </td>
                        </tr>
                        <tr style="background-color: white !important; ">
                          <td style="border-color: white; padding: 0;background-color: white !important; color:red;">Total Amount Due - إجمالي المبلغ المستحق </td>
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:right; color:red;">{{number_format($purchase_return->grandtotalamount,2,'.',',')}}</td>
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

        <br><br>
        <div class="row">
          <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">@lang('app.Notes')</h4><br>
          <p style="text-align: justify; font-size: 10px;">{!! $purchase_return->notes !!} </p>

        </div>

        <br><br>
        <div class="row">
          <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">@lang('app.Terms and Conditions')</h4><br>
          <p style="text-align: justify; font-size: 10px;">{!! $purchase_return->tpreview !!} </p>

        </div>
        <br><br>

      </div>

    </div>
  </div>
  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">
    <img src='{{ asset($footer) }}' border='0' width='100%'>

  </div>