getOrderNo();
loadCakeTypes();
loadCustomers();

$('#cakeType').chosen({width: "300px"});
$('#cakeType').change(function () {
    getCakeDetails();
});

$('#addOrder').click(function () {
    addCakeToSummaryValidation()();
});

$('#resetOrder').click(function () {
    reset_form();
});

$('#resetCakeTypeForm').click(function () {
    resetSelectCakeForm();
});

$('#completeOrder').click(function () {
    orderValidation();
});

$('#weightfield').keyup(function () {
    this.value = this.value.replace(/[a-zA-Z]/g, '');
    var weight = $(this).val();
    var price = localStorage.getItem('price');
    var newPrice = parseFloat(weight) * parseFloat(price);
    $('#pricefield').val(newPrice);
});

$('#advancedAmountfield').keyup(function () {
    this.value = this.value.replace(/[^0-9]/g, '');
    var advance = $(this).val();
    var advanceValue = parseFloat(this.value);
    var orderValue = parseFloat($('#orderAmountfield').val());
    if (advanceValue > orderValue) {
        alertify.alert("Wrong amount", "Advance is higher than order", function () {
            alertify.error('Enter correct amount');
            $('#balanceAmountfield').val('');
        });
        this.value = '';
    }

    if (advance.length != 0) {
        var total = localStorage.getItem('totAmont');
        var balance = parseFloat(total) - parseFloat(advance);
        $('#balanceAmountfield').val(balance.toFixed(2));
    } else {
        $('#balanceAmountfield').val('0.00');
    }
});
$('#quantityfield').keyup(function () {
    this.value = this.value.replace(/[^0-9]/g, '');
    const qty = quantityfield.value;
    if (qty == 0) {
        errorquantityfield.innerHTML = "Quantity required";
        return false;
    } else {
        errorquantityfield.innerHTML = "";
        return true;
    }
});
$('#reqDatefield').change(function () {
    var start = new Date(),
        end = new Date($('#reqDatefield').val()),
        diff = new Date(end - start),
        days = diff / 1000 / 60 / 60 / 24;
    if (Math.round(days) > 30) {
        $('#errorreqDatefield').html("Selected date should be between 30 days");
    } else if (Math.round(days) <= 0) {

        $('#errorreqDatefield').html("Select valid date");
    } else {
        $('#errorreqDatefield').html("");
    }
});

$('#selectCustomer').change(function () {
    var customer = $('#selectCustomer').val();
    if (customer == 0) {
        $('#errorCustomer').html("Select the customer");
    }else{
        $('#errorCustomer').html("");
    }
});

//==============================================================================
function orderValidation() {
    var allOk = true;
    var date = $('#reqDatefield').val();
    var customer = $('#selectCustomer').val();
    var advance = $('#advancedAmountfield').val();

    if (date.length <= 0) {
        allOk = false;
        $('#errorreqDatefield').text("Date is required");
    } else {
        $('#errorreqDatefield').text("");
    }

    if (customer == 0) {
        allOk = false;
        $('#errorCustomer').text("Customer is required");
    } else {
        $('#errorCustomer').text("");
    }

    if (advance.length <= 0) {
        allOk = false;
        $('#erroradvancedAmountfield').text("Advance is required");
    } else {
        $('#erroradvancedAmountfield').text("");
    }

    if (allOk) {
        alertify.confirm("Confirm order", "Do you want to place the order?",
            function () {
                completeOrder();
            },
            function () {
                alertify.error('Order cancelled');
            });
    }
}

function chosenRefresh_cacke() {
    $('#cakeType').trigger("chosen:updated");
}

function loadCakeTypes() {
    var dataArray = {action: 'loadCakeTypes'}
    $.post('./models/new_order_model.php', dataArray, function (reply) {
        $('#cakeType').html('').append(reply);
        chosenRefresh_cacke();
    });
}

function getCakeDetails() {
    var cakeType = $('#cakeType').val();
    cakeType = cakeType.split('~');
    $('#weightfield').val(cakeType[2]);
    $('#pricefield').val(cakeType[1]);
    localStorage.setItem('cakeId', cakeType[0]);
    localStorage.setItem('price', cakeType[1]);
    localStorage.setItem('weight', cakeType[2]);
}

function getOrderNo() {
    var dataArray = {action: 'getOrderNo'}
    $.post('./models/new_order_model.php', dataArray, function (reply) {
        $('#orderNOfield').val(reply);
        loadAddedCakesDetailsForOrder();
    });
}

