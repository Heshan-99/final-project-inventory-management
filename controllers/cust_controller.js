loadAddesCustTable();
getNextCusCode();

$('#SaveCust').click(function () {
    form_validation();
});

$('#resetCust').click(function () {
    reset_form();
});

$('#updateCus').click(function () {
    update_form_validation();
});

$('#namefield').keyup(function () {
    const name = namefield.value.trim();
    const title = titlefield.value;
    const crit1 = name != "";
    const crit2 = name.length >= 3;
    const crit3 = title != "";

    if (!crit1) {
        name_msg.innerHTML = "Name is required";
        return false;
    }

    if (!crit2) {
        name_msg.innerHTML = "Name should has at least 3 characters";
        return false;
    }

    if (!crit3) {
        name_msg.innerHTML = "Select a title";
        return false;
    }
    name_msg.innerHTML = "";
    return true;
});

$('#addressfield').keyup(function () {
    const address = addressfield.value.trim();
    const crit1 = address != "";
    const crit2 = address.length >= 4;
    if (!crit1) {
        address_msg.innerHTML = "Address is required";
        return false;
    }

    if (!crit2) {
        address_msg.innerHTML = "Address should has 4 characters";
        return false;
    }

    address_msg.innerHTML = "";
    return true;
});

$('#mobilefield').keyup(function () {
    const mobilePattern = /^[0][1-9][0-9]{8}$/;
    const mobile = mobilefield.value.trim();
    const crit1 = mobile != "";
    const crit2 = mobile.length == 10;
    const crit3 = mobilePattern.test(mobile);
    if (!crit1) {
        mobile_msg.innerHTML = "Mobile is required";
        return false;
    }

    if (!crit2) {
        mobile_msg.innerHTML = "Mobile number should has 10 characters";
        return false;
    }

    if (!crit3) {
        mobile_msg.innerHTML = "Invalid mobile number";
        return false;
    }
    mobile_msg.innerHTML = "";
    return true;
});

$('#emailfield').keyup(function () {
    const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const email = emailfield.value.trim();
    const crit1 = email.length <= 255;
    const crit2 = emailPattern.test(email);

    if (!crit1) {
        email_msg.innerHTML = "Email address length should be at most 255";
        return false;
    }

    if (!crit2) {
        email_msg.innerHTML = "Invalid email address";
        return false;
    }
    email_msg.innerHTML = "";
    return true;
});

$('#search').keyup(function () {
    loadAddesCustTable();
});


//==============================================================================

function checkEmail() {
    var email = $('#emailfield').val();
    var dataArray = {action: 'checkEmail', email: email}
    $.post('./models/cust_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.alert("Email exist","This email is already exists. Try another email or select customer from previously added list for the order.", function(){
                    alertify.error('Enter failed');
                });
            $('#emailfield').focus();
        } else {
            saveCustomer();
        }
    });
}

function saveCustomer() {
    var code = localStorage.getItem('cCode');
    var title = $('#titlefield').val();
    var name = $('#namefield').val();
    var address = $('#addressfield').val();
    var mobile = $('#mobilefield').val();
    var email = $('#emailfield').val();
    var dataArray = {action: 'saveCustomer', code:code, title: title, name: name, address: address, mobile: mobile, email: email};
    $.post('./models/cust_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Insert Successes');
            getNextCusCode();
            reset_form();
        } else {
            alertify.error('Insert failed');
        }
    });
}

function getNextCusCode() {
    var dataArray = {action: 'getNextCusCode'};
    $.post('./models/cust_model.php', dataArray, function (reply) {
        $('#codefield').html(reply);
        localStorage.setItem('cCode', reply);
    });
}

function reset_form() {
    $('#titlefield').val('');
    $('#namefield').val('');
    $('#addressfield').val('');
    $('#mobilefield').val('');
    $('#emailfield').val('');

    $('#name_msg').html('');
    $('#address_msg').html('');
    $('#mobile_msg').html('');
    $('#email_msg').html('');

    loadAddesCustTable();
    getNextCusCode();

    $('#updateCus').addClass('d-none');
    $('#SaveCust').removeClass('d-none');
}

