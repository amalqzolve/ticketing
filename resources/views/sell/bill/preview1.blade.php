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


$salesquotation_sufix = ""; 
    $salesquotation = ""; 
$des = "";
$total=0;
 if($companysettings!="")
  {
    foreach($companysettings as $companies)
    {
      $salesquotation_sufix = $companies->salesquotation_sufix;
      $salesquotation = $companies->salesquotation;
    }
  }
?>
<?php

         foreach ($branchsettings as $key => $value) {
         $header=$value->pdfheader;
         $footer=$value->pdffooter;
         }
         ?>
<?php

foreach($billsettlement as $billsettlements)
{
  $id = $billsettlements->id;
$customer = $billsettlements->customer;
$tdate = $billsettlements->tdate;
$notes = $billsettlements->notes;
$saleid = $billsettlements->bills;
$paidamount = $billsettlements->paidamount;

}

foreach ($customers as $key => $customers)
{
  $cust_code = $customers->cust_code;
   $cust_type = $customers->type;
   $cust_group = $customers->group;
   $cust_category = $customers->customer_category;
   $cust_name = $customers->cust_name;
   $cust_add1 = $customers->cust_add1;
   $cust_add2 = $customers->cust_add2;
   $cust_country = $customers->cntry_name;
   $cust_region = $customers->cust_region;
   $cust_city = $customers->cust_city;
   $cust_zip = $customers->cust_zip;
   $mobile = $customers->mobile;
   $vatno = $customers->vatno;
   $buyerid_crno = $customers->buyerid_crno;

  $ar_cust_name = $customers->ar_cust_name;
  $ar_cust_add1 = $customers->ar_cust_add1;
  $ar_cust_add2 = $customers->ar_cust_add2;
  $ar_cust_region = $customers->ar_cust_region;
  $ar_cust_city = $customers->ar_cust_city;
  $ar_cust_zip = $customers->ar_cust_zip;
  $ar_vatno = $customers->ar_vatno;
  $ar_buyerid_crno = $customers->ar_buyerid_crno;
  $ar_cust_country = $customers->ar_cust_country;

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
                    <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Sale ID</td>
                    <td style="border-color: white; padding: 0;text-align: center;  font-size:11px; color: red;">{{$saleid}}</td> 
                    <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">
                    


                    </td>
                  
                  </tr>

 <tr>
                    <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Transaction Date</td>
                    <td style="border-color: white; padding: 0;text-align: center;  font-size:11px; color: red;">{{$tdate}}</td> 
                    <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">
                    


                    </td>
                  
                  </tr>
                  <tr>
                    <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">Paid Amount</td>
                    <td style="border-color: white; padding: 0;text-align: center;  font-size:11px; color: red;">{{$paidamount}}</td> 
                    <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">
                    


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

$c=storage_path('app/public/'.str_slug($id).'.svg');

  ?>
    <!-- <img src='{{  $c }}' style="width:80px" > -->
</div>
                    </td>
                    <td colspan="2" style="border-color: white; padding:0;"></td>
                  </tr>
                  <tr>    
                    <td style="height:60px; border-color: white; padding:0;">
                       

                
                       
                      </td>
                    <td style="height:60px; border-color: white; padding:0; font-size: 32px; text-align:right;">
                      <strong>Bill Settle</strong><br></td>
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
   <table style="width:100%; border-spacing: 0;" cellspacing="0" cellpadding="0">
    
      <tr>
         <td valign="top" style="border-color: white; width: 50; ">
         <center><h3>Buyer Details  </h3></h3>

          <table style="width:100%; border-color: white;  border-spacing: 0; /*padding: 2px;*/ " cellspacing="0" cellpadding="0">
            <tr style=" ">
              <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 11px;"  width="12%">Name:</td>
              <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="1%">:</td> -->
              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">{{$cust_name}}</td>
                <!-- <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 11px;" width="30%">      الإسم      </td> -->
            </tr>


              <tr>
              <td style=" border-color: white; ; border-color: white;   padding: 0px; font-weight: bold; font-size: 11px;"  >Address: </td>
              <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%">:</td> -->
              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; padding:0; "> 
                <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                  <tr >
                    <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; " ><?php if(isset($cust_add1)){echo  $cust_add1;echo "<br>";} ?> 
                      <?php if(isset($cust_add2)){ echo  $cust_add2;echo "<br>";} ?>
                    </td>
                  </tr>
                </table>

              </td>
              <!-- <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"  >  رقم المبني    </td> -->

            </tr>


    


      <tr>
              <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;" ></td>
          <!--    <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%"></td> -->
              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">
                <table style=" width: 100%;border-collapse: collapse; border-spacing: 0; ">
                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; " >
                       <?php if(isset($cust_region)){echo  $cust_region;echo "<br>";} ?>
                      
                    </td>
                  </tr>
                </table>
              </td>
             <!--  <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"   >      الحي       </td> -->
            </tr>


             

      <tr>
              <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;" ></td>
             <!--  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%"></td> -->
              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">
                <table style=" width: 100%; border-collapse: collapse; border-spacing: 0;">
                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; " > 
                        <?php if(isset($cust_zip)){echo  $cust_zip;echo "<br>";} ?>
                 
                    </td>
                  </tr>
                </table>
              </td>
              <!-- <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 11px;"  >     المدينة     </td> -->
            </tr>
   
   <tr>
              <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;"  ></td>
             <!--  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%"></td> -->
              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">
                <table style=" width: 100%; border-collapse: collapse; border-spacing: 0;">
                  <tr>
                    <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-size: 11px; " >
                      
                      <?php if(isset($cust_city)){echo  $cust_city;echo "<br>";} ?><?php if(isset($cust_country)){echo  $cust_country;echo "<br>";} ?>
                    </td>
                  </tr>
                </table>
              </td>
              <!-- <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"  >       الرمز البريدي      </td> -->
            </tr>
          

             <!--   <tr>
              <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold;"   width="30%">Additional No:</td>
              <td  style="border-color: white; border-color: white;   padding: 0px;"><?php //echo  '-'; ?></td>
              <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;" >      الرقم الإضافي للعنوان     </td>
            </tr> -->
   
            <tr>
              <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;" >VAT No:</td>
              <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%">:</td> -->
              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px;">{{$vatno}}</td>
              <!-- <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 11px;"  >   رقم تسجيل ضريبة القيمة المضافة      </td> -->
            </tr>
   <tr>
              <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold; font-size: 11px;" >CR No:</td>
             <!--  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="2%">:</td> -->
              <td  style="border-color: white;  border-color: white;   padding: 0px; font-size: 11px;">{{$buyerid_crno}}</td>
              <!-- <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"  >   معرف آخر       </td> -->
            </tr>







         
            
          </table>
          
            
         </td>
         <td valign="top" style="border-color: white; width: 50%;">
          <center><h3>تفاصيل المشتري   </h3></h3>
          <table style="width:100%; border-color: white;   padding: 2px; border-spacing: 0; " cellspacing="0" cellpadding="0">
            <tr style=" ">
              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; "> {{$ar_cust_name}}</td>
              <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"  width="3%">:</td> -->
                <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;  font-size: 11px;" width="20%">:

                الإسم


              </td>
            </tr>


              <tr>

              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">
                <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                  <tr >
                    <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px; font-size: 11px; width: 60%; text-align: right;" > 
                   <?php if(isset($ar_cust_add1)){echo $ar_cust_add1;echo "<br>";} ?><?php if(isset($ar_cust_add2)){echo  $ar_cust_add2;echo "<br>";} ?> 
                      

                  </td>
                    
                  </tr>
                </table>
              </td>
             <!--  <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;">:</td> -->
              <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"  >: العنوان  </td>

            </tr>




      <tr>

              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">
                <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                 <tr >
                    <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px; font-size: 11px; width: 60%; text-align: right;" >
                      <?php if(isset($ar_cust_region)){echo  $ar_cust_region;echo "<br>";} ?> 
                     

                  </td>
                    
                  </tr>
                </table>
              </td>
              <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"></td> -->
              <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"   >          </td>
            </tr>



            



      <tr>
              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">
                <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse; border-spacing: 0;">
                   <tr >
                    <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px; font-size: 11px; width: 60%; text-align: right;" >
                      <?php if(isset($ar_cust_zip)){echo  $ar_cust_zip;echo "<br>";} ?>

                       </td>
                    
                  </tr>
                </table>
              </td>
              <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"></td> -->
              <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 11px;"  >     </td>
            </tr>
  
   <tr>
          
              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; border-spacing: 0; ">
                <table style=" width: 100%; margin: 0; padding:0;border-collapse: collapse;">
                   <tr >
                    <td style="margin: 0; border-color: white; ; border-color: white;   padding: 0px; font-size: 11px; width: 60%; text-align: right;" >
                      <?php if(isset($ar_cust_city)){echo  $ar_cust_city;echo "<br>";} ?><?php if(isset($ar_cust_country)){echo  $ar_cust_country;echo "<br>";} ?>
                       </td>
                    
                  </tr>
                </table>
              </td>
              <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;"></td> -->
              <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"  >          </td>
            </tr>

         

              <!--  <tr>
              <td style=" border-color: white; ; border-color: white;   padding: 0px;  font-weight: bold;"   width="30%">Additional No:</td>
              <td  style="border-color: white; border-color: white;   padding: 0px;"></td>
              <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px;" >      الرقم الإضافي للعنوان     </td>
            </tr> -->
   <tr>

              <td  style="border-color: white; border-color: white;   padding: 0px; font-size: 11px; text-align: right; "> {{$ar_vatno}}</td>
              <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;">:</td> -->
              <td style=" border-color: white; text-align:right; ; border-color: white;   padding: 0px; font-size: 11px;"  >:
                
                رقم ضريبة

                
              </td>
            </tr>
   <tr>
            
              <td  style="border-color: white;  border-color: white;   padding: 0px; font-size: 11px; text-align: right; ">{{$ar_buyerid_crno}}</td>
              <!-- <td style=" border-color: white; ; border-color: white;   padding: 0px; font-size: 11px;">:</td> -->
              <td style=" border-color: white; text-align: right; ; border-color: white;   padding: 0px; font-size: 11px;"  >:معرف المشتري

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
        <h3 style="letter-spacing: 0px; margin: 0;"> Details </h3>
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
       <td   style="border-color: white;  width: 3%;text-align:left; white-space: nowrap;">#</td>
       <td  style="border-color: white; text-align: left; width: 30%;">@lang('app.Mode of Payment')<br></td>
     <td  style="border-color: white; text-align: left; width: 30%;">@lang('app.Reference')<br></td>
    
    
       <td  style="border-color: white;  padding: 0; width: 5%;text-align: center;">@lang('app.Amount')  <br>   الوحدة       </td>
       
       

     </tr>
      <tr class="str">
        <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;"  colspan="4"><hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;"></td>
         
     </tr>
    
               @foreach($billsettlement_metod as $key=>$billsettlement_metods)
               <?php $total += $billsettlement_metods->amount;?>
     <tr class="str">
       <td  style="border-color: white;   padding: 2px; text-align: left;">{{$key+1}}</td>
       <td  style="border-color: white;   padding: 2px; text-align: left;"><?php if($billsettlement_metods->modeofpayment == 1) echo 'Cash';?>
             <?php if($billsettlement_metods->modeofpayment == 2) echo 'Card';?>
             <?php if($billsettlement_metods->modeofpayment == 3) echo 'Bank';?>
             <?php if($billsettlement_metods->modeofpayment == 4) echo 'Cheque';?></td>
          <td  style="border-color: white;   padding: 2px;">
            {{$billsettlement_metods->preference}}
</td>   

       <td  style="border-color: white;   padding: 2px; text-align: center;">{{$billsettlement_metods->amount}}</td>
      
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
                    <td style="border-color: white; padding: 0;background-color: white !important;">Total </td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">{{$total}}</td>
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



<!--  <br>
 <div class="row">
  <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">@lang('app.Notes')</h4>
  <p style="text-align: justify; font-size: 10px;">{{$notes}}</p>

 </div> -->

 <br><br>
 <div class="row">
  <h4 style="letter-spacing: 0px; margin: 0; text-align: left;">@lang('app.Notes')</h4>
  <p style="text-align: justify; font-size: 10px;">{{$notes}}</p>

 </div>

 <br><br>
 <table width="100%">
   <tr>
     <td style="border-color: white;background-color: white !important; font-weight: b;"><span style="font-weight: bold;">Prepared by</span><br> 
   
      </td>
     <td style="border-color: white;background-color: white !important; text-align: center;"><span style="font-weight: bold;">Approved by</span> <br> 
      </td>
    <td style="border-color: white; text-align: right;background-color: white !important;"><span style="font-weight: bold;">Received by</span> <br> 
     </td> 
   </tr><tr>
     <td style="border-color: white;background-color: white !important;"><p><br>  </p></td>
     <td style="border-color: white;background-color: white !important;"><p><br>  </p></td>
      <td style="border-color: white; text-align: right;background-color: white !important;"><p> <br> <br><!-- Name, Signature & Date --> <br>  </p></td>
   </tr>
 </table>
 <div class="row">


 


   </div>
</div>
 
  </div>  </div>

  <div style="width: 100%;padding-bottom: 0px; position: absolute; bottom: 0;">
    
  
   
  </div>










