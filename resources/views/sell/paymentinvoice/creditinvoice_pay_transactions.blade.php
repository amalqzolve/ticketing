@extends('sales.common.layout')



@section('content')
<!-- <link href="{{url('/')}}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
								   <div class="kt-subheader__breadcrumbs">

										<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

										<span class="kt-subheader__breadcrumbs-separator"></span>

										

									</div>
								</div>
								<div class="kt-subheader__toolbar">
							<div class="kt-subheader__wrapper">
								<a href="#" class="btn kt-subheader__btn-primary">
									@lang('app.Back') 
								</a>
							
							   
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
										Payments List

									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
											
					
						
													
												<div class="dropdown dropdown-inline">
													<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="la la-download"></i> @lang('app.Export')
													</button>
													<div class="dropdown-menu dropdown-menu-right">
														<ul class="kt-nav">
															<li class="kt-nav__section kt-nav__section--first">
																<span class="kt-nav__section-text">@lang('app.Choose an option')</span>
															</li>
															<li class="kt-nav__item" id="export-button-print">
																<span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">@lang('app.Print')</span>
																</span>
															</li>
															<li class="kt-nav__item" id="export-button-copy">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">@lang('app.Copy')</span>
																</span>
															</li>
															<li class="kt-nav__item" id="export-button-csv">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-text-o"></i>
																	<span class="kt-nav__link-text">@lang('app.CSV')</span>
																</a>
															</li>
															<li class="kt-nav__item" id="export-button-pdf">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																	<span class="kt-nav__link-text">@lang('app.PDF')</span>
																</span>
															</li>
														</ul>
													</div>
												</div>
												


											</div>
										</div>
									</div>
								</div>
								<?php
foreach($details as $detailss)
	{
	 $invoiceid = $detailss->invoiceid;
		$totalamount = $detailss->totalamount;
		$customer = $detailss->customer;
		$quotedate = $detailss->date;
		$depositaccount = $detailss->depositaccount;
		$notes = $detailss->notes;
		$reference = $detailss->reference;
		$cid = $detailss->cid;
	}
	?>
								<div class="kt-portlet__body">
<div class="row">
	<div class="col-lg-12">
										<div class="form-group row pr-md-3">
										<div class="col-md-2">
										<label>@lang('app.Customer') </label>
										</div> 
										<div class="col-md-10  input-group-sm">
									<input type="text" class="form-control" name="customer" id="customer" value="{{$customer}}" readonly>                 
										</div>
										</div>
									  </div>

									  <div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Invoice Number') </label>
										</div> 
										<div class="col-md-8  input-group-sm">
									<input type="text" class="form-control" name="invoiceno" id="invoiceno" value="{{$invoiceid}}" readonly>                 
										</div>
										</div>
									  </div>

									  <div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Invoice Date</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control" name="date" id="date" value="{{$quotedate}}" readonly>               
										</div>
										</div>
										</div>

										<div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>Invoice Amount</label>
										</div> 
										<div class="col-md-8  input-group-sm">
									<input type="text" class="form-control" name="totalamount" id="totalamount" value="{{$totalamount}}" readonly>                 
										</div>
										</div>
									  </div>

				
									  <div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Transaction Date')</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control kt_datetimepickerr" name="transactiondate" id="transactiondate" value="{{date('d-m-Y')}}">               
										</div>
										</div>
										</div>

										<div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>Deposit Account </label>
										</div> 
										<div class="col-md-8  input-group-sm">
									<input type="text" class="form-control" name="depositaccount" id="depositaccount" value="{{$depositaccount}}" >                 
										</div>
										</div>
									  </div>

										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Notes</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control" name="notes" id="notes" value="{{$notes}}" >               
										</div>
										</div>
										</div>

										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Reference</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control" name="reference" id="reference" value="{{$reference}}" >               
										</div>
										</div>
										</div>
										
									</div>
