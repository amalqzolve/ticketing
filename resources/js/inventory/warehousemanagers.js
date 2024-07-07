/**
  * datatable for Warehouse Manager Submission
*/

        $(document.body).on("keyup  change", "#phone", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
    }); 



$(document).on('click', '#warehouse_manager_submit', function(e){
       e.preventDefault();
        
                        name             = $('#manager_name').val();
                        code             = $('#manager_code').val();
                        city             = $('#city').val();
                        phone            = $('#phone').val();
                        email            = $('#email').val();
                        country_region   = $('#country_region').val();

        
         if (name=="") {
         $('#manager_name').addClass('is-invalid');
            toastr.warning('Manager Name is required.');     
         return false;
         } 
         else{
            $('#manager_name').removeClass('is-invalid');
         } 


             if (code=="") {
         $('#manager_code').addClass('is-invalid');
            toastr.warning('Manager Code is required.');     
         return false;
         } 
         else{
            $('#manager_code').removeClass('is-invalid');
         } 
       /*  var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
                if (!filter.test(phone)) 
                {
                    //toastr.warning('Please Enter Valid Phone Number.');
                     return false;
                }
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if ( !emailReg.test( email ) ) 
            {
                toastr.warning('Please enter valid email.');
             return false;
            } */
       /*  if (code=="") {
         $('#manager_code').addClass('is-invalid');
            toastr.warning('Manager Code is required.');    
         return false;
         } 
         else{
            $('#manager_code').removeClass('is-invalid');
         }
         if (city=="") {
         $('#city').addClass('is-invalid');
            toastr.warning('City is required.');     
         return false;
         } 
         else{
            $('#city').removeClass('is-invalid');
         } 
        if (country_region == "") { 
            toastr.warning('Country is required.');     
        $('#country_region').next().find('.select2-selection').addClass('select-dropdown-error');
        return false;
        }
         else {
           $('#country_region').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (phone=="") {
         $('#phone').addClass('is-invalid');
            toastr.warning('Phone Number is required.');     
         return false;
         } 
         else{
            $('#phone').removeClass('is-invalid');
         } 
         var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
                if (!filter.test(phone)) 
                {
                    //toastr.warning('Please Enter Valid Phone Number.');
                     return false;
                }
          if (email=="") {
         $('#email').addClass('is-invalid');
        toastr.warning('Please enter a valid email address eg:mail@gmail.com');
  
         return false;
         } 
         else{
            $('#email').removeClass('is-invalid');
         }

            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if ( !emailReg.test( email ) ) 
            {
                toastr.warning('Please enter valid email.');
             return false;
            } */
         $(this).addClass('kt-spinner');
         $(this).prop("disabled", true);
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }

        $.ajax({
            type : "POST",
            url  : "warehousemanagersubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        id               : $('#id').val(),
                        name             : $('#manager_name').val(),
                        code             : $('#manager_code').val(),
                        city             : $('#city').val(),
                        country          : $('#country_region').val(),
                        phone            : $('#phone').val(),
                        email            : $('#email').val(),
                        branch           : $('#branch').val()


                    },
            success: function(data){
          if(data == 'false')
          {
            $('#warehouse_manager_submit').removeClass('kt-spinner');
            $('#warehouse_manager_submit').prop("disabled", false);
            toastr.warning('Manager name already exist');
          }
          else
          {
              $('#warehouse_manager_submit').removeClass('kt-spinner');
              $('#warehouse_manager_submit').prop("disabled", false);
              warehousemanagers_list_table.ajax.reload();

              toastr.success('Warehouse Manager Details '+sucess_msg+' Successfuly');
              window.location.href = "WarehouseManagerList";
            }
                  
            },
            error: function(jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
        });


    });

/**
 *Datatable for Warehouse Manager Information
 */
