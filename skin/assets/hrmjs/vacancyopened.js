var table;
$(document).ready(function() {
	table = $('#vacancy_openedlist').DataTable({
		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"scrollX": true,
		"order": [],

		"ajax": {
			"url": base_url+'Vacancies/vacancyopened_list',
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
$(document).on('click', '#assign_recruitmethod', function () {
	var jobid 		  = '';
	var branch_id     = '';
	var department_id = '';
	var category_id   = '';

	if ($("#check_assign_recruitmethod").is(":checked")) {
		jobid 		  = $("#check_assign_recruitmethod").data('id');
		branch_id     = $("#check_assign_recruitmethod").data('branchid');
		department_id = $("#check_assign_recruitmethod").data('deptid');
		category_id   = $("#check_assign_recruitmethod").data('catgid');
	}

	if ($("#check_assign_recruitmethod").is(":not(:checked)")) {
		jobid 		  = '';
		branch_id     = '';
		department_id = '';
		category_id   = '';
	}

	$.ajax({
		type: "POST",
		url: base_url+'Vacancies/get_jobid',
		data: {jobid:jobid},
		success: function (data) {
			var object = JSON.parse(data);
			
			$.each(object, function(key, job_id) {
        		if (typeof(job_id.id) != "undefined" && job_id.id !== null) {
        			$('#vacancyjob_id').append($('<option>').text('#'+job_id.id).attr('value', job_id.id).attr('selected', 'selected'));
        		}
        	});
        	$('#vacancy_branchid').val(branch_id);
        	$('#vacancy_deptid').val(department_id);
        	$('#vacancy_catgid').val(category_id);
        	$('#assign_recruit_method').modal('show');
		}
	});
});

/************************************************
* Author : Siffy                                *
* Detail : Assign Recruitment Method Submit     *
* Date   : 07-04-2020                           *
************************************************/
$("#assign_recruitmethod_submit").click(function (e) {
	e.preventDefault();
	var job_id 		   = $("#vacancyjob_id").val();
	var branchid       = $("#vacancy_branchid").val();
	var departmentid   = $("#vacancy_deptid").val();
	var categoryid     = $("#vacancy_catgid").val();
	var recruit_method = $("#vacancy_recruitmethod").val();
	var note 		   = $("#vacancy_note").val();

	if (job_id == "") {
		$("#vacancyjob_id").addClass('is-invalid');
		return false;
	}
	else {
		$("#vacancyjob_id").removeClass('is-invalid');
	}

	if (recruit_method == "") {
		$("#vacancy_recruitmethod").addClass('is-invalid');
		return false;
	}
	else {
		$("#vacancy_recruitmethod").removeClass('is-invalid');
	}

	$.ajax({
		type: 'POST',
		url : base_url+'common/db_add_update',
		data: { What : 'assign_recruitmethod_save', 
				job_id : job_id, 
				branchid : branchid,
				departmentid : departmentid,
				categoryid : categoryid, 
				recruit_method : recruit_method, 
				note : note
			  },
		success : function (data) {
			$("#assign_recruit_method").modal('hide');
			table.ajax.reload();
			$('#assign_recruit_methodForm')[0].reset();
		}
	});
});
