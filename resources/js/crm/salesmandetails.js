var table = $('#trashsalesmandetails').DataTable({
        "dom"        : 'B<"top"f>rt<"bottom"lp>',
        "lengthMenu" : [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        "buttons": [
            {
                extend: 'pageLength',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'copy',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'csv',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'excel',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'pdf',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
                }

            },
            {
                extend: 'print',
                text: 'Print all (not just selected)',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
        ],
        "select": {
            style   :  'os',
            selector: 'td:first-child'
        },
        select: true,
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": [ 'odd-row', 'even-row' ],
        "order": [],

        "ajax": {
            "url" : 'Salesmandetailstrash',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }
    });
/**
 *Datatable for Sales Man Information
 */
var salesmandetailslist_table = $('#salesmandetailslist').DataTable({
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
                columns: [0, 1, 2, 3,4,5]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3,4,5]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3,4,5]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3,4,5]
            },
            pageSize: 'A4',
            orientation: 'landscape',
            customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '10%', '10%', 
                                                           '10%', '15%'];
                       }
        },
        {
            extend: 'print',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3,4,5]
            }
        }
    ],

    ajax: {
        "url": 'salesmandetailssettings',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'name', name: 'name' },
        { data: 'place', name: 'place' },
        { data: 'salesman_route', name: 'salesman_route' },
        { data: 'commission', name: 'commission' },
        { data: 'target', name: 'target' },
        { data: 'id', name: 'id' },
        
        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_salesman?id=' + row.id + '" data-type="edit"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text Customersdetail_update" id=' + row.id + ' data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_salesmaninformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});
/**
   *salesman details DataTable Export
*/
  $("#salesmandetails_list_print").on("click", function() {
      salesmandetailslist_table.button('.buttons-print').trigger();
  });
  $("#salesmandetails_list_copy").on("click", function() {
      salesmandetailslist_table.button('.buttons-copy').trigger();
  });
  $("#salesmandetails_list_csv").on("click", function() {
      salesmandetailslist_table.button('.buttons-csv').trigger();
  });
  $("#salesmandetails_list_pdf").on("click", function() {
      salesmandetailslist_table.button('.buttons-pdf').trigger();
  });
// var table = $('#salesmandetailslist').DataTable({
//         "dom"        : 'B<"top"f>rt<"bottom"lp>',
//         "lengthMenu" : [
//             [ 10, 25, 50, -1 ],
//             [ '10 rows', '25 rows', '50 rows', 'Show all' ]
//         ],
//         "buttons": [
//             {
//                 extend: 'pageLength',
//                 className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//             },
//             {
//                 extend: 'copy',
//                 className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//             },
//             {
//                 extend: 'csv',
//                 className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//             },
//             {
//                 extend: 'excel',
//                 className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//             },
//             {
//                 extend: 'pdf',
//                 className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
//                 exportOptions: {
//                     columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
//                 }
//             },
//             {
//                 extend: 'print',
//                 text: 'Print all (not just selected)',
//                 className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
//                 exportOptions: {
//                     modifier: {
//                         selected: null
//                     }
//                 }
//             }
//         ],
//         "select": {
//             style   :  'os',
//             selector: 'td:first-child'
//         },
//         select: true,
//         "pagingType": 'full_numbers',
//         "iDisplayLength": 10,
//         "processing": true,
//         "serverSide": true,
//         "responsive": true,
//         "stripeClasses": [ 'odd-row', 'even-row' ],
//         "order": [],

//         "ajax": {
//             "url" : 'SalesmandetailsList',
//             "type": "POST",
//             "data": function ( data ) {
//                 data._token = $('#token').val()
//             }
//         }
//     });

