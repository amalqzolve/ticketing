
	var vandetails_list_table = $('#vandetails_list').DataTable({
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
					"url": 'van',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'vanname', name: 'vanname' },
					{ data: 'licenseno', name: 'licenseno' },
					{ data: 'routename', name: 'routename' },
					{ data: 'name', name: 'name' },
					{ data: 'driver', name: 'driver' },
					
					{
							data: 'action',
							name: 'action',
							render: function(data, type, row) {
									return '<span style="overflow: visible; position: relative; width: 80px;">\
						<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
												<i class="fa fa-cog"></i></a>\
												<div class="dropdown-menu dropdown-menu-right">\
												<ul class="kt-nav">\
												<a href="vanpdf?id=' + row.id + '" data-type="edit" target="_blank"><li class="kt-nav__item">\
												<span class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-contract"></i>\
												<span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
												</span></li></a>\
											 </ul></div></div></span>';
							}
					},
			]
		});



$(document).on('click', '#vansubmit', function(e) {
				e.preventDefault();
				route = $('#route').val();
				salesman = $('#salesman').val();
				driver = $('#driver').val();
				vanname = $('#vanname').val();
				licenseno = $('#licenseno').val();
				totalrows = $('#totalrows').val();
				username = $('#username').val();
				
				var customername = [];

		        $("select[name^='customername[]']")
		        .each(function(input) {
		            customername.push($(this).val());
		        });
		        var streetname = [];

		        $("input[name^='streetname[]']")
		        .each(function(input) {
		            streetname.push($(this).val());
		        });
		        var district = [];

		        $("input[name^='district[]']")
		        .each(function(input) {
		            district.push($(this).val());
		        });
		         var crno = [];

		        $("input[name^='crno[]']")
		        .each(function(input) {
		            crno.push($(this).val());
		        });
		        var vatno = [];

		        $("input[name^='vatno[]']")
		        .each(function(input) {
		            vatno.push($(this).val());
		        });
		        var phone = [];

		        $("input[name^='phone[]']")
		        .each(function(input) {
		            phone.push($(this).val());
		        });

		        if (vanname == "") 
				  {
           			$('#vanname').addClass('is-invalid');
            			 return false;
        			  }
        			  else 
        			  {
             			$('#vanname').removeClass('is-invalid');
         			  }
         			  if (licenseno == "") 
				  {
           			$('#licenseno').addClass('is-invalid');
            			 return false;
        			  }
        			  else 
        			  {
             			$('#licenseno').removeClass('is-invalid');
         			  }
				if (route == "") {
				    $('#route').next().find('.select2-selection').addClass('select-dropdown-error');
				    return false;
				} else {
				    $('#route').next().find('.select2-selection').removeClass('select-dropdown-error');
				}
				if (salesman == "") {
				    $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
				    return false;
				} else {
				    $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
				}

				if (driver == "") {
				    $('#driver').next().find('.select2-selection').addClass('select-dropdown-error');
				    return false;
				} else {
				    $('#driver').next().find('.select2-selection').removeClass('select-dropdown-error');
				}
				if (username == "") 
				  {
           			$('#username').addClass('is-invalid');
            			 return false;
        			  }
        			  else 
        			  {
             			$('#username').removeClass('is-invalid');
         			  }
				if (totalrows == 0) 
				  {
						toastr.warning('Please add any Customer');
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
						url: "submit-van",
						dataType: "json",
						data: {
								_token: $('#token').val(),
								id: $('#id').val(),
								route: $('#route').val(),
								salesman: $('#salesman').val(),
								driver: $('#driver').val(),  
								vanname : $('#vanname').val(),
								licenseno : $('#licenseno').val(),
								notes : $('#notes').val(),
								username : $('#username').val(),
								password : $('#password').val(),
								customername : customername,
								streetname : streetname,
								district : district,
								crno : crno,
								vatno : vatno,
								phone : phone,


						},
						success: function(data) {
							if(data == true)
							{
								$('#vansubmit').removeClass('kt-spinner');
								$('#vansubmit').prop("disabled", false);
								location.reload();
								toastr.success('Van Details '+sucess_msg+' Successfuly');
							     window.location.href = "van";
							}
							else
							{
								toastr.success('Van already exist!');

							}
								
					
						},
						error: function(jqXhr, json, errorThrown) {
												console.log('Error !!');
						}
				});
		});