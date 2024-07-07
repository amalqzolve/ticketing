@extends('sell.common.layout')



@section('content')
<!-- <link href="{{url('/')}}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets') }}/css/stylelist.css" rel="stylesheet" type="text/css" />
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                   <div class="kt-subheader__breadcrumbs">

                                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

                                        <span class="kt-subheader__breadcrumbs-separator"></span>

                                        

                                    </div>
                                </div>
                                <div class="kt-subheader__toolbar">
                           
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
                                           Delivery Orders
                                        </h3>

                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                            
                    
                        <!-- <a href="{{url('/')}}/Add-creditnote_supplier" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    @lang('app.Credit Note Supplier')
                                                </a> -->
                        <!-- <a href="{{url('/')}}/revisedcustominvoice" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    
                                                    @lang('app.Revised Invoice')
                                                </a> -->
                                                    
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="la la-download"></i> @lang('app.Export')
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__section kt-nav__section--first">
                                                                <span class="kt-nav__section-text">@lang('app.Choose an option')</span>
                                                            </li>
                                                            <li class="kt-nav__item" id="export-button-print">
                                                                <span href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-print"></i>
                                                                    <span class="kt-nav__link-text">@lang('app.Print')</span>
                                                                </span>
                                                            </li>
                                                            <li class="kt-nav__item" id="export-button-copy">
                                                                <span class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-copy"></i>
                                                                    <span class="kt-nav__link-text">@lang('app.Copy')</span>
                                                                </span>
                                                            </li>
                                                            <li class="kt-nav__item" id="export-button-csv">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                                    <span class="kt-nav__link-text">@lang('app.CSV')</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item" id="export-button-pdf">
                                                                <span class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                                    <span class="kt-nav__link-text">@lang('app.PDF')</span>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-portlet__body">

<!--begin: Datatable --><table class="table table-striped table-hover table-checkable dataTable no-footer" id="deliveryorderdetails_list1">
    <thead>
        <tr>
            <th>@lang('app.S.No')</th>
            <th>@lang('app.Delivery Order ID')</th>
            <th>@lang('app.Delivery Date')</th>
            <th>@lang('app.Sale Order ID')</th>
            <th>@lang('app.Customer')</th>
            <th>@lang('app.Salesman')</th>
            <th>Total Delivered Quantity</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
@foreach($deliveryorder as $key=>$deliveryorder)
<tr>
<td>{{$key+1}}</td>
<td>{{$deliveryorder->id}}</td>
<td>{{$deliveryorder->delivery_date}}</td>
<td>{{$deliveryorder->saleorder_id}}</td>
<td>{{$deliveryorder->cust_name}}</td>
<td>{{$deliveryorder->salesman_name}}</td>
<td>{{$deliveryorder->delivery_quantity}}</td>
<td>{{$deliveryorder->status}}</td>
<td>
 <span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                         @if($deliveryorder->status == 'Draft')
                            @can('Delivery Order PDF')
                         <a href="Deliveryorderpdf_sell?id={{$deliveryorder->id}}" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                        <span class="kt-nav__link-text" data-id="{{$deliveryorder->id}}" >PDF</span>
                        </span></li></a>@endcan
                        @can('Delivery Order Edit')
                         <a href="Deliveryorderedit_sell?id={{$deliveryorder->id}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                        <span class="kt-nav__link-text" data-id="{{$deliveryorder->id}}" >Edit</span>
                        </span></li></a>@endcan
                        @can('Delivery Order Delete')
                        <a  data-type="send" data-target="#kt_form"><li class="kt-nav__item delivery_delete" id='{{$deliveryorder->id}}' soid="{{$deliveryorder->saleorder_id}}">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>
                        <span class="kt-nav__link-text" data-id="{{$deliveryorder->id}}" data-soid="{{$deliveryorder->saleorder_id}}" id='{{$deliveryorder->id}}' >Delete</span>
                        </span></li></a>@endcan
                       @can('Delivery Order Approve')
                        <a  data-type="send" data-target="#kt_form"><li class="kt-nav__item delivery_approve" id='{{$deliveryorder->id}}'>
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>
                        <span class="kt-nav__link-text" data-id="{{$deliveryorder->id}}" id='{{$deliveryorder->id}}'>Approve</span>
                        </span></li></a>@endcan
                        @endif
                        @if($deliveryorder->status == 'Delivered')
                        @can('Delivery Order PDF')
                         <a href="Deliveryorderpdf_sell?id={{$deliveryorder->id}}" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                        <span class="kt-nav__link-text" data-id="{{$deliveryorder->id}}" >PDF</span>
                        </span></li></a>@endcan
                        @can('Delivery Order Convert Sales Invoice')
                        <a href="Deliveryorderinvoice_sell?id={{$deliveryorder->saleorder_id}}&&did={{$deliveryorder->id}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                        <span class="kt-nav__link-text" data-id="{{$deliveryorder->saleorder_id}}" >Convert Sales Invoice</span>
                        </span></li></a>@endcan
                        @can('Delivery Order Convert Proforma Invoice')
                        <a href="Deliveryorderperformainvoice_sell?id={{$deliveryorder->saleorder_id}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                        <span class="kt-nav__link-text" data-id="{{$deliveryorder->saleorder_id}}" >Convert Proforma Invoice</span>
                        </span></li></a>@endcan
                        @endif
                    </ul>
                </div>
            </div>
        </span>

</td>

</tr>

@endforeach
    </tbody>

    
</table>

<!--end: Datatable -->

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
<!--end::Modal-->
@endsection
@section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var deliveryorderdetails_list_table = $('#deliveryorderdetails_list1').DataTable({
        processing: true,
         serverSide: false,
         pagingType: "full_numbers",
     //     scrollX: true,
         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
         buttons: [{
              extend: 'copy',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50];
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],
       
      })

$(document).on('click', '.delivery_approve', function() {
        var id = $(this).attr('id');

        swal.fire({
            title: "Are you sure?",
            text: "Do you want Delivered this Order",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
          /* cancelButtonText: "No"
        }).then(result => {*/
            cancelButtonText: "No, cancel it!" }).then(result => {
                if (result.value){
                 window.location = "delivery_Approve?id="+id;
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });

$(document).on('click', '.delivery_delete', function() {
        var id = $(this).attr('id');
        var soid = $(this).attr('soid');

        swal.fire({
            title: "Are you sure?",
            text: "Do you want Delete this Order",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
          /* cancelButtonText: "No"
        }).then(result => {*/
            cancelButtonText: "No, cancel it!" }).then(result => {
                if (result.value){
                 window.location = "delivery_delete?id="+id+"&&soid="+soid;
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });

</script>
@endsection
