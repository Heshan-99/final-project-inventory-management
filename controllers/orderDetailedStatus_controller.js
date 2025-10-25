loadOrderNumber();

$('#orderNoField').change(function () {
    if ($(this).val() == "0") {
        $('#orderNo_msg').html("Select order number");
        $('#totalAmt').val("");
        $('#paidAmt').val("");
        $('#balanceAmt').val("");
    } else {
        $('#orderNo_msg').html("");
        fillFields();
    }
});

$('#getDetailsBtn').click(function () {
    fillFields();
});

$('#resetForm').click(function () {
    reset_form();
});

// =======================================================================================================================

function loadOrderNumber() {
    var dataArray = {action: 'loadOrderNumber'}
    $.post('./models/orderDetailedStatus_model.php', dataArray, function (reply) {
        $('#orderNoField').html(reply);
    });
}

function fillFields() {
    var orderNo = $('#orderNoField').val();
    var dataArray = {action: 'fillFields', orderNo: orderNo}
    $.post('./models/orderDetailedStatus_model.php', dataArray, function (reply) {
        $('#orderDetail_tbl tbody').html('').append(reply);
       getOrderSummary();
    });
}

function getOrderSummary() {
    var orderNo = $('#orderNoField').val();
    var dataArray = {action: 'getOrderSummary', orderNo: orderNo}
    $.post('./models/orderDetailedStatus_model.php', dataArray, function (reply) {
        $.each(reply, function (index, value) {
            $('#orderStatus').val(value.orderStatus);
            $('#orderedDate').val(value.orderDate);
            $('#reqDate').val(value.order_req_date);
            $('#totalAmt').val(value.order_total);
            $('#paidAmt').val(value.order_paid_amt);
            $('#balanceAmt').val(value.order_balance_amt);
        });
    },'json');
}


function reset_form() {
    $('#orderNoField').val("0");
    $('#totalAmt').val("");
    $('#paidAmt').val("");
    $('#balanceAmt').val("");
    $('#recAmt').val("");
    $('#balance').val("");

    $('#orderNo_msg').html("");
}