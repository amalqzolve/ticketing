@extends('crm.common.layout')
@section('content')
<style>
	@import url(https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,500italic,400italic,300italic,100italic);
	@import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:300);

	html {
		/*background: linear-gradient(to left, #8e9eab, #efeff0);
			font-size: 1vw;
			font-family: 'Roboto';
			font-weight: 300;*/
		box-sizing: border-box;
	}

	*,
	*:before,
	*:after {
		box-sizing: inherit;
	}

	h1,
	h2,
	h3,
	h4 {
		font-family: 'Roboto Condensed';
		font-weight: 100;
	}

	h1,
	h2,
	h3 {
		text-transform: uppercase;
	}

	h1 {
		font-size: 3.0517578125rem;
	}

	h2 {
		font-size: 1.953125rem;
	}

	h3 {
		font-size: 1.5625rem;
	}

	.container {
		display: flex;
		flex-direction: column;
		width: 90%;
		margin: 2rem auto;
		box-shadow: 0 0.25rem 2rem 0 rgba(0, 0, 0, 0.3);
	}

	.section1 {
		padding: 1rem;
	}

	.section {
		padding: 2rem;
	}
	}

	.section h2:first-of-type {
		margin-top: 0;
	}

	.section h3:first-of-type {
		margin-top: 0;
	}

	.wrap-icon {
		width: 4rem;
	}

	.toc .wrap-icon {
		width: 2.5rem;
		height: 100%;
		margin: 1rem;
	}

	.toc svg {
		fill: #fff;
	}

	.toc .col {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		transition: transform 100ms ease-in-out;
		transform: scale(1);
	}

	.toc .col svg {
		transform: scale(1);
		transition: transform 100ms ease-in-out;
	}

	.toc .col:hover {
		transform: scale(1.1);
		transition: transform 100ms ease-in-out;
		z-index: 2;
	}

	.toc .col:hover svg {
		transform: scale(1.3);
		transition: transform 100ms ease-in-out;
	}

	.toc .col:after {
		content: attr(data-title);
		color: #fff;
		letter-spacing: 0.1rem;
		text-transform: uppercase;
	}

	.toc .col[data-title="info"] {
		background-color: #00bd9c;
	}

	.toc .col[data-title="SOA"] {
		background-color: #2c97de;
	}

	.toc .col[data-title="Transactions"] {
		background-color: #9c56b8;
	}

	.toc .col[data-title="Client Portel"] {
		background-color: #e87e03;
	}

	.toc .col[data-title="feedback"] {
		background-color: #e94b35;
	}

	.toc .col[data-title="Invoices"] {
		background-color: #daa900;
	}

	.about-me {
		background: #fff;
	}

	.about-me blockquote {
		border-left: 0.25rem solid #e94b35;
		padding-left: 1rem;
		margin-left: 0;
	}

	.about-me blockquote .lede {
		color: #e94b35;
		font-weight: 500;
		letter-spacing: 0.3rem;
		text-transform: uppercase;
	}

	.about-me .soft-skills {
		display: flex;
		justify-content: space-around;
		padding: 0;
		list-style-type: none;
	}

	.about-me .soft-skills .skill {
		display: flex;
		align-items: top;
		justify-content: center;
		flex-direction: row-reverse;
		width: 30%;
	}

	.about-me .soft-skills .skill h3 {
		font-weight: 700;
		margin: 0;
	}

	.about-me .soft-skills .wrap-icon {
		margin: 0;
		margin-right: 1rem;
		width: 3rem;
	}

	.soft-skills .skill:hover .wrap-icon {
		transform: scale(1);
		fill: #e94b35;
		transition: all 200ms ease;
	}

	.soft-skills .skill .wrap-icon {
		transform: scale(0.8);
		fill: #a1a1a1;
		transition: all 200ms ease;
	}

	.the-experienced-roles {
		display: none;
		visibility: hidden;
	}

	.personal-info {
		background-color: #f3f3f3;
		display: flex;
		flex: 1;
		flex-direction: column;
	}

	.personal-info .info-lines {
		-webkit-margin-before: 0;
		-webkit-margin-after: 0;
	}

	.personal-info .info-lines ul {
		margin: 0;
		padding: 0;
		list-style-type: none;
	}

	.personal-info .info-line {
		margin-bottom: 1rem;
	}

	.personal-info .info-line dt,
	.personal-info .info-line dd {
		display: inline-block;
		margin: 0;
	}

	.personal-info .info-line dt {
		text-transform: uppercase;
		font-weight: 500;
		margin-right: 0.5rem;
	}

	.experience {
		background-color: #9c56b8;
		color: #fff;
	}

	.jobs,
	.job-lines {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}

	.jobs .job {
		text-transform: uppercase;
		font-weight: 500;
		margin-bottom: 1rem;
	}

	.jobs .job:before {
		text-transform: none;
		/*font-weight: 100;*/
		display: block;
		opacity: 0.6;
		content: attr(data-start-date) ' – ' attr(data-end-date);
		font-size: 12px;
	}

	.jobs .job:after {
		text-transform: none;
		font-weight: 100;
		display: block;
		opacity: 0.6;
		content: attr(data-job-title);
	}

	.professional-skills {
		background-color: #2c97de;
		color: #fff;
	}

	.professional-skills .skills {
		display: flex;
		justify-content: space-around;
		list-style-type: none;
		margin: 0;
		padding: 0;
	}

	.professional-skills .skills .skill-title {
		text-transform: uppercase;
		letter-spacing: 0.1rem;
	}

	.professional-skills:hover .outer {
		animation: dash 1s ease-in-out forwards;
	}

	.professional-skills .skill {
		display: flex;
		flex-direction: column;
		max-width: 25%;
	}

	.professional-skills .skill .pie {
		text-align: center;
		margin-bottom: 1rem;
		position: relative;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.professional-skills .skill svg {
		position: static;
		width: 7rem;
		height: 7rem;
		transform: rotate(-90deg);
		background: transparent;
		border-radius: 50%;
	}

	.professional-skills .skill circle {
		fill: #fff;
		fill-opacity: 0.2;
		stroke: #fff;
		stroke-width: 32;
	}

	.professional-skills .skill .outer {
		animation: dash 1s ease-in-out forwards;
	}

	.professional-skills .skill .innerCircle {
		fill: #2c97de;
		stroke-width: 0;
		stroke: #2c97de;
		fill-opacity: 1;
	}

	@keyframes dash {
		from {
			stroke-dasharray: 0 100;
		}

		to {
			stroke-dasharray: auto 100;
		}
	}

	.footer {
		background-color: #424242;
		color: #a1a1a1;
	}

	.footer .cv ul,
	.footer .social ul {
		display: flex;
		justify-content: space-between;
		list-style-type: none;
		padding: 0;
	}

	.footer .subscribe .input {
		padding: 0.5rem;
		background: transparent;
		border: 2px solid #a1a1a1;
		color: #a1a1a1;
		width: 100%;
	}

	.footer .subscribe .input:focus {
		outline: 0;
	}

	.social-icons {
		display: flex;
		justify-content: space-between;
	}

	.social-icons .social-icon {
		border-radius: 0.125rem;
		width: 2.5rem;
		height: 2.5rem;
		background-color: #a1a1a1;
	}

	.typed-cursor {
		font-size: 1.5625rem;
		opacity: 1;
		animation: blink 0.7s infinite;
	}

	@keyframes blink {
		0% {
			opacity: 1;
		}

		50% {
			opacity: 0;
		}

		100% {
			opacity: 1;
		}
	}

	p {
		font-size: 11px;
	}

	b,
	strong {
		font-weight: bold !important;
	}

	.address th {
		padding: 2% !important;
		width: 43% !important;
	}
</style>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<?php
	foreach ($users as $data) {
	?>
		<div class="row">
			<div class="col-xl-12">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon kt-hide">
								<i class="la la-gear"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								{{ __('customer.Supplier Information') }}
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-section">
							<div class="kt-section__info"></div>
							<div class="kt-section__content">
								<div class="row">

									<div class="col-12">

										<div class="row toc">






										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8 about-me section">
										<h2><?php echo isset($data->sup_name) ? $data->sup_name : ''; ?></h2>
										<blockquote>
											<p class="lede"><?php echo isset($data->sup_code) ? $data->sup_code : ''; ?></p>

										</blockquote>
										<br><br>
										<ul class="soft-skills">
											<li class="skill">
												<div>
													<h3><?php echo isset($data->supplier_category) ? $data->supplier_category : '';  ?></h3><br>
													<p>
														Supplier Category
													</p>
												</div>

											</li>

											<li class="skill">
												<div>
													<h3><?php echo isset($data->suppliertype) ? $data->suppliertype : '';  ?></h3><br>
													<p>
														Supplier Type
													</p>
												</div>

											</li>
										</ul>
									</div>
									<div class="col-md-4 personal-info section">
										<h2>{{ __('customer.Supplier Information') }}</h2>
										<table class="address">
											<tr>
												<th>{{ __('customer.Supplier Name') }}</th>
												<td><?php echo isset($data->sup_name) ? $data->sup_name : ''; ?></td>
											</tr>
											<tr>
												<th>{{ __('customer.Address') }}</th>
												<td><?php echo isset($data->sup_add1) ? $data->sup_add1 : ''; ?>&nbsp;<?php echo isset($data->sup_add2) ? $data->sup_add2 : ''; ?>&nbsp;<?php echo isset($data->sup_region) ? $data->sup_region : ''; ?>&nbsp;<?php echo isset($data->sup_city) ? $data->sup_city : ''; ?>&nbsp;<?php echo isset($data->country) ? $data->country : ''; ?>&nbsp;<?php echo isset($data->sup_zip) ? $data->sup_zip : ''; ?></td>

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

										<!-- <dl class="info-lines">
								<ul>

										<li class="info-line">
												<dt width="50px">Customer Name:</dt>

												<dd><?php echo isset($data->cust_name) ? $data->cust_name : ''; ?></dd>
										</li>
										<li class="info-line">
												<dt width="60px">Email:</dt>
												<dd><?php echo isset($data->email1) ? $data->email1 : ''; ?></dd>
												<dd><?php echo isset($data->email2) ? $data->email2 : ''; ?></dd>
										</li>
										<li class="info-line">
												<dt>Office Phone No:</dt>
												<dd><?php echo isset($data->office_phone1) ? $data->office_phone1 : '';  ?></dd>
										</li>
										<li class="info-line">
												<dt>Mobile No:</dt>
												<dd><?php echo isset($data->mobile1) ? $data->mobile1 : '';  ?></dd>
										</li>
										<li class="info-line">
												<dt>Website:</dt>
												<dd><?php echo isset($data->website) ? $data->website  : ''; ?></dd>
										</li>
										<li class="info-line">
												<dt>Fax:</dt>
												<dd><?php echo isset($data->website) ? $data->website  : ''; ?></dd>
										</li>
								</ul>
						</dl> -->
									</div>
								</div>
								<div class="row" style="background-color: #8d6e63; color: white;">
									<div class="col-md-4 section1">
										<h2><?php echo isset($data->salesmanname) ? $data->salesmanname : ''; ?></h2>
										<p>Sales Man Name</p>
									</div>
									<div class="col-md-4 section1">
										<h2><?php echo isset($data->account_ledger) ? $data->account_ledger : ''; ?></h2>
										<p>Key Accounts</p>
									</div>
									<!-- <div class="col-md-4 section1" >
						<h2>ledger Name</h2>
						<p>Details</p>
				</div> -->

								</div>
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
								<div class="row footer">

									<h2>{{ __('customer.Contact Information') }}</h2>
									<table class="table" style="color: white; font-size: 10px;">
										<thead>
											<tr>

												<th>
													<h5><b>{{ __('customer.Contact Person') }}</b></h5>
												</th>
												<th>
													<h5><b>{{ __('customer.Mobile Number') }}</b></h5>
												</th>
												<th>
													<h5><b>{{ __('customer.Office Number') }}</b></h5>
												</th>
												<th>
													<h5><b>{{ __('customer.Email') }}</b></h5>
												</th>
												<th>
													<h5><b>{{ __('customer.Department') }}</b></h5>
												</th>
												<th>
													<h5><b>{{ __('app.Designation') }}</b></h5>
												</th>
											</tr>
										</thead>

										@foreach($suppliercontact as $suppliercontacts)
										<tbody>
											<tr>
												<td>{{$suppliercontacts-> contact_personvalue}}</td>
												<td>{{$suppliercontacts->mobiles}}</td>
												<td>{{$suppliercontacts->offices}}</td>
												<td>{{$suppliercontacts->emails}}</td>
												<td>{{$suppliercontacts->departments}}</td>
												<td>{{$suppliercontacts->locations}}</td>


											</tr>
										</tbody>
										@endforeach
									</table>




								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>
</div>
@endsection
@section('script')
<script>
	$('.SupplierManagement').addClass('kt-menu__item--open');
	$('.supplierdetails').addClass('kt-menu__item--active');
</script>
@endsection