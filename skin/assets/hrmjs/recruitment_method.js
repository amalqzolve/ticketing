var table;
$(document).ready(function() {
	table = $('#recruitmethod_table').DataTable({
		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],

		"ajax": {
			"url": base_url+'basic_settings/recruitment_methodlist',
			"type": "POST",
			"data": function (data) {

			}
		},
	});
});

/************************************************
* Author : Siffy                                *
* Detail : Recruitment Method Add Submit        *
* Date   : 06-04-2020                           *
************************************************/
$("#recruitment_method_save").click(function (e) {
	e.preventDefault();
	var method_name = $("#recruitmethod_name").val();
	var description = $("#recruitmethod_description").val();

	if (method_name == "") {
		$("#recruitmethod_name").addClass('is-invalid');
		return false;
	}
	else {
		$("#recruitmethod_name").removeClass('is-invalid');
	}

	$.ajax({
		type: 'POST',
		url : base_url+'common/db_add_update',
		data: {What:'recruitment_method_save', method_name:method_name, description:description},
		success : function (data) {
			$("#addrecruitmentmethod").modal('hide');
			table.ajax.reload();
			$('#form_recruitmentmethod_save')[0].reset();
		}
	});
});

/***************************************************
* Author : Siffy                                   *
* Detail : Load data for Recruitment Method Update *
* Date   : 06-04-2020                              *
***************************************************/
$(document).on('click', '.kt_recruitmethodedit', function () {
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/ajax_edit_data',
        data: {table:'qrecruitment_recruit_method',id:id},
        success: function(data){

            var object = JSON.parse(data);

            $.each(object, function(key, value)
            {
                $('#e_recruitmethod_id').val(value.id);
                $('#e_recruitmethod_name').val(value.method_name);
                $('#e_recruitmethod_description').val(value.description);
            });
            $('#editRecruitmethod').modal('show');
       },
       
  });
     
});

/************************************************
* Author : Siffy                                *
* Detail : Recruitment Method Update Submit     *
* Date   : 06-04-2020                           *
************************************************/
$("#recruitmethod_update").click(function (e) {
	e.preventDefault();
	var method_id   = $("#e_recruitmethod_id").val();
	var method_name = $("#e_recruitmethod_name").val();
	var description = $("#e_recruitmethod_description").val();

	if (method_name == "") {
		$("#e_recruitmethod_name").addClass('is-invalid');
		return false;
	}
	else {
		$("#e_recruitmethod_name").removeClass('is-invalid');
	}

	$.ajax({
		type: 'POST',
		url : base_url+'common/db_add_update',
		data: {What:'recruitmethod_update', id:method_id, method_name:method_name, description:description},
		success : function (data) {
			$("#editRecruitmethod").modal('hide');
			table.ajax.reload();
			$('#form_recruitmethod_update')[0].reset();
		}
	});

});

/************************************************
* Author : Siffy                                *
* Detail : Recruitment Method Delete            *
* Date   : 06-04-2020                           *
************************************************/
$(document).on('click', '.kt_recruitmethoddelete', function () {
    var id = $(this).attr('id');
   
    Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Recruitment Method Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
	        if (result.value) {
		        $.ajax({
		              type: "POST",
		              url : base_url+'common/db_add_update',
		              data: {What:'recruitmethod_delete', id:id},
		              success: function(data) {
		                  table.ajax.reload();
		                  swal.fire("Deleted!", "Your Recruitment Method Entry has been deleted.", "success");
		             }
		        });
	        } else {
	            swal.fire("Cancelled", "Your Recruitment Method Entry is safe :)", "error");
	        }
        });
});