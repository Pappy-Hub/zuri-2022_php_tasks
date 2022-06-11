<?php

require "../config.php";

//register users
function registerUser($username, $email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();

    echo "SAVE MY INFO TO THE DATABASE :) (IMPLEMENT ME)";
   //check if user with this email already exist in the database
}


//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();

    echo "LOG ME IN (IMPLEMENT ME)";
    //open connection to the database and check if username exist in the database
    //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard
}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    echo "RESET YOUR PASSWORD (IMPLEMENT ME)";
    //open connection to the database and check if username exist in the database
    //if it does, replace the password with $password given
}

function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<html>
            <head></head>
            <body>
                <table border='1' style='width: 700px;'><tr><td style='width: 50px'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr></table>
                </table>
            </body>
            </html>";
        }
    }
    //return users from the database
    //loop through the users and display them on a table
}

 function deleteaccount($conn, $id){
     $conn = db();
    //reference how i used the connection here, to help you with the others
     $sql = "DELETE FROM Students WHERE id=$id";
     if(mysqli_query($conn, $sql)){
         echo "<h1 style='color: green'>DELETED</h1>";
     }
     //echo "DELETE YOUR ACCOUNT (IMPLEMENT ME)";

     //delete user with the given id from the database
 }
