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
        "url": 'ProductList',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'product_name', name: 'product_name' },
        { data: 'sku', name: 'sku' },
        { data: 'description', name: 'description' },
        { data: 'category_name', name: 'category_name' },
        { data: 'unit', name: 'unit' },
        { data: 'product_code', name: 'product_code' },
        { data: 'part_no', name: 'part_no' },
        { data: 'model_no', name: 'model_no' },
        { data: 'selling_price', name: 'selling_price' },
        { data: 'available_stock', name: 'available_stock' },


        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_product_details?id='+ row.product_id + '"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text " data-id="' + row.product_id + '" >Edit</span>\
                        </span></li></a>\
                         <a href="ProductListView?id=' + row.product_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.product_id + '" >View</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_products_delete" id=' + row.product_id + ' data-id=' + row.product_id + '>Delete</span></span></li>\
                        <a href="ProductQuoteHistory?id=' + row.product_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-refresh-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.product_id + '" >Quotation History</span>\
                        </span></li></a>\
                        <a href="ProductSalesHistory?id=' + row.product_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-graphic-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.product_id + '" >Invoice History</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
            }
        },

    ]
});


var product_list_table = $('#productdetails_list100').DataTable({
    processing: true,
    scrollX: true,
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    }
    ],

    ajax: {
        "url": 'ProductList',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        // { data: 'product_code', name: 'product_code' },
        { data: 'product_name', name: 'product_name' },

        { data: 'description', name: 'description' },
        { data: 'unit', name: 'unit' },
        { data: 'product_price', name: 'product_price' },        
        { data: 'selling_price', name: 'selling_price' },
        
        // { data: 'category_name', name: 'category_name' },
        // { data: 'part_no', name: 'part_no' },
        // { data: 'model_no', name: 'model_no' },
        // { data: 'sup_name', name: 'sup_name' },
        // { data: 'manufacture_name', name: 'manufacture_name' },
        // { data: 'brand_name', name: 'brand_name' },
        // { data: 'warehouse_name', name: 'warehouse_name' },

        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_product_details?id='+ row.product_id + '"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text " data-id="' + row.product_id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_products_delete" id=' + row.product_id + ' data-id=' + row.product_id + '>Delete</span></span></li>\
                        <a href="ProductQuoteHistory?id=' + row.product_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-refresh-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.product_id + '" >Quotation History</span>\
                        </span></li></a>\
                        <a href="ProductSalesHistory?id=' + row.product_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-graphic-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.product_id + '" >Invoice History</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
            }
        },

    ]
});



