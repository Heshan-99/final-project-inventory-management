loadEmployees();

$('#emp').change(function () {
    loadAvaiPrevilege();
    loadAssignedPrevilege();
});

$('#custAssign').click(function () {
    custAssignPrevilege();
});

$('#allAsign').click(function () {
    allAssignPrevilege();
});

$('#custRemove').click(function () {
    custRemovePrevilege();
});

$('#allRemove').click(function () {
    allRemovePrevilege();
});
//==============================================================================

function loadEmployees() {
    var dataArray = {action: 'loadEmployees'};
    $.post('./models/system_previlege_model.php', dataArray, function (reply) {
        $('#emp').html(reply);
    });
}

function loadAvaiPrevilege() {
    var empId = $('#emp').val();
    var dataArray = {action: 'loadAvaiPrevilege', empId: empId};
    $.post('./models/system_previlege_model.php', dataArray, function (reply) {
        $('#ava_priv').html(reply);
    });
}

function loadAssignedPrevilege() {
    var empId = $('#emp').val();
    var dataArray = {action: 'loadAssignedPrevilege', empId: empId};
    $.post('./models/system_previlege_model.php', dataArray, function (reply) {
        $('#assi_priv').html(reply);
    });
}

function custAssignPrevilege() {
    var empId = $('#emp').val();
    var selectedPrvId = $('#ava_priv').val();
    var dataArray = {action: 'custAssignPrevilege', empId: empId, selectedPrvId: selectedPrvId};
    $.post('./models/system_previlege_model.php', dataArray, function (reply) {
        if (reply == 1) {
            loadAvaiPrevilege();
            loadAssignedPrevilege();
            alertify.success('Privilege assigned successfully');
        } else {
            alertify.error('Privilege assign process failed');
        }
    });
}

function allAssignPrevilege() {
    var empId = $('#emp').val();
    var dataArray = {action: 'allAssignPrevilege', empId: empId};
    $.post('./models/system_previlege_model.php', dataArray, function (reply) {
        if (reply == 1) {
            loadAvaiPrevilege();
            loadAssignedPrevilege();
            alertify.success('All previlege assigned successfully');
        } else {
            alertify.error('All previlege assign process failed');
        }
    });
}

function custRemovePrevilege() {
    var empId = $('#emp').val();
    var selectedPrvId = $('#assi_priv').val();
    var dataArray = {action: 'custRemovePrevilege', empId: empId, selectedPrvId: selectedPrvId};
    $.post('./models/system_previlege_model.php', dataArray, function (reply) {
        if (reply == 1) {
            loadAvaiPrevilege();
            loadAssignedPrevilege();
            alertify.success('Previlege removed successfully');
        } else {
            alertify.error('Previlege remove process failed');
        }
    });
}

function allRemovePrevilege() {
    var empId = $('#emp').val();
    var dataArray = {action: 'allRemovePrevilege', empId: empId};
    $.post('./models/system_previlege_model.php', dataArray, function (reply) {
        if (reply == 1) {
            loadAvaiPrevilege();
            loadAssignedPrevilege();
            alertify.success('All privilege removed successfully');
        } else {
            alertify.error('All privilege remove process failed');
        }
    });
}



