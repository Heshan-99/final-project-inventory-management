loadAddedItemTable();
loadBrandDetails();
loadAddedBrands();
loadAddedBrands();

$('#SaveItem').click(function () {
    form_validation();
});

$('#resetItem').click(function () {
    reset_form();
});

$('#updateItem').click(function () {
    update_form_validation();
});

$('#search').keyup(function () {
    loadAddedItemTable();
});

$('#Brandsearch').keyup(function () {
    loadAddedBrands();
});

$('#itemNamefield').keyup(function () {
    getNewItemCode();
});

$('#notListedBtn').click(function () {
    $('#newBrandField').removeClass('d-none');
    $('#addNewBrandBtn').removeClass('d-none');
});

$('#addNewBrandBtn').click(function () {
    brandValidation();
});

// ======================Validations=========================================

$('#newBrandField').keyup(function () {
    var brand = $('#newBrandField').val();
    if (brand.length == 0) {
        $('#newBrand_msg').text("Brand name is required");
    } else {
        $('#newBrand_msg').text("");
    }
});

$('#itemNamefield').keyup(function () {
    const name = itemNamefield.value.trim();
    const crit1 = name != "";
    const crit2 = name.length >= 2;

    if (!crit1) {
        itemName_msg.innerHTML = "Name is required";
        return false;
    }

    if (!crit2) {
        itemName_msg.innerHTML = "Name should has at least 2 characters";
        return false;
    }
    itemName_msg.innerHTML = "";
    return true;
});


$('#brandIdfield').change(function () {
    const brand = brandIdfield.value;
    const crit1 = brand != "";

    if (!crit1) {
        brand_msg.innerHTML = "Select a brand";
        return false;
    }
    brand_msg.innerHTML = "";
    return true;
});

$('#catIdfield').change(function () {
    var catID = $(this).val();
    if (catID == 0) {
        $('#category_msg').html('Select a category');
    } else {
        $('#category_msg').html('');
    }
});

$('#reorderLevelfield').keyup(function () {
    var reorderlevel = $('#reorderLevelfield').val();
    if (reorderlevel.length == 0) {
        $('#reorderLevel_msg').text("Reorder is required");
    } else {
        $('#reorderLevel_msg').text("");
    }
});


//==============================================================================
function checkNameAndBrand() {
    var name = $('#itemNamefield').val();
    var brand = $('#brandIdfield').val();
    var dataArray = {action: 'checkNameAndBrand', name: name, brand: brand}
    $.post('./models/item_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify
                .alert("Name exists", "This item is already added under this brand. Try another item name or brand", function () {
                    alertify.error('Enter failed');
                });
            $('#itemNamefield').focus();
            $('#itemNamefield').select();
        } else {
            saveItem();
        }
    });
}

function saveItem() {
    var cat = $('#catIdfield').val();
    var name = $('#itemNamefield').val();
    var metric = $("input[name='metric']:checked").val();
    var itemCode = $('#itemCode').val();
    var brand = $('#brandIdfield').val();
    var rLevel = $('#reorderLevelfield').val();
    var dataArray = {
        action: 'saveItem',
        cat: cat,
        name: name,
        metric: metric,
        itemCode: itemCode,
        brand: brand,
        rLevel: rLevel
    };
    $.post('./models/item_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Insert Successes');
            loadAddedItemTable();
            reset_form();
        } else {
            alertify.error('Insert failed');
        }
    });
}

function reset_form() {
    $('#catIdfield').val('0');
    $('#itemNamefield').val('');
    $('input[name="metric"]').prop('checked', false);
    $('#itemCode').val('');
    $('#brandIdfield').val('0');
    $('#reorderLevelfield').val('');
    $('#newBrandField').val('');

    $('#category_msg').html('');
    $('#itemName_msg').html('');
    $('#reorderLevel_msg').html('');
    $('#brand_msg').html('');
    loadAddedItemTable();

    $('#addNewBrandBtn').addClass('d-none');
    $('#newBrandField').addClass('d-none');
    $('#updateItem').addClass('d-none');
    $('#SaveItem').removeClass('d-none');
}

function form_validation() {
    var allOk = true;
    var name = $('#itemNamefield').val();
    var brand = $('#brandIdfield').val();
    var reorderlevel = $('#reorderLevelfield').val();
    var category = $('#catIdfield').val();

    var metric = '';
    if ($("input:radio[name='metric']").is(":checked")) {
        metric = $("input[name='metric']:checked").val();
    } else {
        metric = 0;
    }

    if (metric == 0) {
        allOk = false;
        $('#metric_msg').text("Metric is required");
    } else {
        $('#metric_msg').text("");
    }

    if (name.length <= 0) {
        allOk = false;
        $('#itemName_msg').text("Name is required");
    } else {
        $('#itemName_msg').text("");
    }

    if (reorderlevel.length == 0) {
        allOk = false;
        $('#reorderLevel_msg').text("Reorder is required");
    } else {
        $('#reorderLevel_msg').text("");
    }

    if (!brand) {
        allOk = false;
        $('#brand_msg').text("Brand is required");
    } else {
        $('#brand_msg').text("");
    }

    if (!category) {
        allOk = false;
        $('#category_msg').text("Category is required");
    } else {
        $('#category_msg').text("");
    }

    if (allOk) {
        checkNameAndBrand();
    }
}

