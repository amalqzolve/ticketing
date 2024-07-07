
var invoiceorderdetails_list_table = $('#invoiceorderdetails_list').DataTable({
      processing: true,
      serverSide: true,
       autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#invoiceorderdetails_list").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          }
      ],

      ajax: {
          "url": 'invoicelistingall',
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
              data: 'sale_id',
              name: 'sale_id',
              render: function(data, type, row) {
                  return '#' + row.sale_id + '&nbsp;&nbsp;';
              }
          },
          { data: 'quotedate', name: 'quotedate' },
          { data: 'cust_name', name: 'cust_name' },
          { data: 'name', name: 'name' },

          { data: 'grandtotalamount', name: 'grandtotalamount' },
         
          {
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
                var j='';
           
                if (row.delivery == 0) 
                {
                  return '<span style="color: red">Not Delivered</span>';

                }
                if (row.delivery == 1) 
                {
                  return '<span style="color: green">Delivered</span>';
                }
                 if (row.delivery == 2) 
                {
                  return '<span style="color: blue">Partially Delivered</span>';
                }
              }
          },
          /*{ data: 'status', name: 'status' },*/
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='<a href="invoiceorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
           

                    if (row.delivery !=1) {
                         j+='<a href="invoiceorder_convert_deliveryorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery Order</span>\
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

    

var invoiceorderdetails_list_table_generated = $('#invoiceorderdetails_list_generated').DataTable({
      processing: true,
      serverSide: true,
         
    initComplete: function (settings, json) {  
    $("#invoiceorderdetails_list_generated").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
  },
 /*scrollX: "100%",*/
 autoWidth: true,
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          }
      ],

      ajax: {
          "url": 'newInvoiceList',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 1
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
              data: 'sale_id',
              name: 'sale_id',
              render: function(data, type, row) {
                  return '#' + row.sale_id + '&nbsp;&nbsp;';
              }
          },
          { data: 'quotedate', name: 'quotedate' },
          { data: 'cust_name', name: 'cust_name' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },
          { data: 'name', name: 'name' },

         
          {
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
                var j='';
           
                
                 if (row.delivery == 0) 
                {
                  return '<span style="color: red">Not Delivered</span>';

                }
                if (row.delivery == 1) 
                {
                  return '<span style="color: green">Delivered</span>';
                }
                 if (row.delivery == 2) 
                {
                  return '<span style="color: blue">Partially Delivered</span>';
                }
                
              }
          },
          /*{ data: 'status', name: 'status' },*/
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='   <a href="invoiceorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
           
               // if (row.sdelivery !=1) {
               //           j+='<a href="sales_convert_deliveryorder?id=' + row.sale_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
               //          <span class="kt-nav__link">\
               //          <i class="kt-nav__link-icon flaticon2-open-box"></i>\
               //          <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery Order</span>\
               //          </span></li></a>';
               //      }
                    if (row.delivery !=1) {
                         j+='<a href="invoiceorder_convert_deliveryorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery Order</span>\
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

var invoiceorderdetails_list_table_notgenerated = $('#invoiceorderdetails_list_notgenerated').DataTable({
      processing: true,
      serverSide: true,
      

    initComplete: function (settings, json) {  
    $("#invoiceorderdetails_list_notgenerated").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
  },
 /*scrollX: "100%",*/
 autoWidth: true,
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          }
      ],

      ajax: {
          "url": 'newInvoiceList',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 0
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
              data: 'sale_id',
              name: 'sale_id',
              render: function(data, type, row) {
                  return '#' + row.sale_id + '&nbsp;&nbsp;';
              }
          },
          { data: 'quotedate', name: 'quotedate' },
          { data: 'cust_name', name: 'cust_name' },
          { data: 'name', name: 'name' },

          { data: 'grandtotalamount', name: 'grandtotalamount' },
          
          {
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
                var j='';
           
                 if (row.delivery == 0) 
                {
                  return '<span style="color: red">Not Delivered</span>';

                }
                if (row.delivery == 1) 
                {
                  return '<span style="color: green">Delivered</span>';
                }
                 if (row.delivery == 2) 
                {
                  return '<span style="color: blue">Partially Delivered</span>';
                }
               
              }
          },
          /*{ data: 'status', name: 'status' },*/
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='   <a href="invoiceorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
           
               // if (row.sdelivery !=1) {
               //           j+='<a href="sales_convert_deliveryorder?id=' + row.sale_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
               //          <span class="kt-nav__link">\
               //          <i class="kt-nav__link-icon flaticon2-open-box"></i>\
               //          <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery Order</span>\
               //          </span></li></a>';
               //      }
                    if (row.delivery !=1) {
                         j+='<a href="invoiceorder_convert_deliveryorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery Order</span>\
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

var invoiceorderdetails_list_table_pargenerated = $('#invoiceorderdetails_list_pargenerated').DataTable({
      processing: true,
      serverSide: true,
    
   autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#invoiceorderdetails_list_pargenerated").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
  },

 /*scrollX: "100%",*/
 autoWidth: true,
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9]
              }
          }
      ],

      ajax: {
          "url": 'newInvoiceList',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 2
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
              data: 'sale_id',
              name: 'sale_id',
              render: function(data, type, row) {
                  return '#' + row.sale_id + '&nbsp;&nbsp;';
              }
          },
          { data: 'quotedate', name: 'quotedate' },
          { data: 'cust_name', name: 'cust_name' },
          { data: 'name', name: 'name' },
          
          { data: 'grandtotalamount', name: 'grandtotalamount' },
          
          {
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
                var j='';
           
               
                  if (row.delivery == 0) 
                {
                  return '<span style="color: red">Not Delivered</span>';

                }
                if (row.delivery == 1) 
                {
                  return '<span style="color: green">Delivered</span>';
                }
                 if (row.delivery == 2) 
                {
                  return '<span style="color: blue">Partially Delivered</span>';
                }
              }
          },
          /*{ data: 'status', name: 'status' },*/
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='   <a href="invoiceorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
           
               // if (row.sdelivery !=1) {
               //           j+='<a href="sales_convert_deliveryorder?id=' + row.sale_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
               //          <span class="kt-nav__link">\
               //          <i class="kt-nav__link-icon flaticon2-open-box"></i>\
               //          <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery Order</span>\
               //          </span></li></a>';
               //      }
                    if (row.delivery !=1) {
                         j+='<a href="invoiceorder_convert_deliveryorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery Order</span>\
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
    