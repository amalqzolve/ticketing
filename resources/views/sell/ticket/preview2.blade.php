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
    <img src='{{ asset($branchsettings->pdfheader) }}' border='0' width='100%'>
  </htmlpageheader>

  <htmlpagefooter name="page-footer">
    <img src='{{ asset($branchsettings->pdffooter) }}' border='0' width='100%'>
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

                    <table style=" padding:0">
                      <tr>
                        <td style="height:60px; border-color: white; padding:0;">
                        </td>
                        <td style="height:60px; border-color: white; padding:0; font-size: 32px; text-align:left;">
                          <strong>Air Ticket </strong>
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
              <table style=" width: 100%; ">
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Ticket ID</td>
                  <td style="border-color: white; padding: 0;text-align: center;  font-size:11px; color: red;">#TKT{{$ticket->id}}</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">
                  </td>

                </tr>
                <tr>
                  <!-- {{ $ticket->quotedate != '' ? date('d-m-Y', strtotime($ticket->quotedate)) : '' }} -->
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Sales Order Id</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">#SO{{$ticket->sales_order_id}}</td>
                  <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">

                  </td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Cotact Person</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$ticket->name}}</td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Passport No</td>
                  <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$ticket->passport_no}}</td>
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
                  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 12px;" width="25%"> Trip Type </td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;"> {{$ticket->trip_details}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 12px;" width="30%"></td>
                </tr>


                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 12px;">Booking ID </td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ticket->booking_id}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>

                </tr>


                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Status</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ticket->booking_status}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>
                </tr>


                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Class</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ticket->class}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>
                </tr>

                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Type</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ticket->type}}</td>
                  <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>
                </tr>
                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Seat</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ticket->seat}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"></td>
                </tr>


                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Notes</td>
                  <td style="border-color: white; border-color: white;   padding: 0px;">{{$ticket->notes}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;"></td>
                </tr>
              </table>


            </td>
            <td valign="top" style="border-color: white; ">
              <table style="width:100%; border-color: white;   padding: 2px; " cellspacing="0" cellpadding="0">
                <tr style=" ">
                  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 12px;" width="25%">Ticket no </td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ticket->ticket_no}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 12px;" width="30%"> </td>
                </tr>

                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Airlines</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ticket->airline_name}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>
                </tr>


                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Booking Ref</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ticket->airline_booking_reference}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>
                </tr>

                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Agency</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ticket->agency}}</td>
                  <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>
                </tr>

                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Boarding</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{($ticket->boarding_time!='')?date('d-m-Y H:i',strtotime($ticket->boarding_time)):''}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>
                </tr>
                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Baggage</td>
                  <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{$ticket->baggage_allowances}}</td>
                  <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>
                </tr>
                <tr>
                  <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Services</td>
                  <td style="border-color: white;  border-color: white;   padding: 0px; font-size: 12px;">{{$ticket->extra_services}}</td>
                  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>
                </tr>

              </table>
            </td>
          </tr>
        </table>
      </div>


      <table style="table-layout: auto; " cellspacing="0" cellpadding="0">
        <tr>
          <td style="border-color: white;   padding: 1px" colspan="2">
            <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
          </td>
        </tr>
        <tr>
          <td style="border-color: white;   padding: 1px; text-align: center;" colspan="2">
            <h3 style="letter-spacing: 0px; margin: 0;">Details</h3>
          </td>
        </tr>
        <tr>
          <td style="border-color: white;   padding: 1px" colspan="2">

            <hr style="height: 4px; background-color: black; color:black;   padding: 1px; margin-top:0;     margin-bottom: 0;">
          </td>
        </tr>

        <tr>
          <td style="border-color: white;">
            <h3>Departure details</h3>
            </h3>
            <table style="width:100%; border-color: white;   padding: 2px; " cellspacing="0" cellpadding="0">
              <tr style=" ">
                <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 12px;" width="25%"> Location </td>
                <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">
                  @foreach($airports as $key => $value)
                  {{($value->code==$ticket->departure)?$value->code.'~'.$value->name:''}}
                  @endforeach
                </td>
                <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 12px;" width="30%"> </td>
              </tr>

              <tr>
                <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;">Date & Time</td>
                <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">{{($ticket->departure_date!='')?date('d-m-Y H:i',strtotime($ticket->departure_date)):''}}</td>
                <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>
              </tr>

            </table>
          </td>
          <td style="border-color: white;">
            <h3>Arrival details</h3>
            </h3>
            <table style="width:100%; border-color: white;   padding: 2px; " cellspacing="0" cellpadding="0">
              <tr style=" ">
                <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 12px;" width="25%"> Location </td>
                <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;">
                  @foreach($airports as $key => $value)
                  {{($value->code==$ticket->arrival)?$value->code.'~'.$value->name:''}}
                  @endforeach
                </td>
                <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 12px;" width="30%"> </td>
              </tr>

              <tr>
                <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 12px;"> Date & Time</td>
                <td style="border-color: white; border-color: white;   padding: 0px; font-size: 12px;"> {{($ticket->arrival_date!='')?date('d-m-Y H:i',strtotime($ticket->arrival_date)):''}}</td>
                <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 12px;"> </td>
              </tr>

            </table>
          </td>
        </tr>

      </table>

      <table>
        <tr>
          <td style="border-color: white;   padding: 1px" colspan="2">

            <hr style="height: 4px; background-color: black; color:black;   padding: 1px; margin-top:0;     margin-bottom: 0;">
          </td>
        </tr>
      </table>

      <div class="str">
        <table>
          <tr>
            <td style="border-color: white;  width: 3%;text-align:left; white-space: nowrap;">#</td>
            <td style="border-color: white; text-align: left; width: 30%;">Passenger Name<br></td>
            <td style="border-color: white; text-align: left; width: 20%;">Pasport no<br></td>
            <td style="border-color: white;  padding: 0; width: 10%;text-align: center;"> Ticket no</td>
            <td style="border-color: white;   padding: 0; text-align: center; width: 10%;">Bookig id</td>
            @if($ticket->show_fair==1)
            <td style="border-color: white;  padding: 0; background-color: white !important;; text-align:center; width: 10%;">Fare</td>
            @endif
          </tr>

          <tr class="str">
            <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="{{($ticket->show_fair==1)?6:5}}">
              <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
            </td>
          </tr>

          @foreach ($ticketMembers as $key => $quotation_products)
          <tr class="str">
            <td style="border-color: white;   padding: 2px; text-align: left;">{{ $key + 1 }}
            </td>
            <td style="border-color: white;   padding: 2px; text-align: left;">
              {{ $quotation_products->add_passenger_name }}
            </td>
            <td style="border-color: white;   padding: 2px;">
              {{ $quotation_products->add_passenger_passport }}
            </td>

            <td style="border-color: white;   padding: 2px; text-align: right;">
              {{ $quotation_products->add_passenger_ticket_number }}
            </td>
            <td style="border-color: white;   padding: 2px; text-align: right;">
              {{ $quotation_products->add_passenger_booking_id }}
            </td>
            @if($ticket->show_fair==1)
            <td style="border-color: white;   padding: 2px; text-align: center; ">
              {{ number_format($quotation_products->add_fare, 2, '.', ',') }}
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


          @if($ticket->show_fair==1)
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
                          <td style="border-color: white; padding: 0;background-color: white !important;">Total Amount </td>
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{number_format($ticket->total_amount,2,'.',',')}}</td>
                        </tr>
                        <tr style="background-color: white !important; ">
                          <td style="border-color: white; padding: 0;background-color: white !important;text-align:left;font-size: 8pt; !important ">
                            <p style="font-size: 8pt;!important">{{$words}} only.</p>
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
          @endif

        </div>

      </div>

    </div>
  </div>