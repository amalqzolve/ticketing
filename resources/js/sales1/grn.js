var grndetails_list_table = $('#grndetails_list').DataTable({
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
          "url": 'grn',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'deliveryorder_id',
              name: 'deliveryorder_id',
              render: function(data, type, row) {
                  return '#' + row.deliveryorder_id + '&nbsp;&nbsp;';
              }
          },
         /*  {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;'; 
                }
              }
          },*/
          { data: 'rfq_id', name: 'rfq_id' },

        /*  { data: 'validity', name: 'validity' },*/
         
         
          
          { data: 'enquiry_id', name: 'enquiry_id' },
          { data: 'quotedate', name: 'quotedate' },
           { data: 'grandtotalamount', name: 'grandtotalamount' },
          /*{
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
                  return '<span style="color: black">'+row.status+'</span>';
                  
              }
          },*/
           { data: 'updated_at', name: 'updated_at' },

          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                
                
                 // j='<a href="grn_pdf?id=' + row.id + '" data-type="edit" target="_blank"><li class="kt-nav__item">\
                 //        <span class="kt-nav__link">\
                 //        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                 //        <span class="kt-nav__link-text" data-id="' + row.id + '" >Technical PO PDF</span>\
                 //        </span></li></a>\
                        j='<a href="grn_pdf1?id=' + row.id + '" data-type="edit" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
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