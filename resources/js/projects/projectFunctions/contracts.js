$('.projects').addClass('kt-menu__item--open');
$('.projects-awarded-list').addClass('kt-menu__item--active');

const uppyProject = Uppy.Core({
    autoProceed: false,
    allowMultipleUploads: true,
    // restrictions: {
    //     allowedFileTypes: ["image/*"]
    // },
    meta: {
        project_id: $('#project_id').val(),
    },
    onBeforeUpload: (files) => {
        fileData = [];
        const updatedFiles = {};

        Object.keys(files).forEach(fileID => {
            fileData.push('custdocumentInfoData/' + files[fileID].name)
        })
        $('#projectContractData').val(fileData);

    },

})

uppyProject.use(Uppy.Dashboard, {
    metaFields: [
        { id: 'name', name: 'Name', placeholder: 'File name' },
        { id: 'description', name: 'description', placeholder: 'Describe what the image is about.' }
    ],
    browserBackButtonClose: true,
    target: '#choose-project-contract',
    inline: true,
    replaceTargetContent: true,
    width: '100%'
})
uppyProject.use(Uppy.Webcam, { target: Uppy.Dashboard })
uppyProject.use(Uppy.XHRUpload, {
    endpoint: '../project-contract-upload',
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



var contarctTbl = $('#contarctTbl').DataTable({
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
        "url": '../project-contracts/1',
        "type": "POST",
        "data": function (data) {
            data._token = $('#token').val()
            data.project_id = $('#project_id').val()
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



$(document).on('click', '.editView', function () {
    var milestoneId = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "../get-project-contract-details",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: milestoneId
        },
        success: function (data) {
            if (data.status == 1) {
                $('#id').val(data.data.id);
                $('#description').val(data.data.description);
                $('#kt_modal_4_6').modal('show');
            } else
                toastr.success('Data Not Found');
        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });

});


$(document).on('click', '.delete', function () {
    var noteId = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want trash this Note",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Trash",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: "../project-contract-delete",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: noteId
                },
                success: function (data) {
                    if (data.status == 1) {
                        closeModel()
                        toastr.warning('Contract Trashed successfuly');
                    } else
                        toastr.error(data.msg);

                },
                error: function (jqXhr, json, errorThrown) {
                    console.log('Error !!');
                }
            });

        } else
            swal.fire("Cancelled", "", "error");
    })
});



$(document).on('click', '#btnAdd', function (e) {
    $('#kt_modal_4_5').modal('show');
});

$(document).on('click', '#btnSave', function (e) {
    e.preventDefault();
    var error = 0;
    if (!error) {
        $('#btnSave').addClass('kt-spinner');
        $('#btnSave').prop("disabled", true);
        if ($('#id').val()) {
            var sucess_msg = 'Updated';
        } else {
            var sucess_msg = 'Created';
        }
        $.ajax({
            type: "POST",
            url: "../project-contract-details-update",
            dataType: "json",
            data: $('#data-from').serialize() + "&_token=" + $('#token').val() + "&project_id=" + $('#project_id').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#btnSave').removeClass('kt-spinner');
                    $('#btnSave').prop("disabled", false);
                    toastr.success('Contract ' + sucess_msg + ' successfuly');
                    closeModel();
                }
                else {
                    $('#btnSave').removeClass('kt-spinner');
                    $('#btnSave').prop("disabled", false);
                    toastr.error(data.msg);

                }

            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});


$(document).on('click', '.close', function (e) {
    closeModel();
});

function closeModel() {
    contarctTbl.ajax.reload();
    $('#kt_modal_4_5').modal('hide');
    $('#kt_modal_4_6').modal('hide');
    uppyProject.reset();
}
// ./old codeeeee