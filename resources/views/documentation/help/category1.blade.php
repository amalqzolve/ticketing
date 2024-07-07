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
     <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop">
        <div class="row">
            <div class="col-lg-4" style="border-right:1px solid #efeff5; align-items: center;flex-wrap: wrap;justify-content: center;display: flex;">
                <div>
                    <input type="text" name="search" placeholder="Search your question" style="width:100%;height: 35px;margin-top: 20px;">
                </div>
                <div style="padding: 25px 0px;">
                    <h3>Categories</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{url('/')}}/help_category1">Documentation</a></li>
                        <li class="list-group-item"><a href="{{url('/')}}/help_category2">Help Desk</a></li>
                        <li class="list-group-item"><a href="{{url('/')}}/help_category3">Leave Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8" style="padding-left: 25px; margin-top: 15px;">
                <div>
                    <h1>Documentation</h1>
                    <h5>Description about how to work with our team.</h5>
                </div>
                <div>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{url('/')}}/help_category_view1">How to develop a best product?</a></li>
                        <li class="list-group-item"><a href="{{url('/')}}/help_category_view2">How to submit your work to product manager?</a></li>
                    </ul>
                </div>
            </div>
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
    .head-part{
        display: inline-block;
        text-align: center;
        padding: 50px;
    }
    .list-group{
        list-style: none;
    }
    .list-group-item{
        padding: 10px 0px;
        background-color: #fff;
        border-color: #fff
    }
</style>
<!--end::Modal-->
@endsection

@section('script')



@endsection