$(document).on('click', '#Salesmandetails_Submit', function(e){
       e.preventDefault();
                        name              = $('#name').val();
                         zip              = $('#zip').val();
                        department        = $('#department').val();
                        email             = $('#email').val();
                        password          = $('#password').val();
                        target            = $('#target').val();

        if (name == "") {
         $('#name').addClass('is-invalid');
         return false;
         } 
         else{
            $('#name').removeClass('is-invalid');
         } 

        
         if (email  == "") {
         $('#email').addClass('is-invalid');
         // toastr.warning('Please enter a valid mail Eg:a@gmail.com');

         return false;
         } 
         else{
            $('#email').removeClass('is-invalid');
         }
        




   // $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }
        $.ajax({
            type : "POST",
            url  : "SalesmanSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        info_id          : $('#id').val(),
                        name             : $('#name').val(),
                        email            : $('#email').val(),
                        password         : $('#password').val(),
                        address1         : $('#address1').val(),
                        address2         : $('#address2').val(),
                        address3         : $('#address3').val(),
                        zip              : $('#zip').val(),
                        country          : $('#country').val(),
                        region           : $('#region').val(),
                        place            : $('#place').val(),
                         department      : $('#department').val(),
                        department_head  : $('#department_head').val(),
                        salesman_route   : $('#salesman_route').val(),
                        parent_group     : $('#parent_group').val(),
                        ledgername       : $('#ledgername').val(),
                        ledgercode       : $('#ledgercode').val(),
                        customers        : $('#customers').val(),
                        commission       : $('#commission').val(),
                        target           : $('#target').val(),
                        branch           : $('#branch').val()

                        
                    },
            success: function(data){
                if(data == false)
          {
            $('#Salesmandetails_Submit').removeClass('kt-spinner');
            $('#Salesmandetails_Submit').prop("disabled", false);
             toastr.warning('Salesman  is already exist');

          }
          else
          {

                $('#Salesmandetails_Submit').removeClass('kt-spinner');
                $('#Salesmandetails_Submit').prop("disabled", false);
                salesmandetailslist_table.ajax.reload();
                toastr.success('Salesman Details ' + sucess_msg + ' successfuly');
                window.location.href="salesmandetailssettings";
            }
            },
            error   : function ( jqXhr, json, errorThrown )
            {
                 $('#Salesmandetails_Submit').prop("disabled", false);
             console.log('Error !!');
            }
        });
    });


$(document).on('click', '.kt_del_salesmaninformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Salesman Details Entry !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deletesalesmans',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  console.log(data);
    if(data == 0)
    {
      swal.fire("Deleted!", "Your salesman has been deleted.", "success");
      salesmandetailslist_table.ajax.reload();
    }
    if(data == 1)
    {
      swal.fire("Not Deleted!", "Your salesman is used in Customer Details.", "success");
      salesmandetailslist_table.ajax.reload();
    }
             }
          });
          } else {

            swal.fire("Cancelled", "Your Salesman Entry is safe :)", "error");
          }
        })
       });

$(document).on('click', '.salesmanrestores', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this  Salesman  Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'Salesmandetailsrestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Salesman Entry Restored.", "success");
                window.location.href="salesmandetailssettings";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Salesman Entry is not restored)", "error");

          }
        })
     });

var table = $('#salesman_accounts_detailslist').DataTable({
        "dom"        : 'B<"top"f>rt<"bottom"lp>',
        "lengthMenu" : [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        "buttons": [
            {
                extend: 'pageLength',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'copy',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'csv',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'excel',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'pdf',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
                }
            },
            {
                extend: 'print',
                text: 'Print all (not just selected)',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
        ],
        "select": {
            style   :  'os',
            selector: 'td:first-child'
        },
        select: true,
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": [ 'odd-row', 'even-row' ],
        "order": [],

        "ajax": {
            "url" : 'salesman_accounts_detailslist',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }
    });

$(document).on('click', '.kt_edit_salesman_accounts', function() {

    var info_id = $(this).attr("data-id");

    $.ajax({
        url: "getsalesmanaccounts",
        method: "POST",
        data: {
            _token: $('#token').val(),
            info_id: info_id
        },
        dataType: "json",
        success: function(data) {

            $('#salesman_accounts_group').val(data['accounts'].account_group);
            $('#salesman_accounts_group').trigger('change');
            $('#salesman_accounts_ledger').val(data['accounts'].account_ledger);
            $('#salesman_accounts_code').val(data['accounts'].account_code);
            $('#salesman_id').val(info_id);

        }
    })
});

$(document).on('click', '#Group_submit_salesman', function(e) {
    e.preventDefault();
    // $(this).addClass('kt-spinner');
    // $(this).prop("disabled", true);


    $.ajax({
        type: "POST",
        url: "salesmanAccountSubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            salesman_id: $('#salesman_id').val(),
            accounts_group: $('#salesman_accounts_group').val(),
            accounts_code: $('#salesman_accounts_code').val(),
            accounts_ledger: $('#salesman_accounts_ledger').val()

        },
        success: function(data) {

            closeModel();

            swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
            window.location.href = "salesmanaccounts";

        },
        error: function(jqXhr, json, errorThrown) {
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors, function(key, value) {
                if (jQuery.isPlainObject(value)) {

                    $.each(value, function(index, ndata) {
                        errorsHtml += '<li>' + ndata + '</li>';
                    });

                } else {

                    errorsHtml += '<li>' + value + '</li>';

                }
            });

            //for spinner button reactive
            $('#Customerdetail_submit').removeClass('kt-spinner');

            $('#Customerdetail_submit').prop("disabled", false);
            //end for spinner button reactive

            $('#customerdetails_list').DataTable().ajax.reload();
            toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
        }
    });

    return false;

});
function closeModel() {

    $("#kt_modal_4_5").modal("hide");
    $('#salesman_accounts_group').val("");
    $('#salesman_accounts_code').val("");
    $('#salesman_accounts_ledger').val("");

}
var keysalesmandetailslist_table = $('#keysalesmandetailslist').DataTable({
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
            customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '10%', '10%', 
                                                           '10%', '15%'];
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
        "url": 'keysalesmandetailssettings',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'id', name: 'id' },
        
        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="keyedit_salesman?id=' + row.id + '" data-type="edit"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text Customersdetail_update" id=' + row.id + ' data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_salesmaninformationkey" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});
