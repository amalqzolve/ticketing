@extends('costing.common.layout')
@section('content')

<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <style>
        .twitter-typeahead,
        .tt-hint,
        .tt-input,
        .tt-menu{
            width: auto ! important;
            font-weight: normal;

        }
    </style>
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


<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											
Estimation
										  
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
								<form class="kt-form" id="id">
                           
								 <div class="row" style="padding-bottom: 6px;">
								 	                       <div class=" pr-1 pl-1" style="">
                           
                          <table class="table table-striped table-bordered table-hover" id="product_table"  style="width:100%">
                                    <thead  class="thead-light" >
                                     <tr>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="25px">#</th>
                                   
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="150px">Item Name</th>
                                       
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Description')</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Unit')</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px">@lang('app.Quantity')</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="90px">@lang('app.Rate')</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px;">@lang('app.Amount')</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px">@lang('app.Discount')</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px;">@lang('app.Vat (%)')</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; width: ;" width="75px;">@lang('app.VAT Amount')</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="75px;">@lang('app.Total Amount')</th>
                                    <th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                                 </tr>
                                    </thead>
                                    <br>
                                    <tbody>
                                    <tr>
   <td style="text-align: center;">1</td>
   <td>

      <input type="text" class="form-control head_name" name="head_name[]" id="head_name1" >                 
       
      
   </td>
      

   <td><textarea class="form-control" id="product_description1" name="product_description[]" rows="1" data-id="1" style=" height: 30px !important;"></textarea></td>
   <td>
      <div>
         <select class="form-control form-control-sm single-select unit kt-selectpicker" data-id="1" name="unit[]" id="unit1">
            <option value="">select</option>
            @foreach($unitlist as $data)
              <option value="{{$data->id}}">{{$data->unit_name}}</option>
              @endforeach


         </select>
      </div>
     
    
   </td>
   <td>
      <div class="input-group input-group-sm">                  <input type="text" class="form-control quantity" data-id="1" name="quantity[]" id="quantity1" value="1">                 </div>
   </td>
   <td>
      <div class="input-group input-group-sm">                 <input type="text" class="form-control rate" name="rate[]" id="rate1" data-id="1" value="0">                 </div>
   </td>
   <td>
      <div class="input-group input-group-sm">                 <input type="text" class="form-control amount" name="amount[]" data-id="1" id="amount1" readonly="" value="0">                 </div>
   </td>
   <td>
      <div class="input-group input-group-sm">                 <input type="text" class="form-control discountamount" data-id="1" name="discountamount[]" id="discountamount1" value="0">                 </div>
   </td>


   <td>
    
     <select class="form-control form-control-sm single-select vat_percentage kt-selectpicker" data-id="1" name="vat_percentage[]" id="vat_percentage1">
            <option value="">select</option>
            @foreach($vatlist as $data)
              <option value="{{$data->total}}">{{$data->total}}</option>
              @endforeach


         </select>
</td>


   <td>                 <input type="text" class="form-control vatamount form-control-sm" name="vatamount[]" id="vatamount1" data-id="1" value="0" readonly="">                 </td>
   <td>
      <div class="input-group input-group-sm">                 <input type="text" class="form-control row_total" data-id="1" name="row_total[]" id="row_total1" readonly="">                 </div>
   </td>
   <td style="background-color: white;">
      <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">                                          <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">                                          <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>                                       </div>
   </td>
