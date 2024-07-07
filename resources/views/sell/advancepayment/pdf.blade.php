<html>

<head>

  <?php

  foreach ($branchsettings as $key => $value) {
    $header = $value->pdfheader;
    $footer = $value->pdffooter;
  }
  ?>
  <?php
  foreach ($advancepayment as $advancepayments) {
    $id = $advancepayments->id;
    $customer = $advancepayments->customer;
    $invoice_no = $advancepayments->invoice_no;
    $date1 = $advancepayments->date;
    $notes = $advancepayments->notes;
    $transactiontype = $advancepayments->transactiontype;
    $accountledger_depositaccount = $advancepayments->accountledger_depositaccount;
  }
  // foreach($advancepayment_metod as $advancepayment_metods)
  // {
  // $modeofpayment = $advancepayment_metods->modeofpayment;
  // $amounts = $advancepayment_metods->amounts;
  // $preference = $advancepayment_metods->preference;
  // }
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
              <!-- <h1 style="letter-spacing: 0px; margin: 0; text-align:left; margin-left: 5px; padding:0">Buyer: </h1> -->
              <table style=" width: 100%; ">

                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Customer</td>
                  <td style="border-color: white; padding: 0;text-align: center;  font-size:11px; color: red;">@foreach($customers as $customerss)
                    <?php if ($customer == $customerss->id) {
                      echo $customerss->cust_name;
                    } ?>
                    @endforeach</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">



                  </td>

                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Transaction Type</td>
                  <td style="border-color: white; padding: 0;text-align: center;  font-size:11px; color: red;"><?php if ($transactiontype == 1) echo "On Account"; ?> <?php if ($transactiontype == 2) echo "Sale Order ID "; ?></td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">



                  </td>

                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Date</td>
                  <td style="border-color: white; padding: 0;text-align: center;  font-size:11px; color: red;">{{$date1}}</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">



                  </td>

                </tr>


                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Invoice No</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$invoice_no}}</td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">
                    رقم ضريبة


                  </td>
                </tr>
                <tr>
                  <td>

                    <table>
                      <thead>
                        <tr>

                          <th>@lang('app.Mode of Payment')</th>
                          <th>@lang('app.Reference')</th>
                          <th>@lang('app.Amount')</th>


                        </tr>
                      </thead>
                      <?php
                      foreach ($advancepayment_metod as $key => $advancepayment_metods) {
                      ?>

                        <tr>

                          <td style="padding: 0;">

                            <?php if ($advancepayment_metods->modeofpayment == 1) echo 'Cash'; ?>
                            <?php if ($advancepayment_metods->modeofpayment == 2) echo 'Card'; ?>
                            <?php if ($advancepayment_metods->modeofpayment == 3) echo 'Bank'; ?>
                            <?php if ($advancepayment_metods->modeofpayment == 4) echo 'Cheque'; ?>

                          </td>
                          <td style="padding: 0;">

                            {{$advancepayment_metods->preference}}

                          </td>
                          <td style="padding: 0;">

                            {{$advancepayment_metods->amounts}}

                          </td>

                        </tr>
                      <?php
                      }
                      ?>

                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Notes</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$notes}} </td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">
                    رقم ضريبة


                  </td>
                </tr>








              </table>
            </td>

          </tr>
        </table>

        <div class="row">





        </div>
      </div>

    </div>
  </div>

  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">

    <img src='{{ asset($footer) }}' border='0' width='100%'>

  </div>