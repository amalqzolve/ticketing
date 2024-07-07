var employeeId;
var employee_name;
var event_employeeId;
var event_employeename;
var depend_employeeId;
var depend_employeename;
var ectg_tab;
var deptmntId;
var designId;
var empId;
var empna;

var datatable_user;
var datatable_branch;
var datatable_dept;
var datatable_designation;
var datatable_employee;
var datatable_family;
var datatable_relational;
var datatable_ethnicinfo;
var datatable_socialinfo;
var datatable_officeinfo;
var datatable_iddetails;
var datatable_badge;
var datatable_insuranceinfo;
var datatable_gpinsrc;
var datatable_bankinfo;
var datatable_drivinglicense;
var datatable_passport;
var datatable_worklicense;
var datatable_educational;
var datatable_certifications;
var datatable_referal;
var datatable_employee_pre;
var datatable_previousdetail_company;
var datatable_achievements;
var datatable_keyskill;
var datatable_language;
var datatable_jobposition;
var datatable_empmilestone;
var datatable_hiring;
var datatable_laborinfo;
var datatable_workinfo;
var datatable_iqama;
var datatable_benefitactivation;
var datatable_sponsors;
var datatable_visaprofession;
var datatable_hospitals;
var datatable_insuranceproviders;
var datatable_dependent_employee;
var datatable_employee_dependents;
var datatable_employee_event;
var datatable_employevents_event;
var datatable_userrole;
var datatable_building;
var datatable_floor;
var datatable_roomno;
var datatable_passport_notification;
var datatable_badge_notification;
var datatable_event_notification;
var datatable_insurance_notification;
var datatable_driving_notification;
var datatable_worklicense_notification;
var datatable_id_notification;
var datatable_iqama_notification;
var datatable_labourlaw_notification;
var datatable_labourcontract_notification;
var datatable_companycontract_notification;
var datatable_setting_sponsors;
var datatable_setting_visaproffession;
var datatable_setting_hospital;
var datatable_setting_insuranceprovider;
var datatable_benefitcategory;
var datatable_benefits;
var datatable_employee_status;
var datatable_employee_relation;
var datatable_termination_reason;
var datatable_setting_events;
var employee_accounting_details;
var datatable_inhouse;
var datatable_outsponsor;
var datatable_outsource;
var datatable_saudinatl;
var datatable_documentcontroller;
var datatable_emptrasfer;

var datatable_employgpdept;
var datatable_employgpdesig;
var datatable_employgpdept_indv;
var datatable_employgpdesg_indv;
var datatable_indivdependant;

