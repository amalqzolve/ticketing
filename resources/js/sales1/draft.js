var quotationdetails_list_table = $('#quotationdetails_list').DataTable({
      processing: true,
      serverSide: true,
      scrollX: true,
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
                  columns: [0, 1, 2, 3,4,5,6,7,8]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%',
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8]
              }
          }
      ],

      ajax: {
          "url": 'newQuotation',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;';
                }
              }
          },
          { data: 'quotedate', name: 'quotedate' },

          { data: 'validity', name: 'validity' },

          { data: 'cust_name', name: 'cust_name', },
         /* { data: 'reference', name: 'reference' },*/

          { data: 'name', name: 'name' },
           { data: 'grandtotalamount', name: 'grandtotalamount' },
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {

                if (row.status == 'Draft')
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 'Send')
                {
                  return '<span style="color: pink">Send</span>';
                }
                 if (row.status == 'Negotiated')
                {
                  return '<span style="color: blue">Negotiated</span>';

                }
                 if (row.status == 'Revised')
                {
                  return '<span style="color: yellow">Revised</span>';

                }
                if (row.status == 'Approved')
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 'Rejected')
                {
                  return '<span style="color: red">Rejected</span>';

                }


              }
          },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                if (row.status === 'Draft') {
                     j='<a href="quotation_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a  data-type="send" data-target="#kt_form"><li class="kt-nav__item quotation_send" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                        </span></li></a><a href="quotation_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a> <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';
                    }

                  if (row.status === 'Send') {
                     j='<a  data-type="negotiation" data-target="#kt_form"><li class="kt-nav__item quotation_negotiation" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Negotiate</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item quotation_approve" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Approve</span>\
                        </span></li></a>\
                        <a  data-type="rejected" data-target="#kt_form"><li class="kt-nav__item quotation_rejected" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-cross"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '"  id=' + row.id + '>Reject</span>\
                        </span></li></a><a href="quotation_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a> <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';
                    }

                 if (row.status === 'Negotiated') {
                     j='<a  data-type="revised" data-target="#kt_form"><li class="kt-nav__item quotation_revised" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Revise</span>\
                        </span></li></a><a href="quotation_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a> <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';
                    }

                 if (row.status === 'Revised') {
                     j='<a  data-type="send" data-target="#kt_form"><li class="kt-nav__item quotation_send" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                        </span></li></a><a href="quotation_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a> <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';
                    }

                    if (row.status === 'Approved') {
                     j='<a href="quotation_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a> <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';
                    }

                     if (row.status === 'Rejected') {
                     j='<a href="quotation_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a> <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';
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
  });






var draftdetails_list_table = $('#draftdetails_list').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%',
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'Draft_quotationss',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.Status = 'Draft'
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;';
                }
              }
          },
          { data: 'quotedate', name: 'quotedate' },

          { data: 'validity', name: 'validity' },

          { data: 'cust_name', name: 'cust_name', },
          /*{ data: 'reference', name: 'reference' },*/

          { data: 'name', name: 'name' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },
          { data: 'status', name: 'status',
              render: function(data, type, row) {
                var j='';

                if (row.status == 'Draft')
                {
                  return '<span style="color: black">Draft</span>';

                }

              }
          },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                if (row.status === 'Draft') {
                     j='<a href="quotation_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a data-type="send" data-target="#kt_form"><li class="kt-nav__item quotation_send" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Send</span>\
                        </span></li></a><a href="quotation_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a> <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';
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
  });


var senddetails_list_table = $('#senddetails_list').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%',
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'Draft_quotationss',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.Status = 'Send'
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;';
                }
              }
          },
          { data: 'quotedate', name: 'quotedate' },

          { data: 'validity', name: 'validity' },

          { data: 'cust_name', name: 'cust_name', },
/*          { data: 'reference', name: 'reference' },*/

          { data: 'name', name: 'name' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },
         { data: 'status', name: 'status',
              render: function(data, type, row) {
                var j='';

                if (row.status == 'Send')
                {
                  return '<span style="color: pink">Send</span>';

                }

              }
          },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';


                  if (row.status === 'Send') {
                     j='<a data-type="negotiation" data-target="#kt_form"><li class="kt-nav__item quotation_negotiation" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Negotiate</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item quotation_approve" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Approve</span>\
                        </span></li></a>\
                        <a data-type="rejected" data-target="#kt_form"><li class="kt-nav__item quotation_rejected" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-cross"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Reject</span>\
                        </span></li></a><a href="quotation_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a> <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';
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
  });

var negotiateddetails_list_table = $('#negotiateddetails_list').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%',
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'Draft_quotationss',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.Status = 'Negotiated'
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;';
                }
              }
          },
          { data: 'quotedate', name: 'quotedate' },

          { data: 'validity', name: 'validity' },

          { data: 'cust_name', name: 'cust_name', },
          /*{ data: 'reference', name: 'reference' },*/

          { data: 'name', name: 'name' },
           { data: 'grandtotalamount', name: 'grandtotalamount' },
          { data: 'status', name: 'status',
              render: function(data, type, row) {
                var j='';

                if (row.status == 'Negotiated')
                {
                  return '<span style="color: blue">Negotiated</span>';

                }

              }
          },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';

                 if (row.status === 'Negotiated') {
                     j='<a data-type="revised" data-target="#kt_form"><li class="kt-nav__item quotation_revised" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Revise</span>\
                        </span></li></a><a href="quotation_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a> <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';
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
  });

