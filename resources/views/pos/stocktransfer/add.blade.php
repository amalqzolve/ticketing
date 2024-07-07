@extends('pos.common.layout')
@section('content')

<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<style>
.inputpicker-overflow-hidden
   {
   overflow: hidden;
   width: 100%;
   }
   .inputpicker-div > .inputpicker-input
   {
   font-size: 11px;
   }
   .inputpicker-arrow{
   top:8px;
   }
   div.new1 {
   background-color: #f2f3f8;
   height: 20px;
   width: 100%;
   right: -36px;
   position: absolute;
   display: block;
   }
   .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
   padding: 8px;
   line-height: 1.42857143;
   vertical-align: top;
   border-top: 1px solid #ddd;
   }
   .pluseb {
   background-color: #5d78ff;
   height: 100%;
   padding-top: 22%;
   text-align: center;
   }
   .pluseb:hover {
   background-color: #2a4eff;
   }
   .uppy-size--md .uppy-Dashboard-inner
   {
   width: 100% ;
   height: 550px;
   }
   .table-bordered th, .table-bordered td {
    border: 0px solid #ebedf2;
    padding: 0px !important;
}
.nav-tabs {
    border-bottom: 0px;
}
.nav-tabs .nav-link {
    border: 3px solid transparent;}
.nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
    border-color: #f8fcff #fefeff #979fa8;
}
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link{
   border-color: #ffffff #ffffff #2275d7;
}
.mbtn
{
   background-color: white;
   color: #74788d;

}
.mbtn:hover
{
       color: #ffffff;
    background: #5d78ff;
    border-color: #5d78ff;
   
}
.mbdg1
{
       background: #fff;
    color: #a1a3a5;
}
.mbdg1:hover
{
    background: #0ABB87;
    color: #fff;
}
.mbdg2
{
       background: #fff;
    color: #a1a3a5;
}
.mbdg2:hover
{
    background: #FD397A;
    color: #fff;
}
.dataTables_wrapper .dataTable .selected th, .dataTables_wrapper .dataTable .selected td {
    background-color: #f4e92b !important;
    /* color: #595d6e; */
}
#productdetails_list_wrapper
{
   height: 300px;
    overflow-y: scroll;
}
</style>
																		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
																	 <div class="kt-container  kt-container--fluid ">
																	 <div class="kt-subheader__main">
																	 <div class="kt-subheader__breadcrumbs">
																	 <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
																	 <span class="kt-subheader__breadcrumbs-separator"></span>

																		<!-- {{ Breadcrumbs::render('NewBrand') }} -->

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
															Stock Transfer
																</h3>
																</div>                  
																</div>
																<div class="kt-portlet__body">
																<form class="kt-form" id="brand_form">
															 
																 <div class="row" style="padding-bottom: 6px;">
																		<?php	if($user_id == 'Qzolve')
                                    {
                                      ?>
                                      <div class="col-lg-6">
                                    <div class="form-group row  pr-md-3">
                                    <div class="col-md-4">
                                    <label>Van Name</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <select class="form-control single-select kt-selectpicker" name="van" id="van">
                                    
                                     <option value=""> Select</option>
                                    @foreach($van as $vans)
                                                       <option value="{{$vans->id}}">{{$vans->vanname}}</option>

                                                      @endforeach
                                    
                                    </select>
                                    </div>
                                    </div>
                                    </div>
                                      <?php
                                    }
                                    else
                                    {
                                      ?>
                                      <div class="col-lg-6">
                                    <div class="form-group row  pr-md-3">
                                    <div class="col-md-4">
                                    <label>Van Name</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <select class="form-control single-select kt-selectpicker" name="van" id="van">
                                    
                                   
                                    @foreach($van as $vans)
                                                       <option value="{{$vans->id}}">{{$vans->vanname}}</option>

                                                      @endforeach
                                    
                                    </select>
                                    </div>
                                    </div>
                                    </div>
                                      <?php
                                    }
                                    ?>													
																		

																	<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Date</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		<input type="text" name="date" id="date" class="form-control kt_datetimepickerr" value="{{date('d-m-Y')}}">
																		</div>
																		</div>
																		</div> 
																		<div class="col-lg-12">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-2">
																		<label>Notes</label>
																		</div>  
																		<div class="col-md-10 input-group input-group-sm">
																		<textarea name="notes" id="notes" class="form-control"></textarea>  
																		</div>
																		</div>
																		</div>   
<div class="col-lg-12">
	<table class="table table-striped table-bordered table-hover" id="product_table"  style="table-layout:fixed; width:100%">
                                    <thead  class="thead-light" >
                                     <tr>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" >Sl.No</th>
                                   
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Item Name')</th>
                 
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">Sales Price</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">Available Quantity</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">Transfer Quantity</th>
                                        <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">Total Amount</th>
                                    
                                   
                                    
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; ">@lang('app.Action')</th>
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
																		                               
			 <input type="hidden" name="totlrows" id="totalrows" value="0">													
									
							
																	</div>
