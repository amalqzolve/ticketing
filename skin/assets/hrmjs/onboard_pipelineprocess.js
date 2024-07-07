var table;
$(document).ready(function() {
	table = $('#onboard_pipelineprocesslist').DataTable({
		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],

		"ajax": {
			"url": base_url+'Onboard_pipelineprocess/onboard_pipelineprocesslist',
			"type": "POST",
			"data": function (data) {

			}
		},
	});
});