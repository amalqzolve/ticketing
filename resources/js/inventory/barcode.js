/*$(document).on('click', '#barcodesubmit', function(e) {
				e.preventDefault();
				
				$(this).addClass('kt-spinner');
				$(this).prop("disabled", true);
				if($('#id').val()){
				var sucess_msg ='Updated';
				} else{
				var sucess_msg ='Created';
				}

				$.ajax({
						type: "POST",
						url: "submit-barcode",
						dataType: "json",
						data: {
								_token: $('#token').val(),
								id: $('#id').val(),
								productname: $('#productname').val(),
								barcode_format: $('#barcode_format').val(),
								
						},
						success: function(data) {
					
								$('#barcodesubmit').removeClass('kt-spinner');
								$('#barcodesubmit').prop("disabled", false);
								branddetails_table.ajax.reload();
								toastr.success('Products Brand Details '+sucess_msg+' Successfuly');
								window.location.href = "BrandList";
					
						},
						error: function(jqXhr, json, errorThrown) {
												console.log('Error !!');
						}
				});
		});*/