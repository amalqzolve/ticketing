/**
 *Datatable for Warehouse Incharge submission
 */

         $(document.body).on("keyup  change", "#phone", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
    }); 




$(document).on('click', '#newwarehouseincharge', function(e){
       e.preventDefault();
        
                        name             = $('#inchargename').val();
                        code             = $('#inchargecode').val();
                        city             = $('#city').val();
                        country          = $('#country').val();
                        phone            = $('#phone').val();
                        email            = $('#email').val();

         if (name=="") {
         $('#inchargename').addClass('is-invalid');
            toastr.warning('Incharge Name is required.');     
         return false;
         } 
         else{
            $('#inchargename').removeClass('is-invalid');
         } 


            if (code=="") {
         $('#inchargecode').addClass('is-invalid');
            toastr.warning('Incharge Code is required.');     
         return false;
         } 
         else{
            $('#inchargecode').removeClass('is-invalid');
         } 

        /* var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
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
        /* if (code=="") {
         $('#inchargecode').addClass('is-invalid');
            toastr.warning('Code is required.');    
         return false;
         } 
         else{
            $('#inchargecode').removeClass('is-invalid');
         }
         if (city=="") {
         $('#city').addClass('is-invalid');
            toastr.warning('City is required.');    
         return false;
         } 
         else{
            $('#city').removeClass('is-invalid');
         }
         if (country == "") { 
         $('#country').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Country is required.');   
        return false;
        }
         else {
           $('#country').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (phone=="") {
         $('#phone').addClass('is-invalid');
            toastr.warning('Phone Number is required.');     
         return false;
         } 
         else{
            $('#phone').removeClass('is-invalid');
         } 
         if (email=="") {
         $('#email').addClass('is-invalid');
        toastr.warning('Please enter a valid email address eg:mail@gmail.com');
      
         return false;
         } 
         else{
            $('#email').removeClass('is-invalid');
         }*/
          $(this).addClass('kt-spinner');
         $(this).prop("disabled", true);
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }

        $.ajax({
            type : "POST",
            url  : "warehouseinchargesubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        id               : $('#id').val(),
                        name             : $('#inchargename').val(),
                        code             : $('#inchargecode').val(),
                        city             : $('#city').val(),
                        country          : $('#country').val(),
                        phone            : $('#phone').val(),
                        email            : $('#email').val(),
                        branch           : $('#branch').val(),


                    },
            success: function(data){
          if(data == 'false')
          {
            $('#newwarehouseincharge').removeClass('kt-spinner');
            $('#newwarehouseincharge').prop("disabled", false);
            toastr.warning('Incharge namme already exist');
          }
          else
          {
              $('#newwarehouseincharge').removeClass('kt-spinner');
              $('#newwarehouseincharge').prop("disabled", false);
              warehouseincharge_list_table.ajax.reload();

              toastr.success('Warehouse Incharge Details '+sucess_msg+' Successfuly');
              window.location.href = "WarehouseInchargeList";
            }
                  
            },
            error: function(jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
      });
    });


/**
 *Datatable for Warehouse Incharge Information
 */
var warehouseincharge_list_table = $('#WarehouseInchargeListing').DataTable({
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
        "url": 'WarehouseInchargeList',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'incharge_name', name: 'incharge_name' },
        { data: 'incharge_code', name: 'incharge_code' },

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
                        <a href="edit_warehouse_incharge?id=' + row.id +'"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text " data-id="'+ row.id +'" >Edit</span>\
                        </span></li></a>\
                        <a href="view_warehouse_incharge?id=' + row.id +'"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text " data-id="'+ row.id +'" >View</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_incharge_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});
/**
 *Datatable for Warehouse Incharge confirmation message
 */
$(document).on('click', '.kt_incharge_delete', function () {
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
              url : 'deletewarehouseincharge',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Entry has been deleted.", "success");
             warehouseincharge_list_table.ajax.reload();

             }
          });
          } else {
            swal.fire("Cancelled", "Your   Entry is safe ", "error");

          }
        })
       });

/**
 *Datatable for Warehouse Incharge trash
 */
var warehousemanagers_list_trash_table = $('#WarehouseInchargeListing_trash').DataTable({
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
        "url": 'Trash-WarehouseIncharge',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'incharge_name', name: 'incharge_name' },
        { data: 'incharge_code', name: 'incharge_code' },

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
                        <span class="kt-nav__link-text kt_inchare_restore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});

/**
 *Datatable for Warehouse Incharge trash delete confirmation message
 */
$(document).on('click', '.kt_incharge_trashdelete', function () {
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
              url : 'trashdeletewarehouseincharge',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                // console.log(data);
                if(data == 's')
                {
                   swal.fire("Deleted!", "Your Entry has been deleted.", "success");
             location.reload();
                }
                else
                {
                   swal.fire("Cancelled", "warehouse incharge is already assigned to a warehouse ", "success");
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
 *Datatable for Warehouse Incharge resore confirmation message
 */
$(document).on('click', '.kt_inchare_restore', function () {
     var id = $(this).attr('id');
     
       

        $.ajax({
              type: "POST",
              url : 'restoreincharge',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Done", "Restore Sucessfully", "success");
                  location.reload();
                  window.location.href="WarehouseInchargeList";

             }
          });
         
        });


/**
 *Warehouse incharge  trash DataTable Export
 */

$("#WarehouseInchargeListing_trash_print").on("click", function() {
    warehousemanagers_list_trash_table.button('.buttons-print').trigger();
});


$("#WarehouseInchargeListing_trash_copy").on("click", function() {
    warehousemanagers_list_trash_table.button('.buttons-copy').trigger();
});

$("#WarehouseInchargeListing_trash_csv").on("click", function() {
    warehousemanagers_list_trash_table.button('.buttons-csv').trigger();
});

$("#WarehouseInchargeListing_trash_pdf").on("click", function() {
    warehousemanagers_list_trash_table.button('.buttons-pdf').trigger();
});


/**
 *Warehouse incharge  Information DataTable Export
 */

$("#WarehouseInchargeListing_print").on("click", function() {
    warehouseincharge_list_table.button('.buttons-print').trigger();
});


$("#WarehouseInchargeListing_copy").on("click", function() {
    warehouseincharge_list_table.button('.buttons-copy').trigger();
});

$("#WarehouseInchargeListing_csv").on("click", function() {
    warehouseincharge_list_table.button('.buttons-csv').trigger();
});

$("#WarehouseInchargeListing_pdf").on("click", function() {
    warehouseincharge_list_table.button('.buttons-pdf').trigger();
});
