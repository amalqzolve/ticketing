    $(document).on('click', '#purchase_submit', function(e) {
    e.preventDefault();

    var supplier_vendor_names  = $('#supplier_vendor_names').val();
    var purchase_date = $('#purchase_order_date').val();
    var purchaseno    = $('#purchase_no').val();
    var paymentterms  = $('#paymentterms').val();
    var notes         = $('#notes').val();
    var terms         = $('#terms').val();
    var currency      = $('#item_currency').val();
    var currencyvalue = $('#item_currency_value').val();
    var purchase_sub_total = $('#purchase_sub_total').val();
    var grandtotal_discount = $('#grandtotal_discount').val();
    var grandtotal_tax = $('#grandtotal_tax').val();
    var net_amount = $('#net_amount').val();
    var paid_amount = $('#paid_amount').val();
    var due_amount = $('#due_amount').val();
    var totalcost_amount = $('#totalcost_amount').val();
    var fileData = $('#fileData').val();

    var purchaser = $('#purchaser').val();

    var bill_entry_date = $('#bill_entry_date').val();
    
   
        if (purchase_date == "") {
            $('#purchase_order_date').addClass('is-invalid');
             toastr.warning("Please add Purchase Date");
            return false;
        } else {
             $('#purchase_order_date').removeClass('is-invalid');
         }
          
  if (supplier_vendor_names == "") {
            $('#supplier_vendor_names').next().find('.select2-selection').addClass('select-dropdown-error');
             toastr.warning("Please add Supplier");
             return false;
        } else {
            $('#supplier_vendor_names').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
  if (purchaser == "") {
            $('#purchaser').next().find('.select2-selection').addClass('select-dropdown-error');
             toastr.warning("Please add Purchaser");
            return false;
        } else {
            $('#purchaser').next().find('.select2-selection').removeClass('select-dropdown-error');
        }




 if (bill_entry_date == "") {
            $('#bill_entry_date').addClass('is-invalid');
            toastr.warning("Please add Bill Entry Date");
            return false;
        } else {
             $('#bill_entry_date').removeClass('is-invalid');
         }
          

var purchasebillid         = $('#purchasebillid').val();
if (purchasebillid == "") {
            $('#purchasebillid').addClass('is-invalid');
            toastr.warning("Please add Bill ID");
            return false;
        } else {
             $('#purchasebillid').removeClass('is-invalid');
         }
          

    var productname = [];

    $("input[name^='productname[]']")
        .each(function(input) {
            productname.push($(this).val());
        });
    var productname_id = [];

    $("input[name^='item_details_id[]']")
        .each(function(input) {
            productname_id.push($(this).val());
        });
       
     var product_description = [];

        $("textarea[name^='product_description[]']")
        .each(function(input) {
            product_description.push($(this).val());
        });     

    var quantity = [];

    $("input[name^='quantity[]']")
        .each(function(input) {
            if($(this).val()<0||!$(this).val()){
                  toastr.warning("Please add Quantity");
            return false;

                 
            }else{
quantity.push($(this).val());
            }
           
        });

    var unit = [];

    $("select[name^='unit[]']")
        .each(function(input) {
            unit.push($(this).val());
        });
//alert(unit); return false;
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

        $("select[name^='vat_percentage[]']")
        .each(function(input) {
            vat_percentage.push($(this).val());
        });

    var discountamount = [];

    $("input[name^='discountamount[]']")
        .each(function(input) {
            discountamount.push($(this).val());
        });

    var row_total = [];

    $("input[name^='row_total[]']")
        .each(function(input) {
            row_total.push($(this).val());
        });

    var itemcost_details = [];

    $("select[name^='itemcost_details[]']")
        .each(function(input) {
            itemcost_details.push($(this).val());
        });

    var costrate = [];

    $("input[name^='costrate[]']")
        .each(function(input) {
            costrate.push($(this).val());
        });

    var costtax_group = [];

    $("select[name^='costtax_group[]']")
        .each(function(input) {
            costtax_group.push($(this).val());
        });

    var costtax_amount = [];

    $("input[name^='costtax_amount[]']")
        .each(function(input) {
            costtax_amount.push($(this).val());
        });
        
        var costtax_notes = [];

    $("input[name^='costtax_notes[]']")
        .each(function(input) {
            costtax_notes.push($(this).val());
        });

    //     var costsupplier = [];

    // $("select[name^='costsupplier[]']")
    //     .each(function(input) {
    //         costsupplier.push($(this).val());
    //     });


    var quantity_value = [];

    $("input[name^='quantity_value[]']")
        .each(function(input) {
            quantity_value.push($(this).val());
        });

    var pur_cost_id = [];

    $("input[name^='pur_cost_id[]']")
        .each(function(input) {
            pur_cost_id.push($(this).val());
        });

    var pur_pro_id = [];

    $("input[name^='pur_pro_id[]']")
        .each(function(input) {
            pur_pro_id.push($(this).val());
        });

        var ttotal = 0;
            $.each(itemcost_details,function() {
                ttotal += parseInt(this, 10);
            });


            if (ttotal > 0) {
                // the array is defined and has at least one element
            }else{
                   /*toastr.warning("Please add Cost Head");
                      return false;*/
            }

             var ptotal = 0;
            $.each(costtax_group,function() {
                ptotal += parseInt(this,10);
            });


            if (quantity>0) {
                // the array is defined and has at least one element
            }else{
            /*      toastr.warning("Please add Item");
                      return false;*/
            }
//               var utotal = 0;
//             $.each(unit,function() {
//                 utotal += parseInt(this,10);
//             });

// alert(utotal);
//             if (utotal>0) {
//                 // the array is defined and has at least one element
//             }else{
//                    toastr.warning("Please add Product Unit");
//                       return false;
//             }

            // var taxtotal = 0;
            // $.each(tax_group,function() {
            //     taxtotal += parseInt(this,10);
            // });

            // if (taxtotal>0) {
            //     // the array is defined and has at least one element
            // }else{
            //        toastr.warning("Please add Product Taxgroup");
            //           return false;
            // }

        


            
   /* test channel msg pass*/

    //$('#purchase_submit').addClass('kt-spinner');
    $('#purchase_submit').prop("disabled", true);
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      


    $.ajax({
        type: "POST",
        url: "qpurchase_submit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
           
            name          : $('#supplier_vendor_names').val(),
            purchase_date : $('#purchase_order_date').val(),
            purchaser: $('#purchaser').val(),
            bill_entry_date: $('#bill_entry_date').val(),
            purchaseno    : $('#purchase_no').val(),
            purchasebillid : $('#purchasebillid').val(),
            purchasemethod  : $('#purchasemethod').val(),
            qtnref : $('#qtnref').val(),
            currency      : $('#item_currency').val(),
            currencyvalue : $('#currency_value').val(),
            po_ref_number : $('#po_ref_number').val(),
            totalamount         : $('#totalamount').val(),
            discount            : $('#discount').val(),
            amountafterdiscount : $('#amountafterdiscount').val(),
            totalvatamount      : $('#totalvatamount').val(),
            grandtotalamount    : $('#grandtotalamount').val(),
            fileData: $('#fileData').val(),
            notes         : $('#notes').val(),
            paymentterms  : $('#paymentterms').val(),
            terms         : $('#terms').val(),
            paymentpreview : $('#paymentpreview').val(),
            termspreview : $('#termspreview').val(),
            totalcost_amount : $('#totalcost_amount').val(),
            
            productname   : productname,
            productname_id:productname_id,
            quantity: quantity,
            unit: unit,
            rate: rate,
            amount : amount,
            vatamount : vatamount,
            vat_percentage : vat_percentage,     
            discountamount : discountamount,
            row_total : row_total,
            itemcost_details : itemcost_details,
            costrate : costrate,
            costtax_group : costtax_group,
            costtax_amount : costtax_amount,
            quantity_value : quantity_value,
            pur_pro_id  : pur_pro_id,
            pur_cost_id : pur_cost_id,
            product_description : product_description,
            costtax_notes : costtax_notes,
            // costsupplier : costsupplier,

            
            branch : $('#branch').val(),
            
            
            
            
            vat_no : $('#vat_no').val(),
            cr_no : $('#cr_no').val(),
            
            
        },
        success: function(data) {
            // uppy.reset();
            if(data == false)
          {
            $('#purchase_submit').removeClass('kt-spinner');
            $('#purchase_submit').prop("disabled", false);
             toastr.warning('Purchase Number is already exist');

          }
          else
          {
            $('#purchase_submit').removeClass('kt-spinner');
            $('#purchase_submit').prop("disabled", false);
            toastr.success('Purchase details '+sucess_msg+' successfuly');

        


            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
            window.location.href = "qpurchaselist";
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
            $('#purchase_submit').removeClass('kt-spinner');
            $('#purchase_submit').prop("disabled", false);
        }
    });

    return false;

});





    $(document).on('click', '#purchase_update', function(e) {
    e.preventDefault();

    var supplier_vendor_names  = $('#supplier_vendor_names').val();
    var purchase_date = $('#purchase_order_date').val();
    var purchaseno    = $('#purchase_no').val();
    var paymentterms  = $('#paymentterms').val();
    var notes         = $('#notes').val();
    var terms         = $('#terms').val();
    var currency      = $('#item_currency').val();
    var currencyvalue = $('#item_currency_value').val();
    var purchase_sub_total = $('#purchase_sub_total').val();
    var grandtotal_discount = $('#grandtotal_discount').val();
    var grandtotal_tax = $('#grandtotal_tax').val();
    var net_amount = $('#net_amount').val();
    var paid_amount = $('#paid_amount').val();
    var due_amount = $('#due_amount').val();
    var totalcost_amount = $('#totalcost_amount').val();
    var fileData = $('#fileData').val();

    var purchaser = $('#purchaser').val();

    var bill_entry_date = $('#bill_entry_date').val();
    
   
        if (purchase_date == "") {
            $('#purchase_order_date').addClass('is-invalid');
             toastr.warning("Please add Purchase Date");
            return false;
        } else {
             $('#purchase_order_date').removeClass('is-invalid');
         }
          
  if (supplier_vendor_names == "") {
            $('#supplier_vendor_names').next().find('.select2-selection').addClass('select-dropdown-error');
             toastr.warning("Please add Supplier");
             return false;
        } else {
            $('#supplier_vendor_names').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
  if (purchaser == "") {
            $('#purchaser').next().find('.select2-selection').addClass('select-dropdown-error');
             toastr.warning("Please add Purchaser");
            return false;
        } else {
            $('#purchaser').next().find('.select2-selection').removeClass('select-dropdown-error');
        }




 if (bill_entry_date == "") {
            $('#bill_entry_date').addClass('is-invalid');
            toastr.warning("Please add Bill Entry Date");
            return false;
        } else {
             $('#bill_entry_date').removeClass('is-invalid');
         }
          

var purchasebillid         = $('#purchasebillid').val();
if (purchasebillid == "") {
            $('#purchasebillid').addClass('is-invalid');
            toastr.warning("Please add Bill ID");
            return false;
        } else {
             $('#purchasebillid').removeClass('is-invalid');
         }
          

    var productname = [];

    $("input[name^='productname[]']")
        .each(function(input) {
            productname.push($(this).val());
        });
    var productname_id = [];

    $("input[name^='item_details_id[]']")
        .each(function(input) {
            productname_id.push($(this).val());
        });
       
     var product_description = [];

        $("textarea[name^='product_description[]']")
        .each(function(input) {
            product_description.push($(this).val());
        });     

    var quantity = [];

    $("input[name^='quantity[]']")
        .each(function(input) {
            if($(this).val()<0||!$(this).val()){
                  toastr.warning("Please add Quantity");
            return false;

                 
            }else{
quantity.push($(this).val());
            }
           
        });

    var unit = [];

    $("select[name^='unit[]']")
        .each(function(input) {
            unit.push($(this).val());
        });
//alert(unit); return false;
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

        $("select[name^='vat_percentage[]']")
        .each(function(input) {
            vat_percentage.push($(this).val());
        });

    var discountamount = [];

    $("input[name^='discountamount[]']")
        .each(function(input) {
            discountamount.push($(this).val());
        });

    var row_total = [];

    $("input[name^='row_total[]']")
        .each(function(input) {
            row_total.push($(this).val());
        });

    var itemcost_details = [];

    $("select[name^='itemcost_details[]']")
        .each(function(input) {
            itemcost_details.push($(this).val());
        });

    var costrate = [];

    $("input[name^='costrate[]']")
        .each(function(input) {
            costrate.push($(this).val());
        });

    var costtax_group = [];

    $("select[name^='costtax_group[]']")
        .each(function(input) {
            costtax_group.push($(this).val());
        });

    var costtax_amount = [];

    $("input[name^='costtax_amount[]']")
        .each(function(input) {
            costtax_amount.push($(this).val());
        });
        
        var costtax_notes = [];

    $("input[name^='costtax_notes[]']")
        .each(function(input) {
            costtax_notes.push($(this).val());
        });

       

        
    var quantity_value = [];

    $("input[name^='quantity_value[]']")
        .each(function(input) {
            quantity_value.push($(this).val());
        });

    var pur_cost_id = [];

    $("input[name^='pur_cost_id[]']")
        .each(function(input) {
            pur_cost_id.push($(this).val());
        });

    var pur_pro_id = [];

    $("input[name^='pur_pro_id[]']")
        .each(function(input) {
            pur_pro_id.push($(this).val());
        });

        var ttotal = 0;
            $.each(itemcost_details,function() {
                ttotal += parseInt(this, 10);
            });


            if (ttotal > 0) {
                // the array is defined and has at least one element
            }else{
                   /*toastr.warning("Please add Cost Head");
                      return false;*/
            }

             var ptotal = 0;
            $.each(costtax_group,function() {
                ptotal += parseInt(this,10);
            });


            if (quantity>0) {
                // the array is defined and has at least one element
            }else{
            /*      toastr.warning("Please add Item");
                      return false;*/
            }
//               var utotal = 0;
//             $.each(unit,function() {
//                 utotal += parseInt(this,10);
//             });

// alert(utotal);
//             if (utotal>0) {
//                 // the array is defined and has at least one element
//             }else{
//                    toastr.warning("Please add Product Unit");
//                       return false;
//             }

            // var taxtotal = 0;
            // $.each(tax_group,function() {
            //     taxtotal += parseInt(this,10);
            // });

            // if (taxtotal>0) {
            //     // the array is defined and has at least one element
            // }else{
            //        toastr.warning("Please add Product Taxgroup");
            //           return false;
            // }

        


            
   /* test channel msg pass*/

    //$('#purchase_update').addClass('kt-spinner');
    $('#purchase_update').prop("disabled", true);
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      


    $.ajax({
        type: "POST",
        url: "qpurchase_update",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
           
            name          : $('#supplier_vendor_names').val(),
            purchase_date : $('#purchase_order_date').val(),
            purchaser: $('#purchaser').val(),
            bill_entry_date: $('#bill_entry_date').val(),
            purchaseno    : $('#purchase_no').val(),
            purchasebillid : $('#purchasebillid').val(),
            purchasemethod  : $('#purchasemethod').val(),
            qtnref : $('#qtnref').val(),
            currency      : $('#item_currency').val(),
            currencyvalue : $('#currency_value').val(),
            po_ref_number : $('#po_ref_number').val(),
            totalamount         : $('#totalamount').val(),
            discount            : $('#discount').val(),
            amountafterdiscount : $('#amountafterdiscount').val(),
            totalvatamount      : $('#totalvatamount').val(),
            grandtotalamount    : $('#grandtotalamount').val(),
            fileData: $('#fileData').val(),
            notes         : $('#notes').val(),
            paymentterms  : $('#paymentterms').val(),
            terms         : $('#terms').val(),
            paymentpreview : $('#paymentpreview').val(),
            termspreview : $('#termspreview').val(),
            totalcost_amount : $('#totalcost_amount').val(),
            
            productname   : productname,
            productname_id:productname_id,
            quantity: quantity,
            unit: unit,
            rate: rate,
            amount : amount,
            vatamount : vatamount,
            vat_percentage : vat_percentage,     
            discountamount : discountamount,
            row_total : row_total,
            itemcost_details : itemcost_details,
            costrate : costrate,
            costtax_group : costtax_group,
            costtax_amount : costtax_amount,
            quantity_value : quantity_value,
            pur_pro_id  : pur_pro_id,
            pur_cost_id : pur_cost_id,
            product_description : product_description,
            costtax_notes : costtax_notes,
            // costsupplier : costsupplier,

            
            branch : $('#branch').val(),
            
            
            
            
            vat_no : $('#vat_no').val(),
            cr_no : $('#cr_no').val(),
            
            
        },
        success: function(data) {
            // uppy.reset();
            if(data == false)
          {
            $('#purchase_update').removeClass('kt-spinner');
            $('#purchase_update').prop("disabled", false);
             toastr.warning('Purchase Number is already exist');

          }
          else
          {
            $('#purchase_update').removeClass('kt-spinner');
            $('#purchase_update').prop("disabled", false);
            toastr.success('Purchase details '+sucess_msg+' successfuly');

        


            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
            window.location.href = "qpurchaselist";
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
            $('#purchase_update').removeClass('kt-spinner');
            $('#purchase_update').prop("disabled", false);
        }
    });

    return false;

});

    $('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});