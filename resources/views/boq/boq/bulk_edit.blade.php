@extends('boq.common.layout')
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
   .tt-menu {
      width: auto ! important;
      font-weight: normal;

   }
</style>
<style>
   .inputpicker-overflow-hidden {
      overflow: hidden;
      width: 100%;
   }

   .inputpicker-div>.inputpicker-input {
      font-size: 11px;
   }

   .inputpicker-arrow {
      top: 8px;
   }

   div.new1 {
      background-color: #f2f3f8;
      height: 20px;
      width: 100%;
      right: -36px;
      position: absolute;
      display: block;
   }

   .table>tbody>tr>td,
   .table>tbody>tr>th,
   .table>tfoot>tr>td,
   .table>tfoot>tr>th,
   .table>thead>tr>td,
   .table>thead>tr>th {
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

   .uppy-size--md .uppy-Dashboard-inner {
      width: 100%;
      height: 550px;
   }

   .table-bordered th,
   .table-bordered td {
      border: 0px solid #ebedf2;
      padding: 0px !important;
   }

   .nav-tabs {
      border-bottom: 0px;
   }

   .nav-tabs .nav-link {
      border: 3px solid transparent;
   }

   .nav-tabs .nav-link:hover,
   .nav-tabs .nav-link:focus {
      border-color: #f8fcff #fefeff #979fa8;
   }

   .nav-tabs .nav-link.active,
   .nav-tabs .nav-item.show .nav-link {
      border-color: #ffffff #ffffff #2275d7;
   }

   .mbtn {
      background-color: white;
      color: #74788d;

   }

   .mbtn:hover {
      color: #ffffff;
      background: #5d78ff;
      border-color: #5d78ff;

   }

   .mbdg1 {
      background: #fff;
      color: #a1a3a5;
   }

   .mbdg1:hover {
      background: #0ABB87;
      color: #fff;
   }

   .mbdg2 {
      background: #fff;
      color: #a1a3a5;
   }

   .mbdg2:hover {
      background: #FD397A;
      color: #fff;
   }

   .dataTables_wrapper .dataTable .selected th,
   .dataTables_wrapper .dataTable .selected td {
      background-color: #f4e92b !important;
      /* color: #595d6e; */
   }

   #productdetails_list_wrapper {
      height: 300px;
      overflow-y: scroll;
   }
</style>


<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
   <br />
   <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
         <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
               <i class="kt-font-brand flaticon-home-2"></i>
            </span>
            <h3 class="kt-portlet__head-title">

               Bulk Edit

            </h3>
         </div>
      </div>
      <div class="kt-portlet__body">
         <form class="kt-form" id="id">
            <div class="row" style="padding-bottom: 6px;">
               <div class=" pr-1 pl-1" style="">

                  <table class="table table-striped table-bordered table-hover" id="product_table" style="width:100%">
                     <thead class="thead-light">
                        <tr>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="25px">#</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">BOQ Ref</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="250px">Item Name</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="350px">@lang('app.Description')</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="350px">@lang('app.Unit')</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px">@lang('app.Quantity')</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                        </tr>
                     </thead>
                     <br>
                     <tbody>
                        @foreach ($items as $key => $item)
                        <tr>
                           <?php $key = $key + 1; ?>
                           <td style="text-align: center;">{{$key}}</td>
                           <td>
                              <input type="text" class="form-control ref" name="ref[]" id="ref" value="{{$item->ref}}">
                           </td>
                           <td>
                              <input type="text" class="form-control head_name" name="head_name[]" id="head_name1" value="{{$item->category_name}}">
                              <input type="hidden" name="head_id[]" id="head_id{{$item->id}}" data-id="{{$item->id}}" value="{{$item->id}}">
                           </td>
                           <td>
                              <textarea class="form-control" id="product_description{{$key}}" name="product_description[]" rows="1" data-id="{{$key}}" style=" height: 30px !important;">{{$item->description}}</textarea>
                           </td>
                           <td>
                              <div>
                                 <select class="form-control form-control-sm single-select unit kt-selectpicker" data-id="{{$key}}" name="unit[]" id="unit{{$key}}">
                                    <option value="">select</option>
                                    @foreach($unitlist as $data)
                                    <option value="{{$data->id}}" {{($data->id == $item->unit)?"selected":''}}> {{$data->unit_name}} </option>
                                    @endforeach
                                 </select>
                              </div>


                           </td>
                           <td>
                              <div class="input-group input-group-sm"> <input type="text" class="form-control quantity" data-id="{{$key}}" name="quantity[]" id="quantity{{$key}}" value="{{$item->quantity}}"> </div>
                           </td>

                           <td style="background-color: white;">
                              <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span> </div>
                           </td>
                        </tr>
                        @endforeach

                     </tbody>
                  </table>
                  <table style="width:100%">
                     <tr>
                        <td>
                           <!-- <button type="button" class="btn btn-primary btn-sm addproduct">Add New</button>&nbsp; &nbsp; &nbsp; &nbsp;</td> -->
                           <!--   <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" id="newrow" ><i class="la la-plus"></i>Line Iteam</button> -->
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

      <input type="hidden" name="parent_child" id="parent_child" value="{{$parent_child}}">
      <input type="hidden" name="edit_ids" id="edit_ids" value="{{$edit_ids}}">
      <div class="kt-portlet__foot">
         <div class="kt-form__actions">
            <div class="row">
               <div class="col-lg-6">
               </div>
               <div class="col-lg-6 kt-align-right">
                  <button id="innerboqupdatebulk" class="btn btn-primary">{{ __('product.Save') }}</button>
                  <button type="button" class="btn btn-secondary float-right mr-2 backHome">{{ __('app.Cancel') }}</button>


               </div>
            </div>
         </div>
      </div>
      </form>
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
@endsection

