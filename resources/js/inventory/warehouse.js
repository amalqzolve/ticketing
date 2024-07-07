/**
 *Datatable for Warehouse lists Information
 */
var warehouse_list_table = $('#warehouse_list').DataTable({
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
        "url": 'WarehouseList',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'warehouse_name', name: 'warehouse_name' },
        { data: 'warehouse_code', name: 'warehouse_code' },
        { data: 'manager', name: 'manager' },
        { data: 'incharge', name: 'incharge' },
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
                        <a href="edit_warehouse?id=' + row.id + '"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text " data-id="' + row.id +'" >Edit</span>\
                        </span></li></a>\
                        <a href="view_warehouse?id=' + row.id + '"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text " data-id="' + row.id +'" >View</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_warehouse_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});

/**
 *Datatable for Warehouse lists submission
 */
$(document).on('click', '#warehouse_submit', function(e){
       e.preventDefault();
       
        
                        warehousename    = $('#warehousename').val();
                        warehousecode    = $('#warehousecode').val();
                        address1         = $('#address1').val();
                        address2         = $('#address2').val();
                        city             = $('#city').val();
                        region           = $('#region').val();

                        country          = $('#country').val();
                        region           = $('#region').val();
                        state            = $('#state').val();
                        zipcode          = $('#zipcode').val();
                        phone            = $('#phone').val();
                        email            = $('#email').val();
                        manager_name     = $('#manager_name').val();
                        incharge_name    = $('#incharge_name').val();

        if (warehousename=="") {
         $('#warehousename').addClass('is-invalid');
            toastr.warning('Warehouse Name is required.');     
         return false;
         } 
         else{
            $('#warehousename').removeClass('is-invalid');
         } 
         if (warehousecode=="") {
         $('#warehousecode').addClass('is-invalid');
            toastr.warning('Warehouse Code is required.');    
         return false;
         } 
         else{
            $('#warehousecode').removeClass('is-invalid');
         } 
         /*var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
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
                

        /* if (address1=="") {
         $('#address1').addClass('is-invalid');
            toastr.warning('Address is required.');     
         return false;
         } 
         else{
            $('#address1').removeClass('is-invalid');
         }
         if (address2=="") {
         $('#address2').addClass('is-invalid');
            toastr.warning('Address is required.');
         return false;
         } 
         else{
            $('#address2').removeClass('is-invalid');
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
        if (region=="") {
         $('#region').addClass('is-invalid');
            toastr.warning('Region is required.');
         return false;
         } 
         else{
            $('#region').removeClass('is-invalid');
         } if (state=="") {
         $('#state').addClass('is-invalid');
            toastr.warning('State is required.');     
         return false;
         } 
         else{
            $('#state').removeClass('is-invalid');
         } 
          if (zipcode=="") {
         $('#zipcode').addClass('is-invalid');
            toastr.warning('Zipcode is required.');    
         return false;
         } 
         else{
            $('#zipcode').removeClass('is-invalid');
         } 
         
         if (phone=="") {
         $('#phone').addClass('is-invalid');
            toastr.warning('Phone Number is required.');    
         return false;
         } 
         else{
            $('#phone').removeClass('is-invalid');
         } */
         /*var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
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
            } 
         if (manager_name == "") { 
        $('#manager_name').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Manager Name is required.');    
        return false;
        }
         else {
           $('#manager_name').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (incharge_name == "") { 
        $('#incharge_name').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Incharge Name is required.');    
        return false;
        }
         else {
           $('#incharge_name').next().find('.select2-selection').removeClass('select-dropdown-error');
        }*/
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
    //     $("#kt_form").validate({
    //     rules: {
           
    //         email: "required email",
    //     },
    //     messages: {
            
    //         email: {
    //             required: "Enter your Email",
    //             email: "Please enter a valid email address.",
    //         }
    //     }
    // });
        if($('#id').val()){
        var sucess_msg ='Updated';
        } else{
        var sucess_msg ='Created';
        }

        $.ajax({
            type : "POST",
            url  : "warehouse_submit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        id               : $('#id').val(),
                        warehousename    : $('#warehousename').val(),
                        warehousecode    : $('#warehousecode').val(),
                        address1         : $('#address1').val(),
                        address2         : $('#address2').val(),
                        city             : $('#city').val(),
                        country          : $('#country').val(),
                        region           : $('#region').val(),
                        state            : $('#state').val(),
                        zipcode          : $('#zipcode').val(),
                        phone            : $('#phone').val(),
                        email            : $('#email').val(),
                        manager_name     : $('#manager_name').val(),
                        incharge_name    : $('#incharge_name').val(),
                        branch           : $('#branch').val(),
                        checkedValue     : $('#default').is(":checked"),


                    },
           success: function(data) {
          if(data == 'false')
          {
            $('#warehouse_submit').removeClass('kt-spinner');
            $('#warehouse_submit').prop("disabled", false);
            toastr.warning('Warehouse namme already exist');
          }
          else
          {
                    $('#warehouse_submit').removeClass('kt-spinner');
                    $('#warehouse_submit').prop("disabled", false);
                    warehouse_list_table.ajax.reload();

                    toastr.success('Warehouse Details '+sucess_msg+' Successfuly');
                    window.location.href = "WarehouseList";
            }
            },
            error: function(jqXhr, json, errorThrown) {
                        console.log('Error !!');
            }
        });


    });



