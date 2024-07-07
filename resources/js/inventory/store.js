  /**
  *Datatable for Store Management
  */

         $(document.body).on("keyup  change", "#phone", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
    }); 




  var storemanagement_table = $('#storemanagement_list').DataTable({
      processing: true,
      serverSide: true,
      pagingType: "full_numbers",
      dom: 'Blfrtip',
      lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
      ],
      buttons: [{
              extend: 'copy',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
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
                  columns: [0, 1, 2, 3,4,5,6]
              }
          }
      ],

      ajax: {
          "url": 'StoreManagement',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
     /*     { data: 'warehouse_name', name: 'warehouse_name' },*/
          { data: 'store_name', name: 'store_name' },
          { data: 'manager', name: 'manager' },
          { data: 'incharge', name: 'incharge' },
          { data: 'store_location', name: 'store_location' },
          { data: 'keeper', name: 'keeper' },
          { data: 'id', name: 'id' },
          
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_store?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a href="view_store?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_store_management_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });
/**
*Store Management submit action
*/
$(document).on('click', '#storemanagement_submit', function(e){
       e.preventDefault();
        warehouse             = $('#warehouse').val();
        storename             = $("input[name=storename]").val();
        storemanager          = $('#storemanager').val();
        storeincharge         = $('#storeincharge').val();
        storelocation         = $('#storelocation').val();
        storekeeper           = $('#storekeeper').val();
        rackavailability      = $('#rackavailability').val();
       /* if (warehouse == "") { 
           $('#warehouse').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Warehouse Name is required.');    
            return false;
        }
         else {
           $('#warehouse').next().find('.select2-selection').removeClass('select-dropdown-error');
        }*/
         if (storename=="") {
         $('#storename').addClass('is-invalid');
            toastr.warning('Store Name is required.');     
         return false;
         } 
         else{
            $('#storename').removeClass('is-invalid');
         } 

           if (rackavailability=="") {
         $('#rackavailability').addClass('is-invalid');
            toastr.warning('Store Code is required.');     
         return false;
         } 
         else{
            $('#rackavailability').removeClass('is-invalid');
         } 


         /*if (storemanager == "") { 
           $('#storemanager').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Store Manager is required.');     
            return false;
        }
         else {
           $('#storemanager').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (storelocation=="") {
         $('#storelocation').addClass('is-invalid');
            toastr.warning('Store location is required.');    
         return false;
         } 
         else{
            $('#storelocation').removeClass('is-invalid');
         }
        if (storeincharge == "") { 
           $('#storeincharge').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Store Incharge is required.');    
            return false;
        }
         else {
           $('#storeincharge').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (storekeeper == "") { 
           $('#storekeeper').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Store Keeper is required.');     
            return false;
        }
         else {
           $('#storekeeper').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
         if (rackavailability=="") {
         $('#rackavailability').addClass('is-invalid');
            toastr.warning('Rack is required.');     
         return false;
         } 
         else{
            $('#rackavailability').removeClass('is-invalid');
         } */
      $(this).addClass('kt-spinner');
      $(this).prop("disabled", true);
      if($('#id').val()){
        var sucess_msg ='Updated';
        } else{
        var sucess_msg ='Created';
        }
        $.ajax({
            type : "POST",
            url  : "storemanagement_submit",
            dataType  : "json",
            data : {
                        _token                : $('#token').val(),
                        id                    : $('#id').val(),
                        warehouse             : $('#warehouse').val(),
                        storename             : $('#storename').val(),
                        storemanager          : $('#storemanager').val(),
                        storeincharge         : $('#storeincharge').val(),
                        storelocation         : $('#storelocation').val(),
                        storekeeper           : $('#storekeeper').val(),
                        rackavailability      : $('#rackavailability').val(),
                        branch                : $('#branch').val(),
                        checkedValue     : $('#default').is(":checked"),
                    },
            success: function(data){
          if(data == 'false')
          {
            $('#storemanagement_submit').removeClass('kt-spinner');
            $('#storemanagement_submit').prop("disabled", false);
            toastr.warning('Store namme already exist');
          }
          else
          {
                    $('#storemanagement_submit').removeClass('kt-spinner');
                    $('#storemanagement_submit').prop("disabled", false);
                    storemanagement_table.ajax.reload();
                    toastr.success('Store Management Details '+sucess_msg+' Successfuly');
                     window.location.href = "StoreManagement";
          }
            },
            error   : function ( jqXhr, json, errorThrown )
            {
                   console.log('Error !!');
             }
        });
    });
/**
*Store Management DataTable Export
*/

  $("#storemanagement_list_print").on("click", function() {
      storemanagement_table.button('.buttons-print').trigger();
  });
  $("#storemanagement_list_copy").on("click", function() {
      storemanagement_table.button('.buttons-copy').trigger();
  });
  $("#storemanagement_list_csv").on("click", function() {
      storemanagement_table.button('.buttons-csv').trigger();
  });
  $("#storemanagement_list_pdf").on("click", function() {
      storemanagement_table.button('.buttons-pdf').trigger();
  });

/**
   *Vendor Group trash DataTable Export
*/
  $("#storemanagement_trash_list_print").on("click", function() {
      storemanagement_trash_table.button('.buttons-print').trigger();
  });


  $("#storemanagement_trash_list_copy").on("click", function() {
      storemanagement_trash_table.button('.buttons-copy').trigger();
  });

  $("#storemanagement_trash_list_csv").on("click", function() {
      storemanagement_trash_table.button('.buttons-csv').trigger();
  });

  $("#storemanagement_trash_list_pdf").on("click", function() {
      storemanagement_trash_table.button('.buttons-pdf').trigger();
  });


// $(document).ready(function(){
// var table = $('#storemanagement_list').DataTable({
//         // "dom"        : 'B<"top"f>rt<"bottom"lp>',
//         // "lengthMenu" : [
//         //     [ 10, 25, 50, -1 ],
//         //     [ '10 rows', '25 rows', '50 rows', 'Show all' ]
//         // ],
//         // "buttons": [
//         //     {
//         //         extend: 'pageLength',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'copy',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'csv',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'excel',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'pdf',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
//         //         exportOptions: {
//         //             columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
//         //         }
//         //     },
//         //     {
//         //         extend: 'print',
//         //         text: 'Print all (not just selected)',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
//         //         exportOptions: {
//         //             modifier: {
//         //                 selected: null
//         //             }
//         //         }
//         //     }
//         // ],
//         // "select": {
//         //     style   :  'os',
//         //     selector: 'td:first-child'
//         // },
//         // select: true,
//         "pagingType": 'full_numbers',
//         "iDisplayLength": 10,
//         "processing": true,
//         "serverSide": true,
//         "responsive": true,
//         "stripeClasses": [ 'odd-row', 'even-row' ],
//         "order": [],

//         "ajax": {
//             "url" : 'storemanagement_list',
//             "type": "POST",
//             "data": function ( data ) {
//                 data._token = $('#token').val()
//             }
//         }

//     })
// });
    /**
     *Store Management Delete
     */
$(document).on('click', '.kt_store_management_delete', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Entry !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value){
        $.ajax({
              type: "POST",
              url : 'deletestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data){
                  swal.fire("Deleted!", "Your Entry has been deleted.", "success");
             location.reload();
             }
          });
          } else{
            swal.fire("Cancelled", "Your Entry is safe ", "error");
          }
        })
       });
    /**
     *Store Management  trash datatable
     */
    var storemanagement_trash_table = $('#storemanagement_trash_list').DataTable({
      processing: true,
      serverSide: true,
      pagingType: "full_numbers",
      dom: 'Blfrtip',
      lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
      ],
      buttons: [{
              extend: 'copy',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6]
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
                  columns: [0, 1, 2, 3,4,5,6]
              }
          }
      ],
         ajax: {
          "url": 'Trash-StoreManagement',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
        columns: [
            {data: 'DT_RowIndex',   name: 'DT_RowIndex'},
       /*   { data: 'warehouse_name', name: 'warehouse_name' },*/
          { data: 'store_name', name: 'store_name' },
          { data: 'manager', name: 'manager' },
          { data: 'incharge', name: 'incharge' },
          { data: 'store_location', name: 'store_location' },
          { data: 'keeper', name: 'keeper' },
          { data: 'total_rack_availability', name: 'total_rack_availability' },
            { data: 'action', name: 'action', render:function(data, type, row){
             return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id='+row.id+'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-refresh-arrow"></i>\
                        <span class="kt-nav__link-text kt_store_management_recover" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
            }},
        ]
    });
    /**
     *Store Management Restore
     */
    $(document).on('click', '.kt_store_management_recover', function () {
      var id = $(this).attr('id');
        $.ajax({
              type: "POST",
              url : 'restorestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Done", "Restore Sucessfully", "success");
                  location.reload();
                  window.location.href="StoreManagement";
             }
          });
        });
      /**
     *Store Management Trash Delete
     */
      $(document).on('click', '.kt_del_store_management_trashdelete', function (){
        var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Entry !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {
        $.ajax({
              type: "POST",
              url : 'deletestoredetails',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

               if(data == 's')
                {
                   swal.fire("Deleted!", "Your Entry has been deleted.", "success");
             location.reload();
                }
                else
                {
                   swal.fire("Cancelled", "store is already assigned to a rack ", "success");
             location.reload();
                }
             }
          });
          } else {
            swal.fire("Cancelled", "Your   Entry is safe ", "error");
          }
        })
      });