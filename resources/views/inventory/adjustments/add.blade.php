@extends('inventory.common.layout')
@section('content')
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
                                   <div class="kt-subheader__breadcrumbs">

										<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

										<span class="kt-subheader__breadcrumbs-separator"></span>

									    {{ Breadcrumbs::render('NewAdjustment') }}

									</div>
								</div>
							
							</div>
						</div>

	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											{{ __('adjustments.New Inventory Adjustment') }}
										</h3>
									</div>
									
								</div>

								<div class="kt-portlet__body">

                                <form class="kt-form" id="kt_form">
                                
                                 <div class="row" >
                                                                

                                    <div class="col-lg-6">
                                    <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('adjustments.Reference Number') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                    <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="address1" placeholder="{{ __('adjustments.Reference Number') }}">
                                    </div>
                                    </div>
                                    </div>
                                    </div>

                                    <div class="col-lg-6">
                                    <div class="form-group row  pl-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('adjustments.Date') }}</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="address1" placeholder="">
                                    </div>
                                    </div>
                                    </div>

                                    <div class="col-lg-6">
                                    <div class="form-group row  pr-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('adjustments.Account') }}</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <select class="form-control single-select">
                                     <option value="">{{ __('adjustments.Select') }}</option>
                                     <option value="1">{{ __('adjustments.Account 1') }}</option>
                                     <option value="2">{{ __('adjustments.Account 2') }}</option>
                                    </select>
                                    </div>
                                    </div>
                                    </div>

                                    <div class="col-lg-6">
                                    <div class="form-group row  pl-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('adjustments.Reason') }}</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="address1" placeholder="{{ __('adjustments.Reason') }}">
                                    </div>
                                    </div>
                                    </div>

                                    <div class="col-lg-6">
                                    <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('adjustments.Description') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                    <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="address1" placeholder="">
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6"></div>
                                </div>
                                <div class="row" >
                
									<div class="row">
									<div class="col-md-3">
									<div class="kt-form__group--inline">
									<div class="kt-form__label">
									<label>{{ __('adjustments.Item Details') }}:</label>
									</div>
									<div class="kt-form__control">
									<input type="email" class="form-control" placeholder="">
									</div>
									</div>
									<div class="d-md-none kt-margin-b-10"></div>
									</div>
									<div class="col-md-3">
									<div class="kt-form__group--inline">
									<div class="kt-form__label">
									<label class="kt-label m-label--single">{{ __('adjustments.Current value') }}:</label>
									</div>
									<div class="kt-form__control">
									<input type="email" class="form-control" placeholder="">
									</div>
									</div>
									<div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    <div class="col-md-2">
									<div class="kt-form__group--inline">
									<div class="kt-form__label">
									<label class="kt-label m-label--single">{{ __('adjustments.Changed value') }}:</label>
									</div>
									<div class="kt-form__control">
									<input type="email" class="form-control" placeholder="">
									</div>
									</div>
									<div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    <div class="col-md-2">
									<div class="kt-form__group--inline">
									<div class="kt-form__label">
									<label class="kt-label m-label--single">{{ __('adjustments.Adjusted value') }}:</label>
									</div>
									<div class="kt-form__control">
									<input type="email" class="form-control" placeholder="+/- 10">
									</div>
									</div>
									<div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    
									<div class="col-md-2 pt-1">
									<a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold mt-4">
									<i class="la la-trash-o"></i>{{ __('adjustments.Delete') }}</a>
                                    </div>   
									</div>                
                                    
                                 </div>
                                 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
															
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="reset" class="btn btn-primary">{{ __('adjustments.Save') }}</button>
															<button type="reset" class="btn btn-secondary">{{ __('adjustments.Cancel') }}</button>
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
<!--end::Modal-->
@endsection
@section('script')
<!-- 
    <script src="{{url('/')}}/assets/js/pages/crud/datatables/basic/customer.js" type="text/javascript"></script> -->

@endsection
