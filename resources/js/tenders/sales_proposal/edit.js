$('.estimated-boq-list').addClass('kt-menu__item--active');

$('#addNewItem').click(function () {
    var rowcount = $('#product_table tr').length;
    var totalqty = '--';
    var req_qty = '--';
    var balanceQty = '--';
    var product = '';
    product += '<tr>\
                <td style="text-align: center;">' + rowcount + '</td>\
                <td>\
                <div class="input-group input-group-sm">\
                <input type="text" name="item[]" id="item" class="form-control" >\
                </div>\
              </td>\
                <td>\
                  <div class="input-group input-group-sm">\
                  <textarea name="desc[]" id="desc" cols="30" class="form-control" rows="2"></textarea>\
                  </div>\
                </td>\
                <td>\
                <div class="input-group input-group-sm">\
                <input type="text" name="amount[]" id="amount" class="form-control integerVal" value="0.00" >\
                </div>\
              </td>\
                <td  style="background-color: white;">\
                  <div class="kt-demo-icon__preview remove" style="width: fit-content;    margin: auto;">\
                     <span class="badge badge-pill mbdg2 mr-1 ml-1 mt-1 shadow">\
                     <i class="fa fa-trash badge-pill" id="" style="padding:0; cursor: pointer;"></i></span>\
                   </div>\
                </td>\
                </tr>';

    $('#product_table').append(product);
    $("#unit" + rowcount).val('').change();
    $("#unitvalue" + rowcount).val('');
});

const uppySalesProp = Uppy.Core({
    autoProceed: false,
    allowMultipleUploads: false,
    restrictions: {
        maxNumberOfFiles: 1,
        minNumberOfFiles: 1,
        allowedFileTypes: ["image/*"]
    },
    meta: {
        brand_id: $('#id').val(),
    },
    onBeforeUpload: (files) => {
        fileData = [];
        const updatedFiles = {};
        Object.keys(files).forEach(fileID => {
            fileData.push('sales_proposal/' + files[fileID].name)
        })
        $('#fileData').val(fileData);

    },

})

uppySalesProp.use(Uppy.Dashboard, {
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
    target: '#choose-files',
    inline: true,
    replaceTargetContent: true,
    width: '100%'
})
uppySalesProp.use(Uppy.Webcam, {
    target: Uppy.Dashboard
})
uppySalesProp.use(Uppy.XHRUpload, {
    endpoint: 'sales-proposal-upload',
    fieldName: 'filenames[]',
    headers: {
        'X-CSRF-TOKEN': $('#token').val(),
    }
})

if ($('#fileData').val() != '') {
    var img_array = $('#fileData').val().split(",");
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
            uppySalesProp.addFile({
                name: img_name,
                type: 'image/jpeg',
                data: blob
            })
        })
}

$(document.body).on("change", "#terms", function () {
    var cid = $(this).val();
    $.ajax({
        url: "../get-terms-from-id",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
            var termcondition = '';
            if (data.status == 1)
                termcondition = data.data.description
            $('#kt-tinymce-4').val(termcondition);
            tinymce.activeEditor.setContent(termcondition);
        }
    })
});

$(document.body).on("keyup", "[name^='amount[]']", function () {
    summaryCalculation();
});
$(document.body).on("keyup", "#profit_percenatge", function () {
    summaryCalculation();
});

$(document.body).on("keyup", "#discount_percenatge", function () {
    summaryCalculation();
});
$(document.body).on("change", "#vat_percenatge", function () {
    summaryCalculation();
});


function summaryCalculation() {

    var totalAmount = 0;
    $("input[name^='amount[]']").each(function (input) {
        var amount = $(this).val();
        totalAmount += parseFloat(amount);
    });
    $('#linetotalamount').val(totalAmount.toFixed(2));

    var linetotalamount = totalAmount;
    var estimated_amount = parseFloat($('#estimated_amount').val());
    var net_amount = linetotalamount + estimated_amount;
    $('#net_amount').val(net_amount.toFixed(2));

    var profit_percenatge = $('#profit_percenatge').val();
    var profit_amount = (net_amount * parseFloat(profit_percenatge)) / 100;
    $('#profit_amount').val(profit_amount.toFixed(2));

    var total_amount_including_profit = net_amount + profit_amount;
    $('#total_amount_including_profit').val(total_amount_including_profit.toFixed(2));


    var discount_percenatge = $('#discount_percenatge').val();
    var discount_amount = (total_amount_including_profit * parseFloat(discount_percenatge)) / 100;
    $('#discount_amount').val(discount_amount.toFixed(2));


    var amount_after_discount = total_amount_including_profit - discount_amount;
    $('#amount_after_discount').val(amount_after_discount.toFixed(2));

    var vat_percenatge = parseFloat(($('#vat_percenatge').val() == '') ? 0 : $('#vat_percenatge').val());
    var vat_amount = (amount_after_discount * parseFloat(vat_percenatge)) / 100;
    $('#vat_amount').val(vat_amount.toFixed(2));

    var grandtotalamount = amount_after_discount + vat_amount;
    $('#grandtotalamount').val(grandtotalamount.toFixed(2));
}

$("body").on("click", ".remove", function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');
    var siblings = row.siblings();
    row.remove();
    siblings.each(function (index) {
        $(this).children().first().text(index + 1);
    });
});

$('#saveBtn').click(function () {
    var error = 0
    if ($('#quotedate').val() == '') {
        $('#dateofsupply').addClass('is-invalid');
        error++;
    } else
        $('#dateofsupply').removeClass('is-invalid');

    if ($('#valid_till').val() == '') {
        $('#valid_till').addClass('is-invalid');
        error++;
    } else
        $('#valid_till').removeClass('is-invalid');


    if ($('#salesman').val() == '') {
        $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else
        $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
    var desc = [];
    $("textarea[name^='desc[]']").each(function (input) {
        desc.push($(this).val());
    });
    if (!error) {
        $('#saveBtn').addClass('kt-spinner');
        $('#saveBtn').prop("disabled", true);
        // + "&desc=" + desc
        $.ajax({
            type: "POST",
            url: "prepare-sales-proposal-update",
            dataType: "json",
            data: $('#dataForm').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#saveBtn').removeClass('kt-spinner');
                    $('#saveBtn').prop("disabled", false);
                    toastr.success('Details Saved Successfully');
                    window.location.href = "sales-proposal-list";
                } else
                    toastr.error('Error Data Not Saved');
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.warning('Fill required Fields');
});