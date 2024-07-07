/**
     *Datatable for vendor group
     */
  var vendorgroupdetails_table = $('#vendorgroupdetails_list').DataTable({
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
          "url": 'vendorgroupdetails',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'title', name: 'title' },
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
                        <span class="kt-nav__link-text VendorGroupDetail_update" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_vendorgroupinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },

      ]
  });
/**
   *Vendor Group DataTable Export
*/
  $("#vendorgroupdetails_list_print").on("click", function() {
      vendorgroupdetails_table.button('.buttons-print').trigger();
  });
  $("#vendorgroupdetails_list_copy").on("click", function() {
      vendorgroupdetails_table.button('.buttons-copy').trigger();
  });
  $("#vendorgroupdetails_list_csv").on("click", function() {
      vendorgroupdetails_table.button('.buttons-csv').trigger();
  });
  $("#vendorgroupdetails_list_pdf").on("click", function() {
      vendorgroupdetails_table.button('.buttons-pdf').trigger();
  });

/**
   *Vendor Group trash DataTable Export
*/
  $("#vendorgrouptrashdetails_list_print").on("click", function() {
      vendorgrouptrashdetails_table.button('.buttons-print').trigger();
  });
  $("#vendorgrouptrashdetails_list_copy").on("click", function() {
      vendorgrouptrashdetails_table.button('.buttons-copy').trigger();
  });
  $("#vendorgrouptrashdetails_list_csv").on("click", function() {
      vendorgrouptrashdetails_table.button('.buttons-csv').trigger();
  });
  $("#vendorgrouptrashdetails_list_pdf").on("click", function() {
      vendorgrouptrashdetails_table.button('.buttons-pdf').trigger();
  });
/**
    *Vendor group  trash datatable
*/
 var vendorgrouptrashdetails_table = $('#vendorgrouptrashdetails_list').DataTable({
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
          "url": 'vendorgrouptrash',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            { data: 'color', name: 'color', render:function(data, type, row){
              return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#'+row.color+'">&nbsp;&nbsp;</div>';
            }},
            { data: 'action', name: 'action', render:function(data, type, row){
             return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id='+row.id+'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text VendorGroupDetail_restore" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
            }},
            
        ]
    });
/**
   *Vendor group get data for update 
*/
$(document).on('click', '.VendorGroupDetail_update', function(){
           var info_id = $(this).attr("data-id");
           $.ajax({
                url       : "getvendorgroup",
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
                }
           })
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
    $('#title').val("");
    $('#description').val("");
    $('#color').val("");
}
/**
*Vendor group submit action
*/
$(document).on('click', '#VendorGroup_submit', function(e){
      e.preventDefault();
        title = $('#title').val();
        color = $('#color').val();
        if (title == ""){
            $('#title').addClass('is-invalid');
            return false;
        }else{
            $('#title').removeClass('is-invalid');
        }
        if (color == "") {
            $('#color').addClass('is-invalid');
            return false;
        } else {
             $('#color').removeClass('is-invalid');
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
            url  : "VendorGroupSubmit",
            dataType  : "json",
            data : {
                    _token             : $('#token').val(),
                    title              : $('#title').val(),
                    id                 : $('#id').val(),
                    description        : $('#description').val(),
                    color              : $('#color').val(),
                    branch             : $('#branch').val()
                    },
            success: function(data){
          if(data == false)
          {
            $('#VendorGroup_submit').removeClass('kt-spinner');
            $('#VendorGroup_submit').prop("disabled", false);
             toastr.success('Vendor group name is already exist');

          }
          else
          {
                    $('#VendorGroup_submit').removeClass('kt-spinner');
                    $('#VendorGroup_submit').prop("disabled", false);
                    closeModel();
                    vendorgroupdetails_table.ajax.reload();
                    toastr.success('Vendor group '+sucess_msg+' Successfuly');
          }
            },
            error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
        });
    });
$.reloadTable = function()
    {
        table.ajax.reload();
    };
/**
*Vendor group deletion
*/
$(document).on('click', '.kt_del_vendorgroupinformation', function (){
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Vendor Group Details Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {
        $.ajax({
              type: "POST",
              url : 'deleteVendorGroup',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  console.log(data);
    if(data == 'true')
    {
      swal.fire("Deleted!", "Your Group has been deleted.", "success");
      vendorgroupdetails_table.ajax.reload();
    }
    else
    {
      swal.fire("Not Deleted!", "Your Group is used in Vendor Details.", "success");
      vendorgroupdetails_table.ajax.reload();
    }
             }
          });
          } else{
            swal.fire("Cancelled", "Your Vendor Group Details Entry is Safe :)", "error");
          }
        })
       });
   
/**
*Vendor group data restore
*/
    $(document).on('click', '.VendorGroupDetail_restore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Vendor Group Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'vendorGroupRestoreTrash',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Vendor Group Entry has been Restored.",
                   "success");
                window.location.href="vendorgroupdetails";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Vendor Group Entry is not safe :)", "error");

          }
        })
     });

