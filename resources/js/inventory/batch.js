/**
 *Datatable for Product Category
 */
var batch_list_table = $('#batch_list').DataTable({
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
                  columns: [0, 1, 2]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2]
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
                  columns: [0, 1, 2]
              }
          }
      ],
      ajax: {
          "url": 'Batchlist',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'batchname', name: 'batchname' },
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
                        <a href="edit_batch?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text batchdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },

      ]
  });
/**
   *Product Category DataTable Export
*/

  $("#batch_list_print").on("click", function() {
      batch_list_table.button('.buttons-print').trigger();
  });
  $("#batch_list_copy").on("click", function() {
      batch_list_table.button('.buttons-copy').trigger();
  });
  $("#batch_list_csv").on("click", function() {
      batch_list_table.button('.buttons-csv').trigger();
  });
  $("#batch_list_pdf").on("click", function() {
      batch_list_table.button('.buttons-pdf').trigger();
  });

/**
   *Product Category trash DataTable Export
*/
 


    /**
     *Datatable for Product Category trash
     */
var batch_trash_list_table = $('#batch_trash_list').DataTable({
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
                  columns: [0, 1, 2]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2]
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
                  columns: [0, 1, 2]
              }
          }
      ],
      ajax: {
          "url": 'batchTrash',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'batchname', name: 'batchname' },
          {data: 'id', name: 'id' },
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
                        <span class="kt-nav__link-text batch_restore" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
              }
          },
      ]
    });

 $("#batch_trash_list_print").on("click", function() {
      batch_trash_list_table.button('.buttons-print').trigger();
  });
  $("#batch_trash_list_copy").on("click", function() {
      batch_trash_list_table.button('.buttons-copy').trigger();
  });
  $("#batch_trash_list_csv").on("click", function() {
      batch_trash_list_table.button('.buttons-csv').trigger();
  });
  $("#batch_trash_list_pdf").on("click", function() {
      batch_trash_list_table.button('.buttons-pdf').trigger();
  });
    /**
    *Produt Category Restore
    */
    $(document).on('click', '.batch_restore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'batch_restore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Restored!", "Your entry Restored.", "success");
                window.location.href="Batchlist";
             }
          });
          } else {
            swal.fire("Cancelled", "Your Product Category Entry is not Safe ", "error");
          }
        })
     });
    /**
    *Function call for trash delete button
    */
    $(document).on('click', '.batchtrashdelete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this  Entry also loss these  Details!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'trashdelete-batch',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Deleted!", "Your entry has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Entry is safe ", "error");
            }
        })
    });
    /**
    *Product Category submit action
    */
    $(document).on('click', '#batch_submit', function(e) {
        e.preventDefault();
        batchname = $('#batchname').val();
        if (batchname == "") {
            $('#batchname').addClass('is-invalid');
            toastr.warning('Batch Name is required.');      
            return false;
        } else {
            $('#batchname').removeClass('is-invalid');
        }
        
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        if($('#id').val()){
        var sucess_msg ='Updated';
        } else{
        var sucess_msg ='Created';
        }
        $.ajax({
            type: "POST",
            url: "submit-batch",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                batchname: $('#batchname').val(),
                description: $('#description').val(),
                branch : $('#branch').val()
            },
            success: function(data) {
              console.log(data);
          if(data == 0)
          {
            $('#batch_submit').removeClass('kt-spinner');
            $('#batch_submit').prop("disabled", false);
            toastr.warning('Batch name already exist');
          }
          else
          {
                  $('#batch_submit').removeClass('kt-spinner');
                  $('#batch_submit').prop("disabled", false);
                  batch_list_table.ajax.reload();
                  toastr.success('Batch Details '+sucess_msg+' Successfuly');
                window.location.href = "Batchlist";
              }
            },
            error: function(jqXhr, json, errorThrown) { 
                console.log('Error !!');
            }
        });
    });
/**
    *Function call for product category delete button
*/

    $(document).on('click', '.batchdelete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Entry!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'delete-batch',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Deleted!", "Your entry has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Invoice  Product Units Entry is safe ", "error");
            }
        })
    });

