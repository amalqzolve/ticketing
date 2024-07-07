$('.car-in-and-out').addClass('kt-menu__item--active');

var listDraft = $('#listDraft').DataTable({
    processing: true,
    serverSide: true,
    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 20, 25, 50, -1],
        [10, 20, 25, 50, "All"]
    ],
    pageLength: 20,
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
            doc.pageMargins = [50, 50, 50, 50];
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

    ajax: {
        "url": 'car-in-and-out',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'trip_id', name: 'trip_id' },
        { data: 'car_name', name: 'car_name' },
        { data: 'rental_type', name: 'rental_type' },
        { data: 'trip_start_date', name: 'trip_start_date' },
        { data: 'trip_end_date', name: 'trip_end_date' },
        { data: 'renter_name', name: 'renter_name' },
        { data: 'mobile', name: 'mobile' },
        { data: 'renter_iqama', name: 'renter_iqama' },
        { data: 'action', name: 'action' },

    ]
});

var listConfirmed = $('#listConfirmed').DataTable({
    processing: true,
    serverSide: true,

    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 20, 25, 50, -1],
        [10, 20, 25, 50, "All"]
    ],
    pageLength: 20,
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
            doc.pageMargins = [50, 50, 50, 50];
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

    ajax: {
        "url": 'car-in-and-out-confirmed',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'trip_id', name: 'trip_id' },
        { data: 'car_name', name: 'car_name' },
        { data: 'rental_type', name: 'rental_type' },
        { data: 'trip_start_date', name: 'trip_start_date' },
        { data: 'trip_end_date', name: 'trip_end_date' },
        { data: 'renter_name', name: 'renter_name' },
        { data: 'mobile', name: 'mobile' },
        { data: 'renter_iqama', name: 'renter_iqama' },
        { data: 'action', name: 'action' },

    ]
});;
var listCompleted = $('#listCompleted').DataTable({
    processing: true,
    serverSide: true,
    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 20, 25, 50, -1],
        [10, 20, 25, 50, "All"]
    ],
    pageLength: 20,
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
            doc.pageMargins = [50, 50, 50, 50];
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

    ajax: {
        "url": 'car-in-and-out-completed',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'trip_id', name: 'trip_id' },
        { data: 'car_name', name: 'car_name' },
        { data: 'rental_type', name: 'rental_type' },
        { data: 'trip_start_date', name: 'trip_start_date' },
        { data: 'trip_end_date', name: 'trip_end_date' },
        { data: 'renter_name', name: 'renter_name' },
        { data: 'mobile', name: 'mobile' },
        { data: 'renter_iqama', name: 'renter_iqama' },
        { data: 'payment_status', name: 'payment_status' },
        { data: 'action', name: 'action' },

    ],
    "fnRowCallback": function (nRow, aData, iDisplayIndex) {
        $("td:nth-child(3)", nRow).html($("td:nth-child(3)", nRow).text());
    },

});
var listCancelled = $('#listCancelled').DataTable({
    processing: true,
    serverSide: true,
    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 20, 25, 50, -1],
        [10, 20, 25, 50, "All"]
    ],
    pageLength: 20,
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
            doc.pageMargins = [50, 50, 50, 50];
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

    ajax: {
        "url": 'car-in-and-out-canceled',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'trip_id', name: 'trip_id' },
        { data: 'car_name', name: 'car_name' },
        { data: 'rental_type', name: 'rental_type' },
        { data: 'trip_start_date', name: 'trip_start_date' },
        { data: 'trip_end_date', name: 'trip_end_date' },
        { data: 'renter_name', name: 'renter_name' },
        { data: 'mobile', name: 'mobile' },
        { data: 'renter_iqama', name: 'renter_iqama' },
        { data: 'action', name: 'action' },
    ]
});



