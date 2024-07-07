@extends('costing.common.layout')
@section('content')
<style>
   .dataTables_wrapper .dataTable .selected th,
   .dataTables_wrapper .dataTable .selected td {
      background-color: #f4e92b !important;
      /* color: #595d6e; */
   }
</style>

<!-- models -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Cost Matrix</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <table class="table table-striped table-hover table-checkable dataTable no-footer" id="costMatrixTbl">
               <thead>
                  <tr>
                     <th>{{ __('product.S.No') }}</th>
                     <th>Cost Matrix Name</th>
                     <th>Description</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btnAdd">Add</button>
         </div>
      </div>
   </div>
</div>
<!-- ./models -->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
   <br />
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
         <form class="kt-form" id="dataForm">
            <input type="hidden" name="boq_id" id="boq_id" value="{{$data->id}}">
            <div class="row" style="padding-bottom: 6px;">
               <!--  -->
               <div class="row mt-5">
                  <div class="col-lg-6">
                     <div class="form-group  row pr-md-3">
                        <div class="col-md-4">
                           <label>Item Name</label>
                        </div>
                        <div class="col-md-8 input-group-sm">
                           <input type="text" class="form-control" name="totalamount" id="totalamount" readonly="" style="font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$data->category_name}}">
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group  row pr-md-3">
                        <div class="col-md-4">
                           <label>@lang('app.Description')</label>
                        </div>
                        <div class="col-md-8 input-group-sm">
                           <input type="text" class="form-control discount" name="discount" id="discount" readonly="" style="font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$data->description}}">
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group  row pr-md-3">
                        <div class="col-md-4">
                           <label>@lang('app.Unit')</label>
                        </div>
                        <div class="col-md-8 input-group-sm">
                           <input type="text" class="form-control" name="unit_name" id="unit_name" readonly="" style="font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$data->unit_name}}">
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group  row pr-md-3">
                        <div class="col-md-4">
                           <label>@lang('app.Quantity')</label>
                        </div>
                        <div class="col-md-8 input-group-sm">
                           <input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly="" style="font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);" value="{{$data->quantity}}">
                        </div>
                     </div>
                  </div>
                 
                  <br>
                  <div class="col-lg-6">
                     <div class="form-group  row pr-md-3">
                        <div class="col-md-4">
                           <label style=" font-size: 1.5rem;  font-weight: bold; padding-top:4px">@lang('app.Amount')</label>
                        </div>
                        <div class="col-md-8 input-group-sm">
                           <input type="text" class="form-control" name="grandtotalamount" id="grandtotalamount" readonly="" style="background-color: #ffffff00;  border: none;  text-align: right;  font-size: 1.75rem; font-weight: bold; color: #646c9a; padding-top: 0px;" value="{{$data->totalamount}}">
                        </div>
                     </div>
                  </div>

               </div>
               <!-- ./ -->

               <table style="width:100%">
                  <tr>
                     <td>
                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="la la-plus"></i>Cost Matrix</button>
                        <br>
                     </td>
                  </tr>
               </table>
            </div>
            <div class="appendDiv">
            </div>
      </div>


      <div class="kt-portlet__foot">
         <div class="kt-form__actions">
            <div class="row">
               <div class="col-lg-6">
               </div>
               <div class="col-lg-6 kt-align-right">
                  <button type="button" id="saveBtn" class="btn btn-primary">{{ __('product.Save') }}</button>&nbsp;
                  <button type="button" class="btn btn-secondary float-right mr-2 backHome">{{ __('app.Cancel') }}</button>
               </div>
            </div>
         </div>
      </div>
      </form>
   </div>
</div>
</div>
@endsection

