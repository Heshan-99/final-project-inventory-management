$('#login').click(function () {
    systemLogin();
});

//===============================================================================

function systemLogin() {
    var username = $('#username').val();
    var password = $('#password').val();
    var dataArray = {action: 'systemLogin', username: username, password: password};
    $.post('./models/login_model.php', dataArray, function (reply) {
        if (reply == 1) {
            alertify.success('Successfully logged into system');
            setTimeout(function () {
                window.location = "./?dashboard";
            }, 1000);
        } else {
            alertify.error('Invalid username or password');
        }
    });
}