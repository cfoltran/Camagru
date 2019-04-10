<?php
    echo "I m in";
	function connect() {
        $host = "192.168.99.100:3307";
        $user = "root";
        $pass = "clemclem";
        $db = "camagrudb";
    
        $co = mysqli_connect($host, $user, $pass, $db);
        if (mysqli_connect_errno($co))
        {
            echo "Echec de connexion à la base de données : " . mysqli_connect_error();
            return (NULL);
        }
        return $co;
        }
        $co = connect();
        // mysqli_query($co, "INSERT INTO USERS VALUE(id_user, 'clement', 'foltran', 'clfoltra', 'clfoltra@student.42.fr', 'clemclem')");
    
?>