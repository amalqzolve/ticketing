    $("body").on("click",".remove",function(event){
   event.preventDefault();
   var row = $(this).closest('tr');
   
  
       var siblings = row.siblings();
       row.remove();
       siblings.each(function(index) {
         $(this).children().first();
       });

            var vatamounts = 0;
        $('.vatamount').each(function()
        {
            var id = $(this).attr('data-id');
            var vatamount = $('#vatamount'+id+'').val();
        
            vatamounts += parseFloat(vatamount);

        });
        $('#totalvatamount').val(vatamounts.toFixed(2));

        
        totalamount_calculate();
        discount_calculate();
final_calculate1();

   
});


$(document).on('click', '#sales_convert_invoiceorder_update', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        validity      = $('#validity').val();
        currency      = $('#currency').val();
        currencyvalue = $('#currency_value').val();

        totalamount         = $('#totalamount').val();
        discount            = $('#discount').val();
        amountafterdiscount = $('#amountafterdiscount').val();
        totalvatamount      = $('#totalvatamount').val();
        grandtotalamount    = $('#grandtotalamount').val();

        terms      = $('#terms').val();
        notes      = $('#notes').val();
        preparedby = $('#preparedby').val();
        approvedby = $('#approvedby').val();


        var pid = [];

        $("input[name^='pid[]']")
        .each(function(input) {
            pid.push($(this).val());
        });
/*alert(pid);return false;*/
        var productname = [];

        $("input[name^='item_details_id[]']")
        .each(function(input) {
            productname.push($(this).val());
        });

        var product_description = [];

         $("textarea[name^='product_description[]']")
        .each(function(input) {
            product_description.push($(this).val());
        });

        var unit = [];

        $("select[name^='unit[]']")
        .each(function(input) {
            unit.push($(this).val());
        });


        var oquantity = [];

        $("input[name^='oquantity[]']")
        .each(function(input) {
            oquantity.push($(this).val());
        });

         var rquantity = [];

        $("input[name^='rquantity[]']")
        .each(function(input) {
            rquantity.push($(this).val());
        });

  var iquantity = [];

        $("input[name^='iquantity[]']")
        .each(function(input) {
            iquantity.push($(this).val());
        });


        var quantity = [];

        $("input[name^='quantity[]']")
        .each(function(input) {
            quantity.push($(this).val());
        });

        var rate = [];

        $("input[name^='rate[]']")
        .each(function(input) {
            rate.push($(this).val());
        });

        var amount = [];

        $("input[name^='amount[]']")
        .each(function(input) {
            amount.push($(this).val());
        });

        var vatamount = [];

        $("input[name^='vatamount[]']")
        .each(function(input) {
            vatamount.push($(this).val());
        });


   var vat_percentage = [];

        $("input[name^='vat_percentage[]']")
        .each(function(input) {
            vat_percentage.push($(this).val());
        });


           var rdiscount = [];

        $("input[name^='discountamount[]']")
        .each(function(input) {
            rdiscount.push($(this).val());
        });

        var row_total = [];

        $("input[name^='row_total[]']")
        .each(function(input) {
            row_total.push($(this).val());
        });


       // if (customer == "") {
       //      $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
       //      toastr.warning("Please Select Customer!");
       //                return false;
       //      return false;
       //  } else {
       //      $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
       //  }

       //  if (reference == "") {
       //      $('#reference').addClass('is-invalid');
       //      toastr.warning("Please Add Reference!");
       //                return false;
       //      return false;
       //  } else {
       //       $('#reference').removeClass('is-invalid');
       //   }
        if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Salesman!");
                      return false;
        } else {
            $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
         
         var ttotal = 0;
            $.each(row_total,function() {
                ttotal += parseInt(this, 10);
            });


            if (ttotal > 0) {
                // the array is defined and has at least one element
            }else{
                   toastr.warning("Please Add Any Product!");
                      return false;
            }



     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Updated';
     } else{
        var sucess_msg ='Created';
     }
    
    $.ajax({
        type: "POST",
        url: "sales_convert_invoiceorder_update",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        quote_id      : $('#quote_id').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        quotedate     : $('#quotedate').val(),
        validity      : $('#validity').val(),
        currency      : $('#currency').val(),
        currencyvalue : $('#currency_value').val(),

        totalamount         : $('#totalamount').val(),
        discount            : $('#discount').val(),
        amountafterdiscount : $('#amountafterdiscount').val(),
        totalvatamount      : $('#totalvatamount').val(),
        grandtotalamount    : $('#grandtotalamount').val(),

        terms      : $('#terms').val(),
        notes      : $('#notes').val(),
        preparedby : $('#preparedby').val(),
        approvedby : $('#approvedby').val(),
        pid : pid,
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        oquantity : oquantity,
        rquantity : rquantity,
        iquantity : iquantity,
        rate : rate,
        amount : amount,
        vatamount : vatamount,  
        rdiscount : rdiscount, 
        vat_percentage : vat_percentage,          
        row_total : row_total,
        shipping_address      : $('#shipping_address').val(),
        billing_address : $('#billing_address').val(),
        contact_phone : $('#contact_phone').val(),
         tpreview : $('#kt-tinymce-4').val(),
          dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        invcustomer_id : $('#invcustomer_id').val(),
   
        },
        success: function(data) {
       
        
             $('#sales_convert_invoiceorder_update').removeClass('kt-spinner');
             $('#sales_convert_invoiceorder_update').prop("disabled", false);
             location.reload();
              window.location.href = "newInvoiceList";
             toastr.success('Successfuly Converted');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

     $(document.body).on("change", "#terms", function() 
    {
        var cid = $(this).val();
        
        $.ajax({
        url: "gettermsquote",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:cid
        },
        dataType: "json",
        success: function(data) {
          //  console.log(data);
            var termcondition ='';
          $.each(data, function(key, value) {
            
           termcondition =value.description;
                        });

          $('#kt-tinymce-4').val(termcondition);
          tinymce.activeEditor.setContent(termcondition);
          console.log(termcondition);

        }
    })
    });



$(document).on('click', '#sales_convert_proformaorder_update', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        validity      = $('#validity').val();
        currency      = $('#currency').val();
        currencyvalue = $('#currency_value').val();

        totalamount         = $('#totalamount').val();
        discount            = $('#discount').val();
        amountafterdiscount = $('#amountafterdiscount').val();
        totalvatamount      = $('#totalvatamount').val();
        grandtotalamount    = $('#grandtotalamount').val();

        terms      = $('#terms').val();
        notes      = $('#notes').val();
        preparedby = $('#preparedby').val();
        approvedby = $('#approvedby').val();


        var pid = [];

        $("input[name^='pid[]']")
        .each(function(input) {
            pid.push($(this).val());
        });
/*alert(pid);return false;*/
        var productname = [];

        $("input[name^='item_details_id[]']")
        .each(function(input) {
            productname.push($(this).val());
        });

        var product_description = [];

         $("textarea[name^='product_description[]']")
        .each(function(input) {
            product_description.push($(this).val());
        });

        var unit = [];

        $("select[name^='unit[]']")
        .each(function(input) {
            unit.push($(this).val());
        });


        var oquantity = [];

        $("input[name^='oquantity[]']")
        .each(function(input) {
            oquantity.push($(this).val());
        });

         var rquantity = [];

        $("input[name^='rquantity[]']")
        .each(function(input) {
            rquantity.push($(this).val());
        });

  var iquantity = [];

        $("input[name^='iquantity[]']")
        .each(function(input) {
            iquantity.push($(this).val());
        });


        var quantity = [];

        $("input[name^='quantity[]']")
        .each(function(input) {
            quantity.push($(this).val());
        });

        var rate = [];

        $("input[name^='rate[]']")
        .each(function(input) {
            rate.push($(this).val());
        });

        var amount = [];

        $("input[name^='amount[]']")
        .each(function(input) {
            amount.push($(this).val());
        });

        var vatamount = [];

        $("input[name^='vatamount[]']")
        .each(function(input) {
            vatamount.push($(this).val());
        });


   var vat_percentage = [];

        $("input[name^='vat_percentage[]']")
        .each(function(input) {
            vat_percentage.push($(this).val());
        });


           var rdiscount = [];

        $("input[name^='discountamount[]']")
        .each(function(input) {
            rdiscount.push($(this).val());
        });

        var row_total = [];

        $("input[name^='row_total[]']")
        .each(function(input) {
            row_total.push($(this).val());
        });


       // if (customer == "") {
       //      $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
       //      toastr.warning("Please Select Customer!");
       //                return false;
       //      return false;
       //  } else {
       //      $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
       //  }

       //  if (reference == "") {
       //      $('#reference').addClass('is-invalid');
       //      toastr.warning("Please Add Reference!");
       //                return false;
       //      return false;
       //  } else {
       //       $('#reference').removeClass('is-invalid');
       //   }
        if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Salesman!");
                      return false;
        } else {
            $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
         
         var ttotal = 0;
            $.each(row_total,function() {
                ttotal += parseInt(this, 10);
            });


            if (ttotal > 0) {
                // the array is defined and has at least one element
            }else{
                   toastr.warning("Please Add Any Product!");
                      return false;
            }



     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Updated';
     } else{
        var sucess_msg ='Created';
     }
    
    $.ajax({
        type: "POST",
        url: "sales_convert_proformaorder_update",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        quote_id      : $('#quote_id').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        quotedate     : $('#quotedate').val(),
        validity      : $('#validity').val(),
        currency      : $('#currency').val(),
        currencyvalue : $('#currency_value').val(),

        totalamount         : $('#totalamount').val(),
        discount            : $('#discount').val(),
        amountafterdiscount : $('#amountafterdiscount').val(),
        totalvatamount      : $('#totalvatamount').val(),
        grandtotalamount    : $('#grandtotalamount').val(),

        terms      : $('#terms').val(),
        notes      : $('#notes').val(),
        preparedby : $('#preparedby').val(),
        approvedby : $('#approvedby').val(),
        pid : pid,
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        oquantity : oquantity,
        rquantity : rquantity,
        iquantity : iquantity,
        rate : rate,
        amount : amount,
        vatamount : vatamount,  
        rdiscount : rdiscount, 
        vat_percentage : vat_percentage,          
        row_total : row_total,
        shipping_address      : $('#shipping_address').val(),
        billing_address : $('#billing_address').val(),
        contact_phone : $('#contact_phone').val(),
         tpreview : $('#kt-tinymce-4').val(),
          dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        invcustomer_id : $('#invcustomer_id').val(),
   
        },
        success: function(data) {
       
        
             $('#sales_convert_proformaorder_update').removeClass('kt-spinner');
             $('#sales_convert_proformaorder_update').prop("disabled", false);
             location.reload();
              window.location.href = "perfomainvoicelist";
             toastr.success('Successfuly Converted');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

    $(document).on('click', '#voupdate', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        validity      = $('#validity').val();
        currency      = $('#currency').val();
        currencyvalue = $('#currency_value').val();

        totalamount         = $('#totalamount').val();
        discount            = $('#discount').val();
        amountafterdiscount = $('#amountafterdiscount').val();
        totalvatamount      = $('#totalvatamount').val();
        grandtotalamount    = $('#grandtotalamount').val();

        terms      = $('#terms').val();
        notes      = $('#notes').val();
        preparedby = $('#preparedby').val();
        approvedby = $('#approvedby').val();


        var pid = [];

        $("input[name^='pid[]']")
        .each(function(input) {
            pid.push($(this).val());
        });
/*alert(pid);return false;*/
        var productname = [];

        $("input[name^='item_details_id[]']")
        .each(function(input) {
            productname.push($(this).val());
        });

        var product_description = [];

         $("textarea[name^='product_description[]']")
        .each(function(input) {
            product_description.push($(this).val());
        });

        var unit = [];

        $("select[name^='unit[]']")
        .each(function(input) {
            unit.push($(this).val());
        });


        var oquantity = [];

        $("input[name^='oquantity[]']")
        .each(function(input) {
            oquantity.push($(this).val());
        });

         var rquantity = [];

        $("input[name^='rquantity[]']")
        .each(function(input) {
            rquantity.push($(this).val());
        });

  var iquantity = [];

        $("input[name^='iquantity[]']")
        .each(function(input) {
            iquantity.push($(this).val());
        });


        var quantity = [];

        $("input[name^='quantity[]']")
        .each(function(input) {
            quantity.push($(this).val());
        });

        var rate = [];

        $("input[name^='rate[]']")
        .each(function(input) {
            rate.push($(this).val());
        });

        var amount = [];

        $("input[name^='amount[]']")
        .each(function(input) {
            amount.push($(this).val());
        });

        var vatamount = [];

        $("input[name^='vatamount[]']")
        .each(function(input) {
            vatamount.push($(this).val());
        });


   var vat_percentage = [];

        $("input[name^='vat_percentage[]']")
        .each(function(input) {
            vat_percentage.push($(this).val());
        });


           var rdiscount = [];

        $("input[name^='discountamount[]']")
        .each(function(input) {
            rdiscount.push($(this).val());
        });

        var row_total = [];

        $("input[name^='row_total[]']")
        .each(function(input) {
            row_total.push($(this).val());
        });


       // if (customer == "") {
       //      $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
       //      toastr.warning("Please Select Customer!");
       //                return false;
       //      return false;
       //  } else {
       //      $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
       //  }

       //  if (reference == "") {
       //      $('#reference').addClass('is-invalid');
       //      toastr.warning("Please Add Reference!");
       //                return false;
       //      return false;
       //  } else {
       //       $('#reference').removeClass('is-invalid');
       //   }
        if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Salesman!");
                      return false;
        } else {
            $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
         
         var ttotal = 0;
            $.each(row_total,function() {
                ttotal += parseInt(this, 10);
            });


            if (ttotal > 0) {
                // the array is defined and has at least one element
            }else{
                   toastr.warning("Please Add Any Product!");
                      return false;
            }



     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Updated';
     } else{
        var sucess_msg ='Created';
     }
    
    $.ajax({
        type: "POST",
        url: "voupdate",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        quote_id      : $('#quote_id').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        quotedate     : $('#quotedate').val(),
        validity      : $('#validity').val(),
        currency      : $('#currency').val(),
        currencyvalue : $('#currency_value').val(),

        totalamount         : $('#totalamount').val(),
        discount            : $('#discount').val(),
        amountafterdiscount : $('#amountafterdiscount').val(),
        totalvatamount      : $('#totalvatamount').val(),
        grandtotalamount    : $('#grandtotalamount').val(),

        terms      : $('#terms').val(),
        notes      : $('#notes').val(),
        preparedby : $('#preparedby').val(),
        approvedby : $('#approvedby').val(),
        pid : pid,
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        oquantity : oquantity,
        rquantity : rquantity,
        iquantity : iquantity,
        rate : rate,
        amount : amount,
        vatamount : vatamount,  
        rdiscount : rdiscount, 
        vat_percentage : vat_percentage,          
        row_total : row_total,
        shipping_address      : $('#shipping_address').val(),
        billing_address : $('#billing_address').val(),
        contact_phone : $('#contact_phone').val(),
         tpreview : $('#kt-tinymce-4').val(),
          dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        invcustomer_id : $('#invcustomer_id').val(),
   
        },
        success: function(data) {
       
        
             $('#voupdate').removeClass('kt-spinner');
             $('#voupdate').prop("disabled", false);
             location.reload();
              window.location.href = "newSalesorder";
             toastr.success('Successfuly Converted');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});