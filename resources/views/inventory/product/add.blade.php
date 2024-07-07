@extends('inventory.common.layout') @section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
    <script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
    <script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
    <script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
    <link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />



    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
            </div>

        </div>
    </div>

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <br />
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-home-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
						New Service Configuration
                    </h3>
                </div>

            </div>

            <div class="kt-portlet__body">

                <form class="kt-form" id="kt_form">

                    <div class="row" style="padding-bottom: 6px;">

                        <div class="kt-portlet">

                            <div class="kt-portlet__body">
                                <ul class="nav nav-tabs  nav-tabs-line" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#basic_details"
                                            role="tab">Service Details</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#stock_details"
                                            role="tab">{{ __('mainproducts.Stock Details') }}</a>
                                    </li>



                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#product_variant" role="tab">
                                            {{ __('mainproducts.Product Variants') }}</a>
                                    </li>

                                  



                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#batch_details"
                                            role="tab">{{ __('mainproducts.Batch Details') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#expiry_warranty"
                                            role="tab">{{ __('mainproducts.Expiry & Warranty') }}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#product_tracking"
                                            role="tab">{{ __('mainproducts.Product Tracking') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#product_images" role="tab">
                                            {{ __('mainproducts.Images') }}</a>
                                    </li> --}}

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="basic_details" role="tabpanel">
                                        <div class="row">






                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>Service  Name<span
                                                                style="color: red">*</span></label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="product_name"
                                                            id="product_name"
                                                            placeholder="{{ __('mainproducts.Product Name') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('app.Description') }}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <textarea class="form-control" name="description" id="description" rows="1"
                                                                placeholder="{{ __('app.Description') }}"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Category') }}<span
                                                                style="color: red">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <select
                                                                class="form-control single-select category kt-selectpicker"
                                                                name="category" id="category">
                                                                <option value="">{{ __('mainproducts.Select') }}
                                                                </option>
                                                                @foreach ($categorylist as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->category_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}



                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Unit') }}<span
                                                                style="color: red">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <select name="unit" id="unit"
                                                                class="form-control single-select unit kt-selectpicker">
                                                                <option value="">{{ __('mainproducts.Select') }}
                                                                </option>
                                                                @foreach ($unit as $unit)
                                                                    <option value="{{ $unit->id }}">
                                                                        {{ $unit->unit_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Product Code') }}<span
                                                                style="color: red">*</span></label>
                                                    </div>
                                                    <div class="col-md-3 input-group input-group-sm">
                                                        <button type="button" class="btn btn-secondary productadd"><i
                                                                class="fa fa-random"></i>{{ __('mainproducts.Add') }}</button>
                                                    </div>
                                                    <div class="col-md-5 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="product_code"
                                                            id="product_code"
                                                            placeholder="{{ __('mainproducts.Product Code') }}">
                                                    </div>

                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.SKU') }}<span
                                                                style="color: red"></span></label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="sku"
                                                            id="sku"
                                                            placeholder="{{ __('mainproducts.stock keeping unit') }}">
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>Service Cost</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" class="form-control product_price"
                                                                name="product_price" id="product_price"
                                                                placeholder="Service Cost">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>Selling Price</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" class="form-control selling_price"
                                                                name="selling_price" id="selling_price"
                                                                placeholder="Selling Price">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>













                                            {{-- <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Supplier') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <div class="input-group input-group-sm">
                                                            <select class="form-control single-select kt-selectpicker"
                                                                name="sup_vendorname" id="sup_vendorname">
                                                                <option value="">{{ __('mainproducts.Select') }}
                                                                </option>
                                                                @foreach ($suppliers as $supplierss)
                                                                    <option value="{{ $supplierss->id }}">
                                                                        {{ $supplierss->sup_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Manufacturer') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <select class="form-control single-select kt-selectpicker"
                                                            name="manufacturer" id="manufacturer">
                                                            <option value="">{{ __('mainproducts.Select') }}
                                                            </option>
                                                            @foreach ($manufacturerlist as $manufacturer)
                                                                <option value="{{ $manufacturer->id }}">
                                                                    {{ $manufacturer->manufacture_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Brand') }}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <select class="form-control single-select kt-selectpicker"
                                                                name="brand" id="brand">
                                                                <option value="">{{ __('mainproducts.Select') }}
                                                                </option>
                                                                @foreach ($brandlist as $brand)
                                                                    <option value="{{ $brand->id }}">
                                                                        {{ $brand->brand_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Warehouse') }}<span
                                                                style="color: red">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <select class="form-control single-select kt-selectpicker"
                                                                name="warehouse" id="warehouse">
                                                                <option value="">{{ __('mainproducts.Select') }}
                                                                </option>
                                                                @foreach ($warehouse as $warehouse)
                                                                    <option value="{{ $warehouse->id }}">
                                                                        {{ $warehouse->warehouse_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                        </div>

                                    </div>
                                    <div class="tab-pane" id="stock_details" role="tabpanel">
                                        <div class="row">
                                            <!-- <div class="col-lg-6">
                  <div class="form-group row pl-md-3">
                   <div class="col-md-4">
                    <label>{{ __('mainproducts.Barcode Format') }}</label>
                   </div>
                   <div class="col-md-8">
                    <div class="input-group input-group-sm">
                     <select class="form-control single-select category kt-selectpicker" name="barcode_format" id="barcode_format">
                      <option value="">{{ __('mainproducts.Select') }}</option>
                <option value="C39">C39</option><option value="C39+">C39+</option>
                <option value="C39E">C39E</option><option value="C39E+">C39E+</option>
                <option value="C93">C93</option><option value="S25">S25</option>
                <option value="S25+">S25+</option><option value="I25">I25</option>
                <option value="I25+">I25+</option><option value="C128">C128</option>
                <option value="C128A">C128A</option><option value="C128B">C128B</option>
                <option value="C128C">C128C</option><option value="EAN2">EAN2</option>
                <option value="EAN5">EAN5</option><option value="EAN8">EAN8</option>
                <option value="EAN13">EAN13</option><option value="UPCA">UPCA</option>
                <option value="UPCE">UPCE</option><option value="MSI">MSI</option>
                <option value="MSI+">MSI+</option><option value="POSTNET">POSTNET</option>
                <option value="PLANET">PLANET</option><option value="RMS4CC">RMS4CC</option>
                <option value="KIX">KIX</option><option value="IMB">IMB</option>
                <option value="CODABAR">CODABAR</option><option value="CODE11">CODE11</option>
                <option value="PHARMA">PHARMA</option><option value="PHARMA2T">PHARMA2T</option>
                     </select>
                    </div>
                   </div>
                  </div>
                 </div> -->
                                            <!-- <div class="col-lg-6">
                  <div class="form-group row pl-md-3">
                   <div class="col-md-4">
                    <label>{{ __('mainproducts.Product Status') }}</label>
                   </div>
                   <div class="col-md-8 input-group input-group-sm">
                    <div class="input-group input-group-sm">
                     <select class="form-control single-select kt-selectpicker" name="product_status" id="product_status">
                      <option value="">{{ __('mainproducts.Select') }}</option>
                      <option value="1">{{ __('mainproducts.Enabled') }}</option>
                      <option value="2">{{ __('mainproducts.Disabled') }}</option>
                     </select>
                    </div>
                   </div>
                  </div>
                 </div> -->
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Inventory Type') }}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <select class="form-control single-select kt-selectpicker"
                                                                name="item_type" id="item_type">

                                                                <option value="1">{{ __('mainproducts.Inventory') }}
                                                                </option>
                                                                <option value="2">
                                                                    {{ __('mainproducts.non Inventory') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Opening Stock') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control opening_stock"
                                                            name="opening_stock" id="opening_stock"
                                                            placeholder="{{ __('mainproducts.Opening Stock') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Part No') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="part_no"
                                                            id="part_no"
                                                            placeholder="{{ __('mainproducts.Part No') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Model No') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="model_no"
                                                            id="model_no"
                                                            placeholder="{{ __('mainproducts.Model No') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Serial Number') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="serial_number"
                                                            id="serial_number"
                                                            placeholder="{{ __('mainproducts.Serial Number') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.HS Code') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="hsn_code"
                                                            id="hsn_code"
                                                            placeholder="{{ __('mainproducts.HS Code') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Lot No') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="lotno"
                                                            id="lotno" placeholder="{{ __('mainproducts.Lot No') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Country of Origin') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="countryoforigin"
                                                            id="countryoforigin"
                                                            placeholder="{{ __('mainproducts.Country of Origin') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.SFDA') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="cfds"
                                                            id="cfds" placeholder="{{ __('mainproducts.SFDA') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Reference') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="reference"
                                                            id="reference"
                                                            placeholder="{{ __('mainproducts.Reference') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Catelogue No') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="catno"
                                                            id="catno"
                                                            placeholder="{{ __('mainproducts.Catelogue No') }}">
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- <div class="col-lg-6">
                  <div class="form-group row pr-md-3">
                   <div class="col-md-4">
                    <label>{{ __('mainproducts.Out of Stock Status') }}</label>
                   </div>
                   <div class="col-md-8 input-group input-group-sm">
                    <div class="input-group input-group-sm">
                     <select class="form-control single-select kt-selectpicker" name="" id="out_of_stock_status"><span style="color: red">*</span>
                      <option value="">{{ __('mainproducts.Select') }}</option>
                      <option value="1">{{ __('mainproducts.Instock') }}</option>
                      <option value="2">{{ __('mainproducts.Out of Stock') }}</option>
                     </select>
                    </div>
                   </div>
                  </div>
                 </div> -->

                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Enable minus stock billing') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <div class="input-group input-group-sm">
                                                            <select class="form-control single-select kt-selectpicker"
                                                                name="enable_minus_stock_billing"
                                                                id="enable_minus_stock_billing">

                                                                <option value="1">Yes</option>
                                                                <option value="2">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Reorder Quality Alert') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <div class="input-group input-group-sm">
                                                            <select
                                                                class="form-control single-select kt-selectpicker reorder_quantity_alert"
                                                                name="reorder_quantity_alert" id="reorder_quantity_alert">

                                                                <option value="1">{{ __('mainproducts.Enabled') }}
                                                                </option>
                                                                <option value="2">{{ __('mainproducts.Disabled') }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6" id="quantity_tab">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Reorder Quantity') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" class="form-control onlynumeric"
                                                                name="alert_quantity" id="alert_quantity"
                                                                placeholder="{{ __('mainproducts.Reorder Quantity') }}">


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane" id="product_variant" role="tabpanel">
                                        <div class="row col-lg-12">
                                            <div class="col-md-8">
                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__label">
                                                        <label
                                                            class="kt-label m-label--single">{{ __('mainproducts.Options') }}</label>
                                                    </div>
                                                    <div class="kt-form__control">

                                                        <input id="s2Tags" name="options"
                                                            placeholder="{{ __('mainproducts.Add Options') }}"
                                                            value="">

                                                    </div>
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>

                                            <div class="col-md-4">

                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__label">
                                                        <label
                                                            class="kt-label m-label--single">{{ __('mainproducts.Action') }}</label>
                                                    </div>
                                                    <div class="kt-form__control">
                                                        <a id="addoption"
                                                            class="btn-sm btn btn-label-info btn-bold addoption">
                                                            <i
                                                                class="la la-plus-square"></i>{{ __('mainproducts.Generate') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="kt-section__content">
                                                <table class="table" id="variant_table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th colspan="2">Service Name</th>
                                                            <th>{{ __('mainproducts.Product Code') }}</th>
                                                            <th>{{ __('mainproducts.SKU') }}</th>
                                                            <th>{{ __('mainproducts.Barcode') }}</th>
                                                            <th>{{ __('mainproducts.Product Cost') }}</th>
                                                            <th>{{ __('mainproducts.Opening Stock') }}</th>
                                                            <th>{{ __('mainproducts.Images') }}</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="tab-pane" id="batch_details" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Maintain batches') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <select class="form-control single-select kt-selectpicker"
                                                            name="maintain_batches" id="maintain_batches">
                                                            <option value="">{{ __('mainproducts.Select') }}
                                                            </option>
                                                            <option value="1">{{ __('mainproducts.Yes') }}</option>
                                                            <option value="2">{{ __('mainproducts.No') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Batch Name') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <select class="form-control single-select kt-selectpicker"
                                                            name="batch_lot_no" id="batch_lot_no">
                                                            <option value="">{{ __('mainproducts.Select') }}
                                                            </option>
                                                            @foreach ($batches as $batchnames)
                                                                <option value="{{ $batchnames->id }}">
                                                                    {{ $batchnames->batchname }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  <div class="col-lg-6">
                  <div class="form-group row">
                   <div class="col-md-4">
                    <label>{{ __('mainproducts.Batch / Lot No') }}</label>
                   </div>
                   <div class="col-md-8 input-group input-group-sm">
                    <input type="text" class="form-control" name="batch_lot_no" id="batch_lot_no" placeholder="">
                   </div>
                  </div>
                 </div> -->
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="product_images" role="tabpanel">

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <input type="hidden" name="fileData" id="fileData" />
                                                <div id="choose-files">
                                                    <form action="/upload">
                                                        <input type="file" id="files" name="files[]"
                                                            accept="image/*" />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8">



                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="expiry_warranty" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Manufacturing Date') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control ktdatepicker"
                                                            name="manufacturing_date" id="manufacturing_date"
                                                            placeholder="{{ __('mainproducts.Manufacturing Date') }}"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Days for Shelf Life') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control shelflife"
                                                            name="shelflife" id="shelflife"
                                                            placeholder="{{ __('mainproducts.Days for Shelf Life') }}"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Expiry Date') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control ktdatepicker"
                                                            name="expiry_date" id="expiry_date"
                                                            placeholder="{{ __('mainproducts.Expiry Date') }}"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Expiry Reminder') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control expiry_reminder"
                                                            name="expiry_reminder" id="expiry_reminder"
                                                            placeholder="{{ __('mainproducts.Expiry Reminder') }}"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Warranty Date') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control ktdatepicker"
                                                            name="warranty_date" id="warranty_date"
                                                            placeholder="{{ __('mainproducts.Warranty Date') }}"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Warranty Reminder') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control warranty_reminder"
                                                            name="warranty_reminder" id="warranty_reminder"
                                                            placeholder="{{ __('mainproducts.Warranty Reminder') }}"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane" id="product_tracking" role="tabpanel">
                                        <div class="row">


                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.UPC') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="upc"
                                                            id="upc"
                                                            placeholder="{{ __('mainproducts.universal product code') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.EAN') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="ean"
                                                            id="ean"
                                                            placeholder="{{ __('mainproducts.European Article Number') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.JAN') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="jan"
                                                            id="jan"
                                                            placeholder="{{ __('mainproducts.Japaneese Article Number') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.ISBN') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="isbn"
                                                            id="isbn"
                                                            placeholder="{{ __('mainproducts.International Standard Book Number') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.MPN') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="mpn"
                                                            id="mpn"
                                                            placeholder="{{ __('mainproducts.Manufacturer  Number') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pl-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Refundable') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <select class="form-control single-select kt-selectpicker"
                                                            name="refundable" id="refundable">


                                                            <option value="1">Yes</option>
                                                            <option value="2">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                    </div>

                                    <!--  <div class="tab-pane" id="accounting_configuration" role="tabpanel">
                 <div class="col-lg-6">
                  <div class="form-group row">
                   <div class="col-md-4">
                    <label>{{ __('mainproduct	s.Sales Accountant') }}</label>
                   </div>
                   <div class="col-md-8">
                    <div class="input-group input-group-sm">
                     <select class="form-control single-select" name="sales_accountant" id="sales_accountant">
                        <option value="">Select</option>
                        <option value="1">B1</option>
                        <option value="2">B2</option>
                       </select>
                    </div>
                   </div>
                  </div>
                 </div>

                 <div class="col-lg-6">
                  <div class="form-group row">
                   <div class="col-md-4">
                    <label>{{ __('mainproducts.Purchase Accountant') }}</label>
                   </div>
                   <div class="col-md-8 input-group input-group-sm">
                    <select class="form-control single-select" name="purchase_accountant" id="purchase_accountant">
                       <option value="">Select</option>
                       <option value="1">P1</option>
                       <option value="2">P2</option>
                      </select>
                   </div>
                  </div>
                 </div>

                 <div class="col-lg-6">
                  <div class="form-group row">
                   <div class="col-md-4">
                    <label>{{ __('mainproducts.Inventory Accountant') }}</label>
                   </div>
                   <div class="col-md-8 input-group input-group-sm">
                    <select class="form-control single-select" name="inventory_accountant" id="inventory_accountant">
                       <option value="">Select</option>
                       <option value="1">IVA 1</option>
                       <option value="2">IVA 2</option>
                      </select>
                   </div>
                  </div>
                 </div>

                </div> -->

                                </div>
                            </div>
                        </div>
                    </div>



                    <input type="hidden" class="form-control" name="branch" id="branch"
                        value="{{ $branch }}">
                    <div class="kt-portlet__foot  pr-0">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-6">

                                </div>
                                <div class="col-lg-6 kt-align-right">

                                    <button type="button" class="btn btn-secondary mr-2" onclick="goPrev()"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-x icon-16">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg> {{ __('mainproducts.Cancel') }}</button>

                                    <button type="submit" name="product_submit" id="product_submit"
                                        class="btn btn-primary  float-right"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="15" height="15" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg> {{ __('mainproducts.Save') }}</button>


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
    </style>
    <!--end::Modal-->
    @endsection @section('script')
    <script type="text/javascript">
        function goPrev() {
            window.history.back();
        }

        var tagify = $('#s2Tags').tagify({
            placeholder: 'add keyword',
            backspace: false,
            editTags: {
                clicks: 1
            }
        });




        $('#s2TagsRemove').on('click', function(e) {
            e.preventDefault();
            $('#s2Tags').data('tagify').removeAllTags();
        });
    </script>
    <script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/tagify.js" type="text/javascript"></script>
    <script type="text/javascript">
        var tr_count = 1;
        var input = document.querySelector('input[name=options]');
        var tagify = new Tagify(input)
        $(function() {
            $('#attribute').on('change', function() {
                var attribute_id = $("#attribute option:selected").val();
                $.ajax({
                    type: 'GET',
                    url: '{!! URL::to('getoptions') !!}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": attribute_id
                    },
                    success: function(data) {
                        var jsobj = JSON.parse(JSON.stringify(data));
                        for (var i = 0; i < jsobj.length; i++) {
                            var jsonData = jsobj[i];
                            //tagify.removeAllTags();
                            tagify.addTags(jsonData.option_name);


                        }
                    },
                    error: function() {

                    }
                });

            })
        });

        $("#addoption").click(function() {
            var productname = $('#product_name').val();
            if (productname == "") {
                $('#product_name').addClass('is-invalid');
                toastr.warning('Product Name is required.');
                $("#basic_details").trigger("click");
                return false;
            } else {
                $('#product_name').removeClass('is-invalid');
            }

            var option_array = [];

            var option_value = $("#s2Tags").val();

            //   console.log(option_value);
            const parsed = JSON.parse(option_value);
            for (i = 0; i < parsed.length; i++) {
                var option_value = parsed[i].value;
                if ('Type and hit Enter' != option_value) {
                    var all_options = productname + " - " + option_value;
                    // option_array.push(option_value);
                    $("#variant_table").each(function() {

                        var tds = '<tr id=tr' + tr_count + '>';
                        tds += '<td class="count" id=count' + tr_count + '>' + tr_count + '</td>' +
                            '<td class="option" id=option' + tr_count + '>' + all_options +
                            '<input type="hidden" class="form-control option_textbox" name="option[]" id="option_textbox' +
                            tr_count + '" value="' + all_options + '">' + '</td>' +
                            '<td><button type="button" class="btn btn-secondary variantproductcodeadd" data-id="' +
                            tr_count +
                            '"><i class="fa fa-random"></i>{{ __('mainproducts.Add') }}</button></td>' +
                            '<td class="variantproductcode" id=variantproductcode' + tr_count + '>' +
                            '<input type="text" class="form-control" name="variantproductcode[]" id="variantproductcode_textbox' +
                            tr_count + '" value="" readonly>' + '</td>' +
                            '<td class="variantsku" id=variantsku' + tr_count + '>' +
                            '<input type="text" class="form-control"  name="variantsku[]" id="variantsku_textbox' +
                            tr_count + '" value="" readonly>' + '</td>' +
                            '<td class="variantbarcode" id=variantbarcode' + tr_count + '>' +
                            '<input type="text"  class="form-control" name="variantbarcode[]" id="variantbarcode_textbox' +
                            tr_count + '" value="">' + '</td>' +
                            '<td class="variantproductcost" id=variantproductcost' + tr_count + '>' +
                            '<input type="text" class="form-control"  name="variantproductcost[]" id="variantproductcost_textbox' +
                            tr_count + '" value="">' + '</td>' +
                            '<td class="variantstock" id=variantstock' + tr_count + '>' +
                            '<input type="text" class="form-control"  name="variantstock[]" id="variantstock_textbox' +
                            tr_count + '" value=""></td>' +
                            '<td><div class="form-group row"><div class="col-sm-12"><div class="dropzone dropzone-default dropzone-brand" id="file' +
                            tr_count + '"><input type="hidden" name="variantimage[]" id="variantimage' +
                            tr_count +
                            '" value=""><div class="dropzone-msg dz-message needsclick"><h3 class="dropzone-msg-title">Drop files here or click to upload.</h3></div></div></div></div></td>' +
                            '<td>' +
                            '<div class="kt-form__control remove"><a id="remove_row" class="btn-sm btn btn-label-info btn-bold"><i class="fa fa-trash"></i>{{ __('mainproducts.Remove') }}</a> </div>' +
                            '</td>';



                        tds += '</tr>';
                        if ($('tbody', this).length > 0) {
                            $('tbody', this).append(tds);
                        } else {
                            $(this).append(tds);
                        }

                        Dropzone.autoDiscover = false;
                        var myDropzone = new Dropzone("div#file" + tr_count, {
                            init: function() {

                                this.on("addedfile", function(file) {


                                    var atid = $(this.element).attr("id").replace(
                                        /[A-Za-z$-]/g, "");
                                    $('#variantimage' + atid + '').val(file.name);

                                });
                            },
                            autoProcessQueue: false,
                            url: "ProductFileUpload1",
                            headers: {
                                'X-CSRF-TOKEN': $('#token').val(),

                            },
                            acceptedFiles: ".jpeg,.jpg,.png,.gif",
                            addRemoveLinks: true,
                            timeout: 5000,
                            success: function(file, response) {



                                //	alert(atid);
                            },
                            error: function(file, response) {
                                return false;
                            }
                        });

                        //	tagify.removeAllTags.bind(tagify);

                        tagify.removeAllTags();


                    });
                    tr_count++;
                    duplicate = 0;

                }

            }

            // var all_options = option_array.join(" - "+productname);

            //  $('.option_textbox').each(function(){
            //  if (($(this).val() === all_options)) {
            //  all_options = undefined;
            //  }
            //  });

            // if ((!all_options || 0 === all_options.length)) {
            // 	return false;
            // }

            // console.log(duplicate);






        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.kt-select2').select2();
        });
    </script>
    <script type="text/javascript">
        $(document.body).on("change", ".unit", function() {
            var unit = $(this).val();

            $.ajax({
                url: "getsellingunits",
                method: "POST",
                data: {
                    _token: $('#token').val(),
                    id: unit
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#selling_units').empty();

                    $.each(data, function(key, value) {
                        $('#selling_units').append('<option value="' + value.id + '">' + value
                            .unit_name + '</option>');
                    });

                }
            })
        });



        $("body").on("click", ".remove", function(event) {
            event.preventDefault();
            var row = $(this).closest('tr');


            var siblings = row.siblings();
            row.remove();
            siblings.each(function(index) {
                $(this).children().first().text(index);
            });

            calculate();
        });


        $(document.body).on("change", "input[type=radio][name=sup_vendor]", function() {




            var checkedValue = $('input[name="sup_vendor"]:checked').val();
            //	alert(checkedValue);
            $.ajax({
                url: "getsupplier_vendor1",
                method: "POST",
                data: {
                    _token: $('#token').val(),
                    id: checkedValue
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('select[name="sup_vendorname"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="sup_vendorname"]').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });

                }
            })
        });


        $(document.body).on("change", ".reorder_quantity_alert", function() {

            var checkedValue = $('#reorder_quantity_alert').val();


            if (checkedValue == 1) {

                $('#alert_quantity').removeAttr('disabled'); //Enable
            } else {
                $('#alert_quantity').val("");
                $('#alert_quantity').attr('disabled', 'disabled'); //Disable

            }

        });


        $(document.body).on("click", ".productadd", function() {
            // var unit = $(this).val();

            $.ajax({
                url: "ProductCode",
                method: "GET",
                data: {
                    _token: $('#token').val(),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#product_code').val(data);
                    $('#sku').val(data);
                    $('#barcode').val(data);

                }
            })
        });

        $(document.body).on("click", ".variantproductcodeadd", function() {

            var cc = $(this).attr('data-id');


            $.ajax({
                url: "ProductCode",
                method: "GET",
                data: {
                    _token: $('#token').val(),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#variantproductcode_textbox' + cc + '').val(data);
                    $('#variantsku_textbox' + cc + '').val(data);
                    $('#variantbarcode_textbox' + cc + '').val(data);

                }
            })
        });
        $(document.body).on("keyup  change", ".product_price", function() {
            var $this = $(this);
            $this.val($this.val().replace(/[^\d.]/g, ''));
        });
        $(document.body).on("keyup  change", ".selling_price", function() {
            var $this = $(this);
            $this.val($this.val().replace(/[^\d.]/g, ''));
        });
        $(document.body).on("keyup  change", ".opening_stock", function() {
            var $this = $(this);
            $this.val($this.val().replace(/[^\d.]/g, ''));
        });
        $(document.body).on("keyup  change", ".shelflife", function() {
            var $this = $(this);
            $this.val($this.val().replace(/[^\d.]/g, ''));
        });
        $(document.body).on("keyup  change", ".warranty_reminder", function() {
            var $this = $(this);
            $this.val($this.val().replace(/[^\d.]/g, ''));
        });
        $(document.body).on("keyup  change", ".expiry_reminder", function() {
            var $this = $(this);
            $this.val($this.val().replace(/[^\d.]/g, ''));
        });
    </script>
    <script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
    <script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

    <script src="{{ url('/') }}/resources/js/inventory/product.js" type="text/javascript"></script>

    <script src="{{ url('/') }}/resources/js/inventory/select2.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets') }}/js/pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document.body).on("keyup  change", ".onlynumeric", function() {
            var $this = $(this);
            $this.val($this.val().replace(/[^\d.]/g, ''));
        });
    </script>
@endsection
