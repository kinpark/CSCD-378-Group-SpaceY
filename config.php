<?php

    //this is just the connection to the sql database separated from
    //database.php incase we need to connect in other spots but dont
    //want to recreate the tables

    $servername = "localhost";
    $username = "root";
    $password = "";

    //Create connection
    $conn = new mysqli($servername, $username, $password);
    //Check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    //Create database
    $sql = "CREATE DATABASE IF NOT EXISTS final_website";
    if($conn->query($sql) === TRUE){
        echo "Database created successfully";
    } else{
        echo "Error creating database: " . $conn->error;
    }
    $conn->close();

    //Re-create connection, this time connecting to the DB as well
    $dbname = "final_website";
    $conn = new mysqli($servername, $username, $password, $dbname);
    //Check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>