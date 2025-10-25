
<html lang="en">
    <head>
        <title>Happy Cakies</title>
        <link rel="stylesheet" href="./others/alertify/css/alertify.css">
        <link rel="stylesheet" href="./others/Assets/CSS/loginstyle.css">
        <link href='https://fonts.googleapis.com/css?family=Cedarville Cursive' rel='stylesheet'>
    </head>
    <body>
        <div class="main">
            <div class="navbar">
                <div class="logo">
                    <h2>Happy<span>Cakies</span>
                </div>
                <div class="menu">
                </div>
            </div>
            <div class="content">
                <div class="form">
                    <h2>Login here</h2>
                    <label>NIC</label>
                    <input type="text" name="nic" placeholder="Enter NIC" id="username">
                    <label>Password</label>
                    <input type="password" name="nic" placeholder="Enter password here" id="password">
                    <button class="btn" type="button" id="login">Login</button>
                </div>
            </div>
        </div>
    </body>
    <?php require_once './others/sub_pages/all_js.php'; ?>
    <script type="text/javascript" src="./controllers/login_controller.js"></script>
</html>
