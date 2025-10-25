getGrnNo();
loadAvailableItems();
loadSuppliers();

$('#addItem').click(function () {
    form_validation();
});

$('#search').keyup(function () {
    loadAvailableItems();
});

$('#resetItemQty').click(function () {
    reset_form();
});

$('#resetGrn').click(function () {
    resetGrnForm();
});

$('#unitfield').keyup(function () {
    this.value = this.value.replace(/[a-zA-Z]/g, '');
    var unit_price = parseFloat($(this).val());
    var added_qty = parseFloat($('#newQty').val());
    var total_amt = unit_price * added_qty;
    $('#totalPricefield').val(total_amt);
});

$('#newQty').keyup(function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});

$('#sup').change(function () {
    var sup = $('#sup').val();
    if (sup == '0') {
        $('#sup_msg').removeClass('d-none');
    } else {
        $('#sup_msg').addClass('d-none');
    }
});

$('#finishGrn').click(function () {
    grn_form_validation();
});

$('#totalPricefield').keyup(function () {
    this.value = this.value.replace(/[a-zA-Z]/g, '');
    var totPrice = $(this).val();
    var qty = $('#newQty').val();
    var unitPrice = parseFloat(totPrice) / parseFloat(qty);
    $('#unitfield').val(unitPrice);
});

//==============================================================================

function getGrnNo() {
    loadAvailableItems();
    var dataArray = {action: 'getGrnNo'};
    $.post('./models/grn_model.php', dataArray, function (reply) {
        $('#GRNNofield').val(reply);
        grnAddedItem();
    });
}

function loadAvailableItems() {
    var search = $('#search').val();
    var dataArray = {action: 'loadAvailableItems', search: search};
    $.post('./models/grn_model.php', dataArray, function (reply) {
        $('#grn_item_table tbody').html('').append(reply);

        $('.select').click(function () {
            var data = $(this).val();
            data = data.split('~');
            localStorage.setItem('itmID', data[0]);
            $('#selItemfield').val(data[1]);
            $('#availableQtyfield').val(data[2]);
            $('#newQty').focus();
        });
    });
}

function reset_form() {
    $('#selItemfield').val('');
    $('#availableQtyfield').val('');
    $('#newQty').val('');
    $('#totalPricefield').val('');
    $('#unitfield').val('');

    $('#newQty_msg').html('');
    $('#totalPrice_msg').html('');
    grnAddedItem();
}

function form_validation() {
    var allOk = true;
    var newQty = $('#newQty').val();
    var totprice = $('#totalPricefield').val();

    if (newQty == 1) {
        allOk = true;
    }

    if (unit == 1) {
        allOk = true;
    }

    if (newQty.length < 1) {
        allOk = false;
        newQty_msg.innerHTML = "New Qty is required";
    } else {
        // $('#newQty_msg').removeClass('d-none');
    }

    if (totprice.length < 1) {
        allOk = false;
        totalPrice_msg.innerHTML = "Total price is required";
    } else {
        // $('#name_msg').addClass('d-none');
    }

    if (allOk) {
        addItemToSummary();
    }
}

function grn_form_validation() {
    var allOk = true;
    var sup = $('#sup').val();
    var date = $('#GRNDatefield').val();
    var grnTot = $('#grnTotalAmnt').val();

    if (sup == 0) {
        allOk = false;
        $('#sup_msg').text("Select a supplier");
    } else {
        $('#sup_msg').text("");
    }

    if (date.length <= 0) {
        allOk = false;
        $('#GRNDate_msg').text("Date is required");
    } else {
        $('#GRNDate_msg').text("");
    }

    if (grnTot == '0') {
        allOk = false;
        alertify
            .alert("No item added", "No item added to the summary. Please add some item for complete the GRN.", function () {
                alertify.error('GRN failed');
            });
    }

    if (allOk) {
        alertify.confirm("Confirm GRN", "Are you sure, You want complete this GRN ?",
            function () {
                // loadAvailableItems();
                addFinalGrn();
            },
            function () {
                alertify.error('Cancel');
            });
    }
}

function addItemToSummary() {
    var grnNo = $('#GRNNofield').val();
    var selItemfield = $('#selItemfield').val();
    var newQty = $('#newQty').val();
    var unitfield = $('#unitfield').val();
    var itemId = localStorage.getItem('itmID');
    var dataArray = {
        action: 'addItemToSummary',
        newQty: newQty,
        unitfield: unitfield,
        selItemfield: selItemfield,
        itemId: itemId,
        grnNo: grnNo
    };
    $.post('./models/grn_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Insert Successes');
            reset_form();
        } else {
            alertify.error('Insert failed');
        }
    });
}

function grnAddedItem() {
    var grnNo = $('#GRNNofield').val();
    var dataArray = {action: 'grnAddedItem', grnNo: grnNo};
    $.post('./models/grn_model.php', dataArray, function (reply) {
        reply = reply.split('~');
        $('#grn_added_item_table tbody').html('').append(reply[0]);
        var totAmt = reply[1];
        $('#grnTotalAmnt').val(totAmt);

        $('.remove').click(function () {
            var index = $(this).val();
            removeItem(index);
        });
    });
}

function removeItem(index) {
    var dataArray = {action: 'removeItem', index: index}
    $.post('./models/grn_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.confirm("Warning", "Do you want to delete this item?",
                function () {
                    grnAddedItem()
                },
                function () {
                    alertify.error('Cancelled');
                });
        } else {
            alertify.error('Delete Failed');
        }
    });
}

function addFinalGrn() {
    var grnNo = $('#GRNNofield').val();
    var grnTotal = parseFloat($('#grnTotalAmnt').val());
    var grnDate = $('#GRNDatefield').val();
    var supplierId = $('#sup').val();
    var dataArray = {action: 'addFinalGrn', grnNo: grnNo, grnTotal: grnTotal, grnDate: grnDate, supplierId: supplierId};

    $.post('./models/grn_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Successfully Completed GRN');
            getGrnNo();
        } else {
            alertify.error('System Error');
        }
    });
}

function loadSuppliers() {
    var dataArray = {action: 'loadSuppliers'};
    $.post('./models/grn_model.php', dataArray, function (reply) {
        $('#sup').html(reply);
    });
}

function resetGrnForm() {
    // alertify.confirm("Confirm GRN", "Are you sure, You want complete this GRN ?",
    //     function () {
    //         addFinalGrn();
    //         loadAvailableItems();
    //     },
    //     function () {
    //         alertify.error('Cancel');
    //     });
    alertify.confirm("Reset GRN", "All added data will be not saved. Do you want reset this GRN?",
        function () {
            var grnNo = $('#GRNNofield').val();
            reset_form();
            $('#sup').val();
            $('#GRNDatefield').val();
            var dataArray = {action: 'resetGrnForm', grnNo: grnNo};
            $.post('./models/grn_model.php', dataArray, function (reply) {
                if (reply == 1) {
                    alertify.success('GRN reset successfully');
                    getGrnNo();
                    grnAddedItem();

                    $('#sup_msg').text("");
                    $('#GRNDate_msg').text("");
                    $('#sup').val('0');

                } else {
                    alertify.error('GRN reset failed');
                }
            });
        },
        function () {
            alertify.error('Cancelled');
        });
}