@extends('crm.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<link href="{{ URL::asset('assets') }}/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content" style="padding-bottom: 0;">
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">Wizard 1 </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs"> <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="" class="kt-subheader__breadcrumbs-link">Pages </a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="" class="kt-subheader__breadcrumbs-link">Wizard 1 </a>
				</div>
			</div>
			<div class="kt-subheader__toolbar">
				<div class="kt-subheader__wrapper"> <a href="#" class="btn kt-subheader__btn-primary">Back
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
								<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
									<div class="kt-wizard-v1__nav-body">
										<div class="kt-wizard-v1__nav-icon"> <i class="flaticon-bus-stop"></i> </div>
										<div class="kt-wizard-v1__nav-label">{{ __('salesman.Key Accounts Information') }}</div>
									</div>
								</div> <!--  <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">                                                                                                                                                    <div class="kt-wizard-v1__nav-body">                                                                                                                                                                              <div class="kt-wizard-v1__nav-icon"> <i class="flaticon-list"></i>                                                                                                                                                                        </div>                                                                                                                  <div class="kt-wizard-v1__nav-label">Accounting Configuration</div>
	</div>                                                                                                                                                                        </div> -->
							</div>

							<input type="hidden" class="form-control" value="{{$branch}}" id="branch" name="branch">
							<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
								<form class="kt-form" id="kt_form">
									<div class="kt-wizard-v1__content p-0" data-ktwizard-type="step-content">
										<div class="box" style="padding-top: 10px;">
											<div class="ribbon-2">{{ __('salesman.Key Accounts') }}</div>
										</div>
										<div class="kt-heading kt-heading--md"></div>
										<div class="kt-form__section kt-form__section--first w3-animate-right" id="animation">
											<div class="kt-wizard-v1__form">
												<div class="separator separator-dashed separator-border-2 mb-5"></div>
												<div class="row" style="padding-bottom: 6px;">
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('salesman.Name') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control" placeholder="{{ __('salesman.Name') }} " id="name" name="name" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('salesman.Email') }}<span style="color: red">*</span></label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control" placeholder="{{ __('salesman.Email') }} " id="email" name="email" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('salesman.Address Line 1') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control" placeholder="{{ __('salesman.Address 1') }}" id="address1" name="address1">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('salesman.Address Line 2') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control" placeholder="{{ __('salesman.Address 2') }}" id="address2" name="address2" data-wheelcolorpicker="" autocomplete="off" style="padding-top: 0px;">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('salesman.Address Line 3') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control" placeholder="{{ __('salesman.Address 3') }} " id="address3" name="address3">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('salesman.Zip Code') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control" placeholder="{{ __('salesman.Zip') }} " id="zip" name="zip" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pl-md-3">
															<div class="col-md-4">
																<label>{{ __('salesman.Region') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control" placeholder="{{ __('salesman.Region') }} " id="region" name="region" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group row pr-md-3">
															<div class="col-md-4">
																<label>{{ __('salesman.Country') }}</label>
															</div>
															<div class="col-md-8">
																<div class="input-group input-group-sm">
																	<select name="country" id="country" class="form-control single-select kt-selectpicker">
																		<option value="">{{ __('customer.Select') }}
																		</option>@foreach($country as $coun)
																		<option value="{{$coun->id}}">
																			{{$coun->cntry_name}}
																		</option>@endforeach
																	</select>

																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group row pl-md-3">
															<div class="col-md-12">
																<label>Signature</label>
															</div>
															<div class="col-md-12 ">

																<input type="hidden" name="fileData" value="" id="signature" />
																<div id="choose-files">
																	<form action="/upload">
																		<input type="file" id="files" name="files[]" accept="image/*" />
																	</form>
																</div>

															</div>
														</div>
													</div>


												</div>
											</div>
										</div>

										<div class="kt-portlet__foot">

											<div class="row">

												<div class="col-lg-12 p-0 kt-align-right">

													<button type="reset" class="btn btn-secondary btn-icon-sm" onclick="goPrev()">
														<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
															<line x1="18" y1="6" x2="6" y2="18"></line>
															<line x1="6" y1="6" x2="18" y2="18"></line>
														</svg>
														@lang('app.Cancel')
													</button>
													<button type="submit" class="btn btn-primary btn-icon-sm" id="keySalesmandetails_Submit">
														<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
															<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
															<polyline points="22 4 12 14.01 9 11.01"></polyline>
														</svg>
														@lang('app.Save')
													</button>

												</div>
											</div>

										</div>


								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- </div>
</div> -->
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('.kt-select2').select2();
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
				fileData.push('signature/' + files[fileID].name)
			})
			//return updatedFiles
			$('#signature').val(fileData);

		},

	})

	uppy.use(Uppy.Dashboard, {
		metaFields: [{
				id: 'name',
				name: 'Name',
				placeholder: 'File name'
			},
			{
				id: 'caption',
				name: 'Caption',
				placeholder: 'describe what the image is about'
			}
		],
		browserBackButtonClose: true,
		target: '#choose-files',
		inline: true,
		replaceTargetContent: true,
		width: '100%'
	})
	uppy.use(Uppy.Webcam, {
		target: Uppy.Dashboard
	})
	uppy.use(Uppy.XHRUpload, {
		endpoint: 'signatureupload',
		// UniqueID       : $('#UniqueID').val(),
		fieldName: 'filenames[]',
		headers: {
			'X-CSRF-TOKEN': $('#token').val(),
			// UniqueID       : $('#UniqueID').val()
		}
	})

	if ($('#signature').val() != '') {
		var img_array = $('#signature').val().split(",");
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


<script type="text/javascript">
	$('#email').focusout(function() {
		$('#email').filter(function() {
			var email = $('#email').val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if (!emailReg.test(email)) {
				$('#email').val("");
				toastr.warning('Please enter valid email.');
			}
		});
	});
	// $(document).on('change','.email',function()
	//   {

	// 		var email=$(this).val();
	// 	$.ajax({
	// 		 type:'POST',
	// 		 url:'getsalesmanemail',
	// 		 data:{
	// 			_token: $('#token').val(),
	// 			'id':email
	// 		},
	// 		 success:function(data){
	// 			console.log(data);
	// 			if(data!=0)
	// 			{
	// 					toastr.warning('Username already exist');
	// 					$('#email').val("");

	// 			}
	// 		 },
	// 		 error:function()
	// 		 {
	// 		 }
	// 	});


	//   });
</script>
<script src="{{url('/')}}/public/assets/js/pages/custom/wizard/wizard-1.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/crm/salesmandetails.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/select2.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.js"></script>
<script>
	$('.keysalesmandetailssettings').addClass('kt-menu__item--active');
</script>
@endsection