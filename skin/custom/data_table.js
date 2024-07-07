var unit_arr;

var driver_dtable;
var vendor_dtable;
var vendor_trashtable;
var supplr_dtable;
var supplr_trashtable;
var supplrslist_dtable;
var supplrspay_dtable;
var vcateg_dtable;
var vtype_dtable;
var vehicle_dtable;
var insrcprov_dtable;
var insrcname_dtable;
var insrctype_dtable;
var ginfo_dtable;
var vinsrc_dtable;
var vestm_dtable;
var otherdoc_dtable;
var adddet_dtable;
var engine_dtable;
var own_dtable;
var contractor_dtable;
var contract_dtable;
var lprov_dtable;
var lbank_dtable;
var loan_dtable;
var ftype_dtable;
var fuel_dtable;
var srvtype_dtable;
var srvdet_dtable;
var srv_dtable;
var route_dtable;
var trip_dtable;
var xcat_dtable;
var xhead_dtable;
var exp_dtable;
var vstatus_dtable;
var vctgavail_dtable;
var vassign_dtable;
var retriv_dtable;
var partsalloc_dtable;
var purchase_dtable;

var v_Id;
var reqtype;
var material_history;
var vehicle_arr;
var servicetype_arr;
var servicedetail_arr;
var grandtotal = 0;
var cmn_settings;
var gtotalvat = 0;
var service_grandtotal = 0;
$(document).ready(function() {

	$('.kt-selectpicker').select2({
	  placeholder: 'Select an option'
	});

	// Add Trip  --- Price Category Dropdown
	$("#pricectg").select2({
		tags: true
	});

	// Add Service   -- Supplier Dropdown
	/*$("#srvsupplier").select2({
		tags: true
	});*/

	// Vehicle Status Assign -- Status Dropdown
	$("#vehstatus").select2({
		tags: true
	});

	// Add Driver - License Type Dropdown
	$("#drv_lic_type").select2({
		tags: true
	});

	// Common fn for Datepicker
	$(function () {
		$('.ktdatepicker').datepicker({
			format: 'dd-mm-yyyy',
			todayHighlight: true,

			autoclose: true
		});
	});

	// -------------------------------------------------------------- 

	// ****************************************
	//            Begin :: DATATABLES         *
	//*****************************************
	
	// Driver List
	driver_dtable = $('#datatable-driver').DataTable({
		"bDestroy": true,
		"dom": 'Blfrtip',
				"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"scrollX" : true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/driver_list',
			type : 'POST'
		},
		 "columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Driver trash List
	driver_trashdtable = $('#datatable-drivertrash').DataTable({
		"bDestroy": true,
		"dom": 'Blfrtip',
				"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"scrollX" : true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/driver_trashlist',
			type : 'POST'
		},
		 "columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 4 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Vendor List (25-02-2021)
	vendor_dtable = $('#datatable-vendor').DataTable({
        "bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
            url : base_url+'table/vendor_list',
            type : 'POST'
        },
      	"columnDefs": [
		{ 
			"targets": [ 0 ],
			"orderable": false,
		},
		{ 
			"targets": [ 4 ],
			"orderable": false,
		},
		],
    "fnDrawCallback": function(settings){
    $('[data-toggle="tooltip"]').tooltip();          
    }
   	});

	// Vendor Trash List (26-02-2021)
	vendor_trashtable = $('#datatable-vendortrash').DataTable({
        "bDestroy": true,"dom": 'Bfrtip',
        "dom": 'Blfrtip',
				"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],
        
    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
        "ajax": {
            url : base_url+'table/vendortrash_list',
            type : 'POST'
        },
      	"columnDefs": [
		{ 
			"targets": [ 0 ],
			"orderable": false,
		},
		{ 
			"targets": [ 4 ],
			"orderable": false,
		},
		],
    "fnDrawCallback": function(settings){
    $('[data-toggle="tooltip"]').tooltip();          
    }
  });

	// Supplier List (Added on 12-03-2021)
	supplr_dtable = $('#datatable-supplier').DataTable({
        "bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
            url : base_url+'table/supplr_list',
            type : 'POST'
        },
      	"columnDefs": [
		{ 
			"targets": [ 0 ],
			"orderable": false,
		},
		{ 
			"targets": [ 4 ],
			"orderable": false,
		},
		],
    	"fnDrawCallback": function(settings){
    		$('[data-toggle="tooltip"]').tooltip();          
    	}
   	});

	// Supplier Trash List (Added on 12-03-2021)
	supplr_trashtable = $('#datatable-supplrtrash').DataTable({
        "bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
            url : base_url+'table/supplrtrash_list',
            type : 'POST'
        },
      	"columnDefs": [
		{ 
			"targets": [ 0 ],
			"orderable": false,
		},
		{ 
			"targets": [ 4 ],
			"orderable": false,
		},
		],
    	"fnDrawCallback": function(settings){
    		$('[data-toggle="tooltip"]').tooltip();          
    	}
   	});

   	/*************************************
    * Detail : Suppliers List            *
    * Date   : 16-03-2021                *
    *************************************/
	supplrslist_dtable = $('#datatable-supplirslist').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/suppliers_listz',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
	   
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	/*************************************
	* Detail : Suppliers Payment List    *
	* Date   : 16-03-2021                *
	*************************************/
	supplrspay_dtable = $('#datatable-supplrspay').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/supplrspaymnt_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			}
			],
	   
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Vehicle Category List
	vcateg_dtable = $('#datatable-vcat').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vcat_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
	   
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Vehicle Category trash List
	vcateg_trashdtable = $('#datatable-vcattrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vcat_trashlist',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
	   
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Vehicle Type List
	vtype_dtable = $('#datatable-vtype').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vtype_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Vehicle Type trash List
	vtype_trashdtable = $('#datatable-vtypetrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vtype_trashlist',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Vehicle List
	vehicle_dtable = $('#datatable-vehicle').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vehicle_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Vehicle trash  List
	vehicle_trashdtable = $('#datatable-vehicletrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vehicle_trashlist',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Insurance Provider List
	insrcprov_dtable = $('#datatable-insuranseprovi').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/insurprovid_list',
			type : 'POST'
		},

		 "columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],

		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Insurance Provider trash List
	insrcprov_trashdtable = $('#datatable-insuranceprovidertrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/insurprovid_trashlist',
			type : 'POST'
		},

		 "columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],

		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//insurance provider excel buttons
    $("#provider_print").on("click", function() {
		insrcprov_dtable.button( '.buttons-print' ).trigger();
	});

	$("#provider_copy").on("click", function() {
		insrcprov_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#provider_excel").on("click", function() {
		insrcprov_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#provider_csv").on("click", function() {
		insrcprov_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#provider_pdf").on("click", function() {
		insrcprov_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Insurance Name List
	insrcname_dtable = $('#datatable-insrnamez').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/insurancename_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Insurance Name List
	insrcname_trashdtable = $('#datatable-insurancenametrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/insurancename_trashlist',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	//insurance type excel buttons
    $("#instype_print").on("click", function() {
		insrctype_dtable.button( '.buttons-print' ).trigger();
	});

	$("#instype_copy").on("click", function() {
		insrctype_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#instype_excel").on("click", function() {
		insrctype_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#instype_csv").on("click", function() {
		insrctype_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#instype_pdf").on("click", function() {
		insrctype_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Insurance Type List
	insrctype_dtable = $('#datatable-insuransetype').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/insuranctype_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],  
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Insurance Type trash List
	insrctype_trashdtable = $('#datatable-insurancetypetrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/insuranctype_trashlist',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],  
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//general information excel buttons
    $("#general_print").on("click", function() {
		ginfo_dtable.button( '.buttons-print' ).trigger();
	});

	$("#general_copy").on("click", function() {
		ginfo_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#general_excel").on("click", function() {
		ginfo_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#general_csv").on("click", function() {
		ginfo_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#general_pdf").on("click", function() {
		ginfo_dtable.button( '.buttons-pdf' ).trigger();
	});

	// General Info List
	ginfo_dtable = $('#datatable-g_info').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/veh_g_info_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 4 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// General Info trash List
	ginfo_trashdtable = $('#datatable-generalinfotrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/veh_g_info_trashlist',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 4 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	//vehicle isurance excel buttons
    $("#vinsurance_print").on("click", function() {
		vinsrc_dtable.button( '.buttons-print' ).trigger();
	});

	$("#vinsurance_copy").on("click", function() {
		vinsrc_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#vinsurance_excel").on("click", function() {
		vinsrc_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#vinsurance_csv").on("click", function() {
		vinsrc_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#vinsurance_pdf").on("click", function() {
		vinsrc_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Vehicle Insurance List
	vinsrc_dtable = $('#datatable-insurv').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/veh_insur_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Vehicle Insurance trash  List
	vinsrc_trashdtable = $('#datatable-insurvtrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/veh_insur_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	//vehicle estimra excel buttons
    $("#vestimara_print").on("click", function() {
		vestm_dtable.button( '.buttons-print' ).trigger();
	});

	$("#vestimara_copy").on("click", function() {
		vestm_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#vestimara_excel").on("click", function() {
		vestm_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#vestimara_csv").on("click", function() {
		vestm_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#vestimara_pdf").on("click", function() {
		vestm_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Vehicle Estimara List
	vestm_dtable = $('#datatable-estmara').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/estmara_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Vehicle Estimara trash List
	vestm_trashdtable = $('#datatable-estmaratrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/estmara_trashlist',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
   
	//vehicle other document excel buttons
    $("#vodocument_print").on("click", function() {
		otherdoc_dtable.button( '.buttons-print' ).trigger();
	});

	$("#vodocument_copy").on("click", function() {
		otherdoc_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#vodocument_excel").on("click", function() {
		otherdoc_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#vodocument_csv").on("click", function() {
		otherdoc_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#vodocument_pdf").on("click", function() {
		otherdoc_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Other Document List
	otherdoc_dtable = $('#datatable-otherdocv').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vehiotherdoc_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Other Document trash List
	otherdoc_trashdtable = $('#datatable-otherdocvtrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vehiotherdoc_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//vehicle category excel buttons
    $("#vadditional_print").on("click", function() {
		adddet_dtable.button( '.buttons-print' ).trigger();
	});

	$("#vadditional_copy").on("click", function() {
		adddet_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#vadditional_excel").on("click", function() {
		adddet_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#vadditional_csv").on("click", function() {
		adddet_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#vadditional_pdf").on("click", function() {
		adddet_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Additional details List
	adddet_dtable = $('#datatable-vehicle_additionaldoc').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8,9]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8,9]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8,9]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8,9]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8,9]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vehicle_adiitionaldoclist',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 10 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Additional details trash List
	adddet_trashdtable = $('#datatable-vehicle_additionaldoctrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8,9]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8,9]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8,9]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8,9]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8,9]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vehicle_adiitionaldoclisttrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 10 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//vehicle engine excel buttons
    $("#engine_print").on("click", function() {
		engine_dtable.button( '.buttons-print' ).trigger();
	});

	$("#engine_copy").on("click", function() {
		engine_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#engine_excel").on("click", function() {
		engine_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#engine_csv").on("click", function() {
		engine_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#engine_pdf").on("click", function() {
		engine_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Engine Details List
	engine_dtable = $('#datatable-engine').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/engine_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 4 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Engine Details trash List
	engine_trashdtable = $('#datatable-enginetrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/engine_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 4 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//vehicle owner excel buttons
    $("#vowner_print").on("click", function() {
		own_dtable.button( '.buttons-print' ).trigger();
	});

	$("#vowner_copy").on("click", function() {
		own_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#vowner_excel").on("click", function() {
		own_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#vowner_csv").on("click", function() {
		own_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#vowner_pdf").on("click", function() {
		own_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Vehicle Owner Details List
	own_dtable = $('#datatable-vowner').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vowner_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Vehicle Owner trash Details List
	own_traashdtable = $('#datatable-vownertrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vowner_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			}
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//contractor excel buttons
    $("#contractor_print").on("click", function() {
		contractor_dtable.button( '.buttons-print' ).trigger();
	});

	$("#contractor_copy").on("click", function() {
		contractor_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#contractor_excel").on("click", function() {
		contractor_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#contractor_csv").on("click", function() {
		contractor_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#contractor_pdf").on("click", function() {
		contractor_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Contractor List
	contractor_dtable = $('#datatable-contractorr').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/contractorr_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Contractor trash List
	contractor_trashdtable = $('#datatable-contractorrtrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/contractorr_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//contract excel buttons
    $("#contract_print").on("click", function() {
		contract_dtable.button( '.buttons-print' ).trigger();
	});

	$("#contract_copy").on("click", function() {
		contract_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#contract_excel").on("click", function() {
		contract_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#contract_csv").on("click", function() {
		contract_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#contract_pdf").on("click", function() {
		contract_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Contract List
	contract_dtable = $('#datatable-contractnnn').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/contractnnn_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 4 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Contract trash List
	contract_trashdtable = $('#datatable-contractnnntrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/contractnnn_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 4 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//loan provider excel buttons
    $("#lprovider_print").on("click", function() {
		lprov_dtable.button( '.buttons-print' ).trigger();
	});

	$("#lprovider_copy").on("click", function() {
		lprov_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#lprovider_excel").on("click", function() {
		lprov_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#lprovider_csv").on("click", function() {
		lprov_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#lprovider_pdf").on("click", function() {
		lprov_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Loan Provider List
	lprov_dtable = $('#datatable-loantblprov').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/loanprovider_list',
			type : 'POST'
		},
		 "columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Loan Provider trash List
	lprov_trashdtable = $('#datatable-loantblprovtrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/loanprovider_listtrash',
			type : 'POST'
		},
		 "columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	//bank category excel buttons
    $("#bank_print").on("click", function() {
		lbank_dtable.button( '.buttons-print' ).trigger();
	});

	$("#bank_copy").on("click", function() {
		lbank_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#bank_excel").on("click", function() {
		lbank_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#bank_csv").on("click", function() {
		lbank_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#bank_pdf").on("click", function() {
		lbank_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Loan Bank List
	lbank_dtable = $('#datatable-bank').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/loanbank_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Loan Bank trash List
	lbank_trashdtable = $('#datatable-banktrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/loanbank_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//loan excel buttons
    $("#loan_print").on("click", function() {
		loan_dtable.button( '.buttons-print' ).trigger();
	});

	$("#loan_copy").on("click", function() {
		loan_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#loan_excel").on("click", function() {
		loan_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#loan_csv").on("click", function() {
		loan_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#loan_pdf").on("click", function() {
		loan_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Loan List
	loan_dtable = $('#datatable-loantbl').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/loan_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Loan trash List
	loan_trashdtable = $('#datatable-loantbltrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/loan_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//fuel type excel buttons
    $("#ftype_print").on("click", function() {
		ftype_dtable.button( '.buttons-print' ).trigger();
	});

	$("#ftype_copy").on("click", function() {
		ftype_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#ftype_excel").on("click", function() {
		ftype_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#ftype_csv").on("click", function() {
		ftype_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#ftype_pdf").on("click", function() {
		ftype_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Fuel Type List
	ftype_dtable = $('#datatable-fueltypee').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/fueltypee_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
	   
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Fuel Type trash List
	ftype_trashdtable = $('#datatable-fueltypeetrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/fueltypee_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
	   
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//vehicle category excel buttons
    $("#fuel_print").on("click", function() {
		fuel_dtable.button( '.buttons-print' ).trigger();
	});

	$("#fuel_copy").on("click", function() {
		fuel_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#fuel_excel").on("click", function() {
		fuel_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#fuel_csv").on("click", function() {
		fuel_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#fuel_pdf").on("click", function() {
		fuel_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Fuel List
	fuel_dtable = $('#datatable-fuellist').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/fuel_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
    
	// Fuel trash  List
	fuel_trashdtable = $('#datatable-fuellisttrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/fuel_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 4 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//service type excel buttons
    $("#stype_print").on("click", function() {
		srvtype_dtable.button( '.buttons-print' ).trigger();
	});

	$("#stype_copy").on("click", function() {
		srvtype_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#stype_excel").on("click", function() {
		srvtype_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#stype_csv").on("click", function() {
		srvtype_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#stype_pdf").on("click", function() {
		srvtype_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Service Type List
	srvtype_dtable = $('#datatable-servtyp').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
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
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
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
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/servtyp_list',
			type : 'POST'
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
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

    // Service Type Trash List
	srvtype_trashdtable = $('#datatable-servtyptrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
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
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
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
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/servtyp_trashlist',
			type : 'POST'
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
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	//service excel buttons
    $("#sdetail_print").on("click", function() {
		srvdet_dtable.button( '.buttons-print' ).trigger();
	});

	$("#sdetail_copy").on("click", function() {
		srvdet_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#sdetail_excel").on("click", function() {
		srvdet_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#sdetail_csv").on("click", function() {
		srvdet_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#sdetail_pdf").on("click", function() {
		srvdet_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Service Details List
	srvdet_dtable = $('#datatable-servdetail').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/servdetail_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Service Details trash List
	srvdet_trashdtable = $('#datatable-servdetailtrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/servdetail_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	//service new excel buttons
    $("#snew_print").on("click", function() {
		srv_dtable.button( '.buttons-print' ).trigger();
	});

	$("#snew_copy").on("click", function() {
		srv_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#snew_excel").on("click", function() {
		srv_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#snew_csv").on("click", function() {
		srv_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#snew_pdf").on("click", function() {
		srv_dtable.button( '.buttons-pdf' ).trigger();
	});

	// New Service List
	srv_dtable = $('#datatable-servnew').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/servnew_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 8 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// New Service trash List
	srv_dtable = $('#datatable-servnew').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/servnew_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 8 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
    // New Service trash List
	srv_trashdtable = $('#datatable-servnewtrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/servnew_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 8 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//route excel buttons
    $("#route_print").on("click", function() {
		route_dtable.button( '.buttons-print' ).trigger();
	});

	$("#route_copy").on("click", function() {
		route_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#route_excel").on("click", function() {
		route_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#route_csv").on("click", function() {
		route_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#route_pdf").on("click", function() {
		route_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Route List
	route_dtable = $('#datatable-routelist').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/route_list',
			type : 'POST'
		},

		 "columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Route List trash
	route_trashdtable = $('#datatable-routelisttrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/route_listtrash',
			type : 'POST'
		},

		 "columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//trip  excel buttons
    $("#trip_print").on("click", function() {
		trip_dtable.button( '.buttons-print' ).trigger();
	});

	$("#trip_copy").on("click", function() {
		trip_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#trip_excel").on("click", function() {
		trip_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#tript_csv").on("click", function() {
		trip_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#trip_pdf").on("click", function() {
		trip_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Trip List
	trip_dtable = $('#datatable-trippzz').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			}
		],

		 
		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/tripmangeee_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 7 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Trip List trash 
	trip_trashdtable = $('#datatable-trippzztrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			}
		],

		 
		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/tripmangeee_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 7 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
  
	//expense category excel buttons
    $("#excat_print").on("click", function() {
		xcat_dtable.button( '.buttons-print' ).trigger();
	});

	$("#excat_copy").on("click", function() {
		xcat_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#excat_excel").on("click", function() {
		xcat_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#excat_csv").on("click", function() {
		xcat_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#excat_pdf").on("click", function() {
		xcat_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Expense Category List
	xcat_dtable = $('#datatable-xcatlist').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/xcat_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Expense Category List trash
	xcat_trashdtable = $('#datatable-xcatlisttrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/xcat_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
   
	//exense head excel buttons
    $("#exhead_print").on("click", function() {
		xhead_dtable.button( '.buttons-print' ).trigger();
	});

	$("#exhead_copy").on("click", function() {
		xhead_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#exhead_excel").on("click", function() {
		xhead_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#exhead_csv").on("click", function() {
		xhead_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#exhead_pdf").on("click", function() {
		xhead_dtable.button( '.buttons-pdf' ).trigger();
	});
	// Expense Head List
	xhead_dtable = $('#datatable-xheadlist').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/xhead_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 4 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Expense Head trash List
	xhead_trashdtable = $('#datatable-xheadlisttrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/xhead_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 4 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//expense excel buttons
    $("#expense_print").on("click", function() {
		exp_dtable.button( '.buttons-print' ).trigger();
	});

	$("#expense_copy").on("click", function() {
		exp_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#expense_excel").on("click", function() {
		exp_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#expense_csv").on("click", function() {
		exp_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#expense_pdf").on("click", function() {
		exp_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Expense List
	exp_dtable = $('#datatable-expenselist').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/expense_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Expense List trash
	exp_trashdtable = $('#datatable-expenselisttrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/expense_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 6 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//vehicle status assign excel buttons
    $("#sassign_print").on("click", function() {
		vstatus_dtable.button( '.buttons-print' ).trigger();
	});

	$("#sassign_copy").on("click", function() {
		vstatus_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#sassign_excel").on("click", function() {
		vstatus_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#sassign_csv").on("click", function() {
		vstatus_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#sassign_pdf").on("click", function() {
		vstatus_dtable.button( '.buttons-pdf' ).trigger();
	});

	/*************************************
	* Detail : Vehicle Status Assign List*
	* Date   : 30-12-2020                *
	*************************************/
	vstatus_dtable = $('#datatable-vstatusassign').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vstatusassign_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 4 ],
				"orderable": false,
			},
		],
		"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//vehicle assign excel buttons
    $("#vassign_print").on("click", function() {
		vassign_dtable.button( '.buttons-print' ).trigger();
	});

	$("#vassign_copy").on("click", function() {
		vassign_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#vassign_excel").on("click", function() {
		vassign_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#vassign_csv").on("click", function() {
		vassign_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#vassign_pdf").on("click", function() {
		vassign_dtable.button( '.buttons-pdf' ).trigger();
	});

	/***********************************
	* Detail : Vehicle Assign List     *
	* Date   : 31-12-2020              *
	***********************************/
	vassign_dtable = $('#datatable-vehicle_assign').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vehicle_assign_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	/****************************************
	* Detail : Vehicle Assign List  trash   *
	* Date   : 31-12-2020                   *
	****************************************/
	vassign_trashdtable = $('#datatable-vehicle_assigntrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vehicle_assign_listtrash',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	/***************************************
	* Detail : Vehicle Availability List   *
				  based on Vehicle Category
				  OR Vehicle Type          *
	* Date   : 4-1-2021                    *
	***************************************/
	vctgavail_dtable = $('#datatable-vcat_vehavail').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		"buttons": [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vcat_vehavail_list',
			type : 'POST',
			data: {vId : v_Id, req : reqtype}
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
	   
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});
	
	//vehicle retrive excel buttons
    $("#vretrive_print").on("click", function() {
		retriv_dtable.button( '.buttons-print' ).trigger();
	});

	$("#vretrive_copy").on("click", function() {
		retriv_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#vretrive_excel").on("click", function() {
		retriv_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#vretrive_csv").on("click", function() {
		retriv_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#vretrive_pdf").on("click", function() {
		retriv_dtable.button( '.buttons-pdf' ).trigger();
	});

	/**********************************
	* Detail : Vehicle Retrieve List  *
	* Date   : 2-1-2021               *
	**********************************/
	retriv_dtable = $('#datatable-vehicle_retrieve').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vehicle_retrieve_list',
			type : 'POST'
		},

		 "columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	/*************************************
	* Detail : Vehicle Retrieve Listtrash *
	* Date   : 2-1-2021                   *
	*************************************/
	retrivtrashdtable = $('#datatable-vehicle_retrievetrash').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/vehicle_retrieve_listtrash',
			type : 'POST'
		},

		 "columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
		"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	// Parts Allocation List
	partsalloc_dtable = $('#datatable-partsalloc').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/partsalloct_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 3 ],
				"orderable": false,
			},
			],
	   
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	/************************************
	* Detail : Purchase List            *
	* Date   : 18-03-2021               *
	************************************/
	purchase_dtable = $('#datatable-purchase').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/purchase_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
			{ 
				"targets": [ 5 ],
				"orderable": false,
			},
			],
	   
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});


	cmn_settings = $('#datatable-common_settings').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			url : base_url+'table/comn_stngs_list',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			}
			],
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});

	//************  End :: DATATABLES  ***********

	// *********** Begin :: Add / Edit Submits *********

	/******************************
	* Detail : Driver Submit      *
	* Date   : 15-12-2020         *
	******************************/
	$("#driver_submit").click(function(e) {
		e.preventDefault();

		var id          = $("input[name='id']").val();
		var gender      = $("#gender").val();
		var name        = $("input[name='name']").val();
		var phone       = $("input[name='phone']").val();
		var nationality = $("#nationality").val();

		
		if (name=="") 
		{
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		} 
		else
		{
			$("input[name='name']").removeClass('is-invalid');
		}
		if (gender == "" || gender == null) 
		{
			$("#gender").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		} 
		else
		{
			$("#gender").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (phone=="") 
		{
			$("input[name='phone']").addClass('is-invalid');
			$("input[name='phone']").focus();
			return false;
		}
		else
		{
		   $("input[name='phone']").removeClass('is-invalid');
		}  
		if (nationality == "" || nationality == null) 
		{
			$("#nationality").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		} 
		else
		{
			$("#nationality").next().find('.select2-selection').removeClass('select-dropdown-error');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_driver', field : 'id', condition : 'phone="'+phone.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(ph_lang);
						$("input[name='phone']").addClass('is-invalid');
						$("input[name='phone']").focus();
						return false;
					}
					else {
						$("input[name='phone']").removeClass('is-invalid');

						$("#driverForm").attr("action",base_url+"Common/db_add_update");
						$("#driverForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_driver', field : 'id', condition : 'phone="'+phone.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(ph_lang);
						$("input[name='phone']").addClass('is-invalid');
						$("input[name='phone']").focus();
						return false;
					}
					else {
						$("input[name='phone']").removeClass('is-invalid');

						$("#driverForm").attr("action",base_url+"Common/db_add_update");
						$("#driverForm").submit();
					}
				}
			});
		}

	});

	/*************************************
	* Detail : Vendor Submit             *
	* Date   : 25-02-2021                *
	*************************************/
	$("#vendorsubmit_btn").click(function() {
		var id    = $("input[name='id']").val();
        var name  = $("input[name='name']").val();
        var phone = $("input[name='phone']").val();
        
        if (name=="") {
            $("input[name='name']").addClass('is-invalid');;
            $("input[name='name']").focus();
            return false;
        }
        else{
        	$("input[name='name']").removeClass('is-invalid');
        }
        if (phone=="") {
            $("input[name='phone']").addClass('is-invalid');;
            $("input[name='phone']").focus();
            return false;
        }
        else {
        	$("input[name='phone']").removeClass('is-invalid');
        }
        //For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vendor', field : 'id', condition : 'phone="'+phone.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(ph_lang);
						$("input[name='phone']").addClass('is-invalid');
						$("input[name='phone']").focus();
						return false;
					}
					else {
						$("input[name='phone']").removeClass('is-invalid');

						$("#vendorForm").attr("action",base_url+"Common/db_add_update");
            			$("#vendorForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vendor', field : 'id', condition : 'phone="'+phone.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(ph_lang);
						$("input[name='phone']").addClass('is-invalid');
						$("input[name='phone']").focus();
						return false;
					}
					else {
						$("input[name='phone']").removeClass('is-invalid');

						$("#vendorForm").attr("action",base_url+"Common/db_add_update");
            			$("#vendorForm").submit();
					}
				}
			});
		}
    });

    /*************************************
	* Detail : Supplier Submit           *
	* Date   : 12-03-2021                *
	*************************************/
	$("#supplrsubmit_btn").click(function() {
		var id    = $("input[name='id']").val();
        var name  = $("input[name='suplr_name']").val();
        var phone = $("input[name='suplr_phone']").val();
        var code  = $("input[name='suplr_code']").val();
        
        if (name=="") {
            $("input[name='suplr_name']").addClass('is-invalid');;
            $("input[name='suplr_name']").focus();
            return false;
        }
        else{
        	$("input[name='suplr_name']").removeClass('is-invalid');
        }

        /* begin :: Added on 17-03-2021 */
        /*if (code=="") {
            $("input[name='suplr_code']").addClass('is-invalid');;
            $("input[name='suplr_code']").focus();
            return false;
        }
        else{
        	$("input[name='suplr_code']").removeClass('is-invalid');
        }*/
        /* end   :: Added on 17-03-2021 */

        if (phone=="") {
            $("input[name='suplr_phone']").addClass('is-invalid');;
            $("input[name='suplr_phone']").focus();
            return false;
        }
        else {
        	$("input[name='suplr_phone']").removeClass('is-invalid');
        }
        //For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_supplier', field : 'id', condition : 'phone="'+phone.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(ph_lang);
						$("input[name='suplr_phone']").addClass('is-invalid');
						$("input[name='suplr_phone']").focus();
						return false;
					}
					else {
						$("input[name='suplr_phone']").removeClass('is-invalid');

						$("#supplierForm").attr("action",base_url+"Common/db_add_update");
            			$("#supplierForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_supplier', field : 'id', condition : 'phone="'+phone.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(ph_lang);
						$("input[name='suplr_phone']").addClass('is-invalid');
						$("input[name='suplr_phone']").focus();
						return false;
					}
					else {
						$("input[name='suplr_phone']").removeClass('is-invalid');

						$("#supplierForm").attr("action",base_url+"Common/db_add_update");
            			$("#supplierForm").submit();
					}
				}
			});
		}
    });

	/*******************************
	* VEhicle Category Submit      *
	*******************************/
	$("#vcatsubmit").click(function(e) {
		e.preventDefault();

		var id   = $("input[name='id']").val();
		var name = $("input[name='name']").val();
		
		if (name=="") 
		{
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}  
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vcat', field : 'id', condition : 'name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(vct_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#vcatForm").attr("action",base_url+"Common/db_add_update");
						$("#vcatForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vcat', field : 'id', condition : 'name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(vct_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#vcatForm").attr("action",base_url+"Common/db_add_update");
						$("#vcatForm").submit();
					}
				}
			});
		}

	});

	/****************************
	* Vehicle Type Submit       *
	****************************/
	$("#vtypesubmit").click(function(e) {
		e.preventDefault();

		var id   = $("input[name='id']").val();
		var name = $("input[name='name']").val();
		
		if (name=="") 
		{
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}  
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vtype', field : 'id', condition : 'name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(vtp_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#vtypeForm").attr("action",base_url+"Common/db_add_update");
						$("#vtypeForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vtype', field : 'id', condition : 'name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(vtp_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#vtypeForm").attr("action",base_url+"Common/db_add_update");
						$("#vtypeForm").submit();
					}
				}
			});
		}

	});

	/********************************
	* Detail : Vehicle Submit       *
	* Date   : 15-12-2020           *
	********************************/
	$("#vehiclesubmit").click(function(e) {
		e.preventDefault();

		var id           = $("input[name='id']").val();
		var name         = $("input[name='name']").val();
		var licplate     = $("input[name='license']").val();
		var number       = $("input[name='number']").val();
		var ctg          = $("#cat").val();
		var type         = $("#type").val();
		var fuel         = $("#fuel_type").val();

		if (name=="") {
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}  
		else 
		{
		   $("input[name='name']").removeClass('is-invalid');
		}
		if (licplate=="") {
			$("input[name='license']").addClass('is-invalid');
			$("input[name='license']").focus();
			return false;
		}  
		else 
		{
		   $("input[name='license']").removeClass('is-invalid');
		}
		if (number=="") 
		{
			$("input[name='number']").addClass('is-invalid');
			$("input[name='number']").focus();
			return false;
		} 
		else 
		{
			$("input[name='number']").removeClass('is-invalid');
		}
		if (ctg=="") {
			$("#cat").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#cat").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (type=="") {
			$("#type").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#type").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (fuel=="") {
			$("#fuel_type").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#fuel_type").next().find('.select2-selection').removeClass('select-dropdown-error');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle', field : 'id', condition : 'license="'+licplate.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(licpl_lang);
						$("input[name='license']").addClass('is-invalid');
						$("input[name='license']").focus();
						return false;
					}
					else {
						$("input[name='license']").removeClass('is-invalid');

						$("#vehicleForm").attr("action",base_url+"Common/db_add_update");
						$("#vehicleForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle', field : 'id', condition : 'license="'+licplate.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(licpl_lang);
						$("input[name='license']").addClass('is-invalid');
						$("input[name='license']").focus();
						return false;
					}
					else {
						$("input[name='license']").removeClass('is-invalid');

						$("#vehicleForm").attr("action",base_url+"Common/db_add_update");
						$("#vehicleForm").submit();
					}
				}
			});
		}
	});

	/****************************************
	* Detail : Insurance Provider Submit    *
	* Date   : 15-12-2020                   *
	****************************************/
	$("#insprovider_submit").click(function(e) {
		e.preventDefault();

		var id          = $("input[name='id']").val();  
		var name        = $("input[name='name']").val();
		var phone       = $("input[name='phone']").val();
		var email       = $("input[name='insrcprov_email']").val();
		var emailformat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		if (name=="") 
		{
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}
		if (phone=="") 
		{
			$("input[name='phone']").addClass('is-invalid');
			$("input[name='phone']").focus();
			return false;
		}
		else
		{
			$("input[name='phone']").removeClass('is-invalid');
		}
		if (email != "" && !emailformat.test(email)) {
			$("input[name='insrcprov_email']").addClass('is-invalid');
			$("input[name='insrcprov_email']").focus();
			return false;
		}
		else {
			$("input[name='insrcprov_email']").removeClass('is-invalid');
		}

		// For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_insurance_provider', field : 'id', condition : 'name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(inprov_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_insurance_provider', field : 'id', condition : 'phone="'+phone.trim()+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(ph_lang);
									$("input[name='phone']").addClass('is-invalid');
									$("input[name='phone']").focus();
									return false;
								}
								else {
									$("input[name='phone']").removeClass('is-invalid');

									$("#inspForm").attr("action",base_url+"Common/db_add_update");
									$("#inspForm").submit();
								}
							}
						});
					}
				}
			});
		}

		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_insurance_provider', field : 'id', condition : 'name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(inprov_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_insurance_provider', field : 'id', condition : 'phone="'+phone.trim()+'" AND id!="'+id+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(ph_lang);
									$("input[name='phone']").addClass('is-invalid');
									$("input[name='phone']").focus();
									return false;
								}
								else {
									$("input[name='phone']").removeClass('is-invalid');

									$("#inspForm").attr("action",base_url+"Common/db_add_update");
									$("#inspForm").submit();
								}
							}
						});
					}
				}
			});
		}

	});
	
	/**********************************
	* Detail : Insurance Name Submit  *
	* Date   : 15-12-2020             *
	**********************************/
	$("#insname_submit").click(function(e) {
		e.preventDefault();

		var id   = $("input[name='id']").val();
		var name = $("input[name='name']").val();

		if (name=="") 
		{
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_insurance_name', field : 'id', condition : 'name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(insna_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#insurnameForm").attr("action",base_url+"Common/db_add_update");
						$("#insurnameForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_insurance_name', field : 'id', condition : 'name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(insna_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#insurnameForm").attr("action",base_url+"Common/db_add_update");
						$("#insurnameForm").submit();
					}
				}
			});
		}

	});

	/*************************************
	* Detail : Insurance Type Submit     *
	* Date   : 15-12-2020                *
	*************************************/
	$("#instype_submit").click(function(e) {
		e.preventDefault();

		var id   = $("input[name='id']").val();
		var name = $("input[name='name']").val();

		if (name=="") {
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}
		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_insurance_type', field : 'id', condition : 'name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(intyp_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#insurtyeForm").attr("action",base_url+"Common/db_add_update");
						$("#insurtyeForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_insurance_type', field : 'id', condition : 'name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(intyp_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#insurtyeForm").attr("action",base_url+"Common/db_add_update");
						$("#insurtyeForm").submit();
					}
				}
			});
		}
   
	});

	/***************************************
	* Detail : General Info (Vehicle Mgmnt)*
	* Date   : 17-12-2020                  *
	***************************************/
	$("#ginfosubmit").click(function(e) {
		e.preventDefault();

		var id               = $("input[name='id']").val();
		var vehicle          = $("#vehicle").val();
		var chassis_no       = $("input[name='chassis']").val();

		if (vehicle == "") {
			$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (chassis_no=="") 
		{
			$("input[name='chassis']").addClass('is-invalid');
			$("input[name='chassis']").focus();
			return false;
		}  
		else
		{
			$("input[name='chassis']").removeClass('is-invalid');
		}

		// For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicleg_info', field : 'id', condition : 'vehicle="'+vehicle+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_vehicleg_info', field : 'id', condition : 'chassis="'+chassis_no+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(chas_lang);
									$("input[name='chassis']").addClass('is-invalid');
									$("input[name='chassis']").focus();
									return false;
								}
								else {
									$("input[name='chassis']").removeClass('is-invalid');

									$("#ginfoForm").attr("action",base_url+"Common/db_add_update");
									$("#ginfoForm").submit();
								}
							}
						});
					}
				}
			});
		}

		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicleg_info', field : 'id', condition : 'vehicle="'+vehicle+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_vehicleg_info', field : 'id', condition : 'chassis="'+chassis_no+'" AND id!="'+id+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(chas_lang);
									$("input[name='chassis']").addClass('is-invalid');
									$("input[name='chassis']").focus();
									return false;
								}
								else {
									$("input[name='chassis']").removeClass('is-invalid');

									$("#ginfoForm").attr("action",base_url+"Common/db_add_update");
									$("#ginfoForm").submit();
								}
							}
						});
					}
				}
			});
		}
	});

	/*******************************************
	* Vehicle Insurance Submit (Vehicle Mgmnt) *
	* Date : 22-12-2020                        *
	*******************************************/
	$("#insursubmit").click(function(e) {
		e.preventDefault();

		var id       = $("input[name='id']").val();
		var vehicle  = $("#vehicle").val();
		var provider = $("#provider").val();
		var expiry   = $("input[name='expiry']").val();

		if (vehicle == "") {
			$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (provider=="") 
		{
			$('#provider').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}  
		else 
		{
			$('#provider').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		
		if (expiry=="") 
		{
			$("input[name='expiry']").addClass('is-invalid');
			$("input[name='expiry']").focus();
			return false;
		}  
		else 
		{
			$("input[name='expiry']").removeClass('is-invalid');
		}

		// For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_insurance', field : 'id', condition : 'vehicle="'+vehicle+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#insurForm").attr("action",base_url+"Common/db_add_update");
						$("#insurForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_insurance', field : 'id', condition : 'vehicle="'+vehicle+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#insurForm").attr("action",base_url+"Common/db_add_update");
						$("#insurForm").submit();
					}
				}
			});
		}
	});

	/*****************************************
	* Vehicle Estimara Submit (Vehicle Mgmnt)*
	* Date : 22-12-2020                      *
	*****************************************/
	$("#estimarasubmit").click(function(e) {
		e.preventDefault();

		var id           = $("input[name='id']").val();
		var vehicle      = $("#vehicle").val();
		var generated_on = $("input[name='generated']").val();
		var expiry       = $("input[name='expiry']").val();

		if (vehicle == "") {
			$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (generated_on=="") 
		{
			$("input[name='generated']").addClass('is-invalid');
			$("input[name='generated']").focus();
			return false;
		}  
		else
		{
			$("input[name='generated']").removeClass('is-invalid');
		}
		if (expiry=="") 
		{
			$("input[name='expiry']").addClass('is-invalid');
			$("input[name='expiry']").focus();
			return false;
		}  
		else
		{
			$("input[name='expiry']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_estimara', field : 'id', condition : 'vehicle="'+vehicle+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#estimaraForm").attr("action",base_url+"Common/db_add_update");
						$("#estimaraForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_estimara', field : 'id', condition : 'vehicle="'+vehicle+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#estimaraForm").attr("action",base_url+"Common/db_add_update");
						$("#estimaraForm").submit();
					}
				}
			});
		}

	});

	/******************************************
	* Detail : Other Document (Vehicle Mngmnt)*
	* Date   : 18-12-2020                     *
	******************************************/
	$("#otherdocsubmit").click(function(e) {
		e.preventDefault();

		var id      = $("input[name='id']").val();
		var vehicle = $("#vehicle").val();
		var name    = $("input[name='name']").val();
		var expiry  = $("input[name='docexpiry']").val();

		if (vehicle == "") {
			$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (name=="") 
		{
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}  
		else
		{
			$("input[name='name']").removeClass('is-invalid');
		}
		if (expiry=="") 
		{
			$("input[name='docexpiry']").addClass('is-invalid');
			$("input[name='docexpiry']").focus();
			return false;
		}  
		else
		{
			$("input[name='docexpiry']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_otherdoc', field : 'id', condition : 'vehicle="'+vehicle+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#otherdocForm").attr("action",base_url+"Common/db_add_update");
						$("#otherdocForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_otherdoc', field : 'id', condition : 'vehicle="'+vehicle+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#otherdocForm").attr("action",base_url+"Common/db_add_update");
						$("#otherdocForm").submit();
					}
				}
			});
		}
	});

	/********************************************
	* Details : Additional Detail (Vehicle Mgmnt)
	* Date    : 18-12-2020                      *
	********************************************/
	$("#additionaldetvehisubmit").click(function(e) {
		e.preventDefault();

		var id               = $("input[name='id']").val();
		var vehicle          = $("#vehicle").val();
		var seat             = $("input[name='seat']").val();
		var door             = $("input[name='door']").val();
		var tires            = $("input[name='tires']").val();

		if (vehicle=="") {
			$("#vehicle").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#vehicle").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (seat=="") 
		{
			$("input[name='seat']").addClass('is-invalid');
			$("input[name='seat']").focus();
			return false;
		} 
		else 
		{
			$("input[name='seat']").removeClass('is-invalid');
		}
		if (tires=="") 
		{
			$("input[name='tires']").addClass('is-invalid');
			$("input[name='tires']").focus();
			return false;
		} 
		else
		{
			$("input[name='tires']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_additional_detail', field : 'id', condition : 'vehicle="'+vehicle+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#vehiaddiForm").attr("action",base_url+"Common/db_add_update");
						$("#vehiaddiForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_additional_detail', field : 'id', condition : 'vehicle="'+vehicle+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#vehiaddiForm").attr("action",base_url+"Common/db_add_update");
						$("#vehiaddiForm").submit();
					}
				}
			});
		}

	});

	/******************************************
	* Detail : Engine Details (Vehicle Mgmnt) *
	* Date   : 17-12-2020                     *
	******************************************/
	$("#enginevsubmit").click(function(e) {
		e.preventDefault();

		var id       = $("input[name='id']").val();
		var vehicle  = $("#vehicle").val();
		var fueltype = $("#fueltype").val();

		if (vehicle == "") {
			$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_engine', field : 'id', condition : 'vehicle="'+vehicle+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#vengineForm").attr("action",base_url+"Common/db_add_update");
						$("#vengineForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_engine', field : 'id', condition : 'vehicle="'+vehicle+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#vengineForm").attr("action",base_url+"Common/db_add_update");
						$("#vengineForm").submit();
					}
				}
			});
		}
	});

	/******************************************
	* Detail : Owner Details (Vehicle Mngmnt) *
	* Date   : 18-12-2020                     *
	******************************************/
	$("#ownersubmit").click(function(e) {
		e.preventDefault();

		var id                      = $("input[name='id']").val();
		var vehicle                 = $("#vehicle").val();
		var name                    = $("input[name='name']").val();
		var Email                   = $("input[name='Email']").val();
		var mail_format             = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var phone                   = $("input[name='phone']").val();

		if (vehicle == "") {
			$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (name=="") 
		{
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}
		else
		{
			$("input[name='name']").removeClass('is-invalid');
		} 
		if (phone=="") 
		{
			$("input[name='phone']").addClass('is-invalid');
			$("input[name='phone']").focus();
			return false;
		}   
		else 
		{
			$("input[name='phone']").removeClass('is-invalid');
		} 
		if (Email!="" && !mail_format.test(Email)) 
		{
			$("input[name='Email']").addClass('is-invalid');
			$("input[name='Email']").focus();
			return false;
		} 
		else
		{
			$("input[name='Email']").removeClass('is-invalid');
		}

		// For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_owner', field : 'id', condition : 'vehicle="'+vehicle+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_vehicle_owner', field : 'id', condition : 'phone="'+phone.trim()+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(ph_lang);
									$("input[name='phone']").addClass('is-invalid');
									$("input[name='phone']").focus();
									return false;
								}
								else {
									$("input[name='phone']").removeClass('is-invalid');

									$("#vownerForm").attr("action",base_url+"Common/db_add_update");
									$("#vownerForm").submit();
								}
							}
						});
					}
				}
			});
		}

		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_owner', field : 'id', condition : 'vehicle="'+vehicle+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(veh_lang);
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_vehicle_owner', field : 'id', condition : 'phone="'+phone.trim()+'" AND id!="'+id+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(ph_lang);
									$("input[name='phone']").addClass('is-invalid');
									$("input[name='phone']").focus();
									return false;
								}
								else {
									$("input[name='phone']").removeClass('is-invalid');

									$("#vownerForm").attr("action",base_url+"Common/db_add_update");
									$("#vownerForm").submit();
								}
							}
						});
					}
				}
			});
		}

	});

	/******************************************
	* Detail : Contractor Submit              *
	* Date   : 22-12-2020                     *
	******************************************/
	$("#contractsubmit").click(function(e) {
		e.preventDefault();

		var id          = $("input[name='id']").val();
		var name        = $("input[name='name']").val();
		var Email       = $("input[name='Email']").val();
		var mail_format = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var phone       = $("input[name='phone']").val();
		var company     = $("input[name='company']").val();
		
		if (name=="") 
		{ 
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		} 
		else
		{
			$("input[name='name']").removeClass('is-invalid');
		} 
		if (Email!="" && !mail_format.test(Email)) 
		{
			$("input[name='Email']").addClass('is-invalid');
			$("input[name='Email']").focus();
			return false;
		} 
		 else
		{
			$("input[name='Email']").removeClass('is-invalid');
		}
		if (phone=="") 
		{
			$("input[name='phone']").addClass('is-invalid');
			$("input[name='phone']").focus();
			return false;
		}
		else
		{
			$("input[name='phone']").removeClass('is-invalid');
		}
		if (company=="") 
		{ 
			$("input[name='company']").addClass('is-invalid');
			$("input[name='company']").focus();
			return false;
		} 
		else
		{
			$("input[name='company']").removeClass('is-invalid');
		}

		// For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_contractor', field : 'id', condition : 'name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(contr_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_contractor', field : 'id', condition : 'phone="'+phone.trim()+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(ph_lang);
									$("input[name='phone']").addClass('is-invalid');
									$("input[name='phone']").focus();
									return false;
								}
								else {
									$("input[name='phone']").removeClass('is-invalid');

									$("#contractorForm").attr("action",base_url+"Common/db_add_update");
									$("#contractorForm").submit();
								}
							}
						});
					}
				}
			});
		}

		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_contractor', field : 'id', condition : 'name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(contr_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_contractor', field : 'id', condition : 'phone="'+phone.trim()+'" AND id!="'+id+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(ph_lang);
									$("input[name='phone']").addClass('is-invalid');
									$("input[name='phone']").focus();
									return false;
								}
								else {
									$("input[name='phone']").removeClass('is-invalid');

									$("#contractorForm").attr("action",base_url+"Common/db_add_update");
									$("#contractorForm").submit();
								}
							}
						});
					}
				}
			});
		}
	});

	/*****************************************
	* Detail : Contract Management Submit    *
	* Date   : 17-12-2020                    *
	*****************************************/
	$("#contraasubmit").click(function(e) {
		e.preventDefault();

		var id         = $("#input[name='id']").val();
		var name       = $("input[name='name']").val();
		var vehicle    = $("#vehicle").val();
		var partyA     = $("#partya").val();
		var partyB     = $("#partyb").val();
		var validfrm   = $("input[name='valid_from']").val();
		var validto    = $("input[name='valid_to']").val();

		if (name=="") {
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		} 
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}
		if (vehicle=="") {
			$("#vehicle").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#vehicle").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (partyA=="") {
			$("#partya").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#partya").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (partyB=="") {
			$("#partyb").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#partyb").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (validfrm=="") {
			$("input[name='valid_from']").addClass('is-invalid');
			$("input[name='valid_from']").focus();
			return false;
		} 
		else 
		{
			$("input[name='valid_from']").removeClass('is-invalid');
		}
		if (validto=="") {
			$("input[name='valid_to']").addClass('is-invalid');
			$("input[name='valid_to']").focus();
			return false;
		} 
		else 
		{
			$("input[name='valid_to']").removeClass('is-invalid');
		}

		$("#contractttForm").attr("action",base_url+"Common/db_add_update");
		$("#contractttForm").submit();
	});

	/****************************************
	* Detail : Loan Provider Submit         *
	* Date   : 19-12-2020                   *
	****************************************/
	$("#loan_new_submit").click(function(e) {
		e.preventDefault();

		var id          = $("input[name='id']").val();
		var name        = $("input[name='name']").val();
		var phone       = $("input[name='phone']").val();
		var email       = $("input[name='email']").val();
		var mail_format = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		if (name=="") {
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}
		if (phone=="") {
			$("input[name='phone']").addClass('is-invalid');
			$("input[name='phone']").focus();
			return false;
		}
		else
		{
			$("input[name='phone']").removeClass('is-invalid');
		}
		if (email!="" && !mail_format.test(email)) {
			$("input[name='email']").addClass('is-invalid');
			$("input[name='email']").focus();
			return false;
		}  
		else 
		{
			$("input[name='email']").removeClass('is-invalid');
		}

		// For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_loan_provider', field : 'id', condition : 'name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(lpro_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_loan_provider', field : 'id', condition : 'phone="'+phone.trim()+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(ph_lang);
									$("input[name='phone']").addClass('is-invalid');
									$("input[name='phone']").focus();
									return false;
								}
								else {
									$("input[name='phone']").removeClass('is-invalid');

									$("#loanpForm").attr("action",base_url+"Common/db_add_update");
									$("#loanpForm").submit();
								}
							}
						});
					}
				}
			});
		}

		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_loan_provider', field : 'id', condition : 'name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(lpro_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_loan_provider', field : 'id', condition : 'phone="'+phone.trim()+'" AND id!="'+id+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(ph_lang);
									$("input[name='phone']").addClass('is-invalid');
									$("input[name='phone']").focus();
									return false;
								}
								else {
									$("input[name='phone']").removeClass('is-invalid');

									$("#loanpForm").attr("action",base_url+"Common/db_add_update");
									$("#loanpForm").submit(); 
								}
							}
						});
					}
				}
			});
		}
	});

	/*****************************************
	* Detail : Loan Bank Submit              *
	* Date   : 19-12-2020                    *
	*****************************************/
	$("#loan_bank_submit").click(function(e) {
		e.preventDefault();

		var id             = $("input[name='id']").val();
		var name           = $("input[name='name']").val();
		var phone          = $("input[name='phone']").val();
		var email          = $("input[name='email']").val();
		var mail_format    = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		if (name=="") {
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}
		else
		{
			$("input[name='name']").removeClass('is-invalid');
		}
		if (phone=="") {
			$("input[name='phone']").addClass('is-invalid');
			$("input[name='phone']").focus();
			return false;
		}
		else
		{
			$("input[name='phone']").removeClass('is-invalid');
		} 
		if (email!="" && !mail_format.test(email)) {
			$("input[name='email']").addClass('is-invalid');
			$("input[name='email']").focus();
			return false;
		}  
		else 
		{
			$("input[name='email']").removeClass('is-invalid');
		}

		// For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_loan_bank', field : 'id', condition : 'name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(bnk_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_loan_bank', field : 'id', condition : 'phone="'+phone.trim()+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(ph_lang);
									$("input[name='phone']").addClass('is-invalid');
									$("input[name='phone']").focus();
									return false;
								}
								else {
									$("input[name='phone']").removeClass('is-invalid');

									$("#loanbankForm").attr("action",base_url+"Common/db_add_update");
									$("#loanbankForm").submit();
								}
							}
						});
					}
				}
			});
		}

		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_loan_bank', field : 'id', condition : 'name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(bnk_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');
						
						$.ajax({
							dataType: 'text',
							type: 'post',
							data: { table : 'qfleet_loan_bank', field : 'id', condition : 'phone="'+phone.trim()+'" AND id!="'+id+'"' },
							url: base_url+'home/check_data_exist',
							success: function(data) {
								if (data > 0) {
									toastr.error(ph_lang);
									$("input[name='phone']").addClass('is-invalid');
									$("input[name='phone']").focus();
									return false;
								}
								else {
									$("input[name='phone']").removeClass('is-invalid');

									$("#loanbankForm").attr("action",base_url+"Common/db_add_update");
									$("#loanbankForm").submit();
								}
							}
						});
					}
				}
			});
		}
	});

	/*************************************
	* Detail : Loan Submit               *
	* Date   : 19-12-2020                *
	*************************************/
	$("#loan_submit").click(function(e) {
		e.preventDefault();

		var id          = $("input[name='id']").val();
		var vehicle     = $("#vehicle").val();
		var provider    = $("#provider").val();
		var bank        = $("#bank").val();
		var emi_amount  = $("input[name='emi_amount']").val();
		var emi_paydate = $("input[name='emipaydate']").val();

		if (vehicle == "") {
			$("#vehicle").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#vehicle").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (provider == null) {
			$("#provider").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#provider").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (bank == null) {
			$("#bank").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#bank").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (emi_amount == "") {
			$("input[name='emi_amount']").addClass('is-invalid');
			$("input[name='emi_amount']").focus();
			return false;
		}
		else
		{
			$("input[name='emi_amount']").removeClass('is-invalid');
		}
		if (emi_paydate == "") {
			$("input[name='emipaydate']").addClass('is-invalid');
			$("input[name='emipaydate']").focus();
			return false;
		}
		else
		{
			$("input[name='emipaydate']").removeClass('is-invalid');
		}

		/*//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_insurance', field : 'id', condition : 'vehicle="'+vehicle+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error("Vehicle Entry Already Exist.");
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#loanForm").attr("action",base_url+"Common/db_add_update");
						$("#loanForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_vehicle_insurance', field : 'id', condition : 'vehicle="'+vehicle+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error("Vehicle Entry Already Exist.");
						$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#loanForm").attr("action",base_url+"Common/db_add_update");
						$("#loanForm").submit();
					}
				}
			});
		}*/
		$("#loanForm").attr("action",base_url+"Common/db_add_update");
		$("#loanForm").submit();

	});

	/************************************
	* Detail : Fuel Type Submit         *
	* Date   : 21-12-2020               *
	************************************/
	$("#fueltyp_submit").click(function(e) {
		e.preventDefault();

		var id   = $("input[name='id']").val();
		var name = $("input[name='name']").val();
		
		if (name=="") {
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_fuel_type', field : 'id', condition : 'name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(ftp_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#fueltypForm").attr("action",base_url+"Common/db_add_update");
						$("#fueltypForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_fuel_type', field : 'id', condition : 'name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(ftp_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#fueltypForm").attr("action",base_url+"Common/db_add_update");
						$("#fueltypForm").submit();
					}
				}
			});
		}
			
	});

	/*************************************
	* Details : Add Fuel Submit          *
	* Date    : 23-12-2020               *
	*************************************/
	$("#fuel_submit").click(function(e) {
		e.preventDefault();

		var id       = $("input[name='id']").val();
		var date     = $("input[name='date']").val();
		var charge   = $("input[name='charge']").val();
		var vehicle  = $("#vehicle").val();
		var fueltype = $("#fueltype").val();
		var odometer = $("input[name='odometer']").val();

		if (vehicle == "") {
			$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (fueltype == "") {
			$('#fueltype').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#fueltype').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (date=="") 
		{   
			$("input[name='date']").addClass('is-invalid');
			$("input[name='date']").focus();
			return false;
		} 
		else 
		{
			$("input[name='date']").removeClass('is-invalid');
		}
		if (odometer=="") 
		{   
			$("input[name='odometer']").addClass('is-invalid');
			$("input[name='odometer']").focus();
			return false;
		} 
		else 
		{
			$("input[name='odometer']").removeClass('is-invalid');
		}
		if (charge=="") 
		{
			$("input[name='charge']").addClass('is-invalid');
			$("input[name='charge']").focus();
			return false;
		}  
		else
		{
			$("input[name='charge']").removeClass('is-invalid');  
		}

		$("#FuelForm").attr("action",base_url+"Common/db_add_update");
		$("#FuelForm").submit();
	});

	/***************************************
	* Detail : Service Type Submit         *
	* Date   : 26-12-2020                  *
	***************************************/
	$("#servtyp_submit").click(function(e) {
		e.preventDefault();

		var id   = $("input[name='id']").val();
		var name = $("input[name='name']").val();
		var date = $("input[name='service_date']").val();
	   
		if (name=="") 
		{
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		} 
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}
		/*if (date=="") 
		{
			$("input[name='service_date']").addClass('is-invalid');
			$("input[name='service_date']").focus();
			return false;
		}  
		else 
		{
			$("input[name='service_date']").removeClass('is-invalid');
		}*/

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_service_type', field : 'id', condition : 'name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(stp_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#servtypForm").attr("action",base_url+"Common/db_add_update");
						$("#servtypForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_service_type', field : 'id', condition : 'name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(stp_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#servtypForm").attr("action",base_url+"Common/db_add_update");
						$("#servtypForm").submit();
					}
				}
			});
		}

	});
	
	/**************************************
	* Detail : Service Details Submit     *
	* Date   : 26-12-2020                 *
	**************************************/
	$("#servdetail_submit").click(function(e) {
		e.preventDefault();

		var id          = $("input[name='id']").val();
		var name        = $("input[name='name']").val();
		var servicetype = $("#servtyp").val();

		if (servicetype == "") {
			$('#servtyp').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#servtyp').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (name=="") 
		{
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_service_detail', field : 'id', condition : 'servtyp="'+servicetype+'" AND name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(sna_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#servdetForm").attr("action",base_url+"Common/db_add_update");
						$("#servdetForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_service_detail', field : 'id', condition : 'servtyp="'+servicetype+'" AND name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(sna_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#servdetForm").attr("action",base_url+"Common/db_add_update");
						$("#servdetForm").submit();
					}
				}
			});
		}

	});




