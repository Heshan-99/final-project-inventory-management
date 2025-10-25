$('#categoryField').change(function () {
    if ($(this).val() == 2) {
        $('.dateRange').removeClass('d-none');
        $('.year_month_section').addClass('d-none');
    } else if ($(this).val() == 3) {
        $('.year_month_section').removeClass('d-none');
        $('.dateRange').addClass('d-none');
    } else {
        $('.dateRange').addClass('d-none');
        $('.year_month_section').addClass('d-none');
    }
});

$('#startDate').change(function () {
    if ($(this).val() == "") {
        $('#startDate_msg').html("Select start Date");
    } else {
        $('#startDate_msg').html("");
    }
});

$('#endDate').change(function () {
    if ($(this).val() == "") {
        $('#endDate_msg').html("Select end Date");
    } else {
        $('#endDate_msg').html("");
    }
});

// ===================================================================================================================

function generateExpensesChart() {
    var startDate = $('#startDate');
    var endDate = $('#endDate');
    var dataArray = {action: 'generateExpensesChart', startDate: startDate, endDate: endDate}
    $.post('./models/', dataArray, function (reply) {

    });
}
