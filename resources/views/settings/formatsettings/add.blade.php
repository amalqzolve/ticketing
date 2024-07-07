@extends('settings.common.layout')
@section('content')
<style>
	.cc-selector input{
    margin:0;padding:0;
    -webkit-appearance:none;
       -moz-appearance:none;
            appearance:none;
}

.cc-selector-2 input{
    position:absolute;
    z-index:999;
}

.visa{background-image:url(http://localhost/trading/public/assets/media/pdfimg/preview1.PNG);}
.mastercard{background-image:url(http://localhost/trading/public/assets/media/pdfimg/preview2.PNG);}
.visa3{background-image:url(http://localhost/trading/public/assets/media/pdfimg/preview3.PNG);}
.mastercard3{background-image:url(http://localhost/trading/public/assets/media/pdfimg/preview4.PNG);}

.cc-selector-2 input:active +.drinkcard-cc, .cc-selector input:active +.drinkcard-cc{opacity: .9;}
.cc-selector-2 input:checked +.drinkcard-cc, .cc-selector input:checked +.drinkcard-cc{
    -webkit-filter: none;
       -moz-filter: none;
            filter: none;
}
.drinkcard-cc{
    cursor:pointer;
    background-size:contain;
    background-repeat:no-repeat;
    display:inline-block;
    width:130px;height:140px;
    -webkit-transition: all 100ms ease-in;
       -moz-transition: all 100ms ease-in;
            transition: all 100ms ease-in;
    -webkit-filter: brightness(.8) grayscale(1) opacity(.7);
       -moz-filter: brightness(.8) grayscale(1) opacity(.7);
            filter: brightness(.8) grayscale(1) opacity(.7);
}
.drinkcard-cc:hover{
    -webkit-filter: brightness(.7) grayscale(.5) opacity(.9);
       -moz-filter: brightness(.7) grayscale(.5) opacity(.9);
            filter: brightness(.7) grayscale(.5) opacity(.9);
}

/* Extras */
a:visited{color:#888}
a{color:#444;text-decoration:none;}
p{margin-bottom:.3em;}

.cc-selector-2 input{ margin: 5px 0 0 12px; }
.cc-selector-2 label{ margin-left: 7px; }
span.cc{ color:#6d84b4 }
.previw{
	position: absolute;
    margin-left: -80px;
    margin-top: 4px;
    cursor: pointer;
}
/*.hiden
{
	visibility: hidden;
}*/

	</style>
	<?php
	$companyname = "";
	$companycr = "";
	$companyvat = "";
	$preview = "";
	$common_customer_database = "";
	$common_customer ="";
	$storeavailable ="";

	$salesquotation = "";
    $salesorder  = "";
    $deliveryorder = "";
  	$purchaseorder = "";
    $proformainvoice= "";
    $salesinvoice  = "";
    $salesreturn= "";
    $purchasereturn = "";
    $debitnote  = "";
    $creditnote  = "";
    $advancerequest = "";
    $paymentrequest = "";
    $advancereceipt = "";
    $paymentreceipt = "";

    $salesquotation_sufix = "";
    $salesorder_sufix  = "";
    $deliveryorder_sufix = "";
  	$purchaseorder_sufix = "";
    $proformainvoice_sufix= "";
    $salesinvoice_sufix  = "";
    $salesreturn_sufix= "";
    $purchasereturn_sufix = "";
    $debitnote_sufix  = "";
    $creditnote_sufix  = "";
    $advancerequest_sufix = "";
    $paymentrequest_sufix = "";
    $advancereceipt_sufix = "";
    $paymentreceipt_sufix = "";

	if($companysettings!="")
	{
		foreach($companysettings as $companies)
		{
			$companyname = $companies->company_name;
			$companycr = $companies->company_cr;
			$companyvat = $companies->company_vat;
			$preview = $companies->preview;
			$common_customer = $companies->common_customer_database;
			$storeavailable = $companies->storeavailable;
			$pdfletterheader_top = $companies->pdfletterheader_top;
			$pdfletterfooter_bottom = $companies->pdfletterfooter_bottom;
			$pdfheader_top = $companies->pdfheader_top;
			$pdffooter_bottom = $companies->pdffooter_bottom;

			$salesquotation = $companies->salesquotation;
    		$salesorder  = $companies->salesorder;
    		$deliveryorder = $companies->deliveryorder;
  			$purchaseorder = $companies->purchaseorder;
    		$proformainvoice= $companies->proformainvoice;
    		$salesinvoice  = $companies->salesinvoice;
    		$salesreturn= $companies->salesreturn;
    		$purchasereturn = $companies->purchasereturn;
    		$debitnote  = $companies->debitnote;
    		$creditnote  = $companies->creditnote;
    		$advancerequest = $companies->advancerequest;
    		$paymentrequest = $companies->paymentrequest;
    		$advancereceipt = $companies->advancereceipt;
    		$paymentreceipt = $companies->paymentreceipt;



    		$salesquotation_sufix = $companies->salesquotation_sufix;
    		$salesorder_sufix  = $companies->salesorder_sufix;
    		$deliveryorder_sufix = $companies->deliveryorder_sufix;
  			$purchaseorder_sufix = $companies->purchaseorder_sufix;
    		$proformainvoice_sufix= $companies->proformainvoice_sufix;
    		$salesinvoice_sufix  = $companies->salesinvoice_sufix;
    		$salesreturn_sufix= $companies->salesreturn_sufix;
    		$purchasereturn_sufix = $companies->purchasereturn_sufix;
    		$debitnote_sufix  = $companies->debitnote_sufix;
    		$creditnote_sufix  = $companies->creditnote_sufix;
    		$advancerequest_sufix = $companies->advancerequest_sufix;
    		$paymentrequest_sufix = $companies->paymentrequest_sufix;
    		$advancereceipt_sufix = $companies->advancereceipt_sufix;
    		$paymentreceipt_sufix = $companies->paymentreceipt_sufix;
		}

	}


	?>
	<input type="hidden" name="branch" id="branch" value="{{$branch}}">
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											Format settings
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
								<form class="kt-form" id="kt_form">

								 <div class="row" style="padding-bottom: 6px;">

								 	<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Sales Quotation Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="salesquotation" placeholder="" id="salesquotation" value="{{$salesquotation}}">
									</div>
									</div>
									</div>


									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Sales Quotation Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="salesquotation_sufix" placeholder="" id="salesquotation_sufix" value="{{$salesquotation_sufix}}">
									</div>
									</div>
									</div>





									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Sales Order Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="salesorder" placeholder="" id="salesorder" value="{{$salesorder}}">
									</div>
									</div>
									</div>


									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Sales Order Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="salesorder_sufix" placeholder="" id="salesorder_sufix" value="{{$salesorder_sufix}}">
									</div>
									</div>
									</div>


									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Delivery Order Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="deliveryorder" placeholder="" id="deliveryorder" value="{{$deliveryorder}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Delivery Order Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="deliveryorder_sufix" placeholder="" id="deliveryorder_sufix" value="{{$deliveryorder_sufix}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Purchase Order Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="purchaseorder" placeholder="" id="purchaseorder" value="{{$purchaseorder}}">
									</div>
									</div>
									</div>


									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Purchase Order Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="purchaseorder_sufix" placeholder="" id="purchaseorder_sufix" value="{{$purchaseorder_sufix}}">
									</div>
									</div>
									</div>




									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Proforma Invoice Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="proformainvoice" placeholder="" id="proformainvoice" value="{{$proformainvoice}}">
									</div>
									</div>
									</div>



									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Proforma Invoice Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="proformainvoice_sufix" placeholder="" id="proformainvoice_sufix" value="{{$proformainvoice_sufix}}">
									</div>
									</div>
									</div>




									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Sales Invoice Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="salesinvoice" placeholder="" id="salesinvoice" value="{{$salesinvoice}}">
									</div>
									</div>
									</div>

										<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Sales Invoice Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="salesinvoice_sufix" placeholder="" id="salesinvoice_sufix" value="{{$salesinvoice_sufix}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Sales Return Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="salesreturn" placeholder="" id="salesreturn" value="{{$salesreturn}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Sales Return Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="salesreturn_sufix" placeholder="" id="salesreturn_sufix" value="{{$salesreturn_sufix}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Purchase Return Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="purchasereturn" placeholder="" id="purchasereturn" value="{{$purchasereturn}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Purchase Return Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="purchasereturn_sufix" placeholder="" id="purchasereturn_sufix" value="{{$purchasereturn_sufix}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Debit Note Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="debitnote" placeholder="" id="debitnote" value="{{$debitnote}}">
									</div>
									</div>
									</div>

										<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Debit Note Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="debitnote_sufix" placeholder="" id="debitnote_sufix" value="{{$debitnote_sufix}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Credit Note Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="creditnote" placeholder="" id="creditnote" value="{{$creditnote}}">
									</div>
									</div>
									</div>

										<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Credit Note Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="creditnote_sufix" placeholder="" id="creditnote_sufix" value="{{$creditnote_sufix}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Advance Request Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="advancerequest" placeholder="" id="advancerequest" value="{{$advancerequest}}">
									</div>
									</div>
									</div>

										<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Advance Request Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="advancerequest_sufix" placeholder="" id="advancerequest_sufix" value="{{$advancerequest_sufix}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Payment Request Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="paymentrequest" placeholder="" id="paymentrequest" value="{{$paymentrequest}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Payment Request Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="paymentrequest_sufix" placeholder="" id="paymentrequest_sufix" value="{{$paymentrequest_sufix}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Advance Receipt Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="advancereceipt" placeholder="" id="advancereceipt" value="{{$advancereceipt}}">
									</div>
									</div>
									</div>


									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Advance Receipt Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="advancereceipt_sufix" placeholder="" id="advancereceipt_sufix" value="{{$advancereceipt_sufix}}">
									</div>
									</div>
									</div>


									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Payment Receipt Prefix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="paymentreceipt" placeholder="" id="paymentreceipt" value="{{$paymentreceipt}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Payment Receipt Sufix<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="paymentreceipt_sufix" placeholder="" id="paymentreceipt_sufix" value="{{$paymentreceipt_sufix}}">
									</div>
									</div>
									</div>


								 </div>

								 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">

															<button type="reset" class="btn btn-secondary cancel" onclick="Currency_cancel()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                @lang('app.Cancel')
                                                            </button>
                                                            <button type="submit" name="format_submit" id="format_submit" class="btn btn-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                                                @lang('app.Save')
                                                            </button>
														</div>
													</div>
												</div>
											</div>
									 </form>
								</div>
							</div>
						</div>
<style type="text/css">
	.hideButton{
	   display: none
	}
	.error{
		color: red
	}
</style>
<!-- The Modal -->
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
<script src="{{url('/')}}/resources/js/settings/company.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/settings/format.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).on("click",".previw",function() {
	   $img= $(this).attr("image");
	   $("#modalimg").attr("src", $img);

	});
</script>
 @endsection
