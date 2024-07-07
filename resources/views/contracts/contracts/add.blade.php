@extends('operations.common.layout')

@section('content')
<!-- <link href="{{url('/')}}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->

<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.form-control {
    height: calc(1.4em + 1rem + 2px);
}
</style>
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
                                   <div class="kt-subheader__breadcrumbs">

										<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

										<span class="kt-subheader__breadcrumbs-separator"></span>

									   
									</div>
								</div>
								<div class="kt-subheader__toolbar">
                            <div class="kt-subheader__wrapper">
                                <a href="#" class="btn kt-subheader__btn-primary">
                                    @lang('app.Back') 
                                </a>
                                <a href="trash_purchase" class="btn btn-secondary btn-hover-warning">
                                    @lang('app.Trash ')

                                </a>
                               
                            </div>
                        </div>
							</div>
						</div>

	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">

											Contract

										</h3>
									</div>
									
								</div>

								<div class="kt-portlet__body">

<!--begin: Datatable -->

	@csrf
	<?php
	$date = date('d-m-Y h:i');
	?>
	
<div class="row">
	<div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Customer') </label>
										</div> 
										<div class="col-md-8  input-group-sm">
									<select class="form-control single-select kt-selectpicker customer" name="customer" id="customer"> 
									<option value="">Select</option>

									@foreach($customers as $customerss) 
										<option value="{{$customerss->id}}">{{$customerss->cust_name}}</option>
										@endforeach
									</select>               
										</div>
										</div>
									  </div>

									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>Contract Name</label>
										</div> 
										<div class="col-md-8  input-group-sm">
									<input type="text" class="form-control" name="contractname" id="contractname">   
									              
										</div>
										</div>
									  </div>
									  

									  <div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Contract Starting Date </label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control kt_datetimepickerr" name="startingdate" id="startingdate">              
										</div>
										</div>
										</div>

										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Contract Ending Date </label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control kt_datetimepickerr" name="endingdate" id="endingdate">              
										</div>
										</div>
										</div>

										
									  <div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>Contract Amount</label>
										</div> 
										<div class="col-md-8  input-group-sm">
									<input type="text" class="form-control" name="contractamount" id="contractamount">   
									              
										</div>
										</div>
									  </div>
									  <div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>Contract Vat Amount</label>
										</div> 
										<div class="col-md-8  input-group-sm">
									<input type="text" class="form-control" name="contractvatamount" id="contractvatamount">   
									              
										</div>
										</div>
									  </div>
									  <div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>Contract Number</label>
										</div> 
										<div class="col-md-8  input-group-sm">
									<input type="text" class="form-control" name="contractno" id="contractno">   
									              
										</div>
										</div>
									  </div>
   
									  <div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Contract Reference</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<select class="form-control single-select kt-selectpicker contractreference" name="contractreference" id="contractreference" >   
								<option value="">Select</option>            
									 
										<option value="1">Sales Quotation</option>
										<option value="2">Sales Order</option>
										<option value="3">Sales Invoice</option>
										
								</select>
										</div>
										</div>
										</div>
										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Reference ID</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<select class="form-control single-select kt-selectpicker" name="invoice_no" id="invoice_no" >   
								<option value="">Select</option>            
									 
										
										
								</select>
										</div>
										</div>
										</div>

										

										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Notes</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<textarea class="form-control" name="notes" id="notes"  >   </textarea>            
										</div>
										</div>
										</div>
									
									<div class="col-lg-12">
								
									<label>@lang('app.Attach File(s) for pdf')</label>
									
										 
								   <input type="hidden" name="fileData" id="fileData"/>
								   <div id="choose-files">
								   <form action="/upload">
								   <input type="file" id="files" name="files[]" accept="image/*"/>
									</form>
								  
									</div>  
									</div>                    
							

										</div>


										<!-- <div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Transaction Type')</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   <select class="form-control single-select kt-selectpicker" id="transactiontype" name="transactiontype">
										<option value="">select</option>
										<option value="1" selected="">Debit</option>
										<option value="2">Credit</option>


											</select>  
								               
										</div>
										</div>
										</div> -->
										
									</div>
										
							<div class="kt-portlet__foot pr-0">
								<div class="row">
								<div class="col-lg-12 p-0 kt-align-right">
	  <!-- <button type="button" id="creditinvoice_pay" class="btn btn-primary" style="float:right;" disabled="">Submit</button> -->

	  <button type="reset" class="btn btn-secondary backHome"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>  &nbsp;Cancel</button>


	  <button type="button" class="btn btn-primary" id="contracts_submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>   &nbsp;Save</button>



</div>
							</div></div></div>

										
										
										

										


</div>

<!--end: Datatable -->

								</div>
							</div>
						</div></div>





<style type="text/css">
	.hideButton{
       display: none
	}
	.error{
		color: red
	}
</style>
<!--end::Modal-->
@endsection
@section('script')
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script type="text/javascript">
	$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

    // 	     $(".kt_datetimepickerr").datetimepicker({
//     format: 'dd-mm-yyyy'

// }).on('changeDate', function(e){
//     $(this).datetimepicker('hide');
// });

$(document.body).on("change", ".contractreference", function() 
	{
		var contractreference = $('#contractreference').val();
		
			$.ajax({
					url: "contractreference_id",
					method: "POST",
					data: {
						_token: $('#token').val(),
						id:contractreference
					},
					dataType: "json",
					success: function(data) {
						console.log(data);
						$('select[name="invoice_no"]').empty();
						
			$('select[name="invoice_no"]').append('<option value="">select</option>');
						$.each(data, function(key, value) {
									$('select[name="invoice_no"]').append('<option value="'+ value.id +'">'+ value.id +'</option>');

									});
					}
				})				
	});


//



const uppy = Uppy.Core({
		autoProceed: false,
		allowMultipleUploads: false,
		// meta: {
		//         UniqueID       : $('#UniqueID').val()
		//     },
		onBeforeUpload: (files) => {
			fileData = [];
			const updatedFiles = {};

			Object.keys(files).forEach(fileID => {
					fileData.push('contract/' + files[fileID].name)
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
	uppy.use(Uppy.GoogleDrive, {
		target: Uppy.Dashboard,
		companionUrl: 'https://companion.uppy.io'
	})
	uppy.use(Uppy.Webcam, { target: Uppy.Dashboard })
	uppy.use(Uppy.XHRUpload, {
		endpoint: 'contractFileUpload',
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

</script>
	
</script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/contracts.js" type="text/javascript"></script>

@endsection
