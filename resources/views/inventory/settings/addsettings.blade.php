@extends('inventory.common.layout')

@section('content')


           
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
                                   <div class="kt-subheader__breadcrumbs">

										<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

										<span class="kt-subheader__breadcrumbs-separator"></span>

									    {{ Breadcrumbs::render('New Settings') }}

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
											{{ __('settings.New Settings') }}
										</h3>
									</div>
									
								</div>

								<div class="kt-portlet__body">

                                <form class="kt-form" id="kt_form">
                                
                                 <div class="row" style="padding-bottom: 6px;">
                                                                

                                    


                                    <div class="col-lg-12">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('settings.Invoice Number Format') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                    <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="categoryname" placeholder="">
                                    </div>
                                    </div>
                                    </div>
                                    </div>

                                    <div class="col-lg-12">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('settings.Number Prefix') }}</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="startingnumber" placeholder="{{ __('settings.Starting Number') }}">
                                    </div>
                                    </div>
                                    </div>

                                    <div class="col-lg-12">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('settings.Number Suffix') }}</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                     <input type="text" class="form-control" name="startingnumber" placeholder="{{ __('settings.Starting Number') }}">
                                    </div>
                                    </div>
                                    </div>

                                    <div class="col-lg-12">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('settings.Applicable From') }}</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="date" class="form-control" name="startingnumber" placeholder="{{ __('settings.Starting Number') }}">
                                    </div>
                                    </div>
                                    </div>

                                    <div class="col-lg-12">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>{{ __('settings.Applicable To') }}</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="date" class="form-control" name="startingnumber" placeholder="{{ __('settings.Starting Number') }}">
                                    </div>
                                    </div>
                                    </div>

                                    

                                   
                                 </div>


                                 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
															
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="reset" class="btn btn-primary">{{ __('settings.Save') }}</button>
															<button type="reset" class="btn btn-secondary">{{ __('settings.Cancel') }}</button>
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
