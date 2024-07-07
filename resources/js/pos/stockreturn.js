	var stockreturndetails_list_table = $('#stockreturndetails_list').DataTable({
			processing: true,
			serverSide: true,
			pagingType: "full_numbers",
			dom: 'Blfrtip',
			lengthMenu: [
					[10, 25, 50, -1],
					[10, 25, 50, "All"]
			],
			buttons: [{
							extend: 'copy',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3,4]
							}
					},
					{
							extend: 'csv',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3,4]
							}
					},
					{
							extend: 'excel',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3,4]
							}
					},
					{
							extend: 'pdf',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3,4]
							},
							pageSize: 'A4',
							orientation: 'landscape',
							customize: function(doc) {
									doc.pageMargins = [50, 50, 50, 50];
									doc.content[1].table.widths = [ '10%', '20%', '10%', '20%', '40%'];
							}
					},
					{
							extend: 'print',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3,4]
							}
					}
			],

			ajax: {
					"url": 'stockreturn',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'date', name: 'date' },
					{ data: 'vanname', name: 'vanname' },
					{ data: 'name', name: 'name' },
					
					{
							data: 'action',
							name: 'action',
							render: function(data, type, row) {
									return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="stockreturn_pdf?id=' + row.id + '" data-type="edit" target="_blank"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-contract"></i>\
												<span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
												</span></li></a>\
											 </ul></div></div></span>';
							}
					},
			]
		});

	 $('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

        $(document).on('click', '#stockreturnsubmit', function(e) {
				e.preventDefault();
				van = $('#van').val();
				date = $('#date').val();
				notes = $('#notes').val();
				receiver = $('#receiver').val();
				totalitems = $('#totalitems').val();
				
				
				var item_details_id = [];

		        $("input[name^='item_details_id[]']")
		        .each(function(input) {
		            item_details_id.push($(this).val());
		        });
		        var trquantity = [];

		        $("input[name^='trquantity[]']")
		        .each(function(input) {
		            trquantity.push($(this).val());
		        });
		        var soquantity = [];

		        $("input[name^='soquantity[]']")
		        .each(function(input) {
		            soquantity.push($(this).val());
		        });
		        var remquantity = [];

		        $("input[name^='remquantity[]']")
		        .each(function(input) {
		            remquantity.push($(this).val());
		        });

		        var retquantity = [];

		        $("input[name^='retquantity[]']")
		        .each(function(input) {
		            retquantity.push($(this).val());
		        });
		        


				if (van == "") {
				    $('#van').next().find('.select2-selection').addClass('select-dropdown-error');
				    return false;
				} else {
				    $('#van').next().find('.select2-selection').removeClass('select-dropdown-error');
				}
				if (date == "") 
				  {
           			$('#date').addClass('is-invalid');
            			 return false;
        			  }
        			  else 
        			  {
             			$('#date').removeClass('is-invalid');
         			  }
         			  if (receiver == "") {
				    $('#receiver').next().find('.select2-selection').addClass('select-dropdown-error');
				    return false;
				} else {
				    $('#receiver').next().find('.select2-selection').removeClass('select-dropdown-error');
				}
				if (totalitems == 0) 
				  {
						toastr.warning('Please add any Product');
            			return false;
        		  }


				$(this).addClass('kt-spinner');
				$(this).prop("disabled", true);
				if($('#id').val()){
				var sucess_msg ='Updated';
				} else{
				var sucess_msg ='Created';
				}

				$.ajax({
						type: "POST",
						url: "submit-stockreturn",
						dataType: "json",
						data: {
								_token: $('#token').val(),
								id: $('#id').val(),
								van: $('#van').val(),
								date: $('#date').val(),
								notes: $('#notes').val(), 
								receiver: $('#receiver').val(),
								totalquantity: $('#totalquantity').val(), 
								totalitems: $('#totalitems').val(),  
								item_details_id : item_details_id,
								trquantity : trquantity,
							
								retquantity : retquantity,
								

						},
						success: function(data) {
							console.log(data);
								$('#stockreturnsubmit').removeClass('kt-spinner');
								$('#stockreturnsubmit').prop("disabled", false);
								// location.reload();
								toastr.success('Stock Return '+sucess_msg+' Successfuly');
							     window.location.href = "stockreturn";
					
						},
						error: function(jqXhr, json, errorThrown) {
												console.log('Error !!');
						}
				});
		});