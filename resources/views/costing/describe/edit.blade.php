@extends('costing.common.layout')
@section('content')
<style>
   .dataTables_wrapper .dataTable .selected th,
   .dataTables_wrapper .dataTable .selected td {
      background-color: #f4e92b !important;
      /* color: #595d6e; */
   }

   element.style {}

   .table-bordered th,
   .table-bordered td {
      border: 1px solid #ebedf2;
   }

   .table th,
   .table td {
      padding: 0 !important;
   }

   .form-control {
      height: 33px;
   }

   thead>tr>td {
      background-color: #3f4aa0;
      color: white;
      white-space: nowrap;
      padding: 2px 7px !important;

   }

   .mtable tr>td:first-child {
      padding-left: 5px !important;
   }

   .form-control {
      width: auto;
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
               <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                  <line x1="18" y1="6" x2="6" y2="18"></line>
                  <line x1="6" y1="6" x2="18" y2="18"></line>
               </svg>
               Close
            </button>
            <button type="button" class="btn btn-primary" id="btnAdd">
               <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                  <polyline points="22 4 12 14.01 9 11.01"></polyline>
               </svg>
               Add
            </button>
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
               Prepare Estimation
            </h3>
         </div>
      </div>
      <div class="kt-portlet__body">
         <form class="kt-form" id="dataForm">
            <input type="hidden" name="boq_id" id="boq_id" value="{{$data->id}}">
            <div class="row" style="padding-bottom: 6px;">
               <!--  -->
               <div class="row ">
                  <div class="col-lg-12">
                     <div class="row ">
                        <div class="col-3">
                           <label><b>Item Name</b> : </label>
                        </div>

                        <div class="col-9 input-group-sm">
                           {{-- <input type="text" class="form-control" name="totalamount" id="totalamount" readonly="" style="font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);"
                           value="{{$data->category_name}}"> --}}
                           <label><b>{{$data->category_name}}</b></label>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-3">
                           <label><b>@lang('app.Description')</b></label>
                        </div>

                        <div class="col-9 input-group-sm">
                           {{-- <input type="text" class="form-control discount" name="discount" id="discount" readonly="" style="font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);"
                           value="{{$data->description}}"> --}}
                           {{$data->description}}
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-3">
                           <label><b>@lang('app.Unit')</b></label>
                        </div>

                        <div class="col-9 input-group-sm">
                           {{-- <input type="text" class="form-control" name="unit_name" id="unit_name" readonly="" style="font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);"
                           value="{{$data->unit_name}}"> --}}
                           {{$data->unit_name}}
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-3">
                           <label><b>@lang('app.Quantity')</b></label>
                        </div>

                        <div class="col-9 input-group-sm">
                           {{-- <input type="text" class="form-control" name="totalvatamount" id="totalvatamount" readonly="" style="font-size: 1.25rem; background-color: #f2f3f8;  height: calc(1.25em + 1rem + 2px);"
                           value="{{$data->quantity}}"> --}}
                           {{$data->quantity}}
                        </div>
                     </div>
                  </div>
                  <br>
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-3">
                           <label><b>@lang('app.Amount')</b></label>
                        </div>

                        <div class="col-9 input-group-sm">
                           <input type="hidden" name="amount" value="{{$data->amount}}" id="amount">
                           {{$data->amount}}
                        </div>
                     </div>
                  </div>
                  <br>
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-3">
                           <label><b>Estimation @lang('app.Amount')</b></label>
                        </div>

                        <div class="col-9 input-group-sm">
                           <input type="text" class="form-control pl-0" name="grandtotalamount" id="grandtotalamount" readonly="" style="background-color: #ffffff00; color:#000 !important;  border: none;   font-size: 1.75rem; font-weight: bold; color: #646c9a; padding-top: 0px;" value="{{($data->totalamount=='')?'0.00':$data->totalamount}}">
                        </div>
                     </div>
                  </div>
                  <br>
                  <div class="col-lg-12">
                     <div class="form-group  row pr-md-3">
                        <div class="col-3">
                           <label style="color:#000; font-size: 1.5rem;  font-weight: bold; padding-top:4px">Total @lang('app.Amount')</label>
                        </div>

                        <div class="col-9 input-group-sm">
                           <input type="text" class="form-control pl-0" name="grandFinaltotalamount" id="grandFinaltotalamount" readonly="" style="background-color: #ffffff00; color:#000 !important;  border: none;   font-size: 1.75rem; font-weight: bold; color: #646c9a; padding-top: 0px;" value="{{$data->grandtotal}}">
                        </div>
                     </div>
                  </div>

               </div>
               <!-- ./ -->

               <table style="width:100%">
                  <tr>
                     <td>
                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm mb-3 float-right" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="la la-plus"></i>Cost Matrix</button>
                        <br>
                     </td>
                  </tr>
               </table>
            </div>
            <div class="appendDiv">
               @if( count($esctimationData) && (isset($esctimationData)) )
               <?php
               foreach ($esctimationData as $key => $value) {
                  if ($key == 0) {
                     $oldCostMatrixId = $value->costmatrx_id;
                     $currentCostMatrixId = $value->costmatrx_id;
                     $slNo = 1;
                     $tableTotal = 0;
                  } else {
                     $currentCostMatrixId = $value->costmatrx_id;
                  }
               ?>
                  @if($key==0)
                  <div class="row" style="padding-bottom: 6px;" id="div{{$value->costmatrx_id}}">
                     <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0; margin-top: 0;">
                     <div class="col-12 mt-4">
                        <h5 class="pt-3">{{$value->costmatrixname}}</h5>
                     </div>

                     <div class="col-9 pl-0 pr-0">
                        <select class="form-control form-control-sm single-select unit kt-selectpicker" data-id="1" name="selectCat{{$value->costmatrx_id}}" id="selectCat{{$value->costmatrx_id}}">
                           <option value="">select</option>
                           @foreach ($costCat as $keyCat => $cat)
                           <option value="{{$cat->id}}">{{$cat->name}} ({{($cat->percentage=="")?0:$cat->percentage}}%)</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="col-3 pr-0 pl-0">
                        <button type="button" class="btn  btn-brand btn-elevate btn-icon-sm  float-right addColumn mr-1" id="{{$value->costmatrx_id}}">
                           <i class="la la-plus"></i>Contingency
                        </button>
                     </div>
                     <div class="" style="width: 100%; overflow-x: auto;">

                        <input type="hidden" name="boqAdded[]" value="{{$value->costmatrx_id}}">
                        <div class="table-responsive  mb-2">
                           <table class="table table-striped table-bordered table-hover mtable" id="tempalteTbl{{$value->costmatrx_id}}" style="width:100%">
                              <thead class="thead-light">
                                 <tr>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">#</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Item Name</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Description</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Unit</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Quantity</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Rate</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Amount</td>
                                    <?php
                                    if (count($value->category)) {
                                       foreach ($value->category as $keys => $categoryCol) {
                                    ?>
                                          <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;"><a class="deleteCol float-right" style="padding:0; cursor: pointer; color: red;">Delete</a><input type="hidden" name="currentCat{{$value->costmatrx_id}}[]" value="{{$categoryCol->cost_category_id}}"></br>
                                             @foreach ($costCat as $keyCat => $cat)
                                             {{($cat->id==$categoryCol->cost_category_id)?$cat->name.'('.$cat->percentage.')%':''}}
                                             @endforeach
                                          </td>
                                    <?php
                                       }
                                    }
                                    ?>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Total</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Action</td>
                                 </tr>
                              </thead>
                              <br>
                              <tbody>
                                 @endif
                                 @if($oldCostMatrixId!=$currentCostMatrixId)
                                 @php
                                 $slNo=1;
                                 @endphp
                              </tbody>
                           </table>
                        </div>

                        <table class="mb-3" style="width:100%">
                           <tr>
                              <td style="width:50%; padding-right: 19px; font-size: 1rem;  font-weight: bold;">
                                 <div class="float-right">Total</div>
                              </td>
                              <td>
                                 <input type="text" class="form-control pt-1 pb-1" name="tableTotal[]" data-id="{{$esctimationData[$key-1]->costmatrx_id}}" id="tableTotal{{$esctimationData[$key-1]->costmatrx_id}}" readonly="" style="background-color: #f2f3f8;  border: none;  text-align: right;  font-size: 1rem; font-weight: bold; color: #646c9a; padding-top: 0px;" value="{{number_format((float)$tableTotal, 2, '.', '')}}">
                              </td>
                              <td>
                                 <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right addRow" id="{{$esctimationData[$key-1]->costmatrx_id}}"><i class="la la-plus"></i>Add Row</button>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <!-- close old div and start a new div -->
                  <div class="row" style="padding-bottom: 6px;" id="div{{$value->costmatrx_id}}">
                     <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0; margin-top: 0;">
                     <div class="col-12 mt-4">
                        <h5 class="pt-3">{{$value->costmatrixname}}</h5>
                     </div>
                     <div class="col-9 pl-0 pr-0">
                        <select class="form-control form-control-sm single-select unit kt-selectpicker" data-id="1" name="selectCat{{$value->costmatrx_id}}" id="selectCat{{$value->costmatrx_id}}">
                           <option value="">select</option>
                           @foreach ($costCat as $keyCostCat => $cat)
                           <option value="{{$cat->id}}">{{$cat->name}} ({{($cat->percentage=="")?0:$cat->percentage}}%)</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="col-3 pr-0 pl-0">
                        <button type="button" class="btn btn-brand btn-elevate btn-block btn-icon-sm  float-right addColumn" id="{{$value->costmatrx_id}}">
                           <i class="la la-plus"></i>Contingency
                        </button>
                     </div>
                     <div class="" style="width: 100%; overflow-x: auto;">

                        <input type="hidden" name="boqAdded[]" value="{{$value->costmatrx_id}}">
                        <div class="table-responsive  mb-2">
                           <table class="table table-striped table-bordered table-hover mtable" id="tempalteTbl{{$value->costmatrx_id}}" style="width:100%">
                              <thead class="thead-light">
                                 <tr>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">#</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Item Name</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Description</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Unit</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Quantity</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Rate</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Amount</td>
                                    @if(count($value->category))
                                    @foreach($value->category as $keys => $categoryCol)
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;"><a class="deleteCol float-right" style="padding:0; cursor: pointer; color: red;">Delete</a><input type="hidden" name="currentCat{{$value->costmatrx_id}}[]" value="{{$categoryCol->cost_category_id}}"></br>
                                       @foreach ($costCat as $keyCat => $cat)
                                       {{($cat->id==$categoryCol->cost_category_id)?$cat->name.'('.$cat->percentage.')%':''}}
                                       @endforeach
                                    </td>
                                    @endforeach
                                    @endif
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Total</td>
                                    <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Action</td>
                                 </tr>
                              </thead>
                              <br>
                              <tbody>
                                 @php
                                 $tableTotal=0;
                                 $oldCostMatrixId=$currentCostMatrixId;
                                 @endphp
                                 @endif

                                 <tr>
                                    <td> {{$slNo++}} </td>
                                    <td>
                                       <input type="hidden" class="form-control" name="costmatrx_product_id{{$value->costmatrx_id}}[]" value="{{$value->costmatrx_product_id}}">
                                       <input type="text" class="form-control" name="head_name{{$value->costmatrx_id}}[]" value="{{$value->head_name}}">
                                    </td>
                                    <td><textarea class="form-control" name="product_description{{$value->costmatrx_id}}[]" rows="1" style=" height: 33px !important;">{{$value->product_description}}</textarea></td>
                                    <td>
                                       <select class="form-control form-control-sm single-select unit kt-selectpicker" data-id="1" name="unit{{$value->costmatrx_id}}[]">
                                          <option value="">select</option>
                                          @foreach($unitlist as $unitRow)
                                          <option value="{{$unitRow->id}}" {{($unitRow->id==$value->unit)?'selected':''}}>{{$unitRow->unit_name}}</option>
                                          @endforeach
                                       </select>
                                    </td>
                                    <td>
                                       <input type="text" class="form-control integerVal valChanged" data-id="qty" name="quantity{{$value->costmatrx_id}}[]" value="{{$value->quantity}}">
                                    </td>
                                    <td>
                                       <input type="text" class="form-control integerVal valChanged" data-id="rate" name="rate{{$value->costmatrx_id}}[]" value="{{$value->rate}}">
                                    </td>
                                    <td>
                                       <input type="text" class="form-control" data-id="amount" name="amount{{$value->costmatrx_id}}[]" style="background-color: #f2f3f8;" readonly value="{{$value->amount}}">
                                    </td>
                                    <?php
                                    if (count($value->category))
                                       foreach ($value->category as $keys => $categoryCol) {
                                    ?>
                                       <td>
                                          <div class="input-group input-group-sm"> <input type="text" class="form-control valChanged" data-id="percentage" name="percenatge{{$value->costmatrx_id}}{{$categoryCol->cost_category_id}}[]" value="{{$categoryCol->percenatge}}"> <input type="text" class="form-control " data-id="percentageAmount" style="background-color: #f2f3f8;" readonly name="percenatge_amount{{$value->costmatrx_id}}{{$categoryCol->cost_category_id}}[]" value="{{$categoryCol->amount}}"> </div>
                                       </td>
                                    <?php
                                       }
                                    ?>
                                    <td>
                                       <input type="text" class="form-control" data-id="row_total" name="row_total{{$value->costmatrx_id}}[]" style="background-color: #f2f3f8;" readonly value="{{$value->row_total}}">
                                    </td>
                                    <td style="text-align: center;">
                                       <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;"> <a class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></a> </div>
                                    </td>
                                 </tr>
                              <?php
                              $tableTotal = $tableTotal + $value->row_total;
                           }
                              ?>
                              </tbody>
                           </table>
                        </div>
                        <table style="width:100%">
                           <tr>
                              <td style="width:50%; padding-right: 19px; font-size: 1rem;  font-weight: bold;">
                                 <div class="float-right">Total</div>
                              </td>
                              <?php
                              if ($key == 0)
                                 $takeIndex = 0;
                              else
                                 $takeIndex = $key - 1;
                              ?>
                              <td>
                                 <input type="text" class="form-control pt-1 pb-1" name="tableTotal[]" data-id="{{$esctimationData[$takeIndex]->costmatrx_id}}" id="tableTotal{{$esctimationData[$takeIndex]->costmatrx_id}}" readonly="" style="background-color: #f2f3f8;  border: none;  text-align: right;  font-size: 1rem; font-weight: bold; color: #646c9a; padding-top: 0px;" value="{{number_format((float)$tableTotal, 2, '.', '')}}">
                              </td>
                              <td>
                                 <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right addRow" id="{{$esctimationData[$takeIndex]->costmatrx_id}}"><i class="la la-plus"></i>Add Row</button>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  @endif
                  <!-- add table div end -->

            </div>
      </div>


      <div class="kt-portlet__foot">
         <div class="kt-form__actions">
            <div class="row">
               <div class="col-lg-6">
               </div>
               <div class="col-lg-6 kt-align-right">
                  <button type="button" id="saveBtn" class="btn btn-primary">
                     <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                     </svg>
                     {{ __('product.Save') }}
                  </button>
                  <button type="button" class="btn btn-secondary float-right mr-2 backHome">
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
         $("#" + drpId).next().find('.select2-selection').removeClass('select-dropdown-error');

         var tableId = 'tempalteTbl' + curId;
         var tableId = 'tempalteTbl' + curId;
         var colCount = $('#' + tableId).find("tr:first td").length;
         $('#' + tableId).find('td').eq(colCount - 3).after('<td> &nbsp; <input type="hidden" name="currentCat' + curId + '[]" value="' + drpVal + '">' + drpText + ' <i class="fa fa-trash deleteCol"></i> &nbsp; </td>');
         $('#' + tableId + ' tbody tr').each(function() {
            $(this).find('td').eq(colCount - 3).after('<td><div class="input-group input-group-sm"> <input type="text" class="form-control valChanged" data-id="percentage" name="percenatge' + curId + '' + drpVal + '[]" value="' + percentage[0] + '"> <input type="text" class="form-control " data-id="percentageAmount" style="background-color: #f2f3f8;" readonly name="percenatge_amount' + curId + '' + drpVal + '[]"> </div></td>');
         });
         $("#" + drpId).val('');
      } else {
         toastr.warning('Please Select A Cost Contingency');
         $("#" + drpId).addClass('is-invalid');
         $("#" + drpId).next().find('.select2-selection').addClass('select-dropdown-error');
      }
      var tableId = 'tempalteTbl' + curId;
      tableReload(tableId);
   });

   $('body').on('click', '.addRow', function() {
      var tableId = 'tempalteTbl' + $(this).attr('id');
      var tableLastRow = $('#' + tableId + ' tbody tr:last').clone();
      var rowCount = $('#' + tableId + ' tbody tr').length;
      $('#' + tableId + ' tbody tr:last').find(".items").select2("destroy");

      tableLastRow.find("span").remove();
      tableLastRow.children('td').each(function(index, td) {
         if (index == 0) {
            $(this).text(rowCount + 1);
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
         // console.log(this);
      });
      // tableLastRow.find("select").select2();
      $('#' + tableId + ' tbody').append(tableLastRow);
      $('#' + tableId + ' tbody tr:last td:first').html($('#row').val());
      selectRefresh();
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
         // var divId = $('#' + tableId).parent().parent().attr('id');
         var divId = $('#' + tableId).parent().parent().parent().attr('id');
         console.log(divId);
         $('#' + divId).remove();
         var tableCount = 0;
         $("input[name='boqAdded[]']").each(function(key, val) {
            var id = $(this).val();
            tableCount++
         });
         if (!tableCount) {
            $('#grandtotalamount').val('0.00');
            var curAmount = parseFloat(($('#amount').val() == '') ? 0 : $('#amount').val());
            $('#grandFinaltotalamount').val(curAmount);
         }

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
            var newTbl = addTbl(item.id, item.costmatrixname);
            $('.appendDiv').append(newTbl);
            selectRefresh();
         }
         $('#exampleModal').modal('hide');
         costMatrixTbl.rows('.selected').nodes().to$().removeClass('selected');
      });
   });

   function addTbl(id, costmatrixname) {
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
                           <td><textarea class="form-control" name="product_description' + id + '[]" rows="1" style=" height: 33px !important;">' + description + '</textarea></td>\
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
                              <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;"> <a class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow"> <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></a> </div>\
                           </td>\
                        </tr>';
               var tableId = 'tempalteTbl' + id;
               $('#' + tableId + '  tbody').append(rows);
               // selectRefresh();
            });
            $('#tableTotal' + id).val(tablTotal.toFixed(2));
            var curGrandtotalamount = ($('#grandtotalamount').val() == '') ? 0 : $('#grandtotalamount').val();
            var newGrandtotalamount = tablTotal + parseFloat(curGrandtotalamount);
            var curAmount = parseFloat(($('#amount').val() == '') ? 0 : $('#amount').val());
            $('#grandtotalamount').val(newGrandtotalamount.toFixed(2));
            newGrandtotalamount += curAmount;
            $('#grandFinaltotalamount').val(newGrandtotalamount.toFixed(2));
         },
         error: function(jqXhr, json, errorThrown) {
            console.log('Error !!');
         }
      });

      var tbl = '<div class="row" style="padding-bottom: 6px;" id="div' + id + '">\
               <hr style="height: 15px; background-color: #f2f3f8; width: 100%; position: absolute; left: 0; border: 0; margin-top: 0;">\
               <div class="col-12 mt-5">\
                  <h5 >' + costmatrixname + '</h5>\
                  </div>\
                  <div class="col-9 pl-0 pr-0">\
                     <select class="form-control form-control-sm single-select unit kt-selectpicker" data-id="1" name="selectCat' + id + '" id="selectCat' + id + '">\
                       <option value="">select</option>\
                       @foreach ($costCat as $keycostCat => $value)\
                       <option value="{{$value->id}}">{{$value->name}} ({{($value->percentage=="")?0:$value->percentage}}%)</option>\
                       @endforeach\
                     </select>\
                  </div>\
                  <div class="col-3 pr-0 pl-0">\
                     <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right addColumn" id="' + id + '"><i class="la la-plus"></i>Contingency</button>\
                  </div>\
               <div class="" style="width: 100%; overflow-x: auto;">\
                  <br>\
                  <input type="hidden" name="boqAdded[]" value="' + id + '">\
                 \
                 <div class="table-responsive mb-2"><table class="table table-striped table-bordered table-hover" id="tempalteTbl' + id + '" style="width:100%">\
                     <thead class="thead-light">\
                        <tr>\
                           <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">#</td>\
                           <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Item Name</td>\
                           <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Description</td>\
                           <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Unit</td>\
                           <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Quantity</td>\
                           <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Rate</td>\
                           <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Amount</td>\
                           <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Total</td>\
                           <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Action</td>\
                        </tr>\
                     </thead>\
                     <br>\
                     <tbody>\
                    \
                     </tbody>\
                  </table></div>\
                  <table style="width:100%">\
                     <tr>\
                        <td style="width:50%; padding-right: 19px; font-size: 1rem;  font-weight: bold;">\
                        <div class="float-right">Total</div>\
                        </td>\
                        <td>\
                        <input type="text" class="form-control" name="tableTotal[]" data-id="' + id + '" id="tableTotal' + id + '" readonly="" style="background-color: #f2f3f8;  border: none;  text-align: right;  font-size: 1rem; font-weight: bold; color: #646c9a; padding-top: 0px;" value="">\
                        </td>\
                        <td>\
                           <button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right addRow" id="' + id + '"><i class="la la-plus"></i>Add Row</button>\
                        </td>\
                     </tr>\
                  </table>\
               </div>\
            </div>';
      selectRefresh();
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
      var curAmount = parseFloat(($('#amount').val() == '') ? 0 : $('#amount').val());
      $('#grandtotalamount').val(grandTotal.toFixed(2));
      grandTotal += curAmount;
      $('#grandFinaltotalamount').val(grandTotal.toFixed(2));
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
      var curAmount = parseFloat(($('#amount').val() == '') ? 0 : $('#amount').val());
      $('#grandtotalamount').val(grandTotal);
      grandTotal += curAmount;
      $('#grandFinaltotalamount').val(grandTotal.toFixed(2));
   });

   $('#saveBtn').click(function() {
      if (tableValidation()) {
         $('#saveBtn').addClass('kt-spinner');
         $('#saveBtn').prop("disabled", true);
         $.ajax({
            type: "POST",
            url: "cost-describe-save",
            dataType: "json",
            data: $('#dataForm').serialize() + "&_token=" + $('#token').val(),
            success: function(data) {
               if (data.status == 1) {
                  $('#saveBtn').removeClass('kt-spinner');
                  $('#saveBtn').prop("disabled", false);
                  window.location.href = "cost-estimation";
                  toastr.success('Details Saved Successfully');
               } else
                  toastr.error('Error Data Not Saved');
            },
            error: function(jqXhr, json, errorThrown) {
               console.log('Error !!');
            }
         });
      } else
         toastr.warning('Fill required Fields');
   });

   function tableValidation() {
      var tableCount = 0;
      var error = 0;
      $("input[name='boqAdded[]']").each(function(key, val) {
         var id = $(this).val();
         tableCount++
         $("input[name='quantity" + id + "[]']").each(function(key, val) {
            if (($(this).val() == '') || ($(this).val() == 0)) {
               error++;
               $(this).addClass('is-invalid');
            } else
               $(this).removeClass('is-invalid');
         });
         $("input[name='rate" + id + "[]']").each(function(key, val) {
            if (($(this).val() == '') || ($(this).val() == 0)) {
               error++;
               $(this).addClass('is-invalid');
            } else
               $(this).removeClass('is-invalid');
         });
         $("select[name='unit" + id + "[]']").each(function(key, val) {
            if (($(this).val() == '') || ($(this).val() == 0)) {
               error++;
               $(this).addClass('is-invalid');
               $(this).next().find('.select2-selection').addClass('select-dropdown-error');
            } else {
               $(this).removeClass('is-invalid');
               $(this).next().find('.select2-selection').removeClass('select-dropdown-error');
            }
         });
      });
      if (!tableCount) {
         // toastr.error('Atleast add a Value');
         // return false;
      }
      if (!error)
         return true;
      else
         return false;
   }
</script>

@endsection