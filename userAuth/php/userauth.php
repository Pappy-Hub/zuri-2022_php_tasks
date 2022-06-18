<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light " style="background-color: rgb(242, 211, 170);">
            <a class="navbar-brand" href="#"><h2>PHP STUDENTS PORTAL</h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item f-right">
                    <a class="nav-link " href="../dashboard.php">DASHBOARD</a>
                </li>
    </div>
    </nav>
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
        header("Location: ../forms/login.php?message=invalid");
        
        
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
    <table class='table table-bordered' border='0.5' style='width: 80%; background-color: smoke; border-style: none'; >
    <tr style='height: 40px'>
        <thead class='thead-dark'> <th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th>
    </thead></tr>";
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
                <td style='width: 150px'> 
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<button class='btn btn-danger' type='submit', name='delete'> DELETE </button> </form> </td>".
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
        header("Location: ../index.php?message=logout");
    }
    else{
        header("Location: ../forms/login.php");
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
