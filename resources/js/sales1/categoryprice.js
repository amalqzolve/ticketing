var categoryprice_list_table = $('#categoryprice_list').DataTable({
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
        "url": 'categoryprice',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'product_name', name: 'product_name' },
        { data: 'product_code', name: 'product_code' },
        { data: 'bar_code',name: 'bar_code' },
        { data: 'unit', name: 'unit' },
        { data: 'category_name', name: 'category_name' },
        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="categoryprice_update?id='+ row.id +'"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text " data-id="' + row.id + '" >Update</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
            }
        },

    ]
});


$(document).on('click', '#categoryprice_submit', function(e) {
    e.preventDefault();
    var productid  = $('#productid').val();
    
    
    var customer_category = [];

    $("input[name^='customer_category[]']")
        .each(function(input) {
            customer_category.push($(this).val());
        });

    var salesprice = [];

    $("input[name^='salesprice[]']")
        .each(function(input) {
            salesprice.push($(this).val());
        });

       
    
   
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      
    $.ajax({
        type: "POST",
        url: "category_price_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            productid : $('#productid').val(),
            customer_category   : customer_category,
            salesprice   : salesprice,
           

        },
        success: function(data) {
            // uppy.reset();
            toastr.success(' success');

            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
             window.location.href = "categoryprice";
            
        },
        error: function(jqXhr, json, errorThrown) {
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors, function(key, value) {
                if (jQuery.isPlainObject(value)) {

                    $.each(value, function(index, ndata) {
                        errorsHtml += '<li>' + ndata + '</li>';
                    });

                } else {

                    errorsHtml += '<li>' + value + '</li>';

                }
            });
            toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
        }
    });

    return false;

});