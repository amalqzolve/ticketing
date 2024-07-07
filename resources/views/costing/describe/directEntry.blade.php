@extends('costing.common.layout')
@section('content')

<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />



<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
   <br />
   <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
         <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
               <i class="kt-font-brand flaticon-home-2"></i>
            </span>
            <h3 class="kt-portlet__head-title">
               Direct Price Analysis
            </h3>
         </div>
      </div>
      <div class="kt-portlet__body">
         <form class="kt-form" id="dataForm">
            <div class="row" style="padding-bottom: 6px;">
               <div class=" pr-1 pl-1" style="">

                  <table class="table table-striped table-bordered table-hover" id="product_table" style="width:100%">
                     <thead class="thead-light">
                        <tr>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="25px">#</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">BOQ Ref</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">Item Name</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="350px">@lang('app.Description')</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px">@lang('app.Quantity')</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="200px">Rate</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="200px">Amount</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="200px">Detailed Estimation</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="200px">Total Estimation</th>
                        </tr>
                     </thead>
                     <br>
                     <tbody>
                        @php
                        $total=0;
                        @endphp
                        @if(count($items)!=0)
                        @foreach ($items as $key => $item)
                        <tr>
                           <?php $key = $key + 1; ?>
                           <td style="text-align: center;">{{$key}}</td>
                           <td>
                              {{$item->ref}}
                           </td>
                           <td>
                              {{$item->category_name}}
                              <input type="hidden" name="head_id[]" id="head_id{{$item->id}}" data-id="id" value="{{$item->id}}">
                           </td>
                           <td>
                              {{$item->description}}
                           </td>
                           <td>
                              <div class="input-group input-group-sm"> <input type="text" class="form-control quantity" data-id="quantity" name="quantity[]" value="{{$item->quantity}}" readonly> </div>
                           </td>
                           <td>
                              <div class="input-group input-group-sm"> <input type="text" class="form-control integerVal rate" data-id="rate" name="rate[]" value="{{($item->rate=='')?0:$item->rate}}"> </div>
                           </td>
                           <td>
                              <div class="input-group input-group-sm"> <input type="text" class="form-control  amount" data-id="amount" name="amount[]" value="{{$item->amount}}" readonly> </div>
                           </td>
                           <td>
                              <div class="input-group input-group-sm"> <input type="text" class="form-control" data-id="estimation_amount" name="estimation_amount[]" value="{{$item->estimation_amount}}" readonly> </div>
                           </td>
                           <td>
                              <div class="input-group input-group-sm"> <input type="text" class="form-control total_amount" data-id="total_amount" name="total_amount[]" value="{{$item->amount + $item->estimation_amount}}" readonly> </div>
                           </td>
                        </tr>
                        @php
                        $total+= $item->amount + $item->estimation_amount;
                        @endphp
                        @endforeach
                        @else
                        <tr>
                           <td colspan="6">
                              <center>
                                 <h6>No Line items Found</h6>
                              </center>
                           </td>
                        </tr>
                        @endif

                     </tbody>
                  </table>
                  <table style="width:100%">
                     <tr>
                        <td>
                           <div class="float-right"><b>Total </b> <input type="text" class="form-control" name="total" id="total" value="{{$total}}"></div>
                           <!-- <button type="button" class="btn btn-primary btn-sm addproduct float-right">Add New</button>&nbsp; &nbsp; &nbsp; &nbsp; -->
                        </td>

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
            <input type="hidden" name="parent_id" id="parent_id" value="{{$parent_id}}">
         </form>
      </div>
      <div class="kt-portlet__foot">
         <div class="kt-form__actions">
            <div class="row">
               <div class="col-lg-6">
               </div>
               <div class="col-lg-6 kt-align-right">
                  <button id="updateBoq" class="btn btn-primary">{{ __('product.Save') }}</button>
                  <button type="button" class="btn btn-secondary float-right mr-2 backHome">{{ __('app.Cancel') }}</button>


               </div>
            </div>
         </div>
      </div>

   </div>
</div>
</div>
@endsection

@section('script')
<script>
   $('.cost-estimation').addClass('kt-menu__item--active');

   $("body").on("keyup", ".rate", function(event) {

      var tr = $(this).closest("tr");
      var quantity, rate, amount, estimation_amount, total_amount;
      tr.find("input").each(function() {
         var attrValue = $(this).attr('data-id');


         if (attrValue == 'quantity') {
            quantity = parseInt(($(this).val() == '') ? 0 : $(this).val());
         }
         if (attrValue == 'rate') {
            rate = parseFloat(($(this).val() == '') ? 0 : $(this).val());
         }
         if (attrValue == 'amount') {
            amount = quantity * rate;
            $(this).val(amount.toFixed(2));
         }
         if (attrValue == 'estimation_amount') {
            estimation_amount = parseFloat(($(this).val() == '') ? 0 : $(this).val());
         }
         if (attrValue == 'total_amount') {
            total_amount = amount + estimation_amount;
            total_amount = $(this).val(total_amount.toFixed(2));
         }

      });
      calculateGrandTotal();
   });

   function calculateGrandTotal() {
      var totalAmount = 0;
      $("input[name='total_amount[]']").each(function(key, valueText) {
         totalAmount += parseFloat($(this).val());
      });
      $('#total').val(totalAmount);
   }


   $(document).on('click', '#updateBoq', function(e) {
      e.preventDefault();
      $.ajax({
         type: "POST",
         url: "{{url('direct-cost-estimation-save')}}",
         dataType: "json",
         data: $('#dataForm').serialize() + "&_token=" + $('#token').val(),
         success: function(data) {
            if (data.status == 1) {
               $('#updateBoq').removeClass('kt-spinner');
               $('#updateBoq').prop("disabled", false);
               toastr.success('Savedsuccessfuly');
            } else
               toastr.error('Error While Save');
         },
         error: function(jqXhr, json, errorThrown) {
            toastr.error('Error !!');
         }
      });
   });
</script>





@endsection