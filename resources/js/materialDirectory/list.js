$('.material-directory').addClass('kt-menu__item--active');

var list = $('#list').DataTable({
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
        customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = ['35%', '35%', '25%'];
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
        "url": 'material-directory',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'id',
            name: 'id',
            render: function (data, type, row) {
                return 'RD ' + row.id + '&nbsp;&nbsp;';
            }
        },
        { data: 'material_name', name: 'material_name' },
        { data: 'description', name: 'description' },
        { data: 'code', name: 'code' },
        { data: 'unit', name: 'unit' },
        { data: 'category', name: 'category' },
        { data: 'group', name: 'group' },
        { data: 'amount', name: 'amount' },
        { data: 'valid_till', name: 'valid_till' },
        {
            data: 'name', name: 'name', render: function (data, type, row) {
                return row.name + '<br>' + row.updated_at;
            }
        },
        {
            data: 'action',
            name: 'action',
            render: function (data, type, row) {
                var j = '<a href="material-directory-edit-view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
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