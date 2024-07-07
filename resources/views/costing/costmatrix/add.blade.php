@extends('costing.common.layout')
@section('content')

<!-- <script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
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

               Cost Matrix

            </h3>
         </div>
      </div>
      <div class="kt-portlet__body">
         <form class="kt-form" id="id">
            <div class="row" style="padding-bottom: 6px;">

               <div class="col-lg-6">
                  <div class="form-group row pr-md-3">
                     <div class="col-md-4 pt-2">
                        <label style="white-space: nowrap;">Cost Matrix Name<span style="color: red">*</span></label>
                     </div>
                     <div class="col-md-8">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control" name="costmatrixname" id="costmatrixname" placeholder="Cost Matrix Name" autocomplete="off">
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-lg-6">
                  <div class="form-group row pr-md-3">
                     <div class="col-md-4 pt-2">
                        <label>{{ __('app.Note') }}</label>
                     </div>
                     <div class="col-md-8">
                        <div class="input-group input-group-sm">
                           <input type="text" class="form-control" name="description" id="description" placeholder="{{ __('app.Note') }}" autocomplete="off">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row" style="padding-bottom: 6px;">
               <div class=" pr-1 pl-1" style="width:100%">
                  <table class="table table-striped table-bordered table-hover" id="product_table" style="width:100%">
                     <thead class="thead-light">
                        <tr>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="25px">#</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="150px">Item Name</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Description')</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">@lang('app.Unit')</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px">@lang('app.Quantity')</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="90px">@lang('app.Rate')</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;" width="75px;">@lang('app.Amount')</th>
                           <th style="background-color:  #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important; " width="60px">@lang('app.Action')</th>
                        </tr>
                     </thead>
                     <br>
                     <tbody>
                        <tr>
                           <td style="text-align: center;">1</td>
                           <td>

                              <input type="text" class="form-control head_name" name="head_name[]" id="head_name1" style="height: 31px;">


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
                              <div class="input-group input-group-sm"> <input type="text" class="form-control quantity" data-id="1" name="quantity[]" id="quantity1" value="1"> </div>
                           </td>
                           <td>
                              <div class="input-group input-group-sm"> <input type="text" class="form-control rate" name="rate[]" id="rate1" data-id="1" value="0"> </div>
                           </td>
                           <td>
                              <div class="input-group input-group-sm"> <input type="text" class="form-control amount" name="amount[]" data-id="1" id="amount1" readonly="" value="0"> </div>
                           </td>
                           <td style="background-color: white;">
                              <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span> </div>
                           </td>
                        </tr>

                     </tbody>
                  </table>
                  <table style="width:100%">
                     <tr>
                        <td>
                           <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" id="newrow"><i class="la la-plus"></i>Line Item</button>
                        </td>
                     </tr>
                  </table>


               </div>
               <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0; margin-top: 0;">

            </div>
      </div>



      <div class="row mt-5">
         <div class="col-lg-5">
         </div>
         <div class="col-lg-7">
            <div class="form-group  row pr-md-3">
               <div class="col-md-4">
                  <label style="    font-size: 1.5rem;font-weight: bold; padding-top:4px">@lang('app.Total Amount')</label>
               </div>
               <div class="col-md-8 input-group-sm">
                  <input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem; font-weight: bold; color: #646c9a; padding-top: 0px;">
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
                  <button id="costmatrixsubmit" class="btn btn-primary float-right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    {{ __('product.Save') }}
                </button>
                  <button type="button" class="btn btn-secondary  mr-2" onclick="goPrev()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    {{ __('app.Cancel') }}
                </button>


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
<script src="{{url('/')}}/resources/js/sales/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/sales/select2.min.js" type="text/javascript"></script>
<!-- <script src="{{url('/')}}/resources/js/sales/enquiry.js" type="text/javascript"></script> -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>
<!-- <script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/resources/js/inventory/purchaseproduct.js" type="text/javascript"></script> -->
<script>
   $('.estimationSettings').addClass('kt-menu__item--open');
   $('.costmatrix').addClass('kt-menu__item--active');

   $(document).on('click', '#costmatrixsubmit', function(e) {
      e.preventDefault();
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
      $("input[name^='quantity[]']").each(function(input) {
         quantity.push($(this).val());
      });
      var rate = [];
      $("input[name^='rate[]']").each(function(input) {
         rate.push($(this).val());
      });
      var amount = [];
      $("input[name^='amount[]']").each(function(input) {
         amount.push($(this).val());
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
         url: "{{url('costmatrixsubmit')}}",
         dataType: "text",
         data: {
            _token: $('#token').val(),
            grandtotalamount: $('#grandtotalamount').val(),
            costmatrixname: $('#costmatrixname').val(),
            description: $('#description').val(),
            head_name: head_name,
            product_description: product_description,
            unit: unit,
            quantity: quantity,
            rate: rate,
            amount: amount,
         },
         success: function(data) {
            if (data == 'false') {
               $('#costmatrixsubmit').removeClass('kt-spinner');
               $('#costmatrixsubmit').prop("disabled", false);
               toastr.warning('Cost Matrix name already exist');
            } else {
               $('#costmatrixsubmit').removeClass('kt-spinner');
               $('#costmatrixsubmit').prop("disabled", false);
               toastr.success('Cost Matrix ' + sucess_msg + ' successfuly');
               window.location.href = document.referrer;
            }
         },
         error: function(jqXhr, json, errorThrown) {
            console.log('Error !!');
         }
      });
   });



   $('body').on('change', '.quantity', function() {
      var id = $(this).attr('data-id');
      row_calculate(id);
   });
   $('body').on('change', '.rate', function() {
      var id = $(this).attr('data-id');
      row_calculate(id);
   });



   function row_calculate(id) {
      var quantity = $('#quantity' + id + '').val();
      var rate = $('#rate' + id + '').val();
      var total = parseFloat(quantity * rate);
      total = getNum(total);
      $('#amount' + id + '').val(total.toFixed(2));
      totalamount_calculate();
      final_calculate1();
   }

   function totalamount_calculate() {
      var totalamount = 0;
      $('.amount').each(function() {
         var id = $(this).attr('data-id');
         var amount = $('#amount' + id + '').val();
         totalamount += parseFloat(amount);
      });
      totalamount = getNum(totalamount);
      $('#totalamount').val(totalamount.toFixed(2));
   }

   function final_calculate1() {
      var grandtotalamount = 0;
      $('.amount').each(function() {
         var id = $(this).attr('data-id');
         var amount = $(this).val();
         grandtotalamount += parseFloat(amount);
      });
      $('#grandtotalamount').val(grandtotalamount.toFixed(2));
   }
