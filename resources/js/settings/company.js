$(document).on('click', '#company_submit', function(e) {
 alert("ad");
    e.preventDefault();

        company_name = $('#company_name').val();
        company_cr         = $('#company_cr').val();
        company_vat        = $('#company_vat').val();
       

        if (company_name == ""){
            $('#company_name').addClass('is-invalid');
            return false;
        }else{
            $('#company_name').removeClass('is-invalid');
        }

        if (company_cr == "") {
            $('#company_cr').addClass('is-invalid');
            return false;
        } else {
             $('#company_cr').removeClass('is-invalid');
         }

        if (company_vat == "") {
            $('#company_vat').addClass('is-invalid');
            return false;
        } else {
            $('#company_vat').removeClass('is-invalid');
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
        url: "settingscompanysubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            company_name  : $('#company_name').val(),
            company_cr    : $('#company_cr').val(),
            company_vat   : $('#company_vat').val(),
            streetname  : $('#streetname').val(),
            district    : $('#district').val(),
            city   : $('#city').val(),
            cust_country : $('#cust_country').val(),
            postalcode : $('#postalcode').val(),
            preview       : $('input[name="preview"]:checked').val(),
            common_customer_database: $('input[name="common_customer_database"]:checked').val(),
            branch        : $("#branch").val(),
            storeavailable: $('input[name="storeavailable"]:checked').val(),
            pdfletterheader_top  : $('#pdfletterheader_top').val(),
            pdfletterfooter_bottom  : $('#pdfletterfooter_bottom').val(),
            pdfheader_top  : $('#pdfheader_top').val(),
            pdffooter_bottom  : $('#pdffooter_bottom').val(),

            salesquotation  : $('#salesquotation').val(),
            salesorder    : $('#salesorder').val(),
            deliveryorder   : $('#deliveryorder').val(),
            purchaseorder       : $('#purchaseorder').val(),
            proformainvoice: $('#proformainvoice').val(),
            salesinvoice        : $("#salesinvoice").val(),
            salesreturn: $('#salesreturn').val(),
            purchasereturn  : $('#purchasereturn').val(),
            debitnote  : $('#debitnote').val(),
            creditnote  : $('#creditnote').val(),
            advancerequest  : $('#advancerequest').val(),
            paymentrequest  : $('#paymentrequest').val(),
            advancereceipt  : $('#advancereceipt').val(),
            paymentreceipt  : $('#paymentreceipt').val(),




        },
        success: function(data) {
            console.log(data);
             $('#company_submit').removeClass('kt-spinner');
             $('#company_submit').prop("disabled", false);
              window.location.href = "company";
             toastr.success('Company Settings '+sucess_msg+' successfuly');
             
        

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});
