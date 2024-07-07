  /**
  *Datatable for Listing Product Unit Management
  */
  var productunitdetails_table = $('#productunitdetails_list').DataTable({
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
                  // doc.content[1].table.widths = [ '10%', '30%', '10%', '10%', '20%', '20%', '10%'];
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
          "url": 'UnitList',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'unit_name', name: 'unit_name' },
          { data: 'unit_code', name: 'unit_code' },
         { 
            data: 'base_unit', name: 'base_unit', 
            render: function(data, type, row) {
                if (row.base_unit == '1') {
                    return '<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>';
                } else {
                    return '<i class="fa fa-times" aria-hidden="true" style="color: red;"></i>';
                }

            }
          },
          { data: 'parent_unit', name: 'parent_unit' },
          { data: 'unit_value', name: 'unit_value' },
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
                        <a href="edit_productunit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text Productunitdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });
/**
  *Datatable for Listing Product Unit Trash Management
  */
  var productunitdetails_trash_table = $('#productunitdetails_trash').DataTable({
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
          "url": 'unittrash',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'unit_name', name: 'unit_name' },
          { data: 'unit_code', name: 'unit_code' },
          { data: 'base_unit', name: 'base_unit' },
          { data: 'parent_unit', name: 'parent_unit' },
          { data: 'unit_name', name: 'unit_name' },
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
                        <span class="kt-nav__link-text Restoreunitinventory" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text Productunittrashdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });

/**
*Product Unit submit action
*/
    $(document).on('click', '#Productunitsubmit', function(e) {
        e.preventDefault();
        unit_name = $('#unit_name').val();
        unit_code = $('#unit_code').val();
        base_unit = $("#base_unit").val();
        parent_unit = $('#parent_unit').val();
        unit_value = $('#unit_value').val();
        
       
        if (unit_name == "") {
            $('#unit_name').addClass('is-invalid');
            return false;
        } else {
            $('#unit_name').removeClass('is-invalid');
        }
        if (unit_code == "") {
            $('#unit_code').addClass('is-invalid');
            return false;
        } else {
            $('#unit_code').removeClass('is-invalid');
        }
    /*    if (base_unit == "") {
            $('#base_unit').addClass('is-invalid');
            return false;
        } else {
            $('#base_unit').removeClass('is-invalid');
        }
*/
        // if (parent_unit == "") {
        //     $('#parent_unit').next().find('.select2-selection').addClass('select-dropdown-error');
        //     return false;
        // } else {
        //     $('#parent_unit').next().find('.select2-selection').removeClass('select-dropdown-error');
        // }
        if (unit_value == "") {
            $('#unit_value').addClass('is-invalid');
            return false;
        } else {
            $('#unit_value').removeClass('is-invalid');
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
            url: "ProductunitSubmit",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                prounit_id: $('#id').val(),
                unit_name: $('#unit_name').val(),
                unit_code: $('#unit_code').val(),
                base_unit: $("#base_unit").val(),
                parent_unit: $('#parent_unit').val(),
                unit_value: $('#unit_value').val(),
                description: $('#description').val(),
                branch : $('#branch').val()
            },
            success: function(data) {
              console.log(data);
                  if(data == 0)
                  {
                    $('#Productunitsubmit').removeClass('kt-spinner');
                    $('#Productunitsubmit').prop("disabled", false);
                    toastr.warning('Product unit already exist');
                  }
                  else
                  {
                            $('#Productunitsubmit').removeClass('kt-spinner');
                            $('#Productunitsubmit').prop("disabled", false);
                            productunitdetails_table.ajax.reload();
                            toastr.success('Product unit Details '+sucess_msg+' Successfuly');
                            window.location.href = "UnitList";
                          }
            },
            error: function(jqXhr, json, errorThrown) {
                        console.log('Error !!');
            }
        });
    });
/**
*Product Unit Export
*/

  $("#productunitdetails_list_print").on("click", function() {
      productunitdetails_table.button('.buttons-print').trigger();
  });
  $("#productunitdetails_list_copy").on("click", function() {
      productunitdetails_table.button('.buttons-copy').trigger();
  });
  $("#productunitdetails_list_csv").on("click", function() {
      productunitdetails_table.button('.buttons-csv').trigger();
  });
  $("#productunitdetails_list_pdf").on("click", function() {
      productunitdetails_table.button('.buttons-pdf').trigger();
  });

/**
   *Product Unit Trash DataTable Export
*/
  $("#productunitdetails_trash_print").on("click", function() {
      productunitdetails_trash_table.button('.buttons-print').trigger();
  });


  $("#productunitdetails_trash_copy").on("click", function() {
      productunitdetails_trash_table.button('.buttons-copy').trigger();
  });

  $("#productunitdetails_trash_csv").on("click", function() {
      productunitdetails_trash_table.button('.buttons-csv').trigger();
  });

  $("#productunitdetails_trash_pdf").on("click", function() {
      productunitdetails_trash_table.button('.buttons-pdf').trigger();
  });


/**
*Product Unit Delete Action
*/
    $(document).on('click', '.Productunitdelete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Invoice Product Units  Details Entry also loss these  Details!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'DeleteProdctunits',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Deleted!", "Your  Invoice Product Units has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Invoice  Product Units Entry is safe ", "error");
            }
        })
    });
/**
*Product Unit Restore Action
*/
    $(document).on('click', '.Restoreunitinventory', function () {
      var id = $(this).attr('id');
        $.ajax({
              type: "POST",
              url : 'restoreinventoryunit',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Done", "Restore Sucessfully", "success");
                  location.reload();
                  window.location.href="UnitList";
             }
          });
        });
/**
*Product Unit Trash Delete
*/
     $(document).on('click', '.Productunittrashdelete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Invoice Product Units  Details Entry!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'DeleteTrashProdctunits',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {
                   alert( "Data Saved: " + data );
                        swal.fire("Deleted!", "Your  Invoice Product Units has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {
                swal.fire("Cancelled", "Your Invoice  Product Units Entry is safe ", "error");
            }
        })
    });
