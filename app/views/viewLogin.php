<div class="login-zone">
    <div class="connexion col-md-4 mx-auto border rounded p-5">
        <form method="POST" action="controller/signin.php">
            <h1>Bienvenue sur <span style="font-family: monospace">Camagru</span> !</h1>
            <input type="text" class="input-box" name="user" id="user" placeholder="Login" required>
            <input type="password" class="input-box" name="passwd" id="passwd" placeholder="Mot de passe" required>
            <div class="info">
                <?php echo $info ?>
            </div>
            <button type="submit" class="btn btn-primary">Log in</button>
        </form>
    </div>
</div>