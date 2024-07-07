@extends('Reports.common.layout')

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
											Statement of Account
										</h3>
									</div>
									
								</div>
<?php
$date = date('d-m-Y');
?>
								<div class="kt-portlet__body">

<!--begin: Datatable -->
<form method="POST" action="{{ route('salessoasubmit') }}">
	@csrf
<div class="row">

	<div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Customer') </label>
										</div> 
										<div class="col-md-8  input-group-sm">
											<select class="form-control single-select kt-selectpicker" id="customer" name="customer">
												<option value="">select</option>
			@foreach($customers as $data)
            <option value="{{$data->id}}">{{$data->cust_name}}</option>
            @endforeach
											</select>                
										</div>
										</div>
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
<div class="col-lg-6">
	  <button type="submit" id="soasubmit" class="btn btn-primary" style="float:right;">Submit</button>
</div>
	<?php $BAL = 0; 
	$BAL1 = 0;
		 $openBAL = 0; 
		$opbal = 0; 
		$trdp = 0; 
		$clbal = 0; 
		$openBALh = 0;
?>
<?php 
if($details!="")
{
	foreach($details as $detailss)
	{
		$cid =  $detailss->customer_id;
	}
	
	foreach($customers as $customerss)
	{
		$cust_name =  $customerss->cust_name;
	}

	?>
	
	@foreach($opening_balance as $key=>$balanceh)
<?php if($balanceh->transaction_type=='cash'){
$rcramt1=$balanceh->totalamount;
$rdramt1=$balanceh->totalamount;
} elseif($balanceh->transaction_type=='credit'){
$rcramt1=$balanceh->totalamount;
$rdramt1=$balanceh->paid_amount;
} else{

} 

$openBALh +=$rcramt1-$rdramt1;
?>

@endforeach
<br><br>
<?php if(!empty($cid)){ ?>

	<table class="table table-striped table-hover table-checkable dataTable no-footer" id="dt">
		<tr>Statement of Account</tr>




<tr>
<td>Customer Name</td>
<td>{{$cust_name}}</td>
<td>From Date</td>
<td>{{$fromdate}}</td>
<td>Till Date</td>
<td>{{$todate}}</td>
<td>Opening Balance</td>
<td>{{$openBALh}}</td>
<td>
	<div class="kt-portlet__head-toolbar">
	<div class="kt-portlet__head-wrapper">
	<div class="kt-portlet__head-actions">
	<a href="{{url('/')}}/soasalespdf?cid={{$cid}}&&fromdate={{$fromdate}}&&todate={{$todate}}"  target="_blank" class="btn btn-brand btn-elevate btn-icon-sm">PDF</a>&nbsp;
	</div>
	</div>
	</div></td>
</tr>
</table>

<?php
}
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

<script type="text/javascript">

	$('.single-select').select2();


	
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

/*   $(document).ready(function() {

      var soadetails_list_table = $('#soadetails_list').DataTable({
        processing: true,
         serverSide: false,
          bAutoWidth: true,
         pagingType: "full_numbers",
          scrollX: true,
         dom: 'Blfrtip',
         
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
       
      })


$("#soadetails_list_print").on("click", function() {
   
    soadetails_list_table.button('.buttons-print').trigger();
});


$("#soadetails_list_copy").on("click", function() {
    soadetails_list_table.button('.buttons-copy').trigger();
});

$("#soadetails_list_csv").on("click", function() {
    soadetails_list_table.button('.buttons-csv').trigger();
});

$("#soadetails_list_pdf").on("click", function() {
    soadetails_list_table.button('.buttons-pdf').trigger();
});


      
      });*/
      
</script>
@endsection
