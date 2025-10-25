loadAddedCakeTable();
getNextCakeCode();

$('#SaveCake').click(function () {
    form_validation();
});

$('#resetCake').click(function () {
    reset_form();
});

$('#updateCake').click(function () {
    update_form_validation();
});

$('#search').keyup(function () {
    loadAddedCakeTable();
});

//$('#photofield').change(function () {
//    getImgPreview(this);
//});

$('#typeField').change(function () {
    var type = $(this).val();
    if (type == 1) {
        $('#itemTypeSection').removeClass('d-none');
    } else {
        $('#itemTypeSection').addClass('d-none');
    }
});

$('#photofield').change(function () {
    var fileExtension = ['jpg', 'jpeg', 'png'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        $('#photo_msg').html("Only formats are allowed : " + fileExtension.join(', '));
        $('#photofield').val('');
        $('#photoPreview').attr('src', './others/images/dummycake.jpg');
    } else {
        $('#photo_msg').html("");
        getImgPreview(this);
    }
});

// =========================================validations===========================================

$('#typeField').change(function () {
    const type = typeField.value;
    const crit1 = type != "";

    if (!crit1) {
        itemType_msg.innerHTML = "Select a type";
        return false;
    }
    itemType_msg.innerHTML = "";
    return true;
});

$('#namefield').keyup(function () {
    const name = namefield.value.trim();
    const crit1 = name != "";
    const crit2 = name.length >= 5;

    if (!crit1) {
        name_msg.innerHTML = "Name is required";
        return false;
    }

    if (!crit2) {
        name_msg.innerHTML = "Name should has at least 5 characters";
        return false;
    }
    name_msg.innerHTML = "";
    return true;
});

$('#occasionfield').change(function () {
    const occasion = occasionfield.value;
    const crit1 = occasion != "";

    if (!crit1) {
        occasion_msg.innerHTML = "Select a occasion";
        return false;
    }
    occasion_msg.innerHTML = "";
    return true;
});

$('#weightfield').change(function () {
    const weight = weightfield.value;
    const crit1 = weight != "";

    if (!crit1) {
        occasion_msg.innerHTML = "Select a weight";
        return false;
    }
    weight_msg.innerHTML = "";
    return true;
});

$('#descriptionfield').keyup(function () {
    const description = descriptionfield.value.trim();
    const crit1 = description != "";
    const crit2 = description.length >= 10;

    if (!crit1) {
        description_msg.innerHTML = "Description is required";
        return false;
    }

    if (!crit2) {
        description_msg.innerHTML = "Description should has at least 10 characters";
        return false;
    }
    description_msg.innerHTML = "";
    return true;
});

//=================================================================================================

function form_validation() {
    var allOk = true;
    var type = $('#typeField').val();
    var name = $('#namefield').val();
    var occasion = $('#occasionfield').val();
    var description = $('#descriptionfield').val();
    var photo = $('#photofield').val();

    if (type == '0') {
        allOk = false;
        $('#itemType_msg').text("Type is required");
    } else {
        $('#itemType_msg').text("");
    }

    if (name.length <= 0) {
        allOk = false;
        $('#name_msg').text("Name is required");
    } else {
        $('#name_msg').text("");
    }

    if (description.length <= 10) {
        allOk = false;
        $('#description_msg').text("Description must be more than 10 characters");
    } else {
        $('#description_msg').text("");
    }

    if (type == 1 && occasion == '0') {
        allOk = false;
        $('#occasion_msg').text("Occasion is required");
    } else {
        $('#occasion_msg').text("");
    }

    if (!photo) {
        allOk = false;
        $('#photo_msg').text("Photo is required");
    } else {
        $('#photo_msg').text("");
    }
    if (allOk) {
        checkName();
    }
}

function update_form_validation() {
    var allOk = true;
    var type = $('#typeField').val();
    var name = $('#namefield').val();
    var occasion = $('#occasionfield').val();
    var description = $('#descriptionfield').val();
    var photo = $('#photofield').val();

    if (type == '0') {
        allOk = false;
        $('#itemType_msg').text("Type is required");
    } else {
        $('#itemType_msg').text("");
    }

    if (name.length <= 0) {
        allOk = false;
        $('#name_msg').text("Name is required");
    } else {
        $('#name_msg').text("");
    }

    if (description.length <= 10) {
        allOk = false;
        $('#description_msg').text("Description must be more than 10 characters");
    } else {
        $('#description_msg').text("");
    }

    if (type == 1 && occasion == '0') {
        allOk = false;
        $('#occasion_msg').text("Occasion is required");
    } else {
        $('#occasion_msg').text("");
    }

    // if (!photo) {
    //     allOk = false;
    //     $('#photo_msg').text("Photo is required");
    // } else {
    //     $('#photo_msg').text("");
    // }
    if (allOk) {
        update_cake_details();
        // checkName();
    }
}

