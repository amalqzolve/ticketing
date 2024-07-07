
$(document).on('click', '#sales_submit', function(e) {
    e.preventDefault();
    var customer_name  = $('#customer_name').val();
    var invoice_no     = $('#invoice_no').val();
    var invoice_date   = $('#invoice_date').val();
    var due_date       = $('#due_date').val();
    var expirydate     = $('#expirydate').val();
    var salesman_name  = $('#salesman_name').val();
    var notes          = $('#notes').val();
    var subtotal       = $('#subtotal').val();
    var discount       = $('#totaldiscount').val();
    var totaltax       = $('#totaltax').val();
    var total          = $('#grandtotal').val();
    var terms_conditions = $('#terms_conditions').val();
    
    var productname = [];

    $("input[name^='productname[]']")
        .each(function(input) {
            productname.push($(this).val());
        });
        
    var product_variants = [];

    $("select[name^='product_variants[]']")
        .each(function(input) {
            product_variants.push($(this).val());
        });
       

    var quantity = [];

    $("input[name^='quantity[]']")
        .each(function(input) {
            quantity.push($(this).val());
        });

         var unit = [];

    $("select[name^='unit[]']")
        .each(function(input) {
            unit.push($(this).val());
        });



    var salesprice = [];

    $("input[name^='salesprice[]']")
        .each(function(input) {
            salesprice.push($(this).val());
        });


    var taxgroup = [];

    $("select[name^='taxgroup[]']")
        .each(function(input) {
            taxgroup.push($(this).val());
        });
        

    var amount = [];

    $("input[name^='amount[]']")
        .each(function(input) {
            amount.push($(this).val());
        });

        var taxamount = [];

    $("input[name^='taxamount[]']")
        .each(function(input) {
            taxamount.push($(this).val());
        });

        var discount = [];

    $("input[name^='discount[]']")
        .each(function(input) {
            discount.push($(this).val());
        });

        var discountamount = [];

    $("input[name^='discountamount[]']")
        .each(function(input) {
            discountamount.push($(this).val());
        });

        var total = [];

    $("input[name^='total[]']")
        .each(function(input) {
            total.push($(this).val());
        });

        var invoice_product_id = [];

    $("input[name^='invoice_product_id[]']")
        .each(function(input) {
            invoice_product_id.push($(this).val());
        });

        if (customer_name == "") {
            $('#customer_name').next().find('.select2-selection').addClass('select-dropdown-error');
            return false;
        } else {
            $('#customer_name').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (invoice_date == "") {
            $('#invoice_date').addClass('is-invalid');
            return false;
        } else {
            $('#invoice_date').removeClass('is-invalid');
        }
        
        if (due_date == "") {
            $('#due_date').addClass('is-invalid');
            return false;
        } else {
            $('#due_date').removeClass('is-invalid');
        }
        if (expirydate == "") {
            $('#expirydate').addClass('is-invalid');
            return false;
        } else {
            $('#expirydate').removeClass('is-invalid');
        }

      if (salesman_name == "") {
            $('#salesman_name').next().find('.select2-selection').addClass('select-dropdown-error');
            return false;
        } else {
            $('#salesman_name').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
       
        
$(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
        
        

   
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      
    $.ajax({
        type: "POST",
        url: "sales_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            customer_name  : $('#customer_name').val(),
            invoice_no     : $('#invoice_no').val(),
            invoice_date   : $('#invoice_date').val(),
            due_date       : $('#due_date').val(),
            salesman_name  : $('#salesman_name').val(),
            notes          : $('#notes').val(),
            subtotal       : $('#subtotal').val(),
            discount       : $('#totaldiscount').val(),
            total          : $('#grandtotal').val(),
            terms_conditions : $('#terms_conditions').val(),   
            totaltax       : $('#totaltax').val(),
            expirydate     : $('#expirydate').val(),
            salesordertype : $('#salesordertype').val(),
            invoiceaddress : $('#invoiceaddress').val(),
            shippingaddress : $('#shippingaddress').val(),
            paymentterms   : $('#paymentterms').val(),
            productname   : productname,
            product_variants: product_variants,
            quantity: quantity,
            salesprice: salesprice,
            taxgroup : taxgroup,
            amount : amount,
            taxamount : taxamount,
            rowdiscount : discount,
            discountamount : discountamount,
            rowtotal : total,
            invoice_product_id:invoice_product_id,
            unit : unit

        },
        success: function(data) {
            // uppy.reset();
          if(data == false)
          {
            $('#sales_submit').removeClass('kt-spinner');
            $('#sales_submit').prop("disabled", false);
             toastr.warning('The Invoice Number Already Exists');

          }
          else
          {
             $('#sales_submit').removeClass('kt-spinner');
            $('#sales_submit').prop("disabled", false);
            toastr.success('Sales Details '+sucess_msg+' successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
            window.location.href = "InvoiceList";
          }
        },
        error: function(jqXhr, json, errorThrown) {
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors, function(key, value) {
                if (jQuery.isPlainObject(value)) {

                    $.each(value, function(index, ndata) {
                        errorsHtml += '<li>' + ndata + '</li>';
                    });

                } else {

                    errorsHtml += '<li>' + value + '</li>';

                }
            });
            toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
        }
    });

    return false;

});

 $('.ktdatepicker').datepicker({
   todayHighlight: true,
   format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
    $(this).datepicker('hide');
});
var salesinvoicedetails_list_table = $('#salesinvoicedetails_list').DataTable({
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
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '25%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          }
      ],

      ajax: {
          "url": 'InvoiceList',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'cust_name', name: 'cust_name' },
          { data: 'invoice_no', name: 'invoice_no' },
          { data: 'invoice_date', name: 'invoice_date' },
          { data: 'due_date', name: 'due_date' },
          { data: 'name', name: 'name' },
          { data: 'total', name: 'total' },
          
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_sales_invoice?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_salesinvoice_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                        <a href="View-SalesInvoice?id=' + row.id + '" data-type="view"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="Pdf-SalesInvoice?id=' + row.id + '" data-type="pdf"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="fas fa-file-pdf"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
              }
          },
      ]
  });

$(document).on('click', '#customer_submit', function(e) {
    e.preventDefault();
    var customername  = $('#customername').val();
    var phonenumber   = $('#phonenumber').val();
    var email         = $('#email').val();
    var address       = $('#address').val();
    
      
    $.ajax({
        type: "POST",
        url: "Customer_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            
            customername  : $('#customername').val(),
            phonenumber   : $('#phonenumber').val(),
            email         : $('#email').val(),
            address       : $('#address').val()

        },
        success: function(data) {
            // uppy.reset();
            if(data == false)
          {
           
             toastr.warning('The Customer Name Already Exists');
              location.reload();
          }
          else
          {
            toastr.success('New Customer Added Successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
            window.location.href = "Add-Invoice";
          }
        },
        error: function(jqXhr, json, errorThrown) {
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors, function(key, value) {
                if (jQuery.isPlainObject(value)) {

                    $.each(value, function(index, ndata) {
                        errorsHtml += '<li>' + ndata + '</li>';
                    });

                } else {

                    errorsHtml += '<li>' + value + '</li>';

                }
            });
            toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
        }
    });

    return false;

});


 $(document).on('click', '.kt_salesinvoice_delete', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Entry ",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'invoice_delete',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {

                    swal.fire("Deleted!", "Your entry has been deleted.", "success");
                    location.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Entry is safe", "error");
        }
    })
});