function addCakeToSummaryValidation() {
    var allOk = true;
    var cakeType = $('#cakeType').val();
    var weight = $('#weightfield').val();
    var quantity = $('#quantityfield').val();
    // if (cakeType.length <= 0) {
    //     allOk = false;
    //     $('#errorSelectfield').text("Weight is required");
    // } else {
    //     $('#errorSelectfield').text("");
    // }

    if (weight.length <= 0) {
        allOk = false;
        $('#errorweightfield').text("Weight is required");
    } else {
        $('#errorweightfield').text("");
    }

    if (quantity.length <= 0) {
        allOk = false;
        $('#errorquantityfield').text("Quantity is required");
    } else {
        $('#errorquantityfield').text("");
    }

    if (allOk) {
        addCakeToOrderSummary()
    }
}

function addCakeToOrderSummary() {
    var orderNo = $('#orderNOfield').val();
    var cakeId = $('#cakeType').val();
    cakeId = cakeId.split('~');
    localStorage.setItem('cakeId', cakeId[0]);
    var x = cakeId[0];
    var weight = $('#weightfield').val();
    var price = $('#pricefield').val();
    var quantity = $('#quantityfield').val();
    var splNote = $('#splNote').val();
    var dataArray = {
        action: 'addCakeToOrderSummary',
        orderNo: orderNo,
        x: x,
        weight: weight,
        price: price,
        quantity: quantity,
        splNote: splNote
    };
    $.post('./models/new_order_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success("Insert Successes");
            loadAddedCakesDetailsForOrder();
            resetSelectCakeForm();
        } else {
            alertify.error("Insert Failed");
        }
    });
}


function completeOrder() {
    var orderNo = $('#orderNOfield').val();
    var custId = $('#selectCustomer').val();
    var reqDate = $('#reqDatefield').val();
    var orderAmount = $('#orderAmountfield').val();
    var advancedAmount = $('#advancedAmountfield').val();
    var balanceAmount = $('#balanceAmountfield').val();
    var totPre = (parseFloat(orderAmount) * 40) / 100;
    if (parseFloat(advancedAmount) < parseFloat(totPre)) {
        alertify.alert('Wrong Advance amount', 'Minimum advance amount :' + totPre.toFixed(2) + '.', function () {
            $('#advancedAmountfield').focus();
            $('#advancedAmountfield').select();
        });
    } else {
        var dataArray = {
            action: 'completeOrder',
            orderNo: orderNo,
            custId: custId,
            orderAmount: orderAmount,
            reqDate: reqDate,
            advancedAmount: advancedAmount,
            balanceAmount: balanceAmount
        };
        $.post('./models/new_order_model.php', dataArray, function (reply) {
            if (reply == 1) {
                alertify.success("Order completed");
                reset_form();
                setTimeout(function () {
                    window.location = "./?advance&orderID=" + orderNo;
                }, 1000);
            } else {
                alertify.error("System error");
            }
        });
    }
}

function reset_form() {
    $('#reqDatefield').val('');
    $('#selectCustomer').val('');
    $('#orderAmountfield').val('');
    $('#advancedAmountfield').val('');
    $('#balanceAmountfield').val('');
    $('#errorreqDatefield').html('');
    $('#errorCustomer').html('');
    $('#erroradvancedAmountfield').html('');
    getOrderNo();
    resetSelectCakeForm();
}

function resetSelectCakeForm() {
    $('#cakeType').val('0');
    $('#weightfield').val('');
    $('#pricefield').val('');
    $('#quantityfield').val('1');
    $('#splNote').val('');
    $('#errorquantityfield').html('');
    $('#errorweightfield').html('');
    $('#errorSelectfield').html('');
}

function loadAddedCakesDetailsForOrder() {
    var orderNo = $('#orderNOfield').val();
    var dataArray = {action: 'loadAddedCakesDetailsForOrder', orderNo: orderNo}
    $.post('./models/new_order_model.php', dataArray, function (reply) {
        var x = reply.split('~');
        $('#orderSummary tbody').html('').append(x[0]);
        localStorage.setItem('totAmont', x[1]);
        $('#orderAmountfield').val(x[1]);
        $('.delete').click(function () {
            var itmID = $(this).val();
            alertify.confirm("Confirm remove", "Do you want to remove this item?",
                function () {
                    removeAddedCake(itmID);
                },
                function () {
                    alertify.error('Cancelled');
                });
        });
    });
}

function removeAddedCake(cakeId) {
    var dataArray = {action: 'removeAddedCake', cakeId: cakeId}
    $.post('./models/new_order_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success("Item removed successfully");
            loadAddedCakesDetailsForOrder();
        } else {
            alertify.error("Item remove failed");
        }
    });
}

function loadCustomers() {
    var dataArray = {action: 'loadCustomers'};
    $.post('./models/new_order_model.php', dataArray, function (reply) {
        $('#selectCustomer').html(reply);
        chosenRefresh();
    });
}

