@extends('asset.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
<?php
foreach($areas as $areas)
{
	$id = $areas->id;
	$name = $areas->name;
$description = $areas->description;
}

?>
<input type="hidden" name="id" id="id" value="{{$id}}">

							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											New Asset Category
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body pr-0">
                                <form class="kt-form" id="kt_form">
                                 <div class="row" style="padding-bottom: 6px;">
                                    
                                   
                                    <div class="col-lg-6">
                                    <div class="form-group row pr-md-3">
                                    <div class="col-md-4">
                                    <label>Category Name</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="name"  id="name" value="{{$name}}">
                                    </div>
                                    </div>
                                    </div>
                                     <div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>Description</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <textarea class="form-control" name="description" rows="1"  id="description">{{$description}}</textarea>
                                    </div>
                                    </div>
                                    </div>

                                    
                                    
                                 </div>
                                 <div class="kt-portlet__foot pr-0">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="submit" name="assetcategory_submit" id="assetcategory_submit" class="btn btn-primary float-right">
																<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Save</button>
															<button type="reset" class="btn btn-secondary float-right mr-1" onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel</button>
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
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<!-- <script src="{{url('/')}}/resources/js/custom/rack.js" type="text/javascript"></script> -->
<!-- <script src="{{url('/')}}/resources/js/custom/select2.js" type="text/javascript"></script>
 -->
<script src="{{url('/')}}/resources/js/asset/category.js" type="text/javascript"></script>
 <script type="text/javascript">
 function goPrev()
{
window.history.back();
}
 </script>
 @endsection