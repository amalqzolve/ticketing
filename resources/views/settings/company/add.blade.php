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
    $pdfheader_top = "";
	$pdfletterfooter_bottom = "";
	$pdffooter_bottom = "";
	$pdfletterheader_top = "";
	$streetname = "";
	$district = "";
	$city = "";
	$comcountry = "";
	$postalcode = "";
	$streetnamear = "";
	$districtar = "";
	$cityar = "";
	$postalcodear = "";
	$companynamear = "";

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
    		$proformainvoiceval= $companies->proformainvoiceval;
    		$salesinvoice  = $companies->salesinvoice;
    		$salesreturn= $companies->salesreturn;
    		$purchasereturn = $companies->purchasereturn;
    		$debitnote  = $companies->debitnote;
    		$creditnote  = $companies->creditnote;
    		$advancerequest = $companies->advancerequest;
    		$paymentrequest = $companies->paymentrequest;
    		$advancereceipt = $companies->advancereceipt;
    		$paymentreceipt = $companies->paymentreceipt;
    		$streetname = $companies->streetname;
						$district = $companies->district;
						$city = $companies->city;
						$comcountry = $companies->cust_country;
						$postalcode = $companies->postalcode; 
						$streetnamear = $companies->streetnamear;
						$districtar = $companies->districtar;
						$cityar = $companies->cityar;
						$postalcodear = $companies->postalcodear;
						$companynamear = $companies->company_namear;
						$companylogo = $companies->companylogo;
		}

	}


	?>
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
											Company settings
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
								<form class="kt-form" id="kt_form">
								 <div class="row" style="padding-bottom: 6px;">


									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Company Name<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="company_name" placeholder="Company Name" id="company_name" value="{{$companyname}}">
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Company Name(Ar)<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="company_namear" placeholder="Company Name" id="company_namear" value="{{$companynamear}}">
									</div>
									</div>
									</div>
									
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Street Name<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="streetname" placeholder="Street Name" id="streetname" value="{{$streetname}}">
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Street Name(Ar)<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="streetnamear" placeholder="Street Name" id="streetnamear" value="{{$streetnamear}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>District<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="district" placeholder="District" id="district" value="{{$district}}">
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>District(Ar)<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="districtar" placeholder="District" id="districtar" value="{{$districtar}}">
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>City<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="city" placeholder="City" id="city" value="{{$city}}">
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>City(Ar)<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="cityar" placeholder="City" id="cityar" value="{{$cityar}}">
									</div>
									</div>
									</div>
									
									
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Postal Code<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="postalcode" placeholder="Postal Code" id="postalcode" value="{{$postalcode}}">
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Postal Code(Ar)<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="postalcodear" placeholder="Postal Code" id="postalcodear" value="{{$postalcodear}}">
									</div>
									</div>
									</div>



									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>CR ID<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="company_cr" placeholder="Company CR" id="company_cr" value="{{$companycr}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>VAT ID<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="company_vat" placeholder="Company VAT" id="company_vat" value="{{$companyvat}}">
									</div>
									</div>
									</div>
									<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('customer.Country') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8">
																<div class="input-group  input-group-sm">
																	<select name="comcountry" id="comcountry"
																		class="form-control single-select">

																		<option value="">{{ __('customer.Select') }}
																		</option>@foreach($country as $coun)
																		<option value="{{$coun->id}}"@if($comcountry == $coun->id){{"selected"}}@endif>
																			{{$coun->cntry_name}}</option>@endforeach
																	</select>
																</div>
															</div>
														</div>
													</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Common Database<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="radio" class="form-control" name="common_customer_database" id="common_customer_database" <?php if($common_customer == 1) echo "checked";?> value="1">Yes
									<input type="radio" class="form-control" name="common_customer_database" id="common_customer_database" <?php if($common_customer == 2) echo "checked";?> value="2">No
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Store Available<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="radio" class="form-control" name="storeavailable" id="storeavailable" <?php if($storeavailable == 1) echo "checked";?> value="1">Yes
									<input type="radio" class="form-control" name="storeavailable" id="storeavailable" <?php if($storeavailable == 2) echo "checked";?> value="2">No
									</div>
									</div>
									</div>

									<div class="col-lg-12">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Invoice Format<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">


									 <div class="cc-selector-2">
								        <input id="visa2" type="radio" name="preview" <?php if($preview == 'preview1') echo "checked";?> value="preview1" class="hiden" />
								        <label class="drinkcard-cc visa img-thumbnail" for="visa2">
								        </label>
								        <span class="badge badge-info previw"  class="btn btn-primary" data-toggle="modal" data-target="#myModal" image="{{ URL::asset('assets') }}/media/pdfimg/preview1.PNG">
								        preview</span>

								        <input id="mastercard2" type="radio" name="preview" <?php if($preview == 'preview2') echo "checked";?> value="preview2" class="hiden" />
								        <label class="drinkcard-cc mastercard img-thumbnail"for="mastercard2"></label>
								        <span class="badge badge-info previw"  class="btn btn-primary" data-toggle="modal" data-target="#myModal"  image="{{ URL::asset('assets') }}/media/pdfimg/preview2.PNG">
								        preview</span>

								        <input id="visa3" type="radio" name="preview" <?php if($preview == 'preview3') echo "checked";?> value="preview3" class="hiden" />
								        <label class="drinkcard-cc visa3 img-thumbnail" for="visa3">
								        </label>
								        <span class="badge badge-info previw"  class="btn btn-primary" data-toggle="modal" data-target="#myModal" image="{{ URL::asset('assets') }}/media/pdfimg/preview3.PNG">
								        preview</span>

								        <input   id="mastercard3" type="radio" name="preview" <?php if($preview == 'preview4') echo "checked";?> value="preview4" class="hiden" />
								        <label class="drinkcard-cc mastercard3 img-thumbnail"for="mastercard3"></label>
								        <span class="badge badge-info previw"  class="btn btn-primary" data-toggle="modal" data-target="#myModal"  image="{{ URL::asset('assets') }}/media/pdfimg/preview4.PNG">
								        preview</span>



								    </div>
									</div>
									</div>
									</div>

									



									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Top Margin [in px] with Header<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="pdfheader_top" placeholder="" id="pdfheader_top" value="{{$pdfheader_top}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Top Margin [in px] with Footer<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="pdffooter_bottom" placeholder="" id="pdffooter_bottom" value="{{$pdffooter_bottom}}">
									</div>
									</div>
									</div>



									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Top Margin [in px] without Header<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="pdfletterheader_top" placeholder="" id="pdfletterheader_top" value="{{$pdfletterheader_top}}">
									</div>
									</div>
									</div>

									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Top Margin [in px] without Footer<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="pdfletterfooter_bottom" placeholder="" id="pdfletterfooter_bottom" value="{{$pdfletterfooter_bottom}}">
									</div>
									</div>
									</div>
									<div class="col-lg-12">
									<div class="form-group row pl-md-3">
									<div class="col-md-12">
									<label>Company Logo</label>
									</div>
									<div class="col-md-12 ">

								   <input type="hidden" name="fileData" value="{{$companylogo}}" id="fileData"/>
								   <div id="choose-files">
								   <form action="/upload">
								   <input type="file" id="files" name="files[]" accept="image/*"/>
									</form>
								   </div>

									</div>
									</div>
									</div>
									