$(document).ready(function() {
    
    /********************************
    * Admin Table                   *
    ********************************/
	datatable_user = $('#datatable-user').KTDatatable({
		// datasource definition
		  data: {
		    type: 'remote',
		    source: {
		      read: {
		        url: base_url+'table/user_list',
		        map: function(raw) {
		          // sample data mapping
		          var dataSet = raw;
		          if (typeof raw.data !== 'undefined') {
		            dataSet = raw.data;
		          }
		          return dataSet;
		        },
		      },
		    },
		    // pageSize: 10,
		    serverPaging: true,
		    serverFiltering: true,
		    serverSorting: true,
		  },

		 // layout definition
		  layout: {
		    scroll: true,
		    footer: false,
		  },

		  // column sorting
  		  sortable: true,

		  pagination: true,

		  search: {
		    input: $('#generalSearch'),
		  },
		  columns: [
		    {
		      field: 'slno',
		      title: '#',
		      sortable: 'asc',
		      width: 40,
		      type: 'number',
		      selector: false,
		      textAlign: 'center',
		    }, {
		      field: 'dp',
		      title: 'Dp',
		    }, {
		      field: 'name',
		      title: 'Name',
		      /*template: function(row, index, datatable) {
		        return row.f_name + ' ' + row.l_name;
		      },*/
		    }, {
		      field: 'username',
		      width: 150,
		      title: 'Username',
		    }, {
		      field: 'created_dt',
		      title: 'Created',
		    }, {
		      field: 'action',
		      title: 'Actions',
		      sortable: false,
		      width: 130,
		      overflow: 'visible',
		      textAlign: 'center'/*,
		      template: function(row, index, datatable) {
		        var dropup = (datatable.getPageSize() - index) <= 4 ? 'dropup' : '';
		        return '<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
		                        <i class="flaticon2-paper"></i>\
		                    </a>\
		                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete">\
		                        <i class="flaticon2-trash"></i>\
		                    </a>';
		      },*/
		    }]
	});

    /**********************************
    * Branch Table                    *
    **********************************/
	datatable_branch = $('#datatable-branch').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/branch_list',
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

	/************************************
	* Department Table                  *
	************************************/
	datatable_dept = $('#datatable-dept').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/dept_list',
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

	/**************************************
	* Designation Table                   *
	**************************************/
	datatable_designation = $('#datatable-designation').DataTable({
        "bDestroy": true,
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/designation_list',
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

	/***************************************
	* Employee Table                       *
	***************************************/
	datatable_employee = $('#datatable-employee').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7,8,9]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7,8,9]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7,8,9]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7,8,9]
                },
                orientation: 'landscape',
                pageSize: 'A3',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7,8,9]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employee_list',
            type : 'POST'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 1 ],
                "orderable": false,
            },
            { 
                "targets": [ 10 ],
                "orderable": false,
            },/*
            { 
                "targets": [ 8 ],
                "orderable": false,
            },*/
        ],
    "fnDrawCallback": function(settings){
    $('[data-toggle="tooltip"]').tooltip();          
    }
   });

   /****************************************
   * Family Table                          *
   ****************************************/
   	datatable_family = $('#datatable_family').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                },
                orientation: 'landscape',
                pageSize: 'A3',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.content[1].table.widths = [ '3%',  '13%', '10%', '13%', 
                                                           '13%', '12%', '12%', '12%', '12%'];
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/family_list',
            type : 'POST'
        },
            "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 9 ],
                "orderable": false,
            },
        ],
    	"fnDrawCallback": function(settings){
    		$('[data-toggle="tooltip"]').tooltip();          
    	}
	});

	/***************************************
	* Relational Info Table                *
	***************************************/
	datatable_relational = $('#datatable_relational').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/relational_list',
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
            },/*
            { 
                "targets": [ 8 ],
                "orderable": false,
            },*/
        ],
	    "fnDrawCallback": function(settings){
	    	$('[data-toggle="tooltip"]').tooltip();          
	    }
	});

	/***************************************
	* Ethnic Info Table                    *
	***************************************/
	datatable_ethnicinfo = $('#datatable_ethnicinformation').DataTable({
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
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/ethnicinformation_list',
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
            },/*{ 
                "targets": [ 7 ],
                "orderable": false,
            },*/
        ],
    	"fnDrawCallback": function(settings){
    		$('[data-toggle="tooltip"]').tooltip();          
    	}
	});

	/***************************************
	* Social Info Table                    *
	***************************************/
	datatable_socialinfo = $('#datatable_socialinfo').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                orientation: 'landscape',
                pageSize: 'A3',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        // "scrollX": true,
        // "scrollY": '120vh',
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/socialinfo_list',
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

    /****************************************
    * Employee Keyskill                     *
    ****************************************/
    datatable_keyskill = $('#datatable_keyskill').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/keyskill_list',
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
    * Language Proficiency                  *
    ****************************************/
    datatable_language = $('#datatable_language').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/language_list',
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
            },/*
            { 
                "targets": [ 8 ],
                "orderable": false,
            },*/
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***************************************
    * Educational Info                     *
    ***************************************/
    datatable_educational = $('#datatable_educational').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                orientation: 'landscape',
                pageSize: 'A3',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/educational_list',
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
            { 
                "targets": [ 4 ],
                "orderable": false,
            },
            { 
                "targets": [ 8 ],
                "orderable": false,
            },/*{ 
                "targets": [ 9 ],
                "orderable": false,
            },*/
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***************************************
    * Certifications                       *
    ***************************************/
    datatable_certifications = $('#datatable_certifications').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/certifications_list',
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
            { 
                "targets": [ 4 ],
                "orderable": false,
            },
            { 
                "targets": [ 5 ],
                "orderable": false,
            },
            { 
                "targets": [ 6 ],
                "orderable": false,
            }/*,
            { 
                "targets": [ 7 ],
                "orderable": false,
            },*/
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /****************************************
    * Employee Achievements                 *
    ****************************************/
    datatable_achievements = $('#datatable_achievements').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/achievement_list',
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
            { 
                "targets": [ 4 ],
                "orderable": false,
            },
            { 
                "targets": [ 5 ],
                "orderable": false,
            },
            { 
                "targets": [ 6 ],
                "orderable": false,
            },/*{ 
                "targets": [ 7 ],
                "orderable": false,
            },*/
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /****************************************
    * ID Details Table                      *
    ****************************************/
    datatable_iddetails = $('#datatable_iddetails').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                    doc.content[1].table.widths = [ '4%',  '15%', '10%', '13%', 
                                                           '8%', '12%', '12%', '12%', '7%', '7%'];
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        // "scrollX": true,
        // "scrollY": '120vh',
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/iddetails_list',
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
            },/*{ 
                "targets": [ 11 ],
                "orderable": false,
            },*/
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /****************************************
    * Driving License                       *
    ****************************************/
    datatable_drivinglicense = $('#datatable_drivinglicense').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                    doc.content[1].table.widths = [ '5%',  '21%', '10%', '14%', 
                                                           '12%', '12%', '7%', '7%', '4%', '8%'];
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/drivinglicense_list',
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
            { 
                "targets": [ 9 ],
                "orderable": false,
            },
            { 
                "targets": [ 10 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***************************************
    * Passport Details                     *
    ***************************************/
    datatable_passport = $('#datatable_passport').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                },
                pageSize: 'A3',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.content[1].table.widths = [ '4%',  '23%', '13%', '18%', 
                                                            '10%', '8%', '8%', '8%', '8%'];
                },
                orientation: 'landscape'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/passport_list',
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
            { 
                "targets": [ 8 ],
                "orderable": false,
            },
            { 
                "targets": [ 9 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /****************************************
    * Bank Info                             *
    ****************************************/
    datatable_bankinfo = $('#datatable_bankinfo').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                    doc.content[1].table.widths = [ '5%', '20%', '10%', '8%', 
                                                           '8%', '15%', '8%', '12%', 
                                                                '6%', '8%'];
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        /*"scrollX": true,
        "scrollY": '120vh',*/
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/bankinfo_list',
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
            },/*{ 
                "targets": [ 11 ],
                "orderable": false,
            },*/
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

	/****************************************
	* Office Info Table                     *
	****************************************/	
	datatable_officeinfo = $('#datatable_officeinfo').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        /*"scrollX": true,
        "scrollY": '120vh',*/
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/officeinfo_list',
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

	/****************************************
	* Badge Info                            *
	****************************************/
	datatable_badge = $('#datatable_badge').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        // "scrollX": true,
        // "scrollY": '120vh',
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/badge_list',
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
            }/*,
            { 
                "targets": [ 11 ],
                "orderable": false,
            },*/
        ],
    	"fnDrawCallback": function(settings){
    		$('[data-toggle="tooltip"]').tooltip();          
    	}
	});

	
	/*****************************************
	* Insurance Info                         *
	*****************************************/
	datatable_insuranceinfo = $('#datatable_insuranceinfo').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                },
                pageSize: 'A3',
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.content[1].table.widths = [ '4%',  '14%', '10%', '10%', 
                                                           '8%', '11%', '8%', '7%', 
                                                                '7%', '7%', '7%', '7%'];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "scrollX": true,
        "scrollY": '120vh',
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/insuranceinfo_list',
            type : 'POST'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 12 ],
                "orderable": false,
            },/*{ 
                "targets": [ 13 ],
                "orderable": false,
            },*/
        ],
    	"fnDrawCallback": function(settings){
    		$('[data-toggle="tooltip"]').tooltip();          
    	}
	});

    /***************************************
    * Detail : Group Insurance             *
    * Date   : 04-03-2021                  *
    ***************************************/
    datatable_gpinsrc = $('#datatable_gpinsrc').DataTable({
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
                    /*doc.content[1].table.widths = [ '4%',  '14%', '10%', '10%', 
                                                           '8%', '11%', '8%', '7%', 
                                                                '7%', '7%', '7%', '7%'];*/
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/gpinsurance_list',
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
            { 
                "targets": [ 5 ],
                "orderable": false,
            },
            { 
                "targets": [ 6 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

	/***************************************
	* Work License                         *
	***************************************/
	datatable_worklicense = $('#datatable_worklicense').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                    columns: [0,1,2,3,4,5,6,7,]
                },
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.content[1].table.widths = [ '6%',  '22%', '14%', '16%', 
                                                           '13%', '13%', '8%', '8%'];
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/worklicense_list',
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
            },/*{ 
                "targets": [ 9 ],
                "orderable": false,
            },*/
        ],
    	"fnDrawCallback": function(settings){
    		$('[data-toggle="tooltip"]').tooltip();          
    	}
	});

    /**************************************
    * Hiring Info                         *
    **************************************/
    datatable_hiring = $('#datatable_hiring').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
                },
                orientation: 'landscape',
                pageSize: 'A3',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.content[1].table.widths = [ '4%', '16%', '10%', '6%', 
                                                           '6%', '6%', '7%', '7%', 
                                                                '6%', '6%', '6%', '6%',
                                                                    '7%', '7%'];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        //"scrollX": true,
        "scrollY": '120vh',
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/hiring_list',
            type : 'POST'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 14 ],
                "orderable": false,
            },/*{ 
                "targets": [ 15 ],
                "orderable": false,
            },*/
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /*****************************************
    * Labour Info                            *
    *****************************************/
    datatable_laborinfo = $('#datatable_laborinfo').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/laborinfo_list',
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
            { 
                "targets": [ 4 ],
                "orderable": false,
            },
            { 
                "targets": [ 5 ],
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

	/***************************************
	* Refferal Info                        *
	***************************************/
	datatable_referal = $('#datatable_referal').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    // doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
                    // doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
                    doc.content[1].table.widths = [ '7%', '20%', '15%', '12%', 
                                                           '19%', '17%', '10%'];
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/referal_list',
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
            { 
                "targets": [ 7 ],
                "orderable": false,
            },/*{ 
                "targets": [ 8 ],
                "orderable": false,
            },*/
        ],
    	"fnDrawCallback": function(settings){
    		$('[data-toggle="tooltip"]').tooltip();          
    	}
	});

	/****************************************
	* Employee Previous Details             *
	****************************************/
	datatable_employee_pre = $('#datatable-employee_pre').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,2,3]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,2,3]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,2,3]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,2,3]
                },
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    // doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,2,3]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employee_pre_list',
            type : 'POST'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 1 ],
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

    /****************************************
    * Employee Previous Details Company List*
    ****************************************/
    datatable_previousdetail_company = $('#datatable-previousdet_company').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7]
                },
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/previousdetail_companylist',
            type : 'POST',
            data : {employeeId:employeeId, employee_name:employee_name}
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 7 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /*************************************
    * Employment Milestone               *
    *************************************/
    datatable_empmilestone = $('#datatable_empmilestone').DataTable({
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
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    // doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/empmilest_list',
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
            { 
                "targets": [ 4 ],
                "orderable": false,
            },
            { 
                "targets": [ 5 ],
                "orderable": false,
            }/*{ 
                "targets": [ 6 ],
                "orderable": false,
            }*/
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

	/***************************************
	* Desired Job Position                 *
	***************************************/
	datatable_jobposition = $('#datatable_jobposition').DataTable({
        "bDestroy": true,
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
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    // doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/jobposition_list',
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
            { 
                "targets": [ 4 ],
                "orderable": false,
            }
        ],
    	"fnDrawCallback": function(settings){
    		$('[data-toggle="tooltip"]').tooltip();          
    	}
	});

    /**************************************
    * Passport Notification               *
    **************************************/
    datatable_passport_notification = $('#datatable-passport_notification').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    // doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/passport_notification',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /****************************************
    * badge Notification                    *
    ****************************************/
    datatable_badge_notification = $('#datatable-badge_notification').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    // doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/badge_notification',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });
    /*****************************************
    * insurance Notification                 *
    *****************************************/
    datatable_insurance_notification = $('#datatable-insurance_notification').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    // doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/insurance_notification',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /**************************************
    * driving license Notification        *
    **************************************/
    datatable_driving_notification = $('#datatable-drivinglicense_notification').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/drivinglicense_notification',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });
    /***************************************
    * work license Notification            *
    ***************************************/
    datatable_worklicense_notification = $('#datatable-worklicense_notification').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/worklicense_notification',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /*****************************************
    * id Notification                        *
    *****************************************/
    datatable_id_notification = $('#datatable-id_notification').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/id_notification',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });
    
    /*****************************************
    * Iqama/Bitaqa Notification              *
    *****************************************/
    datatable_iqama_notification = $('#datatable-iqama_notification').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,12,13]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,12,13]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,12,13]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,12,13]
                },
                pageSize: 'A3',
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.content[1].table.widths = [ '5%', '15%', '10%', '7%', 
                                                           '9%', '6%', '6%', '6%', 
                                                                '6%', '4%', '6%'];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,12,13]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        /*"scrollX": true,
        "scrollY": '120vh',*/
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/iqama_bitaqa_notification',
            type : 'POST'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 11 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /*****************************************
    * Labour Law Notification                *
    *****************************************/
    datatable_labourlaw_notification = $('#datatable-laborlaw_notification').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/labourlaw_notification',
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
            { 
                "targets": [ 6 ],
                "orderable": false,
            },
            { 
                "targets": [ 7 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /*****************************************
    * Labour Contract Notification           *
    *****************************************/
    datatable_labourcontract_notification = $('#datatable-laborcontract_notification').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/labourcontract_notification',
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
            { 
                "targets": [ 6 ],
                "orderable": false,
            },
            { 
                "targets": [ 7 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /*****************************************
    * Company Contract Notification           *
    *****************************************/
    datatable_companycontract_notification = $('#datatable-companycontract_notification').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/companycontract_notification',
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
            { 
                "targets": [ 6 ],
                "orderable": false,
            },
            { 
                "targets": [ 7 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /**************************************
    * Event Notification                  *
    **************************************/
    datatable_event_notification = $('#datatable-event_notification').DataTable({
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
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.content[1].table.widths = [ '8%', '25%', '15%', '15%', 
                                                           '9%', '28%'];
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/event_notification',
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
            { 
                "targets": [ 7 ],
                "orderable": false,
            },
            { 
                "targets": [ 8 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * Work Information                 *
    ***********************************/
    datatable_workinfo = $('#datatable_workinfo').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3,4,5,7,8,9]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4,5,7,8,9]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4,5,7,8,9]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3,4,5,7,8,9]
                },
                pageSize: 'A3',
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
                    doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
                    // doc.content[1].table.widths = [ '2%',  '14%', '14%', '14%', 
                                                           // '14%', '14%', '14%', '14%'];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,7,8,9]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        // "scrollX": true,
        // "scrollY": '120vh',
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/workinfo_list',
            type : 'POST'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 9 ],
                "orderable": false,
            }/*,
            { 
                "targets": [ 11 ],
                "orderable": false,
            }*/
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * Iqama/Bitaqa Details             *
    ***********************************/
    datatable_iqama = $('#datatable_iqama').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        /*"scrollY":        480,
        "deferRender":    true,
        "scroller":       true,*/
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                },
                orientation: 'landscape',
                pageSize: 'A3',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.content[1].table.widths = [ '5%', '20%', '10%', '10%', 
                                                           '8%', '8%', '8%', '6%', 
                                                                '6%', '8%', '11%'];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "scrollX": true,
        "scrollY": '100vh',
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/iqama_list',
            type : 'POST'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 11 ],
                "orderable": false,
            }/*{ 
                "targets": [ 15 ],
                "orderable": false,
            }*/
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * Benefit Activation               *
    ***********************************/
    datatable_benefitactivation = $('#datatable_benefitactivation').DataTable({
        "bDestroy": true,
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/benefitactivation_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * Sponsor Information              *
    ***********************************/
    datatable_sponsors = $('#datatable_sponsors').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/sponsor_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * VISA Profession Information      *
    ***********************************/
    datatable_visaprofession = $('#datatable_visaprofession').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/visaprofession_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * Hospital Information             *
    ***********************************/
    datatable_hospitals = $('#datatable_hospitals').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/hospital_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * Insurance Provider Details       *
    ***********************************/
    datatable_insuranceproviders = $('#datatable_insuranceproviders').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/insuranceprovider_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /****************************************
    * DEpendent Employee Details            *
    ****************************************/
    datatable_dependent_employee = $('#datatable-dependent_employee').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,2,3]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,2,3]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,2,3]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,2,3]
                },
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,2,3]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/dependent_employee_list',
            type : 'POST'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 1 ],
                "orderable": false,
            },
            { 
                "targets": [ 4 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /****************************************
    * Employee Dependant Details            *
    ****************************************/
    datatable_employee_dependents = $('#datatable-employee_dependents').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url  : base_url+'table/employeedependant_list',
            type : 'POST',
            data : {employeeId:depend_employeeId, depend_employeename:depend_employeename}
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 1 ],
                "orderable": false,
            },
            { 
                "targets": [ 7 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /****************************************
    * Employee Events Table                 *
    ****************************************/
    datatable_employee_event = $('#datatable_employee_event').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,2,3,4]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,2,3,4]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,2,3,4]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,2,3,4]
                },
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,2,3,4]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employee_event_list',
            type : 'POST'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 1 ],
                "orderable": false,
            },
            { 
                "targets": [ 5 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /********************************************
    * Event List of Employee Events (View Event)*
    ********************************************/
    datatable_employevents_event = $('#datatable-employevents_events').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/viewemployee_events',
            type : 'POST',
            data : {employeeId:event_employeeId, event_employeename:event_employeename}
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 1 ],
                "orderable": false,
            },
            { 
                "targets": [ 5 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /************************************
    * Employee Category List            *
    ************************************/
    // For Inhouse
    datatable_inhouse = $('#datatable-inhouse').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                },
                pageSize: 'A3',
                orientation: 'landscape'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employcategry_list',
            type : 'POST',
            data : { ectg_tab : 'inhouse' }
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

    // For Out Sponsorship
    datatable_outsponsor = $('#datatable-outsponsor').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                },
                pageSize: 'A3',
                orientation: 'landscape'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employcategry_list',
            type : 'POST',
            data : { ectg_tab : 'outsponsorshp' }
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

    // Outsource
    datatable_outsource = $('#datatable-outsource').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                },
                pageSize: 'A3',
                orientation: 'landscape'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employcategry_list',
            type : 'POST',
            data : { ectg_tab : 'outsource' }
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

    // Saudi National
    datatable_saudinatl = $('#datatable-saudinational').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                },
                pageSize: 'A3',
                orientation: 'landscape'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employcategry_list',
            type : 'POST',
            data : { ectg_tab : 'saudinational' }
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

    /**************************************
    * Document Controller                 *
    **************************************/
    datatable_documentcontroller = $('#datatable-documentcontroller').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.content[1].table.widths = [ '8%', '25%', '15%', '15%', 
                                                           '11%', '6%', '20%'];
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/document_controller',
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
            { 
                "targets": [ 6 ],
                "orderable": false,
            },
            { 
                "targets": [ 7 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /**************************************
    * Detail : Employee Transfer          *
    * Date   : 12-04-2021                 *
    **************************************/
    datatable_emptrasfer = $('#datatable_employtransfer').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employtransfer_list',
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
            { 
                "targets": [ 4 ],
                "orderable": false,
            },
            { 
                "targets": [ 5 ],
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

    /******************************************************
    * Office Details Tables (General Settings)            *
    ******************************************************/
    // ------------------For Building --------------------
    datatable_building = $('#datatable_offc_building').DataTable({
        "bDestroy": true,
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/building_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    //-------------------For Floor ---------------------------
    datatable_floor = $('#datatable_offc_floor').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/floor_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    //-------------------For Room No -----------------------
    datatable_roomno = $('#datatable_offc_room').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/room_no_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /******************************************
    * Employee Status                         *
    ******************************************/
    datatable_employee_status = $('#datatable_employee_status').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/status_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

	/***********************************
	* Userrole (General Settings)      *
	***********************************/
	datatable_userrole = $('#datatable-userrole').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/userrole_list',
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
            }
        ],
    	"fnDrawCallback": function(settings){
    		$('[data-toggle="tooltip"]').tooltip();          
    	}
	});

    /***********************************
    * Sponsor (HRM Setting)            *
    ***********************************/
    datatable_setting_sponsors = $('#datatable_visadet_sponsor').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/settings_sponsor_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * VISA Professions (HRM Setting)   *
    ***********************************/
    datatable_setting_visaproffession = $('#datatable_visadet_visaproffession').DataTable({
        "bDestroy": true,
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/settings_visaprofession_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * Hospitals (HRM Setting)          *
    ***********************************/
    datatable_setting_hospital = $('#datatable_meddetail_hospital').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/settings_hospital_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * Insurance Provider (HRM Setting) *
    ***********************************/
    datatable_setting_insuranceprovider = $('#datatable_meddetail_insuranceprovider').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/settings_insuranceprovider_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /**************************************
    * Benefit Category (Benefit Settings) *
    **************************************/
    datatable_benefitcategory = $('#datatable_benefitcategory').DataTable({
        "bDestroy": true,
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/benefitcategory_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * Benefits (Benefit Settings)      *
    ***********************************/
    datatable_benefits = $('#datatable_benefits').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/benfits_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /**************************************
    * Employee Relations                    *
    **************************************/
    datatable_employee_relation = $('#datatable_employee_relation').DataTable({
        "bDestroy": true,
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employee_relation_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /**************************************
    * Termination Reason                    *
    **************************************/
    datatable_termination_reason = $('#datatable_termination_reason').DataTable({
        "bDestroy": true,
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/terminate_reason_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });  

    /***********************************
    * Events (HRM Setting)             *
    ***********************************/
    datatable_setting_events = $('#datatable_events').DataTable({
        "bDestroy": true,
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/settings_events_list',
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
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***********************************
    * Detail : Quick View Individual   *
                Dependant List         *
    * Date   : 07-04-2021              *
    ***********************************/
    datatable_indivdependant = $('#datatable_qvdepd_indiv').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url  : base_url+'table/qvindivdependant_list',
            type : 'POST',
            data : {employeeId:empId, depend_employeename:empna}
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

employee_accounting_details = $('#datatable_employee_accounting_details').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',

        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,2,3,4]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,2,3,4]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,2,3,4]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,2,3,4]
                },
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,2,3,4]
                }
            }
        ],
        "pagingType": 'full_numbers',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employee_accounting_details_list',
            type : 'POST'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ 1 ],
                "orderable": false,
            },
            { 
                "targets": [ 5 ],
                "orderable": false,
            }
        ],
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
        }
    });

    /***************************************
    * Detail : Employee Group - Department *
    * Date   : 25-03-2021                  *
    ***************************************/
    datatable_employgpdept = $('#datatable_empgpdept').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employgp_deptlist',
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

    /***************************************
    * Detail : Employee Group - Designation *
    * Date   : 25-03-2021                  *
    ***************************************/
    datatable_employgpdesig = $('#datatable_empgpdesign').DataTable({
        "bDestroy": true,
        "dom": 'Blfrtip',
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url : base_url+'table/employgp_designlist',
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

    /***************************************
    * Detail : Employee Group - Department *
          Individual Employee Entries      *
    * Date   : 25-03-2021                  *
    ***************************************/
    datatable_employgpdept_indv = $('#datatable_empgpdept_indiv').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url  : base_url+'table/employgp_deptindivlist',
            data : { deptmntId : deptmntId},
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

    /***************************************
    * Detail : Employee Group - Department *
          Individual Employee Entries      *
    * Date   : 25-03-2021                  *
    ***************************************/
    datatable_employgpdesg_indv = $('#datatable_empgpdesg_indiv').DataTable({
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
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            url  : base_url+'table/employgp_desgindivlist',
            data : { desgnId : designId},
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

    

	/* ---------------------------------------------------------------*/
	/* ---------------------------------------------------------------*/

	/***************************************************
	* Show Image in Modal 							   *
	***************************************************/
	$(".thumbimg").click(function(){
	  	$a = $(this).attr("src");
	    $("#idimg").attr("src",$a);
	});

    $(".lawsign").click(function(){
        $a=$(this).attr("src");
        $("#mimg").attr("src",$a);
    });

    $(".contract").click(function(){
        $a=$(this).attr("src");
        $("#mimg1").attr("src",$a);
    });

    $(".contractsign").click(function(){
        $a=$(this).attr("src");
        $("#mimg2").attr("src",$a);
    });

// Hide the re-occuring field in Benefit Settings of Benefit Activation
$('.reoccuring').hide();

// Hide the re-occuring field in Benefit Settings of Dependant Benefit Activation
$('.dep_reoccuring').hide();

}); // End DOM

/**********************************
* Admin Add                       *
**********************************/
$("#userAdd_btn").click(function() {
    window.location.href = base_url+'home/userpg_add';
});

/*********************************
* Detail : Group Insurance Add   *
* Date   : 04-03-2021            *
*********************************/
$("#gpinsrcAdd_btn").click(function() {
    window.location.href = base_url+'home/groupinsrc_add';
});

/*********************************
* Branch Add                     *
*********************************/
$("#branchAdd_btn").click(function() {
    window.location.href = base_url+'home/branchpg_add';
});

/**********************************
* Department Add                  *
**********************************/
$("#deptAdd_btn").click(function() {
	window.location.href = base_url+'home/deptpg_add';
});

/**********************************
* Designation Add                 *
**********************************/
$("#designationAdd_btn").click(function() {
	window.location.href = base_url+'home/desgnpg_add';
});

/**********************************
* Employee Add                    *
**********************************/
$("#employeeAdd_btn").click(function() {
	window.location.href = base_url+'home/employeepg_add';
});

/**********************************
* Create Insurance Provider       *
**********************************/
$('#insurance_provider').on('change', function (e) {
    var insurance_provider = $('#insurance_provider').val();
    if (insurance_provider == "create_insuranceprovider") {
        $("#insurance_provider_btn").modal({backdrop: 'static'});
        $("#insurance_provider_btn").modal('show');
    } 
});

$('#insurance_provider_btn').on('hide.bs.modal', function (e) {
    $('#insurance_provider').val('').trigger('change');
    $('#insurance_company_documents').val('');
    $('#insrcdoc').text('Choose file');
    $('#insurance_provider_contact_details tbody > tr'). remove();
    $('#insurance_company-error').text('');
    $('#insrc_cperson_email-error').text('');
    $('#insrc_cperson_name-error').text('');
    $("#insurance_provider_form").trigger('reset');
});

/**********************************
* Create Insurance Category       *
**********************************/
$('#insurance_category').on('change', function (e) {
    var insurance_category = $('#insurance_category').val();
    if (insurance_category == "create_insurancecategory") {
        $("#insurance_category_btn").modal({backdrop: 'static'});
        $("#insurance_category_btn").modal('show');
    } 
});

$('#insurance_category_btn').on('hide.bs.modal', function (e) {
    $('#insurance_category').val('').trigger('change');
    $('#insurance_category_name-error').text('');
    $('#insurancectg_form').trigger('reset');
});

/**********************************
* Create Insurance Type           *
**********************************/
$('#insurance_type').on('change', function (e) {
    var insurance_type = $('#insurance_type').val();
    if (insurance_type == "create_insurancetype") {
        $("#insurance_type_btn").modal({backdrop: 'static'});
        $("#insurance_type_btn").modal('show');
    } 
});

$('#insurance_type_btn').on('hide.bs.modal', function (e) {
    $('#insurance_type').val('').trigger('change');
    $('#insurance_type_name-error').text('');
    $("#insurancetype_form").trigger('reset');
});

/**********************************
* Create Insurance Class           *
**********************************/
$('#insurance_class').on('change', function (e) {
    var insurance_class = $('#insurance_class').val();
    if (insurance_class == "create_insuranceclass") {
        $("#insurance_class_btn").modal({backdrop: 'static'});
        $("#insurance_class_btn").modal('show');
    } 
});

$('#insurance_class_btn').on('hide.bs.modal', function (e) {
    $('#insurance_class').val('').trigger('change');
});

/******************************************************
* Detail : Create Insurance Provider(Group Insurance) *
* Date   : 04-03-2021                                 *
******************************************************/
$('#gpinsrc_provider').on('change', function (e) {
    var insurance_provider = $('#gpinsrc_provider').val();
    if (insurance_provider == "create_insuranceprovider") {
        $("#gpinsurance_provider_btn").modal({backdrop: 'static'});
        $("#gpinsurance_provider_btn").modal('show');
    } 
});

$('#gpinsurance_provider_btn').on('hide.bs.modal', function (e) {
    $('#gpinsrc_provider').val('').trigger('change');
    $('#gpinsrc_company_documents').val('');
    $('#gpinsrcdoc').text('Choose file');
    $('#insurance_provider_contact_details tbody > tr'). remove();
    $('#gpinsrc_company-error').text('');
    $('#insrc_cperson_email-error').text('');
    $('#insrc_cperson_name-error').text('');
    $("#gpinsrc_provider_form").trigger('reset');
});

/*****************************************************
* Detail : Create Insurance Category(Group Insurance)*
* Date   : 04-03-2021                                *
*****************************************************/
$('#gpinsrc_category').on('change', function (e) {
    var insurance_category = $('#gpinsrc_category').val();
    if (insurance_category == "create_insurancecategory") {
        $("#gpinsurance_category_btn").modal({backdrop: 'static'});
        $("#gpinsurance_category_btn").modal('show');
    } 
});

$('#gpinsurance_category_btn').on('hide.bs.modal', function (e) {
    $('#gpinsrc_category').val('').trigger('change');
    $('#gpinsrc_category_name-error').text('');
    $('#gpinsrcctg_form').trigger('reset');
});

/*************************************************
* Detail : Create Insurance Type(Group Insurance)*
* Date   : 04-03-2021                            *
*************************************************/
$('#gpinsrc_type').on('change', function (e) {
    var insurance_type = $('#gpinsrc_type').val();
    if (insurance_type == "create_insurancetype") {
        $("#gpinsrc_type_btn").modal({backdrop: 'static'});
        $("#gpinsrc_type_btn").modal('show');
    } 
});

$('#gpinsrc_type_btn').on('hide.bs.modal', function (e) {
    $('#gpinsrc_type').val('').trigger('change');
    $('#gpinsrc_type_name-error').text('');
    $("#gpinsrctype_form").trigger('reset');
});

/**********************************
* Previous Detail Company Add     *
**********************************/
$("#prevousdet_companyAdd_btn").click(function() {
    window.location.href = base_url+'home/pre_det_employee?id='+employeeId+'&&emp_name='+employee_name;
});

/**********************************
* Employee Dependent Add          *
**********************************/
$("#dependentAdd_btn").click(function() {
    window.location.href = base_url+'home/add_dependent?id='+depend_employeeId+'&&d_id=0&&empname='+depend_employeename;
});

//Document Controller Add
$("#document_Add").click(function() {
    window.location.href = base_url+'home/document_Add?&&whichpg=1';
});

/**************************************
* Office Settings Building Add        *
**************************************/
$("#buildingAdd_btn").click(function() {
    window.location.href = base_url+'home/building_add';
});

/**************************************
* Office Settings Floor Add           *
**************************************/
$("#floorAdd_btn").click(function() {
    window.location.href = base_url+'home/floor_add';
});

/**************************************
* Office Settings Room Add            *
**************************************/
$("#roomAdd_btn").click(function() {
    window.location.href = base_url+'home/room_add';
});



/***********************************************
* Detail : Ajax of Building Dropdown for floor *
* Date   : 13-02-2020                          *
***********************************************/
$('#offc_flr_branch').on('change', function (e, data1) {
  $('#offc_flr_build').find('option').not(':first').remove();

    var branchid = $("#offc_flr_branch").val();
    $.ajax({
        dataType: 'text',
        type    : 'post',
        data    : { branchid : branchid},
        url     : base_url+'home/getbuildng_forajax',
        cache   : false,
          success: function (data) {
            $.each(JSON.parse(data), function(key, value){
                $('#offc_flr_build').append($('<option>').text(value.bldng_name).attr('value', value.id));
            });
            if (typeof(data1) != "undefined" && data1 !== null) {
              $('#offc_flr_build').val(data1).trigger('change');
            }
          }
        });

});

/**************************************************
* Detail : Ajax of Building Dropdown for Room no. *
* Date   : 14-02-2020                             *
**************************************************/
$('#offc_room_branch').on('change', function (e, data1) {
  $('#offc_room_build').find('option').not(':first').remove();

    var branchid = $("#offc_room_branch").val();
    $.ajax({
        dataType: 'text',
        type    : 'post',
        data    : { branchid : branchid},
        url     : base_url+'home/getbuildng_forajax',
        cache   : false,
          success: function (data) {
            $.each(JSON.parse(data), function(key, value){
                $('#offc_room_build').append($('<option>').text(value.bldng_name).attr('value', value.id));
            });
            if(typeof(data1) != "undefined" && data1 !== null)
            {
              $('#offc_room_build').val(data1.buildingId).trigger('change', data1.floorId);
            }
          }
    });
});

/***********************************************
* Detail : Ajax of Floor Dropdown for Room no. *
* Date   : 14-02-2020                          *
***********************************************/
$('#offc_room_build').on('change', function (e, data1) {
  $('#offc_room_floor').find('option').not(':first').remove();
    var buildgid = $("#offc_room_build").val();
    $.ajax({
        dataType: 'text',
        type    : 'post',
        data    : { buildgid : buildgid},
        url     : base_url+'home/getfloor_forajax',
        cache   : false,
          success: function (data) {
            $.each(JSON.parse(data), function(key, value){
                $('#offc_room_floor').append($('<option>').text(value.floor_no).attr('value', value.id));
            });
            if(typeof(data1) != "undefined" && data1 !== null)
            {
              $('#offc_room_floor').val(data1).trigger('change');
            }
          }
        });
});

/**********************************
* User Role Add                   *
**********************************/
$("#userroleAdd_btn").click(function() {
	$("#userrole_Model").modal({backdrop: 'static'});
    $("#userrole_Model").modal('show');
});




/********************  Edit  **************************/
/************************************
* Admin Edit                        *
************************************/
function usereditingFun(id) {
   window.location.href = base_url+'home/userpg_add?id='+id;
}
/************************************
* Branch Edit                       *
************************************/
function brancheditingFun(id) {
    window.location.href = base_url+'home/branchpg_add?id='+id;
}
/*************************************
* Department Edit                    *
*************************************/
function depteditingFun(id) {
	window.location.href = base_url+'home/deptpg_add?id='+id;
}

/*************************************
* Designation Edit                   *
*************************************/
function designationeditingFun(id) {
   window.location.href = base_url+'home/desgnpg_add?id='+id;
}

/*************************************
* Employee Edit                      *                                       
*************************************/
function employeeeditingFun(id) {
	window.location.href = base_url+'home/employeepg_add?id='+id;
}

/************************************
* Employee Dependant Edit           *
************************************/
function dependanteditingFun(id,empid,empname) {
    window.location.href = base_url+'home/add_dependent?id='+empid+'&&d_id='+id+'&&empname='+empname;
}

/************************************
* Document Controller Edit          *
************************************/
function documentedit(id) {
    window.location.href = base_url+'home/document_Add?id='+id+'&&whichpg=1';
}

/**************************************
* Document Controller Edit (Dashboard)*
**************************************/
function doc_contrllredit(id) {
    window.location.href = base_url+'home/document_Add?id='+id+'&&whichpg=2';
}

/********************************
* Office Setting Building Edit  *
********************************/
function buildngeditingFun(id) {
   window.location.href = base_url+'home/building_add?id='+id;
}

/********************************
* Office Setting Floor Edit     *
********************************/
function flooreditingFun(id) {
   window.location.href = base_url+'home/floor_add?id='+id;
}

/********************************
* Office Setting Floor Edit     *
********************************/
function room_noeditingFun(id)
{
    window.location.href = base_url+'home/room_add?id='+id;
}

/*************************************
* Family Add                         *
*************************************/
function familyeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#family_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/familyModal',
        data: {id:id},
        success: function(data){
     		$('#fmly_country').find('option').not(':first').remove();
     		$('#fmly_state').find('option').not(':first').remove();

            $(".error").text('');
        	$("input[name ='id']").val('');
        	var object = JSON.parse(data);
        	var edit_data = object.view;

        	$.each(object.cntrys, function(key, cntry) {
        		if (typeof(edit_data.country) != "undefined" && edit_data.country !== null && cntry.id == edit_data.country) {
        			$('#fmly_country').append($('<option>').text(cntry.cntry_name).attr('value', cntry.id).attr('selected', 'selected'));
        		}
        		else{
        			$('#fmly_country').append($('<option>').text(cntry.cntry_name).attr('value', cntry.id));
        		}
        	});

    		$("input[name ='id']").val(edit_data.id);
    		$('#fmly_family_name').val(edit_data.family_name);
    		$('#fmly_location').val(edit_data.location);
    		if(typeof(edit_data.state) != "undefined" && edit_data.state !== null && edit_data.state > 0) {
    			$('#fmly_state').append($('<option>').text(edit_data.state_na).attr('value', edit_data.state).attr('selected', 'selected'));
    		}
    		$('#fmly_street').val(edit_data.street);
    		$('#fmly_area').val(edit_data.area);
    		$('#fmly_address').val(edit_data.address);

        	$("#familyModal").modal({backdrop: 'static'});
        	$("#familyModal").modal('show');
       }
       
  });
}

