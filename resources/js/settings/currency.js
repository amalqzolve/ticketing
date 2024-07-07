var currency_list_table = $('#currency_list').DataTable({
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
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '20%', '10%','15%'];
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
          "url": 'settingscurrency',
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
                        <a href="settingsedit_currency?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a href="settingsCurrencyView?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text currencydelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },

      ]
  });


var currency_trash_list_table = $('#currency_trash_list').DataTable({
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
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '20%', '10%','15%'];
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
          "url": 'settingsCurrencyTrash',
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
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
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
function Currency_cancel()
{
    window.location.href="settingscurrency";
}

$(document).on('click', '#currency_submit', function(e) {
  // alert("ad");
    e.preventDefault();

        currency_name = $('#currency_name').val();
        value         = $('#value').val();
        symbol        = $('#symbol').val();
        notes         = $('#notes').val();

        if (currency_name == ""){
            $('#currency_name').addClass('is-invalid');
            return false;
        }else{
            $('#currency_name').removeClass('is-invalid');
        }

        if (value == "") {
            $('#value').addClass('is-invalid');
            return false;
        } else {
             $('#value').removeClass('is-invalid');
         }

        if (symbol == "") {
            $('#symbol').addClass('is-invalid');
            return false;
        } else {
            $('#symbol').removeClass('is-invalid');
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
        url: "settingscurrencysubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            currency_name : $('#currency_name').val(),
            value         : $('#value').val(),
            symbol        : $('#symbol').val(),
            notes         : $('#notes').val(),
            checkedValue  : $('#default').is(":checked"),
            branch        : $("#branch").val()
        },
        success: function(data) {

         

          if(data == 3)
          {
            $('#currency_submit').removeClass('kt-spinner');
            $('#currency_submit').prop("disabled", false);
             toastr.success(currency_name+' Currency Name already exist');

           }
           if(data == 2)
           {
             $('#currency_submit').removeClass('kt-spinner');
             $('#currency_submit').prop("disabled", false);
              window.location.href = "settingscurrency";
             toastr.success('currency '+sucess_msg+' successfuly');
             closeModel();
           }

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
                    url: 'settingsdelete-currency',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {
                      if(data == 'true')
                      {
                        swal.fire("Deleted!", "Your Entry has been deleted.", "success");
                        location.reload();
                      }
                      else
                      {
                        swal.fire("Not Deleted!", "This Currency is already used", "success");
                        location.reload();
                      }
                        
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
                    url: 'settingsrestore-currency',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Restored!", "Your Entry has been restored.", "success");
                        window.location.href="settingscurrency";
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
                    url: 'settingstrashdelete-currency',
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

  $("#currency_list_print").on("click", function() {
      currency_list_table.button('.buttons-print').trigger();
  });


  $("#currency_list_copy").on("click", function() {
      currency_list_table.button('.buttons-copy').trigger();
  });

  $("#currency_list_csv").on("click", function() {
      currency_list_table.button('.buttons-csv').trigger();
  });

  $("#currency_list_pdf").on("click", function() {
      currency_list_table.button('.buttons-pdf').trigger();
  });
  $("#currency_trash_list_print").on("click", function() {
      currency_trash_list_table.button('.buttons-print').trigger();
  });


  $("#currency_trash_list_copy").on("click", function() {
      currency_trash_list_table.button('.buttons-copy').trigger();
  });

  $("#currency_trash_list_csv").on("click", function() {
      currency_trash_list_table.button('.buttons-csv').trigger();
  });

  $("#currency_trash_list_pdf").on("click", function() {
      currency_trash_list_table.button('.buttons-pdf').trigger();
  });