@extends('settings.common.layout')
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
											Wallet Transaction
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">

								<form class="kt-form" id="kt_form">
								 <div class="row" style="padding-bottom: 6px;">
									
								   @foreach($wallettr as $wallettrs)
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Date<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control ktdatepicker" name="date" id="date" value="{{$wallettrs->date}}">
									</div>
									</div>
									</div>
									
									
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Account Name<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<select class="form-control kt-select2 accountname" id="accountname" name="accountname">
										@foreach($wallet as $wallets)
										<option value="{{$wallets->id}}"<?php if($wallettrs->account == $wallets->id) { echo 'selected'; }?>>{{$wallets->name}}</option>
										@endforeach
										
										
									</select>
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>DR/CR<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<select class="form-control kt-select2 drcr" id="drcr" name="drcr">
										<option value="">select</option>
										<option value="1"<?php if($wallettrs->drcr == 1) echo 'selected';?>>Debit</option>
										<option value="2"<?php if($wallettrs->drcr == 2) echo 'selected';?>>Credit</option>
										
									</select>
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Amounts<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control" name="amounts" id="amounts" value="{{$wallettrs->amounts}}">
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Notes<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
									<textarea class="form-control" name="notes" id="notes">{{$wallettrs->notes}}</textarea>
									</div>
									</div>
									</div>
									
								   
									

<input type="hidden" class="form-control" name="id" id="id" value="{{$wallettrs->id}}">
@endforeach
									<input type="hidden" class="form-control" name="branch" id="branch" value="{{$branch}}">
									
								 </div>
								 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="submit" name="wallettransaction_submit" id="wallettransaction_submit" class="btn btn-primary">@lang('app.Save')  </button>
															<button type="reset" class="btn btn-secondary cancel" onclick="taxgroup()">@lang('app.Cancel')    </button>
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
	$(document).ready(function() {
	$('.kt-select2').select2();
});
	$('.ktdatepicker').datepicker({
   todayHighlight: true,
   format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
    $(this).datepicker('hide');
});
</script>


</script>

<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/custom/select2.js" type="text/javascript"></script>

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
<script src="{{url('/')}}/resources/js/settings/wallet.js" type="text/javascript"></script>
 
 @endsection
