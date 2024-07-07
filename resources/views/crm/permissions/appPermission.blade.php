@extends('crm.common.layout')
 @section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
            .contain {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 12px;
                cursor: pointer;
                font-size: 22px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            .contain input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }
            .contain input:disabled ~.checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 45px;
                background-color:#eee;
            }
            .contain input:disabled ~.checkmark:hover {
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 45px;
                background-color:#eee;
            }
            .checkmark {
                content: "";
                color: #fff;
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 45px;
                background-color:red;
            }
            .contain:hover input ~ .checkmark {
                background-color: orange;
            }
            .contain input:checked ~ .checkmark {
                background-color: #4CAF50;
            }
            .contain input:checked ~ .checkmark:hover {
                background-color: #21d127;
            }
            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }
            .contain input:checked ~ .checkmark:after {
                display: block;
            }
            .contain .checkmark:after {
                left: 17px;
                top: 2px;
                width: 5px;
                height: 17px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }
            .new::after {
                content: "✘";
                background-color: white;
                color: red;
                font-weight: bold;
                font-size: 16px;
                width: 15px;
                height: 15px;
                position: absolute;
                cursor: pointer;
            }
            .new:checked::after {
                content: "✔";
                background-color: white;
                color: #4CAF50;
                font-weight: bold;
                font-size: 16px;
                width: 15px;
                height: 15px;
                position: absolute;
            }
</style>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br/>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">    <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-line-chart"></i>
                                        </span>
                <h3 class="kt-portlet__head-title">
                        {{ trans('app.userslist')}}
                    </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i> Export</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">Choose an option</span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-print">  <span href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-print"></i>
                                                                    <span class="kt-nav__link-text">Print</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-copy">   <span class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-copy"></i>
                                                                    <span class="kt-nav__link-text">Copy</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-csv">
                                        <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item" id="export-button-pdf">    <span class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                                    <span class="kt-nav__link-text">PDF</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>&nbsp;
                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_2"><i class="la la-plus"></i>New Record</button>
                        <a href="userInfoTrash" type="button" class="btn btn-danger btn-elevate btn-icon-sm"> <i class="la la-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <p>Content Permission: Lock including nested Project <a href="#">Edit</a>
            </p>
            <h3>Permission Rule</h3>
            <table class="table table-striped- table-bordered table-hover table-checkable tpad">
                <thead>
                    <tr>
                        <th>Group/User</th>
                        <th style="text-align:center"> <a href="/payroles">
                                Payroll
                            </
                        </th>
                        <th style="text-align:center">
                            <a href="/payroles">
                                HRM
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                Sales
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                App
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                Pos
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                App1
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                App2
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                App3
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                App4
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                App5
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                App6
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                App7
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                App8
                            </a>
                        </th>
                        <th style="text-align:center"> <a href="/payroles">
                                App9
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="dropdown">
                            <a href="/super_adminInfo"> <i class="fa fa-user-circle-o" aria-hidden="true"></i> Super Admin</a>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="dropdown">
                            <a href="/super_adminInfo"> <i class="fa fa-user-circle" aria-hidden="true">
                                </i> Admin</a>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="dropdown">
                            <a href="/super_adminInfo"> <i class="fa fa-user" aria-hidden="true"></i> Employee</a>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="dropdown">
                            <a href="/super_adminInfo"> <i class="fa fa-user-o" aria-hidden="true"></i> User</a>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="dropdown">
                            <a href="/super_adminInfo"> <i class="fa fa-tasks" aria-hidden="true"></i> Manager</a>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox"> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox"> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" checked> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="contain">
                                <input type="checkbox" disabled> <span class="checkmark"></span>
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="col-md-5" style="padding: 0px;">
                <button class="btn btn-default">+Add group/ User Rule</button>
            </div>
            <div class="col-md-7"></div>
        </div>
    </div>
</div>.
<div class="modal fade" id="kt_modal_4_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <input type="hidden" name="id" id="id" value="">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Information details form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="kt-form kt-form--label-right" id="user-form" name="user-form">
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Customer Type:</label>
                                <input type="text" class="form-control" placeholder="Enter Customer Type " id="cust_type" name="cust_type">
                            </div>
                            <div class="col-lg-4">
                                <label>Customer Name:</label>
                                <input type="text" class="form-control" placeholder="Enter Customer Name" id="cust_name" name="cust_name">
                            </div>
                            <div class="col-lg-4">
                                <label>Customer Country :</label>
                                <input type="text" class="form-control" placeholder="Enter Customer Country" id="cust_country" name="cust_country">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Customer City:</label>
                                <input type="text" class="form-control" placeholder="Enter  City" id="cust_city" name="cust_city">
                            </div>
                            <div class="col-lg-4">
                                <label>Customer Region:</label>
                                <input type="text" class="form-control" placeholder="Enter Customer Region " id="cust_region" name="cust_region">
                            </div>
                            <div class="col-lg-4">
                                <label class="">Customer Zip:</label>
                                <input type="text" class="form-control" placeholder="Enter Customer  Zip" id="cust_zip" name="cust_zip">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Customer Email:</label>
                                <input type="text" class="form-control" placeholder="Enter Customer  Email" id="cust_email" name="cust_email">
                            </div>
                            <div class="col-lg-4">
                                <label>Customer Office Phone:</label>
                                <input type="text" class="form-control" placeholder="Enter Customer   Office Phone " id="cust_officephone" name="cust_officephone">
                            </div>
                            <div class="col-lg-4">
                                <label class="">Customer Mobile Number:</label>
                                <input type="text" class="form-control" placeholder="Enter  Customer  Mobile Number" id="cust_mobile" name="cust_mobile">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Customer Fax:</label>
                                <input type="text" class="form-control" placeholder="Enter Customer Fax" id="cust_fax" name="cust_fax">
                            </div>
                            <div class="col-lg-4">
                                <label>Customer Website:</label>
                                <input type="text" class="form-control" placeholder="Enter Customer Website" id="cust_website" name="cust_website">
                            </div>
                            <div class="col-lg-4">
                                <label>Customer Address:</label>
                                <textarea class="form-control edited" rows="1" id="cust_add1" name="cust_add1" placeholder="Enter Your Address"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label class="">Customer Address2:</label>
                                <textarea class="form-control edited" rows="1" id="cust_add2" name="cust_add2" placeholder="Enter Your Address"></textarea>
                                <input type="hidden" name="fileData" id="fileData" />
                                <input type="hidden" name="UniqueID" id="UniqueID" />
                            </div>
                        </div>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                        <div class="form-group row">
                            <table id="table-more">
                                <tr class="addmore">
                                    <td>
                                        <input type="text" class="form-control skill" placeholder="Skill" name="skill[0]" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control skillValue" placeholder="Value" name="skillValue[0]" />
                                    </td>
                                    <td>
                                        <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold"> <i class="la la-trash-o"></i> Delete</a>
                                        <a href="javascript:;" id="add-more" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand"> <i class="la la-plus"></i> Add</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div id="choose-files">
                                    <form action="/upload">
                                        <input type="file" id="files" name="files[]" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-8"></div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="Customerdetail_submit" class="btn btn-primary float-right mr-2">Submit</button>
                <button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
    </form>
</div>
<style type="text/css">
    .hideButton{
                display: none
            }
            .error{
                color: red
            }
</style>
@endsection