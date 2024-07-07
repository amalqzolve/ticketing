// 
$('.procurementSettings').addClass('kt-menu__item--open');
$('.userManagement').addClass('kt-menu__item--active');
var usersTbl = $('#usersTbl').DataTable({
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
            columns: [0, 1, 2, 3, 4, 5]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%'];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
        }
    }
    ],

    ajax: {
        "url": 'procurement-user-management',
        "type": "GET",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'name', name: 'name', render: function (data, type, row) {
                var curData = row.name;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'email', name: 'email', render: function (data, type, row) {
                var curData = row.email;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'branch', name: 'branch', render: function (data, type, row) {
                var curData = row.branch;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'department', name: 'department', render: function (data, type, row) {
                var curData = row.department;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'designation', name: 'designation', render: function (data, type, row) {
                var curData = row.designation;
                if (curData != null)
                    return curData.length > 30 ? curData.substr(0, 30) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '';

                j = '<a href="procurement-user-management/' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="procurement-user-management/' + row.id + '/edit" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
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




$(document).on('click', '#addRec', function () {
    if ($('#usersList').val() == '') {
        toastr.warning("Please Select A User for create synthesis User !");
        $('#usersList').next().find('.select2-selection').addClass('select-dropdown-error');
    } else {
        // alert($('#usersList').val());
        window.location.href = "procurement-user-management/" + $('#usersList').val() + "/edit";
    }
});

$("#export-button-print").on("click", function () {
    usersTbl.button('.buttons-print').trigger();
});
$("#export-button-copy").on("click", function () {
    usersTbl.button('.buttons-copy').trigger();
});

$("#export-button-csv").on("click", function () {
    usersTbl.button('.buttons-csv').trigger();
});

$("#export-button-pdf").on("click", function () {
    usersTbl.button('.buttons-pdf').trigger();
});



