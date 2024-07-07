var vatgroups_list_table = $('#vatgroups_list').DataTable({
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
          "url": 'vatgroup',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'vatgroup_name', name: 'vatgroup_name' },
          {data: 'total', name: 'total' },
          {data: 'description', name: 'description' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_taxgroup?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text taxgroupdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },

      ]
  });


var vatgroups_trash_list_table = $('#vatgroups_trash_list').DataTable({
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
          "url": 'vatgroupsTrash',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'currency_name', name: 'currency_name' },
          { data: 'value', name: 'value' },
          {data: 'symbol', name: 'symbol' },
          {data: 'note', name: 'note' },
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
                        <span class="kt-nav__link-text currencyrestore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text currencytrashdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },

      ]
  });

$(document).on('click', '#vatgroup_submit', function(e) {
    e.preventDefault();

        vatgroup_name = $('#vatgroup_name').val();
        vats         = $('#vats').val();
        description   = $('#description').val();


        if (vatgroup_name == ""){
            $('#vatgroup_name').addClass('is-invalid');
            return false;
        }else{
            $('#vatgroup_name').removeClass('is-invalid');
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
        url: "vatgroupsubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            vatgroup_name : $('#vatgroup_name').val(),
            vats         : $('#vats').val(),
            description   : $('#description').val()
        },
        success: function(data) {
          console.log(data);

             $('#vatgroup_submit').removeClass('kt-spinner');
             $('#vatgroup_submit').prop("disabled", false);
              window.location.href = "vatgroup";
             toastr.success('Vat Groups '+sucess_msg+' successfuly');
             closeModel();


        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

$(document).on('click', '.cancel', function() {

    closeModel();

});

function closeModel() {
    $('#currency_name').val("");
    $('#value').val("");
    $('#symbol').val("");
    $('#notes').val("");


}

  $(document).on('click', '.currencydelete', function() {
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
                    url: 'delete-currency',
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
   $(document).on('click', '.currencyrestore', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will be able to recover this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'restore-currency',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Restored!", "Your Entry has been restored.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Entry is safe :)", "error");
            }
        })
    });
    $(document).on('click', '.currencytrashdelete', function() {
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
                    url: 'trashdelete-currency',
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

  $("#vatgroups_list_print").on("click", function() {
      vatgroups_list_table.button('.buttons-print').trigger();
  });


  $("#vatgroups_list_copy").on("click", function() {
      vatgroups_list_table.button('.buttons-copy').trigger();
  });

  $("#vatgroups_list_csv").on("click", function() {
      vatgroups_list_table.button('.buttons-csv').trigger();
  });

  $("#vatgroups_list_pdf").on("click", function() {
      vatgroups_list_table.button('.buttons-pdf').trigger();
  });
  $("#currency_trash_list_print").on("click", function() {
      vatgroups_trash_list_table.button('.buttons-print').trigger();
  });


  $("#currency_trash_list_copy").on("click", function() {
      vatgroups_trash_list_table.button('.buttons-copy').trigger();
  });

  $("#currency_trash_list_csv").on("click", function() {
      vatgroups_trash_list_table.button('.buttons-csv').trigger();
  });

  $("#currency_trash_list_pdf").on("click", function() {
      vatgroups_trash_list_table.button('.buttons-pdf').trigger();
  });


  $(document).ready(function() {
       $('.kt-select2').select2();
   });