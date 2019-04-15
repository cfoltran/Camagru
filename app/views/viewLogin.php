<div class="form-zone">
    <div class="form-body">
        <form method="POST" action="<?= URL ?>?url=login&submit=login">
            <h1>Bienvenue sur <span style="font-family: monospace">Camagru</span> !</h1>
            <input type="text" class="input-box" name="login" id="login" placeholder="Login" required>
            <input type="password" class="input-box" name="passwd" id="passwd" placeholder="Mot de passe" required>
            <div class="info">
                <?= $info ?>
            </div>
            <div class="error">
                <?= $err ?>
            </div>
            <button type="submit" class="btn btn-primary">Log in</button>
        </form>
        </div>
</div>