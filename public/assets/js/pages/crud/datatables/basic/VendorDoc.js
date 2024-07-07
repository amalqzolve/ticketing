     $(document).on('click', '#Docdetail_submit', function(e){

      //for spinner button
      e.preventDefault();

      $(this).addClass('kt-spinner');
      $(this).prop( "disabled", true );
      //end spinner

         $('#user-form').validate(  {
          rules: {
            name : "required"
            },
          messages: {
            name  : "Please specify Vendor Name"
          }

         });


        if (!$('#user-form').valid()) // check if form is valid
        {
            //for spinner button reactive
            $(this).removeClass('kt-spinner');

            $(this).prop( "disabled", false );
            //end for spinner button reactive
            return false;

        }
        //console.log();

        //alert($("input[name='addmore']").val());

        $.ajax({
            type : "POST",
            url  : "docInfo",
            dataType  : "json",
            data : {
                        _token          : $('#token').val(),
                        doc_id          : $('#id').val(),
                        name            : $('#v_name').val(),
                        title            : $('#title').val(),
                        
                        description     : $('#description').val(),
                        fileData        : $('#fileData').val(),
                        UniqueID         : $('#UniqueID').val()

                    },

            success: function(data){
                 swal.fire("Done", "Submission Sucessfully", "success");
                  location.reload();
                  window.location.href="vendordocuments";

                  closeModel();

                  uppy.reset();

                  //for spinner button
                  $('#Docdetail_submit').removeClass('kt-spinner');

                  $('#Docdetail_submit').prop( "disabled", false );
                //end for spinner button

                $('#vendordocdetails_list_last').trigger('click');

                setTimeout(function() {
                $('#vendordocdetails_list_list_first').trigger('click');
                }, 3000);

                  //table.ajax.reload();

                 

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
                $('#Docdetail_submit').removeClass('kt-spinner');

                $('#Docdetail_submit').prop( "disabled", false );
                //end for spinner button reactive

                $('#vendordocdetails_list').DataTable().ajax.reload();
                toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });

        return false;

    });

     var table = $('#vendordocdetails_list').DataTable({
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
            "url" : 'docList',
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

     var table = $('#vendordoctrashdetails_list').DataTable({
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
            "url" : 'DoctrashList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });

     $(document).on('click', '.DocDetail_update', function(){

           var user_id = $(this).attr("data-id");
           $.ajax({
                url       : "getDocInfo",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      user_id     : user_id
                    },
                dataType  : "json",
                success:function(data)
                {
                     $('#name').val(data['users'].name);
                     $('#description').val(data['users'].description);
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
                        // assuming the image lives on a server somewhere
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
     
     
     $(document).on('click', '.DocDetail_add', function(){

           var user_id = $(this).attr("data-id");
           $.ajax({
              url       : "getDocAdd",
                 method    : "POST",
                 data      : {
                       _token      : $('#token').val(),
                       user_id     : user_id
                     },
                 dataType  : "json",
                 success:function(data)
      //           // console.log(data);
{
 console.log(data);
         // alert(user_name);
            $('#v_id').val(user_id);
            $('#v_name').val(data['users'].vendor_name);
}
});
         

   $('#kt_modal_4_2').show();
           


         });
      //      $.ajax({
      //           url       : "getDocAdd",
      //           method    : "POST",
      //           data      : {
      //                 _token      : $('#token').val(),
      //                 user_name     : user_name
      //               },
      //           dataType  : "json",
      //           success:function(data)
      //           // console.log(data);

      //           {
      //                $('#name').val(user_name);
      //                $('#description').val();
      //                   $('#title').val();
                     
      //                $('#UniqueID').val();
      //                $('#fileData').val();
      //                $("#usersInformation").modal("hide");



      //               // $.each(data['addMore'], function( index, value ) {

      //               //   if(index==0){

      //               //     $('.addmore').find(".skill").val(value['skill']);
      //               //     $('.addmore').find(".skillValue").val(value['value']);

      //               //   }else{


      //               //    $('#table-more').append('<tr id="row'+index+'" class="dynamic-added addmore subadmore">\
      //               //     <td>\
      //               //     <input type="text" value="'+value['skill']+'" name="skill['+index+']" placeholder="Skill" class="skill form-control name_list" />\
      //               //     </td>\
      //               //     <td>\
      //               //     <input type="text" value="'+value['value']+'" name="skillValue['+index+']" placeholder="Value" class="skillValue form-control name_list" />\
      //               //     </td>\
      //               //     <td>\
      //               //     <button type="button" name="remove" id="'+index+'" class="btn btn-danger btn_remove">X</button>\
      //               //     </td>\
      //               //     </tr>');
      //               //   }

      //               // });


      //                if($('#fileData').val()!='')
      //                {
      //                  var img_array = $('#fileData').val().split(",");

      //                  $.each(img_array,function(i){
      //                      onImageClicked(img_array[i]);
      //                  });
      //                }

      //                 function onImageClicked (img) {

      //                   var str = img.toString();
      //                   var n = str.lastIndexOf('/');
      //                   var img_name = str.substring(n + 1);
      //                   // assuming the image lives on a server somewhere
      //                   return fetch(img)
      //                     .then((response) => response.blob()) // returns a Blob
      //                     .then((blob) => {
      //                       uppy.addFile({
      //                         name: img_name,
      //                         type: 'image/jpeg',
      //                         data: blob
      //                       })
      //                    })
      //                 }
      //           }
      //      })
      // });
     
     $(document).on('click', '.kt_del_Docinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Vendor Document Details Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deleteDocInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Vendor Document Entry has been deleted.", "success");
                  location.reload();
             }
          });
          } else {

            swal.fire("Cancelled", "Your Vendor Document Details Entry is safe :)", "error");
          }
        })
       });
      