/**
 *Datatable for Warehouse delete conformation message
 */
$(document).on('click', '.kt_warehouse_delete', function () {
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
              url : 'deletewarehouse',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Entry has been deleted.", "success");
             warehouse_list_table.ajax.reload();

             }
          });
          } else {
            swal.fire("Cancelled", "Your   Entry is safe ", "error");

          }
        })
       });

/**
 *Datatable for Warehouse lists trash Information
 */
var warehouse_trash_list_table = $('#warehouse_trash_list').DataTable({
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
                // doc.styles['table'] = { width:100% }
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
        "url": 'Trash-Warehouse',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'warehouse_name', name: 'warehouse_name' },
        { data: 'warehouse_code', name: 'warehouse_code' },
        { data: 'manager', name: 'manager' },
        { data: 'incharge', name: 'incharge' },
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
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-refresh-arrow"></i>\
                        <span class="kt-nav__link-text kt_warehouse_recover" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});
/**
 *Datatable for Warehouse lists trash conformation message
 */
    $(document).on('click', '.kt_warehouse_trashdelete', function () {
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
              url : 'deletewarehousetrashdetails',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Entry has been deleted.", "success");
             location.reload();

             }
          });
          } else {
            swal.fire("Cancelled", "Your   Entry is safe ", "error");

          }
        })
       });
/**
 *Datatable for Warehouse lists restore confirmation message
 */    
    $(document).on('click', '.kt_warehouse_recover', function () {
     var id = $(this).attr('id');
     
       

        $.ajax({
              type: "POST",
              url : 'restorewarehouse',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Done", "Restore Sucessfully", "success");
                  location.reload();
                  window.location.href="WarehouseList";

             }
          });
         
        });


/**
 *Warehouse  trash DataTable Export
 */

$("#warehouse_trash_list_print").on("click", function() {
    warehouse_trash_list_table.button('.buttons-print').trigger();
});


$("#warehouse_trash_list_copy").on("click", function() {
    warehouse_trash_list_table.button('.buttons-copy').trigger();
});

$("#warehouse_trash_list_csv").on("click", function() {
    warehouse_trash_list_table.button('.buttons-csv').trigger();
});

$("#warehouse_trash_list_pdf").on("click", function() {
    warehouse_trash_list_table.button('.buttons-pdf').trigger();
});


/**
 *Warehouse  Information DataTable Export
 */

$("#warehouse_list_print").on("click", function() {
    warehouse_list_table.button('.buttons-print').trigger();
});


$("#warehouse_list_copy").on("click", function() {
    warehouse_list_table.button('.buttons-copy').trigger();
});

$("#warehouse_list_csv").on("click", function() {
    warehouse_list_table.button('.buttons-csv').trigger();
});

$("#warehouse_list_pdf").on("click", function() {
    warehouse_list_table.button('.buttons-pdf').trigger();
});