</tr>
                                       
                                    </tbody>
                                 </table>
                                 <table style="width:100%">
                                    <tr>
                                          <td>
                                             <!-- <button type="button" class="btn btn-primary btn-sm addproduct">Add New</button>&nbsp; &nbsp; &nbsp; &nbsp;</td> -->
                                             <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" id="newrow" ><i class="la la-plus"></i>Line Iteam</button>
                                 
                                      
                                 </td>
                                 
                                       </tr>
                                 </table>
                              
                            
                        </div>
                        <hr style="height: 15px;
                     background-color: #f2f3f8;
                     width: 100%;
                     position: absolute;
                     left: 0;
                     border: 0;
                     margin-top: 0;">
                       
                     </div>
                  </div>



                  <div class="row mt-5">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group  row pr-md-3">
                    <div class="col-md-4">
                    <label>@lang('app.Total Amount Before Tax')</label>
                    </div>  
                    <div class="col-md-8 input-group-sm">
                     
                    <input type="text" class="form-control" name="totalamount" id="totalamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                    
                              
                    <!-- </div> -->
                    </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group  row pr-md-3">
                    <div class="col-md-4">
                    <label>@lang('app.Discount (Flat)')</label>
                    </div>  
                    <div class="col-md-8 input-group-sm">
                     
                    <input type="text" class="form-control discount" name="discount" id="discount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                    
                              
                    <!-- </div> -->
                    </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group  row pr-md-3">
                    <div class="col-md-4">
                    <label>@lang('app.Amount After Discount')</label>
                    </div>  
                    <div class="col-md-8 input-group-sm">
                     
                    <input type="text" class="form-control" name="amountafterdiscount" id="amountafterdiscount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">
                    
                              
                    <!-- </div> -->
                    </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group  row pr-md-3">
                    <div class="col-md-4">
                    <label>@lang('app.VAT Amount')</label>
                    </div>  
                    <div class="col-md-8 input-group-sm">
                     
                    <input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly style=" text-align: right; font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);">                    
                              
                    <!-- </div> -->
                    </div>
                    </div>
                    </div>
                 <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group  row pr-md-3">
                    <div class="col-md-4">
                    <label style="    font-size: 1.5rem;
    font-weight: bold; padding-top:4px">@lang('app.Total Amount')</label>
                    </div>  
                    <div class="col-md-8 input-group-sm">
                     
                    <input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly style="
                                        background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem;
    font-weight: bold; color: #646c9a; padding-top: 0px;">
                    
                              
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
															<button id="costmatrixsubmit" class="btn btn-primary">{{ __('product.Save') }}</button>
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
<script>

	$(document).on('click', '#costmatrixsubmit', function(e) {
    e.preventDefault();



        var head_name = [];

        $("input[name^='head_name[]']")
        .each(function(input) {
            head_name.push($(this).val());
        });




        var product_description = [];

        $("textarea[name^='product_description[]']")
        .each(function(input) {
            product_description.push($(this).val());
        });

        var unit = [];

        $("select[name^='unit[]']")
        .each(function(input) {
            unit.push($(this).val());
        });

        var quantity = [];

        $("input[name^='quantity[]']")
        .each(function(input) {
            quantity.push($(this).val());
        });

        var rate = [];

        $("input[name^='rate[]']")
        .each(function(input) {
            rate.push($(this).val());
        });

        var amount = [];

        $("input[name^='amount[]']")
        .each(function(input) {
            amount.push($(this).val());
        });

        var vatamount = [];

        $("input[name^='vatamount[]']")
        .each(function(input) {
            vatamount.push($(this).val());
        });

        var vat_percentage = [];
          $("select[name^='vat_percentage[]']")
                .each(function(input) {
                    vat_percentage.push($(this).val());
                });




           var rdiscount = [];

        $("input[name^='discountamount[]']")
        .each(function(input) {
            rdiscount.push($(this).val());
        });


        var row_total = [];

        $("input[name^='row_total[]']")
        .each(function(input) {
            row_total.push($(this).val());
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
        //url: "costmatrixsubmit",
         url: "{{url('costmatrixsubmit')}}",
        dataType: "text",
        data: {
            _token: $('#token').val(),


        totalamount         : $('#totalamount').val(),
        discount            : $('#discount').val(),
        amountafterdiscount : $('#amountafterdiscount').val(),
        totalvatamount      : $('#totalvatamount').val(),
        grandtotalamount    : $('#grandtotalamount').val(),
        paidamount    : $('#paidamount').val(),
        balanceamount    : $('#balanceamount').val(),
        costmatrixname    : $('#costmatrixname').val(),
        description    : $('#description').val(),
        head_name : head_name,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        rate : rate,
        amount : amount,
        vat_percentage : vat_percentage, 
        vatamount : vatamount,    
        rdiscount : rdiscount,     
        row_total : row_total,
       
   
        },
        success: function(data) {
        	if(data == 'false')
									{
										$('#costmatrixsubmit').removeClass('kt-spinner');
										$('#costmatrixsubmit').prop("disabled", false);
										toastr.warning('Cost Matrix name already exist');
									}
									else
									{
										 $('#costmatrixsubmit').removeClass('kt-spinner');
             $('#costmatrixsubmit').prop("disabled", false);
                toastr.success('Cost Matrix ' +sucess_msg+' successfuly');
                   window.location.href = document.referrer;
									}
        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});



   $(document).on('click', '.closeBtn', function() {

      $("#myModal").modal("hide");
      $('#itemname').val("");
      $('#description').val("");
      $('#productunit').val("");
      $('#price').val("");

      $("#serviceModal").modal("hide");
      $('#servicename').val("");
      $('#servicedescription').val("");
      $('#serviceunit').val("");
      $('#serviceprice').val("");

});
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
         /*  if (data != null && data.length > 1) {
           }*/
 var des = value.description !=null ? value.description : '-';
         var selling_price = (value.selling_price !=null) ? value.selling_price : 0;
          var product = '';
         product += '<tr>\
                 <td style="text-align: center;">'+rowcount+'</td><td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control single-select productname kt-selectpicker" name="productname[]" id="productname" data-id="'+rowcount+'" value="'+value.product_name+'">\
                 <div>\
                 <input type="hidden" class="form-control single-select item_details_id" name="item_details_id[]" id="item_details_id" data-id="'+rowcount+'" value="'+value.product_id+'">\
                 </td>\
                 <td><textarea class="form-control" id="product_description'+rowcount+'" name="product_description[]" rows="1" data-id='+rowcount+' style=" height: 30px !important;">'+des+'</textarea>\</td>\
                 <td>\
                 <div>\
                 <select class="form-control form-control-sm single-select unit kt-selectpicker"  data-id="'+rowcount+'" name="unit[]" id="unit'+rowcount+'">\
                 <option value="">select</option>\
         @foreach($unitlist as $data)\
              <option value="{{$data->id}}">{{$data->unit_name}}</option>\
              @endforeach\
                 </select>\
                  </div>\
                 <div class="input-group input-group-sm">\
                 <input type="hidden" class="form-control unitvalue" name="unitvalue[]" id="unitvalue'+rowcount+'"  data-id="'+rowcount+'">\
                 </div>\
                 <div class="input-group input-group-sm">\
                 <input type="hidden" class="form-control quantity_value" name="quantity_value[]" id="quantity_value'+rowcount+'"  data-id="'+rowcount+'" value="1">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                  <input type="text" class="form-control quantity"  data-id="'+rowcount+'" name="quantity[]" id="quantity'+rowcount+'" value="1">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control rate" name="rate[]" id="rate'+rowcount+'"  data-id="'+rowcount+'" value="'+selling_price+'">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control amount" name="amount[]"  data-id="'+rowcount+'" id="amount'+rowcount+'" readonly value="'+selling_price+'">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control discountamount"  data-id="'+rowcount+'" name="discountamount[]" id="discountamount'+rowcount+'" value="0">\
                 </div>\
                 </td>\
                 @foreach($vatlist as $data)\
                        <?php
      if($data->default_tax == 1)
      { ?>
                              <td><input type="text" class="form-control vat_percentage form-control-sm" name="vat_percentage[]" id="vat_percentage'+rowcount+'" data-id='+rowcount+' value="{{$data->total}}" ></td>\
                           <?php
      }
       ?>
                           @endforeach\
                <td>\
                 <input type="text" class="form-control vatamount form-control-sm" name="vatamount[]" id="vatamount'+rowcount+'" data-id='+rowcount+' value="0"    readonly>\
                 </td>\
                  <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control row_total"  data-id="'+rowcount+'" name="row_total[]" id="row_total'+rowcount+'" readonly>\
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
                 $('.vat_percentage').trigger("change");
                 $("#unit"+rowcount).val(value.unit).change();
                  $("#unitvalue"+rowcount).val(value.unit);
                 
            
                  });

        rowcount++;
      }
   })
}

