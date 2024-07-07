
$(document).ready(function(){
    const uppy = Uppy.Core({
    autoProceed: true,
    allowMultipleUploads: true,
    showRemoveButtonAfterComplete: true,
    meta: {
            UniqueID       : $('#UniqueID').val()
          },
    onBeforeUpload   : (files) => {
    fileData           = [];
    const updatedFiles = {};
            Object.keys(files).forEach(fileID => {
                fileData.push('userInfoData/'+$('#UniqueID').val()+'/'+files[fileID].name );
            });
            $('#fileData').val(fileData);
        },
    });
    uppy.use(Uppy.FileInput, {
        target: '.UppyForm',
        pretty: true,
        inputName: 'files[]',
        replaceTargetContent: true,
    })
    uppy.use(Uppy.ProgressBar, {
        target: '.UppyProgressBar',
        showProgressDetails: true,
        hideAfterFinish: true,
    })
    uppy.use(Uppy.XHRUpload, {
        endpoint  : 'FileUpload',
        UniqueID  : $('#UniqueID').val(),
        fieldName : 'filenames[]',
        headers: {
            'X-CSRF-TOKEN' : $('#token').val(),
            UniqueID       : $('#UniqueID').val()
        }
    });
    uppy.on('upload-success', (file, response) => {
        const url      = response.uploadURL;
        const fileName = file.name;
        document.querySelector('.uploaded-files ol').innerHTML +=
            `<li><a href="${url}" target="_blank">${fileName}</a> <i data-name="${fileName}" class="flaticon2-cancel-music removeUppyItem"></i></li>`
    })
  });
$('#vendorDoc').on('shown.bs.modal', function (e) {
  var reference_tag = $(e.relatedTarget);
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
$(document).on('click', '#Docdetail_submit', function(e){
      e.preventDefault();
      $(this).addClass('kt-spinner');
      $(this).prop( "disabled", true );
        $('#user-form').validate({
          rules: {
            name : "required"
            },
          messages: {
            name  : "Please specify Vendor Name"
          }
         });
        if (!$('#user-form').valid())
        {
          $(this).removeClass('kt-spinner');
          $(this).prop( "disabled", false );
          return false;
        }
        var titles      =[];
        var descriptions=[];
        $(".addmores").each(function(){
            titles.push($(this).find(".titles").val());
            descriptions.push($(this).find(".descriptions").val());
            fileData.push($(this).find(".fileData").val());
        });
        var selectedItemArray = [];
        var selectData = $('.js-data-example-ajax').select2('data');
        $.each(selectData, function( index, value ) {
            selectedItemArray.push(value['id']);
        });
        $.ajax({
            type : "POST",
            url  : "docInfo",
            dataType  : "json",
            data : {
                        _token          : $('#token').val(),
                        doc_id          : $('#id').val(),
                        v_id            : $('#v_id').val(),
                        title           : $('#title').val(),
                        description     : $('#description').val(),
                        name            : $('#v_name').val(),
                        fileData        : $('#fileData').val(),
                        cust_users      : selectedItemArray.toString(),
                        UniqueID        : $('#UniqueID').val(),
                        titles: titles,
                        descriptions:descriptions,
                    },
            success: function(data){
                swal.fire("Done", "Submission Sucessfully", "success");
                location.reload();
                window.location.href="vendordocuments";
                closeModel();
                uppy.reset();
                $('#Docdetail_submit').removeClass('kt-spinner');
                $('#Docdetail_submit').prop( "disabled", false );
                $('#vendordocdetails_list_last').trigger('click');
                setTimeout(function() {
                $('#vendordocdetails_list_list_first').trigger('click');
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
                $('#Docdetail_submit').removeClass('kt-spinner');
                $('#Docdetail_submit').prop( "disabled", false );
                $('#vendordocdetails_list').DataTable().ajax.reload();
                toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });
        return false;
    });
$(document).on('click', '.removeUppyItem', function(){
        var newFileData = [];
        var button_id = $(this).attr("data-name");
        $(this).parent('li').remove();
        var filearray = $('#fileData').val().split(",");
        $.each(filearray,function(i){
            var single = filearray[i].split("/");
            if(button_id!=single[2])
             {
              newFileData.push(filearray[i]);
             }
        });
        $('#fileData').val(newFileData);
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
    var i=1;
$('#add-mores').click(function(){
   i++;
   $('#table-more').append('<tr id="row'+i+'" class="dynamic-added addmore subadmore">\
    <td>\
    <input type="text"  name="titles['+i+']" placeholder="Title" class="titles form-control name_list" />\
    </td>\
    <td>\
    <input type="text"  name="descriptions['+i+']" placeholder="Description" class="descriptions form-control name_list" />\
    </td>\
    <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>\
    </td>\
    </tr>');
});
$(document).on('click', '.btn_remove', function(){
     var button_id = $(this).attr("id");
     $('#row'+button_id+'').remove();
    });
    $(".btn-success").click(function(){ 
        var lsthmtl = $(".clone").html();
          $(".UppyForm").after(lsthmtl);
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
$(document).on('click', '.close', function(){
     closeModel();
     function closeModel(){
      $("#vendorDoc").modal("hide");
      $('#v_name').val("");
      $('#title').val("");
      $('#description').val("");
      $('#fileData').val("");
        }
  });
$(document).on('click', '.DocDetail_restore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Vendor Documents Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {
        $.ajax({
              type: "POST",
              url : 'DocTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Vendor Documents Entry has been restored.", "success");
                window.location.href="vendordocuments";
             }
          });
          } else {
            swal.fire("Cancelled", "Your Vendor Documents Entry is not restored :)", "error");

          }
        })
     });
$(document).on('click', '.DocDetail_add', function(){
           var user_id = $(this).attr("data-id");
           $.ajax({
              url          : "getDocAdd",
                 method    : "POST",
                 data      : {
                       _token      : $('#token').val(),
                       user_id     : user_id
                     },
                 dataType  : "json",
                 success:function(data)
                    {
                      $('#v_id').val(user_id);
                      $('#v_name').val(data['users'].vendor_name);
                      $("#usersInformation").modal("hide");
                    }
                });
        $('#vendorDoc').show();
         });
$(document).on('click', '.DocDetail_update', function(){
           var user_id = $(this).attr("data-id");
           $.ajax({
              url       : "getDocEdit",
              method    : "POST",
              data      : {
                       _token      : $('#token').val(),
                       user_id     : user_id
                     },
                 dataType  : "json",
                 success:function(data)
                {
                     $('#v_name').val(data['users'].name);
                     $('#title').val(data['users'].title);
                     $('#v_id').val(user_id);
                     $('#description').val(data['users'].description);
                     $('#id').val(data['users'].id);
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
                          .then((response) => response.blob())
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
         $('#vendorDoc').show();
         });
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
      if(result.value){
        $.ajax({
              type: "POST",
              url : 'deleteDocInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data){
                  swal.fire("Deleted!", "Your Vendor Document Entry has been deleted.", "success");
                  location.reload();
                }
          });
          } else{
            swal.fire("Cancelled", "Your Vendor Document Details Entry is safe :)", "error");
          }
        })
});
      