<input type="hidden" name="branch" id="branch" value="{{$branch}}">

								 </div>
								 <br><br><br>



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
                                                            <button type="submit" name="company_submit" id="company_submit" class="btn btn-primary">
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
<!-- <script src="{{url('/')}}/resources/js/settings/company.js" type="text/javascript"></script> -->

<script type="text/javascript">
	$(document).on("click",".previw",function() {
	   $img= $(this).attr("image");
	   $("#modalimg").attr("src", $img);

	});
</script>

<script type="text/javascript">



const uppy = Uppy.Core({
		autoProceed: false,
		allowMultipleUploads: false,
		// meta: {
		//         UniqueID       : $('#UniqueID').val()
		//     },
		 restrictions: {
    maxNumberOfFiles: 1,
    minNumberOfFiles: 1,
    allowedFileTypes: ['image/*'],
  },
		onBeforeUpload: (files) => {
			fileData = [];
			const updatedFiles = {};

			Object.keys(files).forEach(fileID => {
					fileData.push('companylogoupload/' + files[fileID].name)
				})
				//return updatedFiles
			$('#fileData').val(fileData);

		},

	})

	uppy.use(Uppy.Dashboard, {
		metaFields: [
			{ id: 'name', name: 'Name', placeholder: 'File name' },
			{ id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
		],
		browserBackButtonClose: true,
		target: '#choose-files',
		inline: true,
		replaceTargetContent: true,
		width:'100%'
	})
	uppy.use(Uppy.Webcam, { target: Uppy.Dashboard })
	uppy.use(Uppy.XHRUpload, {
		endpoint: 'companylogoupload',
		// UniqueID       : $('#UniqueID').val(),
		fieldName: 'filenames[]',
		headers: {
			'X-CSRF-TOKEN': $('#token').val(),
			// UniqueID       : $('#UniqueID').val()
		}
	})

	if ($('#fileData').val() != '') {
		var img_array = $('#fileData').val().split(",");
		console.log(img_array);
		$.each(img_array, function(i) {
			onuppyImageClicked('public/' + img_array[i]);
		});
	}

	function onuppyImageClicked(img) {

		var str = img.toString();
		var n = str.lastIndexOf('/');
		var img_name = str.substring(n + 1);
		// assuming the image lives on a server somewhere
		return fetch(img)
			.then((response) => response.blob()) // returns a Blob
			.then((blob) => {
				uppy.addFile({
					name: img_name,
					type: 'image/jpeg',
					data: blob
				})
			})
	}




	$(document).on('click', '#company_submit', function(e) {

    e.preventDefault();

        company_name = $('#company_name').val();
        company_cr         = $('#company_cr').val();
        company_vat        = $('#company_vat').val();
       

        if (company_name == ""){
            $('#company_name').addClass('is-invalid');
            return false;
        }else{
            $('#company_name').removeClass('is-invalid');
        }

        if (company_cr == "") {
            $('#company_cr').addClass('is-invalid');
            return false;
        } else {
             $('#company_cr').removeClass('is-invalid');
         }

        if (company_vat == "") {
            $('#company_vat').addClass('is-invalid');
            return false;
        } else {
            $('#company_vat').removeClass('is-invalid');
        }

     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Updated';
     } else{
        var sucess_msg ='Created';
     }
    

    $.ajax({
        type: "POST",
        url: "settingscompanysubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            company_name  : $('#company_name').val(),
            company_cr    : $('#company_cr').val(),
            company_vat   : $('#company_vat').val(),
            streetname  : $('#streetname').val(),
            district    : $('#district').val(),
            city   : $('#city').val(),
            comcountry : $('#comcountry').val(),
            postalcode : $('#postalcode').val(),
            company_namear  : $('#company_namear').val(),
            streetnamear  : $('#streetnamear').val(),
            districtar    : $('#districtar').val(),
            cityar   : $('#cityar').val(),
            postalcodear : $('#postalcodear').val(),
            preview       : $('input[name="preview"]:checked').val(),
            common_customer_database: $('input[name="common_customer_database"]:checked').val(),
            branch        : $("#branch").val(),
            storeavailable: $('input[name="storeavailable"]:checked').val(),
            pdfletterheader_top  : $('#pdfletterheader_top').val(),
            pdfletterfooter_bottom  : $('#pdfletterfooter_bottom').val(),
            pdfheader_top  : $('#pdfheader_top').val(),
            pdffooter_bottom  : $('#pdffooter_bottom').val(),

            salesquotation  : $('#salesquotation').val(),
            salesorder    : $('#salesorder').val(),
            deliveryorder   : $('#deliveryorder').val(),
            purchaseorder       : $('#purchaseorder').val(),
            proformainvoice: $('#proformainvoice').val(),
            salesinvoice        : $("#salesinvoice").val(),
            salesreturn: $('#salesreturn').val(),
            purchasereturn  : $('#purchasereturn').val(),
            debitnote  : $('#debitnote').val(),
            creditnote  : $('#creditnote').val(),
            advancerequest  : $('#advancerequest').val(),
            paymentrequest  : $('#paymentrequest').val(),
            advancereceipt  : $('#advancereceipt').val(),
            paymentreceipt  : $('#paymentreceipt').val(),
            fileData: $('#fileData').val(),




        },
        success: function(data) {
            console.log(data);
             $('#company_submit').removeClass('kt-spinner');
             $('#company_submit').prop("disabled", false);
              window.location.href = "company";
             toastr.success('Company Settings '+sucess_msg+' successfuly');
             
        

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

</script>

 @endsection
