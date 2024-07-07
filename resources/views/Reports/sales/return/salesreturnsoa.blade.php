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
									<div class="kt-portlet__head-toolbar">
	<div class="kt-portlet__head-wrapper">
	<div class="kt-portlet__head-actions">
	<a href="{{url('/')}}/soasalesreturnpdf?customer={{$customer}}&&fromdate={{$fromdate}}&&todate={{$todate}}"  target="_blank" class="btn btn-brand btn-elevate btn-icon-sm">PDF</a>&nbsp;
	</div>
	</div>
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


	<?php $BAL = 0; 
	$BAL1 = 0;
		 $openBAL = 0; 
		$opbal = 0; 
		$trdp = 0; 
		$clbal = 0; 
		$openBALh = 0;
?>

	
	
<br><br>


	<table class="table table-striped table-hover table-checkable dataTable no-footer" id="dt">
		
<tr>
<td>Customer Name</td>
<td>From Date</td>
<td>Till Date</td>



</tr>
@foreach($details as $detailss)
<tr>
	
	
		<td>{{$detailss->cust_name}}</td>
		<td>{{$fromdate}}</td>
		<td>{{$todate}}</td>
		
			
	
</tr>
@endforeach
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
