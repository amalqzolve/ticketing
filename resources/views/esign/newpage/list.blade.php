@extends('esign.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                   Documents
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{url('e-sign/newform')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            @lang('app.New Record')
                        </a>
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
            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="tbl">
                <thead>
                    <tr>
                        <th><strong>@lang('app.Sl. No')</strong></th>
                        <th><strong>Document Name</strong></th>
                        <th><strong>Document Type</strong></th>
                        <th><strong>Form Name</strong></th>
                        <th><strong>Recipients</strong></th>
                        <th><strong>Status</strong></th>
                        <th><strong>Owner</strong></th>
                        <th><strong>Created on</strong></th>
                        <th><strong>Last Modified</strong></th>
                        <th><strong>@lang('app.Action')</strong></th>
                    </tr>
                </thead>
                <tbody>



                    <tr>
                        <td>1</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>
                            <a href="#" data-toggle="popover"
                            data-placement="bottom"
                            title="Document Name :  Download
                            Created On :  00/00/0000"
                            data-content="Signer : qzolve@gmail.com">
                                <span class="badge badge-warning text-white p-2">Draft</span>
                            </a>
                        </td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>
                            <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <a href="" data-type="edit">
                                <li class="kt-nav__item">
                                    <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon-background"></i>
                                    <span class="kt-nav__link-text" data-id="26">View</span>
                                    </span>
                                </li>
                                </a>

                                <a href="" data-type="edit">
                                <li class="kt-nav__item">
                                    <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-edit"></i>
                                    <span class="kt-nav__link-text" data-id="26">Edit</span>
                                    </span>
                                </li>
                                </a>
                                <li class="kt-nav__item">
                                <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-trash"></i>
                                    <span class="kt-nav__link-text kt_del_customerdetails" id="26" data-id="26">Delete</span>
                                </span>
                                </li>
                            </ul>
                            </div>
                        </div>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>
                            <a href="#" data-toggle="popover"
                            data-placement="bottom"
                            title="Document Name :  Download
                            Created On :  00/00/0000"
                            data-content="Signer : qzolve@gmail.com">
                                <span class="badge badge-success p-2 text-uppercase">Completed</span>
                            </a>
                        </td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>
                            <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <a href="" data-type="edit">
                                <li class="kt-nav__item">
                                    <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon-background"></i>
                                    <span class="kt-nav__link-text" data-id="26">View</span>
                                    </span>
                                </li>
                                </a>

                                <a href="" data-type="edit">
                                <li class="kt-nav__item">
                                    <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-edit"></i>
                                    <span class="kt-nav__link-text" data-id="26">Edit</span>
                                    </span>
                                </li>
                                </a>
                                <li class="kt-nav__item">
                                <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-trash"></i>
                                    <span class="kt-nav__link-text kt_del_customerdetails" id="26" data-id="26">Delete</span>
                                </span>
                                </li>
                            </ul>
                            </div>
                        </div>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>
                            <a href="#" data-toggle="popover"
                            data-placement="bottom"
                            title="Document Name :  Download
                            Created On :  00/00/0000"
                            data-content="Signer : qzolve@gmail.com">
                                <span class="badge badge-primary p-2 text-uppercase">
                                    Declined
                                </span>
                            </a>
                        </td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>
                            <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <a href="" data-type="edit">
                                <li class="kt-nav__item">
                                    <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon-background"></i>
                                    <span class="kt-nav__link-text" data-id="26">View</span>
                                    </span>
                                </li>
                                </a>

                                <a href="" data-type="edit">
                                <li class="kt-nav__item">
                                    <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-edit"></i>
                                    <span class="kt-nav__link-text" data-id="26">Edit</span>
                                    </span>
                                </li>
                                </a>
                                <li class="kt-nav__item">
                                <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-trash"></i>
                                    <span class="kt-nav__link-text kt_del_customerdetails" id="26" data-id="26">Delete</span>
                                </span>
                                </li>
                            </ul>
                            </div>
                        </div>
                        </td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>
                            <a href="#" data-toggle="popover"
                            data-placement="bottom"
                            title="Document Name :  Download
                            Created On :  00/00/0000"
                            data-content="Signer : qzolve@gmail.com">
                                <span class="badge badge-dark p-2 text-uppercase">Expired</span>
                            </a>
                        </td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>Lorem Ipsum is</td>
                        <td>
                            <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="fa fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <a href="" data-type="edit">
                                <li class="kt-nav__item">
                                    <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon-background"></i>
                                    <span class="kt-nav__link-text" data-id="26">View</span>
                                    </span>
                                </li>
                                </a>

                                <a href="" data-type="edit">
                                <li class="kt-nav__item">
                                    <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-edit"></i>
                                    <span class="kt-nav__link-text" data-id="26">Edit</span>
                                    </span>
                                </li>
                                </a>
                                <li class="kt-nav__item">
                                <span class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-trash"></i>
                                    <span class="kt-nav__link-text kt_del_customerdetails" id="26" data-id="26">Delete</span>
                                </span>
                                </li>
                            </ul>
                            </div>
                        </div>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>

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
<script src="{{url('/')}}/resources/js/esign/newpage/list.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
            $("#tbl").wrap("<div class='table-responsive'></div>");
            $('[data-toggle="popover"]').popover();
     });
</script>
@endsection
