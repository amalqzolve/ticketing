$('.projects').addClass('kt-menu__item--open');
$('.project-approve-list').addClass('kt-menu__item--active');

var pendingTbl = $('#pendingTbl').DataTable({
    processing: true,
    serverSide: true,

    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 20, 50, -1],
        [10, 20, 50, "All"]
    ],
    "pageLength": 20,
    buttons: [{
        extend: 'copy',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    }
    ],

    ajax: {
        "url": 'project-approve-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'cust_name', name: 'cust_name',
            render: function (data, type, row) {
                var curData = row.cust_name;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'projectname', name: 'projectname',
            render: function (data, type, row) {
                var curData = row.projectname;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'startdate', name: 'startdate' },
        { data: 'enddate', name: 'enddate' },
        { data: 'ponumber', name: 'ponumber' },
        { data: 'povalue', name: 'povalue' },
        { data: 'podate', name: 'podate' },
        { data: 'action', name: 'action' },
    ]
});


var approvedTbl = $('#approvedTbl').DataTable({
    processing: true,
    serverSide: true,
    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 20, 50, -1],
        [10, 20, 50, "All"]
    ],
    "pageLength": 20,
    buttons: [{
        extend: 'copy',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%', '5%', '5%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        }
    }
    ],

    ajax: {
        "url": 'project-list-approved-approval',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'cust_name', name: 'cust_name',
            render: function (data, type, row) {
                var curData = row.cust_name;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'projectname', name: 'projectname',
            render: function (data, type, row) {
                var curData = row.projectname;
                if (curData != null)
                    return curData.length > 40 ? curData.substr(0, 40) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'startdate', name: 'startdate' },
        { data: 'enddate', name: 'enddate' },
        { data: 'ponumber', name: 'ponumber' },
        { data: 'povalue', name: 'povalue' },
        { data: 'podate', name: 'podate' },
        {
            data: 'heyrarchy', name: 'heyrarchy',
            render: function (data, type, row) {
                if (row.heyrarchy == 2)
                    return '<span style="color: green">Approved</span>';
                if (row.heyrarchy == 3)
                    return '<span style="color: orange">Returned</span>';
                if (row.heyrarchy == 4)
                    return '<span style="color: red">Rejected</span>';
                if (row.heyrarchy == 5)
                    return '<span style="color: blue">Resubmited</span>';
            }
        },
        { data: 'action', name: 'action' },
    ]
});




$(document).on('click', '.approveBtn', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Approve this Project",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Approve",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            // // loaderShow();
            swal.fire({
                title: 'Submit your Comments',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                confirmButtonText: 'Approve',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    if (login == '') {
                        swal.showValidationMessage(
                            `Enter A Comment First: `
                        )
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "project-approve",
                            dataType: "text",
                            data: {
                                _token: $('#token').val(),
                                id: id,
                                comment: login
                            },
                            success: function (data) {
                                if (data == 1) {
                                    // loaderClose();
                                    toastr.success('Project Approved successfuly');
                                    window.location.href = "project-approve-list";
                                }

                            },
                            error: function (jqXhr, json, errorThrown) {
                                console.log('Error !!');
                            }
                        });
                    }

                },
            })


        } else {
            swal.fire("Cancelled", "", "error");
        }
    })


    // swal.fire({
    //     title: 'Submit your Github username',
    //     input: 'text',
    //     inputAttributes: {
    //         autocapitalize: 'off'
    //     },
    //     showCancelButton: true,
    //     confirmButtonText: 'Look up',
    //     showLoaderOnConfirm: true,
    //     preConfirm: (login) => {
    //         // return fetch(`//api.github.com/users/${login}`)
    //         //     .then(response => {
    //         //         if (!response.ok) {
    //         //             throw new Error(response.statusText)
    //         //         }
    //         //         return response.json()
    //         //     })
    //         //     .catch(error => {
    //         //         Swal.showValidationMessage(
    //         //             `Request failed: ${error}`
    //         //         )
    //         //     })
    //     },
    //     allowOutsideClick: () => !Swal.isLoading()
    // }).then((result) => {
    //     if (result.isConfirmed) {
    //         Swal.fire({
    //             title: `${result.value.login}'s avatar`,
    //             imageUrl: result.value.avatar_url
    //         })
    //     }
    // })




});



$(document).on('click', '.rejectBtn', function () {
    var id = $(this).attr('id');

    swal.fire({
        title: "Are you sure?",
        text: "Do you want Reject this Project",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Reject",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {
            // // loaderShow();
            swal.fire({
                title: 'Submit your Comments',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                confirmButtonText: 'Reject',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    if (login == '') {
                        swal.showValidationMessage(
                            `Enter A Comment First: `
                        )
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "project-reject",
                            dataType: "text",
                            data: {
                                _token: $('#token').val(),
                                id: id,
                                comment: login
                            },
                            success: function (data) {
                                if (data == 1) {
                                    // loaderClose();
                                    toastr.success('Project Rejected successfuly');
                                    window.location.href = "project-approve-list";
                                }

                            },
                            error: function (jqXhr, json, errorThrown) {
                                console.log('Error !!');
                            }
                        });
                    }

                },
            })


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

$('.kt-wizard-v3__nav-item').click(function () {
    var id = $(this).attr('id');
    $('#tblNames').val(id);
});


$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-print').trigger();
    else if (tbl == 2)
        approvedTbl.button('.buttons-print').trigger();


});

$("#export-button-print").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-print').trigger();
    else if (tbl == 2)
        approvedTbl.button('.buttons-print').trigger();

});


$("#export-button-copy").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-copy').trigger();
    else if (tbl == 2)
        approvedTbl.button('.buttons-copy').trigger();

});

$("#export-button-csv").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-csv').trigger();
    else if (tbl == 2)
        approvedTbl.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    var tbl = $('#tblNames').val();
    if (tbl == 1)
        pendingTbl.button('.buttons-pdf').trigger();
    else if (tbl == 2)
        approvedTbl.button('.buttons-pdf').trigger();

});






