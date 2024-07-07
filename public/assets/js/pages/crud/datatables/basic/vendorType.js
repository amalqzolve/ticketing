
var table = $('#vendortypetrashdetails_list').DataTable({
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
            "url" : 'vendortypetrashList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }

    });


var table = $('#vendortypedetails_list').DataTable({
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
            "url" : 'VendortypeList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }

    });

$(document).on('click', '.Vendortypedetail_update', function(){

           var info_id = $(this).attr("data-id");
           $.ajax({
                url       : "getvendortype",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      info_id     : info_id
                    },
                dataType  : "json",
                success:function(data)
                {
                     $('#vendor_type').val(data['users'].vendor_type);
                     $('#description').val(data['users'].description);
                     $('#color').val(data['users'].color);
                     
                     $('#id').val(info_id);
                     
                     $("#usersInformation").modal("hide");
                   
                }
           })
      });

  
    $(document).on('click', '#VendorType_submit', function(e){
      e.preventDefault();
        $.ajax({
            type : "POST",
            url  : "VendorTypeSubmit",
            dataType  : "json",
            data : {
                        _token             : $('#token').val(),
                        vendor_type    : $('#vendor_type').val(),
                        vendor_id          : $('#id').val(),
                        description        : $('#description').val(),
                        color              : $('#color').val(),
                        
                    },
            success: function(data){
                  swal.fire("Done", "Submission Sucessfully", "success");
                  location.reload();
                  window.location.href="vendortypedetails";
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
     
 $.reloadTable = function()
    {
        table.ajax.reload();
    };

    $(document).on('click', '.kt_del_vendortypeinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Vendor Type Details Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deleteVendorType',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Vendor Type Entry has been deleted.", "success");
                  location.reload();
             }
          });
          } else {

            swal.fire("Cancelled", "Your Vendor TYpe Details Entry is safe :)", "error");
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

