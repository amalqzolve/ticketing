var table;
$(document).ready(function() {

    table = $('#datatable-common_letter_process').DataTable({ 
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1]
                }
            }
        ],
    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            "url" : base_url+'basic_settings/letter_pipeline_process_list',
            "type": "POST",
            "data": function ( data ) {
            	  
            }
        },
        "columnDefs": [
        { 
            "targets": [ 0 ],
            "orderable": false,
        },
        { 
            "targets": [ 2 ],
            "orderable": false,
        },
        // { 
        //     "targets": [ 3 ],
        //     "orderable": false,
        // }
        ],
    });
});


