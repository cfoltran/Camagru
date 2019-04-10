<div class="nav-menu" id="menu">
    <a href="/">Camagru</a>
    <a href='./login.php'>Sign in</a>
    <a href='/register.php'>Register</a>
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