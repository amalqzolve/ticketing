$('.changeProfile').click(function () {
    $('#profileModel').modal('show');
});


const uppy = Uppy.Core({
    autoProceed: true,
    allowMultipleUploads: false,

    restrictions: {
        maxNumberOfFiles: 1,
        minNumberOfFiles: 1,
        allowedFileTypes: ['image/*', '.jpg', '.jpeg', '.png'],
    },

    meta: {
        id: $('#id').val(),
    },
    onBeforeUpload: (files) => {
        fileData = [];
        const updatedFiles = {};

        Object.keys(files).forEach(fileID => {
            fileData.push('Profilepicture/' + files[fileID].name)
        })
        //return updatedFiles
        $('#fileDataProfile').val(fileData);

    },

})

uppy.use(Uppy.Dashboard, {
    metaFields: [
        { id: 'name', name: 'Name', placeholder: 'File name' },
        { id: 'caption', name: 'Caption', placeholder: 'Describe what the image is about' }
    ],
    browserBackButtonClose: true,
    target: '#choose-files',
    inline: true,
    replaceTargetContent: true,
    width: '100%'
})
/*  uppy.use(Uppy.GoogleDrive, {
    target: Uppy.Dashboard,
    companionUrl: 'https://companion.uppy.io'
})*/
uppy.use(Uppy.Webcam, { target: Uppy.Dashboard })
uppy.use(Uppy.XHRUpload, {
    endpoint: $('#cur_url').val() + '/profilepictureFileUpload',
    // UniqueID       : $('#UniqueID').val(),
    fieldName: 'filenames[]',
    headers: {
        'X-CSRF-TOKEN': $('#token').val(),
        UniqueID: $('#UniqueID').val()
    }
})

if ($('#fileDataProfile').val() != '') {
    var img_array = $('#fileDataProfile').val().split(",");
    console.log(img_array);
    $.each(img_array, function (i) {
        onuppyImageClicked('public/' + img_array[i]);
    });
}

function onuppyImageClicked(img) {

    var str = img.toString();
    var n = str.lastIndexOf('/');
    var img_name = str.substring(n + 1);
    // assuming the image lives on a server somewhere
    return fetch(img)
        .then((response) => response.blob()) // returns a Blob
        .then((blob) => {
            uppy.addFile({
                name: img_name,
                type: 'image/jpeg',
                data: blob
            })
        })
}



$(document).on('click', '#btnSaveProfile', function (e) {
    var error = 0;
    if (($('#password').val() != "") || ($('#current_password').val() != "")) {
        let data = $("#current_password").val().trim();
        if ((data == '') || data.length < 8) {
            $('#current_password').addClass('is-invalid');
            if (data.length < 8)
                $("#current_password").next().html('must have minimum  8 Digits');
            error++;
        } else
            $('#current_password').removeClass('is-invalid');
        if ($('#password_confirmation').val() == "") {
            $('#password_confirmation').addClass('is-invalid');
            error++;
        } else
            $('#password_confirmation').removeClass('is-invalid');
        let dataPassword = $("#password").val().trim();
        if (($('#password').val() == "") || (dataPassword.length < 8)) {
            $('#password').addClass('is-invalid');
            if (dataPassword.length < 8)
                $("#password").next().html('must have minimum 8 Digits');
            error++;
        } else
            $('#password').removeClass('is-invalid');
    }

    if ($('#user_name').val() == "") {
        $('#user_name').addClass('is-invalid');
        error++;
    } else
        $('#user_name').removeClass('is-invalid');

    if (!error) {
        $('#btnSaveProfile').addClass('kt-spinner');
        $('#btnSaveProfile').attr("disabled", true);
        $.ajax({
            type: "POST",
            url: $('#cur_url').val() + "/update-pofile",
            dataType: "json",
            data: $('#profileForm').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                if (data.status == 2) {
                    $.each(data.error, function (key, value) {
                        $("#" + key).next().html(value[0]);
                        $("#" + key).addClass('is-invalid');
                    });
                    $('#btnSaveProfile').removeClass('kt-spinner');
                    $('#btnSaveProfile').prop("disabled", false);
                }
                else if (data.status == 1) {
                    toastr.success('Profile Has been Changed Successfully');
                    $('#btnSaveProfile').removeClass('kt-spinner');
                    $('#btnSaveProfile').prop("disabled", false);
                    location.reload();
                } else {
                    $('#btnSaveProfile').removeClass('kt-spinner');
                    $('#btnSaveProfile').prop("disabled", false);
                    toastr.error(data.msg);
                }
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else {
        toastr.warning('Fill Mandatory Fields.');
    }

});


// $(document).on('click', '#changepicture', function (e) {
//     e.preventDefault();

//     fileData = $('#fileData').val();


//     $(this).addClass('kt-spinner');
//     $(this).prop("disabled", true);
//     if ($('#id').val()) {
//         var sucess_msg = 'Updated';
//     } else {
//         var sucess_msg = 'Created';
//     }

//     $.ajax({
//         type: "POST",
//         url: "submit-changepic",
//         dataType: "json",
//         data: {
//             _token: $('#token').val(),
//             id: $('#id').val(),
//             fileData: $('#fileData').val()
//         },
//         success: function (data) {

//             uppy.reset();

//             $('#changepicture').removeClass('kt-spinner');
//             $('#changepicture').prop("disabled", false);

//             toastr.success('Profile Profilepicture ' + sucess_msg + ' Successfuly');


//         },
//         error: function (jqXhr, json, errorThrown) {
//             console.log('Error !!');
//         }
//     });
// });