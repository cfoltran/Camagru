<?php
    function connect() {
        $host = "localhost:3306";
        $user = "root";
        $passwd = "clemclem";

        try {
            $co = new PDO("mysql:host=$host;dbname=camagrudb", $user, $passwd);
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $req = "SELECT * FROM USERS WHERE login='$login'";
        $res = $co->query($req);
        return ($co);
    }
?>