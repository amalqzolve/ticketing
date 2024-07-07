var table;
$(document).ready(function() {
	table = $('#documentn_pipelineprocesslist').DataTable({
		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],

		"ajax": {
			"url": base_url+'Documentation_pipelineprocess/documentn_pipelineprocesslist',
			"type": "POST",
			"data": function (data) {

			}
		},
	});
});