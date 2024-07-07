  /**
     *Datatable for Vendor Category
     */
 
  var vendorcategorydetails_table = $('#vendorcategorydetails_list').DataTable({
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
          "url": 'vendorcategorydetails',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'vendor_category', name: 'vendor_category' },
          { data: 'description', name: 'description' },
          {
              data: 'color',
              name: 'color',
              render: function(data, type, row) {
                  return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
              }
          },
          { data: 'customcode', name: 'customcode' },
           { data: 'startfrom',  name: 'startfrom' },
         
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_4"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text Vendorcategorydetail_update" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_vendorcategoryinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },

      ]
  });
/**
    *Vendor group  trash datatable
*/
 var vendorcategorytrashdetails_table = $('#vendorcategorytrashdetails_list').DataTable({
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
          "url": 'vendorCategoryTrash',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'vendor_category', name: 'vendor_category'},
            {data: 'description', name: 'description'},
            {data: 'color', name: 'color', render:function(data, type, row){
              return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#'+row.color+'">&nbsp;&nbsp;</div>';
            }},
            {data: 'customcode', name: 'customcode'},
            {data: 'startfrom', name: 'startfrom'},
            {data: 'action', name: 'action', render:function(data, type, row){
             return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id='+row.id+'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                        <span class="kt-nav__link-text VendorCategorydetail_restore" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
            }},
            
        ]
    });
/**
   *Vendor Category DataTable Export
*/

  $("#vendorcategorydetails_list_print").on("click", function() {
      vendorcategorydetails_table.button('.buttons-print').trigger();
  });
  $("#vendorcategorydetails_list_copy").on("click", function() {
      vendorcategorydetails_table.button('.buttons-copy').trigger();
  });
  $("#vendorcategorydetails_list_csv").on("click", function() {
      vendorcategorydetails_table.button('.buttons-csv').trigger();
  });
  $("#vendorcategorydetails_list_pdf").on("click", function() {
      vendorcategorydetails_table.button('.buttons-pdf').trigger();
  });

/**
   *Vendor Category trash DataTable Export
*/
  $("#vendorcategorytrashdetails_print").on("click", function() {
      vendorcategorytrashdetails_table.button('.buttons-print').trigger();
  });
  $("#vendorcategorytrashdetails_copy").on("click", function() {
      vendorcategorytrashdetails_table.button('.buttons-copy').trigger();
  });
  $("#vendorcategorytrashdetails_csv").on("click", function() {
      vendorcategorytrashdetails_table.button('.buttons-csv').trigger();
  });
  $("#vendorcategorytrashdetails_pdf").on("click", function() {
      vendorcategorytrashdetails_table.button('.buttons-pdf').trigger();
  });

/**
   *Vendor Category get data for update 
*/
$(document).on('click', '.Vendorcategorydetail_update', function(){
           var info_id = $(this).attr("data-id");
           $.ajax({
                url       : "getvendorcategory",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      info_id     : info_id
                    },
                dataType  : "json",
                success:function(data)
                {
                     $('#vendor_category').val(data['users'].vendor_category);
                     $('#description').val(data['users'].description);
                     $('#color').val(data['users'].color);
                     $('#id').val(info_id);
                     $('#customcode').val(data['users'].customcode);
                     $('#startfrom').val(data['users'].startfrom);
                }
           })
      });
/**
    *Vendor Category submit action
*/
$(document).on('click', '#VendorCategory_submit', function(e){
      e.preventDefault();
        vendor_category = $('#vendor_category').val();
        color           = $('#color').val();
        customcode      = $('#customcode').val();
        startfrom       = $('#startfrom').val();
        if (vendor_category == ""){
            $('#vendor_category').addClass('is-invalid');
            return false;
        }else{
            $('#vendor_category').removeClass('is-invalid');
        }
        if (color == "") {
            $('#color').addClass('is-invalid');
            return false;
        } else {
             $('#color').removeClass('is-invalid');
        }
        
        if (customcode == "") {
            $('#customcode').addClass('is-invalid');
            return false;
        } else {
             $('#customcode').removeClass('is-invalid');
        }
        if (startfrom == "") {
            $('#startfrom').addClass('is-invalid');
            return false;
        } else {
             $('#startfrom').removeClass('is-invalid');
        }
      $(this).addClass('kt-spinner');
      $(this).prop("disabled", true);
      if($('#id').val()){
        var sucess_msg ='Updated';
      } else{
        var sucess_msg ='Created';
      }
        $.ajax({
            type : "POST",
            url  : "VendorCategorySubmit",
            dataType  : "json",
            data : {
                        _token             : $('#token').val(),
                        vendor_category    : $('#vendor_category').val(),
                        vendor_id          : $('#id').val(),
                        description        : $('#description').val(),
                        color              : $('#color').val(),
                        customcode         :$('#customcode').val(),
                        startfrom          :$('#startfrom').val(),
                        branch             :$('#branch').val()
                    },
            success: function(data){
          if(data == false)
          {
            $('#VendorCategory_submit').removeClass('kt-spinner');
            $('#VendorCategory_submit').prop("disabled", false);
             toastr.success('Vendor category name is already exist');

          }
          else
          {
                  $('#VendorCategory_submit').removeClass('kt-spinner');
                  $('#VendorCategory_submit').prop("disabled", false);
                  closeModel();
                  vendorcategorydetails_table.ajax.reload();
                  toastr.success('Vendor Category Details '+sucess_msg+' Successfuly');
          }
                },
            error   : function ( jqXhr, json, errorThrown )
            {
               console.log('Error !!');
            }
        });
    });
/**
    *Function call for close button
*/
$(document).on('click', '.close,.closeBtn', function() {
    closeModel();
});
function closeModel() {
    $("#kt_modal_4_4").modal("hide");
    $('#id').val("");
    $('#vendor_category').val("");
    $('#description').val("");
    $('#color').val("");
    $('#customcode').val("");
    $('#startfrom').val("");
}
/**
    *Vendor Category deletion
*/
$(document).on('click', '.kt_del_vendorcategoryinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Vendor Category Details Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {
        $.ajax({
              type: "POST",
              url : 'deleteVendorCategory',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data){
                  console.log(data);
    if(data == 'true')
    {
      swal.fire("Deleted!", "Your Category has been deleted.", "success");
      vendorcategorydetails_table.ajax.reload();
    }
    else
    {
      swal.fire("Not Deleted!", "Your Category is used in Vendor Details.", "success");
      vendorcategorydetails_table.ajax.reload();
    }

             }
          });
          } else{
            swal.fire("Cancelled", "Your Vendor Category Details Entry is safe :)", "error");
          }
        })
       });
/**
    *Vendor Category Restore
*/
    $(document).on('click', '.VendorCategorydetail_restore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Vendor Category Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'vendorCategoryRestoreTrash',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Restored!", "Your Vendor Category Entry has been Restored.", "success");
                window.location.href="vendorcategorydetails";
             }
          });
          } else {
            swal.fire("Cancelled", "Your Vendor Category Entry is not Safe :)", "error");
          }
        })
     });


  