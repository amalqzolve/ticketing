var deliveryorderdetails_list_table = $('#deliveryorderdetails_list').DataTable({
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
            doc.content[1].table.widths = [ '25%',  '25%', '10%', '10%', 
                                                           '10%', '15%','15%','15%','15%','15%'];
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
          "url": 'deliveryorder',
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
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
               
                if (row.status == 3) 
                {
                     return 'Delivered';
                }
                if (row.status == 4) 
                {
                     return 'Partially Delivered';
                }
                 if (row.status == 5) 
                {
                     return 'Invoiced';
                }
                if (row.status == 6) 
                {
                     return 'Partially Invoiced';
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
                        <a href="convertinvoice?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Convert to Invoice</span>\
                        </span></li></a>\
                         <a href="deliveryorder_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                         <a href="deliveryorder_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" target="blank">PDF</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
              }
          },
      ]
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
   

         if (customer_name == "") {
            $('#customer_name').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Customer Name!");
                      return false;
        } else {
            $('#customer_name').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (invoice_date == "") {
            $('#invoice_date').addClass('is-invalid');
            toastr.warning("Please Add Invoice Date!");
                      return false;
        } else {
            $('#invoice_date').removeClass('is-invalid');
        }
        
        if (due_date == "") {
            $('#due_date').addClass('is-invalid');
            toastr.warning("Please Add  Due Date!");
                      return false;
        } else {
            $('#due_date').removeClass('is-invalid');
        }
       

      if (salesman_name == "") {
            $('#salesman_name').next().find('.select2-selection').addClass('select-dropdown-error');
           toastr.warning("Please Select Any Salesman!");
                      return false;
        } else {
            $('#salesman_name').next().find('.select2-selection').removeClass('select-dropdown-error');
        }

         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      
    $.ajax({
        type: "POST",
        url: "convert_invoice_submit_del",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            salesid: $('#sales_id').val(),
            deliveryid: $('#id').val(),
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