/***************************************
* Relational Info Edit                 *
***************************************/
function relationaleditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#relational_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
   $.ajax({
        type: "POST",
        url : base_url+'home/relationalModal',
        data: {id:id},
        success: function(data){
            $(".error").text('');
        	$("input[name ='id']").val('');

        	var object = JSON.parse(data);
        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
    			$('#r_spouse_name').val(edit_data.spouse_name);
    			$('#r_email').val(edit_data.email);
    			$('#r_ph').val(edit_data.ph);
    			$('#r_address').val(edit_data.address);
        	});

        	$("#relationalModal").modal({backdrop: 'static'});
        	$("#relationalModal").modal('show');
       }
       
  });
}

/****************************************
* Ethnic Info Edit                      *
****************************************/
function ethnicinformationeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#ethnic_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/ethnicinformationModal',
        data: {id:id},
        success: function(data){
            $(".error").text('');
        	$("input[name ='id']").val('');
     		$('#relgn').find('option').not(':first').remove();
        	$('#relgn').val("").trigger('change');
        	var object = JSON.parse(data);
        	var edit_data1 = object.view;

        	$.each(object.religions, function(key, religion) {
        		if (typeof(edit_data1[0].religion) != "undefined" && edit_data1[0].religion !== null && religion.id == edit_data1[0].religion) {
        			$('#relgn').append($('<option>').text(religion.relg_name).attr('value', religion.id).attr('selected', 'selected'));
        		}
        		else{
        			$('#relgn').append($('<option>').text(religion.relg_name).attr('value', religion.id));
        		}
        	});
        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
    			$("input[name ='value']").val(edit_data.value);
    			$("#ethnic_note").val(edit_data.note);
        	});

        	$("#ethnicinformationModal").modal({backdrop: 'static'});
        	$("#ethnicinformationModal").modal('show');
       }
    });
}

/****************************************
* Social Info Edit                      *
****************************************/
function socialinfoeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#social_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/socialinfoModal',
        data: {id:id},
        success: function(data){
            $(".error").text('');
        	$("input[name ='id']").val('');
        	var object = JSON.parse(data);
        	
        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
    			$("input[name ='fb_id']").val(edit_data.fb_id);
    			$("input[name ='snapchat']").val(edit_data.snapchat);
    			$("input[name ='twitter']").val(edit_data.twitter);
    			$("input[name ='blog']").val(edit_data.blog);
    			$("input[name ='website']").val(edit_data.website);
    			$("input[name ='youtube']").val(edit_data.youtube);
    			$("input[name ='linked_in']").val(edit_data.linked_in);
    			$("input[name ='whatsap']").val(edit_data.whatsap);
        	});

        	$("#socialinfoModal").modal({backdrop: 'static'});
        	$("#socialinfoModal").modal('show');
       }
    });
}

/**********************************
* Office Info Edit                *
**********************************/
function officeinfoeditingFun(id,deptId,branchId,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#officeinfo_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/officeinfoModal',
        data: {id:id, dept_id:deptId, branch_id:branchId},
        success: function(data){
        	$("input[name ='id']").val('');
     		$('#offc_info_pjthead').find('option').not(':first').remove();
     		$('#offc_info_bldng').find('option').not(':first').remove();
     		$('#offc_info_flr').find('option').not(':first').remove();
     		$('#offc_info_roomno').find('option').not(':first').remove();

        	var object 	   = JSON.parse(data);
        	var edit_data1 = object.view;

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
        	});
        	$.each(object.dept_heads, function(key, depthead) {
        		if (typeof(edit_data1[0].project_head) != "undefined" && edit_data1[0].project_head !== null && depthead.id == edit_data1[0].project_head) {
        			$('#offc_info_pjthead').append($('<option>').text(depthead.f_name + ' ' +depthead.l_name + ' (' + depthead.employee_code + ' )').attr('value', depthead.id).attr('selected', 'selected'));
        		}
        		else{
        			$('#offc_info_pjthead').append($('<option>').text(depthead.f_name + ' ' +depthead.l_name + ' (' + depthead.employee_code + ' )').attr('value', depthead.id));
        		}
        	});
        	$.each(object.building, function(key, buildng) {
        		if (typeof(edit_data1[0].building_id) != "undefined" && edit_data1[0].building_id !== null && buildng.id == edit_data1[0].building_id) {
        			$('#offc_info_bldng').append($('<option>').text(buildng.bldng_name).attr('value', buildng.id).attr('selected', 'selected'));
        		}
        		else{
        			$('#offc_info_bldng').append($('<option>').text(buildng.bldng_name).attr('value', buildng.id));
        		}
        	});

        	$.each(object.floors, function(key, floor) {
        		if (typeof(edit_data1[0].floor_id) != "undefined" && edit_data1[0].floor_id !== null && floor.id == edit_data1[0].floor_id) {
        			$('#offc_info_flr').append($('<option>').text(floor.floor_no).attr('value', floor.id).attr('selected', 'selected'));
        		}
        		else{
        			$('#offc_info_flr').append($('<option>').text(floor.floor_no).attr('value', floor.id));
        		}
        	});

        	$.each(object.roomnos, function(key, roomnum) {
        		if (typeof(edit_data1[0].room_no_id) != "undefined" && edit_data1[0].room_no_id !== null && roomnum.id == edit_data1[0].room_no_id) {
        			$('#offc_info_roomno').append($('<option>').text(roomnum.room_no).attr('value', roomnum.id).attr('selected', 'selected'));
        		}
        		else{
        			$('#offc_info_roomno').append($('<option>').text(roomnum.room_no).attr('value', roomnum.id));
        		}
        	});

        	$("#officeinfoModal").modal({backdrop: 'static'});
        	$("#officeinfoModal").modal('show');
       }
    });
}

/**********************************
* ID Details Edit                 *
**********************************/
function iddetailseditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#iddetail_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/iddetailsModal',
        data: {id:id},
        success: function(data){
            var iddetail_upload = [];
            var id_upload       = '';
            $("input[name ='id']").val('');
        	$("input[name ='iddet_upld']").val('');
            $(".error").text('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
              	$('#id_category').val(edit_data.id_category).trigger('change');
    			$("#id_type").val(edit_data.id_type);
    			$("#id_number").val(edit_data.number);
    			$("#id_issued_by").val(edit_data.issued_by);
    			$("#id_issued_from").val(edit_data.issued_from);

                if (edit_data.valid_from != "0000-00-00" && edit_data.valid_from != null && edit_data.valid_from != "") {
                    var id_validfrom = ctm2_formatDate(edit_data.valid_from);
                    $("#id_valid_from").datepicker('setDate', id_validfrom);
                }
                else {
                    $("#id_valid_from").val('');
                }

                if (edit_data.valid_till != "0000-00-00" && edit_data.valid_till != null && edit_data.valid_till != "") {
                    var id_validtill = ctm2_formatDate(edit_data.valid_till);
                    $("#id_valid_till").datepicker('setDate', id_validtill);
                }
                else {
                    $("#id_valid_till").val('');
                }

    			$("#iddet_remdr").val(edit_data.reminder);

    			if (typeof(edit_data.upload) != "undefined" && edit_data.upload !== null) {
    				iddetail_upload = edit_data.upload;
                    id_upload       = iddetail_upload.split('/');
                    $(".idupld").html(id_upload[3]);
    			}
    			else {
    				$(".idupld").html("Choose file");
    			}
        	});

        	$("#iddetailsModal").modal({backdrop: 'static'});
        	$("#iddetailsModal").modal('show');
       }
    });
}

/*******************************
* Badge Details Edit           *
*******************************/
function badgeeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#badge_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/badgemodal',
        data: {id:id},
        success: function(data){
            var badgedetail_upload = [];
            var badge_upload       = '';
            $("input[name ='id']").val('');
        	$("input[name ='badgedet_upld']").val('');
            $('#badge_category').find('option').not(':first').remove();
            $(".error").text('');
        	var object = JSON.parse(data);
            var edit_data1 = object.view;

            $.each(object.badgectg, function(key, badge_ctgry) {
                if (typeof(edit_data1[0].badge_category) != "undefined" && edit_data1[0].badge_category !== null && badge_ctgry.id == edit_data1[0].badge_category) {
                    $('#badge_category').append($('<option>').text(badge_ctgry.badge_category).attr('value', badge_ctgry.id).attr('selected', 'selected'));
                }
                else{
                    $('#badge_category').append($('<option>').text(badge_ctgry.badge_category).attr('value', badge_ctgry.id));
                }
            });

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
              	// $('#badge_category').val(edit_data.badge_category).trigger('change');
    			$("#badge_type").val(edit_data.badge_type);
    			$("#badge_number").val(edit_data.number);
    			$("#badgissued_by").val(edit_data.issued_by);
    			$("#badgissued_from").val(edit_data.issued_from);

                if (edit_data.valid_from != "0000-00-00" && edit_data.valid_from != null && edit_data.valid_from != "") {
                    var badge_validfrom = ctm2_formatDate(edit_data.valid_from);
                    $("#badgvalid_from").datepicker('setDate', badge_validfrom);
                }
                else {
                    $("#badgvalid_from").val('');
                }

                if (edit_data.valid_till != "0000-00-00" && edit_data.valid_till != null && edit_data.valid_till != "") {
                    var badge_validtill = ctm2_formatDate(edit_data.valid_till);
                    $("#badgvalid_till").datepicker('setDate', badge_validtill);
                }
                else {
                    $("#badgvalid_till").val('');
                }

    			$("#badg_remdr").val(edit_data.reminder);

    			if (typeof(edit_data.upload) != "undefined" && edit_data.upload !== null) {
    				badgedetail_upload = edit_data.upload;
                    badge_upload       = badgedetail_upload.split('/');
                    $(".badgeupld").html(badge_upload[3]);
    			}
    			else {
    				$(".badgeupld").html("Choose file");
    			}
        	});

        	$("#badgemodal").modal({backdrop: 'static'});
        	$("#badgemodal").modal('show');
       }
    });
}

/*********************************
* Bank Info Edit 				 *
*********************************/
function bankinfoeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#bankinfo_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/bankinfoModal',
        data: {id:id},
        success: function(data){
        	$("input[name ='id']").val('');
            $(".error").text('');
            $('#bnk_country').find('option').not(':first').remove();
     		$('#bank_name').find('option').not(':first').remove();
        	
        	var object     = JSON.parse(data);
        	var edit_data1 = object.view;

            $.each(object.banks, function(key, bank) {
                if (typeof(edit_data1[0].bank_name) != "undefined" && edit_data1[0].bank_name !== null && bank.id == edit_data1[0].bank_name) {
                    $('#bank_name').append($('<option>').text(bank.bank_name).attr('value', bank.id).attr('selected', 'selected'));
                }
                else{
                    $('#bank_name').append($('<option>').text(bank.bank_name).attr('value', bank.id));
                }
            });

        	$.each(object.countries, function(key, country) {
        		if (typeof(edit_data1[0].country) != "undefined" && edit_data1[0].country !== null && country.id == edit_data1[0].country) {
        			$('#bnk_country').append($('<option>').text(country.cntry_name).attr('value', country.id).attr('selected', 'selected'));
        		}
        		else{
        			$('#bnk_country').append($('<option>').text(country.cntry_name).attr('value', country.id));
        		}
        	});

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
    			$("#bank_name").val(edit_data.bank_name);
    			$("#b_account_name").val(edit_data.account_name);
    			$("#b_account_number").val(edit_data.account_number);
    			$("#b_swift_code").val(edit_data.swift_code);
    			$("#b_iban_number").val(edit_data.iban_number);
    			$("#b_extra_info").val(edit_data.extra_info);
        	});

        	$("#bankinfoModal").modal({backdrop: 'static'});
        	$("#bankinfoModal").modal('show');
       }
    });
}

/***************************************************
* Driving License Edit 							   *
***************************************************/
function drivinglcenseeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#drivinglicense_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/licenseModal',
        data: {id:id},
        success: function(data){
            var drivinglic_upload = [];
            var license_upload    = '';
            $("input[name ='id']").val('');
            $(".error").text('');
        	$("input[name ='drv_upload']").val('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
    			$("#li_num").val(edit_data.license_number);
    			$("#li_issued_by").val(edit_data.issued_by);
    			$("#li_provider").val(edit_data.provider);

                if (edit_data.valid_from != "0000-00-00" && edit_data.valid_from != null && edit_data.valid_from != "") {
                    var drivnglic_validfrom = ctm2_formatDate(edit_data.valid_from);
                    $("#li_valid_from").datepicker('setDate', drivnglic_validfrom);
                }
                else {
                    $("#li_valid_from").val('');
                }

    			if (edit_data.valid_till != "0000-00-00" && edit_data.valid_till != null && edit_data.valid_till != "") {
                    var drivnglic_validtill = ctm2_formatDate(edit_data.valid_till);
                    $("#li_valid_till").datepicker('setDate', drivnglic_validtill);
                }
                else {
                    $("#li_valid_till").val('');
                }

    			$("#drv_remdr").val(edit_data.reminder);
    			if (typeof(edit_data.upload) != "undefined" && edit_data.upload !== null) {
    				drivinglic_upload = edit_data.upload;
                    license_upload    = drivinglic_upload.split('/');
                    $(".drvlic_upld").html(license_upload[3]);
    			}
    			else {
    				$(".drvlic_upld").html("Choose file");
    			}
        	});

        	$("#licenseModal").modal({backdrop: 'static'});
        	$("#licenseModal").modal('show');
       }
    });
}

