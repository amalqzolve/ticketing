var table;
$(document).ready(function() {
	table = $('#completed_recruitjobs').DataTable({
		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],

		"ajax": {
			"url": base_url+'Completed_recruitmentjobs/completed_recruitjoblist',
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
$(document).on('click', '#assign_onboardprocess', function () {
	var jobid 		  = '';
	var branch_id     = '';
	var department_id = '';
	var category_id   = '';
	if ($("#check_assign_onboardprocess").is(":checked")) {
		jobid 		  = $("#check_assign_onboardprocess").data('id');
		branch_id     = $("#check_assign_onboardprocess").data('branchid');
		department_id = $("#check_assign_onboardprocess").data('deptid');
		category_id   = $("#check_assign_onboardprocess").data('catgid');
	}

	if ($("#check_assign_onboardprocess").is(":not(:checked)")) {
		jobid 		  = '';
		branch_id     = '';
		department_id = '';
		category_id   = '';
	}
	
	$.ajax({
		type: "POST",
		url: base_url+'Completed_recruitmentjobs/get_jobid',
		data: {jobid:jobid},
		success: function (data) {
			var object = JSON.parse(data);

			$.each(object, function(key, job_id) {
        		if (typeof(job_id.id) != "undefined" && job_id.id !== null) {
        			$('#cmplt_recruitjob_job_id').append($('<option>').text('#'+job_id.id).attr('value', job_id.id).attr('selected', 'selected'));
        		}
        	});
        	$('#cmplt_recruitjob_branchid').val(branch_id);
        	$('#cmplt_recruitjob_deptid').val(department_id);
        	$('#cmplt_recruitjob_catgid').val(category_id);

        	$('#assign_onboard_process').modal('show');
        	table.ajax.reload();
		}
	});
});

/************************************************
* Author : Siffy                                *
* Detail : Assign Onboard Process Submit        *
* Date   : 08-04-2020                           *
************************************************/
$("#assign_onboardprocess_submit").click(function (e) {
	e.preventDefault();
	var job_id 		     	  = $("#cmplt_recruitjob_job_id").val();
	var branchid         	  = $("#cmplt_recruitjob_branchid").val();
	var departmentid     	  = $("#cmplt_recruitjob_deptid").val();
	var categoryid            = $('#cmplt_recruitjob_catgid').val();
	var applicant_name   	  = $("#applicant_name").val();
	var applicant_email  	  = $("#applicant_email").val();
	var applicant_idtype 	  = $("#applicant_idtype").val();
	var applicant_idno   	  = $("#applicant_idnumber").val();
	var phone_no         	  = $("#cmplt_recruitjob_phoneno").val();
	var onboard_processmethod = $("#onboard_processmethod").val();
	var note                  = $("#cmplt_recruitjob_note").val();

	if (job_id == "") {
		$("#cmplt_recruitjob_job_id").addClass('is-invalid');
		return false;
	}
	else {
		$("#cmplt_recruitjob_job_id").removeClass('is-invalid');
	}

	if (applicant_name == "") {
		$("#applicant_name").addClass('is-invalid');
		return false;
	}
	else {
		$("#applicant_name").removeClass('is-invalid');
	}
	if (applicant_email == "") {
		$("#applicant_email").addClass('is-invalid');
		return false;
	}
	else {
		$("#applicant_email").removeClass('is-invalid');
	}
	if (applicant_idtype == "") {
		$("#applicant_idtype").addClass('is-invalid');
		return false;
	}
	else {
		$("#applicant_idtype").removeClass('is-invalid');
	}
	if (applicant_idno == "") {
		$("#applicant_idnumber").addClass('is-invalid');
		return false;
	}
	else {
		$("#applicant_idnumber").removeClass('is-invalid');
	}
	if (phone_no == "") {
		$("#cmplt_recruitjob_phoneno").addClass('is-invalid');
		return false;
	}
	else {
		$("#cmplt_recruitjob_phoneno").removeClass('is-invalid');
	}
	if (onboard_processmethod == "") {
		$("#onboard_processmethod").addClass('is-invalid');
		return false;
	}
	else {
		$("#onboard_processmethod").removeClass('is-invalid');
	}

	$.ajax({
		type: 'POST',
		url : base_url+'common/db_add_update',
		data: { What : 'assign_onboardprocess_save', 
				job_id : job_id, 
				branchid : branchid,
				departmentid : departmentid,
				categoryid : categoryid, 
				applicant_name : applicant_name, 
				applicant_email : applicant_email, 
				applicant_idtype : applicant_idtype, 
				applicant_idno : applicant_idno, 
				phone_no : phone_no,
				onboard_processmethod : onboard_processmethod, 
				note : note
			  },
		success : function (data) {
			$("#assign_onboard_process").modal('hide');
			table.ajax.reload();
			$('#assign_onboard_processForm')[0].reset();
		}
	});
});