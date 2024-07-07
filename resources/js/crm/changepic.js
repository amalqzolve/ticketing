  const uppy = Uppy.Core({
        autoProceed: false,
        allowMultipleUploads: false,
        // meta: {
        //         UniqueID       : $('#UniqueID').val()
        //     },
        onBeforeUpload: (files) => {
            fileData = [];
            const updatedFiles = {};

            Object.keys(files).forEach(fileID => {
                    fileData.push('Profilepicture/' + files[fileID].name)
                })
                //return updatedFiles
            $('#fileData').val(fileData);

        },

    })

    uppy.use(Uppy.Dashboard, {
        metaFields: [
            { id: 'name', name: 'Name', placeholder: 'File name' },
            { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
        ],
        browserBackButtonClose: true,
        target: '#choose-files',
        inline: true,
        replaceTargetContent: true,
        width:'100%'
    })
    uppy.use(Uppy.GoogleDrive, {
        target: Uppy.Dashboard,
        companionUrl: 'https://companion.uppy.io'
    })
    uppy.use(Uppy.Webcam, { target: Uppy.Dashboard })
    uppy.use(Uppy.XHRUpload, {
        endpoint: 'profilepictureFileUpload',
        // UniqueID       : $('#UniqueID').val(),
        fieldName: 'filenames[]',
        headers: {
            'X-CSRF-TOKEN': $('#token').val(),
            // UniqueID       : $('#UniqueID').val()
        }
    })

    if ($('#fileData').val() != '') {
        var img_array = $('#fileData').val().split(",");
        console.log(img_array);
        $.each(img_array, function(i) {
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


        $(document).on('click', '#changepicture', function(e) {
        e.preventDefault();
        
        fileData = $('#fileData').val();

       
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        if($('#id').val()){
        var sucess_msg ='Updated';
        } else{
        var sucess_msg ='Created';
        }

        $.ajax({
            type: "POST",
            url: "submit-changepic",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                id: $('#id').val(),
                fileData: $('#fileData').val()
            },
            success: function(data) {
          
                uppy.reset();

                $('#changepicture').removeClass('kt-spinner');
                $('#changepicture').prop("disabled", false);
               
                toastr.success('Profile Profilepicture '+sucess_msg+' Successfuly');
                
          
            },
            error: function(jqXhr, json, errorThrown) {
                        console.log('Error !!');
            }
        });
    });