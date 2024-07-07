
<html>
<head>

<?php

         foreach ($branchsettings as $key => $value) {
         $header=$value->pdfheader;
         $footer=$value->pdffooter;
         }
         $totalcost =0;
$grandtotalamount = 0;
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

    <table style="width:100%;" cellspacing="0" cellpadding="0">
      
      <tr>
         <td valign="top" style="border-color: white; width:50%;">
         <table class="table table-striped table-hover table-checkable dataTable no-footer">
 @foreach($data as $datas)
 <?php
 $grandtotalamount = $datas->grandtotalamount;
?> 
     <tr><th>Purchase ID</th><td><?php echo $datas->id; ?></td></tr> 
     <tr><th>Total Items</th><td>{{$productscount}}</td></tr>    
  <tr><th>Purchase Amount</th><td><?php echo $datas->grandtotalamount; ?></td></tr>
   <a href="{{url('/')}}/purchasecostpdf?pid={{$datas->id}}"  target="_blank" class="btn btn-brand btn-elevate btn-icon-sm">PDF</a>&nbsp;
   @endforeach
   
   
	
</table>
          
            
         </td>
         <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0px 0px 0px 8px;border-color: white;" width="50%">
          
            <table style="width:100%;  border-color: white;" cellspacing="0" cellpadding="0" >
              <tr cellspacing="0" cellpadding="0" >
                <td style="border-color: white; padding:0; ">
                  <table>
                    <tr>
                      
                      <td  style="border-color: white; padding:0;">
                        <h2 style="font-size: 25px; text-align: right; margin: 0;"> PURCHASE COST</h2>
                      </td>
                </tr>
                </table>
                </td>
              </tr>             
          </table>
          
          	<table class="table table-striped table-hover table-checkable dataTable no-footer">
		<thead>
			<tr><th>Cost Name</th>
			<th>Amount</th></tr>
		</thead>
		<tbody>
			@foreach($purchase_costlist as $key => $purchase_costlist) 
			<tr><td>               
          @foreach($costheadlist as $data)
               <?php
               $totalcost += $purchase_costlist->amount;
              if($data->id == $purchase_costlist->costheadname)
                {
                       echo $data->voucher_name;
                }
              ?>
            @endforeach</td> <td>{{$purchase_costlist->amount}}
            	</td></tr>
     @endforeach
		</tbody>
		
		
    <tr><th>Total Cost</th><td><?php echo round($totalcost,2) ?></td></tr>
    <?php
    $costamount = 0;
 $grandtotal = $totalcost + $grandtotalamount;
 $costamount = $totalcost / $productscount;
 ?><tr><th>Single Item Cost Amount</th><td>{{round($costamount,2)}}</td></tr>
     <tr><th>Grand Total(Purchase Amount + Total Cost)</th><td><?php echo round($grandtotal,2) ?></td></tr>
    
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
        <h1 style="letter-spacing: 0px; margin: 0;">Purchase Cost </h1>
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
      <th>@lang('app.Sl.No')</th>
      <th>Product Name</th>
      <th>Part No</th>
      <th>Unit</th>
      <th>Quantity</th>
      <th>Rate</th>
      <th>Amount</th>
      <th>Vat Amount</th>
      <th>Total Amount</th>
      <th>Total Cost</th>
      <th>Price for Single Quantity</th>

    </tr>
     


   
  <tbody>
  

@foreach($pi_product as $key=>$pi_products)
<tr>
  <td>{{$key+1}}</td>
  <td>{{$pi_products->product_name}}</td>
  <td>{{$pi_products->part_no}}</td>
  <td>{{$pi_products->unit_name}}</td>
  <td>{{$pi_products->quantity}}</td>
  <td>{{$pi_products->rate}}</td>
  <td>{{$pi_products->amount}}</td>
  <td>{{$pi_products->vatamount}}</td>
  <td>{{$pi_products->totalamount}}</td>
  <td>{{round($costamount * $pi_products->quantity),2}}</td>
  <td>{{round($costamount + $pi_products->rate),2}}</td>

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
