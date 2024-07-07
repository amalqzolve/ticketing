<html>

<head>
	<?php
	foreach ($branchsettings as $key => $value) {
		$header = $value->pdfheader;
		$footer = $value->pdffooter;
	}
	?>
	<style>
		@page {
			margin: 180px 50px;
		}

		#header {
			position: fixed;
			left: 0px;
			top: -180px;
			right: 0px;
			height: 150px;
			text-align: center;
		}

		#footer {
			position: fixed;
			left: 0px;
			bottom: -180px;
			right: 0px;
			height: 150px;
			text-align: center;
		}


		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td,
		th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #dddddd;
		}
	</style>

<body>
	<div id="header">
		<img src="{{ asset($header) }}" height="150" width="1250" class="img-thumboli" />
	</div>
	<div id="footer">
		<img src="{{ asset($footer) }}" height="150" width="1250" class="img-thumboli" />
	</div>
	<div id="content">
		<?php
		foreach ($customer as $key => $value) {
			$cust_name = $value->cust_name;
			$cust_code = $value->cust_code;
		}
		?>
		<?php
		foreach ($customerdocuments as $key => $value) {
			$vat_no = $value->vat_no;
			$license_no = $value->license_no;
			$description = $value->description;
			$payment_terms = $value->payment_terms;
			$credit_period_of_total_invoices = $value->credit_period_of_total_invoices;
			$total_amount = $value->total_amount;
			$credit_period_of_each_invoices = $value->credit_period_of_each_invoices;
			$cr_no = $value->cr_no;
			$license_expiring_date = $value->license_expiring_date;
			$vat_expiring_date = $value->vat_expiring_date;
			$cr_expiring_date = $value->cr_expiring_date;
			$contract_no = $value->contract_no;
			$contractno_expiry_date = $value->contractno_expiry_date;
			$no_of_invoices = $value->no_of_invoices;
		}
		?>
		<h2>
			<center>{{ __('customer.Customer Documents & Contracts') }}</center>
		</h2>
		<table>

			<tr>
				<th>{{ __('customer.Customer Name') }}</th>
				<td>{{$cust_name}}</td>
			</tr>
			<tr>
				<th>{{ __('customer.Customer Code') }}</th>
				<td>{{$cust_code}}</td>

			</tr>
			<tr>
				<th>{{ __('customer.VAT No') }}</th>
				<td>{{$vat_no}}</td>
			</tr>
			<tr>
				<th>{{ __('customer.License No') }}</th>
				<td>{{$license_no}}</td>

			</tr>
			<tr>
				<th>{{ __('customer.Customer No') }}</th>
				<td>{{$cr_no}}</td>
			</tr>
			<tr>
				<th>{{ __('customer.VAT Expiring Date') }}</th>
				<td>{{$vat_expiring_date}}</td>

			</tr>
			<tr>
				<th>{{ __('customer.License Expiring Date') }}</th>
				<td>{{$license_expiring_date}}</td>
			</tr>
			<tr>
				<th>{{ __('customer.CR Expiring Date') }}</th>
				<td>{{$cr_expiring_date}}</td>

			</tr>
			<tr>
				<th>{{ __('customer.Contract No') }}</th>
				<td>{{$contract_no}}</td>
			</tr>
			<tr>
				<th>{{ __('customer.Contract No Expiry Date') }}</th>
				<td>{{$contractno_expiry_date}}</td>

			</tr>
			<tr>
				<th>{{ __('customer.Number of Invoice') }}</th>
				<td>{{$no_of_invoices}}</td>
			</tr>
			<tr>
				<th>{{ __('customer.Credit Period of each Invoice') }}</th>
				<td>{{$credit_period_of_each_invoices}}</td>

			</tr>
			<tr>
				<th>{{ __('customer.Total Amount') }}</th>
				<td>{{$total_amount}}</td>
			</tr>
			<tr>
				<th>{{ __('customer.Credit Period of total Invoices') }}</th>
				<td>{{$credit_period_of_total_invoices}}</td>

			</tr>
			<tr>
				<th>{{ __('customer.Payment Terms') }}</th>

				<td>
					@foreach($payment_termss as $data)
					<?php if ($payment_terms == $data->id) {
						echo $data->term;
					} ?>
					@endforeach

				</td>

			</tr>
			<tr>
				<th>{{ __('customer.Description') }}</th>
				<td>{{strip_tags($description)}}</td>

			</tr>



		</table>
	</div>
</body>

</html>