function form_validation() {
    var allOk = true;
    var title = $('#titlefield').val();
    var name = $('#namefield').val();
    var address = $('#addressfield').val();
    var mobile = $('#mobilefield').val();
    var email = $('#emailfield').val();

    if (title == 1) {
        allOk = true;
    }

    if (name.length <= 5) {
        allOk = false;
        name_msg.innerHTML = "Name is required";
    } else {
        // $('#name_msg').addClass('d-none');
    }

    if (address.length <= 5) {
        allOk = false;
        address_msg.innerHTML = "Address is required";
    } else {
        // $('#address_msg').addClass('d-none');
    }

    if (mobile.length <= 5) {
        allOk = false;
        mobile_msg.innerHTML = "Mobile is required";
    } else {
        // $('#address_msg').addClass('d-none');
    }

    if (email.length <= 5) {
        allOk = false;
        email_msg.innerHTML = "Email is required";
        // $('#name_msg').removeClass('d-none');
    } else {
        // $('#address_msg').addClass('d-none');
    }

    if (allOk) {
        checkEmail();
    }
}

function update_form_validation() {
    var allOk = true;
    var title = $('#titlefield').val();
    var name = $('#namefield').val();
    var address = $('#addressfield').val();
    var mobile = $('#mobilefield').val();
    var email = $('#emailfield').val();

    if (title == 1) {
        allOk = true;
    }

    if (name.length <= 5) {
        allOk = false;
        name_msg.innerHTML = "Name is required";
    } else {
        // $('#name_msg').addClass('d-none');
    }

    if (address.length <= 5) {
        allOk = false;
        address_msg.innerHTML = "Address is required";
    } else {
        // $('#address_msg').addClass('d-none');
    }

    if (mobile.length <= 5) {
        allOk = false;
        mobile_msg.innerHTML = "Mobile is required";
    } else {
        // $('#address_msg').addClass('d-none');
    }

    if (email.length <= 5) {
        allOk = false;
        email_msg.innerHTML = "Email is required";
        // $('#name_msg').removeClass('d-none');
    } else {
        // $('#address_msg').addClass('d-none');
    }

    if (allOk) {
        update_cust_details();
    }
}

function loadAddesCustTable() {
    var search = $('#search').val();
    var dataArray = {action: 'loadAddesCustTable', search: search}
    $.post('./models/cust_model.php', dataArray, function (reply) {
        $('#addedCus_tbl tbody').html('').append(reply);

        $('.select').click(function () {
            get_cus_data_for_update($(this).val());
        });
        $('.delete').click(function () {
            var id = $(this).val();
            alertify.confirm("Confirm Delete", "Are you sure, You want to delete this Record ?",
                    function () {
                        delete_cus_record(id);
                    },
                    function () {
                        alertify.error('Delete Cancel');
                    });
        });
    });
}

function get_cus_data_for_update(cusID) {
    $('#namefield').focus();
    var dataArray = {action: 'get_cus_data_for_update', cusID: cusID}
    $.post('./models/cust_model.php', dataArray, function (reply) {
        $.each(reply, function (index, value) {
            $('#codefield').text(value.cusCode);
            $('#titlefield').val(value.title);
            $('#namefield').val(value.name);
            $('#addressfield').val(value.address);
            $('#mobilefield').val(value.mobile);
            $('#emailfield').val(value.email);
            localStorage.setItem('cusID', cusID);
        });
    }, 'json');

    $('#updateCus').removeClass('d-none');
    $('#SaveCust').addClass('d-none');

}

function update_cust_details() {
    var title = $('#titlefield').val();
    var name = $('#namefield').val();
    var address = $('#addressfield').val();
    var mobile = $('#mobilefield').val();
    var email = $('#emailfield').val();
    var cusID = localStorage.getItem('cusID');
    var dataArray = {action: 'update_cust_details', title: title, name: name, address: address, mobile: mobile, email: email, cusID: cusID};
    $.post('./models/cust_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Update Successes');
            reset_form();
        } else {
            alertify.error('Update Faild');
        }
    });
}

function delete_cus_record(cusID) {
    var dataArray = {action: 'delete_cus_record', cusID: cusID}
    $.post('./models/cust_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Delete Successes');
            reset_form();
        } else {
            alertify.error('Cannot delete this customer. Because the customer has assigned order(s)');
        }
    });
}