<html>

<head>

  <?php
  $header = "";
  $footer = "";
  foreach ($branchsettings as $key => $value) {
    $header = $value->pdfheader;
    $footer = $value->pdffooter;
  }
  ?>

  <style>
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
      font: bold 100% sans-serif;
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
      font-weight: bold;
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
        font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
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
      font-family: "Calibri", "sans-serif";
    }

    table {
      font-size: 11px;
      font-family: "Calibri", "sans-serif";
    }

    td {
      font-size: 12px;
      font-family: "Calibri", "sans-serif";
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

    div.str {
      padding: 5px;
    }

    .str tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    @page * {
      margin-top: 2.54cm;
      margin-bottom: 2.54cm;
      margin-left: 3.175cm;
    }
  </style>
  <img src='{{ asset($header) }}' border='0' width='100%'>
  <div class="container" style="padding-right: 25px;padding-left: 25px;padding-top: 0px;padding-bottom: 0px;">
    <div class="row" style="margin-top:10px;">







      <div style="width: 100%;padding-bottom: 0px;">
        <table style="width:100%;" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" style="border-color: white; width:50%;">
              <!-- fffff -->


            </td>
            <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0px 0px 0px 8px;border-color: white;" width="50%">

              <table style="width:100%;  border-color: white;" cellspacing="0" cellpadding="0">
                <tr cellspacing="0" cellpadding="0">
                  <td style="border-color: white; padding:0; ">
                    <table>
                      <tr>

                        <td style="border-color: white; padding:0;">
                          <h2 style="font-size: 25px; text-align: right; margin: 0;"> Purchase Register </h2>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <table style="width:100%;" cellspacing="0" cellpadding="0">
                <tr>
                  <td style="border-color: white;    padding: 1px;" colspan="2">
                    <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
                  </td>
                </tr>
                <tr>

                  <td style="border-color: white; width: 100%; ">
                    <table style=" width: 100%;">
                      <tr>
                        <td style="border-color: white; padding: 0"><b>Form Date</b></td>
                        <td style="border-color: white; padding: 0;text-align: right;">
                          {{$fromdate}}
                        </td>

                      </tr>
                      <tr>
                        <td style="border-color: white; padding: 0"><b>Till Date</b></td>
                        <td style="border-color: white; padding: 0;text-align:  right;">
                          {{$todate}}
                        </td>
                      </tr>
                    </table>
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
            <h1 style="letter-spacing: 0px; margin: 0;">Register </h1>
          </td>
        </tr>
        <tr>
          <td style="border-color: white;   padding: 1px">

            <hr style="height: 4px; background-color: black; color:black;   padding: 1px; margin-top:0;     margin-bottom: 0;">
          </td>
        </tr>
      </table>
      <div class="str">
        <table style="table-layout: auto; border-collapse: collapse; " cellspacing="0" cellpadding="0" id="soadetails_list">
          <tr>
            <th style="border-color: white; background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">@lang('app.Sl.No')</th>
            <th style="border-color: white; background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">Date</th>
            <th style="border-color: white; background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">Invoice ID</th>
            <th style="border-color: white; background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">Supplier</th>
            <th style="border-color: white;  background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">Invoiced Amount</th>
            <!-- <th style="border-color: white;  background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">Paid from Advance</th> -->
            <th style="border-color: white; background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">Paid By Cash</th>

            <th style="text-align: right;border-color: white; background-color: white;  padding: 1px;  white-space: nowrap;">Paid By Card</th>
            <th style="text-align: right;border-color: white; background-color: white;  padding: 1px; white-space: nowrap;">Paid By Bank</th>
            <!-- <th style="text-align: right;border-color: white; background-color: white;  padding: 1px;  white-space: nowrap;">Paid at Bill Settile</th> -->
            <th style="text-align: right;border-color: white; background-color: white;  padding: 1px;  white-space: nowrap;">Total Paid</th>
            <th style="text-align: right;border-color: white; background-color: white;  padding: 1px;  white-space: nowrap;">Balance</th>

          </tr>
          <tr class="str">
            <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="12">
              <hr style="height: 4px; color:black; font-size: 5px; background-color: black; margin: 0;">
            </td>
          </tr>
          <tbody>

            <?php
            $grandtotalamount = 0;
            $advance_amt = 0;
            $paid_by_cash = 0;
            $paid_by_card = 0;
            $paid_by_bank = 0;
            $by_billsettilement = 0;
            $paid_amount = 0;
            $balance_amount = 0;
            ?>
            @foreach($updatedTransaction as $key=>$details)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$details['bill_entry_date']}}</td>
              <td>{{$details['id']}}</td>
              <td>{{$details['sup_name']}}</td>
              <td style="text-align:  right;">{{$details['grandtotalamount']}}</td>
              <!-- <td style="text-align:  right;">{{$details['advance_amt']}}</td> -->
              <td style="text-align:  right;">{{$details['paid_by_cash']}}</td>
              <td style="text-align:  right;">{{$details['paid_by_card']}}</td>
              <td style="text-align:  right;">{{$details['paid_by_bank']}}</td>
              <!-- <td style="text-align:  right;">{{$details['by_billsettilement']}}</td> -->
              <td style="text-align:  right;">{{$details['paid_by_cash']+$details['paid_by_card']+$details['paid_by_bank']}}</td>
              <td style="text-align:  right;">{{$details['grandtotalamount']-($details['paid_by_cash']+$details['paid_by_card']+$details['paid_by_bank'])}}</td>
            </tr>
            <?php
            $grandtotalamount += $details['grandtotalamount'];
            // $advance_amt += $details['advance_amt'];
            $paid_by_cash += $details['paid_by_cash'];
            $paid_by_card += $details['paid_by_card'];
            $paid_by_bank += $details['paid_by_bank'];
            // $by_billsettilement += $details['by_billsettilement'];
            $paid_amount += $details['paid_by_cash'] + $details['paid_by_card'] + $details['paid_by_bank'];
            $balance_amount += $details['grandtotalamount'] - ($details['paid_by_cash'] + $details['paid_by_card'] + $details['paid_by_bank']);
            ?>
            @endforeach
            <tr>
              <td colspan="4" style="text-align: center;"><b>Total </b></td>
              <td style="text-align:  right;"> <b><i> {{$grandtotalamount}}</i></b></td>
              <!-- <td style="text-align:  right;"> <b><i> {{$advance_amt}}</i></b></td> -->
              <td style="text-align:  right;"> <b><i> {{$paid_by_cash}}</i></b></td>
              <td style="text-align:  right;"> <b><i> {{$paid_by_card}}</i></b></td>
              <td style="text-align:  right;"> <b><i> {{$paid_by_bank}}</i></b></td>
              <!-- <td style="text-align:  right;"> <b><i> {{$by_billsettilement}}</i></b></td> -->
              <td style="text-align:  right;"> <b><i> {{$paid_amount}}</i></b></td>
              <td style="text-align:  right;"> <b><i> {{$balance_amount}}</i></b></td>
            </tr>

          </tbody>


        </table>
        <div class="row">
          <br>
          <table style="width:100%;" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top" style="border-color: white;"> </td>
              <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0px 0px 0px 8px;border-color: white;" width="60%"></td>
            </tr>
          </table>
        </div>


      </div>
      <div style="margin-top:25px;">
      </div>


    </div>
  </div>

  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">

    <img src='{{ asset($footer) }}' border='0' width='100%'>

  </div>