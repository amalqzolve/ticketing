$(document.body).on("change", "#group_name", function() {
    var grp_id = this.value;

    $.ajax({
        url: "getgroup_details",
        method: "POST",
        data: {
            _token: $('#token').val(),
            grp_id: grp_id
        },
        dataType: "json",
        success: function(data) {
            $('#account_code').val(data);

        }
    })


});

$(document).on('click', '#accounts_submit', function(e){
       e.preventDefault();

        account_name             = $('#account_name').val();
        account_code             = $("#account_code").val();
        group_name               = $('#group_name').val();
        

        
        
         if (account_name=="") {
         $('#account_name').addClass('is-invalid');
         return false;
         } 
         else{
            $('#account_name').removeClass('is-invalid');
         } 
         if (account_code=="") {
         $('#account_code').addClass('is-invalid');
         return false;
         } 
         else{
            $('#account_code').removeClass('is-invalid');
         } 
         if (group_name == "") { 
           $('#group_name').next().find('.select2-selection').addClass('select-dropdown-error');
            return false;
        }
         else {
           $('#group_name').next().find('.select2-selection').removeClass('select-dropdown-error');
        }

        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        if ($('#id').val()) {
        var sucess_msg = 'Updated';
        } else {
        var sucess_msg = 'Created';
        }

        $.ajax({
            type : "POST",
            url  : "accounts_submit",
            dataType  : "json",
            data : {
                        _token                : $('#token').val(),
                        id                    : $('#id').val(),
                       account_name           : $('#account_name').val(),
                       account_code           : $("#account_code").val(),
                       group_name             : $('#group_name').val(),


                    },
            success: function(data){
          if(data == 'false')
          {
            $('#accounts_submit').removeClass('kt-spinner');
            $('#accounts_submit').prop("disabled", false);
            toastr.warning('Account namme already exist');
          }
          else
          {
                  $('#accounts_submit').removeClass('kt-spinner');
                  $('#accounts_submit').prop("disabled", false);
            toastr.success('Account Settings ' + sucess_msg + ' successfuly');
                  //location.reload();
                  window.location.href="AccountsList";
                  $(this).prop("disabled", false);
              }
            },
            error   : function ( jqXhr, json, errorThrown )
            {
                var errors = jqXhr.responseJSON;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    if(jQuery.isPlainObject( value )){

                      $.each(value, function( index, ndata ) {
                        errorsHtml += '<li>' + ndata + '</li>';
                      });

                    }else{

                    errorsHtml += '<li>' + value + '</li>';

                    }
                });
               toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });

        return false;

    });

/**
 *Datatable for account settings lists Information
 */
var accounts_list_table = $('#accounts_list').DataTable({
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
            customize: function(doc) {
                doc.pageMargins = [50, 50, 50, 50];
                doc.content[1].table.widths = [ '10%', '30%', '30%', '30%'];
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
        "url": 'AccountsList',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'account_name', name: 'account_name' },
        { data: 'account_code', name: 'account_code' },

        {
            data: 'name',name: 'name'
            
        },
        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_accounts?id=' + row.id + '"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text " data-id="' + row.id +'" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_accounts_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});

// $(document).ready(function(){
// var table = $('#accounts_list').DataTable({
//         // "dom"        : 'B<"top"f>rt<"bottom"lp>',
//         // "lengthMenu" : [
//         //     [ 10, 25, 50, -1 ],
//         //     [ '10 rows', '25 rows', '50 rows', 'Show all' ]
//         // ],
//         // "buttons": [
//         //     {
//         //         extend: 'pageLength',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'copy',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'csv',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'excel',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'pdf',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
//         //         exportOptions: {
//         //             columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
//         //         }
//         //     },
//         //     {
//         //         extend: 'print',
//         //         text: 'Print all (not just selected)',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
//         //         exportOptions: {
//         //             modifier: {
//         //                 selected: null
//         //             }
//         //         }
//         //     }
//         // ],
//         // "select": {
//         //     style   :  'os',
//         //     selector: 'td:first-child'
//         // },
//         // select: true,
//         "pagingType": 'full_numbers',
//         "iDisplayLength": 10,
//         "processing": true,
//         "serverSide": true,
//         "responsive": true,
//         "stripeClasses": [ 'odd-row', 'even-row' ],
//         "order": [],

