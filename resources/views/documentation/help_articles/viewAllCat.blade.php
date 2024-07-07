@extends('documentation.common.layout')
<style type="text/css">
	.active {
		background-color: #0000ff0a !important;
		color: gray;
		border-left: 2px solid #4e5e6a !important;
		text-indent: -2px;
		background: rgba(0, 0, 0, 0.02);
	}
</style>
@section('content')
<?php
$category = "";
foreach ($article as $articles1) {

	$category = $articles1->category;
}
?>

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
					Articles
				</h3>
			</div>

			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-secondary mr-2 backHome" > <i class="la la-undo"></i>Back</button>
						</div>&nbsp;
					</div>
				</div>
			</div>
		</div>

		<div class="kt-portlet__body">
			<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<input class="form-control" type="text" name="title_search" id="title_search" placeholder="search.....">
							<div id="titleList" style="position:absolute;">
							</div>
							<br>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">

							<h4>Categories</h4>
							<ul class="list-group">
								@foreach($categories as $categories)
								<a class="card-header {{($categories->id == $cid)? 'active':''}}" data-id="{{$categories->id}}" href="helparticleview?cid={{$categories->id}}">{{$categories->title}}</a>
								@endforeach
							</ul>
						</div>

						<div class="col-lg-8 row">
							<div class="accordion spec" id="accordionExample1"></div>

							<div class="col-12 ist-group">
								<!-- <span class="mb-3">
									<h3>Guidelines</h3>
									Description about how to work with our team.
								</span> -->
								<br>
								@foreach($article as $articles)
								<a href='helparticleview?id={{$articles->id}}&cid={{$articles->category}}' class="pl-0 list-group-item border-0 text-dark w-100 text-left">
									<i class="fa fa-arrow-right"></i>&nbsp; &nbsp; &nbsp; {{$articles->title}}
								</a>
								@endforeach
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<style type="text/css">

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
	$(document).ready(function() {

		$('#title_search').keyup(function() {
			var query = $(this).val();
			if (query != '') {
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: 'autocomplete_help',
					method: "POST",
					data: {
						query: query,
						_token: _token
					},
					success: function(data) {
						$('#titleList').fadeIn();
						$('#titleList').html(data);
					}
				});
			} else {
				$('#titleList').fadeOut();
			}
		});

		$(document).on('click', 'li', function() {
			$('#title_search').val($(this).text());
			$('#titleList').fadeOut();
		});

	});
</script>


@endsection