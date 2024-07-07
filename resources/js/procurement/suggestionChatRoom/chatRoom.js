$('.suggestionChatRoom').addClass('kt-menu__item--active');
$(document).on('click', '.curActive', function (e) {
    $('.curActive').removeClass('currentActiveStyle');
    $(this).addClass('currentActiveStyle');
    $('#activeUserName').text($('.currentActiveStyle #userName').val());
    $('.currentActiveStyle .kt-font-bold').hide();

    $('#current_from').val($('.currentActiveStyle #userId').val());
    $('#current_type').val($('.currentActiveStyle #type').val());
    $('#current_doc_id').val($('.currentActiveStyle #doc_id').val());
    $('#btnView').show();

    // alert($('#to').val());
    $('.kt-chat__status').show();
    // $('.kt-chat__input').show();
    $('#editor').show();
    $('#btnPost').show();
    $('.kt-chat__messages').text('');
    $.ajax({
        type: "POST",
        url: "get-suggestion-chat-room-details",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            type: $('#current_type').val(),
            doc_id: $('#current_doc_id').val(),
            from: $('#current_from').val()
        },
        success: function (data) {
            if (data.status == '1') {
                // 
                $.each(data.chat, function (key, val) {
                    var path = $('#path').val();
                    // var comment = $("#editor").val();
                    var sideClass;
                    var userName;
                    var left;
                    var right;
                    var leftTime;
                    var rightTime;
                    if (val.responce_status == 1) {
                        sideClass = 'kt-chat__message--right';
                        userName = 'You';
                        path = $('#profilePic').val();
                        left = '';
                        right = '<span class="kt-media kt-media--circle kt-media--sm">\
                                    <img src="'+ path + '" alt="image">\
                                </span>';
                        leftTime = '<span class="kt-chat__datetime">' + val.created_at + '</span>';
                        rightTime = '';
                    } else {
                        sideClass = '';
                        userName = $('.currentActiveStyle #userName').val();
                        path = $('.currentActiveStyle img').attr('src');
                        left = '<span class="kt-media kt-media--circle kt-media--sm">\
                                    <img src="'+ path + '" alt="image">\
                                </span>';
                        right = '';
                        leftTime = '';
                        rightTime = '<span class="kt-chat__datetime">' + val.created_at + '</span>';
                    }
                    var appendMsg = '<div class="kt-chat__message ' + sideClass + '">\
                                         <div class="kt-chat__user">\
                                         '+ leftTime + '\
                                         '+ left + '\
                                             <a href="#" class="kt-chat__username">'+ userName + '</span></a>\
                                         '+ right + '\
                                         '+ rightTime + '\
                                         </div>\
                                         <div class="kt-chat__text kt-bg-light-brand">\
                                         '+ val.comment + '\
                                         </div >\
                                     </div > ';
                    $('.kt-chat__messages').append(appendMsg);
                });
                $('#test').focus();
                $('.kt-chat__text').each(function (index, value) {
                    // alert();
                    $(this).focus();
                });
                // 
            } else {
                alert('error');
            }
        },
        error: function (jqXhr, json, errorThrown) {
            alert('error');
            // console.log('Error !!');
        }
    });
});
$('.showUsers').click(function () {
    $('#exampleModal').modal('show');
});


$(function () {
    $("#editor").keypress(function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        //alert(code);
        if (code == 13) {
            $("#btnPost").trigger('click');
            return true;
        }
    });
});


$('#btnPost').click(function () {
    var path = $('#profilePic').val();
    var comment = $("#editor").val();
    var sideClass = 'kt-chat__message--right';
    var appendMsg = '<div class="kt-chat__message ' + sideClass + '">\
                         <div class="kt-chat__user">\
                             <a href="#" class="kt-chat__username">You</span></a>\
                             <span class="kt-media kt-media--circle kt-media--sm">\
                                 <img src="'+ path + '" alt="image">\
                             </span>\
                         </div>\
                         <div class="kt-chat__text kt-bg-light-brand">\
                         '+ comment + '\
                         </div >\
                     </div > ';
    $('.kt-chat__messages').append(appendMsg);
    $('#test').focus();

    $.ajax({
        type: "POST",
        url: "suggestion-chat-room-save",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            type: $('#current_type').val(),
            doc_id: $('#current_doc_id').val(),
            from: $('#current_from').val(),
            comment: comment
        },
        success: function (data) {
            if (data.status == '1') {
            } else {
                alert('error');
            }
        },
        error: function (jqXhr, json, errorThrown) {
            alert('error');
            // console.log('Error !!');
        }
    });
    $("#editor").val('');
});

$('#btnView').click(function () {
    var url = window.location.href + '/..';
    if ($('#current_type').val() == 'epr')
        url = url + '/epr_view?id=' + $('#current_doc_id').val();
    if ($('#current_type').val() == 'ST')
        url = url + '/stock-transfer-pdf?id=' + $('#current_doc_id').val();
    if ($('#current_type').val() == 'PO')
        url = url + '/epr-po-pdf?id=' + $('#current_doc_id').val();
    if ($('#current_type').val() == 'GRN')
        url = url + '/epr-po-grn-pdf?id=' + $('#current_doc_id').val();
    if ($('#current_type').val() == 'S-IN')
        url = url + '/epr-po-grn-stock-in-pdf?id=' + $('#current_doc_id').val();
    if ($('#current_type').val() == 'S-INV')
        url = url + '/epr-po-invoice-pdf?id=' + $('#current_doc_id').val();
    if ($('#current_type').val() == 'S-PAY')
        url = url + '/supplier-payment-pdf?id=' + $('#current_doc_id').val();

    window.open(url, '_blank');
});

