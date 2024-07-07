@extends('qpurchase.common.layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
                     <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                           <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <i class="kt-font-brand flaticon-home-2"></i>
                              </span>
                              <h3 class="kt-portlet__head-title">
                                Vouchers
                              </h3>
                           </div>
                           <div class="kt-portlet__head-toolbar">
                              <div class="kt-portlet__head-wrapper">
                                 <div class="kt-portlet__head-actions">
                                     <a type="button" class="btn btn-brand btn-elevate btn-icon-sm" href="{{url('/')}}/buy_direct_purchase" ><i class="la la-plus"></i>{{ __('customer.New Record') }}</a> 
                                    
                 

                                    <div class="dropdown dropdown-inline">
                                       <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="la la-download"></i> Export
                                       </button>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          <ul class="kt-nav">

                                            <li class="kt-nav__section kt-nav__section--first">
                                                <span class="kt-nav__section-text">{{ __('product.Choose an option') }}</span>
                                             </li>
                                             <li class="kt-nav__item" id="voucher_details_list_print">
                                                <span href="#" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-print"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.Print') }}</span>
                                                </span>
                                             </li>
                                             <li class="kt-nav__item" id="voucher_details_list_copy">
                                                <span class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-copy"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.Copy') }}</span>
                                                </span>
                                             </li>
                                             <li class="kt-nav__item" id="voucher_details_list_csv">
                                                <a href="#" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.CSV') }}</span>
                                                </a>
                                             </li>
                                             <li class="kt-nav__item" id="voucher_details_list_pdf">
                                                <span class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.PDF') }}</span>
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
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="voucherslist">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Voucher Type </th>
            <th>Supplier </th>
            <th>VAT No </th>
            <th>Cash / Credit </th>
            <th>Bill ID </th>
            <th>Bill Date </th>
            <th>Entry Date </th>
            <th>Due Date </th>
            <th>PO/Ref Number</th>
            <th>Purchaser </th>
            <th>Total Amount </th>
            
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>


       @foreach($vouchers as $voucher)
<tr >
   <td >{{$i}}</td>
   <td   style="cursor: pointer;"  class="viewchilden">{{ $voucher->voucher_name  }}</td>
      <td   style="cursor: pointer;"  class="viewchilden">{{ $voucher->sup_name  }}</td>
      <td   style="cursor: pointer;"  class="viewchilden">{{ $voucher->vatno  }}</td>
   
       <td  style="cursor: pointer;"  class="viewchilden"><?php if($voucher->purchase_type==1){echo "Cash"; } elseif($voucher->purchase_type==2){echo "Credit"; } else{
  echo "-";
       }  ?></td>

          <td   style="cursor: pointer;"  class="viewchilden">{{ $voucher->bill_id  }}</td>


          <td   style="cursor: pointer;"  class="viewchilden">{{ $voucher->quotedate  }}</td>
          <td   style="cursor: pointer;"  class="viewchilden">{{ $voucher->entrydate  }}</td>
          <td   style="cursor: pointer;"  class="viewchilden">{{ $voucher->dateofsupply  }}</td>
          <td   style="cursor: pointer;"  class="viewchilden">{{ $voucher->po_wo_ref  }}</td>
          <td   style="cursor: pointer;"  class="viewchilden">{{ $voucher->purchaser  }}</td>
          <td   style="cursor: pointer;text-align:right;"  class="viewchilden">{{ $voucher->grandtotalamount  }}</td>
                 





          <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
<a href="qpurchase_voucher_pdf?id={{$voucher->vid}}" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-printer"></i>
                        <span class="kt-nav__link-text" data-id="{{$voucher->id}}" >PDF</span>
                        </span></li></a>

                       
                          <a href="{{url('/')}}/buy_voucher_edit?id={{$voucher->vid}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-background"></i>
                        <span class="kt-nav__link-text" data-id="" >Edit</span>
                        </span></li></a>
                             <a href="{{url('/')}}/buy_voucher_delete?id={{$voucher->vid}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text" data-id="" >Delete</span>
                        </span></li></a>
                       
                 


                  
                       </ul></div></div></span></td>
</tr>
 <?php $i++; ?>
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
<script src="{{url('/')}}/resources/js/boq/boq.js" type="text/javascript"></script>
<script type="text/javascript">

   $(document).ready(function() {

      var voucherslist_table = $('#voucherslist').DataTable({
        processing: true,
         serverSide: false,
         pagingType: "full_numbers",
          scrollX: true,
         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
             buttons: [{
              extend: 'copy',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14]
              },
              pageSize: 'LEGAL',
              orientation: 'landscape',
            
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                 columns: [0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14]
              }
          }
      ],
/*         buttons: [
{
extend: 'pdfHtml5',
orientation: 'landscape',
pageSize: 'LEGAL'
}
]*/
       
      })


$("#voucher_details_list_print").on("click", function() {
   
    voucherslist_table.button('.buttons-print').trigger();
});


$("#voucher_details_list_copy").on("click", function() {
    voucherslist_table.button('.buttons-copy').trigger();
});

$("#voucher_details_list_csv").on("click", function() {
    voucherslist_table.button('.buttons-csv').trigger();
});

$("#voucher_details_list_pdf").on("click", function() {
    voucherslist_table.button('.buttons-pdf').trigger();
});


      
      });



</script>
@endsection
