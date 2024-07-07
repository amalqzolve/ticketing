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
																		<a class="nav-link" data-toggle="tab" href="#stock_details" role="tab">{{ __('mainproducts.Stock') }}</a>
																</li>
																
																

															<!-- 	<li class="nav-item">
																		<a class="nav-link" data-toggle="tab" href="#product_variant" role="tab">{{ __('mainproducts.Product Variants') }}</a>
																</li> -->

																<li class="nav-item">
																		<a class="nav-link" data-toggle="tab" href="#product_details" role="tab">{{ __('mainproducts.Product Details') }}</a>
																</li>
																
																<li class="nav-item">
																		<a class="nav-link" data-toggle="tab" href="#product_images" role="tab">{{ __('mainproducts.Images') }}</a>
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
																	<!-- <li class="nav-item">
																		<a class="nav-link" data-toggle="tab" href="#accounting_configuration"
																				role="tab">{{ __('mainproducts.Accounts Configuration') }}</a>
																</li> -->


														</ul>
														<div class="tab-content">
																<input type="hidden" name="id" id="id" value="<?php echo $data->id;?>">
																<div class="tab-pane active" id="basic_details" role="tabpanel">
																	<div class="row">
																		<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>{{ __('mainproducts.Product Type') }}</label>
											</div>
											<div class="col-md-4">
												:
											</div>
											<div class="col-md-4 input-group input-group-sm">
												<div class="input-group input-group-sm">
													
																		
						@if($data->product_status == 1)
						{{ __('mainproducts.Product') }}
						@endif
						@if($data->product_status == 2)								
						{{ __('mainproducts.Service') }}
						@endif
												
												</div>
											</div>
										</div>
									</div>
													<div class="col-lg-6">
													<div class="form-group row pl-md-3">
												<div class="col-md-4">
												<label>{{ __('mainproducts.Product Name') }}</label>
															</div>
															<div class="col-md-4">
												:
											</div>
												<div class="col-md-4 input-group input-group-sm">
												<?php echo $data->product_name;?>
																						</div>
													</div>
													</div>
													<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>{{ __('mainproducts.Category') }}</label>
									</div>
									<div class="col-md-4">
												:
											</div>
									<div class="col-md-4">
									<div class="input-group input-group-sm">
									
																								@foreach($categorylist as $category)
																												
																													@if($data->category==$category->id)
																													
																																{{$category->category_name}}
																																@endif
																														@endforeach
																												
																										
																								</div>
																						</div>
																				</div>
																		</div>
																		<div class="col-lg-6">
							<div class="form-group row pl-md-3">
								<div class="col-md-4">
							<label>{{ __('mainproducts.Unit') }}</label>
											</div>
											<div class="col-md-4">
												:
											</div>
									<div class="col-md-4">
									<div class="input-group input-group-sm">
									
									@foreach($unit as $unit)
										
									@if($data->unit==$unit->id)
								
								{{$unit->unit_name}}
								@endif
														@endforeach
																												
																									
																								</div>
																						</div>
																				</div>
																		</div>
											<div class="col-lg-6">
											<div class="form-group row pr-md-3">
											<div class="col-md-4">
										<label>{{ __('mainproducts.Product Code') }}</label>
										</div>
										<div class="col-md-4">
												:
											</div>
									<div class="col-md-4 input-group input-group-sm">
									<?php echo $data->product_code;?>
																						</div>
								</div>
								</div>
											<div class="col-lg-6">
																								<div class="form-group row pl-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.SKU') }}</label>
																										</div>
																										<div class="col-md-4">
																												:
																										</div>
																										<div class="col-md-4 input-group input-group-sm">
																												<?php echo $data->sku;?>
																										</div>
																								</div>
																						</div>						
								<div class="col-lg-6">
								<div class="form-group row pr-md-3">
								<div class="col-md-4">
								<label>{{ __('mainproducts.Barcode') }}</label>
								</div>
								<div class="col-md-4">
												:
											</div>
								<div class="col-md-4 input-group input-group-sm">
								<?php echo $data->barcode;?>
																						</div>
							</div>
															</div>

															<div class="col-lg-6">
								<div class="form-group row pl-md-3">
								<div class="col-md-4">
								<label>{{ __('mainproducts.Barcode Format') }}</label>
								</div>
								<div class="col-md-4">
												:
											</div>
								<div class="col-md-4 input-group input-group-sm">
								<?php echo $data->barcode_format;?>
																						</div>
							</div>
															</div>
															
							

																		
																	
									

					<div class="col-lg-6">
					<div class="form-group row pr-md-3">
					<div class="col-md-4">
					<label>{{ __('mainproducts.Out of Stock Status') }}</label>
							</div>
							<div class="col-md-4">
												:
											</div>
					<div class="col-md-4 input-group input-group-sm">
					<div class="input-group input-group-sm">
					
																										
																														@if($data->out_of_stock_status == 1)
																														{{ __('mainproducts.Instock') }}
																														@endif
																														@if($data->out_of_stock_status == 2)
																														{{ __('mainproducts.Out of Stock') }}
																														@endif
																												
																										
																								</div>
																						</div>
																				</div>
																		</div>
																	

								<div class="col-lg-6">
								<div class="form-group row pl-md-3">
							<div class="col-md-4">
						<label>{{ __('mainproducts.Product Status') }}</label>
									</div>
									<div class="col-md-4">
												:
											</div>
						<div class="col-md-4 input-group input-group-sm">
						<div class="input-group input-group-sm">
						
															
						@if($data->product_status == 1)
						{{ __('mainproducts.Enabled') }}
						@endif
						@if($data->product_status == 2)								
						{{ __('mainproducts.Disabled') }}
						@endif
					
						</div>
						</div>
						</div>
						</div>
						<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>{{ __('app.Product Price') }}</label>
											</div>
											<div class="col-md-4">
												:
											</div>
											<div class="col-md-4">
												<div class="input-group input-group-sm">
													{{$data->product_price}}
												</div>
											</div>
										</div>
									</div>
						<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>{{ __('mainproducts.Quantity Available') }}</label>
											</div>
											<div class="col-md-4">
												:
											</div>
											<div class="col-md-4">
												<div class="input-group input-group-sm">
													{{$data->available_stock}}
												</div>
											</div>
										</div>
									</div>
										
									<div class="col-lg-6">
										<div class="form-group row pr-md-3">
											<div class="col-md-4">
												<label>{{ __('app.Supplier/Vendor') }}</label>
											</div>
											<div class="col-md-4">
												:
											</div>
											<div class="col-md-4">
												<div class="input-group input-group-sm">
													
                                        @if($data->provider == 1)
                                        Supplier
                                        @endif
                                        @if($data->provider == 2)
                                        Vendor
                                        @endif 

													
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>{{ __('mainproducts.Name') }}</label>
											</div>
											<div class="col-md-4">
												:
											</div>
											<div class="col-md-4 input-group input-group-sm">
												<div class="input-group input-group-sm">
													
                      @if($data->provider == 1)
                        
                        	            @foreach($suppliers as $suppliers)
                                     @if($data->provider_id==$suppliers->id) 
																																					{{$suppliers->name}}
																																					@endif
                                     @endforeach  
                                     
                                     																	
									              @endif
									              @if($data->provider == 2)
                        
                        	            @foreach($vendors as $vendors)
                                     @if($data->provider_id==$vendors->id) 
																																					{{$vendors->name}}
																																					@endif
                                     @endforeach  
                                     
                                     																	
									              @endif
														
													
												</div>
											</div>
										</div>
									</div>

						<div class="col-lg-6">
						<div class="form-group row pr-md-3">
						<div class="col-md-4">
						<label>{{ __('app.Description') }}</label>
						</div>
						<div class="col-md-4">
												:
											</div>
						<div class="col-md-4">
						<div class="input-group input-group-sm">
						{{$data->description}}
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
						<label>{{ __('mainproducts.Opening Stock') }}</label>
																								</div>
																								<div class="col-md-4">
												:
											</div>
																								<div class="col-md-4 input-group input-group-sm">
																										<?php echo $data->opening_stock;?>
																								</div>
																						</div>
																				</div>

												<div class="col-lg-6">
												<div class="form-group row pl-md-3">
												<div class="col-md-4">
												<label>{{ __('mainproducts.Enable minus stock billing') }}</label>
											</div>
											<div class="col-md-4">
												:
											</div>
											<div class="col-md-4 input-group input-group-sm">
													
																												
																														@if($data->enable_minus_stock_billing == 1)
																														{{ __('mainproducts.Yes') }}
																														@endif
																														@if($data->enable_minus_stock_billing == 2)
																														{{ __('mainproducts.No') }}
																														@endif
																												
																												
																										
																								</div>
																						</div>
																				</div>
																			
												<div class="col-lg-6">
											<div class="form-group row pr-md-3">
												<div class="col-md-4">
											<label>{{ __('mainproducts.Reorder Quality Alert') }}</label>
													</div>
													<div class="col-md-4">
												:
											</div>
										<div class="col-md-4 input-group input-group-sm">
										<div class="input-group input-group-sm">
										
																														@if($data->reorder_quantity_alert == 1)
																													{{ __('mainproducts.Enabled') }}
																													@endif
																														@if($data->reorder_quantity_alert == 2)
																														{{ __('mainproducts.Disabled') }}
																											@endif			
																														
																											
																										</div>
																								</div>
																						</div>
																				</div>
										<div class="col-lg-6" id="quantity_tab">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>{{ __('mainproducts.Quantity') }}</label>
											</div>
											<div class="col-md-4">
												:
											</div>
											<div class="col-md-4 input-group input-group-sm">
												<div class="input-group input-group-sm">
													{{$data->reorder_quantity}}
															

												</div>
											</div>
										</div>
									</div>
																			</div>
																			</div>

																<!-- <div class="tab-pane" id="product_variant" role="tabpanel">
												

																		<div class="col-lg-12">
																				<div class="kt-section__content">
																						<table class="table" id="variant_table">
																								<thead>
																										<tr>
																												<th>#</th>
																												<th>{{ __('mainproducts.Item Name') }}</th>
																												<th>{{ __('mainproducts.Stock') }}</th>
																												<th>{{ __('mainproducts.Cost price') }}</th>
																												<th>{{ __('mainproducts.Selling price') }}</th>
																												
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
																									
																									<td>{{ $option->sku }}</td>
																									
																									<td> {{ $option->cost_price }}</td>
																									
																									<td>{{ $option->selling_price }}</td>
																									
																									
																																																	
																									@php
																								$tr_count++;
																								@endphp
																									@endforeach

																								</tbody>
																						</table>
																				</div>
																		</div>
																</div> -->

					<div class="tab-pane" id="product_details" role="tabpanel">
						<div class="row">
						<div class="col-lg-6">
						<div class="form-group row pr-md-3">
						<div class="col-md-4">
						<label>{{ __('mainproducts.Item Type') }}</label>
			</div>																					 
			<div class="col-md-4">
										:
										</div><div class="col-md-4">
							<div class="input-group input-group-sm">
								
																
														@if($data->inventory_type == 1)
													{{ __('mainproducts.Inventory') }}
													@endif
											@if($data->inventory_type == 2)
										{{ __('mainproducts.non Inventory') }}
										@endif
											</div>
										</div>
																		</div>
													</div>
											<div class="col-lg-6">
											<div class="form-group row pl-md-3">
											<div class="col-md-4">
											<label>{{ __('mainproducts.Refundable') }}</label>									 </div>
											<div class="col-md-4">
										:
										</div>
										<div class="col-md-4 input-group input-group-sm">							
											<?php 
											if($data->refundable == "on")
											{
												?>
												<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
												<?php
											}
											else
											{
												?>
												<i class="fa fa-times mt-3 ml-3" aria-hidden="true" style="color: red;"></i>
												<?php
											}
										 ?>
																</div>
															</div>
														</div>					 
												<div class="col-lg-6">
												<div class="form-group row pr-md-3">
												<div class="col-md-4">
												<label>{{ __('mainproducts.Manufacturer') }}</label>												 </div>
												<div class="col-md-4">
										:
										</div>
											<div class="col-md-4 input-group input-group-sm">
											
											@foreach($manufacturerlist as $manufact)
											
											@if($data->manufacturer==$manufact->id)
												
											{{$manufact->manufacture_name}}
											@endif
											@endforeach
											
												</div>
											</div>
											</div>
												<div class="col-lg-6">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
										<label>{{ __('mainproducts.Brand') }}</label>
										</div>
										<div class="col-md-4">
										:
										</div>
										<div class="col-md-4">
										<div class="input-group input-group-sm">
											
												@foreach($brandlist as $brandlists)
																									
																									@if($brandlists->id == $data->brand)
																								{{$brandlists->brand_name}}
																								@endif
																									@endforeach
								
																												</div>
																										</div>
																								</div>
																						</div>
																					

																						<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.Serial Number') }}</label>
																										</div>
																										<div class="col-md-4">
																												:
																										</div>
																										<div class="col-md-4 input-group input-group-sm">
																												<?php echo $data->serial_number;?>
																										</div>
																								</div>
																						</div>

																						<div class="col-lg-6">
																								<div class="form-group row pl-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.Model No') }}</label>
																										</div>
																										<div class="col-md-4">
																												:
																										</div>
																										<div class="col-md-4 input-group input-group-sm">
																												<?php echo $data->model_no;?>
																										</div>
																								</div>
																						</div>
																					

																						<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.Part No') }}</label>
																										</div>
																										<div class="col-md-4">
																											:
																										</div>
																										<div class="col-md-4 input-group input-group-sm">
																												<?php echo $data->part_no;?>
																										</div>
																								</div>
																						</div>
																						<div class="col-lg-6">
																								<div class="form-group row pl-md-3">
																										<div class="col-md-4">
																												<label>HSN Code</label>
																										</div>
																										<div class="col-md-4">
																											:
																										</div>
																										<div class="col-md-4 input-group input-group-sm">
																												<?php echo $data->hsn_code;?>
																										</div>
																								</div>
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
								<div class="col-md-4">
																												:
																										</div>
					<div class="col-md-4 input-group input-group-sm">
					
															
					@if($data->maintain_batches == 1)
					{{ __('mainproducts.Yes') }}
					@endif
					@if($data->maintain_batches == 2)
						{{ __('mainproducts.No') }}
						@endif
					</select>
					</div>
					</div>
					</div>
					<div class="col-lg-6">
					<div class="form-group row pl-md-3">
					<div class="col-md-4">											<label>{{ __('mainproducts.Batch Name') }}</label>
						</div>
						<div class="col-md-4">
																												:
																										</div>
					<div class="col-md-4 input-group input-group-sm">
				
																									
																									@foreach($batches as $batchnames)
																									
																									@if($batchnames->id == $data->batch_name)
																								{{$batchnames->batchname}}
																								@endif
																									@endforeach
																												
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
																		
																			<?php $imgArray = explode(',', $data->image); 
																			foreach ($imgArray as $key => $value) { ?>


																<img class="kt-widget__img kt-hidden-" src="{{url('/public')}}/<?php echo $value; ?>" alt="image">
														



																		<?php	}?>
																		
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
																											<div class="col-md-4">
																												:
																										</div>
																											<div class="col-md-4 input-group input-group-sm">
																													<?php echo $data->manufacturing_date;?>
																											</div>
																									</div>
																							</div>
																							<div class="col-lg-6">
																									<div class="form-group row pl-md-3">
																											<div class="col-md-4">
																													<label>{{ __('mainproducts.Expiry Date') }}</label>
																											</div>
																											<div class="col-md-4">
																												:
																										</div>
																											<div class="col-md-4 input-group input-group-sm">
																													<?php echo $data->expiry_date;?>
																											</div>
																									</div>
																							</div>
																					

																							<div class="col-lg-6">
																									<div class="form-group row pr-md-3">
																											<div class="col-md-4">
																													<label>{{ __('mainproducts.Expiry Reminder') }}</label>
																											</div>
																											<div class="col-md-4">
																												:
																										</div>
																											<div class="col-md-4 input-group input-group-sm">
																													<?php echo $data->expiry_reminder;?>
																											</div>
																									</div>
																							</div>

																							<div class="col-lg-6">
																									<div class="form-group row pl-md-3">
																											<div class="col-md-4">
																													<label>{{ __('mainproducts.Warranty Date') }}</label>
																											</div>
																											<div class="col-md-4">
																												:
																										</div>
																											<div class="col-md-4 input-group input-group-sm">
																													<?php echo $data->warranty_date;?>
																											</div>
																									</div>
																							</div>
																						
																							<div class="col-lg-6">
																									<div class="form-group row pr-md-3 ">
																											<div class="col-md-4">
																													<label>{{ __('mainproducts.Warranty Reminder') }}</label>
																											</div>
																											<div class="col-md-4">
																												:
																										</div>
																											<div class="col-md-4 input-group input-group-sm">
																													<?php echo $data->warranty_reminder;?>
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
																												<label>{{ __('mainproducts.SKU') }}</label>
																										</div>
																										<div class="col-md-4">
																												:
																										</div>
																										<div class="col-md-4 input-group input-group-sm">
																												<?php echo $data->sku;?>
																										</div>
																								</div>
																						</div>

																						<div class="col-lg-6">
																								<div class="form-group row pl-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.UPC') }}</label>
																										</div>
																										<div class="col-md-4">
																												:
																										</div>
																										<div class="col-md-4 input-group input-group-sm">
																												<?php echo $data->upc;?>
																										</div>
																								</div>
																						</div>

																						<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.EAN') }}</label>
																										</div>
																										<div class="col-md-4">
																												:
																										</div>
																										<div class="col-md-4 input-group input-group-sm">
																												<?php echo $data->ean;?>
																										</div>
																								</div>
																						</div>

																						<div class="col-lg-6">
																								<div class="form-group row pl-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.JAN') }}</label>
																										</div>
																										<div class="col-md-4">
																												:
																										</div>
																										<div class="col-md-4 input-group input-group-sm">
																												<?php echo $data->jan;?>
																										</div>
																								</div>
																						</div>

																						<div class="col-lg-6">
																								<div class="form-group row pr-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.ISBN') }}</label>
																										</div>
																										<div class="col-md-4">
																												:
																										</div>
																										<div class="col-md-4 input-group input-group-sm">
																												<?php echo $data->isbn;?>
																										</div>
																								</div>
																						</div>

																						<div class="col-lg-6">
																								<div class="form-group row pl-md-3">
																										<div class="col-md-4">
																												<label>{{ __('mainproducts.MPN') }}</label>
																										</div>
																										<div class="col-md-4">
																												:
																										</div>
																										<div class="col-md-4 input-group input-group-sm">
																												<?php echo $data->mpn;?>
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

<script src="{{url('/')}}/resources/js/inventory/product.js" type="text/javascript"></script>
@endsection
