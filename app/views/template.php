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
            <a href="<?= URL ?>?url=login"><i class="fas fa-camera"></i> Take a pic</a>
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
            <button onclick="displayUpdatePasswd()">Changer de mot de passe</button>
            <button onclick="displayDelAccount()">Supprimer le compte</button>
            <div class="form-zone">
                <div class="form-body" id="update-passwd">
                    <h2 style="text-align: center">Update your password</h2>
                    <input type="password" class="input-box" id="oldPasswd" placeholder="Old password" required>
                    <input type="password" class="input-box" id="newPasswd1" placeholder="New password" required>
                    <input type="password" class="input-box" id="newPasswd2" placeholder="Confirm password" required>
                    <div class="info">
                        <?= $info ?>
                    </div>
                    <div class="error">
                        <?= $err ?>
                    </div>
                    <button onclick="updatePasswd()" class="btn btn-primary">Update</button>
                </div>
                <div class="form-body" id="del-account">
                    <h2 style="text-align: center">Delete your account 😭</h2>
                    <input type="password" class="input-box" name="oldPasswd" placeholder="Enter your password" required>
                    <div class="info">
                        <?= $info ?>
                    </div>
                    <div class="error">
                        <?= $err ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
    <?= $content ?>
    <footer>
        <p>© 2019 made with ☕️ by Clément</p>
    </footer>
    <script src="<?= URL ?>scripts/index.js"></script>
</body>
</html>