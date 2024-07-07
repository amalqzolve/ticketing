/**
 *Datatable for Product Category
 */
var productcategory_table = $('#productcategory_list').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50];
                  doc.content[1].table.widths = [ '10%', '30%', '10%', '50%'];
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],
      ajax: {
          "url": 'CategoryList',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'category_name', name: 'category_name' },
          { data: 'category_code', name: 'category_code' },
          { data: 'id', name: 'id' },
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
                        <a href="edit_category?id=' + row.id + '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text Productcategorydelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },

      ]
  });
/**
   *Product Category DataTable Export
*/

  $("#productcategory_list_print").on("click", function() {
      productcategory_table.button('.buttons-print').trigger();
  });
  $("#productcategory_list_copy").on("click", function() {
      productcategory_table.button('.buttons-copy').trigger();
  });
  $("#productcategory_list_csv").on("click", function() {
      productcategory_table.button('.buttons-csv').trigger();
  });
  $("#productcategory_list_pdf").on("click", function() {
      productcategory_table.button('.buttons-pdf').trigger();
  });

/**
   *Product Category trash DataTable Export
*/
  $("#productcategory_trash_print").on("click", function() {
      productcategory_trash_table.button('.buttons-print').trigger();
  });
  $("#productcategory_trash_copy").on("click", function() {
      productcategory_trash_table.button('.buttons-copy').trigger();
  });
  $("#productcategory_trash_csv").on("click", function() {
      productcategory_trash_table.button('.buttons-csv').trigger();
  });
  $("#productcategory_trash_pdf").on("click", function() {
      productcategory_trash_table.button('.buttons-pdf').trigger();
  });


    /**
     *Datatable for Product Category trash
     */
var productcategory_trash_table = $('#productcategory_trash').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50];
                  doc.content[1].table.widths = [ '10%', '30%', '10%', '50%'];
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],
      ajax: {
          "url": 'CategoryTrash',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'category_name', name: 'category_name' },
          { data: 'category_code', name: 'category_code' },
          { data: 'id', name: 'id' },
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
                        <a href="#?id='+row.id+'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-refresh-arrow"></i>\
                        <span class="kt-nav__link-text productCategory_restore" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text Productcategorytrashdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
    });
    /**
    *Produt Category Restore
    */
    $(document).on('click', '.productCategory_restore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Product Category Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'ProductCategoryRestoreTrash',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Restored!", "Your Product Category Entry has been Restored.", "success");
                window.location.href="CategoryList";
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
    $(document).on('click', '.Productcategorytrashdelete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Invoice Product Category  Details Entry also loss these  Details!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'trashdelete-category',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Deleted!", "Your  Invoice Product Category has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Invoice  Product Units Entry is safe ", "error");
            }
        })
    });
    /**
    *Product Category submit action
    */
    $(document).on('click', '#Productcategorysubmit', function(e) {
        e.preventDefault();
        categoryname = $('#categoryname').val();
        categorycode = $('#categorycode').val();
        startingnumber = $('#startingnumber').val();
        if (categoryname == "") {
            $('#categoryname').addClass('is-invalid');
            toastr.warning('Category Name is required.');      
            return false;
        } else {
            $('#categoryname').removeClass('is-invalid');
        }

           if (categorycode == "") {
            $('#categorycode').addClass('is-invalid');
            toastr.warning('Category Name is required.');      
            return false;
        } else {
            $('#categorycode').removeClass('is-invalid');
        }


      /*  if (startingnumber == "") {
            $('#startingnumber').addClass('is-invalid');
            toastr.warning('Starting Number is required.');      
            return false;
        } else {
            $('#startingnumber').removeClass('is-invalid');
        }*/
        
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        if($('#id').val()){
        var sucess_msg ='Updated';
        } else{
        var sucess_msg ='Created';
        }
        $.ajax({
            type: "POST",
            url: "submit-category",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                categoryname: $('#categoryname').val(),
                categorycode: $('#categorycode').val(),
                startingnumber: $('#startingnumber').val(),
                description: $('#description').val(),
                branch : $('#branch').val()
            },
            success: function(data) {
              console.log(data);
                if(data == 0)
                {
                  $('#Productcategorysubmit').removeClass('kt-spinner');
                  $('#Productcategorysubmit').prop("disabled", false);
                  toastr.warning('Category name already exist');
                }
                else
                {
                        $('#Productcategorysubmit').removeClass('kt-spinner');
                        $('#Productcategorysubmit').prop("disabled", false);
                        productcategory_table.ajax.reload();
                        toastr.success('Product Category Details '+sucess_msg+' Successfuly');
                      window.location.href = "CategoryList";
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

    $(document).on('click', '.Productcategorydelete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Invoice Product Category  Details Entry!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'delete-category',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Deleted!", "Your  Invoice Product Category has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Invoice  Product Units Entry is safe ", "error");
            }
        })
    });