$(document).on('click', '.confirmTrip', function () {
    var id = $(this).attr('id');


    $.ajax({
        type: "POST",
        url: "get-car-in-and-out",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: id,
        },
        success: function (data) {
            if (data.status == 1) {
                $('#kt_modal_4_4').modal('show');
                $('#rental_id').val(id);

                $('#trip_start_odometer').removeClass('is-invalid');
                $('#ins_id').removeClass('is-invalid');
                $('#ins_type').removeClass('is-invalid');
                $('#ins_amount').removeClass('is-invalid');
                $('#ins_start_date').removeClass('is-invalid');
                $('#ins_end_date').removeClass('is-invalid');

                $('#trip_start_odometer').val(data.data.trip_start_odometer);
                $('#ins_id').val('');
                $('#ins_type').val('');
                $('#ins_amount').val('');
                $('#ins_start_date').val('');
                $('#ins_end_date').val('');
                $('#ins_note').val('');
            } else {
                toastr.error(data.msg);
            }
        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });







});



$(document).on('click', '#btnConfirmSave', function () {
    var error = 0;


    if ($('#trip_start_odometer').val() == '') {
        error++;
        $('#trip_start_odometer').addClass('is-invalid');
    } else
        $('#trip_start_odometer').removeClass('is-invalid');

    if ($('#ins_id').val() == '') {
        error++;
        $('#ins_id').addClass('is-invalid');
    } else
        $('#ins_id').removeClass('is-invalid');

    if ($('#ins_type').val() == '') {
        error++;
        $('#ins_type').addClass('is-invalid');
    } else
        $('#ins_type').removeClass('is-invalid');

    if ($('#ins_amount').val() == '') {
        error++;
        $('#ins_amount').addClass('is-invalid');
    } else
        $('#ins_amount').removeClass('is-invalid');

    if ($('#ins_start_date').val() == '') {
        error++;
        $('#ins_start_date').addClass('is-invalid');
    } else
        $('#ins_start_date').removeClass('is-invalid');

    if ($('#ins_end_date').val() == '') {
        error++;
        $('#ins_end_date').addClass('is-invalid');
    } else
        $('#ins_end_date').removeClass('is-invalid');




    var from = $("#ins_start_date").val();
    var to = $("#ins_end_date").val();

    if (!chekFromToDate(from, to)) {
        error++;
        $('#ins_start_date').addClass('is-invalid');
        $("#ins_end_date").addClass('is-invalid');
    } else {
        $('#ins_start_date').removeClass('is-invalid');
        $('#ins_end_date').removeClass('is-invalid');
    }



    if ($('#terms_conditions').val() == '') {
        error++;
        $('#terms_conditions').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Select Terms And Conditions !!');
    }
    else
        $('#terms_conditions').next().find('.select2-selection').removeClass('select-dropdown-error');

    if (!error) {
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Confirm this Trip",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel"
        }).then(result => {
            if (result.value) {
                $('#btnConfirmSave').addClass('kt-spinner');
                $('#btnConfirmSave').attr("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "car-in-and-out-confirm",
                    dataType: "json",
                    data: $('#data-form-confirm').serialize() + "&_token=" + $('#token').val(),
                    success: function (data) {
                        if (data.status == 1) {
                            toastr.warning('Car In And out Confirmed successfuly');
                            window.location.href = "car-in-and-out";
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
    }

})


$(document).on('click', '.completeTrip', function () {
    var id = $(this).attr('id');

    $('.remove').each(function (index) {
        $(this).click();
    });
    $('#id').val('');
    $('#trip_start_date').val('');
    $('#trip_end_date').val('');
    $.ajax({
        type: "POST",
        url: "get-car-in-and-out",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: id,
        },
        success: function (data) {
            if (data.status == 1) {
                $('#kt_modal_4_5').modal('show');
                $('#id').val(data.data.id);
                $('#trip_start_date').val(data.data.trip_start_date);
                $('#trip_end_date').val(data.data.trip_end_date);
                $('#trip_start_odometer_11').val(data.data.trip_start_odometer)
            } else {
                toastr.error(data.msg);
            }
        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });



});

$(document).on('click', '#addrow', function (e) {
    var $tableBody = $('#additionalTable').find("tbody"),
        $trLast = $tableBody.find("tr:last"),
        $trNew = $trLast.clone();
    $trNew.find("input:text").val('');
    $trLast.after($trNew);
    $('#additionalTable tbody tr').each(function (index) {
        $(this).children().first().text(index + 1);
    });
})

$("body").on("click", ".remove", function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');
    $("#additionalTable tbody tr td").removeClass("selected");
    if ($('#additionalTable tbody tr').length == 1) {
        $('input[name="amount[]"]').val('');
        $('input[name="remarks[]"]').val('');
    } else {
        var siblings = row.siblings();
        row.remove();
        siblings.each(function (index) {
            $(this).children().first().text(index + 1);
        });
    }
    findTotal();
});
$("body").on("keyup", ".valChanged", function (event) {
    findTotal();
})

function findTotal() {
    var total = 0;
    $("input[name^='amount[]']").each(function (input) {
        total += ($(this).val() != '') ? parseInt($(this).val()) : 0;
    });
    $('#otherTotal').val(total)
}

$(document).on('click', '.cancelTrip', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Cancel this Trip",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Cancel",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "car-in-and-out-cancel",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data.status == 1) {
                        toastr.warning('Car In And out Cancelled successfuly');
                        window.location.href = "car-in-and-out";
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



$(document).on('click', '.trashTrip', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want trash this Trip",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Trash",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: "car-in-and-out-delete",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data.status == 1) {
                        toastr.warning('Car In And out Deleted successfuly');
                        window.location.href = "car-in-and-out";
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



$(document).on('click', '#btnCompleteSave', function () {
    var error = 0;

    if ($('#trip_end_odometer').val() == '') {
        error++;
        $('#trip_end_odometer').addClass('is-invalid');
    } else
        $('#trip_end_odometer').removeClass('is-invalid');

    if ($('#trip_start_odometer_11').val() > $('#trip_end_odometer').val()) {
        error++;
        $('#trip_end_odometer').addClass('is-invalid');
    } else
        $('#trip_end_odometer').removeClass('is-invalid');

    if (!error) {
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Complete this Trip",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Complete",
            cancelButtonText: "Cancel"
        }).then(result => {
            if (result.value) {
                $('#btnCompleteSave').addClass('kt-spinner');
                $('#btnCompleteSave').attr("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "car-in-and-out-complete",
                    dataType: "json",
                    data: $('#data-form-complete').serialize() + "&_token=" + $('#token').val(),
                    success: function (data) {
                        if (data.status == 1) {
                            toastr.warning('Car In And out Completed successfuly');
                            window.location.href = "car-in-and-out";
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
    }
});

$('.nav-link').click(function () {
    var id = $(this).attr('id');
    $('#tblNames').val(id);
});


// $("#export-button-print").on("click", function () {
//     var tbl = $('#tblNames').val();
//     if (tbl == 1)
//         listDraft.button('.buttons-print').trigger();
//     else if (tbl == 2)
//         listConfirmed.button('.buttons-print').trigger();
//     else if (tbl == 3)
//         listCompleted.button('.buttons-print').trigger();
//     else if (tbl == 4)
//         listCancelled.button('.buttons-print').trigger();
// });

$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        listDraft.button('.buttons-print').trigger();
    else if (tbl == 2)
        listConfirmed.button('.buttons-print').trigger();
    else if (tbl == 3)
        listCompleted.button('.buttons-print').trigger();
    else if (tbl == 4)
        listCancelled.button('.buttons-print').trigger();

});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        listDraft.button('.buttons-copy').trigger();
    else if (tbl == 2)
        listConfirmed.button('.buttons-copy').trigger();
    else if (tbl == 3)
        listCompleted.button('.buttons-copy').trigger();
    else if (tbl == 4)
        listCancelled.button('.buttons-copy').trigger();

});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        listDraft.button('.buttons-csv').trigger();
    else if (tbl == 2)
        listConfirmed.button('.buttons-csv').trigger();
    else if (tbl == 3)
        listCompleted.button('.buttons-csv').trigger();
    else if (tbl == 4)
        listCancelled.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        listDraft.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        listConfirmed.button('.buttons-pdf').trigger();
    else if (tbl == 3)
        listCompleted.button('.buttons-pdf').trigger();
    else if (tbl == 4)
        listCancelled.button('.buttons-pdf').trigger();
});

