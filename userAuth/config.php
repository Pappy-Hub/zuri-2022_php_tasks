<?php
//set your configs here
$host = "127.0.0.1";
$user = "root";
$db = "zuriphp";
$password = "";

function db () {
    $conn = mysqli_connect($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);
    if(!$conn){
        echo "<script> alert('Error connecting to the database') </script>";
    }
    return $conn;

}