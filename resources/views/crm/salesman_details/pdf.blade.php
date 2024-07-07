
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
<?php 
foreach ($salesman as $key => $value) {
	
$infoid = $value->id; 
$name = $value->name; 
$email = $value->email; 
$commission=$value->commission;
$target=$value->target;
$password = $value->password;
 $address1 = $value->address1;
 $address2 = $value->address2;
 $address3 = $value->address3;
 $zip = $value->zip;
 $country = $value->country;
 $region = $value->region;
 $place = $value->place;
 $department = $value->department; 
 $department_head = $value->department_head;
 $routes = $value->salesman_route; 
 $parent_group = $value->account_group; 
$ledgername = $value->account_ledger;
 $ledgercode = $value->account_code;
}?>
<table>
	
	 <tr>
		<td>{{ __('salesman.Name') }}:{{$name}}</td>
		<td>{{ __('salesman.Email') }}:{{$email}}</td>
		
	</tr>
	 
	<tr>
		<td>{{ __('salesman.Salesman Commission') }}:{{$commission}}</td>
		<td>{{ __('salesman.Target') }}:{{$target}}</td>
		
	</tr>
	<tr>
		 <td>{{ __('salesman.Address1') }}:{{$address1}}</td>
	 
		<td>{{ __('salesman.Address2') }}:{{$address2}}</td>
		
	</tr>
	<tr>
				<td>{{ __('salesman.Address3') }}:{{$address3}}</td>

		<td>{{ __('salesman.Zip') }}:{{$zip}}</td>
		
	</tr>
	<tr>
				<td>{{ __('salesman.Country') }}:{{$country}}</td>

		<td>{{ __('salesman.Region') }}:{{$region}}</td>
		
	</tr>
	<tr>
		<td>{{ __('salesman.Place') }}:{{$place}}</td>

		<td>{{ __('salesman.Department') }}:{{$department}}</td>
		
	</tr>
	<tr>
				<td>{{ __('salesman.Department Head') }}:{{$department_head}}</td>

		<td>{{ __('salesman.Salesman Route') }}:<?php foreach ($route as $data) if ($routes == $data->id)
{
		echo $data->routename;
} ?></td>
		
	</tr>
	<tr>
				<td>{{ __('salesman.Account Group') }}:{{$parent_group}}</td>

	</tr>
</table>
	 </div>
 </body>
 </html>
