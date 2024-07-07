$('.list-boq').addClass('kt-menu__item--active');

$(document).ready(function () {
    $('.kt-selectpicker').select2();
});


var maindetails_list_table = $('#maindetails_list').DataTable({
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
        "url": 'list-boq',
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
            data: 'tender_id', name: 'tender_id', render: function (data, type, row) {
                if (row.type == 1)
                    return 'TNDR ' + row.tender_id;
                else
                    return '-';
            }
        },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return '# ' + row.id + '&nbsp;&nbsp;';
            }
        },
        {
            data: 'type', name: 'type',
            render: function (data, type, row) {
                if (row.type == 1)
                    return 'Tender';
                else if (row.type == 2)
                    return 'Project';
                else
                    return '-';
            }
        },
        {
            data: 'cust_name', name: 'cust_name', className: 'client',
            render: function (data, type, row) {
                var curData = row.cust_name;
                if (curData != null)
                    return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'projectname', name: 'projectname',
            render: function (data, type, row) {
                var curData = row.projectname;
                if (curData != null)
                    return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'category_name', name: 'category_name',
            render: function (data, type, row) {
                var curData = row.category_name;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'description', name: 'description',
            render: function (data, type, row) {
                var curData = row.description;
                if (curData != null)
                    return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'status', name: 'status',
            render: function (data, type, row) {
                if (row.status == null)
                    return '<span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-danger">BOQ Revision</span></span>'; //'BOQ Revision';
                else if (row.status == 1) {
                    if (row.estimation_status == 1)
                        return '<span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-brand">Estimation Completed</span></span>';//'Estimation Completed';
                    else
                        return '<span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">Waiting for Estimation</span></span>';//'Waiting for Estimation';
                }
                else if (row.status == 2)
                    return '<span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-brand">Estimation Completed</span></span>';//'Estimation Completed';
                else if (row.status == 3)
                    return '<span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Submited To Tender</span></span>';
            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {

                var j = '';
                if (row.status == null) {
                    j = '<a href="boq_main_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-edit"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                            </span></li>\
                          </a>\
                          <li class="kt-nav__item sendForEstimation" data-id="' + row.id + '">\
                               <span class="kt-nav__link">\
                                  <i class="kt-nav__link-icon flaticon2-paper-plane"></i>\
                                   <span class="kt-nav__link-text " data-id="' + row.id + '">Send For Estimation</span>\
                               </span>\
                            </li>';
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
                            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                        <i class="fa fa-cog"></i></a>\
                                        <div class="dropdown-menu dropdown-menu-right">\
                                        <ul class="kt-nav">'+ j + '\
                                       </ul></div></div></span>';
                } else if (row.status == 1) {
                    j = '<li class="kt-nav__item callBack" data-id="' + row.id + '">\
                               <span class="kt-nav__link">\
                                  <i class="kt-nav__link-icon flaticon2-refresh"></i>\
                                   <span class="kt-nav__link-text " data-id="' + row.id + '">Call Back For Modification</span>\
                               </span>\
                            </li>';
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
                            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                        <i class="fa fa-cog"></i></a>\
                                        <div class="dropdown-menu dropdown-menu-right">\
                                        <ul class="kt-nav">'+ j + '\
                                       </ul></div></div></span>';
                }
                else if (row.status == 2) {
                    j = '<li class="kt-nav__item callBack" data-id="' + row.id + '">\
                               <span class="kt-nav__link">\
                                  <i class="kt-nav__link-icon flaticon2-refresh"></i>\
                                   <span class="kt-nav__link-text " data-id="' + row.id + '">Call Back For Modification</span>\
                               </span>\
                            </li>';

                    return '<span style="overflow: visible; position: relative; width: 80px;">\
                            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                        <i class="fa fa-cog"></i></a>\
                                        <div class="dropdown-menu dropdown-menu-right">\
                                        <ul class="kt-nav">'+ j + '\
                                       </ul></div></div></span>';
                }
                else if (row.status == 3)
                    return '';


            }
        },
    ],
    columnDefs: [
        { width: '50px', "orderable": false, "searchable": false, targets: [0, 9] },
        { width: '20px', "searchable": false, targets: [8] },
        { width: '70px', targets: [1, 2, 3] },
        { width: '200px', targets: [4] },
        { width: '300px', targets: [5, 6] }
    ],
    fixedColumns: true,
});
// 
$('#maindetails_list').on('click', 'tbody td', function () {
    var index = $(this).closest("td").index();
    if ((index) && (index != 9)) {
        var data = maindetails_list_table.row(this).data();
        window.location.href = 'view-childen?id=' + data.id;
    }
});




$(document).on('change', '#boq_type', function (e) {
    if ($(this).val() == 1) {
        $('.projectDiv').hide();
        $('.tenderDiv').show();
        $('#projectname').val('');
        $('#tender').val('');
    }
    else {
        $('.projectDiv').show();
        $('.tenderDiv').hide();
        $('#projectname').val('');
        $('#tender').val('');
    }
});

$(document).on('click', '#boq_submit', function (e) {
    e.preventDefault();
    var error = 0;
    if ($('#boq_type').val() == "") {
        $('#boq_type').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#boq_type').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#boq_type').val() == 1) {
        if ($('#tender').val() == "") {
            $('#tender').next().find('.select2-selection').addClass('select-dropdown-error');
            error++;
        } else
            $('#tender').next().find('.select2-selection').removeClass('select-dropdown-error');
    } else {
        if ($('#projectname').val() == "") {
            $('#projectname').next().find('.select2-selection').addClass('select-dropdown-error');
            error++;
        } else
            $('#projectname').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if ($('#client').val() == "") {
        $('#client').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#client').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#name').val() == "") {
        $('#name').addClass('is-invalid');
        error++;
    } else
        $('#name').removeClass('is-invalid');

    if (error == 0) {
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        if ($('#id').val())
            var sucess_msg = 'Updated';
        else
            var sucess_msg = 'Created';
        $.ajax({
            type: "POST",
            url: "boqsubmit",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                info_id: $('#id').val(),
                name: $('#name').val(),
                description: $('#description').val(),
                projectname: $('#projectname').val(),
                client: $('#client').val(),
                type: $('#boq_type').val(),
                tender_id: $('#tender').val(),
                date: $('#date').val()
            },
            success: function (data) {
                $('#boq_submit').removeClass('kt-spinner');
                $('#boq_submit').prop("disabled", false);
                closeModel();
                toastr.success('New Root ' + sucess_msg + ' successfuly');
                location.reload();
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.warning("Please Fill mandatory Fields !!");

});

function closeModel() {
    $("#kt_modal_4_5").modal("hide");
    $('#boq_type').next().find('.select2-selection').removeClass('select-dropdown-error');
    $('#projectname').next().find('.select2-selection').removeClass('select-dropdown-error');
    $('#client').next().find('.select2-selection').removeClass('select-dropdown-error');
    $('#name').removeClass('is-invalid');
    $('#boq_type').val('');
    $('#projectname').val('');
    $('#client').val('');
    $('#name').val('');
    $('#description').val("");
}


$(document).on('click', '#boq_update', function (e) {
    e.preventDefault();

    name = $('#name1').val();
    amount = $('#amount1').val();
    description = $('#description1').val();
    projectname = $('#projectname1').val();

    if (name == "") {
        $('#name').addClass('is-invalid');
        return false;
    } else {
        $('#name').removeClass('is-invalid');
    }


    if (projectname == "") {
        $('#projectname').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning("Please Select Project!");
        return false;
    } else {
        $('#projectname').next().find('.select2-selection').removeClass('select-dropdown-error');
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
        url: "boq_update",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            name: $('#name1').val(),
            description: $('#description1').val(),
            projectname: $('#projectname1').val(),

            /*amount: $('#amount1').val(),*/

        },
        success: function (data) {
            $('#boq_update').removeClass('kt-spinner');
            $('#boq_update').prop("disabled", false);
            closeModel();
            toastr.success('New Root ' + sucess_msg + ' successfuly');
            location.reload();
        },
        error: function (jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});


$(document).on('click', '.sendForEstimation', function () {
    var id = $(this).attr('data-id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Send this BOQ for Estimation",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Send",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            // loaderShow();
            $.ajax({
                type: "POST",
                url: "boq-send",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success('BOQ Send for Estimation successfuly');
                        location.reload(true);
                    } else {
                        swal.fire({
                            title: "Error !!!",
                            text: data.msg,
                            type: "error",
                        });
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


$(document).on('click', '.callBack', function () {
    var id = $(this).attr('data-id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Send this Group for Estimation",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Call Back",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            // loaderShow();
            $.ajax({
                type: "POST",
                url: "boq-enable-edit",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success('Call Back BOQ successfuly');
                        // location.reload(true);
                    } else {
                        swal.fire({
                            title: "Error !!!",
                            text: data.msg,
                            type: "error",
                        });
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

$("#export-button-print").on("click", function () {
    maindetails_list_table.button('.buttons-print').trigger();
});
$("#export-button-copy").on("click", function () {
    maindetails_list_table.button('.buttons-copy').trigger();
});
$("#export-button-csv").on("click", function () {
    maindetails_list_table.button('.buttons-csv').trigger();
});
$("#export-button-pdf").on("click", function () {
    maindetails_list_table.button('.buttons-pdf').trigger();
});



