
/**
 *Datatable for vendor accounts Information
 */

var vendoraccounts_list_table = $('#vendordetails_list').DataTable({
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
            doc.content[1].table.widths = [ '15%',  '15%', '15%', '15%', 
                                                           '15%', '15%', '13%'];
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
        "url": 'vendoraccounts',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'vendor_code', name: 'vendor_code' },
        { data: 'vendor_name', name: 'vendor_name' },
        { data: 'account_group', name: 'account_group' },
        { data: 'account_ledger', name: 'account_ledger' },
        { data: 'account_code', name: 'account_code' },
        {
            data: 'status',
            name: 'status',
            render: function(data, type, row) {
             if (row.sub_ledger === undefined || row.sub_ledger === null) {
                    return '<span class="label label-lg label-light-danger label-inline">Not Updated</span>';
                } else {
                    return '<span class="label label-lg font-weight-bold label-light-primary label-inline">Updated</span';
                }

            }
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
                         <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5">\
                         <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text kt_edit_accounts" id=' + row.id + ' data-id=' + row.id + '>Update</span></span></li></a>\
                       </ul></div></div></span>';

            }
        },

    ]
});
// var table = $('#vendordetails_list').DataTable({
//     "dom": 'B<"top"f>rt<"bottom"lp>',
//     "lengthMenu": [
//         [10, 25, 50, -1],
//         ['10 rows', '25 rows', '50 rows', 'Show all']
//     ],
//     "buttons": [{
//             extend: 'pageLength',
//             className: 'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         },
//         {
//             extend: 'copy',
//             className: 'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         },
//         {
//             extend: 'csv',
//             className: 'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         },
//         {
//             extend: 'excel',
//             className: 'btn btn-outline-brand btn-elevate btn-pill hideButton'
//         },
//         {
//             extend: 'pdf',
//             className: 'btn btn-outline-brand btn-elevate btn-pill hideButton',
//             exportOptions: {
//                 columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
//             }
//         },
//         {
//             extend: 'print',
//             text: 'Print all (not just selected)',
//             className: 'btn btn-outline-brand btn-elevate btn-pill hideButton',
//             exportOptions: {
//                 modifier: {
//                     selected: null
//                 }
//             }
//         }
//     ],
//     "select": {
//         style: 'os',
//         selector: 'td:first-child'
//     },
//     select: true,
//     "pagingType": 'full_numbers',
//     "iDisplayLength": 10,
//     "processing": true,
//     "serverSide": true,
//     "responsive": true,
//     "stripeClasses": ['odd-row', 'even-row'],
//     "order": [],

//     "ajax": {
//         "url": 'vendorAccountsList',
//         "type": "POST",
//         "data": function(data) {
//             data._token = $('#token').val()
//         }
//     }
// });




$(document).on('click', '.kt_edit_accounts', function() {

    var info_id = $(this).attr("data-id");

    $.ajax({
        url: "getvendoraccounts",
        method: "POST",
        data: {
            _token: $('#token').val(),
            info_id: info_id
        },
        dataType: "json",
        success: function(data) {

if(data['accounts'].ledger_type==1)
            {
                $("#existing").hide(); 
                    $("#new").show();
            }
      if(data['accounts'].ledger_type==2)
            {
                $("#new").hide();  
               $("#existing").show();

            }

  
  
$('#customer_ledger').val(data['accounts'].sub_ledger);
            $('#customer_ledger').trigger('change');

            $('#accounts_group').val(data['accounts'].account_group);
            $('#accounts_group').trigger('change');
            $('#accounts_ledger').val(data['accounts'].vendor_name);
            $('#accounts_code').val(data['accounts'].account_code);
            $('#id').val(info_id);
            $('#main_ledger').val(data['accounts'].main_ledger);
            $('#sub_ledger').val(data['accounts'].sub_ledger);


        }
    })
});

$(document.body).on("change", "#accounts_group", function() {
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
           //     if(typeof($('#accounts_code').val()) == "undefined" || $('#accounts_code').val() == null ||  $('#accounts_code').val() == '') {
                  $('#accounts_code').val(data);
           //     }

        }
    })


});



$(document).on('click', '.close,.closeBtn', function() {

    closeModel();

});

function closeModel() {

    $("#kt_modal_4_5").modal("hide");
    $('#accounts_group').val("");
    $('#accounts_code').val("");
    $('#accounts_ledger').val("");

}

$(document).on('click', '#Group_submit', function(e) {
    e.preventDefault();
    accounts_group  = $('#accounts_group').val();
    accounts_code   = $('#accounts_code').val();
    accounts_ledger = $('#accounts_ledger').val();
    var checkedValue = $('input[name="types"]:checked').val();
      if(checkedValue == 1)
            {

     if (accounts_group == "") {
    $('#accounts_group').next().find('.select2-selection').addClass('is-invalid');
    toastr.warning('Account Group is required.');
    return false;
    } else {
     $('#accounts_group').next().find('.select2-selection').removeClass('is-invalid');
    }
    if (accounts_code == "") {
    $('#accounts_code').next().find('.select2-selection').addClass('is-invalid');
    toastr.warning('Account Code is required.');
    return false;
    } else {
     $('#accounts_code').next().find('.select2-selection').removeClass('is-invalid');
    }
    if (accounts_ledger == "") {
    $('#accounts_ledger').next().find('.select2-selection').addClass('is-invalid');
    toastr.warning('Account Ledger is required.');
    return false;
    } else {
     $('#accounts_ledger').next().find('.select2-selection').removeClass('is-invalid');
    }
}
     if(checkedValue == 2)
            {
                
                customer_ledger  = $('#customer_ledger').val();

                 if (customer_ledger == "") {
                $('#customer_ledger').next().find('.select2-selection').addClass('is-invalid');
                toastr.warning('Ledger is required.');
                return false;
                } else {
                 $('#customer_ledger').next().find('.select2-selection').removeClass('is-invalid');
                }

            }
    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);

    $.ajax({
        type: "POST",
        url: "VendorAccountSubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            cust_id: $('#id').val(),
            ledger_type:checkedValue,
            customer_ledger :$('#customer_ledger').val(),
            accounts_group: $('#accounts_group').val(),
            accounts_code: $('#accounts_code').val(),
            accounts_ledger: $('#accounts_ledger').val(),
            branch : $('#branch').val(),
            main_ledger : $('#main_ledger').val(),
            sub_ledger : $('#sub_ledger').val()

        },
        success: function(data) {


            $('#Group_submit').removeClass('kt-spinner');
            $('#Group_submit').prop("disabled", false);
            closeModel();
            vendoraccounts_list_table.ajax.reload();
            toastr.success('vendor accounts updated successfuly');

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

/**
 *vendor accounts DataTable Export
 */

$("#vendordetails_list_print").on("click", function() {
    vendoraccounts_list_table.button('.buttons-print').trigger();
});


$("#vendordetails_list_copy").on("click", function() {
    vendoraccounts_list_table.button('.buttons-copy').trigger();
});

$("#vendordetails_list_csv").on("click", function() {
    vendoraccounts_list_table.button('.buttons-csv').trigger();
});

$("#vendordetails_list_pdf").on("click", function() {
    vendoraccounts_list_table.button('.buttons-pdf').trigger();
});