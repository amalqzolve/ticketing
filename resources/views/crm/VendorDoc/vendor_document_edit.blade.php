
@extends('crm.common.layout')
	@section('content')
		<link href="{{ URL::asset('assets') }}/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content" style="padding-bottom: 0;">
				<div class="kt-subheader   kt-grid__item" id="kt_subheader">
								<div class="kt-container  kt-container--fluid ">
												<div class="kt-subheader__main">
																<h3 class="kt-subheader__title">
																				Wizard 1 </h3>
																<span class="kt-subheader__separator kt-hidden"></span>
																<div class="kt-subheader__breadcrumbs"> <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
											<span class="kt-subheader__breadcrumbs-separator"></span>
											<a href="" class="kt-subheader__breadcrumbs-link">
											Pages </a>
											<span class="kt-subheader__breadcrumbs-separator"></span>
											<a href="" class="kt-subheader__breadcrumbs-link">
											Wizard 1 </a>
											</div>
												</div>
												<div class="kt-subheader__toolbar">
																<div class="kt-subheader__wrapper"> <a href="#" class="btn kt-subheader__btn-primary">
																								Back
																				</a>
																</div>
												</div>
								</div>
				</div>
				<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
								<div class="kt-portlet">
												<div class="kt-portlet__body kt-portlet__body--fit nborder">
									<div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="step-first">
									<div class="kt-grid__item">
									<div class="kt-wizard-v1__nav">
									<div class="kt-wizard-v1__nav-items kt-wizard-v1__nav-items--clickable">
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current" id="documentsinfo">
									<div class="kt-wizard-v1__nav-body">			 <div class="kt-wizard-v1__nav-icon"> <i class="flaticon-bus-stop"></i>																			</div>											 <div class="kt-wizard-v1__nav-label">{{ __('customer.License') }}</div>											
								</div>												</div>												 <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">																								 <div class="kt-wizard-v1__nav-body">																	 <div class="kt-wizard-v1__nav-icon"> <i class="flaticon-list"></i>																						</div>																									 <div class="kt-wizard-v1__nav-label">{{ __('customer.Documents') }}</div>
								</div>												</div>
								<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" id="credit_limit">							
									<div class="kt-wizard-v1__nav-body">			
									<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-responsive"></i>																									</div>			     <div class="kt-wizard-v1__nav-label">{{ __('customer.Credit limit') }}</div>																										</div>
										</div>
									<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">						
										<div class="kt-wizard-v1__nav-body">
										<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-globe"></i>																	</div>
										<div class="kt-wizard-v1__nav-label">{{ __('customer.Contracts') }}</div>																			</div>   																					</div>
										</div>
										@php 
										if(isset($data))
										{
										foreach ($data as $key => $value)  
										{
										$vatno = $value->vat_no; 						$vdate = $value->vat_expiring_date; 
										$licno = $value->license_no; 					$ldate = $value->license_expiring_date; 
										$crno = $value->cr_no; 						$cdate = $value->cr_expiring_date; 
										$noinv = $value->no_of_invoices; 
										$cpeinv= $value->credit_period_of_each_invoices; $cptinc= $value->credit_period_of_total_invoices; 
										$tamnt = $value->total_amount;				 $contract_no = $value->contract_no; 
										$crdate = $value->contractno_expiry_date; 
										$documents =isset($value->documents)? $value->documents :'';						$description = isset($value->description)? $value->description : '' ; 	
										$pterms= $value->payment_terms;
										$pterms =isset($pterms)? $pterms :'';
										}
										}
													@endphp		
										<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
										<form class="kt-form" id="kt_form">
										<div class="kt-wizard-v1__content p-0" data-ktwizard-type="step-content">			<div class="box" style="padding-top: 10px;">											 <div class="ribbon-2">{{ __('customer.License') }}</div>
										</div>																					 <div class="kt-heading kt-heading--md"></div>
										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">																			 
											<div class="kt-wizard-v1__form">			
										<div class="separator separator-dashed separator-border-2 mb-5"></div>							 <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">	   
										<div class="row" style="padding-bottom: 6px;">											
																						 <div class="col-lg-12">
									<div class="form-group row pl-md-3">
										<table class="table table-striped table-hover" id="modeofpaymenttable">
											<thead  style=" background-color: #306584; color: white;">
											<tr>
											<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 30px;">#</th>

												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Document Name</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Expiry Date</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Reminder Days</th>
											
												 <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;
												 width: 30px;">
													<!-- <div class="kt-demo-icon__preview addmorepayments pluseb">
															<i class="fa fa-plus" style="color: white;"></i>
														</div> --></th>
											</tr>
											</thead>
										<tr></tr>
										@if(isset($docs))
											@foreach($docs as $key=>$docs)
											<tr>
					  <td class="row_count" id="rowcount" style="padding: 0;">{{$key+1}}</td>
					  <td style="padding: 0;">
					  <input class="form-control single-select documentname" name="documentname[]" id="documentname{{$key+1}}" data-id={{$key+1}} placeholder="Document Name" value="{{$docs->docname}}">
					  </td>
					  <td style="padding: 0;">
					  <div class="input-group input-group-sm">
					 <input type="text" class="form-control kt_datetimepickerr expirydate" placeholder="Expiration Date" id="expirydate{{$key+1}}" name="expirydate[]" data-id={{$key+1}} value="{{$docs->expdate1}}">
					  </div>
					  </td>
					  <td style="padding: 0;">
					  <div class="input-group input-group-sm">
					  <input type="text" class="form-control days" name="days[]" id="days{{$key+1}}"  data-id={{$key+1}} placeholder="Reminder Days" value="{{$docs->days}}">
					  </div>
						<td style="padding: 0;">
					  <div class="kt-demo-icon__preview remove">
					  <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>
					  </div>
					  </td>
					  </tr>
											@endforeach
										@endif
										</table>
					<table style="width:100%;">
						<tr>
							<td>
								<button type="button" class="addmorepayments pluseb btn btn-brand btn-elevate btn-icon-sm  float-right" ><i class="la la-plus"></i>Add More</button>
							</td>
						</tr>
					</table>
					
									</div>
								</div>								
										</div>														
									</div>														
								</div>														
							</div>													
						<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">												<div class="box" style="padding-top: 10px;">				
