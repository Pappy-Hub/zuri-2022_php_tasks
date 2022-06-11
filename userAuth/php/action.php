<?php
include "userauth.php";
include_once "../config.php";


switch(true){
    case isset($_POST['register']):
        //extract the $_POST array values for name, password and email
        $username = '';
        $password = '';
        $email = '';
        registerUser($username, $email, $password);
        break;

    case isset($_POST['login']):
        $password = '';
        $email = '';
        loginUser($email, $password);
        break;
    case isset($_POST["reset"]):
        $password = '';
        $email = '';
        resetPassword($email, $password);
        break;
    case isset($_POST["delete"]):
        $id = $_POST['id'];
        deleteaccount($id);
        break;
    case isset($_GET["all"]):
        getusers();
        break;
}