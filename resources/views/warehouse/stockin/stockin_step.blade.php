@extends('warehouse.common.layout')

@section('content')
<style type="text/css">
  .btn
  {
         padding: 0.25rem 0.45rem !important;
  }
</style>
    
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
											New Stock IN 
										</h3>
									</div>
									
								</div>

								<div class="kt-portlet__body">

                                <form class="kt-form" id="kt_form">
                                
                               
                                 <div class="row" style="padding-bottom: 6px;">
                                    <div class="col-lg-12">
                                    <div class="form-group row pl-md-3">
                                        <table class="table table-bordered" id="product_tables">
                                            <thead class="thead-light">
                                            <tr>
                                                 <th>@lang('app.S.No')</th>
                                                 <th>@lang('app.Product Name')</th>
                                                 <th>@lang('app.Quantity')</th>
                                                 <th>Store</th>
                                                 <th>Rack</th>
                                                 
                                                 
                                            </tr>
                                            </thead>
                                            <tbody >
                                            <tr></tr>

                                            @foreach($purchase_products as $key => $products)
                                     

                                            <tr>
                                            <td class="row_count" id="rowcount">{{$key + 1}}</td>

                                            <td><input type="text" class="form-control pname"name="pname[]" id="pname" value="{{$products->product_name}}" data-id="{{$key + 1}}" readonly><input type="hidden" class="form-control pnameid"name="pnameid[]" id="pnameid" value="{{$products->product_id}}" data-id="{{$key + 1}}">
    

    <input type="hidden" class="form-control purchaseid"name="purchaseid[]" id="purchaseid" value="{{$products->purchaseid}}" data-id="{{$key + 1}}">


<input type="hidden" class="form-control amount"name="amount[]" id="amount" value="{{$products->amount}}" data-id="{{$key + 1}}">

<input type="hidden" class="form-control vat_amount"name="vat_amount[]" id="vat_amount" value="{{$products->vat_amount}}" data-id="{{$key + 1}}">

<input type="hidden" class="form-control row_total"name="row_total[]" id="row_total" value="{{$products->row_total}}" data-id="{{$key + 1}}">






                                            </td>
                                            
                                            <td><input type="text" class="form-control" name="quantity[]" id="quantity{{$key + 1}}" value="{{$products->available_stock}}"> </td> 
                                            
                      <td>
                      <select class="form-control single-select store" name="store[]" id="store{{$key + 1}}" data-id='{{$key + 1}}'>
                      <option value="">Select</option>
                      @foreach($storelist as $data)

                        <option value="{{$data->id}}">{{$data-> store_name}}</option>
                      @endforeach
                      </select>
                      </td>
                        <td>
                      <select class="form-control single-select rack" name="rack[]" id="rack{{$key + 1}}" data-id='{{$key + 1}}'>
                      <option value="">Select</option>\
                      </select>
                      </td>


                                            
                                             
                                        </tr>
                                        
                                        @endforeach
                                      </tbody>
                                        </table>
                                       
                                    </div>
                                </div>
                                  </div>
                                



                       <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                          <div class="row">
                            <div class="col-lg-6">
                              
                            </div>
                            <div class="col-lg-6 kt-align-right">
                              <button type="reset" class="btn btn-primary btn-icon-sm" id="stock_submit4">@lang('app.Save')</button>
                              <button type="reset" class="btn btn-secondary btn-icon-sm" 
                              onclick="">@lang('app.Cancel')</button>
                            </div>
                          </div>
                        </div>
                      </div>
                                </form>
                                


								</div>
							</div>
						</div>




    <!--begin::Modal-->
                           
                            <!--end::Modal-->


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

$(document.body).on("change", ".store", function() 
    {
        var store = $(this).val();
        var cc = $(this).attr('data-id');
        $.ajax({
        url: "getrackname1",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:store
        },
        dataType: "json",
          success: function(data) {
            console.log(data);
            $('#rack'+cc+'').empty();
            $('#rack'+cc+'').append('<option value="">select</option>');
            $.each(data, function(key, value) {
                        $('#rack'+cc+'').append('<option value="'+ value.id +'">'+ value.rack_name +'</option>');
                        });

        }
    })
    });


</script>
<script type="text/javascript">
  

$(document).on('click', '#stock_submit4', function(e) {
    e.preventDefault();


    var pname = [];

    $("input[name^='pname[]']")
        .each(function(input) {
            pname.push($(this).val());
        });

 

        var pnameid = [];

    $("input[name^='pnameid[]']")
        .each(function(input) {
            pnameid.push($(this).val());
        });

       

    var quantity = [];

    $("input[name^='quantity[]']")
        .each(function(input) {
            quantity.push($(this).val());
        });

    

  
    var store = [];

    $("select[name^='store[]']")
        .each(function(input) {
            store.push($(this).val());
        });

    var rack = [];

    $("select[name^='rack[]']")
        .each(function(input) {
            rack.push($(this).val());
        });

  

        var purchase = [];

         $("input[name^='purchaseid[]']")
        .each(function(input) {
            purchase.push($(this).val());
        });





        var amount = [];

         $("input[name^='amount[]']")
        .each(function(input) {
            amount.push($(this).val());
        });



        var vat_amount = [];

         $("input[name^='vat_amount[]']")
        .each(function(input) {
            vat_amount.push($(this).val());
        });



        var row_total = [];

         $("input[name^='row_total[]']")
        .each(function(input) {
            row_total.push($(this).val());
        });
  $('#stock_submit4').prop("disabled", true);

    $.ajax({
        type: "POST",
        url: "newstockin_submit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            pname : pname,
            pnameid : pnameid,
            quantity : quantity,
            store: store,
            rack : rack,
            purchase:purchase,
            amount:amount,
            vat_amount:vat_amount,
            row_total:row_total
        },
        success: function(data) {
            
            console.log(data);
            // uppy.reset();
            toastr.success('Stock details added successfuly');
              $('#stock_submit4').prop("disabled", false);
            window.location.href = "stockin";
        },
        error: function(jqXhr, json, errorThrown) {
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors, function(key, value) {
                if (jQuery.isPlainObject(value)) {

                    $.each(value, function(index, ndata) {
                        errorsHtml += '<li>' + ndata + '</li>';
                    });

                } else {

                    errorsHtml += '<li>' + value + '</li>';

                }
            });
            toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
        }
    });


    return false;


});
</script>
@endsection
