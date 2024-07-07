$('.teams-list').addClass('kt-menu__item--active');


var employeesTbl = $('#employeesTbl').DataTable({
    processing: true,
    serverSide: false,
    bPaginate: false,
    dom: 'Blfrtip',
    ajax: {
        "url": 'rmusers',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'employee_name_field', name: 'employee_name_field', "render": function (data, type, row, meta) {
                if (data != null && data.length > 1)
                    return type === 'display' && data.length > 40 ? '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' : data;
                else
                    return data;
            }
        },
        {
            data: 'employeeid', name: 'employeeid', "render": function (data, type, row, meta) {
                if (data != null && data.length > 1)
                    return type === 'display' && data.length > 40 ? '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' : data;
                else
                    return data;
            }
        },
        { data: 'jobtitle', name: 'jobtitle' },
        { data: 'name', name: 'name' },
        { data: 'category', name: 'category' },

    ]
});


$(document).ready(function () {
    $('#employeesTbl tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');

        $('#selected_items').val(employeesTbl.rows('.selected').data().length);

        var versement_each = 0;
        selectArr = new Array();
        var ids = $.map(employeesTbl.rows('.selected').data(), function (item) {
            versement_each += parseFloat(item.unit_price) || 0;
            var idx = $.inArray(item.product_id, selectArr);
            if (idx == -1) {
                selectArr.push(item.product_id);
            } else {
                selectArr.splice(idx, item.product_id);
            }
        });
        $('#selected_amount').val(versement_each.toFixed(2));
    });



});



$("#newrow").on("click", function () {
    $('#kt_modal_4_4').modal('show');
    employeesTbl.rows('.selected').nodes().to$().removeClass('selected');
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

$("#datatableadd").on("click", function () {
    $('#kt_modal_4_4').modal('hide');
    var rowcount = $('#product_table tr').length;
    $.each(employeesTbl.rows('.selected').data(), function (key, item) {
        var error = 0;
        $('input[name^="employee_id[]"]').each(function () {
            if ($(this).val() == item.id)
                error++;
        });

        if (!error) {
            var product = '<tr>\
        <td style="text-align: center;">' + rowcount + '</td>\
        <td>\
        <div class="input-group input-group-sm">\
        <input type="hidden" class="form-control single-select employee_id" name="employee_id[]" id="employee_id" value="' + item.id + '" readonly>\
        ' + item.employee_name_field + '\
        <div>\
        </td>\
        <td>\
        <div class="input-group input-group-sm">\
        ' + item.employeeid + '\
        <div>\
        </td>\
        <td>\
        <div class="input-group input-group-sm">\
        ' + item.jobtitle + '\
        <div>\
        </td>\
        <td>\
        <div class="input-group input-group-sm">\
        ' + item.name + '\
        <div>\
        </td>\
        <td>\
        <div class="input-group input-group-sm">\
        ' + item.category + '\
        <div>\
        </td>\
        <td  style="background-color: white;">\
             <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">\
                                 <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
                                 <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>\
                              </div>\
               </td>\
        </tr>';
            $('#product_table').append(product);
            rowcount++;
        } else
            toastr.warning(item.employee_name_field + ' already Added');
    });
    employeesTbl.rows('.selected').nodes().to$().removeClass('selected');
});




$(document).on('click', '#btnSave', function (e) {
    console.log('sdsfs' + $('#data-form-team').serialize());
    e.preventDefault();
    console.log($('#product_table tr').length);
    var error = 0;
    if ($('#name').val() == '') {
        error++;
        $('#name').addClass('is-invalid');
    } else
        $('#name').removeClass('is-invalid');
    if ($('#product_table tr').length < 2) {
        error++;
        toastr.warning('Must Have a member in a Team !!!');
    }
    if (error == 0) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);

        $.ajax({
            type: "POST",
            url: "team-save",
            dataType: "json",
            data: $('#data-form-team').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#btnSave').removeClass('kt-spinner');
                    $('#btnSave').prop("disabled", false);
                    toastr.success('Team Created successfuly');
                    window.location.href = "teams-list";
                } else {
                    toastr.error(data.msg);
                    $('#btnSave').removeClass('kt-spinner');
                    $('#btnSave').prop("disabled", false);
                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('Fill mandatory Fileds !!!');
});

