#!/usr/bin/php
<?php
    include ('model/database.php');
    $con = mysqli_connect("localhost", "adm", "clemclem", "test");
    if (!$con)
        die("An error occured 😥\n");
    $db_query = "CREATE DATABASE camagrudb";
    if (mysqli_query($con, $db_query))
        echo "Database created 👌 \n";
    else
        echo "An error occured 😥\n";
    mysqli_close($con);
    
    $con = connect();
    $all_query = file_get_contents('./SQL/create_tables.sql');
    if (mysqli_multi_query($con, $all_query))
        echo "Create table successfully 👌 \n";
    else
        echo "An error occured 😥\n";
    mysqli_close($con);
?>