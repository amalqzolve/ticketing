/**
 *Datatable for Supplier Group Information
 */
var suppliergroup_listtable = $('#suppliergroup_list').DataTable({
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
        "url": 'suppliergroup',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },
        { data: 'description', name: 'description' },

        {
            data: 'color',
            name: 'color',
            render: function(data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
            }
        },
        

        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_10"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text suppliergrupdetail_update" id=' + row.id + ' data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_suppliergrupinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});



/**
 *Datatable for Supplier Group  trash Information
 */
var suppliergroup_trash_listtable = $('#suppliergrouptrash').DataTable({
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
        "url": 'suppliertrashshows',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },
        { data: 'description', name: 'description' },

        {
            data: 'color',
            name: 'color',
            render: function(data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
            }
        },
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
                        <span class="kt-nav__link-text suppliergruprestore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});
/**
   *Supplier Group  restore  conformation message
 */
$(document).on('click', '.suppliergruprestore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Supplier group Entry Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'suppliergrupTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Supplier group Entry has been Restored.", "success");
                window.location.href="suppliergroup";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Supplier group is not Restored :)", "error");

          }
        })
     });



/**
   *Supplier group Submission
 */
$(document).on('click', '#suppliergroupdetail_submit', function(e){
e.preventDefault();

    title = $('#title').val();
    color = $('#color').val();

    if (title == "") {
        $('#title').addClass('is-invalid');
        return false;
    } else {
        $('#title').removeClass('is-invalid');
    }
    if (color == "") {
        $('#color').addClass('is-invalid');
        return false;
    } else {
        $('#color').removeClass('is-invalid');

    }
    
    



    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }


    $.ajax({
        type: "POST",
        url: "suppliergroupSubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            title: $('#title').val(),
            description: $('#description').val(),
            color: $('#color').val(),
            branch : $('#branch').val()
            

        },
        success: function(data) {

          if(data == false)
          {
            $('#suppliergroupdetail_submit').removeClass('kt-spinner');
            $('#suppliergroupdetail_submit').prop("disabled", false);
             toastr.success('Supplier group name is already exist');

          }
          else
          {
            $('#suppliergroupdetail_submit').removeClass('kt-spinner');
            $('#suppliergroupdetail_submit').prop("disabled", false);
            closeModel();
            suppliergroup_listtable.ajax.reload();
            toastr.success('Supplier group ' + sucess_msg + ' successfuly');
          }

        },
        error: function(jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});

/**
 *Supplier group  Information DataTable Export
 */

$("#suppliergroup_list_print").on("click", function() {
    suppliergroup_listtable.button('.buttons-print').trigger();
});


$("#suppliergroup_list_copy").on("click", function() {
    suppliergroup_listtable.button('.buttons-copy').trigger();
});

$("#suppliergroup_list_csv").on("click", function() {
    suppliergroup_listtable.button('.buttons-csv').trigger();
});

$("#suppliergroup_list_pdf").on("click", function() {
    suppliergroup_listtable.button('.buttons-pdf').trigger();
});

/**
  *Supplier group close model after submission
 */
function closeModel(){

    $("#kt_modal_4_10").modal("hide");
    $('#title').val("");
    $('#description').val("");
    $('#color').val("");

    $('#id').val("");
      

   }

  $(document).on('click', '.close,.closeBtn', function(){
     closeModel();
  });

/**
  *Supplier Group updation
*/ 
$(document).on('click', '.suppliergrupdetail_update', function(){
           var cust_id = $(this).attr("data-id");
           $.ajax({
                url       : "getsuppliergrup",
                method    : "POST",
                data      : {
              _token      : $('#token').val(),
              cust_id     : cust_id
                    },
                dataType  : "json",
                success:function(data)
                {
                    $('#title').val(data['users'].title);
                    $('#description').val(data['users'].description);
                    $('#color').val(data['users'].color);
                     
                     $('#id').val(cust_id);
                    


                    }
                   
       
              
           })
      });


/**
  *Supplier Group delete confirmation messsage
*/  

$(document).on('click', '.kt_del_suppliergrupinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Entry  Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {
        $.ajax({
              type: "POST",
              url : 'deletesuppliergrupInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                console.log(data);
               if(data == 'true')
               {
                 swal.fire("Deleted!", "Your Group has been deleted.", "success");
                 suppliergroup_listtable.ajax.reload();
               }
               else
               {
                 swal.fire("Not Deleted!", "Your Group is used in Supplier Details.", "success");
                 suppliergroup_listtable.ajax.reload();
    }
             }
          });
          } else {
            swal.fire("Cancelled", "Your Entry is safe :)", "error");
          }
        })
       });
/**
 *Supplier group  trash DataTable Export
 */

$("#suppliergrouptrash_print").on("click", function() {
    suppliergroup_trash_listtable.button('.buttons-print').trigger();
});


$("#suppliergrouptrash_copy").on("click", function() {
    suppliergroup_trash_listtable.button('.buttons-copy').trigger();
});

$("#suppliergrouptrash_csv").on("click", function() {
    suppliergroup_trash_listtable.button('.buttons-csv').trigger();
});

$("#suppliergrouptrash_pdf").on("click", function() {
    suppliergroup_trash_listtable.button('.buttons-pdf').trigger();
});