@extends('tenders.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<style>
    .inputpicker-overflow-hidden {
        overflow: hidden;
        width: 100%;
    }

    .inputpicker-div>.inputpicker-input {
        font-size: 11px;
    }

    .inputpicker-arrow {
        top: 8px;
    }

    div.new1 {
        background-color: #f2f3f8;
        height: 20px;
        width: 100%;
        right: -36px;
        position: absolute;
        display: block;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

    .pluseb {
        background-color: #5d78ff;
        height: 100%;
        padding-top: 22%;
        text-align: center;
    }

    .pluseb:hover {
        background-color: #2a4eff;
    }

    .uppy-size--md .uppy-Dashboard-inner {
        width: 100%;
        height: 550px;
    }

    .table-bordered th,
    .table-bordered td {
        border: 0px solid #ebedf2;
        padding: 0px !important;
    }

    .nav-tabs {
        border-bottom: 0px;
    }

    .nav-tabs .nav-link {
        border: 3px solid transparent;
    }

    .nav-tabs .nav-link:hover,
    .nav-tabs .nav-link:focus {
        border-color: #f8fcff #fefeff #979fa8;
    }

    .nav-tabs .nav-link.active,
    .nav-tabs .nav-item.show .nav-link {
        border-color: #ffffff #ffffff #2275d7;
    }

    .mbtn {
        background-color: white;
        color: #74788d;

    }

    .mbtn:hover {
        color: #ffffff;
        background: #5d78ff;
        border-color: #5d78ff;

    }

    .mbdg1 {
        background: #fff;
        color: #a1a3a5;
    }

    .mbdg1:hover {
        background: #0ABB87;
        color: #fff;
    }

    .mbdg2 {
        background: #fff;
        color: #a1a3a5;
    }

    .mbdg2:hover {
        background: #FD397A;
        color: #fff;
    }

    .dataTables_wrapper .dataTable .selected th,
    .dataTables_wrapper .dataTable .selected td {
        background-color: #f4e92b !important;
        /* color: #595d6e; */
    }

    #productdetails_list_wrapper {
        height: 300px;
        overflow-y: scroll;
    }
</style>


<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Add Tender
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body pl-2 pr-2 pb-0">

            <form class="kt-form" id="kt_form" name="kt_form">

                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">Tender Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_tabs_2_2">@lang('app.Other Information')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3">Terms and Conditions</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_4"></a>
                    </li> -->
                </ul>


                <div class="tab-content">

                    <div class="tab-pane p-2 active" id="kt_tabs_2_1" role="tabpanel">

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Client <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select name="client" id="client" class="form-control single-select kt-selectpicker">
                                            <option value="">--select--</option>
                                            @foreach($client as $key => $value)
                                            <option value="{{$value->id}}">{{$value->cust_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Project Name <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="project_name" id="project_name">
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Category <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <select name="category_id" id="category_id" class="form-control single-select kt-selectpicker">
                                            <option value="">--select--</option>
                                            @foreach($category as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Date of Submission</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" value="{{date('d-m-Y')}}" id="date_of_submission" name="date_of_submission">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Date of release</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" value="{{date('d-m-Y')}}" id="date_of_release" name="date_of_release">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Tender reference</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control" name="reference" id="reference">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Bid Extension Date</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" value="{{date('d-m-Y')}}" id="bid_extension_date" name="bid_extension_date">
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Bid Submission Date</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <input type="text" class="form-control kt_datetimepickerr" value="{{date('d-m-Y')}}" id="bid_submission_date" name="bid_submission_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Bid Bond</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea cols="30" class="form-control" rows="2" id="bid_bond" name="bid_bond"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Consultant</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea cols="30" class="form-control" rows="2" id="consultant" name="consultant"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-2">
                                        <label>Scope of Work</label>
                                    </div>
                                    <div class="col-md-10 input-group-sm">
                                        <textarea cols="30" class="form-control" rows="4" id="scope_of_work" name="scope_of_work"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane p-3 " id="kt_tabs_2_2" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Internal Reference</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea class="form-control" name="internalreference" id="internalreference"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group  row pr-md-3">
                                    <div class="col-md-4">
                                        <label>Printable notes</label>
                                    </div>
                                    <div class="col-md-8 input-group-sm">
                                        <textarea class="form-control" name="notes" id="notes"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane p-3" id="kt_tabs_2_3" role="tabpanel">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="fileData" id="fileData" value="" />
                                <div id="choose-files">
                                    <form action="/upload">
                                        <input type="file" id="files" name="files[]" accept="image/*" />
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>



                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                            </div>
                            <div class="col-lg-12 kt-align-right">
                                <button type="reset" class="btn btn-secondary backHome"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg> &nbsp;@lang('app.Cancel')</button>
                                <button type="button" class="btn btn-primary" id="btnSave"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg> &nbsp;Save</button>
                            </div>
                        </div>
                    </div>
                </div>



            </form>



        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/resources/js/tenders/tender/add.js" type="text/javascript"></script>


<script>
    const uppy = Uppy.Core({
        autoProceed: false,
        allowMultipleUploads: false,
        restrictions: {
            maxNumberOfFiles: 1,
            minNumberOfFiles: 1,
            allowedFileTypes: ["image/*"]
        },
        meta: {
            brand_id: $('#id').val(),
        },
        onBeforeUpload: (files) => {
            fileData = [];
            const updatedFiles = {};
            Object.keys(files).forEach(fileID => {
                fileData.push('tender/' + files[fileID].name)
            })
            $('#fileData').val(fileData);

        },

    })

    uppy.use(Uppy.Dashboard, {
        metaFields: [{
                id: 'name',
                name: 'Name',
                placeholder: 'File name'
            },
            {
                id: 'caption',
                name: 'Caption',
                placeholder: 'describe what the image is about'
            }
        ],
        browserBackButtonClose: true,
        target: '#choose-files',
        inline: true,
        replaceTargetContent: true,
        width: '100%'
    })
    uppy.use(Uppy.Webcam, {
        target: Uppy.Dashboard
    })
    uppy.use(Uppy.XHRUpload, {
        endpoint: 'tender-file-upload',
        fieldName: 'filenames[]',
        headers: {
            'X-CSRF-TOKEN': $('#token').val(),
        }
    })

    if ($('#fileData').val() != '') {
        var img_array = $('#fileData').val().split(",");
        console.log(img_array);
        $.each(img_array, function(i) {
            onuppyImageClicked('public/' + img_array[i]);
        });
    }

    function onuppyImageClicked(img) {

        var str = img.toString();
        var n = str.lastIndexOf('/');
        var img_name = str.substring(n + 1);
        // assuming the image lives on a server somewhere
        return fetch(img)
            .then((response) => response.blob()) // returns a Blob
            .then((blob) => {
                uppy.addFile({
                    name: img_name,
                    type: 'image/jpeg',
                    data: blob
                })
            })
    }
</script>

@endsection