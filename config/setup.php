#!/usr/bin/php
<?php
    require_once('database.php');
    $co = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    if (!$co)
        die("An error occured 😥\n");
    $query = "CREATE DATABASE camagrudb";
    $req = $co->prepare($query);
    $req->execute();
    if ($req)
        echo "Database created 👌 \n";
    else
        echo "An error occured 😥\n";
    $req->closeCursor();
    $all_query = file_get_contents('./camagrudb.sql');
    try {
        $co->exec($all_query);
        echo "Create table successfully 👌 \n";
    }
    catch (PDOException $e)
    {
        echo "An error occured 😥\n";
        echo $e->getMessage();
        die();
    }
?>