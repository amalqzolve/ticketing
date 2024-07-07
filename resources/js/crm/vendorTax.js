$(document).on('click', '#Taxdetail_submit', function(e){
      e.preventDefault();
      $(this).addClass('kt-spinner');
      $(this).prop( "disabled", true );
         $('#user-form').validate({
          rules: {
                  vat_no : "required"
                 },
          messages: {
                    vat_no  : "Please specify your vat Number"
                    }
           });
        if(!$('#user-form').valid()) 
         {
          $(this).removeClass('kt-spinner');
          $(this).prop( "disabled", false );e
            return false;
          }
        $.ajax({
            type : "POST",
            url  : "taxInfo",
            dataType  : "json",
            data : {
                      _token      : $('#token').val(),
                      tax_id      : $('#id').val(),
                      vat_no      : $('#vat_no').val(),
                      vat_name    : $('#vat_name').val(),
                      fileData    : $('#fileData').val(),
                      UniqueID    : $('#UniqueID').val()
                    },
            success: function(data){
                 swal.fire("Done", "Submission Sucessfully", "success");
                  location.reload();
                  window.location.href="vendortaxdetails";
                  closeModel();
                  uppy.reset(); button
                  $('#Taxdetail_submit').removeClass('kt-spinner');
                  $('#Taxdetail_submit').prop( "disabled", false );
                  $('#taxdetails_list_last').trigger('click');
                setTimeout(function() {
                $('#taxdetails_list_first').trigger('click');
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
                $('#Taxdetail_submit').removeClass('kt-spinner');
                $('#Taxdetail_submit').prop( "disabled", false );
                $('#taxdetails_list').DataTable().ajax.reload();
                toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });
        return false;
    });

var table = $('#taxdetails_list').DataTable({
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
            "url" : 'taxList',
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
var table = $('#taxdetailstrash_list').DataTable({
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
            "url" : 'taxtrashList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }
});
$(document).on('click', '.TaxDetail_update', function(){
        var user_id = $(this).attr("data-id");
           $.ajax({
                url       : "getTaxInfo",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      user_id     : user_id
                    },
                dataType  : "json",
                success:function(data)
                {
                     $('#vat_no').val(data['users'].vat_no);
                     $('#vat_name').val(data['users'].vat_name);
                     $('#id').val(user_id);
                     $('#UniqueID').val(data['users'].uniqueid);
                     $('#fileData').val(data['users'].file_data);
                     $("#usersInformation").modal("hide");
                     if($('#fileData').val()!='')
                     {
                       var img_array = $('#fileData').val().split(",");

                       $.each(img_array,function(i){
                           onImageClicked(img_array[i]);
                       });
                     }
                      function onImageClicked (img) {
                        var str = img.toString();
                        var n = str.lastIndexOf('/');
                        var img_name = str.substring(n + 1);
                        return fetch(img)
                          .then((response) => response.blob()) // returns a Blob
                          .then((blob) => {
                            uppy.addFile({
                              name: img_name,
                              type: 'image/jpeg',
                              data: blob
                            })
                         })
                      }
                }
           })
});
$(document).on('click', '.kt_del_Taxinformation', function () {
        var id = $(this).attr('id');
        swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Vendor Tax Details Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {
        $.ajax({
              type: "POST",
              url : 'deleteTaxInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Deleted!", "Your Vendor Tax Entry has been deleted.", "success");
                  location.reload();
             }
          });
          } else{
            swal.fire("Cancelled", "Your Vendor Tax Details Entry is safe :)", "error");
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
    $(document).on('click', '.VendorTaxDetail_restore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Vendor Tax Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'VendorTaxRestoreTrash',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Vendor Tax Entry has been Restored.", "success");
                window.location.href="vendortaxdetails";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Vendor Tax Entry is not safe :)", "error");

          }
        })
     });
      






