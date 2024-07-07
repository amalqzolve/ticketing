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
		<!-- <h1>PDF</h1> -->
		<img src="{{ asset($header) }}" height="150" width="1250" class="img-thumboli" />

	</div>
	<div id="footer">
		<img src="{{ asset($footer) }}" height="150" width="1250" class="img-thumboli" />
	</div>
	<div id="content">
		<?php
		foreach ($users as $data) {
		?>
			<div class="col-md-4 personal-info section">
				<h2>{{ __('customer.General Information') }}</h2>
				<table class="address">
					<tr>
						<th>Customer Code</th>
						<td><?php echo isset($data->cust_code) ? $data->cust_code : ''; ?></td>

					</tr>
					<tr>
						<th>{{ __('customer.Category') }}</th>
						<td><?php echo isset($data->custcategory) ? $data->custcategory : ''; ?></td>

					</tr>
					<tr>
						<th>{{ __('customer.Group') }}</th>
						<td><?php echo isset($data->grouptitle) ? $data->grouptitle : ''; ?></td>

					</tr>
					<tr>
						<th>{{ __('customer.Type') }}</th>
						<td><?php echo isset($data->customertype) ? $data->customertype : ''; ?> </td>

					</tr>
					<tr>
						<th>{{ __('customer.Sales Man Name') }}</th>
						<td><?php echo isset($data->salesmanname) ? $data->salesmanname : ''; ?></td>

					</tr>
					<tr>
						<th>{{ __('customer.Key Accounts') }}</th>
						<td><?php echo isset($data->account_ledger) ? $data->account_ledger : ''; ?></td>

					</tr>
				</table>


			</div>
			<div class="col-md-4 personal-info section">
				<h2>{{ __('customer.Customer Information') }}</h2>
				<table class="table-bordered">
					<tr>
						<th>{{ __('customer.Customer Name') }}</th>
						<td><?php echo isset($data->cust_name) ? $data->cust_name : ''; ?></td>
					</tr>
					<tr>

						<th>{{ __('customer.Address') }}</th>
						<td><?php echo isset($data->cust_add1) ? $data->cust_add1 : ''; ?>&nbsp;<?php echo isset($data->cust_add2) ? $data->cust_add2 : ''; ?>&nbsp;<?php echo isset($data->cust_region) ? $data->cust_region : ''; ?>&nbsp;<?php echo isset($data->cust_city) ? $data->cust_city : ''; ?>&nbsp;<?php echo isset($data->country) ? $data->country : ''; ?>&nbsp;<?php echo isset($data->cust_zip) ? $data->cust_zip : ''; ?></td>

					</tr>
					<tr>
						<th>{{ __('customer.Email') }}</th>
						<td><?php echo isset($data->email1) ? $data->email1 : ''; ?> &nbsp; <?php echo isset($data->email2) ? $data->email2 : ''; ?></td>

					</tr>
					<tr>
						<th>{{ __('customer.Office Phone No') }}</th>
						<td><?php echo isset($data->office_phone1) ? $data->office_phone1 : ''; ?> &nbsp; <?php echo isset($data->office_phone2) ? $data->office_phone2 : ''; ?></td>

					</tr>
					<tr>
						<th>{{ __('customer.Mobile No') }}</th>
						<td><?php echo isset($data->mobile1) ? $data->mobile1 : ''; ?> &nbsp; <?php echo isset($data->mobile2) ? $data->mobile2 : ''; ?></td>

					</tr>
					<tr>
						<th>{{ __('customer.Fax') }}</th>
						<td><?php echo isset($data->fax) ? $data->fax : ''; ?></td>

					</tr>
					<tr>
						<th>{{ __('customer.Website') }}</th>
						<td><?php echo isset($data->website) ? $data->website : ''; ?></td>

					</tr>
				</table>


			</div>
			<br><br><br><br>
			<div class="row">
				<div class="col-md-6 experience section">
					<h2>{{ __('customer.Invoice Address') }}</h2>
					<table class="address">

						<tr>
							<th>{{ __('customer.Address') }}</th>
							<td><?php echo isset($data->invoice_add1) ? $data->invoice_add1 : ''; ?>&nbsp;<?php echo isset($data->invoice_add2) ? $data->invoice_add2 : ''; ?>&nbsp;<?php echo isset($data->invoice_region) ? $data->invoice_region : ''; ?>&nbsp;<?php echo isset($data->invoice_city) ? $data->invoice_city : ''; ?>&nbsp;<?php echo isset($data->invoice_country) ? $data->invoice_country : ''; ?>&nbsp;<?php echo isset($data->invoice_zip) ? $data->invoice_zip : ''; ?></td>

						</tr>
						<tr>
							<th>{{ __('customer.Email') }}</th>
							<td><?php echo isset($data->invoice_email1) ? $data->invoice_email1 : ''; ?> &nbsp; <?php echo isset($data->invoice_email2) ? $data->invoice_email2 : ''; ?></td>

						</tr>
						<tr>
							<th>{{ __('customer.Office Phone No') }}</th>
							<td><?php echo isset($data->invoice_office_phone1) ? $data->invoice_office_phone1 : ''; ?> &nbsp; <?php echo isset($data->invoice_office_phone2) ? $data->invoice_office_phone2 : ''; ?></td>

						</tr>
						<tr>
							<th>{{ __('customer.Mobile No') }}</th>
							<td><?php echo isset($data->invoice_mobile1) ? $data->invoice_mobile1 : ''; ?> &nbsp; <?php echo isset($data->invoice_mobile2) ? $data->invoice_mobile2 : ''; ?></td>

						</tr>

					</table>
				</div>
				<div class="col-md-6 professional-skills section">
					<h2>{{ __('customer.Shipping Address') }}</h2>


					<table class="address">
						<tr>
							<th>{{ __('customer.Address') }}</th>
							<td><?php echo isset($data->shipping1) ? $data->shipping1 : ''; ?>&nbsp;<?php echo isset($data->shipping2) ? $data->shipping2 : ''; ?>&nbsp;<?php echo isset($data->shipping_region) ? $data->shipping_region : ''; ?>&nbsp;<?php echo isset($data->shipping_city) ? $data->shipping_city : ''; ?>&nbsp;<?php echo isset($data->shipping_country) ? $data->shipping_country : ''; ?>&nbsp;<?php echo isset($data->shipping_zip) ? $data->shipping_zip : ''; ?></td>

						</tr>
						<tr>
							<th>{{ __('customer.Email') }}</th>
							<td><?php echo isset($data->shipping_email1) ? $data->shipping_email1 : ''; ?> &nbsp; <?php echo isset($data->shipping_email2) ? $data->shipping_email2 : ''; ?></td>

						</tr>
						<tr>
							<th>{{ __('customer.Office Phone No') }}</th>
							<td><?php echo isset($data->shipping_office_phone1) ? $data->shipping_office_phone1 : ''; ?> &nbsp; <?php echo isset($data->shipping_office_phone2) ? $data->shipping_office_phone2 : ''; ?></td>

						</tr>
						<tr>
							<th>{{ __('customer.Mobile No') }}</th>
							<td><?php echo isset($data->shipping_mobile1) ? $data->shipping_mobile1 : ''; ?> &nbsp; <?php echo isset($data->shipping_mobile2) ? $data->shipping_mobile2 : ''; ?></td>

						</tr>
					</table>
				</div>
			</div>
			<br><br>
			<h2>{{ __('customer.Contact Information') }}</h2>
			<table>
				<thead>
					<tr>
						<th>{{ __('customer.Contact Person') }}</th>
						<th>{{ __('customer.Mobile Number') }}</th>
						<th>{{ __('customer.Office Number') }}</th>
						<th>{{ __('customer.Email') }}</th>
						<th>{{ __('customer.Department') }}</th>
						<th>{{ __('customer.Designation') }}</th>
					</tr>
				</thead>

				@foreach($customercontact as $customercontacts)
				<tbody>
					<tr>
						<td>{{$customercontacts-> contact_personvalue}}</td>
						<td>{{$customercontacts->mobiles}}</td>
						<td>{{$customercontacts->offices}}</td>
						<td>{{$customercontacts->emails}}</td>
						<td>{{$customercontacts->departments}}</td>
						<td>{{$customercontacts->locations}}</td>


					</tr>
				</tbody>
				@endforeach
			</table>

		<?php
		}
		?>

	</div>
</body>

</html>