$("#makepay_submit").click(function(e) {
		e.preventDefault();
		var payment_to     	= $("#payment_to").val();
		var payment_from        = $("#payment_from").val();
		var paid_amount      = $("#paid_amount").val();
		var date  = $("#date").val(); 
		var payment_method        = $("#payment_method").val(); 

		if (payment_to == "") {
			$('#payment_to').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#payment_to').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (payment_from == "") {
			$('#payment_from').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#payment_from').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (paid_amount == "") {
			$("#paid_amount").addClass('is-invalid');
			$("#paid_amount").focus();
			return false;
		}
		else {
			$("#paid_amount").removeClass('is-invalid');
		}

		if (date == "") {
			$('#date').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#date').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		
		if (payment_method == "") {
			$('#payment_method').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#payment_method').next().find('.select2-selection').removeClass('select-dropdown-error');
		}

		$("#makepayForm").attr("action",base_url+"home/makepayment_submit");
		$("#makepayForm").submit();
	});

$("#makepaypurchase_submit").click(function(e) {
		e.preventDefault();
		var payment_to     	= $("#payment_to").val();
		var payment_from        = $("#payment_from").val();
		var paid_amount      = $("#paid_amount").val();
		var date  = $("#date").val(); 
		var payment_method        = $("#payment_method").val(); 

		if (payment_to == "") {
			$('#payment_to').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#payment_to').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (payment_from == "") {
			$('#payment_from').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#payment_from').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (paid_amount == "") {
			$("#paid_amount").addClass('is-invalid');
			$("#paid_amount").focus();
			return false;
		}
		else {
			$("#paid_amount").removeClass('is-invalid');
		}

		if (date == "") {
			$('#date').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#date').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		
		if (payment_method == "") {
			$('#payment_method').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#payment_method').next().find('.select2-selection').removeClass('select-dropdown-error');
		}

		$("#makepaypurchaseForm").attr("action",base_url+"home/makepayment_purchase_submit");
		$("#makepaypurchaseForm").submit();
	});

	/****************************************
	* Detail : New Service Submit           *
	* Date   : 28-12-2020                   *
	****************************************/
	$("#servnew_submit").click(function(e) {
		e.preventDefault();
		
		var id          = $("input[name='id']").val();
		var type     	= $("#suppliervendor_type").val();
		var name        = $("#srvvendor").val();
		var ledger      = $("#maintainance_ledger").val();
		var invoice_no  = $("#invoice_number").val(); 
		var mode        = $("#mode_of_operation").val(); // added on 26-02-2021
		var doneby      = $("#done").val();
		var date        = $("#doned").val();

		if (type == "") {
			$('#suppliervendor_type').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#suppliervendor_type').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (ledger == "") {
			$('#maintainance_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#maintainance_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (invoice_no == "") {
			$("#invoice_number").addClass('is-invalid');
			$("#invoice_number").focus();
			return false;
		}
		else {
			$("#invoice_number").removeClass('is-invalid');
		}
		if (mode == "") {
			$('#mode_of_operation').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#mode_of_operation').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		
		if (doneby == "") {
			$('#done').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#done').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (date == "") {
			$("#doned").addClass('is-invalid');
			$("#doned").focus();
			return false;
		}
		else {
			$("#doned").removeClass('is-invalid');
		}
		
		$("#servnewForm").attr("action",base_url+"Common/db_add_update");
		$("#servnewForm").submit();
	});

	/***********************************
	* Detail : Route Management        *
	* Date   : 24-12-2020              *
	***********************************/
	$("#route_submit").click(function(e) {
		e.preventDefault();

		var id        = $("input[name='id']").val();
		var name      = $("input[name='name']").val();
		var dlocation = $("input[name='dlocation']").val();
		var alocation = $("input[name='alocation']").val();
		var distance  = $("input[name='distance']").val();

		if (name=="") {
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}
		else {
			$("input[name='name']").removeClass('is-invalid');
		}
		if (dlocation=="") {
			$("input[name='dlocation']").addClass('is-invalid');
			$("input[name='dlocation']").focus();
			return false;
		}
		else {
			$("input[name='dlocation']").removeClass('is-invalid');
		}
		if (alocation=="") {
			$("input[name='alocation']").addClass('is-invalid');
			$("input[name='alocation']").focus();
			return false;
		}
		else {
			$("input[name='alocation']").removeClass('is-invalid');
		}
		if (distance=="") {
			$("input[name='distance']").addClass('is-invalid');
			$("input[name='distance']").focus();
			return false;
		}
		else {
			$("input[name='distance']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_route', field : 'id', condition : 'name="'+name.trim()+'" AND dlocation="'+dlocation.trim()+'" AND alocation="'+alocation.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error("Route Entry Already Exist.");
						return false;
					}
					else {
						$("#RouteForm").attr("action",base_url+"Common/db_add_update");
						$("#RouteForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_route', field : 'id', condition : 'name="'+name.trim()+'" AND dlocation="'+dlocation.trim()+'" AND alocation="'+alocation.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error("Route Entry Already Exist.");
						return false;
					}
					else {
						$("#RouteForm").attr("action",base_url+"Common/db_add_update");
						$("#RouteForm").submit();
					}
				}
			});
		}

	});

	/************************************
	* Detail : Trip Management Submit   *
	* Date   : 24-12-2020               *
	************************************/
	$("#tripppp_submit").click(function() {
		var id           = $("input[name='id']").val();
		var single       = $("input[name='single']").val();
		var round        = $("input[name='round']").val();
		var vehicletype  = $("#vehitype").val();
		var route        = $("#route").val();
		var basekm       = $("input[name='base_km']").val();
		var add_rate     = $("input[name='addrate']").val();

		if (vehicletype=="") {
			$('#vehitype').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#vehitype').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (route=="") {
			$("#route").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#route").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (basekm=="") {
			$("input[name='base_km']").addClass('is-invalid');
			$("input[name='base_km']").focus();
			return false;
		}
		else {
			$("input[name='base_km']").removeClass('is-invalid');
		}
		if (add_rate=="") {
			$("input[name='addrate']").addClass('is-invalid');
			$("input[name='addrate']").focus();
			return false;
		}
		else {
			$("input[name='addrate']").removeClass('is-invalid');
		}
		if (single=="") {
			$("input[name='single']").addClass('is-invalid');
			$("input[name='single']").focus();
			return false;
		}
		else {
			$("input[name='single']").removeClass('is-invalid');
		}
		if (round=="") {
			$("input[name='round']").addClass('is-invalid');
			$("input[name='round']").focus();
			return false;
		}
		else {
			$("input[name='round']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_trip_management', field : 'id', condition : 'v_typeid="'+vehicletype+'" AND route="'+route+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(trp_lang);
						$('#vehitype').next().find('.select2-selection').addClass('select-dropdown-error');
						$("#route").next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehitype').next().find('.select2-selection').removeClass('select-dropdown-error');
						$("#route").next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#tripppForm").attr("action",base_url+"Common/db_add_update");
						$("#tripppForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_trip_management', field : 'id', condition : 'v_typeid="'+vehicletype+'" AND route="'+route+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(trp_lang);
						$('#vehitype').next().find('.select2-selection').addClass('select-dropdown-error');
						$("#route").next().find('.select2-selection').addClass('select-dropdown-error');
						return false;
					}
					else {
						$('#vehitype').next().find('.select2-selection').removeClass('select-dropdown-error');
						$("#route").next().find('.select2-selection').removeClass('select-dropdown-error');

						$("#tripppForm").attr("action",base_url+"Common/db_add_update");
						$("#tripppForm").submit();
					}
				}
			});
		}

	});

	/*************************************
	* Detail : Expense Category Submit   *
	* Date   : 30-12-2020                *
	*************************************/
	$("#xcat_submit").click(function(e) {
		e.preventDefault();

		var id   = $("input[name='id']").val();
		var name = $("input[name='name']").val();

		if (name=="") {
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_xcat', field : 'id', condition : 'name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(xctg_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#xcatForm").attr("action",base_url+"Common/db_add_update");
						$("#xcatForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_xcat', field : 'id', condition : 'name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(xctg_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#xcatForm").attr("action",base_url+"Common/db_add_update");
						$("#xcatForm").submit();
					}
				}
			});
		}

	});

	/************************************
	* Detail : Expense Head Submit      *
	* Date   : 30-12-2020               *
	************************************/
	$("#xhead_submit").click(function(e) {
		e.preventDefault();

		var id       = $("input[name='id']").val();
		var cost_ctg = $("#xcat").val();
		var name     = $("input[name='name']").val();

		if (cost_ctg == "") {
			$('#xcat').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#xcat').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (name=="") {
			$("input[name='name']").addClass('is-invalid');
			$("input[name='name']").focus();
			return false;
		}
		else 
		{
			$("input[name='name']").removeClass('is-invalid');
		}

		//For Add
		if (id == '') {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_xhead', field : 'id', condition : 'xcat="'+cost_ctg+'" AND name="'+name.trim()+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(xhead_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#xheadForm").attr("action",base_url+"Common/db_add_update");
						$("#xheadForm").submit();
					}
				}
			});
		}
		// For Edit
		else {
			$.ajax({
				dataType: 'text',
				type: 'post',
				data: { table : 'qfleet_xhead', field : 'id', condition : 'xcat="'+cost_ctg+'" AND name="'+name.trim()+'" AND id!="'+id+'"' },
				url: base_url+'home/check_data_exist',
				success: function(data) {
					if (data > 0) {
						toastr.error(xhead_lang);
						$("input[name='name']").addClass('is-invalid');
						$("input[name='name']").focus();
						return false;
					}
					else {
						$("input[name='name']").removeClass('is-invalid');

						$("#xheadForm").attr("action",base_url+"Common/db_add_update");
						$("#xheadForm").submit();
					}
				}
			});
		}
	
	});

	/**************************************
	* Detail : Add Expense Submit         *
	* Date   : 30-12-2020                 *
	**************************************/
	$("#expense_submit").click(function(e) {
		e.preventDefault();

		var date   = $("input[name='date']").val();
		var amount = $("input[name='amount']").val();

		if (date=="") {
			$("input[name='date']").addClass('is-invalid');
			$("input[name='date']").focus();
			return false;
		}
		else
		{
			$("input[name='date']").removeClass('is-invalid');
		} 
		if (amount=="") {
			$("input[name='amount']").addClass('is-invalid');
			$("input[name='amount']").focus();
			return false;
		} 
		else
		{
			$("input[name='amount']").removeClass('is-invalid');
		}

		$("#expenseForm").attr("action",base_url+"Common/db_add_update");
		$("#expenseForm").submit();
	});

	/****************************************
	* Details : Vehicle Status Assign Submit*
	* Date    : 30-12-2020                  *
	****************************************/
	$("#vstatusassignsubmit").click(function(e) {
		e.preventDefault();

		/*var id          = $("input[name='id']").val();
		var vehicle     = $("#vehicle").val();
		var status      = $("#vehstatus").val();
		var availstatus = $("#avail_status").val();

		if (vehicle == "") {
			$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (status == "") {
			$('#vehstatus').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#vehstatus').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (availstatus == "") {
			$('#avail_status').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#avail_status').next().find('.select2-selection').removeClass('select-dropdown-error');
		}*/

		$("#vstatusassignForm").attr("action",base_url+"Common/db_add_update");
		$("#vstatusassignForm").submit();
	});

	/**************************************
	* Detail : Vehicle Assign Submit      *
	* Date   : 31-12-2020                 *
	**************************************/
	$("#vehicleassignsubmit").click(function(e) {
		e.preventDefault();

		var branch     = $("#branch").val();
		var department = $("#department").val();
		var employee   = $("#employee").val();
		var vehicle    = $("#vehicle").val();
		var date       = $("input[name='date']").val();
	  
		if (branch == "") {
			$('#branch').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#branch').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (department == "") {
			$('#department').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#department').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (employee == "") {
			$('#employee').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#employee').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (vehicle == "") {
			$('#vehicle').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#vehicle').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (date=="") {
			$("input[name='date']").addClass('is-invalid');
			$("input[name='date']").focus();
			return false;
		}
		else 
		{
			$("input[name='date']").removeClass('is-invalid');
		}

		$("#vehicleassignForm").attr("action",base_url+"Common/db_add_update");
		$("#vehicleassignForm").submit();
	});

	/************************************
	* Detail : Vehicle Retrieve Submit  *
	* Date   : 4-1-2020                 *
	************************************/
	$("#vehicleretrievesubmit").click(function() {
		var status = $("#status").val();
		var date   = $("input[name='date']").val();

		 if (status == "") {
			$('#status').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#status').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (date == "") {
			$("input[name='date']").addClass('is-invalid');
			$("input[name='date']").focus();
			return false;
		}
		else 
		{
			$("input[name='date']").removeClass('is-invalid');
		}
		
		$("#vehicleretrieveForm").attr("action",base_url+"Common/db_add_update");
		$("#vehicleretrieveForm").submit();
	});

	/************************************
	* Detail : Service Report Submit    *
	* Date   : 27-02-2021               *
	************************************/
	$("#servreport_submit").click(function(e) {
		e.preventDefault();
		var vehicle = $("#srvrep_vehicle").val();
		var fromdt  = $("input[name='frm_date']").val();
		var todt    = $("input[name='to_date']").val();
		var srvtype = $("#srvrep_srvtype").val();
		
		if (vehicle == "" || vehicle == null) 
		{
			$("#srvrep_vehicle").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		} 
		else
		{
			$("#srvrep_vehicle").next().find('.select2-selection').removeClass('select-dropdown-error');

			var htmlstr = '';

	        $.ajax({
	            dataType: 'json',
	            type: 'post',
	            data: { veh : vehicle, from_dt : fromdt, to_dt : todt, serv_type : srvtype},
	            url: base_url+'home/getreport_servicehist',
	            cache: false,
	            success: function (data) {

	                // Service History
	                $.each(data[1], function(index,srvhist) {
	                    var srvdate = '';

	                    if (srvhist.doned != '' && srvhist.doned != "0000-00-00") {
	                        srvdate = ctm2_formatDate(srvhist.doned);
	                    }
	                    else {
	                        srvdate = " ";
	                    }

	                    var done_by = '';

	                    if (srvhist.doneby == 1) {
	                        done_by = "Company";
	                    }
	                    else if (srvhist.doneby == 2) {
	                        done_by = "Outside";
	                    }
	                    
	                    htmlstr += '<div class="row">\
	                    <div class="col-12">\
	                    <div class="dropdown m-5 float-right">\
					    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">\
					    <i class="fa fa-download">Download</i>\
					    </button>\
					    <div class="dropdown-menu dropdown-menu-right">\
					    <a class="dropdown-item" href="'+base_url+'home/servicepdf?id=' + srvhist.vehicle +'">\
					    <span class="kt-nav__link-text" ><i class="fa fa-file">\
						</i> \
						Service Report</span>\
						</span></a>\
					    <a class="dropdown-item" href="'+base_url+'home/costreport?id=' + srvhist.vehicle +'">\
					    <span class="kt-nav__link-text" ><i class="fa fa-file">\
						</i> \
						Cost Report</span>\
						</span></a>\
					    </div>\
					    </div></div>\
						<div class="col-12">\
	                    <div class="kt-timeline-v2">\
	                                    <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">\
	                                      <div class="kt-timeline-v2__item">\
	                                        <span class="kt-timeline-v2__item-time" style="margin-left: -17%;">'+srvdate+'</span>\
	                                        <div class="kt-timeline-v2__item-cricle">\
	                                          <i class="fa fa-genderless kt-font-warning"></i>\
	                                        </div>\
	                                        <div class="kt-timeline-v2__item-text kt-padding-top-5">\
	                                          '+srvhist.name+' ('+srvhist.license+')<br>\
	                                          Service Type    : '+srvhist.servicetype+'<br>\
	                                          Service Details : '+srvhist.srvdetail+'<br>\
	                                          Vendor          : '+srvhist.vendor+'<br>\
	                                          Done By         : '+done_by+'<br>\
	                                          Service Amount  : '+srvhist.service_amount+'<br>\
	                                          Odometer        : '+srvhist.odometer+'\
	                                        </div>\
	                                      </div>\
	                                    </div>\
	                                </div></div><div>';
	                });

	                $("#service_history").html(htmlstr);

	            }
	        });
		}

	});


	// ************ End  :: Add / Edit Submits **********

}); // End  :: DOM

