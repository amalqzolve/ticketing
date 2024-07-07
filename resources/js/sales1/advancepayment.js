$(document).on('click', '#advancepayment_submit', function(e) {
    e.preventDefault();    

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
        url: "advancepaymentsubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            customer         : $('#customer').val(),
            transactiontype : $('input[name="transactiontype"]:checked').val(),
            date  : $('#date').val(),
            invoice_no  : $('#invoice_no').val(),
            accountledger_depositaccount  : $('#accountledger_depositaccount').val(),
            notes : $('#notes').val(),
    
            preference : preference,
            modeofpayment : modeofpayment,
            amount : amount,
           
        },
        success: function(data) {
              window.location.href = "advancepayment";
           
             toastr.success('Successfully Added');
           
        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log(errorThrown);
           
        }
    }); 

});


var advancepaymentdetails_list_table = $('#advancepaymentdetails_list').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'advancepayment',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'invoice_no',
              name: 'invoice_no',
             
          },
           
          { data: 'date', name: 'date'},
          { data: 'cust_name', name: 'cust_name',},
          

          { data: 'transactiontype', name: 'transactiontype',
          render: function(data, type, row) {
                  if(row.transactiontype == 1)
                  {
                    
                    return 'On Account';
                    // return row.grandtotalamount;
                  }
                  if(row.transactiontype == 2)
                  {
                    return 'Sale Order';
                  }
              } },
         
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="advancepayment_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a><a href="advancepayment_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text advancepayment_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
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

  $(document).on('click', '.advancepayment_delete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'delete-advancepayment',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {
                     
                        swal.fire("Deleted!", "Your Entry has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Entry is safe :)", "error");
            }
        })
    });


  
$(document).on('click', '#advancepayment_update', function(e) {
    e.preventDefault();    

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
        url: "advancepaymentupdate",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            payid : $('#payid').val(),
            customer         : $('#customer').val(),
            transactiontype : $('input[name="transactiontype"]:checked').val(),
            date  : $('#date').val(),
            invoice_no  : $('#invoice_no').val(),
            accountledger_depositaccount  : $('#accountledger_depositaccount').val(),
            notes : $('#notes').val(),
    
            preference : preference,
            modeofpayment : modeofpayment,
            amount : amount,
           
        },
        success: function(data) {
              window.location.href = "advancepayment";
           
             toastr.success('Successfully Added');
           
        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log(errorThrown);
           
        }
    }); 

});