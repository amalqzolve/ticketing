  /**
     *Datatable for asset group
     */
        $(document.body).on("keyup  change", "#phone", function() 
 {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));  
    }); 


  var storekeepers_list_table = $('#storekeepers_list').DataTable({
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
                  columns: [0, 1, 2,3,4,5]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2,3,4,5]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2,3,4,5]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2,3,4,5]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50]
                  doc.content[1].table.widths = [ '10%', '45%', '45%'];
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2,3,4,5]
              }
          }
      ],

      ajax: {
          "url": 'Storekeepers',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'name', name: 'name' },
          { data: 'code', name: 'code' },
          { data: 'city', name: 'city' },
          { data: 'phone', name: 'phone' },
          { data: 'email', name: 'email' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="storekeeperupdate?id=' + row.id + '"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text " data-id="' + row.id +'" >Edit</span>\
                        </span></li></a>\
                        <a href="view_storekeeper?id=' + row.id + '"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text " data-id="' + row.id +'" >View</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_storekeeperinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },

      ]
  });


   /**
     *asset group submit action
     */

$(document).on('click', '#storekeeper_submit', function(e) {
    e.preventDefault();

        storekeepername = $('#storekeepername').val();
        code        = $('#code').val();
        city        = $('#city').val();
        country     = $('#country_region').val();
        phone       = $('#phone').val();
        email       = $('#email').val();

        if (storekeepername == ""){
            $('#storekeepername').addClass('is-invalid');
            toastr.warning('Store Keeper Name is required.');     
            return false;
        }else{
            $('#storekeepername').removeClass('is-invalid');
        }



        if (phone == ""){
            $('#phone').addClass('is-invalid');
            toastr.warning('Phone is required.');     
            return false;
        }else{
            $('#phone').removeClass('is-invalid');
        }



        var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
                if (!filter.test(phone)) 
                {
                    //toastr.warning('Please Enter Valid Phone Number.');
                     return false;
                }
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if ( !emailReg.test( email ) ) 
            {
                toastr.warning('Please enter valid email.');
             return false;
            } 
       /* if (code=="") {
         $('#code').addClass('is-invalid');
            toastr.warning('Code is required.');     

         return false;
         } 
         else{
            $('#code').removeClass('is-invalid');
         }
         if (city=="") {
         $('#city').addClass('is-invalid');
            toastr.warning('City is required.');     
         return false;
         } 
         else{
            $('#city').removeClass('is-invalid');
         }
         if (country == "") { 
         $('#country_region').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Country is required.');     
        return false;
        }
         else {
           $('#country_region').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (phone=="") {
         $('#phone').addClass('is-invalid');
            toastr.warning('Phone Number is required.');     
         return false;
         } 
         else{
            $('#phone').removeClass('is-invalid');
         } 
         var filter = /^(?:\+\d{2})?\d{10}(?:,(?:\+\d{2})?\d{15})*$/;
                if (!filter.test(phone)) 
                {
                    //toastr.warning('Please Enter Valid Phone Number.');
                     return false;
                }
         if (email=="") {
         $('#email').addClass('is-invalid');
        toastr.warning('Please Select valid email address example:a@gmail.com');
         
         return false;
         } 
         else{
            $('#email').removeClass('is-invalid');
         }
         var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if ( !emailReg.test( email ) ) 
            {
                toastr.warning('Please enter valid email.');
             return false;
            } 
*/
     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Updated';
     } else
     {
          var sucess_msg ='Created';
     }
    

    $.ajax({
        type: "POST",
        url: "storekeepersubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            storekeepername: $('#storekeepername').val(),
            code        : $('#code').val(),
            city        : $('#city').val(),
            country     : $('#country_region').val(),
            phone       : $('#phone').val(),
            email       : $('#email').val(),
            branch      : $('#branch').val()
        },
        success: function(data) {

        if(data == 'false')
          {
            $('#storekeeper_submit').removeClass('kt-spinner');
            $('#storekeeper_submit').prop("disabled", false);
            toastr.warning('Storekeepers name already exist');
          }
          else
          {
             $('#storekeeper_submit').removeClass('kt-spinner');
             $('#storekeeper_submit').prop("disabled", false);
             // closeModel();
             storekeepers_list_table.ajax.reload();

             // storemanagers_list_table.fnDraw();
             toastr.success('Store Keeper '+sucess_msg+' successfuly');
             window.location.href = "Storekeepers";
           }


        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

/**
     *Asset group get data for update 
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
     *Asset group deletion
     */

$(document).on('click', '.kt_del_storekeeperinformation', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
            }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: 'deletestorekeeper',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {
                    swal.fire("Deleted!", "Your Entry has been deleted.", "success");
                    storekeepers_list_table.ajax.reload();
                    storekeepers_list_table.fnDraw();

                }
            });
        } else {
            swal.fire("Cancelled", "Your Entry is safe ", "error");

        }
    })
});

