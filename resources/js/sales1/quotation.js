$(document).on('click', '#productname_submit', function(e) {
    e.preventDefault();

        name         = $('#itemname').val();
        description  = $('#description').val();
        unit         = $('#productunit').val();
        price        = $('#price').val();

        if (name == ""){
            $('#itemname').addClass('is-invalid');
            return false;
        }else{
            $('#itemname').removeClass('is-invalid');
        }

        if (unit == "") {
            $('#productunit').addClass('is-invalid');
            return false;
        } else {
             $('#productunit').removeClass('is-invalid');
         }
         if (price == "") {
            $('#price').addClass('is-invalid');
            return false;
        } else {
             $('#price').removeClass('is-invalid');
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
        url: "newproductsubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            name         : $('#itemname').val(),
            description  : $('#description').val(),
            unit         : $('#productunit').val(),
            price        : $('#price').val(),
            branch : $('#branch').val(),
            type : 1
        },
        success: function(data) {
           
            if(data == 1)
            {
             toastr.warning('Product Already Exists');

            }
            else
            {
       
             $('#myModal').modal('hide');
             $('#productname_submit').removeClass('kt-spinner');
             $('#productname_submit').prop("disabled", false);
             toastr.success('New Product'+sucess_msg+' successfuly');
        
            var dataa = {
                    id: data,
                    text: name
                };

                var newOption = new Option(dataa.text, dataa.id, false, false);
                $('.productname').append(newOption);

                   $('#itemname').val('');
                   $('#description').val('');
                   $('#productunit').val('');
                   $('#price').val('');
}
        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log(errorThrown);
           
        }
    });
});



$(document).on('click', '#servicename_submit', function(e) {
    e.preventDefault();

        name         = $('#servicename').val();
        description  = $('#servicedescription').val();
        unit         = $('#serviceunit').val();
        price        = $('#serviceprice').val();

        if (name == ""){
            $('#servicename').addClass('is-invalid');
            return false;
        }else{
            $('#servicename').removeClass('is-invalid');
        }

        if (unit == "") {
            $('#serviceunit').addClass('is-invalid');
            return false;
        } else {
             $('#serviceunit').removeClass('is-invalid');
         }
         if (price == "") {
            $('#serviceprice').addClass('is-invalid');
            return false;
        } else {
             $('#serviceprice').removeClass('is-invalid');
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
        url: "newproductsubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            name         : $('#servicename').val(),
            description  : $('#servicedescription').val(),
            unit         : $('#serviceunit').val(),
            price        : $('#serviceprice').val(),
            branch : $('#branch').val(),
            type : 2,
        },
        success: function(data) {
       if(data == 2)
            {
             toastr.warning('Service Already Exists');

            }
            else
            {
             $('#serviceModal').modal('hide');
             $('#servicename_submit').removeClass('kt-spinner');
             $('#servicename_submit').prop("disabled", false);
             toastr.success('New Service'+sucess_msg+' successfuly');
        
            var dataa = {
                    id: data,
                    text: name
                };

                var newOption = new Option(dataa.text, dataa.id, false, false);
                $('.productname').append(newOption).trigger('change');
}
        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log(errorThrown);
           
        }
    });
});




