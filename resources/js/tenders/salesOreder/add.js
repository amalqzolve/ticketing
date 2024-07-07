$('.salesProposal').addClass('kt-menu__item--open');
$('.sales-proposal-list').addClass('kt-menu__item--active');
$('.sales-proposal-list-project').addClass('kt-menu__item--active');
$(document).on('click', '#projectsubmit', function (e) {
    e.preventDefault();

    client = $('#client').val();
    projectname = $('#projectname').val();
    startdate = $('#startdate').val();
    enddate = $('#enddate').val();
    salesorder = $('#salesorder').val();
    bidvalue = $('#bidvalue').val();
    podate = $('#podate').val();
    ponumber = $('#clients_po_number').val();


    if (client == "") {
        $('#client').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Title is Required');
        return false;
    } else {
        $('#client').next().find('.select2-selection').removeClass('select-dropdown-error');
    }



    if (projectname == "") {
        $('#projectname').addClass('is-invalid');
        toastr.warning('Title is Required');
        return false;
    } else {
        $('#projectname').removeClass('is-invalid');
    }

    if (startdate == "") {
        $('#startdate').addClass('is-invalid');
        toastr.warning('Title is Required');
        return false;
    } else {
        $('#startdate').removeClass('is-invalid');
    }
    if (enddate == "") {
        $('#enddate').addClass('is-invalid');
        toastr.warning('Title is Required');
        return false;
    } else {
        $('#enddate').removeClass('is-invalid');
    }

    if ($('#poject_category_id').val() == "") {
        $('#poject_category_id').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('poject category is Required');
        return false;
    } else {
        $('#poject_category_id').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if (ponumber == "") {
        $('#clients_po_number').addClass('is-invalid');
        toastr.warning('ponumber is Required');
        return false;
    } else
        $('#clients_po_number').removeClass('is-invalid');

    if (bidvalue == "") {
        $('#bidvalue').addClass('is-invalid');
        toastr.warning('Title is Required');
        return false;
    } else {
        $('#bidvalue').removeClass('is-invalid');
    }
    if (podate == "") {
        $('#podate').addClass('is-invalid');
        toastr.warning('Title is Required');
        return false;
    } else {
        $('#podate').removeClass('is-invalid');
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
        url: "sales-order-save",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            sales_proposal_id: $('#sales_prop_id').val(),
            poject_category_id: $('poject_category_id').val(),
            client_id: $('#client').val(),
            projectname: $('#projectname').val(),
            description: $('#description').val(),
            startdate: $('#startdate').val(),
            enddate: $('#enddate').val(),
            ponumber: $('#clients_po_number').val(),
            bidvalue: $('#bidvalue').val(),
            podate: $('#podate').val(),
            labels: $('#labels').val(),
            internal_ref: $('#internal_ref').val(),
            notes: $('#notes').val(),
        },
        success: function (data) {
            if (data.status == 1) {
                $('#projectsubmit').removeClass('kt-spinner');
                $('#projectsubmit').prop("disabled", false);
                // projects_list_table.ajax.reload();
                window.location.href = "sales-order-list";
                toastr.success('Sales Order ' + sucess_msg + ' successfuly');
            }


        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
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