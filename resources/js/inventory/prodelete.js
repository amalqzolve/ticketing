// /**
//  *Datatable for products details Information
//  */
// var productdetails_list_table = $('#productdetails_list').DataTable({
//     processing: true,
//     serverSide: true,
//     pagingType: "full_numbers",
//     dom: 'Blfrtip',
//     lengthMenu: [
//         [10, 25, 50, -1],
//         [10, 25, 50, "All"]
//     ],

//     buttons: [{
//             extend: 'copy',
//             className: "hidden",
//             exportOptions: {
//                 columns: [0, 1, 2, 3, 4, 5,6,7,8]
//             }
//         },
//         {
//             extend: 'csv',
//             className: "hidden",
//             exportOptions: {
//                 columns: [0, 1, 2, 3, 4, 5,6,7,8]
//             }
//         },
//         {
//             extend: 'excel',
//             className: "hidden",
//             exportOptions: {
//                 columns: [0, 1, 2, 3, 4, 5,6,7,8]
//             }
//         },
//         {
//             extend: 'pdf',
//             className: "hidden",
//             exportOptions: {
//                 columns: [0, 1, 2, 3, 4, 5,6,7,8]
//             },
//             pageSize: 'A4',
//             orientation: 'landscape',
//             customize: function(doc) {
//                 doc.pageMargins = [50, 50, 50, 50];
//                 // doc.styles['table'] = { width:100% }
//             }
//         },
//         {
//             extend: 'print',
//             className: "hidden",
//             exportOptions: {
//                 columns: [0, 1, 2, 3, 4, 5,6,7,8]
//             }
//         }
//     ],

//     ajax: {
//         "url": 'ProductList',
//         "type": "POST",
//         "data": function(data) {
//             data._token = $('#token').val()
//         }
//     },
//     columns: [
//         { data: 'DT_RowIndex', name: 'DT_RowIndex' },
//         { data: 'product_name', name: 'product_name' },
//         { data: 'product_code', name: 'product_code' },
//         { data: 'bar_code',name: 'bar_code' },
//         { data: 'unit', name: 'unit' },
//         { data: 'category_name', name: 'category_name' },
//         { data: 'out_of_stock_status', name: 'out_of_stock_status'},
//         { data: 'product_status', name: 'product_status'},
//         { data: 'description', name: 'description'},



//         {
//             data: 'action',
//             name: 'action',
//             render: function(data, type, row) {
//                 return '<span style="overflow: visible; position: relative; width: 80px;">\
//             <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
//                         <i class="fa fa-cog"></i></a>\
//                         <div class="dropdown-menu dropdown-menu-right">\
//                         <ul class="kt-nav">\
//                         <a href="edit_product_details?id='+ row.id +'"><li class="kt-nav__item">\
//                         <span class="kt-nav__link">\
//                         <i class="kt-nav__link-icon flaticon2-contract"></i>\
//                         <span class="kt-nav__link-text " data-id="' + row.id + '" >Edit</span>\
//                         </span></li></a>\
//                         <li class="kt-nav__item">\
//                         <span class="kt-nav__link">\
//                         <i class="kt-nav__link-icon flaticon2-trash"></i>\
//                         <span class="kt-nav__link-text kt_products_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
//                        </ul></div></div></span>';
//             }
//         },

//     ]
// });
// /**


/**
 *Datatable for product details trash Information
 */
var product_trash_list_table = $('#productdetails_list_trash').DataTable({
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
        customize: function (doc) {
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
        "url": 'Trash-Product',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'product_name', name: 'product_name' },
        { data: 'description', name: 'description' },
        { data: 'unit', name: 'unit' },
        { data: 'product_price', name: 'product_price' },
        { data: 'selling_price', name: 'selling_price' },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_products_recover" id=' + row.product_id + ' data-id=' + row.product_id + '>Recover</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});
/**
  *products details recover confirmation message
  */
$(document).on('click', '.kt_products_recover', function () {
    var id = $(this).attr('id');



    $.ajax({
        type: "POST",
        url: 'productsrecover',
        data: {
            _token: $('#token').val(),
            id: id
        },
        success: function (data) {
            swal.fire("Done", "Restore Sucessfully", "success");
            location.reload();
            window.location.href = "ProductList";

        }
    });

});


/**
 *products details trash DataTable Export
 */

$("#productdetails_list_trash_print").on("click", function () {
    product_trash_list_table.button('.buttons-print').trigger();
});


$("#productdetails_list_trash_copy").on("click", function () {
    product_trash_list_table.button('.buttons-copy').trigger();
});

$("#productdetails_list_trash_csv").on("click", function () {
    product_trash_list_table.button('.buttons-csv').trigger();
});

$("#productdetails_list_trash_pdf").on("click", function () {
    product_trash_list_table.button('.buttons-pdf').trigger();
});

/**
 *products details DataTable Export
 */

$("#productdetails_list_print").on("click", function () {
    productdetails_list_table.button('.buttons-print').trigger();
});


$("#productdetails_list_copy").on("click", function () {
    productdetails_list_table.button('.buttons-copy').trigger();
});

$("#productdetails_list_csv").on("click", function () {
    productdetails_list_table.button('.buttons-csv').trigger();
});

$("#productdetails_list_pdf").on("click", function () {
    productdetails_list_table.button('.buttons-pdf').trigger();
});



$(document).on('click', '.kt_products_delete_trash', function () {
    var id = $(this).attr('id');
    // alert(id);
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Entry also loss these  Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'DeleteTrashProduct',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {
                    // alert(data);
                    swal.fire("Deleted!", "Your  entry has been deleted.", "success");
                    location.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your  Entry is safe ", "error");
        }
    })
});