/************************************
* Passport Edit 					*
************************************/
function passporteditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#passport_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/passportModal',
        data: {id:id},
        success: function(data){
            var passportdet_upload = [];
            var passport_upload    = '';
            $(".error").text('');
            $("input[name ='id']").val('');
        	$("input[name ='passprt_upld']").val('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
    			$("#passport_number").val(edit_data.passport_number);
    			$("#passport_issueby").val(edit_data.issued_by);
                $("#passport_issuefrm").val(edit_data.issued_from);
    			$("#passport_issuecity").val(edit_data.issued_city);

                if (edit_data.valid_from != "0000-00-00" && edit_data.valid_from != null && edit_data.valid_from != "") {
                    var passprt_validfrom = ctm2_formatDate(edit_data.valid_from);
                    $("#passport_validfrom").datepicker('setDate', passprt_validfrom);
                }
                else {
                    $("#passport_validfrom").val('');
                }

                if (edit_data.valid_till != "0000-00-00" && edit_data.valid_till != null && edit_data.valid_till != "") {
                    var passprt_validtill = ctm2_formatDate(edit_data.valid_till);
                    $("#passport_validtill").datepicker('setDate', passprt_validtill);
                }
                else {
                    $("#passport_validtill").val('');
                }
    			
    			$("#passprt_remdr").val(edit_data.reminder);
    			if (typeof(edit_data.upload) != "undefined" && edit_data.upload !== null) {
                    passportdet_upload = edit_data.upload;
                    passport_upload    = passportdet_upload.split('/');
    				$(".passport_upld").html(passport_upload[3]);
    			}
    			else {
    				$(".passport_upld").html("Choose file");
    			}
        	});

        	$("#passportModal").modal({backdrop: 'static'});
        	$("#passportModal").modal('show');
       }
    });
}

/***************************************************
* Work License Edit 							   *
***************************************************/
function worklicenceditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#worklicense_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/worklicenseModal',
        data: {id:id},
        success: function(data){
            var worklicense_upload = [];
            var worklic_upload     = ''; 
            $("input[name ='id']").val('');
        	$("input[name ='wl_upload']").val('');
            $(".error").text('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
    			$("#wl_license_number").val(edit_data.license_number);
    			$("#wl_issued_by").val(edit_data.issued_by);
    			$("#wl_license_provider").val(edit_data.license_provider);

                if (edit_data.valid_from != "0000-00-00" && edit_data.valid_from != null && edit_data.valid_from != "") {
                    var worklic_validfrom = ctm2_formatDate(edit_data.valid_from);
                    $("#wl_valid_from").datepicker('setDate', worklic_validfrom);
                }
                else {
                    $("#wl_valid_from").val('');
                }

                if (edit_data.valid_till != "0000-00-00" && edit_data.valid_till != null && edit_data.valid_till != "") {
                    var worklic_validtill = ctm2_formatDate(edit_data.valid_till);
                    $("#wl_valid_till").datepicker('setDate', worklic_validtill);
                }
                else {
                    $("#wl_valid_till").val('');
                }

    			$("#wl_remdr").val(edit_data.reminder);
    			if (typeof(edit_data.upload) != "undefined" && edit_data.upload !== null) {
    				worklicense_upload = edit_data.upload;
                    worklic_upload     = worklicense_upload.split('/');
                    $(".worklic_upld").html(worklic_upload[3]);
    			}
    			else {
    				$(".worklic_upld").html("Choose file");
    			}
        	});

        	$("#worklicenseModal").modal({backdrop: 'static'});
        	$("#worklicenseModal").modal('show');
       }
    });
}

/***************************************************
* Educational Info Edit 					   	   *
***************************************************/
function educationaleditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#educational_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/educationalModal',
        data: {id:id},
        success: function(data){
            $(".error").text('');
        	$("input[name ='id']").val('');
            $('#qlevel_name').find('option').not(':first').remove();
            $('#edu_coursetype').find('option').not(':first').remove();

        	var object          = JSON.parse(data);
        	var edit_data       = object.view;
        	var qualfctn_levels = object.qulf_level;
        	var courses         = object.courses;

        	$.each(qualfctn_levels, function(key, qlevel) {
        			$('#qlevel_name').append($('<option>').text(qlevel.qualif_name).attr('value', qlevel.id));
        	});

        	$.each(courses, function(key, course) {
        			$('#edu_coursetype').append($('<option>').text(course.course_name).attr('value', course.id));
        	});

        	var slno      		= 0;
        	var qua_lvl   		= [];
        	var q_lvlid   		= [];
        	var qualfn    		= [];
        	var cours_name 	    = [];
        	var coursetype_na 	= [];
        	var coursetype_id 	= [];
        	var join_yr   		= [];
        	var pass_yr   		= [];
        	var htmlstr         = '';

        	if (typeof(edit_data) != "undefined" && edit_data !== null) {

        		$("input[name ='id']").val(edit_data.id);

        		if (typeof(edit_data.qlvl_names) != "undefined" && edit_data.qlvl_names !== null) {
        			qua_lvl 	  = edit_data.qlvl_names;
        		}
        		if (typeof(edit_data.qualifn_level) != "undefined" && edit_data.qualifn_level !== null) {
        			q_lvlid 	  = JSON.parse(edit_data.qualifn_level);
        		}
        		if (typeof(edit_data.qualification) != "undefined" && edit_data.qualification !== null) {
        			qualfn 		  = JSON.parse(edit_data.qualification);
        		}
				if (typeof(edit_data.cname) != "undefined" && edit_data.cname !== null) {
        			cours_name    = JSON.parse(edit_data.cname);
        		}
        		if (typeof(edit_data.course_names) != "undefined" && edit_data.course_names !== null) {
        			coursetype_na = edit_data.course_names;
        		}
        		if (typeof(edit_data.course_name) != "undefined" && edit_data.course_name !== null) {
        			coursetype_id = JSON.parse(edit_data.course_name);
        		}
        		if (typeof(edit_data.year_ofjoining) != "undefined" && edit_data.year_ofjoining !== null) {
        			join_yr       = JSON.parse(edit_data.year_ofjoining);
        		}
        		if (typeof(edit_data.year_ofpassout) != "undefined" && edit_data.year_ofpassout !== null) {
        			pass_yr       = JSON.parse(edit_data.year_ofpassout);
        		}

        		$.each(qua_lvl, function(k1, v1) {
        			slno     = slno + 1;
        			htmlstr += '<tr id="tr'+slno+'" class="edu_inite">\
                          			<td class="sl_id">'+slno+'</td>\
                          			<td><input type="hidden" name="qlfy_lvl[]" id="qlfy_lvl" value="'+q_lvlid[k1]+'">'+qua_lvl[k1]+'</td>\
                          			<td><input type="hidden" name="qualifn[]" id="qualifn" value="'+qualfn[k1]+'">'+qualfn[k1]+'</td>\
                          			<td><input type="hidden" name="coursename[]" id="coursename" value="'+cours_name[k1]+'">'+cours_name[k1]+'</td>\
		                          	<td><input type="hidden" name="ctype_name[]" id="ctype_name" value="'+coursetype_id[k1]+'">'+coursetype_na[k1]+'</td>\
		                          	<td><input type="hidden" name="yr_join[]" id="yr_join" value="'+join_yr[k1]+'">'+join_yr[k1]+'</td>\
		                          	<td><input type="hidden" name="yr_pass[]" id="yr_pass" value="'+pass_yr[k1]+'">'+pass_yr[k1]+'</td>\
		                          	<td><button type="button" class="btn btn-outline-danger btn-elevate btn-sm btn-icon" onclick="remove_edurow('+slno+')" title="Remove Education"><i class="la la-trash-o"></i></button></td>\
                        		</tr>';
                    
                });
                $("#eduinfo_det > tbody").html(htmlstr);
        	}

        	$("#educationalModal").modal({backdrop: 'static'});
        	$("#educationalModal").modal('show');
       }
    });
}

/************************************************
* Detail : Certifications Edit with employee Id *
* Date   : 28-02-2020                           *
************************************************/
function certificateditingFun(empid,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#certifications_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/certificationsModal',
        data: {empid:empid},
        success: function(data){
            $(".error").text('');
        	$("input[name ='emp_Id']").val('');
        	var object  = JSON.parse(data);
        	var slno    = 0;
        	var htmlstr = '';

        	$("input[name ='emp_Id']").val(object.emp_Id);

        	$.each(object.view, function(key, edit_data) {
        		if (typeof(edit_data.certificate_name) != "undefined" && edit_data.certificate_name !== null) {
        			slno     = slno+1;
        			htmlstr += '<tr id="tr'+slno+'" class="cert_inite">\
                          			<td class="sl_id">'+slno+'</td>\
                          			<td class="certfId"><input type="hidden" name="certft_id[]" id="certft_id" value="'+edit_data.id+'"></td>\
                          			<td>';
          			if (typeof(edit_data.certificate) != "undefined" && edit_data.certificate !== null) {
	        			certificate_upload = edit_data.certificate;
                        certif_upload      = certificate_upload.split('/');

                        htmlstr += '<input type="hidden" name="ex_certif[]" id="ex_certif" value="'+edit_data.certificate+'">\
                                    <input type="file" name="certif[]" id="certif" value="" style="display: none;">\
                                    '+certif_upload[4]+'';

                        /*htmlstr += '<input type="hidden" name="ex_certif[]" id="ex_certif" value="'+edit_data.certificate+'">\
                            		<input type="file" name="certif[]" id="certif" value="" style="display: none;">\
                            		<img src="' + base_url + edit_data.certificate + '" class="tableimg" alt="' +edit_data.certificate+ '">';*/
	        		}
	        		else {
	        			htmlstr += '<input type="hidden" name="ex_certif[]" id="ex_certif" value="'+edit_data.certificate+'">\
	        						<input type="file" name="certif[]" id="certif" value="">';
	        		}

	        		htmlstr += '</td>\
                                <td><input type="hidden" name="certificate_name[]" id="certificate_name" value="'+edit_data.certificate_name+'">'+edit_data.certificate_name+'</td>\
                                <td><input type="hidden" name="yoj[]" id="yoj" value="'+edit_data.year_ofjoining+'">'+edit_data.year_ofjoining+'</td>\
                                <td><input type="hidden" name="yop[]" id="yop" value="'+edit_data.year_ofpassout+'">'+edit_data.year_ofpassout+'</td>\
                                <td><input type="hidden" name="dcp[]" id="dcp" value="'+edit_data.description+'">'+edit_data.description+'</td>\
                          		<td><button type="button" class="btn btn-outline-danger btn-elevate btn-sm btn-icon" onclick="remove_crow('+slno+')" title="Remove Certificate"><i class="la la-trash-o"></i></button>\
                        		</td>\
                    </tr>';
        		}
        	});
        	$("#certifications > tbody").html(htmlstr);

        	$("#certificationsModal").modal({backdrop: 'static'});
        	$("#certificationsModal").modal('show');
       }
    });
}

/***************************************************
* Refferal Edit 								   *
***************************************************/
function referaleditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#referral_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/referalModal',
        data: {id:id},
        success: function(data){
        	$("input[name ='id']").val('');
        	$("#referal_from").val("").trigger('change');
    		$("#reffered_on").val('');
    		$("#refferal_reason").val("");
    		$('#refer_by').hide();
            $(".error").text('');

        	var htmlstr = '';
        	var object  = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
    			if (typeof(edit_data.referal_from) != "undefined" && edit_data.referal_from !== null) {
    				if (edit_data.referal_from == 1) {
    					$("#referal_from").val(edit_data.referal_from).trigger('change', edit_data.reffered_by_in);
    				}
    				else if (edit_data.referal_from == 2) {
    					$("#referal_from").select2("val", edit_data.referal_from);
    					$("#reffered_by").val(edit_data.reffered_by_out);
    				}
    			}

                if (edit_data.reffered_on != "0000-00-00" && edit_data.reffered_on != null && edit_data.reffered_on != "") {
                    var refferedon = ctm2_formatDate(edit_data.reffered_on);
                    $("#reffered_on").datepicker('setDate', refferedon);
                }
                else {
                    $("#reffered_on").val('');
                }

    			$("#refferal_reason").val(edit_data.refferal_reason);
        	});

        	$("#referalModal").modal({backdrop: 'static'});
        	$("#referalModal").modal('show');
       }
    });
}

/*****************************************************
* Detail : Referred By based on Refferal from        *
* Date   : 17-02-2020                                *
*****************************************************/
$('#referal_from').on('change', function (e, ref_in) {
    var referral_frm = $('#referal_from').val();
    var html         = '';
    if (referral_frm == 1) {
        html = '<label class="form-control-label">Referred By</label><span style="color:red"> *</span>\
                    &nbsp;&nbsp;<span id="refby_error" class="error" for="refby_error"></span>\
                    <select class="form-control kt-select2" name="reffered_by" id="reffered_by">\
                        <option value="">Select</option>\
                    </select>';
        $.ajax({
            dataType: 'text',
            type    : 'post',
            url     : base_url+'home/get_employeeajax',
            cache   : false,
              success: function (data) {
                
                $.each(JSON.parse(data), function(key, value){
                	if (typeof(ref_in) != "undefined" && ref_in !== null && ref_in == value.id) {
                		$('#reffered_by').append($('<option>').text(value.f_name+' '+value.l_name).attr('value', value.id).attr('selected', 'selected'));
                	}
                	else {
                		$('#reffered_by').append($('<option>').text(value.f_name+' '+value.l_name).attr('value', value.id));
                	}                    
                });
              }
        });
        $('#refer_by').html(html);
        $('#reffered_by').select2();
    }
    else if (referral_frm == 2) {
        html = '<label class="form-control-label">Referred By</label><span style="color:red"> *</span>\
                    <input type="role" name="reffered_by" id="reffered_by" class="form-control" value="">\
                <span id="refby_error" class="error" for="refby_error"></span>';
        $('#refer_by').html(html);
    }
    $('#refer_by').show();
});

/**************************************
* Employee Previous Details Edit      *
**************************************/
function previousdetail_editingFun(previousdet_id, empid, employee_name) {
    window.location.href = base_url+'home/pre_det_employee?previousdet_id='+previousdet_id+'&&id='+empid+'&&emp_name='+employee_name;
}

/**************************************
* Achievements Edit                   *
**************************************/
function achievementseditingFun(id) {
	window.location.href = base_url+'home/achievementsModal?id='+id;
}

/**************************************
* Key skills Edit                     *
**************************************/
function keyskilleditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#keyskill_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/keyskillModal',
        data: {id:id},
        success: function(data){
            $(".error").text('');
        	$("input[name ='id']").val('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);

    			var skill_arr     = [];
                var extra_currilr = [];
                var slno 		  = 0;
                var htmlstr		  = '';

                if (typeof(edit_data.skills) != "undefined" && edit_data.skills !== null) {
                	skill_arr     = JSON.parse(edit_data.skills);
                	extra_currilr = JSON.parse(edit_data.extra_curricular);
                	$.each(skill_arr, function(k1, skill) {
                		var extra_curlr   = '';
                		slno 	 = slno + 1;
                		if (typeof(extra_currilr[k1]) != "undefined" && extra_currilr[k1] !== null) {
                			extra_curlr = extra_currilr[k1];
                		}
                		else {
                			extra_curlr   = '';
                		}
                		htmlstr += '<tr id="tr'+slno+'" class="key_skill">\
                						<td class="sl_id">'+slno+'</td>\
                						<td><input type="hidden" name="skills[]" id="skills" value="'+skill+'">'+skill+'</td>\
                						<td><input type="hidden" name="extra_curricular[]" id="extra_skills" value="'+extra_curlr+'">'+extra_curlr+'</td>\
                						<td><button type="button" class="btn btn-outline-danger btn-sm keyskill" title="Remove Key Skill"><i class="la la-trash-o"></i></button>\
                						</td>\
                    				</tr>';
                	});
            	}
            	$("#skills_list > tbody").html(htmlstr);
        	});

        	$("#keyskillModal").modal({backdrop: 'static'});
        	$("#keyskillModal").modal('show');
       }
    });
}

/**************************************
* Language Profficiency Edit          *
**************************************/
function languageeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#languageprof_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$('#lang_prof').find('option').not(':first').remove();
	$.ajax({
        type: "POST",
        url : base_url+'home/languageModal',
        data: {id:id},
        success: function(data){
            $(".error").text('');
        	$("input[name ='id']").val('');
        	var object = JSON.parse(data);

        	$.each(object.language, function(key, lang){
            		$('#lang_prof').append($('<option>').text(lang.lg_name).attr('value', lang.id));
            });

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
    			var lang_arr = [];
              	var rd_arr   = [];
              	var wt_arr   = [];
              	var spk_arr  = [];

              	var r_stat   = '';
              	var w_stat   = '';
              	var s_stat   = '';
              	var slno     = 0;
              	var htmlstr  = '';
  				
  				if (typeof(edit_data.language) != "undefined" && edit_data.language !== null) {
  					lang_arr = JSON.parse(edit_data.language);

  					if (typeof(edit_data.reading) != "undefined" && edit_data.reading !== null) {
  						rd_arr = JSON.parse(edit_data.reading);
  					}
  					if (typeof(edit_data.writing) != "undefined" && edit_data.writing !== null) {
  						wt_arr = JSON.parse(edit_data.writing);
  					}
  					if (typeof(edit_data.speak) != "undefined" && edit_data.speak !== null) {
  						spk_arr = JSON.parse(edit_data.speak);
  					}
  					$.each(lang_arr, function(k1, langg) {
  						slno = slno + 1;
  						if (typeof(rd_arr[k1]) != "undefined" && rd_arr[k1] !== null && rd_arr[k1] == 1) {
  							r_stat = 'checked';
  						}
  						else {
  							r_stat = '';
  						}

  						if (typeof(wt_arr[k1]) != "undefined" && wt_arr[k1] !== null && wt_arr[k1] == 1) {
  							w_stat = 'checked';
  						}
  						else {
  							w_stat = '';
  						}

  						if (typeof(spk_arr[k1]) != "undefined" && spk_arr[k1] !== null && spk_arr[k1] == 1) {
  							s_stat = 'checked';
  						}
  						else {
  							s_stat = '';
  						}

  						htmlstr += '<tr id="tr'+slno+'" class="lang_proficiency">\
                          <td class="sl_id">'+slno+'</td>\
                          <td><input type="hidden" name="langug[]" id="langug" value="'+langg+'">'+langg+'</td>\
                          <td>\
                            <label class="kt-checkbox kt-checkbox--brand">\
                            <input type="checkbox" name="r_check[]" id="r_check" value="1" '+r_stat+'><span></span>\
                            </label>\
                          </td>\
                          <td>\
                            <label class="kt-checkbox kt-checkbox--brand">\
                            <input type="checkbox" name="w_check[]" id="w_check" value="1" '+w_stat+'><span></span>\
                            </label>\
                          </td>\
                          <td>\
                            <label class="kt-checkbox kt-checkbox--brand">\
                            <input type="checkbox" name="s_check[]" id="s_check" value="1" '+s_stat+'><span></span>\
                            </label>\
                          </td>\
                          <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="remove_lrow('+slno+')" title="Remove Language"><i class="la la-trash-o"></i></button>\
                        </td>\
                    </tr>';

  					});
  				}
    			$("#lg_profcdet > tbody").html(htmlstr);
        	});

        	$("#languageModal").modal({backdrop: 'static'});
        	$("#languageModal").modal('show');
       }
    });
}

