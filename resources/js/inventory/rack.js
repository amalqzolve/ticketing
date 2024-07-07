  /**
  *Datatable for Rack Management
  */

         $(document.body).on("keyup  change", "#phone", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
    }); 




  var rackmanagement_table = $('#rackmanagement_list').DataTable({
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
                  columns: [0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
                 
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50];
                   doc.content[1].table.widths = [ '25%', '25%', '25%', '25%'];
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3, 4]
              }
          }
      ],

      ajax: {
          "url": 'RackManagement',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
    /*      { data: 'name', name: 'name' },*/
          { data: 'storename', name: 'storename' },
          { data: 'rack_name', name: 'rack_name' },
           { data: 'rack_manager', name: 'rack_manager' },
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
                        <a href="edit_rack?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a href="view_rack?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_rack_management_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });
/**
*Rack management add data
*/
      $(document).on('click', '#rackmanagement_submit', function(e){
       e.preventDefault();
                        warehouse             = $('#warehouse').val();
                        store                 = $('#store').val();
                        rackname              = $('#rackname').val();
                        rackmanger            = $('#rackmanger').val();
                        rackincharge          = $('#rackincharge').val();
      
         if (store=="") {
         $('#store').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Store is required.');     
         return false;
         } 
         else{
            $('#store').next().find('.select2-selection').removeClass('select-dropdown-error');
         } 
         if (rackname=="") {
         $('#rackname').addClass('is-invalid');
            toastr.warning('Rack Name is required.');     
         return false;
         } 
         else{
            $('#rackname').removeClass('is-invalid');
         } 
  if (rackmanger=="") {
         $('#rackmanger').addClass('is-invalid');
            toastr.warning('Rack Code is required.');     
         return false;
         } 
         else{
            $('#rackmanger').removeClass('is-invalid');
         } 
         
        /* if (rackmanger=="") {
         $('#rackmanger').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Rackmanger is required.');     
         return false;
         } 
         else{
            $('#store').next().find('.select2-selection').removeClass('select-dropdown-error');
         } 
         if (rackincharge=="") {
         $('#rackincharge').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Rackincharge is required.');     
         return false;
         } 
         else{
            $('#store').next().find('.select2-selection').removeClass('select-dropdown-error');
         } */
         
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        if($('#id').val()){
        var sucess_msg ='Updated';
        } else{
        var sucess_msg ='Created';
        }
        $.ajax({
            type      : "POST",
            url       : "rackmanagement_submit",
            dataType  : "json",
            data : {
                        _token                : $('#token').val(),
                        id                    : $('#id').val(),
                        warehouse             : $('#warehouse').val(),
                        store                 : $('#store').val(),
                        rackname              : $('#rackname').val(),
                        rackmanger            : $('#rackmanger').val(),
                        rackincharge          : $('#rackincharge').val(),
                        branch                : $('#branch').val(),
                        checkedValue     : $('#default').is(":checked"),
                    },
            success: function(data){
              if(data == 'false')
          {
            $('#rackmanagement_submit').removeClass('kt-spinner');
            $('#rackmanagement_submit').prop("disabled", false);
            toastr.warning('Rack name already exist');
          }
          else
          {
                  $('#rackmanagement_submit').removeClass('kt-spinner');
                  $('#rackmanagement_submit').prop("disabled", false);
                  rackmanagement_table.ajax.reload();
                  toastr.success('Rack Management Details '+sucess_msg+' Successfuly');
                  window.location.href="RackManagement";
                }
            },
            error   : function ( jqXhr, json, errorThrown )
            {
             console.log('Error !!');
            }
          });
        });


// $(document).ready(function(){
// var table = $('#rackmanagement_list').DataTable({
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
//             "url" : 'rackmanagement_list',
//             "type": "POST",
//             "data": function ( data ) {
//                 data._token = $('#token').val()
//             }
//         }

//     })
// });
/**
*Rack Management data delete
*/
$(document).on('click', '.kt_rack_management_delete', function () {
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
              url : 'deleterack',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
              swal.fire("Deleted!", "Your Entry has been deleted.", "success");
             location.reload();
             }
          });
          } else {
            swal.fire("Cancelled", "Your   Entry is safe ", "error");
          }
        })
       });
/**
*Rack management trash data listing
*/
  var rackmanagement_trash_table = $('#rackmanagement_trash_list').DataTable({
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
                  columns: [0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3, 4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50];
                  doc.content[1].table.widths = [ '10%', '40%', '50%'];
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3, 4]
              }
          }
      ],

      ajax: {
          "url": 'Trash-RackManagement',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'storename', name: 'storename' },
          { data: 'rack_name', name: 'rack_name' },
           { data: 'rack_manager', name: 'rack_manager' },
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
                        <a href="#?id='+row.id+'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-refresh-arrow"></i>\
                        <span class="kt-nav__link-text kt_rack_management_recover" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
              }
          },
      ]
  });
// $(document).ready(function(){
// var table = $('#rackmanagement_trash_list').DataTable({
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
//             "url" : 'rackmanagement_trash_list',
//             "type": "POST",
//             "data": function ( data ) {
//                 data._token = $('#token').val()
//             }
//         }

//     })
// });
/**
*Rack management Data Recover
*/
      $(document).on('click', '.kt_rack_management_recover', function () {
      var id = $(this).attr('id');
        $.ajax({
              type: "POST",
              url : 'restorerack',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Done", "Restore Sucessfully", "success");
                  location.reload();
                  window.location.href="RackManagement";
             }
          });
         
        });
/**
   *Rack Management DataTable Export
*/
  $("#rackmanagement_list_print").on("click", function() {
      rackmanagement_table.button('.buttons-print').trigger();
  });
  $("#rackmanagement_list_copy").on("click", function() {
      rackmanagement_table.button('.buttons-copy').trigger();
  });
  $("#rackmanagement_list_csv").on("click", function() {
      rackmanagement_table.button('.buttons-csv').trigger();
  });
  $("#rackmanagement_list_pdf").on("click", function() {
      rackmanagement_table.button('.buttons-pdf').trigger();
  });

/**
   *Rack management trash DataTable Export
*/
  $("#rackmanagement_trash_list_print").on("click", function() {
      rackmanagement_trash_table.button('.buttons-print').trigger();
  });
  $("#rackmanagement_trash_list_copy").on("click", function() {
      rackmanagement_trash_table.button('.buttons-copy').trigger();
  });
  $("#rackmanagement_trash_list_csv").on("click", function() {
      rackmanagement_trash_table.button('.buttons-csv').trigger();
  });
  $("#rackmanagement_trash_list_pdf").on("click", function() {
      rackmanagement_trash_table.button('.buttons-pdf').trigger();
  });

/**
*Rack management data trash delete
*/
      $(document).on('click', '.kt_rack_management_trashdelete', function () {
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
              url : 'deleterackdetails',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Deleted!", "Your Entry has been deleted.", "success");
             location.reload();
             }
          });
          } else {
            swal.fire("Cancelled", "Your   Entry is safe ", "error");

          }
        })
        });
    