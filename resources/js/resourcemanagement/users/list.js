$('.rmusers').addClass('kt-menu__item--active');
/**
 *Datatable for product details Information
 */
//$.fn.dataTable.ext.errMode = 'none';

var product_list_table = $('#employeesTbl').DataTable({
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
                return type === 'display' && data.length > 40 ?
                    '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' :
                    data;
            }
        },

        {
            data: 'employeeid', name: 'employeeid', "render": function (data, type, row, meta) {
                if (data != null && data.length > 1) {
                    return type === 'display' && data.length > 40 ?
                        '<span title="' + data + '">' + data.substr(0, 38) + '...</span>' :
                        data;
                } else
                    return data;
            }
        },
        { data: 'category', name: 'category' },
        { data: 'name', name: 'name' },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';
                j = '<a data-type="approved" data-target="#kt_form"><li class="kt-nav__item epr_send" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-edit-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Edit</span>\
                        </span></li></a>\
                        <a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item epr_trash" id=' + row.id + ' >\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-delete"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delete</span>\
                        </span></li></a>';

                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+ j + '\
                       </ul></div></div></span>';
            }
        },
    ]
});





$(document).ready(function () {


    $('#productdetails_list tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');

        $('#selected_items').val(product_list_table.rows('.selected').data().length);

        var versement_each = 0;
        selectArr = new Array();
        var ids = $.map(product_list_table.rows('.selected').data(), function (item) {
            versement_each += parseFloat(item.unit_price) || 0;
            // alert(versement_each);
            //
            var idx = $.inArray(item.product_id, selectArr);
            if (idx == -1) {
                selectArr.push(item.product_id);
            } else {
                selectArr.splice(idx, item.product_id);
            }
            //



        });


        $('#selected_amount').val(versement_each.toFixed(2));
    });



});



$("#datatableadd").on("click", function () {
    $('#kt_modal_4_4').modal('hide');
    product_list_table.rows('.selected').nodes().to$().removeClass('selected');
    $('#selected_amount').val('');
    $('#selected_items').val('');
    createproductvialoop(selectArr);

});


/**
 *products details DataTable Export
 */

$("#productdetails_list_print").on("click", function () {

    product_list_table.button('.buttons-print').trigger();
});


$("#productdetails_list_copy").on("click", function () {
    product_list_table.button('.buttons-copy').trigger();
});

$("#productdetails_list_csv").on("click", function () {
    product_list_table.button('.buttons-csv').trigger();
});

$("#productdetails_list_pdf").on("click", function () {
    product_list_table.button('.buttons-pdf').trigger();
});

