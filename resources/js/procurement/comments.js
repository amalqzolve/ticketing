$(document).on('click', '.commentspoup', function () {
    var currentCommentDocType = $(this).attr('data-id');
    var currentCommentDocId = $(this).attr('id');
    var currentCommentDocDescription = '# ' + currentCommentDocType + ' ' + currentCommentDocId;
    if ((currentCommentDocType != '') && (currentCommentDocId != '')) {
        $('#currentCommentDocType').val(currentCommentDocType);
        $('#currentCommentDocId').val(currentCommentDocId);
        $('#currentCommentDocDescription').html(currentCommentDocDescription);
        $('.kt-chat__messages').text('');//clear old chat
        $.ajax({
            type: "POST",
            url: $('#cur_url').val() + "/get-comments",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                type: currentCommentDocType,
                doc_id: currentCommentDocId,
            },
            success: function (data) {
                if (data.status == '1') {
                    var appendMsg = '';
                    $.each(data.chat, function (key, val) {
                        if (data.currentUser == val.from) {
                            var currentuserProfilepath = $('#currentCommentProfilePic').val();
                            var appendMsg = '<div class="col-12" style="display: inline-block;">\
                                                <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">\
                                                    <div class="kt-chat__user">\
                                                        <span class="kt-chat__datetime">'+ val.created_at + '</span>\
                                                        <a href="#" class="kt-chat__username">You</span></a>\
                                                        <span class="kt-media kt-media--circle kt-media--sm">\
                                                            <img src="'+ currentuserProfilepath + '" alt="image">\
                                                        </span>\
                                                    </div>\
                                                    <div class="kt-chat__text">\
                                                    '+ val.comment + '\
                                                    </div>\
                                                </div>\
                                            </div>';
                        } else {
                            var appendMsg = '<div class="col-12" style="display: inline-block;">\
                                                <div class="kt-chat__message kt-chat__message--success">\
                                                    <div class="kt-chat__user">\
                                                        <span class="kt-media kt-media--circle kt-media--sm">\
                                                            <img src="'+ data.imgPath + '/' + val.image + '" alt="image">\
                                                        </span>\
                                                        <a href="#" class="kt-chat__username">'+ val.name + '</a>\
                                                        <span class="kt-chat__datetime">'+ val.created_at + '</span>\
                                                    </div>\
                                                    <div class="kt-chat__text">\
                                                    '+ val.comment + '\
                                                    </div>\
                                                </div>\
                                            </div>';

                        }

                        $('#currentCommentBoxBody').append(appendMsg);
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


        $('#kt_chat_modal').modal('show');

    } else
        toastr.error('error on loding chatbox');

});


$(document).on('keyup', '#editor', function (e) {
    if (e.keyCode == 13) {
        $("#postComment").trigger("click");
    }
});


$(document).on('click', '#postComment', function () {
    var comment = $("#editor").val();
    var sideClass = 'kt-chat__message--right';
    path = $('#profilePic').val();
    var currentuserProfilepath = $('#currentCommentProfilePic').val();

    var appendMsg = '<div class="col-12" style="display: inline-block;">\
                        <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">\
                                    <div class="kt-chat__user">\
                                        <span class="kt-chat__datetime">Now</span>\
                                        <a href="#" class="kt-chat__username">You</span></a>\
                                        <span class="kt-media kt-media--circle kt-media--sm">\
                                            <img src="'+ currentuserProfilepath + '" alt="image">\
                                        </span>\
                                    </div>\
                                    <div class="kt-chat__text">\
                                       '+ comment + '\
                                    </div>\
                                </div>\
                                </div>';

    $('#currentCommentBoxBody').append(appendMsg);

    $('#test').focus();
    $.ajax({
        type: "POST",
        url: $('#cur_url').val() + "/comment-save",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            type: $('#currentCommentDocType').val(),
            doc_id: $('#currentCommentDocId').val(),
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

