const uppyObjSeal = Uppy.Core({
    autoProceed: false,
    allowMultipleUploads: false,
    // meta: {
    //         UniqueID       : $('#UniqueID').val()
    //     },
    restrictions: {
        maxNumberOfFiles: 1,
        minNumberOfFiles: 1,
        allowedFileTypes: ['image/*'],
    },
    onBeforeUpload: (files) => {
        console.log('sds');
        fileDataSeal = [];
        const updatedFiles = {};
        Object.keys(files).forEach(fileID => {
            fileDataSeal.push('seal/' + files[fileID].name)
        })
        //return updatedFiles
        $('#fileDataSeal').val(fileDataSeal);

    },

})

uppyObjSeal.use(Uppy.Dashboard, {
    metaFields: [{
        id: 'name',
        name: 'Name',
        placeholder: 'File name'
    },
    {
        id: 'caption',
        name: 'Caption',
        placeholder: 'describe what the image is about'
    }
    ],
    browserBackButtonClose: true,
    target: '#choose-seal',
    inline: true,
    replaceTargetContent: true,
    width: '95%',
    height: '50%'
})
uppyObjSeal.use(Uppy.Webcam, {
    target: Uppy.Dashboard
})
uppyObjSeal.use(Uppy.XHRUpload, {
    endpoint: 'seal-upload',
    // UniqueID       : $('#UniqueID').val(),
    fieldName: 'filenames[]',
    headers: {
        'X-CSRF-TOKEN': $('#token').val(),
        // UniqueID       : $('#UniqueID').val()
    }
})

if ($('#fileDataSeal').val() != '') {
    var img_array = $('#fileDataSeal').val().split(",");
    console.log(img_array);
    $.each(img_array, function (i) {
        onuppyImageClickedSeal('public/' + img_array[i]);
    });
}

function onuppyImageClickedSeal(img) {
    var str = img.toString();
    var n = str.lastIndexOf('/');
    var img_name = str.substring(n + 1);
    // assuming the image lives on a server somewhere
    return fetch(img)
        .then((response) => response.blob()) // returns a Blob
        .then((blob) => {
            uppyObjSeal.addFile({
                name: img_name,
                type: 'image/jpeg',
                data: blob
            })
        })
}

uppyObjSeal.on('complete', (result) => {
    // Get the uploaded file data
    const file = result.successful[0];

    // Display the uploaded image in the image container
    const imageUrl = URL.createObjectURL(file.data);
    $('.branchSealSummary').html(`<img src="${imageUrl}" alt="Invoice Footer Not Uploded">`);
});