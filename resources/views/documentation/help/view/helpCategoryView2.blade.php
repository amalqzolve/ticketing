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
            <div class="col-lg-4" style="border-right:1px solid #efeff5;align-items: center;flex-wrap: nowrap;justify-content: center;display: flex;align-content: center;flex-direction: column;">
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
                    <h1>How to submit your work to product manager?</h1>
                </div>
                <div>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                    <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>
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
