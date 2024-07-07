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
                    @lang('support_ticket.Update Ticket')
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form method="post" class="kt-form" id="Ticketupdate_Form" autocomplete="off" onsubmit="tickt_update.disabled = true; return true;">
                @csrf
                <input type="hidden" class="form-control" name="tickt_id" id="tickt_id" value="{{ $ticketdet->id }}">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Client')<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <select class="form-control single-select kt-selectpicker" name="e_tickt_client" id="e_tickt_client" disabled>
                                    <option value="">Select</option>
                                    @foreach($customers as $customers)
                                    @if ($ticketdet->client_id)
                                    @if ($customers->id == $ticketdet->client_id)
                                    <option value="{{$customers->id}}" selected>{{$customers->cust_name}}</option>
                                    <!-- @else
                                            <option value="{{$customers->id}}">{{$customers->cust_name}}</option> -->
                                    @endif
                                    @endif
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
                                <select class="form-control single-select kt-selectpicker" name="e_tickt_against" id="e_tickt_against">
                                    <option value="">Select</option>
                                    <option value="1" {{($ticketdet->ticket_against == 1) ? "selected" : ''}}>New Task</option>
                                    <option value="2" {{($ticketdet->ticket_against == 2) ? "selected" : ''}}>Project</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-none" id="e_project_div">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Project')<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <select class="form-control single-select kt-selectpicker" name="e_tickt_project" id="e_tickt_project">
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
                                <input type="text" class="form-control" name="e_tickt_title" id="e_tickt_title" placeholder="@lang('support_ticket.Ticket Title')" value="{{ isset($ticketdet->ticket_title) ? $ticketdet->ticket_title : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Ticket Category')<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <select class="form-control single-select kt-selectpicker" name="e_tickt_category" id="e_tickt_category">
                                    <option value="">Select</option>

                                    @foreach($categories as $categories)
                                    @if ($ticketdet->ticket_category_id)
                                    @if ($categories->id == $ticketdet->ticket_category_id)
                                    <option value="{{$categories->id}}" selected>{{$categories->category}}</option>
                                    @else
                                    <option value="{{$categories->id}}">{{$categories->category}}</option>
                                    @endif
                                    @else
                                    <option value="{{$categories->id}}">{{$categories->category}}</option>
                                    @endif
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
                                <input type="text" class="form-control" name="e_tickt_date" id="e_tickt_date" placeholder="@lang('support_ticket.Ticket Date')" value="{{date('d-m-Y', strtotime($ticketdet->ticket_date))}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Due Date')</label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <input type="text" class="form-control kt_datetimepickerr" name="e_tickt_completiondate" id="e_tickt_completiondate" placeholder="@lang('support_ticket.Due Date')" value="{{ isset($ticketdet->completion_date) ? date('d-m-Y', strtotime($ticketdet->completion_date)) : ''}}">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Scope of work')</label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <input type="text" class="form-control" name="e_tickt_scopeof_work" id="e_tickt_scopeof_work" placeholder="@lang('support_ticket.Scope of work')" value="{{ isset($ticketdet->scope_of_work) ? $ticketdet->scope_of_work : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>@lang('support_ticket.Priority')</label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <select class="form-control single-select kt-selectpicker" name="e_tickt_priority" id="e_tickt_priority">
                                    <option value="">Select</option>
                                    <option value="1" {{($ticketdet->priority_id == 1) ? "selected" : ''}}>Normal</option>
                                    <option value="2" {{($ticketdet->priority_id == 2) ? "selected" : ''}}>Medium</option>
                                    <option value="3" {{($ticketdet->priority_id == 3) ? "selected" : ''}}>Urgent</option>
                                    <option value="4" {{($ticketdet->priority_id == 4) ? "selected" : ''}}>Very Urgent</option>
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
                                <select class="form-control single-select kt-selectpicker" name="e_tickt_assignedto" id="e_tickt_assignedto" multiple="multiple">
                                    <option value="">Select</option>

                                    @foreach($users as $users)
                                    @if ($ticketdet->assigned_to)
                                    @if ($users->id == $ticketdet->assigned_to)
                                    <option value="{{$users->id}}" selected>{{$users->name}}</option>
                                    @else
                                    <option value="{{$users->id}}">{{$users->name}}</option>
                                    @endif
                                    @else
                                    <option value="{{$users->id}}">{{$users->name}}</option>
                                    @endif
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
                                <input type="text" class="form-control" name="e_tickt_reference" id="e_tickt_reference" placeholder="@lang('support_ticket.Reference')" value="{{ isset($ticketdet->reference) ? $ticketdet->reference : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-2">
                                <label>@lang('support_ticket.Ticket Details')<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-10 input-group input-group-sm">
                                <textarea class="form-control" name="e_tickt_details" id="e_tickt_details">{{ isset($ticketdet->ticket_details) ? $ticketdet->ticket_details : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- {{$ticket_attachmnts}} -->

                    <div class="col-lg-12">
                        <div class="form-group row pr-md-3">

                            <div class="col-md-2">
                                <label>@lang('support_ticket.Attachment')</label>
                            </div>
                            <div class="col-md-10 input-group input-group-sm">
                                @php
                                $files_arr = array();
                                $exist_files = '';

                                foreach ($ticket_attachmnts as $key => $uplds) {
                                array_push($files_arr, $uplds->file_name);
                                }

                                $exist_files = implode(',', $files_arr);
                                @endphp
                                <input type="hidden" name="e_upload_status" id="e_upload_status" value="0" />
                                <input type="hidden" name="fileData" id="fileData" value="{{ $exist_files }}" />
                                <div id="e_tickt_attachments" style="width: 100%;">

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
                                <button type="submit" name="tickt_update" id="tickt_update" class="btn btn-primary">@lang('support_ticket.Update')</button>
                                <button type="reset" class="btn btn-secondary backHome cancel" onclick="back()">@lang('support_ticket.Cancel')</button>
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
<script type="text/javascript">
    $(function() {
        var client_id = "{{ $ticketdet->client_id }}";
        var tick_agnst = "{{ $ticketdet->ticket_against }}";

        if (tick_agnst == 2) {
            var pjt_id = "{{ $ticketdet->project_id }}";

            $.ajax({
                type: "POST",
                url: "../getclient_projects",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: client_id,
                },
                success: function(data) {
                    $('#e_tickt_project').empty().trigger("change");
                    var newOption = new Option('--select--', '', false, false);
                    if (data.status == 1) {
                        $('#e_tickt_project').append(newOption).trigger('change');
                        $.each(data.data, function(i, val) {
                            if (val.id == pjt_id) {
                                var newOption = new Option(val.projectname, val.id, false, true);
                            } else {
                                var newOption = new Option(val.projectname, val.id, false, false);
                            }

                            $('#e_tickt_project').append(newOption).trigger('change');
                        });
                    } else
                        console.log('Error !!');

                },
                error: function(jqXhr, json, errorThrown) {
                    console.log('Error !!');
                }
            });

            $("#e_project_div").removeClass('d-none');
        } else {
            $("#e_project_div").addClass('d-none');
        }
    });

    $('.create_ticket').addClass('kt-menu__item--open kt-menu__item--here');

    /****************************************
     * Detail : Uppy Upload                  *
     * Date   : 16-11-2022                   *
     ****************************************/
    const uppy1 = new Uppy.Core({
            debug: true,
            autoProceed: false,
            restrictions: {
                maxFileSize: 3100000
            },
            allowMultipleUploads: false, // Once upload button clicked then no files can be added
            onBeforeFileAdded: (currentFile, files) => {
                fileData = [];

                var urlToFile = $('#publc_urll').val() + 'support_tickets/tickets/' + currentFile.name;
                var xhr = new XMLHttpRequest();

                xhr.open('HEAD', urlToFile, false);
                xhr.send();

                if (xhr.status == "404") {
                    modified_flname();
                }

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
            target: '#e_tickt_attachments',
            replaceTargetContent: true,
            // width:'100%',
            // height: '60%',
            doneButtonHandler: null, // Removes the done button shown after 'Upload n File' button is clicked
            hideUploadButton: false // Hides the 'Upload n File' button
        });

    uppy1.use(Uppy.Form, {
        target: '#Ticketupdate_Form',
        getMetaFromForm: true,
        addResultToForm: true,
        multipleResults: true,
        submitOnSuccess: false
        // triggerUploadOnSubmit: true
    });

    uppy1.use(Uppy.XHRUpload, {
        endpoint: '../upload_ticktattachmnts',
        // UniqueID       : $('#UniqueID').val(),
        fieldName: 'filenames[]',
        headers: {
            'X-CSRF-TOKEN': $('#token').val(),
            // UniqueID       : $('#UniqueID').val()
        }
    });

    uppy1.on('file-removed', (file, reason) => {
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

    // To show already uploaded files for edit (Adding files)
    if ($('#fileData').val() != '') {
        var file_array = $('#fileData').val().split(",");

        $.each(file_array, function(i) {
            showuppyfiles($('#publc_urll').val() + file_array[i]);
        });
    }

    function showuppyfiles(att_file) {
        var str = att_file.toString();
        var n = str.lastIndexOf('/');
        var file_name = str.substring(n + 1);
        // assuming the files lives on a server somewhere
        return fetch(att_file)
            .then((response) => response.blob()) // returns a Blob
            .then((blob) => {
                uppy.addFile({
                    name: file_name,
                    type: 'image/*,text/*',
                    data: blob
                })
            })
    }

    uppy1.on('upload-success', (file, response) => {
        $("#e_upload_status").val(1);
    });

    // .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'});
</script>
@endsection