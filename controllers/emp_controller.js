loadAddedEmpTable();
getNextEmpCode();

$('#SaveEmp').click(function () {
    form_validation();
});

$('#resetEmp').click(function () {
    reset_form();
});

$('#updateEmp').click(function () {
    update_form_validation();
});

$('#search').keyup(function () {
    loadAddedEmpTable();
});

$('#empPhotofield').change(function () {
    getImgPreview(this);
});

$('#dobfield').change(function () {
    var selectedDate = $('#dobfield').val();
    var start = new Date(selectedDate),
        end = new Date(),
        diff = new Date(end - start),
        years = diff / 1000 / 60 / 60 / 24 / 365;
    if (parseInt(years) <= 18) {
        $('#dob_msg').html("Selected age should not be less than 18.");
    } else {
        $('#dob_msg').html("");
    }
});


// ====================================validation============================================

$('#empnamefield').keyup(function () {
    const name = empnamefield.value.trim();
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


$('#nicfield').keyup(function () {
    const nicPattern = /^(?:\d{9}[V]|\d{12})$/;
    const nicValue = $(this).val();

    if (!nicPattern.test(nicValue)) {
        nic_msg.innerHTML = "NIC is wrong";
    } else {
        nic_msg.innerHTML = "";
    }
});


//$('#dobfield').change(function () {
//    const dob = dobfield.value;
//    const crit1 = dob != "";
//
//    if (!crit1) {
//        dob_msg.innerHTML = "Select a date of birth";
//        return false;
//    }
//    dob_msg.innerHTML = "";
//    return true;
//});

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

$('#landfield').keyup(function () {
    const land = landfield.value.trim();

    if (land == "") {
        land_msg.innerHTML = "";
        return true;
    }

    const landPattern = /^[0][0-9]{9}$/;
    const crit1 = land.length == 10;
    const crit2 = landPattern.test(land);

    if (!crit1) {
        land_msg.innerHTML = "Land number should has 10 characters";
        return false;
    }

    if (!crit2) {
        land_msg.innerHTML = "Invalid land number";
        return false;
    }
    land_msg.innerHTML = "";
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

$('#designationfield').change(function () {
    const designation = designationfield.value;
    const crit1 = designation != "";

    if (!crit1) {
        designation_msg.innerHTML = "Designation is required";
        return false;
    }
    designation_msg.innerHTML = "";
    return true;
});

$('#recdatefield').change(function () {
    const recdate = recdatefield.value;
    const crit1 = recdate != "";

    if (!crit1) {
        recdate_msg.innerHTML = "Recruit is required";
        return false;
    }
    recdate_msg.innerHTML = "";
    return true;
});

$('#empPhotofield').change(function () {
    const photo = empPhotofield.value;
    const crit1 = photo != "";

    if (!crit1) {
        photo_msg.innerHTML = "Select a photo";
        return false;
    }
    photo_msg.innerHTML = "";
    return true;
});

$('#conPasswordfield').keyup(function () {
    const pass = Passwordfield.value;
    const confirmPass = conPasswordfield.value;
    if (confirmPass == pass) {
        conPass_msg.innerHTML = "";
        return true;
    } else {
        conPass_msg.innerHTML = "Password not match!";
        return false;
    }
});


//===========================Function===================================================

function getImgPreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#empPhotoPreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function uploadImage() {
    var fd = new FormData();
    var files = $('#empPhotofield')[0].files[0];
    fd.append('file', files);
    $.ajax({
        url: './models/emp_upload.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response != 0) {
                reset_form();
            } else {
                alertify.error("File not uploaded");
            }
        },
    });
}

function checkNic() {
    var nic = $('#nicfield').val();
    var dataArray = {action: 'checkNic', nic: nic}
    $.post('./models/emp_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.alert("NIC exist", "This user maybe already exists. Try another NIC or check employee list.", function () {
                alertify.error('Enter failed');
            });
            $('#nicfield').focus();
            $('#nicfield').select();
        } else {
            saveEmployee();
        }
    });
}