//         "ajax": {
//             "url" : 'accounts_list',
//             "type": "POST",
//             "data": function ( data ) {
//                 data._token = $('#token').val()
//             }
//         }

//     })
// });


$(document).on('click', '.kt_accounts_delete', function () {
     var id = $(this).attr('id');
     
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Entry !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deleteaccounts',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Entry has been deleted.", "success");
             location.reload();

             }
          });
          } else {
            swal.fire("Cancelled", "Your   Entry is safe ", "error");

          }
        })
       });

/**
 *Datatable for account settings lists Information
 */
var accounts_list_trash_table = $('#accounts_list_trash').DataTable({
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
            customize: function(doc) {
                doc.pageMargins = [50, 50, 50, 50];
                doc.content[1].table.widths = [ '10%', '30%', '30%', '30%'];
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
        "url": 'Trash-Account',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'account_name', name: 'account_name' },
        { data: 'account_code', name: 'account_code' },

        {
            data: 'group_name',name: 'group_name'
            
        },
        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-refresh-arrow"></i>\
                        <span class="kt-nav__link-text kt_accounts_recover" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});
// $(document).ready(function(){
// var table = $('#accounts_list_trash').DataTable({
//         // "dom"        : 'B<"top"f>rt<"bottom"lp>',
//         // "lengthMenu" : [
//         //     [ 10, 25, 50, -1 ],
//         //     [ '10 rows', '25 rows', '50 rows', 'Show all' ]
//         // ],
//         // "buttons": [
//         //     {
//         //         extend: 'pageLength',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'copy',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'csv',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'excel',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         //     },
//         //     {
//         //         extend: 'pdf',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
//         //         exportOptions: {
//         //             columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
//         //         }
//         //     },
//         //     {
//         //         extend: 'print',
//         //         text: 'Print all (not just selected)',
//         //         className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
//         //         exportOptions: {
//         //             modifier: {
//         //                 selected: null
//         //             }
//         //         }
//         //     }
//         // ],
//         // "select": {
//         //     style   :  'os',
//         //     selector: 'td:first-child'
//         // },
//         // select: true,
//         "pagingType": 'full_numbers',
//         "iDisplayLength": 10,
//         "processing": true,
//         "serverSide": true,
//         "responsive": true,
//         "stripeClasses": [ 'odd-row', 'even-row' ],
//         "order": [],

//         "ajax": {
//             "url" : 'accounts_trash_list',
//             "type": "POST",
//             "data": function ( data ) {
//                 data._token = $('#token').val()
//             }
//         }

//     })
// });


$(document).on('click', '.kt_accounts_recover', function () {
     var id = $(this).attr('id');
     
       

        $.ajax({
              type: "POST",
              url : 'restoreaccounts',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                  swal.fire("Done", "Restore Sucessfully", "success");
                   // accounts_list_trash_table.ajax.reload();
                  // location.reload();
                   window.location.href="AccountsList";

             }
          });
         
        });



/**
 *accounts details DataTable Export
 */

$("#accounts_list_print").on("click", function() {
    accounts_list_table.button('.buttons-print').trigger();
});


$("#accounts_list_copy").on("click", function() {
    accounts_list_table.button('.buttons-copy').trigger();
});

$("#accounts_list_csv").on("click", function() {
    accounts_list_table.button('.buttons-csv').trigger();
});

$("#accounts_list_pdf").on("click", function() {
    accounts_list_table.button('.buttons-pdf').trigger();
});

/**
 *accounts details DataTable Export
 */

$("#accounts_list_trash_print").on("click", function() {
    accounts_list_trash_table.button('.buttons-print').trigger();
});


$("#accounts_list_trash_copy").on("click", function() {
    accounts_list_trash_table.button('.buttons-copy').trigger();
});

$("#accounts_list_trash_csv").on("click", function() {
    accounts_list_trash_table.button('.buttons-csv').trigger();
});

$("#accounts_list_trash_pdf").on("click", function() {
    accounts_list_trash_table.button('.buttons-pdf').trigger();
});