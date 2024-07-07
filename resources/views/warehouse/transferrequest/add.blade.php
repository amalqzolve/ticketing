@extends('warehouse.common.layout') @section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	li.nav-item {
		width: 140px;
}

#productdetails_list_wrapper
{
   height: 300px;
    overflow-y: scroll;
}
.dataTables_wrapper .dataTable .selected th, .dataTables_wrapper .dataTable .selected td {
    background-color: #f4e92b !important;
    /* color: #595d6e; */
}
</style>


<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
		</div>
	   
	</div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Transfer Request
				</h3>
			</div>

		</div> 

		<div class="kt-portlet__body">

	<?php
	$date = date('d-m-Y')
	?>		
							
								 <div class="row" style="padding-bottom: 6px;">
									
								   
								   <div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Date')</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control kt_datetimepickerr" name="out_date" id="out_date" value="{{date('d-m-Y')}}">               
										</div>
										</div>
										</div>


									<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Prepared By')</label>
										</div> 
										<div class="col-md-8 input-group-sm">
									   <select class="form-control kt-selectpicker" id="preparedby">
									   	<option value="">select</option>
			@foreach($salesmen as $data)
            <option value="{{$data->id}}">{{$data->name}}</option>
            @endforeach
									   </select>

										
															
										<!-- </div> -->
										</div>
										</div>
										</div>
										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Approved By')</label>
										</div> 
										<div class="col-md-8 input-group-sm">
									   
											<select class="form-control kt-selectpicker" id="approvedby">
									   	<option value="">select</option>
			@foreach($salesmen as $data)
            <option value="{{$data->id}}">{{$data->name}}</option>
            @endforeach
									   </select>
										
															
										<!-- </div> -->
										</div> 
										</div>
										</div>


										<div class="col-lg-6">
										<div class="form-group  row pl-md-3">
										<div class="col-md-4">
										<label>Request Warehouse</label>
										</div> 
										<div class="col-md-8 input-group-sm">
									   
											<select class="form-control kt-selectpicker" id="warehouse">
									   	<option value="">select</option>
			@foreach($warehouses as $data)
            <option value="{{$data->id}}">{{$data->warehouse_name}}</option>
            @endforeach
									   </select>
										
															
										<!-- </div> -->
										</div> 
										</div>
										</div>
									

				

									   <div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Requested By</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control" name="requested_by" id="requested_by" value="">               
										</div>
										</div>
										</div>

						


									
									<div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>Notes</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <textarea class="form-control" rows="1" name="notes" id="notes"></textarea>
                                    </div>
                                    </div>
                                    </div>

									

									


									

								 </div>


								       <div class=" pr-1 pl-1" style=" width: 100%;      background-color: #f2f3f8;   margin-top: -10px;">
                           
                          <table class="table table-striped table-bordered table-hover" id="product_table"  style="table-layout:fixed; width:100%">
												<thead  class="thead-light" >
												 <tr>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="30px">#</th>
                                   
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="250px">@lang('app.Item Name')</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">Existing Quantity</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">Stock Transfer Quantity</th>
                                      
                                  
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                                 </tr>
												</thead>
												<tbody>
												
													
												</tbody>
											</table>
											<table style="width:100%">
												<tr>
														<td>
															<!-- <button type="button" class="btn btn-primary btn-sm addproduct">Add New</button>&nbsp; &nbsp; &nbsp; &nbsp;</td> -->
															<button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" data-type="add" data-toggle="modal" data-target="#kt_modal_4_4"><i class="la la-plus"></i>Line Iteam</button>
											
												
											</td>
											
 													</tr>
											</table>
                              
                            
                        </div>


								 <div class="kt-portlet__foot pr-0">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="submit" name="transferrequestsubmit" id="transferrequestsubmit" class="btn btn-primary float-right ">
																<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Save
															</button>
															<button type="button" class="btn btn-secondary float-right mr-2"  onclick="goPrev()">
																<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel
															</button>
														</div>
													</div>
												</div>
									
						</div>

						</div>
					</div>
				</div>



<div class="modal fade" id="kt_modal_4_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="min-width: 1024px;">
   <input type="hidden" name="id" id="id" value="">
   <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('mainproducts.Product List') }}</h5>




            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>


         </div>
         <div class="modal-body">
            <form class="kt-form kt-form--label-right" id="category-form" name="category-form">
               <div class="kt-portlet__body">
                  
                  <table class="table table-striped table-hover table-checkable dataTable no-footer" id="productdetails_list">
    <thead>
        <tr>
            <th>{{ __('mainproducts.S.No') }}</th>
            <th>{{ __('mainproducts.Product Name') }}</th>
             <th>Description</th>
            <th>{{ __('mainproducts.Product Code') }}</th>
            <!-- <th>{{ __('mainproducts.Barcode') }}</th> -->
            <th>{{ __('mainproducts.Unit') }}</th>
            <!-- <th>Product price</th> -->
            <th>Selling price</th>
            <th>Stock</th>
            <th>WH</th>
            <th>Store</th>
           <!--  <th>Rack</th> -->
            <th>Category</th>
           <!--  <th>Type</th>
            <th>Status</th> -->
           <!--  <th>ID</th> -->
        </tr>
    </thead>
    <tbody>
    </tbody>  
