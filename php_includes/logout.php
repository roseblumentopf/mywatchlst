<?php

session_start();
// Set Session data to an empty array
$_SESSION = array();
// Expire their cookie files
if (isset($_COOKIE["id"]) && isset($_COOKIE["email"]) && isset($_COOKIE["pass"])) {
    setcookie("id", '', strtotime('-5 days'), '/');
    setcookie("email", '', strtotime('-5 days'), '/');
    setcookie("pass", '', strtotime('-5 days'), '/');
}
// Destroy the session variables
session_destroy();
// Double check to see if their sessions exists
if (isset($_SESSION['email'])) {
    //header("location: message.php?msg=Error:_Logout_Failed");
    echo "Error:_Logout_Failed";
} else {
    header("location: http://localhost/mywatchlst/index.php");
    exit();
}

