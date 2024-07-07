@extends('costing.common.layout')
@section('content')
<style>
   .table th,
   .table td {
      padding: 0.35rem !important;
   }

   .form-control {
      height: 33px;
   }

   br {
      display: none;
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
               Estimation
            </h3>
         </div>
      </div>
      <div class="kt-portlet__body">

         <form class="kt-form" id="dataForm">
            <div class="row" style="padding-bottom: 6px;">
               <!--  -->
               <div class="row">
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-md-3">
                           <label>Item Name</label>
                        </div>
                        <div class="col-md-9 input-group-sm">
                           <label><b>{{$data->category_name}}</b></label>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-md-3">
                           <label>@lang('app.Description')</label>
                        </div>
                        <div class="col-md-9 input-group-sm">
                           {{$data->description}}
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-md-3">
                           <label>@lang('app.Unit')</label>
                        </div>
                        <div class="col-md-9 input-group-sm">
                           {{$data->unit_name}}
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-md-3">
                           <label>@lang('app.Quantity')</label>
                        </div>
                        <div class="col-md-9 input-group-sm">
                           {{$data->quantity}}
                        </div>
                     </div>
                  </div>

               </div>
               <!-- ./ -->
            </div>


            <div class="appendDiv mt-3">
               @if( count($esctimationData) && (isset($esctimationData)) )
               @foreach ($esctimationData as $key => $value)
               @php
               if($key==0){
               $oldCostMatrixId=$value->costmatrx_id;
               $currentCostMatrixId=$value->costmatrx_id;
               $slNo=1;
               $tableTotal=0;
               }else {
               $currentCostMatrixId=$value->costmatrx_id;
               }
               @endphp
               @if($key==0)
               <div class="accordion accordion-light  accordion-svg-icon" id="accordionExample{{$key}}">
                  <div class="card">
                     <div class="card-header" id="headingOne{{$key}}">
                        <div class="card-title collapsed pt-1 pb-1" data-toggle="collapse" data-target="#collapseOne{{$key}}" aria-expanded="false" aria-controls="collapseOne{{$key}}">
                           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                 <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                 <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                 <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                              </g>
                           </svg>{{$value->costmatrixname}} -- @foreach ($total as $dup => $dupvalue) @if($value->costmatrx_id==$dupvalue->costmatrx_id) @php $curSum=$dupvalue->sum; @endphp @endif @endforeach
                           <span style="position: absolute; right: 0;" class="float-right">{{number_format((float)$curSum, 2, '.', '')}}</span>
                           <!-- head -->
                        </div>
                     </div>
                     <div id="collapseOne{{$key}}" class="collapse" aria-labelledby="headingOne{{$key}}" data-parent="#accordionExample{{$key}}" style="">
                        <div class="card-body p-0">

                           <div class="table-responsive mb-2">
                              <table class="table table-striped table-bordered table-hover" id="tempalteTbl{{$value->costmatrx_id}}" style="width:100%">
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
                                       <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">
                                          @foreach ($costCat as $keyCat => $cat)
                                          {{($cat->id==$categoryCol->cost_category_id)?$cat->name.'('.$cat->percentage.')%':''}}
                                          @endforeach
                                       </td>
                                       @endforeach
                                       @endif
                                       <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Total</td>
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
                           <table style="width:100%">
                              <tr>
                                 <td style="width:50%; padding-right: 19px; font-size: 1rem;  font-weight: bold;">
                                    <div class="float-right">Total</div>
                                 </td>
                                 <td>
                                    <input type="text" class="form-control pt-1 pb-1" name="tableTotal[]" data-id="{{$esctimationData[$key-1]->costmatrx_id}}" id="tableTotal{{$esctimationData[$key-1]->costmatrx_id}}" readonly="" style="background-color: #f2f3f8;  border: none;  text-align: right;  font-size: 1rem; font-weight: bold; color: #646c9a; padding-top: 0px;" value="{{number_format((float)$tableTotal, 2, '.', '')}}">
                                 </td>
                              </tr>
                           </table>
                           <!--</div>
                     </div> -->

                        </div>
                     </div>
                  </div>
               </div>


               <!-- close old div and start a new div -->
               <div class="accordion accordion-light  accordion-svg-icon" id="accordionExample{{$key}}">
                  <div class="card">
                     <div class="card-header" id="headingOne{{$key}}">
                        <div class="card-title collapsed pt-1 pb-1" data-toggle="collapse" data-target="#collapseOne{{$key}}" aria-expanded="false" aria-controls="collapseOne{{$key}}">
                           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                 <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                 <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                 <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                              </g>
                           </svg>{{$value->costmatrixname}} -- @foreach ($total as $dup => $dupvalue) @if($value->costmatrx_id==$dupvalue->costmatrx_id) @php $curSum=$dupvalue->sum; @endphp @endif @endforeach
                           <span style="position: absolute; right: 0;" class="float-right">{{number_format((float)$curSum, 2, '.', '')}}</span>

                           <!-- head -->
                        </div>
                     </div>
                     <div id="collapseOne{{$key}}" class="collapse" aria-labelledby="headingOne{{$key}}" data-parent="#accordionExample{{$key}}" style="">
                        <div class="card-body  p-0">
                           <div class="table-responsive mb-2">
                              <table class="table table-striped table-bordered table-hover" style="width:100%">
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
                                       <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">
                                          @foreach ($costCat as $keyCat => $cat)
                                          {{($cat->id==$categoryCol->cost_category_id)?$cat->name.'('.$cat->percentage.')%':''}}
                                          @endforeach
                                       </td>
                                       @endforeach
                                       @endif
                                       <td style="background-color: #3f4aa0; color: white; white-space: nowrap; padding: 2px 7px !important;">Total</td>
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
                                       <td>{{$value->head_name}}</td>
                                       <td>{{$value->product_description}}</td>
                                       <td>
                                          @foreach($unitlist as $unitRow)
                                          {{($unitRow->id==$value->unit)?$unitRow->unit_name:''}}
                                          @endforeach
                                       </td>
                                       <td>{{$value->quantity}} </td>
                                       <td>{{$value->rate}} </td>
                                       <td>{{$value->amount}} </td>
                                       @if(count($value->category))
                                       @foreach($value->category as $keys => $categoryCol)
                                       <td>
                                          <div class="input-group input-group-sm">{{$categoryCol->amount}} &nbsp; ({{$categoryCol->percenatge}} %)</div>
                                       </td>

                                       @endforeach
                                       @endif
                                       <td>{{$value->row_total}}</td>
                                    </tr>
                                    @php
                                    $tableTotal=$tableTotal+ $value->row_total;
                                    @endphp
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                           <table style="width:100%">
                              <tr>
                                 <td style="width:50%; padding-right: 19px; font-size: 1rem;  font-weight: bold;">
                                    <div class="float-right">Total</div>
                                 </td>
                                 <td>
                                    <input type="text" class="form-control pt-1 pb-1" name="tableTotal[]" readonly="" style="background-color: #f2f3f8;  border: none;  text-align: right;  font-size: 1rem; font-weight: bold; color: #646c9a; padding-top: 0px;" value="{{number_format((float)$tableTotal, 2, '.', '')}}">
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                     @endif
                     <!-- add table div end -->
                  </div>
               </div>
            </div>

      </div>
      <div class="col-lg-12 border border-left-0 border border-right-0 border border-bottom-0">
         <div class="form-group  row pr-md-3">
            <div class="col-md-3">
               <label style=" font-size: 1.3rem; color:#000; font-weight: bold; padding-top:4px">Total Estimation </label>
            </div>
            <div class="col-md-9 input-group-sm">
               <input type="text" class="form-control text-right pr-0" name="grandtotalamount" id="grandtotalamount" readonly="" style="background-color: #ffffff00;  border: none;   font-size: 1.35rem; font-weight: bold; color: #000; padding-top: 0px;" value="{{$data->totalamount}}">
            </div>
         </div>
      </div>
      <div class="col-lg-12 border border-left-0 border border-right-0 border border-bottom-0">
         <div class="form-group  row pr-md-3">
            <div class="col-md-3">
               <label style=" font-size: 1.3rem; color:#000; font-weight: bold; padding-top:4px">Direct Price Analysis </label>
            </div>
            <div class="col-md-9 input-group-sm">
               <input type="text" class="form-control text-right pr-0" name="amount" id="amount" readonly="" style="background-color: #ffffff00;  border: none;   font-size: 1.35rem; font-weight: bold; color: #000; padding-top: 0px;" value="{{$data->amount}}">
            </div>
         </div>
      </div>

      <div class="col-lg-12 border border-left-0 border border-right-0 border border-bottom-0">
         <div class="form-group  row pr-md-3">
            <div class="col-md-3">
               <label style=" font-size: 1.5rem; color:#000; font-weight: bold; padding-top:4px">Grand Total @lang('app.Amount')</label>
            </div>
            <div class="col-md-9 input-group-sm">
               <input type="text" class="form-control text-right pr-0" name="grandtotal" id="grandtotal" readonly="" style="background-color: #ffffff00;  border: none;   font-size: 1.75rem; font-weight: bold; color: #000; padding-top: 0px;" value="{{$data->grandtotal}}">
            </div>
         </div>
      </div>


      <div class="kt-portlet__foot">
         <div class="kt-form__actions">
            <div class="row">
               <div class="col-lg-6">
               </div>
               <div class="col-lg-6 kt-align-right">
                  <button type="button" class="btn btn-secondary float-right mr-2 backHome">
                     <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                     </svg>{{ __('app.Cancel') }}
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
</script>

@endsection