</table>
               
                  <table class="table" style="width:50%; margin-left:50%;">
                              <thead class="thead-light" >
                              <tr>
                                 <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total items selected</td><td style="border-bottom: 1px dashed gray; text-align: right;">
                                    <input type="text" id="selected_items" readonly="" class="form-control input form-control-sm"  style="border:0; text-align: right; background-color: #fff; height: calc(0.5em + 1rem + 2px);font-size: 20px; font-weight:bold;"></td>
                              </tr>

                              <tr >
                                 <td class="pt-3" style="border-bottom: 1px dashed gray;font-size: 18px;">Total amount</td><td style="border-bottom: 1px dashed gray;text-align: right;">
                                    <input type="text" id="selected_amount" readonly="" class="form-control form-control-sm"  style="border:0; text-align: right; background-color: #fff; height: calc(0.5em + 1rem + 2px);font-size: 20px; font-weight:bold;">
                                    
                                 </td>
                              </tr>

                           </thead>
                           </table>    
 <button type="button" class="btn btn-brand btn-elevate btn-icon-sm float-right ml-2" id="datatableadd"><i class="la la-plus"></i>Add</button>
 <button type="button" class="btn btn-secondary btn-icon-sm float-right" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel</button>


               </div>
         </div>
      
      </div>
   </div>

</div>


		</div>
	</div>
</div>
<style type="text/css">
	.hideButton {
		display: none
	}
	
	.error {
		color: red
	}
</style>
<!--end::Modal-->
@endsection @section('script')
<script type="text/javascript">
   function goPrev()
	{
  window.history.back();
  }




</script>

</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/asset/asset.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script>

<script type="text/javascript">

	  $('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

    




var product_list_table = $('#productdetails_list').DataTable({
    processing: true,
    serverSide: false,
    bPaginate: false,
    dom: 'Blfrtip',
    columnDefs: [
  {
    "defaultContent": "-",
    "targets": "_all"
  }
 /* ,{
                "targets": [ 11 ],
                "visible": false
            }*/],
 //   aoColumnDefs: [{ "bVisible": false, "aTargets": [13] }],
//ProductsalesListing
//ProductpurchaseListing
    ajax: {
        "url": 'ProductstockoutListing',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val();
            data.wid = $('#warehouse').val();
            //
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
       /* { data: 'product_name', name: 'product_name' },*/
          { data: 'product_name', name: 'product_name' },

    
        { data: 'description', name: 'description', "render": function ( data, type, row, meta ) {

if (data != null && data.length > 1) {
     return type === 'display' && data.length > 40 ?
        '<span title="'+data+'">'+data.substr( 0, 38 )+'...</span>' :
        data;
    } else{
        return data;
    }

     
    } },
      /*  { data: 'description', name: 'description' },*/
        { data: 'product_code', name: 'product_code' },
       /* { data: 'bar_code',name: 'bar_code' },*/
        { data: 'unit', name: 'unit' },
      /*  { data: 'product_price', name: 'product_price' },*/
        { data: 'selling_price', name: 'selling_price' },
        { data: 'available_stock', name: 'available_stock' },
        { data: 'warehouse', name: 'warehouse' },
        { data: 'store', name: 'store' },
        /*{ data: 'rack', name: 'rack' },*/
        { data: 'category_name', name: 'category_name' },
        
         
        

    ]
});




    $(document).ready(function() {


     $('#productdetails_list tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');

         $('#selected_items').val(product_list_table.rows('.selected').data().length);

var versement_each = 0;
selectArr= new Array();
 var ids = $.map(product_list_table.rows('.selected').data(), function (item) {
         versement_each += parseFloat(item.unit_price) || 0;
         // alert(versement_each);
//
         var idx = $.inArray(item.product_id, selectArr);
if (idx == -1) {
  selectArr.push(item.product_id);
} else {
  selectArr.splice(idx, item.product_id);
}
//



    });


  $('#selected_amount').val(versement_each.toFixed(2));
    } );
 


} );



$("#datatableadd").on("click", function() {
$('#kt_modal_4_4').modal('hide');
product_list_table .rows( '.selected' ).nodes().to$() .removeClass( 'selected' );
$('#selected_amount').val('');
$('#selected_items').val('');
/*alert(selectArr);*/
    createproductvialoop(selectArr);

    });

function createproductvialoop(product_name_array){

   for(i=0; i<product_name_array.length; ++i){
   
    createproduct(product_name_array[i]);
}

}




