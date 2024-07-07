
/**
 *Datatable for customer Information
 */


/**
 *Datatable for customer type
 */

var customertypedetails_table = $('#customertypedetails_list').DataTable({
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
            doc.content[1].table.widths = [ '2%',  '15%', '15%', '15%'];
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
        "url": 'customertypedetails',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },
        { data: 'discription', name: 'discription' },

        {
            data: 'color',
            name: 'color',
            render: function(data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
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
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text Type_update" id=' + row.id + ' data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_typeinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});

/**
 *Customer trash  trash datatable
 */

var trashtypedetails_table = $('#trashdetailslisttype').DataTable({
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
            doc.content[1].table.widths = [ '2%',  '15%', '15%', '15%'];
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
        "url": 'typetrash',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },
        { data: 'discription', name: 'discription' },
        {
            data: 'color',
            name: 'color',
            render: function(data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
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
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                        <span class="kt-nav__link-text kt_restore_typeinformation" id=' + row.id + ' data-id="' + row.id + '" >Restore</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
            }
        },

    ]
});

/**
 *Datatable for customer Trash
 */

var customerdetailstrash_list_table = $('#customerdetailstrash_list').DataTable({
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
        "url": 'customertrash',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'cust_code', name: 'cust_code' },
        { data: 'cust_name', name: 'cust_name' },
        { data: 'cust_name_alias', name: 'cust_name_alias' },
        { data: 'mobile1', name: 'mobile1' },
        { data: 'custcategory', name: 'custcategory' },
        { data: 'grouptitle', name: 'grouptitle' },

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
                        <span class="kt-nav__link-text kt_restore_customerinformation" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_customerdelete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';

            }
        },

    ]
});

/**
 *Customer category  trash datatable
 */

var trashcategorydetails_table = $('#trashdetailslistcategory').DataTable({
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
            customize: function(doc) {
                doc.pageMargins = [50, 50, 50, 50];
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
        "url": 'categorytrash',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'customer_category', name: 'customer_category' },
        { data: 'description', name: 'description' },

        {
            data: 'color',
            name: 'color',
            render: function(data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
            }
        },
        { data: 'cust_code', name: 'cust_code' },
        { data: 'start_from', name: 'start_from' },
        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                        <span class="kt-nav__link-text kt_restore_categoryinformation" id=' + row.id + ' data-id="' + row.id + '" >Restore</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
            }
        },

    ]
});

$(document).on('click', '.kt_restore_customerinformation', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Customer  Entry Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'customerTrashRestore',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {

                    swal.fire("Restored!", "Your Customer Entry has been deleted.", "success");
                    window.location.href = "customerdetails";

                }
            });
        } else {
            swal.fire("Cancelled", "Your Customer Entry is safe :)", "error");

        }
    })
});



$(document).on('click', '.kt_restore_categoryinformation', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Customer Category Entry !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'categoryTrashRestore',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {

                    swal.fire("Restored!", "Your Customer Category Entry has been Restored.", "success");
                    window.location.href='customercategorydetails';


                }
            });
        } else {
            swal.fire("Cancelled", "Your Customer Entry is safe :)", "error");

        }
    })
});
$(document).on('click', '.kt_restore_typeinformation', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Customer Type Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'typeTrashRestore',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {

                    swal.fire("Restored!", "Your Type Entry has been Restored.", "success");
                    window.location.href="customertypedetails";


                }
            });
        } else {
            swal.fire("Cancelled", "Your Type Entry is safe :)", "error");

        }
    })
});

/**
 *Datatable for customer category
 */

