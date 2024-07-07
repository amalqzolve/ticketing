$('.car-in-and-out').addClass('kt-menu__item--active');

$(document).on('click', '#btnSaveCarInOut', function (e) {
    e.preventDefault();
    var error = 0;
    if ($('#isue_date').val() == '') {
        error++;
        $('#isue_date').addClass('is-invalid');
    } else
        $('#isue_date').removeClass('is-invalid');


    if ($('#cust_name').val() == '') {
        error++;
        $('#cust_name').addClass('is-invalid');
    } else
        $('#cust_name').removeClass('is-invalid');

    if ($('#renter_iqama').val() == '') {
        error++;
        $('#renter_iqama').addClass('is-invalid');
    } else
        $('#renter_iqama').removeClass('is-invalid');

    if ($('#iqama_exp_date').val() == '') {
        error++;
        $('#iqama_exp_date').addClass('is-invalid');
    } else
        $('#iqama_exp_date').removeClass('is-invalid');

    if ($('#renter_licence_number').val() == '') {
        error++;
        $('#renter_licence_number').addClass('is-invalid');
    } else
        $('#renter_licence_number').removeClass('is-invalid');

    if ($('#renter_licence_exp_date').val() == '') {
        error++;
        $('#renter_licence_exp_date').addClass('is-invalid');
    } else
        $('#renter_licence_exp_date').removeClass('is-invalid');

    if ($('#trip_start_date').val() == '') {
        error++;
        $('#trip_start_date').addClass('is-invalid');
    } else
        $('#trip_start_date').removeClass('is-invalid');

    if ($('#trip_start_odometer').val() == '') {
        error++;
        $('#trip_start_odometer').addClass('is-invalid');
    } else
        $('#trip_start_odometer').removeClass('is-invalid');

    if ($('#newcustomer').val() == '') {
        error++;
        $('#newcustomer').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Select Customer Source !!');
    }
    else
        $('#newcustomer').next().find('.select2-selection').removeClass('select-dropdown-error');


    if ($('#car_id').val() == '') {
        error++;
        $('#car_id').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Select Car !!');
    }
    else
        $('#car_id').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#rental_type').val() == '') {
        error++;
        $('#rental_type').next().find('.select2-selection').addClass('select-dropdown-error');
        toastr.warning('Select Rental Type !!');
    }
    else
        $('#rental_type').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#newcustomer').val() == 2) {
        if ($('#customer').val() == '') {
            error++;
            $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning('Select Rental Type !!');
        }
        else
            $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
    } else
        $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');


    var from = $("#iqama_issue_date").val();
    var to = $("#iqama_exp_date").val();

    if (!chekFromToDate(from, to)) {
        error++;
        $('#iqama_issue_date').addClass('is-invalid');
        $("#iqama_exp_date").addClass('is-invalid');
    } else {
        $('#iqama_issue_date').removeClass('is-invalid');
        $('#iqama_exp_date').removeClass('is-invalid');
    }


    var from = $("#renter_licence_issue_date").val();
    var to = $("#renter_licence_exp_date").val();

    if (!chekFromToDate(from, to)) {
        error++;
        $('#renter_licence_issue_date').addClass('is-invalid');
        $("#renter_licence_exp_date").addClass('is-invalid');
    } else {
        $('#renter_licence_issue_date').removeClass('is-invalid');
        $('#renter_licence_exp_date').removeClass('is-invalid');
    }

    var from = $("#additional_driver_licence_issue_date").val();
    var to = $("#additional_driver_licence_exp_date").val();

    if (!chekFromToDate(from, to)) {
        error++;
        $('#additional_driver_licence_issue_date').addClass('is-invalid');
        $("#additional_driver_licence_exp_date").addClass('is-invalid');
    } else {
        $('#additional_driver_licence_issue_date').removeClass('is-invalid');
        $('#additional_driver_licence_exp_date').removeClass('is-invalid');
    }


    var from = $("#isue_date").val();
    var to = $("#exp_date").val();

    if (!chekFromToDate(from, to)) {
        error++;
        $('#isue_date').addClass('is-invalid');
        $("#exp_date").addClass('is-invalid');
    } else {
        $('#isue_date').removeClass('is-invalid');
        $('#exp_date').removeClass('is-invalid');
    }


    var from = $("#trip_start_date").val();
    var to = $("#trip_end_date").val();

    if (!chekFromToDate(from, to)) {
        error++;
        $('#trip_start_date').addClass('is-invalid');
        $("#trip_end_date").addClass('is-invalid');
    } else {
        $('#trip_start_date').removeClass('is-invalid');
        $('#trip_end_date').removeClass('is-invalid');
    }

    if ($('#trip_start_odometer').val() > $('#trip_end_odometer').val()) {
        error++;
        $('#trip_end_odometer').addClass('is-invalid');
    } else
        $('#trip_end_odometer').removeClass('is-invalid');

    if (error == 0) {
        $('#btnSaveCarInOut').addClass('kt-spinner');
        $('#btnSaveCarInOut').prop("disabled", true);
        loaderShow();
        $.ajax({
            type: "POST",
            url: "car-in-and-out-submit",
            dataType: "json",
            data: $('#car-in-and-out-form').serialize() + "&_token=" + $('#token').val(),
            success: function (data) {
                $('#btnSaveCarInOut').removeClass('kt-spinner');
                $('#btnSaveCarInOut').prop("disabled", false);
                toastr.success('New Car Rental Details Created successfuly');
                loaderClose();
                $('#btnSaveCarInOut').removeClass('kt-spinner');
                $('#btnSaveCarInOut').prop("disabled", false);
                window.location.href = "car-in-and-out";

            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else
        toastr.error('Fill mandatory Fileds !!!');
});


$(document.body).on("change", "#car_id", function () {
    loadRate();
});
$(document.body).on("change", "#rental_type", function () {
    loadRate();
});

function loadRate() {
    if (($('#car_id').val() != '') && ($('#rental_type').val() != '')) {
        $.ajax({
            url: "get-car-reant",
            method: "POST",
            data: {
                _token: $('#token').val(),
                car_id: $('#car_id').val(),
                rental_type: $('#rental_type').val(),
            },
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    $('#rate').val(data.data.charge);
                    $('#limit').val(data.data.limit);
                    $('#aditional_amount').val(data.data.additonal);
                }
            }
        })
    } else {
        $('#rate').val('0');
        $('#limit').val('0');
        $('#aditional_amount').val('0');
    }
}


