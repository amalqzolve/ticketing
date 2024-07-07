/**
 *Datatable for product details Information
 */
//$.fn.dataTable.ext.errMode = 'none';
$('.eprList').addClass('kt-menu__item--open');
$('.eprList1').addClass('kt-menu__item--active');
$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});
$(document.body).on("change", "#request_type", function () {
    if ($(this).val() == 4) {
        $('#client').prop("disabled", false);
        $('#project').prop("disabled", false);
    } else {
        $('#client').val('').trigger('change');
        $('#project').val('').trigger('change');
        $('#client').prop("disabled", true);
        $('#project').prop("disabled", true);
    }
});


$('#addNewItem').click(function () {
    var reqType = $('#request_against').val();
    if (reqType != '')
        $('#request_against').next().find('.select2-selection').removeClass('select-dropdown-error');
    if (reqType == 3)
        $('#kt_modal_4_4').modal('show');
    else if (reqType == 2) {
        addblankRow();
    }
    else if (reqType == 1) {
        if ($('#project').val() != '') {
            var projectName = $("#project option:selected").text();
            $('#project_name').html(projectName);
            $('#kt_modal_4_5').modal('show');
            $('#project').next().find('.select2-selection').removeClass('select-dropdown-error');
        } else {
            toastr.warning("Please Select The project!");
            $('#project').next().find('.select2-selection').addClass('select-dropdown-error');
        }
    }
    else {
        toastr.warning("Please Select Request against!");
        $('#request_against').next().find('.select2-selection').addClass('select-dropdown-error');
        return false;
    }
});


$(document.body).on("change", "#request_against", function () {
    $("#product_table > tbody").empty();
});
$('#materialDirectory').click(function () {
    $('#kt_modal_4_6').modal('show');
});

$(document.body).on("change", "#terms", function () {
    var cid = $(this).val();

    $.ajax({
        url: "get-terms-from-id",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
            //  console.log(data);
            var termcondition = '';
            $.each(data, function (key, value) {

                termcondition = value.description;
            });

            $('#kt-tinymce-4').val(termcondition);
            tinymce.activeEditor.setContent(termcondition);
            console.log(termcondition);

        }
    })
});

$(document).on('change', '.quantity', function () {
    if ($('#request_against').val() == 1) {
        var id = $(this).attr('data-id');
        var totalquantity = $('#totalquantity' + id + '').val();
        var reqQty = $('#reqQty' + id + '').val();
        var quantity = $('#quantity' + id + '').val();

        var balance = parseInt(totalquantity) - (parseInt(reqQty) + parseInt(quantity));
        if (balance < 0) {
            $(this).addClass('is-invalid');
            $(this).val('');
            toastr.error('Please Enter a Valid Quantity !!!!');
        } else {
            $('#balanceQty' + id + '').val(balance);
            $(this).removeClass('is-invalid');
        }
    }
});

function checkQty() {
    var id;
    var error = 0;
    var totalquantity
    var reqQty
    var quantity
    var balance
    $("input[name^='quantity[]']")
        .each(function (input) {
            id = $(this).attr('data-id');
            totalquantity = $('#totalquantity' + id + '').val();
            reqQty = $('#reqQty' + id + '').val();
            quantity = $('#quantity' + id + '').val();
            balance = parseInt(totalquantity) - (parseInt(reqQty) + parseInt(quantity));
            if (balance < 0) {
                $(this).addClass('is-invalid');
                error++;
            } else
                $(this).removeClass('is-invalid');
        });
    return error;
}


$("body").on("click", ".remove", function (event) {
    event.preventDefault();

    var id = $(this).attr('data-id');
    var product_id = $('#product_id' + id).val();
    var deleted = $('#deleted_elements').val();
    if (deleted != '')
        deleted = deleted + '~' + product_id;
    else
        deleted = product_id;
    $('#deleted_elements').val(deleted);

    var row = $(this).closest('tr');
    var siblings = row.siblings();
    row.remove();
    siblings.each(function (index) {
        $(this).children().first().text(index + 1);
    });
});

