<?php
    define("servername","localhost");
    define("username","root");
    define("password","");
    define("dbname","sms");

    $conn = mysqli_connect(servername, username, password, dbname);
    if(!$conn) {
        die("Error establishing database connection".mysqli_connect_error());
    } 
?>