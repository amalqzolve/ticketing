

/**
 *Datatable for customer Information
 */

var payment_list_table = $('#payment_list').DataTable({
    processing: true,
    serverSide: true,
      scrollX: true,
    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],

    buttons: [{
            extend: 'copy',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            },
            pageSize: 'A4',
            orientation: 'landscape',
            customize: function(doc) {
                doc.pageMargins = [50, 50, 50, 50];
            }
        },
        {
            extend: 'print',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        }
    ],

    ajax: {
        "url": 'settingspaymentTerms',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'term', name: 'term' },
          {
              data: 'description',
              name: 'description',
              render: function(data, type, row) {
                //  return  row.description;
                   return $("<div/>").html(row.description).text();
              }
          },
        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                         <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#payment_terms"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text paymentdetail_update" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_paymentinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';

            }
        },

    ]
});


var paymenttrash_list_table = $('#paymentmenttrashs').DataTable({
    processing: true,
    serverSide: true,
    pagingType: "full_numbers",
    dom: 'Blfrtip',
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],

    buttons: [{
            extend: 'copy',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            },
            pageSize: 'A4',
            orientation: 'landscape',
            customize: function(doc) {
                doc.pageMargins = [50, 50, 50, 50];
            }
        },
        {
            extend: 'print',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        }
    ],

    ajax: {
        "url": 'settingspaymentmenttrashdetails',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'term', name: 'term' },
            {
              data: 'description',
              name: 'description',
              render: function(data, type, row) {
                //  return  row.description;
                   return $("<div/>").html(row.description).text();
              }
          },
        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                         <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#payment_terms"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                        <span class="kt-nav__link-text paymentdetail_restore" data-id="' + row.id + '" >Restore</span>\
                        </span></li></a>\
                       </ul></div></div></span>';

            }
        },

    ]
});

 

    $(document).on('click', '.paymentdetail_restore', function() {
        var id = $(this).attr("data-id");
        swal.fire({
            title: "Are you sure?",
            text: "You will be able to recover this payment Entry!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Restore it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'paymentTrashRestore',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Restored!", "Your Payment Terms has been restored.", "success");
                        window.location.href = "crm";

                    }
                });
            } else {
                swal.fire("Cancelled", "Your Payment Terms Entry is  safe :)", "error");

            }
        })
    });

    $(document).on('click', '#payment_submit', function(){
  
    
         term            = $('#term').val();
         description     = tinyMCE.activeEditor.getContent();
          
        // alert(tinyMCE.activeEditor.getContent());
        if (term  == "") {
        $('#term').addClass('is-invalid');
        return false;
        }
        else{
       $('term').removeClass('is-invalid');
        }
        // if(description == "") {
        //    $('#kt-tinymce-4').addClass('is-invalid');
        //    return false ;
        //  }
        //  else {
        //    $('#kt-tinymce-4').removeClass('is-invalid');
        //  }
         $(this).addClass('kt-spinner');
         $(this).prop("disabled", true);
        $.ajax({
            type : "POST",
            url  : "settingsPaymentSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        payment_id       : $('#id').val(),
                        term             : $('#term').val(),
                        description      : tinyMCE.activeEditor.getContent(),
                        branch           : $('#branch').val()
                    },
            success: function(data){
          if(data == false)
          {
            $('#payment_submit').removeClass('kt-spinner');
            $('#payment_submit').prop("disabled", false);
             toastr.success('Payment terms name is already exist');

          }
          else
          {
            $('#payment_submit').removeClass('kt-spinner');
            $('#payment_submit').prop("disabled", false);
                  closeModel();


                  swal.fire("Done", "Submission Sucessfully", "success");
                  location.reload();
          }
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


    function closeModel() {

        $("#payment_terms").modal("hide");
        $('#term').val("");
        $('#id').val("");
        // $('#description1').val("").trigger('change');
    }

    $(document).on('click', '.closeBtn,.close', function() {
        closeModel();
    });


    $(document).on('click', '.paymentdetail_update', function() {

        var payment_id = $(this).attr("data-id");
        $.ajax({
            url: "settingsgetPaymentTerms",
            method: "POST",
            data: {
                _token: $('#token').val(),
                payment_id: payment_id
            },
            dataType: "json",

            success: function(data) {
                 console.log(data);
                $('#term').val(data['users'].term);
                $('#id').val(data['users'].id);
                tinymce.activeEditor.setContent(data['users'].description);

            }

        })
    });

/**
 *Payment terms DataTable Export
 */

$("#payment_print").on("click", function() {
    payment_list_table.button('.buttons-print').trigger();
});


$("#payment_copy").on("click", function() {
    payment_list_table.button('.buttons-copy').trigger();
});

$("#payment_csv").on("click", function() {
    payment_list_table.button('.buttons-csv').trigger();
});

$("#payment_pdf").on("click", function() {
    payment_list_table.button('.buttons-pdf').trigger();
});

/**
 *Payment terms trash DataTable Export
 */

$("#payment_print").on("click", function() {
    paymenttrash_list_table.button('.buttons-print').trigger();


$("#payment_copy").on("click", function() {
    paymenttrash_list_table.button('.buttons-copy').trigger();
});

$("#payment_csv").on("click", function() {
    paymenttrash_list_table.button('.buttons-csv').trigger();
});

$("#paymentt_pdf").on("click", function() {
    paymenttrash_list_table.button('.buttons-pdf').trigger();
});


    // $(document).on('click', '#payment_terms', function() {

    //     tinymce.activeEditor.setContent('');
    // });

    $(document).on('click', '.kt_del_paymentinformation', function() {
       alert("a");
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Payment Entry!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: 'settingsdeletePaymentInfo',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {
                        // table.ajax.reload();
                        swal.fire("Deleted!", "Your Payment Entry has been deleted.", "success");
                        payment_list_table.ajax.reload();
                    }
                });
            } else {
                swal.fire("Cancelled", "Your Payroll  Master Entry is safe :)", "error");
            }
        })
    });
});