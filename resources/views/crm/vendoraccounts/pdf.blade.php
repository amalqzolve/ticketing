
<html>
	<head>
		<?php
         foreach ($branchsettings as $key => $value) {
         $header=$value->pdfheader;
         $footer=$value->pdffooter;
         }
         ?>
	 <style>
		 @page { margin: 180px 50px; }
		 #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px;  text-align: center; }
		 #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; text-align: center; }
		  }
	 </style>
	<body>
	 <div id="header">
		 <!-- <h1>PDF</h1> -->
       <img src="{{ asset($header) }}"  height="150" width="1250"  class="img-thumboli" />

	 </div>
	 <div id="footer">
       <img src="{{ asset($footer) }}"  height="150" width="1250"  class="img-thumboli" />
	 </div>
	 <div id="content">

<table width="100%" style="width:100%" border="0">
	
	    <tr>
		<td>{{ __('customer.Name') }}:{{$data->vendor_name}}</td>
		<td>{{ __('customer.Code') }}:{{$data->vendor_code}}</td>
		
	</tr>
	<tr>
		<td>{{ __('customer.Ledger Name') }}:{{$data->account_ledger}}</td>
		<td>{{ __('customer.Ledger Code') }}:{{$data->account_code}}</td>
		
	</tr>
	
		</table>
	 </div>
 </body>
 </html>
