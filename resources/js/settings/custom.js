 $(document).on('click', '#customfieldsubmit', function(e) {
    e.preventDefault();

        

     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Updated';
     } else{
        var sucess_msg ='Created';
     }
    

    $.ajax({
        type: "POST",
        url: "customfieldsubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
        labels : $('#labels').val(),
        },
        success: function(data) {
         
       
             $('#customfieldsubmit').removeClass('kt-spinner');
             $('#customfieldsubmit').prop("disabled", false);
            location.reload();
             window.location.href = "customefields";
             toastr.success('custom fields '+sucess_msg+' successfuly');
           

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});