/************ Begin :: Add / Edit Modal ************/

// Driver Add
$("#driver_ADD").click(function() {
	$("#driverModal").modal({backdrop: 'static'});
	$("#driverModal").load(base_url+'home/driverModal');
	$(".modal-backdrop").show();
	$('#driverModal').show();
});

// Driver Edit
function drivereditingFun(id) {
   $("#driverModal").modal({backdrop: 'static'});
   $("#driverModal").load(base_url+'home/driverModal?id='+id);
   $(".modal-backdrop").show();
   $('#driverModal').show();
}

// Vendor Add
$("#vendor_ADD").click(function() {
    $("#vendorModal").modal({backdrop: 'static'});
    $("#vendorModal").load(base_url+'home/vendorModal');
    $(".modal-backdrop").show();
    $('#vendorModal').show();
});

// Vendor Edit
function vendoreditingFun(id) {
   	$("#vendorModal").modal({backdrop: 'static'});
   	$("#vendorModal").load(base_url+'home/vendorModal?id='+id);
   	$(".modal-backdrop").show();
    $('#vendorModal').show();
}

// Supplier Add
$("#supplier_ADD").click(function() {
    $("#supplierModal").modal({backdrop: 'static'});
    $("#supplierModal").load(base_url+'home/supplr_Modal');
    $(".modal-backdrop").show();
    $('#supplierModal').show();
});

