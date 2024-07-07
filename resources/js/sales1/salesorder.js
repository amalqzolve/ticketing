var salesorderdetails_list_table = $('#salesorderdetails_list').DataTable({
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
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50];
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
          "url": 'salesorder',
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
              data: 'delivery',
              name: 'delivery',
              render: function(data, type, row) {
                if (row.delivery == 1) 
                {
                     return 'Yes';
                }
                if (row.delivery == 0) 
                {
                     return 'No';
                }
                
                 
              }
          },
            {
              data: 'invoice',
              name: 'invoice',
              render: function(data, type, row) {
                if (row.invoice == 1) 
                {
                     return 'Yes';
                }
                if (row.invoice == 0) 
                {
                     return 'No';
                }
                
                 
              }
          },
          
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_sales_order?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a href="update_sales_order?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Update</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_purchase_management_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                        <a href="View-Salesorder?id=' + row.id + '" data-type="view"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="Pdf-Salesorder?id=' + row.id + '" data-type="pdf" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="fas fa-file-pdf"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
              }
          },
      ]
  });
$(document).on('click', '#sales_order_submit', function(e) {
    e.preventDefault();
    var customer_name  = $('#customer_name').val();
    var invoice_no     = $('#invoice_no').val();
    var invoice_date   = $('#invoice_date').val();
    var due_date       = $('#due_date').val();
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

          if (typeof productname !== 'undefined' && productname.length > 0) {
                // the array is defined and has at least one element
            }else{
                   toastr.warning("Please Add Any Product!");
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
        url: "sales_order_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            customer_name  : $('#customer_name').val(),
            invoice_no     : $('#invoice_no').val(),
            invoice_date   : $('#invoice_date').val(),
            due_date       : $('#due_date').val(),
            saledate       : $('#sale_date').val(),
            salesman_name  : $('#salesman_name').val(),
            notes          : $('#notes').val(),
            subtotal       : $('#subtotal').val(),
            discount       : $('#totaldiscount').val(),
            total          : $('#grandtotal').val(),
            terms_conditions : $('#terms_conditions').val(),   
            totaltax       : $('#totaltax').val(),
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
            branch : $('#branch').val(),

        },
        success: function(data) {
            // uppy.reset();
            if(data == false)
          {
            $('#sales_order_submit').removeClass('kt-spinner');
            $('#sales_order_submit').prop("disabled", false);
             toastr.warning('The Invoice Number Already Exists');

          }
          else
          {
             $('#sales_order_submit').removeClass('kt-spinner');
            $('#sales_order_submit').prop("disabled", false);
            toastr.success('Sales Order Details '+sucess_msg+' successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
            window.location.href = "salesorder";
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
    format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

$(document).on('click', '.status_submit', function(e) {
    e.preventDefault();
   var status = $(this).val();
   var cc = $(this).attr('data-id');
   var id  = $('#invoice_product_id'+cc+'').val();

  $.ajax({
        type: "POST",
        url: "sales_order_product_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: id,
            status  : status
        },
        success: function(data) {
            // uppy.reset();
            toastr.success('Status Updated Successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
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

$(document).on('click', '#converttodelivery_submit', function(e) {
    e.preventDefault();
    var customer_name  = $('#customer_name').val();
    var invoice_no     = $('#invoice_no').val();
    var invoice_date   = $('#invoice_date').val();
    var due_date       = $('#due_date').val();
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
   

     if (typeof productname !== 'undefined' && productname.length > 0) {
                // the array is defined and has at least one element
            }else{
                   toastr.warning("Please add any Product!");
            }




         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      
    $.ajax({
        type: "POST",
        url: "convert_delivery_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            salesid: $('#id').val(),
            customer_name  : $('#customer_name').val(),
            invoice_no     : $('#invoice_no').val(),
            invoice_date   : $('#invoice_date').val(),
            due_date       : $('#due_date').val(),
            saledate       : $('#sale_date').val(),
            salesman_name  : $('#salesman_name').val(),
            notes          : $('#notes').val(),
            subtotal       : $('#subtotal').val(),
            discount       : $('#totaldiscount').val(),
            total          : $('#grandtotal').val(),
            terms_conditions : $('#terms_conditions').val(),   
            totaltax       : $('#totaltax').val(),
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
            branch : $('#branch').val()

        },
        success: function(data) {
            // uppy.reset();
            toastr.success(' success');

            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
             window.location.href = "deliveryorder";
            
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

$(document).on('click', '#confirm_salesorder', function(e) {
    e.preventDefault();
  
   var id  = $('#id').val();
  $.ajax({
        type: "POST",
        url: "sales_order_confirm",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: id,
            status  : 2,
            branch : $('#branch').val()
        },
        success: function(data) {
            // uppy.reset();
            toastr.success('Status Updated Successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
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


$(document).on('click', '#converttoinvoice_submit', function(e) {
    e.preventDefault();
    var customer_name  = $('#customer_name').val();
    var invoice_no     = $('#invoice_no').val();
    var invoice_date   = $('#invoice_date').val();
    var due_date       = $('#due_date').val();
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
   

     if (typeof productname !== 'undefined' && productname.length > 0) {
                // the array is defined and has at least one element
            }else{
                   toastr.warning("Please Add Any Product!");
            }



         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      
    $.ajax({
        type: "POST",
        url: "convert_invoice_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            salesid: $('#id').val(),
            customer_name  : $('#customer_name').val(),
            invoice_no     : $('#invoice_no').val(),
            invoice_date   : $('#invoice_date').val(),
            due_date       : $('#due_date').val(),
            saledate       : $('#sale_date').val(),
            salesman_name  : $('#salesman_name').val(),
            notes          : $('#notes').val(),
            subtotal       : $('#subtotal').val(),
            discount       : $('#totaldiscount').val(),
            total          : $('#grandtotal').val(),
            terms_conditions : $('#terms_conditions').val(),   
            totaltax       : $('#totaltax').val(),
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
            branch : $('#branch').val()

        },
        success: function(data) {
            // uppy.reset();
            toastr.success(' success');

            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
             window.location.href = "salesorder";
            
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
            toastr.success('New Customer Added Successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
            window.location.href = "Add-salesorder";
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