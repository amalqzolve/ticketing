  /**
  *Datatable for Manufacture Listing
  */

  var manufacturesdetails_table = $('#manufacturesdetails_list').DataTable({
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
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50];
                  //doc.content[1].table.widths = [ '20%', '20%', '20%', '20%', '20%'];
                  // doc.styles['table'] = { width:100% }
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          }
      ],

      ajax: {
          "url": 'ManufacturerList',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'manufact_name', name: 'manufact_name' },
          { data: 'manufacture_code', name: 'manufacture_code' },
         
//           { data: 'logo', name: 'logo', 
//           render: function(data, type, row) {
// // return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
//            return '<img src="URL::to() }}/public/Manufactureinfodata"'+ row.logo+'" class="img-thumbnail" width="75" height="75"/>';
//             }
//           }, 
          { data: 'id', name: 'id' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="editmanufacturer?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text delmanufaturerdetails" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });

  /**
*Product Manufacture Trash Delete
*/
$(document).on('click', '.trashdeleteformanufacture', function() {
 
        var id = $(this).attr('id');
        // alert(id);
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Manufature Details Entry!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'DeleteTrashProdctmanufacture',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {
                          // alert(data);
                        swal.fire("Deleted!", "Your  Invoice Manufature Product Units has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Invoice  Manufature  Product Units Entry is safe ", "error");
            }
        })
    });


/**
*Product Management DataTable Export
*/

  $("#manufacturesdetails_list_print").on("click", function() {
      manufacturesdetails_table.button('.buttons-print').trigger();
  });
  $("#manufacturesdetails_list_copy").on("click", function() {
      manufacturesdetails_table.button('.buttons-copy').trigger();
  });
  $("#manufacturesdetails_list_csv").on("click", function() {
      manufacturesdetails_table.button('.buttons-csv').trigger();
  });
  $("#manufacturesdetails_list_pdf").on("click", function() {
      manufacturesdetails_table.button('.buttons-pdf').trigger();
  });

/**
   *Product Group trash DataTable Export
*/
  $("#manufacturedetails_trash_print").on("click", function() {
      manufacturedetails_trash_table.button('.buttons-print').trigger();
  });


  $("#manufacturedetails_trash_copy").on("click", function() {
      manufacturedetails_trash_table.button('.buttons-copy').trigger();
  });

  $("#manufacturedetails_trash_csv").on("click", function() {
      manufacturedetails_trash_table.button('.buttons-csv').trigger();
  });

  $("#manufacturedetails_trash_pdf").on("click", function() {
      manufacturedetails_trash_table.button('.buttons-pdf').trigger();
  });


/**
*Datatable for Manufacture Delete
*/
    $(document).on('click', '.delmanufaturerdetails', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Invoice Manufacturer And Options  Details Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'delete-manufacture',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {

                    swal.fire("Deleted!", "Your  Invoice Manufacturer And Options  has been deleted.", "success");
                    location.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Invoice  Manufature Product Units Entry is safe ", "error");
        }
    })
});
/**
*Datatable for Manufacture Trash Listing
*/
    var manufacturedetails_trash_table = $('#manufacturedetails_trash').DataTable({
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
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50];
                  // doc.styles['table'] = { width:100% }
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          }
      ],

      ajax: {
          "url": 'manufacturetrash',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'manufacture_name', name: 'manufacture_name' },
          { data: 'manufacture_code', name: 'manufacture_code' },
          
          { data: 'id', name: 'id' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id='+row.id+'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-refresh-arrow"></i>\
                        <span class="kt-nav__link-text restoremanufacture" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text trashdeleteformanufacture" id='+row.id+' data-id="'+row.id+'" >Delete</span>\
                        </span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });
