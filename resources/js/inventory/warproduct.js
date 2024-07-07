/**
 *Datatable for product details Information
 */
$.fn.dataTable.ext.errMode = 'none';

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
        "url": 'ProductList',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'product_name', name: 'product_name' },
         { data: 'sku', name: 'sku' },
        { data: 'description', name: 'description'},
        { data: 'category_name', name: 'category_name' },
        { data: 'unit', name: 'unit' },
        { data: 'product_code', name: 'product_code' },
        { data: 'part_no',name: 'part_no' },
        { data: 'model_no',name: 'model_no' },
          { data: 'selling_price', name: 'selling_price'},
          { data: 'available_stock', name: 'available_stock'},
          

        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_war_product_details?id='+ row.product_id +'"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text " data-id="' + row.product_id + '" >Edit</span>\
                        </span></li></a>\
                        </ul></div></div></span>';
            }
        },

    ]
});

