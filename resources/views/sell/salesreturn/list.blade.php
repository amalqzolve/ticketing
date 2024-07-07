@extends('sell.common.layout')
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
                                            Sales Return
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                            @can('Sales Return Add')                    
                         <a href="{{url('/')}}/sales_return_add_sell" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    New Record                                              </a>@endcan
                    
                        <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-download"></i> Export
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                            <li class="kt-nav__section kt-nav__section--first">
                            <span class="kt-nav__section-text">Choose an option</span>
                            </li>
                            <li class="kt-nav__item" id="purchasenumber_list_print">
                            <span href="#" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-print"></i>
                            <span class="kt-nav__link-text">Print</span>
                            </span>
                            </li>
                            <li class="kt-nav__item" id="purchasenumber_list_copy">
                            <span class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-copy"></i>
                            <span class="kt-nav__link-text">Copy</span>
                            </span>
                            </li>
                            <li class="kt-nav__item" id="purchasenumber_list_csv">
                            <a href="#" class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                            <span class="kt-nav__link-text">CSV</span>
                            </a>
                            </li>
                            <li class="kt-nav__item"id="purchasenumber_list_pdf">
                            <span class="kt-nav__link">
                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                            <span class="kt-nav__link-text">PDF</span>
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
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="sales_return_details_lists">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Invoice NO</th>
            <th>Invoice Date</th>
            <th>Customer Name</th>
            <th>Return Date</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       @foreach($salesreturn as $key=>$salesreturns)
       <tr>
        <td>{{$key+1}}</td>
        <td>{{$salesreturns->invoiceid}}</td>
        <td>{{$salesreturns->quotedate}}</td>
        <td>{{$salesreturns->cust_name}}</td>
        <td>{{$salesreturns->returndate}}</td>
        <td>{{$salesreturns->grandtotalamount}}</td>
        <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                            @can('Sales Return PDF')
                            <a href="salesreturns-Pdf?id={{$salesreturns->id}}" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                        <span class="kt-nav__link-text" data-id="{{$salesreturns->id}}" >PDF</span>
                        </span></li></a>@endcan
        @if($salesreturns->status==0)
        @can('Sales Return Convert to Credit Note')
        <a href="converttocreditnote_sell?id={{$salesreturns->invoiceid}}&&rid={{$salesreturns->id}}" data-type="send" data-target="#kt_form"><li class="kt-nav__item salesorder_confirm" id='{{$salesreturns->invoiceid}}'>
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>
                        <span class="kt-nav__link-text" data-invoiceid="{{$salesreturns->invoiceid}}" invoiceid='{{$salesreturns->invoiceid}}'>Convert to Credit Note</span>
                        </span></li></a>@endcan</ul></div></div></span></td>@endif
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
