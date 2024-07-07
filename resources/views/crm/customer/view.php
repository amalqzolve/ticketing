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
</style>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-3">
	<div class="row">
		<div class="col-xl-12">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon kt-hide">
							<i class="la la-gear"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							{{ __('customer.Customer Views') }}
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
										<div class="col section" data-title="info">
											<div class="wrap-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path d="M4 24H2V0h2v24zM22 2H6v12h16l-4-5.97L22 2z" />
												</svg>
											</div>
										</div>
										<div class="col section" data-title="SOA">
											<div class="wrap-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path d="M13.744 8s1.522-8-3.335-8H2v24h20V11c0-3.42-5.247-3.745-8.256-3zM14 19H6v-1h8v1zm4-3H6v-1h12v1zm0-3H6v-1h12v1zM14.568.075C16.77 1.25 20.506 4.958 22 6.955c-1.286-.9-4.044-1.656-6.09-1.178.22-1.468-.186-4.534-1.342-5.702z" />
												</svg>
											</div>
										</div>
										<div class="col section" data-title="Transactions">
											<div class="wrap-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path d="M12.23 15.5c-6.8 0-10.367-1.22-12.23-2.597V22h24v-8.95c-3.218 2.222-9.422 2.45-11.77 2.45zM14 18.032C14 19.12 13.104 20 12 20s-2-.88-2-1.968V17h4v1.032zM0 9.492V7h24v2.605c0 5.29-24 5.133-24-.114zM9 2c-1.104 0-2 .896-2 2v2h2V4.5c0-.276.224-.5.5-.5h5c.276 0 .5.224.5.5V6h2V4c0-1.104-.896-2-2-2H9z" />
												</svg>
											</div>
										</div>
										<div class="col section" data-title="Client Portel">
											<div class="wrap-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path d="M17.997 18H6.002L6 17.377c0-1.26.1-1.986 1.588-2.33 1.684-.39 3.344-.736 2.545-2.21C7.767 8.476 9.46 6 12 6c2.49 0 4.225 2.383 1.865 6.84-.775 1.463.826 1.81 2.545 2.208C17.9 15.392 18 16.12 18 17.38l-.003.62zm4.81-2.214c-1.29-.298-2.49-.56-1.908-1.657 1.768-3.343.468-5.13-1.4-5.13-1.266 0-2.25.817-2.25 2.324 0 3.903 2.27 1.77 2.247 6.676h4.5l.003-.463c0-.946-.074-1.493-1.192-1.75zM.003 18h4.5c-.02-4.906 2.247-2.772 2.247-6.676C6.75 9.817 5.765 9 4.5 9c-1.868 0-3.168 1.787-1.398 5.13.58 1.098-.62 1.358-1.91 1.656C.075 16.044 0 16.59 0 17.536L.002 18z" />
												</svg>
											</div>
										</div>
										<div class="col section" data-title="feedback">
											<div class="wrap-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path d="M10.252 23h-3.21c-.612 0-1.157-.427-1.354-1.007L4.098 17H8.71l.918 3.17c.178.553.512 1.042.962 1.41.758.617.27 1.42-.34 1.42zm9.286-21.902c-1.522.617-4.525 3.74-8.252 4.64C10.484 6.835 10 8.617 10 10.582c0 1.86.44 3.553 1.166 4.662 3.94.942 6.303 3.996 8.31 4.67 2.2.743 4.528-3.467 4.524-9.42-.003-5.96-2.47-10.203-4.462-9.397zm1.704 15.472c-.72 1.656-1.987 1.685-2.72 0-.436-1-.73-2.77-.892-3.96h.38c1.174 0 2.125-.954 2.125-2.13s-.95-2.133-2.125-2.133h-.39c.16-1.21.538-2.947.974-3.89.764-1.652 1.94-1.68 2.72 0 1.315 2.837 1.368 8.793-.072 12.113zM8.807 15h-4.37C1.983 15 0 12.953 0 10.5S1.984 6 4.436 6H8.88c-.56 1.3-.876 2.887-.876 4.594 0 1.627.29 3.14.803 4.406z" />
												</svg>
											</div>
										</div>
										<div class="col section" data-title="Invoices">
											<div class="wrap-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path d="M12.014 6.54S14.16 2.57 15.49 0L24 8.51c-2.583 1.322-6.556 3.46-6.556 3.46l-5.43-5.43zm-8.517 6.423S2.157 18.217 0 21.567l.827.826 3.967-3.967c.348-.348.57-.8.63-1.288.033-.27.152-.532.36-.74.498-.498 1.306-.498 1.803 0 .498.5.498 1.305 0 1.803-.208.21-.47.33-.74.362-.488.06-.94.28-1.288.63L1.59 23.16l.826.84c3.314-2.133 8.604-3.51 8.604-3.51l4.262-7.838-3.95-3.95-7.837 4.26z" />
												</svg>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8 about-me section">
									<h2>Customer name</h2>
									<blockquote>
										<p class="lede">Hard-working person on the way to success…</p>
										<p>Customize your website as you want.</p>
									</blockquote>
									<ul class="soft-skills">
										<li class="skill">
											<div>
												<h3>Due Amount</h3>
												<p>
													1000000
												</p>
											</div>
											<div class="wrap-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path d="M5 8.5C5 7.672 5.672 7 6.5 7S8 7.672 8 8.5c0 .83-.672 1.5-1.5 1.5S5 9.33 5 8.5zm9 .5l-2.52 4L9 11.04 5 17h14l-5-8zm8-4v14H2V5h20zm2-2H0v18h24V3z" />
												</svg>
											</div>
										</li>
										<li class="skill">
											<div>
												<h3>Total Invoice</h3>
												<p>
													1000000
												</p>
											</div>
											<div class="wrap-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path d="M5 20v2H3v-2h2zm2-2H1v6h6v-6zm6-1v5h-2v-5h2zm2-2H9v9h6v-9zm6-2v9h-2v-9h2zm2-2h-6v13h6V11zm0-11l-6 1.22 1.716 1.71-6.85 6.732-3-3.002-7.842 7.797 1.41 1.418 6.427-6.39 2.992 2.993 8.28-8.137L21.8 6 23 0z" />
												</svg>
											</div>
										</li>
										<li class="skill">
											<div>
												<h3>Credit Limit</h3>
												<p>
													10000000
												</p>
											</div>
											<div class="wrap-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10S2 17.514 2 12 6.486 2 12 2zm0-2C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm1 12V6h-2v8h7v-2h-5z" />
												</svg>
											</div>
										</li>
									</ul>
								</div>
								<div class="col-md-4 personal-info section">
									<h2>Customer Info</h2>
									<dl class="info-lines">
										<ul>
											<li class="info-line">
												<dt>Customer Name:</dt>

												<dd><?php echo isset($data->cust_name) ? $data->cust_name : ''; ?></dd>
											</li>
											<li class="info-line">
												<dt>email:</dt>
												<dd><?php echo isset($data->email1) ? $data->email1 : ''; ?></dd>
											</li>
											<li class="info-line">
												<dt>Phone No:</dt>
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
										</ul>
									</dl>
								</div>
							</div>
							<div class="row" style="background-color: #8d6e63; color: white;">
								<div class="col-md-4 section1">
									<h2>Accounting group</h2>
									<p>Details</p>
								</div>
								<div class="col-md-4 section1">
									<h2>ledger code</h2>
									<p>Details</p>
								</div>
								<div class="col-md-4 section1">
									<h2>ledger Name</h2>
									<p>Details</p>
								</div>

							</div>
							<div class="row">
								<div class="col-md-4 experience section">
									<h2>General Info</h2>
									<ul class="jobs">
										<li class="job" data-start-date="Customer Code" data-end-date="" data-job-title=""><?php echo isset($data->cust_code) ? $data->cust_code : ''; ?></li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Customer Type" data-end-date="" data-job-title=""><?php echo isset($data->cust_type) ? $data->cust_type : '';  ?></li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Customer Category" data-end-date="" data-job-title=""><?php echo isset($data->cust_category) ? $data->cust_category : '';  ?></li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Customer Group" data-end-date="" data-job-title=""><?php echo isset($data->cust_group) ? $data->cust_group : ''; ?></li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Sales man" data-end-date="" data-job-title=""><?php echo isset($data->salesman) ? $data->salesman : '';  ?></li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Key Accounts" data-end-date="" data-job-title=""><?php echo isset($data->key_account) ? $data->key_account : ''; ?> </li>
									</ul>
								</div>
								<div class="col-md-8 professional-skills section">
									<h2>Contact Info</h2>

									<!-- <table class="table" id="viewcustomerdetails_list" style="color: white; font-size: 10px;">
								<thead>
										<tr>
												<th>Contact Person</th>
								<th>Mobile Number</th>
								<th>Office Number</th>
								<th>Email</th>
								<th>Department</th>
								<th>Designation</th>
										</tr>
								</thead>
								<tbody>
										
								</tbody>
						</table> -->
									<ul class="jobs">
										<li class="job" data-start-date="Contact Person" data-end-date="" data-job-title=""><?php echo isset($data->contact_person) ? $data->contact_person : ''; ?></li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Mobile Number" data-end-date="" data-job-title=""><?php echo isset($data->mobile2) ? $data->mobile2 : '';  ?></li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Office Phone Number" data-end-date="" data-job-title=""><?php echo isset($data->office_phone2) ? $data->office_phone2 : '';  ?></li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Email" data-end-date="" data-job-title=""><?php echo isset($data->email) ? $data->email : ''; ?></li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Department" data-end-date="" data-job-title=""><?php echo isset($data->department) ? $data->department : '';  ?></li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Location" data-end-date="" data-job-title=""><?php echo isset($data->location) ? $data->location : ''; ?> </li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Customer Address" data-end-date="" data-job-title=""><?php echo isset($data->cust_add1) ? $data->cust_add1 : ''; ?> </li>
									</ul>
									<ul class="jobs">
										<li class="job" data-start-date="Invoice Address" data-end-date="" data-job-title=""><?php echo isset($data->invoice_add1) ? $data->invoice_add1 : ''; ?> </li>
									</ul>
								</div>
							</div>
							<div class="row footer">
								<div class="col col-f footer-name section">
									<h2><b>100000</b></h2>
									<p>
										Outstanding Amount
									</p>
								</div>
								<div class="col col-f cv section">
									<h2><b>100000</b></h2>
									<p>
										Opening Balance
									</p>
								</div>

								<div class="col col-f social section">
									<h2><b>100000</b></h2>
									<p>
										Transation Debit
									</p>
								</div>
								<div class="col col-f social section">
									<h2><b>100000</b></h2>
									<p>
										Transation Credit
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/crm/customer.js" type="text/javascript"></script>
@endsection