$(document).on('click', '.kt_products_delete', function () {
    var id = $(this).attr('id');

    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Entry !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'deleteproducts',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {

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
 *products details DataTable Export
 */

$("#productdetails_list_print").on("click", function () {

    product_list_table.button('.buttons-print').trigger();
});


$("#productdetails_list_copy").on("click", function () {
    product_list_table.button('.buttons-copy').trigger();
});

$("#productdetails_list_csv").on("click", function () {
    product_list_table.button('.buttons-csv').trigger();
});

$("#productdetails_list_pdf").on("click", function () {
    product_list_table.button('.buttons-pdf').trigger();
});



const uppy = Uppy.Core({
    autoProceed: false,
    allowMultipleUploads: true,
    // meta: {
    //         UniqueID       : $('#UniqueID').val()
    //     },
    onBeforeUpload: (files) => {
        fileData = [];
        const updatedFiles = {};

        Object.keys(files).forEach(fileID => {
            fileData.push('ProductFileUpload/' + files[fileID].name)
        })
        //return updatedFiles
        $('#fileData').val(fileData);

    },

})

uppy.use(Uppy.Dashboard, {
    metaFields: [
        { id: 'name', name: 'Name', placeholder: 'File name' },
        { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
    ],
    browserBackButtonClose: true,
    target: '#choose-files',
    inline: true,
    replaceTargetContent: true,
    width: '100%'
})
uppy.use(Uppy.GoogleDrive,
    {
        target: Uppy.Dashboard,
        companionUrl: 'https://companion.uppy.io'
    })
uppy.use(Uppy.Webcam, { target: Uppy.Dashboard })
uppy.use(Uppy.XHRUpload, {
    endpoint: 'ProductFileUpload',
    // UniqueID       : $('#UniqueID').val(),
    fieldName: 'filenames[]',
    headers: {
        'X-CSRF-TOKEN': $('#token').val(),
        // UniqueID       : $('#UniqueID').val()
    }
})



if ($('#fileData').val() != '') {
    var img_array = $('#fileData').val().split(",");

    $.each(img_array, function (i) {
        onuppyImageClicked('public/' + img_array[i]);
    });
}

function onuppyImageClicked(img) {

    var str = img.toString();
    var n = str.lastIndexOf('/');
    var img_name = str.substring(n + 1);
    // assuming the image lives on a server somewhere
    return fetch(img)
        .then((response) => response.blob()) // returns a Blob
        .then((blob) => {
            uppy.addFile({
                name: img_name,
                type: 'image/jpeg',
                data: blob
            })
        })
}

/**
  *product details submission
  */
$(document).on('click', '#product_submit', function (e) {
    e.preventDefault();

    product_name = $('#product_name').val();
    product_code = $('#product_code').val();
    barcode = $('#barcode').val();
    barcode_format = $('#barcode_format').val();
    unit = $('#unit').val();
    kt_tagify_5 = $('#kt_tagify_5').val();
    category = $('#category').val();

    selling_units = $('#selling_units').val();
    out_of_stock_status = $('#out_of_stock_status').val();
    product_status = $('#product_status').val();
    opening_stock = $('#opening_stock').val();
    enable_minus_stock_billing = $('#enable_minus_stock_billing').val();
    reorder_quantity_alert = $('#reorder_quantity_alert').val();
    taxable = $('#taxable').val();
    sales_tax_groups = $('#sales_tax_groups').val();
    purchase_tax_group = $('#purchase_tax_group').val();
    item_type = $('input[name="product_type"]:checked').val();
    refundable = $('#refundable').val();
    manufacturer = $('#manufacturer').val();
    brand = $('#brand').val();
    attribute = $('#attribute').val();

    serial_number = $('#serial_number').val();
    model_no = $('#model_no').val();
    part_no = $('#part_no').val();
    maintain_batches = $('#maintain_batches').val();
    batch_lot_no = $('#batch_lot_no').val();
    manufacturing_date = $('#manufacturing_date').val();
    expiry_date = $('#expiry_date').val();
    expiry_reminder = $('#expiry_reminder').val();
    warranty_date = $('#warranty_date').val();
    warranty_reminder = $('#warranty_reminder').val();
    sku = $('#sku').val();
    upc = $('#upc').val();
    ean = $('#ean').val();
    jan = $('#jan').val();
    isbn = $('#isbn').val();
    mpn = $('#mpn').val();
    // sales_accountant = $('#sales_accountant').val();
    // purchase_accountant = $('#purchase_accountant').val();
    // inventory_accountant = $('#inventory_accountant').val();
    fileData = $('#fileData').val();
    product_type = $('input[name="product_type"]:checked').val();
    product_price = $('#product_price').val();
    warehouse = $('#warehouse').val();



    if (product_name == "") {
        $('#product_name').addClass('is-invalid');
        toastr.warning('Product Name is required.');
        return false;
    }
    else {
        $('#product_name').removeClass('is-invalid');
    }

    if (category == "") {
        $('#category').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('category is required.');
        return false;
    }
    else {
        $('#category').next().find('.select2-selection').removeClass('select-dropdown-error');
    }
    if (unit == "") {
        $('#unit').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Unit is required.');
        return false;
    }
    else {
        $('#unit').next().find('.select2-selection').removeClass('select-dropdown-error');
    }
    if (product_code == "") {
        $('#product_code').addClass('is-invalid');
        toastr.warning('Product code is required.');
        return false;
    }
    else {
        $('#product_code').removeClass('is-invalid');
    }

    if (warehouse == "") {
        $('#warehouse').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('warehouse is required.');
        return false;
    }
    else {
        $('#warehouse').next().find('.select2-selection').removeClass('select-dropdown-error');
    }


    var arvid = [];

    $("input[name^='vid[]']")
        .each(function (input) {
            arvid.push($(this).val());
        });


    var aroption = [];

    $("input[name^='option[]']")
        .each(function (input) {
            aroption.push($(this).val());
        });

    var variantproductcode = [];

    $("input[name^='variantproductcode[]']")
        .each(function (input) {
            variantproductcode.push($(this).val());
        });

    var variantsku = [];

    $("input[name^='variantsku[]']")
        .each(function (input) {
            variantsku.push($(this).val());
        });

    var variantbarcode = [];

    $("input[name^='variantbarcode[]']")
        .each(function (input) {
            variantbarcode.push($(this).val());
        });

    var variantproductcost = [];

    $("input[name^='variantproductcost[]']")
        .each(function (input) {
            variantproductcost.push($(this).val());
        });

    var variantimage = [];

    $("input[name^='variantimage[]']")
        .each(function (input) {
            variantimage.push($(this).val());
        });

    var variantstock = [];

    $("input[name^='variantstock[]']")
        .each(function (input) {
            variantstock.push($(this).val());
        });




    $('#product_submit').addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }



    $.ajax({
        type: "POST",
        url: "product_submits",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            product_name: $('#product_name').val(),
            product_code: $('#product_code').val(),
            barcode: $('#barcode').val(),
            barcode_format: $('#barcode_format').val(),
            unit: $('#unit').val(),
            category: $('#category').val(),
            // out_of_stock_status: $('#out_of_stock_status').val(),
            // product_status: $('#product_status').val(),
            description: $('#description').val(),
            available_stock: $('#opening_stock').val(),
            opening_stock: $('#opening_stock').val(),
            enable_minus_stock_billing: $('input[name="enable_minus_stock_billing"]:checked').val(),
            reorder_quantity_alert: $('input[name="reorder_quantity_alert"]:checked').val(),
            alert_quantity: $('#alert_quantity').val(),
            taxable: $('#taxable').val(),
            sales_tax_groups: $('#sales_tax_groups').val(),
            purchase_tax_group: $('#purchase_tax_group').val(),
            item_type: $('input[name="product_type"]:checked').val(),
            refundable: $('#refundable').val(),
            manufacturer: $('#manufacturer').val(),
            brand: $('#brand').val(),
            serial_number: $('#serial_number').val(),
            model_no: $('#model_no').val(),
            part_no: $('#part_no').val(),
            maintain_batches: $('#maintain_batches').val(),
            batch_lot_no: $('#batch_lot_no').val(),
            manufacturing_date: $('#manufacturing_date').val(),
            expiry_date: $('#expiry_date').val(),
            expiry_reminder: $('#expiry_reminder').val(),
            warranty_date: $('#warranty_date').val(),
            warranty_reminder: $('#warranty_reminder').val(),
            sku: $('#sku').val(),
            upc: $('#upc').val(),
            ean: $('#ean').val(),
            jan: $('#jan').val(),
            isbn: $('#isbn').val(),
            mpn: $('#mpn').val(),
            fileData: $('#fileData').val(),
            // sales_accountant: $('#sales_accountant').val(),
            // purchase_accountant: $('#purchase_accountant').val(),
            // inventory_accountant: $('#inventory_accountant').val(),
            variant_id: arvid,
            product_variant: aroption,
            variantproductcode: variantproductcode,
            variantsku: variantsku,
            variantbarcode: variantbarcode,
            variantproductcost: variantproductcost,
            variantimage: variantimage,
            branch: $('#branch').val(),
            // product_type : $('input[name="product_type"]:checked').val(),
            product_price: $('#product_price').val(),
            sup_vendor: $('input[name="sup_vendor"]:checked').val(),
            sup_vendorname: $('#sup_vendorname').val(),
            quantity: $('#quantity').val(),
            alert_quantity: $('#alert_quantity').val(),
            hsn_code: $('#hsn_code').val(),
            variantstock: variantstock,
            selling_price: $('#selling_price').val(),
            lotno: $('#lotno').val(),
            shelflife: $('#shelflife').val(),
            countryoforigin: $('#countryoforigin').val(),
            cfds: $('#cfds').val(),
            reference: $('#reference').val(),
            catno: $('#catno').val(),
            warehouse: $('#warehouse').val()


        },
        success: function (data) {
            console.log(data);
            // if(data == false)
            // {
            //   $('#product_submit').removeClass('kt-spinner');
            //   $('#product_submit').prop("disabled", false);
            //   toastr.warning('Product Code already exist');
            // }
            // uppy.reset();
            // else
            // {
            $('#product_submit').removeClass('kt-spinner');
            $('#product_submit').prop("disabled", false);
            toastr.success('Product details ' + sucess_msg + ' successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
            const channel = new BroadcastChannel("inventory");
            channel.postMessage("success");

            location.reload();
            window.location.href = "ProductList";
            //}
        },
        error: function (jqXhr, json, errorThrown) {
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors, function (key, value) {
                if (jQuery.isPlainObject(value)) {

                    $.each(value, function (index, ndata) {
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

// $(document).on('click', '.kt_products_recover', function() {
//     var id = $(this).attr('id');

// uppy.use(Uppy.Dashboard, {
//    metaFields: [
//     { id: 'name', name: 'Name', placeholder: 'File name' },
//     { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
//   ],
//   browserBackButtonClose: true,
//   target: '#choose-files',
//   inline: true,
//   replaceTargetContent: true,
// })
// uppy.use(Uppy.GoogleDrive,
//   { target: Uppy.Dashboard,
//    companionUrl: 'https://companion.uppy.io'
//   })
// uppy.use(Uppy.Webcam, { target: Uppy.Dashboard })
// uppy.use(Uppy.XHRUpload, {
//   endpoint: 'ProductFileUpload',
//   // UniqueID       : $('#UniqueID').val(),
//   fieldName: 'filenames[]',
//     headers: {
//         'X-CSRF-TOKEN': $('#token').val(),
//          // UniqueID       : $('#UniqueID').val()
//     }
// })



//     if ($('#fileData').val() != '') {
//         var img_array = $('#fileData').val().split(",");
//         console.log(img_array);
//         $.each(img_array, function(i) {
//             onuppyImageClicked('public/' + img_array[i]);
//         });
//     }

//     function onuppyImageClicked(img) {

//         var str = img.toString();
//         var n = str.lastIndexOf('/');
//         var img_name = str.substring(n + 1);
//         // assuming the image lives on a server somewhere
//         return fetch(img)
//             .then((response) => response.blob()) // returns a Blob
//             .then((blob) => {
//                 uppy.addFile({
//                     name: img_name,
//                     type: 'image/jpeg',
//                     data: blob
//                 })
//             })
//     }

// *products delete confirmation message
// */


/**
  *product details for datepicker
  */
$('.ktdatepicker').datepicker({
    todayHighlight: true,

    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});