function createproduct(product_name){
      //var product_name = $(this).val();
  // alert(product_name);
      
      
      
      $.ajax({
      url: "getproduct_name_details_sell_quotation",
      method: "POST",
      data: {
         _token: $('#token').val(),
         id:product_name
      },
      dataType: "json",
      success: function(data) { 
   
         $.each(data, function(key, value) {
         	  rowcount = $('#product_table tr').length;
			var des = value.description !="" ? value.description : '';
			var selling_price = (value.selling_price !=null) ? value.selling_price : 0;
			var stock = (value.available_stock !=null) ? value.available_stock : 0;

          var product = '';
         product += '<tr>\
                 <td>'+rowcount+'</td><td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname" data-id="'+rowcount+'" value="'+value.product_name+'" readonly>\
                 <div>\
                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id" data-id="'+rowcount+'" value="'+value.product_id+'">\
                 </td><td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control available_stock" name="available_stock[]" id="available_stock'+rowcount+'"  data-id="'+rowcount+'" value="'+stock+'" readonly>\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control stock_out_quantity" name="stock_out_quantity[]"  data-id="'+rowcount+'" id="stock_out_quantity'+rowcount+'">\
                 </div>\
                 </td>\
                 <td  style="background-color: white;">\
                      <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">\
                                          <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
                                          <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>\
                                       </div>\
                        </td>\
                 </tr>';
       $('#product_table').append(product);
              
                  });

        rowcount++;
      }
   })
}


	$( "#allocation_quantity" ).keyup(function() {
  var allocation_quantity = $(this).val();
    var available_quantity = document.getElementById("available_quantity").value;
    if (parseInt(allocation_quantity) > parseInt(available_quantity))

    {
         toastr.error('Allocation Quantity Must less or equal to Available Quantity');
        $(this).val("");
    } else {
        // do something
    }
});



$('body').on('change', '.stock_out_quantity', function() {
	 var id = $(this).attr('data-id');
	 
var stock_out_quantity = $('#stock_out_quantity'+id+'').val();

var available_stock = $('#available_stock'+id+'').val();
if (parseInt(stock_out_quantity) > parseInt(available_stock))

    {
         toastr.error('Stock Outn Quantity Must less or equal to Available Quantity');
        $(this).val("");
    } else {
        // do something
    }

	});


    $("body").on("click",".remove",function(event){
   event.preventDefault();
   var row = $(this).closest('tr');
   
  
       var siblings = row.siblings();
       row.remove();
       siblings.each(function(index) {
            $(this).children().first().text(index+1);
       });

       

   
});

$(document).on('click', '#transferrequestsubmit', function(e) {
    e.preventDefault();

        out_date      = $('#out_date').val();

 if (out_date == "") {
    $('#out_date').addClass('is-invalid');
    toastr.warning('Date is Required.');
    
    return false;
    } else {
    $('#out_date').removeClass('is-invalid');
    }

preparedby      = $('#preparedby').val();
 if (preparedby == "") {
            $('#preparedby').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any Salesman!");
                      return false;
        } else {
            $('#preparedby').next().find('.select2-selection').removeClass('select-dropdown-error');
        }


approvedby      = $('#approvedby').val();
 if (approvedby == "") {
            $('#approvedby').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any Salesman!");
                      return false;
        } else {
            $('#approvedby').next().find('.select2-selection').removeClass('select-dropdown-error');
        }


requested_by      = $('#requested_by').val();
 if (requested_by == "") {
    $('#requested_by').addClass('is-invalid');
    toastr.warning('Requested by is Required.');
    
    return false;
    } else {
    $('#requested_by').removeClass('is-invalid');
    }

warehouse      = $('#warehouse').val();



 if (warehouse == "") {
            $('#warehouse').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any warehouse!");
                      return false;
        } else {
            $('#warehouse').next().find('.select2-selection').removeClass('select-dropdown-error');
        }





        var productname = [];

        $("input[name^='item_details_id[]']")
        .each(function(input) {
            productname.push($(this).val());
        });




        
 var available_stock = [];

        $("input[name^='available_stock[]']")
        .each(function(input) {
            available_stock.push($(this).val());
        });


         var stock_out_quantity = [];

        $("input[name^='stock_out_quantity[]']")
        .each(function(input) {
            stock_out_quantity.push($(this).val());
        });



     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Updated';
     } else{
        var sucess_msg ='Created';
     }
    

    $.ajax({
        type: "POST",
        url: "transferrequestsubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        out_date            : $('#out_date').val(),
        prepared_by      : $('#preparedby').val(),
        approved_by     : $('#approvedby').val(),
        requested_by     : $('#requested_by').val(),
        warehouse     : $('#warehouse').val(),
        notes      : $('#notes').val(),
        productname     : productname,
        available_stock      : available_stock,
        stock_out_quantity : stock_out_quantity
        },
        success: function(data) {
       
        
             $('#transferrequestsubmit').removeClass('kt-spinner');
             $('#transferrequestsubmit').prop("disabled", false);
             location.reload();
              window.location.href = "transferrequests";
             toastr.success('Transfer Request '+sucess_msg+' successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});




$("#warehouse").on('change', function () {
   restId = $(this).val(); //This restId  is global variable
  product_list_table.ajax.reload();
});

</script>
@endsection