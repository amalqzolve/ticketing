/**
 *Datatable for Supplier Category Information
 */
var suppliercategorydetails_list_table = $('#suppliercategorydetails_list').DataTable({
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
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
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
                columns: [0, 1, 2, 3, 4, 5]
            }
        }
    ],

    ajax: {
        "url": 'suppliercategory',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },
        { data: 'discription', name: 'discription' },

        {
            data: 'color',
            name: 'color',
            render: function(data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
            }
        },
        { data: 'customcode', name: 'customcode' },
        { data: 'startfrom', name: 'startfrom' },

        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_8"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text suppliercategorydetail_update" id=' + row.id + ' data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_suppliercatgryinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});
/**
 *Supplier Category Information DataTable Export
 */

$("#suppliercategorydetails_list_print").on("click", function() {
    suppliercategorydetails_list_table.button('.buttons-print').trigger();
});


$("#suppliercategorydetails_list_copy").on("click", function() {
    suppliercategorydetails_list_table.button('.buttons-copy').trigger();
});

$("#suppliercategorydetails_list_csv").on("click", function() {
    suppliercategorydetails_list_table.button('.buttons-csv').trigger();
});

$("#suppliercategorydetails_list_pdf").on("click", function() {
    suppliercategorydetails_list_table.button('.buttons-pdf').trigger();
});


/**
 *Supplier Category trash DataTable Export
 */

$("#trashdetailslistsuppliercategory_print").on("click", function() {
    suppliercategorydetails_trash_table.button('.buttons-print').trigger();
});


$("#trashdetailslistsuppliercategory_copy").on("click", function() {
    suppliercategorydetails_trash_table.button('.buttons-copy').trigger();
});

$("#trashdetailslistsuppliercategory_csv").on("click", function() {
    suppliercategorydetails_trash_table.button('.buttons-csv').trigger();
});

$("#trashdetailslistsuppliercategory_pdf").on("click", function() {
    suppliercategorydetails_trash_table.button('.buttons-pdf').trigger();
});

/**
 *Dtatable for Supplier Category trash Listing
 */
var suppliercategorydetails_trash_table = $('#sup_ctgrytrashtype').DataTable({
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
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
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
                columns: [0, 1, 2, 3, 4, 5]
            }
        }
    ],

    ajax: {
        "url": 'suppliercatgrytrash',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },
        { data: 'discription', name: 'discription' },

        {
            data: 'color',
            name: 'color',
            render: function(data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
            }
        },
        { data: 'customcode', name: 'customcode' },
        { data: 'startfrom', name: 'startfrom' },

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
                        <span class="kt-nav__link-text sup_cat_typerestore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});
/**
 *Supplier Category restore confirmation message
 */
$(document).on('click', '.sup_cat_typerestore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Supplier Category Entry !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'sup_cat_TrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Supplier Category Entry has been Restored.", "success");
                window.location.href="suppliercategory";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Supplier Category Entry is not recovered :)", "error");

          }
        })
     });

/**
 *Supplier category submit action
 */
$(document).on('click', '#suppliercategorydetail_submit', function(e){
  e.preventDefault();

    title = $('#title').val();
    color = $('#color').val();
    customcode = $('#customcode').val();
    startfrom = $('#startfrom').val();

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
    if (customcode == "") {
        $('#customcode').addClass('is-invalid');
        return false;
    } else {
        $('#customcode').removeClass('is-invalid');

    }
    if (startfrom == "") {
        $('#startfrom').addClass('is-invalid');
        return false;
    } else {
        $('#startfrom').removeClass('is-invalid');

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
        url: "suppliercatgrySubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            title: $('#title').val(),
            discription: $('#discription').val(),
            color: $('#color').val(),
            customcode: $('#customcode').val(),
            startfrom: $('#startfrom').val(),
            branch : $('#branch').val()

        },
        success: function(data) {

          if(data == false)
          {
            $('#suppliercategorydetail_submit').removeClass('kt-spinner');
            $('#suppliercategorydetail_submit').prop("disabled", false);
             toastr.success('Supplier category name is already exist');

          }
          else
          {
            $('#suppliercategorydetail_submit').removeClass('kt-spinner');
            $('#suppliercategorydetail_submit').prop("disabled", false);
            closeModel();
            suppliercategorydetails_list_table.ajax.reload();
            toastr.success('Supplier category ' + sucess_msg + ' successfuly');
          }

        },
        error: function(jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});
/**
 *Supplier category model close  after submission
 */
function closeModel(){

      $("#kt_modal_4_8").modal("hide");

      $('#title').val("");
      $('#color').val("");
      $('#customcode').val("");
      $('#startfrom').val("");
      $('#discription').val("");

      
      $('#id').val("");
      

   }

  $(document).on('click', '.close,.closeBtn', function(){
     closeModel();
  });

/**
  *Supplier Category datas show in update 
*/ 
$(document).on('click', '.suppliercategorydetail_update', function(){
  
           var cust_id = $(this).attr("data-id");
           $.ajax({
                url       : "getsuppliercatgry",
                method    : "GET",
                data      : {
              _token      : $('#token').val(),
              cust_id     : cust_id
                    },
                dataType  : "json",
                success:function(data)
                {
                    $('#title').val(data['users'].title);
                    $('#discription').val(data['users'].discription);
                    $('#color').val(data['users'].color);
                    $('#customcode').val(data['users'].customcode);
                    $('#startfrom').val(data['users'].startfrom);
                     $('#id').val(cust_id);

                     
                   
       
                }
           })
      });


/**
  *Supplier Category delete confirmation message  
*/ 
$(document).on('click', '.kt_del_suppliercatgryinformation', function () {
  
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
              url : 'deletesuppliercatgryInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                console.log(data);
               if(data == 'true')
               {
                 swal.fire("Deleted!", "Your Category has been deleted.", "success");
                 suppliercategorydetails_list_table.ajax.reload();
               }
               else
               {
                 swal.fire("Not Deleted!", "Your Category is used in Supplier Details.", "success");
                 suppliercategorydetails_list_table.ajax.reload();
    
             }
             }
          });
          } else {
            swal.fire("Cancelled", "Your  Entry is safe :)", "error");
          }
        })
       });
