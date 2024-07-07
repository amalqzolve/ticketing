$('.projects').addClass('kt-menu__item--open');
$('.projects-awarded-list').addClass('kt-menu__item--active');

$(document).on("click", ".myfile", function () {
    $per = $(this).parent();
    $input = $($per).children("input");
    $progress = $($per).children("div");
    $input.click();
    $($input).bind('change', function () {
        //this.files[0].size gets the size of your file.
        $($progress).append("<div class='progress' style='height:5px'><div class='progress-bar' style='width:100%;height:10px'></div></div>");

    });
});


$(document).on("click", ".vcmt", function () {
    $(this).hide();
    var currentComment = $(this).attr('data-id');
    localStorage.setItem('currentChat', currentComment);
    $supper = $(this).parents(".grp");
    $hiden = $($supper).find("span");
    $($hiden).fadeToggle("slow");
});
$(document).on("click", ".rply", function () {
    $supper = $(this).parents(".grp");
    $hiden = $($supper).find(".cmnt");
    $($hiden).fadeToggle("slow");
});


const uppyProject = Uppy.Core({
    autoProceed: true,
    allowMultipleUploads: true,
    restrictions: {
        maxNumberOfFiles: 1,
        allowedFileTypes: ["image/*"]
    },
    meta: {
        project_id: $('#project_id').val(),
    },
    onBeforeUpload: (files) => {
        fileData = [];
        const updatedFiles = {};
        Object.keys(files).forEach(fileID => {
            fileData.push(files[fileID].name)
        })
        $('#projectCommentFileData').val(fileData);

    },

})

uppyProject.use(Uppy.FileInput, {
    target: '#Uppy',
});

uppyProject.use(Uppy.ProgressBar, {
    target: '#UppyProgressBar',
    hideAfterFinish: false,
});

uppyProject.use(Uppy.XHRUpload, {
    endpoint: '../project-comment-file-upload',
    fieldName: 'filenames[]',
    headers: {
        'X-CSRF-TOKEN': $('#token').val(),
        UniqueID: $('#UniqueID').val(),
    }
});

$(document).on('click', '#btnPostMainComment', function (e) {
    e.preventDefault();
    tax_name = $('#name').val();
    var error = 0;

    if ($('#comment').val() == "") {
        $('#comment').addClass('is-invalid');
        error++;
    } else {
        $('#comment').removeClass('is-invalid');
    }

    if (!error) {
        $('#btnPostMainComment').addClass('kt-spinner');
        $('#btnPostMainComment').prop("disabled", true);
        if ($('#id').val()) {
            var sucess_msg = 'Updated';
        } else {
            var sucess_msg = 'Created';
        }
        $.ajax({
            type: "POST",
            url: "../project-comment-submit",
            dataType: "json",
            data: $('#data-from-main-comment').serialize() + "&_token=" + $('#token').val() + "&project_id=" + $('#project_id').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#btnPostMainComment').removeClass('kt-spinner');
                    $('#btnPostMainComment').prop("disabled", false);
                    toastr.success('Comment Saved ' + sucess_msg + ' successfuly');
                    location.reload();
                }
                else {
                    $('#btnPostMainComment').removeClass('kt-spinner');
                    $('#btnPostMainComment').prop("disabled", false);
                    toastr.error(data.msg);
                }

            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});



$(document).on('click', '.commentTrash', function (e) {

    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Comment!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: '../project-comment-delete',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {
                    console.log(data);
                    if (data == 'true') {
                        swal.fire("Deleted!", "Your label has been deleted.", "success");
                        location.reload();
                    }


                }
            });
        } else {
            swal.fire("Cancelled", "Your Entry is safe :)", "error");

        }
    })
});

$(document).on('click', '.subCommentTrash', function (e) {

    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Comment!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: '../project-sub-comment-delete',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function (data) {
                    console.log(data);
                    if (data == 'true') {
                        swal.fire("Deleted!", "Comments Has been deleted.", "success");
                        location.reload();
                    }


                }
            });
        } else {
            swal.fire("Cancelled", "Your Entry is safe :)", "error");

        }
    })
});


$(document).on('click', '.btnPostSubComment', function (e) {
    e.preventDefault();
    var currentButton = $(this);
    tax_name = $('#name').val();
    var error = 0;
    var form = $(this).closest("form");
    var comment = form.find('.sub_comment').val();
    console.log(comment);
    if (comment == "") {
        form.find('.sub_comment').addClass('is-invalid');
        error++;
    } else {
        form.find('.sub_comment').removeClass('is-invalid');
    }
    if (!error) {
        currentButton.addClass('kt-spinner');
        currentButton.prop("disabled", true);
        var formData = new FormData($(form)[0]);
        formData.append("_token", $('#token').val());
        formData.append("project_id", $('#project_id').val());
        $.ajax({
            type: "POST",
            url: "../project-sub-comment-submit",
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == 1) {
                    currentButton.removeClass('kt-spinner');
                    currentButton.prop("disabled", false);
                    toastr.success('Replay Saved successfuly');
                    location.reload();
                }
                else {
                    currentButton.removeClass('kt-spinner');
                    currentButton.prop("disabled", false);
                    toastr.error(data.msg);
                }

            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});


$(document).ready(function () {
    var chatId = localStorage.getItem('currentChat');
    if (chatId != '')
        $('#btn_' + chatId).click();
    localStorage.setItem('currentChat', '');
});