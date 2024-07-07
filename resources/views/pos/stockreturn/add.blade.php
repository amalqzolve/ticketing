@extends('pos.common.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
															Stock Return
																</h3>
																</div>                  
																</div>
																<div class="kt-portlet__body">
																<form class="kt-form" id="brand_form">
															 <input type="hidden" name="role" id="role" value="{{$user_id}}">
																 <div class="row" style="padding-bottom: 6px;">
																				<?php
																				$trquantity = 0;
                                 	$requantity = 0;
																				if($user_id == 'Qzolve')
																				{
																					?>
																					<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Van</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		<select class="form-control single-select kt-selectpicker van" name="van" id="van">
																	
																		 <option value="">Select</option>
																		 
																		 @foreach($van as $van)
																		 <option value="{{$van->id}}">{{$van->vanname}}</option>
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
																		<label>Van</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		<select class="form-control single-select kt-selectpicker van" name="van" id="van">
																	
																		 
																		 @foreach($van as $van)
																		 <option value="{{$van->id}}">{{$van->vanname}}</option>
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
																		<label>Return Date</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		<input type="text" name="date" id="date" class="form-control kt_datetimepickerr" value="{{date('d-m-Y')}}">
																		</div>
																		</div>
																		</div> 
                                                      <div class="col-lg-6">
                                                      <div class="form-group row  pr-md-3">
                                                      <div class="col-md-4">
                                                      <label>Receiver</label>
                                                      </div>  
                                                      <div class="col-md-8 input-group input-group-sm">
                                                      <select class="form-control single-select kt-selectpicker" name="receiver" id="receiver">
                                                       <option value="">Select</option>
                                                       
                                                       @foreach($salesmanlist as $salesmanlist)
																		 <option value="{{$salesmanlist->id}}">{{$salesmanlist->name}}</option>
																		 @endforeach
                                                      
                                                      </select>
                                                      </div>
                                                      </div>
                                                      </div>
																		<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Notes</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		<textarea name="notes" id="notes" class="form-control"></textarea>  
																		</div>
																		</div>
																		</div>   
<div class="col-lg-12">
                           <div class="form-group row pl-md-3">
                              <table class="table table-striped table-hover" id="modeofpaymenttable">
                                 <thead  style=" background-color: #306584; color: white;">
                                 <tr>
                                 <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 30px;">#</th>
                                    <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Item Name</th>
                                    <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Available Quantity</th>
                                    
                                     <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Return Quantity</th>
                                          <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Action</th>
                                     <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;
                                     width: 30px;">
                                       <!-- <div class="kt-demo-icon__preview addmorepayments pluseb">
                                             <i class="fa fa-plus" style="color: white;"></i>
                                          </div> --></th>
                                 </tr>
                                 </thead>
                                 <?php
                                 if($user_id != 'Qzolve')
                                 {
                                 	           foreach($vanstock as $key=>$vanstocks)
                                 {
                                 	
                                 

                                 	?>
                                 	<tr>
                                 	
                 <td style="text-align: center;">{{$key+1}}</td><td>
                 <div class="input-group input-group-sm">
                 <input type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname{{$key+1}}'" data-id="{{$key+1}}" value="{{$vanstocks->product_name}}" readonly="">
                 <div>
                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id{{$key+1}}" data-id="{{$key+1}}" value="{{$vanstocks->productid}}">
                 </td>
                 <td>
                 <div class="input-group input-group-sm">
                 <input type="text" class="form-control trquantity" name="trquantity[]" id="trquantity{{$key+1}}"  data-id="{{$key+1}}" value="{{$vanstocks->available_quantity}}" readonly="">
                 </div>
                 </td>
                 
                 
                 <td>
                 <div class="input-group input-group-sm">
                  <input type="text" class="form-control retquantity"  data-id="{{$key+1}}" name="retquantity[]" id="retquantity{{$key+1}}" value="0">
                 </div>
                 </td>
                 <td  style="background-color: white;">
                      <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">
                                          <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">
                                          <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>
                                       </div>
                        </td>
                 </tr>
                                 	<?php 	
                                 }
                                 }
                      
                                 ?>

                                 
                                 
                              </table>
              
               
                           </div>
                        </div>
																		   <div class="row mt-5">
						<div class="col-lg-6">
                              </div>
                              <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>Total Items Returned</label>
                              </div>  
                              <div class="col-md-8 input-group-sm">
                              
                              <input type="text" class="form-control" name="totalitems" id="totalitems" value="0" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                              
                                             
                              <!-- </div> -->
                              </div>
                              </div>
                              </div>
                              <div class="col-lg-6">
                              </div>
                              <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>Total Returned Quantity</label>
                              </div>  
                              <div class="col-md-8 input-group-sm">
                              
                              <input type="text" class="form-control" name="totalquantity" id="totalquantity" value="0" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                              
                                             
                              <!-- </div> -->
                              </div>
                              </div>
                              </div>
                              <div class="col-lg-6">
                              </div>
                              
                           </div>                            
																
									
							
																	</div>

						
																 <div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
															
														</div>
														<div class="col-lg-6 kt-align-right">
															<button id="stockreturnsubmit" class="btn btn-primary">{{ __('app.Save') }}</button>
															<button type="button" class="btn btn-secondary float-right mr-2"  onclick="goPrev()">{{ __('app.Cancel') }}</button>


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
	 function goPrev()
		{
	window.history.back();
	}
</script>
<script type="text/javascript">

$(document).ready(function(){
	  // var rowcount = ($("#modeofpaymenttable > tbody > tr").length) + 1;
	$('body').on('change', '.van', function() 
		{
			var i = 0;
var q = 0;
var tq = 0;
	var vanname = $(this).val(); 

	$("#modeofpaymenttable > tbody").remove();
	  var rowcount = ($("#modeofpaymenttable > tbody > tr").length) + 1;

		   $.ajax({
		url: "getvanproductsreturn",
		method: "POST",
		data: {
			_token: $('#token').val(),
			vanname:vanname,
		
		},
		dataType: "json",
		success: function(data) {
			 $.each(data, function(key, value) 
			 {

			 	// var trquantity = parseInt(value.available_quantity) + parseInt(value.invoiced_quantity);
   
			 	var payment = '';
			payment += '<tr>\
					  <td class="row_count" id="rowcount" style="padding: 0;">'+rowcount+'</td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control productname" name="productname[]" id="productname'+rowcount+'"  data-id="'+rowcount+'"value="'+value.product_name+'" readonly>\
					  <input type="hidden" class="form-control item_details_id" name="item_details_id[]" id="item_details_id'+rowcount+'"  data-id="'+rowcount+'" value="'+value.productid+'">\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control trquantity" name="trquantity[]" id="trquantity'+rowcount+'"  data-id="'+rowcount+'" value="'+value.available_quantity+'" readonly>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control retquantity" name="retquantity[]" id="retquantity'+rowcount+'"  data-id='+rowcount+' value="0">\
					  </div>\
					  </td>\
						<td style="padding: 0;">\
					  <div class="kt-demo-icon__preview costremove">\
					  <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>\
					  </div>\
					  </td>\
					  </tr>';
		
					  
		
					   $('#modeofpaymenttable').append(payment);

					  
    $('#totalitems').val(rowcount);

					   rowcount++;
});

 

		}
	})
			
});

   
 });

$(document.body).on("keyup  change", ".retquantity", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
 });
$('body').on('change', '.retquantity', function() {
var totalquantity = 0;
var quantity = 0;
var id = 0;
var items = 0;
    $('.retquantity').each(function()
      {
      	
         var id = $(this).attr('data-id');
         var trquantity = $('#trquantity'+id+'').val();
         var quantity = $('#retquantity'+id+'').val();
         if(parseFloat(trquantity) < parseFloat(quantity))
       {
         toastr.warning('Incorrect return quantity');
        $('#retquantity'+id+'').val(0);
        
       }
       else
       {
         totalquantity += parseFloat(quantity);
       }
       
      });
   var roles = $('#role').val();
   if(roles !== 'Qzolve')
   {
   	var items = ($("#modeofpaymenttable > tbody > tr").length);

    $('#totalitems').val(items);
   }
	  
 $('#totalquantity').val(totalquantity);
   });

</script>

<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/quotation.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
 <script src="{{url('/')}}/resources/js/pos/products.js" type="text/javascript"></script>
 <script src="{{url('/')}}/resources/js/pos/stockreturn.js" type="text/javascript"></script>
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
