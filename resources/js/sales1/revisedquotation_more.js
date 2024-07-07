var morerevisedquotationdetails_list_table = $('#morerevisedquotationdetails_list').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'viewmore_revisedquotation',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
                 data.id =  $('#quote_id').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'quote_id',
              name: 'quote_id',
              render: function(data, type, row) {
                  return '#' + row.quote_id + '&nbsp;&nbsp;';
              }
          },
          { data: 'version', name: 'version' },

          { data: 'quotedate', name: 'quotedate' },

          { data: 'validity', name: 'validity' },
          { data: 'cust_name', name: 'cust_name', },
          { data: 'reference', name: 'reference' },
          { data: 'attention', name: 'attention' },
          { data: 'name', name: 'name' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },
          
          { data: 'status' , name: 'status'},

          {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="view_revisedquotation_more?version=' + row.version + '" data-type="view"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.version + '" >View</span>\
                        </span></li></a>\
                         </ul></div></div></span>';

            }
        },

      ]
  });