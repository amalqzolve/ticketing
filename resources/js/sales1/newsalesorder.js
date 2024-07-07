
var salesorderdetails_list_table = $('#salesorderdetails_list').DataTable({
      processing: true,
      serverSide: true,
  
 autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#salesorderdetails_list").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
          "url": 'newSalesorder',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
           

        {
              data: 'po_date',
              name: 'po_date',
              render: function(data, type, row) {
                  return '' + row.po_date + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'po_wo_ref',
              name: 'po_wo_ref',
              render: function(data, type, row) {
                  return '#' + row.po_wo_ref + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
      
          {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
        

       
          { data: 'quotedate', name: 'quotedate' },
      

          { data: 'cust_name', name: 'cust_name' },
          /*{ data: 'name', name: 'name' },*/
          
          { data: 'grandtotalamount', name: 'grandtotalamount' },

         /* { data: 'attention', name: 'attention' },
          { data: 'contact_phone', name: 'contact_phone' },*/
             {
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
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
                     return '<span style="color: blue">Partial Delivered</span>';
                }
                 
              }
          },
            {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
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
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
               
                  j='   <a href="salesorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Sale order PDF</span>\
                        </span></li></a><a href="salesorder_vo?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >VO</span>\
                        </span></li></a>';
                if (row.qtn_id == row.quote_id) 
                {
                  j+='<a href="quotation_file_download?id=' + row.quote_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.quote_id + '" >File Download</span>\
                        </span></li></a>';
                }
                        

                if (row.delivery !=1) {
                     /*  j+='<a href="saleorder_deivery?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery Order</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_deliveryorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery</span>\
                        </span></li></a>';

                    }
               if (row.invoice !=1) {
                    /*   j+='<a href="saleorder_invoice?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-file-2"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Invoice</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_invoiceorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Sales Invoice</span>\
                        </span></li></a>';
                    }

                 if (row.po_status ==0) {
                         j+='<a href="sales_convert_purchaseorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert to Purchase Order</span>\
                        </span></li></a>';
                    }



                      if (row.p_status !=1) {
                         j+='<a href="sales_convert_proformaorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert to Proforma Invoice</span>\
                        </span></li></a>';
                    }

                     

  j+='<a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item salequotation_enquiry" id=' + row.id +'>\
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


$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

    

    
var partial_delivered_list_table = $('#Partially_delivered_list').DataTable({
      processing: true,
      serverSide: true,
  
 autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#Partially_delivered_list").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
          "url": 'newSalesorder',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 'partial_delivered'
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
           

        {
              data: 'po_date',
              name: 'po_date',
              render: function(data, type, row) {
                  return '' + row.po_date + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'po_wo_ref',
              name: 'po_wo_ref',
              render: function(data, type, row) {
                  return '#' + row.po_wo_ref + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
      
          {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
        

       
          { data: 'quotedate', name: 'quotedate' },
      

          { data: 'cust_name', name: 'cust_name' },
          /*{ data: 'name', name: 'name' },
*/          
          { data: 'grandtotalamount', name: 'grandtotalamount' },

         /* { data: 'attention', name: 'attention' },
          { data: 'contact_phone', name: 'contact_phone' },*/
             {
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
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
                     return '<span style="color: blue">Partial Delivered</span>';
                }
                 
              }
          },
            {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
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
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='<a href="salesorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Sale order PDF</span>\
                        </span></li></a><a href="salesorder_vo?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >VO</span>\
                        </span></li></a>';

                if (row.delivery !=1) {
                     /*  j+='<a href="saleorder_deivery?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery Order</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_deliveryorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery</span>\
                        </span></li></a>';

                    }
               if (row.invoice !=1) {
                    /*   j+='<a href="saleorder_invoice?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-file-2"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Invoice</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_invoiceorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Sales Invoice</span>\
                        </span></li></a>';
                    }

                                   if (row.p_status !=1) {
                         j+='<a href="sales_convert_proformaorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert to Proforma Invoice</span>\
                        </span></li></a>';
                    }
 j+='<a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item salequotation_enquiry" id=' + row.id +'>\
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



    
var fully_delivered_list_table = $('#fully_delivered_list').DataTable({
      processing: true,
      serverSide: true,
  
 autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#fully_delivered_list").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
          "url": 'newSalesorder',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 'fully_delivered'

          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
           

        {
              data: 'po_date',
              name: 'po_date',
              render: function(data, type, row) {
                  return '' + row.po_date + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'po_wo_ref',
              name: 'po_wo_ref',
              render: function(data, type, row) {
                  return '#' + row.po_wo_ref + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
      
          {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
        

       
          { data: 'quotedate', name: 'quotedate' },
      

          { data: 'cust_name', name: 'cust_name' },
        /*  { data: 'name', name: 'name' },
*/          
          { data: 'grandtotalamount', name: 'grandtotalamount' },

         /* { data: 'attention', name: 'attention' },
          { data: 'contact_phone', name: 'contact_phone' },*/
             {
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
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
                     return '<span style="color: blue">Partial Delivered</span>';
                }
                 
              }
          },
            {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
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
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='<a href="salesorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Sale order PDF</span>\
                        </span></li></a><a href="salesorder_vo?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >VO</span>\
                        </span></li></a>';

                if (row.delivery !=1) {
                     /*  j+='<a href="saleorder_deivery?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery Order</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_deliveryorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery</span>\
                        </span></li></a>';

                    }
               if (row.invoice !=1) {
                    /*   j+='<a href="saleorder_invoice?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-file-2"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Invoice</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_invoiceorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Sales Invoice</span>\
                        </span></li></a>';
                    }

                   if (row.p_status !=1) {
                         j+='<a href="sales_convert_proformaorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert to Proforma Invoice</span>\
                        </span></li></a>';
                    }

 j+='<a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item salequotation_enquiry" id=' + row.id +'>\
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



    
var partial_invoiced_list_table = $('#Partially_invoiced_list').DataTable({
      processing: true,
      serverSide: true,
  
 autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#Partially_invoiced_list").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
          "url": 'newSalesorder',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 'partial_invoiced'
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
           

        {
              data: 'po_date',
              name: 'po_date',
              render: function(data, type, row) {
                  return '' + row.po_date + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'po_wo_ref',
              name: 'po_wo_ref',
              render: function(data, type, row) {
                  return '#' + row.po_wo_ref + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
      
          {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
        

       
          { data: 'quotedate', name: 'quotedate' },
      

          { data: 'cust_name', name: 'cust_name' },
          /*{ data: 'name', name: 'name' },
*/          
          { data: 'grandtotalamount', name: 'grandtotalamount' },

         /* { data: 'attention', name: 'attention' },
          { data: 'contact_phone', name: 'contact_phone' },*/
             {
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
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
                     return '<span style="color: blue">Partial Delivered</span>';
                }
                 
              }
          },
            {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
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
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='<a href="salesorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Sale order PDF</span>\
                        </span></li></a><a href="salesorder_vo?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >VO</span>\
                        </span></li></a>';

                if (row.delivery !=1) {
                     /*  j+='<a href="saleorder_deivery?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery Order</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_deliveryorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery</span>\
                        </span></li></a>';

                    }
               if (row.invoice !=1) {
                    /*   j+='<a href="saleorder_invoice?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-file-2"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Invoice</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_invoiceorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Sales Invoice</span>\
                        </span></li></a>';
                    }

                                   if (row.p_status !=1) {
                         j+='<a href="sales_convert_proformaorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert to Proforma Invoice</span>\
                        </span></li></a>';
                    }


 j+='<a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item salequotation_enquiry" id=' + row.id +'>\
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




    
var fully_invoiced_list_table = $('#fully_invoiced_list').DataTable({
      processing: true,
      serverSide: true,
  
 autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#fully_invoiced_list").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
          "url": 'newSalesorder',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 'fully_invoiced'
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
           

        {
              data: 'po_date',
              name: 'po_date',
              render: function(data, type, row) {
                  return '' + row.po_date + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'po_wo_ref',
              name: 'po_wo_ref',
              render: function(data, type, row) {
                  return '#' + row.po_wo_ref + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
      
          {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
        

       
          { data: 'quotedate', name: 'quotedate' },
      

          { data: 'cust_name', name: 'cust_name' },
         /* { data: 'name', name: 'name' },*/
          
          { data: 'grandtotalamount', name: 'grandtotalamount' },

         /* { data: 'attention', name: 'attention' },
          { data: 'contact_phone', name: 'contact_phone' },*/
             {
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
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
                     return '<span style="color: blue">Partial Delivered</span>';
                }
                 
              }
          },
            {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
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
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='<a href="salesorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Sale order PDF</span>\
                        </span></li></a><a href="salesorder_vo?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >VO</span>\
                        </span></li></a>';

                if (row.delivery !=1) {
                     /*  j+='<a href="saleorder_deivery?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery Order</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_deliveryorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery</span>\
                        </span></li></a>';

                    }
               if (row.invoice !=1) {
                    /*   j+='<a href="saleorder_invoice?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-file-2"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Invoice</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_invoiceorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Sales Invoice</span>\
                        </span></li></a>';
                    }

                                   if (row.p_status !=1) {
                         j+='<a href="sales_convert_proformaorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert to Proforma Invoice</span>\
                        </span></li></a>';
                    }


 j+='<a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item salequotation_enquiry" id=' + row.id +'>\
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




var not_invoiced_list_table = $('#not_invoiced_list').DataTable({
      processing: true,
      serverSide: true,
  
 autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#not_invoiced_list").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
          "url": 'newSalesorder',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 'not_invoiced'
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
           

        {
              data: 'po_date',
              name: 'po_date',
              render: function(data, type, row) {
                  return '' + row.po_date + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'po_wo_ref',
              name: 'po_wo_ref',
              render: function(data, type, row) {
                  return '#' + row.po_wo_ref + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
      
          {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
        

       
          { data: 'quotedate', name: 'quotedate' },
      

          { data: 'cust_name', name: 'cust_name' },
         /* { data: 'name', name: 'name' },*/
          
          { data: 'grandtotalamount', name: 'grandtotalamount' },

         /* { data: 'attention', name: 'attention' },
          { data: 'contact_phone', name: 'contact_phone' },*/
             {
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
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
                     return '<span style="color: blue">Partial Delivered</span>';
                }
                 
              }
          },
            {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
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
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='<a href="salesorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Sale order PDF</span>\
                        </span></li></a><a href="salesorder_vo?id=' + row.id + '" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >VO</span>\
                        </span></li></a>';

                if (row.delivery !=1) {
                     /*  j+='<a href="saleorder_deivery?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery Order</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_deliveryorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery</span>\
                        </span></li></a>';

                    }
               if (row.invoice !=1) {
                    /*   j+='<a href="saleorder_invoice?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-file-2"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Invoice</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_invoiceorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Sales Invoice</span>\
                        </span></li></a>';
                    }

                                   if (row.p_status !=1) {
                         j+='<a href="sales_convert_proformaorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert to Proforma Invoice</span>\
                        </span></li></a>';
                    }


 j+='<a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item salequotation_enquiry" id=' + row.id +'>\
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



var not_delivered_list_table = $('#not_delivered_list').DataTable({
      processing: true,
      serverSide: true,
  
 autoWidth: true,
 /*scrollX: "100%",*/
  initComplete: function (settings, json) {  
    $("#not_delivered_list").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
          "url": 'newSalesorder',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.status = 'not_delivered'
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
           

        {
              data: 'po_date',
              name: 'po_date',
              render: function(data, type, row) {
                  return '' + row.po_date + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'po_wo_ref',
              name: 'po_wo_ref',
              render: function(data, type, row) {
                  return '#' + row.po_wo_ref + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
      
          {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
        

       
          { data: 'quotedate', name: 'quotedate' },
      

          { data: 'cust_name', name: 'cust_name' },
         /* { data: 'name', name: 'name' },*/
          
          { data: 'grandtotalamount', name: 'grandtotalamount' },

         /* { data: 'attention', name: 'attention' },
          { data: 'contact_phone', name: 'contact_phone' },*/
             {
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
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
                     return '<span style="color: blue">Partial Delivered</span>';
                }
                 
              }
          },
            {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
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
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                  j='<a href="salesorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Sale order PDF</span>\
                        </span></li></a><a href="salesorder_vo?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >VO</span>\
                        </span></li></a>';

                if (row.delivery !=1) {
                     /*  j+='<a href="saleorder_deivery?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delivery Order</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_deliveryorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Delivery</span>\
                        </span></li></a>';

                    }
               if (row.invoice !=1) {
                    /*   j+='<a href="saleorder_invoice?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-file-2"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Invoice</span>\
                        </span></li></a>';*/
                          j+='<a href="sales_convert_invoiceorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert Sales Invoice</span>\
                        </span></li></a>';
                    }
                                   if (row.p_status !=1) {
                         j+='<a href="sales_convert_proformaorder?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-open-box"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert to Proforma Invoice</span>\
                        </span></li></a>';
                    }

                      j+='<a data-type="convertenquiry" data-target="#kt_form"><li class="kt-nav__item salequotation_enquiry" id=' + row.id +'>\
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




$(document).on('click', '.salequotation_enquiry', function() {
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
            window.location = "sale_quotation_enquiry?id="+id;
               
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });

