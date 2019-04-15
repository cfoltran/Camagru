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
            if (!isset($_SESSION['loggued_on_user'])) {
                echo '<a class="user" href='.URL.'?url=login>Sign in</a>';
                echo '<a class="user" href='.URL.'?url=register>Register</a>';
            } else {
                echo '<a class="user" href="/register.php"><i class=fa fa-user"></i></a>';
            }
        ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("menu");
            if (x.className === "nav-menu") {
                x.className += " responsive";
            } else {
                x.className = "nav-menu";
            }
        }
    </script>
    <?= $content ?>
    <footer>
        <a class="btn-blue" href="#">Espace administrateur</a>
        <a class="btn-blue">CGU</a>
        <p>© 2019 make with ☕️ by Clément</p>
    </footer>
</body>
</html>