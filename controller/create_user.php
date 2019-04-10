<?php
    require_once('../model/users.php');

	$login = $_POST['login'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$mail = $_POST['mail'];
	$passwd1 = $_POST['passwd1'];
    $passwd2 = $_POST['passwd2'];

        var_dump(user_exist($login));die();
        if (user_exist($login)) {
            header('Location: ../register.php');
        } 
        else {
            add_user($firstname, $lastname, $login, $passwd1, $mail);
            header('Location: ../login.php');
        }
?>