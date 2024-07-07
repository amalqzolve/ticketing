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
											History - Stock Transfer 
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
                                                <th>Transfer Qty</th>
                                                <th>Product Code</th>
                                                <th>SKU</th>
                                                

                                                 
                                                 
                                            </tr>
                                            </thead>
                                            <tbody >
                                            <tr></tr>

                                            @foreach($products1 as $key => $products)
                                     

                                            <tr>
                                            <td class="row_count" id="rowcount">{{$key + 1}}</td>

                                            <td>{{$products->productname}}
                                            </td>
                                                  <td>{{$products->stock_out_quantity}}
                                            </td>
                                              <td>{{$products->product_code}}
                                            </td>
                                              <td>{{$products->sku}}
                                            </td>
                                           
                                            
                                             
                                        </tr>
                                        
                                        @endforeach
                                      </tbody>
                                        </table>
                                       
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
            rack : rack
        },
        success: function(data) {
            
            console.log(data);
            // uppy.reset();
            toastr.success('Stock details added successfuly');
              $('#stock_submit').prop("disabled", false);
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


<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script> 
<script type="text/javascript">
    
    $('#product_tables').DataTable( {
    responsive: true
} );
</script>
@endsection
