$('.sales-order-list').addClass('kt-menu__item--active');
$(document).on('click', '#projectsubmit', function (e) {
    e.preventDefault();


    var error = 0;
    if ($('#client_id').val() == "") {
        $('#client_id').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Client is Required');
        error++;
    } else
        $('#client_id').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#projectname').val() == "") {
        $('#projectname').addClass('is-invalid');
        toastr.warning(' Project Name is Required');
        error++;
    } else
        $('#projectname').removeClass('is-invalid');


    if ($('#startdate').val() == "") {
        $('#startdate').addClass('is-invalid');
        toastr.warning('Start date is Required');
        error++;
    } else
        $('#startdate').removeClass('is-invalid');

    if ($('#enddate').val() == "") {
        $('#enddate').addClass('is-invalid');
        toastr.warning('End date is Required');
        error++;
    } else
        $('#enddate').removeClass('is-invalid');

    if ($('#clients_po_number').val() == "") {
        $('#clients_po_number').addClass('is-invalid');
        toastr.warning('End date is Required');
        error++;
    } else
        $('#clients_po_number').removeClass('is-invalid');

    if ($('#sovalue').val() == "") {
        $('#sovalue').addClass('is-invalid');
        toastr.warning('Sales Order Value is Required');
        error++;
    } else
        $('#sovalue').removeClass('is-invalid');

    if ($('#sodate').val() == "") {
        $('#sodate').addClass('is-invalid');
        toastr.warning('Sales Order Date is Required');
        error++;
    } else
        $('#sodate').removeClass('is-invalid');



    if (!error) {
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "sales-order-save",
            dataType: "json",
            data: $('#dataForm').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                if (data.status) {
                    $(this).addClass('kt-spinner');
                    $(this).prop("disabled", true);
                    toastr.success('Sales Order Created successfuly');
                    window.location.href = "sales-order-list";
                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else {
        toastr.warning('Fill Mandatory Fields');
    }
});

$(document).on('click', '.delprojects', function () {
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
                url: 'deleteprojects',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {
                    console.log(data);
                    if (data == 'true') {
                        swal.fire("Deleted!", "Your project has been deleted.", "success");
                        projects_list_table.ajax.reload();
                    }


                }
            });
        } else {
            swal.fire("Cancelled", "Your Entry is safe :)", "error");

        }
    })
});


$("#projects_list_print").on("click", function () {
    projects_list_table.button('.buttons-print').trigger();
});


$("#projects_list_copy").on("click", function () {
    projects_list_table.button('.buttons-copy').trigger();
});

$("#projects_list_csv").on("click", function () {
    projects_list_table.button('.buttons-csv').trigger();
});

$("#projects_list_pdf").on("click", function () {
    projects_list_table.button('.buttons-pdf').trigger();
});