// $(document).ready(function(){

// $(".productname").select2();

//      var rowcount = ($("#product_table > tbody > tr").length);
//      var i1=true;
//    $(".addproduct").click(function() 
//       {
//  $('.productname').each(function() {

//         if ($(this).val() === '') {
//           i1=false;
//            return false;


//         }
//         else {
//               i1=true;
//          }

//              });
//          if(i1==true){

//                 var sl = ($("#product_table > tbody > tr").length);
//           var sl = sl + 1;
         

   


//          var products = '';
//          products += '<tr>\
//                  <td class="row_count" id="rowcount">'+ sl +'</td>\
//                  <td>\
//                  <select class="form-control kt-selectpicker productname" id="productname'+sl+'" name="productname[]" data-id='+sl+'><option value="">Select</option>';


//  $.ajax({
//         type: "POST",
//         url: "getallproductdetails",
//         dataType: "json",
//         data: {
//             _token: $('#token').val(),
//         },
//         success: function(data) {
       

//               $.each(data, function(key, value) {

// $("#productname"+sl).append("<option value='"+value.product_id+"'>"+value.product_name+"</option>");
             


//             });

//    //$("#productname"+sl).trigger('change');


//         },
//         error: function(jqXhr, json, errorThrown) {
         
//           console.log(errorThrown);
           
