  /**
  *Datatable for Vendor Type
  */
  var vendortypedetails_table = $('#vendortypedetails_list').DataTable({
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
          "url": 'vendortypedetails',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'vendor_type', name: 'vendor_type' },
          { data: 'description', name: 'description' },
          {
              data: 'color',
              name: 'color',
              render: function(data, type, row) {
                  return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
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
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_4"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text Vendortypedetail_update" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_vendortypeinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });
/**
*Vendor type get data for update 
*/
$(document).on('click', '.Vendortypedetail_update', function(){
           var info_id = $(this).attr("data-id");
           $.ajax({
                url       : "getvendortype",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      info_id     : info_id
                    },
                dataType  : "json",
                success:function(data)
                {
                     $('#vendor_type').val(data['users'].vendor_type);
                     $('#description').val(data['users'].description);
                     $('#color').val(data['users'].color);
                     $('#id').val(info_id);
                }
           })
      });
/**
*Vendor Type submit action
*/
$(document).on('click', '#VendorType_submit', function(e){
      e.preventDefault();
        vendor_type     = $('#vendor_type').val();
        color           = $('#color').val();
        description     = $('#description').val();
        if (vendor_type == ""){
            $('#vendor_type').addClass('is-invalid');
            return false;
        }else{
            $('#vendor_type').removeClass('is-invalid');
        }
        if (color == "") {
            $('#color').addClass('is-invalid');
            return false;
        } else {
             $('#color').removeClass('is-invalid');
        }
        if (description == "") {
            $('#description').addClass('is-invalid');
            return false;
        } else {
             $('#description').removeClass('is-invalid');
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
            url  : "VendorTypeSubmit",
            dataType  : "json",
            data : {
                        _token             : $('#token').val(),
                        vendor_type        : $('#vendor_type').val(),
                        vendor_id          : $('#id').val(),
                        description        : $('#description').val(),
                        color              : $('#color').val(),
                        branch             : $('#branch').val()
                    },
            success: function(data){
          if(data == false)
          {
            $('#VendorType_submit').removeClass('kt-spinner');
            $('#VendorType_submit').prop("disabled", false);
             toastr.success('Vendor type name is already exist');

          }
          else
          {
                    $('#VendorType_submit').removeClass('kt-spinner');
                    $('#VendorType_submit').prop("disabled", false);
                    closeModel();
                    vendortypedetails_table.ajax.reload();
                    toastr.success('Vendor Type Details '+sucess_msg+' Successfuly');
          }
            },
            error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
        });
        return false;
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
    $('#vendor_type').val("");
    $('#description').val("");
    $('#color').val("");
}

$.reloadTable = function()
    {
        table.ajax.reload();
    };
/**
*Vendor Type Trash Datatable
*/
 var vendortypetrashdetails_table = $('#vendortypetrashdetails_list').DataTable({
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
          "url": 'vendortypetrash',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'vendor_type', name: 'vendor_type'},
            {data: 'description', name: 'description'},
            {data: 'color', name: 'color', render:function(data, type, row){
              return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#'+row.color+'">&nbsp;&nbsp;</div>';
            }},
            {data: 'action', name: 'action', render:function(data, type, row){
             return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id='+row.id+'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                        <span class="kt-nav__link-text VendorTypeDetail_restore" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
            }},
            
        ]
    });

/**
*Vendor Type deletion
*/
$(document).on('click', '.kt_del_vendortypeinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Vendor Type Details Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {
        $.ajax({
              type: "POST",
              url : 'deleteVendorType',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  console.log(data);
    if(data == 'true')
    {
      swal.fire("Deleted!", "Your Type has been deleted.", "success");
      vendortypedetails_table.ajax.reload();
    }
    else
    {
      swal.fire("Not Deleted!", "Your Type is used in Vendor Details.", "success");
      vendortypedetails_table.ajax.reload();
    }

             }
          });
          } else {
            swal.fire("Cancelled", "Your vendor type details Entry is safe :)", "error");
          }
        })
       });
/**
*Vendor Type DataTable Export
*/
  $("#vendortypedetails_list_print").on("click", function() {
      vendortypedetails_table.button('.buttons-print').trigger();
  });
  $("#vendortypedetails_list_copy").on("click", function() {
      vendortypedetails_table.button('.buttons-copy').trigger();
  });
  $("#vendortypedetails_list_csv").on("click", function() {
      vendortypedetails_table.button('.buttons-csv').trigger();
  });
  $("#vendortypedetails_list_pdf").on("click", function() {
      vendortypedetails_table.button('.buttons-pdf').trigger();
  });
/**
*Vendor Type trash DataTable Export
*/
  $("#vendortypetrashdetails_list_print").on("click", function() {
      vendortypetrashdetails_table.button('.buttons-print').trigger();
  });
  $("#vendortypetrashdetails_list_copy").on("click", function() {
      vendortypetrashdetails_table.button('.buttons-copy').trigger();
  });
  $("#vendortypetrashdetails_list_csv").on("click", function() {
      vendortypetrashdetails_table.button('.buttons-csv').trigger();
  });
  $("#vendortypetrashdetails_list_pdf").on("click", function() {
      vendortypetrashdetails_table.button('.buttons-pdf').trigger();
  });

/**
*Vendor Type get data for update 
*/
    $(document).on('click', '.VendorTypeDetail_restore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Vendor Type Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'VendorTypeRestoreTrash',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Restored!", "Your Vendor Type Entry has been Restored.", "Success");
                window.location.href="vendortypedetails";
             }
          });
          } else {
            swal.fire("Cancelled", "Your Vendor Type Entry is not safe :)", "error");
          }
        })
     });
