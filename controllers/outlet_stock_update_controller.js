loadItemType();
loadBatchNO();

$('#itemType').change(function () {
    getItemDetails($(this).val());
});

$('#newQtyfield').keyup(function () {
    this.value = this.value.replace(/[a-zA-Z]/g, '');
});

$('#SaveItem').click(function () {
    form_validation();
});

$('#resetItem').click(function () {
    reset_form();
});

$('#completeBatch').click(function () {
    alertify.confirm("Confirm finish", "Are you sure, You want complete this batch ?",
        function () {
            completeBatch();
        },
        function () {
            alertify.error('Cancel');
        });
});

$('#reorderLevelfield').keyup(function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});

$('#expireDatefield').change(function () {
    var start = new Date(),
        end = new Date($('#expireDatefield').val()),
        diff = new Date(end - start),
        days = diff / 1000 / 60 / 60 / 24;
    if (Math.round(days) <= 0) {
        $('#expireDate_msg').html("Select valid date");
    } else {
        $('#expireDate_msg').html("");
    }
});

//==============================================================================

function loadItemType() {
    var dataArray = {action: 'loadCakeTypes'}
    $.post('./models/newConfig_model.php', dataArray, function (reply) {
        $('#itemType').html('').append(reply);
    });
}

function loadBatchNO() {
    var dataArray = {action: 'loadBatchNO'}
    $.post('./models/outlet_stock_update_model.php', dataArray, function (reply) {
        $('#batchNofield').val(reply);
        $('#batchNo_2').html(reply);
        loadAddedItems();
    });
}

function getItemDetails(itemId) {
    var dataArray = {action: 'getItemDetails', itemId: itemId}
    $.post('./models/outlet_stock_update_model.php', dataArray, function (reply) {
        var x = reply.split('~');
        $('#sellingPricefield').val(x[0]);
        $('#availableQtyfield').val(x[1]);
    });
}

function form_validation() {
    var allOk = true;
    var newQty = $('#newQtyfield').val();
    var itemValue = $('#itemType').val();
    var reorderLevel = $('#reorderLevelfield').val();

    if (newQty.length <= 0) {
        allOk = false;
        $('#newQty_msg').text("Quantity is required");
    } else {
        $('#newQty_msg').text("");
    }

    if (reorderLevel.length <= 0) {
        allOk = false;
        $('#reorderLevel_msg').text("Reorder level is required");
    } else {
        $('#reorderLevel_msg').text("");
    }

    if (itemValue == 0) {
        allOk = false;
        $('#itemType_msg').text("Select item");
    } else {
        $('#itemType_msg').text("");
    }

    var start = new Date(),
        end = new Date($('#expireDatefield').val()),
        diff = new Date(end - start),
        days = diff / 1000 / 60 / 60 / 24;
    if (Math.round(days) <= 0) {
        allOk = false;
        $('#expireDate_msg').html("Select valid date");
    } else {
        $('#expireDate_msg').html("");
    }

    if (allOk) {
        saveStock();
    }
}

function saveStock() {
    var batchNo = $('#batchNofield').val();
    var itemId = $('#itemType').val();
    var sellPrice = $('#sellingPricefield').val();
    var qty = $('#newQtyfield').val();
    var expDate = $('#expireDatefield').val();
    var reorderLevel = $('#reorderLevelfield').val();
    var dataArray = {
        action: 'saveStock',
        batchNo: batchNo,
        itemId: itemId,
        sellPrice: sellPrice,
        qty: qty,
        expDate: expDate,
        reorderLevel: reorderLevel
    }
    $.post('./models/outlet_stock_update_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success("Insert Successes");
            loadAddedItems();
            reset_form();
            setTimeout(function () {
                alertify.success("Stock updated");
            }, 1500);
        } else {
            alertify.error("Insert Failed");
        }
    });
}

function completeBatch() {
    var batchNo = $('#batchNofield').val();
    var dataArray = {action: 'completeBatch', batchNo: batchNo}
    $.post('./models/outlet_stock_update_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success("Batch completed");
            loadBatchNO();
        } else {
            alertify.error("Failed");
        }
    });
}

function loadAddedItems() {
    var batchNo = $('#batchNofield').val();
    var dataArray = {action: 'loadAddedItems', batchNo: batchNo}
    $.post('./models/outlet_stock_update_model.php', dataArray, function (reply) {
        $('#addedItem_tbl tbody').html('').append(reply);

        $('.select').click(function () {
            get_cake_data_for_update($(this).val());
        });
        $('.delete').click(function () {
            var id = $(this).val();
            alertify.confirm("Confirm Delete", "Are you sure, You want to delete this Record ?",
                function () {
                    delete_cake_record(id);
                },
                function () {
                    alertify.error('Delete Cancel');
                });
        });
    });
}

function reset_form() {
    $('#itemType').val('0');
    $('#newQtyfield').val('');
    $('#expireDatefield').val('');
    $('#reorderLevelfield').val('');
    $('#sellingPricefield').val('');
    $('#availableQtyfield').val('');

    $('#itemType_msg').html('');
    $('#newQty_msg').html('');
    $('#expireDate_msg').html('');
    $('#reorderLevel_msg').html('');


    $('#updateCake').addClass('d-none');
    $('#SaveCake').removeClass('d-none');
    $('#seeMore').addClass('d-none');
}