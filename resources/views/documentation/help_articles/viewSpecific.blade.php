@extends('documentation.common.layout')
<style type="text/css">
	.active {
		background-color: blue !important;
		color: white;
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
							<button type="button" class="btn btn-secondary mr-2 backHome"> <i class="la la-undo"></i>Back</button>
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
							<div class="accordion" id="accordionExample1">
								@foreach($article as $articles)
								<div class="card">
									<div class="card-header" id="">
										<div class="card-title" data-toggle="collapse" data-target="#article{{$articles->id}}" aria-expanded="true" aria-controls="article{{$articles->id}}">
											{{$articles->title}}
										</div>
									</div>
									<div id="article{{$articles->id}}" class="collapse show" aria-labelledby="" data-parent="#accordionExample1">
										<div class="card-body">
											<?php echo $articles->notes; ?>
										</div>
									</div>
								</div>
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