function update_form_validation() {
    var allOk = true;
    var name = $('#itemNamefield').val();
    var brand = $('#brandIdfield').val();
    var reorderlevel = $('#reorderLevelfield').val();
    var category = $('#catIdfield').val();

    if (name.length <= 0) {
        allOk = false;
        $('#itemName_msg').text("Name is required");
    } else {
        $('#itemName_msg').text("");
    }

    if (reorderlevel.length == 0) {
        allOk = false;
        $('#reorderLevel_msg').text("Reorder is required");
    } else {
        $('#reorderLevel_msg').text("");
    }

    if (!brand) {
        allOk = false;
        $('#brand_msg').text("Brand is required");
    } else {
        $('#brand_msg').text("");
    }

    if (!category) {
        allOk = false;
        $('#category_msg').text("Category is required");
    } else {
        $('#category_msg').text("");
    }

    if (allOk) {
        update_item_details();
    }
}

function loadAddedItemTable() {
    var search = $('#search').val();
    var dataArray = {action: 'loadAddedItemTable', search: search}
    $.post('./models/item_model.php', dataArray, function (reply) {
        $('#addedItem_tbl tbody').html('').append(reply);

        $('.select').click(function () {
            get_item_data_for_update($(this).val());
        });
        $('.deleteItem').click(function () {
            var itemId = $(this).val();
            alertify.confirm("Confirm Delete", "Are you sure, You want to delete this Record ?",
                function () {
                    delete_item_record(itemId);
                },
                function () {
                    alertify.error('Delete Cancelled');
                });
        });
    });
}

function get_item_data_for_update(itemID) {
    $('#catIdfield').focus();
    var dataArray = {action: 'get_item_data_for_update', itemID: itemID}
    $.post('./models/item_model.php', dataArray, function (reply) {
        $.each(reply, function (index, value) {
            $('#catIdfield').val(value.item_cat_id);
            $('#itemNamefield').val(value.item_name);
            if (value.item_metric == 'kg') {
                $('#metricfield1').prop('checked', true);
            } else if (value.item_metric == 'l') {
                $('#metricfield2').prop('checked', true);
            } else {
                $('#metricfield3').prop('checked', true);
            }
            $('#itemCode').val(value.item_code);
            $('#brandIdfield').val(value.brand_id);
            $('#reorderLevelfield').val(value.reorder_level);
            localStorage.setItem('itemID', itemID);
        });
    }, 'json');

    $('#updateItem').removeClass('d-none');
    $('#SaveItem').addClass('d-none');

}

function update_item_details() {
    var catId = $('#catIdfield').val();
    var name = $('#itemNamefield').val();
    var brandId = $('#brandIdfield').val();
    var reorderLevel = $('#reorderLevelfield').val();
    var itemID = localStorage.getItem('itemID');
    var dataArray = {
        action: 'update_item_details',
        catId: catId,
        name: name,
        brandId: brandId,
        reorderLevel: reorderLevel,
        itemID: itemID
    };
    $.post('./models/item_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Update Successes');
            reset_form();
        } else {
            alertify.error('Update failed');
        }
    });
}

function delete_item_record(itemID) {
    var dataArray = {action: 'delete_item_record', itemID: itemID}
    $.post('./models/item_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Delete Successes');
            loadAddedItemTable();
            reset_form();
        } else {
            alertify.error("Cannot delete this item. Because this item used for some item's configurations");
        }
    });
}

function getNewItemCode() {
    var itemName = $('#itemNamefield').val();
    if (itemName.length >= 2) {
        var dataArray = {action: 'getNewItemCode', itemName: itemName}
        $.post('./models/item_model.php', dataArray, function (reply) {
            $('#itemCode').val(reply);
        });
    } else {
        $('#itemCode').val('');
    }
}

function loadBrandDetails() {
    var dataArray = {action: 'loadBrandDetails'}
    $.post('./models/item_model.php', dataArray, function (reply) {
        $('#brandIdfield').html(reply);
    });
}

// =========================================New Brand enter=====================================================

function brandValidation() {
    var allOk = true;
    var brand = $('#newBrandField').val();

    if (brand.length <= 0) {
        allOk = false;
        $('#newBrand_msg').text("Brand is required");
    } else {
        $('#newBrand_msg').text("");
    }

    if (allOk) {
        checkBrand();
    }
}

function checkBrand() {

    var brand = $('#newBrandField').val();
    var dataArray = {action: 'checkBrand', brand: brand}
    $.post('./models/item_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify
                .alert("Brand exists", "This brand name is already exists. Try another name", function () {
                    alertify.error('Enter failed');
                });
            $('#newBrandField').focus();
            $('#newBrandField').select();
        } else {
            addNewBrand();
        }
    });
}

function addNewBrand() {
    var newBrand = $('#newBrandField').val();
    var dataArray = {action: 'addNewBrand', newBrand: newBrand}
    $.post('./models/item_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Successfully added');
            // reset_form();
            loadBrandDetails();
            loadAddedBrands();

            $('#newBrandField').addClass('d-none');
            $('#addNewBrandBtn').addClass('d-none');
        } else {
            alertify.error('Failed');
        }
    });
}

function loadAddedBrands() {
    var search = $('#Brandsearch').val();
    var dataArray = {action: 'loadAddedBrands', search: search}
    $.post('./models/item_model.php', dataArray, function (reply) {
        $('#addedbrand_tbl tbody').html('').append(reply);

        $('.deleteBrand').click(function () {
            var id = $(this).val();
            alertify.confirm("Confirm Delete", "Are you sure, You want to delete this Record ?",
                function () {
                    deleteBrand(id);
                },
                function () {
                    alertify.error('Delete Cancelled');
                });
        });
    });
}

function deleteBrand(id) {
    var dataArray = {action: 'deleteBrand', id: id}
    $.post('./models/item_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Delete Successes');
            loadAddedBrands();
            loadBrandDetails();
        } else {
            alertify.error("Cannot delete this brand. Because there are some items registered under this brand.");
        }
    });
}