$(document).on('click', '#epr_update', function (e) {
    e.preventDefault();
    var error = 0;
    var procuctEnter = 0;
    var productname = [];
    $("input[name^='productname[]']")
        .each(function (input) {
            productname.push($(this).val());
            procuctEnter++;
        });
    if (!procuctEnter) {
        error++;
        toastr.error('Add atleast an Item !!!');
    }
    var product_description = [];

    $("textarea[name^='product_description[]']")
        .each(function (input) {
            product_description.push($(this).val());
        });

    var unit = [];

    $("select[name^='unit[]']")
        .each(function (input) {
            unit.push($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('is-invalid');
                error++;
            }
            else
                $(this).removeClass('is-invalid');
        });

    if ($('#quotedate').val() == '') {
        error++;
        $('#quotedate').addClass('is-invalid');
    } else
        $('#quotedate').removeClass('is-invalid');


    if ($('#dateofsupply').val() == '') {
        error++;
        $('#dateofsupply').addClass('is-invalid');
    } else
        $('#dateofsupply').removeClass('is-invalid');

    if ($('#request_type').val() == '') {
        error++;
        $('#request_type').next().find('.select2-selection').addClass('select-dropdown-error');
    }
    else {
        $('#request_type').next().find('.select2-selection').removeClass('select-dropdown-error');
        if ($('#request_type').val() == 4) {

            if ($('#client').val() == '') {
                error++;
                $('#client').next().find('.select2-selection').addClass('select-dropdown-error');
            } else
                $('#client').next().find('.select2-selection').removeClass('select-dropdown-error');

            if ($('#project').val() == '') {
                error++;
                $('#project').next().find('.select2-selection').addClass('select-dropdown-error');
            } else
                $('#project').next().find('.select2-selection').removeClass('select-dropdown-error');
        } else {
            $('#client').next().find('.select2-selection').removeClass('select-dropdown-error');
            $('#project').next().find('.select2-selection').removeClass('select-dropdown-error');
            $('#project').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
    }
    if ($('#mr_category').val() == '') {
        error++;
        $('#mr_category').next().find('.select2-selection').addClass('select-dropdown-error');
    }
    else
        $('#mr_category').next().find('.select2-selection').removeClass('select-dropdown-error');
    if ($('#request_against').val() == '') {
        error++;
        $('#request_against').next().find('.select2-selection').addClass('select-dropdown-error');
    }
    else
        $('#request_against').next().find('.select2-selection').removeClass('select-dropdown-error');

    var product_id = [];
    $("input[name^='product_id[]']").each(function (input) {
        product_id.push($(this).val());
    });

    var totalquantity = [];
    $("input[name^='totalquantity[]']").each(function (input) {
        totalquantity.push($(this).val());
    });
    var reqQty = [];
    $("input[name^='reqQty[]']").each(function (input) {
        reqQty.push($(this).val());
    });
    var quantity = [];
    $("input[name^='quantity[]']").each(function (input) {
        quantity.push($(this).val());

    });
    var balanceQty = [];
    $("input[name^='balanceQty[]']").each(function (input) {
        balanceQty.push($(this).val());
    });
    if ($('#request_against').val() == 1) {
        var qutyChk = checkQty();
        error = error + qutyChk;
    }


    var id = $('#materialRequestid').val();
    if (error == 0) {
        $('#epr_submit').addClass('kt-spinner');
        $('#epr_submit').prop("disabled", true);
        loaderShow();
        $.ajax({
            type: "POST",
            url: "material-request-update",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: id,
                productname: productname,
                product_description: product_description,
                unit: unit,
                product_id: product_id,
                totalquantity: totalquantity,
                reqQty: reqQty,
                quantity: quantity,
                balanceQty: balanceQty,
                deleted_elements: $('#deleted_elements').val(),
                quotedate: $('#quotedate').val(),
                dateofsupply: $('#dateofsupply').val(),
                request_type: $('#request_type').val(),
                mr_category: $('#mr_category').val(),
                request_priority: $('#request_priority').val(),
                request_against: $('#request_against').val(),
                client: $('#client').val(),
                project: $('#project').val(),
                internalreference: $('#internalreference').val(),
                notes: $('#notes').val(),
                terms: $('#terms').val(),
            },
            success: function (data) {
                loaderClose();
                if (data.status = 1) {
                    $('#epr_submit').removeClass('kt-spinner');
                    $('#epr_submit').prop("disabled", false);
                    toastr.success('EPR Updated successfuly');
                    window.location.href = "material-request";

                } else {
                    toastr.warning(data.msg);
                }

            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('Fill mandatory Fileds !!!');
});

var product_list_table = $('#productdetails_list').DataTable({
    processing: true,
    serverSide: false,
    bPaginate: false,
    dom: 'Blfrtip',
    columnDefs: [
        {
            "defaultContent": "-",
            "targets": "_all"
        }
        , {
            "targets": [7],
            "visible": false
        }],
    ajax: {
        "url": 'product-purchase-listing',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
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
        { data: 'available_stock', name: 'available_stock' },
        { data: 'warehouse', name: 'warehouse' },
        { data: 'store', name: 'store' },
        { data: 'category_name', name: 'category_name' },
    ]
});

$(document).ready(function () {
    $('#terms').trigger('change');
    $('#productdetails_list tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');

        $('#selected_items').val(product_list_table.rows('.selected').data().length);

        var versement_each = 0;
        selectArr = new Array();
        var ids = $.map(product_list_table.rows('.selected').data(), function (item) {
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



$("#datatableadd").on("click", function () {
    $('#kt_modal_4_4').modal('hide');
    product_list_table.rows('.selected').nodes().to$().removeClass('selected');
    $('#selected_amount').val('');
    $('#selected_items').val('');
    createproductvialoop(selectArr);

});



var boqProductdetails_list = $('#boqProductdetails_list').DataTable({
    processing: true,
    serverSide: false,
    bPaginate: false,
    bdestroy: true,
    dom: 'Blfrtip',
    columnDefs: [
        {
            "defaultContent": "-",
            "targets": "_all"
        }
        // , {
        //     "targets": [5],
        //     "visible": false
        // }
    ],
    ajax: {
        "url": 'product-boq-listing',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val(),
                data.projectId = $('#project').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'ref', name: 'ref' },
        { data: 'category_name', name: 'category_name' },
        { data: 'description', name: 'description' },
        { data: 'unit', name: 'unit' },
        { data: 'quantity', name: 'quantity' },
        { data: 'epr_requested_quantity', name: 'epr_requested_quantity' },
        {
            data: 'quantity', name: 'quantity', "render": function (data, type, row, meta) {
                return row.quantity - row.epr_requested_quantity;
            }
        },
    ]
});



$(document).ready(function () {
    $('#boqProductdetails_list tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');

        $('#selected_items').val(boqProductdetails_list.rows('.selected').data().length);

        var versement_each = 0;
        selectArrBoq = new Array();
        var ids = $.map(boqProductdetails_list.rows('.selected').data(), function (item) {
            // versement_each += parseFloat(item.unit_price) || 0;
            var idx = $.inArray(item.id, selectArrBoq);
            if (idx == -1) {
                selectArrBoq.push(item.id);
            } else {
                selectArrBoq.splice(idx, item.id);
            }
        });
        // $('#selected_amount').val(versement_each.toFixed(2));
    });
});



$("#datatableaddBoq").on("click", function () {
    $('#kt_modal_4_5').modal('hide');
    boqProductdetails_list.rows('.selected').nodes().to$().removeClass('selected');
    $('#selected_amount').val('');
    $('#selected_items').val('');
    createproductvialoop(selectArrBoq);
});


var materialDirectoryListTbl = $('#materialDirectoryListTbl').DataTable({
    processing: true,
    serverSide: false,
    bPaginate: false,
    dom: 'Blfrtip',
    columnDefs: [
        {
            "defaultContent": "-",
            "targets": "_all"
        }
        , {
            "targets": [5],
            "visible": false
        }],
    ajax: {
        "url": 'material-directory-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'material_name', name: 'material_name' },
        { data: 'description', name: 'description' },
        { data: 'code', name: 'code' },
        { data: 'unit', name: 'unit' },
        { data: 'category', name: 'category' },
        { data: 'group', name: 'group' },
        { data: 'amount', name: 'amount' }

    ]
});

$(document).ready(function () {
    $('#materialDirectoryListTbl tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
        $('#selected_items').val(materialDirectoryListTbl.rows('.selected').data().length);
        var versement_each = 0;
        selectArrmaterialDirectory = new Array();
        var ids = $.map(materialDirectoryListTbl.rows('.selected').data(), function (item) {
            var idx = $.inArray(item.id, selectArrmaterialDirectory);
            if (idx == -1) {
                selectArrmaterialDirectory.push(item.id);
            } else {
                selectArrmaterialDirectory.splice(idx, item.id);
            }
        });
    });
});

$("#datatableaddMaterialDirectory").on("click", function () {
    $('#kt_modal_4_6').modal('hide');
    materialDirectoryListTbl.rows('.selected').nodes().to$().removeClass('selected');
    $('#selected_amount').val('');
    $('#selected_items').val('');
    createproductvialoop(selectArrmaterialDirectory);
});

$(document).on('change', '#client', function () {
    var id = $(this).val();
    $.ajax({
        type: "POST",
        url: "load-project-from-client",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: id,
        },
        success: function (data) {
            $('#project').empty().trigger("change");
            var newOption = new Option('--select--', '', false, false);
            if (data.status == 1) {
                $('#project').append(newOption).trigger('change');
                $.each(data.data, function (i, val) {
                    var newOption = new Option(val.projectname, val.id, false, false);
                    $('#project').append(newOption).trigger('change');
                });
            } else
                console.log('Error !!');

        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });
});

$(document).on('change', '#project', function () {
    var value = $(this).val();
    if ((value != '') && (value != null))
        boqProductdetails_list.ajax.reload();
});



// file upload

const uppyProject = Uppy.Core({
    autoProceed: true,
    allowMultipleUploads: true,
    restrictions: {
        /* maxNumberOfFiles: 1,
           minNumberOfFiles: 1,*/
        // allowedFileTypes: ["image/*"]
    },
    meta: {
        epr_id: $('#materialRequestid').val(),
    },
    onBeforeUpload: (files) => {
        fileData = [];
        const updatedFiles = {};
        Object.keys(files).forEach(fileID => {
            fileData.push('custdocumentInfoData/' + files[fileID].name)
        })
        //return updatedFiles
        $('#projectfileData').val(fileData);

    },

})

uppyProject.use(Uppy.Dashboard, {
    metaFields: [
        { id: 'name', name: 'Name', placeholder: 'File name' },
        { id: 'description', name: 'description', placeholder: 'Describe what the image is about.' }
    ],
    browserBackButtonClose: true,
    target: '#choose-project-files',
    inline: true,
    replaceTargetContent: true,
    width: '100%'
})
uppyProject.use(Uppy.Webcam, { target: Uppy.Dashboard })
uppyProject.use(Uppy.XHRUpload, {
    endpoint: 'epr-attachments-upload',
    fieldName: 'filenames[]',
    headers: {
        'X-CSRF-TOKEN': $('#token').val(),
        UniqueID: $('#UniqueID').val(),
    }
})



function onuppyImageClicked(img) {

    var str = img.toString();
    var n = str.lastIndexOf('/');
    var img_name = str.substring(n + 1);
    // assuming the image lives on a server somewhere
    return fetch(img)
        .then((response) => response.blob()) // returns a Blob
        .then((blob) => {
            Uppy.addFile({
                name: img_name,
                type: 'image/jpg',
                data: blob
            })
        })
}


//



var filesTbl = $('#filesTbl').DataTable({
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
        "url": 'epr-attachments/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.epr_id = $('#materialRequestid').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'file', name: 'file', render: function (data, type, row) {
                var curData = row.file;
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
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'name', name: 'name', render: function (data, type, row) {
                var curData = row.name;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'uploded_date', name: 'uploded_date' },
        { data: 'action', name: 'action' },

    ],
    // "fnRowCallback": function (nRow, aData, iDisplayIndex) {
    //     $("td:nth-child(5)", nRow).html($("td:nth-child(5)", nRow).text());
    // },
});


$(document).on('click', '.delete', function () {
    var noteId = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want trash this Attachment",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Trash",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: "epr-attachments-delete",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: noteId
                },
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success('Attachment Trashed successfuly');
                        filesTbl.ajax.reload();
                    } else
                        toastr.error(data.msg);

                },
                error: function (jqXhr, json, errorThrown) {
                    console.log('Error !!');
                }
            });

        } else
            swal.fire("Cancelled", "", "error");
    })
});
// ./ file upload

