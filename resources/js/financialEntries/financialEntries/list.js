$('.financialEntries').addClass('kt-menu__item--active');

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
        "url": '../e-treasury/issued-payment-voucher-list',
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
                var j = '<a href="../e-treasury/generated-payment-voucher-pdf?id=' + row.payment_voucher_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                <span class="kt-nav__link-text" data-id="' + row.id + '" >Payment Voucher</span>\
                </span></li></a>\
                <a href="../e-treasury/issued-payment-voucher-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
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



