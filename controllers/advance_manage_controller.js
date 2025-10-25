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

$('#updateBalance').click(function () {
    var allok = 1;
    var recAmt = $('#recAmt').val();
    if ($('#orderNoField').val() == "0") {
        $('#orderNo_msg').html("Select order number");
        allok = 0;
    }
    if (recAmt.length == 0) {
        $('#recAmt_msg').html("Received amount required.")
        allok = 0;
    }
    if (allok == 1) {
        $('#recAmt_msg').html("")
        alertify.confirm("Update advance", "Are you sure, You want update the order's advance ?",
                function () {
                    updateBalance();
                },
                function () {
                    alertify.error('Delete Cancelled');
                });
    }
});

$('#resetForm').click(function () {
    reset_form();
});

$('#payment').keyup(function () {
    this.value = this.value.replace(/[^0-9.]/g, '');
});

$('#recAmt').keyup(function () {
    this.value = this.value.replace(/[^0-9.]/g, '');
    var recAmt = $('#recAmt').val();
    var balanceAmt = $('#balanceAmt').val();
    if (recAmt.length != 0) {
        var balance = recAmt - balanceAmt;
        $('#balance').val(balance);
    } else {
        $('#balance').val('');
    }

    if (parseFloat(recAmt) < parseFloat(balanceAmt)) {
        $('#recAmt_msg').html("Received amount should be greater than or equal to payable amount.")
    } else {
        $('#recAmt_msg').html("")
    }
});

// =======================================================================================================================

function loadOrderNumber() {
    var dataArray = {action: 'loadOrderNumber'}
    $.post('./models/advance_manage_model.php', dataArray, function (reply) {
        $('#orderNoField').html(reply);
    });
}

function fillFields() {
    var orderNo = $('#orderNoField').val();
    var dataArray = {action: 'fillFields', orderNo: orderNo}
    $.post('./models/advance_manage_model.php', dataArray, function (reply) {
        $.each(reply, function (index, value) {
            $('#totalAmt').val(value.order_total);
            $('#paidAmt').val(value.order_paid_amt);
            $('#balanceAmt').val(value.order_balance_amt);
            $('#recAmt').focus();
            $('#recAmt').select();
        });
    }, 'json');
}

function updateBalance() {
    var orderTblId = $('#orderNoField').val();
    var recAmt = $('#recAmt').val();
    var balance = $('#balance').val();
    var dataArray = {action: 'updateBalance', orderTblId: orderTblId, recAmt: recAmt, balance: balance}
    $.post('./models/advance_manage_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Payment update Successes');
            reset_form();
            loadOrderNumber();
            setTimeout(function () {
                window.location = "./?completedAdvance&orderDetails=" + orderTblId +"~"+ recAmt +"~"+ balance;
            }, 1000);
        } else {
            alertify.error('Payment update Failed');
        }
    });
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