// Supplier Edit
function supplreditingFun(id) {
   	$("#supplierModal").modal({backdrop: 'static'});
   	$("#supplierModal").load(base_url+'home/supplr_Modal?id='+id);
   	$(".modal-backdrop").show();
    $('#supplierModal').show();
}

// Vehicle Category Add
$("#vcat_Add").click(function() {
	$("#vcat_modal").modal({backdrop: 'static'});
	$("#vcat_modal").load(base_url+'home/vcatModal');
	$(".modal-backdrop").show();
	$('#vcat_modal').show();
});

// Vehicle Category Edit
function vcateditingFun(id) {
   $("#vcat_modal").modal({backdrop: 'static'});
   $("#vcat_modal").load(base_url+'home/vcatModal?id='+id);
   $(".modal-backdrop").show();
   $('#vcat_modal').show();
}

// Vehicle Type Add
$("#vtype_Add").click(function() {
	$("#vtype_modal").modal({backdrop: 'static'});
	$("#vtype_modal").load(base_url+'home/vtypeModal');
	$(".modal-backdrop").show();
	$('#vtype_modal').show();
});

// Vehicle Type Edit
function vtypeeditingFun(id) {
   $("#vtype_modal").modal({backdrop: 'static'});
   $("#vtype_modal").load(base_url+'home/vtypeModal?id='+id);
   $(".modal-backdrop").show();
   $('#vtype_modal').show();
}

// Vehicle Add
$("#vehicle_Add").click(function() {
	$("#vehicle_modal").modal({backdrop: 'static'});
	$("#vehicle_modal").load(base_url+'home/vehiclemodal');
	$(".modal-backdrop").show();
	$('#vehicle_modal').show();
});

// Vehicle Edit
function vehicleeditingFun(id) {
   $("#vehicle_modal").modal({backdrop: 'static'});
   $("#vehicle_modal").load(base_url+'home/vehiclemodal?id='+id);
   $(".modal-backdrop").show();
   $('#vehicle_modal').show();
}

// Insurance Provider Add
$("#insprov_Add").click(function() {
	$("#insproviModal").modal({backdrop: 'static'});
	$("#insproviModal").load(base_url+'home/insproviModal');
	$(".modal-backdrop").show();
	$('#insproviModal').show();
});

// Insurance Provider Edit
function insuranceproveditingFun(id) {
   $("#insproviModal").modal({backdrop: 'static'});
   $("#insproviModal").load(base_url+'home/insproviModal?id='+id);
   $(".modal-backdrop").show();
   $('#insproviModal').show();
}

// Insurance Name Add
$("#insname_Add").click(function() {
	$("#insnameModal").modal({backdrop: 'static'});
	$("#insnameModal").load(base_url+'home/insnameModal');
	$(".modal-backdrop").show();
	$('#insnameModal').show();
});

// Insurance Name Edit
function insnameeditingFun(id) {
	$("#insnameModal").modal({backdrop: 'static'});
	$("#insnameModal").load(base_url+'home/insnameModal?id='+id);
	$(".modal-backdrop").show();
	$('#insnameModal').show();
}

// Insurance Type Add
$("#instyp_Add").click(function() {
	$("#instypeModal").modal({backdrop: 'static'});
	$("#instypeModal").load(base_url+'home/instypeModal');
	$(".modal-backdrop").show();
	$('#instypeModal').show();
});

// Insurance Type Edit
function insntypeeditingFun(id) {
	$("#instypeModal").modal({backdrop: 'static'});
	$("#instypeModal").load(base_url+'home/instypeModal?id='+id);
	$(".modal-backdrop").show();
	$('#instypeModal').show();
}

// General Info Add
$("#g_info_Add").click(function() {
	$("#g_info_modal").modal({backdrop: 'static'});
	$("#g_info_modal").load(base_url+'home/g_info_modal');
	$(".modal-backdrop").show();
	$('#g_info_modal').show();
});

// General Info Edit
function ginfoeditingFun(id) {
	$("#g_info_modal").modal({backdrop: 'static'});
	$("#g_info_modal").load(base_url+'home/g_info_modal?id='+id);
	$(".modal-backdrop").show();
	$('#g_info_modal').show();
}

// Vehicle Insurance Add
$("#insr_Add").click(function() {
	$("#insurance_modal").modal({backdrop: 'static'});
	$("#insurance_modal").load(base_url+'home/insurance_modal');
	$(".modal-backdrop").show();
	$('#insurance_modal').show();
});

// Vehicle Insurance Edit
function vinsueditingFun(id) {
	$("#insurance_modal").modal({backdrop: 'static'});
	$("#insurance_modal").load(base_url+'home/insurance_modal?id='+id+'&&pg=2');
	$(".modal-backdrop").show();
	$('#insurance_modal').show();
}

// Vehicle Estimara Add
$("#estimara_Add").click(function() {
	$("#estimara_modal").modal({backdrop: 'static'});
	$("#estimara_modal").load(base_url+'home/estimara_modal');
	$(".modal-backdrop").show();
	$('#estimara_modal').show();
});

// Vehicle Estimara Edit
function estimaraeditingFun(id) {
	$("#estimara_modal").modal({backdrop: 'static'});
	$("#estimara_modal").load(base_url+'home/estimara_modal?id='+id+'&&pg=2');
	$(".modal-backdrop").show();
	$('#estimara_modal').show();
}

// Other Document Add
$("#othdoc_Add").click(function() {
	$("#odoc_modal").modal({backdrop: 'static'});
	$("#odoc_modal").load(base_url+'home/otherdocvechi_modal');
	$(".modal-backdrop").show();
	$('#odoc_modal').show();
});

// Other Document Edit
function vehiotherdoceditFun(id) {
	$("#odoc_modal").modal({backdrop: 'static'});
	$("#odoc_modal").load(base_url+'home/otherdocvechi_modal?id='+id+'&&pg=2');
	$(".modal-backdrop").show();
	$('#odoc_modal').show();
}

// Additional Details Add
$("#vehicleaddd_Addnew").click(function() {
	$("#additional_modal").modal({backdrop: 'static'});
	$("#additional_modal").load(base_url+'home/additional_modal');
	$(".modal-backdrop").show();
	$('#additional_modal').show();
});

// Additional Details Edit
function vehicleaditionaldoceditingFun(id) {
	$("#additional_modal").modal({backdrop: 'static'});
	$("#additional_modal").load(base_url+'home/additional_modal?id='+id);
	$(".modal-backdrop").show();
	$('#additional_modal').show();
}

