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
    var error = 0;
    var procuctEnter = 0;
    var material_name = [];
    $("input[name^='material_name[]']").each(function (input) {
        material_name.push($(this).val());
        if (($(this).val() == '') || ($(this).val() == 0)) {
            $(this).addClass('is-invalid');
            error++;
        }
        else
            $(this).removeClass('is-invalid');
        procuctEnter++;
    });
    if (!procuctEnter) {
        error++;
        toastr.error('Add atleast an Item !!!');
    }
    var description = [];
    $("input[name^='description[]']").each(function (input) {
        description.push($(this).val());
    });
    var code = [];
    $("input[name^='code[]']").each(function (input) {
        code.push($(this).val());
    });
    var unit = [];
    $("input[name^='unit[]']").each(function (input) {
        unit.push($(this).val());
    });
    var category = [];
    $("input[name^='category[]']").each(function (input) {
        category.push($(this).val());
    });
    var group = [];
    $("input[name^='group[]']").each(function (input) {
        group.push($(this).val());
    });
    var amount = [];
    $("input[name^='amount[]']").each(function (input) {
        amount.push($(this).val());
    });
    var valid_till = [];
    $("input[name^='valid_till[]']").each(function (input) {
        valid_till.push($(this).val());
    });

    if (error == 0) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "material-directory-save",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                material_name: material_name,
                description: description,
                code: code,
                unit: unit,
                category: category,
                group: group,
                amount: amount,
                valid_till: valid_till
            },
            success: function (data) {
                $('#btnSave').removeClass('kt-spinner');
                $('#btnSave').prop("disabled", false);
                toastr.success('Details Saved Successfuly');
                window.location.href = "material-directory";
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('Fill mandatory Fileds !!!');
});


