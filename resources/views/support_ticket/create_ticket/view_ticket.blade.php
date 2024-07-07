@extends('support_ticket.common.layout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />

	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
                @lang('support_ticket.Ticket') #{{ isset($ticketdet->ticketID) ? $ticketdet->ticketID : '' }} - {{ isset($ticketdet->ticket_title) ? $ticketdet->ticket_title : '' }}
				</h3>

			</div>
            <div class="dropdown mt-3">
                <button class="btn btn-secondary float-right btn-sm backHome cancel">
                    <i class="flaticon2-back" aria-hidden="true"></i> @lang('support_ticket.Back')
                </button>
            </div>
		</div>
		<div class="kt-portlet__body">
            <div class="media row pb-3">
                <div class="col-md-12 mb-1">
                    <b>@lang('support_ticket.Client'):</b> <span class="text-dark">{{ isset($ticketdet->cust_name) ? $ticketdet->cust_name : '' }}</span>
                </div>
                @php
                    $ticketagnst = "";
                    if($ticketdet->ticket_against == 1) {
                        $ticketagnst = "New Task";
                    }
                    elseif($ticketdet->ticket_against == 2) {
                        $ticketagnst = "Project";
                    }

                    $priorty = "";
                    if($ticketdet->priority_id == 1) {
                        $priorty = "Normal";
                    }
                    elseif($ticketdet->priority_id == 2) {
                        $priorty = "Medium";
                    }
                    elseif($ticketdet->priority_id == 3) {
                        $priorty = "Urgent";
                    }
                    elseif($ticketdet->priority_id == 4) {
                        $priorty = "Very Urgent";
                    }

                    $tickt_stat  = "";
                    $badge_color = "";
                    if($ticketdet->ticket_status == 1) {
                        $tickt_stat  = "Open";
                        $badge_color = "badge-success";
                    }
                    elseif($ticketdet->ticket_status == 0) {
                        $tickt_stat = "Close";
                        $badge_color = "badge-danger";
                    }
                @endphp
                <div class="col-md-6">
                    <b>@lang('support_ticket.Ticket Against'):</b> <span class="text-dark">{{$ticketagnst}}</span>
                    <br>
                    <b>@lang('support_ticket.Ticket Category'):</b> <span class="text-dark">{{ isset($ticketdet->category) ? $ticketdet->category : '' }}</span>
                    <br>
                    <b>@lang('support_ticket.Priority'):</b> <span class="text-dark">{{ $priorty }}</span>
                </div>


                <div class="col-md-6 text-right">
                    <b>@lang('support_ticket.Ticket Date'):</b> <span class="text-dark">{{ isset($ticketdet->created_at) ? date('d-M-Y H:i:s A', strtotime($ticketdet->created_at)) : ''}}</span><br>
                    <b>@lang('support_ticket.Created by'):</b> <span class="text-dark">{{ isset($ticketdet->created_by) ? $ticketdet->created_by : '' }}</span>
                    <br />
                    <b>Status:</b> <span class="badge {{ $badge_color }} text-white">{{ $tickt_stat }}</span>
                </div>

            </div>

            <div class="media border border-right-0 border-left-0 p-3">
                <div class="media-body pt-3">
                    <div class="form-group">
                        <textarea class="form-control bg-light" rows="5" readonly>{{ isset($ticketdet->ticket_details) ? $ticketdet->ticket_details : '' }}</textarea>
                      </div>
                </div>
            </div>

            <div class="media border border-right-0 border-left-0 p-3">
                <div class="media-body pt-3  list-group">
                  <h4>@lang('support_ticket.Attachment')</h4>
                @php
                    $filearr = array();
                    $filena  = '';

                    if($ticket_attachmnts->isEmpty())
                    {
                        echo '<p class="list-group-item list-group-item-action">No Attachments are uploaded.</p>';
                    }
                    else {
                        foreach ($ticket_attachmnts as $key => $attchmnt) {
                            $filearr = explode('/', $attchmnt->file_name);
                            $filena  = $filearr[2];

                            echo '<p class="list-group-item list-group-item-action"><b><i class="flaticon-attachment"></i> </b>'.$filena.' <a href="download_attachment?na='.$attchmnt->file_name.'" class="btn btn-sm  float-right btn-outline-brand btn-elevate btn-icon" title="Download Attachment"><i class="la la-cloud-download"></i></a> </p>';
                        }
                    }
                @endphp

                </div>
            </div>

            <div class="media border border-right-0 border-left-0 p-3">
                <div class="media-body pt-3  list-group">
                    <h4>@lang('support_ticket.Ticket History')</h4>
                </div>
            </div>

            <?php
                foreach ($ticket_history as $key => $history) {
                    if ($history->title == 'Ticket Created By') {
                        echo '<div class="media border border-right-0 border-left-0 p-3">
                                <div class="media-body pt-3">
                                    <p><b>'.$history->title.'</b></p>
                                    <p>User : '.$history->user_name.'</p>
                                    <p>Date : '.$history->created_at.'</p>
                                </div>
                            </div>';
                    }
                    if ($history->title == 'Ticket Assigned To') {
                        echo '<div class="media border border-right-0 border-left-0 p-3">
                                <div class="media-body pt-3">
                                    <p><b>'.$history->title.'</b></p>
                                    <p>User : '.$history->asgned_to.'</p>
                                    <p>Assigned By : '.$history->asgned_by.'</p>
                                    <p>Date : '.$history->created_at.'</p>
                                </div>
                            </div>';
                    }
                    if ($history->title == 'Ticket Delegated To') {
                        echo '<div class="media border border-right-0 border-left-0 p-3">
                                <div class="media-body pt-3">
                                    <p><b>'.$history->title.'</b></p>
                                    <p>User : '.$history->asgned_to.'</p>
                                    <p>Assigned By : '.$history->asgned_by.'</p>
                                    <p>Date : '.$history->created_at.'</p>
                                </div>
                            </div>';
                    }
                    if ($history->title == 'Ticket Updates') {
                        echo '<div class="media border border-right-0 border-left-0 p-3">
                                <div class="media-body pt-3">
                                    <p><b>'.$history->title.'</b></p>
                                    <p>'.$history->name.' '.$history->labelsuffix.'';
                        if (isset($history->labelcontent)) {
                            echo $history->labelcontent;
                        }
                        echo '</p>
                                    <p>Date : '.$history->created_at.'</p>
                                </div>
                            </div>';
                    }
                }
            ?>
                
            <div class="media border border-right-0 border-left-0 p-3">
                <div class="media-body pt-3">
                  <h4>Ticket Closed</h4>
                  <p>Ticket Closed by Assigned Users : </p>
                  <p>Ticket Closed by Delegated Users : </p>
                </div>
            </div>
            
            <form method="post" class="kt-form" id="Ticketcomments_Form" autocomplete="off" enctype="multipart/form-data" >
            @csrf
            <div class="media border border-right-0 border-left-0 p-3">
                <img src="{{ URL::to('/') }}/public/{{Session::get('profile.0')}}" alt="John Doe"
                class="mr-3 mt-3 rounded-circle " style="width:60px;">
                <div class="media-body pt-3">
                    <div class="form-group">
                        <input type="hidden" name="ticketid" id="cmnt_ticketid" value="{{ $ticketdet->id }}" />
                        <textarea class="form-control bg-light" rows="5" name="ticket_cmn_comment" id="ticket_cmn_comment" placeholder="Enter your comments..."></textarea>
                        <div class="col-12 bg-light border pt-2 pb-2">
                            <button type="button" id="upbtn"
                            class="btn btn-sm btn-outline-secondary  m-1">
                                <i class="fa fa-camera-retro" aria-hidden="true"></i> @lang('support_ticket.Attachment')
                            </button>
                            <input type="file" name="ticket_commentupld" id="ticket_commentupld" style="display: none;">

                            <button type="submit" class="btn btn-sm btn-info float-right mr-1" name="ticket_cmn_comments" id="ticket_cmn_comments"><span style="white-space: nowrap"><i class="fa fa-comment" aria-hidden="true"></i>@lang('support_ticket.Save as note')</span></button>
                        </div>
                      </div>
                </div>
            </div>
            </form>
		</div>
	</div>
</div>
<style type="text/css">
	.hideButton {
		display: none
	}

	.error {
		color: red
	}
    .uppy-size--md .uppy-Dashboard-inner{
        min-width: 100% !important;
    }

</style>
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/support_ticket/create_ticket.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#upbtn").click(function(){
            $("#ticket_commentupld").click();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
	    });
    });
    </script>
@endsection
