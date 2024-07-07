$('.sales-order-list').addClass('kt-menu__item--active');
var salesOrderList = $('#salesOrderList').DataTable({
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
            doc.pageMargins = [50, 50, 50, 50];
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
        "url": 'sales-order-list',
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
                return 'SO ' + row.id;
            }
        },
        {
            data: 'cust_name', name: 'cust_name', render: function (data, type, row) {
                var curData = row.cust_name;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'projectname', name: 'projectname', render: function (data, type, row) {
                var curData = row.projectname;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'startdate', name: 'startdate' },
        { data: 'enddate', name: 'enddate' },
        {
            data: 'clients_po_number', name: 'clients_po_number', render: function (data, type, row) {
                var curData = row.clients_po_number;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'sovalue', name: 'sovalue', render: function (data, type, row) {
                var curData = row.sovalue;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'sodate', name: 'sodate' },
        {
            data: 'created_by', name: 'created_by', render: function (data, type, row) {
                var curData = row.created_by;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
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
                      <i class="kt-nav__link-icon flaticon-open-box"></i>\
                      <span class="kt-nav__link-text convertToProject" id=' + row.id + ' data-id=' + row.id + '>Convert To Project</span></span></li>\
                      <li class="kt-nav__item">\
                      <span class="kt-nav__link">\
                      <i class="kt-nav__link-icon flaticon2-trash"></i>\
                      <span class="kt-nav__link-text delSalesOrder" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                     </ul></div></div></span>';
            }
        },

    ]
});


var salesOrderListConverted = $('#salesOrderListConverted').DataTable({
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
            doc.pageMargins = [50, 50, 50, 50];
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
        "url": 'sales-order-converted-list',
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
                return 'SO ' + row.id;
            }
        },
        {
            data: 'cust_name', name: 'cust_name', render: function (data, type, row) {
                var curData = row.cust_name;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'projectname', name: 'projectname', render: function (data, type, row) {
                var curData = row.projectname;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'startdate', name: 'startdate' },
        { data: 'enddate', name: 'enddate' },
        {
            data: 'clients_po_number', name: 'clients_po_number', render: function (data, type, row) {
                var curData = row.clients_po_number;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'sovalue', name: 'sovalue', render: function (data, type, row) {
                var curData = row.sovalue;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'sodate', name: 'sodate' },
        {
            data: 'created_by', name: 'created_by', render: function (data, type, row) {
                var curData = row.created_by;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'converted_by', name: 'converted_by' },

    ]
});



$(document).on('click', '.delSalesOrder', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want trash this Sales Order",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Trash",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "so-delete",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data.status == 1) {
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

$(document).on('click', '.convertToProject', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want convert this Sales Order To Project",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Convert",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "so-convert-to-project",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success('Convetion Success successfuly');
                        location.reload();
                    } else {
                        swal.fire({
                            title: "Error !!!",
                            text: data.msg,
                            type: "error",
                        });
                    }
                },
                error: function (jqXhr, json, errorThrown) {
                    console.log('Error !!');
                }
            })
        } else {
            swal.fire("Cancelled", "", "error");
        }
    });


});