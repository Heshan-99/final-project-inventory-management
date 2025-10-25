loadAddedItems();
loadCakeTypes();


$('#addItem').click(function () {
    addSelectedItems();
});

$('#removeItem').click(function () {
    loadAddedItems();
});

$('#cakeType').change(function () {
    loadAddedCakes();
});

$('#resetConfig').click(function () {
    loadCakeTypes();
    loadAddedCakes();
});

$('#finishConfig').click(function () {
    finishCakeConfiguration();
});

// =====================================================================================================================

function loadAddedItems() {
    var dataArray = {action: 'loadAddedItems'}
    $.post('./models/newConfig_model.php', dataArray, function (reply) {
        $('#addedItem_tbl tbody').html('').append(reply);

        $('.itemAmount').keyup(function () {
            var addedQty = $(this).val();
            var index = $(this).data('index');
            var checkBox = "#ch_" + index;
            if (addedQty.length != 0) {
                $(checkBox).val(addedQty);
            } else {
                $(checkBox).val('0');
            }
        });

        $('.itemChecked').click(function () {
            var index = $(this).data('index');
            var inputID = "#input_" + index;
            if ($(this).prop('checked') == true) {
                $(inputID).attr('disabled', false);
                $(inputID).focus();
            } else {
                $(inputID).attr('disabled', true);
                $(inputID).val('');
            }
        });

        $('.other').keyup(function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        
        $('.ing').keyup(function () {
            this.value = this.value.replace(/[a-zA-Z]/g, '');
        });
    });
}

function addSelectedItems() {
    var cakeId = $('#cakeType').val();
    if (cakeId != 0) {
        $('#errorSelectfield').html('');
        var items = [];
        var issueQty = [];
        var error = 0;
        $('input.itemChecked:checkbox:checked').each(function () {
            items.push($(this).data('itmid'));
            var addedQty = $(this).val();
            if (addedQty != 0) {
                issueQty.push(addedQty);
            } else {
                error++
            }
        });

        if (error == 0) {
            var dataArray = {action: 'addSelectedItems', items: items, issueQty: issueQty, cakeId: cakeId}
            $.post('./models/newConfig_model.php', dataArray, function (reply) {
                if (reply == 1) {
                    alertify.success("Item inserted successfully");
                    loadAddedCakes();
                    loadAddedItems();
                } else if (reply == 99) {
                    alertify.alert("Some item exists", "Some items you trying to enter are already entered. Other items added successfully.", function () {
                        alertify.error('Few items added');
                    });
                    loadAddedItems();
                    loadAddedCakes();
                } else {
                    alertify.error("Please select one or more items");
                }
            });
        } else {
            $('#errorMsgMain').html("Some ingredients quantities are invalid");
        }
    } else {
        $('#errorSelectfield').html('Please select a cake type');
    }
}

function loadCakeTypes() {
    var dataArray = {action: 'loadCakeTypes'}
    $.post('./models/newConfig_model.php', dataArray, function (reply) {
        $('#cakeType').html('').append(reply);
        loadAddedCakes();
    });
}

function loadAddedCakes() {
    var cakeId = $('#cakeType').val();
    if (cakeId != 0) {
        $('#errorSelectfield').html('');
        var dataArray = {action: 'loadAddedCakes', cakeId: cakeId};
        $.post('./models/newConfig_model.php', dataArray, function (reply) {
            reply = reply.split('~');
            $('#addedCakeDetail_tbl tbody').html('').append(reply[0]);
            $('#grandTotal').val(reply[1])
            $('#sellingPrice').val(reply[2])

            $('.item_remove').click(function () {
                var index = $(this).val();
                removeItem(index);
            });

        });
    } else {
        $('#addedCakeDetail_tbl tbody').html('');
        $('#grandTotal').val('')
    }
}

function removeItem(index) {
    var dataArray = {action: 'removeItem', index: index}
    $.post('./models/newConfig_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Delete Successes');
            // reset_item_table();
            loadAddedCakes();
            loadAddedItems();
        } else {
            alertify.error('Delete Failed');
        }
    });
}

// function reset_item_table() {
//     // loadCakeTypes();
//     loadAddedItems();
//
// }

function finishCakeConfiguration() {
    var cakeId = $('#cakeType').val();
    var sellingPrice = $('#sellingPrice').val();
    var totalCost = $('#grandTotal').val();
    if (parseFloat(sellingPrice) > parseFloat(totalCost)) {
        var dataArray = {action: 'finishCakeConfiguration', cakeId: cakeId, sellingPrice: sellingPrice};
        $.post('./models/newConfig_model.php', dataArray, function (reply) {
            if (reply == 1) {
                alertify.success("Price added successfully");
                resetAll();
            } else {
                alertify.error("System error");
            }
        });
    } else {
        alertify.alert("Selling price is less than cost.", function () {
            alertify.error('Configuration not inserted');
        });
    }

}

function resetAll() {
    loadAddedItems();
    loadCakeTypes();
    $('#sellingPrice').val('');
}
