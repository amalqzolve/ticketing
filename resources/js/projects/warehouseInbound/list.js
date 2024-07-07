$('.projectMaterials').addClass('kt-menu__item--open');
$('.warehouse-inbound-list').addClass('kt-menu__item--active');
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
        "url": 'warehouse-inbound-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.project_id = $('#project_id').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return 'TS ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'transfer_date', name: 'transfer_date' },
        {
            data: 'stock_transfer_id',
            name: 'stock_transfer_id',
            render: function (data, type, row) {
                return 'ST ' + row.stock_transfer_id + '&nbsp;&nbsp;';
            }
        },
        {
            data: 'epr_id',
            name: 'epr_id',
            render: function (data, type, row) {
                return 'EPR ' + row.epr_id + '&nbsp;&nbsp;';
            }
        },
        { data: 'name', name: 'name' },
        { data: 'warehouse_name', name: 'warehouse_name' },
        {
            data: 'request_type', name: 'request_type',
            render: function (data, type, row) {
                if (row.request_type == 1)
                    return 'Internal use';
                else if (row.request_type == 2)
                    return 'Department use';
                else if (row.request_type == 3)
                    return 'Personal Use';
                else if (row.request_type == 4)
                    return 'Project Purpose';
            }
        },
        {
            data: 'request_against', name: 'request_against',
            render: function (data, type, row) {
                if (row.request_against == 1)
                    return 'BOQ';
                else if (row.request_against == 2)
                    return 'Non BOQ';
                else if (row.request_against == 3)
                    return 'Stock request';
            }
        },
        {
            data: 'mr_category', name: 'mr_category',
        },
        {
            data: 'client', name: 'client',
            render: function (data, type, row) {
                if (row.client == null)
                    return '--';
                else
                    return row.client;
            }
        },
        {
            data: 'project', name: 'project',
            render: function (data, type, row) {
                if (row.project == null)
                    return '--';
                else
                    return row.project;
            }
        },

        {
            data: 'received_status',
            name: 'received_status',
            render: function (data, type, row) {
                if (row.received_status == 0)
                    return '<span style="color: black">Not Received</span>';
                else if (row.received_status == 1)
                    return '<span style="color: blue">Received</span>';
                else
                    return '-';
            }
        },
        { data: 'action', name: 'action' },
    ]
});

var doneTbl = $('#doneTbl').DataTable({
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
        "url": 'warehouse-inbound-list-done',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.project_id = $('#project_id').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return 'TS ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'transfer_date', name: 'transfer_date' },
        {
            data: 'stock_transfer_id',
            name: 'stock_transfer_id',
            render: function (data, type, row) {
                return 'ST ' + row.stock_transfer_id + '&nbsp;&nbsp;';
            }
        },
        {
            data: 'epr_id',
            name: 'epr_id',
            render: function (data, type, row) {
                return 'EPR ' + row.epr_id + '&nbsp;&nbsp;';
            }
        },
        { data: 'name', name: 'name' },
        { data: 'warehouse_name', name: 'warehouse_name' },
        {
            data: 'request_type', name: 'request_type',
            render: function (data, type, row) {
                if (row.request_type == 1)
                    return 'Internal use';
                else if (row.request_type == 2)
                    return 'Department use';
                else if (row.request_type == 3)
                    return 'Personal Use';
                else if (row.request_type == 4)
                    return 'Project Purpose';
            }
        },
        {
            data: 'request_against', name: 'request_against',
            render: function (data, type, row) {
                if (row.request_against == 1)
                    return 'BOQ';
                else if (row.request_against == 2)
                    return 'Non BOQ';
                else if (row.request_against == 3)
                    return 'Stock request';
            }
        },
        {
            data: 'mr_category', name: 'mr_category',
        },
        {
            data: 'client', name: 'client',
            render: function (data, type, row) {
                if (row.client == null)
                    return '--';
                else
                    return row.client;
            }
        },
        {
            data: 'project', name: 'project',
            render: function (data, type, row) {
                if (row.project == null)
                    return '--';
                else
                    return row.project;
            }
        },

        {
            data: 'received_status',
            name: 'received_status',
            render: function (data, type, row) {
                if (row.received_status == 0)
                    return '<span style="color: black">Not Received</span>';
                else if (row.received_status == 1)
                    return '<span style="color: blue">Received</span>';
                else
                    return '-';
            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';

                j = '<a href="../transfer-stock-pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery Note</span>\
                    </span></li></a>';
                if (row.received_status != 1) {
                    j += '<a data-type="edit" data-target="#kt_form"><li class="kt-nav__item receive_products" id=' + row.id + '>\
                <span class="kt-nav__link">\
                <i class="kt-nav__link-icon flaticon-piggy-bank"></i>\
                <span class="kt-nav__link-text" data-id="' + row.id + '" >Receive Items</span>\
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



$(document).on('click', '.receive_products', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Receive this Products",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Receive",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            $('#kt_modal_4_5').modal('show');
            $('#comment').val('');
            $('#received_date').val('');
            $('#id').val(id);

        } else {
            swal.fire("Cancelled", "", "error");
        }
    })
});

$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();
    var error = 0;
    if ($('#received_date').val() == "") {
        $('#received_date').addClass('is-invalid');
        error++;
    } else
        $('#received_date').removeClass('is-invalid');


    if (!error) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "recive-to-project",
            dataType: "json",
            data: $('#data-from').serialize() + "&_token=" + $('#token').val() + "&project_id=" + $('#project_id').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#kt_modal_4_5').modal('hide');
                    toastr.success('Received To Project Successfully');
                    pendingTbl.ajax.reload();
                    doneTbl.ajax.reload();
                    $('#btnSave').removeClass('kt-spinner');
                    $('#btnSave').prop("disabled", false);
                    $('#comment').val('');
                    $('#received_date').val('');
                    $('#id').val('');
                } else
                    toastr.error(data.msg);

            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});