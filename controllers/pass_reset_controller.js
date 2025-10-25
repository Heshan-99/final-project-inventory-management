loadEmployees();

$('#emp').change(function () {
    setSelectedEmpDetails();
});

$('#changePass').change(function () {
    setSelectedEmpDetails();
});

$('#resetEmpPass').click(function () {
    alertify.confirm("Confirm Reset", "Are you sure, You want to Reset Password ?",
            function () {
                resetPassword();
            },
            function () {
                alertify.error('Password Reset Cancel');
            });
});

//================================================================================

function loadEmployees() {
    var dataArray = {action: 'loadEmployees'};
    $.post('./models/pass_reset_model.php', dataArray, function (reply) {
        $('#emp').html(reply);
    });
}

function setSelectedEmpDetails() {
    var empData = $('#emp').val();
    empData = empData.split('~');
    localStorage.setItem('empID', empData[0]);
    var x = empData[1];
    x = x.split('/');
    $('#empNamefield').val(x[0]);
    $('#nicfield').val(x[1]);
    $('#Mobilefield').val(x[2]);
}

function resetPassword() {
    var empId = localStorage.getItem('empID');
    var dataArray = {action: 'resetPassword', empId: empId};
    $.post('./models/pass_reset_model.php', dataArray, function (reply) {
        if (reply != 0) {
            $('#passSetion').removeClass('d-none');
            $('#hintSymbol').removeClass('d-none');
            $('#newPass').html(reply);
             alertify.success('Successfully reset password');
        }else{
             alertify.error('System Error');
            
        }
    });
}

