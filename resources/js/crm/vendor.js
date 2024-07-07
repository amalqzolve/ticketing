
/**
 *Datatable for supplier Information
 */

var vendordetails_list_table = $('#vendordetails_list').DataTable({
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
        "url": 'vendors',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'vendor_name', name: 'vendor_name' },
        { data: 'vendor_name_alias', name: 'vendor_name_alias' },
        { data: 'mobile1', name: 'mobile1' },
        { data: 'title', name: 'title' },


        { data: 'vendor_category', name: 'vendor_category' },
       
                { data: 'vendor_code', name: 'vendor_code' },

        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="view_vendor?id=' + row.id + '" data-type="edit"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-background"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="vendor_pdf?id=' + row.id + '" data-type="edit" target="blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a href="edit_vendor?id=' + row.id + '" data-type="edit"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_vendorinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';

            }
        },

    ]
});

/**
 *Datatable for vendor trash details
 */

var vendortrashdetails_list_table = $('#vendordetailstrash_list').DataTable({
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
        "url": 'vendorInfoTrash',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'vendor_name', name: 'vendor_name' },
        { data: 'vendor_code', name: 'vendor_code' },
        { data: 'vendor_type', name: 'vendor_type' },
        { data: 'vendor_category', name: 'vendor_category' },
        { data: 'name', name: 'name' },
        { data: 'account_ledger', name: 'account_ledger' },
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
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                        <span class="kt-nav__link-text Vendrdetail_restore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';

            }
        },

    ]
});

$(document).on('click', '#vendor_submit', function(e) {
    $(this).removeClass('kt-spinner');
    var contact_personcharges = [];
    var mobiles = [];
    var offices = [];
    var emails = [];
    var departments = [];
    var locations = [];
    $(".addmore").each(function() {
        contact_personcharges.push($(this).find(".contact_personcharges").val());
        mobiles.push($(this).find(".mobiles").val());
        offices.push($(this).find(".offices").val());
        emails.push($(this).find(".emails").val());
        departments.push($(this).find(".departments").val());
        locations.push($(this).find(".locations").val());
    });
    $.ajax({
        type: "POST",
        url: "VendorSubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            vendor_id: $('#id').val(),
            vendor_code: $('#vendor_code').val(),
            vendor_type: $('#vendor_type').val(),
            vendor_category: $('#vendor_category').val(),
            salesman: $('#salesman').val(),
            vendor_name_alias:$('#vendor_name_alias').val(),
            vendor_group: $('#vendor_group').val(),
            key_account: $('#key_account').val(),
            vendor_name: $('#vendor_name').val(),
            contact_person: $('#contact_person').val(),
            vendor_add1: $('#vendor_add1').val(),
            vendor_add2: $('#vendor_add2').val(),
            vendor_country: $('#vendor_country').val(),
            vendor_region: $('#vendor_region').val(),
            vendor_city: $('#vendor_city').val(),
            vendor_zip: $('#vendor_zip').val(),
            email1: $('#email1').val(),
            email2: $('#email2').val(),
            office_phone1: $('#office_phone1').val(),
            office_phone2: $('#office_phone2').val(),
            mobile1: $('#mobile1').val(),
            mobile2: $('#mobile2').val(),
            fax: $('#fax').val(),
            website: $('#website').val(),
            contact_persons: $('#contact_persons').val(),
            mobile: $('#mobile').val(),
            office: $('#office').val(),
            contact_department: $('#contact_department').val(),
            email: $('#email').val(),
            location: $('#location').val(),
            invoice_add1: $('#invoice_add1').val(),
            invoice_add2: $('#invoice_add2').val(),
            shipping1: $('#shipping1').val(),
            shipping2: $('#shipping2').val(),
            portal: $('#portal').val(),
            username: $('#username').val(),
            registerd_email: $('#registerd_email').val(),
            password: $('#password').val(),
            contact_person_incharges: contact_personcharges,
            mobiles: mobiles,
            offices: offices,
            emails: emails,
            departments: departments,
            locations: locations
        },
        success: function(data) {
            swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
            window.location.href = "vendors";
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
            toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
        }
    });
    return false;
});
$(document).on('click', '.kt_del_vendorinformation', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Vendor Details Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: 'deleteVendorInfo',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {
                    swal.fire("Deleted!", "Your Vendor Entry has been deleted.", "success");
                    location.reload();
                }
            });
        } else {
            swal.fire("Cancelled", "Your Vendor Details Entry is safe :)", "error");
        }
    })
});
$.reloadTable = function() {
    table.ajax.reload();
};
$(document).on('click', '.Vendordetail_update', function() {
    var user_id = $(this).attr("data-id");
    $.ajax({
        url: "getVendordetailsInfo",
        method: "POST",
        data: {
            _token: $('#token').val(),
            user_id: user_id
        },
        dataType: "json",
        success: function(data) {
            $('#id').val(vendor_id);
            $('#password').val(data['vendors'].password);
            $('#registerd_email').val(data['vendors'].registerd_email);
            $('#username').val(data['vendors'].username);
            $('#portal').val(data['vendors'].portal);
            $('#shipping2').val(data['vendors'].shipping2);
            $('#shipping1').val(data['vendors'].shipping1);
            $('#invoice_add2').val(data['vendors'].invoice_add2);
            $('#invoice_add1').val(data['vendors'].invoice_add1);
            $('#location').val(data['vendors'].location);
            $('#email').val(data['vendors'].email);
            $('#contact_department').val(data['vendors'].contact_department);
            $('#office').val(data['vendors'].office);
            $('#mobile').val(data['vendors'].mobile);
            $('#contact_person_incharge').val(data['vendors'].contact_person_incharge);
            $("#usersInformation").modal("hide");
            $('#contact_person').val(data['vendors'].contact_person);
            $('#website').val(data['vendors'].website);
            $('#fax').val(data['vendors'].fax);
            $('#mobile2').val(data['vendors'].mobile2);
            $('#mobile1').val(data['vendors'].mobile1);
            $('#office_phone2').val(data['vendors'].office_phone2);
            $('#office_phone1').val(data['vendors'].office_phone1);
            $('#email2').val(data['vendors'].email2);
            $('#email1').val(data['vendors'].email1);
            $('#vendor_zip').val(data['vendors'].vendor_zip);
            $('#vendor_city').val(data['vendors'].vendor_city);
            $('#vendor_region').val(data['vendors'].vendor_region);
            $('#vendor_country').val(data['vendors'].vendor_country);
            $('#vendor_add2').val(data['vendors'].vendor_add2);
            $('#vendor_add1').val(data['vendors'].vendor_add1);
            $('#vendor_name').val(data['vendors'].vendor_name);
            $('#key_account').val(data['vendors'].key_account);
            $('#salesman').val(data['vendors'].salesman);
            $('#vendor_category').find(":selected").text();
            $('#vendor_type').find(":selected").text();
            $('#vendor_code').find(":selected").text();
        }
    })
});
$.reloadTable = function() {
    table.ajax.reload();
};
$("#export-button-pdf").on("click", function() {
    $('body .buttons-pdf').trigger('click');
});
$("#export-button-print").on("click", function() {
    $('body .buttons-print').trigger('click');
});
$("#export-button-csv").on("click", function() {
    $('body .buttons-csv').trigger('click');
});
$("#export-button-copy").on("click", function() {
    $('body .buttons-copy').trigger('click');
});

