    /*******************************************************************************
     * Detail : User Information data listing
     * Date   : 24-04-2020                                                         *
     *******************************************************************************/



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function() {

  closeModel();


  jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});




const uppy = Uppy.Core({
    autoProceed: false,
    allowMultipleUploads: true,
    meta: {
            UniqueID       : $('#UniqueID').val()
        },
    onBeforeUpload   : (files) => {
                      fileData           = [];
                      const updatedFiles = {};

                      Object.keys(files).forEach(fileID => {
                            fileData.push('userInfoData/'+$('#UniqueID').val()+'/'+files[fileID].name )
                      });
                      //return updatedFiles
                      $('#fileData').val(fileData);


                    },

});

uppy.use(Uppy.Dashboard, {
   metaFields: [
    { id: 'name', name: 'Name', placeholder: 'File name' },
    { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
  ],
  browserBackButtonClose: true,
  target: '#choose-files',
  inline: true,
  replaceTargetContent: true,
});

uppy.use(Uppy.GoogleDrive,
  { target: Uppy.Dashboard,
   companionUrl: 'https://companion.uppy.io'
  });

uppy.use(Uppy.Webcam, { target: Uppy.Dashboard });

uppy.use(Uppy.XHRUpload, {
  endpoint: 'FileUpload',
  UniqueID       : $('#UniqueID').val(),
  fieldName: 'filenames[]',
    headers: {
        'X-CSRF-TOKEN': $('#token').val(),
         UniqueID       : $('#UniqueID').val()
    }
});




$('#kt_modal_4_2').on('shown.bs.modal', function (e) {

var reference_tag = $(e.relatedTarget);

   //console.log(reference_tag);

  var type = reference_tag.data('type');

   if(type!='edit')
   {
   $.ajax({
            type : "POST",
            url  : "detUniqueID",
            dataType : "JSON",
            data : {
                        _token           : $('#token').val()

                    },
            success: function(data){
               if($('#id').val()=='')
                $('#UniqueID').val(data);
                uppy.setMeta({ UniqueID: $('#UniqueID').val() })
            }
        });
   }

})

   function closeModel(){

      $("#kt_modal_4_2").modal("hide");

      $('#cust_type').val("");
      $('#cust_name').val("");
      $('#cust_add1').val("");
      $('#cust_add2').val("");
      $('#cust_country').val("");
      $('#cust_city').val("");
      $('#cust_region').val("");
      $('#cust_zip').val("");
      $('#cust_email').val("");
      $('#cust_officephone').val("");
      $('#cust_mobile').val("");
      $('#cust_fax').val("");
      $('#cust_website').val("");
      $('#id').val("");
      $('#fileData').val("");
      $('#UniqueID').val("");
      $('.addmore').find(".skill").val("");
      $('.addmore').find(".skillValue").val("");
      $('.subadmore').remove();

   }

  $(document).on('click', '.close,.closeBtn', function(){

     closeModel();

  });


    var table = $('#userdetails_list').DataTable({
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
            "url" : 'userList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });

    /*******************************************************************************
     * Author : surya                                                             *
     * Detail :Add Button click to show the data for appinformation               *
     * Date   : 19-06-2020                                                        *
     *******************************************************************************/


    $(document).on('click', '#Appdetail_submit', function(e){

      //for spinner button
      e.preventDefault();

      $(this).addClass('kt-spinner');
      $(this).prop( "disabled", true );
      //end spinner

         $('#user-form').validate(  {
          rules: {
            app_name : "required",
            url : "required",
            },
          messages: {
          app_name  : "Please specify your Application Name",
            url : {
              required: "We need url"}
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

        var skill=[];

        var skillValue=[];


        $(".addmore").each(function() {

         skill.push($(this).find(".skill").val());
         skillValue.push($(this).find(".skillValue").val());

        });

        //console.log();

        //alert($("input[name='addmore']").val());

        $.ajax({
            type : "POST",
            url  : "appInfo",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        id               : $('#id').val(),
                        app_name         : $('#app_name').val(),
                        app_desc         : $('#app_desc').val(),
                        url              : $('#url').val(),
                        status          : $('#status').val(),
                       
                        file_data        : $('#fileData').val(),
                        UniqueID         : $('#UniqueID').val(),
                        skill            : skill,
                        skillValue       : skillValue

                    },
            success: function(data){

                  closeModel();

                  uppy.reset();

                  //for spinner button
                  $('#Appdetail_submit').removeClass('kt-spinner');

                  $('#Appdetail_submit').prop( "disabled", false );
                //end for spinner button

                $('#appdetails_list_last').trigger('click');

                setTimeout(function() {
                $('#appdetails_list_first').trigger('click');
                }, 3000);

                  //table.ajax.reload();

                  swal.fire("Done", "Submission Sucessfully", "success");

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
                $('#Appdetail_submit').removeClass('kt-spinner');

                $('#Appdetail_submit').prop( "disabled", false );
                //end for spinner button reactive

                $('#appdetails_list').DataTable().ajax.reload();
                toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });

        return false;

    });

    var table = $('#appdetails_list').DataTable({
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
            "url" : 'appList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });
    /*******************************************************************************
     * Author : surya                                                             *
     * Detail : Edit Button click to show the data for appinformation               *
     * Date   : 19-06-2020                                                          *
     *******************************************************************************/

    $(document).on('click', '.singleApp_update', function(){

           var user_id = $(this).attr("data-id");
           $.ajax({
                url       : "getSingleAppInfo",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      user_id     : user_id
                    },
                dataType  : "json",
                success:function(data)
                {
                     $('#app_name').val(data['apps'].app_name);
                     $('#app_desc').val(data['apps'].app_desc);
                     $('#url').val(data['apps'].url);
                     $('#status').val(data['apps'].status);
                     $('#icon').val(data['apps'].icon);
                     $('#id').val(user_id);
                     $('#UniqueID').val(data['apps'].uniqueid);
                     $('#fileData').val(data['apps'].file_data);
                     $("#usersInformation").modal("hide");



                    $.each(data['addMore'], function( index, value ) {

                      if(index==0){

                        $('.addmore').find(".skill").val(value['skill']);
                        $('.addmore').find(".skillValue").val(value['value']);

                      }else{


                       $('#table-more').append('<tr id="row'+index+'" class="dynamic-added addmore subadmore">\
                        <td>\
                        <input type="text" value="'+value['skill']+'" name="skill['+index+']" placeholder="Skill" class="skill form-control name_list" />\
                        </td>\
                        <td>\
                        <input type="text" value="'+value['value']+'" name="skillValue['+index+']" placeholder="Value" class="skillValue form-control name_list" />\
                        </td>\
                        <td>\
                        <button type="button" name="remove" id="'+index+'" class="btn btn-danger btn_remove">X</button>\
                        </td>\
                        </tr>');
                      }

                    });


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

    /*******************************************************************************
     * Author : surya                                                             *
     * Detail :Delete Button click to delete the data for appinformation               *
     * Date   : 19-06-2020                                                          *
     *******************************************************************************/
    $(document).on('click', '.kt_del_appinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Applist Entry also loss these Application Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deleteAppInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Application Entry has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Application Entry is safe :)", "error");

          }
        })
       });

     var tableTrash = $('#apptrashdetails_lists').DataTable({
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
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
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
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": [ 'odd-row', 'even-row' ],
        "order": [],

        "ajax": {
            "url" : 'appListTrash',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });
     /*******************************************************************************
     * Author : surya                                                                *
     * Detail :restore deleted  app information                                           *
     * Date   : 20-06-2020                                                          *
     *******************************************************************************/
     $(document).on('click', '.kt_restore_appinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Payroll  Master Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'appTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Payroll  Master Entry has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Payroll  Master Entry is safe :)", "error");

          }
        })
     });


var i=1;

$('#add-more').click(function(){

   i++;

   $('#table-more').append('<tr id="row'+i+'" class="dynamic-added addmore subadmore">\
    <td>\
    <input type="text"  name="skill['+i+']" placeholder="Skill" class="skill form-control name_list" />\
    </td>\
    <td>\
    <input type="text"  name="skillValue['+i+']" placeholder="Value" class="skillValue form-control name_list" />\
    </td>\
    <td>\
    <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>\
    </td>\
    </tr>');

});

$(document).on('click', '.btn_remove', function(){

     var button_id = $(this).attr("id");

     $('#row'+button_id+'').remove();

});

    $(document).on('click', '#Customerdetail_submit', function(e){

      //for spinner button
      e.preventDefault();

      $(this).addClass('kt-spinner');
      $(this).prop( "disabled", true );
      //end spinner

         $('#user-form').validate(  {
          rules: {
            cust_type : "required",
            cust_email: {
              required: true,
              email: true
            }
            },
          messages: {
            cust_type  : "Please specify your Customer Type",
            cust_email : {
              required: "We need your email address to contact you",
              email: "Your email address must be in the format of name@domain.com"
            }
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

        var skill=[];

        var skillValue=[];


        $(".addmore").each(function() {

         skill.push($(this).find(".skill").val());
         skillValue.push($(this).find(".skillValue").val());

        });



        //console.log();

        //alert($("input[name='addmore']").val());

        $.ajax({
            type : "POST",
            url  : "userInfo",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        cust_id          : $('#id').val(),
                        cust_type        : $('#cust_type').val(),
                        cust_name        : $('#cust_name').val(),
                        cust_add1        : $('#cust_add1').val(),
                        cust_add2        : $('#cust_add2').val(),
                        cust_country     : $('#cust_country').val(),
                        cust_city        : $('#cust_city').val(),
                        cust_region      : $('#cust_region').val(),
                        cust_zip         : $('#cust_zip').val(),
                        cust_email       : $('#cust_email').val(),
                        cust_officephone : $('#cust_officephone').val(),
                        cust_mobile      : $('#cust_mobile').val(),
                        cust_fax         : $('#cust_fax').val(),
                        cust_website     : $('#cust_website').val(),
                        file_data        : $('#fileData').val(),
                        UniqueID         : $('#UniqueID').val(),
                        skill            : skill,
                        skillValue       : skillValue

                    },
            success: function(data){

                  closeModel();

                  uppy.reset();

                  //for spinner button
                  $('#Customerdetail_submit').removeClass('kt-spinner');

                  $('#Customerdetail_submit').prop( "disabled", false );
                //end for spinner button

                $('#userdetails_list_last').trigger('click');

                setTimeout(function() {
                $('#userdetails_list_first').trigger('click');
                }, 3000);

                  //table.ajax.reload();

                  swal.fire("Done", "Submission Sucessfully", "success");

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

                $('#userdetails_list').DataTable().ajax.reload();
                toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });

        return false;

    });







    $('#userdetails_list tfoot th').each(function (i)
    {

            var title = $('#userdetails_list tfoot th').eq($(this).index()).text();
            // or just var title = $('#sample_3 thead th').text();
            var serach = '<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />';
            $(this).html('');
            $(serach).appendTo(this).keyup(function(){table.fnFilter($(this).val(),i)})
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


     /*******************************************************************************
     * Author : suji                                                                *
     * Detail :Edit Button click to show the data for userinformation               *
     * Date   : 24-04-2020                                                          *
     *******************************************************************************/

    $(document).on('click', '.Customerdetail_update', function(){

           var user_id = $(this).attr("data-id");
           $.ajax({
                url       : "getSingleUserInfo",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      user_id     : user_id
                    },
                dataType  : "json",
                success:function(data)
                {
                     $('#cust_type').val(data['users'].cust_type);
                     $('#cust_name').val(data['users'].cust_name);
                     $('#cust_add1').val(data['users'].cust_add1);
                     $('#cust_add2').val(data['users'].cust_add2);
                     $('#cust_country').val(data['users'].cust_country);
                     $('#cust_city').val(data['users'].cust_city);
                     $('#cust_region').val(data['users'].cust_region);
                     $('#cust_zip').val(data['users'].cust_zip);
                     $('#cust_email').val(data['users'].cust_email);
                     $('#cust_officephone').val(data['users'].cust_officephone);
                     $('#cust_mobile').val(data['users'].cust_mobile);
                     $('#cust_fax').val(data['users'].cust_fax);
                     $('#cust_website').val(data['users'].cust_website);
                     $('#id').val(user_id);
                     $('#UniqueID').val(data['users'].uniqueid);
                     $('#fileData').val(data['users'].file_data);
                     $("#usersInformation").modal("hide");



                    $.each(data['addMore'], function( index, value ) {

                      if(index==0){

                        $('.addmore').find(".skill").val(value['skill']);
                        $('.addmore').find(".skillValue").val(value['value']);

                      }else{


                       $('#table-more').append('<tr id="row'+index+'" class="dynamic-added addmore subadmore">\
                        <td>\
                        <input type="text" value="'+value['skill']+'" name="skill['+index+']" placeholder="Skill" class="skill form-control name_list" />\
                        </td>\
                        <td>\
                        <input type="text" value="'+value['value']+'" name="skillValue['+index+']" placeholder="Value" class="skillValue form-control name_list" />\
                        </td>\
                        <td>\
                        <button type="button" name="remove" id="'+index+'" class="btn btn-danger btn_remove">X</button>\
                        </td>\
                        </tr>');
                      }

                    });


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

     /*******************************************************************************
     * Author : suji                                                                *
     * Detail :delete for userinformation                                           *
     * Date   : 24-04-2020                                                          *
     *******************************************************************************/
     $(document).on('click', '.kt_del_usersinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Payroll  Master Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deleteUserInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Payroll  Master Entry has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Payroll  Master Entry is safe :)", "error");

          }
        })
       });
     });



    var tableTrash = $('#userdetails_list_trash').DataTable({
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
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
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
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": [ 'odd-row', 'even-row' ],
        "order": [],

        "ajax": {
            "url" : 'userListTrash',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });


     /*******************************************************************************
     * Author : suji                                                                *
     * Detail :restore deleted  user information                                           *
     * Date   : 24-04-2020                                                          *
     *******************************************************************************/
     $(document).on('click', '.kt_restore_usersinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Payroll  Master Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'userTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Payroll  Master Entry has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Payroll  Master Entry is safe :)", "error");

          }
        })
     });


var i=1;

$('#add-more').click(function(){

   i++;

   $('#table-more').append('<tr id="row'+i+'" class="dynamic-added addmore subadmore">\
    <td>\
    <input type="text"  name="skill['+i+']" placeholder="Skill" class="skill form-control name_list" />\
    </td>\
    <td>\
    <input type="text"  name="skillValue['+i+']" placeholder="Value" class="skillValue form-control name_list" />\
    </td>\
    <td>\
    <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>\
    </td>\
    </tr>');

});

$(document).on('click', '.btn_remove', function(){

     var button_id = $(this).attr("id");

     $('#row'+button_id+'').remove();

});
