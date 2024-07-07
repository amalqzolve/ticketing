
var deliveryorderdetails_list_table = $('#deliveryorderdetails_list').DataTable({
      processing: true,
      serverSide: true,
     autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#deliveryorderdetails_list").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
            doc.content[1].table.widths = [ '15%',  '15%', '10%', '10%', 
                                                           '10%', '5%','5%','5%','15%','5%'];
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
          "url": 'deliveryorderlistingall',
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
          { data: 'quotedate', name: 'quotedate' },
            {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'sale_id',
              name: 'sale_id',
              render: function(data, type, row) {
                  return '#' + row.sale_id + '&nbsp;&nbsp;';
              }
          },
          
          { data: 'cust_name', name: 'cust_name' },
          { data: 'name', name: 'name' },

          { data: 'grandtotalamount', name: 'grandtotalamount' },
          
          {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
                var j='';
           
                if (row.invoice == 0) 
                {
                  return '<span style="color: red">Not Invoiced</span>';

                }
                if (row.invoice == 1) 
                {
                  return '<span style="color: green">Invoiced</span>';
                }
                 if (row.invoice == 2) 
                {
                  return '<span style="color: blue">Partial Invoiced</span>';

                }
                
                  
              }
          },
       /*   { data: 'status', name: 'status' },*/
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='<a href="deliveryorder_pdf?id=' + row.id + '&&sale_id='+row.sale_id+'" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery PDF</span>\
                        </span></li></a>';
           
               if (row.invoice!=1) {
                           j+='<a href="deliveryorder_convert_invoiceorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Sales Invoice</span>\
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

$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

    

    
    var deliveryorderdetails_list_table_generated = $('#generated').DataTable({
      processing: true,
      serverSide: true,
     /* scrollX: true,*/
      autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#generated").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
            doc.content[1].table.widths = [ '15%',  '15%', '10%', '10%', 
                                                           '10%', '5%','5%','5%','15%','5%'];
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
          "url": 'newDeliveryorder',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 1
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
          { data: 'quotedate', name: 'quotedate' },
            {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'sale_id',
              name: 'sale_id',
              render: function(data, type, row) {
                  return '#' + row.sale_id + '&nbsp;&nbsp;';
              }
          },
          
          { data: 'cust_name', name: 'cust_name' },
          { data: 'name', name: 'name' },

          { data: 'grandtotalamount', name: 'grandtotalamount' },
         
          {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
                var j='';
           
                
                if (row.invoice == 1) 
                {
                  return '<span style="color: green">Invoiced</span>';
                }
                
                
                  
              }
          },
       /*   { data: 'status', name: 'status' },*/
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='<a href="deliveryorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery PDF</span>\
                        </span></li></a>';
           
               if (row.invoice!=1) {
                           j+='<a href="deliveryorder_convert_invoiceorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Sales Invoice</span>\
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


var deliveryorderdetails_list_table_pargenerated = $('#pargenerated').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#pargenerated").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
            doc.content[1].table.widths = [ '15%',  '15%', '10%', '10%', 
                                                           '10%', '5%','5%','5%','15%','5%'];
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
          "url": 'newDeliveryorder',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 2

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
          { data: 'quotedate', name: 'quotedate' },
            {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'sale_id',
              name: 'sale_id',
              render: function(data, type, row) {
                  return '#' + row.sale_id + '&nbsp;&nbsp;';
              }
          },
          
          { data: 'cust_name', name: 'cust_name' },
          { data: 'name', name: 'name' },

          { data: 'grandtotalamount', name: 'grandtotalamount' },
         
          {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
                var j='';
           
               
                 if (row.invoice == 2) 
                {
                  return '<span style="color: blue">Partial Invoiced</span>';

                }
                
                  
              }
          },
       /*   { data: 'status', name: 'status' },*/
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='<a href="deliveryorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery PDF</span>\
                        </span></li></a>';
           
               if (row.invoice!=1) {
                           j+='<a href="deliveryorder_convert_invoiceorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Sales Invoice</span>\
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


var deliveryorderdetails_list_table_notgenerated = $('#notgenerated').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#notgenerated").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
            doc.content[1].table.widths = [ '15%',  '15%', '10%', '10%', 
                                                           '10%', '5%','5%','5%','15%','5%'];
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
          "url": 'newDeliveryorder',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 0
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
          { data: 'quotedate', name: 'quotedate' },
            {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'sale_id',
              name: 'sale_id',
              render: function(data, type, row) {
                  return '#' + row.sale_id + '&nbsp;&nbsp;';
              }
          },
          
          { data: 'cust_name', name: 'cust_name' },
          { data: 'name', name: 'name' },
          
          { data: 'grandtotalamount', name: 'grandtotalamount' },
          
          {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
                var j='';
           
                if (row.invoice == 0) 
                {
                  return '<span style="color: red">Not Invoiced</span>';

                }
                
                
                  
              }
          },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='<a href="deliveryorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery PDF</span>\
                        </span></li></a>';
           
               if (row.invoice!=1) {
                           j+='<a href="deliveryorder_convert_invoiceorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Sales Invoice</span>\
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

