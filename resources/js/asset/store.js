  var storemanagement_table = $('#storemanagement_list').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7]
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
                  columns: [0, 1, 2, 3,4,5,6,7]
              }
          }
      ],

      ajax: {
          "url": 'assetStoreManagement',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'id', name: 'id' },
          
          { data: 'warehouse_name', name: 'warehouse_name' },
          { data: 'store_name', name: 'store_name' },
          { data: 'manager', name: 'manager' },
          { data: 'incharge', name: 'incharge' },
          { data: 'store_location', name: 'store_location' },
          { data: 'keeper', name: 'keeper' },
          { data: 'total_rack_availability', name: 'total_rack_availability' },
          
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_store?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a href="view_store?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_store_management_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });
$(document).on('click', '#storemanagement_submit', function(e){
       e.preventDefault();
        warehouse             = $('#warehouse').val();
        storename             = $("input[name=storename]").val();
        storemanager          = $('#storemanager').val();
        storeincharge         = $('#storeincharge').val();
        storelocation         = $('#storelocation').val();
        storekeeper           = $('#storekeeper').val();
        rackavailability      = $('#rackavailability').val();
        if (warehouse == "") { 
           $('#warehouse').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Warehouse Name is required.');    
            return false;
        }
         else {
           $('#warehouse').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
         if (storename=="") {
         $('#storename').addClass('is-invalid');
            toastr.warning('Store Name is required.');     
         return false;
         } 
         else{
            $('#storename').removeClass('is-invalid');
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
            url  : "assetstoremanagement_submit",
            dataType  : "json",
            data : {
                        _token                : $('#token').val(),
                        id                    : $('#id').val(),
                        warehouse             : $('#warehouse').val(),
                        storename             : $('#storename').val(),
                        storemanager          : $('#storemanager').val(),
                        storeincharge         : $('#storeincharge').val(),
                        storelocation         : $('#storelocation').val(),
                        storekeeper           : $('#storekeeper').val(),
                        rackavailability      : $('#rackavailability').val(),
                        branch                : $('#branch').val(),
                        checkedValue     : $('#default').is(":checked"),
                    },
            success: function(data){
         
                    $('#storemanagement_submit').removeClass('kt-spinner');
                    $('#storemanagement_submit').prop("disabled", false);
                    storemanagement_table.ajax.reload();
                    toastr.success('Store Management Details '+sucess_msg+' Successfuly');
                     window.location.href = "assetStoreManagement";
          
            },
            error   : function ( jqXhr, json, errorThrown )
            {
                   console.log('Error !!');
             }
        });
    });