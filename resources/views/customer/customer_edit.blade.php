@extends('common.layout')


@section('content')
<style>
    .kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form {
        width: 95%;
        padding: 1rem 0 5rem;
    }
    .kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form .kt-wizard-v1__content {
        border-top: 1px solid #eeeef4;
        padding-right: 20px;
        padding-left: 20px;
    }
    .kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form .kt-form__actions [data-ktwizard-type="action-prev"] {
                position: absolute;
                right: 218px;
            }
            .kt-wizard-v1 .kt-wizard-v1__wrapper .kt-form .kt-form__actions [data-ktwizard-type="action-next"] {
                position: absolute;
                right: 58px;
            }
            .kt-wizard-v1[data-ktwizard-state="last"] [data-ktwizard-type="action-submit"] {
                display: inline-block;
                position: absolute;
                right: 77px;
            }
</style>

            <!-- end:: Header -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                <!-- begin:: Subheader -->
                <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                    <div class="kt-container  kt-container--fluid ">
                        <div class="kt-subheader__main">
                            <h3 class="kt-subheader__title">
                               {{ __('app.Home') }}   </h3>
                            <span class="kt-subheader__separator kt-hidden"></span>
                            <div class="kt-subheader__breadcrumbs">
                                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                                <span class="kt-subheader__breadcrumbs-separator"></span>
                                 <a href="customerdetails" class="kt-subheader__breadcrumbs-link">
                                   {{ __('app.Customer Details') }}  </a>
                                <span class="kt-subheader__breadcrumbs-separator"></span>
                                

                                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                            </div>
                        </div>
                        <div class="kt-subheader__toolbar">
                            <div class="kt-subheader__wrapper">
                                <a href="#" class="btn kt-subheader__btn-primary">
                                    {{ __('app.Actions') }} &nbsp;

                                    <!--<i class="flaticon2-calendar-1"></i>-->
                                </a>
                                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="left">
                                    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                            </g>
                                        </svg>

                                        <!--<i class="flaticon2-plus"></i>-->
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">

                                        <!--begin::Nav-->
                                        <ul class="kt-nav">
                                            <li class="kt-nav__head">
                                                Add anything or jump to:
                                                <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                            </li>
                                            <li class="kt-nav__separator"></li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                    <span class="kt-nav__link-text">Order</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                    <span class="kt-nav__link-text">Ticket</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
                                                    <span class="kt-nav__link-text">Goal</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                    <span class="kt-nav__link-text">Support Case</span>
                                                    <span class="kt-nav__link-badge">
                                                                <span class="kt-badge kt-badge--success">5</span>
                                                            </span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__separator"></li>
                                            <li class="kt-nav__foot">
                                                <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
                                                <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                            </li>
                                        </ul>

                                        <!--end::Nav-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end:: Subheader -->

                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    <div class="kt-portlet">
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="step-first">
                                <div class="kt-grid__item">

                                    <!--begin: Form Wizard Nav -->
                                    <div class="kt-wizard-v1__nav">

                                        <!--doc: Remove "kt-wizard-v1__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
                                        <div class="kt-wizard-v1__nav-items kt-wizard-v1__nav-items--clickable">
                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                                <div class="kt-wizard-v1__nav-body">
                                                    <div class="kt-wizard-v1__nav-icon">
                                                        <i class="flaticon-bus-stop"></i>
                                                    </div>
                                                    <div class="kt-wizard-v1__nav-label">
                                                       {{ __('app.General Info') }} 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                                <div class="kt-wizard-v1__nav-body">
                                                    <div class="kt-wizard-v1__nav-icon">
                                                        <i class="flaticon-list"></i>
                                                    </div>
                                                    <div class="kt-wizard-v1__nav-label">
                                                       {{ __('app.Customer Info') }} 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                                <div class="kt-wizard-v1__nav-body">
                                                    <div class="kt-wizard-v1__nav-icon">
                                                        <i class="flaticon-responsive"></i>
                                                    </div>
                                                    <div class="kt-wizard-v1__nav-label">
                                                        {{ __('app.Contact Info') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                                <div class="kt-wizard-v1__nav-body">
                                                    <div class="kt-wizard-v1__nav-icon">
                                                        <i class="flaticon-globe"></i>
                                                    </div>
                                                    <div class="kt-wizard-v1__nav-label">
                                                       {{ __('app.Invoices Info') }} 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                                <div class="kt-wizard-v1__nav-body">
                                                    <div class="kt-wizard-v1__nav-icon">
                                                        <i class="flaticon-truck"></i>
                                                    </div>
                                                    <div class="kt-wizard-v1__nav-label">
                                                        {{ __('app.Credentials') }}
                                                    </div>
                                                </div>
                                            </div>

                                        {{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
                                        {{--                                                <div class="kt-wizard-v1__nav-body">--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
                                        {{--                                                        <i class="flaticon-globe"></i>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-label">--}}
                                        {{--                                                        Portal--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
                                        {{--                                                <div class="kt-wizard-v1__nav-body">--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
                                        {{--                                                        <i class="flaticon-globe"></i>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-label">--}}
                                        {{--                                                        Type--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
                                        {{--                                                <div class="kt-wizard-v1__nav-body">--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
                                        {{--                                                        <i class="flaticon-globe"></i>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-label">--}}
                                        {{--                                                        Transaction--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
                                        {{--                                                <div class="kt-wizard-v1__nav-body">--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
                                        {{--                                                        <i class="flaticon-globe"></i>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-label">--}}
                                        {{--                                                        Credit limit--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
                                        {{--                                                <div class="kt-wizard-v1__nav-body">--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
                                        {{--                                                        <i class="flaticon-globe"></i>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-label">--}}
                                        {{--                                                        Payment Terms--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
                                        {{--                                                <div class="kt-wizard-v1__nav-body">--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
                                        {{--                                                        <i class="flaticon-globe"></i>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-label">--}}
                                        {{--                                                        Accounting--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}

                                        {{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
                                        {{--                                                <div class="kt-wizard-v1__nav-body">--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
                                        {{--                                                        <i class="flaticon-globe"></i>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-label">--}}
                                        {{--                                                        SOA--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
                                        {{--                                                <div class="kt-wizard-v1__nav-body">--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
                                        {{--                                                        <i class="flaticon-globe"></i>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-label">--}}
                                        {{--                                                        VAT--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}

                                        {{--                                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">--}}
                                        {{--                                                <div class="kt-wizard-v1__nav-body">--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-icon">--}}
                                        {{--                                                        <i class="flaticon-globe"></i>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="kt-wizard-v1__nav-label">--}}
                                        {{--                                                        Document--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}

                                        <!--end: Form Wizard Nav -->
                                        </div>
                                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">


<?php
foreach ($data as $key => $value)
{

    $cust_id = $data->id;
    $cust_code = $data->cust_code;
    $cust_type = $data->cust_type;
    $cust_category = $data->cust_category;
    $salesman = $data->salesman;
    $key_account = $data->key_account;
    $cust_note = $data->cust_note;
    $cust_name = $data->cust_name;
    $cust_add1 = $data->cust_add1;
    $cust_add2 = $data->cust_add2;
    $cust_country = $data->cust_country;
    $cust_region = $data->cust_region;
    $cust_city = $data->cust_city;
    $cust_zip = $data->cust_zip;
    $email1 = $data->email1;
    $email2 = $data->email2;
    $office_phone1 = $data->office_phone1;
    $office_phone2 = $data->office_phone2;
    $mobile1 = $data->mobile1;
    $mobile2 = $data->mobile2;
    $fax = $data->fax;
    $website = $data->website;
    $contact_person = $data->contact_person;
    $contact_person_incharge = $data->contact_person_incharge;
    $mobile = $data->mobile;
    $office = $data->office;
    $contact_department = $data->contact_department;
    $email = $data->email;
    $location = $data->location;
    $portal = $data->portal;
    $username = $data->username;
    $registerd_email = $data->registerd_email;
    $password = $data->password;

} ?>
<?php
foreach ($datas as $key => $value)
{

    $contact_person_incharges = $datas->contact_person_incharges;
    $contact_personvalue = $datas->contact_personvalue;
    $mobiles = $datas->mobiles;
    $offices = $datas->offices;
    $emails = $datas->emails;
    $departments = $datas->departments;
    $locations = $datas->locations;
}

?>


                                            <!--begin: Form Wizard Form-->
                                            <form class="kt-form" id="kt_form">
<input type="hidden" name="id" id="id" value="<?php echo $cust_id ?>">

                                                <!--begin: Form Wizard Step 1-->
                                                <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                              <div class="kt-heading kt-heading--md">{{ __('app.Customer Details') }} </div>
                               <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                                                
                     <div class="col-lg-6">
                     <div class="form-group">
                       <label >{{ __('app.Customer Code') }}</label>
                    <div class="input-group">
                         <div class="input-group-prepend">

                    <span class="input-group-text" id="basic-addon2" style=" padding-top: 0px;
                    padding-bottom: 7px;">
                        <span class="kt-switch kt-switch--sm kt-switch--icon">
                        <label style="margin-bottom: -12px;">
                        <input type="checkbox" checked="checked" name="" id="idcheck">
                       
                            <span></span></label
                                                                                    >
                 </span>
                      </div>
                                                                        
               <input type="text" class="form-control"  name="cust_code" id="cust_code" placeholder="{{ __('app.Customer Code') }}" required autocomplete="off" value="<?php echo $cust_code ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                  <div class="col-lg-6">
                         <div class="form-group">
                           
                            <label>{{ __('app.Customer Type') }}</label>
                            <select class="form-control" id="cust_type" name="cust_type" value="<?php echo $cust_type; ?>">
                              @foreach($areaLists as $item)
                              <option value="{{$item->title}}" 
                                

                                <?php
                                if ($cust_type == $item->title)
                                {
                                    echo "selected";
                                }                                
                                ?>

                                
                                >{{$item->title}}</option>
                                @endforeach
                            </select>
               

                                                                    </div>
                                                                </div>

            <div class="col-lg-6">
                <div class="form-group">
                    
                    <label>{{ __('app.Customer Category') }}</label>
                    <select class="form-control" id="cust_category" name="cust_category" required="">
                              <option value="">{{ __('app.Select') }}</option> 
                              @foreach($areaList as $item)
                              <option value="{{$item->customer_category}}"

                               <?php
                               if ($cust_category == $item->customer_category)
                               {
                                   echo "selected";
                               }
                               ?>

                                >{{$item->customer_category}}</option>
                              @endforeach 
                            </select>
    

                                                                    </div>
                                                                </div>
              <div class="col-lg-6">
                 <div class="form-group">
                    <label>{{ __('app.Sales man') }}</label>
                    <select class="form-control single-select" id="salesman" name="salesman">
                        <option value="">Select</option>
                         <option value="Ram" <?php
if ($salesman == 'Ram')
{
    echo "selected";
}
?>>Ram</option>
                        <option value="Roy" <?php
if ($salesman == 'Roy')
{
    echo "selected";
}
?>>Roy</option>
                    </select>

                                                                    </div>
                                                                </div>

             <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('app.Key Accounts') }}</label>
                    <select class="form-control single-select" id="key_account" name="key_account">
                    <option value="">Select</option>
                        <option value="Ram"  <?php
if ($key_account == 'Ram')
{
    echo "selected";
}
?>>Ram</option>
                        <option value="Roy"  <?php
if ($key_account == 'Roy')
{
    echo "selected";
}
?>>Roy</option>
                    </select>

                                                                    </div>
                                                                </div>
<div class="col-lg-6">
                            <div class="form-group">
                              <label>{{ __('app.Customer Note') }}</label>
                                <div class="input-group">
                                   <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user" aria-hidden="true"></i></span></div>
                      <input type="text" class="form-control" id="cust_note" name="cust_note" autocomplete="off" placeholder="{{ __('app.Customer Note') }}" value="<?php echo $cust_note ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 1-->

                                                <!--begin: Form Wizard Step 2-->
                                                <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                                                    <div class="kt-heading kt-heading--md">{{ __('app.Contact Details') }}</div>
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="kt-wizard-v1__form">

                  <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <label>{{ __('app.Customer Name/Company name') }}</label>
                                <div class="input-group">
                                   <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user" aria-hidden="true"></i></span></div>
                      <input type="text" class="form-control" id="cust_name" name="cust_name" autocomplete="off" placeholder="{{ __('app.Customer Name/Company name') }}" value="<?php echo $cust_name; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
<div class="form-group">
    <label>{{ __('app.Contact Person') }}</label>
    <div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user-circle" aria-hidden="true"></i></span></div>
          <input type="text" class="form-control" id="contact_person" name="contact_person" autocomplete="off" placeholder="{{ __('app.Contact Person') }}" value="<?php echo $contact_person; ?>" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
    <div class="form-group">
        <label>{{ __('app.Address 1') }}</label>
        <textarea type="text" class="form-control"  autocomplete="off" id="cust_add1" name="cust_add1" onchange="myFunctions(this.value)" ><?php echo $cust_add1; ?></textarea>

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
              <div class="form-group">
                  <label>{{ __('app.Address 2') }}</label>
                  <textarea type="text" class="form-control" autocomplete="off"  id="cust_add2" name="cust_add2" onchange="myFunctionadd(this.value)"><?php echo $cust_add2; ?></textarea>

                                                                    </div>
                                                                </div>

        <div class="col-lg-6">
            <div class="form-group">
                 <label>{{ __('app.Country') }}</label>
                <div class="input-group ">
                     <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-globe" aria-hidden="true"></i></span></div>
                 <input type="text" class="form-control" id="cust_country" name="cust_country" autocomplete="off" placeholder="{{ __('app.Country') }}" onchange="myFunctioncountry(this.value)" value="<?php echo $cust_country; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label>{{ __('app.Region') }}</label>
            <div class="input-group ">
      <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map" aria-hidden="true"></i></span></div>
                        <input type="text" class="form-control" id="cust_region" name="cust_region"  autocomplete="off" placeholder="{{ __('app.Region') }}" onchange="myFunctionregion(this.value)" value="<?php echo $cust_region; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
              <div class="form-group">
                   <label>{{ __('app.City') }}</label>
                  <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-street-view" aria-hidden="true"></i></span></div>
                           <input type="text" class="form-control" id="cust_city" name="cust_city" autocomplete="off" placeholder="{{ __('app.City') }}" onchange="myFunctioncity(this.value)" value="<?php echo $cust_city; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
          <div class="form-group">
               <label>{{ __('app.Zipcode') }}</label>
               <div class="input-group ">
         <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map-signs" aria-hidden="true"></i></span></div>
      <input type="text" class="form-control" id="cust_zip" name="cust_zip" autocomplete="off" placeholder="{{ __('app.Zipcode') }}" onchange="myFunctionzip(this.value)" value="<?php echo $cust_zip; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
              <div class="form-group">
                   <label>{{ __('app.Email') }}</label>
          <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">@</span></div>
          <input type="text" class="form-control" id="email1" name="email1" onchange="myFunction(this.value)" autocomplete="off" placeholder="{{ __('app.Email') }}" value="<?php echo $email1; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
         <div class="form-group">
            <label>{{ __('app.Secondary Email') }}</label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">@</span></div>
        <input type="text" class="form-control" id="email2" name="email2" autocomplete="off" placeholder="{{ __('app.Secondary Email') }}" onchange="myFunctionemail(this.value)" value="<?php echo $email2; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
               <div class="form-group">
                 <label>{{ __('app.Office Phone 1') }}</label>
              <div class="input-group">
                  <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-phone" aria-hidden="true"></i></span></div>
                <input type="text" class="form-control" id="office_phone1" name="office_phone1" autocomplete="off" placeholder="{{ __('app.Office Phone 1') }}" onchange="myFunctionphone(this.value)" value="<?php echo $office_phone1; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
            <div class="form-group">
                <label>{{ __('app.Office Phone 2') }}</label>
                 <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-phone" aria-hidden="true"></i></span></div>
        <input type="text" class="form-control" id="office_phone2" name="office_phone2" autocomplete="off" placeholder="{{ __('app.Office Phone 2') }}" onchange="myFunctionphone2(this.value)" value="<?php echo $office_phone2; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
<div class="form-group">
    <label>{{ __('app.Mobile 1') }}</label>
    <div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-mobile" aria-hidden="true"></i></span></div>
                <input type="text" class="form-control" id="mobile1" name="mobile1" autocomplete="off" placeholder="{{ __('app.Mobile 1') }}" onchange="myFunctionmobile(this.value)" value="<?php echo $mobile1; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
    <div class="form-group">
        <label>{{ __('app.Mobile 2') }}</label>
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-mobile" aria-hidden="true"></i></span></div>
          <input type="text" class="form-control" id="mobile2" name="mobile2" autocomplete="off" placeholder="{{ __('app.Mobile 2') }}" onchange="myFunctionmobile1(this.value)" value="<?php echo $mobile2; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
     <div class="form-group">
         <label>{{ __('app.Fax') }}</label>
        <div class="input-group ">
            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-fax" aria-hidden="true"></i></span></div>
        <input type="text" class="form-control" id="fax" name="fax" autocomplete="off" placeholder="{{ __('app.Fax') }}" value="<?php echo $fax; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

         <div class="col-lg-6">
             <div class="form-group">
                <label>{{ __('app.Website') }}</label>
                <div class="input-group ">
                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-window-maximize" aria-hidden="true"></i></span></div>
                    <input type="text" class="form-control" id="website" name="website" autocomplete="off" placeholder="{{ __('app.Website') }}" value="<?php echo $website; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 2-->

                                                <!--begin: Form Wizard Step 3-->
                                                <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
      <div class="kt-heading kt-heading--md">{{ __('app.Contact Person') }}</div>
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="kt-wizard-v1__form">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                           <label>{{ __('app.Contact Person') }}</label>
                          <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user-plus" aria-hidden="true"></i></span></div>
                             <input type="text" class="form-control" placeholder="{{ __('app.Contact Person') }}" id="contact_persons" name="contact_persons" autocomplete="off" value="<?php echo $contact_person; ?>">
                                                                           
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.Contact Person in Charge') }}</label>
            <div class="input-group ">
                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-info" aria-hidden="true"></i></span></div>
                <input type="text" class="form-control" placeholder="{{ __('app.Contact Person in Charge') }}" id="contact_person_incharge" name="contact_person_incharge" autocomplete="off" value="<?php echo $contact_person_incharge; ?>">
                                                                            
                                                                        </div>

                                                                    </div>
                                                                </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __('app.Mobile') }}</label>
                <div class="input-group ">
                     <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-mobile" aria-hidden="true"></i></span></div>
        <input type="text" class="form-control"  placeholder="{{ __('app.Mobile') }}" id="mobile" name="mobile" autocomplete="off" value="<?php echo $mobile; ?>">
                                                                           
                                                                        </div>

                                                                    </div>
                                                                </div>
               <div class="col-md-6">
                  <div class="form-group">
                       <label>{{ __('app.Office Number') }}</label>
                      <div class="input-group ">
                          <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-phone" aria-hidden="true"></i></span></div>
                   <input type="text" class="form-control" placeholder="{{ __('app.Office Number') }}" id="office" name="office" autocomplete="off" value="<?php echo $office; ?>">
                                                                            
                                                                        </div>

                                                                    </div>
                                                                </div>

    <div class="col-md-6">
         <div class="form-group">
            <label>{{ __('app.Email') }}</label>
            <div class="input-group ">
                 <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">@</span></div>
                   <input type="text" class="form-control" placeholder="{{ __('app.Email') }}" id="email" name="email" autocomplete="off" value="<?php echo $email; ?>">
                                                                            
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                 <div class="form-group">
                     <label>{{ __('app.Department') }}</label>
                    <div class="input-group ">
                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-bookmark" aria-hidden="true"></i></span></div>
                  <input type="text" class="form-control" placeholder="{{ __('app.Department') }}" id="contact_department" name="contact_department" autocomplete="off" value="<?php echo $contact_department; ?>">
                                                                            
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
            <div class="form-group">
                 <label>{{ __('app.Location') }}</label>
                 <div class="input-group ">
                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker" aria-hidden="true"></i></span></div>
       <input type="text" class="form-control" placeholder="{{ __('app.Location') }}" id="location" name="location" autocomplete="off" value="<?php echo $location; ?>">
                                                                            
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                          <div class="form-group">
                               <button class="btn btn-outline-secondary" id="add_more_table">+{{ __('app.Add More') }} </button>
                             </div>
                                </div>

                                  </div>
                        <div class="row">
                 <div class="col-md-12">
                 <table  class="table table-striped table-bordered" id="addmore_table">
                    <thead>
                        <tr id="addmore">
                          <td id="incharge">{{ __('app.Person in Charge') }}</td>
                          <td  id="person">{{ __('app.Contact Person') }}</td>
                          <td id="mobilenumber">{{ __('app.Mobile Number') }}</td>
                          <td id="officenumber">{{ __('app.Office Charge') }}</td>                                                                              
                           <td id="emailnumber">{{ __('app.email') }}</td>
                           <td id="departmentnumber">{{ __('app.Department') }}</td>
                           <td id="locationnumber">{{ __('app.Location') }}</td>
                           <td>{{ __('app.Action') }}</td>

                          </tr>
                           
                            </thead>
                            <tbody id="tbadd">


 <td>
    <input type="text" value="<?php echo $contact_person_incharge ?>" id="contact_person_incharges" name="contact_person_incharges[0]" placeholder="Contact Person Incharge" class="skill form-control contact_person_incharges" />
    </td>
    <td>
    <input type="text" value="<?php echo $contact_person ?>" id="contact_personvalue" name="contact_person[0]" placeholder="Contact Person Incharge" class="skill form-control contact_personvalue" />
    </td>
    <td>
    <input type="text" value="<?php echo $mobile ?>" id="mobiles"  name="mobiles[0]" placeholder="Mobile Number" class="skill form-control mobiles" />
    </td>
    <td>
    <input type="text" value="<?php echo $office ?>" id="offices" name="offices[0]" placeholder="Office Number" class="skill form-control offices" />
    </td>
    <td>
    <input type="text"  value="<?php echo $email ?>"id="emails" name="emails[0]" placeholder="Email" class="skill form-control emails" />
    </td>
    <td>
    <input type="text" value="<?php echo $contact_department ?>" id="departments" name="departments[0]" placeholder="Department" class="skill form-control departments" />
    </td>
    <td>
    <input type="text"  value="<?php echo $location ?>" id="locations" name="locations[0]" placeholder="Location" class="skillValue form-control locations" />
    </td>
    <td>
    <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>
    </td>








                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 3-->

                                                <!--begin: Form Wizard Step 4-->
                                                <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                                                    <div class="kt-heading kt-heading--md">{{ __('app.Invoice Address') }}
                                                        <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                                            <input type="checkbox" id="Checkedinvoice"> Same as customer address
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="kt-wizard-v1__form">

                                                            <div class="row">
                                                                <div class="col-lg-6">
             <div class="form-group">
                <label>{{ __('app.Address 1') }}</label>
                 <textarea type="text" class="form-control" id="invoice_add1" name="invoice_add1" placeholder="{{ __('app.Address 1') }}" autocomplete="off"></textarea>

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
     <div class="form-group">
         <label>{{ __('app.Address 2') }}</label>
         <textarea type="text" class="form-control" id="invoice_add2" name="invoice_add2" placeholder="{{ __('app.Address 2') }}" autocomplete="off"></textarea>

                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
        <div class="form-group">
            <label>{{ __('app.Country') }}</label>
            <div class="input-group ">
                 <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-globe" aria-hidden="true"></i></span></div>
               <input type="text" class="form-control"  placeholder="{{ __('app.Country') }}" id="invoice_country" name="invoice_country" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('app.Region') }}</label>
                    <div class="input-group ">
                         <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map" aria-hidden="true"></i></span></div>
                  <input type="text" class="form-control" placeholder="{{ __('app.Region') }}" id="invoice_region" name="invoice_region"  autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                <div class="form-group">
                     <label>{{ __('app.City') }}</label>
                    <div class="input-group ">
                  <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-street-view" aria-hidden="true"></i></span></div>
                <input type="text" class="form-control" placeholder="{{ __('app.City') }}" id="invoice_city" name="invoice_city" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
          <div class="form-group">
               <label>{{ __('app.Zipcode') }}</label>
          <div class="input-group ">
               <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map-signs" aria-hidden="true"></i></span></div>
         <input type="text" class="form-control" placeholder="{{ __('app.Zipcode') }}" id="invoice_zip" name="invoice_zip" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>

          <div class="col-lg-6">
              <div class="form-group">
                   <label>{{ __('app.Email') }}</label>
                  <div class="input-group ">
                      <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">@</span></div>
        <input type="text" class="form-control" placeholder="{{ __('app.Email') }}" id="invoice_email1" name="invoice_email1"  autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>

      <div class="col-lg-6">
          <div class="form-group">
               <label>{{ __('app.Secondary Email') }}</label>
              <div class="input-group ">
           <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">@</span></div>
           <input type="text" class="form-control" placeholder="{{ __('app.Secondary Email') }}" id="invoice_email2" name="invoice_email2" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
               <div class="form-group">
                  <label>{{ __('app.Office Phone 1') }}</label>
                  <div class="input-group ">
                      <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-phone" aria-hidden="true"></i></span></div>
              <input type="text" class="form-control" placeholder="{{ __('app.Office Phone 1') }}" id="invoice_office_phone1" name="invoice_office_phone1" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
             <div class="form-group">
                <label>{{ __('app.Office Phone 2') }}</label>
                <div class="input-group ">
                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-phone" aria-hidden="true"></i></span></div>
                      <input type="text" class="form-control"  placeholder="{{ __('app.Office Phone 2') }}" id="invoice_office_phone2" name="invoice_office_phone2" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>

            <div class="col-lg-6">
                 <div class="form-group">
                    <label>{{ __('app.Mobile 1') }}</label>
                    <div class="input-group ">
                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-mobile" aria-hidden="true"></i></span></div>
                   <input type="text" class="form-control" placeholder="{{ __('app.Mobile 1') }}" id="invoice_mobile1" name="invoice_mobile1" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>

      <div class="col-lg-6">
          <div class="form-group">
              <label>{{ __('app.Mobile 2') }}</label>
              <div class="input-group ">
                  <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-mobile" aria-hidden="true"></i></span></div>
               <input type="text" class="form-control" placeholder="{{ __('app.Mobile 2') }}" id="invoice_mobile2" name="invoice_mobile2" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix" style="border-top: 1px solid #eeeef4;    padding-bottom: 10px;margin-top: 15px;"></div>

                                                            <div class="kt-heading kt-heading--md">{{ __('app.Shipping Address') }}
                                                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                                                    <input type="checkbox" id="Checkedshipping"> Same as customer address
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                            <div class="row">
           <div class="col-lg-6">
               <div class="form-group">
                  <label>{{ __('app.Address 1') }}</label>
                  <textarea type="text" class="form-control"  id="shipping1" name="shipping1" placeholder="{{ __('app.Address 1') }}" autocomplete="off"></textarea>

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
               <div class="form-group">
                   <label>{{ __('app.Address 2') }}</label>
              <textarea type="text" class="form-control" id="shipping2" name="shipping2" placeholder="{{ __('app.Address 2') }}" autocomplete="off"></textarea>

                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
        <div class="form-group">
             <label>{{ __('app.Country') }}</label>
            <div class="input-group ">
                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-globe" aria-hidden="true"></i></span></div>
              <input type="text" class="form-control" placeholder="C{{ __('app.Country') }}" id="shipping_country" name="shipping_country" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                  <div class="form-group">
                       <label>{{ __('app.Region') }}</label>
                       <div class="input-group ">
                          <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map" aria-hidden="true"></i></span></div>
                <input type="text" class="form-control" placeholder="{{ __('app.Region') }}" id="shipping_region" name="shipping_region"  autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
          <div class="form-group">
               <label>{{ __('app.City') }}</label>
              <div class="input-group ">
     <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-street-view" aria-hidden="true"></i></span></div>
                <input type="text" class="form-control"  placeholder="{{ __('app.City') }}" id="shipping_city" name="shipping_city" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('app.Zipcode') }}</label>
                    <div class="input-group ">
                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map-signs" aria-hidden="true"></i></span></div>
                <input type="text" class="form-control" placeholder="{{ __('app.Zipcode') }}" id="shipping_zip" name="shipping_zip" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
    <div class="form-group">
         <label>{{ __('app.Email') }}</label>
        <div class="input-group ">
            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">@</span></div>
                  <input type="text" class="form-control" placeholder="{{ __('app.Email') }}" id="shipping_email1" name="shipping_email1" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
               <div class="form-group">
                   <label>{{ __('app.Secondary Email') }}</label>
                  <div class="input-group ">
                      <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">@</span></div>
                      <input type="text" class="form-control" placeholder="{{ __('app.Secondary Email') }}" id="shipping_email2" name="shipping_email2" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
      <div class="form-group">
          <label>{{ __('app.Office Phone 1') }}</label>
          <div class="input-group ">
              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-phone" aria-hidden="true"></i></span></div>
        <input type="text" class="form-control" placeholder="{{ __('app.Office Phone 1') }}" id="shipping_office_phone1" name="shipping_office_phone1" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
            <div class="form-group">
                 <label>{{ __('app.Office Phone 2') }}</label>
                <div class="input-group ">
                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-phone" aria-hidden="true"></i></span></div>
                   <input type="text" class="form-control" placeholder="{{ __('app.Office Phone 2') }}" id="shipping_office_phone2" name="shipping_office_phone2" autocomplete="off"  >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
          <div class="form-group">
               <label>{{ __('app.Mobile 1') }}</label>
               <div class="input-group ">
              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-mobile" aria-hidden="true"></i></span></div>
           <input type="text" class="form-control"   placeholder="{{ __('app.Mobile 1') }}" id="shipping_mobile1" name="shipping_mobile1" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
  <div class="form-group">
      <label>{{ __('app.Mobile 2') }}</label>
      <div class="input-group ">
          <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-mobile" aria-hidden="true"></i></span></div>
          <input type="text" class="form-control" placeholder="{{ __('app.Mobile 2') }}" id="shipping_mobile2" name="shipping_mobile2" autocomplete="off" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 4-->

                                                <!--begin: Form Wizard Step 5-->
                                                <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                                                    <div class="kt-heading kt-heading--md">{{ __('app.Other Details') }}</div>
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="kt-wizard-v1__form">

                                                            <div class="row">
                                                                <div class="col-lg-6">
      <div class="form-group">
          <label>{{ __('app.Portal URL') }}</label>
          <div class="input-group ">
              <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-globe" aria-hidden="true"></i></span></div>
    <input type="text" class="form-control" placeholder="{{ __('app.Portal URL') }}" id="portal" name="portal" autocomplete="off" value="<?php echo $portal; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
      <label>{{ __('app.Username') }}</label>
      <div class="input-group kt-input-icon kt-input-icon--right" id="spintog">
          <div class="input-group-prepend">
  <span class="input-group-text" id="basic-addon2">
                                                                                    <i class="fa fa-user" aria-hidden="true"></i>
         </span>
    </div>
    <input type="text" class="form-control" placeholder="{{ __('app.Username') }}" id="username" name="username" autocomplete="off" value="<?php echo $username; ?>">
      <span class="kt-input-icon__icon kt-input-icon__icon--right">
               <span><div class="spinner-border" id="spin" style="z-index: 10000; display:none;"></div></span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
          <div class="form-group">
              <label>{{ __('app.Email') }}</label>
              <div class="input-group ">
                   <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">@</span></div>
        <input type="text" class="form-control"  placeholder="{{ __('app.Email') }}" id="registerd_email" name="registerd_email" autocomplete="off" value="<?php echo $registerd_email; ?>">

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                  <div class="form-group">
                       <label>{{ __('app.Password') }}</label>
                      <div class="input-group ">
                           <div class="input-group-prepend" id="eye1">
                  <span class="input-group-text" id="basic-addon2" ><i class="fa fa-eye" aria-hidden="true"></i></span>                                                                                
                                    </div>
                    <div class="input-group-prepend" id="eye0" style="display: none;">
                                                           <span class="input-group-text" id="basic-addon2"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>                                                                                
                                                                            </div>
                     <input type="password" class="form-control" placeholder="{{ __('app.Password') }}" id="password " name="password" autocomplete="off" value="<?php echo $password; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>













                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                                <script>
                                                    $(document).ready(function(){
                                                        $("#eye1").click(function(){
                                                            $(this).hide();
                                                            $("#eye0").show();
                                                            $("#pass").attr("type","text");
                                                        });
                                                        $("#eye0").click(function(){
                                                            $(this).hide();
                                                            $("#eye1").show();
                                                            $("#pass").attr("type","password");
                                                        });
                                                        //adcode
                                                        $("#adm").click(function(){
                                                            $cnt=$("#cnt").val();
                                                            $inch=$("#inch").val();
                                                            $mob=$("#mob").val();
                                                            $off=$("#off").val();
                                                            $ema=$("#ema").val();
                                                            $dep=$("#dep").val();
                                                            $loc=$("#loc").val();
                                                            $adcode="<tr><td>"+$cnt+"</td><td>"+$inch+"</td><td>"+$mob+"</td><td>"+$off+"</td><td>"+$ema+"</td><td>"+$dep+"</td><td>"+$loc+"</td><td><button class='btn btn-dark' id='remove'><i class='fa fa-trash' style='padding-right: 0;'></i></button></td></tr>";
                                                            $("#tbadd").append($adcode);
                                                            $("#cnt").val("");
                                                            $("#inch").val("");
                                                            $("#mob").val("");
                                                            $("#off").val("");
                                                            $("#ema").val("");
                                                            $("#dep").val("");
                                                            $("#loc").val("");
                                                        });
                                                        $("#spintog").focusin(function(){
                                                            $("#spin").show();
                                                        });
                                                        $("#spintog").focusout(function(){
                                                            $("#spin").hide();
                                                        });

                                                    });
                                                    $(document).on("click","#remove",function() {
                                                        //alert("click");
                                                        $(this).parent().addClass("delete");
                                                        $(".delete").parent().remove();
                                                    });
                                                </script>
                                                <!--end: Form Wizard Step 5-->

                                                <!--begin: Form Wizard Step 6-->
    <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
        <div class="kt-heading kt-heading--md">Customer Portal details</div>
        <div class="kt-form__section kt-form__section--first">
            <div class="kt-wizard-v1__form">

                <div class="row">
                   <div class="col-lg-6">
                  <div class="form-group">
                      <label>Portal URL</label>
                      <input type="url" class="form-control" name="city" placeholder="Portal URL" value="https://www.google.com/">

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="city" placeholder="Username" value="Username">

                                                                    </div>
                                                                </div>
                                                            </div>

        <div class="row">
             <div class="col-lg-6">
                 <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="city" placeholder="Password" value="Password">

                                                                    </div>
                                                                </div>
              <div class="col-lg-6">
                  <div class="form-group">
                       <label>Registered Email</label>
                      <input type="email" class="form-control" name="city" placeholder="Registered Email" value="Registered Email">

                                                                    </div>
                                                                </div>
                                                            </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Portal created on</label>
                <input type="text" class="form-control" name="city" placeholder="Portal created on" value="Portal created on">

                                                                    </div>
                                                                </div>
          <div class="col-lg-6">
              <div class="form-group">
                  <label>password Modified History</label>
                   <input type="text" class="form-control" name="city" placeholder="password Modified History" value="password Modified History">

                                                                    </div>
                                                                </div>
                                                            </div>

  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
               <label>Modification History IP Address</label>
              <input type="text" class="form-control" name="city" placeholder="Modification History IP Address" value="Modification History IP Address">

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
              <div class="form-group">
                  <label>Send portal link to registered email</label>
                  <input type="text" class="form-control" name="city" placeholder="Send portal link to registered email" value="Send portal link to registered email">

                                                                    </div>
                                                                </div>
                                                            </div>

    <div class="row">
         <div class="col-lg-5">
            <div class="form-group">
                <label>update registered email</label>
                <input type="text" class="form-control" name="city" placeholder="update registered email" value="update registered email">

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5">
           <div class="form-group">
              <label>update user login</label>
              <input type="text" class="form-control" name="city" placeholder="update user login" value="update user login">

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                              <div class="form-group">


                            <label class="col-1 col-form-label">account</label>
                            <div class="col-1">
 <span class="kt-switch kt-switch--icon">
   <label>
    <input type="checkbox" name="">
       <span></span>
   </label>
 </span>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 6-->

                                                <!--begin: Form Wizard Step 7-->
<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
    <div class="kt-heading kt-heading--md">Customer Type Details (Listings only)</div>
     <div class="kt-form__section kt-form__section--first">
        <div class="kt-wizard-v1__form">
            <div class="row">
                 <div class="col-lg-6">
                     <div class="form-group">
                        <label>Customer type</label>
                         <input type="text" class="form-control" name="city" placeholder="Customer type" value="Customer type">

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
      <div class="form-group">
          <label>customer type description</label>
    <input type="text" class="form-control" name="city" placeholder="customer type description" value="customer type description">

                                                                    </div>
                                                                </div>
                                                            </div>
          <div class="row">
               <div class="col-lg-12">
                   <div class="form-group">
                      <label>Customer type</label>
                      <textarea class="form-control" name="city" placeholder="Customer type">
                                                                        </textarea>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 7-->

                                                <!--begin: Form Wizard Step 8-->
  <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
              <div class="kt-heading kt-heading--md">Customer Transaction Details - (listings only)</div>
      <div class="kt-form__section kt-form__section--first">
          <div class="kt-wizard-v1__form">

               <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Total Sales</label>
                           <input type="text" class="form-control" name="city" placeholder="Total Sales" value="Total Sales">

                                                                    </div>
                                                                </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                         <label>Total Invoice Amount</label>
                        <input type="text" class="form-control" name="city" placeholder="Total Invoice Amount" value="Total Invoice Amount">

                                                                    </div>
                                                                </div>
                                                            </div>

              <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Paid Invoices</label>
                          <input type="text" class="form-control" name="city" placeholder="Paid Invoices" value="Paid Invoices">

                                                                    </div>
                                                                </div>
          <div class="col-lg-6">
              <div class="form-group">
                   <label>Due invoices</label>
                  <input type="text" class="form-control" name="city" placeholder="Due invoices" value="Due invoices">

                                                                    </div>
                                                                </div>
                                                            </div>

            <div class="row">
                <div class="col-lg-6">
                     <div class="form-group">
                         <label>Over Due invoices</label>
                        <input type="text" class="form-control" name="city" placeholder="Over Due invoices" value="Over Due invoices">

                                                                    </div>
                                                                </div>
      <div class="col-lg-6">
          <div class="form-group">
               <label>Partially Paid invoices</label>
               <input type="text" class="form-control" name="city" placeholder="Partially Paid invoices" value="Partially Paid invoices">

                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 8-->

                                                <!--begin: Form Wizard Step 9-->
                          <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
            <div class="kt-heading kt-heading--md">Customer Credit limit Details</div>
            <div class="kt-form__section kt-form__section--first">
                 <div class="kt-wizard-v1__form">

                    <div class="row">
                        <div class="col-lg-6">
                             <div class="form-group">
                     <label>Credit Limit on number of invoices</label>
                <input type="text" class="form-control" name="city" placeholder="Credit Limit on number of invoices" value="Credit Limit on number of invoices">

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
            <div class="form-group">
                <label>credit limit on Total Amount</label>
                <input type="text" class="form-control" name="city" placeholder="credit limit on Total Amount" value="credit limit on Total Amount">

                                                                    </div>
                                                                </div>
                                                            </div>

   <div class="row">
       <div class="col-lg-6">
          <div class="form-group">
              <label>Credit limit period on each invoice</label>
              <input type="text" class="form-control" name="city" placeholder="Credit limit period on each invoice" value="Credit limit period on each invoice">

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
    <div class="form-group">
        <label>credit limit exceed penal charges %</label>
         <input type="text" class="form-control" name="city" placeholder="credit limit exceed penal charges %" value="credit limit exceed penal charges %">

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 9-->

                                                <!--begin: Form Wizard Step 10-->
  <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
      <div class="kt-heading kt-heading--md">Customer Payment Terms Details</div>
      <div class="kt-form__section kt-form__section--first">
           <div class="kt-wizard-v1__form">

              <div class="row">
                  <div class="col-lg-4">
                       <div class="form-group">
                           <label>Term – 1</label>
                          <input type="text" class="form-control" name="city" placeholder="Term – 1" value="Term – 1">

                                                                    </div>
                                                                </div>
  <div class="col-lg-4">
      <div class="form-group">
           <label>percentage on invoice amount</label>
           <input type="text" class="form-control" name="city" placeholder="percentage on invoice amount" value="percentage on invoice amount">

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
      <div class="form-group">
          <label>Term Period from Invoice</label>
          <input type="text" class="form-control" name="city" placeholder="Term Period from Invoice" value="Term Period from Invoice">

                                                                    </div>
                                                                </div>
                                                            </div>

<div class="row">
     <div class="col-lg-6">
         <div class="form-group">
             <label>Add More until it reaches 100 %</label>
            <input type="text" class="form-control" name="city" placeholder="Add More until it reaches 100 %" value="Add More until it reaches 100 %">

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
          <div class="form-group">
              <label>Customer Payment Details Note</label>
               <input type="text" class="form-control" name="city" placeholder="Customer Payment Details Note" value="Customer Payment Details Note">

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 10-->



                                                <!--begin: Form Wizard Step 11-->
     <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
        <div class="kt-heading kt-heading--md">Customer Payment Terms Details</div>
        <div class="kt-form__section kt-form__section--first">
            <div class="kt-wizard-v1__form">


                 <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                            <label>Total debit</label>
                <input type="text" class="form-control" name="city" placeholder="Total debit" value="Total debit">
                                                                    </div>
                                                                </div>
    <div class="col-lg-6">
         <div class="form-group">
             <label>Total Credit</label>
            <input type="text" class="form-control" name="city" placeholder="Total Credit" value="Total Credit">
                                                                    </div>
                                                                </div>
                                                            </div>

          <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                       <label>Opening Balance</label>
                       <input type="text" class="form-control" name="city" placeholder="Opening Balance" value="Opening Balance">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
               <div class="form-group">
                  <label>Closing Balance</label>
                  <input type="text" class="form-control" name="city" placeholder="Closing Balance" value="Closing Balance">
                                                                    </div>
                                                                </div>
                                                            </div>

            <div class="row">
                <div class="col-lg-6">
                     <div class="form-group">
                         <label>Outstanding amount</label>
                        <input type="text" class="form-control" name="city" placeholder="Outstanding amount" value="Outstanding amount">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 11-->

                                                <!--begin: Form Wizard Step 12-->
           <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                <div class="kt-heading kt-heading--md">Customer SOA Details</div>
               <div class="kt-form__section kt-form__section--first">
                   <div class="kt-wizard-v1__form">


                        <div class="row">
                            <div class="col-lg-6">
                               <div class="form-group">
                                   <label>Customer SOA</label>
               <input type="text" class="form-control" name="city" placeholder="Customer SOA" value="Customer SOA">
                                                                    </div>
                                                                </div>
               <div class="col-lg-6">
                  <div class="form-group">
                      <label>Customer SOA Detailed</label>
                      <input type="text" class="form-control" name="city" placeholder="Customer SOA Detailed" value="Customer SOA Detailed">
                                                                    </div>
                                                                </div>
                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 12-->

                                                <!--begin: Form Wizard Step 13-->
          <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
              <div class="kt-heading kt-heading--md">Customer VAT Details</div>
              <div class="kt-form__section kt-form__section--first">
                   <div class="kt-wizard-v1__form">


                      <div class="row">
                          <div class="col-lg-6">
                              <div class="form-group">
                                  <label>VAT Number</label>
                                  <input type="text" class="form-control" name="city" placeholder="VAT Number" value="VAT Number">
                                                                    </div>
                                                                </div>
                <div class="col-lg-6">
                     <div class="form-group">
                         <label>Tax Name</label>
                        <input type="text" class="form-control" name="city" placeholder="Tax Name" value="Tax Name">
                                                                    </div>
                                                                </div>
                                                            </div>

            <div class="row">
                 <div class="col-lg-6">
                    <div class="form-group">
                    <label>VAT Certificate</label>
                     <input type="text" class="form-control" name="city" placeholder="VAT Certificate" value="VAT Certificate">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">

                                                                    </div>
                                                                </div>
                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 13-->




                                                <!--begin: Form Wizard Step last-->
                                                <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
       <div class="kt-heading kt-heading--md">Customer Documents</div>
       <div class="kt-form__section kt-form__section--first">
          <div class="row">
              <div class="col-lg-12">
                  <button type="button" id="addata" class="btn btn-dark btn-elevate btn-pill btn-sm pull-right">Add</button>
                                                            </div>
                                                        </div>
          <div class="kt-wizard-v1__form" id="fmappend">

              <span id="htmldata">
                   <div class="row" >
                       <div class="col-lg-6">
                          <div class="form-group">
                               <label>Document Name</label>
                         <input type="text" class="form-control" name="city" placeholder="Document Name" value="Document Name">
                                                                                </div>
                                                                    </div>
                <div class="col-lg-6">
                    <div class="form-group">
                     <label>Upload</label>
                     <input type="file" class="form-control" name="city" placeholder="Upload" >
            <span class="form-text text-muted">Please Upload.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </span>



                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step last-->


                                                <!--begin: Form Actions -->
       <div class="kt-form__actions">
           <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                                        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> &nbsp; {{ __('app.Previous') }}
           </button>
           <button  id="Customer_submit" class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                                        {{ __('app.Submit') }} &nbsp; <i class="fa fa-paper-plane" aria-hidden="true"></i>
          </button>
          <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                                        {{ __('app.Next Step') }} &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                                    </button>
                                                </div>

                                                <!--end: Form Actions -->
                                            </form>

                                            <!--end: Form Wizard Form-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    </div>
                    
@endsection

@section('script')

<script type="text/javascript">
  var i=1;

$('#add_more_table').click(function(){

   i++;

   $('#addmore_table').append('<tr id="row'+i+'" class="dynamic-added addmore subadmore">\
    <td>\
    <input type="text"value="<?php echo $contact_person_incharges ?>"  id="contact_person_incharges" name="contact_person_incharges['+i+']" placeholder="Contact Person Incharge" class="contact_person_incharges form-control name_list" autocomplete="off" />\
    </td>\
    <td>\
    <input type="text"value="<?php echo $contact_personvalue ?>" id="contact_personvalue"  name="contact_personvalue['+i+']" placeholder="Contact Person" class="contact_personvalue form-control name_list"  autocomplete="off"/>\
    </td>\
    <td>\
    <input type="text" value="<?php echo $mobiles ?>"id="mobiles"  name="mobiles['+i+']" placeholder="Mobile Number" class="mobiles form-control name_list" autocomplete="off" />\
    </td>\
    <td>\
    <input type="text"value="<?php echo $offices ?>" id="offices" name="offices['+i+']" placeholder="Office Number" class="offices form-control name_list"autocomplete="off" />\
    </td>\
    <td>\
    <input type="text" value="<?php echo $emails ?>"id="emails" name="emails['+i+']" placeholder="Email" class="emails form-control name_list"autocomplete="off" />\
    </td>\
    <td>\
    <input type="text"value="<?php echo $departments ?>" id="departments" name="departments['+i+']" placeholder="Department" class="departments form-control name_list"autocomplete="off" />\
    </td>\
    <td>\
    <input type="text"  value="<?php echo $locations ?>"id="locations" name="locations['+i+']" placeholder="Location" class="locations form-control name_list"autocomplete="off" />\
    </td>\
    <td>\
    <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>\
    </td>\
    </tr>');
});

$(document).on('click', '.btn_remove', function(){
     var button_id = $(this).attr("id");
     $('#row'+button_id+'').remove();
});

</script>
<script type="text/javascript">
  $(function()
  {
     $("#idcheck").change(function()
     {
         var st= this.checked;
         if(st)
         {
          $("#cust_code").prop("disabled",false);
         }
         else
         {
          $("#cust_code").prop("disabled",true);

         }
     });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
  $("#Checkedinvoice").change(function(){
    if(this.checked)
    {
          $val = $("#cust_add1").val();
          $val1 = $("#cust_add2").val();
          $val2 = $("#cust_country").val();
          $val3 = $("#cust_region").val();
          $val4 = $("#cust_city").val();
          $val5 = $("#cust_zip").val();
          $val6 = $("#email1").val();
          $val7 = $("#email2").val();
          $val8 = $("#office_phone1").val();
          $val9 = $("#office_phone2").val();
          $val10 = $("#mobile1").val();
          $val11 = $("#mobile2").val();

            $('#invoice_add1').val($val);
            $('#invoice_add2').val($val1);
            $('#invoice_country').val($val2);
            $('#invoice_region').val($val3);
            $('#invoice_city').val($val4);
            $('#invoice_zip').val($val5);
            $('#invoice_email1').val($val6);
            $('#invoice_email2').val($val7);
            $('#invoice_office_phone1').val($val8);
            $('#invoice_office_phone2').val($val9);
            $('#invoice_mobile1').val($val10);
            $('#invoice_mobile2').val($val11);
            }
    else
    {
            $('#invoice_add1').val("");
            $('#invoice_add2').val("");
            $('#invoice_country').val("");
            $('#invoice_region').val("");
            $('#invoice_city').val("");
            $('#invoice_zip').val("");
            $('#invoice_email1').val("");
            $('#invoice_email2').val("");
            $('#invoice_office_phone1').val("");
            $('#invoice_office_phone2').val("");
            $('#invoice_mobile1').val("");
            $('#invoice_mobile2').val("");
            
    }
});
  });
  
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $("#Checkedshipping").change(function(){
    if(this.checked)
    {
          $val12 = $("#cust_add1").val();
          $val13 = $("#cust_add2").val();
          $val14 = $("#cust_country").val();
          $val15 = $("#cust_region").val();
          $val16 = $("#cust_city").val();
          $val17 = $("#cust_zip").val();
          $val18= $("#email1").val();
          $val19 = $("#email2").val();
          $val20 = $("#office_phone1").val();
          $val21 = $("#office_phone2").val();
          $val22 = $("#mobile1").val();
          $val23 = $("#mobile2").val();

            $('#shipping1').val($val12);
            $('#shipping2').val($val13);
            $('#shipping_country').val($val14);
            $('#shipping_region').val($val15);
            $('#shipping_city').val($val16);
            $('#shipping_zip').val($val17);
            $('#shipping_email2').val($val18);
            $('#shipping_email1').val($val19);
            $('#shipping_office_phone1').val($val20);
            $('#shipping_office_phone2').val($val21);
            $('#shipping_mobile2').val($val22);
            $('#shipping_mobile1').val($val23);
    }
    else
    {
            $('#shipping1').val("");
            $('#shipping2').val("");
            $('#shipping_country').val("");
            $('#shipping_region').val("");
            $('#shipping_city').val("");
            $('#shipping_zip').val("");
            $('#shipping_email2').val("");
            $('#shipping_email1').val("");
            $('#shipping_office_phone1').val("");
            $('#shipping_office_phone2').val("");
            $('#shipping_mobile2').val("");
            $('#shipping_mobile1').val("");
    }
});
  });
  
</script>

<script type="text/javascript">
function myFunctionslocation(val) {
  var input2 = $('#location').val();
  $('#locations').val(input2);
  
}
function myFunctionsdepartments(val) {
  var input2 = $('#contact_department').val();
  $('#departments').val(input2);
}
function myFunctionoffice(val) {
  var input2 = $('#office').val();
  $('#offices').val(input2);
}
function myFunctionmobiles
(val) {
  var input2 = $('#mobile').val();
  $('#mobiles').val(input2);
}
function myFunctionsemail
(val) {
  var input2 = $('#email').val();
  $('#emails').val(input2);
    
}
function myFunctioncontact_person_incharge
(val) {
  var input2 = $('#contact_person_incharge').val();
  $('#contact_person_incharges').val(input2);
   
}
function myFunctionsperson
(val) {
  var input2 = $('#contact_persons').val();
    $('#contact_personvalue').val(input2);
}
function myFunction
(val) {
  var input2 = $('#mobile1').val();
    $('#registerd_email').val(input2);
  
}

</script>
    <script src="{{ URL::asset('assets') }}/js/pages/custom/wizard/wizard-1.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets') }}/js/pages/crud/datatables/basic/customer.js" type="text/javascript"></script>
@endsection
