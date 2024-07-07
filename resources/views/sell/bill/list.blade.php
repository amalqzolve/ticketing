@extends('sell.common.layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
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
            <h3 class="kt-portlet__head-title">Invoice Settlement - Receipt Vouchers
            </h3>
         </div>
         <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
               <div class="kt-portlet__head-actions">
                  @can('Bill Settlement Add')
                  <a type="button" class="btn btn-brand btn-elevate btn-icon-sm" href="{{url('/')}}/sales_bill_settlement_add_sell"><i class="la la-plus"></i>{{ __('customer.New Record') }}</a> @endcan

                  <div class="dropdown dropdown-inline">
                     <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-download"></i> Options
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
         <table class="table table-striped table-hover table-checkable dataTable no-footer" id="maindetails_list">
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>Receipt ID</th>
                  <th>Date </th>
                  <th>Customer </th>
                  <th>Paid amount </th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
            </tbody>
         </table>
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
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<!-- <script src="{{url('/')}}/resources/js/boq/boq.js" type="text/javascript"></script> -->
<script type="text/javascript">
   $(document).ready(function() {
      $('.payments').addClass('kt-menu__item--open');
      $('.sales_bill_settlement_sell').addClass('kt-menu__item--active');

      var maindetails_list_table = $('#maindetails_list').DataTable({
         processing: true,
         serverSide: true,
         pagingType: "full_numbers",
         dom: 'Blfrtip',
         lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
         ],
         order: [
            [1, 'desc']
         ],
         ajax: {
            "url": 'sales_bill_settlement_sell',
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
               data: 'id',
               name: 'id'
            },
            {
               data: 'transactiondate',
               name: 'transactiondate'
            },
            {
               data: 'cust_name',
               name: 'cust_name',
               render: function(data, type, row) {
                  var curData = row.cust_name;
                  if (curData != null)
                     return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                  else
                     return '-';
               }
            },
            {
               data: 'paidamount',
               name: 'paidamount'
            },
            {
               data: 'status',
               name: 'status'
            },
            {
               data: 'action',
               name: 'action',
            },
         ],
         columnDefs: [{
            width: '50px',
            "orderable": false,
            "searchable": false,
            targets: [0, 6]
         }, ],

      })


      $("#voucher_details_list_print").on("click", function() {
         maindetails_list_table.button('.buttons-print').trigger();
      });

      $("#voucher_details_list_copy").on("click", function() {
         maindetails_list_table.button('.buttons-copy').trigger();
      });

      $("#voucher_details_list_csv").on("click", function() {
         maindetails_list_table.button('.buttons-csv').trigger();
      });

      $("#voucher_details_list_pdf").on("click", function() {
         maindetails_list_table.button('.buttons-pdf').trigger();
      });
   });



   $(document).on('click', '.bill_settlement_approve', function() {
      var id = $(this).attr('id');
      swal.fire({
         title: "Are you sure?",
         text: "Do you want Approve This Bill Settilement",
         type: "warning",
         showCancelButton: true,
         confirmButtonClass: "btn-danger",
         confirmButtonText: "Approve",
         cancelButtonText: "Cancel"
      }).then(result => {
         if (result.value) {
            $.ajax({
               type: "POST",
               url: "bill-settilement-approve",
               dataType: "json",
               data: {
                  _token: $('#token').val(),
                  id: id,
               },
               success: function(data) {
                  if (data.status == 1) {
                     toastr.success('Bill Settilement Approved successfuly');
                     window.location.href = "sales_bill_settlement_sell";
                  } else {
                     swal.fire({
                        title: "Error !!!",
                        text: data.msg,
                        type: "error",
                     });
                  }
               },
               error: function(jqXhr, json, errorThrown) {
                  console.log('Error !!');
               }
            });

         } else {
            swal.fire("Cancelled", "", "error");
         }
      })
   });


   $(document).on('click', '.bill_settlement_delete', function() {
      var id = $(this).attr('id');
      swal.fire({
         title: "Are you sure?",
         text: "Do you want Delete This Bill Settilement",
         type: "warning",
         showCancelButton: true,
         confirmButtonClass: "btn-danger",
         confirmButtonText: "Delete",
         cancelButtonText: "Cancel"
      }).then(result => {
         if (result.value) {
            $.ajax({
               type: "POST",
               url: "bill-settilement-delete",
               dataType: "json",
               data: {
                  _token: $('#token').val(),
                  id: id,
               },
               success: function(data) {
                  if (data.status == 1) {
                     toastr.success('Bill Settilement Deleted successfuly');
                     window.location.href = "sales_bill_settlement_sell";
                  } else {
                     swal.fire({
                        title: "Error !!!",
                        text: data.msg,
                        type: "error",
                     });
                  }
               },
               error: function(jqXhr, json, errorThrown) {
                  console.log('Error !!');
               }
            });

         } else {
            swal.fire("Cancelled", "", "error");
         }
      })
   });
</script>
@endsection