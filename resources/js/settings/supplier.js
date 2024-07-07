var suppliergroup_listtable = $('#suppliergroup_list').DataTable({
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
        "url": 'settingssuppliergroup',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },
        {
            data: 'color',
            name: 'color',
            render: function(data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
            }
        },
        { data: 'description', name: 'description' },
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
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_10"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text suppliergrupdetail_update" id=' + row.id + ' data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_suppliergrupinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});

var suppliergroup_trash_listtable = $('#suppliergrouptrash').DataTable({
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
        "url": 'settingssuppliertrashshows',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },
        { data: 'description', name: 'description' },

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
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                        <span class="kt-nav__link-text suppliergruprestore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});

$(document).on('click', '#suppliergroupdetail_submit', function(e){
e.preventDefault();

    title = $('#title').val();
    color = $('#color').val();

    if (title == "") {
        $('#title').addClass('is-invalid');
        return false;
    } else {
        $('#title').removeClass('is-invalid');
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
        url: "settingssuppliergroupSubmit",
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
            $('#suppliergroupdetail_submit').removeClass('kt-spinner');
            $('#suppliergroupdetail_submit').prop("disabled", false);
             toastr.warning('The Supplier Group Name  Already Exists');

          }
          else
          {
            $('#suppliergroupdetail_submit').removeClass('kt-spinner');
            $('#suppliergroupdetail_submit').prop("disabled", false);
            closeModel();
            suppliergroup_listtable.ajax.reload();
            toastr.success('Supplier Group ' + sucess_msg + ' successfuly');
          }

        },
        error: function(jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});
$(document).on('click', '.suppliergrupdetail_update', function(){
           var cust_id = $(this).attr("data-id");
           $.ajax({
                url       : "settingsgetsuppliergrup",
                method    : "POST",
                data      : {
              _token      : $('#token').val(),
              cust_id     : cust_id
                    },
                dataType  : "json",
                success:function(data)
                {
                    $('#title').val(data['users'].title);
                    $('#description').val(data['users'].description);
                    $('#color').val(data['users'].color);
                     
                     $('#id').val(cust_id);
                    


                    }
                   
       
              
           })
      });
$(document).on('click', '.kt_del_suppliergrupinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Entry  Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {
        $.ajax({
              type: "POST",
              url : 'settingsdeletesuppliergrupInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
               
               if(data == 0)
               {
                 swal.fire("Deleted!", "Your Group has been deleted.", "success");
                 suppliergroup_listtable.ajax.reload();
               }
               if(data == 1)
               {
                 swal.fire("Not Deleted!", "Your Group is used in Supplier Details.", "success");
                 suppliergroup_listtable.ajax.reload();
    }
             }
          });
          } else {
            swal.fire("Cancelled", "Your Entry is safe :)", "error");
          }
        })
       });

$(document).on('click', '.suppliergruprestore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Supplier group Entry Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'settingssuppliergrupTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Supplier group Entry has been Restored.", "success");
                window.location.href="settingssuppliergroup";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Supplier group is not Restored)", "error");

          }
        })
     });
function closeModel(){

    $("#kt_modal_4_10").modal("hide");
    $('#title').val("");
    $('#description').val("");
    $('#color').val("");

    $('#id').val("");
      

   }

$("#suppliergroup_list_print").on("click", function() {
    suppliergroup_listtable.button('.buttons-print').trigger();
});


$("#suppliergroup_list_copy").on("click", function() {
    suppliergroup_listtable.button('.buttons-copy').trigger();
});

$("#suppliergroup_list_csv").on("click", function() {
    suppliergroup_listtable.button('.buttons-csv').trigger();
});

$("#suppliergroup_list_pdf").on("click", function() {
    suppliergroup_listtable.button('.buttons-pdf').trigger();
});

$("#suppliergrouptrash_print").on("click", function() {
    suppliergroup_trash_listtable.button('.buttons-print').trigger();
});


$("#suppliergrouptrash_copy").on("click", function() {
    suppliergroup_trash_listtable.button('.buttons-copy').trigger();
});

$("#suppliergrouptrash_csv").on("click", function() {
    suppliergroup_trash_listtable.button('.buttons-csv').trigger();
});

$("#suppliergrouptrash_pdf").on("click", function() {
    suppliergroup_trash_listtable.button('.buttons-pdf').trigger();
});

   var suppliercategorydetails_list_table = $('#suppliercategorydetails_list').DataTable({
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
            customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '10%', '10%', 
                                                           '10%', '25%'];
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
        "url": 'settingssuppliercategory',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },
        { data: 'customcode', name: 'customcode' },
        { data: 'startfrom', name: 'startfrom' },
        {
            data: 'color',
            name: 'color',
            render: function(data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
            }
        },
        { data: 'discription', name: 'discription' },
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
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_7"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text suppliercategorydetail_update" id=' + row.id + ' data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_suppliercatgryinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});