//         }
//     });
            
   
         
   

//             products +='</select>\
//                  </td>\
//                  <input type="hidden" name="orquantity[]" id="orquantity'+sl+'">\
//                  <td>\
//                  <textarea class="form-control" id="product_description'+sl+'" name="product_description[]" data-id='+sl+'></textarea>\
//                  </td>\
//                   <td>\
//                  <select class="form-control kt-selectpicker" id="unit'+sl+'" name="unit[]" data-id='+sl+'>\
//          <option value="">select</option>\
//          @foreach($unitlist as $data)\
//             <option value="{{$data->id}}">{{$data->unit_name}}</option>\
//             @endforeach</select>\</td>\
//                   <td>\
//                 <input type="text" class="form-control quantity" name="quantity[]" id="quantity'+sl+'" value="1" data-id='+sl+'>\
//                  </td>\
//                   <td>\
//                  <input type="text" class="form-control rate" name="rate[]" id="rate'+sl+'" data-id='+sl+'>\
//                  </td>\
//                  <td>\
//                 <input type="text" class="form-control amount" name="amount[]" id="amount'+sl+'" data-id='+sl+' readonly>\
//                  </td>\
//                   <td><input type="text" class="form-control discountamount" name="discountamount[]" id="discountamount'+sl+'"  data-id='+sl+' value="0"></td>\
//                   @foreach($vatlist as $data)\
//                         <?php
//                               if($data->default_tax == 1)
//                               { ?>
//                               <td><input type="text" class="form-control vat_percentage" name="vat_percentage[]" id="vat_percentage'+sl+'" data-id='+sl+' value="{{$data->total}}" ></td>\
//                            <?php
//                         }
//                            ?>
//                            @endforeach\
//                            <td>\
//                  <input type="text" class="form-control vatamount" name="vatamount[]" id="vatamount'+sl+'" data-id='+sl+' value="0" readonly>\
//                  </td>\
//                  <td>\
//                  <input type="text" class="form-control row_total" name="row_total[]" id="row_total'+sl+'" data-id='+sl+' readonly>\
//                  </td>\
//                  <td>\
//                      <div class="kt-demo-icon__preview remove">\
//                        <i class="fa fa-trash" id="" style="color: red;padding-left: 30%;"></i>\
//                     </div>\
//                       </td>\
//                  </tr>';
      
//                   $('#product_table').append(products);
//                   rowcount++;
//                      $('.kt-selectpicker').select2();
//         } else{
//           toastr.warning("Please Select any Product!"); return false;
//         }
      


         
   
// });
   
//  });

//    $(document.body).on("change", ".productname", function() 
//    {
//       var productid = $(this).val();
//       var id = $(this).attr('data-id');
      
      
//       $.ajax({
//       url: "getproductdetails",
//       method: "POST",
//       data: {
//          _token: $('#token').val(),
//          id:productid
//       },
//       dataType: "json",
//       success: function(data) {
//          $.each(data, function(key, value) {
//                   $('#rate'+id+'').val(value.selling_price);
//                   $('#product_description'+id+'').val(value.description);
//                   $('#unit'+id+'').select2("val", value.unit);
//                   $('#quantity'+id+'').val(1);
//                   $('#amount'+id+'').val("");
//                   $('#vatamount'+id+'').val(0);
//                   $('#row_total'+id+'').val("");
//                   $('#totalamount').val("");
//                   $('#discount').val("");
//                   $('#amountafterdiscount').val("");
//                   $('#totalvatamount').val("");
//                   $('#grandtotalamount').val("");
//                   $('#orquantity'+id+'').val(value.available_stock);
//                   });
//          row_vatcalculate(id);
//          row_calculate(id);
         

