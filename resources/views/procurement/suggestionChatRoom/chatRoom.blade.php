@extends('procurement.common.layoutChat')
@section('content')

<style>
    .currentActiveStyle {
        background-color: #f8f8f8;
        /* background-color: #e6f8f3; */
        border-radius: 5px;
        /* margin: 1rem 0 1.3rem 0 !important; */
        padding: 0.3rem 0 0.3rem 0.rem !important;
    }
</style>

<input type="hidden" name="path" id="path" value="{{ URL::to('/public') }}/">
<input type="hidden" name="profilePic" id="profilePic" value="{{ URL::to('/public') }}/{{$profile}}">

<!-- <input type="hidden" name="path" id="path" value="{{URL::asset('assets') }}/"> -->
<input type="hidden" name="current_type" id="current_type">
<input type="hidden" name="current_doc_id" id="current_doc_id">
<input type="hidden" name="current_from" id="current_from">

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::App-->
        <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

            <!--Begin:: App Aside Mobile Toggle-->
            <button class="kt-app__aside-close" id="kt_chat_aside_close">
                <i class="la la-close"></i>
            </button>

            <!--End:: App Aside Mobile Toggle-->

            <!--Begin:: App Aside-->
            <div class="kt-grid__item kt-app__toggle kt-app__aside kt-app__aside--lg kt-app__aside--fit" id="kt_chat_aside">

                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last">
                    <div class="kt-portlet__body">
                        <div class="kt-searchbar"> </div>
                        <div class="kt-widget kt-widget--users kt-mt-20">
                            <div class="kt-scroll kt-scroll--pull" style="overflow-y: auto;  height: 520px;">
                                <div class="kt-widget__items">
                                    @foreach ($chat as $key => $value)
                                    <div class="kt-widget__item curActive">
                                        <span class="kt-media kt-media--circle">
                                            <img src="{{ URL::to('/public') }}/{{($value['image']!='')?$value['image']:'/Profilepicture/default.jpg'}}" alt="image">
                                        </span>
                                        <div class="kt-widget__info">
                                            <div class="kt-widget__section">
                                                <a class="kt-widget__username">{{$value['name']}} ({{$value['type']}} {{$value['doc_id']}})</a>
                                                <span class="kt-badge kt-badge--success kt-badge--dot"></span>
                                                <input type="hidden" name="type" id="type" value="{{$value['type']}}">
                                                <input type="hidden" name="doc_id" id="doc_id" value="{{$value['doc_id']}}">
                                                <input type="hidden" class="userId" id="userId" name="userId" value="{{$value['from']}}">
                                                <input type="hidden" class="userName" id="userName" name="userName" value="{{$value['name']}}">
                                            </div>
                                            <span class="kt-widget__desc">
                                                <!-- Head of Development -->
                                                {{$value['designation']}}
                                            </span>
                                        </div>
                                        <div class="kt-widget__action">
                                            <!-- <span class="kt-widget__date">&nbsp;</span> -->
                                            @if($value['count_unread'])
                                            <span class="kt-badge kt-badge--success kt-font-bold">{{$value['count_unread']}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>

            <!--End:: App Aside-->

            <!--Begin:: App Content-->
            <div class="kt-grid__item kt-grid__item--fluid kt-app__content" id="kt_chat_content">
                <div class="kt-chat">
                    <div class="kt-portlet kt-portlet--head-lg kt-portlet--last">
                        <div class="kt-portlet__head">
                            <div class="kt-chat__head ">
                                <div class="kt-chat__left">&nbsp;</div>
                                <div class="kt-chat__center">
                                    <div class="kt-chat__label">
                                        <a href="#" class="kt-chat__title">
                                            <div id="activeUserName"></div>
                                        </a>
                                        <span class="kt-chat__status" style="display:none;">
                                            <span class="kt-badge kt-badge--dot kt-badge--success"></span>
                                            Active
                                        </span>
                                    </div>
                                    <div class="kt-chat__pic kt-hidden">&nbsp;</div>
                                </div>
                                <div class="kt-chat__right">
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" id="btnView" style="display:none;">
                                        <i class="flaticon-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-scroll kt-scroll--pull" style="overflow-y: auto;  height: 325px;">
                                <div class="kt-chat__messages"> </div>
                                <div id='test' tabindex='1'></div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-chat__input">
                                <div class="kt-chat__editor" style="height: 50px">
                                    <input type="text" name="editor" id="editor" placeholder="Type here..." style="height: 50px; display:none ;" class="form-control">
                                </div>
                                <div class="kt-chat__toolbar">
                                    <div class="kt_chat__tools">
                                    </div>
                                    <div class="kt_chat__actions" style="height: 20px">
                                        <button type="button" id="btnPost" class="btn btn-brand btn-md btn-upper btn-bold kt-chat__reply" style="display:none ;">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--End:: App Content-->
        </div>

        <!--End::App-->
    </div>

    <!-- end:: Content -->
</div>
<!-- style="height: 135px; overflow: hidden;" -->
@endsection
@section('script')
<!-- <script src="{{url('/')}}/resources/js/procurement/suggestion/chat.js" type="text/javascript"></script> -->
<!-- <script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script> -->
<script src="{{url('/')}}/resources/js/procurement/suggestionChatRoom/chatRoom.js" type="text/javascript"></script>

@endsection