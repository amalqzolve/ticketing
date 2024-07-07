


<html>
<head>

<?php

         foreach ($branchsettings as $key => $value) {
         $header=$value->pdfheader;
         $footer=$value->pdffooter;
         }
         foreach($contracts as $contract)
  {
    $id = $contract->id;
    $customer = $contract->customer;
    $contractname = $contract->contractname;
    $startingdate = $contract->startingdate;
    $endingdate = $contract->endingdate;
    $contractamount = $contract->contractamount;
    $contractvatamount = $contract->contractvatamount;
    $contractno = $contract->contractno;
    $contractreference = $contract->contractreference;
    $invoiceno = $contract->invoiceno;
    $notes = $contract->notes;
    $terms = $contract->terms;
    $tpreview = $contract->tpreview;
    
  }
  if($contractreference == 1)
  {
    $ref = "Sales Quotation";
  }
  elseif ($contractreference == 2)
  {
        $ref = "Sales Order";
  }
  elseif ($contractreference == 3)
  {
        $ref = "Sales Invoice";
  }
  else
  {
    $ref = "";
  }
  if($contractvatamount == 1)
  {
    $vat = "Including";
  }
  elseif($contractvatamount == 2)
  {
    $vat = "Excluding";
  }
  else
  {
    $vat = "";
  }
         ?>

<style>



