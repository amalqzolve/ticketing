@extends('warehouse.common.layout')

@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
{{-- <div class="kt-subheader   kt-grid__item" id="kt_subheader">
							                        <div class="kt-container  kt-container--fluid ">
								                    <div class="kt-subheader__main">
                                                    <div class="kt-subheader__breadcrumbs">
								                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
								                    <span class="kt-subheader__breadcrumbs-separator"></span>
									                {{ Breadcrumbs::render('ProductListing') }} 
							                        </div> 
						                            </div>
						                            
							                        </div>
						                            </div> --}}

	                                                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                                                    <br/>
							                        <div class="kt-portlet kt-portlet--mobile">
								                    <div class="kt-portlet__head kt-portlet__head--lg">
									                <div class="kt-portlet__head-label">
										            <span class="kt-portlet__head-icon">
											        <i class="kt-font-brand flaticon-home-2"></i>
										            </span>
										            <h3 class="kt-portlet__head-title">
											      Transfer Requests
										            </h3>
									               </div>
									               <div class="kt-portlet__head-toolbar">
										           <div class="kt-portlet__head-wrapper">
											       <div class="kt-portlet__head-actions">
												         <a href="{{url('/')}}/transferrequest_add" class="btn btn-brand btn-elevate btn-icon-sm"> <i
							class="la la-plus"></i>
						{{ __('app.New Record') }}</a>
						
												 <div class="dropdown dropdown-inline">
												 <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											     <i class="la la-download"></i> {{ __('mainproducts.Export') }}
											     </button>
											     <div class="dropdown-menu dropdown-menu-right">
												 <ul class="kt-nav">
												 <li class="kt-nav__section kt-nav__section--first">
												 <span class="kt-nav__section-text">{{ __('mainproducts.Choose an option') }}</span>
												 </li>
												 <li class="kt-nav__item" id="productdetails_list_print">
												<span href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-print"></i>
												<span class="kt-nav__link-text">{{ __('mainproducts.Print') }}</span>
												</span>
												</li>
												<li class="kt-nav__item" id="productdetails_list_copy">
												<span class="kt-nav__link">
												<i class="kt-nav__link-icon la la-copy"></i>
												<span class="kt-nav__link-text">{{ __('mainproducts.Copy') }}</span>
												</span>
												</li>
												<li class="kt-nav__item" id="productdetails_list_csv">
												<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-file-text-o"></i>
												<span class="kt-nav__link-text">{{ __('mainproducts.CSV') }}</span>
												</a>
												</li>
												<li class="kt-nav__item" id="productdetails_list_pdf">
												<span class="kt-nav__link">
												<i class="kt-nav__link-icon la la-file-pdf-o"></i>
												<span class="kt-nav__link-text">{{ __('mainproducts.PDF') }}</span>
												</span>
												</li>
												</ul>
						                         </div>
												</div>
												 
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
<!--begin: Datatable -->
<table class="table table-striped table-hover table-checkable dataTable no-footer " id="productdetails_list" style="display: table;">
    <thead>
        <tr>
            <th>{{ __('mainproducts.S.No') }}</th>
            <th>Date</th>
            <th>Requested By</th>
            <th>Prepared By</th>
            <th>Approved By</th>
            <th>Stock Transfer qty</th>
            <th>Warehouse</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>


@foreach($products as $key=>$product)
<tr>
 

 
   <td >{{$key+1}}</td>

     <td>{{ $product->transfer_date }}</td>
      <td>{{ $product->requested_by }}</td>
     <td>{{ $product->preparedby }}</td>
     <td>{{ $product->approvedby }}</td>
     <td>{{ $product->total }}</td>
     <td>{{ $product->transfer_warehouse2 }}</td>
     <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        
                         <a href="{{url('/')}}/transfer_request_edit?id={{$product->tid}}" data-type="edit"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>
                        <span class="kt-nav__link-text" data-id="" >Edit</span>
                        </span></li></a>
                        <a  data-type="delete" data-target="#kt_form"><li class="kt-nav__item transferrequest_delete" id='{{$product->tid}}'>
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text" data-id="{{$product->tid}}" id="">Delete</span>
                        </span></li></a>
                       </ul></div></div></span></td>
    


</tr>
           @endforeach
          

    </tbody>  
</table>
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
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script> 

<!--  <script src="{{url('/')}}/resources/js/inventory/prodelete.js" type="text/javascript"></script> -->

<script type="text/javascript">
	


/*vcheck*/

$("#checkall").click(function(){
    $('input:checkbox.vcheck').not(this).prop('checked', this.checked);
});

/////////////////////////////

$(document).on('click', '.checkall,.vcheck', function () {

var voucher_id={};
voucher_id.checkselected=[];
voucher_id.checkselectedvalues=[];


$("input:checkbox").each(function(){
    var $this = $(this);

    if($this.is(":checked")){
      var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
if(numberRegex.test($this.attr("id"))) {
   voucher_id.checkselected.push($this.attr("id"));
}  


        
        //voucher_id.checkselectedvalues.push($this.val());
    }else{
        //
    }
})
var iddds='';
if(voucher_id.checkselected.length>0){
  
  $(".bulk").show();
var iddds=voucher_id.checkselected;
$('#iddds').val(iddds);
//  alert(voucher_id.checkselected);
}else{
  $(".bulk").hide();
}
//
/*var totaldue = 0;
for (var i = 0; i < voucher_id.checkselectedvalues.length; i++) {
    totaldue += voucher_id.checkselectedvalues[i] << 0;
}*/
//

////////$('#dueamount').val(totaldue);

});

////

   $(document.body).on("click", ".bulk", function() 
   {
    
      var ids = $('#iddds').val();
      window.location = "{{url('/')}}/warehouse_stockin?ids="+ids;
     
   });

 var productdetails_list_table2 = $('#productdetails_list').DataTable({
        processing: true,
         serverSide: false,
         pagingType: "full_numbers",
        //   scrollX: true,

         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
         buttons: [{
              extend: 'copy',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50];
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
              }
          }
      ],
       
      });


    $("#productdetails_list_print").on("click", function() {
   
    productdetails_list_table2.button('.buttons-print').trigger();
});


$("#productdetails_list_copy").on("click", function() {
    productdetails_list_table2.button('.buttons-copy').trigger();
});

$("#productdetails_list_csv").on("click", function() {
    productdetails_list_table2.button('.buttons-csv').trigger();
});

$("#productdetails_list_pdf").on("click", function() {
    productdetails_list_table2.button('.buttons-pdf').trigger();
});

$(document).on('click', '.transferrequest_delete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Delete this request",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {

               window.location = "transferrequest-Delete?id="+id;
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });



</script>

@endsection
