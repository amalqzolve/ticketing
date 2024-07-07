$('.supplierQuotation').addClass('kt-menu__item--active');
var boqListTable = $('#list').DataTable({
    processing: true,
    serverSide: true,
    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 20, 50, -1],
        [10, 20, 50, "All"]
    ],
    "pageLength": 20,
    buttons: [{
        extend: 'copy',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    }
    ],

    ajax: {
        "url": 'quote-comparison-detail-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val(),
                data.id = $('#eprId').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        // {
        //     data: 'id',
        //     name: 'id',
        //     render: function (data, type, row) {
        //         return '#EPR-' + row.epr_id + '&nbsp;&nbsp;';
        //     }
        // },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return '#RFQ-' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'rfq_date', name: 'rfq_date' },
        { data: 'supp_quot_id', name: 'supp_quot_id' },
        { data: 'quot_date', name: 'quot_date' },
        { data: 'quote_valid_date', name: 'quote_valid_date' },
        {
            data: 'sup_name', name: 'sup_name', render: function (data, type, row) {
                var curData = row.sup_name;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'status',
            name: 'status',
            render: function (data, type, row) {
                if (row.status == 1)
                    return '<span style="color: black">Draft</span>';
                if (row.status == 2)
                    return '<span style="color: green">Quote Submited</span>';
                if (row.status == 3)
                    return '<span style="color: blue">Send</span>';
            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                if (row.status == 1) {//approval pending
                    j = '<a href="epr-rfq-view?id=' + row.id + '"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                    </span></li></a>\
                    <a href="epr-rfq-view-pdf?id=' + row.id + '"  target="_blank"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="epr-rfq-edit?id=' + row.id + '"  data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                    </span></li></a>\
                    <a href="#" data-target="#kt_form" ><li class="kt-nav__item send" id="' + row.id + '">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Send</span>\
                    </span></li></a>';
                }
                if (row.status == 2) {//approval pending
                    j = '<a href="epr-rfq-view?id=' + row.id + '"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                    </span></li></a>\
                    <a href="epr-rfq-view-pdf?id=' + row.id + '"  target="_blank"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="epr-rfq-generate-po?id=' + row.id + '" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Generate PO</span>\
                    </span></li></a>';
                }
                if (row.status == 3) {//approval pending
                    j = '<a href="epr-rfq-view?id=' + row.id + '"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                    </span></li></a>\
                    <a href="epr-rfq-view-pdf?id=' + row.id + '"  target="_blank"  data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-background"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                    </span></li></a>\
                    <a href="epr-rfq-submit?id=' + row.id + '" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Submit</span>\
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


$(document).on('click', '.epr_resubmit', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Resubmit this EPR",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Resubmit",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            loaderShow();
            $.ajax({
                type: "POST",
                url: "epr-resubmit",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data.status == 1) {
                        loaderClose();
                        toastr.success('EPR Resubmited successfuly');
                        window.location.href = "epr-approval";
                    } else
                        toastr.error(data.msg);


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

$(document).on('click', '.epr_reject', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Reject this EPR",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Reject",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            loaderShow();
            $.ajax({
                type: "POST",
                url: "epr-reject",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    loaderClose();
                    if (data.status == 1) {
                        toastr.success('EPR Rejected successfuly');
                        window.location.href = "epr-approval";
                    } else
                        toastr.error(data.msg);

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


$(document).on('click', '.send', function () {
    var id = $(this).attr('id');
    alert(id);
    swal.fire({
        title: "Are you sure?",
        text: "Send this RFQ !!",
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
                url: "send-rfq",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    loaderClose();
                    if (data.status == 1) {
                        toastr.success('RFQ Send successfuly');
                        location.reload();
                    } else
                        toastr.error(data.msg);

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


$("#export-button-print").on("click", function () {
    boqListTable.button('.buttons-print').trigger();
});

$("#export-button-print").on("click", function () {
    boqListTable.button('.buttons-print').trigger();
});


$("#export-button-copy").on("click", function () {
    boqListTable.button('.buttons-copy').trigger();
});

$("#export-button-csv").on("click", function () {
    boqListTable.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    boqListTable.button('.buttons-pdf').trigger();
});