var warehousemanagers_list_table = $('#warehousemanagers_list').DataTable({
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
                columns: [0, 1, 2, 3, 4, 5,6]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6]
            },
            pageSize: 'A4',
            orientation: 'landscape',
            customize: function(doc) {
                doc.pageMargins = [50, 50, 50, 50];
                // doc.styles['table'] = { width:100% }
            }
        },
        {
            extend: 'print',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6]
            }
        }
    ],

    ajax: {
        "url": 'WarehouseManagerList',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'manager_name', name: 'manager_name' },
        { data: 'manager_code', name: 'manager_code' },

        {
            data: 'city',name: 'city'
            
        },
        { data: 'country', name: 'country' },
        { data: 'phone', name: 'phone' },
        { data: 'email', name: 'email'},

        

        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_warehouse_manger?id='+ row.id +'"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text " data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a href="view_warehouse_manger?id='+ row.id +'"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text " data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_manager_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});
/**
  *Warehouse Manager Delete confirmation message
  */
$(document).on('click', '.kt_manager_delete', function () {
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
              url : 'deletewarehousemanager',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Entry has been deleted.", "success");
             warehousemanagers_list_table.ajax.reload();

             }
          });
          } else {
            swal.fire("Cancelled", "Your   Entry is safe ", "error");

          }
        })
       });


/**
 *Datatable for Warehouse Manager trash listing
 */
var warehousemanagers_list_trash_table = $('#warehousemanagers_list_trash').DataTable({
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
                columns: [0, 1, 2, 3, 4, 5,6]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6]
            },
            pageSize: 'A4',
            orientation: 'landscape',
            customize: function(doc) {
                doc.pageMargins = [50, 50, 50, 50];
                // doc.styles['table'] = { width:100% }
            }
        },
        {
            extend: 'print',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6]
            }
        }
    ],

    ajax: {
        "url": 'Trash-WarehouseManager',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'manager_name', name: 'manager_name' },
        { data: 'manager_code', name: 'manager_code' },

        {
            data: 'city',name: 'city'
            
        },
        { data: 'country', name: 'country' },
        { data: 'phone', name: 'phone' },
        { data: 'email', name: 'email'},

        

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
                        <i class="kt-nav__link-icon flaticon2-refresh-arrow"></i>\
                        <span class="kt-nav__link-text kt_manager_restore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});
/**
  * Warehouse Manager trash confirmation message
*/  
$(document).on('click', '.kt_manager_trashdelete', function () {
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
              url : 'deletewarehousemanagertrashlist',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                if(data == 's')
                {
                   swal.fire("Deleted!", "Your Entry has been deleted.", "success");
             location.reload();
                }
                else
                {
                   swal.fire("Cancelled", "warehouse manager is already assigned to a warehouse ", "success");
             location.reload();
                }

             }
          });
          } else {
            swal.fire("Cancelled", "Your   Entry is safe ", "error");

          }
        })
       });
/**
  *warehouse Manager Restore Confirmation message
*/  
$(document).on('click', '.kt_manager_restore', function () {
     var id = $(this).attr('id');
     
       

        $.ajax({
              type: "POST",
              url : 'restorewarehousemanager',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Done", "Restore Sucessfully", "success");
                  location.reload();
                  window.location.href="WarehouseManagerList";

             }
          });
         
        });



/**
 *Warehouse Manager  trash DataTable Export
 */

$("#warehousemanagers_list_trash_print").on("click", function() {
    warehousemanagers_list_trash_table.button('.buttons-print').trigger();
});


$("#warehousemanagers_list_trash_copy").on("click", function() {
    warehousemanagers_list_trash_table.button('.buttons-copy').trigger();
});

$("#warehousemanagers_list_trash_csv").on("click", function() {
    warehousemanagers_list_trash_table.button('.buttons-csv').trigger();
});

$("#warehousemanagers_list_trash_pdf").on("click", function() {
    warehousemanagers_list_trash_table.button('.buttons-pdf').trigger();
});


/**
 *Warehouse Manager  Information DataTable Export
 */

$("#warehousemanagers_list_print").on("click", function() {
    warehousemanagers_list_table.button('.buttons-print').trigger();
});


$("#warehousemanagers_list_copy").on("click", function() {
    warehousemanagers_list_table.button('.buttons-copy').trigger();
});

$("#warehousemanagers_list_csv").on("click", function() {
    warehousemanagers_list_table.button('.buttons-csv').trigger();
});

$("#warehousemanagers_list_pdf").on("click", function() {
    warehousemanagers_list_table.button('.buttons-pdf').trigger();
});
