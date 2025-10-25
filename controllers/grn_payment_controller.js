loadGrnNumber();

$('#grnNoField').change(function () {
    if ($(this).val() == "0") {
        $('#grnNo_msg').html("Select GRN number");
        $('#totalGrnAmt').val("");
        $('#paidAmt').val("");
        $('#balance').val("");
    } else {
        $('#grnNo_msg').html("");
        fillFields();
    }
});

$('#updateBalance').click(function () {
    validateGRNForm();
});

$('#resetForm').click(function () {
    reset_form();
});

$('#payment').keyup(function () {
    var balanceAmt = $('#balance').val();
    var payment = $('#payment').val();
    if(parseFloat(payment) > parseFloat(balanceAmt)){
        alertify.alert("Warning", "Payment is higher than balance.", function(){
                alertify.error('Enter valid value');
            });
        $('#payment').val("");
    }

    this.value = this.value.replace(/[^0-9.]/g, '');
    if ($(this).length <= 0) {
        $('#payment_msg').text("Payment is required");
    } else {
        $('#payment_msg').text("");
    }
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

function loadGrnNumber() {
    var dataArray = {action: 'loadGrnNumber'}
    $.post('./models/grn_payment_model.php', dataArray, function (reply) {
        $('#grnNoField').html(reply);
    });
}

function fillFields() {
    var grnNo = $('#grnNoField').val();
    var dataArray = {action: 'fillFields', grnNo: grnNo}
    $.post('./models/grn_payment_model.php', dataArray, function (reply) {
        $.each(reply, function (index, value) {
            $('#totalGrnAmt').val(value.grn_tot_amt);
            $('#paidAmt').val(value.grn_paid_amt);
            $('#balance').val(value.grn_bal_amt);
            $('#payment').focus();
            $('#payment').select();
        });
    }, 'json');
}

function validateGRNForm(){
    var allOk = true;
    var grnNo = $('#grnNoField').val();
    var payment = $('#payment').val();

    if (grnNo == '0') {
        allOk = false;
        $('#grnNo_msg').text("Select GRN number");
    } else {
        $('#grnNo_msg').text("");
    }

    if (payment.length <= 0) {
        allOk = false;
        $('#payment_msg').text("Payment is required");
    } else {
        $('#payment_msg').text("");
    }

    if (allOk) {
        alertify.confirm("GRN payment update", "Are you sure, You want update the GRN payment ?",
                    function () {
                        updateBalance();
                    },
                    function () {
                        alertify.error('GRN payment Cancelled');
                    });

    }
}

function updateBalance() {
    var grnNo = $('#grnNoField').val();
    var payment = $('#payment').val();
    var dataArray = {action: 'updateBalance', grnNo: grnNo, payment: payment}
    $.post('./models/grn_payment_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('GRN Payment update Successes');
            reset_form();
            loadGrnNumber();
        } else {
            alertify.error('GRN Payment update Failed');
        }
    });
}

function reset_form() {
    $('#grnNoField').val("0");
    $('#totalGrnAmt').val("");
    $('#paidAmt').val("");
    $('#balance').val("");
    $('#payment').val("");

    $('#grnNo_msg').html("");
    $('#payment_msg').html("");
}