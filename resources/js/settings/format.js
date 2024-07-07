$(document).on('click', '#format_submit', function(e) {
  // alert("ad");
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
        url: "settingsformatsubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
           
            branch        : $("#branch").val(),
          

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


            salesquotation_sufix  : $('#salesquotation_sufix').val(),
            salesorder_sufix    : $('#salesorder_sufix').val(),
            deliveryorder_sufix   : $('#deliveryorder_sufix').val(),
            purchaseorder_sufix       : $('#purchaseorder_sufix').val(),
            proformainvoice_sufix: $('#proformainvoice_sufix').val(),
            salesinvoice_sufix      : $("#salesinvoice_sufix").val(),
            salesreturn_sufix: $('#salesreturn_sufix').val(),
            purchasereturn_sufix  : $('#purchasereturn_sufix').val(),
            debitnote_sufix : $('#debitnote_sufix').val(),
            creditnote_sufix  : $('#creditnote_sufix').val(),
            advancerequest_sufix  : $('#advancerequest_sufix').val(),
            paymentrequest_sufix  : $('#paymentrequest_sufix').val(),
            advancereceipt_sufix  : $('#advancereceipt_sufix').val(),
            paymentreceipt_sufix  : $('#paymentreceipt_sufix').val(),





        },
        success: function(data) {
            console.log(data);
             $('#format_submit').removeClass('kt-spinner');
             $('#format_submit').prop("disabled", false);
              window.location.href = "formatsettings";
             toastr.success('Format Settings '+sucess_msg+' successfuly');
             
        

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});
