<div class="form-zone">
    <div class="form-body">
        <form method="POST" action="<?= URL ?>?url=register&submit=ok">
            <h1>Bienvenue sur <span style="font-family: monospace">Camagru</span> !</h1>
            <h3 style="text-align: center">C'est l'heure des présentations</h3>
            <input type="text" class="input-box" name="login" placeholder="login" required>
            <input type="text" class="input-box" name="firstname" placeholder="Prénom" required>
            <input type="text" class="input-box" name="lastname" placeholder="Nom" required>
            <input type="email" class="input-box" name="mail" placeholder="e-mail" required>
            <input type="password" class="input-box" name="passwd1" placeholder="Saisissez un mot de passe" required>
            <input type="password" class="input-box" name="passwd2" placeholder="Confirmez le mot de passe" required>
            <div class="error">
                <p><?php echo $err ?></p>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>