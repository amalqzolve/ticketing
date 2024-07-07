  /**
     *Datatable for department
     */
 
  var departmentdetails_list = $('#departmentdetails_list').DataTable({
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
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1,2]
              }
          }
      ],

      ajax: {
          "url": 'Department',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'name', name: 'name' },
          { data: 'note', name: 'note' },
          
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                         <a href="edit_department?id=' + row.id + '" data-type="edit"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Update</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_departmentdetails" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';

            }
          },

      ]
  });
     /**
     *Datatable for department trash
     */
 
  var trashdepartment_table = $('#trashdepartmentdetails_list').DataTable({
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
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1,2]
              }
          }
      ],

      ajax: {
          "url": 'departmenttrash',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'name', name: 'name' },
          { data: 'note', name: 'note' },
          
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
                        <i class="kt-nav__link-icon flaticon-upload-1h"></i>\
                        <span class="kt-nav__link-text kt_del_restoredepartment" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';

            }
          },

      ]
  });



     /**
     *department submission
     */

$(document).on('click', '#department_submit', function(e){
       e.preventDefault();
    name = $('#name').val();

    if (name == "") {
        $('#name').addClass('is-invalid');
        return false;
    } else {
        $('#name').removeClass('is-invalid');
    }
   
  
    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }


        $.ajax({
            type : "POST",
            url  : "departmentSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        id               : $('#id').val(),
                        name             : $('#name').val(),
                        note             : $('#note').val(),
                        branch           : $('#branch').val()
                        
                        
                    },
            success: function(data){
                  swal.fire("Done", "Submission Sucessfully", "success");
                  location.reload();
                  window.location.href="Department";
            },
            error   : function ( jqXhr, json, errorThrown )
            {
                var errors = jqXhr.responseJSON;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    if(jQuery.isPlainObject( value )){

                      $.each(value, function( index, ndata ) {
                        errorsHtml += '<li>' + ndata + '</li>';
                      });

                    }else{

                    errorsHtml += '<li>' + value + '</li>';

                    }
                });
               toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });

        return false;

    });
/**
*Department data deletion
*/

$(document).on('click', '.kt_del_departmentdetails', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Department Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
            }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: 'deletedepartment',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {
                    swal.fire("Deleted!", "Your Department Entry has been deleted.", "success");
                    departmentdetails_list.ajax.reload();
                    departmentdetails_list.fnDraw();

                }
            });
        } else {
            swal.fire("Cancelled", "Your Department Entry is safe :)", "error");

        }
    })
});

/**
*Department data restore
*/

$(document).on('click', '.kt_del_restoredepartment', function() {
    var id = $(this).attr('id');
    
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Department Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: 'departmenttrashlist',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {
                    swal.fire("Restored!", "Your Department Entry has been Restored.", "success");
                    window.location.href ="Department";
                  
                }
            });
        } else {
            swal.fire("Cancelled", "Your Department Entry is safe :)", "error");

        }
    })
});

/**
*Department DataTable Export
*/

  $("#departmentdetails_list_print").on("click", function() {
      departmentdetails_list.button('.buttons-print').trigger();
  });


  $("#departmentdetails_list_copy").on("click", function() {
      departmentdetails_list.button('.buttons-copy').trigger();
  });

  $("#departmentdetails_list_csv").on("click", function() {
      departmentdetails_list.button('.buttons-csv').trigger();
  });

  $("#departmentdetails_list_pdf").on("click", function() {
      departmentdetails_list.button('.buttons-pdf').trigger();
  });

  /**
  *Department trash DataTable Export
  */

  $("#departmentdetails_trash_list_print").on("click", function() {
      trashdepartment_table.button('.buttons-print').trigger();
  });


  $("#departmentdetails_trash_list_copy").on("click", function() {
      trashdepartment_table.button('.buttons-copy').trigger();
  });

  $("#departmentdetails_trash_list_csv").on("click", function() {
      trashdepartment_table.button('.buttons-csv').trigger();
  });

  $("#departmentdetails_trash_list_pdf").on("click", function() {
      trashdepartment_table.button('.buttons-pdf').trigger();
  });