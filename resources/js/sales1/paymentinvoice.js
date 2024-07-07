
var formatter = new Intl.NumberFormat('en-IN', {
  minimumFractionDigits: 2,
});
var paymentdetails_list_table = $('#paymentdetails_list').DataTable({
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
          "url": 'paymentinvoicelist',
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
                  return '#S' + row.id + '&nbsp;&nbsp;';
              }
          },
           
          { data: 'quotedate', name: 'quotedate'},
          { data: 'cust_name', name: 'cust_name',},
          { data: 'totalamount', name: 'totalamount'},
          { data: 'discount', name: 'discount' },
          { data: 'vatamount', name: 'vatamount' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },

          { data: 'id', name: 'id',
          render: function(data, type, row) {
                 /* if(row.method == 1)
                  {*/
                    
                    return row.grandtotalamount;
                    // return row.grandtotalamount;
                 /* }
                  if(row.method == 2)
                  {
                    return row.paid_amount;
                  }*/
              } },
          { data: 'id', name: 'id',
          render: function(data, type, row) {
                /*  if(row.method == 1)
                  {
                    return 0;
                  }
                  if(row.method == 2)
                  {*/
                    return row.due_amount;
                 /* }*/
              } },
          { data: 'id', name: 'id',
          render: function(data, type, row) {
                /*  if(row.method == 1)
                  {
                    return '<span style="color: green">Paid</span>';
                  }
                  if(row.method == 2)
                  {*/
                    if(row.grandtotalamount != row.paid_amount)
                    {
                      return '<span style="color: red">Not Paid</span>';
                    }
                      return '<span style="color: green">Paid</span>';

                 // }
              } },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     

                    


                        if(row.method == 2)
                  {
                    j+='<a href="creditinvoice_pay?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Receive Payment</span>\
                        </span></li></a><a href="creditinvoice_pay_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Payment Edit</span>\
                        </span></li></a><a href="creditinvoice_pay_delete?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Payment Delete</span>\
                        </span></li></a>';
                  }


 j+='<a href="creditinvoice_pay_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
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

var cashsalesdetails_list_table = $('#cashsalesdetails_list').DataTable({
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
          "url": 'cashsales_report_list',
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
                  return '#S' + row.id + '&nbsp;&nbsp;';
              }
          },
           
          { data: 'quotedate', name: 'quotedate'},
          { data: 'cust_name', name: 'cust_name',},
          { data: 'totalamount', name: 'totalamount'},
          { data: 'discount', name: 'discount' },
          { data: 'vatamount', name: 'vatamount' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },
           { data: 'method', name: 'method',
          render: function(data, type, row) {
                  if(row.method == 1)
                  {
                    return 0;
                  }
                  if(row.method == 2)
                  {
                    return row.grandtotalamount;
                  }
              } },
          { data: 'method', name: 'method',
          render: function(data, type, row) {
                  if(row.method == 1)
                  {
                    return '<span style="color: green">Paid</span>';
                  }
                  if(row.method == 2)
                  {
                    return '<span style="color: red">Not Paid</span>';
                  }
              } },

          
      ]
  });

var creditsalesdetails_list_table = $('#creditsalesdetails_list').DataTable({
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
          "url": 'creditsales_report_list',
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
                  return '#S' + row.id + '&nbsp;&nbsp;';
              }
          },
           
          { data: 'quotedate', name: 'quotedate'},
          { data: 'cust_name', name: 'cust_name',},
          { data: 'totalamount', name: 'totalamount'},
          { data: 'discount', name: 'discount' },
          { data: 'vatamount', name: 'vatamount' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },
          { data: 'method', name: 'method',
          render: function(data, type, row) {
                  if(row.method == 1)
                  {
                    return row.grandtotalamount;
                  }
                  if(row.method == 2)
                  {
                    return row.paid_amount;
                  }
              } },
          { data: 'method', name: 'method',
          render: function(data, type, row) {
                  if(row.method == 1)
                  {
                    return 0;
                  }
                  if(row.method == 2)
                  {
                    return row.due_amount;
                  }
              } },
          { data: 'method', name: 'method',
          render: function(data, type, row) {
                  if(row.method == 1)
                  {
                    return '<span style="color: green">Paid</span>';
                  }
                  if(row.method == 2)
                  {
                    if(row.grandtotalamount != row.paid_amount)
                    {
                      return '<span style="color: red">Not Paid</span>';
                    }
                      return '<span style="color: green">Paid</span>';
                  }
              } },
          
      ]
  });


$(document).on('click', '#creditinvoice_pay', function(e) {
    e.preventDefault();    
totalamount = $('#totalamount').val();
totalamount1 = $('#totalamount1').val();


 var modeofpayment = [];

        $("select[name^='modeofpayment[]']")
        .each(function(input) {
            modeofpayment.push($(this).val());
        });

        var amount = [];

        $("input[name^='amount[]']")
        .each(function(input) {
            amount.push($(this).val());
        });

         var preference = [];

        $("input[name^='preference[]']")
        .each(function(input) {
            preference.push($(this).val());
        });
        

    $.ajax({
        type: "POST",
        url: "creditinvoicesubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            totalamount         : $('#totalamount').val(),
            date  : $('#date').val(),
            transactiondate  : $('#transactiondate').val(),
            invoiceid  : $('#invoiceid').val(),
            customer  : $('#customer').val(),
            depositaccount : $('#depositaccount').val(),
            notes : $('#notes').val(),
            reference : $('#reference').val(),
            preference : preference,
            modeofpayment : modeofpayment,
            amount : amount,
            cid : $('#cid').val(),
            payingamount : $('#payingamount').val(),
        },
        success: function(data) {
              window.location.href = "paymentinvoicelist";
           
             toastr.success('Successfully Added');
           
        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log(errorThrown);
           
        }
    }); 

});



$(document).on('click', '#creditinvoice_pay_edit', function(e) {
    e.preventDefault();    
totalamount = $('#totalamount').val();
totalamount1 = $('#totalamount1').val();


 var modeofpayment = [];

        $("select[name^='modeofpayment[]']")
        .each(function(input) {
            modeofpayment.push($(this).val());
        });

        var amount = [];

        $("input[name^='amount[]']")
        .each(function(input) {
            amount.push($(this).val());
        });

         var preference = [];

        $("input[name^='preference[]']")
        .each(function(input) {
            preference.push($(this).val());
        });
        

    $.ajax({
        type: "POST",
        url: "creditinvoicesubmit_transactions",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            totalamount         : $('#totalamount').val(),
            date  : $('#date').val(),
            transactiondate  : $('#transactiondate').val(),
            invoiceid  : $('#invoiceno').val(),
            customer  : $('#customer').val(),
            depositaccount : $('#depositaccount').val(),
            notes : $('#notes').val(),
            reference : $('#reference').val(),
            preference : preference,
            modeofpayment : modeofpayment,
            amount : amount,
            payid : $('#payid').val(),
            cid : $('#cid').val(),
            totalamount1 : $('#totalamount1').val(),
        },
        success: function(data) {
              window.location.href = "paymentinvoicelist";
           
             toastr.success('Successfully Added');
           
        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log(errorThrown);
           
        }
    }); 

});

