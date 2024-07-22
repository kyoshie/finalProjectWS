<?php 
    $host = 'localhost';
    $username = 'root';
    $password='secret';
    $dbname = 'journal';


    $connection = mysqli_connect($host, $username, $password, $dbname);

    if (!$connection) {
        die("Connection failed: ".mysqli_connect_error());
    }


    echo "Connected";


?>