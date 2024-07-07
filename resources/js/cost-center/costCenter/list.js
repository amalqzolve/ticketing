$('.list').addClass('kt-menu__item--active');

$(document).ready(function () {
    $('.kt-selectpicker').select2();
});


var datatable_list = $('#datatable_list').DataTable({
    processing: true,
    serverSide: true,
    dom: "Bfrtip",
    pagingType: "full_numbers",
    buttons: [{
        extend: 'copy',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
        }
    }
    ],
    columnDefs: [
        { "width": "450px", "targets": [0, 1] },
        { "width": "40px", "targets": [4] }
    ],
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 20, 50, -1],
        [10, 20, 50, "All"]
    ],
    "pageLength": 20,
    ajax: {
        "url": 'list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    "rowCallback": function (row, data, index) {
        $('td', row).css('cursor', 'pointer');
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'name', name: 'name', render: function (data, type, row) {
                var curData = row.name;
                if (curData != null)
                    return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'code', name: 'code'
        },
        {
            data: 'department', name: 'department', render: function (data, type, row) {
                var curData = row.department;
                if (curData != null)
                    return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'business_area', name: 'business_area', render: function (data, type, row) {
                var curData = row.business_area;
                if (curData != null)
                    return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'functional_area', name: 'functional_area', render: function (data, type, row) {
                var curData = row.functional_area;
                if (curData != null)
                    return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'responsible_person', name: 'responsible_person', render: function (data, type, row) {
                var curData = row.responsible_person;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'description', name: 'description', render: function (data, type, row) {
                var curData = row.description;
                if (curData != null)
                    return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'action', name: 'action' },
    ],
    columnDefs: [
        { width: '50px', "orderable": false, "searchable": false, targets: [0, 8] },
        { width: '20px', "searchable": false, targets: [7] },
        { width: '70px', targets: [1, 2, 3] },
        { width: '200px', targets: [4] },
        { width: '300px', targets: [5, 6] }
    ],
    fixedColumns: true,
});
// 
$('#datatable_list').on('click', 'tbody td', function () {
    var index = $(this).closest("td").index();
    if ((index) && (index != 8)) {
        var data = datatable_list.row(this).data();
        window.location.href = 'list-childen/' + data.id;
    }
});

$(document).on('click', '.closeBtn', function (e) {
    $('#btnSave').removeClass('kt-spinner');
    $('#btnSave').prop("disabled", false);

    $('#id').val('');
    $('#name').val('');
    $('#code').val('');
    $('#description').val('');
    $('#department').val('');
    $('#business_area').val('');
    $('#functional_area').val('');
    $('#responsible_person').val('');
    $('#name').removeClass('is-invalid');
    $('#code').removeClass('is-invalid');
    $('#department').next().find('.select2-selection').removeClass('select-dropdown-error');
    selectRefresh();

});

$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();
    var error = 0;

    if ($('#name').val() == "") {
        $('#name').addClass('is-invalid');
        error++;
    } else
        $('#name').removeClass('is-invalid');
    if ($('#code').val() == "") {
        $('#code').addClass('is-invalid');
        error++;
    } else
        $('#code').removeClass('is-invalid');

    if ($('#department').val() == "") {
        $('#department').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#department').next().find('.select2-selection').removeClass('select-dropdown-error');



    if (error == 0) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);
        if ($('#id').val())
            var sucess_msg = 'Updated';
        else
            var sucess_msg = 'Created';
        $.ajax({
            type: "POST",
            url: "save",
            dataType: "json",
            data: $('#data-form').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                if (data.status == 1) {
                    datatable_list.ajax.reload();
                    $('.closeBtn').click();
                    toastr.success('Cost Center ' + sucess_msg + ' successfuly');
                } else if (data.status == 2) {
                    $.each(data.error, function (key, value) {
                        // $("#" + key).next().html(value[0]);
                        $("#" + key).addClass('is-invalid');
                        $("#" + key).next().find('.select2-selection').addClass('select-dropdown-error');
                        toastr.error(value[0]);
                    });
                }
                else
                    toastr.error('Unknown Error Please Contact Admin');
                $('#btnSave').removeClass('kt-spinner');
                $('#btnSave').prop("disabled", false);
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.warning("Please Fill mandatory Fields !!");

});



$(document).on('click', '.edit_btn', function (e) {
    console.log('xxxx');
    var id = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        url: "get-cost-center/" + id,
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: id
        },
        success: function (data) {
            if (data.status == 1) {
                $('#id').val(data.data.id);
                $('#name').val(data.data.name);
                $('#code').val(data.data.code);
                $('#description').val(data.data.description);
                $('#department').val(data.data.department);
                $('#business_area').val(data.data.business_area);
                $('#functional_area').val(data.data.functional_area);
                $('#responsible_person').val(data.data.responsible_person);
                selectRefresh();
                $('#kt_modal_4_5').modal('show');
            }
            $('#btnSave').removeClass('kt-spinner');
            $('#btnSave').prop("disabled", false);
        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });
});



$("#export-button-print").on("click", function () {
    datatable_list.button('.buttons-print').trigger();
});
$("#export-button-copy").on("click", function () {
    datatable_list.button('.buttons-copy').trigger();
});
$("#export-button-csv").on("click", function () {
    datatable_list.button('.buttons-csv').trigger();
});
$("#export-button-pdf").on("click", function () {
    datatable_list.button('.buttons-pdf').trigger();
});



