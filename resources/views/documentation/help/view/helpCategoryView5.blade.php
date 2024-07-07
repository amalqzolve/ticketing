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
            <div class="col-lg-4" style="border-right:1px solid #efeff5; padding-left: 40px;">
                <div>
                    <input type="text" name="search" placeholder="Search your question" style="width:70%;height: 35px;margin-top: 20px;">
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
                    <h1>How much leave I can enjoy in a year?</h1>
                </div>
                <div>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
                    <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>
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
