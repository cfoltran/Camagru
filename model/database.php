<?php
    function connect() {
        $host = "localhost:3307";
        $user = "adm";
        $passwd = "clemclem";

        try {
            $co = new PDO("mysql:host=$host;dbname=camagrudb", $user, $passwd);
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return ($co);
    }
?>