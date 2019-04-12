<div class="nav-menu" id="menu">
    <a href="/">Camagru</a>
    <?php
        if (!isset($_SESSION['loggued_on_user'])) {
            echo "<a class='user' href='./signin.php'>Sign in</a>";
            echo "<a class='user' href='/register.php'>Register</a>";
        } else {
            echo "<a class='user' href='/register.php'><i class='fa fa-user'></i></a>";
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