var enquirydetails_list_table = $('#enquirydetails_list').DataTable({
 
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
          "url": 'enquiryreport',
          "type": "POST",
          "data": function(data) {
            data._token = $('#token').val(),
            data.sid = $('#salesmen').val()
            data.from = $('#from').val()
            data.to = $('#to').val()

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
              data: 'total',
              name: 'total',
              render: function(data, type, row) {
                if(row.total=='' || row.total==null){
                  return '0';
                }else{
                   return row.total; 
                }
              }
          },


          { data: 'quotedate', name: 'quotedate' },

      
         
          { data: 'cust_name', name: 'cust_name', },
         
          
          { data: 'name', name: 'name' },
         
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           if (row.status == 0) 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 1) 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 2) 
                {
                  return '<span style="color: red">Rejected</span>';

                }
                  
              }
          },
          
          {
              data: 'enqstatus',
              name: 'enqstatus',
              render: function(data, type, row) {
                if(row.enqstatus=='Expired'){
                   return  'Expired '+ row.redays +  ' days'; 
                }else{
                  return +row.redays+ ' days to expire' ;

                }
              }
          },
          { data: 'updated_at', name: 'updated_at' },
         
      ]
  });



 $(document).on('click', '#salesmensubmitenquiry', function() 
 {
    enquirydetails_list_table.ajax.reload();
 });


$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});