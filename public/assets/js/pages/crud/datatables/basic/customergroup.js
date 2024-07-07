var table = $('#customergroupdetails_list').DataTable({
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
            "url" : 'CustomergroupList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }
    });

$(document).on('click', '.close,.closeBtn', function(){

     closeModel();

  });
     function closeModel(){

      $("#kt_modal_4_5").modal("hide");
      $('#title').val("");
      $('#description').val("");
      $('#color').val("");

        }

$(document).on('click', '#Group_submit', function(e){
      e.preventDefault();
      $(this).addClass('kt-spinner');
      $(this).prop( "disabled", true );
         $('#group-form').validate(  {
          rules: {
            title : "required",
            },
          messages: {
            title  : "Please specify your Customer Title",
          }

         });


        if (!$('#group-form').valid()) // check if form is valid
        {
            $(this).removeClass('kt-spinner');

            $(this).prop( "disabled", false );
            return false;

        }

       
        $.ajax({
            type : "POST",
            url  : "CustGroupinfo",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        info_id          : $('#id').val(),
                        title            : $('#title').val(),
                        description      : $('#description').val(),
                        color            : $('#color').val()
                       

                       
                    },
            success: function(data){

                  closeModel();

                  swal.fire("Done", "Submission Sucessfully", "success");
                  location.reload();
                  window.location.href="customergroup";

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

                //for spinner button reactive
                $('#Customerdetail_submit').removeClass('kt-spinner');

                $('#Customerdetail_submit').prop( "disabled", false );
                //end for spinner button reactive

                $('#customergroupdetails_list').DataTable().ajax.reload();
                toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });

        return false;

    });



$(document).on('click', '.Groupupdate', function(){

           var info_id = $(this).attr("data-id");
           $.ajax({
                url       : "getgroupupdate",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      info_id     : info_id
                    },
                dataType  : "json",
                success:function(data)
                {
                     $('#title').val(data['users'].title);
                     $('#description').val(data['users'].description);
                     
                     $('#color').val(data['users'].color);
                     $('#id').val(info_id);
                     
                     $("#usersInformation").modal("hide");
                   
                }
           })
      });


$(document).on('click', '.kt_del_groupinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Group Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deletegroup',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Group Entry has been deleted.", "success");
             location.reload();

             }
          });
          } else {
            swal.fire("Cancelled", "Your    Category   Entry is safe :)", "error");

          }
        })
       });


$(document).on('click', '.grouprestoredetails', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Customer Group Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'grouptrashrestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Customer Group Entry has been deleted.", "success");
                window.location.href="customergroup";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Customer Entry is safe :)", "error");

          }
        })
     });

var table = $('#trashgroupdetails').DataTable({
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
            "url" : 'Grouptrashlist',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }
    });
