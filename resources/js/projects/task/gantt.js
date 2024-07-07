$('.tasks').addClass('kt-menu__item--open');
$('.task-list').addClass('kt-menu__item--active');

$(document).on('click', '#btnViewTask', function (e) {

    if ($('#project_id_filter').val() != '') {
        $('#project_id_filter').next().find('.select2-selection').removeClass('select-dropdown-error');
        removeallDataInBoard();
        $('#btnViewTask').addClass('kt-spinner');
        $('#btnViewTask').attr("disabled", true);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "task-list-kanaban",
            dataType: "json",
            data: {
                _token: $('#token').val(),
                project_id: $('#project_id_filter').val()
            },
            success: function (data) {
                if (data.status == 1) {
                    $.each(data.data, function (key, val) {
                        KanbanTest.addElement("_" + val.state_id, {
                            id: val.id,
                            title: val.title,
                            drag: function (el, source) {
                                console.log("START DRAG: " + el.dataset.eid);

                            },
                        },);
                    });


                } else {
                    alert(data.msg);
                    $('#btnViewTask').removeClass('kt-spinner');
                    $('#btnViewTask').attr("disabled", false);
                }
                $('#btnViewTask').removeClass('kt-spinner');
                $('#btnViewTask').attr("disabled", false);
            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    } else {
        $('#project_id_filter').next().find('.select2-selection').addClass('select-dropdown-error');
    }
});

function removeallDataInBoard() {
    $('.kanban-item').each(function (i, obj) {
        var id = $(this).attr('data-eid');
        KanbanTest.removeElement(id);
    });
}