var open_tbl = $('#ticket_opentbl').DataTable({
    processing: true,
    serverSide: true,
    pagingType: "full_numbers",
    // scrollX: true,
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],
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
            doc.content[1].table.widths = ['5%', '20%', '15%', '15%', '10%', '20%', '5%', '10%'];
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
    ajax: {
        "url": 'open_or_close',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { 
            data: 'ticketID', name: 'ticketID', 
            render: function (data, type, row) {
                return '<a href="view_ticket?id=' + row.id + '" class="kt-nav__link">'+row.ticketID+'</a>';
            }
        },
        { data: 'ticket_date', name: 'ticket_date' },
        { data: 'cust_name', name: 'cust_name' },
        { data: 'ticket_title', name: 'ticket_title' },
        { data: 'due_date', name: 'due_date' },
        { data: 'expirydays', name: 'expirydays' },
        { data: 'assignd_user', name: 'assignd_user' },
        { data: 'ticket_status', name: 'ticket_status' },
        {
            data: 'action', name: 'action',
            orderable: false, searchable: false,
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                            <i class="fa fa-cog"></i></a>\
                            <div class="dropdown-menu dropdown-menu-right">\
                            <ul class="kt-nav">\
                              <li class="kt-nav__item view_ticketdetails" data-id=' + row.id + ' >\
                              <span class="kt-nav__link">\
                              <i class="kt-nav__link-icon flaticon-eye"></i>\
                              <span class="kt-nav__link-text">View Ticket Details</span>\
                              </span></li>\
                           </ul></div></div></span>';
            }
        },

    ]
});


var closed_tbl = $('#ticket_closedtbl').DataTable({
    processing: true,
    serverSide: true,
    pagingType: "full_numbers",
    // scrollX: true,
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],
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
            doc.content[1].table.widths = ['5%', '20%', '15%', '15%', '10%', '20%', '5%', '10%'];
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
    ajax: {
        "url": 'closed_tickets',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { 
            data: 'ticketID', name: 'ticketID', 
            render: function (data, type, row) {
                return '<a href="view_ticket?id=' + row.id + '" class="kt-nav__link">'+row.ticketID+'</a>';
            }
        },
        { data: 'ticket_date', name: 'ticket_date' },
        { data: 'cust_name', name: 'cust_name' },
        { data: 'ticket_title', name: 'ticket_title' },
        { data: 'due_date', name: 'due_date' },
        { data: 'expirydays', name: 'expirydays' },
        { data: 'assignd_user', name: 'assignd_user' },
        { data: 'ticket_status', name: 'ticket_status' },
        {
            data: 'action', name: 'action',
            orderable: false, searchable: false,
            render: function (data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
                <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                  <i class="fa fa-cog"></i></a>\
                  <div class="dropdown-menu dropdown-menu-right">\
                  <ul class="kt-nav">\
                    <li class="kt-nav__item view_ticketdetails" data-id=' + row.id + ' >\
                    <span class="kt-nav__link">\
                    <i class="kt-nav__link-icon flaticon-eye"></i>\
                    <span class="kt-nav__link-text">View Ticket Details</span>\
                    </span></li>\
                 </ul></div></div></span>';
            }
        },

    ]
});

/**
 * Details : View Tickets Details
 * Date    : 05-12-2022
 */
 $(document).on('click', '.view_ticketdetails', function(){
    var ticketid = $(this).data('id');
    
    window.location.href = 'view_ticketdetails';
 });