$(document).ready(function() {
/**
	*Datatable for entries Listing
	*/
	var entrydetails_table = $('#entrydetails_list').DataTable({
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
					"url": 'operational_entries',
					"type": "POST",
					"data": function(data) {
							data._token = $('#token').val()
					}
			},
			columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'date', name: 'date' },
					{ data: 'number', name: 'number' },
					{ data: 'category', name: 'number' },
					{ data: 'entrytype_id1', name: 'entrytype_id1' },
					{ data: 'account_names', name: 'account_names' },



					{ data: 'dr_total', name: 'dr_total', 
				 },
					{ data: 'cr_total', name: 'cr_total' },
					{ data: 'notes', name: 'notes' },
					{
              data: 'pstatus',
              name: 'pstatus',
              render: function(data, type, row) {
                 if (row.pstatus == 0) 
                {
                     return '<span style="color: red">UnPosted</span>';
                }
                if (row.pstatus == 1) 
                {
                     return '<span style="color: green">Posted</span>';
                }
                
                
                 
              }
          },
				  {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
              
              	if(row.category=='Direct Invoice'){
					 j+='<a href="cinvoice_pdf?id=' + row.category_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.category_id + '" >PDF Letterhead</span>\
                        </span></li></a>\
                        <a href="cinvoice_pdf_print?id=' + row.category_id +'" target="_blank" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.category_id + '" >PDF</span>\
                        </span></li></a>';

                        
				}

				if(row.category=='Debit Note'){
				

                              j+='<a href="debitnote_pdf?id=' + row.category_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.category_id + '" >PDF</span>\
                        </span></li></a><a href="debitnote_pdfletter?id=' + row.category_id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.category_id + '" >PDF Letterhead</span>\
                        </span></li></a>';
					
				}

				if(row.category=='Credit Note'){
			

                        j+='<a href="creditnotepdf?id=' + row.category_id +'" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.category_id + '" >PDF</span>\
                        </span></li></a><a href="creditnotepdfletter?id=' + row.category_id +'" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.category_id + '" >PDF Letterhead</span>\
                        </span></li></a>';

					
				}




                if (row.pstatus !=1) {
                          j+='<a href="post_entry?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Post</span>\
                        </span></li></a>';



				if(row.category=='Direct Invoice'){
					 j+='<a href="cinvoice_edit?id=' + row.category_id + '&&cid=' + row.c_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>';


				}

				if(row.category=='Debit Note'){
					/* j+='<a href="----?id=' + row.category_id + '&&cid=' + row.c_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>';*/

                             
					
				}

				if(row.category=='Credit Note'){
					/* j+='<a href="---?id=' + row.category_id + '&&cid=' + row.c_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>';*/

                 

					
				}




                    }
            
                   

                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                       </ul></div></div></span>';
              }
          },
			]
		})
});