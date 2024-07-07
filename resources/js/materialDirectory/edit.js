/**
 *Datatable for product details Information
 */
$('.material-directory').addClass('kt-menu__item--active');

$('#addNewItem').click(function () {
    addblankRow();
});


$("body").on("click", ".remove", function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');


    var siblings = row.siblings();
    row.remove();
    siblings.each(function (index) {
        $(this).children().first().text(index + 1);
    });
});

$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();
    $('#btnSave').addClass('kt-spinner');
    $('#btnSave').prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "material-directory-update",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            material_name: $('#material_name').val(),
            description: $('#description').val(),
            code: $('#code').val(),
            unit: $('#unit').val(),
            category: $('#category').val(),
            group: $('#group').val(),
            amount: $('#amount').val(),
            valid_till: $('#valid_till').val(),
        },
        success: function (data) {
            $('#btnSave').removeClass('kt-spinner');
            $('#btnSave').prop("disabled", false);
            toastr.success('Details Updated Successfuly');
            window.location.href = "material-directory";
        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });
});


