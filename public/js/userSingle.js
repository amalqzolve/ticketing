$(document).ready(function() {


    const uppy = Uppy.Core({
        autoProceed: true,
        allowMultipleUploads: true,
        showRemoveButtonAfterComplete: true,
        meta: {
            UniqueID       : $('#UniqueID').val()
        },
        onBeforeUpload   : (files) => {
            fileData           = [];
            const updatedFiles = {};

            Object.keys(files).forEach(fileID => {
                fileData.push('userInfoData/'+$('#UniqueID').val()+'/'+files[fileID].name );
            });
            //return updatedFiles
            $('#fileData').val(fileData);

        },

    });

    uppy.use(Uppy.FileInput, {
        target: '.UppyForm',
        pretty: true,
        inputName: 'files[]',
        replaceTargetContent: true,


    })
    uppy.use(Uppy.ProgressBar, {
        target: '.UppyProgressBar',
        showProgressDetails: true,
        hideAfterFinish: true,
    })
    uppy.use(Uppy.XHRUpload, {
        endpoint: 'FileUpload',
        UniqueID       : $('#UniqueID').val(),
        fieldName: 'filenames[]',
        headers: {
            'X-CSRF-TOKEN': $('#token').val(),
            UniqueID       : $('#UniqueID').val()
        }
    });

// And display uploaded files
    uppy.on('upload-success', (file, response) => {
        const url      = response.uploadURL;
        const fileName = file.name;

        document.querySelector('.uploaded-files ol').innerHTML +=
            `<li><a href="${url}" target="_blank">${fileName}</a> <i data-name="${fileName}" class="flaticon2-cancel-music removeUppyItem"></i></li>`
    })


    var table = $('#userdetails_list').DataTable({
        "dom"        : 'B<"top"f>rt<"bottom"lp>',
        "lengthMenu" : [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        "buttons": [
            {
                extend: 'pageLength',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'copy',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'csv',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'excel',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'pdf',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
                }
            },
            {
                extend: 'print',
                text: 'Print all (not just selected)',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
        ],
        "select": {
            style   :  'os',
            selector: 'td:first-child'
        },
        select: true,
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": [ 'odd-row', 'even-row' ],
        "order": [],

        "ajax": {
            "url" : 'userList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });

  $('.js-data-example-ajax').select2({
  ajax: {
    url: "userListDropDown",
    dataType: 'json',
    type : "POST",
    multiple: true,
    delay: 250,
    data: function (params) {
      return {
      	_token : $('#token').val(),
        q      : params.term, // search term
        page   : params.page
      };
    },
    processResults: function (data, params) {
      // parse the results into the format expected by Select2
      // since we are using custom formatting functions we do not need to
      // alter the remote JSON data, except to indicate that infinite
      // scrolling can be used
      params.page = params.page || 1;

      return {
        results: data.items,
        pagination: {
          more: (params.page * 30) < data.total_count
        }
      };
    },
    cache: true
  },
  placeholder: 'Search for a repository',
  minimumInputLength: 1,
  templateResult: formatRepo,
  templateSelection: formatRepoSelection
});

    var userSelect = $('.js-data-example-ajax');

    $.ajax({
        type: 'POST',
        url: $('#base_url').val()+'/'+'selectOptions/information/' + $('#cust_id').val(),
        data: {
            _token: $('#token').val(),
        },
        success: function (data) {

            $.each(data, function(i, item) {
            console.log(data[i].cust_name);
            // create the option and append to Select2
            var option = new Option(data[i].cust_name, data[i].id, true, true);
            userSelect.append(option).trigger('change');
            });
            // manually trigger the `select2:select` event
            // userSelect.trigger({
            //     type: 'select2:select',
            //     params: {
            //         data: data
            //     }
            // });
        }
    });

function formatRepo (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div class='select2-result-repository clearfix'>" +
      "<div class='select2-result-repository__avatar'><img width=20px src='" + repo.url + "' /></div>" +
      "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'></div>" +
        "<div class='select2-result-repository__description'></div>" +
        "<div class='select2-result-repository__statistics'>" +
          "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> </div>" +
          "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> </div>" +
          "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> </div>" +
        "</div>" +
      "</div>" +
    "</div>"
  );

  $container.find(".select2-result-repository__title").text(repo.full_name);
  $container.find(".select2-result-repository__description").text(repo.description);
  $container.find(".select2-result-repository__forks").append(repo.forks_count + " Forks");
  $container.find(".select2-result-repository__stargazers").append(repo.stargazers_count + " Stars");
  $container.find(".select2-result-repository__watchers").append(repo.watchers_count + " Watchers");

  return $container;
}

function formatRepoSelection (repo) {
  return repo.full_name || repo.text;
}



    $(document).on('click', '#single_Customerdetail_submit', function(e){

         e.preventDefault();

         $(this).addClass('kt-spinner');
         $(this).prop( "disabled", true );

         $('#user-form').validate(  {
          rules: {
            cust_type : "required",
            cust_email: {
              required: true,
              email: true
            }
            },
          messages: {
            cust_type  : "Please specify your Customer Type",
            cust_email : {
              required: "We need your email address to contact you",
              email: "Your email address must be in the format of name@domain.com"
            }
          }

         });


        if (!$('#user-form').valid()) // check if form is valid
        {
            $(this).removeClass('kt-spinner');

            $(this).prop( "disabled", false );

            return false;

        }

        var skill=[];

        var skillValue=[];


        $(".addmore").each(function() {

            skill.push($(this).find(".skill").val());
            skillValue.push($(this).find(".skillValue").val());

        });

        var selectedItemArray = [];
        var selectData = $('.js-data-example-ajax').select2('data');

        $.each(selectData, function( index, value ) {
            //alert( index + ": " + value['id'] );
            selectedItemArray.push(value['id']);
        });

        $.ajax({
            type: "POST",
            url: $('#base_url').val()+'/'+'userInfo',
            dataType: "json",
            data: {
                _token      : $('#token').val(),
                cust_id     : $('#cust_id').val(),
                cust_type   : $('#cust_type').val(),
                cust_name   : $('#cust_name').val(),
                cust_add1   : $('#cust_add1').val(),
                cust_add2   : $('#cust_add2').val(),
                cust_country: $('#cust_country').val(),
                cust_city   : $('#cust_city').val(),
                cust_region : $('#cust_region').val(),
                cust_zip    : $('#cust_zip').val(),
                cust_email  : $('#cust_email').val(),
                cust_officephone: $('#cust_officephone').val(),
                cust_mobile : $('#cust_mobile').val(),
                cust_fax    : $('#cust_fax').val(),
                cust_website: $('#cust_website').val(),
                file_data   : $('#fileData').val(),
                cust_users  : selectedItemArray.toString(),
                UniqueID    : $('#UniqueID').val(),
                skill       : skill,
                skillValue  : skillValue
            },
            success: function (data) {

                swal.fire("Done", "Submission Sucessfully", "success");

                $('#user-form')[0].reset();

                $('.uploaded-files ol').empty();

                uppy.reset();

                $('#single_Customerdetail_submit').removeClass('kt-spinner');

                $('#single_Customerdetail_submit').prop( "disabled", false );

            },
            error   : function ( jqXhr, json, errorThrown )
            {
                $('#single_Customerdetail_submit').removeClass('kt-spinner');

                $('#single_Customerdetail_submit').prop( "disabled", false );

                var errors = jqXhr.responseJSON;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    if(jQuery.isPlainObject( value )){

                      $.each(value, function( index, ndata ) {
                        errorsHtml += '<li>' + ndata + '</li>';
                      });

                    }else{

                    errorsHtml += '<li>' + value + '</li>';

                    }
                });
                toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });


    });

    var i=1;

    $('#add-more').click(function(){

        i++;

        $('#table-more').append('<tr id="row'+i+'" class="dynamic-added addmore subadmore">\
    <td>\
    <input type="text"  name="skill['+i+']" placeholder="Skill" class="skill form-control name_list" />\
    </td>\
    <td>\
    <input type="text"  name="skillValue['+i+']" placeholder="Value" class="skillValue form-control name_list" />\
    </td>\
    <td>\
    <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>\
    </td>\
    </tr>');

    });

    $(document).on('click', '.btn_remove', function(){

        var button_id = $(this).attr("id");

        $('#row'+button_id+'').remove();

    });

    $(document).on('click', '.removeUppyItem', function(){
        var newFileData = [];

        var button_id = $(this).attr("data-name");

        $(this).parent('li').remove();

        var filearray = $('#fileData').val().split(",");

        $.each(filearray,function(i){
            //alert(filearray[i]);
            var single = filearray[i].split("/");

            if(button_id!=single[2])
             {
              newFileData.push(filearray[i]);
             }

        });

        $('#fileData').val(newFileData);
    });

});
