<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="views/css/stylesheet.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title><?= $t ?></title>
</head>
<body>
    <div class="nav-menu" id="menu">
        <a href="<?= URL ?>">Camagru</a>
        <?php 
        session_start();
        if (!isset($_SESSION['login'])): ?>
            <a href="<?= URL ?>?url=camagru"><i class="fas fa-camera"></i> Take a pic</a>
            <a class="user" href="<?= URL ?>?url=login">Sign in</a>
            <a class="user" href="<?= URL ?>?url=register">Register</a>
        <?php else: ?>
            <a class="user" href="<?= URL ?>?url=login&submit=logout"><i class="fas fa-sign-out-alt"></i></a>
            <a class="user" onclick="displayModalUser()"><i class="fas fa-user-cog"></i></a>
            <a href="<?= URL ?>?url=camagru"><i class="fas fa-camera"></i> Take a pic</a>
        <?php endif; ?>
        <a href="javascript:void(0);" class="icon" onclick="menu()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div id="modalUser" class="modal">
        <div class="modal-content">
            <button onclick="displayForm('notifications')">Notifications</button>
            <button onclick="displayForm('update-passwd')">Update password</button>
            <button onclick="displayForm('del-account')">Delete account</button>
            <button onclick="displayForm('update-login')">Update login</button>
            <button onclick="displayForm('update-email')">Update email</button>
            <div class="form-zone">
                <div class="form-body">
                    <div id="notifications">
                        <h2 style="text-align: center">Notifications 🔔</h2>
                        <button id="btn-psh" class="off" onclick="setNotifSet()"></button>
                    </div>
                    <div id="update-passwd">
                        <h2 style="text-align: center">Update your password 🆕</h2>
                        <input type="password" class="input-box" id="oldPasswd" placeholder="Old password" required>
                        <input type="password" class="input-box" id="newPasswd1" placeholder="New password" required>
                        <input type="password" class="input-box" id="newPasswd2" placeholder="Confirm password" required>
                        <button onclick="updatePasswd()" class="btn btn-primary">Update</button>
                    </div>
                    <div id="del-account">
                        <h2 style="text-align: center">Delete your account 😭</h2>
                        <form method="POST" action="<?= URL ?>?url=login&submit=delAccount">
                            <input type="password" class="input-box" name="passwd" placeholder="Enter your password" required>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>
                    </div>
                    <div id="update-login">
                        <h2 style="text-align: center">Update your login 🆕</h2>
                        <input type="text" class="input-box" id="login" placeholder="Enter your new login" required>
                        <button type="submit" onclick="updateLogin()" class="btn btn-primary">Update</button>
                    </div>
                    <div id="update-email">
                        <h2 style="text-align: center">Update your email 🆕</h2>
                        <form action="<?= URL ?>?url=login&submit=updateMail" method="post">
                            <input type="email" class="input-box" name="email" placeholder="Enter your new email" required>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <div class="info" id="setting-info">
                        <?= $info ?>
                    </div>
                    <div class="error" id="setting-error">
                        <?= $err ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $content ?>
    <a id="feedback" href="<?= URL ?>?url=feedback"><i class="fas fa-comments"></i></a>
    <footer>
        <p>© 2019 made with ☕️ by Clément</p>
    </footer>
    <script src="<?= URL ?>scripts/index.js"></script>
</body>
</html>