loadPaidExpenses();
loadAddedExpensesTypes();
loadAddedExpensesTypes2();

$('#SaveExpense').click(function () {
    form_validation();
});

$('#resetExpense').click(function () {
    reset_form();
});

$('#search').keyup(function () {
    loadPaidExpenses();
});

$('#expenseField2').change(function () {
    loadPaidExpenses();
});

$('#amountfield').keyup(function () {
    this.value = this.value.replace(/[^0-9.]/g, '');
    if(this.value == ''){
        $('#amount_msg').text("Amount is required");
    }else{
        $('#amount_msg').text("");
    }
});

$('#datefield').keyup(function () {
    if(this.value == ''){
        $('#date_msg').text("Amount is required");
    }else{
        $('#date_msg').text("");
    }
});

$('#date').keyup(function (e) {
    if (e.which == 13) {
        loadPaidExpenses();
    }
});
// ======================================================================================================================

function form_validation() {
    var allOk = true;
    var expense = $('#expenseField').val();
    var amount = $('#amountfield').val();
    var date = $('#datefield').val();

    if (expense == '0') {
        allOk = false;
        $('#expenseField_msg').text("Type is required");
    } else {
        $('#expenseField_msg').text("");
    }

    if (amount.length <= 0) {
        allOk = false;
        $('#amount_msg').text("Amount is required");
    } else {
        $('#amount_msg').text("");
    }

    if (date <= '0') {
        allOk = false;
        $('#date_msg').text("Date is required");
    } else {
        $('#date_msg').text("");
    }

    if (allOk) {
        addPaidExpense();
    }
}

function reset_form() {
    $('#expenseField').val('0');
    $('#amountfield').val('');
    $('#datefield').val('');
    $('#notefield').val('');

    $('#itemTypeSection').addClass('d-none');

    $('#expenseField_msg').html('');
    $('#amount_msg').html('');
    $('#date_msg').html('');

    $('#updateCake').addClass('d-none');
    $('#SaveCake').removeClass('d-none');
    $('#seeMore').addClass('d-none');
}

function addPaidExpense(){
    var expenseType = $('#expenseField').val();
    var amount = $('#amountfield').val();
    var date = $('#datefield').val();
    var note = $('#notefield').val();

    var dataArray = {action: 'addPaidExpense', expenseType: expenseType, amount: amount, date: date, note: note};
    $.post('./models/expenses_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success("Insert Successes");
            loadPaidExpenses();
            reset_form();
        } else {
            alertify.error("Insert Failed");
        }
    });
}

function loadPaidExpenses(){
    var paidExpenseType2 = $('#expenseField2').val();
    var date = $('#date').val();
    var dataArray = {action: 'loadPaidExpenses', paidExpenseType2: paidExpenseType2, date:date}
    $.post('./models/expenses_model.php', dataArray, function (reply) {
        $('#addedExpenses_tbl tbody').html('').append(reply);

        $('.delete').click(function () {
            var id = $(this).val();
            alertify.confirm("Confirm Delete", "Are you sure, You want to delete this Record ?",
                function () {
                    delete_expense_record(id);
                },
                function () {
                    alertify.error('Delete Cancel');
                });
        });
    });
}

function loadAddedExpensesTypes(){
    var dataArray = {action: 'loadAddedExpensesTypes'}
    $.post('./models/expenses_model.php', dataArray, function (reply) {
        $('#expenseField').html(reply);
    });
}

function loadAddedExpensesTypes2(){
    var dataArray = {action: 'loadAddedExpensesTypes2'}
    $.post('./models/expenses_model.php', dataArray, function (reply) {
        $('#expenseField2').html(reply);
    });
}

function delete_expense_record(expenseid){
    var dataArray = {action: 'delete_expense_record', expenseid: expenseid}
    $.post('./models/expenses_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Delete Successes');
            loadPaidExpenses();
        } else {
            alertify.error('Delete Failed');
        }
    });
}