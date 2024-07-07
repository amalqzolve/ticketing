@extends('documentation.common.layout')

@section('content')
<style>
	.tox-tinymce {
		width: 99% !important;
	}
</style>
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
		</div>
	</div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Edit Article
				</h3>
			</div>
		</div>
		@foreach($article as $article)
		<div class="kt-portlet__body">
			<form class="kt-form kt-form--label-right" id="group-form" name="group-form" method="POST">
				@csrf
				<div class="kt-portlet__body">
					<input type="hidden" name="id" id="id" value="{{$article->id}}">
					<div class="form-group row">

						<div class="col-lg-6">
							<div class="form-group row pr-md-4">
								<div class="col-md-3">
									<label for="floatingSelect">Category</label>
								</div>
								<div class="col-md-9 ">
									<div class="input-group  input-group-sm form-floating">
										<select class="form-control single-select kt-selectpicker" id="help_category" aria-label="Floating label select example" name="help_category" style="border-color: #e5e8ee; display: inline-block;height: 28px;width: 100%;">
											<option value="">Select</option>
											@foreach($categories as $categories)
											<option value="{{$categories->id}}" <?php
																				if ($categories->id == $article->category) {
																					echo "selected";
																				}

																				?>>
												{{$categories->title}}
											</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group row pl-md-4">
								<div class="col-md-3">
									<label>Title</label>
								</div>
								<div class="col-md-9 ">
									<div class="input-group  input-group-sm">
										<input type="text" class="form-control" placeholder="Title" id="title" name="title" autocomplete="off" value="{{$article->title}}">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">

						<div class="col-lg-6">
							<div class="form-group row pr-md-4">
								<div class="col-md-3">
									<label>Sort</label>
								</div>
								<div class="col-md-9 ">
									<div class="input-group  input-group-sm">
										<input type="number" class="form-control" placeholder="Sort" id="sort" name="sort" data-wheelcolorpicker="" autocomplete="off" style="padding-top: 0px;" value="{{$article->sort}}">
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="col-lg-6">
							<div class="form-group row pl-md-4 ">
								<div class="col-md-3">
									<label>Status</label>
								</div>
								<div class="col-md-9 ">
									<div class="input-group  input-group-sm ">
										<input type="radio" name="status" value="Active" <?php if ($article->status == "Active") echo "checked"; ?> id="status_active" style="margin-right: 8px;">
										<label for="status_active" class="form-check-label">Active</label>
										<input type="radio" name="status" value="Inactive" id="status_inactive" style="margin-right: 8px; margin-left: 15px;" <?php if ($article->status == "Inactive") echo "checked"; ?>>
										<label for="status_inactive" class="form-check-label">Inactive</label>
									</div>
								</div>
							</div>
						</div> -->

						<div class="col-lg-6">
							<div class="form-group row pl-md-4">
								<div class="col-md-3">
									<label>Sort</label>
								</div>
								<div class="col-md-9 ">
									<div class="input-group  input-group-sm">
										<select class="form-control single-select kt-selectpicker" id="status" aria-label="Floating label select example" name="status" style="border-color: #e5e8ee; display: inline-block;height: 28px;width: 100%;">
											<option value="Active" {{($article->status == "Active")?'selected':''}}>Active</option>
											<option value="Inactive" {{($article->status == "Inactive")?'selected':''}}>Inactive</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group row mt-3">
								<div class="col-md-12">
									<label for="floatingSelect">Notes</label>
								</div>
								<div class="col-md-12">
									<div class="kt-tinymce">
										<textarea id="kt-tinymce-4" name="notes" class="tox-target">
										{{-- name="kt-tinymce-4" --}}{{$article->notes}}
										</textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group row  pl-md-3">&nbsp;</div>
						</div>

						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-6"></div>
								<div class="col-lg-6 kt-align-right">
									<button type="button" class="btn btn-secondary " style="margin-left: 15px" onclick="history.back()">
										<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
											<line x1="18" y1="6" x2="6" y2="18"></line>
											<line x1="6" y1="6" x2="18" y2="18"></line>
										</svg> Cancel
									</button>
									&nbsp;
									<button id="help_article_submit" class="float-right btn btn-brand kt-spinner--left kt-spinner--sm kt-spinner--light">
										<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
											<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
											<polyline points="22 4 12 14.01 9 11.01"></polyline>
										</svg>
										&nbsp;Save
									</button>

								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		@endforeach
	</div>
</div>

<style type="text/css">
	.hideButton {
		display: none
	}

	.error {
		color: red
	}

	.tox-tinymce {
		width: 98%;
	}
</style>

@endsection

@section('script')

<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript">
</script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript">
</script>

<script type="text/javascript">
	$('.help_support').addClass('kt-menu__item--open');
	$('.help_articles').addClass('kt-menu__item--active');
	$(document).on('click', '#help_article_submit', function(e) {
		e.preventDefault()

		title = $('#title').val();
		category = $('#help_category').val();
		notes = $('#notes').val();
		sort = $('#sort').val();

		if (title == "") {
			$('#title').addClass('is-invalid');
			toastr.warning('Title is Required');
			return false;
		} else
			$('#title').removeClass('is-invalid');

		if (category == "") {
			$('#help_category').next().find('.select2-selection').addClass('select-dropdown-error');
			toastr.warning('Category is Required');
			return false;
		} else {
			$('#help_category').next().find('.select2-selection').removeClass('select-dropdown-error');
		}

		if (sort == "") {
			$('#sort').addClass('is-invalid');
			toastr.warning('Sort is Required');
			return false;
		} else
			$('#sort').removeClass('is-invalid');
		$('#help_article_submit').addClass('kt-spinner');

		$.ajax({
			type: "POST",
			url: "help_article_submit",
			dataType: "json",

			data: {
				_token: $('#token').val(),
				id: $('#id').val(),
				title: $('#title').val(),
				category: category,
				notes: tinyMCE.activeEditor.getContent(),
				sort: $('#sort').val(),
				status: $('input[name="status"]:checked').val()
			},

			success: function(data) {
				if (data.status == 1) {
					$('#help_article_submit').removeClass('kt-spinner');
					toastr.success('Help article Updated successfuly');
					window.location.href = "help_articles";
				} else {
					if (data.status == 2) {
						$('#title').addClass('is-invalid');
						toastr.error(data.msg);
					}
					if (data.status == 3) {
						$('#sort').addClass('is-invalid');
						toastr.error(data.msg);
					}
				}


			},
			error: function(jqXhr, json, errorThrown) {
				console.log('Error !!');
			}

		});
	});
</script>


@endsection