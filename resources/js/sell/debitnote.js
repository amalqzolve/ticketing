$(document).on('click', '#debitnote_update', function(e) {
    e.preventDefault();

        salesman      = $('#salesman').val();
        

         if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Salesman!");
                      return false;
   
        } else {
            $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
        }

        var item_id = [];

        $("input[name^='item_id[]']")
        .each(function(input) {
            item_id.push($(this).val());
        });

        var description = [];

        $("textarea[name^='description[]']")
        .each(function(input) {
            description.push($(this).val());
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
        url: "debitnotesubmit_sell",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        invoiceid            : $('#invoiceid').val(),
        debitdate :$('#debitdate').val(),
        reason : $('#reason').val(),
        quotedate     : $('#quotedate').val(),
        valid_till      : $('#valid_till').val(),
        method : $('#method').val(),
        qtn_ref : $('#qtn_ref').val(),
        po_ref : $('#po_ref').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        currency      : $('#currency').val(),
        currencyvalue : $('#currency_value').val(),
        payment_terms : $('#payment_terms').val(),
        discount_type : $('#discount_type').val(),
        notes      : $('#notes').val(),
        internal_reference      : $('#internal_reference').val(),
        terms      : $('#terms').val(),
        tpreview : tinymce.get("kt-tinymce-4").getContent(),
        
        totalamount         : $('#totalamount').val(),
        discount            : $('#discount').val(),
        amountafterdiscount : $('#amountafterdiscount').val(),
        totalvatamount      : $('#totalvatamount').val(),
        grandtotalamount    : $('#grandtotalamount').val(),

        customer      : $('#customer').val(),
        
        item_id : item_id,
        description : description,
        unit : unit,
        quantity : quantity,
        rate : rate,
        amount : amount,
        vatamount : vatamount,    
        rdiscount : rdiscount, 
        vat_percentage : vat_percentage,     
        row_total : row_total,

        

        },
        success: function(data) {
       
        
             //$('#debitnote_update').removeClass('kt-spinner');
              window.location.href = "debitnote_sell";
             toastr.success('Debit'+sucess_msg+' successfuly');
             $('#debitnote_update').prop("disabled", false);
            

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