$(document).on('click', '#keySalesmandetails_Submit', function(e){
       e.preventDefault();
                        name              = $('#name').val();
                         zip              = $('#zip').val();
                        department        = $('#department').val();
                        email             = $('#email').val();
                        password          = $('#password').val();
                        target            = $('#target').val();
                        fileData          = $('#signature').val();



        if (name == "") {
         $('#name').addClass('is-invalid');
         return false;
         } 
         else{
            $('#name').removeClass('is-invalid');
         } 

        
         if (email  == "") {
         $('#email').addClass('is-invalid');
         // toastr.warning('Please enter a valid mail Eg:a@gmail.com');

         return false;
         } 
         else{
            $('#email').removeClass('is-invalid');
         }
        




   // $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }
        $.ajax({
            type : "POST",
            url  : "keySalesmanSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        info_id          : $('#id').val(),
                        name             : $('#name').val(),
                        email            : $('#email').val(),
                        password         : $('#password').val(),
                        address1         : $('#address1').val(),
                        address2         : $('#address2').val(),
                        address3         : $('#address3').val(),
                        zip              : $('#zip').val(),
                        country          : $('#country').val(),
                        region           : $('#region').val(),
                        place            : $('#place').val(),
                         department      : $('#department').val(),
                        department_head  : $('#department_head').val(),
                        salesman_route   : $('#salesman_route').val(),
                        parent_group     : $('#parent_group').val(),
                        ledgername       : $('#ledgername').val(),
                        ledgercode       : $('#ledgercode').val(),
                        customers        : $('#customers').val(),
                        commission       : $('#commission').val(),
                        target           : $('#target').val(),
                        branch           : $('#branch').val(),
                        signature         : $('#signature').val(),

                        
                    },
            success: function(data){
                if(data == false)
          {
            $('#keySalesmandetails_Submit').removeClass('kt-spinner');
            $('#keySalesmandetails_Submit').prop("disabled", false);
             toastr.warning('Key Account  is already exist');

          }
          else
          {

                $('#keySalesmandetails_Submit').removeClass('kt-spinner');
                $('#keySalesmandetails_Submit').prop("disabled", false);
                salesmandetailslist_table.ajax.reload();
                toastr.success('Key Account ' + sucess_msg + ' successfuly');
                window.location.href="keysalesmandetailssettings";
            }
            },
            error   : function ( jqXhr, json, errorThrown )
            {
                 $('#keySalesmandetails_Submit').prop("disabled", false);
             console.log('Error !!');
            }
        });
    });
$(document).on('click', '.kt_del_salesmaninformationkey', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Salesman Details Entry ",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'keydeletesalesman',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  console.log(data);
    if(data == 0)
    {
      swal.fire("Deleted!", "Your salesman has been deleted.", "success");
      keysalesmandetailslist_table.ajax.reload();
    }
    if(data == 1)
    {
      swal.fire("Not Deleted!", "Your salesman is used in Customer Details.", "success");
      keysalesmandetailslist_table.ajax.reload();
    }
             }
          });
          } else {

            swal.fire("Cancelled", "Your Salesman Entry is safe :)", "error");
          }
        })
       });


$("#keysalesmandetailslist_list_print").on("click", function() {
      keysalesmandetailslist_table.button('.buttons-print').trigger();
  });
  $("#keysalesmandetailslist_list_copy").on("click", function() {
      keysalesmandetailslist_table.button('.buttons-copy').trigger();
  });
  $("#keysalesmandetailslist_list_csv").on("click", function() {
      keysalesmandetailslist_table.button('.buttons-csv').trigger();
  });
  $("#keysalesmandetailslist_list_pdf").on("click", function() {
      keysalesmandetailslist_table.button('.buttons-pdf').trigger();
  });