//       }
//    })
//    });

    $('body').on('change', '.quantity', function() {
    var id = $(this).attr('data-id');
    row_calculate(id);
    row_vatcalculate(id);
   });
     $('body').on('change', '.rate', function() {
    var id = $(this).attr('data-id');
    row_vatcalculate(id);
    row_calculate(id);
    row_vatcalculate(id);
   });
$('body').on('change', '.vatamount', function() {
    var id = $(this).attr('data-id');
    row_calculate(id);
    row_vatcalculate(id);
   });

$('body').on('change', '.discountamount', function() {
    var id = $(this).attr('data-id');
    
    discount_calculate();
    row_vatcalculate(id);
    row_calculate(id);
   });



$('body').on('change', '.vat_percentage', function() {
    var id = $(this).attr('data-id');
    

    row_vatcalculate(id);
     row_calculate(id);

   });


 function discount_calculate()
     {
         var totaldiscamount = 0;
      $('.discountamount').each(function()
      {
         var id = $(this).attr('data-id');
         var damount = $('#discountamount'+id+'').val();
      
         totaldiscamount += parseFloat(damount);

      });
      totaldiscamount=getNum(totaldiscamount);
      $('#discount').val(totaldiscamount);
//

   /*var amountafterdiscount = 0;
   var grandtotalamount = 0;
         var discount = $('#discount').val();
         var totalamount = $('#totalamount').val();
         var totalvatamount = $('#totalvatamount').val();

         var discountamount = (parseFloat(totalamount) - parseFloat(discount)) ;
         amountafterdiscount = parseFloat(totalamount) - parseFloat(discountamount);
         grandtotalamount = parseFloat(amountafterdiscount) + parseFloat(totalvatamount);
      
      $('#amountafterdiscount').val(amountafterdiscount);
      $('#grandtotalamount').val(grandtotalamount);*/
      //
     }


 function row_vatcalculate(id)
     {
   var vatpercentage= $('#vat_percentage'+id+'').val();
     vatpercentage=getNum(vatpercentage);
      var quantity = $('#quantity'+id+'').val();
   quantity=getNum(quantity);
      var rate     = $('#rate'+id+'').val();
 rate=getNum(rate);
      var rdiscount     = $('#discountamount'+id+'').val();
 rdiscount=getNum(rdiscount);

      var total    = parseFloat(quantity * rate) -parseFloat(rdiscount);


      vat_amount = (vatpercentage / 100) * total;
       vat_amount=getNum(vat_amount);
       $('#vatamount'+id+'').val(vat_amount.toFixed(2));

       //

         var vatamounts = 0;
      $('.vatamount').each(function()
      {
         var id = $(this).attr('data-id');
         var vatamount = $('#vatamount'+id+'').val();
      
         vatamounts += parseFloat(vatamount);

      });
      vatamounts=getNum(vatamounts);
      $('#totalvatamount').val(vatamounts.toFixed(2));

      //
}

     function row_calculate(id)
     {
      

      var quantity = $('#quantity'+id+'').val();
      var rate     = $('#rate'+id+'').val();
      var vatamount= $('#vatamount'+id+'').val();

//$new_width = ($percentage / 100) * $totalWidth;
   var disamount= $('#discountamount'+id+'').val();



      var total    = parseFloat(quantity * rate);
      var rowtotal = parseFloat(total-disamount) + parseFloat(vatamount)
total=getNum(total);
rowtotal=getNum(rowtotal);
      $('#amount'+id+'').val(total.toFixed(2));
      $('#row_total'+id+'').val(rowtotal.toFixed(2));
      row_vatcalculate(id);
      totalamount_calculate();
      discount_calculate();
      final_calculate1();
     }

    $('body').on('change', '.vatamount', function() {
   
      var vatamounts = 0;
      $('.vatamount').each(function()
      {
         var id = $(this).attr('data-id');
         var vatamount = $('#vatamount'+id+'').val();
      
         vatamounts += parseFloat(vatamount);

      });
      vatamounts=getNum(vatamounts);
      $('#totalvatamount').val(vatamounts.toFixed(2));
   });

function totalamount_calculate()
{
      var totalamount = 0;
      $('.amount').each(function()
      {
         var id = $(this).attr('data-id');
         var amount = $('#amount'+id+'').val();
      
         totalamount += parseFloat(amount);

      });
         totalamount=getNum(totalamount);
      $('#totalamount').val(totalamount.toFixed(2));
   /* $('#amountafterdiscount').val("");
      $('#discount').val("");
      $('#grandtotalamount').val("");*/

}

    $('body').on('change', '.discount', function() {
   
final_calculate1();

      
   });
