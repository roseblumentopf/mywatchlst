<?php

session_start();
//include_once("db.php");
// Files that inculde this file at the very top would NOT require 
// connection to database or session_start(), be careful.
// Initialize some vars
$user_ok = false;
$log_id = "";
$log_email = "";
$log_password = "";
$conn = mysqli_connect("localhost", "root", "", "mywatchlst");

// User Verify function
function evalLoggedUser($conn, $id, $e, $p) {
    $sql = "SELECT ip FROM users WHERE id='$id' AND email='$e' AND password='$p' AND activated='1' LIMIT 1"; //AND activated='1'
    $query = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($query);
    if ($numrows > 0) {
        return true;
    }
}

if (isset($_SESSION["userid"]) && isset($_SESSION["email"]) && isset($_SESSION["password"])) {
    $log_id = preg_replace('#[^0-9]#', '', $_SESSION['userid']);
    $log_email = preg_replace('#[^a-z0-9]#i', '', $_SESSION['email']);
    $log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
// Verify the user
    $user_ok = evalLoggedUser($conn, $log_id, $log_email, $log_password);
} else if (isset($_COOKIE["id"]) && isset($_COOKIE["email"]) && isset($_COOKIE["pass"])) {
    $_SESSION['userid'] = preg_replace('#[^0-9]#', '', $_COOKIE['id']);
    $_SESSION['email'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['email']);
    $_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['pass']);
    $log_id = $_SESSION['userid'];
    $log_email = $_SESSION['email'];
    $log_password = $_SESSION['password'];
// Verify the user
    $user_ok = evalLoggedUser($conn, $log_id, $log_email, $log_password);
    if ($user_ok == true) {
// Update their lastlogin datetime field
        $sql = "UPDATE users SET lastlogin=now() WHERE id='$log_id' LIMIT 1";
        $query = mysqli_query($conn, $sql);
    }
}

