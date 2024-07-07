$('.cost-estimation').addClass('kt-menu__item--active');
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
                        columns: [0, 1, 2, 3, 4, 5, 6]
                  }
            },
            {
                  extend: 'csv',
                  className: "hidden",
                  exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                  }
            },
            {
                  extend: 'excel',
                  className: "hidden",
                  exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                  }
            },
            {
                  extend: 'pdf',
                  className: "hidden",
                  exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                  },
                  pageSize: 'A4',
                  orientation: 'landscape',
                  customize: function (doc) {
                        doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
                        doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
                        doc.content[1].table.widths = ['10%', '11%', '11%', '11%', '11%', '11%', '11%'];
                  }
            },
            {
                  extend: 'print',
                  className: "hidden",
                  exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                  }
            }
            ],

            ajax: {
                  "url": 'cost-estimation',
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
                        data: 'id', name: 'id',
                        render: function (data, type, row) {
                              return '# ' + row.id + '&nbsp;&nbsp;';
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
                        data: 'cust_name', name: 'cust_name', render: function (data, type, row) {
                              var curData = row.cust_name;
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
                  {
                        data: 'estimation_status', name: 'estimation_status',
                        render: function (data, type, row) {
                              if (row.estimation_status == 1)
                                    return ' <span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Completed</span></span> ';
                              else
                                    return '<span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">Pending</span></span>';
                        }
                  },
                  // boq-send-to-tender
                  {
                        data: 'action',
                        name: 'action',
                        render: function (data, type, row) {
                              var j = '';
                              if (row.estimation_status == 1) {
                                    j = '<a data-type="edit" data-target="#kt_form" class="sendToTender"  data-id="' + row.id + '" ><li class="kt-nav__item">\
                                              <span class="kt-nav__link">\
                                              <i class="kt-nav__link-icon flaticon2-graph-1"></i>\
                                              <span class="kt-nav__link-text" data-id="' + row.id + '" >Send to Tender Department</span>\
                                              </span></li></a>\
                                              <a data-type="edit" data-target="#kt_form" class="estimationPending" data-id="' + row.id + '" ><li class="kt-nav__item">\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-graph-1"></i>\
                                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Send Back For Modification</span>\
                                    </span></li></a>';
                              } else {
                                    j = '<a data-type="edit" data-target="#kt_form" class="estimationCompleted" data-id="' + row.id + '" ><li class="kt-nav__item">\
                                    <span class="kt-nav__link">\
                                    <i class="kt-nav__link-icon flaticon2-graph-1"></i>\
                                    <span class="kt-nav__link-text" data-id="' + row.id + '" >Estimation Completed</span>\
                                    </span></li></a>';
                              }

                              return '<span style="overflow: visible; position: relative; width: 80px;">\
                                  <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                                              <i class="fa fa-cog"></i></a>\
                                              <div class="dropdown-menu dropdown-menu-right">\
                                              <ul class="kt-nav">'+ j + '\
                                             </ul></div></div></span>';

                              return null;
                        }
                  },
            ],
            columnDefs: [
                  { width: '50px', "orderable": false, "searchable": false, targets: [0, 7] },
                  { width: '20px', "searchable": false, targets: [6] },
                  { width: '70px', targets: [1, 2, 5] },
                  { width: '200px', targets: [4, 3] }
            ],
            fixedColumns: true,
      });
      // 
      $('#maindetails_list').on('click', 'tbody td', function () {
            var index = $(this).closest("td").index();
            if ((index) && (index != 7)) {
                  var data = maindetails_list_table.row(this).data();
                  window.location.href = 'cost-estimation-child?id=' + data.id;
            }
      });

      $(document).on('click', '.sendToTender', function () {
            var id = $(this).attr('data-id');
            swal.fire({
                  title: "Are you sure?",
                  text: "Do you want Send this BOQ to Tender",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Send",
                  cancelButtonText: "Cancel"
            }).then(result => {
                  if (result.value) {
                        // loaderShow();
                        $.ajax({
                              type: "POST",
                              url: "boq-send-to-tender",
                              dataType: "json",
                              data: {
                                    _token: $('#token').val(),
                                    id: id,
                              },
                              success: function (data) {
                                    if (data.status == 1) {
                                          toastr.success('BOQ Successfuly Send To Tender');
                                          location.reload(true);
                                    } else {
                                          swal.fire({
                                                title: "Error !!!",
                                                text: data.msg,
                                                type: "error",
                                          });
                                    }

                              },
                              error: function (jqXhr, json, errorThrown) {
                                    console.log('Error !!');
                              }
                        });

                  } else {
                        swal.fire("Cancelled", "", "error");
                  }
            })
      });
      // });

      $(document).on('click', '.estimationCompleted', function () {
            var id = $(this).attr('data-id');
            swal.fire({
                  title: "Are you sure?",
                  text: "Do you want to complete the Estimation",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Complete",
                  cancelButtonText: "Cancel"
            }).then(result => {
                  if (result.value) {
                        // loaderShow();
                        $.ajax({
                              type: "POST",
                              url: "boq-mark-estimation-completed",
                              dataType: "json",
                              data: {
                                    _token: $('#token').val(),
                                    id: id,
                              },
                              success: function (data) {
                                    if (data.status == 1) {
                                          toastr.success('BOQ Estimation Completed');
                                          location.reload(true);
                                    } else {
                                          swal.fire({
                                                title: "Error !!!",
                                                text: data.msg,
                                                type: "error",
                                          });
                                    }

                              },
                              error: function (jqXhr, json, errorThrown) {
                                    console.log('Error !!');
                              }
                        });

                  } else {
                        swal.fire("Cancelled", "", "error");
                  }
            })
      });




      $(document).on('click', '.estimationPending', function () {
            var id = $(this).attr('data-id');
            swal.fire({
                  title: "Are you sure?",
                  text: "Do you want to Send Back For Modification",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Send Back",
                  cancelButtonText: "Cancel"
            }).then(result => {
                  if (result.value) {
                        // loaderShow();
                        $.ajax({
                              type: "POST",
                              url: "boq-mark-estimation-pending",
                              dataType: "json",
                              data: {
                                    _token: $('#token').val(),
                                    id: id,
                              },
                              success: function (data) {
                                    if (data.status == 1) {
                                          toastr.success('BOQ  Successfuly Send Backed');
                                          location.reload(true);
                                    } else {
                                          swal.fire({
                                                title: "Error !!!",
                                                text: data.msg,
                                                type: "error",
                                          });
                                    }

                              },
                              error: function (jqXhr, json, errorThrown) {
                                    console.log('Error !!');
                              }
                        });

                  } else {
                        swal.fire("Cancelled", "", "error");
                  }
            })
      });

      // $('#maindetails_list').on('click', '.estimationCompleted', function () {
      //       alert('estimationCompleted');
      // });


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

