<?php
    require_once('../model/database.php');

    $db = connect();
    function user_exist($login) {
        var_dump($login);
        $req = "SELECT * FROM USERS WHERE login='$login'";
        $res = $db->query($req);
        $query = $db->prepare("SELECT * FROM USERS WHERE login='$login'");
        $query->execute();

        if (!$res)
            return (false);
        return (true);
    }

    function create_user($firstname, $lastname, $login, $passwd, $mail) {
        $hash = hash('whirlpool', $passwd);
        $req = "INSERT INTO USERS VALUES(id_user, '$firstname', '$lastname', '$login', '$mail', '$hash')";
        $res = $db->query($req);
        if (!$res)
            return (null);
    }
?>