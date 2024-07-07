$('.projects').addClass('kt-menu__item--open');
$('.projects-awarded-list').addClass('kt-menu__item--active');
var materialsTbl = $('#materialsTbl').DataTable({
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
        "url": '../project-materials-alocated/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.project_id = $('#project_id').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'product_name', name: 'product_name', "render": function (data, type, row, meta) {
                if (data != null && data.length > 1)
                    return type === 'display' && data.length > 40 ? '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' : data;
                else
                    return data;
            }
        },
        {
            data: 'description', name: 'description', "render": function (data, type, row, meta) {
                if (data != null && data.length > 1)
                    return type === 'display' && data.length > 40 ? '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' : data;
                else
                    return data;
            }
        },
        { data: 'product_code', name: 'product_code' },
        { data: 'unit', name: 'unit' },
        // { data: 'quantity', name: 'quantity' },
        { data: 'quantity', name: 'quantity' },
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


            swal.fire({
                title: 'Submit your Comments',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                confirmButtonText: 'Receive',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    if (login == '') {
                        swal.showValidationMessage(
                            `Enter A Comment First: `
                        )
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "recive-to-project",
                            dataType: "text",
                            data: {
                                _token: $('#token').val(),
                                id: id,
                                comment: login
                            },
                            success: function (data) {
                                if (data == 1) {
                                    toastr.success('EPR Returned for resubmit successfuly');
                                    window.location.href = "epr-approval";
                                }

                            },
                            error: function (jqXhr, json, errorThrown) {
                                console.log('Error !!');
                            }
                        });

                    }

                },
            })


        } else {
            swal.fire("Cancelled", "", "error");
        }
    })
});