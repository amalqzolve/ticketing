$('.estimattionMenu').addClass('kt-menu__item--open');
$('.list-boq-estimation-pending').addClass('kt-menu__item--active');
$(document).ready(function () {

      var maindetails_list_table = $('#maindetails_list').DataTable({
            processing: true,
            serverSide: true,
            pagingType: "full_numbers",
            dom: 'Blfrtip',
            lengthMenu: [
                  [10, 20, 50, -1],
                  [10, 20, 50, "All"]
            ],
            "pageLength": 20,
            buttons: [{
                  extend: 'copy',
                  className: "hidden",
                  exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
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
                        columns: [0, 1, 2, 3, 4, 5]
                  },
                  pageSize: 'A4',
                  orientation: 'landscape',
                  customize: function (doc) {
                        doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
                        doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
                        doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%'];
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
                  "url": 'view-childen-estimation-pending',
                  "type": "POST",
                  "data": function (data) {
                        data._token = $('#token').val(),
                              data.id = $('#parent').val()
                  }
            },
            "rowCallback": function (row, data, index) {
                  if (data.is_parent == 1) {
                        $('td', row).addClass('table-warning');
                        $('td', row).css('cursor', 'pointer');
                  }

            },
            columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                  { data: 'id', name: 'id' },
                  { data: 'category_code', name: 'category_code' },
                  {
                        data: 'ref', name: 'ref',
                        render: function (data, type, row) {
                              var curData = row.ref;
                              if (curData != null)
                                    return curData.length > 120 ? curData.substr(0, 120) + '…' : curData;
                              else
                                    return '-';
                        }
                  },
                  {
                        data: 'category_name', name: 'category_name',
                        render: function (data, type, row) {
                              var curData = row.category_name;
                              if (curData != null)
                                    return curData.length > 120 ? curData.substr(0, 120) + '…' : curData;
                              else
                                    return '-';
                        }
                  },
                  { data: 'total_amount', name: 'total_amount' },
            ],
            columnDefs: [{
                  "targets": 0,
                  "orderable": false
            }],
      });
      // 
      $('#maindetails_list').on('click', 'tbody td', function () {
            var index = $(this).closest("td").index();
            if ((index) && (index != 6)) {
                  var data = maindetails_list_table.row(this).data();
                  if (data.is_parent)
                        window.location.href = 'view-childen-estimation-pending?id=' + data.id;
            }
      });

      $("#checkall").click(function () {
            $('input:checkbox.vcheck').not(this).prop('checked', this.checked);
      });

      $(document).on('click', '.checkall,.vcheck', function () {
            var voucher_id = {};
            voucher_id.checkselected = [];
            voucher_id.checkselectedvalues = [];
            $("input:checkbox").each(function () {
                  var $this = $(this);

                  if ($this.is(":checked")) {
                        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
                        if (numberRegex.test($this.attr("id"))) {
                              voucher_id.checkselected.push($this.attr("id"));
                        }
                        //voucher_id.checkselectedvalues.push($this.val());
                  } else {
                        //
                  }
            })
            var iddds = '';
            if (voucher_id.checkselected.length > 0) {
                  $(".bulk").show();
                  var iddds = voucher_id.checkselected;
                  $('#iddds').val(iddds);
            } else {
                  $(".bulk").hide();
            }
      });

      $('#maindetails_list').on('click', '.viewchilden', function () {
            if ($(this).data('href'))
                  window.location.href = $(this).data('href');
      });
      $("#export-button-print").on("click", function () {
            maindetails_list_table.button('.buttons-print').trigger();
      });
      $("#export-button-copy").on("click", function () {
            maindetails_list_table.button('.buttons-copy').trigger();
      });
      $("#export-button-csv").on("click", function () {
            maindetails_list_table.button('.buttons-csv').trigger();
      });
      $("#export-button-pdf").on("click", function () {
            maindetails_list_table.button('.buttons-pdf').trigger();
      });
});
