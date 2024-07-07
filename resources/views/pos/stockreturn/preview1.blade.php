<html>
<head>
<?php

$pdfheader_top=100;
$pdffooter_bottom=160;

if(Session::get('pdfheader_top')){
  $pdfheader_top=Session::get('pdfheader_top');
}
if(Session::get('pdffooter_bottom')){
  $pdffooter_bottom=Session::get('pdffooter_bottom');
}


?>
<?php

         foreach ($branchsettings as $key => $value) {
         $header=$value->pdfheader;
         $footer=$value->pdffooter;
         }
         ?>
<?php

foreach ($stockreturn as $key => $value)
{
        $returnid = $value->id;
        $vanname = $value->vanname;
        $date = $value->date;
        $notes = $value->notes;
        $returneditems = $value->returneditems;
        $returnedquantity = $value->returnedquantity;
        
                
}

 $quantity = 0;



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

body { margin: 0px; }

@page { 
  margin: <?php echo $pdfheader_top;?>px 0px <?php echo $pdffooter_bottom;?>px 0px; 
}
@page {
  header: page-header;
  footer: page-footer;
}



</style>

<htmlpageheader name="page-header">
 <img src='{{ asset($header) }}' border='0' width='100%' >
</htmlpageheader>

<htmlpagefooter name="page-footer">
  <img src='{{ asset($footer) }}' border='0' width='100%' >
</htmlpagefooter>
 
<div class="container" style="padding-right: 25px;padding-left: 25px;  padding-bottom: 0px; ">
<div class="row" style="margin-top:0px;">
  <div style="width: 100%;padding-bottom: 0px;">
    
  
   
  </div>
   
  <div style="width: 100%; padding-top: 0px;">
    <table style="width:100%;" cellspacing="0" cellpadding="0">
      <tr>
      
      
         <td  style="border-color: white;   padding-top: 0; padding-right: 0; padding-bottom: 0;  ">
        <!-- <h1 style="letter-spacing: 0px; margin: 0; text-align:left; margin-left: 5px; padding:0">Buyer: </h1> -->
        <table style=" width: 100%; ">
          <tr>
                    <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Return ID</td>
                    <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$returnid}}</td>
                    <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">
                    

                  </td>
                  </tr>
                  <tr>
                    <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Van Name</td>
                    <td style="border-color: white; padding: 0;text-align: center;  font-size:11px; color: red;">{{$vanname}}</td> 
                    <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">
                      
                      

                    </td>
                  
                  </tr>
                  

                    <tr>
                    <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;"> Date</td>
                    <td style="border-color: white; padding: 0;text-align:  center;  font-size:11px;">{{$date}}</td>
                    <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">


                       </td>
                  </tr>
                 



      
                </table>
      </td>
      <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0; border-color: white; width:48%">
          <table style="width:100%;  border-color: white;" cellspacing="0" cellpadding="0" >
              <tr cellspacing="0" cellpadding="0" >
                <td style="border-color: white; ">
                  <!-- <table style="margin:0; padding:0">
                    <tr>

                      
                      
                </tr>
                </table> -->
                <table  style=" padding:0">
  
                  <tr>   
                    <td rowspan="2" style="border-color: white; padding:0; width: 30%;">
                     <div class="visible-print text-center">


  <?php

/*     $company_name="Rabou Liyan Trading Est";
     $company_vat='300396608300003';

   $qrtextof='Seller Name :-> '.$company_name.', Vat Number :-> '.$company_vat.', Datetime :-> '.$quotedate.', Vat Total :-> '.$totalvatamount.', Total  :->'.$grandtotalamount;


$qrtextof=str_replace('',"",$qrtextof);*/



  ?>
    
</div>
                    </td>
                    <td colspan="2" style="border-color: white; padding:0;"></td>
                  </tr>
                  <tr>    
                    <td style="height:60px; border-color: white; padding:0;">
                       

                
                       
                      </td>
                    <td style="height:60px; border-color: white; padding:0; font-size: 32px; text-align:right;">
                      <strong>Stock Return </strong><br>     </td>
                  </tr>
                </table>
                </td>
              </tr>
               <tr>
                <td  style="border-color: white;  padding-left: 5px;" colspan="2">
                   <hr style="height: 2px; color:black;  background-color: black; margin-top: 1px;     margin-bottom: 1px;">
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
        <h3 style="letter-spacing: 0px; margin: 0;">Product Details  </h3>
      </td>
    </tr>
    <tr>
      <td  style="border-color: white;   padding: 1px">
       
        <hr style="height: 4px; background-color: black; color:black;   padding: 1px; margin-top:0;     margin-bottom: 0;">
      </td>
    </tr>
   </table>
   <div class="str">
   <table>
      <tr>
       <td   style="border-color: white;  width: 20%;text-align:left; white-space: nowrap;">#</td>
       
       <td  style="border-color: white; text-align: left; width: 50%;">Product Name<br> </td>
       <td  style="border-color: white;  padding: 0;  width: 30%;text-align: left;">Return Quantity  <br></td>
      
       
       
       
       
       

     </tr>
      <tr class="str">
        <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;"  colspan="12"><hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;"></td>
         
     </tr>
    
        @foreach($stockreturn_products as $key=>$stockreturn_products)
        
     <tr class="str">
       <td  style="border-color: white;   padding: 2px; text-align: left;">{{$key+1}}</td>
      
      <td style="border-color: white;   padding: 2px; text-align: center;">{{$stockreturn_products->product_name}}</td>
               
       <td  style="border-color: white;   padding: 2px; text-align: left;">{{$stockreturn_products->retquantity}}</td>

     
            
      
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



   <table style="width:100%; font-weight:bold;" cellspacing="0" cellpadding="0">
      <tr>
         <td valign="top" style="border-color: white;">
         
         </td>
         <td cellspacing="0" cellpadding="0" valign="right" style="padding: 0px 0px 0px 8px;border-color: white;" width="70%">
         
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
                    <td style="border-color: white; padding: 0;background-color: white !important;">Total Items Returned</td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{$returneditems}}</td>
                  </tr>

                   <tr style="background-color: white !important;">
                    <td style="border-color: white; padding: 0;background-color: white !important;">Total Returned Quantity</td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{$returnedquantity}}</td>
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
  <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">Notes</h4>
  <p style="text-align: justify; font-size: 10px;">{{$notes}} </p>

 </div>

 <br><br>

 <div class="row">


 


   </div>
</div>
 
  </div>  </div>

  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">
    
  
   
  </div>










