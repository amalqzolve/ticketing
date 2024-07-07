var stockadjustmentdetails_list_table = $('#stockadjustmentdetails_list').DataTable({
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
          "url": 'stockadjustment',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'variants', name: 'variants' },
          { data: 'batchname', name: 'batchname' },
          { data: 'stock', name: 'stock' },
          { data: 'sales_price', name: 'sales_price' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_stock_adjustment?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
              }
          },
      ]
  });

$(document).on('click', '#stockadjustment_submit', function(e) {
    e.preventDefault();

        productname = $('#productname').val();
        batch       = $('#batch').val();
        stock       = $('#stock').val();


        if (productname == ""){
            $('#productname').addClass('is-invalid');
            return false;
        }else{
            $('#productname').removeClass('is-invalid');
        }



             if (batch == ""){
            $('#batch').addClass('is-invalid');
            return false;
        }else{
            $('#batch').removeClass('is-invalid');
        }

             if (stock == ""){
            $('#stock').addClass('is-invalid');
            return false;
        }else{
            $('#stock').removeClass('is-invalid');
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
        url: "stockadjustmentsubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            batch    : $('#batch').val(),
            stock    : $('#stock').val(),
        },
        success: function(data) {
          console.log(data);
           if(data == false)
          {
            $('#stockadjustment_submit').removeClass('kt-spinner');
            $('#stockadjustment_submit').prop("disabled", false);
             toastr.warning('Product name is already exist');

          }
          else
          {
             $('#stockadjustment_submit').removeClass('kt-spinner');
             $('#stockadjustment_submit').prop("disabled", false);
              window.location.href = "stockadjustment";
             toastr.success('Stock Details '+sucess_msg+' successfuly');
             closeModel();
          }

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});