function checkUpdateNic() {
    var nic = $('#nicfield').val();
    var oldNic = localStorage.getItem('nic');
    if (oldNic == nic) {
        update_emp_details();
    } else {
        var dataArray = {action: 'checkUpdateNic', nic: nic}
        $.post('./models/emp_model.php', dataArray, function (reply) {
            if (reply == 1) {
                alertify.alert("NIC exist", "This user maybe already exists. Try another NIC or check employee list.", function () {
                    alertify.error('Enter failed');
                });
                $('#nicfield').focus();
                $('#nicfield').select();
            } else {
                update_emp_details();
            }
        });

    }
}

function saveEmployee() {
    var code = localStorage.getItem('eCode');
    var title = $('#titlefield').val();
    var name = $('#empnamefield').val();
    var nic = $('#nicfield').val();
    var dob = $('#dobfield').val();
    var gender = $("input[name='gender']:checked").val();
    var mobile = $('#mobilefield').val();
    var land = $('#landfield').val();
    var address = $('#addressfield').val();
    var email = $('#emailfield').val();
    var designation = $('#designationfield').val();
    var recdate = $('#recdatefield').val();
    var password = $('#Passwordfield').val();

    var dataArray = {
        action: 'saveEmployee',
        code: code,
        title: title,
        name: name,
        nic: nic,
        dob: dob,
        gender: gender,
        mobile: mobile,
        land: land,
        address: address,
        email: email,
        designation: designation,
        recdate: recdate,
        password: password
    };
    $.post('./models/emp_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success("Insert Successes");
            uploadImage();
            getNextEmpCode();
        } else {
            alertify.error("Insert Failed");
        }
    });
}

function getNextEmpCode() {
    var dataArray = {action: 'getNextEmpCode'};
    $.post('./models/emp_model.php', dataArray, function (reply) {
        $('#codefield').html(reply);
        localStorage.setItem('eCode', reply);
    });
}

function reset_form() {
    $('#titlefield').val('');
    $('#empnamefield').val('');
    $('#nicfield').val('');
    $('#dobfield').val('');
    $('input[name="gender"]').prop('checked', false);
    $('#mobilefield').val('');
    $('#landfield').val('');
    $('#addressfield').val('');
    $('#emailfield').val('');
    $('#designationfield').val('');
    $('#recdatefield').val('');
    $('#photofield').val('');
    $('#Passwordfield').val('');
    $('#conPasswordfield').val('');
    $('#empPhotoPreview').attr('src', './others/Assets/Images/dummyphoto.jpg');
    $('#empPhotofield').val('');

    $('#name_msg').html('');
    $('#nic_msg').html('');
    $('#dob_msg').html('');
    $('#gender_msg').html('');
    $('#mobile_msg').html('');
    $('#land_msg').html('');
    $('#address_msg').html('');
    $('#email_msg').html('');
    $('#designation_msg').html('');
    $('#recdate_msg').html('');
    $('#photo_msg').html('');
    $('#conPass_msg').html('');

    loadAddedEmpTable();
    getNextEmpCode();

    $('#updateEmp').addClass('d-none');
    $('#SaveEmp').removeClass('d-none');
}

