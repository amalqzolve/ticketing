@extends('inventory.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											{{ __('product.Edit Category') }}
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
                                   <?php
                                   foreach ($datas as $key => $value) {
                                    $id            =$datas->id;
                                    $description   =$datas->description;
                                    $startingnumber=$datas->starting_number;
                                    $categoryname  =$datas->category_name;
                                    $categorycode  =$datas->category_code;
                                    
                                   }
                                   ?>
                                <form class="kt-form" id="product_category">
                                <input type="hidden" name="id" id="id" value="<?php echo $id?>">
                                 <div class="row" style="padding-bottom: 6px;">
                                    <div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4 pt-2"  style="white-space: nowrap;">
                                    <label>{{ __('product.Category Name') }}<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                    <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="categoryname" id="categoryname" placeholder="{{ __('product.Category Name') }}" autocomplete="off" value="<?php echo $categoryname; ?>">
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                       <div class="col-lg-6">
                           <div class="form-group row pl-md-3">
                           <div class="col-md-4 pt-2"  style="white-space: nowrap;">
                           <label>{{ __('product.Category Code') }}<span style="color: red">*</span></label>
                           </div>
                           <div class="col-md-8">
                           <div class="input-group input-group-sm">
                           <input type="text" class="form-control" name="categorycode" id="categorycode" placeholder="{{ __('Category Code') }}" autocomplete="off" value="<?php echo $categorycode; ?>">
                           </div>
                           </div>
                           </div>
                           </div>
                                  <!--   <div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('product.Starting Number') }}</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="number" min="0" class="form-control" name="startingnumber" placeholder="{{ __('product.Category Name') }}" id="startingnumber" autocomplete="off" value="<?php echo $startingnumber; ?>">
                                    </div>
                                    </div>
                                    </div> -->
                                    <div class="col-lg-12">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-2">
                                    <label>{{ __('app.Note') }}</label>
                                    </div>  
                                    <div class="col-md-10 input-group input-group-sm">
                                     <textarea class="form-control" name="description" id="description" autocomplete="off" placeholder="{{ __('app.Note') }}"><?php echo $description; ?></textarea>
                                    </div>
                                    </div>
                                    </div>
                                 </div>
                                 <div class="kt-portlet__foot pr-0">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
															<input type="hidden" class="form-control" name="branch" value="{{$branch}}" id="branch" >
														</div>
														<div class="col-lg-6 kt-align-right">
															<button id="Productcategorysubmit" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>  {{ __('product.Save') }}</button>
															<button type="button" class="btn btn-secondary mr-2"  onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>  {{ __('app.Cancel') }}</button>


														</div>
													</div>
												</div>
											</div>
                                </form>
								</div>
							</div>
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
@section('script')
<script type="text/javascript">
   function goPrev()
    {
  window.history.back();
  }
</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/product_category.js" type="text/javascript"></script>
@endsection