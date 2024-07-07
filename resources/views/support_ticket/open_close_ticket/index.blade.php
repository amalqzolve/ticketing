@extends('support_ticket.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/public/assets/css/pages/wizard/wizard-3.css" rel="stylesheet" type="text/css" />

<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <div class="kt-subheader__breadcrumbs">

                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

                <span class="kt-subheader__breadcrumbs-separator"></span>

            </div>
        </div>
    </div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mb-3">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('support_ticket.open_or_close_tickets')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> @lang('app.Export')
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-print">
                                        <span href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">@lang('app.Print')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-copy">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">@lang('app.Copy')</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-csv">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.CSV')</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-pdf">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">@lang('app.PDF')</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="first">
                <div class="kt-grid__item">
                    <div class="kt-wizard-v3__nav border border-0">
                        <div class="kt-wizard-v3__nav-items kt-wizard-v3__nav-items--clickable pl-2">
                            <div class="kt-wizard-v3__nav-item" id="1" data-ktwizard-type="step" data-ktwizard-state="current">
                                <div class="kt-wizard-v3__nav-body pb-0">
                                    <div class="kt-wizard-v3__nav-label">
                                        Open
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" id="2" data-ktwizard-type="step" data-ktwizard-state="">
                                <div class="kt-wizard-v3__nav-body pb-0">
                                    <div class="kt-wizard-v3__nav-label">
                                        Closed
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <input type="hidden" name="tblNames" id="tblNames" value="1">

                <div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
                    <div class="mt-3">
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">

                                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                                    <!--begin: Form Wizard Form-->
                                    <form class="kt-form" id="kt_form" style="width: 100%; padding:0;">

                                        <table class="table table-striped table-hover table-checkable dataTable no-footer" id="ticket_opentbl">
                                            <thead>
											<tr>
                                                <th><strong>@lang('app.Sl. No')</strong></th>
												<th><strong>@lang('support_ticket.Ticket ID')</strong></th>
									            <th><strong>@lang('support_ticket.Ticket Date')</strong></th>
												<th><strong>@lang('support_ticket.Client')</strong></th>
												<th><strong>@lang('support_ticket.Ticket Title')</strong></th>
												<th><strong>@lang('support_ticket.Due Date')</strong></th>
                                                <th><strong>@lang('support_ticket.Expiry(days)')</strong></th>
												<th><strong>@lang('support_ticket.Assigned to')</strong></th>
												<th><strong>@lang('support_ticket.Status')</strong></th>
												<th><strong>@lang('app.Action')</strong></th>
											</tr>
                                            </thead>

                                            <tbody>

                                            </tbody>

                                        </table>
                                    </form>

                                    <!--end: Form Wizard Form-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="kt-wizard-v3__content   fadeIn" data-ktwizard-type="step-content">
                    <div class="mt-3">
                        <table class="table table-striped table-hover table-checkable dataTable no-footer" id="ticket_closedtbl">
                            <thead>
								<tr>
                                    <th><strong>@lang('app.Sl. No')</strong></th>
                                    <th><strong>@lang('support_ticket.Ticket ID')</strong></th>
                                    <th><strong>@lang('support_ticket.Ticket Date')</strong></th>
                                    <th><strong>@lang('support_ticket.Client')</strong></th>
                                    <th><strong>@lang('support_ticket.Ticket Title')</strong></th>
                                    <th><strong>@lang('support_ticket.Due Date')</strong></th>
                                    <th><strong>@lang('support_ticket.Expiry(days)')</strong></th>
                                    <th><strong>@lang('support_ticket.Assigned to')</strong></th>
                                    <th><strong>@lang('support_ticket.Status')</strong></th>
                                    <th><strong>@lang('app.Action')</strong></th>
								</tr>
                            </thead>

                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- begin ::  Update Ticket Status Modal -->
<div class="modal fade" id="updatestatus_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Update Ticket Status')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="kt-form" method="POST" id="updatestatus_Form" action="{{ url('support_ticket/tickettag_update') }}">
                @csrf
                <div class="modal-body">

					<input type="hidden" class="form-control" name="e_ticktag_id" id="e_ticktag_id" >
                    
                        <div class="form-group">
                            <label for="e_ticktag_name" class="form-control-label">@lang('support_ticket.Status'):</label>
                            <select class="form-control single-select kt-selectpicker" id="mrCat">
								<option value="">Select</option>
								<option value="1">Status 1</option>
								<option value="2">Status 2</option>
								<option value="3">Status 3</option>
								<option value="4">Status 4</option>
								
							</select>
                            @error('e_ticktag_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="e_ticktag_desc" class="form-control-label">@lang('support_ticket.Description'):</label>
                            <textarea class="form-control" name="e_ticktag_desc" id="e_ticktag_desc"></textarea>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('support_ticket.Close')</button>
                    <button type="submit" class="btn btn-primary" name="tickettagupdate" id="tickettagupdate">@lang('app.Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end   :: Update Ticket Status Modal -->

<style type="text/css">
    .hideButton {
        display: none
    }

    .error {
        color: red
    }
</style>
<!--end::Modal-->
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/support_ticket/openclose_ticket.js" type="text/javascript"></script>
<!-- end::Global Config -->
<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{url('/')}}/public/assets/js/pages/custom/wizard/wizard-3.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.open_orclose').addClass('kt-menu__item--open kt-menu__item--here');

    $(document).ready(function() {

        $('[type="search"]').addClass("form-control form-control-sm mt-3");
        $('div.dataTables_wrapper div.dataTables_length select').addClass("form-control form-control-sm mt-3");


    });
</script>


<!--end::Page Scripts -->

@endsection