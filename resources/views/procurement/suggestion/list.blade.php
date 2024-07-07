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


<input type="hidden" name="type" id="type" value="{{$data['type']}}">
<input type="hidden" name="docId" id="docId" value="{{$data['docId']}}">
<input type="hidden" name="from" id="from" value="{{$data['from']}}">
<input type="hidden" name="to" id="to">
<input type="hidden" name="path" id="path" value="{{ URL::to('/public') }}/">
<input type="hidden" name="profilePic" id="profilePic" value="{{ URL::to('/public') }}/{{$profile}}">

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Chat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="kt-todo__body">
                    <div class="kt-todo__items" data-type="task">
                        <div class="col-lg-8">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-4">
                                    <label>Users <span style="color: red">*</span></label>
                                </div>
                                <div class="col-md-8 input-group-sm">
                                    <select class="form-control single-select kt-selectpicker" id="users" name="users">
                                        <option value="">Select</option>
                                        @foreach ($users as $key => $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-check">
                            <input type="checkbox" class="form-check-input kt-checkbox kt-checkbox--single kt-checkbox--tick kt-checkbox--brand" id="exampleCheck" name="users[]">
                            <label class="form-check-label kt-todo__message" for="exampleCheck1">{{$value->department}} {{$value->designation}}</label>
                        </div> -->

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnAddToChat">Add Chat</button>
            </div>
        </div>
    </div>
</div>
<!-- ./Modal -->


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
                        <div class="kt-searchbar">
                            <!-- <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg></span></div>
                                <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon1">
                            </div> -->
                        </div>
                        <div class="kt-widget kt-widget--users kt-mt-20">
                            <div class="kt-scroll kt-scroll--pull" style="overflow-y: auto;  height: 520px;">
                                <div class="kt-widget__items">
                                    @foreach ($usersOnChat as $key => $value)
                                    <div class="kt-widget__item curActive">
                                        <span class="kt-media kt-media--circle">
                                            <img src="{{ URL::to('/public') }}/{{($value['image']!='')?$value['image']:'/Profilepicture/default.jpg'}}" alt="image">
                                        </span>
                                        <div class="kt-widget__info">
                                            <div class="kt-widget__section">
                                                <a class="kt-widget__username">{{$value['name']}}</a>
                                                <span class="kt-badge kt-badge--success kt-badge--dot"></span>
                                                <input type="hidden" class="userId" id="userId" name="userId" value="{{$value['id']}}">
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
                                    <div class="dropdown dropdown-inline">
                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="flaticon2-add-1"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-md">

                                            <!--begin::Nav-->
                                            <ul class="kt-nav">
                                                <li class="kt-nav__head">
                                                    Messaging
                                                </li>
                                                <li class="kt-nav__separator"></li>
                                                <li class="kt-nav__item">
                                                    <div class="kt-nav__link showUsers">
                                                        <i class="kt-nav__link-icon flaticon2-group"></i>
                                                        <span class="kt-nav__link-text">New Chat</span>
                                                    </div>
                                                </li>

                                                <li class="kt-nav__separator"></li>
                                            </ul>

                                            <!--end::Nav-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-scroll kt-scroll--pull" style="overflow-y: auto;  height: 325px;">
                                <div class="kt-chat__messages">
                                    <!-- <div class="kt-chat__message">
                                        <div class="kt-chat__user">
                                            <span class="kt-media kt-media--circle kt-media--sm">
                                                <img src="{{ URL::asset('assets') }}/media/users/default.jpg" alt="image">
                                            </span>
                                            <a href="#" class="kt-chat__username">Sam</span></a>
                                            <span class="kt-chat__datetime">2 Hours</span>
                                        </div>
                                        <div class="kt-chat__text kt-bg-light-success">
                                            How likely are you to recommend our company <br>to your friends and family?
                                        </div>
                                    </div>
                                    <div class="kt-chat__message kt-chat__message--right">
                                        <div class="kt-chat__user">
                                            <span class="kt-chat__datetime">30 Seconds</span>
                                            <a href="#" class="kt-chat__username">You</span></a>
                                            <span class="kt-media kt-media--circle kt-media--sm">
                                                <img src="{{ URL::asset('assets') }}/media/users/default.jpg" alt="image">
                                            </span>
                                        </div>
                                        <div class="kt-chat__text kt-bg-light-brand">
                                            Hey there, we’re just writing to let you know <br>that you’ve been subscribed to a repository on GitHub.
                                        </div>
                                    </div> -->
                                </div>
                                <div id='test' tabindex='1'></div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-chat__input">
                                <div class="kt-chat__editor" style="height: 50px">
                                    <!-- <textarea id="editor" style="height: 50px; display:none ;" placeholder="Type here..."></textarea> -->
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
<script src="{{url('/')}}/resources/js/procurement/suggestion/chatOverRide.js" type="text/javascript"></script>
<script>
    @if($data['type'] == 'epr')
    $('.eprApproval').addClass('kt-menu__item--active');
    @endif
    @if($data['type'] == 'ST')
    $('.stock-transfer-approve-list').addClass('kt-menu__item--active');
    @endif
    @if($data['type'] == 'PO')
    $('.poApproveList').addClass('kt-menu__item--active');
    @endif
    @if($data['type'] == 'GRN')
    $('.grnApproveList').addClass('kt-menu__item--active');
    @endif
    @if($data['type'] == 'S-IN')
    $('.stockInApproval').addClass('kt-menu__item--active');
    @endif
    @if($data['type'] == 'S-INV')
    $('.invoiceApproveList').addClass('kt-menu__item--active');
    @endif
    @if($data['type'] == 'S-PAY')
    $('.supplierPaymentApproval').addClass('kt-menu__item--active');
    @endif
</script>
@endsection