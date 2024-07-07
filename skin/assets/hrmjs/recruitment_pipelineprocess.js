var table;
$(document).ready(function() {
	table = $('#recruitment_pipelineprocesslist').DataTable({
		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],

		"ajax": {
			"url": base_url+'Recruitment_pipelineprocess/recruitment_pipelineprocesslist',
			"type": "POST",
			"data": function (data) {

			}
		},
	});
});