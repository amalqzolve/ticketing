@extends('warehouse.common.layout')
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
										{{ __('mainproducts.New Product Configuration') }}
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
																		<a class="nav-link active" data-toggle="tab" href="#basic_details" role="tab">{{ __('mainproducts.Basic Details') }}</a>
																</li>
																<li class="nav-item">
																		<a class="nav-link" data-toggle="tab" href="#stock_details" role="tab">{{ __('mainproducts.Stock Details') }}</a>
																</li>
																
																

																<li class="nav-item">
																		<a class="nav-link" data-toggle="tab" href="#product_variant" role="tab">{{ __('mainproducts.Product Variants') }}</a>
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
																		<a class="nav-link" data-toggle="tab" href="#product_images" role="tab">{{ __('mainproducts.Images') }}</a>
																</li>

																	
																	
																	
																	<!-- <li class="nav-item">
																		<a class="nav-link" data-toggle="tab" href="#accounting_configuration"
																				role="tab">{{ __('mainproducts.Accounts Configuration') }}</a>
																</li> -->


														</ul>
														<div class="tab-content">
																<input type="hidden" name="id" id="id" value="<?php echo $data->product_id;?>">
																<div class="tab-pane active" id="basic_details" role="tabpanel">
																	<div class="row">
												<!-- 	<div class="col-lg-6">
														<div class="form-group row pr-md-3">
											<div class="col-md-4">
													<label>{{ __('mainproducts.Product Type') }}</label>
											</div>
											<div class="col-md-8">
													<div class="kt-radio-inline">
														
														<label class="kt-radio kt-radio--solid kt-radio--brand">
															<input type="radio" <?php if($data->product_type == 1) echo "checked"; ?> name="product_type" value="1"> {{ __('mainproducts.Product') }}
															<span></span>
														</label>
														
														<label class="kt-radio kt-radio--solid kt-radio--brand">
															<input type="radio" <?php if($data->product_type == 2) echo "checked"; ?> name="product_type" value="2"> {{ __('mainproducts.Service') }}
															<span></span>
														</label>
														
													
														
													</div>
											</div>
										</div>
									</div> -->
									<div class="col-lg-6">
													<div class="form-group row pr-md-3">
												<div class="col-md-4">
												<label>{{ __('mainproducts.Product Name') }}<span style="color: red">*</span></label>
															</div>
												<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="product_name" id="product_name"placeholder="{{ __('mainproducts.Product Name') }}" value="<?php echo $data->product_name;?>">
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
													<textarea class="form-control" name="description" id="description"  rows="1" placeholder="{{ __('app.Description') }}">{{$data->description}}</textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('mainproducts.Category') }}</label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<select class="form-control single-select category kt-selectpicker" name="category" id="category">
																								@foreach($categorylist as $category)
																													<?php
																													if($data->category!=$category->id)
																													{
																													?>
																														<option value="{{$category->id}}">
																																{{$category->category_name}}</option>
																													<?php
																														}
																														else
																														{
																																	?>
																														<option value="{{$category->id}}" selected>
																																{{$category->category_name}}</option>
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
							<label>{{ __('mainproducts.Unit') }}<span style="color: red">*</span></label>
											</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<select name="unit" id="unit" class="form-control single-select kt-selectpicker">
									@foreach($unit as $unit)
											<?php
									if($data->unit!=$unit->id)
									{
									?>
									<option value="{{$unit->id}}">
								{{$unit->unit_name}}</option>
										<?php
									}			
									else
									{																							 ?>
									<option value="{{$unit->id}}" selected>
									{{$unit->unit_name}}</option>
										<?php
																														}
										?>																				@endforeach
																												
																										</select>
																								</div>
																						</div>
																				</div>
																		</div>
											<div class="col-lg-6">
											<div class="form-group row pr-md-3">
											<div class="col-md-4">
										<label>{{ __('mainproducts.Product Code') }}</label>
										</div>
																	<div class="col-md-3 input-group input-group-sm">
												<button type="button" class="btn btn-secondary productadd"><i class="fa fa-random"></i>{{ __('mainproducts.Add') }}</button>
											</div>
									<div class="col-md-5 input-group input-group-sm">
									<input type="text" class="form-control" name="product_code" id="product_code" placeholder="" value="<?php echo $data->product_code;?>">
																						</div>
															
								</div>
								</div>
								<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.SKU') }}</label>
																										</div>
																										<div class="col-md-8 input-group input-group-sm">
																												<input type="text" class="form-control" name="sku" id="sku" 
																														placeholder="{{ __('mainproducts.stock keeping unit') }}" value="<?php echo $data->sku;?>">
																										</div>
																								</div>
																						</div>
																	
								<!-- <div class="col-lg-6">
								<div class="form-group row pr-md-3">
								<div class="col-md-4">
								<label>{{ __('mainproducts.Barcode') }}</label>
								</div>
								<div class="col-md-8 input-group input-group-sm">
								<input type="text" class="form-control" name="barcode" id="barcode" placeholder="" value="<?php echo $data->barcode;?>">
																						</div>
							</div>
															</div> -->
															<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Landed Cost<span style="color: red">*</span></label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													<input type="text" class="form-control" name="product_price" id="product_price" placeholder="{{ __('app.Product Price') }}" value="{{$data->product_price}}">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>{{ __('app.Selling Price') }}<span style="color: red">*</span></label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													<input type="text" class="form-control" name="selling_price" id="selling_price" placeholder="{{ __('app.Selling Price') }}" value="{{$data->selling_price}}">
												</div>
											</div>
										</div>
									</div>
													<!-- 		<div class="col-lg-6">
										<div class="form-group row pr-md-3">
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
															 <!-- <div class="col-lg-6" id="quantity_tab">
          <div class="form-group row pr-md-3">
           <div class="col-md-4">
            <label>{{ __('mainproducts.Quantity Available') }}</label>
           </div>
           <div class="col-md-8 input-group input-group-sm">
            <div class="input-group input-group-sm">
             <input type="text" class="form-control" name="quantity" id="quantity" value="{{$data->available_stock}}">
               

            </div>
           </div>
          </div>
         </div> -->
         
									
									<!-- <div class="col-lg-6">
								<div class="form-group row pr-md-3">
							<div class="col-md-4">
						<label>{{ __('mainproducts.Product Status') }}</label>
									</div>
						<div class="col-md-8 input-group input-group-sm">
						<div class="input-group input-group-sm">
						<select class="form-control single-select kt-selectpicker" name="product_status" id="product_status">
						<?php														
						if($data->product_status == 1)
						{																?>																<option value="1" selected>{{ __('mainproducts.Enabled') }}</option>														
						<option value="2">{{ __('mainproducts.Disabled') }}</option>																	<?php
						}															
						if($data->product_status == 2)								
						{																?>																<option value="1" >{{ __('mainproducts.Enabled') }}</option>
						<option value="2" selected>{{ __('mainproducts.Disabled') }}</option>														<?php
						}																?>						
						</select>
						</div>
						</div>
						</div>
						</div> -->
							

									
																	
									

					<!-- <div class="col-lg-6">
					<div class="form-group row pr-md-3">
					<div class="col-md-4">
					<label>{{ __('mainproducts.Out of Stock Status') }}</label>
							</div>
					<div class="col-md-8 input-group input-group-sm">
					<div class="input-group input-group-sm">
					<select class="form-control single-select kt-selectpicker" name="out_of_stock_status" id="out_of_stock_status">
																												<?php
																														if($data->out_of_stock_status == 1)
																														{
																																	?>
																																<option value="1" selected>{{ __('mainproducts.Instock') }}</option>
																																<option value="2" >{{ __('mainproducts.Out of Stock') }}</option>
																																<?php
																														}
																														if($data->out_of_stock_status == 2)
																														{
																																	?>
																																<option value="1" >{{ __('mainproducts.Instock') }}</option>
																																<option value="2" selected>{{ __('mainproducts.Out of Stock') }}</option>
																																<?php
																														}

																														?>
																												
																										</select>
																								</div>
																						</div>
																				</div>
																		</div> -->
																	

								
						
									
            
								<!-- 	<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
													<label>{{ __('app.Supplier/Vendor') }}</label>
											</div>
											<div class="col-md-8">
													<div class="kt-radio-inline">
														<label class="kt-radio kt-radio--solid kt-radio--brand">
															<input type="radio" <?php if($data->provider == 1) echo "checked";?> name="sup_vendor" value="1"> {{ __('mainproducts.Supplier') }}
															<span></span>
														</label>
														<label class="kt-radio kt-radio--solid kt-radio--brand">
															<input type="radio"  <?php if($data->provider == 2) echo "checked";?> name="sup_vendor" value="2"> {{ __('mainproducts.Vendor') }}
															<span></span>
														</label>
														
													</div>
											</div>
										</div>
									</div> -->
									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Supplier</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<div class="input-group input-group-sm">
													<select class="form-control single-select kt-selectpicker" name="sup_vendorname" id="sup_vendorname">
														<option value="">{{ __('mainproducts.Select') }}</option>
                      
                        
                        	            @foreach($suppliers as $supplierss)
                                     <option value="{{$supplierss->id}}" 							
                                     	@if($data->provider_id==$supplierss->id) {{"selected"}}
																																					@endif>{{$supplierss->name}}</option>
                                     @endforeach  
                       
													</select>
												</div>
											</div>
										</div>
									</div>
<div class="col-lg-6">
												<div class="form-group row pr-md-3">
												<div class="col-md-4">
												<label>{{ __('mainproducts.Manufacturer') }}</label>												 </div>
											<div class="col-md-8 input-group input-group-sm">
											<select class="form-control single-select kt-selectpicker" name="manufacturer" id="manufacturer">
												<option value="">{{ __('mainproducts.Select') }}</option>
											@foreach($manufacturerlist as $manufact)
											<?php
											if($data->manufacturer!=$manufact->id)
												{									
													?>


											<option value="{{$manufact->id}}">
											{{$manufact->manufacture_name}}</option>
																<?php
																	}
											else
											{																		
												?>
											<option value="{{$manufact->id}}" selected>
											{{$manufact->manufacture_name}}</option>
											<?php
											}
										?>
											@endforeach
											</select>
												</div>
											</div>
											</div>
						<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>{{ __('mainproducts.Brand') }}</label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													<select class="form-control single-select kt-selectpicker" name="brand" id="brand">
														<option value="">{{ __('mainproducts.Select') }}</option>
															   @foreach($brandlist as $brand)
															<option value="{{$brand->id}}"@if($data->brand==$brand->id) {{"selected"}}
																																					@endif>
																{{$brand->brand_name}}</option>
															@endforeach
														   </select>
												</div>
											</div>
										</div>
									</div>
																<!-- 						<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Warehouse</label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													<select class="form-control single-select kt-selectpicker" name="warehouse" id="warehouse">
														<option value="">{{ __('mainproducts.Select') }}</option>
															  
														   </select>
												</div>
											</div>
										</div>
									</div> -->


																		<!-- <div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Store</label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													<select class="form-control single-select kt-selectpicker" name="store" id="store">
														<option value="">{{ __('mainproducts.Select') }}</option>
															   @foreach($warehouse as $store)
															<option value="{{$store->id}}"@if($data->store==$store->id) {{"selected"}}
																																					@endif>
																{{$store->store_name}}</option>
															@endforeach
														   </select>
												</div>
											</div>
										</div>
									</div> -->
					


												<!-- <div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Rack</label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													<select class="form-control single-select kt-selectpicker" name="rack" id="rack">
														<option value="">{{ __('mainproducts.Select') }}</option>
															  
														   </select>
												</div>
											</div>
										</div>
									</div> -->



						</div>
						</div>
						<div class="tab-pane" id="stock_details" role="tabpanel">
						<div class="row">
							<div class="col-lg-6">
						<div class="form-group row pr-md-3">
						<div class="col-md-4">
						<label>{{ __('mainproducts.Item Type') }}</label>
			</div>																					 <div class="col-md-8">
							<div class="input-group input-group-sm">
								<select class="form-control single-select kt-selectpicker" name="item_type" id="item_type">
																				<option value="1" <?php      
              if($data->item_type == 1)
             { echo "selected"; }
             ?>>{{ __('mainproducts.Inventory') }}</option>
									<option value="2" <?php      
              if($data->item_type == 2)
             { echo "selected"; }
             ?> >{{ __('mainproducts.non Inventory') }}</option>																																					 </select>
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
																										<input type="text" class="form-control" name="opening_stock" id="opening_stock" 
																												placeholder="{{ __('mainproducts.Opening Stock') }}" value="<?php echo $data->opening_stock;?>">
																								</div>
																						</div>
																				</div>
<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.Part No') }}</label>
																										</div>
																										<div class="col-md-8 input-group input-group-sm">
																												<input type="text" class="form-control" name="part_no" id="part_no" 
																														placeholder="" value="<?php echo $data->part_no;?>">
																										</div>
																								</div>
																						</div>
																						<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.Model No') }}</label>
																										</div>
																										<div class="col-md-8 input-group input-group-sm">
																												<input type="text" class="form-control" name="model_no" id="model_no" 
																														placeholder="" value="<?php echo $data->model_no;?>">
																										</div>
																								</div>
																						</div>
																						<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.Serial Number') }}</label>
																										</div>
																										<div class="col-md-8 input-group input-group-sm">
																												<input type="text" class="form-control" name="serial_number" id="serial_number" 
																														placeholder="" value="<?php echo $data->serial_number;?>">
																										</div>
																								</div>
																						</div>
																								<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>HS Code</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="hsn_code" id="hsn_code" value="{{$data->hsn_code}}">
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Lot No</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="lotno" id="lotno" placeholder="" value="{{$data->lotno}}">
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Country of Origin</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="countryoforigin" id="countryoforigin" placeholder="" value="{{$data->countryoforigin}}">
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>SFDA</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="cfds" id="cfds" placeholder="" value="{{$data->cfds}}">
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Reference</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="reference" id="reference" placeholder="" value="{{$data->reference}}">
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Catelogue No</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control" name="catno" id="catno" placeholder="" value="{{$data->catno}}">
											</div>
										</div>
									</div>
									<div class="col-lg-6">
						<div class="form-group row pr-md-3">
						<div class="col-md-4">
						<label>{{ __('mainproducts.Item Type') }}</label>
			</div>																					 <div class="col-md-8">
							<div class="input-group input-group-sm">
								<select class="form-control single-select kt-selectpicker" name="enable_minus_stock_billing" id="enable_minus_stock_billing">
																				<option value="1" <?php      
              if($data->enable_minus_stock_billing == 1)
             { echo "selected"; }
             ?>>Yes</option>
									<option value="2" <?php      
              if($data->enable_minus_stock_billing == 2)
             { echo "selected"; }
             ?> >No</option>																																					 </select>
											</div>
										</div>
																		</div>
													</div>
													<div class="col-lg-6">
						<div class="form-group row pr-md-3">
						<div class="col-md-4">
						<label>{{ __('mainproducts.Item Type') }}</label>
			</div>																					 <div class="col-md-8">
							<div class="input-group input-group-sm">
								<select class="form-control single-select kt-selectpicker reorder_quantity_alert" name="reorder_quantity_alert" id="reorder_quantity_alert">
																				<option value="1" <?php      
              if($data->reorder_quantity_alert == 1)
             { echo "selected"; }
             ?>>Enabled</option>
									<option value="2" <?php      
              if($data->reorder_quantity_alert == 2)
             { echo "selected"; }
             ?> >Disabled</option>																																					 </select>
											</div>
										</div>
																		</div>
													</div>
											
										<div class="col-lg-6" id="quantity_tab">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Reorder Quantity</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<div class="input-group input-group-sm">
													<input type="text" class="form-control" name="alert_quantity" id="alert_quantity" value="{{$data->reorder_quantity}}">
															

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
													<label class="kt-label m-label--single">{{ __('mainproducts.Options') }}</label>
												</div>
												<div class="kt-form__control">

													<input id="s2Tags" name="options" placeholder="{{ __('mainproducts.Add Options') }}" value="">

												</div>
											</div>
											<div class="d-md-none kt-margin-b-10"></div>
										</div>
																			
																				<div class="col-md-2">

																						<div class="kt-form__group--inline">
																								<div class="kt-form__label">
																										<label class="kt-label m-label--single">{{ __('mainproducts.Action') }}</label>
																								</div>
																								<div class="kt-form__control">
																										<a id="addoption" class="btn-sm btn btn-label-info btn-bold">
																												<i class="la la-plus-square"></i>{{ __('mainproducts.Add') }}</a>
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
														<th>{{ __('mainproducts.Image') }}</th>
														
													</tr>
																								</thead>
																								<tbody>
																								
																									@php
																								$tr_count = 1
																								@endphp
																								@foreach($options as $option)
																								
																								<tr id=tr{{ $tr_count  }}>

																								
																									<td class="count" id='count{{ $tr_count  }}'>{{ $tr_count  }}</td>
																									<input type="hidden" class="form-control" name="vid[]" id=vid_textbox{{ $tr_count  }} value="{{ $option->id }}">
																									<td class="option" id=option{{ $tr_count  }}>{{ $option->variants }} <input type="hidden" class="form-control option_textbox" name="option[]" id="option_textbox{{ $tr_count  }}" value="{{ $option->variants }}"></td> 
																									<td><button type="button" class="btn btn-secondary variantproductcodeadd" data-id="{{tr_count}}"><i class="fa fa-random"></i>{{ __('mainproducts.Add') }}</button></td>
																									<td class="variantproductcode" id=variantproductcode{{tr_count}}><input type="text" class="form-control" name="variantproductcode[]" id="variantproductcode_textbox{{tr_count}}" value="" readonly></td>
																									
																									<td class="variantsku" id=variantsku{{tr_count}}><input type="text" class="form-control"  name="variantsku[]" id="variantsku_textbox{{tr_count}}" value="" readonly></td>
																									
																								<td class="variantbarcode" id=variantbarcode{{tr_count}}><input type="text"  class="form-control" name="variantbarcode[]" id="variantbarcode_textbox{{tr_count}}" value=""></td>
																								<td class="variantproductcost" id=variantproductcost{{tr_count}}><input type="text" class="form-control"  name="variantproductcost[]" id="variantproductcost_textbox{{tr_count}}" value=""></td>

																								<td><div class="form-group row"><div class="col-sm-12"><div class="dropzone dropzone-default dropzone-brand" id="file{{tr_count}}"><div class="dropzone-msg dz-message needsclick"><h3 class="dropzone-msg-title">Drop files here or click to upload.</h3></div></div></div></div></td>
																									<td><div class="kt-form__control remove"><a id="remove_row" class="btn-sm btn btn-label-info btn-bold"><i class="fa fa-trash"></i>{{ __('mainproducts.Remove') }}</a> </div></td>
																									
																																																	
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
					<select class="form-control single-select kt-selectpicker" name="maintain_batches" id="maintain_batches">
      	<option value="1" <?php      
              if($data->maintain_bathes == 1)
             { echo "selected"; }
             ?>>{{ __('mainproducts.Yes') }}</option>													
					<option value="2" <?php      
              if($data->maintain_bathes == 2)
             { echo "selected"; }
             ?>>{{ __('mainproducts.No') }}</option>
						
					</select>
					</div>
					</div>
					</div>
					<div class="col-lg-6">
					<div class="form-group row pr-md-3">
					<div class="col-md-4">											<label>{{ __('mainproducts.Batch Name') }}</label>
						</div>
					<div class="col-md-8 input-group input-group-sm">
				<select class="form-control single-select kt-selectpicker" name="batch_lot_no" id="batch_lot_no">
																									
																									@foreach($batches as $batchnames)
																									<?php
																									if($batchnames->id != $data->batch_lot_no)
																									{
																									?>
																									<option value="{{$batchnames->id}}">{{$batchnames->batchname}}</option>
																									<?php
																									}
																									else
																									{
																										?>
																										<option value="{{$batchnames->id}}" selected>{{$batchnames->batchname}}</option>
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
																														placeholder="" value="<?php echo $data->batch_lot_no;?>">
																										</div>
																								</div>
																						</div> -->

																			</div>
																			
																			<div class="tab-pane" id="product_images" role="tabpanel">
																					
																		

																		<div class="form-group row">
																		<div class="col-lg-12">
																		<input type="hidden" name="fileData" id="fileData" value="<?php echo $data->image?>"/>
																		<div id="choose-files">
																		<form action="/upload">
																		<input type="file" id="files" name="files[]" value="<?php echo $data->image?>" />
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
																													<input type="text" class="form-control ktdatepicker" name="manufacturing_date" id="manufacturing_date"
																															placeholder="" value="<?php echo $data->manufacturing_date;?>" autocomplete="off">
																											</div>
																									</div>
																							</div>
																							<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>Days for Shelf Life</label>
											</div>
											<div class="col-md-8 input-group input-group-sm">
												<input type="text" class="form-control shelflife" name="shelflife" id="shelflife" placeholder="" autocomplete="off" value="<?php echo $data->shelflife;?>">
											</div>
										</div>
									</div>
																							<div class="col-lg-6">
																									<div class="form-group row pr-md-3">
																											<div class="col-md-4">
																													<label>{{ __('mainproducts.Expiry Date') }}</label>
																											</div>
																											<div class="col-md-8 input-group input-group-sm">
																													<input type="text" class="form-control ktdatepicker" name="expiry_date" id="expiry_date" 
																															placeholder="" value="<?php echo $data->expiry_date;?>" autocomplete="off">
																											</div>
																									</div>
																							</div>
																					

																							<div class="col-lg-6">
																									<div class="form-group row pr-md-3">
																											<div class="col-md-4">
																													<label>{{ __('mainproducts.Expiry Reminder') }}</label>
																											</div>
																											<div class="col-md-8 input-group input-group-sm">
																													<input type="text" class="form-control expiry_reminder" name="expiry_reminder" id="expiry_reminder" 
																															placeholder="" value="<?php echo $data->expiry_reminder;?>"autocomplete="off">
																											</div>
																									</div>
																							</div>

																							<div class="col-lg-6">
																									<div class="form-group row pr-md-3">
																											<div class="col-md-4">
																													<label>{{ __('mainproducts.Warranty Date') }}</label>
																											</div>
																											<div class="col-md-8 input-group input-group-sm">
																													<input type="text" class="form-control ktdatepicker" name="warranty_date" id="warranty_date" 
																															placeholder="" value="<?php echo $data->warranty_date;?>" autocomplete="off">
																											</div>
																									</div>
																							</div>
																						
																							<div class="col-lg-6">
																									<div class="form-group row pr-md-3 ">
																											<div class="col-md-4">
																													<label>{{ __('mainproducts.Warranty Reminder') }}</label>
																											</div>
																											<div class="col-md-8 input-group input-group-sm">
																													<input type="text" class="form-control warranty_reminder" name="warranty_reminder" id="warranty_reminder" 
																															placeholder="" value="<?php echo $data->warranty_reminder;?>">
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
																												<input type="text" class="form-control" name="upc" id="upc" 
																														placeholder="{{ __('mainproducts.universal product code') }}" value="<?php echo $data->upc;?>">
																										</div>
																								</div>
																						</div>

																						<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.EAN') }}</label>
																										</div>
																										<div class="col-md-8 input-group input-group-sm">
																												<input type="text" class="form-control" name="ean" id="ean" 
																														placeholder="{{ __('mainproducts.European Article Number') }}" value="<?php echo $data->ean;?>">
																										</div>
																								</div>
																						</div>

																						<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.JAN') }}</label>
																										</div>
																										<div class="col-md-8 input-group input-group-sm">
																												<input type="text" class="form-control" name="jan" id="jan" 
																														placeholder="{{ __('mainproducts.Japaneese Article Number') }}" value="<?php echo $data->jan;?>">
																										</div>
																								</div>
																						</div>

																						<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.ISBN') }}</label>
																										</div>
																										<div class="col-md-8 input-group input-group-sm">
																												<input type="text" class="form-control" name="isbn" id="isbn" 
																														placeholder="{{ __('mainproducts.International Standard Book Number') }}" value="<?php echo $data->isbn;?>">
																										</div>
																								</div>
																						</div>

																						<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.MPN') }}</label>
																										</div>
																										<div class="col-md-8 input-group input-group-sm">
																												<input type="text" class="form-control" name="mpn" id="mpn" 
																														placeholder="{{ __('mainproducts.Manufacturer  Number') }}" value="<?php echo $data->mpn;?>">
																										</div>
																								</div>
																						</div>
																						<div class="col-lg-6">
						<div class="form-group row pr-md-3">
					<div class="col-md-4">
					<label>Refundable</label>
								</div>
					<div class="col-md-8 input-group input-group-sm">
					<select class="form-control single-select kt-selectpicker" name="refundable" id="refundable">
      	<option value="1" <?php      
              if($data->refundable == 1)
             { echo "selected"; }
             ?>>{{ __('mainproducts.Yes') }}</option>													
					<option value="2" <?php      
              if($data->refundable == 2)
             { echo "selected"; }
             ?>>{{ __('mainproducts.No') }}</option>
						
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
<input type="hidden" name="branch" id="branch" value="{{$branch}}">
								<div class="kt-portlet__foot p-0">
										<div class="kt-form__actions">
												<div class="row">
														<div class="col-lg-6">

														</div>
														<div class="col-lg-6 kt-align-right">
																<button type="submit" name="product_submit" id="product_submit" class="btn btn-primary float-right "><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>  {{ __('mainproducts.Save') }}</button>
																	<button type="button" class="btn btn-secondary mr-2"  onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> {{ __('mainproducts.Cancel') }}</button>
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
		function goPrev()
		{
	window.history.back();
	}
</script>

<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/tagify.js" type="text/javascript"></script>
<script type="text/javascript">
	var tr_count = {{ $tr_count+1  }}; 
	var input = document.querySelector('input[name=options]');
	var tagify = new Tagify(input)

	$(function() {
		$('#attribute').on('change', function() {
			var attribute_id = $("#attribute option:selected").val();
			$.ajax({
				type: 'GET',
				url: '{!!URL::to('getoptions')!!}',
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

$(document.body).on("change", ".unit", function() 
	{
		var unit = $(this).val();
	
		$.ajax({
		url: "getsellingunits",
		method: "POST",
		data: {
			_token: $('#token').val(),
			id:unit
		},
		dataType: "json",
		success: function(data) {
			console.log(data);
			$('#selling_units').empty();
					
			$.each(data, function(key, value) {
						$('#selling_units').append('<option value="'+ value.id +'">'+ value.unit_name +'</option>');
						});

		}
	})
	}); 






	$("#addoption").click(function() {
	
		var productname = $('#product_name').val();
		if (productname=="") 
       {
       $('#product_name').addClass('is-invalid');
        toastr.warning('Product Name is required.');
        $("#basic_details").trigger("click");
       return false;
       } 
       else
       {
          $('#product_name').removeClass('is-invalid');
       } 

		var option_array = [];

		var option_value = $("#s2Tags").val();
	 
		//   console.log(option_value);
		const parsed = JSON.parse(option_value);
		for (i = 0; i < parsed.length; i++) {
			var option_value = parsed[i].value;
			if ('Type and hit Enter' != option_value) {
				var all_options = productname+" - "+option_value;
				// option_array.push(option_value);
				$("#variant_table").each(function() {

			var tds = '<tr id=tr' + tr_count + '>';
			tds += '<td class="count" id=count' + tr_count + '>' + tr_count + '</td>' + '<td class="option" id=option' + tr_count + '>' + all_options + '<input type="hidden" class="form-control option_textbox" name="option[]" id="option_textbox'+tr_count+'" value="' + all_options + '">'+ '</td>'+'<td><button type="button" class="btn btn-secondary variantproductcodeadd" data-id="'+tr_count+'"><i class="fa fa-random"></i>{{ __('mainproducts.Add') }}</button></td>' + '<td class="variantproductcode" id=variantproductcode' + tr_count + '>' + '<input type="text" class="form-control" name="variantproductcode[]" id="variantproductcode_textbox'+tr_count+'" value="" readonly>' + '</td>'+'<td class="variantsku" id=variantsku' + tr_count + '>' + '<input type="text" class="form-control"  name="variantsku[]" id="variantsku_textbox'+tr_count+'" value="" readonly>' + '</td>' + '<td class="variantbarcode" id=variantbarcode' + tr_count + '>' + '<input type="text"  class="form-control" name="variantbarcode[]" id="variantbarcode_textbox'+tr_count+'" value="">' + '</td>'+'<td class="variantproductcost" id=variantproductcost' + tr_count + '>' + '<input type="text" class="form-control"  name="variantproductcost[]" id="variantproductcost_textbox'+tr_count+'" value="">' + '</td>'+'<td><div class="form-group row"><div class="col-sm-12"><div class="dropzone dropzone-default dropzone-brand" id="file'+tr_count+'"><div class="dropzone-msg dz-message needsclick"><h3 class="dropzone-msg-title">Drop files here or click to upload.</h3></div></div></div></div></td>' + '<td>'+'<div class="kt-form__control remove"><a id="remove_row" class="btn-sm btn btn-label-info btn-bold"><i class="fa fa-trash"></i>{{ __('mainproducts.Remove') }}</a> </div>' + '</td>';



			tds += '</tr>';
			if ($('tbody', this).length > 0) {
				$('tbody', this).append(tds);
			} else {
				$(this).append(tds);
			}

			 Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("div#file"+tr_count, {
                url: "static/phpFiles/test.php"
        });
            
		//	tagify.removeAllTags.bind(tagify);

			 tagify.removeAllTags();


		});
		tr_count++;
		duplicate=0;

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
	$("body").on("click",".remove",function(event){
		event.preventDefault();
		var row = $(this).closest('tr');
		
	
				var siblings = row.siblings();
				row.remove();
				siblings.each(function(index) {
					$(this).children().first().text(index);
				});
	
	calculate();
});
$(document.body).on("change", "input[type=radio][name=sup_vendor]", function() 
	{

		


		var checkedValue = $('input[name="sup_vendor"]:checked').val();
			//	alert(checkedValue);
		$.ajax({
		url: "getsupplier_vendor1",
		method: "POST",
		data: {
			_token: $('#token').val(),
			id:checkedValue
		},
		dataType: "json",
		success: function(data) {
			console.log(data);
			$('select[name="sup_vendorname"]').empty();
			$.each(data, function(key, value) {
						$('select[name="sup_vendorname"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
						});

		}
	})
	});
$(document.body).on("change", ".reorder_quantity_alert", function() 
 {
  var checkedValue = $('#reorder_quantity_alert').val();
  if(checkedValue == 1)
  {
   $('#alert_quantity').removeAttr('disabled'); //Enable
  }
  else
  {
   $('#alert_quantity').val("");
   $('#alert_quantity').attr('disabled', 'disabled'); //Disable

  }
  
 }); 

$(document.body).on("click", ".productadd", function() 
	{
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

$(document.body).on("click", ".variantproductcodeadd", function() 
	{

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
			$('#variantproductcode_textbox'+cc+'').val(data);
			$('#variantsku_textbox'+cc+'').val(data);
			$('#variantbarcode_textbox'+cc+'').val(data);
			
		}
	})
	});
$(document.body).on("keyup  change", ".product_price", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });
$(document.body).on("keyup  change", ".selling_price", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });
$(document.body).on("keyup  change", ".opening_stock", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });
$(document.body).on("keyup  change", ".shelflife", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });
$(document.body).on("keyup  change", ".warranty_reminder", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });
$(document.body).on("keyup  change", ".expiry_reminder", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });



$(document.body).on("change", "#warehouse", function() 
    {
        var warehouse = $(this).val();
        $.ajax({
        url: "getstorename",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:warehouse
        },
        dataType: "json",
          success: function(data) {
            console.log(data);
            $('#store').empty();
            $('#store').append('<option value="">select</option>');
            $.each(data, function(key, value) {
                        $('#store').append('<option value="'+ value.store_name +'">'+ value.store_name +'</option>');
                        });

        }
    })
    });
$(document.body).on("change", "#store", function() 
    {
        var store = $(this).val();
        $.ajax({
        url: "getrackname1",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:store
        },
        dataType: "json",
          success: function(data) {
            console.log(data);
            $('#rack').empty();
            $('#rack').append('<option value="">select</option>');
            $.each(data, function(key, value) {
                        $('#rack').append('<option value="'+ value.rack_name +'">'+ value.rack_name +'</option>');
                        });

        }
    })
    });


$(document).on('click', '#product_submit', function(e) {
    e.preventDefault();

    product_name = $('#product_name').val();
    product_code = $('#product_code').val();
    barcode = $('#barcode').val();
    barcode_format = $('#barcode_format').val();  
    unit = $('#unit').val();
    kt_tagify_5 = $('#kt_tagify_5').val();
    category = $('#category').val();
   
    selling_units = $('#selling_units').val();
    out_of_stock_status = $('#out_of_stock_status').val();
    product_status = $('#product_status').val();
    opening_stock = $('#opening_stock').val();
    enable_minus_stock_billing = $('#enable_minus_stock_billing').val();
    reorder_quantity_alert = $('#reorder_quantity_alert').val();
    taxable = $('#taxable').val();
    sales_tax_groups = $('#sales_tax_groups').val();
    purchase_tax_group = $('#purchase_tax_group').val();
    item_type = $('input[name="product_type"]:checked').val();
    refundable = $('#refundable').val();
    manufacturer = $('#manufacturer').val();
    brand = $('#brand').val();
    attribute = $('#attribute').val();

    serial_number = $('#serial_number').val();
    model_no = $('#model_no').val();
    part_no = $('#part_no').val();
    maintain_batches = $('#maintain_batches').val();
    batch_lot_no = $('#batch_lot_no').val();
    manufacturing_date = $('#manufacturing_date').val();
    expiry_date = $('#expiry_date').val();
    expiry_reminder = $('#expiry_reminder').val();
    warranty_date = $('#warranty_date').val();
    warranty_reminder = $('#warranty_reminder').val();
    sku = $('#sku').val();
    upc = $('#upc').val();
    ean = $('#ean').val();
    jan = $('#jan').val();
    isbn = $('#isbn').val();
    mpn = $('#mpn').val();
    // sales_accountant = $('#sales_accountant').val();
    // purchase_accountant = $('#purchase_accountant').val();
    // inventory_accountant = $('#inventory_accountant').val();
    fileData = $('#fileData').val();
    product_type = $('input[name="product_type"]:checked').val();
    product_price = $('#product_price').val();
    warehouse = $('#warehouse').val();
    


       if (product_name=="") 
       {
       $('#product_name').addClass('is-invalid');
        toastr.warning('Product Name is required.');
       return false;
       } 
       else
       {
          $('#product_name').removeClass('is-invalid');
       } 
       
       if (category=="") 
       {
       $('#category').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('category is required.');      
       return false;
       } 
       else
       {
          $('#category').next().find('.select2-selection').removeClass('select-dropdown-error');
       }
       if (unit=="") 
       {
       $('#unit').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Unit is required.');      
       return false;
       } 
       else
       {
          $('#unit').next().find('.select2-selection').removeClass('select-dropdown-error');
       } 
       if (product_code=="") 
       {
       $('#product_code').addClass('is-invalid');
        toastr.warning('Product code is required.');      
       return false;
       } 
       else
       {
          $('#product_code').removeClass('is-invalid');
       } 
       
       if (warehouse=="") 
       {
       $('#warehouse').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('warehouse is required.');      
       return false;
       } 
       else
       {
          $('#warehouse').next().find('.select2-selection').removeClass('select-dropdown-error');
       } 
        

    var arvid = [];

    $("input[name^='vid[]']")
        .each(function(input) {
            arvid.push($(this).val());
        });


    var aroption = [];

    $("input[name^='option[]']")
        .each(function(input) {
            aroption.push($(this).val());
        });

    var variantproductcode = [];

    $("input[name^='variantproductcode[]']")
        .each(function(input) {
            variantproductcode.push($(this).val());
        });

    var variantsku = [];

    $("input[name^='variantsku[]']")
        .each(function(input) {
            variantsku.push($(this).val());
        });

    var variantbarcode = [];

    $("input[name^='variantbarcode[]']")
        .each(function(input) {
            variantbarcode.push($(this).val());
        });

    var variantproductcost = [];

    $("input[name^='variantproductcost[]']")
        .each(function(input) {
            variantproductcost.push($(this).val());
        });

    var variantimage = [];

    $("input[name^='variantimage[]']")
        .each(function(input) {
            variantimage.push($(this).val());
        });

         var variantstock = [];

        $("input[name^='variantstock[]']")
        .each(function(input) {
            variantstock.push($(this).val());
        });
        

        

        $('#product_submit').addClass('kt-spinner');
        $(this).prop("disabled", true);
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      


    $.ajax({
        type: "POST",
        url: "warproduct_submits",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            product_name: $('#product_name').val(),
            product_code: $('#product_code').val(),
            barcode: $('#barcode').val(),
            barcode_format: $('#barcode_format').val(),
            unit: $('#unit').val(),
            category: $('#category').val(),
            // out_of_stock_status: $('#out_of_stock_status').val(),
            // product_status: $('#product_status').val(),
            description: $('#description').val(),
            available_stock: $('#opening_stock').val(),
            opening_stock: $('#opening_stock').val(),
            enable_minus_stock_billing:  $('input[name="enable_minus_stock_billing"]:checked').val(),
            reorder_quantity_alert:$('input[name="reorder_quantity_alert"]:checked').val(),
            alert_quantity: $('#alert_quantity').val(),
            taxable: $('#taxable').val(),
            sales_tax_groups: $('#sales_tax_groups').val(),
            purchase_tax_group: $('#purchase_tax_group').val(),
            item_type: $('input[name="product_type"]:checked').val(),
            refundable: $('#refundable').val(),
            manufacturer: $('#manufacturer').val(),
            brand: $('#brand').val(),
            serial_number: $('#serial_number').val(),
            model_no: $('#model_no').val(),
            part_no: $('#part_no').val(),
            maintain_batches: $('#maintain_batches').val(),
            batch_lot_no: $('#batch_lot_no').val(),
            manufacturing_date: $('#manufacturing_date').val(),
            expiry_date: $('#expiry_date').val(),
            expiry_reminder: $('#expiry_reminder').val(),
            warranty_date: $('#warranty_date').val(),
            warranty_reminder: $('#warranty_reminder').val(),
            sku: $('#sku').val(),
            upc: $('#upc').val(),
            ean: $('#ean').val(),
            jan: $('#jan').val(),
            isbn: $('#isbn').val(),
            mpn: $('#mpn').val(),
            fileData:$('#fileData').val(),
            // sales_accountant: $('#sales_accountant').val(),
            // purchase_accountant: $('#purchase_accountant').val(),
            // inventory_accountant: $('#inventory_accountant').val(),
            variant_id : arvid,
            product_variant: aroption,
            variantproductcode : variantproductcode,
            variantsku : variantsku,
            variantbarcode : variantbarcode,
            variantproductcost : variantproductcost,
            variantimage : variantimage,
            branch : $('#branch').val(),
            // product_type : $('input[name="product_type"]:checked').val(),
            product_price : $('#product_price').val(),
            sup_vendor : $('input[name="sup_vendor"]:checked').val(),
            sup_vendorname : $('#sup_vendorname').val(),
            quantity : $('#quantity').val(),
            alert_quantity : $('#alert_quantity').val(),
            hsn_code : $('#hsn_code').val(),
            variantstock : variantstock,
            selling_price : $('#selling_price').val(),
            lotno : $('#lotno').val(),
            shelflife : $('#shelflife').val(),
            countryoforigin : $('#countryoforigin').val(),
            cfds : $('#cfds').val(),
            reference : $('#reference').val(),
            catno : $('#catno').val(),
            warehouse : $('#warehouse').val(),
            store : $('#store').val(),
            rack : $('#rack').val()


            
        },
        success: function(data) {
            console.log(data);
          if(data == false)
          {
            $('#product_submit').removeClass('kt-spinner');
            $('#product_submit').prop("disabled", false);
            toastr.warning('Product namme already exist');
          }
            // uppy.reset();
            else
            {
            $('#product_submit').removeClass('kt-spinner');
            $('#product_submit').prop("disabled", false);
            toastr.success('Product details ' + sucess_msg + ' successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
               const channel = new BroadcastChannel("inventory");
               channel.postMessage("success");

            location.reload();
            // window.location.href = "stock_master";
            window.location.href = "stockMaster1";
          }
        },
        error: function(jqXhr, json, errorThrown) {
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors, function(key, value) {
                if (jQuery.isPlainObject(value)) {

                    $.each(value, function(index, ndata) {
                        errorsHtml += '<li>' + ndata + '</li>';
                    });

                } else {

                    errorsHtml += '<li>' + value + '</li>';

                }
            });
            toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
        }
    });

    return false;

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

<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script>
@endsection
