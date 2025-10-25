loadAddedItems();
getBillNo();

$('#search').keyup(function (e) {
    if (e.which == 13) {
        $('#itm_1').focus();
    } else {
        loadAddedItems();
    }
});

$('#itemQty').keyup(function () {
    this.value = this.value.replace(/[^0-9]/g, '');
    var qty = $(this).val();
    if (qty.length != 0) {
        var available_qty = localStorage.getItem('ava_qty');
        var unit_price = localStorage.getItem('selling_price');

        if (parseFloat(qty) > parseFloat(available_qty)) {
            alertify.error("Available quantity is less than entered quantity");
            $('#itemQty').val("");
        } else {
            var itemTotalPrice = parseFloat(qty) * parseFloat(unit_price);
            $('#itemTot').html(itemTotalPrice);
        }
    } else {
        $('#itemTot').html('0.00');
    }
});

$('#addItemToLog').click(function () {
    if ($('#selectedItm').val() == '') {
        $('#selectItemMsg').removeClass('d-none');
    } else {
        $('#selectItemMsg').addClass('d-none');
        addItemToLog();
    }
});

$('#grandTotal').keyup(function (e) {
    if($('#grandTotal').val() !== '')
    $('#totalMsg').addClass('d-none');
})

$('#paidAmt').keyup(function (e) {
    var grntot = $('#grandTotal').val();
    var paidamt = $('#paidAmt').val();
    var balanceamt = (paidamt-grntot);
    $('#balanceamt').val(balanceamt);
})

$('#finishBill').click(function () {
    if ($('#grandTotal').val() == '') {
        $('#totalMsg').removeClass('d-none');
    } else {
        finishBill();
    }
});

$('#resetBill').click(function () {
    resetBill();
});

// =====================================================================================================================

function loadAddedItems() {
    var search = $('#search').val();
    var dataArray = {action: 'loadAddedItems', search: search}
    $.post('./models/outlet_management_model.php', dataArray, function (reply) {
        $('#itemTable tbody').html('').append(reply);

        $('.select').click(function () {
            var data = $(this).val();
            data = data.split('~');
            localStorage.setItem('itmID', data[0]);
            localStorage.setItem('item_name', data[1]);
            localStorage.setItem('selling_price', data[2]);
            localStorage.setItem('ava_qty', data[3]);
            $('#selectedItm').val(data[1]);
            $('#itemQty').focus();
        });
    });
}

function addItemToLog() {
    var billNo = $('#billNo').val();
    var item_id = localStorage.getItem('itmID');
    var itemQuantity = $('#itemQty').val();
    var itemTotal = $('#itemTot').html();
    var dataArray = {
        action: 'addItemToLog',
        billNo: billNo,
        item_id: item_id,
        itemQuantity: itemQuantity,
        itemTotal: itemTotal
    }
    $.post('./models/outlet_management_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Item added successfully');
            loadAddedItems();
            getBillTotal();
            loadItemToBill();
            $('#selectedItm').val('');
            $('#itemQty').val('');
            $('#itemTot').html('0.00');
        } else {
            alertify.error('Add item failed');
        }
    });
}

function loadItemToBill() {
    var billNo = $('#billNo').val();
    var dataArray = {action: 'loadItemToBill', billNo: billNo}
    $.post('./models/outlet_management_model.php', dataArray, function (reply) {
        $('#addedBillItemDetails tbody').html('').append(reply);
        $('.remove').click(function () {
            removeAddedItem($(this).val());
        });

    });
}

function getBillNo() {
    var dataArray = {action: 'getBillNo'}
    $.post('./models/outlet_management_model.php', dataArray, function (reply) {
        $('#billNo').val(reply);
        getBillTotal();
        loadItemToBill();
    });
}

function getBillTotal() {
    var billNo = $('#billNo').val();
    var dataArray = {action: 'getBillTotal', billNo: billNo}
    $.post('./models/outlet_management_model.php', dataArray, function (reply) {
        $('#grandTotal').val(reply);
    });
}

function removeAddedItem(removeId) {
    // var addedQty =
    var dataArray = {action: 'removeAddedItem', removeId: removeId}
    $.post('./models/outlet_management_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.confirm("Remove item", "Do you want to remove this item ?",
                function () {
                    alertify.success('Item removed successfully');
                    loadItemToBill();
                    getBillTotal();
                    loadAddedItems();
                },
                function () {
                    alertify.error('Item remove failed');
                });
        } else {
            alertify.error('Item remove failed');
        }
    });
}

function finishBill() {
    var paidamt = $('#paidAmt').val();
    var balanceamt = $('#balanceamt').val();
    var billNo = $('#billNo').val();
    var grandTotal = $('#grandTotal').val();
    var dataArray = {action: 'finishBill', billNo: billNo, grandTotal: grandTotal, paidamt:paidamt, balanceamt:balanceamt}
    $.post('./models/outlet_management_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.confirm("Reset bill", "Are you sure, You want complete this bill ?",
                function () {
                    alertify.success('Bill completed successfully');
                    getBillNo();
                    setTimeout(function () {
                        window.location = "./?outletReceipt&billNo=" + billNo;
                    }, 1500);
                },
                function () {
                    alertify.error('Bill complete failed');
                });

            //     alertify.success('Bill completed successfully');
            //     getBillNo();
            //     setTimeout(function () {
            //         window.location = "./?outletReceipt&billNo=" + billNo;
            //     }, 1500);
            // } else {
            //     alertify.error('Bill complete failed');
            // }
        }
    });
}

function resetBill(){
    var billNo = $('#billNo').val();
    var dataArray = {action: 'resetBill', billNo:billNo}
    $.post('./models/outlet_management_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.confirm("Reset bill", "Are you sure, You want reset this bill ?",
                function () {
                    loadItemToBill();
                    getBillTotal();
                    $('#totalMsg').addClass('d-none');
                    alertify.success('Bill reset successfully');
                },
                function () {
                    alertify.error('Cancelled');
                });
        }
    });
}