var table = $('#vendorcreditdetails_list').DataTable({
        "dom"        : 'B<"top"f>rt<"bottom"lp>',
        "lengthMenu" : [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        "buttons": [
            {
             extend: 'pageLength',
             className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
             extend: 'copy',
             className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
              extend: 'csv',
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
              extend: 'excel',
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
              extend: 'pdf',
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
              exportOptions: {
                columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
              }
            },
            {
                extend: 'print',
                text: 'Print all (not just selected)',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
        ],
        "select": {
            style   :  'os',
            selector: 'td:first-child'
        },
        select: true,
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": [ 'odd-row', 'even-row' ],
        "order": [],

        "ajax": {
            "url" : 'VendorCreditList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }
    });
    $("#export-button-pdf").on("click", function () {
    $('body .buttons-pdf').trigger('click');
    });
    $("#export-button-print").on("click", function () {
    $('body .buttons-print').trigger('click');
    });
    $("#export-button-csv").on("click", function () {
    $('body .buttons-csv').trigger('click');
    });
    $("#export-button-copy").on("click", function () {
    $('body .buttons-copy').trigger('click');
    });

$(document).on('click', '.CreditDetail_add', function(){
           var user_id = $(this).attr("data-id");
           $.ajax({
              url       : "getCreditAdd",
                 method    : "POST",
                 data      : {
                       _token      : $('#token').val(),
                       user_id     : user_id
                     },
                 dataType  : "json",
                 success:function(data)
                  { 
                    $('#v_id').val(user_id);
                    $('#select_vendor').val(data['users'].vendor_name);
                    $('#id').val(data['vendor'].id);
                    $('#number_invoices').val(data['vendor'].number_invoices);
                     $('#total_amount').val(data['vendor'].total_amount);
                     $('#period').val(data['vendor'].period);
                     $('#penal_charges').val(data['vendor'].penal_charges);
                    $("#usersInformation").modal("hide");
                  }
                });
        $('#vendorCredit').show();
         });
$(document).on('click', '.close', function(){
     closeModel();
     function closeModel(){
      $("#vendorCredit").modal("hide");
      $('#total_amount').val("");
      $('#number_invoices').val("");
      $('#period').val("");
      $('#penal_charges').val("");
        }
  });
$(document).on('click', '#Creditdetail_submit', function(e){
      e.preventDefault();
      $(this).addClass('kt-spinner');
      $(this).prop( "disabled", true );
      $('#user-form').validate(  {
          rules: {
            select_customer : "required"
            },
          messages: {
            select_customer  : "Please specify Vendor Name"
          }
         });
        if (!$('#user-form').valid()) // check if form is valid
        {
            $(this).removeClass('kt-spinner');
            $(this).prop( "disabled", false );
            return false;
        }
        $.ajax({
            type : "POST",
            url  : "CreditInfo",
            dataType  : "json",
            data : {
                        _token               : $('#token').val(),
                        doc_id               : $('#id').val(),
                        v_id                 : $('#v_id').val(),
                        select_vendor        : $('#select_vendor').val(),
                        number_invoices      : $('#number_invoices').val(),
                        total_amount         : $('#total_amount').val(),
                        period               : $('#period').val(),
                        penal_charges        : $('#penal_charges').val(),
                    },
            success: function(data){
                swal.fire("Done", "Submission Sucessfully", "success");
                location.reload();
                window.location.href="vendorCreditLimits";
                closeModel();
                uppy.reset();
                $('#Creditdetail_submit').removeClass('kt-spinner');
                $('#Creditdetail_submit').prop( "disabled", false );
                $('#vendorcreditdetails_list_last').trigger('click');
                setTimeout(function() {
                $('#vendorcreditdetails_list_first').trigger('click');
                }, 3000);
            },
            error   : function ( jqXhr, json, errorThrown )
            {
                var errors = jqXhr.responseJSON;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    if(jQuery.isPlainObject( value )){
                      $.each(value, function( index, ndata ) {
                        errorsHtml += '<li>' + ndata + '</li>';
                      });
                    }else{
                    errorsHtml += '<li>' + value + '</li>';
                    }
                });
                $('#Creditdetail_submit').removeClass('kt-spinner');
                $('#Creditdetail_submit').prop( "disabled", false );
                $('#vendorcreditdetails_list').DataTable().ajax.reload();
                toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });
        return false;
    });

$(document).on('click', '.kt_del_Creditinformation', function (){
    var id = $(this).attr('id');
    swal.fire({
    title: "Are you sure?",
    text: "You will not be able to recover this Vendor Credit Details Entry!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel it!" }).then(result => {
    if(result.value){
        $.ajax({
              type: "POST",
              url : 'deleteCreditInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data){
                  swal.fire("Deleted!", "Your Vendor Credit Entry has been deleted.", "success");
                  location.reload();
             }
          });
          } else{
            swal.fire("Cancelled", "Your Vendor Credit Details Entry is safe :)", "error");
          }
        })
       });
