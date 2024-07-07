@extends('settings.common.layout')
<style>
	.linkBtn {
		font-size: 10px !important;
		color: blue !important;
	}
</style>
@section('content')
<?php
$default_customer_ledger = isset($branchSettings->default_customer_ledger) ? $branchSettings->default_customer_ledger : '';
$default_supplier_ledger = isset($branchSettings->default_supplier_ledger) ? $branchSettings->default_supplier_ledger : '';

$sales_invoice_ledger = isset($branchSettings->sales_invoice_ledger) ? $branchSettings->sales_invoice_ledger : '';
$sales_invoice_vat_ledger = isset($branchSettings->sales_invoice_vat_ledger) ? $branchSettings->sales_invoice_vat_ledger : '';
$sales_return_ledger = isset($branchSettings->sales_return_ledger) ? $branchSettings->sales_return_ledger : '';
$sales_return_vat_ledger = isset($branchSettings->sales_return_vat_ledger) ? $branchSettings->sales_return_vat_ledger : '';
$purchase_invoice_ledger = isset($branchSettings->purchase_invoice_ledger) ? $branchSettings->purchase_invoice_ledger : '';
$purchase_invoice_vat_ledger = isset($branchSettings->purchase_invoice_vat_ledger) ? $branchSettings->purchase_invoice_vat_ledger : '';
$purchase_return_ledger = isset($branchSettings->purchase_return_ledger) ? $branchSettings->purchase_return_ledger : '';
$purchase_return_vat_ledger = isset($branchSettings->purchase_return_vat_ledger) ? $branchSettings->purchase_return_vat_ledger : '';
$sales_invoice_entry_type = isset($branchSettings->sales_invoice_entry_type) ? $branchSettings->sales_invoice_entry_type : '';
$purchase_invoice_entry_type = isset($branchSettings->purchase_invoice_entry_type) ? $branchSettings->purchase_invoice_entry_type : '';
$sales_return_entry_type = isset($branchSettings->sales_return_entry_type) ? $branchSettings->sales_return_entry_type : '';
$purchase_return_entry_type = isset($branchSettings->purchase_return_entry_type) ? $branchSettings->purchase_return_entry_type : '';
$sales_billsettilement_entry_type = isset($branchSettings->sales_billsettilement_entry_type) ? $branchSettings->sales_billsettilement_entry_type : '';
$purchase_billsettilement_entry_type = isset($branchSettings->purchase_billsettilement_entry_type) ? $branchSettings->purchase_billsettilement_entry_type : '';
$sales_adwance_entry_type = isset($branchSettings->sales_adwance_entry_type) ? $branchSettings->sales_adwance_entry_type : '';
$purchase_adwance_entry_type = isset($branchSettings->purchase_adwance_entry_type) ? $branchSettings->purchase_adwance_entry_type : '';
$sales_return_refund_entry_type = isset($branchSettings->sales_return_refund_entry_type) ? $branchSettings->sales_return_refund_entry_type : '';
$purchase_return_refund_entry_type = isset($branchSettings->purchase_return_refund_entry_type) ? $branchSettings->purchase_return_refund_entry_type : '';

