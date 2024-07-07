

/**
 *Datatable for customer Information
 */

var termsconditions_list_table = $('#termsconditions_list').DataTable({
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
                columns: [0, 1]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            },
            pageSize: 'A4',
            orientation: 'landscape',
            customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '50%',  '50%'];
                       }
        },
        {
            extend: 'print',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            }
        }
    ],

    ajax: {
        "url": 'settingstermsconditions',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'term', name: 'term' },
       
           /*   {
              data: 'description',
              name: 'description',
              render: function(data, type, row) {
                //  return  row.description;
                   return $("<div/>").html(row.description).text();
              }
          },*/


        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav"> <a href="settingsTermsView?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                         <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#termsandconditions"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text termsdetail_update" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_termsinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';

            }
        },

    ]
});

    var termstrashs_list_table = $('#termstrashs').DataTable({
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
                columns: [0, 1]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
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
                columns: [0, 1]
            }
        }
    ],

    ajax: {
        "url": 'settingstermstrashdetails',
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
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                        <span class="kt-nav__link-text termsdetail_restore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';

            }
        },

    ]
});

    $(document).on('click', '.termsdetail_restore', function() {
        var id = $(this).attr("data-id");
        swal.fire({
            title: "Are you sure?",
            text: "You will be able to recover this Entry!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Restore it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'settingstermsTrashRestore',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {

                        swal.fire("Restored!", "Your Terms has been restored.", "success");
                        window.location.href = "settingstermsconditions";

                    }
                });
            } else {
                swal.fire("Cancelled", "Your Entry is  safe", "error");

            }
        })
    });

    $(document).on('click', '#terms_submit', function(){
   
    
        term           = $('#term').val();
        // description     = tinyMCE.activeEditor.getContent();
        
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
            url  : "settingstermsSubmit",
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
            $('#terms_submit').removeClass('kt-spinner');
            $('#terms_submit').prop("disabled", false);
             toastr.success('Terms name is already exist');

          }
          else
          {
            $('#terms_submit').removeClass('kt-spinner');
            $('#terms_submit').prop("disabled", false);
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

        $("#termsandconditions").modal("hide");
        $('#term').val("");
        $('#id').val("");
         tinyMCE.activeEditor.setContent('');
        $('#description1').val("").trigger('change');
    }

    $(document).on('click', '.closeBtn,.close', function() {
        closeModel();
    });


    $(document).on('click', '.termsdetail_update', function() {

        var term_id = $(this).attr("data-id");
        $.ajax({
            url: "settingsgetTermsconditions",
            method: "POST",
            data: {
                _token: $('#token').val(),
                term_id: term_id
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


    $(document).on('click', '#termsandconditions', function() {

        CKEDITOR.instances['description1'].setData('');
    });

    $(document).on('click', '.kt_del_termsinformation', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Entry!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: 'settingsdeletetermsInfo',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {
                        console.log(data);
                        // table.ajax.reload();
                        if(data == '1')
                        {
                            swal.fire("Not Deleted!", "Terms and Condition is already used.", "success");
                            location.reload();
                        }
                        else
                        {
                        swal.fire("Deleted!", "Your Entry has been deleted.", "success");
                        termsconditions_list_table.ajax.reload();
                        }
                    }
                });
            } else {
                swal.fire("Cancelled", "Your Entry is safe ", "error");
            }
        })
    });