/**************************************
* Job Position Edit                   *
**************************************/
function jobpositioneditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#desiredjob_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$('#jobpos_desgn').find('option').not(':first').remove();
	$.ajax({
        type: "POST",
        url : base_url+'home/jobpositionModal',
        data: {id:id},
        success: function(data){
        	$("input[name ='id']").val('');
            $(".error").text('');
        	var desgn_names  = [];
            var reasons		 = [];
            var desg_ids     = [];
            var tr_id 		 = 0;
            var htmlstr    	 = '';

        	var object       = JSON.parse(data);
        	var edit_data    = object.view;
        	
            if (edit_data.reason != '') {
                var reason_arr   = JSON.parse(edit_data.reason);
            }
            else {
                var reason_arr   = [];
            }
        	

        	$.each(object.designatn, function(key, desgn){
            	$('#jobpos_desgn').append($('<option>').text(desgn.designation).attr('value', desgn.id));
            });

        	$("input[name ='id']").val(edit_data.id);

        	if (typeof(edit_data.designation) != "undefined" && edit_data.designation !== null) {
                
                if (edit_data.reason != '') {
                    desg_ids   = JSON.parse(edit_data.designation);
                }
                else {
                    desg_ids   = [];
                }

				desgn_names  = edit_data.design_name;
                
                if (edit_data.reason != '') {
                    reasons   = JSON.parse(edit_data.reason);
                }
                else {
                    reasons   = [];
                }

				$.each(desg_ids, function(k1, desgnId) {
					tr_id    = tr_id + 1;
					if (typeof(desgn_names[k1].designation) != "undefined" && desgn_names[k1].designation !== null) {
						desig_name = desgn_names[k1].designation;
					}
					else {
						desig_name = '';
					}
					if (typeof(reasons[k1]) != "undefined" && reasons[k1] !== null) {
						reason = reasons[k1];
					}
					else {
						reason = '';
					}
					htmlstr += '<tr id="jobpos_tr'+tr_id+'" class="jobp_inite">\
		                            <td class="jpsl_id">'+tr_id+'</td>\
		                            <td class="desgnID"><input type="hidden" name="desgn_Id[]" id="desgn_Id" value="'+desgnId+'"></td>\
		                            <td>'+desig_name+'</td>\
		                            <td><textarea name="tbl_reason[]" id="tbl_reason" class="form-control desgnID">'+reason+'</textarea>'+reason+'</td>\
		                            <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="remove_jobpos_row('+tr_id+','+desgnId+',\''+desig_name+'\')" title="Remove Job Position"><i class="la la-trash-o"></i></button>\
		                            </td>\
                        		</tr>';
				});
				
			}
            $("#jobpos_det > tbody").html(htmlstr);

        	$("#jobpositionModal").modal({backdrop: 'static'});
        	$("#jobpositionModal").modal('show');
       }
    });
}

/**************************************
* Employment Milestone Edit           *
**************************************/
function empmilestn_editFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#employmilestone_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$('#jp_cntry').find('option').not(':first').remove();
	$.ajax({
        type: "POST",
        url : base_url+'home/emp_milestoneModal',
        data: {id:id},
        success: function(data){
        	$("input[name ='id']").val('');
            $(".sponsorname_error").text('');
        	var cwrk_arr   = [];
        	var object     = JSON.parse(data);
        	var edit_data1 = object.view;

        	if (typeof(edit_data1[0].countries_worked) != "undefined" && edit_data1[0].countries_worked !== null) {
        		cwrk_arr = JSON.parse(edit_data1[0].countries_worked);
        	}
        	
        	$.each(object.cntry_wrkd, function(key, country){
        		if (typeof(cwrk_arr) != "undefined" && cwrk_arr !== null) {
        			if ($.inArray(country.id, cwrk_arr) > -1) {
        				$('#jp_cntry').append($('<option>').text(country.cntry_name).attr('value', country.id).attr('selected', 'selected'));
        			}
        			else {
        				$('#jp_cntry').append($('<option>').text(country.cntry_name).attr('value', country.id));
        			}
        		}
        		else {
        			$('#jp_cntry').append($('<option>').text(country.cntry_name).attr('value', country.id));
        		}
            	
            });

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);
    			$("#jp_employ_status").val(edit_data.employment_status).trigger('change');
        	});

        	$("#emp_milestoneModal").modal({backdrop: 'static'});
        	$("#emp_milestoneModal").modal('show');
       }
    });
}

/**************************************
* Hiring Information Edit             *
**************************************/
function hiringeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#hiring_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/hiringModal',
        data: {id:id},
        success: function(data){
        	$("input[name ='id']").val('');
            $(".error").text('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);

                $("input[name ='date_callletter']").datepicker('setDate', edit_data.date_callletter);
                $("input[name ='date_interview']").datepicker('setDate', edit_data.date_interview);
                $("input[name ='date_offerletter']").datepicker('setDate', edit_data.date_offerletter);
                $("input[name ='date_offletteraccepted']").datepicker('setDate', edit_data.date_offletteraccepted);
                $("input[name ='date_appoinment']").datepicker('setDate', edit_data.date_appoinment);
                $("input[name ='date_agreementsigned']").datepicker('setDate', edit_data.date_agreementsigned);
                $("input[name ='date_contactsigned']").datepicker('setDate', edit_data.date_contactsigned);
                $("input[name ='date_hiring']").datepicker('setDate', edit_data.date_hiring);
                $("input[name ='date_joining']").datepicker('setDate', edit_data.date_joining);
                $("input[name ='date_paystarts']").datepicker('setDate', edit_data.date_paystarts);
                $("input[name ='date_paystops']").datepicker('setDate', edit_data.date_paystops);
        	});

        	$("#hiringModal").modal({backdrop: 'static'});
        	$("#hiringModal").modal('show');
       }
    });
}

/**************************************
* Labour Information Edit             *
**************************************/
function laborinfoeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#labourinfo_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
	$.ajax({
        type: "POST",
        url : base_url+'home/laborinfoModal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            $("input[name ='labor_lawsigned']").val('');
            $("input[name ='labor_contract']").val('');
        	$("input[name ='company_contract']").val('');
            $(".error").text('');
        	var laborlaw	 	 = [];
        	var laborcontract	 = [];
        	var cmpnycontract    = [];
        	var laborlaw_name 	 = '';
        	var labcontract_name = '';
        	var cmpcontract_name = '';
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
                $("input[name ='id']").val(edit_data.id);
                
                if (edit_data.laborlaw_alertdate != "0000-00-00" && edit_data.laborlaw_alertdate != null) {
                    var laborlaw_aldate        = ctm2_formatDate(edit_data.laborlaw_alertdate);
                    $("#laborlaw_alertdt").datepicker('setDate', laborlaw_aldate);
                }
                else {
                    $("#laborlaw_alertdt").val('');
                }

                if (edit_data.laborcontract_alertdate != "0000-00-00" && edit_data.laborcontract_alertdate != null) {
                    var laborcontract_aldate   = ctm2_formatDate(edit_data.laborcontract_alertdate);
                    $("#laborcontract_alertdt").datepicker('setDate', laborcontract_aldate);
                }
                else {
                    $("#laborcontract_alertdt").val('');
                }
                
                if (edit_data.companycontract_alertdate != "0000-00-00" && edit_data.companycontract_alertdate != null) {
                    var cmpnycontract_aldate   = ctm2_formatDate(edit_data.companycontract_alertdate);
                    $("#companycontract_alertdt").datepicker('setDate', cmpnycontract_aldate);
                }
                else {
                    $("#companycontract_alertdt").val('');
                }

                if (edit_data.laborlawsigned_date != "0000-00-00" && edit_data.laborlawsigned_date != null) {
                    var laborlaw_signdt        = ctm2_formatDate(edit_data.laborlawsigned_date);
                    $("input[name ='laborlawsign_date']").datepicker('setDate', laborlaw_signdt);
                }
                else {
                    $("input[name ='laborlawsign_date']").val('')
                }
                
                if (edit_data.laborlaw_expirydate != "0000-00-00" && edit_data.laborlaw_expirydate != null) {
                    var laborlaw_expirydt      = ctm2_formatDate(edit_data.laborlaw_expirydate);
                    $("input[name ='laborlaw_expiry']").datepicker('setDate', laborlaw_expirydt);
                }
                else {
                    $("input[name ='laborlaw_expiry']").val('');
                }

                if (edit_data.laborcontractsigned_date != "0000-00-00" && edit_data.laborcontractsigned_date != null) {
                    var laborcontract_signdt   = ctm2_formatDate(edit_data.laborcontractsigned_date);
                    $("input[name ='laborcontractsign_date']").datepicker('setDate', laborcontract_signdt);
                }
                else {
                    $("input[name ='laborcontractsign_date']").val('');
                }

                if (edit_data.laborcontract_expirydate != "0000-00-00" && edit_data.laborcontract_expirydate != null) {
                    var laborcontract_expirydt = ctm2_formatDate(edit_data.laborcontract_expirydate);
                    $("input[name ='laborcontract_expiry']").datepicker('setDate', laborcontract_expirydt);
                }
                else {
                    $("input[name ='laborcontract_expiry']").val('');
                }
                
                if (edit_data.companycontractsign_date != "0000-00-00" && edit_data.companycontractsign_date != null) {
                    var cmpnycontract_signdt   = ctm2_formatDate(edit_data.companycontractsign_date);
                    $("input[name ='cmpnycontractsign_date']").datepicker('setDate', cmpnycontract_signdt);
                }
                else {
                    $("input[name ='cmpnycontractsign_date']").val('');
                }

                if (edit_data.companycontract_expirydate != "0000-00-00" && edit_data.companycontract_expirydate != null) {
                    var cmpnycontract_expirydt = ctm2_formatDate(edit_data.companycontract_expirydate);
                    $("input[name ='companycontract_expiry']").datepicker('setDate', cmpnycontract_expirydt);
                }
                else {
                    $("input[name ='companycontract_expiry']").val('');
                }
                
                $("input[name ='laborlaw_reminder']").val(edit_data.laborlaw_reminder);
                $("input[name ='laborcontract_remdr']").val(edit_data.laborcontract_reminder);
                $("input[name ='companycontract_remdr']").val(edit_data.companycontract_reminder);

    			if (typeof(edit_data.labor_lawsigned) != "undefined" && edit_data.labor_lawsigned !== null) {
    				laborlaw      = edit_data.labor_lawsigned;
    				laborlaw_name = laborlaw.split('/');
    				$(".lawsign_upld").html(laborlaw_name[4]);
    			}
    			else {
    				$(".lawsign_upld").html("Choose file");
    			}

    			if (typeof(edit_data.labor_contact) != "undefined" && edit_data.labor_contact !== null) {
    				laborcontract    = edit_data.labor_contact;
    				labcontract_name = laborcontract.split('/');
    				$(".labcontract_upld").html(labcontract_name[4]);
    			}
    			else {
    				$(".labcontract_upld").html("Choose file");
    			}

    			if (typeof(edit_data.labor_contactsigned) != "undefined" && edit_data.labor_contactsigned !== null) {
    				cmpnycontract    = edit_data.labor_contactsigned;
    				cmpcontract_name = cmpnycontract.split('/');
    				$(".cmpnycontract_upld").html(cmpcontract_name[4]);
    			}
    			else {
    				$(".cmpnycontract_upld").html("Choose file");
    			}
        	});

        	$("#laborinfoModal").modal({backdrop: 'static'});
        	$("#laborinfoModal").modal('show');
       }
    });
}

/**************************************
* Work Information Edit               *
**************************************/
function workinfoeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#workinfo_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
    $.ajax({
        type: "POST",
        url : base_url+'home/work_informationModal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            $(".error").text('');
            $('#team_leader').find('option').not(':first').remove();
            $('#project_manager').find('option').not(':first').remove();
            $('#department_head').find('option').not(':first').remove();
            var object    = JSON.parse(data);
            var edit_data1= object.view;

            $.each(object.employees, function(key, teamleader) {
                if (typeof(edit_data1[0].teamleader_id) != "undefined" && edit_data1[0].teamleader_id !== null && teamleader.id == edit_data1[0].teamleader_id) {
                    $('#team_leader').append($('<option>').text(teamleader.f_name + ' ' +teamleader.l_name + ' (' + teamleader.employee_code + ' )').attr('value', teamleader.id).attr('selected', 'selected'));
                }
                else{
                    $('#team_leader').append($('<option>').text(teamleader.f_name + ' ' +teamleader.l_name + ' (' + teamleader.employee_code + ' )').attr('value', teamleader.id));
                }
            });
            
            $.each(object.employees, function(key, projectmanager) {
                if (typeof(edit_data1[0].projectmanager_id) != "undefined" && edit_data1[0].projectmanager_id !== null && projectmanager.id == edit_data1[0].projectmanager_id) {
                    $('#project_manager').append($('<option>').text(projectmanager.f_name + ' ' +projectmanager.l_name + ' (' + projectmanager.employee_code + ' )').attr('value', projectmanager.id).attr('selected', 'selected'));
                }
                else{
                    $('#project_manager').append($('<option>').text(projectmanager.f_name + ' ' +projectmanager.l_name + ' (' + projectmanager.employee_code + ' )').attr('value', projectmanager.id));
                }
            });

            $.each(object.employees, function(key, departmenthead) {
                if (typeof(edit_data1[0].departmenthead_id) != "undefined" && edit_data1[0].departmenthead_id !== null && departmenthead.id == edit_data1[0].departmenthead_id) {
                    $('#department_head').append($('<option>').text(departmenthead.f_name + ' ' +departmenthead.l_name + ' (' + departmenthead.employee_code + ' )').attr('value', departmenthead.id).attr('selected', 'selected'));
                }
                else{
                    $('#department_head').append($('<option>').text(departmenthead.f_name + ' ' +departmenthead.l_name + ' (' + departmenthead.employee_code + ' )').attr('value', departmenthead.id));
                }
            });
            $.each(object.view, function(key, edit_data) {
                $("input[name ='id']").val(edit_data.id);

                $("input[name ='work_location']").val(edit_data.work_location);
                $("input[name ='work_email']").val(edit_data.work_email);
                $("input[name ='work_mobile']").val(edit_data.work_mobile);
                $("input[name ='work_phone']").val(edit_data.work_phone);
            });

            $("#workinfoModal").modal({backdrop: 'static'});
            $("#workinfoModal").modal('show');
       }
    });
}

/**************************************
* Iqama/Bitaqa Details Edit           *
**************************************/
function iqamadetaileditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#iqama_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
    $.ajax({
        type: "POST",
        url : base_url+'home/iqamaModal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            // Begin :: Clearing the Datepicker
            $('#iqama_issuedate').val('').datepicker('update');
            $('#iqama_expirydate').val('').datepicker('update');
            // End   :: Clearing the Datepicker
            $(".error").text('');
            $(".iqama_error").text('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                $("input[name ='id']").val(edit_data.id);
                $('#iqama_profession').find('option').not(':first').remove();

                $("input[name ='iqama_id']").val(edit_data.iqama_bitaqa);

                $.each(object.iqama_profesion, function(key, iqamaprofesion) {
                    if (typeof(edit_data.iqama_profession_id) != "undefined" && edit_data.iqama_profession_id !== null && iqamaprofesion.id == edit_data.iqama_profession_id) {
                        $('#iqama_profession').append($('<option>').text(iqamaprofesion.iqama_profession_name).attr('value', iqamaprofesion.id).attr('selected', 'selected'));
                    }
                    else{
                        $('#iqama_profession').append($('<option>').text(iqamaprofesion.iqama_profession_name).attr('value', iqamaprofesion.id));
                    }
                });
                
                $("input[name ='iqama_issuedate_hijri']").val(edit_data.iqama_issuedate_hijri);

                if (edit_data.iqama_issuedate != "0000-00-00" && edit_data.iqama_issuedate != null && edit_data.iqama_issuedate != "") {
                    var iqama_issuedt = ctm2_formatDate(edit_data.iqama_issuedate);
                    $("#iqama_issuedate").datepicker('setDate', iqama_issuedt);
                }
                else {
                    $("input[name ='iqama_issuedate']").val('');
                }
                
                $("input[name ='iqama_expirydate_hijri']").val(edit_data.iqama_expirydate_hijri);

                if (edit_data.iqama_expirydate != "0000-00-00" && edit_data.iqama_expirydate != null && edit_data.iqama_expirydate != "") {
                    var iqama_exipirydt = ctm2_formatDate(edit_data.iqama_expirydate);
                    $("#iqama_expirydate").datepicker('setDate', iqama_exipirydt);
                }
                else {
                    $("input[name ='iqama_expirydate']").val('');
                }

                $("input[name ='issued_city']").val(edit_data.issued_city);
                $("input[name ='iqama_reminder']").val(edit_data.iqama_reminder);
                /*$("input[name ='muqeem_cardno']").val(edit_data.muqeem_card_no);

                if (edit_data.muqeem_issuedate != "0000-00-00" && edit_data.muqeem_issuedate != null && edit_data.muqeem_issuedate != "") {
                    var muqeem_issuedt = ctm2_formatDate(edit_data.muqeem_issuedate);
                    $("#muqeem_issuedate").datepicker('setDate', muqeem_issuedt);
                }
                else {
                    $("input[name ='muqeem_issuedate']").val('');
                }
                
                if (edit_data.muqeem_expirydate != "0000-00-00" && edit_data.muqeem_expirydate != null && edit_data.muqeem_expirydate != "") {
                    var muqeem_exipirydt = ctm2_formatDate(edit_data.muqeem_expirydate);
                    $("#muqeem_expirydate").datepicker('setDate', muqeem_exipirydt);
                }
                else {
                    $("input[name ='muqeem_expirydate']").val('');
                }
                
                $("input[name ='muqeem_reminder']").val(edit_data.muqeem_reminder);*/
                $("input[name ='gosi_no']").val(edit_data.gosi_number);
            });

            $("#iqamaModal").modal({backdrop: 'static'});
            $("#iqamaModal").modal('show');
       }
    });
}