var customercategorydetails_table = $('#customercategorydetails_list').DataTable({
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
            customize: function(doc) {
                doc.pageMargins = [50, 50, 50, 50];
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
        "url": 'customercategorydetails',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'customer_category', name: 'customer_category' },
        { data: 'description', name: 'description' },

        {
            data: 'color',
            name: 'color',
            render: function(data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
            }
        },
        { data: 'cust_code', name: 'cust_code' },
        { data: 'start_from', name: 'start_from' },

        {
            data: 'action',
            name: 'action',
            render: function(data, type, row) {
                return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_4"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text Category_update" id=' + row.id + ' data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_categoryinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});

/**
 *Customer category submit action
 */

$(document).on('click', '#Category_submit', function(e) {
    e.preventDefault();

    customer_category = $('#customer_category').val();
    color = $('#color').val();
    cust_code = $('#cust_code').val();
    start_from = $('#start_from').val();
    description = $('#description').val();

    if (customer_category == "") {
        $('#customer_category').addClass('is-invalid');
        return false;
    } else {
        $('#customer_category').removeClass('is-invalid');
    }
    if (color == "") {
        $('#color').addClass('is-invalid');
        return false;
    } else {
        $('#color').removeClass('is-invalid');

    }
    if (cust_code == "") {
        $('#cust_code').addClass('is-invalid');
        return false;
    } else {
        $('#cust_code').removeClass('is-invalid');

    }
    if (start_from == "") {
        $('#start_from').addClass('is-invalid');
        return false;
    } else {
        $('#start_from').removeClass('is-invalid');

    }
    



    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }


    $.ajax({
        type: "POST",
        url: "Categoryinfo",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            customer_category: $('#customer_category').val(),
            description: $('#description').val(),
            color: $('#color').val(),
            cust_code: $('#cust_code').val(),
            start_from: $('#start_from').val(),
            branch : $('#branch').val()

        },
        success: function(data) {

          if(data == false)
          {
            $('#Category_submit').removeClass('kt-spinner');
             $('#Category_submit').prop("disabled", false);
             toastr.success('customer category name is already exist');

          }
          else
          {
            $('#Category_submit').removeClass('kt-spinner');
            $('#Category_submit').prop("disabled", false);
            closeModelcust();
            customercategorydetails_table.ajax.reload();
            toastr.success('customer category ' + sucess_msg + ' successfuly');
          }

        },
        error: function(jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});

$(document).on('click', '.close,.closeBtn', function() {

    closeModel();

});

function closeModelcust() {

    $("#kt_modal_4_4").modal("hide");
    $('#customer_category').val("");
    $('#description').val("");
    $('#color').val("");
    $('#cust_code').val("");
    $('#start_from').val("");
    
}

function closeModels() {

    $("#kt_modal_4_5").modal("hide");
    $('#title').val("");
    $('#description').val("");
    $('#color').val("");

}

/**
 *Customer type submit action
 */

$(document).on('click', '#Type_submit', function(e) {
    e.preventDefault();

    title = $('#title').val();
    color = $('#color').val();
    description = $('#description').val();

    if (title == "") {
        $('#title').addClass('is-invalid');
        return false;
    } else {
        $('#title').removeClass('is-invalid');
    }

    if (color == "") {
        $('#color').addClass('is-invalid');
        return false;
    } else {
        $('#color').removeClass('is-invalid');
    }
    if (description == "") {
        $('#description').addClass('is-invalid');
        return false;
    } else {
        $('#description').removeClass('is-invalid');
    }

        

    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
    if ($('#id').val()) {
        var sucess_msg = 'Updated';
    } else {
        var sucess_msg = 'Created';
    }


    $.ajax({
        type: "POST",
        url: "Typesubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            title: $('#title').val(),
            description: $('#description').val(),
            color: $('#color').val(),
            branch : $('#branch').val()
        },
        success: function(data) {
          if(data == false)
          {
            $('#Type_submit').removeClass('kt-spinner');
             $('#Type_submit').prop("disabled", false);
             toastr.success('customer type name is already exist');

          }
          else
          {
            $('#Type_submit').removeClass('kt-spinner');
            $('#Type_submit').prop("disabled", false);
            closeModels();
            customertypedetails_table.ajax.reload();
            toastr.success('customer type ' + sucess_msg + ' successfuly');
          }

        },
        error: function(jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});





$(document).on('click', '.kt_del_typeinformation', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Customer Type Details Entry ",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'deletetypeInfo',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    if(data == 'true')
                    {
                   swal.fire("Deleted!", "Your Type has been deleted.", "success");
                    customertypedetails_table.ajax.reload();
                }
                else{
                   swal.fire("Not Deleted!", "Your Type is used in Customer Details.", "success");

                    customertypedetails_table.ajax.reload();

                }
                }
            });
        } else {

            swal.fire("Cancelled", "Your Customer Type Entry is safe :)", "error");
        }
    })
});


