$('.electronicTreasury').addClass('kt-menu__item--active');
var pendingVouchers = $('#pendingVouchers').DataTable({
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
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%', '5%', '5%'];
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
        "url": 'e-treasury-vouchers',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },

    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id', name: 'id',
            render: function (data, type, row) {
                return 'VC ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'voucher_name', name: 'voucher_name' },
        { data: 'sup_name', name: 'sup_name' },
        {
            data: 'purchase_type', name: 'purchase_type',
            render: function (data, type, row) {
                if (row.purchase_type == 1)
                    return "Cash";
                else if (row.purchase_type == 2)
                    return "Credit";
                else
                    return "-";
            }
        },
        { data: 'bill_id', name: 'bill_id' },
        { data: 'quotedate', name: 'quotedate' },
        { data: 'entrydate', name: 'entrydate' },
        { data: 'po_wo_ref', name: 'po_wo_ref' },
        { data: 'purchaser', name: 'purchaser' },
        { data: 'totalamount', name: 'totalamount' },
        { data: 'totalvatamount', name: 'totalvatamount' },
        { data: 'grandtotalamount', name: 'grandtotalamount' },
        { data: 'paidamount', name: 'paidamount' },
        { data: 'balanceamount', name: 'balanceamount' },
        {
            data: 'status', name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Draft</span>';
                if (row.status == 2)
                    return '<span style="color: blue">Send</span>';
                if (row.status == 3)
                    return '<span style="color: orange">Returned</span>';
                if (row.status == 4)
                    return '<span style="color: red">Rejected</span>';
                if (row.status == 5)
                    return '<span style="color: blue">Resubmited</span>';
                if (row.status == 6)
                    return '<span style="color: green">Approved</span>';
                if (row.status == 0)
                    return '<span style="color: red">Trashed</span>';

            }
        },
        {
            data: 'payment_voucher_status',
            name: 'payment_voucher_status',
            render: function (data, type, row) {
                if (row.payment_voucher_status == 1)
                    return '<span style="color: black">Not Genearted</span>';
                if (row.payment_voucher_status == 2)
                    return '<span style="color: green">Generated</span>';
            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.payment_voucher_status == 1) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                            </span></li></a>\
                            <a href="generate-payment-voucher-vc?id=' + row.id + '" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >Generate Payment Voucher</span>\
                            </span></li></a>';
                }
                if (row.payment_voucher_status == 2) {
                    j = '<a href="voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                }

                return '<span style="overflow: visible; position: relative; width: 80px;">\
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                            <i class="fa fa-cog"></i></a>\
                            <div class="dropdown-menu dropdown-menu-right">\
                            <ul class="kt-nav">'+ j + '\
                           </ul></div></div></span>';
            }
        },
    ]
});


var pendingTbl = $('#pendingTbl').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    }
    ],

    ajax: {
        "url": 'electronic-treasury',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return 'S-PAY ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'created_at', name: 'created_at' },
        { data: 'sup_name', name: 'sup_name' },
        {
            data: 'invoice_id',
            name: 'invoice_id',
            render: function (data, type, row) {
                return 'S-INV ' + row.invoice_id + '&nbsp;&nbsp;';
            }
        },
        { data: 'supplier_invoice_date', name: 'supplier_invoice_date' },
        {
            data: 'po_id',
            name: 'po_id',
            render: function (data, type, row) {
                return 'PO# ' + row.po_id + '&nbsp;&nbsp;';
            }
        },
        { data: 'po_date', name: 'po_date' },
        { data: 'req_amount', name: 'req_amount' },
        {
            data: 'status',
            name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Draft</span>';
                if (row.status == 2)
                    return '<span style="color: blue">Send</span>';
                if (row.status == 3)
                    return '<span style="color: orange">Returned</span>';
                if (row.status == 4)
                    return '<span style="color: red">Rejected</span>';
                if (row.status == 5)
                    return '<span style="color: blue">Resubmited</span>';
                if (row.status == 6)
                    return '<span style="color: green">Approved</span>';
                if (row.status == 0)
                    return '<span style="color: red">Trashed</span>';

            }
        },
        {
            data: 'payment_voucher_status',
            name: 'payment_voucher_status',
            render: function (data, type, row) {
                if (row.payment_voucher_status == 1)
                    return '<span style="color: black">Not Genearted</span>';
                if (row.payment_voucher_status == 2)
                    return '<span style="color: green">Generated</span>';
            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.payment_voucher_status == 1) {
                    j = '<a href="supplier-payment-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a href="generate-payment-voucher?id=' + row.id + '" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Generate Payment Voucher</span>\
                        </span></li></a>';
                }
                if (row.payment_voucher_status == 2) {
                    j = '<a href="supplier-payment-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                }
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+ j + '\
                       </ul></div></div></span>';
            }
        },
    ]
});



