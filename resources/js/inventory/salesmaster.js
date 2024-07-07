var product_list_table = $('#productdetails_list100').DataTable({
    processing: true,
    scrollX:true,
    // serverSide: true,
    pagingType: "full_numbers",
    dom: 'Qlfrtip',
    searchBuilder: {
            logic: 'OR'
        },
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],

    buttons: [{
            extend: 'copy',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6,7,8,9,10,11,12]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6,7,8,9,10,11,12]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6,7,8,9,10,11,12]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6,7,8,9,10,11,12]
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
                columns: [0, 1, 2, 3, 4, 5,6,7,8,9,10,11,12]
            }
        }
    ],

    ajax: {
        "url": 'salesmaster',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'product_name', name: 'product_name' },
        { data: 'description', name: 'description'},
        { data: 'category_name', name: 'category_name' },
        { data: 'unit', name: 'unit' },
        { data: 'sku', name: 'sku' },
        { data: 'product_code', name: 'product_code' },
        { data: 'available_stock', name: 'available_stock' },
        { data: 'product_price', name: 'product_price' },
        { data: 'costpercentage', name: 'costpercentage' },
        { data: 'landing', name: 'landing' },
        { data: 'margin', name: 'margin' },
        { data: 'selling_price', name: 'selling_price' },
        { data: 'profit', name: 'profit' },
        
       
        
        
          




        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav"><a href="salesmaster_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        </ul></div></div></span>';
            }
        },

    ]
});


$("#productdetails_list_print").on("click", function() {
   
    product_list_table.button('.buttons-print').trigger();
});


$("#productdetails_list_copy").on("click", function() {
    product_list_table.button('.buttons-copy').trigger();
});

$("#productdetails_list_csv").on("click", function() {
    product_list_table.button('.buttons-csv').trigger();
});

$("#productdetails_list_pdf").on("click", function() {
    product_list_table.button('.buttons-pdf').trigger();
});