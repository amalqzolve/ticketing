@extends('documentation.common.layout')

@section('content')

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
					Add new article (Help)
				</h3>
			</div>
		</div> 
@foreach($article as $article)
<input type="hidden" name="id" id="id" value="{{$article->id}}">
		<div class="kt-portlet__body">
			<form class="kt-form kt-form--label-right" id="group-form" name="group-form" method="POST">
					@csrf
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-6">
										<label>{{ __('customer.Title') }}</label>
									</div>
									<div class="col-md-6 pl-4">
										<div class="input-group  input-group-sm">
											<input type="text" class="form-control" placeholder="{{ __('customer.Title') }} " id="title" name="title" autocomplete="off" value="{{$article->title}}">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-6">
										<label for="floatingSelect">Category</label>
									</div>
									<div class="col-md-6 pl-4">
										<div class="input-group  input-group-sm form-floating" >

											<select  class="form-control single-select kt-selectpicker" id="category" name="category" aria-label="Floating label select example" style="border-color: #e5e8ee; display: inline-block;height: 28px;width: 100%;" >
												<option value="">select</option>
												@foreach($category as $category)
												<option value="{{$category->id}}"
													<?php if($category->id == $article->category) echo "selected";?>
													>{{$category->title}}</option>
												@endforeach
											</select>
											
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="row">
									<div class="col-md-6">
										<label for="floatingSelect">Notes</label>
									</div>
									<div class="col-md-6">
										<div class="kt-tinymce">
											<textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target">{{$article->notes}}
											</textarea>
									</div>
								</div>
							</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group row pr-md-3" style="margin-top: 20px;">
									<div class="col-md-6">
										<label>Sort</label>
									</div>
									<div class="col-md-6 pl-4">
										<div class="input-group  input-group-sm">
											<input type="number" class="form-control" placeholder="Sort" id="sort" name="sort" data-wheelcolorpicker="" autocomplete="off" style="padding-top: 0px;" value="{{$article->sort}}">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group row  pr-md-3">
									<div class="col-md-6">
										<label>Status</label>
									</div>
									<div class="col-md-6 pl-4">
										<div class="input-group  input-group-sm ">
											<input type="radio" name="status" value="Active" <?php if($article->status == "Active") echo "checked";?> id="status_active" style="margin-right: 8px;">
											<label for="status_active" class="form-check-label">Active</label>
											<input type="radio" name="status" value="Inactive" id="status_inactive" <?php if($article->status == "Inactive") echo "checked";?> style="margin-right: 8px; margin-left: 15px;">
											<label for="status_inactive" class="form-check-label">Inactive</label>
										</div>
									</div>
									<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-6"></div>
								<div class="col-lg-6 kt-align-right">
									<button type="submit" name="base_article_submit" id="base_article_submit" class="btn btn-primary">Save</button>
									<button type="button" class="btn btn-secondary float-right" style="margin-left: 15px">Cancel</button>
								</div> 
							</div>
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
	.tox-tinymce{
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

		$(document).on('click', '#base_article_submit', function(e){
		e.preventDefault()
		
		title = $('#title').val();
		category = $('#category').val();
		notes = $('#notes').val();
		sort = $('#sort').val();
		//alert(category); return false;
    	$.ajax({
    		type: "POST",
    		url: "knowledge_article_submit",
    		dataType: "json",

    		data: {
    			_token		: 	$('#token').val(),
          		id 			: 	$('#id').val(),
          		title 		: 	$('#title').val(),
          		category 	: 	category,
				notes 		: 	tinyMCE.activeEditor.getContent(),
          		sort 		: 	$('#sort').val(),
          		status: $('input[name="status"]:checked').val()
        	},

        	success:function(data){
        		if(data){
            	
            	toastr.success('Knowledge article added successfuly');

            	window.location.href = "knowledge_base_articles";
            /*	help_article_list_table.ajax.reload();*/
           
        		}

        		
        	},
        	error: function(jqXhr, json, errorThrown) {
         		console.log('Error !!');
        	}
        
    	});
	});

	
</script>


@endsection