function form_validation() {
    var allOk = true;
    var name = $('#empnamefield').val();
    var dob = $('#dobfield').val();
    var nicPattern = /^(?:\d{9}V|\d{12})$/;
    var nicValue = $('#nicfield').val();

    var gender = '';
    if ($("input:radio[name='gender']").is(":checked")) {
        gender = $("input[name='gender']:checked").val();
    } else {
        gender = 0;
    }

    var mobile = $('#mobilefield').val();
    var land = $('#landfield').val();
    var address = $('#addressfield').val();
    var email = $('#emailfield').val();
    var designation = $('#designationfield').val();
    var recdate = $('#recdatefield').val();
    var photo = $('#empPhotofield').val();
    var password = $('#Passwordfield').val();
    var passwordConfirm = $('#conPasswordfield').val();

    if (name.length <= 0) {
        allOk = false;
        $('#name_msg').text("Name is required");
    } else {
        $('#name_msg').text("");
    }

    if (!nicPattern.test(nicValue)) {
        allOk = false;
        nic_msg.innerHTML = "NIC is wrong";
    } else {
        nic_msg.innerHTML = "";
    }

    if (!dob) {
        allOk = false;
        $('#dob_msg').text("Date of birth is required");
    } else {
        $('#dob_msg').text("");
    }

    if (gender == 0) {
        allOk = false;
        $('#gender_msg').text("Gender is required");
    } else {
        $('#gender_msg').text("");
    }

    if (mobile.length <= 0) {
        allOk = false;
        $('#mobile_msg').text("Mobile is required");
    } else {
        $('#mobile_msg').text("");
    }

    if (address.length <= 10) {
        allOk = false;
        $('#address_msg').text("Address is required");
    } else {
        $('#address_msg').text("");
    }

    if (email.length <= 0) {
        allOk = false;
        $('#email_msg').text("Email is required");
    } else {
        $('#email_msg').text("");
    }

    if (!designation) {
        allOk = false;
        $('#designation_msg').text("Designation is required");
    } else {
        $('#designation_msg').text("");
    }

    if (!recdate) {
        allOk = false;
        $('#recdate_msg').text("Recruit date is required");
    } else {
        $('#recdate_msg').text("");
    }

    if (!photo) {
        allOk = false;
        $('#photo_msg').text("Photo is required");
    } else {
        $('#photo_msg').text("");
    }

    if (passwordConfirm.length <= 0) {
        allOk = false;
        $('#conPass_msg').text("Password is required");
    } else {
        $('#conPass_msg').text("");
    }

    if (allOk) {
        checkNic()
    }
}

function update_form_validation() {
    var allOk = true;
    var name = $('#empnamefield').val();
    var nic = $('#nicfield').val();
    var dob = $('#dobfield').val();

    var gender = '';
    if ($("input:radio[name='gender']").is(":checked")) {
        gender = $("input[name='gender']:checked").val();
    } else {
        gender = 0;
    }

    var mobile = $('#mobilefield').val();
    // var land = $('#landfield').val();
    var address = $('#addressfield').val();
    var email = $('#emailfield').val();
    var designation = $('#designationfield').val();
    var recdate = $('#recdatefield').val();
    // var photo = $('#empPhotofield').val();
    // var password = $('#Passwordfield').val();
    // var passwordConfirm = $('#conPasswordfield').val();

    if (name.length <= 0) {
        allOk = false;
        $('#name_msg').text("Name is required");
    } else {
        $('#name_msg').text("");
    }

    if (nic.length <= 0) {
        allOk = false;
        $('#nic_msg').text("NIC is required");
    } else {
        $('#nic_msg').text("");
    }

    if (!dob) {
        allOk = false;
        $('#dob_msg').text("Date of birth is required");
    } else {
        $('#dob_msg').text("");
    }

    if (gender == 0) {
        allOk = false;
        $('#gender_msg').text("Gender is required");
    } else {
        $('#gender_msg').text("");
    }

    if (mobile.length <= 0) {
        allOk = false;
        $('#mobile_msg').text("Mobile is required");
    } else {
        $('#mobile_msg').text("");
    }

    if (address.length <= 10) {
        allOk = false;
        $('#address_msg').text("Address is required");
    } else {
        $('#address_msg').text("");
    }

    if (email.length <= 0) {
        allOk = false;
        $('#email_msg').text("Email is required");
    } else {
        $('#email_msg').text("");
    }

    if (!designation) {
        allOk = false;
        $('#designation_msg').text("Designation is required");
    } else {
        $('#designation_msg').text("");
    }

    if (!recdate) {
        allOk = false;
        $('#recdate_msg').text("Recruit date is required");
    } else {
        $('#recdate_msg').text("");
    }

    // if (!photo) {
    //     allOk = false;
    //     $('#photo_msg').text("Photo is required");
    // } else {
    //     $('#photo_msg').text("");
    // }

    // if (passwordConfirm.length <= 0) {
    //     allOk = false;
    //     $('#conPass_msg').text("Password is required");
    // } else {
    //     $('#conPass_msg').text("");
    // }

    if (allOk) {
        checkUpdateNic()
    }
}