$(document).on('click', '.Vendrdetail_restore', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Vendor Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'vendorRestoreTrash',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {

                    swal.fire("Restored!", "Your Vendor Entry has been Restored.", "success");
                    window.location.href = "vendors";

                }
            });
        } else {
            swal.fire("Cancelled", "Your Vendor Entry is not safe :)", "error");

        }
    })
});

/**
 *Datatable for vendor documents Information
 */

var vendordocuments_list_table = $('#vendor_documents_details_list').DataTable({
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
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            },
            pageSize: 'A4',
            orientation: 'landscape',
            customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '10%', '10%', '10%', 
                                                           '15%', '15%', '15%','13%'];
                       }
        },
        {
            extend: 'print',
            className: "hidden",
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        }
    ],

    ajax: {
        "url": 'vendordocuments',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'vendor_name', name: 'vendor_name' },
       { data: 'total', name: 'total' },
        { data: 'exp', name: 'exp' },
        { data: 'ac', name: 'ac' },
         
       
        {
            data: 'action',
            name: 'action',
           render: function(data, type, row) {
                j='<a href="edit_vendor_documents?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Update</span>\
                        </span></li></a>';
                        j+='<a href="edit_vendor_docs?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Documents</span>\
                        </span></li></a>';

                      
                        if (!row.documents=='') {
                             j+='<a href="vendor_doc_view?id=' + row.vendor_id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-folder-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.vendor_id + '" >Attachments</span>\
                        </span></li></a>'; 
                        }
                        
                if (row.ven_id==row.id) {
                    j+='<a href="vendor_docpdf?id=' + row.id + '" data-type="edit" target="blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';}
                    
                
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






$(document.body).on("change", "#payment_terms", function() {
    var grp_id = this.value;

    $.ajax({
        url: "getpayterms",
        method: "POST",
        data: {
            _token: $('#token').val(),
            grp_id: grp_id
        },
        dataType: "json",
        success: function(data) {
            console.log(data);
            CKEDITOR.instances['description1'].setData(data['payterm'].description);
        }
    })


});

$('.ktdatepicker').datepicker({
    format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

/**
 *vendor details DataTable Export
 */

$("#vendordetails_list_print").on("click", function() {
    vendordetails_list_table.button('.buttons-print').trigger();
});


$("#vendordetails_list_copy").on("click", function() {
    vendordetails_list_table.button('.buttons-copy').trigger();
});

$("#vendordetails_list_csv").on("click", function() {
    vendordetails_list_table.button('.buttons-csv').trigger();
});

$("#vendordetails_list_pdf").on("click", function() {
    vendordetails_list_table.button('.buttons-pdf').trigger();
});

/**
 *vendor trash details DataTable Export
 */

$("#vendordetailstrash_list_print").on("click", function() {
    vendortrashdetails_list_table.button('.buttons-print').trigger();
});


$("#vendordetailstrash_list_copy").on("click", function() {
    vendortrashdetails_list_table.button('.buttons-copy').trigger();
});

$("#vendordetailstrash_list_csv").on("click", function() {
    vendortrashdetails_list_table.button('.buttons-csv').trigger();
});

$("#vendordetailstrash_list_pdf").on("click", function() {
    vendortrashdetails_list_table.button('.buttons-pdf').trigger();
});

/**
 *vendor documents and contracts details DataTable Export
 */

$("#vendor_documents_details_list_print").on("click", function() {
    vendordocuments_list_table.button('.buttons-print').trigger();
});


$("#vendor_documents_details_list_copy").on("click", function() {
    vendordocuments_list_table.button('.buttons-copy').trigger();
});

$("#vendor_documents_details_list_csv").on("click", function() {
    vendordocuments_list_table.button('.buttons-csv').trigger();
});

$("#vendor_documents_details_list_pdf").on("click", function() {
    vendordocuments_list_table.button('.buttons-pdf').trigger();
});


var vendordocuments_list_more_table = $('#vendordocuments_list_more').DataTable({
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
                columns: [0, 1]
            }
        },
        {
            extend: 'csv',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            }
        },
        {
            extend: 'excel',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            }
        },
        {
            extend: 'pdf',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            },
            pageSize: 'A4',
            orientation: 'landscape',
            customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '2%',  '15%'];
                       }
        },
        {
            extend: 'print',
            className: "hidden",
            exportOptions: {
                columns: [0, 1]
            }
        }
    ],

    ajax: {
        "url": 'vendor_doc_view',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val(),
            data.vendor_id = $('#vendor_id').val()
            
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'caption', name: 'caption' },

        { data: 'file', name: 'file' },
      
      /*  {
            data: 'download',
            name: 'download',
            render: function(data, type, row) {
                if (row.documents === undefined || row.documents === null) {
                    return '';
                } else {
                    return '<a href="supplier_download?id=' + row.id + '"><button class="btn btn-success btn-elevate btn-icon-sm" style="padding: 1px 6px !important;">Download &nbsp; <i class="fa fa-download" aria-hidden="true"></i> </button></a>';
                }

            }
        },*/
       {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                j='<a href="vvdownload?id='+ row.vendor_id+'&&file='+ row.file+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-arrow-down"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Download</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_vendor_document_file" id=' + row.id + ' data-id=' + row.id + ' data-file=' + row.file + '  data-vendor_id=' + row.vendor_id + '>Delete</span></span></li>';

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
/**
 *vendor documents and contracts details DataTable Export
 */

$("#vendor_documents_more_details_list_print").on("click", function() {
    vendordocuments_list_more_table.button('.buttons-print').trigger();
});


$("#vendor_documents_more_details_list_copy").on("click", function() {
    vendordocuments_list_more_table.button('.buttons-copy').trigger();
});

$("#vendor_documents_more_details_list_csv").on("click", function() {
    vendordocuments_list_more_table.button('.buttons-csv').trigger();
});

$("#vendor_documents_more_details_list_pdf").on("click", function() {
    vendordocuments_list_more_table.button('.buttons-pdf').trigger();
});

$(document).on('click', '.kt_del_vendor_document_file', function() {

    var id = $(this).attr('id');
     var file = $(this).attr('data-file');
    var vendor_id = $(this).attr('data-vendor_id');

 
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this document!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'deleteVendordocumentfile',
                data: {
                    _token: $('#token').val(),
                    id: id,
                    file:file,
                    vendor_id:vendor_id
                },
                success: function(data) {

                    swal.fire("Deleted!", "Your Vendor document has been deleted.", "success");
                    location.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Vendor document is safe :)", "error");
        }
    })
});
