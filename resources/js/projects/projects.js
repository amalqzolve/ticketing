$('.projects').addClass('kt-menu__item--open');
$('.projectlist').addClass('kt-menu__item--active');

var projects_list = $('#projects_list').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    }
    ],

    ajax: {
        "url": 'projectlist',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'cust_name', name: 'cust_name' },
        { data: 'projectname', name: 'projectname' },
        { data: 'startdate', name: 'startdate' },
        { data: 'enddate', name: 'enddate' },
        { data: 'ponumber', name: 'ponumber' },
        { data: 'povalue', name: 'povalue' },
        { data: 'podate', name: 'podate' },
        { data: 'action', name: 'action' },

    ]
});

var projects_list_send = $('#projects_list_send').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    }
    ],

    ajax: {
        "url": 'project-list-send',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'cust_name', name: 'cust_name' },
        { data: 'projectname', name: 'projectname' },
        { data: 'startdate', name: 'startdate' },
        { data: 'enddate', name: 'enddate' },
        { data: 'ponumber', name: 'ponumber' },
        { data: 'povalue', name: 'povalue' },
        { data: 'podate', name: 'podate' },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                       <div class="dropdown">\
                       <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="project-pdf?id=' + row.id + '" data-type="edit"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone</span>\
                        </span></li></a>\
                       </ul></div>\
                       </div></span>';
            }
        },

    ]
});;
var projects_list_approved = $('#projects_list_approved').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    }
    ],

    ajax: {
        "url": 'project-list-approved',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'cust_name', name: 'cust_name' },
        { data: 'projectname', name: 'projectname' },
        { data: 'startdate', name: 'startdate' },
        { data: 'enddate', name: 'enddate' },
        { data: 'ponumber', name: 'ponumber' },
        { data: 'povalue', name: 'povalue' },
        { data: 'podate', name: 'podate' },


        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                <div class="dropdown">\
                <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                 <i class="fa fa-cog"></i></a>\
                 <div class="dropdown-menu dropdown-menu-right">\
                 <ul class="kt-nav">\
                 <a href="project-pdf?id=' + row.id + '" data-type="edit"><li class="kt-nav__item">\
                 <span class="kt-nav__link">\
                 <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                 <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                 </span></li></a>\
                 <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                 <span class="kt-nav__link">\
                 <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                 <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone</span>\
                 </span></li></a>\
                </ul></div>\
                </div></span>';
            }
        },

    ],
    "fnRowCallback": function (nRow, aData, iDisplayIndex) {
        $("td:nth-child(3)", nRow).html($("td:nth-child(3)", nRow).text());
    },

});;
var projects_list_rejected = $('#projects_list_rejected').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
        }
    }
    ],

    ajax: {
        "url": 'project-list-rejected',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'cust_name', name: 'cust_name' },
        { data: 'projectname', name: 'projectname' },
        { data: 'startdate', name: 'startdate' },
        { data: 'enddate', name: 'enddate' },
        { data: 'ponumber', name: 'ponumber' },
        { data: 'povalue', name: 'povalue' },
        { data: 'podate', name: 'podate' },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                <div class="dropdown">\
                <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                 <i class="fa fa-cog"></i></a>\
                 <div class="dropdown-menu dropdown-menu-right">\
                 <ul class="kt-nav">\
                 <a href="project-pdf?id=' + row.id + '" data-type="edit"><li class="kt-nav__item">\
                 <span class="kt-nav__link">\
                 <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                 <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                 </span></li></a>\
                 <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item viewSynHistory" id=' + row.id + '>\
                 <span class="kt-nav__link">\
                 <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                 <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Synthesis Milestone</span>\
                 </span></li></a>\
                </ul></div>\
                </div></span>';
            }
        },

    ]
});



