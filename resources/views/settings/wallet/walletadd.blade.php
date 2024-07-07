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


									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Date<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<input type="text" class="form-control ktdatepicker" name="date" id="date">
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
										<option value="{{$wallets->id}}" >{{$wallets->name}}</option>
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
										<option value="1">Debit</option>
										<option value="2">Credit</option>

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
									<input type="text" class="form-control" name="amounts" id="amounts">
									</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Notes<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
									<textarea class="form-control" name="notes" id="notes"></textarea>
									</div>
									</div>
									</div>




<input type="hidden" class="form-control" name="id" id="id" value="">
									<input type="hidden" class="form-control" name="branch" id="branch" value="{{$branch}}">

								 </div>
								 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">

															<button type="reset" class="btn btn-secondary cancel" onclick="taxgroup()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                @lang('app.Cancel')
                                                            </button>
                                                            <button type="submit" name="wallettransaction_submit" id="wallettransaction_submit" class="btn btn-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                                                @lang('app.Save')
                                                            </button>

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