// Engine Details Add
$("#engine_Add").click(function() {
	$("#engine_modal").modal({backdrop: 'static'});
	$("#engine_modal").load(base_url+'home/enginevechi_modal');
	$(".modal-backdrop").show();
	$('#engine_modal').show();
});

// Engine Details Edit
function vehiengineeditFun(id) {
	$("#engine_modal").modal({backdrop: 'static'});
	$("#engine_modal").load(base_url+'home/enginevechi_modal?id='+id);
	$(".modal-backdrop").show();
	$('#engine_modal').show();
}

// Owner Details Add
$("#vowner_Add").click(function() {
	$("#owner_modal").modal({backdrop: 'static'});
	$("#owner_modal").load(base_url+'home/vehicleowner_modal');
	$(".modal-backdrop").show();
	$('#owner_modal').show();
});

// Owner Details Edit
function vehiownereditFun(id) {
	$("#owner_modal").modal({backdrop: 'static'});
	$("#owner_modal").load(base_url+'home/vehicleowner_modal?id='+id);
	$(".modal-backdrop").show();
	$('#owner_modal').show();
}

// Contractor Add
$("#contractor_Add").click(function() {
	$("#contractor_modal").modal({backdrop: 'static'});
	$("#contractor_modal").load(base_url+'home/contractorModal');
	$(".modal-backdrop").show();
	$('#contractor_modal').show();
}); 

// Contractor Edit
function contractor_editingFun(id) {
	$("#contractor_modal").modal({backdrop: 'static'});
	$("#contractor_modal").load(base_url+'home/contractorModal?id='+id);
	$(".modal-backdrop").show();
	$('#contractor_modal').show();
}

// Contract Add
// 22-05-2020
$("#contract_Add").click(function() {
	$("#contract_modal").modal({backdrop: 'static'});
	$("#contract_modal").load(base_url+'home/contractModal');
	$(".modal-backdrop").show();
	$('#contract_modal').show();
});

// Contract Edit
// 22-05-2020
function contracttttt_editingFun(id) {
	$("#contract_modal").modal({backdrop: 'static'});
	$("#contract_modal").load(base_url+'home/contractModal?id='+id+'&&pg=2');
	$(".modal-backdrop").show();
	$('#contract_modal').show();
}

// Loan Provider Add
//22-05-2020
$("#loan_new_Add").click(function() {
	$("#loanModal").modal({backdrop: 'static'});
	$("#loanModal").load(base_url+'home/lons_provider_modal');
	$(".modal-backdrop").show();
	$('#loanModal').show();
});

/************************************
* Detail : Loan Provider Edit       *
* Date   : 22-05-2020               *
************************************/
function loanprovieditFun(id) {
	$("#loanModal").modal({backdrop: 'static'});
	$("#loanModal").load(base_url+'home/lons_provider_modal?id='+id);
	$(".modal-backdrop").show();
	$('#loanModal').show();
}

/************************************
* Detail : Loan Provider View       *
* Date   : 22-05-2020               *
************************************/
function loanprovieditFunv(id) {
	$("#loanModal").modal({backdrop: 'static'});
	$("#loanModal").load(base_url+'home/lons_provider_modalv?id='+id);
	$(".modal-backdrop").show();
	$('#loanModal').show();
}

// Loan Bank Add
//22-05-2020
$("#loan_bank_Add").click(function() {
	$("#loanModal").modal({backdrop: 'static'});
	$("#loanModal").load(base_url+'home/lons_bank_modal');
	$(".modal-backdrop").show();
	$('#loanModal').show();
});

/********************************
* Detail : Loan Bank Edit       *
* Date   : 22-05-2020           *
********************************/
function loanbankeditFun(id) {
	$("#loanModal").modal({backdrop: 'static'});
	$("#loanModal").load(base_url+'home/lons_bank_modal?id='+id);
	$(".modal-backdrop").show();
	$('#loanModal').show();
}

/********************************
* Detail : Loan Bank View       *
* Date   : 22-05-2020           *
********************************/
function loanbankeditFunv(id) {
	$("#loanModal").modal({backdrop: 'static'});
	$("#loanModal").load(base_url+'home/lons_bank_modalv?id='+id);
	$(".modal-backdrop").show();
	$('#loanModal').show();
}

// Loan Add
// 22-05-2020
$("#loan_Add").click(function() {
	$("#loanModal").modal({backdrop: 'static'});
	$("#loanModal").load(base_url+'home/lonsnew_modal');
	$(".modal-backdrop").show();
	$('#loanModal').show();
});

// Loan Edit
// 22-05-2020
function loaneditFun(id) {
	$("#loanModal").modal({backdrop: 'static'});
	$("#loanModal").load(base_url+'home/lonsnew_modal?id='+id);
	$(".modal-backdrop").show();
	$('#loanModal').show();
}

// Fuel Type Add
$("#fueltype_Add").click(function() {
	$("#fuelypeModal").modal({backdrop: 'static'});
	$("#fuelypeModal").load(base_url+'home/fuelc_modal');
	$(".modal-backdrop").show();
	$('#fuelypeModal').show();
});

// Fuel Type Edit
function fueltypeeditFun(id) {
	$("#fuelypeModal").modal({backdrop: 'static'});
	$("#fuelypeModal").load(base_url+'home/fuelc_modal?id='+id);
	$(".modal-backdrop").show();
	$('#fuelypeModal').show();
}

/***************************************
* Detail : Fuel Add                    * 
* Date   : 23-12-2020                  *
***************************************/
/*$("#fuel_Add").click(function() {
	$("#fuelModal").modal({backdrop: 'static'});
	$("#fuelModal").load(base_url+'home/fuel_modal');
	$(".modal-backdrop").show();
	$('#fuelModal').show();
});*/

$("#fuel_Add").click(function() {
	window.location.href = base_url+'home/fuel_modal';
});

/************************************
* Detail : Fuel Edit                *
* Date   : 23-12-2020               *
************************************/
/*function fueleditFun(id) {
   $("#fuelModal").modal({backdrop: 'static'});
   $("#fuelModal").load(base_url+'home/fuel_modal?id='+id);
   $(".modal-backdrop").show();
   $('#fuelModal').show();
}*/

function fueleditFun(id) {
   window.location.href = base_url+'home/fuel_modal?id='+id;
}

// Service Type Add
$("#servtype_Add").click(function() {
	$("#servtypeModal").modal({backdrop: 'static'});
	$("#servtypeModal").load(base_url+'home/servtype_modal');
	$(".modal-backdrop").show();
	$('#servtypeModal').show();
});

// Service Type Edit
function servtypeditFun(id) {
	$("#servtypeModal").modal({backdrop: 'static'});
	$("#servtypeModal").load(base_url+'home/servtype_modal?id='+id);
	$(".modal-backdrop").show();
	$('#servtypeModal').show();
}

// Service Details Add
$("#servdet_Add").click(function() {
	$("#servdet_modal").modal({backdrop: 'static'});
	$("#servdet_modal").load(base_url+'home/servdet_modal');
	$(".modal-backdrop").show();
	$('#servdet_modal').show();
});

// Service Details Edit
function servdetaileditFun(id) {
	$("#servdet_modal").modal({backdrop: 'static'});
	$("#servdet_modal").load(base_url+'home/servdet_modal?id='+id);
	$(".modal-backdrop").show();
	$('#servdet_modal').show();
}

/**********************************
* Detail : Service Add            *
* Date   : 28-12-2020             *
**********************************/
/*$("#servnew_Add").click(function() {
	$("#servnew_modal").modal({backdrop: 'static'});
	$("#servnew_modal").load(base_url+'home/servnew_modal');
	$(".modal-backdrop").show();
	$('#servnew_modal').show();
});*/

$("#servnew_Add").click(function() {
	window.location.href = base_url+'home/servnew_modal';
});

// Service Edit
/**************************************
* Detail : New Service Edit           *
* Date   : 28-12-2020                 *
**************************************/
/*function servneweditFun(id) {
   $("#servnew_modal").modal({backdrop: 'static'});
   $("#servnew_modal").load(base_url+'home/servnew_modal?id='+id);
   $(".modal-backdrop").show();
   $('#servnew_modal').show();
}*/

function servneweditFun(id) {
   window.location.href = base_url+'home/servnew_modal_edit?id='+id+'&&pg=2';
}

// Route Add
$("#route_Add").click(function() {
	$("#routeModal").modal({backdrop: 'static'});
	$("#routeModal").load(base_url+'home/routeModal');
	$(".modal-backdrop").show();
	$('#routeModal').show();
});

// Route Edit
function routeeditFun(id) {
	$("#routeModal").modal({backdrop: 'static'});
	$("#routeModal").load(base_url+'home/routeModal?id='+id);
	$(".modal-backdrop").show();
	$('#routeModal').show();
}

/********************************
* Detail : Trip Add             *
* Date   : 15-12-2020           *
********************************/
$("#trippp_Add").click(function() {
	$("#tripmanModal").modal({backdrop: 'static'});
	$("#tripmanModal").load(base_url+'home/tripmanModal');
	$(".modal-backdrop").show();
	$('#tripmanModal').show();
});

// Trip Edit
function tripeditFun(id) {
	$("#tripmanModal").modal({backdrop: 'static'});
	$("#tripmanModal").load(base_url+'home/tripmanModal?id='+id);
	$(".modal-backdrop").show();
	$('#tripmanModal').show();
}

// Expense Category Add
// 22-05-2020
$("#xcat_Add").click(function() {
	$("#xcatModal").modal({backdrop: 'static'});
	$("#xcatModal").load(base_url+'home/xcatModal');
	$(".modal-backdrop").show();
	$('#xcatModal').show();
});

// Expense Category Edit
// 22-05-2020
function xcateditFun(id) {
	$("#xcatModal").modal({backdrop: 'static'});
	$("#xcatModal").load(base_url+'home/xcatModal?id='+id);
	$(".modal-backdrop").show();
	$('#xcatModal').show();
}

// Expense Head Add
// 22-05-2020
$("#xhead_Add").click(function() {
	$("#xheadModal").modal({backdrop: 'static'});
	$("#xheadModal").load(base_url+'home/xheadModal');
	$(".modal-backdrop").show();
	$('#xheadModal').show();
});

// Expense Head Edit
// 22-05-2020
function xheadeditFun(id) {
	$("#xheadModal").modal({backdrop: 'static'});
	$("#xheadModal").load(base_url+'home/xheadModal?id='+id);
	$(".modal-backdrop").show();
	$('#xheadModal').show();
}

// Expense Add
// 23-05-2020
$("#expense_Add").click(function() {
	$("#expensedModal").modal({backdrop: 'static'});
	$("#expensedModal").load(base_url+'home/expensedModal');
	$(".modal-backdrop").show();
	$('#expensedModal').show();
});

// Expense Edit
// 23-05-2020
function expenseeditFun(id) {
	$("#expensedModal").modal({backdrop: 'static'});
	$("#expensedModal").load(base_url+'home/expensedModal?id='+id);
	$(".modal-backdrop").show();
	$('#expensedModal').show();
}

/************************************
* Detail : Add Vehicle Status Assign*
* Date   : 30-12-2020               *
************************************/
/*$("#vstatus_assignAdd").click(function() {
	$("#vstatusassign_modal").modal({backdrop: 'static'});
	$("#vstatusassign_modal").load(base_url+'home/vstatusassignModal');
	$(".modal-backdrop").show();
	$('#vstatusassign_modal').show();
});*/

/***************************************
* Detail : Vehicle Status Assign Update*
* Date   : 30-12-2020                  *
***************************************/
function vstatusassign_editingFun(id) {
	$("#vstatusassign_modal").modal({backdrop: 'static'});
	$("#vstatusassign_modal").load(base_url+'home/vstatusassignModal?id='+id);
	$(".modal-backdrop").show();
	$('#vstatusassign_modal').show();
}

/********************************
* Detail : Vehicle Assign Add   *
********************************/
$("#vehicle_assign_Add").click(function() {
	$("#vehicle_assign_modal").modal({backdrop: 'static'});
	$("#vehicle_assign_modal").load(base_url+'home/vehicleassignModal');
	$(".modal-backdrop").show();
	$('#vehicle_assign_modal').show();
});

/********************************
* Detail : Vehicle Assign Edit  *
* Date   : 31-12-2020           *
********************************/
function vehicle_assign_editingFun(id) {
	$("#vehicle_assign_modal").modal({backdrop: 'static'});
	$("#vehicle_assign_modal").load(base_url+'home/vehicleassignModal?id='+id);
	$(".modal-backdrop").show();
	$('#vehicle_assign_modal').show();
}

/**********************************
* Detail : Vehicle Retrieve       *
**********************************/
function vehicle_retrieve_Fun(id, veh_id) {
   $("#vehicle_retrieve_modal").modal({backdrop: 'static'});
   $("#vehicle_retrieve_modal").load(base_url+'home/vehicleretrieveModal?id='+id+'&&vehid='+veh_id);
   $(".modal-backdrop").show();
   $('#vehicle_retrieve_modal').show();
}

/************************************
* Detail : Suppliers Make Payment   *
* Date   : 16-03-2021               *
************************************/
$("#makepayment").click(function() {
	window.location.href = base_url+'home/supplrmake_payment';
});

/***********************************
* Details : Parts Allocation Add   *
* Date    : 16-03-2020             *
***********************************/
$("#partsallocn_Add").click(function() {
	$("#parts_allocnModal").modal({backdrop: 'static'});
	$("#parts_allocnModal").load(base_url+'home/partsallocn_modal');
	$(".modal-backdrop").show();
	$('#parts_allocnModal').show();
});

/***********************************
* Detail : Purchase Edit           * 
* Date   : 18-03-2021              *
***********************************/
function purchaseeditingFun(id) {
   window.location.href = base_url+'home/purchase_add?id='+id;
}

/************ End   :: Add / Edit Modal ************/

// *************** Begin :: DELETE ***************

// Driver Delete
function driverDeleteFn(id) {
	var tbl  = 'qfleet_driver';
	var url  = 'driver';
	var mssg = 'driver';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					driver_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Driver Restore
function driverrestore(id) {
	var tbl  = 'qfleet_driver';
	var url  = 'driver';
	var mssg = 'driver';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id,table:tbl},
				success: function(data) {
                    window.location.href="driver";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Vendor Delete
function vendorDeleteFn(id) {
	var tbl  = 'qfleet_vendor';
	var url  = 'vendor';
	var mssg = 'vendor';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					vendor_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}

// Vendor Restore
function vendorrestore(id) {
	var tbl  = 'qfleet_vendor';
	var url  = 'vendor';
	var mssg = 'vendor';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id,table:tbl},
				success: function(data) {

                    window.location.href="vendor";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}

// Supplier Delete
function supplrDeleteFn(id) {
	var tbl  = 'qfleet_supplier';
	var url  = 'supplier';
	var mssg = 'supplier';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					supplr_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}

// Vendor Restore
function vendorrestore(id) {
	var tbl  = 'qfleet_supplier';
	var url  = 'supplier';
	var mssg = 'supplier';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id,table:tbl},
				success: function(data) {

                    window.location.href="supplier";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}

// Vehicle Category Delete
function vehicatDeleteFn(id) {
	var tbl  = 'qfleet_vcat';
	var url  = 'vehiclecategory';
	var mssg = 'vehiclecategory';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					vcateg_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}
// Vehicle Category Restore
function vcategoryrestore(id) {
	var tbl  = 'qfleet_vcat';
	var url  = 'vehiclecategory';
	var mssg = 'vehiclecategory';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="vehiclecategory";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Vehicle Type Delete
function vtypeDeleteFn(id) {
	var tbl  = 'qfleet_vtype';
	var url  = 'vehicle_Type';
	var mssg = 'vtype';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					vtype_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
		});

}
// Vehicle type Restore
function vehtyperestore(id) {
	var tbl  = 'qfleet_vtype';
	var url  = 'vehicle_Type';
	var mssg = 'vtype';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="vehicle_Type";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}


// Vehicle Delete
function vehicleDeleteFn(id) {
	var tbl  = 'qfleet_vehicle';
	var url  = 'vehicle';
	var mssg = 'vehicle';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					vehicle_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
	
}
// Vehicle  Restore
function vehiclerestores(id) {
	var tbl  = 'qfleet_vehicle';
	var url  = 'vehicle';
	var mssg = 'vehicle';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="vehicle";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}


// Insurance Provider Delete
function insproviderDeleteFn(id) {
	var tbl  = 'qfleet_insurance_provider';
	var url  = 'Insurance_provider';
	var mssg = 'Insurance_provider';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					insrcprov_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
		});
}
// insurance provider  Restore
function insuranceproviderrestore(id) {
	var tbl  = 'qfleet_insurance_provider';
	var url  = 'Insurance_provider';
	var mssg = 'Insurance_provider';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="Insurance_provider";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}


// Insurance Name Delete
function insnameDeleteFn(id) {
	var tbl  = 'qfleet_insurance_name';
	var url  = 'Insurance_name';
	var mssg = 'Insurance_name';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					insrcname_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
		});
}
// insurance name  Restore
function insunamerestore(id) {
	var tbl  = 'qfleet_insurance_name';
	var url  = 'Insurance_name';
	var mssg = 'Insurance_name';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="Insurance_name";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}



// Insurance Type Delete
function instypeDeleteFn(id) {
	var tbl  = 'qfleet_insurance_type';
	var url  = 'Insurance_type';
	var mssg = 'Insurance_type';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					insrctype_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
		});

}
// insurance type  Restore
function insurancetypetrash(id) {
	var tbl  = 'qfleet_insurance_type';
	var url  = 'Insurance_type';
	var mssg = 'Insurance_type';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="Insurance_type";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// general information Restore
function g_inforestore(id) {
	var tbl  = 'qfleet_vehicleg_info';
	var url  = 'g_info';
	var mssg = 'g_info';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="g_info";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}



// General Info Delete
function ginfoDeleteFn(id) {
	var tbl  = 'qfleet_vehicleg_info';
	var url  = 'g_info';
	var mssg = 'g_info';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					ginfo_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });   
}
// vehicle document information Restore
function v_docinsurancerestore(id) {
	var tbl  = 'qfleet_vehicle_insurance';
	var url  = 'v_doc_insurance';
	var mssg = 'v_doc_insurance';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="v_doc_insurance";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}



// Vehicle Insurance Delete
function vinsDeleteFn(id) {
	var tbl  = 'qfleet_vehicle_insurance';
	var url  = 'v_doc_insurance';
	var mssg = 'v_doc_insurance';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					vinsrc_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}