var approveddetails_list_table = $('#approveddetails_list').DataTable({
      processing: true,
      serverSide: true,
      pagingType: "full_numbers",
      scrollX: true,
      dom: 'Blfrtip',
      lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
      ],
      buttons: [{
              extend: 'copy',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%',
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'Draft_quotationss',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.Status = 'Approved'
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;';
                }
              }
          },
          { data: 'quotedate', name: 'quotedate' },

          { data: 'validity', name: 'validity' },

          { data: 'cust_name', name: 'cust_name', },
          /*{ data: 'reference', name: 'reference' },*/

          { data: 'name', name: 'name' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },
          { data: 'status', name: 'status',
              render: function(data, type, row) {
                var j='';

                if (row.status == 'Approved')
                {
                  return '<span style="color: green">Approved</span>';

                }

              }
          },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';


                    if (row.status === 'Approved') {
                     j='<a href="quotation_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a> <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';
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
  });

var rejecteddetails_list_table = $('#rejecteddetails_list').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%',
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'Draft_quotationss',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.Status = 'Rejected'
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;';
                }
              }
          },
          { data: 'quotedate', name: 'quotedate' },

          { data: 'validity', name: 'validity' },

          { data: 'cust_name', name: 'cust_name', },
        /*  { data: 'reference', name: 'reference' },*/

          { data: 'name', name: 'name' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },
          { data: 'status', name: 'status',
              render: function(data, type, row) {
                var j='';

                if (row.status == 'Rejected')
                {
                  return '<span style="color: red">Rejected</span>';

                }

              }
          },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j=' <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';

                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                       </ul></div></div></span>';
              }
          },

      ]
  });

var reviseddetails_list_table = $('#reviseddetails_list').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%',
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'Draft_quotationss',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.Status = 'Revised'
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;';
                }
              }
          },
          { data: 'quotedate', name: 'quotedate' },

          { data: 'validity', name: 'validity' },

          { data: 'cust_name', name: 'cust_name', },
          /*{ data: 'reference', name: 'reference' },*/

          { data: 'name', name: 'name' },
            { data: 'grandtotalamount', name: 'grandtotalamount' },
          { data: 'status', name: 'status',
              render: function(data, type, row) {
                var j='';

                if (row.status == 'Revised')
                {
                  return '<span style="color: yellow">Revised</span>';

                }

              }
          },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';




                 if (row.status === 'Revised') {
                     j='<a data-type="send" data-target="#kt_form"><li class="kt-nav__item quotation_send" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Send</span>\
                        </span></li></a><a href="quotation_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a> <a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item quotation_enquiry" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Enquiry</span>\
                        </span></li></a>';
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
  });


$(document).on('click', '.quotation_send', function() {
        var id = $(this).attr('id');

        swal.fire({
            title: "Are you sure?",
            text: "Do you want Send this Quotation",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
          /* cancelButtonText: "No"
        }).then(result => {*/
            cancelButtonText: "No, cancel it!" }).then(result => {
                if (result.value){
                 window.location = "quotation_send?id="+id;
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });

$(document).on('click', '.quotation_negotiation', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Negotiate this Quotation",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {

               window.location = "quotation_negotiation?id="+id;
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });



$(document).on('click', '.quotation_enquiry', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Convert this Quotation",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {
            window.location = "quotation_enquiry?id="+id;

             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });


$(document).on('click', '.quotation_approve', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Approved this Quotation",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {
            window.location = "quotation_approve?id="+id;

             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });
$(document).on('click', '.quotation_rejected', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Reject this Quotation",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {
window.location = "quotation_rejected?id="+id;

             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });
$(document).on('click', '.quotation_revised', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Revised this Quotation",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {

               window.location = "quotation_revised?id="+id;
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });


var revisedquotationdetails_list_table = $('#revisedquotationdetails_list').DataTable({
      processing: true,
      serverSide: true,
 /*     scrollX: true,*/
 autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {
    $("#revisedquotationdetails_list").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
  },
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10,11]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10,11]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10,11]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10,11]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%',
                                                           '11%', '11%','11%','5%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10,11]
              }
          }
      ],

      ajax: {
          "url": 'revised_quotation',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;';
                }
              }
          },
          { data: 'version', name: 'version' },

          { data: 'quotedate', name: 'quotedate' },
          { data: 'updated_at', name: 'updated_at' },
          { data: 'validity', name: 'validity' },
          { data: 'cust_name', name: 'cust_name', },
          { data: 'reference', name: 'reference' },

          { data: 'name', name: 'name' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },
          { data: 'status' , name: 'status'},
          {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="view_revisedquotation?id=' + row.id + '" data-type="view"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="viewmore_revisedquotation?id=' + row.quote_id + '" data-type="view"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row. quote_id + '" >Revised Versions</span>\
                        </span></li></a>\
                         </ul></div></div></span>';

            }
        },

      ]
  });


$("#quotationdetails_list_print").on("click", function() {
      quotationdetails_list_table.button('.buttons-print').trigger();
  });


  $("#quotationdetails_list_copy").on("click", function() {
      quotationdetails_list_table.button('.buttons-copy').trigger();
  });

  $("#quotationdetails_list_csv").on("click", function() {
      quotationdetails_list_table.button('.buttons-csv').trigger();
  });

  $("#quotationdetails_list_pdf").on("click", function() {
      quotationdetails_list_table.button('.buttons-pdf').trigger();
  });