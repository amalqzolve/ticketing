@extends('settings.common.layout')

@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/jquery.inputpicker.css" rel="stylesheet" type="text/css" />



<style type="text/css">
	.form-group {
	margin-bottom: 1rem;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
	padding: 8px;
	line-height: 1.42857143;
	vertical-align: top;
	border-top: 1px solid #ddd;
}
div.new1 {
	   background-color: #f2f3f8;
	height: 20px;


	width: 100%;

	right: -36px;
	position: absolute;
	display: block;
}
.pluseb
{
	background-color: #5d78ff;
	height: 100%;
	padding-top: 22%;
}
.pluseb:hover
{
	background-color: #2a4eff;

}
.inputpicker-overflow-hidden
{
	width: 100%;
}

.inputpicker-input
{
	height: calc(1.5em + 1rem + 2px);
}

.inputpicker-arrow
{
		top: 6px;
		right: 9px;
}
.inputpicker-wrapped-list .inputpicker-active
{
	color: white;
}
table.small > thead
{
	font-weight: bold;
}
.inputpicker-arrow b
{
		width: 11px;
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
											Document Settings
										</h3>
									</div>

								</div>

								<div class="kt-portlet__body">

								<form class="kt-form" id="kt_form">
								<ul class="nav nav-tabs">

								  <li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#menu1">Seal</a>
								  </li>
								<?php $seal=""; ?>
								  @php foreach ($seals as $key => $value) {

								   $seal =isset($value->seal)? $value->seal :'';
								  		} @endphp
								</ul>
								<div class="tab-content">

								<div class="tab-pane container active" id="menu1">
									 <div class="row" style="padding-bottom: 6px;">
									<div class="col-lg-12">
									<div class="form-group row pl-md-3">
									<div class="col-md-12">
									<label>@lang('app.Attach File(s) for pdf')</label>
									</div>
									<div class="col-md-12 ">

								   <input type="hidden" name="fileData" value="{{$seal}}" id="fileData"/>
								   <div id="choose-files">
								   <form action="/upload">
								   <input type="file" id="files" name="files[]" accept="image/*"/>
									</form>
								   </div>

									</div>
									</div>
									</div>
								 </div>
								 </div>


<input type="hidden" name="branch" id="branch" value="{{$branch}}">
								 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">

														</div>
														<div class="col-lg-6 kt-align-right">

															<button type="reset" class="btn btn-secondary btn-icon-sm" onclick="goPrev()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                @lang('app.Cancel')
                                                            </button>
                                                            <button type="reset" class="btn btn-primary btn-icon-sm" id="seal_submit">
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
<!--end::Modal-->

@endsection

@section('script')
<script src="{{ URL::asset('assets') }}/plugins/jquery.inputpicker.js" type="text/javascript"></script>
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
					fileData.push('seal/' + files[fileID].name)
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
		endpoint: 'sealupload',
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





function goPrev()
	{
  window.history.back();
  }

$(document).on('click', '#seal_submit', function(e) {
	e.preventDefault();

	$.ajax({
		type: "POST",
		url: "seal_submit",
		dataType: "json",
		data: {
			_token: $('#token').val(),
			id: $('#id').val(),

			fileData: $('#fileData').val(),
			branch : $('#branch').val(),
		},
		success: function(data) {
			// uppy.reset();


			$('#seal_submit').removeClass('kt-spinner');
			$('#seal_submit').prop("disabled", false);
			toastr.success('Sucessfully added');

			// swal.fire("Done", "Submission Sucessfully", "success");
			location.reload();
			window.location.href = "seal";

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

</script>

<script src="{{url('/')}}/resources/js/custom/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/custom/select2.min.js" type="text/javascript"></script>


@endsection
