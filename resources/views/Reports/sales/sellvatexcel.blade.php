
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

<table>
    <tr>
      <td>
         
      </td>
    </tr>
    <tr>
      <td>
        	Sales VAT Report
        
      </td>
    </tr>
    
   </table>

<?php 

	$totalinvoiceamount = 0;
	$exvat = 0;
	$vat = 0;
	$no =0;
	foreach($details as $key=>$details1)
	{
	
		$no = $key+1;
	}
	?>
<table>
	<thead>
		<tr>
			<td colspan="9">
			</td>
		</tr>
		<tr>
			<td>@lang('app.Sl.No')</td>
			<td>@lang('app.Sales Date')</td>
			<td>@lang('app.Sales ID')</td>
			<td>Customer</td>
			<td>@lang('app.Vat No')</td>
		
			<td>Sales Amount</td>
			<td>Excluding Vat</td>
			<td>@lang('app.Vat Amount')</td>
			
			
			
		</tr>
		<tr>
			<td colspan="9">
			
			</td>
		</tr>
	</thead>

	<tbody>
@foreach($details as $key=>$details)
<tr>
<td>{{$key+1}}</td>
<td>{{$details->quotedate}}</td>
<td>#{{$details->sid}}</td>
<td>{{$details->cust_name}}</td>
<td>{{$details->vat_no}}</td>

<td>{{number_format($details->grandtotalamount,2,'.',',')}}</td>
<td>{{number_format($details->totalamount,2,'.',',')}}</td>
<td>{{number_format($details->vatamount,2,'.',',')}}</td>


</tr>

<?php 
  $totalinvoiceamount+= $details->grandtotalamount;
    $exvat += $details->totalamount;
    $vat += $details->vatamount;
?>
@endforeach
</tbody>

</table>

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
                    	{{$no}}
                    </td>
                  </tr>

                   <tr style="background-color: white !important;">
                    <td style="border-color: white; padding: 0;background-color: white !important;">
                    	@lang('app.Total Invoice Amount')
                    </td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">
                    	{{number_format($totalinvoiceamount,2,'.',',')}}
                    </td>
                  </tr>


							<tr style="background-color: white !important;">
                    <td style="border-color: white; padding: 0;background-color: white !important;">
                    	@lang('app.Total Excluding Vat Amount')
                    </td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">
                    	{{number_format($exvat,2,'.',',')}}
                    </td>
                  </tr>


                  <tr style="background-color: white !important;">
                    <td style="border-color: white; padding: 0;background-color: white !important;">
                    	@lang('app.Total Vat Amount')
                    </td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">

                      <?php
                      $bal_vat=$totalinvoiceamount-$exvat;
 ?>
                    	{{number_format($bal_vat,2,'.',',')}}
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
