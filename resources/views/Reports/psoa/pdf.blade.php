
<html>
<head>

<?php

         foreach ($branchsettings as $key => $value) {
         $header=$value->pdfheader;
         $footer=$value->pdffooter;
         }
         ?>

<style>
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
   h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }
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
   table.inventory th { font-weight: bold; text-align: center; }
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
   font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif; }
   span:empty { display: none; }
   .add, .cut { display: none;  padding: 0;}
   }
   @page { margin: 5px; }

   body {
   font-size: 12px;
   font-family: "Calibri","sans-serif";
   }
   table {
   font-size: 11px;
   font-family: "Calibri","sans-serif";
   }
   td {
   font-size: 12px;
   font-family: "Calibri","sans-serif";
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
   div.str{
      padding: 5px;
   }
.str tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  @page *{
    margin-top: 2.54cm;
    margin-bottom: 2.54cm;
    margin-left: 3.175cm;
   }
</style>
  <img src='{{ asset($header) }}' border='0' width='100%' >







<div class="container" style="padding-right: 25px;padding-left: 25px;padding-top: 0px;padding-bottom: 0px;">
<div class="row" style="margin-top:10px;">
  
    





  <div style="width: 100%;padding-bottom: 0px;">
<?php $BAL = 0; 
     $openBAL = 0; 
    $opbal = 0; 
    $trdp = 0; 
    $clbal = 0; 
    $openBALh = 0;
    foreach($name as $names)
  {
    $cust_name =  $names->name;
  }
?>
@foreach($opening_balance as $key=>$balance1)
<?php if($balance1->transaction_type=='cash'){
$rcramt1=$balance1->totalamount;
$rdramt1=$balance1->totalamount;
} elseif($balance1->transaction_type=='credit'){
$rcramt1=$balance1->totalamount;
$rdramt1=$balance1->paid_amount;
} else{

} 

$openBALh +=$rcramt1-$rdramt1;
?>

@endforeach
    <table style="width:100%;" cellspacing="0" cellpadding="0">
      
      <tr>
         <td valign="top" style="border-color: white; width:50%;">
          <table style="width:90%; margin-top: 40px;" cellspacing="0" cellpadding="0">
            <tr>
              <td style=" border-color: white;"  width="30%"><b>{{$providername}} Name</b></td>
              
              <td  style="border-color: white; "><b>
                {{$cust_name}}
              </b></td>
            </tr>
            <tr>
              <td style=" border-color: white;"   width="30%"><b>Address </b></td>
             
              <td  style="border-color: white; ">
                Address
              </td>
            </tr>
            <tr>
              <td style=" border-color: white;"   width="30%"><b> Mobile No </b></td>
           
              <td  style="border-color: white;">
                 Mobile No
              </td>
            </tr>
             

          

            

            
          </table>
          
            
         </td>
         <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0px 0px 0px 8px;border-color: white;" width="50%">
          
            <table style="width:100%;  border-color: white;" cellspacing="0" cellpadding="0" >
              <tr cellspacing="0" cellpadding="0" >
                <td style="border-color: white; padding:0; ">
                  <table>
                    <tr>
                      
                      <td  style="border-color: white; padding:0;">
                        <h2 style="font-size: 25px; text-align: right; margin: 0;"> STATEMENT OF ACCOUNT </h2>
                      </td>
                </tr>
                </table>
                </td>
              </tr>             
          </table>
          
          <table style="width:100%;" cellspacing="0" cellpadding="0">
          <tr>
            <td  style="border-color: white;    padding: 1px;" colspan="2">
               <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
            </td>
          </tr>
            <tr>
              <!-- <td style="border-color: white;    padding: 1px">
                <table>
                  <tr>
                    <td style="border-color: white; padding: 0"><b>QUOTATION</b></td>
                    <td style="border-color: white; padding: 0"> print_r($result[0]->quote_num); ?> </td>
                  </tr>
                </table>
              </td> -->
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
                   <tr>
                    <td style="border-color: white; padding: 0"><b>Opemimg Balance </b></td>
                    <td style="border-color: white; padding: 0;text-align: right;">
                      {{$openBALh}}
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

  <table style="table-layout: auto; " cellspacing="0" cellpadding="0" >
     <tr>
      <td  style="border-color: white;   padding: 1px">
         <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
      </td>
    </tr>
    <tr>
      <td  style="border-color: white;   padding: 1px; text-align: center;">
        <h1 style="letter-spacing: 0px; margin: 0;">Statement </h1>
      </td>
    </tr>
    <tr>
      <td  style="border-color: white;   padding: 1px">
       
        <hr style="height: 4px; background-color: black; color:black;   padding: 1px; margin-top:0;     margin-bottom: 0;">
      </td>
    </tr>
  </table>
  <div class="str">
    <table style="table-layout: auto; border-collapse: collapse; " cellspacing="0" cellpadding="0"  id="soadetails_list">
      <tr>
        <th style="border-color: white; background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">@lang('app.Sl.No')</th>
        <th style="border-color: white;  background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">@lang('app.Document ID')</th>
        <th style="border-color: white;  background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">@lang('app.Document Type')</th>
        <th style="border-color: white;  background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">Transaction</th>
        <th style="border-color: white; background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">Notes</th>
        <th style="border-color: white; background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">@lang('app.Document Date')</th>
        <th style="border-color: white; background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">@lang('app.Dr Amount')</th>
        <th style="border-color: white; background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">@lang('app.Cr Amount')</th>
        <th style="border-color: white; background-color: white;  padding: 1px; text-align:left; white-space: nowrap;">@lang('app.Balance')</th>
        
      </tr>
      <tr class="str">
        <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;"  colspan="9"><hr style="height: 4px; color:black; font-size: 5px; background-color: black; margin: 0;"></td>
         
     </tr>


   
  <tbody>
  



<!-- opbal -->
@foreach($opening_balance as $key=>$balance1)
<?php if($balance1->transaction_type=='cash'){
$rcramt1=$balance1->totalamount;
$rdramt1=$balance1->totalamount;
} elseif($balance1->transaction_type=='credit'){
$rcramt1=$balance1->totalamount;
$rdramt1=$balance1->paid_amount;
} else{

} 

$openBAL +=$rcramt1-$rdramt1;
?>

@endforeach

<!-- opbal -->



@foreach($details as $key=>$details)
<?php if($details->transaction_type=='cash'){
$rcramt=$details->totalamount;
$rdramt=$details->totalamount;
} elseif($details->transaction_type=='credit'){
$rcramt=$details->totalamount;
$rdramt=$details->paid_amount;
} else{

} 

$BAL +=$rcramt-$rdramt;
?>
<tr class="str" style="border-collapse: collapse;">
<td style="border-collapse: collapse; border:0;">{{$key+1}}</td>
<td style="border-collapse: collapse; border:0;">{{$details->doc_id}}</td>
<td style="border-collapse: collapse; border:0;">{{$details->doc_type}}</td>

<td style="border-collapse: collapse; border:0;">{{$details->transaction_type}}</td>
<td style="border-collapse: collapse; border:0;"></td>
<td style="border-collapse: collapse; border:0;">{{$details->doc_transaction}}</td>


<td style="text-align: right; border-collapse: collapse; border:0;">{{$rcramt}}</td>
<td style="text-align: right; border-collapse: collapse; border:0;">{{$rdramt}}</td>
<td style="text-align: right; border-collapse: collapse; border:0;">{{$BAL}}</td>
</tr>
@endforeach
  </tbody>

  
</table>
<div class="row">  
   
   <br>
  
  <table style="width:100%;" cellspacing="0" cellpadding="0">
      <tr>
         <td valign="top" style="border-color: white;">
         
         </td>
         <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0px 0px 0px 8px;border-color: white;" width="60%">
          
          
          
          <table style="width:100%; background-color: white !important; " cellspacing="0" cellpadding="0">
          <tr>
            <td  style="border-color: white;    padding: 1px;" colspan="2">
              <hr style="height: 4px; color:black; background-color: black;  padding: 1px; margin-top: 1px;     margin-bottom: 1px;">
            </td>
          </tr>
            <tr style="background-color: white !important;">
             
              <td style="border-color: white;background-color: white !important; width: 100%; padding: 0; ">
                <table style="width:100%; background-color: white !important;">
                  <tr style="background-color: white !important;">
                    <td style="border-color: white; padding: 0;background-color: white !important;"><b>Transaction during the period</b></td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;"><b>
                      {{$BAL}}
                    </b></td>
                  </tr>
                  <tr style="background-color: white !important;">
                    <td style="border-color: white; padding: 0;background-color: white !important;"><b>Closing Balance </b></td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;"><b>
                     {{$openBAL+$BAL}}
                    </b></td>
                  </tr>
                   
                  
                </table>
              </td>
            </tr>
            <tr>
              <td style="border-color: white;    padding: 1px;" colspan="2">
                <hr style="height: 4px; color:black;   background-color: black; margin-top: 1px;     margin-bottom: 1px;">
              </td>
            </tr>
          </table>
          
           
         
         </td>
      </tr>
   </table> 
  
  
</div>












</div> 
<div style="margin-top:25px;">

</div>


 </div></div>

  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">
    
    <img src='{{ asset($footer) }}' border='0' width='100%' >
   
  </div>