/**
*Product Manufacture restore confirmation message
*/
$(document).on('click', '.restoremanufacture', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this  Entry !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value){
        $.ajax({
              type: "POST",
              url : 'restoremanufacture',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data){
                  swal.fire("Deleted!", "Your Entry has been restored.", "success");
                    location.reload();
                  window.location.href="ManufacturerList";

             }
          });
          } else{
            swal.fire("Cancelled", "Your Entry is not safe ", "error");
          }
        })
       });

    const uppy = Uppy.Core({
        autoProceed: false,
        allowMultipleUploads: true,
             restrictions: {
  maxNumberOfFiles: 1,
  minNumberOfFiles: 1,
  allowedFileTypes: ["image/*"]
  },
        // meta: {
        //         UniqueID       : $('#UniqueID').val()
        //     },
        onBeforeUpload: (files) => {
            fileData = [];
            const updatedFiles = {};

            Object.keys(files).forEach(fileID => {
                    fileData.push('Manufactureinfodata/' + files[fileID].name)
                })
                //return updatedFiles
            $('#fileData').val(fileData);

        },

    })

    uppy.use(Uppy.Dashboard, {
        metaFields: [
            { id: 'name', name: 'Name', placeholder: 'File name' },
            { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
        ],
        browserBackButtonClose: true,
        target: '#choose-files',
        inline: true,
        replaceTargetContent: true,
        width:'100%'
    })
    uppy.use(Uppy.GoogleDrive, {
        target: Uppy.Dashboard,
        companionUrl: 'https://companion.uppy.io'
    })
    uppy.use(Uppy.Webcam, { target: Uppy.Dashboard })
    uppy.use(Uppy.XHRUpload, {
        endpoint: 'ManufactureFileUpload',
        // UniqueID       : $('#UniqueID').val(),
        fieldName: 'filenames[]',
        headers: {
            'X-CSRF-TOKEN': $('#token').val(),
            // UniqueID       : $('#UniqueID').val()
        }
    })


if ($('#fileData').val() != '') {
        var img_array = $('#fileData').val().split(",");
        console.log(img_array);
        $.each(img_array, function(i) {
            onuppyImageClicked('public/' + img_array[i]);
        });
    }

    function onuppyImageClicked(img) {

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
/**
*Product Manufature submit action
*/
    

$(document).on('click', '#manufacture_submit', function(e) {
        e.preventDefault();
        manufacture_name = $('#manufacture_name').val();
        manufacture_code = $('#manufacture_code').val();
    

        if (manufacture_name == "") {
            $('#manufacture_name').addClass('is-invalid');
            toastr.warning('Manufacture Name is required.');      
            return false;
        } else {
            $('#manufacture_name').removeClass('is-invalid');
        }
        if (manufacture_code == "") {
            $('#manufacture_code').addClass('is-invalid');
            toastr.warning('Manufacture Code is required.');      
            return false;
        } else {
            $('#manufacture_code').removeClass('is-invalid');
        }
      
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        if($('#id').val()){
        var sucess_msg ='Updated';
        } else{
        var sucess_msg ='Created';
        }

        $.ajax({
            type: "POST",
            url: "submit-manufacturer",
            dataType: "text",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                manufacture_name: $('#manufacture_name').val(),
                manufacture_code: $('#manufacture_code').val(),
                fileData: $('#fileData').val(),
                vendor: $('#vendor').val(),
                description : $('#description').val(),
                branch : $('#branch').val()
            },
            success: function(data) {
                    console.log(data);
                if(data == 0)
                {
                  $('#manufacture_submit').removeClass('kt-spinner');
                  $('#manufacture_submit').prop("disabled", false);
                  toastr.warning('Manufacture name already exist');
                }
                else
                {
                      uppy.reset();

                      $('#manufacture_submit').removeClass('kt-spinner');
                      $('#manufacture_submit').prop("disabled", false);
                      manufacturesdetails_table.ajax.reload();
                      toastr.success('Manufacture  Details '+sucess_msg+' Successfuly');
                      window.location.href = "ManufacturerList";
                }
            },
            error: function(jqXhr, json, errorThrown) {
                        console.log('Error !!');
            }
        });
    });




/**
  * Manufacture delete trash confirmation message
  */

// $(document).on('click', '.delmanufacturer_trashdelete', function() {
//     var id = $(this).attr('id');
//     swal.fire({
//         title: "Are you sure?",
//         text: "You will not be able to recover this Invoice Manufacturer And Options  Details Entry also loss these  Details!",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonClass: "btn-danger",
//         confirmButtonText: "Yes, delete it!",
//         cancelButtonText: "No, cancel it!"
//     }).then(result => {
//         if (result.value) {

//             $.ajax({
//                 type: "POST",
//                 url: 'trash_delete_manufacture',
//                 data: {
//                     _token: $('#token').val(),
//                     id: id
//                 },
//                 success: function(data) {

//                     swal.fire("Deleted!", "Your  Invoice Manufacturer And Options  has been deleted.", "success");
//                     location.reload();
//                 }
//             });
//         } else {

//             swal.fire("Cancelled", "Your Invoice  Product Units Entry is safe :)", "error");
//         }
//     })
// });




/**
*manufacture Management DataTable Export
*/

  // $("#manufacturesdetails_list_print").on("click", function() {
  //     manufacturesdetails_table.button('.buttons-print').trigger();
  // });
  // $("#manufacturesdetails_list_copy").on("click", function() {
  //     manufacturesdetails_table.button('.buttons-copy').trigger();
  // });
  // $("#manufacturesdetails_list_csv").on("click", function() {
  //     manufacturesdetails_table.button('.buttons-csv').trigger();
  // });
  // $("#manufacturesdetails_list_pdf").on("click", function() {
  //     manufacturesdetails_table.button('.buttons-pdf').trigger();
  // });

/**
   *manufacture trash DataTable Export
*/
  // $("#manufacturedetails_trash_print").on("click", function() {
  //     manufacturedetails_trash_table.button('.buttons-print').trigger();
  // });


  // $("#manufacturedetails_trash_copy").on("click", function() {
  //     manufacturedetails_trash_table.button('.buttons-copy').trigger();
  // });

  // $("#manufacturedetails_trash_csv").on("click", function() {
  //     manufacturedetails_trash_table.button('.buttons-csv').trigger();
  // });

  // $("#manufacturedetails_trash_pdf").on("click", function() {
  //     manufacturedetails_trash_table.button('.buttons-pdf').trigger();
  // });