function checkName() {
    var name = $('#namefield').val();
    var dataArray = {action: 'checkName', name: name}
    $.post('./models/cake_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify
                    .alert("Name exists", "This cake name is already exists. Try another name", function () {
                        alertify.error('Enter failed');
                    });
            $('#namefield').focus();
            $('#namefield').select();
        } else {
            saveCake();
        }
    });
}

function saveCake() {
    var code = localStorage.getItem('cCode');
    var type = $('#typeField').val();
    var name = $('#namefield').val();
    var occasion = '';
    if (type == 1) {
        occasion = $('#occasionfield').val();
    }
    alert(code)
    var description = $('#descriptionfield').val();
    var dataArray = {action: 'saveCake', code: code, type: type, name: name, occasion: occasion, description: description};
    $.post('./models/cake_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success("Insert Successes");
            uploadImage();
            getNextCakeCode()
        } else {
            alertify.error("Insert Failed");
        }
    });
}

function getNextCakeCode() {
    var dataArray = {action: 'getNextCakeCode'};
    $.post('./models/cake_model.php', dataArray, function (reply) {
        $('#codefield').html($.trim(reply));
        localStorage.setItem('cCode', $.trim(reply));
    });
}

function getImgPreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#photoPreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function uploadImage() {
    var fd = new FormData();
    var files = $('#photofield')[0].files[0];
    fd.append('file', files);
    $.ajax({
        url: './models/cake_design_upload.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response != 0) {
                reset_form();
            } else {
                alertify.error("file not uploaded");
            }
        },
    });
}

function reset_form() {
    $('#codefield').text('');
    $('#typeField').val('0');
    $('#namefield').val('');
    $('#occasionfield').val('0');
    $('#weightfield').val('0');
    $('#descriptionfield').val('');
    $('#photofield').val('');

    $('#itemTypeSection').addClass('d-none');

    $('#name_msg').html('');
    $('#occasion_msg').html('');
    $('#weight_msg').html('');
    $('#description_msg').html('');
    $('#photo_msg').html('');
    $('#photoPreview').attr('src', './others/images/dummycake.jpg');

    loadAddedCakeTable();
    getNextCakeCode();

    $('#updateCake').addClass('d-none');
    $('#SaveCake').removeClass('d-none');
    $('#seeMore').addClass('d-none');
}

function loadAddedCakeTable() {
    var search = $('#search').val();
    var dataArray = {action: 'loadAddedCakeTable', search: search}
    $.post('./models/cake_model.php', dataArray, function (reply) {
        $('#addedcake_tbl tbody').html('').append(reply);

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

function get_cake_data_for_update(cakeID) {
    $('#typeField').focus();
    localStorage.setItem('cakeID', cakeID);
    var dataArray = {action: 'get_cake_data_for_update', cakeID: cakeID}
    $.post('./models/cake_model.php', dataArray, function (reply) {
        $.each(reply, function (index, value) {
            $('#codefield').text(value.code);
            $('#typeField').val(value.type);
            if (value.type == 1) {
                $('#itemTypeSection').removeClass('d-none');
            } else {
                $('#itemTypeSection').addClass('d-none');
            }
            $('#namefield').val(value.name);
            $('#occasionfield').val(value.occasion);
            $('#weightfield').val(value.weight);
            $('#descriptionfield').val(value.description);
            $('#photoPreview').attr('src', './others/upload_cake_designs/' + value.photo);
            $('#photofield').val(value.photo);
        });
    }, 'json');

    $('#updateCake').removeClass('d-none');
    $('#SaveCake').addClass('d-none');
}

function update_cake_details() {
    var name = $('#namefield').val();
    var occasion = $('#occasionfield').val();
    var weight = $('#weightfield').val();
    var description = $('#descriptionfield').val();
    var cakeID = localStorage.getItem('cakeID');
    var dataArray = {
        action: 'update_cake_details',
        name: name,
        occasion: occasion,
        weight: weight,
        description: description,
        cakeID: cakeID
    };
    $.post('./models/cake_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Update Successes');
            uploadImage();
            setTimeout(function () {
                window.location = './?cakeReg';
            }, 1000);
        } else {
            alertify.error('Update Failed');
        }
    });
}

function delete_cake_record(cakeID) {
    var dataArray = {action: 'delete_cake_record', cakeID: cakeID}
    $.post('./models/cake_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Delete Successes');
            reset_form();
        } else {
            alertify.error('Cannot delete this item. Because this item assigned to some orders.');
        }
    });
}