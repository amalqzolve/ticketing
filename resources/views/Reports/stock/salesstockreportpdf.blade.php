
<html>
<head>

<?php
$header = "";
$footer = "";
         foreach ($branchsettings as $key => $value) {
         $header=$value->pdfheader;
         $footer=$value->pdffooter;
         }
         ?>

<style>

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
.str tr:nth-child(odd) {
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
	<table style="table-layout: auto; " cellspacing="0" cellpadding="0" >
    <tr>
      <td  style="border-color: white;   padding: 1px">
         <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
      </td>
    </tr>
    <tr>
      <td  style="border-color: white;   padding: 1px; text-align: center;">
        <h3 style="letter-spacing: 0px; margin: 0;">
        	Sales stock Report 
        </h3>
      </td>
    </tr>
    
   </table>
 </div>
  <div class="str" style="width: 100%;padding-bottom: 0px;">

<table class="table table-striped table-hover table-checkable dataTable no-footer" id="salesvatdetails_list">
	<thead>
		<tr>
			<td colspan="9">
				<hr style="height: 4px; background-color: black; color:black;   padding: 1px; margin-top:0;     margin-bottom: 0;">
			</td>
		</tr>
		<tr>
			<td style="border-color: white; text-align:center; white-space: nowrap;">@lang('app.Sl.No')</td>
			<td   style="border-color: white;   white-space: nowrap;">@lang('app.Invoice ID')</tf>
			<td   style="border-color: white;  white-space: nowrap;">@lang('app.Item Name')</td>
      <td   style="border-color: white;  white-space: nowrap;">@lang('app.Invoice Date')</td>
      <td   style="border-color: white;  white-space: nowrap;">@lang('app.Quantity')</td>
			
		</tr>
		<tr>
			<td colspan="9">
				<hr style="height: 2px; background-color: black; color:black;   padding: 1px; margin-top:0;     margin-bottom: 0;">
			</td>
		</tr>
	</thead>

	<tbody>
@foreach($data as $key=>$value)
<tr>
  <td>{{$key+1}}</td>
  <td>{{$value->invoice_id}}</td>
  <td>{{$value->product_name}}</td>
  <td>{{$value->invoice_date}}</td>
  <td>{{$value->quantity}}</td>
  
</tr>
@endforeach
</tbody>

</table>






</div> 
<!-- <div style="margin-top:25px;">
<table style="width:100%; font-weight:bold;" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" style="border-color: white;"></td>
			<td cellspacing="0" cellpadding="0" valign="right" style="padding: 0px 0px 0px 8px;border-color: white;" width="50%">
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
                    <td style="border-color: white; padding: 0;background-color: white !important;">
                    	@lang('app.Total Invoice')
                    </td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">
                    
                    </td>
                  </tr>

                   <tr style="background-color: white !important;">
                    <td style="border-color: white; padding: 0;background-color: white !important;">
                    	@lang('app.Total Invoice Amount')
                    </td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">
                    	
                    </td>
                  </tr>


							<tr style="background-color: white !important;">
                    <td style="border-color: white; padding: 0;background-color: white !important;">
                    	@lang('app.Total Excluding Vat Amount')
                    </td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">
                    	
                    </td>
                  </tr>


                  <tr style="background-color: white !important;">
                    <td style="border-color: white; padding: 0;background-color: white !important;">
                    	@lang('app.Total Vat Amount')
                    </td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">

                      
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
</div> -->


 </div></div>

  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">
    
    <img src='{{ asset($footer) }}' border='0' width='100%' >
   
  </div>
