  /**
  *Datatable for Attribute Management
  */
  
  var attributedetails_table = $('#attributedetails_list').DataTable({
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
                  doc.content[1].table.widths = [ '10%', '30%', '20%', '40%'];
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
          "url": 'AttributeList',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'attribute_name', name: 'attribute_name' },
          { data: 'attribute_code', name: 'attribute_code' },
          // { data: 'options', name: 'options' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_attribute?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text Attributeandoptiondelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });
  /**
*Product Attribute DataTable Export
*/

  $("#attributedetails_list_print").on("click", function() {
      attributedetails_table.button('.buttons-print').trigger();
  });
  $("#attributedetails_list_copy").on("click", function() {
      attributedetails_table.button('.buttons-copy').trigger();
  });
  $("#attributedetails_list_csv").on("click", function() {
      attributedetails_table.button('.buttons-csv').trigger();
  });
  $("#attributedetails_list_pdf").on("click", function() {
      attributedetails_table.button('.buttons-pdf').trigger();
  });

/**
   *product attribute trash DataTable Export
*/
  $("#attributetrash_list_print").on("click", function() {
      attributetrash_table.button('.buttons-print').trigger();
  });


  $("#attributetrash_list_copy").on("click", function() {
      attributetrash_table.button('.buttons-copy').trigger();
  });

  $("#attributetrash_list_csv").on("click", function() {
      attributetrash_table.button('.buttons-csv').trigger();
  });

  $("#attributetrash_list_pdf").on("click", function() {
      attributetrash_table.button('.buttons-pdf').trigger();
  });

  /**
  *Datatable for Attribute Trash Listing
  */
  var attributetrash_table = $('#attributetrash_list').DataTable({
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
                   doc.content[1].table.widths = [ '10%', '30%', '20%', '40%'];
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
          "url": 'trashlist',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'attribute_name', name: 'attribute_name' },
          { data: 'attribute_code', name: 'attribute_code' },
          { data: 'options', name: 'options' },
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
                        <span class="kt-nav__link-text attributerestore" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text Attributeandoptiontrashdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });
/**
*Product Unit Restore Action
*/
    $(document).on('click', '.attributerestore', function () {
      var id = $(this).attr('id');
        $.ajax({
              type: "POST",
              url : 'attributerestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Done", "Restore Sucessfully", "success");
                  location.reload();
                  window.location.href="AttributeList";
             }
          });
        });



  /**
  *Datatable for Attribute Submit
  */
    $(document).on('click', '#attributeandoptionsubmit', function(e) {
        e.preventDefault();
        attribute_name = $('#attribute_name').val();
        attribute_code = $('#attribute_code').val();
        options = $('#options').val();
        // note = $('#description').val();

        if (attribute_name == "") {
            $('#attribute_name').addClass('is-invalid');
            toastr.warning('Attribute Name is required.');      
            return false;
        } else {
            $('#attribute_name').removeClass('is-invalid');
        }
        if (attribute_code == "") {
            $('#attribute_code').addClass('is-invalid');
            toastr.warning('Attribute Code is required.');      
            return false;
        } else {
            $('#attribute_code').removeClass('is-invalid');
        }

        if (options == "") {
            $('.tagify').addClass('is-invalid');
            toastr.warning('Options is required.');     
            return false;
        } else {
            $('.tagify').removeClass('is-invalid');
        }

        // if (note == "") {
        //     $('#description').addClass('is-invalid');
        //     return false;
        // } else {
        //     $('#description').removeClass('is-invalid');
        // }
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        if($('#id').val()){
        var sucess_msg ='Updated';
        } else{
        var sucess_msg ='Created';
        }
        $.ajax({
            type: "POST",
            url: "submit-attribute",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                attribute_name: $('#attribute_name').val(),
                attribute_code: $('#attribute_code').val(),
                options: $('#options').val(),
                description : $('#description').val(),
                branch : $('#branch').val()
            },
            success: function(data) {
          if(data == 'false')
          {
            $('#attributeandoptionsubmit').removeClass('kt-spinner');
            $('#attributeandoptionsubmit').prop("disabled", false);
            toastr.warning('Already exist');
          }
          else
          {
              $('#attributeandoptionsubmit').removeClass('kt-spinner');
              $('#attributeandoptionsubmit').prop("disabled", false);
              attributedetails_table.ajax.reload();
              toastr.success('Product Attribute Details '+sucess_msg+' Successfuly');
              window.location.href = "AttributeList";
          }
            },
            error: function(jqXhr, json, errorThrown) {
              console.log('Error !!');
            }
        });
    });

    $(document).on('click', '.Attributeandoptiontrashdelete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Invoice Attribute And Options  Details Entry also loss these  Details!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'trashdelete-attribute',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Deleted!", "Your  Invoice Attribute And Options  has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Invoice  Product Units Entry is safe ", "error");
            }
        })
    });
/**
  *Datatable for product attribute delete confirmation message
  */
    $(document).on('click', '.Attributeandoptiondelete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Invoice Attribute And Options  Details Entry also loss these  Details!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'delete-attribute',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Deleted!", "Your  Invoice Attribute And Options  has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Invoice  Product Units Entry is safe ", "error");
            }
        })
    });

