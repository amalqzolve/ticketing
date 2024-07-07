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
        "url": 'assetWarehouseList',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'id', name: 'id' },
        
        { data: 'warehouse_name', name: 'warehouse_name' },
        { data: 'warehouse_code', name: 'warehouse_code' },
        { data: 'manager', name: 'manager' },
        { data: 'incharge', name: 'incharge' },


        

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
$(document).on('click', '#warehouse_submit', function(e){
       e.preventDefault();
       
        
                        var warehousename    = $('#warehousename').val();
                        var warehousecode    = $('#warehousecode').val();
                        var address1         = $('#address1').val();
                        var address2         = $('#address2').val();
                        var city             = $('#city').val();
                        var region           = $('#region').val();
                        var country          = $('#country').val();
                        var region           = $('#region').val();
                        var state            = $('#state').val();
                        var zipcode          = $('#zipcode').val();
                        var phone            = $('#phone').val();
                        var email            = $('#email').val();
                        var manager_name     = $('#manager_name').val();
                        var incharge_name    = $('#incharge_name').val();

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
        
  
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
    
        if($('#id').val()){
        var sucess_msg ='Updated';
        } else{
        var sucess_msg ='Created';
        }

        $.ajax({
            type : "POST",
            url  : "assetwarehouse_submit",
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
            if(data == true)
            {
                $('#warehouse_submit').removeClass('kt-spinner');
                    $('#warehouse_submit').prop("disabled", false);
                    // warehouse_list_table.ajax.reload();
// location.reload();
                    toastr.success('Warehouse Details '+sucess_msg+' Successfuly');
                    window.location.href = "assetWarehouseList";
            }
            else
            {
                    toastr.warning('Warehouse already exist');

            }
          
                    
            
            },
            error: function(jqXhr, json, errorThrown) {
                        console.log('Error !!');
            }
        });


    });