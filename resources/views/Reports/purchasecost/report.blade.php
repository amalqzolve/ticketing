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
												Purchase Cost Report
										</h3>
									</div>

								</div>
<?php
$date = date('d-m-Y');
$totalcost =0;
$grandtotalamount = 0;
?>
								<div class="kt-portlet__body">

<!--begin: Datatable -->
<form method="POST" action="{{ route('purchasesoasubmit') }}">
	@csrf
<div class="row">
<div class="col-md-6">
	<table class="table table-striped table-hover table-checkable dataTable no-footer">
 @foreach($data as $datas)
 <?php
 $grandtotalamount = $datas->grandtotalamount;
?> 
     <tr><th>Purchase ID</th><td><?php echo $datas->id; ?></td></tr> 
     <tr><th>Total Items</th><td>{{$productscount}}</td></tr>    
  <tr><th>Purchase Amount</th><td><?php echo $datas->grandtotalamount; ?></td></tr>
   <a href="{{url('/')}}/purchasecostpdf?pid={{$datas->id}}"  target="_blank" class="btn btn-brand btn-elevate btn-icon-sm">PDF</a>&nbsp;
   @endforeach
   
   
	
</table>
</div>
<div class="col-md-6">
	<table class="table table-striped table-hover table-checkable dataTable no-footer">
		<thead>
			<tr><th>Cost Name</th>
			<th>Amount</th></tr>
		</thead>
		<tbody>
			@foreach($purchase_costlist as $key => $purchase_costlist) 
			<tr><td>               
          @foreach($costheadlist as $data)
               <?php
               $totalcost += $purchase_costlist->amount;
              if($data->id == $purchase_costlist->costheadname)
                {
                       echo $data->voucher_name;
                }
              ?>
            @endforeach</td> <td>{{$purchase_costlist->amount}}
            	</td></tr>
     @endforeach
		</tbody>
		
		
    <tr><th>Total Cost</th><td><?php echo round($totalcost,2) ?></td></tr>
    <?php
    $costamount = 0;
 $grandtotal = $totalcost + $grandtotalamount;
 $costamount = $totalcost / $productscount;

 ?><tr><th>Single Item Cost Amount</th><td>{{round($costamount,2)}}</td></tr>
		<tr><th>Grand Total</th><td>{{round($grandtotal,2)}}</td></tr>
</table>
</div>
	

<table class="table table-striped table-hover table-checkable dataTable no-footer" id="soadetails_list">
	<thead>
		<tr>
			<th>@lang('app.Sl.No')</th>
			<th>Product Name</th>
			<th>Part No</th>
			<th>Unit</th>
			<th>Quantity</th>
			<th>Rate</th>
			<th>Amount</th>
			<th>Vat Amount</th>
			<th>Total Amount</th>
			<th>Total Cost</th>
			<th>Price for Single Quantity</th>

		</tr>
	</thead>

	<tbody>
@foreach($pi_product as $key=>$pi_products)
<tr>
	<td>{{$key+1}}</td>
	<td>{{$pi_products->product_name}}</td>
	<td>{{$pi_products->part_no}}</td>
	<td>{{$pi_products->unit_name}}</td>
	<td>{{$pi_products->quantity}}</td>
	<td>{{$pi_products->rate}}</td>
	<td>{{$pi_products->amount}}</td>
	<td>{{$pi_products->vatamount}}</td>
	<td>{{$pi_products->totalamount}}</td>
	<td>{{round($costamount * $pi_products->quantity),2}}</td>
	<td>{{round($costamount + $pi_products->rate),2}}</td>

</tr>
@endforeach
	</tbody>


</table>



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