$(document).on('click', '.sendBtn', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Send this Project for Approval",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Send",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            loaderShow();
            $.ajax({
                type: "POST",
                url: "project-send",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success('Project Send for Approval successfuly');
                        loaderClose();
                        window.location.href = "projectlist";
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


$(document).on('click', '.viewSynHistory', function () {
    var id = $(this).attr('id');
    $('.statusDiv').html('');
    $.ajax({
        type: "POST",
        url: "get-project-approval-history",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: id,
        },
        success: function (data) {
            if (data.status == 1) {

                var timeLine = '<ul class="timeline" id="timeline">';
                $.each(data.data, function (key, val) {
                    var status = '';
                    var curClass = '';
                    var timeOfAction = "";
                    if (val.status == 0) {
                        status = 'waiting ';
                        curClass = '';
                        timeOfAction = '----';
                    }
                    else if (val.status == 1) {
                        status = 'Pending ';
                        curClass = '';
                        timeOfAction = '&nbsp;&nbsp;';

                    }
                    else if (val.status == 2) {
                        status = 'Approved ';
                        curClass = 'complete';//
                        timeOfAction = val.status_changed;
                    }
                    else if (val.status == 3) {
                        status = 'Returned ';
                        curClass = 'returned';
                        timeOfAction = val.status_changed;
                    }
                    else if (val.status == 4) {
                        status = 'Rejected ';
                        curClass = 'rejected';
                        timeOfAction = val.status_changed;
                    }

                    timeLine = timeLine + '<li class="li ' + curClass + '">\
                                        <div class="timestamp text-center">\
                                            <span class="author">'+ val.name + '</span>\
                                            <span class="date">'+ timeOfAction + '<span>\
                                        </div>\
                                        <div class="status pt-4 mb-3">\
                                            <h4> '+ status + ' </h4>\
                                        </div>\
                                        </li>';
                });
                timeLine = timeLine + '</ul>';
                $('.statusDiv').html(timeLine);

                $('#modelProgress').modal('toggle');
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


});




$(document).on('click', '#projectsubmit', function (e) {
    e.preventDefault();

    var client = $('#client').val();
    var projectname = $('#projectname').val();
    var startdate = $('#startdate').val();
    var enddate = $('#enddate').val();
    var poject_category_id = $('#poject_category_id').val();
    var salesorder = $('#salesorder').val();
    var bidvalue = $('#bidvalue').val();
    var podate = $('#podate').val();




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

    if (poject_category_id == "") {
        $('#poject_category_id').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Poject Category is Required');
        return false;
    } else {
        $('#poject_category_id').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if (ponumber == "") {
        $('#ponumber').addClass('is-invalid');
        toastr.warning('Po number is Required');
        return false;
    } else {
        $('#ponumber').removeClass('is-invalid');
    }

    if (bidvalue == "") {
        $('#bidvalue').addClass('is-invalid');
        toastr.warning('Bid value is Required');
        return false;
    } else {
        $('#bidvalue').removeClass('is-invalid');
    }
    if (podate == "") {
        $('#podate').addClass('is-invalid');
        toastr.warning('PO date is Required');
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
        url: "projectsubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            client: $('#client').val(),
            projectname: $('#projectname').val(),
            description: $('#description').val(),
            startdate: $('#startdate').val(),
            enddate: $('#enddate').val(),
            poject_category_id: $('#poject_category_id').val(),
            ponumber: $('#ponumber').val(),
            bidvalue: $('#bidvalue').val(),
            podate: $('#podate').val(),
            labels: $('#labels').val(),
            internal_ref: $('#internal_ref').val(),
            notes: $('#notes').val(),
        },
        success: function (data) {


            $('#projectsubmit').removeClass('kt-spinner');
            $('#projectsubmit').prop("disabled", false);
            projects_list.ajax.reload();
            window.location.href = "projectlist";
            toastr.success('Project ' + sucess_msg + ' successfuly');


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
                        projects_list.ajax.reload();
                    }


                }
            });
        } else {
            swal.fire("Cancelled", "Your Entry is safe :)", "error");

        }
    })
});





$("#projects_list_print").on("click", function () {
    projects_list.button('.buttons-print').trigger();
});
$("#projects_list_copy").on("click", function () {
    projects_list.button('.buttons-copy').trigger();
});
$("#projects_list_csv").on("click", function () {
    projects_list.button('.buttons-csv').trigger();
});
$("#projects_list_pdf").on("click", function () {
    projects_list.button('.buttons-pdf').trigger();
});