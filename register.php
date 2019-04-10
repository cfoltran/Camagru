<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/stylesheet.css" type="text/css">
	<link rel="stylesheet" href="css/register.css" type="text/css">
    <title>Camagru</title>
</head>
<body>
    <?php include('partials/menu.php'); ?>
	<div class="login-zone">
		<div class="connexion col-md-4 mx-auto border rounded p-5">
            <form method="POST" action="./controller/create_user.php">
                <h1>Bienvenue sur <span style="font-weight: bold; text-align: center;">Camagru</span> !</h1>
                <h3 style="text-align: center">C'est l'heure des présentations</h3>
                <input type="text" class="input-box" name="login" id="login" placeholder="login" required>
                <input type="text" class="input-box" name="firstname" id="firstname" placeholder="Prénom" required>
                <input type="text" class="input-box" name="lastname" id="lastname" placeholder="Nom" required>
                <input type="email" class="input-box" name="mail" id="mail" placeholder="e-mail" required>
                <input type="password" class="input-box" name="passwd1" id="passwd1" placeholder="Saisissez un mot de passe" required>
                <input type="password" class="input-box" name="passwd2" id="passwd2" placeholder="Confirmez le mot de passe" required>
				<button type="submit" class="btn btn-primary">S'inscrire</button>
			</form>
		</div>
    </div>
    <?php include('partials/footer.php'); ?>
</body>
</html>
