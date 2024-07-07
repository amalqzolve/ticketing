var table;
$(document).ready(function() {
	table = $('#completed_onboardjoblist').DataTable({
		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],

		"ajax": {
			"url": base_url+'Completed_onboardjobs/completed_onboardjoblist',
			"type": "POST",
			"data": function (data) {

			}
		},
	});
});

/*************************************************
* Author : Siffy                                 *
* Detail : Loading JobId Dropdown into modal     *
* Date   : 07-04-2020                            *
*************************************************/
$(document).on('click', '#assign_documentnprocess', function () {
	var jobid 		  = '';
	var branch_id     = '';
	var department_id = '';
	var applicantid   = '';
	var categoryid 	  = '';

	if ($("#check_assign_documentnprocess").is(":checked")) {
		jobid 		  = $("#check_assign_documentnprocess").data('id');
		branch_id     = $("#check_assign_documentnprocess").data('branchid');
		department_id = $("#check_assign_documentnprocess").data('deptid');
		applicantid   = $("#check_assign_documentnprocess").data('applicantid');
		categoryid	  = $("#check_assign_documentnprocess").data('catgid');
	}

	if ($("#check_assign_documentnprocess").is(":not(:checked)")) {
		jobid 		  = '';
		branch_id     = '';
		department_id = '';
		applicantid   = '';
		categoryid	  = '';
	}
	
	$.ajax({
		type: "POST",
		url: base_url+'Completed_onboardjobs/get_jobid',
		data: {jobid:jobid},
		success: function (data) {
			var object = JSON.parse(data);

			$.each(object, function(key, job_id) {
        		if (typeof(job_id.id) != "undefined" && job_id.id !== null) {
        			$('#cmplt_onboardjob_job_id').append($('<option>').text('#'+job_id.id).attr('value', job_id.id).attr('selected', 'selected'));
        		}
        	});
		}
	});

	$('#cmplt_onboardjob_branchid').val(branch_id);
    $('#cmplt_onboardjob_deptid').val(department_id);
    $('#cmplt_onboardjob_catgid').val(categoryid);

    $.ajax({
		type: "POST",
		url: base_url+'Completed_onboardjobs/get_applicantid',
		data: {applicantid:applicantid},
		success: function (data) {
			var object = JSON.parse(data);

			$.each(object, function(key, applicant_id) {
        		if (typeof(applicant_id.id) != "undefined" && applicant_id.id !== null) {
        			$('#cmplt_onboardjob_applicantid').append($('<option>').text(applicant_id.applicant_name).attr('value', applicant_id.id).attr('selected', 'selected'));
        		}
        	});
		}
	});

    $('#assign_documentn_process').modal('show');
	table.ajax.reload();
});

/************************************************
* Author : Siffy                                *
* Detail : Assign Onboard Process Submit        *
* Date   : 08-04-2020                           *
************************************************/
$("#assign_documentnprocess_submit").click(function (e) {
	e.preventDefault();
	var job_id 		     	  = $("#cmplt_onboardjob_job_id").val();
	var branchid         	  = $("#cmplt_onboardjob_branchid").val();
	var departmentid     	  = $("#cmplt_onboardjob_deptid").val();
	var categoryid			  = $('#cmplt_onboardjob_catgid').val();
	var documentn_method	  = $("#cmplt_onboardjob_documentn_method").val();
	var applicantid       	  = $("#cmplt_onboardjob_applicantid").val();
	var note                  = $("#cmplt_onboardjob_note").val();

	if (job_id == "") {
		$("#cmplt_onboardjob_job_id").addClass('is-invalid');
		return false;
	}
	else {
		$("#cmplt_onboardjob_job_id").removeClass('is-invalid');
	}

	if (documentn_method == "") {
		$("#cmplt_onboardjob_documentn_method").addClass('is-invalid');
		return false;
	}
	else {
		$("#cmplt_onboardjob_documentn_method").removeClass('is-invalid');
	}
	if (applicantid == "") {
		$("#cmplt_onboardjob_applicantid").addClass('is-invalid');
		return false;
	}
	else {
		$("#cmplt_onboardjob_applicantid").removeClass('is-invalid');
	}

	$.ajax({
		type: 'POST',
		url : base_url+'common/db_add_update',
		data: { What : 'assign_documentnprocess_save', 
				job_id : job_id, 
				branchid : branchid,
				departmentid : departmentid, 
				categoryid : categoryid, 
				documentn_method : documentn_method, 
				applicantid : applicantid, 
				note : note
			  },
		success : function (data) {
			$("#assign_documentn_process").modal('hide');
			table.ajax.reload();
			$('#assign_documentnprocessForm')[0].reset();
		}
	});
});
