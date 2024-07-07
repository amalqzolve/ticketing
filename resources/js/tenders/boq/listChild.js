$('.estimated-boq-list').addClass('kt-menu__item--active');
$(document).ready(function () {

      var maindetails_list_table = $('#maindetails_list').DataTable({
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                  }
            },
            {
                  extend: 'csv',
                  className: "hidden",
                  exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                  }
            },
            {
                  extend: 'excel',
                  className: "hidden",
                  exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                  }
            },
            {
                  extend: 'pdf',
                  className: "hidden",
                  exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                  },
                  pageSize: 'A4',
                  orientation: 'landscape',
                  customize: function (doc) {
                        doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
                        doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
                        doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%', '5%', '5%', '5%', '5%'];
                  }
            },
            {
                  extend: 'print',
                  className: "hidden",
                  exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                  }
            }
            ],

            ajax: {
                  "url": 'estimated-boq-list-child',
                  "type": "POST",
                  "data": function (data) {
                        data._token = $('#token').val(),
                              data.id = $('#parent').val()
                  }
            },
            "rowCallback": function (row, data, index) {
                  if (data.is_parent == 1) {
                        $('td', row).css('background-color', 'orange');
                        $('td', row).css('cursor', 'pointer');
                  }

            },
            columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                  { data: 'id', name: 'id' },
                  { data: 'category_code', name: 'category_code' },
                  {
                        data: 'category_name', name: 'category_name', render: function (data, type, row) {
                              var curData = row.category_name;
                              if (curData != null)
                                    return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                              else
                                    return '-';
                        }
                  },
                  { data: 'estimation_amount', name: 'estimation_amount' },
                  { data: 'profit_amount', name: 'profit_amount' },
                  { data: 'net_amount', name: 'net_amount' },
                  { data: 'vatamount', name: 'vatamount' },
                  { data: 'totalamount', name: 'totalamount' },
                  {
                        data: 'action',
                        name: 'action',
                        render: function (data, type, row) {
                              var j = '';
                              if (row.is_parent != 1) {
                                    j = '<a href="generate-proposal?id=' + row.id + '" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-graph-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >Generate Proposal</span>\
                            </span></li></a>\
                            <a href="cost-describe-view?id=' + row.id + '" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                            <span class="kt-nav__link">\
                            <i class="kt-nav__link-icon flaticon2-graph-1"></i>\
                            <span class="kt-nav__link-text" data-id="' + row.id + '" >View Estimation</span>\
                            </span></li></a>';

                                    return '<span style="overflow: visible; position: relative; width: 80px;">\
                            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                            <i class="fa fa-cog"></i></a>\
                            <div class="dropdown-menu dropdown-menu-right">\
                            <ul class="kt-nav">'+ j + '\
                           </ul></div></div></span>';
                              } else
                                    return null;
                        }
                  },
            ]
      });
      // 
      $('#maindetails_list').on('click', 'tbody td', function () {
            var index = $(this).closest("td").index();
            // if ((index) && (index != 9)) {
            var data = maindetails_list_table.row(this).data();
            // alert(data.is_parent);
            if (data.is_parent)
                  window.location.href = 'estimated-boq-list-child?id=' + data.id;
            // }
      });

});

