  /**
     *Datatable for customer group
     */
 
  var customergroupdetails_table = $('#customergroupdetails_list').DataTable({
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
          "url": 'customergroup',
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
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_groupinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },

      ]
  });


 /**
     *Function call for close button
     */

$(document).on('click', '.close,.closeBtn', function() {

    closeModel();

});

function closeModel() {

    $("#kt_modal_4_5").modal("hide");
    $('#id').val("");
    $('#title').val("");
    $('#description').val("");
    $('#color').val("");

}

 /**
     *Customer group submit action
     */

$(document).on('click', '#Group_submit', function(e) {
    e.preventDefault();

        title = $('#title').val();
        color = $('#color').val();
        description = $('#description').val();

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
        type: "POST",
        url: "CustGroupinfo",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            title: $('#title').val(),
            description: $('#description').val(),
            color: $('#color').val(),
            branch : $('#branch').val(),
            default_grp  : $('#grpdefault').val()
        },
        success: function(data) {
         


          if(data == false)
          {
            $('#Group_submit').removeClass('kt-spinner');
             $('#Group_submit').prop("disabled", false);
             toastr.success('customer group name is already exist');

          }
          else
          {
             $('#Group_submit').removeClass('kt-spinner');
             $('#Group_submit').prop("disabled", false);
             closeModel();
             customergroupdetails_table.ajax.reload();
             toastr.success('customer group '+sucess_msg+' successfuly');
           }

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

/**
     *Customer group get data for update 
     */


$(document).on('click', '.Groupupdate', function() {

    var info_id = $(this).attr("data-id");
    $.ajax({
        url: "getgroupupdate",
        method: "POST",
        data: {
            _token: $('#token').val(),
            info_id: info_id
        },
        dataType: "json",
        success: function(data) {
            $('#title').val(data['users'].title);
            $('#description').val(data['users'].description);
            $('#color').val(data['users'].color);
            $('#id').val(info_id);
        }
    })
});
/**
     *Customer group deletion
     */

$(document).on('click', '.kt_del_groupinformation', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Customer Group Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
            }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: 'deletegroup',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {
                  console.log(data);
                   if(data == 'true')
                    {
                   swal.fire("Deleted!", "Your Group has been deleted.", "success");
                   customergroupdetails_table.ajax.reload();
                    }
                    else
                    {
                   swal.fire("Not Deleted!", "Your Group is used in Customer Details.", "success");
                   customergroupdetails_table.ajax.reload();
                    }

                }
            });
        } else {
            swal.fire("Cancelled", "Your Customer Group Entry is safe :)", "error");

        }
    })
});

/**
     *Customer group data restore
     */

$(document).on('click', '.grouprestoredetails', function() {
    var id = $(this).attr('id');
    
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Customer Group Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: 'grouptrashrestore',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {
                    swal.fire("Restored!", "Your Customer Group Entry has been Restored.", "success");
                    window.location.href ="customergroup";
                  
                }
            });
        } else {
            swal.fire("Cancelled", "Your Customer Group Entry is safe :)", "error");

        }
    })
});
/**
     *Customer group  trash datatable
     */

    var trashgroupdetails_table = $('#trashgroupdetails').DataTable({
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
          "url": 'grouptrash',
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
                        <span class="kt-nav__link-text grouprestoredetails" id='+row.id+' data-id="'+row.id+'" >Restore</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
            }},
            
        ]
    });
    
 

/**
   *Customer Group DataTable Export
   */

  $("#customergroupdetails_list_print").on("click", function() {
      customergroupdetails_table.button('.buttons-print').trigger();
  });


  $("#customergroupdetails_list_copy").on("click", function() {
      customergroupdetails_table.button('.buttons-copy').trigger();
  });

  $("#customergroupdetails_list_csv").on("click", function() {
      customergroupdetails_table.button('.buttons-csv').trigger();
  });

  $("#customergroupdetails_list_pdf").on("click", function() {
      customergroupdetails_table.button('.buttons-pdf').trigger();
  });

  /**
   *Customer Group trash DataTable Export
   */

  $("#trashgroupdetails_print").on("click", function() {
      trashgroupdetails_table.button('.buttons-print').trigger();
  });


  $("#trashgroupdetails_copy").on("click", function() {
      trashgroupdetails_table.button('.buttons-copy').trigger();
  });

  $("#trashgroupdetails_csv").on("click", function() {
      trashgroupdetails_table.button('.buttons-csv').trigger();
  });

  $("#trashgroupdetails_pdf").on("click", function() {
      trashgroupdetails_table.button('.buttons-pdf').trigger();
  });