$(document).on('click', '#quotation_convert_enquiry', function(e) {
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
        cust_name=$('#cust_name').val();


        if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Customer!");
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }

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
        //     $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
        //    toastr.warning("Please Select Customer!");
        //               return false;
        //     return false;
        // } else {
        //     $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
        // }

        // if (reference == "") {
        //     $('#reference').addClass('is-invalid');
        //     toastr.warning("Please Add reference!");
        //               return false;
        //     return false;
        // } else {
        //      $('#reference').removeClass('is-invalid');
        //  }
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
        url: "newquotationsubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        customer      : $('#customerid').val(),
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
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        rate : rate,
        amount : amount,
        vatamount : vatamount,    
        rdiscount : rdiscount, 
        vat_percentage : vat_percentage,     
        row_total : row_total,
        shipping_address      : $('#shipping_address').val(),
        billing_address : $('#billing_address').val(),
        contact_phone : $('#contact_phone').val(),
        tpreview : tinymce.get("kt-tinymce-4").getContent(),
        cust_category      : $('#cust_category').val(),
        cust_code      : $('#cust_code').val(),
        cust_type      : $('#cust_type').val(),
        cust_group      : $('#cust_group').val(),
        cust_name      : $('#cust_name').val(),
        cust_country      : $('#cust_country').val(),
        building_no      : $('#building_no').val(),
        cust_region      : $('#cust_region').val(),
        cust_district      : $('#cust_district').val(),
        cust_city      : $('#cust_city').val(),
        cust_zip      : $('#cust_zip').val(),
        mobile      : $('#mobile').val(),
        vatno      : $('#vatno').val(),
        buyerid_crno      : $('#buyerid_crno').val(),
        dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        newcustomer : $('#newcustomer').val(),
         delivery_period : $('#delivery_period').val(),
        
   
        },
        success: function(data) {
       
        
             $('#quotation_submit').removeClass('kt-spinner');
             $('#quotation_submit').prop("disabled", false);
             location.reload();
              window.location.href = "newQuotation";
             toastr.success('New Quotation'+sucess_msg+' successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

$(document).on('click', '#quotation_submit1', function(e) {
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
        cust_name=$('#cust_name').val();
               delivery_period : $('#delivery_period').val();


        if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Customer!");
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }

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
        //     $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
        //    toastr.warning("Please Select Customer!");
        //               return false;
        //     return false;
        // } else {
        //     $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
        // }

        // if (reference == "") {
        //     $('#reference').addClass('is-invalid');
        //     toastr.warning("Please Add reference!");
        //               return false;
        //     return false;
        // } else {
        //      $('#reference').removeClass('is-invalid');
        //  }
          if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Salesman!");
                      return false;
           
        } else {
            $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (cust_category == "") {
    $('#cust_category').next().find('.select2-selection').addClass('is-invalid');
    toastr.warning('Customer Category is Required.');
    
    return false;
    } else {
     $('#cust_category').next().find('.select2-selection').removeClass('is-invalid');
    }
    if (cust_code == "") {
    $('#cust_code').addClass('is-invalid');
    toastr.warning('customer Code is Required.');
    
    return false;
    } else {
    $('#cust_code').removeClass('is-invalid');
    }
    if (cust_type == "") {
    $('#cust_type').next().find('.select2-selection').addClass('is-invalid');
    toastr.warning('Customer Type is Required.');
    
    return false;
    } else {
     $('#cust_type').next().find('.select2-selection').removeClass('is-invalid');
    }
    if (cust_group == "") {
    $('#cust_group').next().find('.select2-selection').addClass('is-invalid');
    toastr.warning('Customer Group is Required.');
   
    return false;
    } else {
     $('#cust_group').next().find('.select2-selection').removeClass('is-invalid');
    }

    if (cust_name == "") {
    $('#cust_name').addClass('is-invalid');
    toastr.warning('Cusomer Name is Required.');
    
    return false;
    } else {
    $('#cust_name').removeClass('is-invalid');
    }
    if (cust_country == "") {
    $('#cust_country').next().find('.select2-selection').addClass('is-invalid');
    toastr.warning('Country is Required.');
    
    return false;
    } else {
     $('#cust_country').next().find('.select2-selection').removeClass('is-invalid');
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
        url: "newquotationsubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
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
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        rate : rate,
        amount : amount,
        vatamount : vatamount,    
        rdiscount : rdiscount, 
        vat_percentage : vat_percentage,     
        row_total : row_total,
        shipping_address      : $('#shipping_address').val(),
        billing_address : $('#billing_address').val(),
        contact_phone : $('#contact_phone').val(),
        tpreview : tinymce.get("kt-tinymce-4").getContent(),
        cust_category      : $('#cust_category').val(),
        cust_code      : $('#cust_code').val(),
        cust_type      : $('#cust_type').val(),
        cust_group      : $('#cust_group').val(),
        cust_name      : $('#cust_name').val(),
        cust_country      : $('#cust_country').val(),
        building_no      : $('#building_no').val(),
        cust_region      : $('#cust_region').val(),
        cust_district      : $('#cust_district').val(),
        cust_city      : $('#cust_city').val(),
        cust_zip      : $('#cust_zip').val(),
        mobile      : $('#mobile').val(),
        email      : $('#email').val(),
        vatno      : $('#vatno').val(),
        buyerid_crno      : $('#buyerid_crno').val(),
        dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        newcustomer : $('#newcustomer').val(),
               delivery_period : $('#delivery_period').val(),
        
   
        },
        success: function(data) {
       
        
             $('#quotation_submit1').removeClass('kt-spinner');
             $('#quotation_submit1').prop("disabled", false);
             location.reload();
              window.location.href = "newQuotation";
             toastr.success('New Quotation'+sucess_msg+' successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

$(document).on('click', '#quotation_submit', function(e) {
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
        cust_name=$('#cust_name').val();


        if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Customer!");
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }

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

        $("select[name^='vat_percentage[]']")
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
        //     $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
        //    toastr.warning("Please Select Customer!");
        //               return false;
        //     return false;
        // } else {
        //     $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
        // }

        // if (reference == "") {
        //     $('#reference').addClass('is-invalid');
        //     toastr.warning("Please Add reference!");
        //               return false;
        //     return false;
        // } else {
        //      $('#reference').removeClass('is-invalid');
        //  }
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
        url: "newquotationsubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
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
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        rate : rate,
        amount : amount,
        vatamount : vatamount,    
        rdiscount : rdiscount, 
        vat_percentage : vat_percentage,     
        row_total : row_total,
        shipping_address      : $('#shipping_address').val(),
        billing_address : $('#billing_address').val(),
        contact_phone : $('#contact_phone').val(),
        tpreview : tinymce.get("kt-tinymce-4").getContent(),
        cust_category      : $('#cust_category').val(),
        cust_code      : $('#cust_code').val(),
        cust_type      : $('#cust_type').val(),
        cust_group      : $('#cust_group').val(),
        cust_name      : $('#cust_name').val(),
        cust_country      : $('#cust_country').val(),
        building_no      : $('#building_no').val(),
        cust_region      : $('#cust_region').val(),
        cust_district      : $('#cust_district').val(),
        cust_city      : $('#cust_city').val(),
        cust_zip      : $('#cust_zip').val(),
        mobile      : $('#mobile').val(),
        vatno      : $('#vatno').val(),
        buyerid_crno      : $('#buyerid_crno').val(),
        dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        newcustomer : $('#newcustomer').val(),
               delivery_period : $('#delivery_period').val(),
        
   
        },
        success: function(data) {
       
        
             $('#quotation_submit').removeClass('kt-spinner');
             $('#quotation_submit').prop("disabled", false);
             location.reload();
              window.location.href = "newQuotation";
             toastr.success('New Quotation'+sucess_msg+' successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});


$(document).on('click', '#quotation_update', function(e) {
    e.preventDefault();
        customer_id      = $('#customer_id').val();
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
        cust_name=$('#cust_name').val();



        if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Customer!");
            
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }


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

        $("select[name^='vat_percentage[]']")
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


        //  if (customer == "") {
        //     $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
        //     toastr.warning("Please Select Customer!");
        //               return false;
        //     return false;
        // } else {
        //     $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
        // }

        // if (reference == "") {
        //     $('#reference').addClass('is-invalid');
        //     toastr.warning("Please Add Reference!");
        //               return false;
        //     return false;
        // } else {
        //      $('#reference').removeClass('is-invalid');
        //  }
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
        url: "newquotationupdate",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        customer      : $('#customer').val(),
        customer_id      : $('#customer_id').val(),
        unique_id      : $('#unique_id').val(),
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
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        rate : rate,
        amount : amount,
        vatamount : vatamount,  
        rdiscount : rdiscount, 
        vat_percentage : vat_percentage,       
        row_total : row_total,
        shipping_address      : $('#shipping_address').val(),
        billing_address : $('#billing_address').val(),
        contact_phone : $('#contact_phone').val(),
        tpreview : tinymce.get("kt-tinymce-4").getContent(),
        dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        invcustomer_id : $('#invcustomer_id').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
               delivery_period : $('#delivery_period').val(),
        
        },
        success: function(data) {
       
        
             $('#quotation_submit').removeClass('kt-spinner');
             $('#quotation_submit').prop("disabled", false);
             location.reload();
              window.location.href = "newQuotation";
             toastr.success('Quotation Updated Successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});


$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

    




/* $(".kt_datetimepickerr").datetimepicker({
    format: 'dd-mm-yyyy'

}).on('changeDate', function(e){
    $(this).datetimepicker('hide');
});
*/


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


    $(document.body).on("change", "#customer", function() 
    {
        var cid = $(this).val();
        
        $.ajax({
        url: "getcustomeraddressquote",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:cid
        },
        dataType: "json",
        success: function(data) {
            console.log(data);
            var inv_address ='';
            var ship_address ='';
            var cust_phone ='';
          $.each(data, function(key, value) {
            
           inv_address =value.invoice_add1+' '+value.invoice_add2+' '+value.invoice_city+' '+value.invoice_country;

           ship_address =value.shipping1+' '+value.shipping2+' '+value.shipping_city+' '+value.invoice_country;

           cust_phone =value.mobile1;



                        });

          $('#billing_address').val(inv_address);
          $('#shipping_address').val(ship_address);
          $('#contact_phone').val(cust_phone);
          

        }
    })
    });

    $("body").on("click",".remove",function(event){
   event.preventDefault();
   var row = $(this).closest('tr');
   
  
       var siblings = row.siblings();
       row.remove();
       siblings.each(function(index) {
           $(this).children().first().text(index+1);
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


$(document).on('click', '#quotation_revise', function(e) {
    e.preventDefault();
        customer_id      = $('#customer_id').val();
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

        $("select[name^='vat_percentage[]']")
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
       //     toastr.warning("Please Select Customer!");
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
        url: "newquotationrevise",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        customer      : $('#customer').val(),
        customer_id      : $('#customer_id').val(),
        unique_id      : $('#unique_id').val(),
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
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        rate : rate,
        amount : amount,
        vatamount : vatamount,  
        rdiscount : rdiscount, 
        vat_percentage : vat_percentage,       
        row_total : row_total,
        shipping_address      : $('#shipping_address').val(),
        billing_address : $('#billing_address').val(),
        contact_phone : $('#contact_phone').val(),
        tpreview : tinymce.get("kt-tinymce-4").getContent(),
        dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        invcustomer_id : $('#invcustomer_id').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        revised_on : $('#revised_on').val(),
               delivery_period : $('#delivery_period').val(),
        
   
        },
        success: function(data) {
       
        
             $('#quotation_revise').removeClass('kt-spinner');
             $('#quotation_revise').prop("disabled", false);
             location.reload();
              window.location.href = "newQuotation";
             toastr.success('Quotation Revised Successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});


$(document).on('click', '#quotation_approve', function(e) {
    e.preventDefault();
        customer_id      = $('#customer_id').val();
        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        validity      = $('#validity').val();
        currency      = $('#currency').val();
        currencyvalue = $('#currency_value').val();

         po_id = $('#po_id').val();
          po_date = $('#po_date').val();
           po_note = $('#po_note').val();

        totalamount         = $('#totalamount').val();
        discount            = $('#discount').val();
        amountafterdiscount = $('#amountafterdiscount').val();
        totalvatamount      = $('#totalvatamount').val();
        grandtotalamount    = $('#grandtotalamount').val();

        terms      = $('#terms').val();
        notes      = $('#notes').val();
        preparedby = $('#preparedby').val();
        approvedby = $('#approvedby').val();


        var productname = [];

        $("select[name^='productname[]']")
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


        //  if (customer == "") {
        //     $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
        //    toastr.warning("Please Select Customer!");
        //               return false;
        //     return false;
        // } else {
        //     $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
        // }

        // if (reference == "") {
        //     $('#reference').addClass('is-invalid');
        //    toastr.warning("Please Add Reference!");
        //               return false;
        //     return false;
        // } else {
        //      $('#reference').removeClass('is-invalid');
        //  }
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
        url: "quotation_approved",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        customer      : $('#customer').val(),
        customer_id      : $('#customer_id').val(),
        unique_id      : $('#unique_id').val(),
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
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
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
        po_note:po_note,
        dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        invcustomer_id : $('#invcustomer_id').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        po_date : $('#po_date').val(),
               delivery_period : $('#delivery_period').val(),
        
   
        },
        success: function(data) {
       
        
             $('#quotation_approve').removeClass('kt-spinner');
             $('#quotation_approve').prop("disabled", false);
       
              window.location.href = "newSalesorder";
             toastr.success('Quotation Approved Successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});
$(document.body).on("change", "#customer", function() 
    {

        var cid = $(this).val();
        
        $.ajax({
        url: "getcustomeraddressquote",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:cid
        },
        dataType: "json",
        success: function(data) {
            console.log(data);
            var inv_address ='';
            var ship_address ='';
            var cust_phone ='';
          $.each(data, function(key, value) {
            
           inv_address =value.invoice_add1+' '+value.invoice_add2+' '+value.invoice_city+' '+value.invoice_country;

           ship_address =value.shipping1+' '+value.shipping2+' '+value.shipping_city+' '+value.invoice_country;

           cust_phone =value.mobile1;
           $('#cust_name').val(value.cust_name);
           $('#building_no').val(value.cust_add1);
           $('#cust_region').val(value.cust_add2);
           $('#cust_district').val(value.cust_region);
           $('#cust_city').val(value.cust_city);
           $('#cust_zip').val(value.cust_zip);
           $('#email').val(value.email1);
           $('#mobile').val(value.mobile1);
           $('#vatno').val(value.vatno);
           $('#buyerid_crno').val(value.buyerid_crno);
           $('#cust_category').val(value.cust_category).trigger('change');
           $('#cust_type').val(value.cust_type).trigger('change');
           $('#cust_group').val(value.cust_group).trigger('change');
           $('#cust_country').val(value.cust_country).trigger('change');




                        });

          $('#billing_address').val(inv_address);
          $('#shipping_address').val(ship_address);
          $('#contact_phone').val(cust_phone);

          

        }
    })
    });

