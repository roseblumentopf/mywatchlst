<?php
session_start();
// If user is logged in, header them away
if (isset($_SESSION["email"])) {
    header("location: index.php");
    exit();
}
?><?php

if (isset($_POST["e"])) {
// CONNECT TO THE DATABASE
    include_once("db.php");
// GATHER THE POSTED DATA INTO LOCAL VARIABLES
    //$u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
    $e = mysqli_real_escape_string($conn, $_POST['e']);
    $p = $_POST['p'];
    $g = preg_replace('#[^a-z]#', '', $_POST['g']);
    $c = preg_replace('#[^a-z ]#i', '', $_POST['c']);
// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
// DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
//    $sql = "SELECT id FROM users WHERE username='$u' LIMIT 1";
//    $query = mysqli_query($conn, $sql);
//    $u_check = mysqli_num_rows($query);
// -------------------------------------------
    $sql = "SELECT id FROM users WHERE email='$e' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    $e_check = mysqli_num_rows($query);
// FORM DATA ERROR HANDLING
    if ($e == "" || $p == "" || $g == "" || $c == "") {
        echo "The form submission is missing values.";
        exit();
//    } else if ($u_check > 0) {
//        echo "The username you entered is alreay taken";
//        exit();
    } else if ($e_check > 0) {
        echo "That email address is already in use in the system";
        exit();
//    } else if (strlen($u) < 3 || strlen($u) > 16) {
//        echo "Username must be between 3 and 16 characters";
//        exit();
//    } else if (is_numeric($u[0])) {
//        echo 'Username cannot begin with a number';
//        exit();
    } else {
// END FORM DATA ERROR HANDLING
        // Begin Insertion of data into the database
// Hash the password and apply your own mysterious unique salt
//$cryptpass = crypt($p);
//include_once ("php_includes/randStrGen.php");
//$p_hash = randStrGen(20)."$cryptpass".randStrGen(20);
        $p_hash = md5($p);
        $string_temp = $e+$g+$p_hash+$c+$ip;
        $string_hash = hash("sha256", $string_temp);
// Add user info into the database table for the main site table
        $sql = "INSERT INTO users (email, password, gender, country, ip, signup, lastlogin, activated)       
       VALUES('$e','$p_hash','$g','$c','$ip',now(),now(),'$string_hash')";
        $query = mysqli_query($conn, $sql);
        $uid = mysqli_insert_id($conn);
        $sqlopt = "INSERT INTO useroptions (user_id)       
       VALUES('$uid')";
        $queryopt = mysqli_query($conn, $sqlopt);
        //$uid = mysqli_insert_id($conn);
// Establish their row in the useroptions table
//        $sql = "INSERT INTO useroptions (id, username, background) VALUES ('$uid','$u','original')";
//        $query = mysqli_query($conn, $sql);
// Create directory(folder) to hold each user's files(pics, MP3s, etc.)
//        if (!file_exists("user/$u")) {
//            mkdir("user/$u", 0755);
//        }
// Email the user their activation link
        if ($query) {
            echo 'signup_success';
//            $to = "$e";
//            $from = "cronjob@h2201857.stratoserver.net";
//            $subject = 'yoursitename Account Activation';
//            $message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>yoursitename Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://www.yoursitename.com"><img src="http://www.yoursitename.com/images/logo.png" width="36" height="30" alt="yoursitename" style="border:none; float:left;"></a>yoursitename Account Activation</div><div style="padding:24px; font-size:17px;">Hello ' . $e . ',<br /><br />Click the link below to activate your account when ready:<br /><br /><a href="http://h2201857.stratoserver.net/clean/activation.php?e=' . $e . '&a=' . $string_hash . '">Click here to activate your account now</a><br /><br />Login after successful activation using your:<br />* E-mail Address: <b>' . $e . '</b></div></body></html>';
//            $headers = "From: $from\n";
//            $headers .= "MIME-Version: 1.0\n";
//            $headers .= "Content-type: text/html; charset=iso-8859-1\n";
//            mail($to, $subject, $message, $headers);
        } else {
            echo 'signup_error';
        }

        exit();
    }
    exit();
}