$(document).ready(function () {
    $(document).on('change', '.newcustomer', function () {
        var customer = $(this).val();
        if (customer == 1) {
            var default_grp = $('#default_grp').val();
            var typedefault = $('#typedefault').val();
            var catdefault = $('#catdefault').val();
            $('#customer').val('').trigger('change');
            $('#customer').attr('disabled', true);
            $('#cust_category').val(catdefault).trigger('change').attr('disabled', false);
            $('#cust_type').val(typedefault).trigger('change').attr('disabled', false);
            $('#cust_group').val(default_grp).trigger('change').attr('disabled', false);
            $('#cust_name').val('').attr('readonly', false);
            $('#cust_code').val('').attr('readonly', true);
            $('#building_no').val('').attr('readonly', false);
            $('#cust_region').val('').attr('readonly', false);
            $('#cust_district').val('').attr('readonly', false);
            $('#cust_city').val('').attr('readonly', false);
            $('#cust_zip').val('').attr('readonly', false);
            $('#mobile').val('').attr('readonly', false);
            $('#vatno').val('').attr('readonly', false);
            $('#buyerid_crno').val('').attr('readonly', false);
            $('#cust_country').trigger('change').attr('disabled', false);
        }
        if (customer == 2) {
            $('#customer').attr('disabled', false);
            $('#cust_category').attr('disabled', true);
            $('#cust_type').attr('disabled', true);
            $('#cust_group').attr('disabled', true);
            $('#cust_country').attr('disabled', true);
            $('#cust_code').attr('readonly', true);
            $('#building_no').attr('readonly', true);
            $('#cust_region').attr('readonly', true);
            $('#cust_district').attr('readonly', true);
            $('#cust_city').attr('readonly', true);
            $('#cust_zip').attr('readonly', true);
            $('#mobile').attr('readonly', true);
            $('#vatno').attr('readonly', true);
            $('#buyerid_crno').attr('readonly', true);
            $('#cust_name').attr('readonly', true);
        }



    });
});

$(window).on('load', function () {
    var cat_id = $('#cust_category').val();
    $.ajax({
        type: 'POST',
        url: '../getcategorycode',
        data: {
            _token: $('#token').val(),
            'id': cat_id
        },
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                $("#cust_code").val(value.cust_code + '/' + value.increment);
            });
        },
        error: function () {
        }
    });

});

$(document).on('change', '.Cust_category', function () {
    var cat_id = $(this).val();
    $.ajax({
        type: 'POST',
        url: '../getcategorycode',
        data: {
            _token: $('#token').val(),
            'id': cat_id
        },
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                $("#cust_code").val(value.cust_code + '/' + value.increment);
            });
        },
        error: function () {
        }
    });
});


$(document.body).on("change", "#customer", function () {

    var cid = $(this).val();

    $.ajax({
        url: "../getcustomeraddressquote_sell",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id: cid
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var inv_address = '';
            var ship_address = '';
            var cust_phone = '';
            $.each(data, function (key, value) {
                inv_address = value.invoice_add1 + ' ' + value.invoice_add2 + ' ' + value.invoice_city + ' ' + value.invoice_country;
                ship_address = value.shipping1 + ' ' + value.shipping2 + ' ' + value.shipping_city + ' ' + value.invoice_country;
                cust_phone = value.mobile1;
                $('#cust_name').val(value.cust_name).attr('readonly', true);
                $('#building_no').val(value.cust_add1).attr('readonly', true);
                $('#cust_region').val(value.cust_add2).attr('readonly', true);
                $('#cust_district').val(value.cust_region).attr('readonly', true);
                $('#cust_city').val(value.cust_city).attr('readonly', true);
                $('#cust_zip').val(value.cust_zip).attr('readonly', true);
                $('#email').val(value.email1).attr('readonly', true);
                $('#mobile').val(value.mobile1).attr('readonly', true);
                $('#vatno').val(value.vatno).attr('readonly', true);
                $('#buyerid_crno').val(value.buyerid_crno).attr('readonly', true);
                $('#cust_category').val(value.cust_category).trigger('change');
                $('#cust_type').val(value.cust_type).trigger('change');
                $('#cust_group').val(value.cust_group).trigger('change');
                $('#cust_country').val(value.cust_country).trigger('change').attr('disabled', true);
            });

            $('#billing_address').val(inv_address);
            $('#shipping_address').val(ship_address);
            $('#contact_phone').val(cust_phone);
        }
    })
});