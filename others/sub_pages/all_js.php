<script type="text/javascript" src="./others/js/jquery.js"></script>
<script type="text/javascript" src="./others/alertify/alertify.js"></script>
<script type="text/javascript" src="./others/chosen/chosen.jquery.js"></script>



<script type="text/javascript">
    $('.chosen').chosen({width: "300px", height: "45px"});

    function chosenRefresh() {
        $(".chosen").trigger("chosen:updated");
    }

    $('#resetPassword').click(function () {
        changePassword();
    });

    $('#logout').click(function () {
        alertify.confirm("Confirm logout", "Are you sure, You want to logout ?",
                function () {
                    system_logout();
                },
                function () {
                    alertify.error('Logout cancelled');
                });
    });

    function system_logout() {
        var dataArray = {action: 'system_logout'}
        $.post('./models/login_model.php', dataArray, function (reply) {
            if (reply == 1) {
                window.location = "./";
            }
        });
    }

    function changePassword() {
        var oldPass = $('#oldPassfield').val();
        var newPass = $('#newPassfield').val();
        var dataArray = {action: 'changePassword', oldPass: oldPass, newPass: newPass}
        $.post('./models/login_model.php', dataArray, function (reply) {
            if (reply == 1) {
                alertify.success('Successfully changed password');
                setTimeout(function () {
                    window.location = "./";
                }, 1000);
            } else {
                alertify.error('System error');
            }
        });
    }

    function sendSMS(to, msg) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "https://www.textit.biz/sendmsg/?id=94788743480&pw=4999&to=" + to + "&text=" + msg);
        xhr.send();
    }
</script>