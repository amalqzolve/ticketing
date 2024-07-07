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
    <div class="row" style="margin-top:70px;">
      <!-- <div style="width: 100%;padding-bottom: 0px;">



      </div> -->

      <div style="width: 100%; padding-top: -65px;">
        <table style="width:100%;" cellspacing="0" cellpadding="0">
          <tr>
            <td style="border-color: white;   padding-top: 0; padding-right: 0; padding-bottom: 0;  ">
              <table style=" width: 100%; ">
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">PO ID.</td>
                  <td style="border-color: white; padding: 0;text-align: left;  font-size:11px; color: red;"> PO {{$mainData->id}}</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                </tr>

                <!-- <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Supplier Name</td>
                  <td style="border-color: white; padding: 0;text-align: left;  font-size:11px;"> {{$mainData->sup_name}}</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                </tr> -->
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;"> PO Date</td>
                  <td style="border-color: white; padding: 0;text-align: left;  font-size:11px; "> {{date('d-m-Y',strtotime($mainData->po_date))}}</td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Valid Till Date</td>
                  <td style="border-color: white; padding: 0;text-align: left;  font-size:11px; "> {{date('d-m-Y',strtotime($mainData->po_valid_till))}} </td>
                  <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;"></td>
                </tr>
                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold; font-size: 11px;"> Request type </td>
                  <td style="border-color: white; padding: 0;text-align: left; font-size: 11px;">&nbsp;{{($mainData->request_type==1)?'Internal use':''}}{{($mainData->request_type==2)?'Department use':''}}{{($mainData->request_type==3)?'Personal use':''}}{{($mainData->request_type==4)?'Project Purpose':''}}
                  </td>
                </tr>
                @if($mainData->request_type==4)
                <tr>
                  <td style=" border-color: white;padding: 0; font-size: 11px; font-weight: bold; ">Project </td>
                  <td style="border-color: white;padding: 0; font-size: 11px; text-align: left;">&nbsp;{{$mainData->projectname}}</td>
                </tr>
                @endif

                <tr>
                  <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">QTN Ref</td>
                  <td style="border-color: white; padding: 0;text-align: left;  font-size:11px; "> {{$mainData->supp_quot_id}}</td>
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
                        <td rowspan="1" style="border-color: white; padding:0; width: 30%;">

                        </td>
                        <td colspan="2" style="border-color: white; padding:0;"></td>
                      </tr>
                      <tr>
                        <!-- <td style="height:60px; border-color: white; padding:0;">
                        </td> -->
                        <td colspan="3" style="height:60px; border-color: white; padding:0; font-size: 32px; text-align:right;">
                          <strong> Purchase&nbsp;Order </strong>
                          <!-- <br> -->
                        </td>
                      </tr>
                      <tr>
                        <td style="border-color: white; padding:0;">&nbsp;</td>
                        <td style="border-color: white; padding:0;">&nbsp;</td>
                        <td style="border-color: white; padding:0; text-align:right;"> <span style="font-weight: bold;">Generated by </span>:{{$mainData->created_name}}
                          <br>
                          Email : {{$mainData->created_email}}
                          <br>
                          Phone : {{$mainData->created_phone}}
                          <br>
                          Epr ID : EPR-{{$mainData->epr_id}}
                        </td>
                      </tr>
                      created_name


                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="border-color: white;  padding-left: 5px;" colspan="2">
              <!-- <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;"> -->
            </td>
          </tr>
        </table>
        </td>
        </tr>
        </table>

        <!--  -->
        <table style="width:100%; border-spacing: 0;" cellspacing="0" cellpadding="0">

          <tr>
            <td valign="top" style="border-color: white; width: 50; ">
              <center>
                <h3>Supplier Details </h3>
                </h3>

                <table style="width:100%; border-color: white;  border-spacing: 0; /*padding: 2px;*/ " cellspacing="0" cellpadding="0">
                  <tr style=" ">
                    <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 11px;" width="12%">Name:</td>
                    <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="1%">:</td> -->
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">{{$mainData->sup_name}}</td>
                    <!-- <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 11px;" width="30%">      الإسم      </td> -->
                  </tr>


                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 11px;">Address: </td>
                    <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%">:</td> -->
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; padding:0; ">
                      <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                        <tr>
                          <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; ">{{$mainData->sup_add1}} <br>
                            {{$mainData->sup_add2}}<br>
                            {{$mainData->sup_region}}<br>
                            {{$mainData->sup_city}}<br>
                            {{$mainData->sup_zip}}
                          </td>
                        </tr>
                      </table>

                    </td>
                    <!-- <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"  >  رقم المبني    </td> -->

                  </tr>





                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;">Vat No</td>
                    <!--    <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%"></td> -->
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">
                      <table style=" width: 100%;border-collapse: collapse; border-spacing: 0; ">
                        <tr>
                          <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; ">{{$mainData->vatno}}

                          </td>
                        </tr>
                      </table>
                    </td>
                    <!--  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"   >      الحي       </td> -->
                  </tr>




                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;">Cr No</td>
                    <!--  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%"></td> -->
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">
                      <table style=" width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                          <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; ">

                            {{$mainData->buyerid_crno}}
                          </td>
                          }
                          }
                        </tr>
                      </table>
                    </td>
                    <!-- <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 11px;"  >     المدينة     </td> -->
                  </tr>

                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;"></td>
                    <!--  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%"></td> -->
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">
                      <table style=" width: 100%; border-collapse: collapse; border-spacing: 0;">
                        <tr>
                          <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; ">


                          </td>
                        </tr>
                      </table>
                    </td>
                    <!-- <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"  >       الرمز البريدي      </td> -->
                  </tr>

                </table>


            </td>
            <td valign="top" style="border-color: white; width: 50%;">
              <center>
                <h3>تفاصيل المشتري </h3>
                </h3>
                <table style="width:100%; border-color: white;   padding: 2px; border-spacing: 0; " cellspacing="0" cellpadding="0">
                  <tr style=" ">
                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">{{$mainData->sup_name_ar}}</td>
                    <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="3%">:</td> -->
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 11px;" width="20%">:

                      الإسم


                    </td>
                  </tr>


                  <tr>

                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">
                      <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                        <tr>
                          <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px; font-size: 11px; width: 60%; text-align: right;">

                            {{$mainData->sup_add1_ar}} <br>
                            {{$mainData->sup_add2_ar}}<br>
                            {{$mainData->sup_region_ar}}<br>
                            {{$mainData->sup_city_ar}}<br>
                            {{$mainData->sup_country_ar}}<br>
                            {{$mainData->sup_zip_ar}}

                          </td>

                        </tr>
                      </table>
                    </td>
                    <!--  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;">:</td> -->
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
                    <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"></td> -->
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
                    <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"></td> -->
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
                    <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"></td> -->
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"> </td>
                  </tr>




                  <tr>

                    <td style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">{{$mainData->vatno_ar}}</td>
                    <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;">:</td> -->
                    <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 11px;">:

                      رقم ضريبة


                    </td>
                  </tr>
                  <tr>

                    <td style="border-color: white;  border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">{{$mainData->buyerid_crno_ar}}</td>
                    <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;">:</td> -->
                    <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;">:معرف المشتري

                    </td>
                  </tr>




                </table>


            </td>

          </tr>
        </table>
        <!--  -->



      </div>




      <table style="table-layout: auto; " cellspacing="0" cellpadding="0">
        <!-- <tr>
          <td style="border-color: white;   padding: 1px">
            <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
          </td>
        </tr>
        <tr>
          <td style="border-color: white;   padding: 1px; text-align: center;">
            <h3 style="letter-spacing: 0px; margin: 0;">Items </h3>
          </td>
        </tr> -->
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
        <div class="row">
          <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">Delivery terms</h4>
          <p style="text-align: justify; font-size: 10px;">{{$mainData->delivery_terms}}</p>

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
                  <img style="display:block; width: 40%;height: 40%;" src="{{asset($sign)}}">
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

      </div>
    </div>
  </div>
  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">
    <img src='{{ asset($footer) }}' border='0' width='100%'>
  </div>