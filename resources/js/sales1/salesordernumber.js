var salesordernumber_list_table = $('#salesordernumber_list').DataTable({
      processing: true,
      serverSide: true,
      scrollX: true,
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
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
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
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          }
      ],

      ajax: {
          "url": 'salesordernumber',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'name', name: 'name' },
          { data: 'code', name: 'code' },
          { data: 'startingnumber', name: 'startingnumber' },
          
          
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="salesordernumber_edit?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text salesordernumber_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';


              }
          },
      ]
  });

$(document).on('click', '#salesordernumber_submit', function(e) {
    e.preventDefault();

        name = $('#name').val();
        code         = $('#code').val();
        startingnumber         = $('#startingnumber').val();

        if (name == ""){
            $('#name').addClass('is-invalid');
            return false;
        }else{
            $('#name').removeClass('is-invalid');
        }

        if (code == "") {
            $('#code').addClass('is-invalid');
            return false;
        } else {
             $('#code').removeClass('is-invalid');
         }
         if (startingnumber == "") {
            $('#startingnumber').addClass('is-invalid');
            return false;
        } else {
             $('#startingnumber').removeClass('is-invalid');
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
        url: "salesordernumbersubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            name      : $('#name').val(),
            code: $('#code').val(),
            startingnumber : $('#startingnumber').val(),
            branch : $('#branch').val()
        },
        success: function(data) {

      if(data == false)
          {
            $('#salesordernumber_submit').removeClass('kt-spinner');
            $('#salesordernumber_submit').prop("disabled", false);
             toastr.warning('Sales order Name is already exist');

          }
          else
          {
             $('#salesordernumber_submit').removeClass('kt-spinner');
             $('#salesordernumber_submit').prop("disabled", false);
              window.location.href = "salesordernumber";
             toastr.success('Sales Order Number '+sucess_msg+' successfuly');
             closeModel();
           }

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

$(document).on('click', '.salesordernumber_delete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'delete-salesordernumber',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Deleted!", "Your Entry has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Entry is safe :)", "error");
            }
        })
    });
var salesordernumber_trash_list_table = $('#salesordernumber_trash_list').DataTable({
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
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
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
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          }
      ],

      ajax: {
          "url": 'salesordernumberTrash',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'name', name: 'name' },
          { data: 'code', name: 'code' },
          { data: 'startingnumber', name: 'startingnumber' },
          
          
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {

return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text salesordernumber_restore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';

                  
              }
          },
      ]
  });
$(document).on('click', '.salesordernumber_restore', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will be able to recover this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Restore it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'salesordernumbernumber_restore',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Restore!", "Your Entry has been restored.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Entry is safe :)", "error");
            }
        })
    });
$("#salesordernumber_list_print").on("click", function() {
      salesordernumber_list_table.button('.buttons-print').trigger();
  });


  $("#salesordernumber_list_copy").on("click", function() {
      salesordernumber_list_table.button('.buttons-copy').trigger();
  });

  $("#salesordernumber_list_csv").on("click", function() {
      salesordernumber_list_table.button('.buttons-csv').trigger();
  });

  $("#salesordernumber_list_pdf").on("click", function() {
      salesordernumber_list_table.button('.buttons-pdf').trigger();
  });
  $("#salesordernumber_trash_list_print").on("click", function() {
      salesordernumber_trash_list_table.button('.buttons-print').trigger();
  });


  $("#salesordernumber_trash_list_copy").on("click", function() {
      salesordernumber_trash_list_table.button('.buttons-copy').trigger();
  });

  $("#salesordernumber_trash_list_csv").on("click", function() {
      salesordernumber_trash_list_table.button('.buttons-csv').trigger();
  });

  $("#salesordernumber_trash_list_pdf").on("click", function() {
      salesordernumber_trash_list_table.button('.buttons-pdf').trigger();
  });