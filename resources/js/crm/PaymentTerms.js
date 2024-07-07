

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
        "url": 'paymentTerms',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'term', name: 'term' },
        { data: 'description', name: 'description' 
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
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text flaticon2-edit" data-id="' + row.id + '" >Edit</span>\
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

    var table = $('#paymentmenttrashs').DataTable({
        "dom": 'B<"top"f>rt<"bottom"lp>',
        "lengthMenu": [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        "buttons": [{
                extend: 'pageLength',
                className: 'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'copy',
                className: 'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'csv',
                className: 'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'excel',
                className: 'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'pdf',
                className: 'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                }
            },
            {
                extend: 'print',
                text: 'Print all (not just selected)',
                className: 'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
        ],
        "select": {
            style: 'os',
            selector: 'td:first-child'
        },
        select: true,
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": ['odd-row', 'even-row'],
        "order": [],

        "ajax": {
            "url": 'paymentTermstrashlists',
            "type": "POST",
            "data": function(data) {
                data._token = $('#token').val()
            }
        }


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
                        window.location.href = "paymentTerms";

                    }
                });
            } else {
                swal.fire("Cancelled", "Your Payment Terms Entry is  safe :)", "error");

            }
        })
    });

    $(document).on('click', '#payment_submit', function(){
    for (instance in CKEDITOR.instances) {
       CKEDITOR.instances[instance].updateElement();
    }
    
         term            = $('#term').val();
         description     = $('#description1').val();
        
        if (term  == "") {
        $('#term').addClass('is-invalid');
        return false;
        }
        else{
       $('term').removeClass('is-invalid');
        }
        if(description == "") {
           $('#description1').addClass('is-invalid');
           return false ;
         }
         else {
           $('#description1').removeClass('is-invalid');
         }
         $(this).addClass('kt-spinner');
         $(this).prop("disabled", true);
        $.ajax({
            type : "POST",
            url  : "PaymentSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        payment_id       : $('#id').val(),
                        term             : $('#term').val(),
                        description      : $('#description1').val(),
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
        $('#description1').val("").trigger('change');
    }

    $(document).on('click', '.closeBtn,.close', function() {
        closeModel();
    });


    $(document).on('click', '.paymentdetail_update', function() {

        var payment_id = $(this).attr("data-id");
        $.ajax({
            url: "getPaymentTerms",
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
                CKEDITOR.instances['description1'].setData(data['users'].description);
            }

        })
    });


    $(document).on('click', '#payment_terms', function() {

        CKEDITOR.instances['description1'].setData('');
    });

    $(document).on('click', '.kt_del_paymentinformation', function() {
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
                    url: 'deletePaymentInfo',
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
