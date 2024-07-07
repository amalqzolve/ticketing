$('.settings').addClass('kt-menu__item--open');
$('.managelabels').addClass('kt-menu__item--active');
var labels_details_list_table = $('#labels_details_list').DataTable({
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
            columns: [0, 1, 2]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
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
            columns: [0, 1, 2]
        }
    }
    ],

    ajax: {
        "url": 'managelabels',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },

        {
            data: 'color',
            name: 'color',
            render: function (data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
            }
        },
        { data: 'action', name: 'action' },

    ]
});
$(document).on('click', '#label_submit', function (e) {
    e.preventDefault();

    title = $('#title').val();
    color = $('#color').val();


    if (title == "") {
        $('#title').addClass('is-invalid');
        toastr.warning('Title is Required');
        return false;
    } else {
        $('#title').removeClass('is-invalid');
    }

    if (color == "") {
        $('#color').addClass('is-invalid');
        toastr.warning('Colour is Required');
        return false;
    } else {
        $('#color').removeClass('is-invalid');
    }



    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }


    $.ajax({
        type: "POST",
        url: "labelsubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            title: $('#title').val(),
            color: $('#color').val(),
            branch: $('#branch').val()
        },
        success: function (data) {



            if (data == false) {
                $('#label_submit').removeClass('kt-spinner');
                $('#label_submit').prop("disabled", false);
                toastr.success('Label name is already exist');

            }
            else {
                $('#label_submit').removeClass('kt-spinner');
                $('#label_submit').prop("disabled", false);
                closeModel();
                labels_details_list_table.ajax.reload();
                toastr.success('Label ' + sucess_msg + ' successfuly');
            }

        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});
function closeModel() {

    $("#kt_modal_4_5").modal("hide");
    $('#id').val("");
    $('#title').val("");

    $('#color').val("");

}
$(document).on('click', '.labelupdate', function () {

    var info_id = $(this).attr("data-id");
    $.ajax({
        url: "getlabelupdate",
        method: "POST",
        data: {
            _token: $('#token').val(),
            info_id: info_id
        },
        dataType: "json",
        success: function (data) {
            $('#title').val(data['users'].title);

            $('#color').val(data['users'].color);
            $('#id').val(info_id);
        }
    })
});
$(document).on('click', '.dellabels', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: 'deletelabels',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {
                    console.log(data);
                    if (data == 'true') {
                        swal.fire("Deleted!", "Your label has been deleted.", "success");
                        labels_details_list_table.ajax.reload();
                    }


                }
            });
        } else {
            swal.fire("Cancelled", "Your Entry is safe :)", "error");

        }
    })
});


$("#labels_details_list_print").on("click", function () {
    labels_details_list_table.button('.buttons-print').trigger();
});


$("#labels_details_list_copy").on("click", function () {
    labels_details_list_table.button('.buttons-copy').trigger();
});

$("#labels_details_list_csv").on("click", function () {
    labels_details_list_table.button('.buttons-csv').trigger();
});

$("#labels_details_list_pdf").on("click", function () {
    labels_details_list_table.button('.buttons-pdf').trigger();
});