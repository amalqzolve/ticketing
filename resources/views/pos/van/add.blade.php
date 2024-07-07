@extends('pos.common.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
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
															VAN
																</h3>
																</div>                  
																</div>
																<div class="kt-portlet__body">
																<form class="kt-form" id="brand_form">
															 
																 <div class="row" style="padding-bottom: 6px;">
																		<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Van Name</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																	<input type="text" name="vanname" id="vanname" class="form-control">
																		</div>
																		</div>
																		</div>
																								<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>License Plate No</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																	<input type="text" name="licenseno" id="licenseno" class="form-control">
																		</div>
																		</div>
																		</div>								

																		<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Route</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		<select class="form-control single-select kt-selectpicker" name="route" id="route">
																		 <option value="">Select</option>
																		  @foreach($route as $routes)
																	  <option value="{{$routes->id}}">{{$routes->routename}}</option>
																	  @endforeach
																	
																		
																		</select>
																		</div>
																		</div>
																		</div>

																	<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Salesman</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		<select class="form-control single-select kt-selectpicker" name="salesman" id="salesman">
																		 <option value="">Select</option>
																		  @foreach($salesmanlist as $salesmanlists)
																	  <option value="{{$salesmanlists->id}}">{{$salesmanlists->name}}</option>
																	  @endforeach
																		
																		</select>
																		</div>
																		</div>
																		</div>                                    
																		<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Driver</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																		<select class="form-control single-select kt-selectpicker" name="driver" id="driver">
																		 <option value="">Select</option>
																	 @foreach($drivers as $drivers)
																	  <option value="{{$drivers->id}}">{{$drivers->name}}</option>
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
																	<textarea name="notes" id="notes" class="form-control">
																		
																	</textarea> 
																		</div>
																		</div>
																		</div>
																		<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Username</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																	<input type="text" name="username" id="username" class="form-control username" placeholder="eg:abc@gmail.com">
																		</div>
																		</div>
																		</div>
																		<div class="col-lg-6">
																		<div class="form-group row  pr-md-3">
																		<div class="col-md-4">
																		<label>Password</label>
																		</div>  
																		<div class="col-md-8 input-group input-group-sm">
																	<input type="password" name="password" id="password" class="form-control">
																		</div>
																		</div>
																		</div>
																		 <div class="col-lg-12">
									<div class="form-group row pl-md-3">
										<table class="table table-striped table-hover" id="modeofpaymenttable">
											<thead  style=" background-color: #306584; color: white;">
											<tr>
											<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 30px;">#</th>

												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Customer Name</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Street Name</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">District</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">CR No</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Vat No</th>
														<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">Phone No</th>
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
					
									</div>
								</div>
																		
																	 <div class="kt-portlet__foot">
																	 <div class="kt-form__actions">
																	 <div class="row">
																	 <div class="col-lg-4">
																	 	<input type="hidden" name="totalrows" id="totalrows" value="0">
																	 </div>
																	 <div class="col-lg-8">
																	 </div>
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
															<button id="vansubmit" class="btn btn-primary">{{ __('app.Save') }}</button>
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
	  var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
	$(".addmorepayments").click(function() 
		{
		
	  var sl = ($("#modeofpaymenttable > tbody > tr").length);

		   
			var payment = '';
			payment += '<tr>\
					  <td class="row_count" id="rowcount" style="padding: 0;">'+ sl +'</td>\
					  <td style="padding: 0;">\
					  <select class="form-control single-select customername kt-selectpicker" name="customername[]" id="customername'+rowcount+'" data-id='+rowcount+'>\
					 <option value="">Select</option>\
					  @foreach($customers as $customerss)\
					  <option value="{{$customerss->id}}">{{$customerss->cust_name}}</option>\
					  @endforeach\
					  </select>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control streetname" name="streetname[]" id="streetname'+rowcount+'"  data-id='+rowcount+' readonly>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control district" name="district[]" id="district'+rowcount+'"  data-id='+rowcount+' readonly>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control crno" name="crno[]" id="crno'+rowcount+'"  data-id='+rowcount+' readonly>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control vatno" name="vatno[]" id="vatno'+rowcount+'"  data-id='+rowcount+' readonly>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control phone" name="phone[]" id="phone'+rowcount+'"  data-id='+rowcount+' readonly>\
					  </div>\
					  </td>\
						<td style="padding: 0;">\
					  <div class="kt-demo-icon__preview remove">\
					  <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>\
					  </div>\
					  </td>\
					  </tr>';
		
					   $('#modeofpaymenttable').append(payment);

					  


  $('#totalrows').val(rowcount); 

					   rowcount++;

});

 });
 $(document.body).on("change", ".customername", function() 
    {

        var customer = $(this).val();
        var did = $(this).attr('data-id');
        
        $.ajax({
        url: "getcustomerdetailspos",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:customer
        },
        dataType: "json",
        success: function(data) {
            console.log(data);
           
          $.each(data, function(key, value) {
          
           $('#streetname'+did+'').val(value.cust_add2);
           $('#district'+did+'').val(value.cust_region);
           $('#crno'+did+'').val(value.buyerid_crno);
           $('#vatno'+did+'').val(value.vatno);
           $('#phone'+did+'').val(value.mobile1);
                        });
        }
    })
    });
     $("body").on("click",".remove",function(event){
   event.preventDefault();
   var row = $(this).closest('tr');
   
  
       var siblings = row.siblings();
       row.remove();
       siblings.each(function(index) {
            $(this).children().first().text(index);
       });
});
     $(document.body).on("change", ".username", function() 
    {
    	var email = $('#username').val();
    	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if ( !emailReg.test( email ) ) 
            {
                toastr.warning('Please enter valid email.');
             return false;
            } 
            else
            {
										        $.ajax({
										        url: "getvanemailspos",
										        method: "POST",
										        data: {
										            _token: $('#token').val(),
										            email:email
										        },
										        dataType: "json",
										        success: function(data) {
										            console.log(data);
										         if(data > 0)  
										         {
                toastr.warning('Username already exist!');
																$('#username').val('');
										         }
										         else
										         {

										         }
										         
										        }
										    })
            }
    });
      
</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/pos/van.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>

@endsection
