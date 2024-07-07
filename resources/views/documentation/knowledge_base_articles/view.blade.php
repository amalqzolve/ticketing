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
foreach($basearticle as $basearticle1)
{
	
	$category = $basearticle1->category;
	
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
				Base Articles
				</h3>
			</div>
		</div> 

		<div class="kt-portlet__body">
	<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop">
     	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-4" >
            	<input class="form-control" type="text" name="title_search" id="title_search" placeholder="search.....">
            	<div id="titleList" style="position:absolute;">
    									</div>
               <!--  <select class="form-control single-select kt-selectpicker">
																		 <option>Search</option>
																		 	@foreach($basearticletitles as $basearticletitless)
																		 <option value="{{$basearticletitless->category}}">{{$basearticletitless->title}}</option>
																		 @endforeach
																</select> -->
														<br><br>
                    <ul class="list-group">
                    	@foreach($basecategories as $basecategories)
                   <a class="card-header @if($basecategories->id == $category) active @endif" data-id="{{$basecategories->id}}" href="basearticleview?cid={{$basecategories->id}}">{{$basecategories->title}}</a>
                        @endforeach
                    </ul>
                </div>
           
            <div class="col-lg-8">
            	<div class="accordion" id="accordionExample1">
                    	@foreach($basearticle as $basearticle)

            	<div class="card">
													<div class="card-header" id="">
														<div class="card-title" data-toggle="collapse" data-target="#basearticle{{$basearticle->id}}" aria-expanded="true" aria-controls="basearticle{{$basearticle->id}}">
															{{$basearticle->title}}
														</div>
													</div>
													<div id="basearticle{{$basearticle->id}}" class="collapse" aria-labelledby="" data-parent="#accordionExample1">
														<div class="card-body">
															<?php echo $basearticle->notes;?>
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> -->

<!-- <script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    console.log(path);
    $('#title_search').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script> -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript">
</script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript">
</script>
 
<script type="text/javascript">
$(document).ready(function(){

 $('#title_search').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:'autocomplete_base',
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#titleList').fadeIn();  
                    $('#titleList').html(data);
          }
         });
        }
        else
        {
        	$('#titleList').fadeOut();
        }
    });

    $(document).on('click', 'li', function(){  
        $('#title_search').val($(this).text());  
        $('#titleList').fadeOut();  
    });  

});

</script>


@endsection