function final_calculate1(){

      //

      var vatamounts = 0;
      $('.vatamount').each(function()
      {
         var id = $(this).attr('data-id');
         var vatamount = $('#vatamount'+id+'').val();
      
         vatamounts += parseFloat(vatamount);

      });
       vatamounts=getNum(vatamounts);
      $('#totalvatamount').val(vatamounts.toFixed(2));

      //


      var amountafterdiscount = 0;
   var grandtotalamount = 0;
         var discount = $('#discount').val();
         var totalamount = $('#totalamount').val();
         var totalvatamount = $('#totalvatamount').val();

      var discountamount = $('#discount').val();
         //var discountamount = (parseFloat(totalamount) - parseFloat(discount)) ;
         amountafterdiscount = parseFloat(totalamount) - parseFloat(discountamount);
         grandtotalamount = parseFloat(amountafterdiscount) + parseFloat(totalvatamount);
      //alert('total - '+totalamount);    alert('discountamount - '+ discountamount); alert('amountafterdiscount - '+amountafterdiscount); alert('totalvatamount - '+totalvatamount);
       amountafterdiscount=getNum(amountafterdiscount);
        grandtotalamount=getNum(grandtotalamount);
      $('#amountafterdiscount').val(amountafterdiscount.toFixed(2)); 
      $('#grandtotalamount').val(grandtotalamount.toFixed(2));
}



$(".vatamount").prop("readonly",true);

//$("#currency").select2({disabled:'readonly'});
 $(document.body).on("change", "#currency", function() 
    {
        var cid = $(this).val();
        
        $.ajax({
        url: "getcurrencydatavalue",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:cid
        },
        dataType: "json",
        success: function(data) {
          //  console.log(data);
            var termcondition ='';
          $.each(data, function(key, value) {
            
           cvalue =value.value;
                        });
          cvalue=getNum(cvalue);
          $('#currency_value').val(cvalue);

        }
    })
    });

   $(document).ready(function(){
        $(document).on('change','.Cust_category',function()
        {

            var cat_id=$(this).val();
         $.ajax({
             type:'POST',
             url:'getcategorycode',
             data:{
               _token: $('#token').val(),
               'id':cat_id
            },
             success:function(data){
               console.log(data);
                  $.each(data, function(key, value) {
                     $("#cust_code").val(value.Supplier_category+ '/'+value.increment);
                  });
             },
             error:function()
             {
             }
         });
          
      
        });
      });
   $(document).ready(function(){
        $(document).on('change','.newSupplier',function()
        {

            var Supplier = $(this).val();
            
            if(Supplier == 1)
            {
               $('#Supplier').val('').trigger('change');
               $('#Supplier').attr('disabled',true);
           $('#cust_category').prop("disabled", false);
           $('#cust_type').prop("disabled", false);
           $('#cust_group').prop("disabled", false);

           $('#cust_category').val('').trigger('change');
           $('#cust_type').val('').trigger('change');
           $('#cust_group').val('').trigger('change');
           $('#cust_name').val('');
           $('#cust_code').val('');
           $('#building_no').val('');
           $('#cust_region').val('');
           $('#cust_district').val('');
           $('#cust_city').val('');
           $('#cust_zip').val('');
           $('#mobile').val('');
           $('#vatno').val('');
           $('#buyerid_crno').val('');
           $("#cust_name").prop("readonly",false);
           $('#cust_code').prop("readonly",false);
           $('#building_no').prop("readonly",false);
           $('#cust_region').prop("readonly",false);
           $('#cust_district').prop("readonly",false);
           $('#cust_city').prop("readonly",false);
           $('#cust_zip').prop("readonly",false);
           $('#mobile').prop("readonly",false);
           $('#vatno').prop("readonly",false);
           $('#buyerid_crno').prop("readonly",false);
            }
            if(Supplier == 2)
            {
               $('#Supplier').attr('disabled',false);
           $('#cust_category').prop("disabled", true)
           $('#cust_type').prop("disabled", true);
           $('#cust_group').prop("disabled", true);
           $("#cust_type").select2({disabled:'readonly'}); 
           $("#cust_group").select2({disabled:'readonly'});             
           $("#cust_name").prop("readonly",true);
           $('#cust_code').prop("readonly",true);
           $('#building_no').prop("readonly",true);
           $('#cust_region').prop("readonly",true);
           $('#cust_district').prop("readonly",true);
           $('#cust_city').prop("readonly",true);
           $('#cust_zip').prop("readonly",true);
           $('#mobile').prop("readonly",true);
           $('#vatno').prop("readonly",true);
           $('#buyerid_crno').prop("readonly",true);

            }
            
          
      
        });
      });
   
