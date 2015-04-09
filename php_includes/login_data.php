<?php

session_start();
// If user is logged in, header them away
if (isset($_SESSION["email"])) {
    header("location: index.php");
    exit();
}
?><?php

// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if (isset($_POST["e"])) {
// CONNECT TO THE DATABASE
    include_once("db.php");
// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
    $e = mysqli_real_escape_string($conn, $_POST['e']);
    $p = md5($_POST['p']);
    //$test = md5($p);
    //echo $test;
// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
// FORM DATA ERROR HANDLING
    if ($e == "" || $p == "") {
        echo "login_failed";
        exit();
    } else {
// END FORM DATA ERROR HANDLING
        $sql = "SELECT id, email, password FROM users WHERE email='$e' LIMIT 1"; //AND activated='1' wieder einfügen
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($query);
        //echo count($row);
        $db_id = $row[0];
        $db_email = $row[1];
        $db_pass_str = $row[2];
        //echo $test = $db_pass_str;
        if ($p !== $db_pass_str) {
            echo "login_failed";
            exit();
        } else {
// CREATE THEIR SESSIONS AND COOKIES
            $_SESSION['userid'] = $db_id;
            $_SESSION['email'] = $db_email;
            $_SESSION['password'] = $db_pass_str;
            setcookie("id", $db_id, strtotime('+30 days'), "/", "", "", TRUE);
            setcookie("email", $db_email, strtotime('+30 days'), "/", "", "", TRUE);
            setcookie("pass", $db_pass_str, strtotime('+30 days'), "/", "", "", TRUE);
// UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
            $sql = "UPDATE users SET ip='$ip', lastlogin=now() WHERE email='$db_email' LIMIT 1";
            $query = mysqli_query($conn, $sql);
            echo "login_success";
            exit();
        }
    }
    exit();
} else {
    header("location: index.php");
    exit();
}