/*************************************
* Detail : Employee Transfer Update  *
* Date   : 12-04-2021                *
*************************************/
function emptransfereditFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#employtransfr').html(' - '+firstname+' '+lastname+ ' | '+employcode);
    $.ajax({
        type: "POST",
        url : base_url+'home/employtransferModal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            $('#tr_branch').find('option').not(':first').remove();
            $('#tr_dept').find('option').not(':first').remove();
            $('#tr_desg').find('option').not(':first').remove();
            $("input[name ='transfer_date']").val('');
            $(".error").text('');

            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                $("input[name ='id']").val(edit_data.id);
                $("input[name ='oldbranch']").val(edit_data.branch_id);
                $("input[name ='olddept']").val(edit_data.department_id);
                $("input[name ='olddesig']").val(edit_data.designation_id);

                $.each(object.branch, function(key, brnch) {
                    if (typeof(edit_data.branch_id) != "undefined" && edit_data.branch_id !== null && brnch.id == edit_data.branch_id) {
                        $('#tr_branch').append($('<option>').text(brnch.branch_name).attr('value', brnch.id).attr('selected', 'selected'));
                    }
                    else{
                        $('#tr_branch').append($('<option>').text(brnch.branch_name).attr('value', brnch.id));
                    }
                });

                $.each(object.department, function(key, dept) {
                    if (typeof(edit_data.department_id) != "undefined" && edit_data.department_id !== null && dept.id == edit_data.department_id) {
                        $('#tr_dept').append($('<option>').text(dept.dept_name).attr('value', dept.id).attr('selected', 'selected'));
                    }
                    else{
                        $('#tr_dept').append($('<option>').text(dept.dept_name).attr('value', dept.id));
                    }
                });

                $.each(object.designation, function(key, desig) {
                    if (typeof(edit_data.designation_id) != "undefined" && edit_data.designation_id !== null && desig.id == edit_data.designation_id) {
                        $('#tr_desg').append($('<option>').text(desig.designation).attr('value', desig.id).attr('selected', 'selected'));
                    }
                    else{
                        $('#tr_desg').append($('<option>').text(desig.designation).attr('value', desig.id));
                    }
                });
            });

            $("#emptransferModal").modal({backdrop: 'static'});
            $("#emptransferModal").modal('show');
       }
    });
}

/*************************************
* Employee Events Add                *
*************************************/
function eventseditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#event_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
    $('#event_employeename').val(firstname+' '+lastname);

    $.ajax({
        type: "POST",
        url : base_url+'home/employee_eventModal',
        data: {id:id},
        success: function(data){
            $('#emp_eventtype').find('option').not(':first').remove();

            $("input[name ='eventid']").val('');
            
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {

                $("input[name ='eventid']").val(edit_data.id);
                $("input[name ='event_employeeid']").val(edit_data.employee_id);
                $("input[name ='event_alertdate']").val(edit_data.alert_date);

                $.each(object.event_type, function(key, eventtype) {
                    if (typeof(edit_data.event_type) != "undefined" && edit_data.event_type !== null && eventtype.id == edit_data.event_type) {
                        $('#emp_eventtype').append($('<option>').text(eventtype.event_name).attr('value', eventtype.id).attr('selected', 'selected'));
                    }
                    else{
                        $('#emp_eventtype').append($('<option>').text(eventtype.event_name).attr('value', eventtype.id));
                    }
                });

                if (edit_data.event_date != "0000-00-00" && edit_data.event_date != null) {
                    var eventdate = ctm2_formatDate(edit_data.event_date);
                    $("#emp_eventdate").datepicker('setDate', eventdate);
                }
                else {
                    $("#emp_eventdate").val('');
                }

                $("input[name ='emp_eventtitle']").val(edit_data.event_title);
                $("input[name ='event_reminder']").val(edit_data.reminder);
                $("#emp_eventdescription").val(edit_data.event_description);
            });

            $("#employee_EventsModal").modal({backdrop: 'static'});
            $("#employee_EventsModal").modal('show');
       }
       
  });
}

/***********************************
* Detail : User Role Edit          *
* Date   : 06-02-2020              *
***********************************/
function urole_editingFun(id) {
    $.ajax({
        type: "POST",
        url : base_url+'home/userrole_Modal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                $("input[name ='id']").val(edit_data.id);

                $("input[name ='usr_role']").val(edit_data.role_name);
                $("input[name ='usrrole_val']").val(edit_data.role_value);
                $("#u_rolesubmit_btn").html('Update');
            });

            $("#userrole_Model").modal({backdrop: 'static'});
            $("#userrole_Model").modal('show');
       }
    });
}

/**************************************
* Detail : Sponsor Edit (HRM Settings)*
* Date   : 14-05-2020                 *
**************************************/
function settingsponsor_editingFun(id) {
    $.ajax({
        type: "POST",
        url : base_url+'home/settingsponsor_Modal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                $("input[name ='id']").val(edit_data.id);

                $("input[name ='sponsor_name']").val(edit_data.sponsors_name);
                $("input[name ='sponsor_phoneno']").val(edit_data.sponsors_phoneno);
                $("input[name ='sponsorID']").val(edit_data.sponsors_id);
                $("#sponsor_address").val(edit_data.sponsors_address);
                $("#setting_sponsorsubmit_btn").html('Update');
            });

            $("#setting_sponsorModal").modal({backdrop: 'static'});
            $("#setting_sponsorModal").modal('show');
       }
    });
}

/***********************************************
* Detail : VISA Professions Edit (HRM Settings)*
* Date   : 14-05-2020                          *
***********************************************/
function settingvisaprofession_editingFun(id) {
    $.ajax({
        type: "POST",
        url : base_url+'home/settingvisaprofession_Modal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                $("input[name ='id']").val(edit_data.id);

                $("input[name ='visa_profession']").val(edit_data.visa_profession);
                $("input[name ='visaprofession_code']").val(edit_data.code);
                
                $("#setting_visaprofessionsubmit_btn").html('Update');
            });

            $("#setting_visaprofessionModal").modal({backdrop: 'static'});
            $("#setting_visaprofessionModal").modal('show');
       }
    });
}

/****************************************
* Detail : Hospital Edit (HRM Settings) *
* Date   : 14-05-2020                   *
****************************************/
function settinghospital_editingFun(id) {
    $.ajax({
        type: "POST",
        url : base_url+'home/settinghospital_Modal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                $("input[name ='id']").val(edit_data.id);

                $("input[name ='hospital_name']").val(edit_data.hospital_name);
                $("input[name ='hospital_phoneno']").val(edit_data.hospital_phoneno);
                $("#hospital_address").val(edit_data.hospital_address);
                
                $("#setting_hospitalsubmit_btn").html('Update');
            });

            $("#setting_hospitalModal").modal({backdrop: 'static'});
            $("#setting_hospitalModal").modal('show');
       }
    });
}

/**************************************************
* Detail : Insurance Provider Edit (HRM Settings) *
* Date   : 14-05-2020                             *
**************************************************/
function settinginsuranceprovider_editingFun(id) {
	$.ajax({
        type: "POST",
        url : base_url+'home/settinginsuranceprovider_Modal',
        data: {id:id},
        success: function(data){
            var slno                     = 0;
            var insrcprovider_upload     = [];
            var insuranceprovider_upload = '';
            var contact_persons          = [];
            var contact_persons_ph       = [];
            var contact_persons_email    = [];
            var htmlstr                  = '';
        	$("input[name ='id']").val('');
        	var object = JSON.parse(data);
            
        	$.each(object.view, function(key, edit_data) {
    			$("input[name ='id']").val(edit_data.id);

    			$("input[name ='insurance_company_name']").val(edit_data.company_name);
                $("input[name ='insurance_company_phno']").val(edit_data.phone_number);

                if (typeof(edit_data.documents) != "undefined" && edit_data.documents !== null) {
                    insrcprovider_upload     = edit_data.documents;
                    insuranceprovider_upload = insrcprovider_upload.split('/');
                    $(".insurance_upld").html(insuranceprovider_upload[3]);
                }
                else {
                    $(".insurance_upld").html("Choose file");
                }

                $("#insurance_company_adrs").val(edit_data.address);

                if (typeof(edit_data.contact_person_name) != "undefined" && edit_data.contact_person_name !== null && edit_data.contact_person_name != "") {
                    contact_persons = JSON.parse(edit_data.contact_person_name);
                }

                if (typeof(edit_data.contact_person_phno) != "undefined" && edit_data.contact_person_phno !== null && edit_data.contact_person_phno != "") {
                    contact_persons_ph = JSON.parse(edit_data.contact_person_phno);
                }

                if (typeof(edit_data.contact_person_email) != "undefined" && edit_data.contact_person_email !== null && edit_data.contact_person_email != "") {
                    contact_persons_email = JSON.parse(edit_data.contact_person_email);
                }

                $.each(contact_persons, function(k1, v1) {
                    slno = slno + 1;
                    htmlstr += '<tr id="tr'+slno+'" class="inite">\
                                    <td class="sl_id">'+slno+'</td>\
                                    <td><input type="hidden" name="ins_company_contact_person[]" id="ins_company_contact_person" value="'+v1+'">'+v1+'</td>\
                                    <td><input type="hidden" name="ins_company_contact_person_phno[]" id="ins_company_contact_person_phno" value="'+contact_persons_ph[k1]+'">'+contact_persons_ph[k1]+'</td>\
                                    <td><input type="hidden" name="ins_company_contact_person_mail[]" id="ins_company_contact_person_mail" value="'+contact_persons_email[k1]+'">'+contact_persons_email[k1]+'</td>\
                                    <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="remove_insrc_cperson('+slno+')" title="Remove Insurance"><i class="la la-trash-o"></i>Delete</button>\
                                    </td>\
                                </tr>';
                });

                $("#insurance_provider_contact_details > tbody").html(htmlstr);

                $("#insurance_provider_submit").html('Update');
        	});

        	$("#setting_insurance_providerModal").modal({backdrop: 'static'});
        	$("#setting_insurance_providerModal").modal('show');
       }
    });
}

/****************************************
* Detail : Benefit Category Edit        *
* Date   : 18-05-2020                   *
****************************************/
function benefitcategory_editingFun(id) {
    $.ajax({
        type: "POST",
        url : base_url+'home/benefitscategory_Modal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                $("input[name ='id']").val(edit_data.id);

                $("input[name ='benefit_category']").val(edit_data.benefit_category);
                $("#benefitcategory_desc").val(edit_data.description);
                
                $("#benefitcategorysubmit_btn").html('Update');
            });

            $("#benefitcategoryModal").modal({backdrop: 'static'});
            $("#benefitcategoryModal").modal('show');
       }
    });
}

/**************************************
* Employee Benefits Edit              *
**************************************/
function employbenefiteditingFun(id) {
    $.ajax({
        type: "POST",
        url : base_url+'home/employee_benefitsModal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                var html_str    = '';

                $("input[name ='id']").val(edit_data.id);
                        
                $("#emp_benefitcategory").val(edit_data.benefit_category_id).trigger('change');
                $("input[name ='emp_benefitname']").val(edit_data.benefit_name);
                $("#emp_benefittype").val(edit_data.benefit_type).trigger('change');

                /*if (edit_data.benefit_type == 1) {
                    html_str = '<label for="benefit_value" class="form-control-label">Benefit Value</label>\
                                <span style="color:red"> *</span>&nbsp;&nbsp;<span id="emp_benefitvalue_error" class="error" for="emp_benefitvalue_error"></span>\
                                   <input type="text" class="form-control" name="emp_benefitvalue" id="emp_benefitvalue" value="'+edit_data.value_servicename+'">';
                }
                else if (edit_data.benefit_type == 2) {
                    html_str = '<label for="benefit_value" class="form-control-label">Benefit Value</label>\
                                <span style="color:red"> *</span>&nbsp;&nbsp;<span id="emp_benefitvalue_error" class="error" for="emp_benefitvalue_error"></span>\
                                   <input type="number" class="form-control" name="emp_benefitvalue" id="emp_benefitvalue" value="'+edit_data.value_amount+'">';
                }
                else {
                    html_str = '';
                }
                $('.employee_benefitvalue').html(html_str);*/
            });
            $("#employbenefitsubmit_btn").html('Update');

            $("#employeebenefit_Modal").modal({backdrop: 'static'});
            $("#employeebenefit_Modal").modal('show');
       }
    });
}

/**************************************
* Detail : Events Edit (HRM Settings)*
* Date   : 28-05-2020                 *
**************************************/
function settingevents_editingFun(id) {
    $.ajax({
        type: "POST",
        url : base_url+'home/settingevent_Modal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                $("input[name ='id']").val(edit_data.id);

                $("input[name ='events_name']").val(edit_data.event_name);
                $("#events_description").val(edit_data.description);
                $("#setting_eventsubmit_btn").html('Update');
            });

            $("#setting_eventsModal").modal({backdrop: 'static'});
            $("#setting_eventsModal").modal('show');
       }
    });
}


/*************************************
* Delete Branch                      *
*************************************/
$(document).on('click', '.kt_branch', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'branch',mssg:'branch',table:'qzolvehrm_branch'},
            success: function(data) {
                datatable_branch.ajax.reload();
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
      })
});

/***********************************
* Delete Department                *
***********************************/
$(document).on('click', '.kt_department', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'department',mssg:'department',table:'qzolvehrm_department'},
            success: function(data) {
                datatable_dept.ajax.reload();
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
      })
});

/***********************************
* Delete Designation               *
***********************************/
$(document).on('click', '.kt_designation', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'designation',mssg:'designation',table:'qzolvehrm_designation'},
            success: function(data) {
                datatable_designation.ajax.reload();
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
      })
});

/***********************************
* Delete Employee                  *
***********************************/
$(document).on('click', '.kt_employee', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
     swal.fire({
      title: "Are you sure?",
      text: "You will not be able to recover this Employee Entry!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel it!" }).then(result => {
      if (result.value) {

      $.ajax({
            type: "POST",
            url : base_url+'home/comm_dlt_delete_action',
            data: {id:id,url:'employee',mssg:'employee',table:'qzolvehrm_employee'},
            success: function(data) {
            	datatable_employee.ajax.reload();
                swal.fire("Deleted!", "Your Employee Entry has been deleted.", "success");
           }
        });
        } else {
          swal.fire("Cancelled", "Your Employee Entry is safe :)", "error");
        }
      })
});

/*************************************
* Delete Previous Detail Company     *
*************************************/
$(document).on('click', '.kt_previousdetail_company', function () {
  var id = $(this).attr('id');
  var employ_id = $(this).data('empid');
  var url = '';
  var mssg = '';
  var table = '';
     swal.fire({
      title: "Are you sure?",
      text: "You will not be able to recover this Company Entry!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel it!" }).then(result => {
      if (result.value) {
      $.ajax({
            type: "POST",
            url : base_url+'home/comm_dlt_delete_action',
            data: {id:id,url:'view_previousdetail?id='+employ_id+'',mssg:'previous detail',table:'qzolvehrm_employe_pre_details'},
            success: function(data) {
                datatable_previousdetail_company.ajax.reload();
                swal.fire("Deleted!", "Your Company Entry has been deleted.", "success");
           }
        });
        } else {
          swal.fire("Cancelled", "Your Company Entry is safe :)", "error");
        }
      })
});

// Document Controller Delete
$(document).on('click', '.DocumentControllerDeleteFn', function () {
  var id = $(this).attr('id');
  var tbl = '';
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
            url : base_url+'home/document_controller_delete',
            dataType: 'JSON',
            data: {id:id,tbl:'qzolvehrm_documentcontroller'},
            success: function(data) {
                window.location.href="document_controller";
                swal.fire(del_lang9, del_lang10, "success");            
           }
        });
        } else {
          swal.fire(del_lang5, del_lang6, "error");
        }
      })
});

/*************************************
* Delete UserRole                    *
*************************************/
$(document).on('click', '.kt_userrole', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
     swal.fire({
      title: "Are you sure?",
      text: "You will not be able to recover this User Role Entry!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel it!" }).then(result => {
      if (result.value) {

      $.ajax({
            type: "POST",
            url : base_url+'home/comm_dlt_delete_action',
            data: {id:id,url:'userrole',mssg:'User Role',table:'qzolvehrm_userrole'},
            success: function(data) {
                datatable_userrole.ajax.reload();
                swal.fire("Deleted!", "Your User Role Entry has been deleted.", "success");
           }
        });
        } else {
          swal.fire("Cancelled", "Your User Role Entry is safe :)", "error");
        }
      })
});

/*************************************
* Delete Office Building             *
*************************************/
$(document).on('click', '.kt_offcbuildng', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'office_building',mssg:'Building',table:'qzolvehrm_buildng'},
            success: function(data) {
                datatable_building.ajax.reload();
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
      })
});

/*************************************
* Delete Office Floor                *
*************************************/
$(document).on('click', '.kt_offcfloor', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'office_floor',mssg:'Floor',table:'qzolvehrm_floor'},
            success: function(data) {
                datatable_floor.ajax.reload();
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
      })
});

/*************************************
* Delete Office Room No.             *
*************************************/
$(document).on('click', '.kt_offcroom', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'office_room',mssg:'Room No.',table:'qzolvehrm_room_no'},
            success: function(data) {
                datatable_roomno.ajax.reload();
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
      })
});

/*************************************
* Delete Employee Events             *
*************************************/
$(document).on('click', '.kt_employevent', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
     swal.fire({
      title: "Are you sure?",
      text: "You will not be able to recover this Event Entry!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel it!" }).then(result => {
      if (result.value) {

      $.ajax({
            type: "POST",
            url : base_url+'home/comm_dlt_delete_action',
            data: {id:id,url:'employee_events_view',mssg:'Event',table:'qzolvehrm_subemployee_events'},
            success: function(data) {
                datatable_employevents_event.ajax.reload();
                swal.fire("Deleted!", "Your Event Entry has been deleted.", "success");
           }
        });
        } else {
          swal.fire("Cancelled", "Your Event Entry is safe :)", "error");
        }
      })
});