// Vehicle Estimara Delete
function vestimDeleteFn(id) {
	var tbl  = 'qfleet_vehicle_estimara';
	var url  = 'v_doc_estimara';
	var mssg = 'v_doc_estimara';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					vestm_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// vehicle document estimara Restore
function v_doc_estimararestore(id) {
	var tbl  = 'qfleet_vehicle_estimara';
	var url  = 'v_doc_estimara';
	var mssg = 'v_doc_estimara';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="v_doc_estimara";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}
// other document  Restore
function other_doc_restore(id) {
	var tbl  = 'qfleet_vehicle_otherdoc';
	var url  = 'v_doc';
	var mssg = 'v_doc';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="v_doc";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}



// Other Document Delete
function votherdocDeleteFn(id) {
	var tbl  = 'qfleet_vehicle_otherdoc';
	var url  = 'v_doc';
	var mssg = 'v_doc';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					otherdoc_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// additional  Restore
function additional_restore(id) {
	var tbl  = 'qfleet_vehicle_additional_detail';
	var url  = 'Additional_details';
	var mssg = 'Additional_details';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="Additional_details";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}




// Additional Details Delete
function vehicleaditionaldocDeleteFn(id) {
	var tbl  = 'qfleet_vehicle_additional_detail';
	var url  = 'Additional_details';
	var mssg = 'Additional_details';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					adddet_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}

// Engine Details Delete
function vengineDeleteFn(id) {
	var tbl  = 'qfleet_vehicle_engine';
	var url  = 'engine';
	var mssg = 'engine';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					engine_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// engine  Restore
function engine_restore(id) {
	var tbl  = 'qfleet_vehicle_engine';
	var url  = 'engine';
	var mssg = 'engine';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="engine";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// owner  Restore
function owner_restore(id) {
	var tbl  = 'qfleet_vehicle_owner';
	var url  = 'owner';
	var mssg = 'owner';
	

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="owner";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}



// Owner Details Delete
function vownerDeleteFn(id) {
	var tbl  = 'qfleet_vehicle_owner';
	var url  = 'owner';
	var mssg = 'owner';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					own_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}

// Contractor Delete
function contractorrrDeleteFn(id) {
	var tbl  = 'qfleet_contractor';
	var url  = 'contractor_management';
	var mssg = 'contractor_management';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					contractor_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// contractor management   Restore
function contractormangementrestore(id) {
	var tbl  = 'qfleet_contractor';
	var url  = 'contractor_management';
	var mssg = 'contractor_management';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="contractor_management";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Contract Delete
function contractonlyDeleteFn(id) {
	var tbl  = 'qfleet_contract';
	var url  = 'contract';
	var mssg = 'contract';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					contract_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// contract  Restore
function contractrestore(id) {
	var tbl  = 'qfleet_contract';
	var url  = 'contract';
	var mssg = 'contract';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="contract";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Loan Provider Delete
function loanprovidrDeleteFn(id) {
	var tbl  = 'qfleet_loan_provider';
	var url  = 'loan_provider';
	var mssg = 'loan_provider';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					lprov_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// loan provider Restore
function loan_providerrestore(id) {
	var tbl  = 'qfleet_loan_provider';
	var url  = 'loan_provider';
	var mssg = 'loan_provider';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="loan_provider";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}
// loan bank Restore
function loan_bankrrestore(id) {
	var tbl  = 'qfleet_loan_bank';
	var url  = 'loan_bank';
	var mssg = 'loan_bank';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="loan_bank";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}




// Loan Bank Delete
function loanbankDeleteFn(id) {
	var tbl  = 'qfleet_loan_bank';
	var url  = 'loan_bank';
	var mssg = 'loan_bank';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					lbank_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// loan   Restore
function loanrestore(id) {
	var tbl  = 'qfleet_loan';
	var url  = 'loan_new';
	var mssg = 'loan';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="loan_new";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Loan Delete
function loanDeleteFn(id) {
	var tbl  = 'qfleet_loan';
	var url  = 'loan_new';
	var mssg = 'loan';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					loan_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// fuel type  Restore
function fue_typerestore(id) {
	var tbl  = 'qfleet_fuel_type';
	var url  = 'fuel_type';
	var mssg = 'fuel_type';
	

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="fuel_type";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}




// Fuel Type Delete
function fueltypeDeleteFn(id) {
	var tbl  = 'qfleet_fuel_type';
	var url  = 'fuel_type';
	var mssg = 'fuel_type';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					ftype_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}

// Fuel restore
function fuelrestore(id) {
	var tbl  = 'qfleet_fuel';
	var url  = 'fuel';
	var mssg = 'fuel';
	

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="fuel";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Fuel Delete
function fuelDeleteFn(id) {
	var tbl  = 'qfleet_fuel';
	var url  = 'fuel';
	var mssg = 'fuel';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					fuel_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// Service Type restore
function servtype_restore(id) {
	var tbl  = 'qfleet_service_type';
	var url  = 'service_type';
	var mssg = 'service_type';
	

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="service_type";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Service Type Delete
function servtypDeleteFn(id) {
	var tbl  = 'qfleet_service_type';
	var url  = 'service_type';
	var mssg = 'service_type';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					srvtype_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// Service Detail restore
function serv_restore(id) {
	var tbl  = 'qfleet_service_detail';
	var url  = 'service_details';
	var mssg = 'service_details';
	

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="service_details";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Service Detail Delete
function servdetailDeleteFn(id) {
	var tbl  = 'qfleet_service_detail';
	var url  = 'service_details';
	var mssg = 'service_details';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					srvdet_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}


// New Service restore
function servnewwrestoreFn(id) {
	var tbl  = 'qfleet_service_new';
	var url  = 'service_new';
	var mssg = 'service_new';
	

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="service_new";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// New Service Delete
function servnewwDeleteFn(id) {
	var tbl  = 'qfleet_service_new';
	var url  = 'service_new';
	var mssg = 'service_new';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					srv_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// Route restore
function route_restore(id) {
	var tbl  = 'qfleet_route';
	var url  = 'route';
	var mssg = 'route';
	
	

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="route";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}


// Route Delete
function routeDeleteFn(id) {
	var tbl  = 'qfleet_route';
	var url  = 'route';
	var mssg = 'route';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					route_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// Trip restore
function triprestore(id) {
	var tbl  = 'qfleet_trip_management';
	var url  = 'trip_management';
	var mssg = 'trip_management';
	
	

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="trip_management";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Trip Delete
function tripppDeleteFn(id) {
	var tbl  = 'qfleet_trip_management';
	var url  = 'trip_management';
	var mssg = 'trip_management';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					trip_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// Expense Category restore
function expense_catrestore(id) {
	var tbl  = 'qfleet_xcat';
	var url  = 'expense_cat';
	var mssg = 'expense_cat';
	
	

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="expense_cat";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Expense Category Delete
function xcatDeleteFn(id) {
	var tbl  = 'qfleet_xcat';
	var url  = 'expense_cat';
	var mssg = 'expense_cat';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					xcat_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
// Expense Head restore
function headreatore(id) {
	var tbl  = 'qfleet_xhead';
	var url  = 'expense_head';
	var mssg = 'expense_head';
	
	

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="expense_head";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Expense Head Delete
function xheadDeleteFn(id) {
	var tbl  = 'qfleet_xhead';
	var url  = 'expense_head';
	var mssg = 'expense_head';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					xhead_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+" "+data.exist_in+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}

// Expense restore
function expenserestore(id) {
	var tbl  = 'qfleet_expense';
	var url  = 'expense';
	var mssg = 'expense';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="expense";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

// Expense Delete
function expenseDeleteFn(id) {
	var tbl  = 'qfleet_expense';
	var url  = 'expense';
	var mssg = 'expense';
	
	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					exp_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}

/*****************************
* Vehicle Assign Delete      *
*****************************/
function vehicle_assign_DeleteFn(id) {
	var tbl  = 'qfleet_vehicle_assign';
	var url  = 'vehicle_assign';
	var mssg = 'vehicle_assign';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					vassign_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

/*****************************
* Vehicle Assign Restore      *
*****************************/
function vehicle_assignrestore(id) {
	var tbl  = 'qfleet_vehicle_assign';
	var url  = 'vehicle_assign';
	var mssg = 'vehicle_assign';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_restore_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
                    window.location.href="vehicle_assign";
						swal.fire(del_lang9, del_lang10, "success");
					
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}

/*******************************
* Detail : Purchase Delete     *
* Date   : 19-03-2021          *
*******************************/
function purchaseDeleteFn(id) {
	var tbl  = 'qfleet_purchase';
	var url  = 'Purchase';
	var mssg = 'Purchase';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					purchase_dtable.ajax.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}


/************ End :: Delete ******************/
	
    /**************************************
    * Vehicle Onchange to get Fuel Type   *
    *           for Add Fuel              *
    **************************************/
    $('#vehicle').on('change', function() {
        
        var vehicle = $(this).val();

        if(vehicle) {
            $.ajax({
                url:base_url+'home/getdynamicfueltype?vehicle='+vehicle,
                type: "POST",
                data : {vehicle_id:vehicle},
                dataType: "json",
                success:function(data) {
                    $('select[name="fueltype"]').append('<option value="">Select</option>');
                    $.each(data, function(key, value) {
                        $('select[name="fueltype"]').append('<option value="'+ value.fuel_type +'" selected>'+ value.tname +'</option>');
                    });
                }
                
            });
        }else{
            $('select[name="fueltype"]').empty();
        }
    });

    /**************************************
    * Detail : Fuel Type Onchange to get  *
        Last Fuel Details in Add Fuel     *
    **************************************/
    function  getvehicledetails()
    {
        var vehicle  = $("#vehicle").val();
        var htmlstr = '';

        $.ajax({
            dataType: 'json',
            type: 'post',
            data: { vehicle : vehicle},
            url : base_url+'home/getfueltypevehicledatalist',
            cache: false,
            success: function (data) {
            	console.log(data);
				// Fuel History
				$.each(data['vehicle'], function(index,srvhist) {
					htmlstr += '<div class="kt-timeline-v2">\
									<div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">\
									  <div class="kt-timeline-v2__item">\
										<span class="kt-timeline-v2__item-time" style="margin-left: -17%;">'+srvhist.date+'</span>\
										<div class="kt-timeline-v2__item-cricle">\
										  <i class="fa fa-genderless kt-font-warning"></i>\
										</div>\
										<div class="kt-timeline-v2__item-text kt-padding-top-5">\
										  Vehicle      : '+srvhist.vname+'<br>\
										  Fuel Type    : '+srvhist.fuelname+'<br>\
										  Driver Name  : '+srvhist.dname+'<br>\
										  Last Date    : '+srvhist.date+'<br>\
										  Odometer     : '+srvhist.odometer+'<br>\
										  Charge       : '+srvhist.charge+'<br>\
										  </div>\
									  </div>\
									</div>\
								</div>';
				});

				$("#fuel_history").html(htmlstr);
				$.each(data['fuel'], function(index,lastsrv) {
                    
                    $('.vehicle').html(lastsrv.vname);

                    $('.fueltype').html(lastsrv.fuelname);
                    $('.driver').html(lastsrv.dname);

                    $('.lastfueldate').html(lastsrv.date);
                    $('.odometer').html(lastsrv.odometer);

                    $('.fuelcharge').html(lastsrv.charge);

                   
                    
                });

               
            }
        });
    }

	/*************************************************
    * DEtail : Service Type Onchange to get Last     *
        Service Details (Top 2 Boxes) in New Service *
    * Date   : 28-12-2020                            *
    *************************************************/
    function getservdetaial(){
        var vehi = $("#srv_vehicle").val();
        var styp = $("#servicetyp").val();

        get_lastsrvdetails();

        var trush = document.getElementById("servdetail");
        var length = trush.options.length;
        var lengthc = length + 1;
        for (i = 0; i < lengthc; i++) {
            trush.remove('option');
        }

        $.ajax({
            dataType: 'text',
            type: 'post',
            url: base_url+'home/getservdetail?servicetyp='+styp,
            cache: false,
            success: function (data3) {
                $('#servdetail').append($('<option>').text('Select').attr('value', ''));

                $.each(JSON.parse(data3), function(key, value) {
                    $('#servdetail').append($('<option>').text(value.name).attr('value', value.id));
                });                 
            }
        });
                          
    }




    /**************************************
    * DEtail : Get Last Service Details   *
        (Top 2 Boxes) in New Service      *
    * Date   : 23-02-2021                 *
    **************************************/
    function get_lastsrvdetails() {
        var vehi = $("#srv_vehicle").val();
        var styp = $("#servicetyp").val();

        $.ajax({
            dataType: 'json',
            type: 'post',
            data: { veh : vehi, servtype : styp},
            url: base_url+'home/get_servcdetails',
            cache: false,
            success: function (data) {

                $.each(data[0], function(index,lastsrv) {
                    
                    $('.vehcl').html(lastsrv.vehname + ' (' + lastsrv.license + ')');
                    $('.stype').html(lastsrv.srvtype);

                    if (typeof(lastsrv.upcserv) != "undefined" && lastsrv.upcserv != "0000-00-00" && lastsrv.upcserv !== null) {
                        $('.upcmg_srv').html(ctm2_formatDate(lastsrv.upcserv));
                    }
                    else {
                        $('.upcmg_srv').html("------");
                    }

                    if (typeof(lastsrv.lastsrvdt) != "undefined" && lastsrv.lastsrvdt != "0000-00-00" && lastsrv.lastsrvdt !== null) {
                        $('.lastsrv').html(ctm2_formatDate(lastsrv.lastsrvdt));
                    }
                    else {
                        $('.lastsrv').html("------");
                    }

                    $('.odomtr').html(lastsrv.odometer);

                    if (lastsrv.doneby == 1) {
                        $('.done_by').html("Company");
                    }
                    else if (lastsrv.doneby == 2) {
                        $('.done_by').html("Out Side");   
                    }
                    
                });

            }
        });
    }
    
    /***********************************************
    * Detail : Service History on Vehicle Onchange *
    * Date   : 18-02-2021                          *
    ***********************************************/
    function service_histry()
    {
        var vehi    = $("#srv_vehicle").val();
        var htmlstr = '';

        $.ajax({
            dataType: 'json',
            type: 'post',
            data: { veh : vehi},
            url: base_url+'home/get_servicehistory',
            cache: false,
            success: function (data) {

                // Service History
                $.each(data[1], function(index,srvhist) {
                    var srvdate = '';

                    if (srvhist.doned != '' && srvhist.doned != "0000-00-00") {
                        srvdate = ctm2_formatDate(srvhist.doned);
                    }
                    else {
                        srvdate = " ";
                    }

                    var done_by = '';

                    if (srvhist.doneby == 1) {
                        done_by = "Company";
                    }
                    else if (srvhist.doneby == 2) {
                        done_by = "Outside";
                    }
                    
                    htmlstr += '<div class="kt-timeline-v2">\
                                    <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">\
                                      <div class="kt-timeline-v2__item">\
                                        <span class="kt-timeline-v2__item-time" style="margin-left: -27%;">'+srvdate+'</span>\
                                        <div class="kt-timeline-v2__item-cricle">\
                                          <i class="fa fa-genderless kt-font-warning"></i>\
                                        </div>\
                                        <div class="kt-timeline-v2__item-text kt-padding-top-5">\
                                          '+srvhist.name+' ('+srvhist.license+')<br>\
                                          Service Type    : '+srvhist.servicetype+'<br>\
                                          Service Details : '+srvhist.srvdetail+'<br>\
                                          Vendor          : '+srvhist.vendor+'<br>\
                                          Done By         : '+done_by+'<br>\
                                          Service Amount  : '+srvhist.service_amount+'<br>\
                                          Odometer        : '+srvhist.odometer+'\
                                        </div>\
                                      </div>\
                                    </div>\
                                </div>';
                });

                $("#service_history").html(htmlstr);

            }
        });
    }

	/***********************************************
	* Detail : Onchange Cost Category (Add Expense)*
	* Date   : 30-12-2020                          *
	***********************************************/
	function getxhead(){
		var trush = document.getElementById("xhead");
		var length = trush.options.length;
		var lengthc = length + 1;
		for (i = 0; i < lengthc; i++) {
			trush.remove('option');
		}
		var customer = $("select[name='xcat']").val();
		$.ajax({
			dataType: 'text',
			type: 'post',
			url: base_url+'home/getxhead?xcat='+customer,
			cache: false,
			success: function (data3) {
				$('#xhead').append($('<option>').text('Select').attr('value', '----'));
					$.each(JSON.parse(data3), function(key, value) {
					$('#xhead').append($('<option>').text(value.name).attr('value', value.id));
				});
			}
		});                      
	}

	/**********************************************
	* Detail : Add Purchase Supplier Onchange     *
	* Date   : 17-03-2021                         *
	**********************************************/
	/*$("#purchs_supplier").on('change', function() {
		var supplrId = $(this).val();
		
		$.ajax({
			url: base_url+'home/getsupplrcode',
			type: "POST",
			data: { supplierId : supplrId },
			dataType: "text",
			success: function(data) {
				$("#purchs_supplrcode").val(data);
			}
		});
	});*/

	/***************************************
	* Detail : Add Purchase Type Onchange  *
	* Date   : 19-03-2021                  *
	***************************************/
	function getvehicles(elemnt)
	{
		var type = $(elemnt).val();
		var tdid = $(elemnt).data('id');

		var html = '';

		$('#purch_vehicle'+tdid).find('option').not(':first').remove();
		if (type == 2) { // If vehicle selected
			$('#purch_vehicle'+tdid).select2();

			$.ajax({
				dataType: "JSON",
				type: "POST",
				url: base_url+'home/get_vehicles',
				success: function(data) {
					$.each(data, function(key, value) {
						$('#purch_vehicle'+tdid).append('<option value="'+ value.id +'">'+ value.name +' ('+value.license+')</option>');
					});
				}
			});
		}
	}

	/*************************************
	* Detail : Add Purchase Add More     *
	* Date   : 17-03-2021                *
	*************************************/
	$("#purchs_addmore").on('click', function() {
		var vehicle_parts = $("#purchs_vehparts").val();
		var partname      = $("#purchs_vehparts option:selected").text();
		// var type          = $("#purchs_type").val();
		// var vehclid       = $("#purch_vehicle").val();

		if (vehicle_parts == "") {
			$("#purchs_vehparts").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#purchs_vehparts").next().find('.select2-selection').removeClass('select-dropdown-error');
		// }

		// if (type == "") {
		// 	$("#purchs_type").next().find('.select2-selection').addClass('select-dropdown-error');
		// 	return false;
		// }
		// else {	
		// 	$("#purchs_type").next().find('.select2-selection').removeClass('select-dropdown-error');
		// }

		// if (type == 2 && vehclid == "") {
		// 	$("#purch_vehicle").next().find('.select2-selection').addClass('select-dropdown-error');
		// 	return false;
		// }
		// else {
		// 	$("#purch_vehicle").next().find('.select2-selection').removeClass('select-dropdown-error');

			var part = parseInt(vehicle_parts);
			
        	var tr_id = document.getElementById("purchase_tbl").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
        	var sl_no = tr_id + 1;
        	var td_Id = 0;
        	var units = '';

        	if (tr_id > 0) {
        		var last_tdid = $('#purchase_tbody tr:last input').data('id');
        		td_Id    = last_tdid+1;
        	}

        	/*Units*/
        	$.each(unit_arr, function(key, value) {
				units += '<option value="'+value.id+'">'+value.unit_name+'</option>';
			});

			var tr = '<tr id="tr_'+tr_id+'">\
						<td class="sl_id">'+sl_no+'</td>\
						<td>'+partname+'</td>\
						<td>\
							<input type="hidden" class="form-control" data-id="'+td_Id+'" id="purchs_partid'+td_Id+'" name="purchs_partid[]" value="">\
							<input type="hidden" class="form-control" data-id="'+td_Id+'" id="purchs_pdtid'+td_Id+'" name="purchs_pdtid[]" value="">\
							<input type="text" class="form-control" data-id="'+td_Id+'" id="purchs_partcode'+td_Id+'" name="purchs_partcode[]">\
							<input type="hidden" class="form-control" data-id="'+td_Id+'" id="purchs_partassignid'+td_Id+'" name="purchs_partassignid[]" value="">\
						</td>\
						<td>\
							<select class="form-control" data-id="'+td_Id+'" id="purchs_unit'+td_Id+'" name="purchs_unit[]">\
								<option value="">Select</option>'+units+'\
						 	</select>\
						</td>\
						<td>\
							<input type="number" class="form-control" data-id="'+td_Id+'" id="purchs_qty'+td_Id+'" name="purchs_qty[]" value="0">\
						</td>\
						<td>\
							<input type="number" class="form-control" data-id="'+td_Id+'" id="purchs_rate'+td_Id+'" name="purchs_rate[]" value="0">\
						</td>\
						<td>\
							<input type="text" class="form-control" data-id="'+td_Id+'" id="purchs_amt'+td_Id+'" name="purchs_amt[]" readonly="" value="0.00">\
						</td>\
						<td>\
							<input type="number" class="form-control" data-id="'+td_Id+'" id="purchs_discnt'+td_Id+'" name="purchs_discnt[]" min="0" step="0.01" value="0">\
						</td>\
						<td>\
							<input type="number" class="form-control" data-id="'+td_Id+'" id="purchs_vatpercnt'+td_Id+'" name="purchs_vatpercnt[]" value="15">\
							<input type="hidden" class="form-control" data-id="'+td_Id+'" id="purchs_vatamt'+td_Id+'" name="purchs_vatamt[]" value="0.00">\
						</td>\
						<td>\
							<input type="number" class="form-control" data-id="'+td_Id+'" id="purchs_totl'+td_Id+'" name="purchs_totl[]" readonly="" value="0.00">\
						</td>\
						<td>\
							<select class="form-control kt-selectpicker" data-id="'+td_Id+'" id="purchs_type'+td_Id+'" name="purchs_type[]" onchange="getvehicles(this)">\
								<option value="">Select</option>\
								<option value="1">Stock</option>\
								<option value="2">Vehicle</option>\
							</select>\
						</td>\
						<td>\
							<select class="form-control kt-selectpicker" data-id="'+td_Id+'" id="purch_vehicle'+td_Id+'" name="purch_vehicle[]">\
								<option value="">Select</option>\
							</select>\
						</td>\
						<td>\
							<button type="button" class="btn btn-outline-danger btn-sm" onclick="purchs_remove(this)" title="Remove"><i class="la la-trash-o"></i></button>\
						</td>\
					</tr>';

			$("#purchase_tbl > tbody:last-child").append(tr);

			if (Number.isInteger(part) == false) { // Dynamically Add Vehicle Parts
				$.ajax({
					dataType: 'text',
					type: 'POST',
					data: { part_name : vehicle_parts },
					url: base_url+'home/addvehicle_parts',
					cache: false,
					success: function(data) {
						$("#purchs_partid"+td_Id).val(data);
					}
				});
			}
			else {
				$("#purchs_partid"+td_Id).val(vehicle_parts);
			}
			$("#purchs_vehparts").val(null).trigger("change");
		} // End Else
	});

	/************************************
	* Detail : Add Purchase Remove Rows *
	* Date   : 18-03-2021               *
	************************************/
	function purchs_remove(ob)
	{
		var rowid = $(ob).closest('tr').attr('id');
		
		$("#"+rowid).remove();

		calc_purchasetotals();

		$(".sl_id").each(function(i){
			$(this).text(i+1);
		});

		$("#purchase_tbody > tr").each(function(k) {
			$(this).attr('id', 'tr_' + (k));
		});
	}

	/************************************
	* Detail : Add Purchase Calculations*
	* Date   : 18-03-2021               *
	************************************/
	$('body').on('keyup change click', '#purchase_tbody tr input', function() {
		var tdid          = $(this).data("id");
		var qty           = $("#purchs_qty"+tdid).val();
		var rate          = $("#purchs_rate"+tdid).val();
		
		var amount        = qty * rate;

		var discount      = $("#purchs_discnt"+tdid).val();
		var vatprcnt      = $("#purchs_vatpercnt"+tdid).val();
		var amt_afterdcnt = amount - discount; // Amount After Discount
		var vat_amt       = amt_afterdcnt * (vatprcnt / 100);

		$("#purchs_vatamt"+tdid).val(vat_amt);

		var total         = amt_afterdcnt + vat_amt;

		$("#purchs_amt"+tdid).val(amount.toFixed(2));
		$("#purchs_totl"+tdid).val(total.toFixed(2));

		calc_purchasetotals();
	});

	/***********************************************
	* Detail : Calculate All Totals in Add Purchase*
	* Date   : 18-03-2021                          *
	***********************************************/
	function calc_purchasetotals()
	{
		var totl_amount = 0.00;
		var totl_discnt = 0.00;
		var totl_vatamt = 0.00;
		var gross_amt   = 0.00;
		var amt_arr     = $("input[name='purchs_amt[]']").map(function(){return $(this).val();}).get();
		var discnt_arr  = $("input[name='purchs_discnt[]']").map(function(){return $(this).val();}).get();
		var vat_arr     = $("input[name='purchs_vatamt[]']").map(function(){return $(this).val();}).get();
		var totl_arr    = $("input[name='purchs_totl[]']").map(function(){return $(this).val();}).get();

		$.each(amt_arr, function(index, value) {
			totl_amount += parseFloat(value);
			totl_discnt += parseFloat(discnt_arr[index]);
			totl_vatamt += parseFloat(vat_arr[index]);
			gross_amt   += parseFloat(totl_arr[index]);
		});
		
		$("#purchs_totlamt").val(totl_amount);
		$("#purchs_totldiscnt").val(totl_discnt);
		$("#purchs_totlvat").val(totl_vatamt);
		$("#purchs_grossamt").val(gross_amt);
	}

	/**************************************
	* Detail : Add Purchase Submit        *
	* Date   : 18-03-2021                 *
	**************************************/
	$("#servreport_submit").click(function() {
		var supplier = $("#purchs_supplier").val();
		var billdate = $("input[name='purchs_billdate']").val();
		var billno   = $("input[name='purchs_billno']").val();
		
		if (supplier=="") 
		{
			$("#purchs_supplier").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}  
		else 
		{
			$("#purchs_supplier").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (billdate=="") 
		{
			$("input[name='purchs_billdate']").addClass('is-invalid');
			return false;
		}  
		else 
		{
			$("input[name='purchs_billdate']").removeClass('is-invalid');
		}
		if (billno=="") 
		{
			$("input[name='purchs_billno']").addClass('is-invalid');
			$("input[name='purchs_billno']").focus();
			return false;
		}  
		else 
		{
			$("input[name='purchs_billno']").removeClass('is-invalid');
		}

		$("#purchase_Form").attr("action",base_url+"Common/db_add_update");
		$("#purchase_Form").submit();
	});

	/************************************
	* Detail : Loan Provider Onchange in 
				 Loan Add (Not clear) *
	************************************/
	/*function getproviderdetailzzz(){
		var provider = $("select[name='provider']").val();
		document.getElementById("providercontent").innerHTML = "";
		$.ajax({
			dataType: 'text',
			type: 'post',
			url: base_url+'home/getloanproviderforcard?id='+provider,
			cache: false,
			success: function (data) {
				var obj = JSON.parse(data);
				var div = document.createElement('div');
				div.className = 'row';
				div.innerHTML +=
					'<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11"  style="margin-left: 4%;">\
					<a class="dashboard-stat dashboard-stat-v2 blue" href="#">\
					<h3 style="text-align: center;color:white;" >Loan Provider Detail</h3>\
						<div class="row ">\
							<div class="col-md-6 form-group">\
								<label  style="color: white; margin-top: 5%; margin-left: 5%;">Name : </label>\
								<label style="color: white;">'+obj.name+'</label>\
							</div>\
							<div class="col-md-6 form-group">\
								<label  style="color: white; margin-top: 5%">Location : </label>\
								<label style="color: white;">'+obj.location+'</label>\
							</div>\
							<div class="col-md-6 form-group">\
								<label  style="color: white; margin-left: 5%;">Contact Person : </label>\
								<label style="color: white;">'+obj.contact_person+'</label>\
							</div>\
							<div class="col-md-6 form-group">\
								<label  style="color: white;">Phone : </label>\
								<label style="color: white;">'+obj.phone+'</label>\
							</div>\
							<div class="col-md-6 form-group">\
								<label  style="color: white; margin-left: 5%;">Email : </label>\
								<label style="color: white;">'+obj.email+'</label>\
							</div>\
							<div class="col-md-6 form-group">\
								<label  style="color: white;">Address: </label>\
								<label style="color: white;">'+obj.address+'</label>\
							</div>\
						</div>\
					</a>\
				</div>';
			}
		});
	}*/

	/************************************
	* Detail : Loan Bank Onchange in 
				 Loan Add (Not clear) *
	************************************/
	/*function getbankforcard(){
		var bank = $("select[name='bank']").val();
		document.getElementById("bankcontent").innerHTML = "";
		$.ajax({
			dataType: 'text',
			type: 'post',
			url: base_url+'home/getloanbankforcard?id='+bank,
			cache: false,
			success: function (data) {
				var obj = JSON.parse(data);
				var div = document.createElement('div');
				div.className = 'row';
				div.innerHTML +=
					'<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11"  style="margin-left: 4%;">\
						<a class="dashboard-stat dashboard-stat-v2 blue" href="#">\
						<h3 style="text-align: center;color:white;" >Loan Bank Detail</h3>\
						<div class="row ">\
							<div class="col-md-6 form-group">\
								<label  style="color: white; margin-top: 5%; margin-left: 5%;">Name : </label>\
								<label style="color: white;">'+obj.name+'</label>\
							</div>\
							<div class="col-md-6 form-group">\
								<label  style="color: white; margin-top: 5%">Phone : </label>\
								<label style="color: white;">'+obj.phone+'</label>\
							</div>\
							<div class="col-md-6 form-group">\
								<label  style="color: white; margin-left: 5%;">Head Office : </label>\
								<label style="color: white;">'+obj.head_office+'</label>\
							</div>\
							<div class="col-md-6 form-group">\
								<label  style="color: white;">Branch Name : </label>\
								<label style="color: white;">'+obj.branch_name+'</label>\
							</div>\
							<div class="col-md-6 form-group">\
								<label  style="color: white; margin-left: 5%;">Email : </label>\
								<label style="color: white;">'+obj.email+'</label>\
							</div>\
							<div class="col-md-6 form-group">\
								<label  style="color: white;">Address: </label>\
								<label style="color: white;">'+obj.address+'</label>\
							</div>\
						</div>\
						</a>\
					</div>';
			}
		});                      
	}*/

	/************************************
	* Detail : Cost Head Onchange in 
				 Add Expense (Not clear) *
	************************************/
	/*function getexpensedetailzzz(){
		var vehicle = $("select[name='vehicle']").val();
		var xhead = $("select[name='xhead']").val();
		document.getElementById("xheadhistory").innerHTML = "";
		$.ajax({
			dataType: 'text',
			type: 'post',
			url: base_url+'home/getexpenseheadhistory?vehi='+vehicle+'&&xhead='+xhead,
			cache: false,
			success: function (data) {
				var obj       = JSON.parse(data);
				var div       = document.createElement('div');
				div.className = 'row';
				var payz      ='';
				if (obj.payment_method=="1") {
					var payz ='Cash';
				}else if (obj.payment_method=="2") {
					var payz ='Card';
				}else if (obj.payment_method=="3") {
					var payz ='Bank';
				}else if (obj.payment_method=="4") {
					var payz ='Cheque';
				}else if (obj.payment_method=="0") {
					var payz ='No previous History';
				}
				div.innerHTML +=
				'<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11"  style="margin-left: 4%;">\
					<a class="dashboard-stat dashboard-stat-v2 blue" href="#">\
					<h3 style="text-align: center;color:white;" >Expense History Detail</h3>\
					<div class="row ">\
						<div class="col-md-6 form-group">\
							<label  style="color: white; margin-top: 5%; margin-left: 5%;">Vehicle : </label>\
							<label style="color: white;">'+obj.v_name+'</label>\
						</div>\
						<div class="col-md-6 form-group">\
							<label  style="color: white; margin-top: 5%">Cost Category : </label>\
							<label style="color: white;">'+obj.xcat_name+'</label>\
						</div>\
						<div class="col-md-6 form-group">\
							<label  style="color: white; margin-left: 5%;">Cost Head : </label>\
							<label style="color: white;">'+obj.xhead_name+'</label>\
						</div>\
						<div class="col-md-6 form-group">\
							<label  style="color: white;">Amount : </label>\
							<label style="color: white;">'+obj.amount+'</label>\
						</div>\
						<div class="col-md-6 form-group">\
							<label  style="color: white; margin-left: 5%;">Payment Method : </label>\
							<label style="color: white;">'+payz+'</label>\
						</div>\
						<div class="col-md-6 form-group">\
							<label  style="color: white;">Date: </label>\
							<label style="color: white;">'+obj.date+'</label>\
						</div>\
					</div>\
					</a>\
				</div>';
				document.getElementById('xheadhistory').appendChild(div);
			}
		});              
	}*/

	$(document).ready(function() {
		/***********************************
		* Vehicle Assign Onchange Branch   *
		***********************************/
		$('select[name="branch"]').on('change', function() {
			var branch = $(this).val();
			if(branch) {
				$.ajax({
					url:base_url+'home/getdynamicdepartment',
					type: "POST",
					data : {branch_id:branch},
					dataType: "json",
					success:function(data) {
						$('select[name="department"]').empty();
						$('select[name="employee"]').empty();

						$('#employee').select2({
							placeholder: "Select"
						});

						$('select[name="department"]').append('<option value="">Select</option>');
						$.each(data, function(key, value) {
							$('select[name="department"]').append('<option value="'+ value.id +'">'+ value.dept_name +'</option>');
						});
					}
				});
			}else{
				$('select[name="department"]').empty();
			}
		});

		/*************************************
		* Vehicle Assign Onchange Department *
		* Date : 31-12-2020                  *
		*************************************/
		$('select[name="department"]').on('change', function() {
			var branch     = $("#branch").val();
			var department = $("#department").val();

			$("#employee").empty();
			$('#employee').empty().trigger("change");
			$("#employee").val(null).trigger("change");
			$("#employee").select2('val', '');
			$('#employee').select2({
				placeholder: "Select"
			});

			$.ajax({
					dataType: "json",
					type: "POST",
					data : {branch_id:branch, department_id : department},
					url:base_url+'home/getdynamicemployee1',
					cache: false,
					success:function(data) {
						$.each(data[0], function(key, value){
							$('#employee').append($('<option>').text(value.f_name+' '+value.l_name+' ('+value.employee_code+')').attr('value', value.id));
						});
					}
				});
		});


	/*$('select[name="designation"]').on('change', function() {
			var branch     = $("#branch").val();
			var department = $("#department").val();
            var designation = $(this).val();
			$("#employee").empty();
			$('#employee').empty().trigger("change");
			$("#employee").val(null).trigger("change");
			$("#employee").select2('val', '');
			$('#employee').select2({
				placeholder: "Select"
			});

			$.ajax({
					dataType: "json",
					type: "POST",
					data : {branch_id:branch, department_id : department, designation:designation},
					url:base_url+'home/getdynamicemployee1',
					cache: false,
					success:function(data) {
						$.each(data, function(key, value){
							$('#employee').append($('<option>').text(value.f_name+' '+value.l_name+' ('+value.employee_code+')').attr('value', value.id));
						});
					}
				});
		});*/


	}); // End :: DOM
	
	/**********************************************
	* Date : 8-12-2020                            *
	* Details: Select Driver Onchange (Add Driver)*
	**********************************************/
	$("#drv_selectdriver").on('change', function(){
		var name_ele      = '';
		var driver_select = $("#drv_selectdriver").val();

		if (driver_select == 1) {
			$("#drv_sel").select2('destroy');
			$("#drv_sel").remove();
			$("#drvname").remove();

			name_ele = '<input type="text" name="name" id="drvname" class="form-control" value="">';
			$("#drv_name").append(name_ele);
		}
		else if (driver_select == 2) {
			$("#drvname").remove();

			$("#drv_name").append('<select class="form-control kt-selectpicker" name="name" id="drv_sel" onchange="driverchange()">\
										<option value="">'+sel_lang+'</option>\
									</select>');
			$("#drv_name").append(name_ele);
			$("#drv_sel").select2();

			$.ajax({
				dataType: 'json',
				type:'post',
				url: base_url+'home/driverfromhr',
				cache: false,
				success:function(data)
				{
					$.each(data[0], function(index,driverdet) {
						var drv_id    = driverdet['id'];
						var drv_fname = driverdet['f_name'];
						var drv_lname = driverdet['l_name'];
						var empcode   = driverdet['employee_code'];
				
						$("#drv_sel").append(`<option value="${drv_id}">${drv_fname} ${drv_lname} (${empcode})</option>`);
					});
				}
			});
		}
	
	});

	/*************************************
	* Detail : Onchange of Driver Name   *
	* Date   : 15-12-2020                *
	*************************************/
	function driverchange()
	{
		var drvid = $("#drv_sel").val();// Driver Id

		$.ajax({
			dataType: 'json',
			type: 'post',
			data: { drvid : drvid },
			url: base_url+'home/dvrdet_fromhr',
			cache: false,
			success:function(data)
			{
				$.each(data[0], function(index,drvdet) {

					/*var idexp   = ctm2_formatDate(drvdet.idexpiry); // ID Expiry
					var passexp = ctm2_formatDate(drvdet.passprtexpiry); // Passport Expiry
					var inscrexp= ctm2_formatDate(drvdet.insrcexpiry); // Insurance Expiry
					var licexp  = ctm2_formatDate(drvdet.licexpiry); // License Expiry*/
					
					$("#gender").val(drvdet.gender).trigger('change');
					$("input[name='phone']").val(drvdet.mob);
					$("#nationality").val(drvdet.nationality).trigger('change');
					/*$("input[name='idnum']").val(drvdet.number);
					$("input[name='idex']").datepicker('setDate', idexp);

					if (typeof(drvdet.idupld) != "undefined" && drvdet.idupld !== null) {
						id_upload = drvdet.idupld;
						id_up    = id_upload.split('/');
						$(".idup").html(id_up[3]);
						$("#driveidnn").attr('disabled','disabled');
						// $("#idup_path").val(id_up[3]);
						$("#idup_path").val('hrm/'+id_upload);
					}
					else {
						$(".idup").html("Choose file");
						$("#driveidnn").removeAttr('disabled');
						$("#idup_path").val('');
					}

					$("input[name='passport']").val(drvdet.passport_number);
					$("input[name='passportex']").datepicker('setDate', passexp);

					if (typeof(drvdet.passprtupld) != "undefined" && drvdet.passprtupld !== null) {
						pass_upload = drvdet.passprtupld;
						pass_up     = pass_upload.split('/');
						$(".passup").html(pass_up[3]);
						$("#passporti").attr('disabled','disabled');
						// $("#passup_path").val(pass_up[3]);
						$("#passup_path").val('hrm/'+pass_upload);
					}
					else {
						$(".passup").html("Choose file");
						$("#passporti").removeAttr('disabled');
						$("#passup_path").val('');
					}

					$("input[name='insurncprovi']").val(drvdet.company_name);
					$("input[name='insurance']").val(drvdet.insurance_no);
					$("input[name='insurex']").datepicker('setDate', inscrexp);

					if (typeof(drvdet.insrcupld) != "undefined" && drvdet.insrcupld !== null) {
						insrc_upload = drvdet.insrcupld;
						insrc_up     = insrc_upload.split('/');
						$(".insrcup").html(insrc_up[3]);
						$("#insurancei").attr('disabled','disabled');
						// $("#insrcup_path").val(insrc_up[3]);
						$("#insrcup_path").val('hrm/'+insrc_upload);
					}
					else {
						$(".insrcup").html("Choose file");
						$("#insurancei").removeAttr('disabled');
						$("#insrcup_path").val('');
					}*/

					/*$("input[name='license']").val(drvdet.license_number);
					$("input[name='license_exp']").datepicker('setDate', licexp);

					if (typeof(drvdet.licupld) != "undefined" && drvdet.licupld !== null) {
						lic_upload = drvdet.licupld;
						lic_up     = lic_upload.split('/');
						$(".licup").html(lic_up[3]);
						$("#licensei").attr('disabled','disabled');
						// $("#licup_path").val(lic_up[3]);
						$("#licup_path").val('hrm/'+lic_upload);
					}
					else {
						$(".licup").html("Choose file");
						$("#licensei").removeAttr('disabled');
						$("#licup_path").val('');
					}

					$("#Address").val(drvdet.perm_add);*/
				});
			}
		});
	}
	
	/*************************************
	* Detail : Trip Mgmnt Onchange Route *
	* Date   : 24-12-2020                *
	*************************************/
	$("#route").on('change', function() {
		var routeid = $("#route").val();
		
		$.ajax({
			dataType: 'json',
			type: 'post',
			data: { routeid : routeid },
			url: base_url+'home/routedetails',
			cache: false,
			success:function(data)
			{
				$.each(data[0], function(index, dist) {
					$("input[name='total_km']").val(dist.distance);
				});
			}
		});
	});

    /**********************************************
    * Detail : Vehicle Insurance Notification Edit*
    * Date   : 22-02-2021                         *
    **********************************************/
    function vinsrc_notfneditFun(id)
    {
        $("#insurance_modal").modal({backdrop: 'static'});
        $("#insurance_modal").load(base_url+'home/insurance_modal?id='+id+'&&pg=1');
        $(".modal-backdrop").show();
        $('#insurance_modal').show();
    }

    /**********************************************
    * Detail : Vehicle Estimara Notification Edit *
    * Date   : 22-02-2021                         *
    **********************************************/
    function vest_notfneditFun(id)
    {
        $("#estimara_modal").modal({backdrop: 'static'});
        $("#estimara_modal").load(base_url+'home/estimara_modal?id='+id+'&&pg=1');
        $(".modal-backdrop").show();
        $('#estimara_modal').show();
    }

    /**********************************************
    * Detail : Vehicle Other Doc Notification Edit*
    * Date   : 22-02-2021                         *
    **********************************************/
    function vdoc_notfneditFun(id)
    {
        $("#odoc_modal").modal({backdrop: 'static'});
        $("#odoc_modal").load(base_url+'home/otherdocvechi_modal?id='+id+'&&pg=1');
        $(".modal-backdrop").show();
        $('#odoc_modal').show();
    }

    /***************************************
    * Detail : Contract Notification Edit  *
    * Date   : 22-02-2021                  *
    ***************************************/
    function contract_notfneditFun(id)
    {
        $("#contract_modal").modal({backdrop: 'static'});
        $("#contract_modal").load(base_url+'home/contractModal?id='+id+'&&pg=1');
        $(".modal-backdrop").show();
        $('#contract_modal').show();
    }

    /**********************************************
    * Detail : Upcoming Service Notification Edit *
    * Date   : 22-02-2021                         *
    **********************************************/
    function upsrv_notfneditFun(id)
    {
        window.location.href = base_url+'home/servnew_modal?id='+id+'&&pg=1';
    }

	/**********************************
	* To format date to dd-mm-yyyy    *
	**********************************/
	function ctm2_formatDate(date) {
		var d = new Date(date),
			month = '' + (d.getMonth() + 1),
			day = '' + d.getDate(),
			year = d.getFullYear();

		if (month.length < 2) 
			month = '0' + month;
		if (day.length < 2) 
			day = '0' + day;

		return [day, month, year].join('-');
	}

	/*************************************
	* Detail : Onclick Back/Cancel Button*     
	* Date   : 30-12-2020                *
	*************************************/
	function goBack() {
		window.history.back();
	}

	/*********** Export *****************/
  	//Driver Management
  	$("#driver_print").on("click", function() {
		driver_dtable.button( '.buttons-print' ).trigger();
	});

	$("#driver_copy").on("click", function() {
		driver_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#driver_excel").on("click", function() {
		driver_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#driver_csv").on("click", function() {
		driver_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#driver_pdf").on("click", function() {
		driver_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Vendor
  	$("#vendor_print").on("click", function() {
		vendor_dtable.button( '.buttons-print' ).trigger();
	});

	$("#vendor_copy").on("click", function() {
		vendor_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#vendor_excel").on("click", function() {
		vendor_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#vendor_csv").on("click", function() {
		vendor_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#vendor_pdf").on("click", function() {
		vendor_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Supplier
	$("#supplr_print").on("click", function() {
		supplr_dtable.button( '.buttons-print' ).trigger();
	});

	$("#supplr_copy").on("click", function() {
		supplr_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#supplr_excel").on("click", function() {
		supplr_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#supplr_csv").on("click", function() {
		supplr_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#supplr_pdf").on("click", function() {
		supplr_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Vehicle
    $("#vehicle_print").on("click", function() {
		vehicle_dtable.button( '.buttons-print' ).trigger();
	});

	$("#vehicle_copy").on("click", function() {
		vehicle_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#vehicle_excel").on("click", function() {
		vehicle_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#vehicle_csv").on("click", function() {
		vehicle_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#vehicle_pdf").on("click", function() {
		vehicle_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Vehicle Type
  	$("#vtype_print").on("click", function() {
		vtype_dtable.button( '.buttons-print' ).trigger();
	});

	$("#vtype_copy").on("click", function() {
		vtype_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#vtype_excel").on("click", function() {
		vtype_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#vtype_csv").on("click", function() {
		vtype_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#vtype_pdf").on("click", function() {
		vtype_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Vehicle Category
  	$("#vcat_print").on("click", function() {
		vcateg_dtable.button( '.buttons-print' ).trigger();
	});

	$("#vcat_copy").on("click", function() {
		vcateg_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#vcat_excel").on("click", function() {
		vcateg_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#vcat_csv").on("click", function() {
		vcateg_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#vcat_pdf").on("click", function() {
		vcateg_dtable.button( '.buttons-pdf' ).trigger();
	});

	// Insurance Name
  	$("#name_print").on("click", function() {
		insrcname_dtable.button( '.buttons-print' ).trigger();
	});

	$("#name_copy").on("click", function() {
		insrcname_dtable.button( '.buttons-copy' ).trigger();
	});

	$("#name_excel").on("click", function() {
		insrcname_dtable.button( '.buttons-excel' ).trigger();
	});
	
	$("#name_csv").on("click", function() {
		insrcname_dtable.button( '.buttons-csv' ).trigger();
	});

	$("#name_pdf").on("click", function() {
		insrcname_dtable.button( '.buttons-pdf' ).trigger();
	});


	/****************************
	* partsallocn Submit       *
	****************************/
	$("#partsallocn_submit").click(function(e) {
		e.preventDefault();

		var id   = $("input[name='id']").val();
		var vehicle = $("input[name='palloc_vehicle']").val();
		var parts = $("input[name='palloc_parts']").val();
		var quantity = $("input[name='palloc_qty']").val();
		var date = $("input[name='palloc_date']").val();
		
		if (vehicle=="") {
			$("#palloc_vehicle").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#palloc_vehicle").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (parts=="") {
			$("#palloc_parts").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$("#palloc_parts").next().find('.select2-selection').removeClass('select-dropdown-error');
		}


		//For Add
		if (id == '') {
			$("#vehicle_parts_assign").attr("action",base_url+"Common/db_add_update");
			$("#vehicle_parts_assign").submit();
		}
		// For Edit
		else {
			
			$("#vehicle_parts_assign").attr("action",base_url+"Common/db_add_update");
			$("#vehicle_parts_assign").submit();
			
		}

	});

	/***********************************
* Details : Parts Allocation edit   *
* Date    : 18-03-2020             *
***********************************/
// $("#partsallocn_edit").click(function() {
// 	$id = $('id').val();

// 	$("#parts_allocnModal").modal({backdrop: 'static'});
// 	$("#parts_allocnModal").load(base_url+'home/partsallocn_modal');
// 	$(".modal-backdrop").show();
// 	$('#parts_allocnModal').show();
// });

function partsallocn_edit(id) {
 
    $("#parts_allocnModal").modal({backdrop: 'static'});
	$("#parts_allocnModal").load(base_url+'home/partsallocn_modal?id='+id);
	$(".modal-backdrop").show();
	$('#parts_allocnModal').show();
}
function partsallocn_delete(id) {
	var tbl  = 'qfleet_vehicle_parts_assign';
	var url  = 'partsallocation';
	var mssg = 'partsallocation';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {
					location.reload();
					swal.fire(del_lang9, del_lang10, "success");
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });
}
$("#material_history_submit").click(function(e) {
		e.preventDefault();
		var vehicle = $("#materlhist_vehicle").val();
		var fromdt  = $("input[name='mhistfrm_date']").val();
		var todt    = $("input[name='mhisttill_date']").val();
	
		
		if (vehicle == "" || vehicle == null) 
		{
			$("#materlhist_vehicle").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		} 
		else
		{
			$("#materlhist_vehicle").next().find('.select2-selection').removeClass('select-dropdown-error');
		}

material_history = $('#datatable-materialhist').DataTable({
		"bDestroy": true,"dom": 'Blfrtip',
		 "buttons": [
			{
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [0,1,2]
				},
				pageSize: 'A3',
				orientation: 'landscape',
				customize : function(doc) {
					doc.pageMargins = [50,50,50,50];
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2]
				}
			}
		],

		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],
		"lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'A11']],
		"ajax": {
			 data: { veh : vehicle, from_dt : fromdt, to_dt : todt},
	         url: base_url+'table/getreport_material_history',
			type : 'POST'
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			}
			],
	   
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
	});










			// var htmlstr = '';
			// var no = 1;
	  //       $.ajax({
	  //           dataType: 'json',
	  //           type: 'post',
	  //           data: { veh : vehicle, from_dt : fromdt, to_dt : todt},
	  //           url: base_url+'table/getreport_material_history',
	  //           cache: false,
	  //           success: function (data) {

	  //             console.log(data);
	  //              $.each(data['list'], function(index,value) 
	  //              {
	  //              	 htmlstr += '<tr>\
	  //              	  <td>'+no+'</td>\
	  //              	 <td>'+value.part+'</td>\
	  //              	 <td>'+value.part_code+'</td>\
	  //              	 <td>'+value.date+'</td>\
	  //              	 <td>'+1+'</td>\
	  //              	 </tr>';
	  //              	 no++;
	  //              });

	             

	  //                $("#datatable-materialhist").html(htmlstr);

	  //           }
	  //       });
		});

$("#material_history_pdf").click(function(e) {
		e.preventDefault();
		var vehicle = $("#materlhist_vehicle").val();
		var fromdt  = $("input[name='mhistfrm_date']").val();
		var todt    = $("input[name='mhisttill_date']").val();
	
		
		if (vehicle == "" || vehicle == null) 
		{
			$("#materlhist_vehicle").next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		} 
		else
		{
			$("#materlhist_vehicle").next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		$("#material_history_form").attr("action",base_url+"Home/material_history_pdf");
		$("#material_history_form").submit();
	});




    $('.getservdetaial1').on('change', function() {
      

      var rowidid = $(this).attr('id').replace ( /[^\d.]/g, '' );


        var vehi = $("#vehicle"+rowidid).val();
        var styp = $("#servicetyp"+rowidid).val();

     /*   get_lastsrvdetails1(rowidid);*/

       var trush = document.getElementById("servdetail"+rowidid);
        var length = trush.options.length;
        var lengthc = length + 1;
        for (i = 0; i < lengthc; i++) {
            trush.remove('option');
        }

        $.ajax({
            dataType: 'text',
            type: 'post',
            url: base_url+'home/getservdetail?servicetyp='+styp,
            cache: false,
            success: function (data3) {
                $('#servdetail'+rowidid).append($('<option>').text('Select').attr('value', ''));

                $.each(JSON.parse(data3), function(key, value) {
                    $('#servdetail'+rowidid).append($('<option>').text(value.name).attr('value', value.id));
                });                 
            }
        });


    });


        function get_lastsrvdetails1(rowidid) {
        var vehi = $("#vehicle"+rowidid).val();
        var styp = $("#servicetyp"+rowidid).val();


        $.ajax({
            dataType: 'json',
            type: 'post',
            data: { veh : vehi, servtype : styp},
            url: base_url+'home/get_servcdetails',
            cache: false,
            success: function (data) {

                $.each(data[0], function(index,lastsrv) {
                    
                    $('.vehcl').html(lastsrv.vehname + ' (' + lastsrv.license + ')');
                    $('.stype').html(lastsrv.srvtype);

                    if (typeof(lastsrv.upcserv) != "undefined" && lastsrv.upcserv != "0000-00-00" && lastsrv.upcserv !== null) {
                        $('.upcmg_srv').html(ctm2_formatDate(lastsrv.upcserv));
                    }
                    else {
                        $('.upcmg_srv').html("------");
                    }

                    if (typeof(lastsrv.lastsrvdt) != "undefined" && lastsrv.lastsrvdt != "0000-00-00" && lastsrv.lastsrvdt !== null) {
                        $('.lastsrv').html(ctm2_formatDate(lastsrv.lastsrvdt));
                    }
                    else {
                        $('.lastsrv').html("------");
                    }

                    $('.odomtr').html(lastsrv.odometer);

                    if (lastsrv.doneby == 1) {
                        $('.done_by').html("Company");
                    }
                    else if (lastsrv.doneby == 2) {
                        $('.done_by').html("Out Side");   
                    }
                    
                });
			$('#dltModal1').modal('show'); 
            }
        });
    }
    

  function service_remove(ob)
	{
		var rowid = $(ob).closest('tr').attr('id');
		
		$("#"+rowid).remove();

	//	calc_servicetotals();

		$(".sl_id").each(function(i){
			$(this).text(i+1);
		});

		$("#service_tbody > tr").each(function(k) {
			$(this).attr('id', 'r_' + (k));
		});
		grand_total();

	}
$( document ).ready(function() {
 $('.add_row_new').on('click', function() {
 	var vehicle = '';
 	var servicetype = '';
 	var servicedetails = '';

 	$.each(vehicle_arr, function(key, value) {
				vehicle += '<option value="'+value.id+'">'+value.name+value.license+'</option>';
			});
 	$.each(servicetype_arr, function(key, value) {
				servicetype += '<option value="'+value.id+'">'+value.name+'</option>';
			});
 	$.each(servicedetail_arr, function(key, value) {
				servicedetails += '<option value="'+value.id+'">'+value.name+'</option>';
			});
 
      var tr_id = document.getElementById("service_tbl").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
        	
        	var sl_no = tr_id + 1;
        var	td_Id =tr_id;

          var tr = '<tr id="r_'+tr_id+'">\
						<td class="sl_id">'+sl_no+'</td>\
						<td>\
							<select class="form-control kt-selectpicker" data-id="'+sl_no+'" id="vehicle'+sl_no+'" name="vehicle[]">\
							<option value="">Select</option>'+vehicle+'\
							</select>\
						</td>\
						<td>\
						 <select class="form-control kt-selectpicker getservdetaial1" id="servicetyp'+sl_no+'" data-id="servicetyp'+sl_no+'" name="servicetyp[]">\
										<option value="">Select</option>'+servicetype+'\
									 </select>\
						</td>\
						<td>\
							<select class="form-control kt-selectpicker" id="servdetail'+sl_no+'" name="servdetail[]" >\
										<option value="">Select</option>'+servicedetails+'\
									 </select>\
						</td>\
						<td>\
							<input type="text" class="form-control" data-id="'+sl_no+'" id="description'+sl_no+'" name="description[]" value="">\
						</td>\
						<td>\
							<input type="text" class="form-control" data-id="'+sl_no+'" id="odometer'+sl_no+'" name="odometer[]" value="">\
						</td>\
						<td>\
							<input type="date" name="upcoming_service[]" data-id="'+sl_no+'" id="upcoming_service'+sl_no+'" class="form-control ktdatepicker" value="" placeholder="dd-mm-yyyy" autocomplete="off">\
						</td>\
						<td>\
								<input type="text" class="form-control" data-id="'+sl_no+'" id="upcoming_reminder'+sl_no+'" name="upcoming_reminder[]" value="">\
						</td>\
						<td>\
							<input type="text" class="form-control service_amount" data-id="'+sl_no+'" id="service_amount'+sl_no+'" name="service_amount[]" value="">\
						</td>\
						<td>\
							<input type="text" class="form-control vat" data-id="'+sl_no+'" id="vat'+sl_no+'" name="vat[]" value="">\
							<input type="hidden" class="form-control vatamount" data-id="'+sl_no+'" id="vatamount'+sl_no+'" name="vatamount[]" value="">\
						</td>\
						<td>\
								<input type="text" class="form-control total" data-id="'+sl_no+'" id="total'+sl_no+'" name="total[]" value="">\
						</td>\
						<td>\
								<div class="btn-group" role="group" aria-label="First group">\
								<button type="button" class="btn btn-outline-danger btn-sm" onclick="service_remove(this)" title="Remove"><i class="la la-trash-o"></i></button>\
<button type="button" class="btn btn-outline-info btn-sm" onclick="get_lastsrvdetails1('+sl_no+')" title="Remove"><i class="la la-calendar"></i></button>\
							</div>\
						</td>\
					</tr>';

			$("#service_tbl > tbody:last-child").append(tr);
				});
 		});

$(document.body).on("change", ".service_amount", function() 
	{    
		var id = $(this).attr('data-id');
		var serviceamnt = $('#service_amount'+id+'').val();
		var vat  = $('#vat'+id+'').val();
		rowcalculate_totalamount(serviceamnt,vat,id)
		
	});
$(document.body).on("change", ".vat", function() 
	{    
		var id = $(this).attr('data-id');
		var serviceamnt = $('#service_amount'+id+'').val();
		var vat  = $('#vat'+id+'').val();
		
		rowcalculate_totalamount(serviceamnt,vat,id)
		
	});
function rowcalculate_totalamount(serviceamnt,vat,id){
	
		var row_total = '';
		row_total_service_amount = '';
		var totalvat = '';
		
		if(isNaN(serviceamnt) || serviceamnt=='' || isNaN(vat) || vat=='')
		{
			$('#total'+id+'').val('');
		}
		else
		{
			 totalvat = (serviceamnt / 100) * (vat) 
			
			row_total_service_amount = parseFloat(serviceamnt)+parseFloat(totalvat);
			
			$('#total'+id+'').val(row_total_service_amount);
			$('#vatamount'+id+'').val(totalvat);
			
			
		grand_total();
			
		}
		
}
function grand_total(totalvat)
{
	 var grandtotal = 0;
	var service_grandtotal = 0;
	var vat_total = 0;


	$('#service_totlamt').val('');
	$('.total').each(function(){
		var id = $(this).attr('data-id');
		// var rate = $('#rate'+id+'').val();
		var amount = $('#total'+id+'').val();
		
	grandtotal+= parseFloat(amount);
	});

	$('.service_amount').each(function(){
		var id = $(this).attr('data-id');
		// var rate = $('#rate'+id+'').val();
		var amount1 = $('#service_amount'+id+'').val();
		
	 service_grandtotal+= parseFloat(amount1);
	});

	$('.vatamount').each(function(){
		var id = $(this).attr('data-id');
		// var rate = $('#rate'+id+'').val();
		var amount2 = $('#vatamount'+id+'').val();
		
	 vat_total+= parseFloat(amount2);
	});
	

	$('#service_totlamt').val(service_grandtotal);
	$('#vat_totlamt').val(vat_total);
	$('#grand_totlamt').val(grandtotal);
}
$(document.body).on("change", ".paid_totlamt", function() 
	{    
		var total_amount = $('#service_totlamt').val();
		var paid_amount = $('#paid_totlamt').val();
		var balance = parseFloat(total_amount) - parseFloat(paid_amount);
		$('#due_totlamt').val(balance);
	});



$("#servicepay_submit").click(function(e) {
		e.preventDefault();
		
		var type     	= $("#suppliervendor_type").val();
		var name        = $("#srvvendor").val();

		if (type == "") {
			$('#suppliervendor_type').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#suppliervendor_type').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
	
		
		$("#servicepayForm").attr("action",base_url+"Home/service_pay_submit");
		$("#servicepayForm").submit();
	});


$("#purchasepay_submit").click(function(e) {
		e.preventDefault();
		
		var type     	= $("#suppliervendor_type").val();
		var name        = $("#srvvendor").val();

		if (type == "") {
			$('#suppliervendor_type').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#suppliervendor_type').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
	
		
		$("#servicepayForm").attr("action",base_url+"Home/purchase_pay_submit");
		$("#servicepayForm").submit();
	});


$("#servnew_update").click(function(e) {
		e.preventDefault();
		
		var id          = $("input[name='id']").val();
		var type     	= $("#suppliervendor_type").val();
		var name        = $("#srvvendor").val();
		var ledger      = $("#maintainance_ledger").val();
		var invoice_no  = $("#invoice_number").val(); 
		var mode        = $("#mode_of_operation").val(); // added on 26-02-2021
		var doneby      = $("#done").val();
		var date        = $("#doned").val();

		if (type == "") {
			$('#suppliervendor_type').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#suppliervendor_type').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (ledger == "") {
			$('#maintainance_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#maintainance_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (invoice_no == "") {
			$("#invoice_number").addClass('is-invalid');
			$("#invoice_number").focus();
			return false;
		}
		else {
			$("#invoice_number").removeClass('is-invalid');
		}
		if (mode == "") {
			$('#mode_of_operation').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#mode_of_operation').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		
		if (doneby == "") {
			$('#done').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#done').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (date == "") {
			$("#doned").addClass('is-invalid');
			$("#doned").focus();
			return false;
		}
		else {
			$("#doned").removeClass('is-invalid');
		}
		
		$("#servnewForm_edit").attr("action",base_url+"Common/db_add_update");
		$("#servnewForm_edit").submit();
	});



	$("#common_settings_submit").click(function(e) {
		e.preventDefault();
		
		var pledger          = $("#purchase_maintainance_ledger").val();
		var sledger     	 = $("#service_maintainance_ledger").val();
		

		if (pledger == "") {
			$('#purchase_maintainance_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#purchase_maintainance_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (sledger == "") {
			$('#service_maintainance_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#service_maintainance_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		
		
		$("#commonsettingsForm").attr("action",base_url+"Common/db_add_update");
		$("#commonsettingsForm").submit();
	});

	
		$("#common_settings_update").click(function(e) {
		e.preventDefault();
		
		var pledger          = $("#purchase_maintainance_ledger").val();
		var sledger     	 = $("#service_maintainance_ledger").val();
		

		if (pledger == "") {
			$('#purchase_maintainance_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#purchase_maintainance_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		if (sledger == "") {
			$('#service_maintainance_ledger').next().find('.select2-selection').addClass('select-dropdown-error');
			return false;
		}
		else {
			$('#service_maintainance_ledger').next().find('.select2-selection').removeClass('select-dropdown-error');
		}
		
		
		$("#commonsettingseditForm").attr("action",base_url+"Common/db_add_update");
		$("#commonsettingseditForm").submit();
	});

		

function commonsettingsDeleteFn(id) {
	var tbl  = 'qfleet_common_settings';
	var url  = 'common_settings';
	var mssg = 'common_settings';

	swal.fire({
		title: del_lang1,
		text: del_lang2,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: del_lang3,
		cancelButtonText: del_lang4 }).then(result => {
		if (result.value) {

			$.ajax({
				type: "POST",
				url : base_url+'home/comm_dltaction_delete_new',
				dataType: 'JSON',
				data: {id:id, url:url, mssg:mssg, table:tbl},
				success: function(data) {

					driver_dtable.ajax.reload();
					if (data.flagg == "Success") {
						swal.fire(del_lang9, del_lang10, "success");
					}
					else {
						swal.fire(del_lang7, del_lang8+".", "error");
					}
				}
			});

		} else {
		  swal.fire(del_lang5, del_lang6, "error");
		}
	  });

}