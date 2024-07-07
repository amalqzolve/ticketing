   var rackmanagement_table = $('#rackmanagement_list').DataTable({
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
                  columns: [0, 1, 2, 3, 4, 5, 4, 5]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5]
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
                   doc.content[1].table.widths = [ '25%', '25%', '25%', '25%'];
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5]
              }
          }
      ],

      ajax: {
          "url": 'assetRackManagement',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'id', name: 'id' },
          
          { data: 'name', name: 'name' },
          { data: 'storename', name: 'storename' },
          { data: 'rack_name', name: 'rack_name' },
          { data: 'rack_manager', name: 'rack_manager' },
          { data: 'incharge', name: 'incharge' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_rack?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a href="view_rack?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_rack_management_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });
 $(document).on('click', '#rackmanagement_submit', function(e){
       e.preventDefault();
                        warehouse             = $('#warehouse').val();
                        store                 = $('#store').val();
                        rackname              = $('#rackname').val();
                        rackmanger            = $('#rackmanger').val();
                        rackincharge          = $('#rackincharge').val();
        if (warehouse == "") { 
           $('#warehouse').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Address is required.');     
            return false;
        }
         else {
           $('#warehouse').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
         if (store=="") {
         $('#store').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Store is required.');     
         return false;
         } 
         else{
            $('#store').next().find('.select2-selection').removeClass('select-dropdown-error');
         } 
         if (rackname=="") {
         $('#rackname').addClass('is-invalid');
            toastr.warning('Rack Name is required.');     
         return false;
         } 
         else{
            $('#rackname').removeClass('is-invalid');
         } 
        
         
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        if($('#id').val()){
        var sucess_msg ='Updated';
        } else{
        var sucess_msg ='Created';
        }
        $.ajax({
            type      : "POST",
            url       : "assetrackmanagement_submit",
            dataType  : "json",
            data : {
                        _token                : $('#token').val(),
                        id                    : $('#id').val(),
                        warehouse             : $('#warehouse').val(),
                        store                 : $('#store').val(),
                        rackname              : $('#rackname').val(),
                        rackmanger            : $('#rackmanger').val(),
                        rackincharge          : $('#rackincharge').val(),
                        branch                : $('#branch').val(),
                        checkedValue     : $('#default').is(":checked"),
                    },
            success: function(data){
          
         
                  $('#rackmanagement_submit').removeClass('kt-spinner');
                  $('#rackmanagement_submit').prop("disabled", false);
                  rackmanagement_table.ajax.reload();
                  toastr.success('Rack Management Details '+sucess_msg+' Successfuly');
                  window.location.href="assetRackManagement";
                
            },
            error   : function ( jqXhr, json, errorThrown )
            {
             console.log('Error !!');
            }
          });
        });