@extends('warehouse.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
<?php
foreach($salesmaster as $salesmasters)
{
  $quantity = $salesmasters->available_stock;
$selling_price = $salesmasters->selling_price;
$costpercentage = $salesmasters->costpercentage;
$profit = $salesmasters->profit;
$rate = $salesmasters->rate;
$landing = $salesmasters->landing;
$margin = $salesmasters->margin;
$purchase_price = $salesmasters->purchase_price;
}

?>
              <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                  <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                      <i class="kt-font-brand flaticon-home-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                      Sales Master
                    </h3>
                  </div>
                </div>
                <div class="kt-portlet__body">
                                <form class="kt-form" id="kt_form">
                                 <div class="row" style="padding-bottom: 6px;">
                                    
                                   
                                    <!-- <div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>Quantity</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="quantity" placeholder="" id="quantity" value="{{$quantity}}">
                                    </div>
                                    </div>
                                    </div> -->
                                    <!-- <div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>Rate</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="rate" placeholder="" id="rate" value="{{$rate}}">
                                    </div>
                                    </div>
                                    </div> -->
                                   
                                    <div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>Purchase Price</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="purchase_price" placeholder="" id="purchase_price" value="{{$purchase_price}}">
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>Cost %</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control costpercentage" name="costpercentage" placeholder="" id="costpercentage" value="{{$costpercentage}}">
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>Landed Cost</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="landedcost" placeholder="" id="landedcost" value="{{$landing}}">
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>Markup %</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="markup" placeholder="" id="markup" value="{{$margin}}">
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>Selling Price</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="selling_price" placeholder="" id="selling_price" value="{{$selling_price}}">
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <div class="form-group row pl-md-3">
                                    <div class="col-md-4">
                                    <label>Profit</label>
                                    </div>  
                                    <div class="col-md-8 input-group input-group-sm">
                                    <input type="text" class="form-control" name="profit" placeholder="" id="profit" value="{{$profit}}">
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
                              <button type="submit" name="vatgroup_submit" id="vatgroup_submit" class="btn btn-primary">Save</button>
                              <button type="reset" class="btn btn-secondary cancel" onclick="vatgroup()">Cancel</button>
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
    $(document).ready(function() {
    $('.kt-select2').select2();
});
</script>


</script>
<script type="text/javascript">
    function vatgroup()
{
    window.location.href="salesmaster";
}
</script>

<script type="text/javascript">
   $('body').on('change', '.costpercentage', function() {
     var id = $(this).attr('data-id');
 var total_costm =$('#total_costm').val();
 var costper = $(this).val();

 if(costper<0){
 $(this).val(0);
}
if(!costper){
$(this).val(0);
}

var ac_price = $('#actual_price'+id+'').val();
var total_costm1=$('#total_costm').val();

if(total_costm1<0){
 total_costm1=0;
}
if(!total_costm1){
total_costm1=0;
}


 var row_costamount =(costper / 100) * total_costm1;
 var lprice=parseFloat(row_costamount)+parseFloat(ac_price);
$('#landing'+id+'').val(parseFloat(lprice).toFixed(2));

    });

$('body').on('change', '.margin', function() {
     var id = $(this).attr('data-id');
 var total_landm = $('#landing'+id+'').val();
 var markper = $(this).val();

 if(markper<0){
 $(this).val(0);
}
if(!markper){
$(this).val(0);
}



 var row_markamount =(total_landm / 100) * markper;
 var ac_price = $('#landing'+id+'').val();
  $('#sales_price'+id+'').val(parseFloat((row_markamount)+parseFloat(ac_price)).toFixed(2));
var ppfit=parseFloat((row_markamount)+parseFloat(ac_price));
var prfit=parseFloat(ppfit)-parseFloat(ac_price);
     $('#profit'+id+'').val(parseFloat(prfit).toFixed(2));


//$('#profit'+id+'').val(parseFloat(row_markamount).toFixed(2));

    });
   
</script>

<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>

<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>

<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<!-- <script src="{{url('/')}}/resources/js/sales/rack.js" type="text/javascript"></script> -->
<!-- <script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
 -->
<script src="{{url('/')}}/resources/js/sales/vatgroup.js" type="text/javascript"></script>
 
 @endsection