function loadAddedEmpTable() {
    var search = $('#search').val();
    var dataArray = {action: 'loadAddedEmpTable', search: search}
    $.post('./models/emp_model.php', dataArray, function (reply) {
        $('#addedEmp_tbl tbody').html('').append(reply);

        $('.select').click(function () {
            get_emp_data_for_update($(this).val());
        });
        $('.delete').click(function () {
            var id = $(this).val();
            alertify.confirm("Confirm Delete", "Are you sure, You want to delete this Record ?",
                function () {
                    delete_emp_record(id);
                },
                function () {
                    alertify.error('Delete Cancelled');
                });

        });
    });
}

function get_emp_data_for_update(empID) {
    $('#empnamefield').focus();
    var dataArray = {action: 'get_emp_data_for_update', empID: empID}
    $.post('./models/emp_model.php', dataArray, function (reply) {
        $.each(reply, function (index, value) {
            $('#codefield').text(value.empCode);
            $('#titlefield').val(value.title);
            $('#empnamefield').val(value.name);
            localStorage.setItem('nic', value.nic);
            $('#nicfield').val(value.nic);
            $('#dobfield').val(value.dob);
            if (value.gender == 'Male') {
                $('#genderfield1').prop('checked', true);
            } else {
                $('#genderfield2').prop('checked', true);
            }
            $('#mobilefield').val(value.mobile);
            $('#landfield').val(value.land);
            $('#addressfield').val(value.address);
            $('#emailfield').val(value.email);
            $('#designationfield').val(value.designation);
            $('#recdatefield').val(value.recdate);
            $('#empPhotoPreview').attr('src', './others/upload_emp/' + value.photo);
            localStorage.setItem('empID', empID);
        });
    }, 'json');

    $('#updateEmp').removeClass('d-none');
    $('#SaveEmp').addClass('d-none');

}

function update_emp_details() {
    var title = $('#titlefield').val();
    var name = $('#empnamefield').val();
    var nic = $('#nicfield').val();
    var dob = $('#dobfield').val();
    var gender = $("input[name='gender']:checked").val();
    var mobile = $('#mobilefield').val();
    var land = $('#landfield').val();
    var address = $('#addressfield').val();
    var email = $('#emailfield').val();
    var designation = $('#designationfield').val();
    var recdate = $('#recdatefield').val();
    var empID = localStorage.getItem('empID');
    var dataArray = {
        action: 'update_emp_details',
        title: title,
        name: name,
        nic: nic,
        dob: dob,
        gender: gender,
        mobile: mobile,
        land: land,
        address: address,
        email: email,
        designation: designation,
        recdate: recdate,
        empID: empID
    };
    $.post('./models/emp_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Update Successes');
            uploadImage();
            reset_form();
        } else {
            alertify.error('Update Failed');
        }
    });
}

function delete_emp_record(empID) {
    var dataArray = {action: 'delete_emp_record', empID: empID}
    $.post('./models/emp_model.php', dataArray, function (reply) {
        if (reply == 2) {
            alertify.alert("Warning!","Cannot delete current employee.", function(){
                    alertify.error('Delete failed');
                });
        } else {
            if (reply == 1) {
                alertify.success('Delete Successes');
                reset_form();
            } else {
                alertify.error('Cannot delete this employee. Because this employee has some assignments');
            }
        }

    });
}