var voucherTbl = $('#voucherTbl').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    }
    ],

    ajax: {
        "url": 'electronic-treasury-generated-voucher',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [

        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return 'G-PV ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'voucher_date', name: 'voucher_date' },
        {
            data: 'payment_method',
            name: 'payment_method',
            render: function (data, type, row) {
                var met;
                if (row.payment_method == 1)
                    return 'Cash';
                else if (row.payment_method == 2)
                    return 'Bank Transfer';
                else if (row.payment_method == 3)
                    return 'Cheque';
                else if (row.payment_method == 4)
                    return 'Card Payment';
            }
        },
        { data: 'voucher_reference', name: 'voucher_reference' },
        { data: 'sup_name', name: 'sup_name' },
        {
            data: 'invoice_id',
            name: 'invoice_id',
            render: function (data, type, row) {
                if (row.invoice_id)
                    return 'S-INV ' + row.invoice_id + '&nbsp;&nbsp;';
                else
                    return '--';
            }
        },
        {
            data: 'supplier_payement_id',
            name: 'supplier_payement_id',
            render: function (data, type, row) {
                if (row.supplier_payement_id)
                    return 'S-PRQ ' + row.supplier_payement_id + '&nbsp;&nbsp;';
                else
                    return '--';
            }
        },
        { data: 'amount', name: 'amount' },
        {
            data: 'status',
            name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Not Issued</span>';
                if (row.status == 2)
                    return '<span style="color: green">Issued</span>';
            }
        },

        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.status == 1) {
                    j = '<a href="generated-payment-voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Payment Voucher</span>\
                        </span></li></a>\
                        <a href="issue-payment-voucher?id=' + row.id + '" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Issue Payment</span>\
                        </span></li></a>';
                } else {
                    j = '<a href="generated-payment-voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Payment Voucher</span>\
                    </span></li></a>';
                }
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+ j + '\
                       </ul></div></div></span>';
            }
        },
    ]
});



var stockRequestTable = $('#issuedTbl').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    }
    ],

    ajax: {
        "url": 'issued-payment-voucher-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [

        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return 'ISS-P ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'issued_date', name: 'issued_date' },
        {
            data: 'payment_method',
            name: 'payment_method',
            render: function (data, type, row) {
                var met;
                if (row.payment_method == 1)
                    return 'Cash';
                else if (row.payment_method == 2)
                    return 'Bank Transfer';
                else if (row.payment_method == 3)
                    return 'Cheque';
                else if (row.payment_method == 4)
                    return 'Card Payment';
            }
        },
        { data: 'amount', name: 'amount' },
        { data: 'receiver_name', name: 'receiver_name' },
        { data: 'relation_with_supplier', name: 'relation_with_supplier' },
        { data: 'designation', name: 'designation' },
        { data: 'department', name: 'department' },
        { data: 'national_id', name: 'national_id' },
        { data: 'phone_number', name: 'phone_number' },
        { data: 'issued_date', name: 'issued_date' },
        { data: 'name', name: 'name' },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '<a href="generated-payment-voucher-pdf?id=' + row.payment_voucher_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                <span class="kt-nav__link-text" data-id="' + row.id + '" >Payment Voucher</span>\
                </span></li></a>\
                <a href="issued-payment-voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Voucher Acknowledgement</span>\
                        </span></li></a>';
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+ j + '\
                       </ul></div></div></span>';
            }
        },

    ]
});


$(document).on('click', '.sendForApproval', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Send this Supplier Payment For Approval",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Send",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            loaderShow();
            $.ajax({
                type: "POST",
                url: "supplier-payment-send",
                dataType: "text",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data == 1) {
                        loaderClose();
                        toastr.success('Supplier Payment Send for Approval successfuly');
                        window.location.href = "supplier-payment";
                    }
                },
                error: function (jqXhr, json, errorThrown) {
                    console.log('Error !!');
                }
            });

        } else {

            swal.fire("Cancelled", "", "error");
        }
    })
});



$('.kt-wizard-v3__nav-item').click(function () {
    var id = $(this).attr('id');
    $('#tblNames').val(id);
});


$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-print').trigger();
    else if (tbl == 2)
        voucherTbl.button('.buttons-print').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-print').trigger();

});

$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-print').trigger();
    else if (tbl == 2)
        voucherTbl.button('.buttons-print').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-print').trigger();

});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-copy').trigger();
    else if (tbl == 2)
        voucherTbl.button('.buttons-copy').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-copy').trigger();

});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-csv').trigger();
    else if (tbl == 2)
        voucherTbl.button('.buttons-csv').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        voucherTbl.button('.buttons-pdf').trigger();
    else if (tbl == 3)
        stockRequestTable.button('.buttons-pdf').trigger();
});



