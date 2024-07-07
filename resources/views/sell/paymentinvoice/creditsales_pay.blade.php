@extends('sales.common.layout')

@section('content')
<!-- <link href="{{url('/')}}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.form-control {
    height: calc(1.4em + 1rem + 2px);
}
</style>
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
                                <a href="trash_purchase" class="btn btn-secondary btn-hover-warning">
                                    @lang('app.Trash ')

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
										<h3 class="kt-portlet__head-title">

											Payment 

										</h3>
									</div>
									
								</div>

								<div class="kt-portlet__body">

<!--begin: Datatable -->

	@csrf
	<?php
	$date = date('d-m-Y h:i');
	foreach($details as $detailss)
	{
		$id = $detailss->id;
		$totalamount = $detailss->grandtotalamount;
		$customer = $detailss->cust_name;
		$quotedate = $detailss->quotedate1;
		$cid = $detailss->cid;
	}
	foreach($paymentsdetails as $detailss)
	{
		$dueamount = $detailss->amountss;
	}
	$balance = $totalamount - $dueamount;
	?>
	
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
									<input type="text" class="form-control" name="invoiceno" id="invoiceno" value="{{$id}}" readonly>                 
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
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>Due Amount </label>
										</div> 
										<div class="col-md-8  input-group-sm">
									<input type="text" class="form-control" name="dueamount" id="dueamount" value="{{$balance}}" readonly>                 
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
									<input type="text" class="form-control" name="depositaccount" id="depositaccount" value="" >                 
										</div>
										</div>
									  </div>

										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Notes</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control" name="notes" id="notes" value="" >               
										</div>
										</div>
										</div>

										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Reference</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control" name="reference" id="reference" value="" >               
										</div>
										</div>
										</div>


										<!-- <div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Transaction Type')</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   <select class="form-control single-select kt-selectpicker" id="transactiontype" name="transactiontype">
										<option value="">select</option>
										<option value="1" selected="">Debit</option>
										<option value="2">Credit</option>


											</select>  
								               
										</div>
										</div>
										</div> -->
										
									</div>
										<div class="row" style="padding-bottom: 6px; margin-top: 44px;">
									<div class="col-lg-12">
									<div class="form-group row pl-md-3">
										<table class="table table-striped table-hover" id="modeofpaymenttable">
											<thead  style=" background-color: #306584; color: white;">
											<tr>
											<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 30px;">#</th>
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
											<tr>
												
											</tr>
										</table>
					<table style="width:100%;">
						<tr>
							<td>
								<button type="button" class="addmorepayments pluseb btn btn-brand btn-elevate btn-icon-sm  float-right" ><i class="la la-plus"></i>Add More</button>
							</td>
						</tr>
					</table>
					<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Total Due Amount</label>
										</div>  
										<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="totaldueamount" id="totaldueamount" value="{{$balance}}" readonly>               
										</div>
										</div>
										</div>
										<div class="col-lg-6"></div>
										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Paying Amount</label>
										</div>  
										<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="payingamount" id="payingamount" readonly>               
										</div>
										</div>
										</div>
										<div class="col-lg-6"></div>
										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Net Balance</label>
										</div>  
										<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="balanceamount" id="balanceamount" readonly>               
										</div>
										</div>
										</div>
									</div>
								</div>
							</div>
							<div class="kt-portlet__foot pr-0">
								<div class="row">
								<div class="col-lg-12 p-0 kt-align-right">
	  <!-- <button type="button" id="creditinvoice_pay" class="btn btn-primary" style="float:right;" disabled="">Submit</button> -->

	  <button type="reset" class="btn btn-secondary backHome"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>  &nbsp;Cancel</button>


	  <button type="button" class="btn btn-primary" id="creditinvoice_pay"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>   &nbsp;Save</button>



</div>
							</div></div></div>

										
										
										
<input type="hidden" name="cid" id="cid" value="{{$cid}}">									   
<input type="hidden" name="totalamount1" id="totalamount1" >
<input type="hidden" name="invoiceid" id="invoiceid" value="{{$id}}">
										


</div>

<!--end: Datatable -->

								</div>
							</div>
						</div></div>





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
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

// 	     $(".kt_datetimepickerr").datetimepicker({
//     format: 'dd-mm-yyyy'

// }).on('changeDate', function(e){
//     $(this).datetimepicker('hide');
// });

$(document).ready(function(){
	  var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
	$(".addmorepayments").click(function() 
		{
		
	  var sl = ($("#modeofpaymenttable > tbody > tr").length);

		   
			var payment = '';
			payment += '<tr>\
					  <td class="row_count" id="rowcount" style="padding: 0;">'+ sl +'</td>\
					  <td style="padding: 0;">\
					  <select class="form-control single-select modeofpayment kt-selectpicker" name="modeofpayment[]" id="modeofpayment'+rowcount+'" data-id='+rowcount+'>\
					 <option value="">Select</option>\
					  <option value="1" selected>Cash</option>\
					   <option value="2">Card</option>\
					    <option value="3">Bank</option>\
					     <option value="4">Cheque</option>\
					  </select>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control preference" name="preference[]" id="preference'+rowcount+'"  data-id='+rowcount+'>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control amount" name="amount[]" id="amount'+rowcount+'"  data-id='+rowcount+'>\
					  </div>\
					  </td>\
						<td style="padding: 0;">\
					  <div class="kt-demo-icon__preview costremove">\
					  <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>\
					  </div>\
					  </td>\
					  </tr>';
		
					   $('#modeofpaymenttable').append(payment);

					  



					   rowcount++;
});

   
 });

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
		$('#payingamount').val("");
		$('#balanceamount').val("");
		toastr.warning('Receive Payment is less than or Equal to Total Amount');
		$('#creditinvoice_pay').attr('disabled',true);

	}
	else
	{
		totaldueamount = $('#totaldueamount').val();
		balance = parseFloat(totaldueamount) - parseFloat(totalamount);
		$('#payingamount').val(totalamount.toFixed(2));
		$('#creditinvoice_pay').attr('disabled',false);
		$('#balanceamount').val(balance.toFixed(2));
	}
}




</script>
	
</script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/paymentinvoice.js" type="text/javascript"></script>

@endsection