/*@font-face {
    font-family: 'Tajawal', sans-serif;
    src: url({{ storage_path('fonts/Tajawal-Light.ttf') }}) format('truetype');
}
*/
 * {  font-family: 'Tajawal', sans-serif; }
   h1
   {
   font-size: 24px;
   }
   h4
   {
   font-size: 12px;
   }
   th
   {
   padding:0px !important;
   }
   p 
   {
   margin: 0 0 -14px;
   }
   .panel
   {
   margin-bottom: 10px!important;
   border-color: white;
   box-shadow: none;
   }
   h1 {  letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }
   /* table */
   table { font-size: 12px; table-layout: fixed; width: 100%; }
   table { border-collapse: separate; border-spacing: 2px; }
   th, td { border-width: 1px; padding: 0.1em; position: relative; text-align: left; }
   th, td { border-radius: 0.25em; border-style: solid; }
   th { background: #EEE; border-color: #BBB; }
   td { border-color: #DDD; }
   /* header */
   /* table meta & balance */
   table.meta, table.balance { float: right; width: 36%; }
   table.meta:after, table.balance:after { clear: both; content: ""; display: table; }
   /* table meta */
   table.meta th { width: 40%; }
   table.meta td { width: 60%; }
   /* table items */
   table.inventory { clear: both; width: 100%; }
   table.inventory th {  text-align: center; }
   table.inventory td:nth-child(1) { width: 26%; }
   table.inventory td:nth-child(2) { width: 38%; }
   table.inventory td:nth-child(3) { text-align: right; width: 12%; }
   table.inventory td:nth-child(4) { text-align: right; width: 12%; }
   table.inventory td:nth-child(5) { text-align: right; width: 12%; }
   /* table balance */
   table.balance th, table.balance td { width: 50%; }
   table.balance td { text-align: right; }
   tr:hover .cut { opacity: 1; }
   @media print {
   * { -webkit-print-color-adjust: exact; }
   html { background: none; padding: 0; }
   body { box-shadow: none; margin: 0;
font-family: 'Tajawal', sans-serif; }
   span:empty { display: none; }
   .add, .cut { display: none;  padding: 0;}
   }
   @page { margin: 5px; }

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
   .col-6
   {
    width: 50%;
    float: left;
   }

   .col-40
   {
    width: 40%;
    float: left;
   }

   .col-60
   {
    width: 59%;
    float: left;
   }
    .col-10
   {
    width: 10%;
    float: left;
   }
  

   .col-90
   {
    width: 89%;
    float: left;
   }
   .row
   {
    width: 100%;
   }
.str tr:nth-child(even) {
    background-color: #f2f2f2;
  }
   .str table, .str tr, .str td{
  border-spacing: 0 !important;
  border: none !important;
}
@page { margin: 0px; }
body { margin: 0px; }
</style>
  <img src='{{ asset($header) }}' border='0' width='100%' >
<div class="container" style="padding-right: 25px;padding-left: 25px;padding-top: 0px;padding-bottom: 0px;">
<div class="row" style="margin-top:10px;">
  <div style="width: 100%;padding-bottom: 0px;">
    


                <!-- <div class="kt-portlet__head kt-portlet__head--lg">
                  <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                      <i class="kt-font-brand flaticon-home-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                      @lang('app.Purchase List')
                    </h3>
                  </div>
                  
                </div> -->
                <!-- <hr style="height: 4px; color:black;  background-color: black; margin-top: 0;     margin-bottom: 1px;"> -->

                <div class="kt-portlet__body">
                  
                  <div class="row">
                
                  <div style="width: 35%; margin:auto;">
                    <span><h1>Contracts</h1></span>
                  

                  </div>
                
                  <div style="width: 50%; float: left;" class="col-md-4">
                    <table style="width:100%; margin-right: 15px; "  cellspacing="0" cellpadding="0">
                      <tr><td style="width:50%; border-color: white;   padding: 0px;  font-weight: bold;">Contract ID</td><td style="border-color: white;   padding: 0px;">{{$id}}</td></tr>
                      <tr><td style="border-color: white;   padding: 0px;  font-weight: bold;">Contract Number</td><td style="border-color: white;   padding: 0px;">{{$contractno}}</td></tr>
                      <tr><td style="border-color: white;   padding: 0px;  font-weight: bold;">Contract Name</td><td style="border-color: white;   padding: 0px;">{{$contractname}}</td></tr>
                      <tr><td style="border-color: white;   padding: 0px;  font-weight: bold;">Customer Name</td><td style="border-color: white;   padding: 0px;">@foreach($customers as $customerss) 
                    <?php 
                    if($customer == $customerss->id)
                      echo $customerss->cust_name;
                    ?>
                    @endforeach</td></tr>
                    </table>
                     
                     
                    

                  </div>
                  <div  style="width: 50%; float: left; " class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <table class="table-responsive" style="width:100%; margin-left: 15px;"  cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td style="width:50%; border-color: white;   padding:0px;  font-weight: bold;">Starting Date </td><td style="border-color: white;   padding:0px">{{$startingdate}}
                          </td></tr>
                          <tr>
                          <td style="border-color: white;   padding:0px;  font-weight: bold;">Ending Date</td><td style="border-color: white;   padding:0px">{{$endingdate}}</td></tr><tr>
                          <td style="border-color: white;   padding:0px;  font-weight: bold;">Contract Amount</td><td style="border-color: white;   padding:0px"> {{$contractamount}} </td></tr>
                        <tr><td style="border-color: white;   padding:0px;  font-weight: bold;">Vat Amount</td><td style="border-color: white;   padding:0px">{{$vat}}</td></tr><tr><td style="border-color: white;   padding:0px;  font-weight: bold;">Reference</td><td style="border-color: white;   padding:0px">{{$ref}}</td></tr>
                      <tr><td style="border-color: white;   padding:0px;  font-weight: bold;">Invoice ID</td><td style="border-color: white;   padding:0px"> {{$invoiceno}}</td></tr>
                      </tbody>
                    </table>
                  </div>
                  </div>

<div class="kt-invoice__body">
                      <div class="kt-invoice__container">
                        <div class="str">
                         

                        </div>
                  <div style="width: 50%; float:right;">
                  </div>
                  <div style="width: 50%; float:right;">
                       
                      </div>
                      </div>
                    </div>


          <br><br>
          <div style="border-top: 0px solid #f2f2f2; color:#444; padding:0 0 20px 0;"><br>
                <table class="table-responsive" style="width:100%;"  cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td style=" border-color: white;   padding: 1px;">
                            <h5 class="card-header">Notes</h5>
                  
                           <!--  <h5 class="card-title">Special title treatment</h5> -->
                            <p class="card-text">{{$notes}}</p>
                          </td>
                          <td style=" border-color: white;   padding: 1px; text-align: center;">
                            <h5 class="card-header">Terms And Conditions</h5>
                  
                           
                        
                            <h5 class="card-title"></h5>
                            <p class="card-text"></p>
                           
                          </td>
                          
                        </tr>
                      </tbody>
                    </table>

            
            <br><br><br><br><br>
  <table width="100%">
   <tr>
     <td style="text-align: center; border-color: white;   padding: 1px;"><b>Issued by <br> 
      Name, Signature & Date
      </b></td>
     <td style="text-align: center; border-color: white;   padding: 1px;"><b>Preperd by <br> 
     Name, Signature & Date </b></td>
      <td style="text-align: center; border-color: white;   padding: 1px;"><b>Received by <br> 
      Name, Signature & Date </b></td>
   </tr>
 </table>
          </div>

                </div>
              




    </div>
 
  </div>  </div>

  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">
    
    <img src='{{ asset($footer) }}' border='0' width='100%' >
   
  </div>