?>
<style>
	/*  */
	.cc-selector input {
		margin: 0;
		padding: 0;
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
	}

	.cc-selector-2 input {
		position: absolute;
		z-index: 999;
	}

	.visa {
		background-image: url(http://localhost/trading/public/assets/media/pdfimg/preview1.PNG);
	}

	.mastercard {
		background-image: url(http://localhost/trading/public/assets/media/pdfimg/preview2.PNG);
	}

	.visa3 {
		background-image: url(http://localhost/trading/public/assets/media/pdfimg/preview3.PNG);
	}

	.mastercard3 {
		background-image: url(http://localhost/trading/public/assets/media/pdfimg/preview4.PNG);
	}

	.cc-selector-2 input:active+.drinkcard-cc,
	.cc-selector input:active+.drinkcard-cc {
		opacity: .9;
	}

	.cc-selector-2 input:checked+.drinkcard-cc,
	.cc-selector input:checked+.drinkcard-cc {
		-webkit-filter: none;
		-moz-filter: none;
		filter: none;
	}

	.drinkcard-cc {
		cursor: pointer;
		background-size: contain;
		background-repeat: no-repeat;
		display: inline-block;
		width: 130px;
		height: 140px;
		-webkit-transition: all 100ms ease-in;
		-moz-transition: all 100ms ease-in;
		transition: all 100ms ease-in;
		-webkit-filter: brightness(.8) grayscale(1) opacity(.7);
		-moz-filter: brightness(.8) grayscale(1) opacity(.7);
		filter: brightness(.8) grayscale(1) opacity(.7);
	}

	.drinkcard-cc:hover {
		-webkit-filter: brightness(.7) grayscale(.5) opacity(.9);
		-moz-filter: brightness(.7) grayscale(.5) opacity(.9);
		filter: brightness(.7) grayscale(.5) opacity(.9);
	}

	/* Extras */
	a:visited {
		color: #888
	}

	a {
		color: #444;
		text-decoration: none;
	}

	p {
		margin-bottom: .3em;
	}

	.cc-selector-2 input {
		margin: 5px 0 0 12px;
	}

	.cc-selector-2 label {
		margin-left: 7px;
	}

	span.cc {
		color: #6d84b4
	}

	.previw {
		position: absolute;
		margin-left: -80px;
		margin-top: 4px;
		cursor: pointer;
	}

	/*  */

	.kt-portlet .kt-portlet__body {
		padding: 0px !important;
	}

	.kt-wizard-v2 .kt-wizard-v2__wrapper .kt-form {
		width: 98% !important;
	}

	.subHead {
		font-size: 16px !important;
	}

	.summaryLbl {
		color: black;
	}

	.image-box {
		width: 300px;
		/* Set the width as per your requirement */
		height: 100px;
		/* Set the height as per your requirement */
		overflow: hidden;
		border-width: 1px;
	}

	.image-box img {
		width: 100%;
		height: auto;
		display: block;
	}

	.image-container {
		display: flex;
	}
</style>
<link href="{{ URL::asset('assets/css/pages/wizard/wizard-2.css') }}" rel="stylesheet" type="text/css" />

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Branch settings
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<!-- <div class="kt-portlet"> 
				<div class="kt-portlet__body kt-portlet__body--fit">-->
			<div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first">
				<div class="kt-grid__item kt-wizard-v2__aside">

					<!--begin: Form Wizard Nav -->
					<div class="kt-wizard-v2__nav">

						<!--doc: Remove "kt-wizard-v2__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
						<div class="kt-wizard-v2__nav-items kt-wizard-v2__nav-items--clickable">
							<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
								<div class="kt-wizard-v2__nav-body">
									<div class="kt-wizard-v2__nav-icon">
										<i class="flaticon-globe"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Branch Details
										</div>
										<div class="kt-wizard-v2__nav-label-desc">
											Setup Your Branch Details
										</div>
									</div>
								</div>
							</div>
							<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v2__nav-body">
									<div class="kt-wizard-v2__nav-icon">
										<i class="flaticon-car"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Branch Seal
										</div>
										<div class="kt-wizard-v2__nav-label-desc">
											Upload The Branch Seal
										</div>
									</div>
								</div>
							</div>
							<div class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
								<div class="kt-wizard-v2__nav-body">
									<div class="kt-wizard-v2__nav-icon">
										<i class="flaticon-upload-1"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Invoice Headder & footer
										</div>
										<div class="kt-wizard-v2__nav-label-desc">
											Add Invoice Headder & footer
										</div>
									</div>
								</div>
							</div>
							<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v2__nav-body">
									<div class="kt-wizard-v2__nav-icon">
										<i class="flaticon-responsive"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Invoice Format
										</div>
										<div class="kt-wizard-v2__nav-label-desc">
											Settings for PDF invoice Format
										</div>
									</div>
								</div>
							</div>
							<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v2__nav-body">
									<div class="kt-wizard-v2__nav-icon">
										<i class="flaticon-settings-1"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Accounting Configuration
										</div>
										<div class="kt-wizard-v2__nav-label-desc">
											Configuration For Sales And Purchase
										</div>
									</div>
								</div>
							</div>
							<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v2__nav-body">
									<div class="kt-wizard-v2__nav-icon">
										<i class="flaticon-confetti"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Completed!
										</div>
										<div class="kt-wizard-v2__nav-label-desc">
											Review and Submit
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!--end: Form Wizard Nav -->
				</div>
				<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">

					<!--begin: Form Wizard Form-->
					<form class="kt-form" id="kt_form">

						<!--begin: Form Wizard Step 1-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
							<div class="kt-heading kt-heading--md">Enter your Branch Details</div>
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<div class="form-group">
										<label>Branch Name <span style="color: red">*</span></label>
										<input type="text" class="form-control" name="company_name" id="company_name" value="{{isset($branchSettings->company_name)?$branchSettings->company_name:''}}">
									</div>
									<div class="row">

										<div class="col-xl-6">
											<div class="form-group">
												<label>Building No</label>
												<input type="tel" class="form-control" name="building_no" id="building_no" value="{{isset($branchSettings->building_no)?$branchSettings->building_no:''}}">
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Street Name</label>
												<input type="tel" class="form-control" name="street_name" id="street_name" value="{{isset($branchSettings->street_name)?$branchSettings->street_name:''}}">
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>District</label>
												<input type="tel" class="form-control" name="district" id="district" value="{{isset($branchSettings->district)?$branchSettings->district:''}}">
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Province / State</label>
												<input type="tel" class="form-control" name="province_state" id="province_state" value="{{isset($branchSettings->province_state)?$branchSettings->province_state:''}}">
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>City</label>
												<input type="tel" class="form-control" name="city" id="city" value="{{isset($branchSettings->city)?$branchSettings->city:''}}">
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Country <span style="color: red">*</span></label>
												<select name="country" id="country" class="form-control kt-selectpicker">
													<option value="">Select</option>
													<?php $country_summary = ''; ?>
													@foreach($countries as $coun)
													<?php if (isset($branchSettings->country) && ($branchSettings->country == $coun->id)) $country_summary = $coun->cntry_name; ?>
													<option value="{{$coun->id}}" {{(isset($branchSettings->country)&&($branchSettings->country==$coun->id))?'selected':''}}>{{$coun->cntry_name}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Postal Code</label>
												<input type="tel" class="form-control" name="postal_code" id="postal_code" value="{{isset($branchSettings->postal_code)?$branchSettings->postal_code:''}}">
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Phone Number</label>
												<input type="tel" class="form-control" name="phone_number" id="phone_number" value="{{isset($branchSettings->phone_number)?$branchSettings->phone_number:''}}">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="form-group">
												<label>CR ID <span style="color: red">*</span></label>
												<input type="tel" class="form-control" name="company_cr" id="company_cr" value="{{isset($branchSettings->company_cr)?$branchSettings->company_cr:''}}">
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>VAT ID <span style="color: red">*</span></label>
												<input type="email" class="form-control" name="company_vat" id="company_vat" value="{{isset($branchSettings->company_vat)?$branchSettings->company_vat:''}}">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--end: Form Wizard Step 1-->

						<!--begin: Form Wizard Step 2-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
							<div class="kt-heading kt-heading--md">Upload The Branch Seal</div>
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<div class="col-xl-12">
										<div class="form-group">
											<input type="hidden" name="fileDataSeal" value="{{isset($branchSettings->seal)?$branchSettings->seal:''}}" id="fileDataSeal" />
											<div id="choose-seal"></div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--end: Form Wizard Step 2-->

						<!--begin: Form Wizard Step 3-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
							<div class="kt-heading kt-heading--md">Upload Headder & Footer </div>
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<!-- <div class="row"> -->
									<div class="col-xl-12">
										<div class="form-group">
											<label class="subHead">Headder </label>
											<input type="hidden" name="fileDataHeadder" value="{{isset($branchSettings->pdfheader)?$branchSettings->pdfheader:''}}" id="fileDataHeadder" />
											<div id="choose-headder"></div>
										</div>
									</div>
									<div class="col-xl-12">
										<div class="form-group">
											<label class="subHead">Footer</label>
											<input type="hidden" name="fileDataFooter" value="{{isset($branchSettings->pdffooter)?$branchSettings->pdffooter:''}}" id="fileDataFooter" />
											<div id="choose-footer"></div>
										</div>
									</div>
									<!-- </div> -->
								</div>
							</div>
						</div>

						<!--end: Form Wizard Step 3-->

						<!--begin: Form Wizard Step 4-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
							<div class="kt-heading kt-heading--md">Setup Your Invoice Format</div>
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<div class="row">
										<div class="form-group">
											<label class="subHead">Invoice Format </label>
											<div class="cc-selector-2">
												<input id="visa2" type="radio" name="preview" <?php if ($branchSettings->preview == 'preview1') echo "checked"; ?> value="preview1" class="hiden" />
												<label class="drinkcard-cc visa img-thumbnail" for="visa2"></label>
												<span class="badge badge-info previw" class="btn btn-primary" data-toggle="modal" data-target="#myModal" image="{{ URL::asset('assets') }}/media/pdfimg/preview1.PNG">preview</span>

												<input id="mastercard2" type="radio" name="preview" <?php if ($branchSettings->preview == 'preview2') echo "checked"; ?> value="preview2" class="hiden" />
												<label class="drinkcard-cc mastercard img-thumbnail" for="mastercard2"></label>
												<span class="badge badge-info previw" class="btn btn-primary" data-toggle="modal" data-target="#myModal" image="{{ URL::asset('assets') }}/media/pdfimg/preview2.PNG">preview</span>

												<input id="visa3" type="radio" name="preview" <?php if ($branchSettings->preview == 'preview3') echo "checked"; ?> value="preview3" class="hiden" />
												<label class="drinkcard-cc visa3 img-thumbnail" for="visa3"></label>
												<span class="badge badge-info previw" class="btn btn-primary" data-toggle="modal" data-target="#myModal" image="{{ URL::asset('assets') }}/media/pdfimg/preview3.PNG">preview</span>

												<input id="mastercard3" type="radio" name="preview" <?php if ($branchSettings->preview == 'preview4') echo "checked"; ?> value="preview4" class="hiden" />
												<label class="drinkcard-cc mastercard3 img-thumbnail" for="mastercard3"></label>
												<span class="badge badge-info previw" class="btn btn-primary" data-toggle="modal" data-target="#myModal" image="{{ URL::asset('assets') }}/media/pdfimg/preview4.PNG">preview</span>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Top Margin [in px] with Header <span style="color: red">*</span></label>
												<input type="tel" class="form-control integerVal" name="pdfheader_top" id="pdfheader_top" value="{{isset($branchSettings->pdfheader_top)?$branchSettings->pdfheader_top:'0'}}">
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Bottom Margin [in px] with Footer <span style="color: red">*</span></label>
												<input type="tel" class="form-control integerVal" name="pdffooter_bottom" id="pdffooter_bottom" value="{{isset($branchSettings->pdffooter_bottom)?$branchSettings->pdffooter_bottom:'0'}}">
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Top Margin [in px] without Header <span style="color: red">*</span></label>
												<input type="tel" class="form-control integerVal" name="pdfletterheader_top" id="pdfletterheader_top" value="{{isset($branchSettings->pdfletterheader_top)?$branchSettings->pdfletterheader_top:'0'}}">
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Bottom Margin [in px] without Footer <span style="color: red">*</span></label>
												<input type="tel" class="form-control integerVal" name="pdfletterfooter_bottom" id="pdfletterfooter_bottom" value="{{isset($branchSettings->pdfletterfooter_bottom)?$branchSettings->pdfletterfooter_bottom:'0'}}">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--end: Form Wizard Step 4-->

						<!--begin: Form Wizard Step 5-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
							<div class="kt-heading kt-heading--md">Accounting Configuration
								<a href="{{url('accounting-db-connection')}}" class="linkBtn" style="text-align: right;">
									Change DB
								</a>
							</div>
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<div style="font-size: 20px;">Ledger settings</div>
									<br>
									<div class="row">

										<div class="col-xl-6">
											<div class="form-group">
												<label>Default Customer <span style="color: red">*</span></label>
												<select name="default_customer_ledger" id="default_customer_ledger" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $default_customer_ledger_summary = ''; ?>
													@foreach($allLedger as $ledger)
													<?php
													$selctOrNot = '';
													if (($ledger['parent_id'] == '~') && ($ledger['id'] == $default_customer_ledger)) {
														$selctOrNot = 'selected';
														$default_customer_ledger_summary =	'[' . $ledger['code'] . ']' . $ledger['name'];
													}
													?>
													<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
														@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
															@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Default Supplier <span style="color: red">*</span></label>
												<select name="default_supplier_ledger" id="default_supplier_ledger" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $default_supplier_ledger_summary = ''; ?>
													@foreach($allLedger as $ledger)
													<?php
													$selctOrNot = '';
													if (($ledger['parent_id'] == '~') && ($ledger['id'] == $default_supplier_ledger)) {
														$selctOrNot = 'selected';
														$default_supplier_ledger_summary =	'[' . $ledger['code'] . ']' . $ledger['name'];
													}
													?>
													<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
														@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
															@endforeach
												</select>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="form-group">
												<label>Sales Invoice <span style="color: red">*</span></label>
												<select name="sales_invoice_ledger" id="sales_invoice_ledger" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $sales_invoice_ledger_summary =	''; ?>
													@foreach($allLedger as $ledger)
													<?php
													$selctOrNot = '';
													if (($ledger['parent_id'] == '~') && ($ledger['id'] == $sales_invoice_ledger)) {
														$selctOrNot = 'selected';
														$sales_invoice_ledger_summary =	'[' . $ledger['code'] . ']' . $ledger['name'];
													}
													?>
													<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
														@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
															@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Sales Invoice Vat <span style="color: red">*</span></label>
												<select name="sales_invoice_vat_ledger" id="sales_invoice_vat_ledger" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $sales_invoice_vat_ledger_summary = ''; ?>
													@foreach($allLedger as $ledger)
													<?php
													$selctOrNot = '';
													if (($ledger['parent_id'] == '~') && ($ledger['id'] == $sales_invoice_vat_ledger)) {
														$selctOrNot = 'selected';
														$sales_invoice_vat_ledger_summary =	'[' . $ledger['code'] . ']' . $ledger['name'];
													}
													?>
													<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
														@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
															@endforeach
												</select>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="form-group">
												<label>Sales Return <span style="color: red">*</span></label>
												<select name="sales_return_ledger" id="sales_return_ledger" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $sales_return_ledger_summary = ''; ?>
													@foreach($allLedger as $ledger)
													<?php
													$selctOrNot = '';
													if (($ledger['parent_id'] == '~') && ($ledger['id'] == $sales_return_ledger)) {
														$selctOrNot = 'selected';
														$sales_return_ledger_summary =	'[' . $ledger['code'] . ']' . $ledger['name'];
													}
													?>
													<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
														@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
															@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Sales Return Vat <span style="color: red">*</span></label>
												<select name="sales_return_vat_ledger" id="sales_return_vat_ledger" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $sales_return_vat_ledger_summary = ''; ?>
													@foreach($allLedger as $ledger)
													<?php
													$selctOrNot = '';
													if (($ledger['parent_id'] == '~') && ($ledger['id'] == $sales_return_vat_ledger)) {
														$selctOrNot = 'selected';
														$sales_return_vat_ledger_summary =	'[' . $ledger['code'] . ']' . $ledger['name'];
													}
													?>
													<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
														@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
															@endforeach
												</select>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="form-group">
												<label>Purchase Invoice <span style="color: red">*</span></label>
												<select name="purchase_invoice_ledger" id="purchase_invoice_ledger" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $purchase_invoice_ledger_summary = ''; ?>
													@foreach($allLedger as $ledger)
													<?php
													$selctOrNot = '';
													if (($ledger['parent_id'] == '~') && ($ledger['id'] == $purchase_invoice_ledger)) {
														$selctOrNot = 'selected';
														$purchase_invoice_ledger_summary =	'[' . $ledger['code'] . ']' . $ledger['name'];
													}
													?>
													<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
														@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
															@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Purchase Invoice Vat <span style="color: red">*</span></label>
												<select name="purchase_invoice_vat_ledger" id="purchase_invoice_vat_ledger" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $purchase_invoice_vat_ledger_summary = ''; ?>
													@foreach($allLedger as $ledger)
													<?php
													$selctOrNot = '';
													if (($ledger['parent_id'] == '~') && ($ledger['id'] == $purchase_invoice_vat_ledger)) {
														$selctOrNot = 'selected';
														$purchase_invoice_vat_ledger_summary =	'[' . $ledger['code'] . ']' . $ledger['name'];
													}
													?>
													<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
														@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
															@endforeach
												</select>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="form-group">
												<label>Purchase Return <span style="color: red">*</span></label>
												<select name="purchase_return_ledger" id="purchase_return_ledger" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $purchase_return_ledger_summary = ''; ?>
													@foreach($allLedger as $ledger)
													<?php
													$selctOrNot = '';
													if (($ledger['parent_id'] == '~') && ($ledger['id'] == $purchase_return_ledger)) {
														$selctOrNot = 'selected';
														$purchase_return_ledger_summary =	'[' . $ledger['code'] . ']' . $ledger['name'];
													}
													?>
													<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
														@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
															@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Purchase Return Vat <span style="color: red">*</span></label>
												<select name="purchase_return_vat_ledger" id="purchase_return_vat_ledger" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $purchase_return_vat_ledger_summary = ''; ?>
													@foreach($allLedger as $ledger)
													<?php
													$selctOrNot = '';
													if (($ledger['parent_id'] == '~') && ($ledger['id'] == $purchase_return_vat_ledger)) {
														$selctOrNot = 'selected';
														$purchase_return_vat_ledger_summary =	'[' . $ledger['code'] . ']' . $ledger['name'];
													}
													?>
													<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
														@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
															@endforeach
												</select>
											</div>
										</div>


									</div>
									<br>
									<div style="font-size: 20px;">Entry Type Settings</div>
									<br>
									<div class="row">

										<div class="col-xl-6">
											<div class="form-group">
												<label>Sales Invoice <span style="color: red">*</span></label>
												<select name="sales_invoice_entry_type" id="sales_invoice_entry_type" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $sales_invoice_entry_type_summary = ''; ?>
													@foreach($entryTypes as $entryType)
													<?php if ($sales_invoice_entry_type == $entryType->id) $sales_invoice_entry_type_summary = $entryType->name; ?>
													<option value="{{$entryType->id}}" {{($sales_invoice_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Purchase Invoice <span style="color: red">*</span></label>
												<select name="purchase_invoice_entry_type" id="purchase_invoice_entry_type" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $purchase_invoice_entry_type_summary = ''; ?>
													@foreach($entryTypes as $entryType)
													<?php if ($purchase_invoice_entry_type == $entryType->id) $purchase_invoice_entry_type_summary = $entryType->name; ?>
													<option value="{{$entryType->id}}" {{($purchase_invoice_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="form-group">
												<label>Sales return <span style="color: red">*</span></label>
												<select name="sales_return_entry_type" id="sales_return_entry_type" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $sales_return_entry_type_summary = ''; ?>
													@foreach($entryTypes as $entryType)
													<?php if ($sales_return_entry_type == $entryType->id) $sales_return_entry_type_summary = $entryType->name; ?>
													<option value="{{$entryType->id}}" {{($sales_return_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Purchase return <span style="color: red">*</span></label>
												<select name="purchase_return_entry_type" id="purchase_return_entry_type" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $purchase_return_entry_type_summary = ''; ?>
													@foreach($entryTypes as $entryType)
													<?php if ($sales_return_entry_type == $entryType->id) $purchase_return_entry_type_summary = $entryType->name; ?>
													<option value="{{$entryType->id}}" {{($purchase_return_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="form-group">
												<label>Sales Bill Settilement <span style="color: red">*</span></label>
												<select name="sales_billsettilement_entry_type" id="sales_billsettilement_entry_type" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $sales_billsettilement_entry_type_summary = ''; ?>
													@foreach($entryTypes as $entryType)
													<?php if ($sales_billsettilement_entry_type == $entryType->id) $sales_billsettilement_entry_type_summary = $entryType->name; ?>
													<option value="{{$entryType->id}}" {{($sales_billsettilement_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Purchase Bill Settilement <span style="color: red">*</span></label>
												<select name="purchase_billsettilement_entry_type" id="purchase_billsettilement_entry_type" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $purchase_billsettilement_entry_type_summary = ''; ?>
													@foreach($entryTypes as $entryType)
													<?php if ($purchase_billsettilement_entry_type == $entryType->id) $purchase_billsettilement_entry_type_summary = $entryType->name; ?>
													<option value="{{$entryType->id}}" {{($purchase_billsettilement_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="form-group">
												<label>Sales Adwance <span style="color: red">*</span></label>
												<select name="sales_adwance_entry_type" id="sales_adwance_entry_type" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $sales_adwance_entry_type_summary = ''; ?>
													@foreach($entryTypes as $entryType)
													<?php if ($sales_adwance_entry_type == $entryType->id) $sales_adwance_entry_type_summary = $entryType->name; ?>
													<option value="{{$entryType->id}}" {{($sales_adwance_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Purchase Adwance <span style="color: red">*</span></label>
												<select name="purchase_adwance_entry_type" id="purchase_adwance_entry_type" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $purchase_adwance_entry_type_summary = ''; ?>
													@foreach($entryTypes as $entryType)
													<?php if ($purchase_adwance_entry_type == $entryType->id) $purchase_adwance_entry_type_summary = $entryType->name; ?>
													<option value="{{$entryType->id}}" {{($purchase_adwance_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="form-group">
												<label>Sales Return Refund <span style="color: red">*</span></label>
												<select name="sales_return_refund_entry_type" id="sales_return_refund_entry_type" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $sales_return_refund_entry_type_summary = ''; ?>
													@foreach($entryTypes as $entryType)
													<?php if ($sales_return_refund_entry_type == $entryType->id) $sales_return_refund_entry_type_summary = $entryType->name; ?>
													<option value="{{$entryType->id}}" {{($sales_return_refund_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label>Purchase Return Refund <span style="color: red">*</span></label>
												<select name="purchase_return_refund_entry_type" id="purchase_return_refund_entry_type" class="form-control kt-selectpicker">
													<option value="" selected>Select</option>
													<?php $purchase_return_refund_entry_type_summary = ''; ?>
													@foreach($entryTypes as $entryType)
													<?php if ($purchase_return_refund_entry_type == $entryType->id) $purchase_return_refund_entry_type_summary = $entryType->name; ?>
													<option value="{{$entryType->id}}" {{($purchase_return_refund_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
													@endforeach
												</select>
											</div>
										</div>



									</div>


								</div>
							</div>
						</div>

						<!--end: Form Wizard Step 5-->

						<!--begin: Form Wizard Step 6-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
							<div class="kt-heading kt-heading--md">Review your Details and Submit</div>
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__review">
									<div class="kt-wizard-v2__review-item">
										<div class="kt-wizard-v2__review-title">
											Branch Details
										</div>
										<div class="kt-wizard-v2__review-content">
											<span class="company_name_summary summaryLbl">{{isset($branchSettings->company_name)?$branchSettings->company_name:'0'}}</span><br />
											Building No: <span class="building_no_summary summaryLbl">{{isset($branchSettings->building_no)?$branchSettings->building_no:'0'}}</span><br />
											Street Name: <span class="street_name_summary summaryLbl">{{isset($branchSettings->street_name)?$branchSettings->street_name:'0'}}</span><br />
											District: <span class="district_summary summaryLbl">{{isset($branchSettings->district)?$branchSettings->district:'0'}}</span><br />
											Province / State: <span class="province_state_summary summaryLbl">{{isset($branchSettings->province_state)?$branchSettings->province_state:'0'}}</span><br />
											City: <span class="city_summary summaryLbl">{{isset($branchSettings->city)?$branchSettings->city:'0'}}</span><br />
											Country: <span class="country_summary summaryLbl">{{$country_summary}}</span><br />
											Postal Code: <span class="postal_code_summary summaryLbl">{{isset($branchSettings->postal_code)?$branchSettings->postal_code:'0'}}</span><br />
											Phone: <span class="phone_number_summary summaryLbl">{{isset($branchSettings->phone_number)?$branchSettings->phone_number:'0'}}</span><br />
											CR ID: <span class="company_cr_summary summaryLbl">{{isset($branchSettings->company_cr)?$branchSettings->company_cr:'0'}}</span><br />
											VAT ID: <span class="company_vat_summary summaryLbl">{{isset($branchSettings->company_vat)?$branchSettings->company_vat:'0'}}</span><br />
											<!-- Phone: +61412345678 <br />
											Email: johnwick@reeves.com -->
										</div>
									</div>
									<div class="kt-wizard-v2__review-item">
										<div class="kt-wizard-v2__review-title">
											Seal
										</div>
										<div class="kt-wizard-v2__review-content">
											<!-- Address Line 1<br />
											Address Line 2<br />
											Melbourne 3000, VIC, Australia -->
											<div class="image-box branchSealSummary">
												<img src="{{url(isset($branchSettings->seal)?'public/'.$branchSettings->seal:'')}}" alt="Branch Seal Not Uploded">
											</div>
										</div>
										<div class="kt-wizard-v2__review-item">
											<div class="kt-wizard-v2__review-title">
												Invoice Headder & Footer
											</div>
											<div class="kt-wizard-v2__review-content">
												<!-- Overnight Delivery with Regular Packaging<br />
												Preferred Morning (8:00AM - 11:00AM) Delivery -->
												<div class="image-container">
													<div class="image-box branchInvoiceHeadderSummary">
														<img src="{{url(isset($branchSettings->pdfheader)?'public/'.$branchSettings->pdfheader:'')}}" alt="Invoice Headder Not Uploded">
													</div>
													<div class="image-box branchInvoiceFooterSummary">
														<img src="{{url(isset($branchSettings->pdffooter)?'public/'.$branchSettings->pdffooter:'')}}" alt="Invoice Footer Not Uploded">
													</div>
												</div>
											</div>
										</div>
										<div class="kt-wizard-v2__review-item">
											<div class="kt-wizard-v2__review-title">
												Invoice Format
											</div>
											<div class="kt-wizard-v2__review-content">
												Top Margin [in px] with Header: <span class="pdfheader_top_summary summaryLbl">{{isset($branchSettings->pdfheader_top)?$branchSettings->pdfheader_top:'0'}}</span><br />
												Bottom Margin [in px] with Footer: <span class="pdffooter_bottom_summary summaryLbl">{{isset($branchSettings->pdffooter_bottom)?$branchSettings->pdffooter_bottom:'0'}}</span><br />
												Top Margin [in px] without Header: <span class="pdfletterheader_top_summary summaryLbl">{{isset($branchSettings->pdfletterheader_top)?$branchSettings->pdfletterheader_top:'0'}}</span><br />
												Bottom Margin [in px] without Footer: <span class="pdfletterfooter_bottom_summary summaryLbl">{{isset($branchSettings->pdfletterfooter_bottom)?$branchSettings->pdfletterfooter_bottom:'0'}}</span><br />
											</div>
										</div>
										<div class="kt-wizard-v2__review-item">
											<div class="kt-wizard-v2__review-title">
												Accounting Configuration
											</div>
											<div class="kt-wizard-v2__review-content">
												<br>
												<label class="subHead">Ledger settings</label>
												<br>

												Default Customer: <span class="default_customer_ledger_summary summaryLbl">{{$default_customer_ledger_summary}}</span><br />
												Default Supplier: <span class="default_supplier_ledger_summary summaryLbl">{{$default_supplier_ledger_summary}}</span><br />
												Sales Invoice: <span class="sales_invoice_ledger_summary summaryLbl">{{$sales_invoice_ledger_summary}}</span><br />
												Sales Invoice Vat: <span class="sales_invoice_vat_ledger_summary summaryLbl">{{$sales_invoice_vat_ledger_summary}}</span><br />
												Sales Return: <span class="sales_return_ledger_summary summaryLbl">{{$sales_return_ledger_summary}}</span><br />
												Sales Return Vat: <span class="sales_return_vat_ledger_summary summaryLbl">{{$sales_return_vat_ledger_summary}}</span><br />
												Purchase Invoice: <span class="purchase_invoice_ledger_summary summaryLbl">{{$purchase_invoice_ledger_summary}}</span><br />
												Purchase Invoice Vat: <span class="purchase_invoice_vat_ledger_summary summaryLbl">{{$purchase_invoice_vat_ledger_summary}}</span><br />
												Purchase Return: <span class="purchase_return_ledger_summary summaryLbl">{{$purchase_return_ledger_summary}}</span><br />
												Purchase Return Vat: <span class="purchase_return_vat_ledger_summary summaryLbl">{{$purchase_return_vat_ledger_summary}}</span><br />

												<br>
												<label class="subHead">Entry Type Settings</label>
												<br>

												Sales Invoice: <span class="sales_invoice_entry_type_summary summaryLbl">{{$sales_invoice_entry_type_summary}}</span><br />
												Purchase Invoice: <span class="purchase_invoice_entry_type_summary summaryLbl">{{$purchase_invoice_entry_type_summary}}</span><br />
												Sales return: <span class="sales_return_entry_type_summary summaryLbl">{{$sales_return_entry_type_summary}}</span><br />
												Purchase return: <span class="purchase_return_entry_type_summary summaryLbl">{{$purchase_return_entry_type_summary}}</span><br />
												Sales Bill Settilement: <span class="sales_billsettilement_entry_type_summary summaryLbl">{{$sales_billsettilement_entry_type_summary}}</span><br />
												Purchase Bill Settilement: <span class="purchase_billsettilement_entry_type_summary summaryLbl">{{$purchase_billsettilement_entry_type_summary}}</span><br />
												Sales Adwance: <span class="sales_adwance_entry_type_summary summaryLbl">{{$sales_adwance_entry_type_summary}}</span><br />
												Purchase Adwance: <span class="purchase_adwance_entry_type_summary summaryLbl">{{$purchase_adwance_entry_type_summary}}</span><br />
												Sales Return Refund: <span class="sales_return_refund_entry_type_summary summaryLbl">{{$sales_return_refund_entry_type_summary}}</span><br />
												Purchase Return Refund: <span class="purchase_return_refund_entry_type_summary summaryLbl">{{$purchase_return_refund_entry_type_summary}}</span><br />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--end: Form Wizard Step 6-->

						<!--begin: Form Actions -->
						<div class="kt-form__actions">
							<button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
								Previous
							</button>
							<!-- <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
								Submit
							</button> -->

							<button id="btnFinalSubmit" class="btn btn-success kt-spinner--right kt-spinner--sm kt-spinner--light " data-ktwizard-type="action-submit">
								<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
									<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
									<polyline points="22 4 12 14.01 9 11.01"></polyline>
								</svg>
								{{ __('app.Save') }}
							</button>

							<button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
								Next Step
							</button>
						</div>

						<!--end: Form Actions -->
					</form>

					<!--end: Form Wizard Form-->
				</div>
			</div>
			<!-- </div>
			</div> -->




		</div>
	</div>
</div>

<!-- The Modal for preview image -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog" style="max-width:75%;">
		<div class="modal-content">
			<!-- Modal Header -->
			<!-- Modal body -->
			<div class="modal-body">
				<button type="button " class="btn btn-dark float-right" data-dismiss="modal" style="    width: auto; padding: 4px; line-height: .75; ">&times;</button>
				<img alt="Logo" id="modalimg" src="" style="width:100%;" />
			</div>
			<!-- Modal footer -->
		</div>
	</div>
</div>
<!-- ./ The Modal for preview image -->

@endsection
@section('script')
<script src="{{url('resources/js/settings/branchsettings/sealupload.js')}}" type="text/javascript"></script>
<script src="{{url('resources/js/settings/branchsettings/headderupload.js')}}" type="text/javascript"></script>
<script src="{{url('resources/js/settings/branchsettings/footerupload.js')}}" type="text/javascript"></script>
<script src="{{url('resources/js/settings/branchsettings/wizardSettings.js')}}" type="text/javascript"></script>
<script src="{{url('resources/js/settings/branchsettings/summary.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	$('.branch-settings').addClass('kt-menu__item--active');

	$(document).on("click", ".previw", function() {
		$img = $(this).attr("image");
		$("#modalimg").attr("src", $img);
	});

	$('#btnFinalSubmit').click(function() {
		$('#btnFinalSubmit').addClass('kt-spinner');
		$('#btnFinalSubmit').prop("disabled", true);
		$.ajax({
			type: "POST",
			url: "save-branch-details",
			dataType: "json",
			data: {
				_token: $('#token').val(),

				// Branch Details
				company_name: $('#company_name').val(),
				building_no: $('#building_no').val(),
				street_name: $('#street_name').val(),
				district: $('#district').val(),
				province_state: $('#province_state').val(),
				city: $('#city').val(),
				country: $('#country').val(),
				postal_code: $('#postal_code').val(),
				phone_number: $('#phone_number').val(),
				company_cr: $('#company_cr').val(),
				company_vat: $('#company_vat').val(),

				fileDataSeal: $('#fileDataSeal').val(),

				fileDataHeadder: $('#fileDataHeadder').val(),
				fileDataFooter: $('#fileDataFooter').val(),

				preview: $("input[name='preview']:checked").val(),
				pdfheader_top: $('#pdfheader_top').val(),
				pdffooter_bottom: $('#pdffooter_bottom').val(),
				pdfletterheader_top: $('#pdfletterheader_top').val(),
				pdfletterfooter_bottom: $('#pdfletterfooter_bottom').val(),


				//    ledger
				default_customer_ledger: $('#default_customer_ledger').val(),
				default_supplier_ledger: $('#default_supplier_ledger').val(),

				sales_invoice_ledger: $('#sales_invoice_ledger').val(),
				sales_invoice_vat_ledger: $('#sales_invoice_vat_ledger').val(),
				sales_return_ledger: $('#sales_return_ledger').val(),
				sales_return_vat_ledger: $('#sales_return_vat_ledger').val(),
				purchase_invoice_ledger: $('#purchase_invoice_ledger').val(),
				purchase_invoice_vat_ledger: $('#purchase_invoice_vat_ledger').val(),
				purchase_return_ledger: $('#purchase_return_ledger').val(),
				purchase_return_vat_ledger: $('#purchase_return_vat_ledger').val(),
				// ./   ledger

				// entry_type
				sales_invoice_entry_type: $('#sales_invoice_entry_type').val(),
				purchase_invoice_entry_type: $('#purchase_invoice_entry_type').val(),
				sales_return_entry_type: $('#sales_return_entry_type').val(),
				purchase_return_entry_type: $('#purchase_return_entry_type').val(),
				sales_billsettilement_entry_type: $('#sales_billsettilement_entry_type').val(),
				purchase_billsettilement_entry_type: $('#purchase_billsettilement_entry_type').val(),
				sales_adwance_entry_type: $('#sales_adwance_entry_type').val(),
				purchase_adwance_entry_type: $('#purchase_adwance_entry_type').val(),
				sales_return_refund_entry_type: $('#sales_return_refund_entry_type').val(),
				purchase_return_refund_entry_type: $('#purchase_return_refund_entry_type').val(),
				// ./ entry_type

			},
			success: function(data) {
				if (data.status == 1)
					toastr.success('Branch Detils Saved ');
			},
			error: function(jqXhr, json, errorThrown) {
				toastr.error('Error While Save');
			}
		}).always(function() {
			$('#btnFinalSubmit').removeClass('kt-spinner');
			$('#btnFinalSubmit').prop("disabled", false);
		});
	});
</script>

@endsection