@section('script')
<script src="{{url('/')}}/resources/js/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--begin::Page Vendors(used by this page) -->
<script src="{{ URL::asset('assets') }}/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<!-- Initialize typeahead.js on the input -->
<script>
   // '<div class="kt-demo-icon__preview deleteCol" style="width: fit-content;    margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="' + tableId + '" style="padding:0; cursor: pointer;"></i></span> </div><br>' + drpText
   $('.cost-estimation').addClass('kt-menu__item--active');

   $('body').on('click', '.addColumn', function() {
      var curId = $(this).attr('id');
      var drpId = 'selectCat' + curId;
      var drpVal = $("#" + drpId + " option:selected").val();

      var error = 0;
      $("[name='currentCat" + curId + "[]']").each(function() {
         if (drpVal == $(this).val())
            error++
      });
      if (error) {
         toastr.warning('This Cost Contingency Already added');
         return 0;
      }
      if (drpVal != '') {
         var drpText = $("#" + drpId + " option:selected").text();
         var myArray = drpText.split(" (");
         var percentage = myArray[1].split("%)");
         $("#" + drpId).removeClass('is-invalid');

         var tableId = 'tempalteTbl' + curId;
         var tableId = 'tempalteTbl' + curId;
         var colCount = $('#' + tableId).find("tr:first td").length;
         $('#' + tableId).find('td').eq(colCount - 3).after('<td><span class="deleteCol float-right" style="padding:0; cursor: pointer; color: red;" >Delete</span><input type="text" name="currentCat' + curId + '[]" value="' + drpVal + '"></br>' + drpText + '</td>');
         $('#' + tableId + ' tbody tr').each(function() {
            $(this).find('td').eq(colCount - 3).after('<td><div class="input-group input-group-sm"> <input type="text" class="form-control valChanged" data-id="percentage" name="percenatge' + curId + '' + drpVal + '[]" value="' + percentage[0] + '"> <input type="text" class="form-control " data-id="percentageAmount" style="background-color: #f2f3f8;" readonly name="percenatge_amount' + curId + '' + drpVal + '[]"> </div></td>');
         });
         $("#" + drpId).val('');
      } else {
         toastr.warning('Please Select A Cost Contingency');
         $("#" + drpId).addClass('is-invalid');
      }
      var tableId = 'tempalteTbl' + curId;
      tableReload(tableId);
   });

   $('body').on('click', '.addRow', function() {
      var tableId = 'tempalteTbl' + $(this).attr('id');
      var tableLastRow = $('#' + tableId + ' tbody tr:last').clone();

      tableLastRow.children('td').each(function(index, td) {
         if (index == 0) {
            $(this).text('ddd');
         }
         $(this).find("textarea").val('');
         $(this).find("select").val('');
         $(this).find("input").each(function() {
            $(this).val('');
            var attrValue = $(this).attr('data-id');
            if (attrValue == 'qty')
               $(this).val(1);
            if (attrValue == 'rate')
               $(this).val('0');
            if (attrValue == 'amount') {
               $(this).val('0.00');
            }
            if (attrValue == 'percentage')
               $(this).val('0.00');
            if (attrValue == 'percentageAmount')
               $(this).val('0.00');
            if (attrValue == 'row_total')
               $(this).val('0.00');
         });
         console.log(this);
      });
      $('#' + tableId + ' tbody').append(tableLastRow);
      $('#' + tableId + ' tbody tr:last td:first').html($('#row').val());
   });
   // 


   $('body').on('click', '.remove', function() {
      var row = $(this).closest('tr');
      var siblings = row.siblings();

      var tableId = $(this).closest('table').attr('id');
      var rowCount = $('#' + tableId + ' tr').length;
      if (rowCount > 2)
         $(this).closest("tr").remove();
      else {
         var divId = $('#' + tableId).parent().parent().attr('id');
         $('#' + divId).remove();
      }
      siblings.each(function(index) {
         $(this).children().first().text(index + 1);
      });

      tableReload(tableId);

   });

   $('body').on('click', '.deleteCol', function() {
      var colIndex = $(this).parent().parent().children().index($(this).parent());
      var tableId = $(this).closest('table').attr('id');
      $("#" + tableId + " > thead > tr").each(function() {
         $(this).children("td:eq(" + colIndex + ")").remove();
      });
      $("#" + tableId + " > tbody > tr").each(function() {
         $(this).children("td:eq(" + colIndex + ")").remove();
      });
      tableReload(tableId);
   });


   $('#btnAdd').click(function() {
      var ids = $.map(costMatrixTbl.rows('.selected').data(), function(item) {
         var error = 0;
         $("input[name='boqAdded[]']").each(function(key, val) {
            if ($(this).val() == item.id) {
               error++
               toastr.warning(item.costmatrixname + " already added");
            }
         });
         if (!error) {
            var selected = $('#costMatrix').val();
            var newTbl = addTbl(item.id);
            $('.appendDiv').append(newTbl);
         }
         $('#exampleModal').modal('hide');
         costMatrixTbl.rows('.selected').nodes().to$().removeClass('selected');
      });
   });

   function addTbl(id) {
      $.ajax({
         type: "POST",
         url: "getproduct-costmatrix",
         dataType: "json",
         data: {
            _token: $('#token').val(),
            id: id,
         },
         success: function(data) {
            var tablTotal = 0;
            $.each(data.data, function(key, value) {
               var costmatrx_product_id = value.id;
               var product_name = (value.product_name != null) ? value.product_name : '';
               var description = (value.description != null) ? value.description : '';
               var unit = (value.unit != null) ? value.unit : '';
               var quantity = (value.quantity != null) ? value.quantity : '';
               var rate = (value.rate != null) ? value.rate : '';
               var amount = (value.amount != null) ? value.amount : '';
               var row_total = amount;
               tablTotal += parseFloat(amount);
               // <input type="text" class="form-control" name="unit' + id + '[]" value="' + unit + '">\
               var rows = '<tr>\
                           <td>\
                           ' + (key + 1) + '\
                           </td>\
                           <td>\
                           <input type="hidden" class="form-control" name="costmatrx_product_id' + id + '[]" value="' + costmatrx_product_id + '">\
                              <input type="text" class="form-control" name="head_name' + id + '[]" value="' + product_name + '">\
                           </td>\
                           <td><textarea class="form-control" name="product_description' + id + '[]" rows="1" style=" height: 40px !important;">' + description + '</textarea></td>\
                           <td>\
                           <select class="form-control form-control-sm single-select unit kt-selectpicker" data-id="1" name="unit' + id + '[]" value="' + unit + '" >\
                                    <option value="">select</option>\
                                    @foreach($unitlist as $data)\
                                    <option value="{{$data->id}}">{{$data->unit_name}}</option>\
                                    @endforeach\
                                 </select>\
                           </td>\
                           <td>\
                           <input type="text" class="form-control integerVal valChanged" data-id="qty" name="quantity' + id + '[]"  value="' + quantity + '">\
                           </td>\
                           <td>\
                              <input type="text" class="form-control integerVal valChanged" data-id="rate" name="rate' + id + '[]" value="' + rate + '">\
                           </td>\
                           <td>\
                              <input type="text" class="form-control" data-id="amount" name="amount' + id + '[]" style="background-color: #f2f3f8;" readonly value="' + amount + '">\
                           </td>\
                           <td>\
                              <input type="text" class="form-control" data-id="row_total" name="row_total' + id + '[]" style="background-color: #f2f3f8;" readonly value="' + row_total + '">\
                           </td>\
                           <td style="text-align: center;">\
                              <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;"> <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span> </div>\
                           </td>\
                        </tr>';
               var tableId = 'tempalteTbl' + id;
               $('#' + tableId + '  tbody').append(rows);
            });
            $('#tableTotal' + id).val(tablTotal.toFixed(2));
            var curGrandtotalamount = ($('#grandtotalamount').val() == '') ? 0 : $('#grandtotalamount').val();
            var newGrandtotalamount = tablTotal + parseFloat(curGrandtotalamount);
            $('#grandtotalamount').val(newGrandtotalamount.toFixed(2));
         },
         error: function(jqXhr, json, errorThrown) {
            console.log('Error !!');
         }
      });

      var tbl = '<div class="row" style="padding-bottom: 6px;" id="div' + id + '">\
               <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0; margin-top: 0;">\
               <div class="" style="width: 100%; overflow-x: auto;">\
                  <br>\
                  <input type="hidden" name="boqAdded[]" value="' + id + '">\
                  <table style="width:100%;">\
                     <tr>\
                     <td width="60%">\
                     </td>\
                     <td width="20%">\
                     <br/>\
                     <select class="form-control form-control-sm single-select unit kt-selectpicker" data-id="1" name="selectCat' + id + '" id="selectCat' + id + '">\
                       <option value="">select</option>\
                       @foreach ($costCat as $key => $value)\
                       <option value="{{$value->id}}">{{$value->name}} ({{($value->percentage=="")?0:$value->percentage}}%)</option>\
                       @endforeach\
                     </select>\
                     <br/>\
                     </td>\
                        <td width="10%">\
                           <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right addColumn" id="' + id + '"><i class="la la-plus"></i>Add Contingency</button>\
                        </td>\
                     </tr>\
                  </table>\
                  <table class="table table-striped table-bordered table-hover" id="tempalteTbl' + id + '" style="width:100%">\
                     <thead class="thead-light">\
                        <tr>\
                           <td>#</td>\
                           <td>Item Name</td>\
                           <td>Description</td>\
                           <td>Unit</td>\
                           <td>Quantity</td>\
                           <td>Rate</td>\
                           <td>Amount</td>\
                           <td>Total</td>\
                           <td>Action</td>\
                        </tr>\
                     </thead>\
                     <br>\
                     <tbody>\
                    \
                     </tbody>\
                  </table>\
                  <table style="width:100%">\
                     <tr>\
                        <td style="width:50%; padding-right: 19px; font-size: 1rem;  font-weight: bold;">\
                        <div class="float-right">Total</div>\
                        </td>\
                        <td>\
                        <input type="text" class="form-control" name="tableTotal[]" data-id="' + id + '" id="tableTotal' + id + '" readonly="" style="background-color: #f2f3f8;  border: none;  text-align: right;  font-size: 1.75rem; font-weight: bold; color: #646c9a; padding-top: 0px;" value="">\
                        </td>\
                        <td>\
                           <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right addRow" id="' + id + '"><i class="la la-plus"></i>Add Row</button>\
                        </td>\
                     </tr>\
                  </table>\
               </div>\
            </div>';
      return tbl;
   }

   function tableReload(id) {
      var tableId = id; //'tempalteTbl' + id;
      var tableTotal = 0;
      var curId = tableId.replace('tempalteTbl', '');
      $("#" + tableId + " tr").each(function() {
         var rate = 0;
         var qty = 0;
         var percenatge = 0;
         var percentageAmount = 0;
         var rowTotal = 0;
         var grandRowTotal = 0;
         $(this).children('td').each(function(index, td) {
            $(this).find("input").each(function() {
               var attrValue = $(this).attr('data-id');
               if (attrValue == 'qty')
                  qty = $(this).val();
               if (attrValue == 'rate')
                  rate = $(this).val();
               if (attrValue == 'amount') {
                  rowTotal = rate * qty;
                  grandRowTotal = grandRowTotal + rowTotal;
                  $(this).val(rowTotal.toFixed(2));
               }
               if (attrValue == 'percentage')
                  percentageAmount = (rowTotal * $(this).val()) / 100;
               if (attrValue == 'percentageAmount') {
                  grandRowTotal = grandRowTotal + percentageAmount;
                  $(this).val(percentageAmount.toFixed(2));
               }
               if (attrValue == 'row_total') {
                  tableTotal = tableTotal + grandRowTotal;
                  $(this).val(grandRowTotal.toFixed(2));
               }

            });
         });
      });
      $('#tableTotal' + curId).val(tableTotal.toFixed(2));
      calculateTotalTableSum();
   }

   function calculateTotalTableSum() {
      var grandTotal = 0;
      $("[name='tableTotal[]']").each(function() {
         var currentVal = $(this).val();
         grandTotal += parseFloat(currentVal);
      });
      $('#grandtotalamount').val(grandTotal.toFixed(2));
   }



   var costMatrixTbl = $('#costMatrixTbl').DataTable({
      processing: true,
      serverSide: false,
      bPaginate: false,
      dom: 'Blfrtip',
      columnDefs: [{
         "defaultContent": "-",
         "targets": "_all"
      }],
      ajax: {
         "url": 'costmatrix',
         "type": "POST",
         "data": function(data) {
            data._token = $('#token').val()
         }
      },
      columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
         },
         {
            data: 'costmatrixname',
            name: 'costmatrixname'
         },
         {
            data: 'description',
            name: 'description'
         }
      ]
   });

   $(document).ready(function() {
      var detailRows = [];
      $('#costMatrixTbl tbody').on('click', 'td', function() {
         var data = costMatrixTbl.row(this).data();
         var idx = (data.id) ? data.id : 0;
         if (idx)
            $(this).parent('tr').toggleClass('selected');
      });
   });

   $('body').on('keypress keyup blur', '.integerVal', function(e) {
      $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
      if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
         event.preventDefault();
      }
   });

   $('body').on('change', '.valChanged', function(e) {
      var rate = 0;
      var qty = 0;
      var percenatge = 0;
      var percentageAmount = 0;
      var rowTotal = 0;
      var grandRowTotal = 0;
      var tr = $(this).closest("tr");
      tr.children('td').each(function(index, td) {
         $(this).find("input").each(function() {
            var attrValue = $(this).attr('data-id');
            if (attrValue == 'qty')
               rate = $(this).val();
            if (attrValue == 'rate')
               qty = $(this).val();
            if (attrValue == 'amount') {
               rowTotal = rate * qty;
               grandRowTotal = grandRowTotal + rowTotal;
               $(this).val(rowTotal.toFixed(2));
            }
            if (attrValue == 'percentage')
               percentageAmount = (rowTotal * $(this).val()) / 100;
            if (attrValue == 'percentageAmount') {
               grandRowTotal = grandRowTotal + percentageAmount;
               $(this).val(percentageAmount.toFixed(2));
            }
            if (attrValue == 'row_total')
               $(this).val(grandRowTotal.toFixed(2));

         });
      });
      var grandTotal = 0;
      $("[name='tableTotal[]']").each(function() {
         var tableId = $(this).attr('data-id');
         var toatalTable = 0;
         $("[name='row_total" + tableId + "[]']").each(function() {
            toatalTable = toatalTable + parseFloat($(this).val());
         });
         $(this).val(toatalTable.toFixed(2));
         grandTotal = grandTotal + toatalTable;
      });
      $('#grandtotalamount').val(grandTotal);
   });

   $('#saveBtn').click(function() {
      $.ajax({
         type: "POST",
         url: "cost-describe-save",
         dataType: "json",
         data: $('#dataForm').serialize() + "&_token=" + $('#token').val(),
         success: function(data) {
            alert(data)
         },
      })

   });
</script>

@endsection