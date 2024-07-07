var table = $('#vendordetails_list').DataTable({
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
            "url" : 'vendorList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }

    });

var table = $('#vendordetailstrash_list').DataTable({
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
            "url" : 'vendortrashList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }

    });


$(document).on('click', '#vendor_submit', function(e){

    
        var contact_personcharges=[];
        var mobiles=[];
        var offices=[]; 
        var emails=[];
        var departments=[]; 
        var locations=[];

        $(".addmore").each(function() {
         contact_personcharges.push($(this).find(".contact_personcharges").val());
         mobiles.push($(this).find(".mobiles").val());
         offices.push($(this).find(".offices").val()); 
         emails.push($(this).find(".emails").val());
         departments.push($(this).find(".departments").val());
         locations.push($(this).find(".locations").val());
        });


        // $(".add").each(function() {
        //    contact_person_incharges.push($(this).find(".contact_personvalue").val());
        //    mobiles.push($(this).find(".mobiles").val());
        //    offices.push($(this).find(".offices").val()); 
        //    emails.push($(this).find(".emails").val());
        //    departments.push($(this).find(".departments").val());
        //    locations.push($(this).find(".locations").val());

        //  });
        // alert($("input[name='add']").val());

        $.ajax({
            type : "POST",
            url  : "VendorSubmit",
            dataType  : "json",
            data : {
                        _token             : $('#token').val(),
                        vendor_id          : $('#id').val(),
                        vendor_code        : $('#vendor_code').val(),
                        vendor_type        : $('#vendor_type').val(),
                        vendor_category    : $('#vendor_category').val(),
                        salesman           : $('#salesman').val(),
                        key_account        : $('#key_account').val(),
                        vendor_name        : $('#vendor_name').val(),
                        contact_person     : $('#contact_person').val(),

                        vendor_add1        : $('#vendor_add1').val(),
                        vendor_add2        : $('#vendor_add2').val(),
                        vendor_country     : $('#vendor_country').val(),
                        vendor_region      : $('#vendor_region').val(),
                        vendor_city        : $('#vendor_city').val(),
                        vendor_zip         : $('#vendor_zip').val(),
                        email1             : $('#email1').val(),
                        email2             : $('#email2').val(),
                        office_phone1      : $('#office_phone1').val(),
                        office_phone2      : $('#office_phone2').val(),
                        mobile1            : $('#mobile1').val(),
                        mobile2            : $('#mobile2').val(),
                        fax                : $('#fax').val(),
                        website            : $('#website').val(),
                        contact_persons     : $('#contact_persons').val(),
                        mobile             : $('#mobile').val(),
                        office             : $('#office').val(),
                        contact_department : $('#contact_department').val(),
                        email              : $('#email').val(),
                        location           : $('#location').val(),
                        invoice_add1       : $('#invoice_add1').val(),
                        invoice_add2       : $('#invoice_add2').val(),
                        shipping1          : $('#shipping1').val(),
                        shipping2          : $('#shipping2').val(),
                        portal             : $('#portal').val(),
                        username           : $('#username').val(),
                        registerd_email    : $('#registerd_email').val(),
                        password           : $('#password').val(),
                        contact_person_incharges  :contact_personcharges,
                        mobiles         :mobiles,
                        offices         :offices,
                        emails          :emails,
                        departments     :departments,
                        locations       :locations
                      
                        

                    },
            success: function(data){
                  swal.fire("Done", "Submission Sucessfully", "success");
                  location.reload();
                  window.location.href="vendors";
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
               toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });
        return false;
    });
    
  
   $(document).on('click', '.kt_del_vendorinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Vendor Details Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deleteVendorInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Vendor Entry has been deleted.", "success");
                  location.reload();
             }
          });
          } else {

            swal.fire("Cancelled", "Your Vendor Details Entry is safe :)", "error");
          }
        })
       });
     
 $.reloadTable = function()
    {
        table.ajax.reload();
    };

   
$(document).on('click', '.Vendordetail_update', function(){
           var user_id = $(this).attr("data-id");
           $.ajax({
                url       : "getVendordetailsInfo",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      user_id     : user_id
                    },
                dataType  : "json",
                success:function(data)
                {
                	 $('#id').val(vendor_id);
                     $('#password').val(data['vendors'].password);
                     $('#registerd_email').val(data['vendors'].registerd_email);
                     $('#username').val(data['vendors'].username);
                     $('#portal').val(data['vendors'].portal);
                     $('#shipping2').val(data['vendors'].shipping2);
                     $('#shipping1').val(data['vendors'].shipping1);
                     $('#invoice_add2').val(data['vendors'].invoice_add2);
                     $('#invoice_add1').val(data['vendors'].invoice_add1);
                     $('#location').val(data['vendors'].location);
                     $('#email').val(data['vendors'].email);
                     $('#contact_department').val(data['vendors'].contact_department);
                     $('#office').val(data['vendors'].office);
                     $('#mobile').val(data['vendors'].mobile);
                     $('#contact_person_incharge').val(data['vendors'].contact_person_incharge);
                     $("#usersInformation").modal("hide");
                     $('#contact_person').val(data['vendors'].contact_person);
                     $('#website').val(data['vendors'].website);
                     $('#fax').val(data['vendors'].fax);
                     $('#mobile2').val(data['vendors'].mobile2);
                     $('#mobile1').val(data['vendors'].mobile1);
                     $('#office_phone2').val(data['vendors'].office_phone2);
                     $('#office_phone1').val(data['vendors'].office_phone1);
                     $('#email2').val(data['vendors'].email2);
                     $('#email1').val(data['vendors'].email1);
                     $('#vendor_zip').val(data['vendors'].vendor_zip);
                     $('#vendor_city').val(data['vendors'].vendor_city);
                     $('#vendor_region').val(data['vendors'].vendor_region);
                     $('#vendor_country').val(data['vendors'].vendor_country);
                     $('#vendor_add2').val(data['vendors'].vendor_add2);
                     $('#vendor_add1').val(data['vendors'].vendor_add1);
                     $('#vendor_name').val(data['vendors'].vendor_name);
                     $('#key_account').val(data['vendors'].key_account);
                     $('#salesman').val(data['vendors'].salesman);
                     $('#vendor_category').find(":selected").text();
                     $('#vendor_type').find(":selected").text();
                    $('#vendor_code').find(":selected").text();
                }
           })
      });


     
 $.reloadTable = function()
    {
        table.ajax.reload();
    };
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

