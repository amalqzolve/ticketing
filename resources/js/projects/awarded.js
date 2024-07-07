$('.projects').addClass('kt-menu__item--open');
$('.projects-awarded-list').addClass('kt-menu__item--active');

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
        "url": 'projects-awarded-list',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'projectname', name: 'projectname' },
        { data: 'cust_name', name: 'cust_name' },
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
        $("td:nth-child(2)", nRow).html($("td:nth-child(2)", nRow).text());
    },

});;





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