/*************************************
* Delete Sponsor (HRM Setting)       *
*************************************/
$(document).on('click', '.kt_settingsponsor', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'setting_sponsors',mssg:'Sponsor',table:'qzolvehrm_sponsors'},
            success: function(data) {
                datatable_setting_sponsors.ajax.reload();
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
      })
});

/***************************************
* Delete VISA Professions (HRM Setting)*
***************************************/
$(document).on('click', '.kt_settingvisaprofession', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'setting_visaprofessions',mssg:'VISA Profession',table:'qzolvehrm_visaprofessions'},
            success: function(data) {
                datatable_setting_visaproffession.ajax.reload();
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
      })
});

/***********************************
* Delete Hospital (HRM Setting)    *
***********************************/
$(document).on('click', '.kt_settinghospital', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'setting_hospitals',mssg:'Hospital',table:'qzolvehrm_hospitals'},
            success: function(data) {
                datatable_setting_hospital.ajax.reload();
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
      })
});

/*****************************************
* Delete Insurance Provider (HRM Setting)*
*****************************************/
$(document).on('click', '.kt_settinginsuranceprovider', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'setting_insuranceprovider',mssg:'Insurance Provider',table:'qzolvehrm_insurance_provider'},
            success: function(data) {
                datatable_setting_insuranceprovider.ajax.reload();
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
      })
});

/********************************************
* Delete Benefit Category (Benefit Settings)*
********************************************/
$(document).on('click', '.kt_benefitscategory', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'benefits_category',mssg:'Benefit Category',table:'qzolvehrm_benefitcategory'},
            success: function(data) {
                datatable_benefitcategory.ajax.reload();
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
      })
});

/*************************************
* Delete Benefit (Benefit Settings)  *
*************************************/
$(document).on('click', '.kt_employeebenefits', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'benefits',mssg:'Benefit',table:'qzolvehrm_employee_benefits'},
            success: function(data) {
                datatable_benefits.ajax.reload();
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
      })
});

/*************************************
* Delete Events (HRM Setting)        *
*************************************/
$(document).on('click', '.kt_settingevents', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
     swal.fire({
      title: "Are you sure?",
      text: "You will not be able to recover this Event Entry!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel it!" }).then(result => {
      if (result.value) {

      $.ajax({
            type: "POST",
            url : base_url+'home/comm_dlt_delete_action',
            dataType: 'JSON',
            data: {id:id,url:'settings_events',mssg:'Event',table:'qzolvehrm_events'},
            success: function(data) {
                datatable_setting_events.ajax.reload();
                if (data.flagg == "Success") {
                    swal.fire("Deleted!", "Your Event Entry has been deleted.", "success");
                }
                else {
                    swal.fire("Unable to Delete!", "Your Event Entry exist in "+data.exist_in+".", "error");
                }
           }
        });
        } else {
          swal.fire("Cancelled", "Your Event Entry is safe :)", "error");
        }
      })
});

/*************************************
* Delete Dependant Information       *
*************************************/
$(document).on('click', '.kt_employdependant', function () {
  var id          = $(this).attr('id');
  var employ_id   = $(this).data('empid');
  var employ_name = $(this).data('empname');
  var url = '';
  var mssg = '';
  var table = '';
     swal.fire({
      title: "Are you sure?",
      text: "You will not be able to recover this Dependent Entry!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel it!" }).then(result => {
      if (result.value) {
      $.ajax({
            type: "POST",
            url : base_url+'home/comm_dlt_delete_action',
            data: {id:id,url:'view_employ_dependents?id='+employ_id+'&&employ_name='+employ_name+'',mssg:'dependent',table:'qzolvehrm_employee_dependent'},
            success: function(data) {
                datatable_employee_dependents.ajax.reload();
                swal.fire("Deleted!", "Your Dependent Entry has been deleted.", "success");
           }
        });
        } else {
          swal.fire("Cancelled", "Your Dependent Entry is safe :)", "error");
        }
      })
});

/***************************************
* passport Notification edit           *
***************************************/

function passport_notification_edit(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#pass_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);

	$.ajax({
        type: "POST",
        url : base_url+'home/passport_notification_edit_Modal',
        data: {id:id},
        success: function(data){
            var passportdet_upload = [];
            var passport_upload    = '';

            $("input[name ='passport_id']").val('');
        	$("input[name ='passprt_upld']").val('');
            $(".error").text('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
                var validfrom = ctm2_formatDate(edit_data.valid_from);
                var validtill = ctm2_formatDate(edit_data.valid_till);

    			$("input[name ='passport_id']").val(edit_data.id);
    			$("#passport_notification_number").val(edit_data.passport_number);
                $('#passport_notification_validfrom').datepicker('setDate', validfrom);
                $('#passport_notification_validtill').datepicker('setDate', validtill);
    			$("#passprt_notification_remdr").val(edit_data.reminder);
    			
                if (typeof(edit_data.upload) != "undefined" && edit_data.upload !== null) {
                    passportdet_upload = edit_data.upload;
                    passport_upload    = passportdet_upload.split('/');
                    $(".exp_passportupld").html(passport_upload[3]);
                }
                else {
                    $(".exp_passportupld").html("Choose file");
                }
        	});

        	$("#passport_notification_Modal").modal({backdrop: 'static'});
        	$("#passport_notification_Modal").modal('show');
       }
    });
}
/******************************************************
* badge Notification edit                             *
******************************************************/

function badge_notification_edit(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#badge_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);

	$.ajax({
        type: "POST",
        url : base_url+'home/badge_notification_edit_Modal',
        data: {id:id},
        success: function(data){
            var badgedet_upload = [];
            var badge_upload    = '';
            $("input[name ='badge_id']").val('');
        	$("input[name ='badgedet_upld']").val('');
            $(".error").text('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
                var validfrom = ctm2_formatDate(edit_data.valid_from);
                var validtill = ctm2_formatDate(edit_data.valid_till);

    			$("input[name ='badge_id']").val(edit_data.id);
    			$("#badge_notification_number").val(edit_data.number);
                $('#badge_notification_validfrom').datepicker('setDate', validfrom);
                $('#badge_notification_validtill').datepicker('setDate', validtill);
    			$("#badge_notification_remdr").val(edit_data.reminder);

                if (typeof(edit_data.upload) != "undefined" && edit_data.upload !== null) {
                    badgedet_upload = edit_data.upload;
                    badge_upload    = badgedet_upload.split('/');
                    $(".exp_badgeupld").html(badge_upload[3]);
                }
                else {
                    $(".exp_badgeupld").html("Choose file");
                }
        	});

        	$("#badge_notification_Modal").modal({backdrop: 'static'});
        	$("#badge_notification_Modal").modal('show');
       }
    });
}
/***********************************
* insurance Notification edit      *
***********************************/

function insurance_notification_edit(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#insrc_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);

	$.ajax({
        type: "POST",
        url : base_url+'home/insurance_notification_edit_Modal',
        data: {id:id},
        success: function(data){
            var insurancedet_upload = [];
            var insurance_upload    = '';
            $("input[name ='insurance_id']").val('');
        	$("input[name ='insurance_documents']").val('');
            $(".error").text('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
                var validfrom = ctm2_formatDate(edit_data.valid_from);
                var validtill = ctm2_formatDate(edit_data.valid_till);

    			$("input[name ='insurance_id']").val(edit_data.id);
    			$("#insurance_notification_number").val(edit_data.insurance_no);
                $('#insurance_notification_validfrom').datepicker('setDate', validfrom);
                $('#insurance_notification_validtill').datepicker('setDate', validtill);
    			$("#insurance_notification_remdr").val(edit_data.reminder);
    			
                if (typeof(edit_data.upload) != "undefined" && edit_data.upload !== null) {
                    insurancedet_upload = edit_data.upload;
                    insurance_upload    = insurancedet_upload.split('/');
                    $(".exp_insuranceupld").html(insurance_upload[3]);
                }
                else {
                    $(".exp_insuranceupld").html("Choose file");
                }
        	});

        	$("#insurance_notification_Modal").modal({backdrop: 'static'});
        	$("#insurance_notification_Modal").modal('show');
       }
    });
}

/*****************************************
* Driving License Notification edit      *
*****************************************/
function drivinglicense_notification_edit(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#drv_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);

	$.ajax({
        type: "POST",
        url : base_url+'home/drivinglicense_notification_edit_Modal',
        data: {id:id},
        success: function(data){
            var drivinglicdet_upload = [];
            var drivinglic_upload    = '';
            $("input[name ='drivinglicense_id']").val('');
        	$("input[name ='drv_upload']").val('');
            $(".error").text('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
                var validfrom = ctm2_formatDate(edit_data.valid_from);
                var validtill = ctm2_formatDate(edit_data.valid_till);

    			$("input[name ='drivinglicense_id']").val(edit_data.id);
    			$("#drivinglicense_notification_number").val(edit_data.license_number);
                $('#drivinglicense_notification_validfrom').datepicker('setDate', validfrom);
                $('#drivinglicense_notification_validtill').datepicker('setDate', validtill);
    			$("#drivinglicense_notification_remdr").val(edit_data.reminder);
    			
                if (typeof(edit_data.upload) != "undefined" && edit_data.upload !== null) {
                    drivinglicdet_upload = edit_data.upload;
                    drivinglic_upload    = drivinglicdet_upload.split('/');
                    $(".exp_drivinglicupld").html(drivinglic_upload[3]);
                }
                else {
                    $(".exp_drivinglicupld").html("Choose file");
                }
        	});
            
        	$("#drivinglicense_notification_Modal").modal({backdrop: 'static'});
        	$("#drivinglicense_notification_Modal").modal('show');
       }
    });
}
/******************************************************
* insurance Notification edit                         *
******************************************************/

function worklicense_notification_edit(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#worklic_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);

	$.ajax({
        type: "POST",
        url : base_url+'home/worklicense_notification_edit_Modal',
        data: {id:id},
        success: function(data){
            var worklicdet_upload = [];
            var worklic_upload    = '';

            $("input[name ='worklicense_id']").val('');
        	$("input[name ='wl_upload']").val('');
            $(".error").text('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
                var validfrom = ctm2_formatDate(edit_data.valid_from);
                var validtill = ctm2_formatDate(edit_data.valid_till);

    			$("input[name ='worklicense_id']").val(edit_data.id);
    			$("#worklicense_notification_number").val(edit_data.license_number);
                $('#worklicense_notification_validfrom').datepicker('setDate', validfrom);
                $('#worklicense_notification_validtill').datepicker('setDate', validtill);
    			$("#worklicense_notification_remdr").val(edit_data.reminder);
    			
                if (typeof(edit_data.upload) != "undefined" && edit_data.upload !== null) {
                    worklicdet_upload = edit_data.upload;
                    worklicdet_upload    = worklicdet_upload.split('/');
                    $(".exp_worklicupld").html(worklicdet_upload[3]);
                }
                else {
                    $(".exp_worklicupld").html("Choose file");
                }
        	});

        	$("#worklicense_notification_Modal").modal({backdrop: 'static'});
        	$("#worklicense_notification_Modal").modal('show');
       }
    });
}

/*************************************************
* ID Notification Edit                           *
*************************************************/
function id_notification_edit(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#id_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);

	$.ajax({
        type: "POST",
        url : base_url+'home/id_notification_edit_Modal',
        data: {id:id},
        success: function(data){
            var iddet_upload = [];
            var id_upload    = '';

            $("input[name ='iddetails_id']").val('');
        	$("input[name ='iddet_upld']").val('');
            $(".error").text('');
        	var object = JSON.parse(data);

        	$.each(object.view, function(key, edit_data) {
                var validfrom = ctm2_formatDate(edit_data.valid_from);
                var validtill = ctm2_formatDate(edit_data.valid_till);

    			$("input[name ='iddetails_id']").val(edit_data.id);
    			$("#id_notification_number").val(edit_data.number);
                $('#id_notification_validfrom').datepicker('setDate', validfrom);
                $('#id_notification_validtill').datepicker('setDate', validtill);
    			$("#id_notification_remdr").val(edit_data.reminder);
    			
                if (typeof(edit_data.upload) != "undefined" && edit_data.upload !== null) {
                    iddet_upload = edit_data.upload;
                    id_upload    = iddet_upload.split('/');
                    $(".exp_idupld").html(id_upload[3]);
                }
                else {
                    $(".exp_idupld").html("Choose file");
                }
        	});

        	$("#id_notification_Modal").modal({backdrop: 'static'});
        	$("#id_notification_Modal").modal('show');
       }
    });
}

/*****************************************
* Iqama/Bitaqa Notification Details Edit *
*****************************************/
function iqama_notificationeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#iqama_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
    $.ajax({
        type: "POST",
        url : base_url+'home/iqamaModal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            $(".error").text('');
            $(".iqama_error").text('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {

                $("input[name ='id']").val(edit_data.id);

                $("input[name ='iqama_notif_id']").val(edit_data.iqama_bitaqa);

                $.each(object.iqama_profesion, function(key, iqamaprofesion) {
                    if (typeof(edit_data.iqama_profession_id) != "undefined" && edit_data.iqama_profession_id !== null && iqamaprofesion.id == edit_data.iqama_profession_id) {
                        $('#iqama_notif_profession').append($('<option>').text(iqamaprofesion.iqama_profession_name).attr('value', iqamaprofesion.id).attr('selected', 'selected'));
                    }
                    else{
                        $('#iqama_notif_profession').append($('<option>').text(iqamaprofesion.iqama_profession_name).attr('value', iqamaprofesion.id));
                    }
                });
                
                $("input[name ='iqama_notif_issuedate_hijri']").val(edit_data.iqama_issuedate_hijri);

                if (edit_data.iqama_issuedate != "0000-00-00" && edit_data.iqama_issuedate != null && edit_data.iqama_issuedate != "") {
                    var iqama_issuedt = ctm2_formatDate(edit_data.iqama_issuedate);
                    $('#iqama_notif_issuedate').datepicker('setDate', iqama_issuedt);
                }
                else {
                    $("#iqama_notif_issuedate").val('');
                }

                $("input[name ='iqama_notif_expirydate_hijri']").val(edit_data.iqama_expirydate_hijri);

                if (edit_data.iqama_expirydate != "0000-00-00" && edit_data.iqama_expirydate != null && edit_data.iqama_expirydate != "") {
                    var iqama_exipirydt = ctm2_formatDate(edit_data.iqama_expirydate);
                    $('#iqama_notif_expirydate').datepicker('setDate', iqama_exipirydt);
                }
                else {
                    $("#iqama_notif_expirydate").val('');
                }

                $("input[name ='notif_issued_city']").val(edit_data.issued_city);
                $("input[name ='iqama_notif_reminder']").val(edit_data.iqama_reminder);
                $("input[name ='notif_muqeem_cardno']").val(edit_data.muqeem_card_no);

                if (edit_data.muqeem_issuedate != "0000-00-00" && edit_data.muqeem_issuedate != null && edit_data.muqeem_issuedate != "") {
                    var muqeem_issuedt = ctm2_formatDate(edit_data.muqeem_issuedate);
                    $('#notif_muqeem_issuedate').datepicker('setDate', muqeem_issuedt);
                }
                else {
                    $("#notif_muqeem_issuedate").val('');
                }

                if (edit_data.muqeem_expirydate != "0000-00-00" && edit_data.muqeem_expirydate != null && edit_data.muqeem_expirydate != "") {
                    var muqeem_exipirydt = ctm2_formatDate(edit_data.muqeem_expirydate);
                    $('#notif_muqeem_expirydate').datepicker('setDate', muqeem_exipirydt);
                }
                else {
                    $("#notif_muqeem_expirydate").val('');
                }
                
                $("input[name ='notif_muqeem_reminder']").val(edit_data.muqeem_reminder);
                $("input[name ='notif_gosi_no']").val(edit_data.gosi_number);
            });

            $("#iqama_notificationModal").modal({backdrop: 'static'});
            $("#iqama_notificationModal").modal('show');
       }
    });
}

/*************************************************
* Labour Law Notification Edit                   *
*************************************************/
function laborlaw_notification_edit(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#laborlaw_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
    
    $.ajax({
        type: "POST",
        url : base_url+'home/laborlaw_notification_edit_Modal',
        data: {id:id},
        success: function(data){
            var labourlaw_upload = [];
            var labor_lawupload  = '';

            $("input[name ='labourlaw_id']").val('');
            $("input[name ='labor_lawsigned']").val('');
            $("input[name ='notif_laborlaw_alertdt']").val('');
            $(".error").text('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                if (edit_data.laborlawsigned_date != "0000-00-00" && edit_data.laborlawsigned_date != null && edit_data.laborlawsigned_date != "") {
                    var labourlaw_signeddate = ctm2_formatDate(edit_data.laborlawsigned_date);
                    $('#notif_laborlawsign_date').datepicker('setDate', labourlaw_signeddate);
                }
                else {
                    $("#notif_laborlawsign_date").val('');
                }

                if (edit_data.laborlaw_expirydate != "0000-00-00" && edit_data.laborlaw_expirydate != null && edit_data.laborlaw_expirydate != "") {
                    var labourlaw_expirydate = ctm2_formatDate(edit_data.laborlaw_expirydate);
                    $('#notif_laborlaw_expiry').datepicker('setDate', labourlaw_expirydate);
                }
                else {
                    $("#notif_laborlaw_expiry").val('');
                }
                
                if (edit_data.laborlaw_alertdate != "0000-00-00" && edit_data.laborlaw_alertdate != null && edit_data.laborlaw_alertdate != "") {
                    var labourlaw_alertdate  = ctm2_formatDate(edit_data.laborlaw_alertdate);
                    $("input[name ='notif_laborlaw_alertdt']").val(labourlaw_alertdate);
                }
                else {
                    $("input[name ='notif_laborlaw_alertdt']").val('');
                }

                $("input[name ='labourlaw_id']").val(edit_data.id);
                $("#notif_laborlaw_reminder").val(edit_data.laborlaw_reminder);
                
                if (typeof(edit_data.labor_lawsigned) != "undefined" && edit_data.labor_lawsigned !== null) {
                    labourlaw_upload = edit_data.labor_lawsigned;
                    labor_lawupload  = labourlaw_upload.split('/');
                    $(".notif_lablaw_upld").html(labor_lawupload[4]);
                }
                else {
                    $(".notif_lablaw_upld").html("Choose file");
                }
            });

            $("#labourlaw_notification_Modal").modal({backdrop: 'static'});
            $("#labourlaw_notification_Modal").modal('show');
       }
    });
}

