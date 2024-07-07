const uppyObjHeadder = Uppy.Core({
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
        fileDataHeadder = [];
        const updatedFiles = {};
        Object.keys(files).forEach(fileID => {
            fileDataHeadder.push('pdfheader/' + files[fileID].name)
        })
        //return updatedFiles
        $('#fileDataHeadder').val(fileDataHeadder);

    },

})

uppyObjHeadder.use(Uppy.Dashboard, {
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
    target: '#choose-headder',
    inline: true,
    replaceTargetContent: true,
    width: '95%',
    height: '25%'
})
uppyObjHeadder.use(Uppy.Webcam, {
    target: Uppy.Dashboard
})
uppyObjHeadder.use(Uppy.XHRUpload, {
    endpoint: 'headder-upload',
    // UniqueID       : $('#UniqueID').val(),
    fieldName: 'filenames[]',
    headers: {
        'X-CSRF-TOKEN': $('#token').val(),
        // UniqueID       : $('#UniqueID').val()
    }
})

if ($('#fileDataHeadder').val() != '') {
    var img_array = $('#fileDataHeadder').val().split(",");
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
            uppyObjHeadder.addFile({
                name: img_name,
                type: 'image/jpeg',
                data: blob
            })
        })
}

uppyObjHeadder.on('complete', (result) => {
    // Get the uploaded file data
    const file = result.successful[0];
    // Display the uploaded image in the image container
    const imageUrl = URL.createObjectURL(file.data);
    $('.branchInvoiceHeadderSummary').html(`<img src="${imageUrl}" alt="Invoice Headder Not Uploded">`);
});