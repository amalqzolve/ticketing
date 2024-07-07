@extends('inventory.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon-home-2"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">

                                           
                                            {{ __('product.Quote History') }} -  <?php
                                            if (count($invoices)>0) {
                                           echo $invoices[0]->product_name;
                                       }
                                             ?>
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions"></div>
                        </div>
                        </div>
                        </div>
<div class="kt-portlet__body">
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="sales_return_details_lists">
    <thead>
        <tr>
            <th>S.No</th>
            <th>{{ __('app.Quote NO') }}</th>
            <th>{{ __('app.Quote Date') }}</th>
            <th>{{ __('app.Customer Name') }}</th>
            <th>{{ __('app.Quantity') }}</th>
            <th>{{ __('app.Rate') }}</th>
            <th>{{ __('app.Amount') }}</th>
            <th>{{ __('app.VAT Percentage') }}</th>
            <th>{{ __('app.VAT Amount') }}</th>
            <th>{{ __('app.Discount') }}</th>
            <th>{{ __('app.Total Amount') }}</th>
            <th>{{ __('app.Action') }}</th>
        </tr>
    </thead>
    <tbody>
       @foreach($invoices as $key=>$invoice)
       <tr>
        <td>{{$key+1}}</td>
        <td>{{$invoice->inv_id}}</td>
        <td>{{$invoice->quotedate}}</td>
        <td>{{$invoice->cust_name}}</td>

           <td>{{$invoice->quantity}}</td>
           <td>{{$invoice->rate}}</td>
           <td>{{$invoice->amount}}</td>
           <td>{{$invoice->vat_percentage}}</td>
            <td>{{$invoice->vatamount}}</td>
            <td>{{$invoice->discount}}</td>
            <td>{{$invoice->totalamount}}</td>




        <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                           
                            <a href="salesinvoice-PDF?id={{$invoice->inv_id}}" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                        <span class="kt-nav__link-text" data-id="{{$invoice->inv_id}}" >PDF</span>
                        </span></li></a>
       </tr>
       @endforeach 
    </tbody>
</table>
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
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var sales_return_details_lists_table = $('#sales_return_details_lists').DataTable({
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
</script>
@endsection
