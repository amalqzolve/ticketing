$('.projects').addClass('kt-menu__item--open');
$('.projects-awarded-list').addClass('kt-menu__item--active');

google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);


function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Effort', 'Amount given'],
        ['Work', 75],
        ['Not Work', 25],
    ]);

    var options = {
        pieHole: 0.8,
        backgroundColor: {
            fill: 'transparent'
        },
        pieSliceTextStyle: {
            color: 'black',
        },
        legend: 'none',
        colors: ['#1324bb', '#1361bb']
    };

    var chart = new google.visualization.PieChart(document.getElementById('donut_single'));
    chart.draw(data, options);
}
google.charts.setOnLoadCallback(drawChart2);

function drawChart2() {
    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Work', 11],
        ['Eat', 2],
        ['asd', 2],
        ['asd', 2],
        ['asd', 2],
    ]);

    var options = {
        // title: '',//headding
        pieHole: 0.4,
        legend: {
            position: 'bottom',
            alignment: 'start'
        }
    };

    var chart2 = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart2.draw(data, options);
}

$(document).on('click', '#btnSaveMember', function (e) {
    e.preventDefault();
    tax_name = $('#name').val();
    var error = 0;

    if ($('#new_member').val() == "") {
        $('#new_member').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else {
        $('#new_member').next().find('.select2-selection').removeClass('select-dropdown-error');
    }
    var exist = 0
    $("input[name^='memberId[]']").each(function (input) {
        if ($('#new_member').val() == $(this).val()) {
            exist++;
        }
    });
    if (exist != 0) {
        toastr.error('Member Already Exist In the Project ');
        $('#new_member').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
    } else {
        $('#new_member').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if (!error) {
        $('#btnSaveMember').addClass('kt-spinner');
        $('#btnSaveMember').prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "../project-member-add",
            dataType: "json",
            data: $('#data-from').serialize() + "&_token=" + $('#token').val() + "&project_id=" + $('#project_id').val(),
            success: function (data) {
                if (data.status == 1) {
                    $('#btnSaveMember').removeClass('kt-spinner');
                    $('#btnSaveMember').prop("disabled", false);
                    toastr.success('Member Added successfuly');
                    location.reload();
                }
                else {
                    $('#btnSaveMember').removeClass('kt-spinner');
                    $('#btnSaveMember').prop("disabled", false);
                    toastr.error(data.msg);
                }

            },
            error: function (jqXhr, json, errorThrown) {
                console.log('Error !!');
            }
        });
    }
});


$(document).on('click', '.removeMember', function () {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "Do you want Remove this Member From this Project",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Remove",
        cancelButtonText: "Cancel"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: "../project-member-delete",
                dataType: "json",
                data: {
                    _token: $('#token').val(),
                    id: id,
                },
                success: function (data) {
                    if (data.status == 1) {
                        toastr.warning('Member Removed successfuly');
                        location.reload();
                    }

                },
                error: function (jqXhr, json, errorThrown) {
                    console.log('Error !!');
                }
            });

        } else {
            swal.fire("Cancelled", "", "error");
        }
    })
});