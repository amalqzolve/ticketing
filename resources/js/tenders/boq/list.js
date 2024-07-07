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
                  "url": 'estimated-boq-list',
                  "type": "POST",
                  "data": function (data) {
                        data._token = $('#token').val()
                  }
            },
            "rowCallback": function (row, data, index) {
                  $('td', row).css('cursor', 'pointer');
            },
            columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                  {
                        data: 'id',
                        name: 'id',
                        render: function (data, type, row) {
                              return '# ' + row.id + '&nbsp;&nbsp;';
                        }
                  },
                  {
                        data: 'type', name: 'type',
                        render: function (data, type, row) {
                              if (row.type == 1)
                                    return 'Tender';
                              else if (row.type == 2)
                                    return 'Project';
                              else
                                    return '-';
                        }
                  },
                  {
                        data: 'cust_name', name: 'cust_name', render: function (data, type, row) {
                              var curData = row.cust_name;
                              if (curData != null)
                                    return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                              else
                                    return '-';
                        }
                  },
                  {
                        data: 'tender_id', name: 'tender_id', render: function (data, type, row) {
                              if (row.type == 1)
                                    return 'TNDR ' + row.tender_id;
                              else
                                    return '-';
                        }
                  },
                  {
                        data: 'projectname', name: 'projectname', render: function (data, type, row) {
                              var curData = row.projectname;
                              if (curData != null)
                                    return curData.length > 100 ? curData.substr(0, 100) + '…' : curData;
                              else
                                    return '-';
                        }
                  },
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
                  // { data: 'profit_amount', name: 'profit_amount' },
                  // { data: 'net_amount', name: 'net_amount' },
                  // { data: 'vatamount', name: 'vatamount' },
                  {
                        data: 'profit_entered', name: 'profit_entered',
                        render: function (data, type, row) {
                              if (row.profit_entered == 1) {
                                    return '<span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Generated</span></span>';
                              } else
                                    return '<span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">Not Generated</span></span>';
                        }
                  },
                  {
                        data: 'action',
                        name: 'action',
                        render: function (data, type, row) {
                              var j = '';
                              j = '<a href="prepare-sales-proposal?id=' + row.id + '" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                              <span class="kt-nav__link">\
                              <i class="kt-nav__link-icon flaticon2-graph-1"></i>\
                              <span class="kt-nav__link-text" data-id="' + row.id + '" >Prepare Sales Proposal</span>\
                              </span></li></a>';

                              return '<span style="overflow: visible; position: relative; width: 80px;">\
                                  <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                              <i class="fa fa-cog"></i></a>\
                                              <div class="dropdown-menu dropdown-menu-right">\
                                              <ul class="kt-nav">'+ j + '\
                                             </ul></div></div></span>';
                        }
                  },
            ]
      });
      // 
      $('#maindetails_list').on('click', 'tbody td', function () {
            var index = $(this).closest("td").index();
            if (index != 9) {
                  var data = maindetails_list_table.row(this).data();
                  window.location.href = 'estimated-boq-list-child?id=' + data.id;
            }
      });

});

