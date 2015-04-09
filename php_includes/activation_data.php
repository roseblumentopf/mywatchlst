<?php

if (isset($_GET['e']) && isset($_GET['a'])) {
// Connect to database and sanitize incoming $_GET variables
    include_once("db.php");
    //$id = preg_replace('#[^0-9]#i', '', $_GET['id']);
    //$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
    $e = mysqli_real_escape_string($conn, $_GET['e']);
    $a = mysqli_real_escape_string($conn, $_GET['a']);
// Evaluate the lengths of the incoming $_GET variable
    if (strlen($e) < 5 || strlen($a) == "") {
// Log this issue into a text file and email details to yourself
        //header("location: message.php?msg=activation_string_length_issues");
        echo "activation_string_length_issues";
        //exit();
    }
// Check their credentials against the database
    $sql = "SELECT * FROM users WHERE activated='$a' AND email='$e' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($query);
// Evaluate for a match in the system (0 = no match, 1 = match)
    if ($numrows == 0) {
// Log this potential hack attempt to text file and email details to yourself
        //header("location: message.php?msg=Your credentials are not matching anything in our system");
        echo "Your credentials are not matching anything in our system";
        //exit();
    }
// Match was found, you can activate them
    $sql = "UPDATE users SET activated='1' WHERE email='$e' LIMIT 1";
    $query = mysqli_query($conn, $sql);
// Optional double check to see if activated in fact now = 1
    $sql = "SELECT * FROM users WHERE email='$e' AND activated='1' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($query);
// Evaluate the double check
    if ($numrows == 0) {
// Log this issue of no switch of activation field to 1
        //header("location: message.php?msg=activation_failure");
        echo "failure";
        //exit();
    } else if ($numrows == 1) {
// Great everything went fine with activation!
        //header("location: message.php?msg=activation_success");
        echo "success";
        //exit();
    }
} else {
// Log this issue of missing initial $_GET variables
    //header("location: message.php?msg=missing_GET_variables");
    echo "irgendwas";
    //exit();
}


