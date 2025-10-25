selectOrderDate();
getCusCount();
getOrderCount();
getSalesAndStockValue();

$('#search').keyup(function () {
    selectOrderDate();
});

$('#orderStatusPicker').change(function () {
    selectOrderDate();
});

// =======================================================================================================================

function selectOrderDate() {
    var search = $('#search').val();
    // 0 = pending
    // 1 = processing
    // 2 = completed
    // 3 = payment completed
    // 4 = delivered
    // 5 = cancelled
    var status = $('#orderStatusPicker').val();
    var dataArray = {action: 'selectOrderDate', status: status, search:search}
    $.post('./models/dashboard_model.php', dataArray, function (reply) {
        $('#addedOrder_tbl tbody').html('').append(reply);
    });
}

// function selectOrderDate() {
//     // 0 = pending
//     // 1 = processing
//     // 2 = completed
//     // 3 = payment completed
//     // 4 = delivered
//     var status = $('#orderStatusPicker').val();
//     var dataArray = {action: 'selectOrderDate', status: status}
//     $.post('./models/dashboard_model.php', dataArray, function (reply) {
//         $('#addedOrder_tbl tbody').html('').append(reply);
//     });
// }

// ========================================For dashboard main cards======================================================

function getCusCount() {
    var dataArray = {action: 'getCusCount'}
    $.post('./models/dashboard_model.php', dataArray, function (reply) {
        $('#cusCount').html('').append(reply);
    });
}

function getOrderCount() {
    var dataArray = {action: 'getOrderCount'}
    $.post('./models/dashboard_model.php', dataArray, function (reply) {
        $('#orderCount').html('').append(reply);
    });
}

function getSalesAndStockValue(){
    var dataArray = {action: 'getSalesAndStockValue'}
    $.post('./models/dashboard_model.php', dataArray, function (reply) {
        var x = reply.split('~');
        $('#todaySales').html('').append('<h1>Rs.' + x[0] + '</h1>');
        $('#stockValue').html('<h1>Rs.' + x[1] + '</h1>');
    });
}