<div class="row mt-5">

						<div class="col-lg-6">
                              </div>
                              <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>Total Items</label>
                              </div>  
                              <div class="col-md-8 input-group-sm">
                              
                              <input type="text" class="form-control" name="totalitems" id="totalitems" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                              
                                             
                              <!-- </div> -->
                              </div>
                              </div>
                              </div>
                              <div class="col-lg-6">
                              </div>
                              <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>Total Quantity</label>
                              </div>  
                              <div class="col-md-8 input-group-sm">
                              
                              <input type="text" class="form-control" name="totalquantity" id="totalquantity" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                              
                                             
                              <!-- </div> -->
                              </div>
                              </div>
                              </div>
                              <div class="col-lg-6">
                              </div>
                              <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>Grand Total</label>
                              </div>  
                              <div class="col-md-8 input-group-sm">
                              
                              <input type="text" class="form-control" name="totalamount" id="totalamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                              
                                             
                              <!-- </div> -->
                              </div>
                              </div>
                              </div>
                           </div>
																 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
															
														</div>
														<div class="col-lg-6 kt-align-right">
															<button id="stocktransfersubmit" class="btn btn-primary">{{ __('app.Save') }}</button>
															<button type="button" class="btn btn-secondary float-right mr-2"  onclick="goPrev()">{{ __('app.Cancel') }}</button>


														</div>
													</div>
												</div>
											</div>
											</form>
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
            <th>{{ __('mainproducts.Barcode') }}</th>
            <th>{{ __('mainproducts.Unit') }}</th>
            <th>Product price</th>
            <th>Selling price</th>
            <th>Stock</th>
            <th>WH</th>
            <th>Store</th>
            <!-- <th>Rack</th> -->
            <th>Category</th>
           <!--  <th>Type</th>
            <th>Status</th> -->
            <!-- <th>ID</th> -->
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
	 function goPrev()
		{
	window.history.back();
	}
</script>
<script type="text/javascript">
	   var rowcount = $('#product_table tr').length;
//var rowcount = 1;
$(document.body).on("change", ".product_names", function() 
  {
   product_name = $(this).val();
   createproduct(product_name);
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
      url: "getproduct_name_details_quotation",
      method: "POST",
      data: {
         _token: $('#token').val(),
         id:product_name
      },
      dataType: "json",
      success: function(data) { 
   
         $.each(data, function(key, value) {
            rowcount = $('#product_table tr').length;
           /* alert(rowcount);*/
 var des = value.description !="" ? value.description : '';
         var selling_price = (value.selling_price !=null) ? value.selling_price : 0;
          var product = '';
         product += '<tr>\
                 <td style="text-align: center;">'+rowcount+'</td><td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname" data-id="'+rowcount+'" value="'+value.product_name+'" readonly>\
                 <div>\
                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id" data-id="'+rowcount+'" value="'+value.product_id+'">\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control rate" name="rate[]" id="rate'+rowcount+'"  data-id="'+rowcount+'" value="'+selling_price+'" readonly>\
                 </div>\
                 </td>\
                  <td>\
                 <div class="input-group input-group-sm">\
                   <input type="text" class="form-control single-select originalstock" name="originalstock[]" id="originalstock'+rowcount+'" data-id="'+rowcount+'" value="'+value.available_stock+'" readonly>\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                  <input type="number" class="form-control quantity"  data-id="'+rowcount+'" name="quantity[]" id="quantity'+rowcount+'"  value="1" \
                 </div>\
                 </td>\
                  <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control amount" name="amount[]" id="amount'+rowcount+'"  data-id="'+rowcount+'" value="'+selling_price+'" readonly>\
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
$('#totalrows').val(rowcount);
final_calculate1();
        rowcount++;
      }
   })
}
$(document.body).on("keyup  change", ".quantity", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });
$(document.body).on("change", ".quantity", function() 
    {
        var did = $(this).attr('data-id');
        var quantity = $('#quantity'+did+'').val();
        var orquantity = $('#originalstock'+did+'').val();
       

       if(parseFloat(orquantity) < parseFloat(quantity))
       {
         toastr.warning('Transfered quantity is greater than available quantity');
        $('#quantity'+did+'').val(0);
        
       }
       else
       {

       }
    });
$('body').on('change', '.quantity', function() {
    var id = $(this).attr('data-id');
    row_calculate(id);
   });

   $('body').on('change', '.rate', function() {
    var id = $(this).attr('data-id');
    row_calculate(id);
   });

   function row_calculate(id)
     {
      
      var quantity = $('#quantity'+id+'').val();
      var rate     = $('#rate'+id+'').val();
   
      var total    = parseFloat(quantity * rate);
      

      $('#amount'+id+'').val(total.toFixed(2));
      $('#amount'+id+'').val(total.toFixed(2));
     
     
      final_calculate1();
     }
     

     function final_calculate1()
     {
      var totalitems = 0;
      var totals = 0;
      var totalquantity = 0;
      $('.amount').each(function()
      {
         var id = $(this).attr('data-id');
         var quantity = $('#quantity'+id+'').val();
         var total = $('#amount'+id+'').val();
      
         totals += parseFloat(total);
         totalquantity   += parseFloat(quantity);
         totalitems = $('#product_table tbody tr').length;
      });
      $('#totalitems').val(totalitems);   
      $('#totalquantity').val(totalquantity);
    
      $('#totalamount').val(totals.toFixed(2));
      

      }

    $("body").on("click",".remove",function(event){
   event.preventDefault();
   var row = $(this).closest('tr');
   
  
       var siblings = row.siblings();
       row.remove();
       siblings.each(function(index) {
           $(this).children().first().text(index+1);
       });
final_calculate1();

   
});

</script>
<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
 <script src="{{url('/')}}/resources/js/pos/products.js" type="text/javascript"></script>
 <script src="{{url('/')}}/resources/js/pos/stocktransfer.js" type="text/javascript"></script>
<script type="text/javascript">
	const channel = new BroadcastChannel("inventory");

    channel.addEventListener("message", e => {
      //alert(e.data);
       if(e.data=='success'){
         
  //        load_product();
  //productname
         product_list_table.ajax.reload();
    //      $( "#productname" ).trigger( "click" );
       }
    /*    if(e.data){
         load_product();
         product_list_table.ajax.reload();
         // alert(1);

       }*/
    }); 
</script>
@endsection
