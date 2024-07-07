<html>

<head>
  @php
  foreach ($branchsettings as $key => $value) {
  $header=$value->pdfheader;
  $footer=$value->pdffooter;
  }
  @endphp

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
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Voucher ID.</td>
                  <td style="border-color: white; padding: 0;text-align: left;  font-size:11px; color: red;">G-PV {{$mainData->id}}</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;"> Voucher Date </td>
                  <td style="border-color: white; padding: 0;text-align: left;  font-size:11px; "> {{date('d-m-Y',strtotime($mainData->voucher_date))}}</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                </tr>

                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Payment Method</td>
                  <td style="border-color: white; padding: 0;text-align: left;  font-size:11px;">
                    <?php
                    $bank_name = '';
                    $bank_account = '';
                    $cheque_number = '';
                    $cheque_date = '';
                    if ($mainData->payment_method == 1) {
                      $method = 'Cash';
                      $tId = $mainData->cash_transaction_id;
                      $ref = $mainData->cash_transaction_referance;
                    } else if ($mainData->payment_method == 2) {
                      $method = 'Bank Transfer';
                      $tId = $mainData->bank_transaction_id;
                      $ref = $mainData->bank_transaction_referance;
                      $bank_name = $mainData->bank_name . '~~' . $mainData->iban_swift_code;
                    } else if ($mainData->payment_method == 3) {
                      $method = 'Cheque';
                    } else if ($mainData->payment_method == 4) {
                      $method = 'Cheque';
                      $tId = $mainData->cheque_transaction_id;
                      $ref = $mainData->cheque_transaction_referance;
                      $cheque_number = $mainData->cheque_number;
                      $cheque_date = date('d-m-Y', strtotime($mainData->cheque_date));
                    }
                    echo  $method;
                    ?>

                  </td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                </tr>

                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Transaction ID </td>
                  <td style="border-color: white; padding: 0;text-align: left;  font-size:11px;">{{$tId}}</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                </tr>

                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Transaction Ref </td>
                  <td style="border-color: white; padding: 0;text-align: left;  font-size:11px;">{{$ref}} </td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                </tr>
                <!---->

                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Amount</td>
                  <td style="border-color: white; padding: 0;text-align: left;  font-size:11px;">{{$mainData->amount}} </td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                </tr>






              </table>
            </td>
            <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0; border-color: white; width:48%">
              <table style="width:100%;  border-color: white;" cellspacing="0" cellpadding="0">
                <tr cellspacing="0" cellpadding="0">
                  <td style="border-color: white; ">
                    <table style=" padding:0">

                      <tr>

                        <td colspan="3" style="height:60px; border-color: white; padding:0; font-size: 32px; text-align:right;">
                          <strong>Payment&nbsp;Voucher </strong><br>
                        </td>
                      </tr>
                      <tr>
                        <td style="border-color: white; padding:0;">&nbsp;</td>
                        <td style="border-color: white; padding:0;">&nbsp;</td>
                        <td style="border-color: white; padding:0; text-align:right;"> <span style="font-weight: bold;">Generated by </span>:{{$mainData->created_name}} <br>Date: {{isset($mainData->voucher_date)?date('d-m-Y',strtotime($mainData->voucher_date)):''}}</td>
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



      <table>
        <tr>
          <td style="border-color: white;  width: 3%;text-align:left; white-space: nowrap;"></td>
          <td style="border-color: white; text-align: left; width: 10%;">Dr/Cr </td>
          <td style="border-color: white; text-align: left; width: 15%;">Account </td>
          <td style="border-color: white;  padding: 0;  width: 50%;text-align: left;">Description </td>
          <td style="border-color: white;   padding: 0; text-align:  right; width: 7%;">Debit </td>
          <td style="border-color: white;   padding: 0; text-align:  right; width: 7%;">Credit</td>
        </tr>
        <tr class="str">
          <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="6">
            <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
          </td>

        </tr>




        <tr class="str">
          <td style="border-color: white;   padding: 2px;"></td>
          <td style="border-color: white;   padding: 2px;">Dr</td>
          <td style="border-color: white;   padding: 2px;">{{$mainData->sup_name}}</td>
          <td style="border-color: white;   padding: 2px;"> Payment on {{isset($mainData->voucher_date)?date('d-m-Y',strtotime($mainData->voucher_date)):''}} by {{$method}} ,{{$bank_name}} {{$bank_account}} {{$cheque_number}} {{$cheque_date}} with Ref Id:{{$tId}},Ref.Number:{{$ref}} </td>
          <td style="border-color: white;   padding: 2px; text-align: right">{{$mainData->amount}}</td>
          <td style="border-color: white;   padding: 2px; text-align: right"></td>
        </tr>
        <tr class="str">
          <td style="border-color: white;   padding: 2px;"></td>
          <td style="border-color: white;   padding: 2px;">Cr</td>
          <td style="border-color: white;   padding: 2px;"> {{$payment_cr_account}}</td>
          <!-- cr name -->
          <td style="border-color: white;   padding: 2px; text-align: right"></td>
          <td style="border-color: white;   padding: 2px; text-align: right"></td>
          <td style="border-color: white;   padding: 2px; text-align: right">{{$mainData->amount}}</td>
        </tr>
        <tr class="str">
          <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="6">
            <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
          </td>
        </tr>
        <tr class="str">
          <td style="border-color: white;   padding: 2px;text-align: center" colspan="4"><b> Total</b></td>
          <td style="border-color: white;   padding: 2px; text-align: right"><b>{{$mainData->amount}}</b></td>
          <td style="border-color: white;   padding: 2px; text-align: right"><b>{{$mainData->amount}}</b></td>
        </tr>

      </table>

      <div class="row">
        <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">Voucher Notes</h4>
        <p style="text-align: justify; font-size: 10px;">{{$mainData->notes}}</p>

      </div>
      <br>
      <div class="row">
        <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">Voucher Reference</h4>
        <p style="text-align: justify; font-size: 10px;">{{$mainData->notes}}</p>

      </div>

      <br>
      <div class="row">
        <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">@lang('app.Notes')</h4>
        <p style="text-align: justify; font-size: 10px;">{{$mainData->notes}}</p>

      </div>

      <br><br>
      <div class="row">
        <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">@lang('app.Terms and Conditions')</h4><br>
        <p style="text-align: justify; font-size: 10px;"> {!! $mainData->description!!} </p>

      </div>
      <br><br>



    </div>
  </div>
  </div>
  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">
    <img src='{{ asset($footer) }}' border='0' width='100%'>
  </div>