</script>
        
   
   
</script>
<!-- <script src="{{url('/')}}/resources/js/sales/purchase.js" type="text/javascript"></script> -->
<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/enquiry.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
 <script src="{{url('/')}}/resources/js/inventory/purchaseproduct.js" type="text/javascript"></script>
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


$(document.body).on("keyup  change", ".rate", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   


$(document.body).on("keyup  change", ".amount", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   


$(document.body).on("keyup  change", ".discountamount", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   


$(document.body).on("keyup  change", ".vat_percentage", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   

$(document.body).on("keyup  change", ".vatamount", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   

$(document.body).on("keyup  change", ".row_total", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   

$(document.body).on("keyup  change", ".quantity", function() 
   {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
   });   

function getNum(val) {

   if (isNaN(val)||val == false||val ==null||val == undefined||val =="") {
     return 0;
   }
   return val;
}

 </script>


 

<!-- <script>
 $(document).ready(function() {
    $( ".head_name" ).autocomplete({
 
        source: function(request, response) {
            $.ajax({
            url: "{{url('autocomplete-search')}}",
            data: {
                    query : request.term
             },
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(obj){
                alert(obj.head_name);


                    return obj.head_name;
               }); 
 
               response(resp);
            },

        });
    },
    minLength: 2
 });
});
 
</script>   -->

  <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>

      <!-- Initialize typeahead.js on the input -->
    <script>
        $(document).ready(function() {
    /*      $(document.body).on("change", ".head_name", function() 
  {*/
          var bloodhound = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.whitespace,
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: {
            url: "{{url('boq_head/find?q=%QUERY%')}}",

            wildcard: '%QUERY%'
          },
        });

        $('.head_name').typeahead({
          hint: true,
          highlight: true,
          minLength: 2
        }, {
          name: 'product_name',
          source: bloodhound,

           display: function(data) {
            return data.product_name  //Input value to be set when you select a suggestion.
          },
      
    
          templates: {
            empty: [
              '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
            ],
            header: [
              '<div class="list-group search-results-dropdown">'
            ],
            suggestion: function(data) {
            return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.product_name + '</div></div>'
            }
          }
        });
          });


$(document).ready(function () {
    $('#newrow').click(function () {
      
 rowcount = $('#product_table tr').length;
           /* alert(rowcount);*/
         /*  if (data != null && data.length > 1) {
           }*/

          var product = '';
         product += '<tr>\
                 <td style="text-align: center;">'+rowcount+'</td><td>\
                 <input type="text" class="form-control head_name" name="head_name[]" id="head_name'+rowcount+'" data-id="'+rowcount+'" value="">\
                 </td>\
                 <td><textarea class="form-control" id="product_description'+rowcount+'" name="product_description[]" rows="1" data-id='+rowcount+' style=" height: 30px !important;"></textarea>\</td>\
                 <td>\
                 <select class="form-control form-control-sm single-select unit kt-selectpicker"  data-id="'+rowcount+'" name="unit[]" id="unit'+rowcount+'">\
                 <option value="">select</option>\
         @foreach($unitlist as $data)\
              <option value="{{$data->id}}">{{$data->unit_name}}</option>\
              @endforeach\
                 </select>\
                  </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                  <input type="text" class="form-control quantity"  data-id="'+rowcount+'" name="quantity[]" id="quantity'+rowcount+'" value="1">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control rate" name="rate[]" id="rate'+rowcount+'"  data-id="'+rowcount+'" value="0">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control amount" name="amount[]"  data-id="'+rowcount+'" id="amount'+rowcount+'" readonly value="0.00">\
                 </div>\
                 </td>\
                 <td>\
                 <input type="text" class="form-control discountamount"  data-id="'+rowcount+'" name="discountamount[]" id="discountamount'+rowcount+'" value="0">\
                </td>\ <td>\
    <select class="form-control form-control-sm single-select vat_percentage kt-selectpicker" data-id="'+rowcount+'" name="vat_percentage[]" id="vat_percentage'+rowcount+'">\
            <option value="">select</option>\
            @foreach($vatlist as $data)\
              <option value="{{$data->total}}">{{$data->total}}</option>\
              @endforeach\
</select>\
</td>\
                <td>\
                 <input type="text" class="form-control vatamount form-control-sm" name="vatamount[]" id="vatamount'+rowcount+'" data-id='+rowcount+' value="0"    readonly>\
                 </td>\
                  <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control row_total"  data-id="'+rowcount+'" name="row_total[]" id="row_total'+rowcount+'" readonly>\
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
                 $('.vat_percentage').trigger("change");

                
                 $('.head_name').typeahead('destroy');
                   var bloodhound = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.whitespace,
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: {
            url: "{{url('boq_head/find?q=%QUERY%')}}",

            wildcard: '%QUERY%'
          },
        });

        $('.head_name').typeahead({
          hint: true,
          highlight: true,
          minLength: 2
        }, {
          name: 'product_name',
          source: bloodhound,

           display: function(data) {
            return data.product_name  //Input value to be set when you select a suggestion.
          },
      
    
          templates: {
            empty: [
              '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
            ],
            header: [
              '<div class="list-group search-results-dropdown">'
            ],
            suggestion: function(data) {
            return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.product_name + '</div></div>'
            }
          }
        });
                // $("#unit"+rowcount).val(value.unit).change();
                //  $("#unitvalue"+rowcount).val(value.unit);


    });
});