<div class="ribbon-2">{{ __('customer.Documents') }}</div>																</div>																				<div class="kt-heading kt-heading--md"></div>										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">																			<div class="kt-wizard-v1__form">													<input type="hidden" name="UniqueID" id="UniqueID" value="{{isset($unq_id)? $unq_id :''}}" />																		<input type="hidden" name="fileData" id="fileData" value="{{isset($documents)? $documents :''}}" />																	<div id="choose-files">												<input type="file" id="files" name="files[]" accept="image/*" /></div>																				</div>																				</div>																				</div>																				<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">																								<div class="box" style="padding-top: 10px;">										<div class="ribbon-2">{{ __('customer.Credit Limit') }}</div>										</div>																				<div class="kt-heading kt-heading--md"></div>										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">																			<div class="kt-wizard-v1__form">													<div class="row">																	<div class="col-lg-6">																<div class="form-group row pr-md-3">												<div class="col-md-4">																<label>{{ __('customer.Number of Invoices') }}</label>	<span style="color: red">*</span>												</div>																				<div class="col-md-8">																<div class="input-group input-group-sm">											<input type="text" class="form-control no_of_invoices" name="no_of_invoices" id="no_of_invoices" placeholder="Number of Invoices " value="{{isset($noinv)? $noinv :''}}">																	
</div>																																															</div>																				</div>																				</div>																				<div class="col-lg-6">																<div class="form-group row pl-md-3">												<div class="col-md-4">																<label>{{ __('customer.Total Amount') }}</label>															</div>																				<div class="col-md-8 input-group input-group-sm">									<div class="input-group input-group-sm">											<input type="text" class="form-control total_amount" placeholder="Total Amount" id="total_amount" name="total_amount" value="{{isset($tamnt)? $tamnt :''}}">							</div>																				</div>																				</div>																				</div>																				<div class="col-lg-6">																<div class="form-group row pr-md-3">												<div class="col-md-4">																<label>{{ __('customer.Credit period of each invoices') }}</label>										</div>																				<div class="col-md-8">																<div class="input-group input-group-sm">											<input type="text" class="form-control credit_period_each_invoice" name="credit_period_each_invoice" id="credit_period_each_invoice" placeholder="Credit period of each invoices" value="{{isset($cpeinv)? $cpeinv :''}}">											</div>																				</div>																																									</div>					
						</div>									
						<div class="col-lg-6">										
						<div class="form-group row pl-md-3">	
						<div class="col-md-4">							
						<label>{{ __('customer.Credit period of Total invoices') }}</label>		
						</div>				
						<div class="col-md-8 input-group input-group-sm">		
						<div class="input-group input-group-sm ">	
						<input type="text" class="form-control credit_period_total_invoice" placeholder="Credit period of Totl invoices" name="credit_period_total_invoice" id="credit_period_total_invoice" value="{{isset($cptinc)? $cptinc :''}}">											
					</div>															</div>															</div>															</div>															</div>															</div>															</div>															</div>			
					<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
					<div class="box" style="padding-top: 10px;">					
					<div class="ribbon-2">{{ __('customer.Contracts') }}</div>																					</div>
					<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">																								
						<div class="kt-wizard-v1__form">								<div class="row">																																									<div class="col-lg-12">																																								<div class="form-group row pl-md-3">						<div class="col-md-2">																																								<label>{{ __('customer.Payment terms') }}</label>																							</div>																													<div class="col-md-10 input-group input-group-sm">																																	<div class="input-group input-group-sm ">																				<select class="form-control single-select" id="payment_terms" name="payment_terms">																
						<option value="">{{ __('supplier.Select') }}</option>@foreach($payment_terms as $item)
																	<option value="{{ $item->id }}" {{ (isset($pterms) && $pterms == $item->id) ? 'selected' : '' }}>{{ $item->term }}</option>
																		@endforeach	</select>																																																	</div>																																									</div>																																									</div>																										</div>																											</div>													
							<div class="row">										
								<div class="col-lg-12">																					
									<label>{{ __('customer.Payment Description') }}</label>							<textarea id="description1" name="description" class="form-control" style="width: 100%;">{{isset($description)? $description :''}}</textarea>																																</div>																							</div>																							</div>																							</div>																							</div>																							
									<div class="kt-form__actions">							<input type="hidden" name="branch" id="branch" value="{{$branch}}">									

									<button class="btn btn-default btn-elevate btn-icon-sm" data-ktwizard-type="action-prev" is="p"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> &nbsp; Previous</button>
									<button class="btn btn-brand btn-elevate btn-icon-sm" data-ktwizard-type="action-submit" id="vendordocumentSubmit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Save
									</button>										
									<button class="btn btn-brand btn-elevate btn-icon-sm" data-ktwizard-type="action-next" id="n">Next Step &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>										</div>											</form>
									</div>
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
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
				CKEDITOR.replace('description1');
</script>
<script src="{{url('/')}}/public/assets/js/pages/custom/wizard/wizard-1.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/crm/vendor.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.js"></script>

<script>
				$('.ktdatepicker').datepicker({
				format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
				$(this).datepicker('hide');
});
	var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
	$(".addmorepayments").click(function() 
		{
		
	  var sl = ($("#modeofpaymenttable > tbody > tr").length);

		   
			var payment = '';
			payment += '<tr>\
					  <td class="row_count" id="rowcount" style="padding: 0;">'+ sl +'</td>\
					  <td style="padding: 0;">\
					  <input class="form-control single-select documentname" name="documentname[]" id="documentname'+rowcount+'" data-id='+rowcount+' placeholder="Document Name">\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					 <input type="text" class="form-control kt_datetimepickerr expirydate" placeholder="Expiration Date" id="expirydate'+rowcount+'" name="expirydate[]" data-id='+rowcount+'>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control days" name="days[]" id="days'+rowcount+'"  data-id='+rowcount+' placeholder="Reminder Days">\
					  </div>\
						<td style="padding: 0;">\
					  <div class="kt-demo-icon__preview remove">\
					  <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>\
					  </div>\
					  </td>\
					  </tr>';
		
					   $('#modeofpaymenttable').append(payment);

					  


  $('#totalrows').val(rowcount); 

					   rowcount++;
					   				 $('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
})

});
				const uppy = Uppy.Core({
				autoProceed: false,
				allowMultipleUploads: true,
		/*  restrictions: {
				maxNumberOfFiles: 1,
				minNumberOfFiles: 1,
				allowedFileTypes: ["image/*"]
		},*/


						meta: {
												vendor_id       : $('#id').val(),
								},
				onBeforeUpload: (files) => {
				fileData = [];
				const updatedFiles = {};

				Object.keys(files).forEach(fileID => {
				
					fileData.push('vendordocumentInfoData/'+$('#id').val()+'/'+files[fileID]
					.name)

				})
				//return updatedFiles
				$('#fileData').val(fileData);

				},

	})

	uppy.use(Uppy.Dashboard, {
				metaFields: [
				{ id: 'name', name: 'Name', placeholder: 'File name' },
				{ id: 'caption', name: 'Caption', placeholder: 'Describe what the image is about.' }
				],
				browserBackButtonClose: true,
				target: '#choose-files',
				inline: true,
				replaceTargetContent: true,
				width:'100%'
	})
	// uppy.use(Uppy.GoogleDrive, {
	//    target: Uppy.Dashboard,
	//    companionUrl: 'https://companion.uppy.io'
	// })
	uppy.use(Uppy.Webcam, { target: Uppy.Dashboard })
	uppy.use(Uppy.XHRUpload, {
				endpoint: 'vendordocumentFileUpload',
				// UniqueID       : $('#UniqueID').val(),
				fieldName: 'filenames[]',
				headers: {
				'X-CSRF-TOKEN': $('#token').val(),
					UniqueID       : $('#UniqueID').val(),
				}
	})

	if ($('#fileData').val() != '') {
				var img_array = $('#fileData').val().split(",");
			// console.log(img_array);
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


//



uppy.on('file-removed', (file, reason) => {
			// removeFileFromUploadingCounterUI(file)
var file1name='vendordocumentInfoData/'+$('#id').val()+'/'+file.name;
var ofile=file.name;


			var dimg=removeValue( $('#fileData').val(), file1name,',');
				$('#fileData').val(dimg);
				//

				$.ajax({
				type: "POST",
				url: "vendordocumentDelete",
				dataType: "json",
				data: {
				_token: $('#token').val(),
				vendor_id: $('#id').val(),
				file1name: file1name,
				ofile: ofile,
				docs: $('#fileData').val()

				},
				success: function(data) {
				toastr.success('Document deleted successfuly');
				},
				error: function(jqXhr, json, errorThrown) {
				var errors = jqXhr.responseJSON;
				var errorsHtml = '';
				$.each(errors, function(key, value) {
				if (jQuery.isPlainObject(value)) {

				$.each(value, function(index, ndata) {
					errorsHtml += '<li>' + ndata + '</li>';
				});

				} else {

				errorsHtml += '<li>' + value + '</li>';

				}
				});
				toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
				}
	});

				//



})


var removeValue = function(list, value, separator) {
		separator = separator || ",";
		var values = list.split(separator);
		for(var i = 0 ; i < values.length ; i++) {
				if(values[i] == value) {
						values.splice(i, 1);
						return values.join(separator);
				}
		}
		return list;
}

</script>
<script type="text/javascript">
				
				$(document).on('click', '#vendordocumentSubmit', function(e) {
				e.preventDefault();
				
					$(this).removeClass('kt-spinner');
			
				var no_of_invoices = $('#no_of_invoices').val();
				var total_amount = $('#total_amount').val();
				var credit_period_each_invoice = $('#credit_period_each_invoice').val();
				var credit_period_total_invoice = $('#credit_period_total_invoice').val();
				var payment_terms = $('#payment_terms').val();
	
				var description = CKEDITOR.instances['description1'].getData();

		
				if (no_of_invoices == "") {
	$('#no_of_invoices').addClass('is-invalid');
	toastr.warning('Number Of Invoice is required.');
	$("#credit_limit").trigger("click");
	return false;
	} else {
	$('#no_of_invoices').removeClass('is-invalid');
	}
				var documentname = [];

		        $("input[name^='documentname[]']")
		        .each(function(input) {
		            documentname.push($(this).val());
		        });
		         var expirydate = [];

		        $("input[name^='expirydate[]']")
		        .each(function(input) {
		            expirydate.push($(this).val());
		        });
		         var days = [];

		        $("input[name^='days[]']")
		        .each(function(input) {
		            days.push($(this).val());
		        });


				$.ajax({
								type: "POST",
								url: "vendordocumentSubmit",
								dataType: "json",
								data: {
												_token: $('#token').val(),
												vendor_id: $('#id').val(),
												
												no_of_invoices: $('#no_of_invoices').val(),
												total_amount: $('#total_amount').val(),
												credit_period_each_invoice: $('#credit_period_each_invoice').val(),
												credit_period_total_invoice: $('#credit_period_total_invoice').val(),
												payment_terms: $('#payment_terms').val(),
												description: $('#description1').val(),
												fileData:$('#fileData').val(),
												description : description,
												branch : $('#branch').val(),
												documentname : documentname,
		  								expirydate : expirydate,
		  								days : days


								},
								success: function(data) {
												toastr.success('customer documents updated successfuly');
												window.location.href = "vendordocuments";

								},
								error: function(jqXhr, json, errorThrown) {
												var errors = jqXhr.responseJSON;
												var errorsHtml = '';
												$.each(errors, function(key, value) {
																if (jQuery.isPlainObject(value)) {

																				$.each(value, function(index, ndata) {
																								errorsHtml += '<li>' + ndata + '</li>';
																				});

																} else {

																				errorsHtml += '<li>' + value + '</li>';

																}
												});
												toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
								}
				});

				return false;

});

$(document).ready(function(){
								$('.single-select').select2();
				});
	
								$(document.body).on("change", "#payment_terms", function() {
				var grp_id = this.value;

				$.ajax({
								url: "getpayterms",
								method: "POST",
								data: {
												_token: $('#token').val(),
												grp_id: grp_id
								},
								dataType: "json",
								success: function(data) {
												CKEDITOR.instances['description1'].setData(data['payterm'].description);
								}
				})


});

		$(document.body).on("keyup  change", ".no_of_invoices", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });
$(document.body).on("keyup  change", ".total_amount", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });
$(document.body).on("keyup  change", ".credit_period_each_invoice", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });
$(document.body).on("keyup  change", ".credit_period_total_invoice", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });

</script>
@endsection