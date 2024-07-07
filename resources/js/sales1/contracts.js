$(document).on('click', '#contracts_submit', function(e) {
    e.preventDefault();    



        customer      = $('#customer').val();
        contractname     = $('#contractname').val();
        startingdate     = $('#startingdate').val();
        endingdate      = $('#endingdate').val();
        contractamount     = $('#contractamount').val();
        contractvatamount      = $('#contractvatamount').val();
        contractno = $('#contractno').val();
        contractreference = $('#contractreference').val();
        invoice_no = $('#invoice_no').val();

             if (customer == "") {
            $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any Customer!");
                      return false;
        } else {
            $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
        }

           if (contractname == "") {
            $('#contractname').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#contractname').removeClass('is-invalid');
         }


     if (startingdate == "") {
            $('#startingdate').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#startingdate').removeClass('is-invalid');
         }

     if (endingdate == "") {
            $('#endingdate').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#endingdate').removeClass('is-invalid');
         }

     if (contractamount == "") {
            $('#contractamount').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#contractamount').removeClass('is-invalid');
         }

     if (contractvatamount == "") {
            $('#contractvatamount').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#contractvatamount').removeClass('is-invalid');
         }

     if (contractno == "") {
            $('#contractno').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#contractno').removeClass('is-invalid');
         }

       if (contractreference == "") {
            $('#contractreference').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any contract reference!");
                      return false;
        } else {
            $('#contractreference').next().find('.select2-selection').removeClass('select-dropdown-error');
        }


         if (invoice_no == "") {
            $('#invoice_no').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any Refernce no!");
                      return false;
        } else {
            $('#invoice_no').next().find('.select2-selection').removeClass('select-dropdown-error');
        }


    $.ajax({
        type: "POST",
        url: "contract_submit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
              customer      : $('#customer').val(),
        contractname     : $('#contractname').val(),
        startingdate      : $('#startingdate').val(),
        endingdate      : $('#endingdate').val(),
        contractamount     : $('#contractamount').val(),
        contractvatamount     : $('#contractvatamount').val(),
        contractno  : $('#contractno').val(),
        contractreference : $('#contractreference').val(),
        invoice_no  : $('#invoice_no').val(),
        notes  : $('#notes').val(),
        
        },
        success: function(data) {
              window.location.href = "contracts";
           
             toastr.success('Successfully Added');
           
        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log(errorThrown);
           
        }
    }); 

});

var contractdetails_list_table = $('#contractdetails_list').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><a href="contracts_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });
$(document).on('click', '#contracts_update', function(e) {
    e.preventDefault();    



        customer      = $('#customer').val();
        contractname     = $('#contractname').val();
        startingdate     = $('#startingdate').val();
        endingdate      = $('#endingdate').val();
        contractamount     = $('#contractamount').val();
        contractvatamount      = $('#contractvatamount').val();
        contractno = $('#contractno').val();
        contractreference = $('#contractreference').val();
        invoice_no = $('#invoice_no').val();

             if (customer == "") {
            $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any Customer!");
                      return false;
        } else {
            $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
        }

           if (contractname == "") {
            $('#contractname').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#contractname').removeClass('is-invalid');
         }


     if (startingdate == "") {
            $('#startingdate').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#startingdate').removeClass('is-invalid');
         }

     if (endingdate == "") {
            $('#endingdate').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#endingdate').removeClass('is-invalid');
         }

     if (contractamount == "") {
            $('#contractamount').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#contractamount').removeClass('is-invalid');
         }

     if (contractvatamount == "") {
            $('#contractvatamount').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#contractvatamount').removeClass('is-invalid');
         }

     if (contractno == "") {
            $('#contractno').addClass('is-invalid');
            toastr.warning("Please Add contract name!");
            return false;
        } else {
             $('#contractno').removeClass('is-invalid');
         }

       if (contractreference == "") {
            $('#contractreference').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any contract reference!");
                      return false;
        } else {
            $('#contractreference').next().find('.select2-selection').removeClass('select-dropdown-error');
        }


         if (invoice_no == "") {
            $('#invoice_no').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any Refernce no!");
                      return false;
        } else {
            $('#invoice_no').next().find('.select2-selection').removeClass('select-dropdown-error');
        }


    $.ajax({
        type: "POST",
        url: "contracts_update",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            id : $('#id').val(),
              customer      : $('#customer').val(),
        contractname     : $('#contractname').val(),
        startingdate      : $('#startingdate').val(),
        endingdate      : $('#endingdate').val(),
        contractamount     : $('#contractamount').val(),
        contractvatamount     : $('#contractvatamount').val(),
        contractno  : $('#contractno').val(),
        contractreference : $('#contractreference').val(),
        invoice_no  : $('#invoice_no').val(),
        notes  : $('#notes').val(),
        
        },
        success: function(data) {
              window.location.href = "contracts";
           
             toastr.success('Successfully Updated');
           
        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log(errorThrown);
           
        }
    }); 

});

$(document).on('click', '.contract_delete', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!"
        }).then(result => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: 'delete-contract',
                    data: {
                        _token: $('#token').val(),
                        id: id
                    },
                    success: function(data) {
                     
                        swal.fire("Deleted!", "Your Entry has been deleted.", "success");
                        location.reload();
                    }
                });
            } else {

                swal.fire("Cancelled", "Your Entry is safe :)", "error");
            }
        })
    });





var contractdetails_list_January_table = $('#contractdetails_list_January').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 1
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });




var contractdetails_list_February_table = $('#contractdetails_list_February').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 2
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });




var contractdetails_list_March_table = $('#contractdetails_list_March').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 3
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });



var contractdetails_list_April_table = $('#contractdetails_list_April').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 4
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });



var contractdetails_list_May_table = $('#contractdetails_list_May').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 5
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });




var contractdetails_list_June_table = $('#contractdetails_list_June').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 6
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });




var contractdetails_list_July_table = $('#contractdetails_list_July').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 7
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });




var contractdetails_list_August_table = $('#contractdetails_list_August').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 8
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });



var contractdetails_list_September_table = $('#contractdetails_list_September').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 9
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });



var contractdetails_list_October_table = $('#contractdetails_list_October').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 10
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });





var contractdetails_list_November_table = $('#contractdetails_list_November').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 11
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });




var contractdetails_list_December_table = $('#contractdetails_list_December').DataTable({
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
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'contracts',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.month = 12
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'contractname',
              name: 'contractname',
             
          },
           
          { data: 'startingdate', name: 'startingdate'},
          { data: 'endingdate', name: 'endingdate'},

          { data: 'contractamount', name: 'contractamount'},
          

          { data: 'cust_name', name: 'cust_name' },
                {
              data: 'endingdate',
              name: 'endingdate',
              render: function(data, type, row) {

                var now = new Date();
var startValidAppDate = new Date(row.endingdate);
/*alert(startValidAppDate);
alert(now);*/
if(startValidAppDate>now){
     return 'Expired';
}else{
    return 'Active';
}


                  
              }
          },
           
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     
                       
                    j+='<a href="contracts_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text contract_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>';
                  

                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });