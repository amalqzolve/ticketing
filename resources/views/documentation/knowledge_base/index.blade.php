@extends('documentation.common.layout')

@section('content')

<div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    


                                    <div class="kt-subheader__breadcrumbs">

                                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

                                        <span class="kt-subheader__breadcrumbs-separator"></span>

                                        {{-- Breadcrumbs::render('Dashboard') --}}

                                        <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active"> Language : {{ __('app.title') }}</span>
                                    </div>

                                
                                </div>

                            </div>
                        </div>

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid pt-4">
<div class="row">
    <div class="col-lg-12 head-part">
        <h4>How can we help?</h4>
        <input class="form-control" type="text" name="title_search" id="title_search" placeholder="search.......">
                <div id="titleList" style="position:absolute;">
                                        </div>      
    </div>
</div>
<div class="row" style="margin-bottom:25%">
    @foreach($basecategories as $basecategories)
    <div class="col-lg-4">
        <a href="basearticleview?cid={{$basecategories->id}}">
            <div class="kt-portlet kt-iconbox kt-iconbox--wave">     
                <div class="kt-iconbox__desc" style="text-align: center;">
                    <h3 class="kt-iconbox__title"> {{$basecategories->title}}</h3>
                    <div class="kt-iconbox__content">
                       <h6>{{$basecategories->description}}</h6>
                       <p></p>
                    </div>
                </div>    
            </div>
        </a>
    </div>
    @endforeach
  
</div>

<style type="text/css">
    .hideButton{
       display: none
    }
    .error{
        color: red
    }
    .head-part{
        display: inline-block;
        text-align: center;
        padding: 50px;
    }
</style>
<!--end::Modal-->
@endsection

@section('script')

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
