loadAddedSupTable();
getNextSupCode();

$('#SaveSup').click(function () {
    form_validation();
});

$('#resetSup').click(function () {
    reset_form();
});

$('#updateSup').click(function () {
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

    // if (crit3 == true){
    //     email_msg.innerHTML = "";
    // }
    email_msg.innerHTML = "";
    return true;
});

$('#search').keyup(function () {
    loadAddedSupTable();
});

//==============================================================================
function checkName() {
    var name = $('#namefield').val();
    var dataArray = {action: 'checkName', name: name}
    $.post('./models/sup_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify
                .alert("Name exists","This supplier is already exists. Try another name", function(){
                    alertify.error('Enter failed');
                });
            $('#namefield').focus();
            $('#namefield').select();
        } else {
            saveSupplier();
        }
    });
}

function saveSupplier() {
    var code = localStorage.getItem('sCode');
    var title = $('#titlefield').val();
    var name = $('#namefield').val();
    var address = $('#addressfield').val();
    var mobile = $('#mobilefield').val();
    var email = $('#emailfield').val();
    var dataArray = {action: 'saveSupplier', code:code, title: title, name: name, address: address, mobile: mobile, email: email};
    $.post('./models/sup_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Insert Successes');
            getNextSupCode();
            reset_form();
        } else {
            alertify.error('Insert failed');
        }
    });
}

function getNextSupCode() {
    var dataArray = {action: 'getNextSupCode'};
    $.post('./models/sup_model.php', dataArray, function (reply) {
        $('#codefield').html(reply);
        localStorage.setItem('sCode', reply);
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
    loadAddedSupTable();
    getNextSupCode();

    $('#updateSup').addClass('d-none');
    $('#SaveSup').removeClass('d-none');
}

function form_validation() {
    var allOk = true;
    var title = $('#titlefield').val();
    var name = $('#namefield').val();
    var address = $('#addressfield').val();
    var mobile = $('#mobilefield').val();
    var email = $('#emailfield').val();

    if (name.length <= 0) {
        allOk = false;
        $('#name_msg').text("Name is required");
    } else {
        $('#name_msg').text("");
    }

    if (address.length <= 10) {
        allOk = false;
        $('#address_msg').text("Address is required");
    } else {
        $('#address_msg').text("");
    }

    if (mobile.length <= 0) {
        allOk = false;
        $('#mobile_msg').text("Mobile is required");
    } else {
        $('#mobile_msg').text("");
    }

    if (allOk) {
        checkName();
    }
}

function update_form_validation() {
    var allOk = true;
    var title = $('#titlefield').val();
    var name = $('#namefield').val();
    var address = $('#addressfield').val();
    var mobile = $('#mobilefield').val();
    var email = $('#emailfield').val();

    if (name.length <= 0) {
        allOk = false;
        $('#name_msg').text("Name is required");
    } else {
        $('#name_msg').text("");
    }

    if (address.length <= 10) {
        allOk = false;
        $('#address_msg').text("Address is required");
    } else {
        $('#address_msg').text("");
    }

    if (mobile.length <= 0) {
        allOk = false;
        $('#mobile_msg').text("Mobile is required");
    } else {
        $('#mobile_msg').text("");
    }

    if (allOk) {
        update_sup_details();
    }
}

function loadAddedSupTable() {
    var search = $('#search').val();
    var dataArray = {action: 'loadAddedSupTable', search: search}
    $.post('./models/sup_model.php', dataArray, function (reply) {
        $('#addedSup_tbl tbody').html('').append(reply);

        $('.select').click(function () {
            get_sup_data_for_update($(this).val());
        });
        $('.delete').click(function () {
            var id = $(this).val();
            alertify.confirm("Confirm Delete", "Are you sure, You want to delete this Record ?",
                function () {
                    delete_sup_record(id);
                },
                function () {
                    alertify.error('Delete Cancelled');
                });
        });
    });
}

function get_sup_data_for_update(supID) {
    $('#namefield').focus();
    var dataArray = {action: 'get_sup_data_for_update', supID: supID}
    $.post('./models/sup_model.php', dataArray, function (reply) {
        $.each(reply, function (index, value) {
            $('#codefield').text(value.supCode);
            $('#titlefield').val(value.sup_title);
            $('#namefield').val(value.sup_name);
            $('#addressfield').val(value.sup_address);
            $('#mobilefield').val(value.sup_mobile);
            $('#emailfield').val(value.sup_email);
            localStorage.setItem('supID', supID);
        });
    }, 'json');

    $('#updateSup').removeClass('d-none');
    $('#SaveSup').addClass('d-none');

}

function update_sup_details() {
    var title = $('#titlefield').val();
    var name = $('#namefield').val();
    var address = $('#addressfield').val();
    var mobile = $('#mobilefield').val();
    var email = $('#emailfield').val();
    var supID = localStorage.getItem('supID');
    var dataArray = {action: 'update_sup_details', title: title, name: name, address: address, mobile: mobile, email: email, supID: supID};
    $.post('./models/sup_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Update Successes');
            reset_form();
        } else {
            alertify.error('Update failed');
        }
    });
}

function delete_sup_record(supID) {
    var dataArray = {action: 'delete_sup_record', supID: supID}
    $.post('./models/sup_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Delete Successes');
            reset_form();
        } else {
            alertify.error('Cannot delete this supplier. Because there are some GRN notes assigned to them.');
        }
    });
}