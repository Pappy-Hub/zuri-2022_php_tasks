<?php

require_once "../config.php";

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the db function in config.php
    $conn = db();

    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Students WHERE email='$email'"))>=1){
        echo "<script> alert('User Email Already Taken')</script>";
        header("refresh: 0.5; url=../forms/register.html");
    }
    else{
        $sql = "INSERT INTO `Students` (`full_names`, `country`, `email`, `gender`, `password`) VALUES ('$fullnames', '$country', '$email', '$gender', '$password')";
        if(mysqli_query($conn, $sql)){
            echo "<script> alert('User Successfully created!!')</script>";
            header("refresh: 2; url=../forms/login.html");
        }
        else{
            echo "<script'> alert('An Error Occured please try again')</script>";
        }
    }
}


//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    $query = "SELECT * FROM Students WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) >= 1){
        session_start();
        $_SESSION['username'] = $email;
        header("Location: ../dashboard.php");
        }
    else{
        echo "<script> alert('Incorrect Password') </script>";
    }
}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Students WHERE email='$email'"))>=1){
        $sql = "UPDATE table Student set password='$password' Where email='$email'";
        if(mysqli_query($conn, $sql)){
            echo "<script> alert('Password Succesfully updated!!')</script>";
        }
        else{
            echo "<script> alert('An Error Occured please try again')</script>";
        }
    }
    else{
        echo "an error occured";
    }
}

function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

function logout(){
    if($_SESSION['username'])
    {
        session_unset();
        session_destroy();
        header("Location: ../forms/login.html");
    }
    else{
        header("Location: ../forms/login.html");
    }
    
}

 function deleteaccount($id){
     $conn = db();
    //reference how i used the connection here, to help you with the others
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Students WHERE id=$id"))){
        $sql = "DELETE FROM Students WHERE id=$id";
        if(mysqli_query($conn, $sql)){
            echo "<script> alert('DELETED')</script>";
            header("refresh:0.5; url=action.php?all=");
     }
    }
 }