$(document).ready(function(){
      $(document).on('change','.method',function()
      {

        var method = $(this).val();
        
        if(method == 1)
        {
          $('#paidamount').val(0);
          $('#paidamount').attr('readonly',true);

          $('#balanceamount').val(0);
          $('#balanceamount').attr('readonly',true);

                  
        }
        if(method == 2)
        {
          $('#paidamount').val('');
          $('#balanceamount').val('');

          $('#paidamount').attr('readonly',false);
          $('#balanceamount').attr('readonly',false);

        }
        
       
    
      });
    });
       


       $(document).ready(function(){
        $(document).on('change','#customer1',function()
        {

            var name = $(this).val();
           
         
                $.ajax({
                     url: "getsupplierdetails",
                     method: "POST",
                     data: {
                     _token: $('#token').val(),
                     id:name
                           },
                     dataType: "json",
                     success: function(data) {
                     console.log(data);
                    
                     $.each(data, function(key, value) {
                            $('#customer').val('');
                            $('#cust_category').val(value.sup_category);
                            $('#cust_type').val(value.sup_type);
                            $('#cust_name').val(value.sup_name);
                            $('#cust_code').val(value.sup_code);
                            $('#building_no').val(value.sup_add1);
                            $('#cust_region').val(value.sup_region);
                            $('#cust_district').val(value.sup_add2);
                            $('#cust_city').val(value.sup_city);
                            $('#cust_zip').val(value.sup_zip);
                            $('#mobile').val(value.mobile1);
                            $('#vatno').val(value.vat_no);
                            $('#buyerid_crno').val(value.cr_no);
                            $('#cust_country').val(value.cntry_name);

            });
           
            }
         });
        
            
      });

   });




$(document).on('change','.paidamount',function()
{
  var balance = 0;
  var grandtotalamount = $('#grandtotalamount').val();
  if(grandtotalamount!="")
  {
      var paidamount = $('#paidamount').val();
      if(parseFloat(paidamount) <= parseFloat(grandtotalamount))
      {
        balance = parseFloat(grandtotalamount) - parseFloat(paidamount);
      $('#balanceamount').val(balance);
      }
      else
      {
          toastr.warning("Incorrect Paidamount"); 
      $('#paidamount').val('');
        $('#balanceamount').val('');
        return false;


      }
    
  }
  else
  {
    $('#balanceamount').val('');
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

            var vatamounts = 0;
        $('.vatamount').each(function()
        {
            var id = $(this).attr('data-id');
            var vatamount = $('#vatamount'+id+'').val();
        
            vatamounts += parseFloat(vatamount);

        });
        $('#totalvatamount').val(vatamounts.toFixed(2));

        
        totalamount_calculate();
        discount_calculate();
final_calculate1();

   
}); 
    </script>
@endsection


