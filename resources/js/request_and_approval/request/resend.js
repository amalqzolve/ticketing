/**
 *Datatable for product details Information
 */
$('.request-list').addClass('kt-menu__item--active');

$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).on('changeDate', function (e) {
    $(this).datepicker('hide');
});
$(document.body).on("change", "#request_type", function () {
    if ($(this).val() == 4) {
        $('#client').prop("disabled", false);
        $('#project').prop("disabled", false);
    } else {
        $('#client').val('').trigger('change');
        $('#project').val('').trigger('change');
        $('#client').prop("disabled", true);
        $('#project').prop("disabled", true);
    }
});

//

$('#addNewItem').click(function () {
    var rowcount = $('#product_table tr').length;
    var product = '';
    product += '<tr>\
                        <td style="text-align: center;">' + rowcount + '</td>\
                        <td>\
                        <div class="input-group input-group-sm">\
                        <input type="text" class="form-control" name="item_name[]" id="item_name" data-id="' + rowcount + '" value="">\
                        <div>\
                        </td>\
                        <td><textarea class="form-control" id="item_description' + rowcount + '" name="item_description[]" rows="1" data-id=' + rowcount + ' style=" height: 30px !important;"></textarea>\
                        </td>\
                        <td  style="background-color: white;">\
                            <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">\
                                <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
                                <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>\
                            </div>\
                        </td>\
                    </tr>';

    $('#product_table').append(product);
});


$(document.body).on("change", "#request_against", function () {
    $('#client').val('');
    $('#project').val('');
    refreshItems();

    if ($('#request_against').val() == 1)// Personal 
    {
        $('#noteDiv').show();
        $('#clientDiv').hide();
        $('#projectDiv').hide();
        $('#departmentDiv').hide();
    }
    else if ($('#request_against').val() == 2)// Client
    {
        $('#clientDiv').show();
        $('#noteDiv').hide();
        $('#projectDiv').hide();
        $('#departmentDiv').hide();
    }
    else if ($('#request_against').val() == 3)// Project
    {
        $('#projectDiv').show();
        $('#noteDiv').hide();
        $('#clientDiv').hide();
        $('#departmentDiv').hide();
    }
    else if ($('#request_against').val() == 4)// Department
    {
        $('#departmentDiv').show();
        $('#noteDiv').hide();
        $('#clientDiv').hide();
        $('#projectDiv').hide();
    }
    else if ($('#request_against').val() == 5)// Official
    {
        $('#noteDiv').show();
        $('#clientDiv').hide();
        $('#projectDiv').hide();
        $('#departmentDiv').hide();
    }
});



$(document.body).on("change", "#terms", function () {
    var cid = $(this).val();
    $.ajax({
        url: "get-terms-from-id",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
            var termcondition = '';
            $.each(data, function (key, value) {

                termcondition = value.description;
            });

            $('#kt-tinymce-4').val(termcondition);
            tinymce.activeEditor.setContent(termcondition);
            console.log(termcondition);

        }
    })
});

$("body").on("click", ".remove", function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');


    var siblings = row.siblings();
    row.remove();
    siblings.each(function (index) {
        $(this).children().first().text(index + 1);
    });
});

