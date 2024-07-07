$(document).on('click', '.curActive', function (e) {
    $('.curActive').removeClass('currentActiveStyle');
    $(this).addClass('currentActiveStyle');
    $('#activeUserName').text($('.currentActiveStyle .kt-widget__username').html());
    $('.currentActiveStyle .kt-font-bold').hide();
    $('#to').val($('.currentActiveStyle .userId').val());
    // alert($('#to').val());
    $('.kt-chat__status').show();
    // $('.kt-chat__input').show();
    $('#editor').show();
    $('#btnPost').show();
    $('.kt-chat__messages').text('');
    $.ajax({
        type: "POST",
        url: "get-suggestion-details",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            type: $('#type').val(),
            doc_id: $('#docId').val(),
            to: $('#to').val()
        },
        success: function (data) {
            if (data.status == '1') {
                // alert('ok');

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
                    if (val.responce_status == 0) {
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
                        userName = $('.currentActiveStyle .kt-widget__username').html();
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
                                             '+ rightTime + '\
                                             '+ right + '\
                                         </div>\
                                         <div class="kt-chat__text kt-bg-light-brand">\
                                         '+ val.comment + '\
                                         </div >\
                                     </div > ';
                    $('.kt-chat__messages').append(appendMsg);
                });
                $('#test').focus();
                // 
                $(".kt-chat__messages").animate({ scrollTop: $('.kt-chat__messages').prop("scrollHeight") }, 1000);
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
    var comment = $("#editor").val();
    var sideClass = 'kt-chat__message--right';
    path = $('#profilePic').val();
    var appendMsg = '<div class="kt-chat__message ' + sideClass + '">\
                         <div class="kt-chat__user">\
                             <span class="kt-chat__datetime">now</span>\
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
        url: "suggestion-save",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            type: $('#type').val(),
            doc_id: $('#docId').val(),
            from: $('#from').val(),
            to: $('#to').val(),
            comment: comment
        },
        success: function (data) {
            if (data.status == '1') {
                // $(".kt-chat__messages").animate({ scrollTop: $('.kt-chat__messages').prop("scrollHeight") }, 1000);
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

$('#btnAddToChat').click(function () {
    $.ajax({
        type: "POST",
        url: "get-user-details",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: $('#users').val(),
        },
        success: function (data) {
            if (data.status == '1') {
                var selectedVal = $('#users').val();
                var name = data.data.name;
                var value = data.data.id;
                var img = '';
                if ((data.data.image == '') || (data.data.image == null))
                    img = 'Profilepicture/default.jpg';
                else img = data.data.image;
                var path = $('#path').val() + '/' + img;
                var deptAndDesc = (data.data.designation != null) ? data.data.designation : '';
                var content = ' <div class="kt-widget__item curActive">\
                              <span class="kt-media kt-media--circle">\
                               <img src="'+ path + '" alt="image">\
                                </span>\
                               <div class="kt-widget__info">\
                                  <div class="kt-widget__section">\
                                      <a class="kt-widget__username">'+ name + '</a>\
                                      <span class="kt-badge kt-badge--success kt-badge--dot"></span>\
                                      <input type="hidden" class="userId" id="userId" name="userId" value="'+ value + '">\
                                  </div>\
                                  <span class="kt-widget__desc">\
                                      '+ deptAndDesc + '\
                                  </span>\
                              </div>\
                              <div class="kt-widget__action">\
                              </div>\
                          </div>';
                $('.kt-widget__items').append(content);
                $('#exampleModal').modal('hide');
                $('#users').val('');
                $(".kt-chat__messages").animate({ scrollTop: $('.kt-chat__messages').prop("scrollHeight") }, 1000);
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