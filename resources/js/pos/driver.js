var driverdetails_list_table = $('#driverdetails_list').DataTable({
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
									columns: [0, 1, 2, 3]
							}
					},
					{
							extend: 'csv',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3]
							}
					},
					{
							extend: 'excel',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3]
							}
					},
					{
							extend: 'pdf',
							className: "hidden",
							exportOptions: {
									columns: [0, 1, 2, 3]
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
					"url": 'driver',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'name', name: 'name' },
					{ data: 'phoneno', name: 'phoneno' },
					{ data: 'employeeid', name: 'employeeid' },
					{ data: 'country', name: 'country' },
					
					
					{
							data: 'action',
							name: 'action',
							render: function(data, type, row) {
									return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
											 </ul></div></div></span>';
							}
					},
			]
		});


$(document).on('click', '#driversubmit', function(e) {
				e.preventDefault();
				drivername = $('#drivername').val();
				phoneno = $('#phoneno').val();
				
				  if (drivername == "") 
				  {
           			 $('#drivername').addClass('is-invalid');
            			 return false;
        			  }
        			  else 
        			  {
             			$('#drivername').removeClass('is-invalid');
         			  }
         		  	  if (phoneno == "") 
         		  	  {
            			$('#phoneno').addClass('is-invalid');
            			return false;
        			  }
        			  else
        			  {
            	         $('#phoneno').removeClass('is-invalid');
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
						url: "submit-driver",
						dataType: "json",
						data: {
								_token: $('#token').val(),
								id: $('#id').val(),
								drivername: $('#drivername').val(),
								phoneno: $('#phoneno').val(),
								notes: $('#notes').val(),  
								country: $('#country').val(),  
								nationalid: $('#nationalid').val(),  
								employeeid: $('#employeeid').val(),  
								

						},
						success: function(data) {
							console.log(data)
							if(data == true)
							{
								$('#driversubmit').removeClass('kt-spinner');
								$('#driversubmit').prop("disabled", false);
								location.reload();
								toastr.success('Driver Details '+sucess_msg+' Successfuly');
							     window.location.href = "driver";
							}
							else
							{
								toastr.success('Driver already exist!');

							}
								
					
						},
						error: function(jqXhr, json, errorThrown) {
												console.log('Error !!');
						}
				});
		});
