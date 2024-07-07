@extends('reports.common.layout')

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
											@lang('app.Statment of Account')
										</h3>
									</div>

								</div>
<?php
$date = date('d-m-Y');
?>
								<div class="kt-portlet__body">

<!--begin: Datatable -->
<form method="POST" action="{{ route('purchasestatementofaccountlist') }}">
	@csrf
<div class="row">

	<div class="col-lg-6">
									<div class="form-group row pr-md-3">

								    		<div class="col-md-4">
									<label>Provider<span style="color: red">*</span></label>
									</div>
									<div class="col-md-4">
									 <label class="kt-radio kt-radio--solid kt-radio--brand">
									<input type="radio" name="vendor_supplier" class="ven_sup" value="1">Vendor
									 <span></span>
									</label>&nbsp;
								</div>
								<div class="col-md-4">
									<label class="kt-radio kt-radio--solid kt-radio--brand">
									<input type="radio" name="vendor_supplier" class="ven_sup"  value="2"> Supplier
									<span></span>
									</label>
								   </div>

								</div>
							</div>
							<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-12 input-group input-group-sm">

									<select class="form-control single-select input-group-sm kt-selectpicker supplier_vendor_names" name="supplier_vendor_names" id="supplier_vendor_names">
									 <option value="">Select</option>

									</select>
								</div></div>
							</div>
									  <div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.From Date')</label>
										</div>
										<div class="col-md-8 input-group-sm">

								<input type="text" class="form-control ktdatepicker" name="fromdate" id="fromdate" value="{{date('d-m-Y')}}" >
										</div>
										</div>
										</div>
										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.To Date')</label>
										</div>
										<div class="col-md-8 input-group-sm">

								<input type="text" class="form-control ktdatepicker" name="todate" id="todate" value="{{date('d-m-Y')}}">
										</div>
										</div>
										</div>
<div class="col-lg-12">
	  <button type="submit" id="purchasesoasubmit" class="btn btn-primary" style="float:right;"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Submit</button>
</div>
	<?php $BAL = 0;
		 $openBAL = 0;
		$opbal = 0;
		$trdp = 0;
		$clbal = 0;
		$openBALh = 0;
		$cid = 0;
		$provider =  0;
?>
<?php
if($details!="")
{
	foreach($details as $detailss)
	{
		$provider =  $detailss->provider;
		$cid      = $detailss->customer_id;
	}
	foreach($name as $names)
	{
		$cust_name =  $names->name;
	}
	?>
	@foreach($opening_balance as $key=>$balance1)
<?php if($balance1->transaction_type=='cash'){
$rcramt1=$balance1->totalamount;
$rdramt1=$balance1->totalamount;
} elseif($balance1->transaction_type=='credit'){
$rcramt1=$balance1->totalamount;
$rdramt1=$balance1->paid_amount;
} else{

}

$openBALh +=$rcramt1-$rdramt1;
?>

@endforeach
	<table class="table table-striped table-hover table-checkable dataTable no-footer">
		<tr>Statement of Account</tr>
<tr>
<td>{{$providername}} Name</td>
<td>{{$cust_name}}</td>
<td>From Date</td>
<td>{{$fromdate}}</td>
<td>Till Date</td>
<td>{{$todate}}</td>
<td>Opening Balance</td>
<td>{{$openBALh}}</td>
<td><div class="kt-portlet__head-toolbar">
	<div class="kt-portlet__head-wrapper">
	<div class="kt-portlet__head-actions">

	<a href="{{url('/')}}/purchasesoapdf?cid={{$cid}}&&fromdate={{$fromdate}}&&provider={{$provider}}"  target="_blank" class="btn btn-brand btn-elevate btn-icon-sm">PDF</a>&nbsp;


	</div>
	</div>
	</div></td>
</tr>
</table>
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="soadetails_list">
	<thead>
		<tr>
			<th>@lang('app.Sl.No')</th>
			<th>@lang('app.Document ID')</th>
			<th>@lang('app.Document Type')</th>
			<th>Transaction</th>
			<th>Notes</th>
			<th>@lang('app.Document Date')</th>


			<th>@lang('app.Dr Amount')</th>
			<th>@lang('app.Cr Amount')</th>
			<th>@lang('app.Balance')</th>

		</tr>
	</thead>

	<tbody>



<!-- opbal -->
@foreach($opening_balance as $key=>$balance1)
<?php if($balance1->transaction_type=='cash'){
$rcramt1=$balance1->totalamount;
$rdramt1=$balance1->totalamount;
} elseif($balance1->transaction_type=='credit'){
$rcramt1=$balance1->totalamount;
$rdramt1=$balance1->paid_amount;
} else{

}

$openBAL +=$rcramt1-$rdramt1;
?>

@endforeach

<!-- opbal -->



@foreach($details as $key=>$details)
<?php if($details->transaction_type=='cash'){
$rcramt=$details->totalamount;
$rdramt=$details->totalamount;
} elseif($details->transaction_type=='credit'){
$rcramt=$details->totalamount;
$rdramt=$details->paid_amount;
} else{

}

$BAL +=$rcramt-$rdramt;
?>
<tr>
<td>{{$key+1}}</td>
<td>{{$details->doc_id}}</td>
<td>{{$details->doc_type}}</td>

<td>{{$details->transaction_type}}</td>
<td></td>
<td>{{$details->doc_transaction}}</td>


<td style="text-align: right;">{{$rcramt}}</td>
<td style="text-align: right;">{{$rdramt}}</td>
<td style="text-align: right;">{{$BAL}}</td>
</tr>
@endforeach
	</tbody>


</table>

<table class="table table-striped table-hover table-checkable dataTable no-footer">
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>Transaction during the period</td>
<td>{{$BAL}}</td>
<td>&nbsp;</td>
</tr>
</table>
<table class="table table-striped table-hover table-checkable dataTable no-footer">
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>Closing Balance</td>
<td>{{$openBAL+$BAL}}</td>

<td>&nbsp;</td>

</tr>
</table>
<?php
}
?>


</div>
</form>
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
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});


$('.ktdatepicker').datepicker({
   todayHighlight: true,
   format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

$(document.body).on("change", "input[type=radio][name=vendor_supplier]", function()
	{
		var checkedValue = $('input[name="vendor_supplier"]:checked').val();

		$.ajax({
		url: "getsupplier_vendor_purchase_soa",
		method: "POST",
		data: {
			_token: $('#token').val(),
			id:checkedValue
		},
		dataType: "json",
		success: function(data) {
			console.log(data);
			$('select[name="supplier_vendor_names"]').empty();

$('select[name="supplier_vendor_names"]').append('<option value="">select</option>');
			$.each(data, function(key, value) {
						$('select[name="supplier_vendor_names"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
						});

		}



	})
	});

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


@endsection
