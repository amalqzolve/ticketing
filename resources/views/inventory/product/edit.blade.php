@extends('inventory.common.layout')
@section('content')
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
                        Edit Service Configuration
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
                                        <a class="nav-link" data-toggle="tab" href="#product_variant"
                                            role="tab">{{ __('mainproducts.Product Variants') }}</a>
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
                                        <a class="nav-link" data-toggle="tab" href="#product_images"
                                            role="tab">{{ __('mainproducts.Images') }}</a>
                                    </li> --}}

                                </ul>
                                <div class="tab-content">
                                    <input type="hidden" name="id" id="id" value="<?php echo $data->product_id; ?>">
                                    <div class="tab-pane active" id="basic_details" role="tabpanel">
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>Service Name<span
                                                                style="color: red">*</span></label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="product_name"
                                                            id="product_name"placeholder="Service Name"
                                                            value="<?php echo $data->product_name; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('app.Description') }}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <textarea class="form-control" name="description" id="description" rows="1"
                                                                placeholder="{{ __('app.Description') }}">{{ $data->description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Category') }}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <select
                                                                class="form-control single-select category kt-selectpicker"
                                                                name="category" id="category"> 
                                                               

                                                             </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Unit') }}<span
                                                                style="color: red">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <select name="unit" id="unit"
                                                                class="form-control single-select kt-selectpicker">
                                                                @foreach ($unit as $unit)
                                                                    <?php
									if($data->unit!=$unit->id)
									{
									?>
                                                                    <option value="{{ $unit->id }}">
                                                                        {{ $unit->unit_name }}</option>
                                                                    <?php
									}			
									else
									{																							 ?>
                                                                    <option value="{{ $unit->id }}" selected>
                                                                        {{ $unit->unit_name }}</option>
                                                                    <?php
																														}
										?>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.SKU') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="sku"
                                                            id="sku"
                                                            placeholder="{{ __('mainproducts.stock keeping unit') }}"
                                                            value="<?php echo $data->sku; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                         
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label> Cost</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" class="form-control"
                                                                name="product_price" id="product_price"
                                                                placeholder="Product Cost"
                                                                value="{{ $data->product_price }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>Selling Price</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" class="form-control"
                                                                name="selling_price" id="selling_price"
                                                                placeholder="{{ __('mainproducts.Sales Price') }}"
                                                                value="{{ $data->selling_price }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="stock_details" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Item Type') }}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <select class="form-control single-select kt-selectpicker"
                                                                name="item_type" id="item_type">
                                                                <option value="1" <?php
                                                                if ($data->item_type == 1) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>
                                                                    {{ __('mainproducts.Inventory') }}</option>
                                                                <option value="2" <?php
                                                                if ($data->item_type == 2) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>
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
                                                        <input type="text" class="form-control" name="opening_stock"
                                                            id="opening_stock"
                                                            placeholder="{{ __('mainproducts.Opening Stock') }}"
                                                            value="<?php echo $data->available_stock; ?>">
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
                                                            id="part_no" placeholder="{{ __('mainproducts.Part No') }}"
                                                            value="<?php echo $data->part_no; ?>">
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
                                                            placeholder="{{ __('mainproducts.Model No') }}"
                                                            value="<?php echo $data->model_no; ?>">
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
                                                            placeholder="{{ __('mainproducts.Serial Number') }}"
                                                            value="<?php echo $data->serial_number; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.HS Code') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" placeholder="HS Code"
                                                            name="hsn_code" id="{{ __('mainproducts.HS Code') }}"
                                                            value="{{ $data->hsn_code }}">
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
                                                            id="lotno" placeholder="{{ __('mainproducts.Lot No') }}"
                                                            value="{{ $data->lotno }}">
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
                                                            placeholder="{{ __('mainproducts.Country of Origin') }}"
                                                            value="{{ $data->countryoforigin }}">
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
                                                            id="cfds" placeholder="{{ __('mainproducts.SFDA') }}"
                                                            value="{{ $data->cfds }}">
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
                                                            placeholder="{{ __('mainproducts.Reference') }}"
                                                            value="{{ $data->reference }}">
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
                                                            placeholder="{{ __('mainproducts.Catelogue No') }}"
                                                            value="{{ $data->catno }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Item Type') }}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <select class="form-control single-select kt-selectpicker"
                                                                name="enable_minus_stock_billing"
                                                                id="enable_minus_stock_billing">
                                                                <option value="1" <?php
                                                                if ($data->enable_minus_stock_billing == 1) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>Yes</option>
                                                                <option value="2" <?php
                                                                if ($data->enable_minus_stock_billing == 2) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Item Type') }}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group input-group-sm">
                                                            <select
                                                                class="form-control single-select kt-selectpicker reorder_quantity_alert"
                                                                name="reorder_quantity_alert" id="reorder_quantity_alert">
                                                                <option value="1" <?php
                                                                if ($data->reorder_quantity_alert == 1) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>Enabled
                                                                </option>
                                                                <option value="2" <?php
                                                                if ($data->reorder_quantity_alert == 2) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>Disabled
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
                                                            <input type="text" class="form-control"
                                                                name="alert_quantity" id="alert_quantity"
                                                                value="{{ $data->reorder_quantity }}"
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

                                            <div class="col-md-2">

                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__label">
                                                        <label
                                                            class="kt-label m-label--single">{{ __('mainproducts.Action') }}</label>
                                                    </div>
                                                    <div class="kt-form__control">
                                                        <a id="addoption" class="btn-sm btn btn-label-info btn-bold">
                                                            <i
                                                                class="la la-plus-square"></i>{{ __('mainproducts.Add') }}</a>
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
                                                            <th colspan="2">{{ __('mainproducts.Item Name') }}</th>
                                                            <th>{{ __('mainproducts.Product Code') }}</th>
                                                            <th>{{ __('mainproducts.SKU') }}</th>
                                                            <th>{{ __('mainproducts.Barcode') }}</th>
                                                            <th>{{ __('mainproducts.Product Cost') }}</th>
                                                            <th>{{ __('mainproducts.Images') }}</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @php
                                                            $tr_count = 1;
                                                        @endphp
                                                        @foreach ($options as $option)
                                                            <tr id=tr{{ $tr_count }}>


                                                                <td class="count" id='count{{ $tr_count }}'>
                                                                    {{ $tr_count }}</td>
                                                                <input type="hidden" class="form-control" name="vid[]"
                                                                    id=vid_textbox{{ $tr_count }}
                                                                    value="{{ $option->id }}">
                                                                <td class="option" id=option{{ $tr_count }}>
                                                                    {{ $option->variants }} <input type="hidden"
                                                                        class="form-control option_textbox"
                                                                        name="option[]"
                                                                        id="option_textbox{{ $tr_count }}"
                                                                        value="{{ $option->variants }}"></td>
                                                                <td><button type="button"
                                                                        class="btn btn-secondary variantproductcodeadd"
                                                                        data-id="{{ tr_count }}"><i
                                                                            class="fa fa-random"></i>{{ __('mainproducts.Add') }}</button>
                                                                </td>
                                                                <td class="variantproductcode"
                                                                    id=variantproductcode{{ tr_count }}><input
                                                                        type="text" class="form-control"
                                                                        name="variantproductcode[]"
                                                                        id="variantproductcode_textbox{{ tr_count }}"
                                                                        value="" readonly></td>

                                                                <td class="variantsku" id=variantsku{{ tr_count }}>
                                                                    <input type="text" class="form-control"
                                                                        name="variantsku[]"
                                                                        id="variantsku_textbox{{ tr_count }}"
                                                                        value="" readonly>
                                                                </td>

                                                                <td class="variantbarcode"
                                                                    id=variantbarcode{{ tr_count }}><input
                                                                        type="text" class="form-control"
                                                                        name="variantbarcode[]"
                                                                        id="variantbarcode_textbox{{ tr_count }}"
                                                                        value=""></td>
                                                                <td class="variantproductcost"
                                                                    id=variantproductcost{{ tr_count }}><input
                                                                        type="text" class="form-control"
                                                                        name="variantproductcost[]"
                                                                        id="variantproductcost_textbox{{ tr_count }}"
                                                                        value=""></td>

                                                                <td>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-12">
                                                                            <div class="dropzone dropzone-default dropzone-brand"
                                                                                id="file{{ tr_count }}">
                                                                                <div
                                                                                    class="dropzone-msg dz-message needsclick">
                                                                                    <h3 class="dropzone-msg-title">Drop
                                                                                        files here or click to upload.</h3>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="kt-form__control remove"><a
                                                                            id="remove_row"
                                                                            class="btn-sm btn btn-label-info btn-bold"><i
                                                                                class="fa fa-trash"></i>{{ __('mainproducts.Remove') }}</a>
                                                                    </div>
                                                                </td>


                                                                @php
                                                                    $tr_count++;
                                                                @endphp
                                                        @endforeach

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
                                                            <option value="1" <?php
                                                            if ($data->maintain_bathes == 1) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                {{ __('mainproducts.Yes') }}</option>
                                                            <option value="2" <?php
                                                            if ($data->maintain_bathes == 2) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                {{ __('mainproducts.No') }}</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Batch Name') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <select class="form-control single-select kt-selectpicker"
                                                            name="batch_lot_no" id="batch_lot_no">

                                                            @foreach ($batches as $batchnames)
                                                                <?php
																									if($batchnames->id != $data->batch_lot_no)
																									{
																									?>
                                                                <option value="{{ $batchnames->id }}">
                                                                    {{ $batchnames->batchname }}</option>
                                                                <?php
																									}
																									else
																									{
																										?>
                                                                <option value="{{ $batchnames->id }}" selected>
                                                                    {{ $batchnames->batchname }}</option>
                                                                <?php
																									}
																								?>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-6">
                                <div class="form-group row">
                                  <div class="col-md-4">
                                    <label>{{ __('mainproducts.Batch / Lot No') }}</label>
                                  </div>
                                  <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="batch_lot_no" id="batch_lot_no"
                                      placeholder="" value="<?php echo $data->batch_lot_no; ?>">
                                  </div>
                                </div>
                              </div> -->

                                    </div>

                                    <div class="tab-pane" id="product_images" role="tabpanel">



                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <input type="hidden" name="fileData" id="fileData"
                                                    value="<?php echo $data->image; ?>" />
                                                <div id="choose-files">
                                                    <form action="/upload">
                                                        <input type="file" id="files" name="files[]"
                                                            value="<?php echo $data->image; ?>" />
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
                                                            value="<?php echo $data->manufacturing_date; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Days for Shelf Life') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control shelflife"
                                                            name="shelflife" id="shelflife"
                                                            placeholder="{{ __('mainproducts.Days for Shelf Life') }}"
                                                            autocomplete="off" value="<?php echo $data->shelflife; ?>">
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
                                                            value="<?php echo $data->expiry_date; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Expiry Reminder') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control expiry_reminder"
                                                            name="expiry_reminder" id="expiry_reminder"
                                                            placeholder="{{ __('mainproducts.Expiry Reminder') }}"
                                                            value="<?php echo $data->expiry_reminder; ?>"autocomplete="off">
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
                                                            value="<?php echo $data->warranty_date; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3 ">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Warranty Reminder') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control warranty_reminder"
                                                            name="warranty_reminder" id="warranty_reminder"
                                                            placeholder="{{ __('mainproducts.Warranty Reminder') }}"
                                                            value="<?php echo $data->warranty_reminder; ?>">
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
                                                            placeholder="{{ __('mainproducts.universal product code') }}"
                                                            value="<?php echo $data->upc; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.EAN') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="ean"
                                                            id="ean"
                                                            placeholder="{{ __('mainproducts.European Article Number') }}"
                                                            value="<?php echo $data->ean; ?>">
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
                                                            placeholder="{{ __('mainproducts.Japaneese Article Number') }}"
                                                            value="<?php echo $data->jan; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.ISBN') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <input type="text" class="form-control" name="isbn"
                                                            id="isbn"
                                                            placeholder="{{ __('mainproducts.International Standard Book Number') }}"
                                                            value="<?php echo $data->isbn; ?>">
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
                                                            placeholder="{{ __('mainproducts.Manufacturer  Number') }}"
                                                            value="<?php echo $data->mpn; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row pr-md-3">
                                                    <div class="col-md-4">
                                                        <label>{{ __('mainproducts.Refundable') }}</label>
                                                    </div>
                                                    <div class="col-md-8 input-group input-group-sm">
                                                        <select class="form-control single-select kt-selectpicker"
                                                            name="refundable" id="refundable">
                                                            <option value="1" <?php
                                                            if ($data->refundable == 1) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                {{ __('mainproducts.Yes') }}</option>
                                                            <option value="2" <?php
                                                            if ($data->refundable == 2) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                {{ __('mainproducts.No') }}</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="branch" id="branch" value="{{ $branch }}">
                    <div class="kt-portlet__foot p-0">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-6">

                                </div>
                                <div class="col-lg-6 kt-align-right">
                                    <button type="submit" name="product_submit" id="product_submit"
                                        class="btn btn-primary float-right "><svg xmlns="http://www.w3.org/2000/svg"
                                            width="15" height="15" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-check-circle icon-16">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg> {{ __('mainproducts.Save') }}</button>
                                    <button type="button" class="btn btn-secondary mr-2" onclick="goPrev()"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-x icon-16">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg> {{ __('mainproducts.Cancel') }}</button>
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
@endsection
@section('script')
    <script type="text/javascript">
        function goPrev() {
            window.history.back();
        }
    </script>

    <script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/tagify.js" type="text/javascript"></script>
    <script type="text/javascript">
        var tr_count = {{ $tr_count + 1 }};
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
                            '<td><div class="form-group row"><div class="col-sm-12"><div class="dropzone dropzone-default dropzone-brand" id="file' +
                            tr_count +
                            '"><div class="dropzone-msg dz-message needsclick"><h3 class="dropzone-msg-title">Drop files here or click to upload.</h3></div></div></div></div></td>' +
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
                            url: "static/phpFiles/test.php"
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

    <script type="text/javascript">
        $(document.body).on("keyup  change", ".onlynumeric", function() {
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
@endsection
