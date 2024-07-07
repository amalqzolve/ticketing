
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
        	
Statment of Account
      </td>
    </tr>
    
   </table>

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
<table>
	<thead>
		<tr>
			<td colspan="9">
			</td>
		</tr>
		<tr>
        <th>@lang('app.Sl.No')</th>
        <th>@lang('app.Document ID')</th>
        <th>@lang('app.Document Type')</th>
        <th>Transaction</th>
        <th>Notes</th>
        <th>@lang('app.Document Date')</th>
        <th>@lang('app.Dr Amount')</th>
        <th>@lang('app.Cr Amount')</th>
        <th>@lang('app.Balance')</th>
        
      </tr>
		<tr>
			<td colspan="9">
			
			</td>
		</tr>
	</thead>

	<tbody>
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
                    <td style="border-color: white; padding: 0;background-color: white !important;">Transaction during the period
                    </td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">
                    	{{$BAL}}
                    </td>
                  </tr>

                   <tr style="background-color: white !important;">
                    <td style="border-color: white; padding: 0;background-color: white !important;">
                    	Closing Balance 
                    </td>
                    <td style="border-color: white; padding: 0;background-color: white !important;text-align:right;">
                    	{{$openBAL+$BAL}}
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