$(document).on('click', '.kt_del_customerdetails', function() {

    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Customer Details Entry Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'deleteCustomerInfo',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {

                    swal.fire("Deleted!", "Your Customer Details Entry has been deleted.", "success");
                    location.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Customer Details Entry is safe :)", "error");
        }
    })
});


$(document).on('click', '.kt_customerdelete', function() {

    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Customer Details Entry Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'deletecustrows',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {

                    swal.fire("Deleted!", "Your Customer Details Entry has been deleted.", "success");
                    location.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Customer Details Entry is safe :)", "error");
        }
    })
});


$.reloadTable = function() {
    table.ajax.reload();
};

$(document).on('click', '.Type_update', function() {

    var info_id = $(this).attr("data-id");
    $.ajax({
        url: "gettypeupdate",
        method: "POST",
        data: {
            _token: $('#token').val(),
            info_id: info_id
        },
        dataType: "json",
        success: function(data) {
            $('#title').val(data['users'].title);
            $('#description').val(data['users'].discription);
            $('#color').val(data['users'].color);
            

            $('#id').val(info_id);

            // $("#usersInformation").modal("hide");

        }
    })
});

$(document).on('click', '.Category_update', function() {

    var info_id = $(this).attr("data-id");
    $.ajax({
        url: "getcategorylist",
        method: "POST",
        data: {
            _token: $('#token').val(),
            info_id: info_id
        },
        dataType: "json",
        success: function(data) {
            $('#customer_category').val(data['users'].customer_category);
            $('#description').val(data['users'].description);
            $('#color').val(data['users'].color);
            $('#cust_code').val(data['users'].cust_code);
            $('#start_from').val(data['users'].start_from);

            $('#id').val(info_id);

            // $("#usersInformation").modal("hide");

        }
    })
});


$(document).on('click', '.kt_del_categoryinformation', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Category  Master Entry Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'deletecategory',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
              success: function(data) {
                  console.log(data);

                    

    if(data == 'true')
    {
      swal.fire("Deleted!", "Your Category has been deleted.", "success");
      customercategorydetails_table.ajax.reload();
    }
    else
    {
      swal.fire("Not Deleted!", "Your Category is used in Customer Details.", "success");
      customercategorydetails_table.ajax.reload();
    }


                }
            });
        } else {

            swal.fire("Cancelled", "Your Category  Entry is safe :)", "error");
        }
    })
});
 

/**
 *Datatable for customer Documents & Contracts
 */









/**
 * Date-Picker Script
 */

$('.ktdatepicker').datepicker({
    format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
    $(this).datepicker('hide');
});




/**
 *Customer Information DataTable Export
 */



/**
 *Customer Trash DataTable Export
 */

$("#customerdetailstrash_list_print").on("click", function() {
    customerdetailstrash_list_table.button('.buttons-print').trigger();
});


$("#customerdetailstrash_list_copy").on("click", function() {
    customerdetailstrash_list_table.button('.buttons-copy').trigger();
});

$("#customerdetailstrash_list_csv").on("click", function() {
    customerdetailstrash_list_table.button('.buttons-csv').trigger();
});

$("#customerdetailstrash_list_pdf").on("click", function() {
    customerdetailstrash_list_table.button('.buttons-pdf').trigger();
});
/**
 *Customer category DataTable Export
 */

$("#customercategorydetails_list_print").on("click", function() {
    customercategorydetails_table.button('.buttons-print').trigger();
});


$("#customercategorydetails_list_copy").on("click", function() {
    customercategorydetails_table.button('.buttons-copy').trigger();
});

$("#customercategorydetails_list_csv").on("click", function() {
    customercategorydetails_table.button('.buttons-csv').trigger();
});

$("#customercategorydetails_list_pdf").on("click", function() {
    customercategorydetails_table.button('.buttons-pdf').trigger();
});

