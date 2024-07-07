@extends('support_ticket.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('support_ticket.Create Ticket')
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form method="post" class="kt-form" id="Ticketcreate_Form" autocomplete="off" onsubmit="tickt_submit.disabled = true; return true;">
                @csrf
                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Client')<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <select class="form-control single-select kt-selectpicker" name="tickt_client" id="tickt_client">
                                    <option value="">Select</option>
                                    @foreach($customers as $customers)
                                    <option value="{{$customers->id}}">{{$customers->cust_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Ticket Against')<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <select class="form-control single-select kt-selectpicker" name="tickt_against" id="tickt_against">
                                    <option value="">Select</option>
                                    <option value="1">New Task</option>
                                    <option value="2">Project</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-none" id="project_div">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Project')<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <select class="form-control single-select kt-selectpicker" name="tickt_project" id="tickt_project">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Ticket Title')<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <input type="text" class="form-control" name="tickt_title" id="tickt_title" placeholder="@lang('support_ticket.Ticket Title')">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Ticket Category')<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <select class="form-control single-select kt-selectpicker" name="tickt_category" id="tickt_category">
                                    <option value="">Select</option>
                                    @foreach($categories as $categories)
                                    <option value="{{$categories->id}}">{{$categories->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Ticket Date')<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <input type="text" class="form-control" name="tickt_date" id="tickt_date" placeholder="@lang('support_ticket.Ticket Date')" value="{{date('d-m-Y')}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Due Date')</label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <input type="text" class="form-control kt_datetimepickerr" name="tickt_completiondate" id="tickt_completiondate" placeholder="@lang('support_ticket.Due Date')">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Scope of work')</label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <input type="text" class="form-control" name="tickt_scopeof_work" id="tickt_scopeof_work" placeholder="@lang('support_ticket.Scope of work')">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Priority')</label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <select class="form-control single-select kt-selectpicker" name="tickt_priority" id="tickt_priority">
                                    <option value="">Select</option>
                                    <option value="1">Normal</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Urgent</option>
                                    <option value="4">Very Urgent</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Assigned to')</label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <select class="form-control single-select kt-selectpicker" name="tickt_assignedto" id="tickt_assignedto" multiple="multiple">
                                    <option value="">Select</option>
                                    @foreach($users as $users)
                                    <option value="{{$users->id}}">{{$users->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Reference')</label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <input type="text" class="form-control" name="tickt_reference" id="tickt_reference" placeholder="@lang('support_ticket.Reference')">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-2">
                                <label>@lang('support_ticket.Ticket Details')<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-10 input-group input-group-sm">
                                <textarea class="form-control" name="tickt_details" id="tickt_details"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row pr-md-3">

                            <div class="col-md-2">
                                <label>@lang('support_ticket.Attachment')</label>
                            </div>
                            <div class="col-md-10 input-group input-group-sm">
                                <input type="hidden" name="upload_status" id="upload_status" value="0" />
                                <input type="hidden" name="fileData" id="fileData" />
                                <div id="tickt_attachments" style="width: 100%;">

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-6">
                            </div>
                            <div class="col-lg-6 kt-align-right">
                                <button type="submit" name="tickt_submit" id="tickt_submit" class="btn btn-primary">@lang('support_ticket.Submit')</button>
                                <button type="reset" class="btn btn-secondary backHome cancel">@lang('support_ticket.Cancel')</button>
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

    .uppy-size--md .uppy-Dashboard-inner {
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
    $('.create_ticket').addClass('kt-menu__item--open kt-menu__item--here');

    /****************************************
     * Detail : Uppy Upload                  *
     * Date   : 16-11-2022                   *
     ****************************************/
    const uppyUp = new Uppy.Core({
            debug: true,
            autoProceed: false,
            restrictions: {
                maxFileSize: 3100000
            },
            allowMultipleUploads: false, // Once upload button clicked then no files can be added
            onBeforeFileAdded: (currentFile, files) => {
                fileData = [];
                modified_flname();

                var mod_file;

                function modified_flname() {
                    const modifiedFile = {
                        ...currentFile,
                        name: Date.now() + '__' + currentFile.name
                    }

                    mod_file = modifiedFile;

                    Object.keys(files).forEach(fileID => {
                        fileData.push('support_tickets/tickets/' + files[fileID].name);
                    });

                    fileData.push('support_tickets/tickets/' + modifiedFile.name)

                    $('#fileData').val(fileData);
                }
                return mod_file;
            }
            /*,
                    onBeforeUpload: (files) => {
                        var submit_doc = document.getElementsByName("request_submit");
                        submit_doc.disabled = true;
                    }*/
        })
        .use(Uppy.Dashboard, {
            inline: true,
            target: '#tickt_attachments',
            replaceTargetContent: true,
            // width:'100%',
            // height: '60%',
            doneButtonHandler: null, // Removes the done button shown after 'Upload n File' button is clicked
            hideUploadButton: false // Hides the 'Upload n File' button
        });

    uppyUp.use(Uppy.Form, {
        target: '#Ticketcreate_Form',
        getMetaFromForm: true,
        addResultToForm: true,
        multipleResults: true,
        submitOnSuccess: false
        // triggerUploadOnSubmit: true
    });

    uppyUp.use(Uppy.XHRUpload, {
        endpoint: 'upload_ticktattachmnts',
        // UniqueID       : $('#UniqueID').val(),
        fieldName: 'filenames[]',
        headers: {
            'X-CSRF-TOKEN': $('#token').val(),
            // UniqueID       : $('#UniqueID').val()
        }
    });

    uppyUp.on('file-removed', (file, reason) => {
        var str = $("#fileData").val();
        var substr1 = 'support_tickets/tickets/' + file.name; // without comma
        var substr2 = ',support_tickets/tickets/' + file.name; // with comma in the begining
        var substr3 = 'support_tickets/tickets/' + file.name + ','; // with comma in the end
        var finaloutput = '';

        if (str.includes(substr2) == true) {
            finaloutput = str.replace(substr2, "");
        } else if (str.includes(substr3) == true) {
            finaloutput = str.replace(substr3, "");
        } else if (str.includes(substr1) == true) {
            finaloutput = str.replace(substr1, "");
        }

        $("#fileData").val(finaloutput);
    });

    uppyUp.on('upload-success', (file, response) => {
        $("#upload_status").val(1);
    });

    // .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'});
</script>
@endsection