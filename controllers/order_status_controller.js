loadAddedOrderTable();

$('#search').keyup(function () {
    loadAddedOrderTable();
});

$('#orderStatusPicker').change(function () {
    loadAddedOrderTable();
});

// =======================================================================================================================

function loadAddedOrderTable() {
    var search = $('#search').val();
    var status = $('#orderStatusPicker').val();
    var dataArray = {action: 'loadAddedOrderTable', search: search, status: status}
    $.post('./models/order_status_model.php', dataArray, function (reply) {
        $('#addedOrder_tbl tbody').html('').append(reply);

        $('.pro').click(function () {
            changeStatus(1, $(this).val());
        });
        $('.com').click(function () {
            changeStatus(2, $(this).val());
        });
        $('.pay').click(function () {
            changeStatus(3, $(this).val());
        });
        $('.del').click(function () {
            changeStatus(4, $(this).val());
        });
        $('.rollback').click(function () {
            rollbackStatus($(this).val());
        });
        $('.cancel').click(function () {
            cancelOrder($(this).val());
        });

    });
}

function rollbackStatus(id) {
    alertify.confirm("Rollback order status", "Are you sure, You want to rollback the order status ?",
            function () {
                var dataArray = {action: 'rollbackStatus', id: id}
                $.post('./models/order_status_model.php', dataArray, function (reply) {
                    if (reply == 1) {
                        alertify.success("Status successfully rolled back");
                        loadAddedOrderTable();
                        // if (status == 1) {
                        //     updateStock(id);
                        // }
                    } else {
                        alertify.error("Status rollback fail");
                    }
                });
            },
            function () {
                alertify.error('Status update cancelled');
            });
}

function changeStatus(status, id) {
    alertify.confirm("Update order status", "Are you sure, You want to change this order status ?",
            function () {
                var dataArray = {action: 'changeStatus', status: status, id: id}
                $.post('./models/order_status_model.php', dataArray, function (reply) {
                    if (status == 2) {
                        var x = reply.split('~');
                        if (x[0] == 1) {
                            alertify.success("Status successfully updated");
                            loadAddedOrderTable();
                            var sms = "HappyCakies, Dear customer (" + x[2] + "), your order(" + x[3] + ") is ready to collect. For more details - 071 569 0189";
                            sendSMS(x[1], sms);
                        } else {
                            alertify.error("Status update fail");
                        }
                    } else {
                        if (reply == 1) {
                            alertify.success("Status successfully updated");
                            loadAddedOrderTable();
                            if (status == 1) {
                                updateStock(id);
                            }
                        } else {
                            alertify.error("Status update fail");
                        }
                    }
                });
            },
            function () {
                alertify.error('Status update cancelled');
            });
}

function updateStock(orderTblID) {
    var dataArray = {action: 'updateStock', orderTblID: orderTblID}
    $.post('./models/order_status_model.php', dataArray, function (reply) {
    });
}

function cancelOrder(id) {
    alertify.confirm("Cancel the order", "Are you sure, You want to cancel this order? This step cannot undone!",
            function () {
                var dataArray = {action: 'cancelOrder', id: id}
                $.post('./models/order_status_model.php', dataArray, function (reply) {
                    if (reply == 1) {
                        alertify.success("Order cancelled successfully");
                        loadAddedOrderTable();
                        if (status == 1) {
                            updateStock(id);
                        }
                    } else {
                        alertify.error("Order cancel failed");
                    }
                });
            },
            function () {
                alertify.error('Order cancel aborted');
            });
}