/**
 *Customer trash category DataTable Export
 */

$("#trashdetailslistcategory_print").on("click", function() {
    trashcategorydetails_table.button('.buttons-print').trigger();
});


$("#trashdetailslistcategory_copy").on("click", function() {
    trashcategorydetails_table.button('.buttons-copy').trigger();
});

$("#trashdetailslistcategory_csv").on("click", function() {
    trashcategorydetails_table.button('.buttons-csv').trigger();
});

$("#trashdetailslistcategory_pdf").on("click", function() {
    trashcategorydetails_table.button('.buttons-pdf').trigger();
});

/**
 *Customer  type DataTable Export
 */

$("#customertypedetails_list_print").on("click", function() {
    customertypedetails_table.button('.buttons-print').trigger();
});


$("#customertypedetails_list_copy").on("click", function() {
    customertypedetails_table.button('.buttons-copy').trigger();
});

$("#customertypedetails_list_csv").on("click", function() {
    customertypedetails_table.button('.buttons-csv').trigger();
});

$("#customertypedetails_list_pdf").on("click", function() {
    customertypedetails_table.button('.buttons-pdf').trigger();
});

/**
 *Customer trash type DataTable Export
 */

$("#trashdetailslisttype_print").on("click", function() {
    trashtypedetails_table.button('.buttons-print').trigger();
});


$("#trashdetailslisttype_copy").on("click", function() {
    trashtypedetails_table.button('.buttons-copy').trigger();
});

$("#trashdetailslisttype_csv").on("click", function() {
    trashtypedetails_table.button('.buttons-csv').trigger();
});

$("#trashdetailslisttype_pdf").on("click", function() {
    trashtypedetails_table.button('.buttons-pdf').trigger();
});

/**
 *Customer Documents & Contracts DataTable Export
 */

$("#customer_document_details_list_print").on("click", function() {
    customer_document_details_list_table.button('.buttons-print').trigger();
});


$("#customer_document_details_list_copy").on("click", function() {
    customer_document_details_list_table.button('.buttons-copy').trigger();
});

$("#customer_document_details_list_csv").on("click", function() {
    customer_document_details_list_table.button('.buttons-csv').trigger();
});

$("#customer_document_details_list_pdf").on("click", function() {
    customer_document_details_list_table.button('.buttons-pdf').trigger();
});


var customerdocuments_list_more_table = $('#customerdocuments_list_more').DataTable({
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
            customize: function(doc) {
                doc.pageMargins = [50, 50, 50, 50];
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
        "url": 'cust_doc_view',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val(),
            data.customer_id = $('#customer_id').val()
            
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
                j='<a href="ccdownload?id='+ row.customer_id+'&&file='+ row.file+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-download"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Download</span>\
                        </span></li></a><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_customer_document_file" id=' + row.id + ' data-id=' + row.id + ' data-file=' + row.file + '  data-customer_id=' + row.customer_id + '>Delete</span></span></li>';

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
//customer documents pdf,copy,print export

$("#customer_documents_details_list_print").on("click", function() {
    customerdocuments_list_more_table.button('.buttons-print').trigger();
});


$("#customer_documents_details_list_copy").on("click", function() {
    customerdocuments_list_more_table.button('.buttons-copy').trigger();
});

$("#customer_documents_details_list_csv").on("click", function() {
    customerdocuments_list_more_table.button('.buttons-csv').trigger();
});

$("#customer_documents_details_list_pdf").on("click", function() {
    customerdocuments_list_more_table.button('.buttons-pdf').trigger();
});



$(document).on('click', '.kt_del_customer_document_file', function() {

    var id = $(this).attr('id');
     var file = $(this).attr('data-file');
    var customer_id = $(this).attr('data-customer_id');

 
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
                url: 'deleteCustomerdocumentfile',
                data: {
                    _token: $('#token').val(),
                    id: id,
                    file:file,
                    customer_id:customer_id
                },
                success: function(data) {

                    swal.fire("Deleted!", "Your Customer document has been deleted.", "success");
                    location.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Customer document is safe :)", "error");
        }
    })
});
