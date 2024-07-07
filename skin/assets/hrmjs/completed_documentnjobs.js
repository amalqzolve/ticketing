var table;
$(document).ready(function() {
	table = $('#completed_documentnjoblist').DataTable({
		"pagingType": 'full_numbers',
		"iDisplayLength": 10,
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"order": [],

		"ajax": {
			"url": base_url+'Completed_documentionjobs/completed_documentnjoblist',
			"type": "POST",
			"data": function (data) {

			}
		},
	});
});