@section('script')
<script>
   $('.list-boq').addClass('kt-menu__item--active');
   $(document).on('click', '#innerboqupdatebulk', function(e) {
      e.preventDefault();
      parent = $('#parent').val();
      var head_id = [];
      $("input[name^='head_id[]']").each(function(input) {
         head_id.push($(this).val());
      });



      var head_name = [];
      $("input[name^='head_name[]']").each(function(input) {
         head_name.push($(this).val());
      });




      var product_description = [];
      $("textarea[name^='product_description[]']").each(function(input) {
         product_description.push($(this).val());
      });
      var unit = [];
      $("select[name^='unit[]']").each(function(input) {
         unit.push($(this).val());
      });

      var quantity = [];

      $("input[name^='quantity[]']")
         .each(function(input) {
            quantity.push($(this).val());
         });

      var ref = [];
      $("input[name^='ref[]']").each(function(input) {
         ref.push($(this).val());
      });
      $(this).addClass('kt-spinner');
      $(this).prop("disabled", true);
      if ($('#id').val()) {
         var sucess_msg = 'Updated';
      } else {
         var sucess_msg = 'Created';
      }
      $.ajax({
         type: "POST",
         //url: "innerboqupdatebulk",
         url: "{{url('innerboqupdatebulk')}}",
         dataType: "text",
         data: {
            _token: $('#token').val(),
            totalamount: $('#totalamount').val(),
            discount: $('#discount').val(),
            amountafterdiscount: $('#amountafterdiscount').val(),
            totalvatamount: $('#totalvatamount').val(),
            grandtotalamount: $('#grandtotalamount').val(),
            paidamount: $('#paidamount').val(),
            balanceamount: $('#balanceamount').val(),
            ref: ref,
            head_name: head_name,
            head_id: head_id,
            product_description: product_description,
            unit: unit,
            quantity: quantity,
            // rate: rate,
            // amount: amount,
            // vat_percentage: vat_percentage,
            // vatamount: vatamount,
            // rdiscount: rdiscount,
            // row_total: row_total,
            edit_ids: $('#edit_ids').val(),
            parent_child: $('#parent_child').val(),
         },
         success: function(data) {
            $('#innerboqupdatebulk').removeClass('kt-spinner');
            $('#innerboqupdatebulk').prop("disabled", false);
            toastr.success('Line Item ' + sucess_msg + ' successfuly');
            window.location.href = document.referrer;
         },
         error: function(jqXhr, json, errorThrown) {
            console.log('Error !!');
         }
      });
   });
</script>



</script>
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>
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
      if (e.data == 'success') {
         product_list_table.ajax.reload();
      }
   });
</script>

<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>

<!-- Initialize typeahead.js on the input -->
<script>
   $(document).ready(function() {
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
            return data.product_name //Input value to be set when you select a suggestion.
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
</script>
@endsection