<!--begin: Datatable -->
<table class="table table-striped table-hover" id="modeofpaymenttable">
											<thead  style=" background-color: #306584; color: white;">
											<tr>
										
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Mode of Payment')</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Reference')</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Amount')</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;
												 width: 30px;">
													<!-- <div class="kt-demo-icon__preview addmorepayments pluseb">
															<i class="fa fa-plus" style="color: white;"></i>
														</div> --></th>
												
												 
											</tr>
											</thead>
											<tbody>
										@foreach($paymentsdetails as $key=>$paymentsdetailss)
									
										<tr>
										
											<td><select class="form-control single-select modeofpayment kt-selectpicker" name="modeofpayment[]" id="modeofpayment{{$key+1}}" data-id="{{$key+1}}">
												@if($paymentsdetailss->modeofpayment == 1)
					  <option value="1" selected="">Cash</option>
					   <option value="2">Card</option>
					    <option value="3">Bank</option>
					     <option value="4">Cheque</option>@endif
					     @if($paymentsdetailss->modeofpayment == 2)
					  <option value="1">Cash</option>
					   <option value="2" selected="">Card</option>
					    <option value="3">Bank</option>
					     <option value="4">Cheque</option>@endif
					      @if($paymentsdetailss->modeofpayment == 3)
					  <option value="1">Cash</option>
					   <option value="2">Card</option>
					    <option value="3" selected="">Bank</option>
					     <option value="4">Cheque</option>@endif
					      @if($paymentsdetailss->modeofpayment == 4)
					  <option value="1">Cash</option>
					   <option value="2">Card</option>
					    <option value="3">Bank</option>
					     <option value="4" selected="">Cheque</option>@endif
					  </select></td>
											<td><input type="text" class="form-control preference" name="preference[]" id="preference{{$key+1}}"  data-id="{{$key+1}}" value="{{$paymentsdetailss->preference}}"></td>
											<td><input type="text" class="form-control amount" name="amount[]" id="amount{{$key+1}}"  data-id="{{$key+1}}" value="{{$paymentsdetailss->amounts}}"></td>
											<td>
					  <div class="kt-demo-icon__preview costremove">
					  <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>
					  </div>
					  </td>
										</tr>
										@endforeach
											</tbody>
												
										</table>
<div class="row">
										@foreach($details as $detailss)


<div class="col-lg-6">
										<div class="form-group  row pl-md-3">
										<div class="col-md-4">
										<label>Invoice Amount</label>
										</div>  
										<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="invoiceamount" id="invoiceamount" value="{{$totalamount}}" readonly>               
										</div>
										</div>
										</div>
@endforeach
<div class="col-lg-6">
										<div class="form-group  row pl-md-3">
										<div class="col-md-4">
										<label>Total Amount</label>
										</div>  
										<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="totalamount1" id="totalamount1" readonly>     </div>
										</div>
										</div>
										@foreach($amounts as $amounts1)

<div class="col-lg-6">
										<div class="form-group  row pl-md-3">
										<div class="col-md-4">
										<label>Total Paid Amount</label>
										</div>  
										<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="totalpaidamount" id="totalpaidamount" value="{{$amounts1->amountss}}" readonly>               
										</div>
										</div>
										</div>
@endforeach
<div class="col-lg-6"></div>
@foreach($dueamount as $dueamount1)
<div class="col-lg-6">
										<div class="form-group  row pl-md-3">
										<div class="col-md-4">
										<label>Due Amount</label>
										</div>  
										<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="totaldueamount" id="totaldueamount" value="{{$dueamount1->due_amount}}" readonly>               
										</div>
										</div>
										</div>@endforeach
</div>
<?php
	$date = date('d-m-Y h:i');
	?>
	<input type="hidden" name="transactiondate" id="transactiondate" value="{{$date}}">
	<input type="hidden" name="payid" id="payid" value="{{$id}}">
	<input type="hidden" name="cid" id="cid" value="{{$cid}}">
	
										<div class="kt-portlet__foot pr-0">
								<div class="row">
								<div class="col-lg-12 p-0 kt-align-right">
	  <!-- <button type="button" id="creditinvoice_pay" class="btn btn-primary" style="float:right;" disabled="">Submit</button> -->

	  <button type="reset" class="btn btn-secondary backHome"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>  &nbsp;Cancel</button>


	  <button type="button" class="btn btn-primary" id="creditinvoice_pay_edit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>   &nbsp;Save</button>



</div>
							</div></div>
<!--end: Datatable -->

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
<script type="text/javascript">
		    
	$('body').on('change', '.amount', function() {
	 var id = $(this).attr('data-id');
	 amount_calculate(id);
	});
	$("body").on("click",".costremove",function(event){
   event.preventDefault();
   var row = $(this).closest('tr');
   
  
	   var siblings = row.siblings();
	   row.remove();
	   siblings.each(function(index) {
		 $(this).children().first().text(index);
	   });
  
   amount_calculate();
});
	function amount_calculate(){
 var totalamount = 0;
 var balance = 0;
 var total = 0;
 var totaldueamount = 0;
	$('.amount').each(function(){
		var id = $(this).attr('data-id');
		var amount = $('#amount'+id+'').val();
	totalamount += parseFloat(amount);
   });
	$('#totalamount1').val(totalamount);


	var total = $('#totaldueamount').val();
	
	if(total < totalamount)
	{
		$('#totalamount1').val("");
		toastr.warning('Receive Payment is less than or Equal to Total Amount');
		$('#creditinvoice_pay_edit').attr('disabled',true);

	}
	else
	{
		$('#creditinvoice_pay_edit').attr('disabled',false);
	}

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
<!-- <script src="{{url('/')}}/resources/js/sales/quotation.js" type="text/javascript"></script> -->
<script src="{{url('/')}}/resources/js/sales/paymentinvoice.js" type="text/javascript"></script>
@endsection