$(document).on('click', '#revise_submit', function (e) {
    e.preventDefault();
    var error = 0;
    var item_name = 0;
    $("input[name^='item_name[]']").each(function (input) {
        if ($(this).val() == '') {
            $(this).addClass('is-invalid');
            error++;
        } else
            $(this).removeClass('is-invalid');
        item_name++;
    });
    if (!item_name) {
        error++;
        toastr.error('Add atleast an Item !!!');
    }

    var users = 0;
    $("select[name^='users[]']").each(function (input) {
        if ($(this).val() == '') {
            error++;
            $(this).next().find('.select2-selection').addClass('select-dropdown-error');
        }
        else
            $(this).next().find('.select2-selection').removeClass('select-dropdown-error');
        users++;
    });

    if (!users) {
        error++;
        toastr.error('Add atleast Approval User !!!');
    }

    if ($('#request_tittle').val() == "") {
        $('#request_tittle').addClass('is-invalid');
        error++;
    } else
        $('#request_tittle').removeClass('is-invalid');

    if ($('#required_on').val() == "") {
        $('#required_on').addClass('is-invalid');
        error++;
    } else
        $('#required_on').removeClass('is-invalid');


    if ($('#request_against').val() == '') {
        error++;
        $('#request_against').next().find('.select2-selection').addClass('select-dropdown-error');
    }
    else
        $('#request_against').next().find('.select2-selection').removeClass('select-dropdown-error');

    if (error == 0) {
        swal.fire({
            title: "Are you sure?",
            text: "Do you want resend this Request for approval",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Resend",
            cancelButtonText: "Cancel"
        }).then(result => {
            if (result.value) {
                $('#revise_submit').addClass('kt-spinner');
                $('#revise_submit').prop("disabled", true);
                loaderShow();
                $.ajax({
                    type: "POST",
                    url: "../request-revise-save",
                    dataType: "json",
                    data: $('#data-form').serialize() + "&_token=" + $('#token').val(),
                    success: function (data) {
                        $('#revise_submit').removeClass('kt-spinner');
                        $('#revise_submit').prop("disabled", false);
                        // loaderClose();
                        if (data.status == 1) {
                            toastr.success('Request revised successfuly');
                            window.location.href = "../request-list";
                        } else
                            toastr.error(data.msg);


                    },
                    error: function (jqXhr, json, errorThrown) {
                        toastr.error('Error !!');
                    }
                });
            } else {
                swal.fire("Cancelled", "", "error");
            }
        });

    } else
        toastr.error('Fill mandatory Fileds !!!');
});




// file upload


const uppyProject = Uppy.Core({
    autoProceed: true,
    allowMultipleUploads: true,
    restrictions: {
        /* maxNumberOfFiles: 1,
           minNumberOfFiles: 1,*/
        // allowedFileTypes: ["image/*"]
    },
    meta: {
        request_id: $('#id').val(),
    },
    onBeforeUpload: (files) => {
        fileData = [];
        const updatedFiles = {};

        Object.keys(files).forEach(fileID => {
            fileData.push('custdocumentInfoData/' + files[fileID].name)
        })
        //return updatedFiles
        $('#projectfileData').val(fileData);

    },
})

uppyProject.use(Uppy.Dashboard, {
    metaFields: [
        { id: 'name', name: 'Name', placeholder: 'File name' },
        { id: 'description', name: 'description', placeholder: 'Describe what the image is about.' }
    ],
    browserBackButtonClose: true,
    target: '#choose-project-files',
    inline: true,
    replaceTargetContent: true,
    width: '100%'
})
uppyProject.use(Uppy.Webcam, { target: Uppy.Dashboard })
uppyProject.use(Uppy.XHRUpload, {
    endpoint: '../request-attachments-upload',
    fieldName: 'filenames[]',
    headers: {
        'X-CSRF-TOKEN': $('#token').val(),
        UniqueID: $('#UniqueID').val(),
    }
})


function onuppyImageClicked(img) {

    var str = img.toString();
    var n = str.lastIndexOf('/');
    var img_name = str.substring(n + 1);
    // assuming the image lives on a server somewhere
    return fetch(img)
        .then((response) => response.blob()) // returns a Blob
        .then((blob) => {
            Uppy.addFile({
                name: img_name,
                type: 'image/jpg',
                data: blob
            })
        })
}

//

// ./ file upload



var filesTbl = $('#filesTbl').DataTable({
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
            columns: [0, 1, 2]
        }
    },
    {
        extend: 'csv',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
        }
    },
    {
        extend: 'excel',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
        }
    },
    {
        extend: 'pdf',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
        },
        pageSize: 'A4',
        orientation: 'landscape',
        customize: function (doc) {
            doc.pageMargins = [50, 50, 50, 50];
        }
    },
    {
        extend: 'print',
        className: "hidden",
        exportOptions: {
            columns: [0, 1, 2]
        }
    }
    ],

    ajax: {
        "url": '../request-attachments/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.request_id = $('#id').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            data: 'file', name: 'file', render: function (data, type, row) {
                var curData = row.file;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'description', name: 'description', render: function (data, type, row) {
                var curData = row.description;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        {
            data: 'name', name: 'name', render: function (data, type, row) {
                var curData = row.name;
                if (curData != null)
                    return curData.length > 50 ? curData.substr(0, 50) + '…' : curData;
                else
                    return '-';
            }
        },
        { data: 'uploded_date', name: 'uploded_date' },
        { data: 'action', name: 'action' },

    ],
    // "fnRowCallback": function (nRow, aData, iDisplayIndex) {
    //     $("td:nth-child(5)", nRow).html($("td:nth-child(5)", nRow).text());
    // },
});