var suppliercategorydetails_trash_table = $('#sup_ctgrytrashtype').DataTable({
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
            customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '25%',  '25%', '10%', '10%', 
                                                           '10%', '25%'];
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
        "url": 'settingssuppliercatgrytrash',
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
        { data: 'customcode', name: 'customcode' },
        { data: 'startfrom', name: 'startfrom' },

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
                        <span class="kt-nav__link-text sup_cat_typerestore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});

$(document).on('click', '#suppliercategorydetail_submit', function(e){
  e.preventDefault();

    title = $('#title').val();
    color = $('#color').val();
    customcode = $('#customcode').val();
    startfrom = $('#startfrom').val();

    if (title == "") {
        $('#title').addClass('is-invalid');
        return false;
    } else {
        $('#title').removeClass('is-invalid');
    }
    
    if (customcode == "") {
        $('#customcode').addClass('is-invalid');
        return false;
    } else {
        $('#customcode').removeClass('is-invalid');

    }
    if (startfrom == "") {
        $('#startfrom').addClass('is-invalid');
        return false;
    } else {
        $('#startfrom').removeClass('is-invalid');

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
        url: "settingssuppliercatgrySubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            title: $('#title').val(),
            discription: $('#discription').val(),
            color: $('#color').val(),
            customcode: $('#customcode').val(),
            startfrom: $('#startfrom').val(),
            branch : $('#branch').val()

        },
        success: function(data) {

          if(data == false)
          {
            $('#suppliercategorydetail_submit').removeClass('kt-spinner');
            $('#suppliercategorydetail_submit').prop("disabled", false);
             toastr.warning('The Supplier Category Name  Already Exists');

          }
          else
          {
            $('#suppliercategorydetail_submit').removeClass('kt-spinner');
            $('#suppliercategorydetail_submit').prop("disabled", false);
            closeModelsupcat();
            
            suppliercategorydetails_list_table.ajax.reload();
            toastr.success('Supplier Category ' + sucess_msg + ' successfuly');
          }

        },
        error: function(jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});

function closeModelsupcat() {

        $("#kt_modal_4_8").modal("hide");
        $('#discription').val("");
        $('#customcode').val("");
        $('#color').val("");
        $('#startfrom').val("");
        $('#branch').val("");
        $('#title').val("");
        
}

$(document).on('click', '#supcatcancel', function(e){
    $("#kt_modal_4_8").modal("hide");
        $('#discription').val("");
        $('#customcode').val("");
        $('#color').val("");
        $('#startfrom').val("");
        $('#branch').val("");
        $('#title').val("");
});

$(document).on('click', '.suppliercategorydetail_update', function(){
  
           var cust_id = $(this).attr("data-id");
           $.ajax({
                url       : "settingsgetsuppliercatgry",
                method    : "GET",
                data      : {
              _token      : $('#token').val(),
              cust_id     : cust_id
                    },
                dataType  : "json",
                success:function(data)
                {
                    $('#title').val(data['users'].title);
                    $('#discription').val(data['users'].discription);
                    $('#color').val(data['users'].color);
                    $('#customcode').val(data['users'].customcode);
                    $('#startfrom').val(data['users'].startfrom);
                     $('#id').val(cust_id);

                     
                   
       
                }
           })
      });

      $(document).on('click', '.kt_del_suppliercatgryinformation', function () {
  
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
              url : 'settingsdeletesuppliercatgryInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
                
               if(data == 0)
               {
                 swal.fire("Deleted!", "Your Category has been deleted.", "success");
                 suppliercategorydetails_list_table.ajax.reload();
               }
               if(data == 1)
               {
                 swal.fire("Not Deleted!", "Your Category is used in Supplier Details.", "success");
                 suppliercategorydetails_list_table.ajax.reload();
    
             }
             }
          });
          } else {
            swal.fire("Cancelled", "Your  Entry is safe :)", "error");
          }
        })
       });
      $(document).on('click', '.sup_cat_typerestore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Supplier Category Entry !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'settingssup_cat_TrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Supplier Category Entry has been Restored.", "success");
                window.location.href="settingssuppliercategory";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Supplier Category Entry is not restored)", "error");

          }
        })
     });

var suppliertypedetails_table = $('#suppliertypedetails_list').DataTable({
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
            doc.content[1].table.widths = [ '25%',  '25%', '30%', '25%'];
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
        "url": 'settingssupplier_type',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'title', name: 'title' },
        {
            data: 'color',
            name: 'color',
            render: function(data, type, row) {
                return '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' + row.color + '">&nbsp;&nbsp;</div>';
            }
        },
        { data: 'discription', name: 'discription' },
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
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_7"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text suppliertypedetail_update" id=' + row.id + ' data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_supplierinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});

var trashtypedetails_table = $('#trashtype').DataTable({
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
            doc.content[1].table.widths = [ '25%',  '25%', '30%', '25%'];
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
        "url": 'settingssuppliertrash',
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
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                        <span class="kt-nav__link-text typerestore" id=' + row.id + ' data-id=' + row.id + '>Restore</span></span></li>\
                       </ul></div></div></span>';
            }
        },

    ]
});

