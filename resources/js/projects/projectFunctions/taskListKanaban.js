$('.projects').addClass('kt-menu__item--open');
$('.projects-awarded-list').addClass('kt-menu__item--active');

$(document).ready(function (e) {
    // $(document).on('click', '#btnView', function (e) {

    //     if ($('#project_id').val() != '') {
    // $('#project_id').next().find('.select2-selection').removeClass('select-dropdown-error');
    // removeallDataInBoard();
    // $('#btnView').addClass('kt-spinner');
    // $('#btnView').attr("disabled", true);
    // e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../task-list-kanaban",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            project_id: $('#project_id').val()
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
                // $('#btnView').removeClass('kt-spinner');
                // $('#btnView').attr("disabled", false);
            }
            // $('#btnView').removeClass('kt-spinner');
            // $('#btnView').attr("disabled", false);



        },
        error: function (jqXhr, json, errorThrown) {
            console.log('Error !!');
        }
    });
    //     } else {
    //         $('#project_id_filter').next().find('.select2-selection').addClass('select-dropdown-error');
    //     }
    // });

    function removeallDataInBoard() {
        $('.kanban-item').each(function (i, obj) {
            var id = $(this).attr('data-eid');
            KanbanTest.removeElement(id);
        });
    }



});