/**
     *Datatable for asset group
     */
 
  var storekeepers_trash_list_table = $('#storekeepers_trash_list').DataTable({
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
                  columns: [0, 1, 2,3,4,5]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2,3,4,5]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2,3,4,5]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2,3,4,5]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50];
                  doc.content[1].table.widths = [ '10%', '45%', '45%'];
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2,3,4,5]
              }
          }
      ],

      ajax: {
          "url": 'Trash-storekeeper',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'name', name: 'name' },
          { data: 'code', name: 'code' },
          { data: 'city', name: 'city' },
          { data: 'phone', name: 'phone' },
          { data: 'email', name: 'email' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-refresh-arrow"></i>\
                        <span class="kt-nav__link-text restorestorekeeper" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';
              }
          },

      ]
  });

  /**
     *Asset group data restore
     */

$(document).on('click', '.restorestorekeeper', function() {
    var id = $(this).attr('id');
    
    swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: 'storekeepertrashrestore',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {
                    swal.fire("Restored!", "Your Entry has been Restored.", "success");
                   window.location.href = "Storekeepers";
                  
                }
            });
        } else {
            swal.fire("Cancelled", "Your Entry is safe ", "error");

        }
    })
});
$(document).on('click', '.deletestorekeeper', function() {
    var id = $(this).attr('id');
    
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Deleted it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: 'storekeepertrashdelete',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {
                    swal.fire("Deleted!", "Your Entry has been Deleted.", "success");
                    storekeepers_trash_list_table.ajax.reload();
                    storekeepers_trash_list_table.fnDraw();
                  
                }
            });
        } else {
            swal.fire("Cancelled", "Your Entry is safe ", "error");

        }
    })
});
/**
   *Asset Group DataTable Export
   */

  $("#storekeepers_list_print").on("click", function() {
      storekeepers_list_table.button('.buttons-print').trigger();
  });


  $("#storekeepers_list_copy").on("click", function() {
      storekeepers_list_table.button('.buttons-copy').trigger();
  });

  $("#storekeepers_list_csv").on("click", function() {
      storekeepers_list_table.button('.buttons-csv').trigger();
  });

  $("#storekeepers_list_pdf").on("click", function() {
      storekeepers_list_table.button('.buttons-pdf').trigger();
  });

  /**
   *Asset Group Trash DataTable Export
   */

  $("#storekeepers_trash_list_print").on("click", function() {
      storekeepers_trash_list_table.button('.buttons-print').trigger();
  });


  $("#storekeepers_trash_list_copy").on("click", function() {
      storekeepers_trash_list_table.button('.buttons-copy').trigger();
  });

  $("#storekeepers_trash_list_csv").on("click", function() {
      storekeepers_trash_list_table.button('.buttons-csv').trigger();
  });

  $("#storekeepers_trash_list_pdf").on("click", function() {
      storekeepers_trash_list_table.button('.buttons-pdf').trigger();
  });

      