$(document).on('click', '#suppliertypedetail_submit', function(e) {
e.preventDefault();

    title = $('#title').val();
    color = $('#color').val();

    if (title == "") {
        $('#title').addClass('is-invalid');
        return false;
    } else {
        $('#title').removeClass('is-invalid');
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
        url: "settingssuppliertypeSubmit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            info_id: $('#id').val(),
            title: $('#title').val(),
            discription: $('#discription').val(),
            color: $('#color').val(),
            branch : $('#branch').val()
            

        },
        success: function(data) {

          if(data == false)
          {
            $('#suppliertypedetail_submit').removeClass('kt-spinner');
            $('#suppliertypedetail_submit').prop("disabled", false);
             toastr.warning('The Supplier Type Name  Already Exists');

          }
          else
          {
            $('#suppliertypedetail_submit').removeClass('kt-spinner');
            $('#suppliertypedetail_submit').prop("disabled", false);
            closeModeltype();
            suppliertypedetails_table.ajax.reload();
            toastr.success('Supplier type ' + sucess_msg + ' successfuly');
          }

        },
        error: function(jqXhr, json, errorThrown) {

            console.log('Error !!');
        }
    });
});
function closeModeltype() {
        $("#kt_modal_4_7").modal("hide");
        $('#id').val("");
        $('#title').val("");
        $('#discription').val("");
        $('#color').val("");
}

$(document).on('click', '.suppliertypedetail_update', function() {
    var cust_id = $(this).attr("data-id");
    $.ajax({
        url: "settingsgetsuppliertype",
        method: "POST",
        data: {
            _token: $('#token').val(),
            cust_id: cust_id
        },
        dataType: "json",
        success: function(data) {
            $('#title').val(data['users'].title);
            $('#discription').val(data['users'].discription);
            $('#color').val(data['users'].color);

            $('#id').val(cust_id);
            

        }
    })
});

$(document).on('click', '.kt_del_supplierinformation', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Entry !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: 'settingsdeletesuppliertypeInfo',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {
                  console.log(data);
                   if(data == 0)
                  {
                    swal.fire("Deleted!", "Your Type has been deleted.", "success");
                    suppliertypedetails_table.ajax.reload();
                  }
                  if(data == 1)
                  {
                    swal.fire("Not Deleted!", "Your Type is used in Supplier Details.", "success");
                    suppliertypedetails_table.ajax.reload();
                  }
                }
            });
        } else {
            swal.fire("Cancelled", "Your  Entry is safe :)", "error");
        }
    })
});
/**
 *Supplier Category Information DataTable Export
 */

$("#suppliercategorydetails_list_print").on("click", function() {
    suppliercategorydetails_list_table.button('.buttons-print').trigger();
});


$("#suppliercategorydetails_list_copy").on("click", function() {
    suppliercategorydetails_list_table.button('.buttons-copy').trigger();
});

$("#suppliercategorydetails_list_csv").on("click", function() {
    suppliercategorydetails_list_table.button('.buttons-csv').trigger();
});

$("#suppliercategorydetails_list_pdf").on("click", function() {
    suppliercategorydetails_list_table.button('.buttons-pdf').trigger();
});


/**
 *Supplier Category trash DataTable Export
 */

$("#trashdetailslistsuppliercategory_print").on("click", function() {
    suppliercategorydetails_trash_table.button('.buttons-print').trigger();
});


$("#trashdetailslistsuppliercategory_copy").on("click", function() {
    suppliercategorydetails_trash_table.button('.buttons-copy').trigger();
});

$("#trashdetailslistsuppliercategory_csv").on("click", function() {
    suppliercategorydetails_trash_table.button('.buttons-csv').trigger();
});

$("#trashdetailslistsuppliercategory_pdf").on("click", function() {
    suppliercategorydetails_trash_table.button('.buttons-pdf').trigger();
});
/**
 *Supplier type  Information DataTable Export
 */

$("#suppliertypedetails_list_print").on("click", function() {
    suppliertypedetails_table.button('.buttons-print').trigger();
});


$("#suppliertypedetails_list_copy").on("click", function() {
    suppliertypedetails_table.button('.buttons-copy').trigger();
});

$("#suppliertypedetails_list_csv").on("click", function() {
    suppliertypedetails_table.button('.buttons-csv').trigger();
});

$("#suppliertypedetails_list_pdf").on("click", function() {
    suppliertypedetails_table.button('.buttons-pdf').trigger();
});


/**
 *Supplier  trash type DataTable Export
 */

$("#trashtype_print").on("click", function() {
    trashtypedetails_table.button('.buttons-print').trigger();
});


$("#trashtype_copy").on("click", function() {
    trashtypedetails_table.button('.buttons-copy').trigger();
});

$("#trashtype_csv").on("click", function() {
    trashtypedetails_table.button('.buttons-csv').trigger();
});

$("#trashtype_pdf").on("click", function() {
    trashtypedetails_table.button('.buttons-pdf').trigger();
});

$(document).on('click', '.typerestore', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Supplier Type Entry  Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'settingstypeTrashRestores',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {

                    swal.fire("Restored!", "Your Supplier Type Entry has been deleted.", "success");
                    window.location.href = "settingssupplier_type";

                }
            });
        } else {
            swal.fire("Cancelled", "Your Supplier Entry is not restored )", "error");

        }
    })
});