</script>



</script>


<script type="text/javascript">
   const channel = new BroadcastChannel("inventory");
   channel.addEventListener("message", e => {
      if (e.data == 'success') {
         product_list_table.ajax.reload();
      }
   });


   $(document.body).on("keyup  change", ".rate", function() {
      var $this = $(this);
      $this.val($this.val().replace(/[^\d.]/g, ''));
   });


   $(document.body).on("keyup  change", ".amount", function() {
      var $this = $(this);
      $this.val($this.val().replace(/[^\d.]/g, ''));
   });

   $(document.body).on("keyup  change", ".quantity", function() {
      var $this = $(this);
      $this.val($this.val().replace(/[^\d.]/g, ''));
   });

   function getNum(val) {
      if (isNaN(val) || val == false || val == null || val == undefined || val == "") {
         return 0;
      }
      return val;
   }
</script>


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
            url: "{{url('costmatrix_head/find?q=%QUERY%')}}",

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


   $(document).ready(function() {
      $('#newrow').click(function() {

         rowcount = $('#product_table tr').length;
         var product = '';
         product += '<tr>\
                 <td style="text-align: center;">' + rowcount + '</td><td>\
                 <input type="text" class="form-control head_name" name="head_name[]" id="head_name' + rowcount + '" data-id="' + rowcount + '" value="" style="height:31px;">\
                 </td>\
                 <td><textarea class="form-control" id="product_description' + rowcount + '" name="product_description[]" rows="1" data-id=' + rowcount + ' style=" height: 30px !important;"></textarea>\</td>\
                 <td>\
                 <select class="form-control form-control-sm single-select unit kt-selectpicker"  data-id="' + rowcount + '" name="unit[]" id="unit' + rowcount + '">\
                 <option value="">select</option>\
         @foreach($unitlist as $data)\
              <option value="{{$data->id}}">{{$data->unit_name}}</option>\
              @endforeach\
                 </select>\
                  </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                  <input type="text" class="form-control quantity"  data-id="' + rowcount + '" name="quantity[]" id="quantity' + rowcount + '" value="1">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control rate" name="rate[]" id="rate' + rowcount + '"  data-id="' + rowcount + '" value="0">\
                 </div>\
                 </td>\
                 <td>\
                 <div class="input-group input-group-sm">\
                 <input type="text" class="form-control amount" name="amount[]"  data-id="' + rowcount + '" id="amount' + rowcount + '" readonly value="0.00">\
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
   });

   $("body").on("click", ".remove", function(event) {
      event.preventDefault();
      var row = $(this).closest('tr');
      var siblings = row.siblings();
      row.remove();
      siblings.each(function(index) {
         $(this).children().first().text(index + 1);
      });
      totalamount_calculate();
      final_calculate1();
   });
</script>
@endsection
