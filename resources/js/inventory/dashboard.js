var product_list_table = $('#productdetails_list').DataTable({
    processing: true,
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
                // doc.styles['table'] = { width:100% }
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
        "url": 'inventorydashboard',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'product_name', name: 'product_name' },
        { data: 'product_code', name: 'product_code' },
        { data: 'barcode',name: 'barcode' },
        { data: 'unit', name: 'unit' },
        { data: 'category_name', name: 'category_name' },
         
         {
            data: 'product_status',
            name: 'product_status',
            render: function(data, type, row) {
                if (row.product_status == 1) {
                    return 'Enabled';
                } if (row.product_status == 2) {
                    return 'Disabled';
                }
                if ( row.product_status == '0' || row.product_status == '' || row.product_status == 'undefined' || row.product_status == null ) {
                    return 'Disabled';
                }

            }
        },
       
        { data: 'available_stock', name: 'available_stock'},

        

    ]
});