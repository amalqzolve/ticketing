$(document).on('click', '#generate_salesreport', function(e) {
    e.preventDefault();
    var startdate  = $('#start_date').val();
    var enddate    = $('#end_date').val();
  
      if (startdate == "") {
            $('#start_date').addClass('is-invalid');
            return false;
        } else {
            $('#start_date').removeClass('is-invalid');
        }
     if (enddate == "") {
            $('#end_date').addClass('is-invalid');
            return false;
        } else {
            $('#end_date').removeClass('is-invalid');
        }
    $.ajax({
        type: "POST",
        url: "salesreportgenerate",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            
            startdate  : $('#start_date').val(),
            enddate    : $('#end_date').val(),

        },
        success: function(data) {
            // uppy.reset();
           
         
           
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