/*************************************************
* Labour Contract Notification Edit              *
*************************************************/
function laborcontract_notification_edit(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#laborcontract_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
    $.ajax({
        type: "POST",
        url : base_url+'home/laborcontract_notification_edit_Modal',
        data: {id:id},
        success: function(data){
            var labourcontract_upload = [];
            var labor_contractupload  = '';

            $("input[name ='labourcontract_id']").val('');
            $("input[name ='labor_contract']").val('');
            $("input[name ='notif_laborcontract_alertdt']").val('');
            $(".error").text('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                if (edit_data.laborcontractsigned_date != "0000-00-00" && edit_data.laborcontractsigned_date != null && edit_data.laborcontractsigned_date != "") {
                    var labourcontract_signeddate = ctm2_formatDate(edit_data.laborcontractsigned_date);
                    $('#notif_laborcontractsign_date').datepicker('setDate', labourcontract_signeddate);
                }
                else {
                    $("#notif_laborcontractsign_date").val('');
                }

                if (edit_data.laborcontract_expirydate != "0000-00-00" && edit_data.laborcontract_expirydate != null && edit_data.laborcontract_expirydate != "") {
                    var labourcontract_expirydate = ctm2_formatDate(edit_data.laborcontract_expirydate);
                    $('#notif_laborcontract_expiry').datepicker('setDate', labourcontract_expirydate);
                }
                else {
                    $("#notif_laborcontract_expiry").val('');
                }
                
                if (edit_data.laborcontract_alertdate != "0000-00-00" && edit_data.laborcontract_alertdate != null && edit_data.laborcontract_alertdate != "") {
                    var labourcontract_alertdate  = ctm2_formatDate(edit_data.laborcontract_alertdate);
                    $("input[name ='notif_laborcontract_alertdt']").val(labourcontract_alertdate);
                }
                else {
                    $("input[name ='notif_laborcontract_alertdt']").val('');
                }
                

                $("input[name ='labourcontract_id']").val(edit_data.id);
                $("#notif_laborcontract_reminder").val(edit_data.laborcontract_reminder);
                
                if (typeof(edit_data.labor_contact) != "undefined" && edit_data.labor_contact !== null) {
                    labourcontract_upload = edit_data.labor_contact;
                    labor_contractupload  = labourcontract_upload.split('/');
                    $(".notif_labcontract_upld").html(labor_contractupload[4]);
                }
                else {
                    $(".notif_labcontract_upld").html("Choose file");
                }
            });

            $("#labourcontract_notification_Modal").modal({backdrop: 'static'});
            $("#labourcontract_notification_Modal").modal('show');
       }
    });
}

/*************************************************
* Company Contract Notification Edit             *
*************************************************/
function companycontract_notification_edit(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#cmpcontract_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);
    $.ajax({
        type: "POST",
        url : base_url+'home/companycontract_notification_edit_Modal',
        data: {id:id},
        success: function(data){
            var companycontract_upload = [];
            var company_contractupload = '';

            $("input[name ='cmpcontract_id']").val('');
            $("input[name ='company_contract']").val('');
            $("input[name ='notif_cmpcontract_alertdt']").val('');
            $(".error").text('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                if (edit_data.companycontractsign_date != "0000-00-00" && edit_data.companycontractsign_date != null && edit_data.companycontractsign_date != "") {
                    var cmpnycontract_signeddate = ctm2_formatDate(edit_data.companycontractsign_date);
                    $('#notif_cmpcontractsign_date').datepicker('setDate', cmpnycontract_signeddate);
                }
                else {
                    $("#notif_cmpcontractsign_date").val('');
                }

                if (edit_data.companycontract_expirydate != "0000-00-00" && edit_data.companycontract_expirydate != null && edit_data.companycontract_expirydate != "") {
                    var cmpnycontract_expirydate = ctm2_formatDate(edit_data.companycontract_expirydate);
                    $('#notif_cmpcontract_expiry').datepicker('setDate', cmpnycontract_expirydate);
                }
                else {
                    $("#notif_cmpcontract_expiry").val('');
                }

                if (edit_data.companycontract_alertdate != "0000-00-00" && edit_data.companycontract_alertdate != null && edit_data.companycontract_alertdate != "") {
                    var cmpnycontract_alertdate  = ctm2_formatDate(edit_data.companycontract_alertdate);
                    $("input[name ='notif_cmpcontract_alertdt']").val(cmpnycontract_alertdate);
                }
                else {
                    $("input[name ='notif_cmpcontract_alertdt']").val('');
                }

                $("input[name ='cmpcontract_id']").val(edit_data.id);
                $("#notif_cmpcontract_reminder").val(edit_data.companycontract_reminder);
                
                if (typeof(edit_data.labor_contactsigned) != "undefined" && edit_data.labor_contactsigned !== null) {
                    companycontract_upload = edit_data.labor_contactsigned;
                    company_contractupload  = companycontract_upload.split('/');
                    $(".notif_cmpcontract_upld").html(company_contractupload[4]);
                }
                else {
                    $(".notif_cmpcontract_upld").html("Choose file");
                }
            });

            $("#cmpcontract_notification_Modal").modal({backdrop: 'static'});
            $("#cmpcontract_notification_Modal").modal('show');
       }
    });
}

/*************************************
* Employee Event Notification Edit   *
*************************************/
function event_notificationeditingFun(id,fname,lname,employcode) {
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#event_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);

    $.ajax({
        type: "POST",
        url : base_url+'home/employee_eventModal',
        data: {id:id},
        success: function(data){
            $('#notif_eventtype').find('option').not(':first').remove();

            $("input[name ='notif_eventid']").val('');
            $(".error").text('');
            
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {

                $("input[name ='notif_eventid']").val(edit_data.id);
                $("input[name ='notif_event_employeeid']").val(edit_data.employee_id);
                $("input[name ='notif_event_alertdate']").val(edit_data.alert_date);

                $.each(object.event_type, function(key, eventtype) {
                    if (typeof(edit_data.event_type) != "undefined" && edit_data.event_type !== null && eventtype.id == edit_data.event_type) {
                        $('#notif_eventtype').append($('<option>').text(eventtype.event_name).attr('value', eventtype.id).attr('selected', 'selected'));
                    }
                    else{
                        $('#notif_eventtype').append($('<option>').text(eventtype.event_name).attr('value', eventtype.id));
                    }
                });
                
                if (edit_data.event_date != "0000-00-00" && edit_data.event_date != null && edit_data.event_date != "") {
                    var eventdate = ctm2_formatDate(edit_data.event_date);
                    $("#notif_eventdate").datepicker('setDate', eventdate);
                }
                else {
                    $("#notif_eventdate").val('');
                }
                
                $("input[name ='notif_eventtitle']").val(edit_data.event_title);
                $("input[name ='notif_event_reminder']").val(edit_data.reminder);
                $("#notif_eventdescription").val(edit_data.event_description);
            });

            $("#Events_notificationModal").modal({backdrop: 'static'});
            $("#Events_notificationModal").modal('show');
       }
       
  });
}

/*************************************
* Detail : Exit Re-Entry VISA Details*
* Date   : 16-04-2021                *
*************************************/
function visanotif_edit(empId,id,fname,lname,employcode) {
    $('.form-control').removeClass('is-invalid');
    var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#visa_notif_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);

    $.ajax({
        type: "POST",
        url : base_url+'home/visa_notif_edit_Modal',
        data: {id:id},
        success: function(data){

            $("input[name ='visaid']").val('');
            $('#visa_employstatus').find('option').remove();
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
                var departure = ctm2_formatDate(edit_data.departure_date);
                var arrival   = ctm2_formatDate(edit_data.arrival_date);

                $("input[name ='visaid']").val(edit_data.id);
                $("input[name ='visaempId']").val(edit_data.employee_id);
                $("#visa_no").val(edit_data.visa_number);
                $('#visadeparture_date').datepicker('setDate', departure);
                $('#visaarrival_date').datepicker('setDate', arrival);
                $("#visa_noofdays").val(edit_data.number_of_days);

                $.each(object.employee_status, function(key, emp_status) {
                    if (typeof(edit_data.employee_status) != "undefined" && edit_data.employee_status !== null && emp_status.id == edit_data.employee_status) {
                        $('#visa_employstatus').append($('<option>').text(emp_status.status_name).attr('value', emp_status.id).attr('selected', 'selected'));
                    }
                    else{
                        $('#visa_employstatus').append($('<option>').text(emp_status.status_name).attr('value', emp_status.id));
                    }
                });
            });

            $("#visa_notification_Modal").modal({backdrop: 'static'});
            $("#visa_notification_Modal").modal('show');
       }
    });
}

/******************************************
* Get Employee PDF                        *
******************************************/
$("#empview_pdf").click(function(e) {
    e.preventDefault();
    var id = document.getElementById("empid").value;  
    window.location.href = base_url+'table/employeeview_PDF?id='+id;
    return false; 
});

function uppercaseFirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}


   function employstatuseditingFun(id) {
    /*var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#iqama_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);*/
    $.ajax({
        type: "POST",
        url : base_url+'home/employee_statusModal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
               

                $("#eid").val(edit_data.id);
                $("#e_employee_status_name").val(edit_data.status_name);
                $("#e_status_description").val(edit_data.description);
                        
                
            });

            $("#edit_employeestatus_Modal").modal({backdrop: 'static'});
            $("#edit_employeestatus_Modal").modal('show');
       }
    });
}

$(document).on('click', '.kt_employeestatus', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
     swal.fire({
      title: "Are you sure?",
      text: "You will not be able to recover this status Entry!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel it!" }).then(result => {
      if (result.value) {

      $.ajax({
            type: "POST",
            url : base_url+'home/comm_dlt_delete_action',
            data: {id:id,url:'employee_status',mssg:'status',table:'qzolvehrm_employee_status'},
            success: function(data) {
                datatable_employee_status.ajax.reload();
                swal.fire("Deleted!", "Your Status Entry has been deleted.", "success");
           }
        });
        } else {
          swal.fire("Cancelled", "Your status Entry is safe :)", "error");
        }
      })
});

/***********************************************************
* Detail : Ajax of Benefit Dropdown for Benefit Activation *
* Date   : 19-05-2020                                      *
***********************************************************/
$('#benefitactivn_benefitctg').on('change', function () {
  $('#benefitactivn_benefit').find('option').not(':first').remove();

    var benefitctg_id = $("#benefitactivn_benefitctg").val();
    $.ajax({
        dataType: 'text',
        type    : 'post',
        data    : { benefitctg_id : benefitctg_id},
        url     : base_url+'home/getbenefit_forajax',
        cache   : false,
          success: function (data) {
            $.each(JSON.parse(data), function(key, value){
                $('#benefitactivn_benefit').append($('<option>').text(value.benefit_name).attr('value', value.id+'|'+value.benefit_type));
            });
          }
        });
});

/**************************************************
* Detail : Ajax of Benefit Dropdown for Dependant *    
                    Benefit Activation            *
* Date   : 21-05-2020                             *
**************************************************/
$('#dep_benefitactivn_benefitctg').on('change', function () {
  $('#dep_benefitactivn_benefit').find('option').not(':first').remove();

    var benefitctg_id = $("#dep_benefitactivn_benefitctg").val();
    $.ajax({
        dataType: 'text',
        type    : 'post',
        data    : { benefitctg_id : benefitctg_id},
        url     : base_url+'home/getbenefit_forajax',
        cache   : false,
          success: function (data) {
            $.each(JSON.parse(data), function(key, value){
                $('#dep_benefitactivn_benefit').append($('<option>').text(value.benefit_name).attr('value', value.id+'|'+value.benefit_type));
            });
          }
        });
});

/*******************************************
* Detail : Onchange Lastname in Employee Add
* Date   : 24-03-2021                      *
*******************************************/
$("input[name='Lastname']").on('change', function () {
    var fname   = $("input[name='Firstname']").val();
    var lname   = $("input[name='Lastname']").val();

    $("input[name='ledgername']").val(fname+ ' ' +lname);
});

/*******************************************
* Detail : Onchange Ledger in Employee Add *
* Date   : 24-03-2021                      *
*******************************************/


  function employee_relation_editingFun(id) {
    /*var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#iqama_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);*/
    $.ajax({
        type: "POST",
        url : base_url+'home/employee_relationModal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
               

                $("#id").val(edit_data.id);
                $("#relation_name").val(edit_data.relation_name);
                $("#relation_desc").val(edit_data.description);
                        
                
            });

            $("#employee_relationModal").modal({backdrop: 'static'});
            $("#employee_relationModal").modal('show');
       }
    });
}

$(document).on('click', '.kt_employee_relation', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
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
            url : base_url+'home/comm_dlt_delete_action',
            data: {id:id,url:'employee_relations',mssg:'employee_relations',table:'qzolvehrm_employee_relations'},
            success: function(data) {
                datatable_employee_relation.ajax.reload();
                swal.fire(del_lang7, del_lang8, "success");
           }
        });
        } else {
          swal.fire(del_lang5, del_lang6, "error");
        }
      })
});

  function terminate_reason_editingFun(id) {
    /*var firstname = uppercaseFirstLetter(fname);
    var lastname  = uppercaseFirstLetter(lname);
    $('#iqama_employdet').html(' - '+firstname+' '+lastname+ ' | '+employcode);*/
    $.ajax({
        type: "POST",
        url : base_url+'home/employee_terminationModal',
        data: {id:id},
        success: function(data){
            $("input[name ='id']").val('');
            var object = JSON.parse(data);

            $.each(object.view, function(key, edit_data) {
               

                $("#id").val(edit_data.id);
                $("#reason_name").val(edit_data.reason_name);
                $("#reason_desc").val(edit_data.description);
                        
                
            });

            $("#termination_reasonModal").modal({backdrop: 'static'});
            $("#termination_reasonModal").modal('show');
       }
    });
}

$(document).on('click', '.kt_terminate_reason', function () {
  var id = $(this).attr('id');
  var url = '';
  var mssg = '';
  var table = '';
     swal.fire({
      title: "Are you sure?",
      text: "You will not be able to recover this terminate reason Entry!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel it!" }).then(result => {
      if (result.value) {

      $.ajax({
            type: "POST",
            url : base_url+'home/comm_dlt_delete_action',
            data: {id:id,url:'termination_reason',mssg:'termination_reason',table:'qzolvehrm_terminate_reason'},
            success: function(data) {
            datatable_termination_reason.ajax.reload();
                swal.fire("Deleted!", "Your terminate reason Entry has been deleted.", "success");
           }
        });
        } else {
          swal.fire("Cancelled", "Your terminate reason Entry is safe :)", "error");
        }
      })
});

/******************************************
* Detail : Onchange Branch get Departments*
             For Employee Transfer (AJAX) *
* Date   : 12-04-2021                     *
******************************************/
$("#tr_branch").on('change', function () {
    $('#tr_dept').find('option').not(':first').remove();
    
    var branchid = $("select[name='tr_branch']").val();
    $.ajax({
        dataType: 'text',
        type: 'post',
        url: base_url+'home/getdepartmnt_ajax?id='+branchid,
        cache: false,
        success: function (data) {
            $.each(JSON.parse(data), function(key, value){   
                $('#tr_dept').append($('<option>').text(value.dept_name).attr('value', value.id));
            });
        }
    });
});

$('#employee_EventsModal').on('hide.bs.modal', function (e) {
    $("#emp_eventtitle").val("");
    $("#event_reminder").val("");
    $("#emp_eventdescription").val("");
    $(".error").text("");
});

$('#setting_sponsorModal').on('hide.bs.modal', function (e) {
    $("#sponsor_Id").val('')
    $('#sponsor_name').val('');
    $('#sponsor_phoneno').val('');
    $('#sponsorID').val('');
    $('#sponsor_address').val('');
    $('#sponsorname_error').text('');
    $('#sponsorphone_error').text('');
    $('#setting_sponsorsubmit_btn').html('Save');
});

$('#setting_visaprofessionModal').on('hide.bs.modal', function (e) {
    $("#visaprofessionId").val('');
    $('#visa_profession').val('');
    $('#visaprofession_code').val('');
    $("#visa_profession_error").text('');
    $("#visaprofession_code_error").text('');
    $('#setting_visaprofessionsubmit_btn').html('Save');
});

$('#setting_hospitalModal').on('hide.bs.modal', function (e) {
    $("#hospital_Id").val('');
    $('#hospital_name').val('');
    $('#hospital_phoneno').val('');
    $('#hospital_address').val('');
    $("#hospitalname_error").text('');
    $("#hospitalphone_error").text('');
    $("#setting_hospitalsubmit_btn").html('Save');
});

$('#setting_insurance_providerModal').on('hide.bs.modal', function (e) {
    $("#insurance_providersId").val('');
    $('#insurance_company_name').val('');
    $('#insurance_company_phno').val('');
    $('#insurance_company_documents').val('');
    $(".insurance_upld").html("Choose file");
    $('#insurance_company_adrs').val('');
    $('#insurance_company_contact_person').val('');
    $('#insurance_company_contact_person_phno').val('');
    $('#insurance_company_contact_person_email').val('');
    $("#insurance_company-error").text('');
    $('#insurance_provider_contact_details tbody > tr'). remove();
    $('#insurance_provider_submit').html('Submit');
});

$('#benefitcategoryModal').on('hide.bs.modal', function (e) {
    $("#benefit_categoryId").val('');
    $('#benefit_category').val('');
    $('#benefitcategory_desc').val('');
    $("#benefit_catg_error").text('');
    $("#benefitcategorysubmit_btn").html('Save');
});

$('#employeebenefit_Modal').on('hide.bs.modal', function (e) {
    $("#benefitId").val("");
    $("#emp_benefitcategory").val("").trigger('change');
    $("#emp_benefitname").val("");
    $("#emp_benefittype").val("").trigger('change');
    $('#emp_benefitcategory_error').text('');
    $('#emp_benefitname_error').text('');
    $('#emp_benefittype_error').text('');
    $("#employbenefitsubmit_btn").html('Save');
});

$('#setting_eventsModal').on('hide.bs.modal', function (e) {
    $('#event_Id').val('');
    $('#events_name').val('');
    $('#events_description').val('');
    $("#eventname_error").text('');
    $("#setting_eventsubmit_btn").html('Save');
});

function ctm_formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [month, day, year].join('/');
}

// Convert to dd-mm-yyyy format
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