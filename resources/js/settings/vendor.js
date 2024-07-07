/**
     *Datatable for vendor group
     */
  var vendorgroupdetails_table = $('#vendorgroupdetails_list').DataTable({
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
          "url": 'settingsvendorgroupdetails',
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
          "url": 'settingsvendorgrouptrash',
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
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
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
                url       : "settingsgetvendorgroup",
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
                     $('#colour').val(data['users'].color);
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
    $('#colour').val("");
}
/**
*Vendor group submit action
*/
$(document).on('click', '#VendorGroup_submit', function(e){
      e.preventDefault();
        title = $('#title').val();
        color = $('#colour').val();

        if (title == ""){
            $('#title').addClass('is-invalid');
            return false;
        }else{
            $('#title').removeClass('is-invalid');
        }
        if (color == "") {
            $('#colour').addClass('is-invalid');
            return false;
        } else {
             $('#colour').removeClass('is-invalid');
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
            url  : "settingsVendorGroupSubmit",
            dataType  : "json",
            data : {
                    _token             : $('#token').val(),
                    title              : $('#title').val(),
                    id                 : $('#id').val(),
                    description        : $('#description').val(),
                    color              : $('#colour').val(),
                    branch             : $('#branch').val()
                    },
            success: function(data){
          if(data == false)
          {
            $('#VendorGroup_submit').removeClass('kt-spinner');
            $('#VendorGroup_submit').prop("disabled", false);
             toastr.success('The Vendor Group name  already exists.');

          }
          else
          {
                    $('#VendorGroup_submit').removeClass('kt-spinner');
                    $('#VendorGroup_submit').prop("disabled", false);
                    closeModel();
                    vendorgroupdetails_table.ajax.reload();
                    toastr.success('The Vendor group '+sucess_msg+' Successfully');
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
              url : 'settingsdeleteVendorGroup',
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
              url : 'settingsvendorGroupRestoreTrash',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Vendor Group Entry has been Restored.",
                   "success");
                window.location.href="settingsvendorgroupdetails";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Vendor Group Entry is not safe :)", "error");

          }
        })
     });

      var vendorcategorydetails_table = $('#vendorcategorydetails_list').DataTable({
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
                  columns: [0, 1, 2, 3,4,5]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '10%', '10%', 
                                                           '10%', '25%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5]
              }
          }
      ],

      ajax: {
          "url": 'settingsvendorcategorydetails',
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
                  columns: [0, 1, 2, 3,4,5]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '10%', '10%', 
                                                           '10%', '25%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5]
              }
          }
      ],
         ajax: {
          "url": 'settingsvendorCategoryTrash',
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
            url  : "settingsVendorCategorySubmit",
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
             toastr.success('The Vendor Category Name Already Exists');

          }
          else
          {
                  $('#VendorCategory_submit').removeClass('kt-spinner');
                  $('#VendorCategory_submit').prop("disabled", false);
                  closeModelcategory();
                  vendorcategorydetails_table.ajax.reload();
                  toastr.success('The Vendor Category Details '+sucess_msg+' Successfully');
                  
          }
                },
            error   : function ( jqXhr, json, errorThrown )
            {
               console.log('Error !!');
            }
        });
    });
function closeModelcategory() {
        $("#kt_modal_4_4").modal("hide");
        $('#id').val("");
        $('#vendor_category').val("");
        $('#description').val("");
        $('#color').val("");
        $('#customcode').val("");

        $('#startfrom').val("");

}
       $(document).on('click', '.Vendorcategorydetail_update', function(){
           var info_id = $(this).attr("data-id");
           $.ajax({
                url       : "settingsgetvendorcategory",
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
              url : 'settingsdeleteVendorCategory',
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
              url : 'settingsvendorCategoryRestoreTrash',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Restored!", "Your Vendor Category Entry has been Restored.", "success");
                window.location.href="settingsvendorcategorydetails";
             }
          });
          } else {
            swal.fire("Cancelled", "Your Vendor Category Entry is not Safe :)", "error");
          }
        })
     });

         var vendortypedetails_table = $('#vendortypedetails_list').DataTable({
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
          "url": 'settingsvendortypedetails',
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
          "url": 'settingsvendortypetrash',
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
     /*   if (description == "") {
            $('#description').addClass('is-invalid');
            return false;
        } else {
             $('#description').removeClass('is-invalid');
        }*/
        
      $(this).addClass('kt-spinner');
      $(this).prop("disabled", true);
      if($('#id').val()){
        var sucess_msg ='Updated';
      } else{
        var sucess_msg ='Created';
      }

        $.ajax({
            type : "POST",
            url  : "settingsVendorTypeSubmit",
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
                    closeModeltype();
                    vendortypedetails_table.ajax.reload();
                    toastr.success('The Vendor Type Details '+sucess_msg+' Successfully');
          }
            },
            error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
        });
        return false;
    });
function closeModeltype() {
        $("#kt_modal_4_4").modal("hide");
        $('#id').val("");
        $('#vendor_type').val("");
        $('#description').val("");
        $('#color').val("");
}

$(document).on('click', '.Vendortypedetail_update', function(){
           var info_id = $(this).attr("data-id");
           $.ajax({
                url       : "settingsgetvendortype",
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
              url : 'settingsdeleteVendorType',
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
              url : 'settingsVendorTypeRestoreTrash',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Restored!", "Your Vendor Type Entry has been Restored.", "Success");
                window.location.href="settingsvendortypedetails";
             }
          });
          } else {
            swal.fire("Cancelled", "Your Vendor Type Entry is not safe :)", "error");
          }
        })
     });
    
