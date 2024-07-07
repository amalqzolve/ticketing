<!--Begin:: Chat-->
<style>
    .kt-chat .kt-chat__messages.kt-chat__messages--solid .kt-chat__message {
        margin: 0;
    }
</style>
<div class="modal fade- modal-sticky-bottom-right" id="kt_chat_modal" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="kt-chat">
                <div class="kt-portlet kt-portlet--last">
                    <div class="kt-portlet__head">
                        <div class="kt-chat__head ">
                            <div class="kt-chat__left">
                                <div class="kt-chat__label">
                                    <a href="#" class="kt-chat__title" id="currentCommentDocDescription">Jason Muller</a>
                                    <span class="kt-chat__status">
                                        <span class="kt-badge kt-badge--dot kt-badge--success"></span> Active
                                    </span>
                                </div>
                            </div>
                            <div class="kt-chat__right">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon-more-1"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-md">
                                        <!--begin::Nav-->
                                        <!--end::Nav-->
                                    </div>
                                </div>
                                <button type="button" class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
                                    <i class="flaticon2-cross"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-scroll kt-scroll--pull" data-height="410" data-mobile-height="225">
                            <input type="hidden" name="currentCommentProfilePic" id="currentCommentProfilePic" value="{{url('public')}}/{{isset(Auth::user()->image)?Auth::user()->image:''}}">
                            <input type="hidden" name="currentCommentDocType" id="currentCommentDocType">
                            <input type="hidden" name="currentCommentDocId" id="currentCommentDocId">
                            <div class="kt-chat__messages kt-chat__messages--solid" id="currentCommentBoxBody">

                                <!-- <div class="kt-chat__message kt-chat__message--success">
                                    <div class="kt-chat__user">
                                        <span class="kt-media kt-media--circle kt-media--sm">
                                            <img src="assets/media/users/100_12.jpg" alt="image">
                                        </span>
                                        <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                        <span class="kt-chat__datetime">2 Hours</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        How likely are you to recommend our company<br> to your friends and family?
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                    <div class="kt-chat__user">
                                        <span class="kt-chat__datetime">30 Seconds</span>
                                        <a href="#" class="kt-chat__username">You</span></a>
                                        <span class="kt-media kt-media--circle kt-media--sm">
                                            <img src="assets/media/users/300_21.jpg" alt="image">
                                        </span>
                                    </div>
                                    <div class="kt-chat__text">
                                        Hey there, we’re just writing to let you know that you’ve<br> been subscribed to a repository on GitHub.
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--success">
                                    <div class="kt-chat__user">
                                        <span class="kt-media kt-media--circle kt-media--sm">
                                            <img src="assets/media/users/100_12.jpg" alt="image">
                                        </span>
                                        <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                        <span class="kt-chat__datetime">30 Seconds</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        Ok, Understood!
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                    <div class="kt-chat__user">
                                        <span class="kt-chat__datetime">Just Now</span>
                                        <a href="#" class="kt-chat__username">You</span></a>
                                        <span class="kt-media kt-media--circle kt-media--sm">
                                            <img src="assets/media/users/300_21.jpg" alt="image">
                                        </span>
                                    </div>
                                    <div class="kt-chat__text">
                                        You’ll receive notifications for all issues, pull requests!
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--success">
                                    <div class="kt-chat__user">
                                        <span class="kt-media kt-media--circle kt-media--sm">
                                            <img src="assets/media/users/100_12.jpg" alt="image">
                                        </span>
                                        <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                        <span class="kt-chat__datetime">2 Hours</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        You were automatically <b class="kt-font-brand">subscribed</b> <br>because you’ve been given access to the repository
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                    <div class="kt-chat__user">
                                        <span class="kt-chat__datetime">30 Seconds</span>
                                        <a href="#" class="kt-chat__username">You</span></a>
                                        <span class="kt-media kt-media--circle kt-media--sm">
                                            <img src="assets/media/users/300_21.jpg" alt="image">
                                        </span>
                                    </div>
                                    <div class="kt-chat__text">
                                        You can unwatch this repository immediately <br>by clicking here: <a href="#" class="kt-font-bold kt-link"></a>
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--success">
                                    <div class="kt-chat__user">
                                        <span class="kt-media kt-media--circle kt-media--sm">
                                            <img src="assets/media/users/100_12.jpg" alt="image">
                                        </span>
                                        <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                        <span class="kt-chat__datetime">30 Seconds</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        Discover what students who viewed Learn <br>Figma - UI/UX Design Essential Training also viewed
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                    <div class="kt-chat__user">
                                        <span class="kt-chat__datetime">Just Now</span>
                                        <a href="#" class="kt-chat__username">You</span></a>
                                        <span class="kt-media kt-media--circle kt-media--sm">
                                            <img src="assets/media/users/300_21.jpg" alt="image">
                                        </span>
                                    </div>
                                    <div class="kt-chat__text">
                                        Most purchased Business courses during this sale!
                                    </div>
                                </div> -->

                            </div>
                            <div id="test" tabindex="1"></div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-chat__input">
                            <div class="kt-chat__input">
                                <!-- <textarea placeholder="Type here..." style="height: 50px" maxlength="200"></textarea> -->
                                <input type="text" name="editor" id="editor" placeholder="Type here..." style="height: 50px" class="form-control" maxlength="200">
                            </div>
                            <div class="kt-chat__toolbar">
                                <div class="kt_chat__tools">
                                </div>
                                <div class="kt_chat__actions">
                                    <button type="button" id="postComment" class="btn btn-brand btn-md  btn-font-sm btn-upper btn-bold ">post</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('assets/js/pages/custom/chat/chat.js') }}" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/procurement/comments.js" type="text/javascript"></script>

<!--ENd:: Chat-->