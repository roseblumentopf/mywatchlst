<?php

if (isset($_POST["e"])) {
    include_once("db.php");
    $e = ($_POST["e"]);
    $sqlpass = "SELECT id, email FROM users WHERE email='$e' AND activated='1' LIMIT 1";
    $query = mysqli_query($conn, $sqlpass);
    $numrows = mysqli_num_rows($query);
    if ($numrows > 0) {
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $id = $row["id"];
            $u = $row["email"];
        }
        $emailcut = substr($e, 0, 4);
        $randNum = rand(10000, 99999);
        $tempPass = "$emailcut$randNum";
        $hashTempPass = md5($tempPass);
        $sql = "UPDATE useroptions SET temp_pass='$hashTempPass', temp_pass_created=now() WHERE user_id='$id' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        $to = "$e";
        $from = "cronjob@h2201857.stratoserver.net";
        $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
        $subject = "yoursite New Password";
        $msg = '<h2>Hello ' . $e . '</h2><p>This is an automated message from yoursite. If you did not recently initiate the Forgot Password process, please disregard this email.</p><p>You indicated that you forgot your login password.</p><p><a href="http://h2201857.stratoserver.net/clean/pass.php?p=' . $hashTempPass . '">Click here now to apply a new password.</a></p><p>If you do not click the link in this email, no changes will be made to your account.</p>';
        if (mail($to, $subject, $msg, $headers)) {
            echo "success";
            exit();
        } else {
            echo "email_send_failed";
            exit();
        }
    } else {
        echo "no_exist";
    }
    exit();
}

if (isset($_POST["k"])) {
    include_once("db.php");
    $p = md5($_POST["p"]);
    $k = ($_POST["k"]);
    $sqlcheck = "SELECT user_id FROM useroptions WHERE temp_pass='$k' LIMIT 1";
    $query = mysqli_query($conn, $sqlcheck);
    $numrows = mysqli_num_rows($query);
    if ($numrows > 0) {
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $id = $row["user_id"];
            $temp_pass = $row["temp_pass"];
        }

        $sqlnew = "UPDATE users SET password='$p' WHERE id='$id' LIMIT 1";
        $query = mysqli_query($conn, $sqlnew);
        $sqlopt = "UPDATE useroptions SET temp_pass='' WHERE user_id='$id' LIMIT 1";
        $queryopt = mysqli_query($conn, $sqlopt);
        $to = "f.rose@tu-bs.de";
        $from = "cronjob@h2201857.stratoserver.net";
        $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
        $subject = "yoursite New Password";
        $msg = '<h2>Hello ' . $e . '<p>Your password was changed successfully.</p>';
        if (mail($to, $subject, $msg, $headers)) {
            echo "success";
            exit();
        } else {
            echo "email_send_failed";
            exit();
        }
    } else {
        echo "no_exist";
    }
    exit();
}

if (isset($_POST["o"])) {
    include_once("db.php");
    include_once("check_login_status.php");
    $p = md5($_POST["p"]);
    $o = md5($_POST["o"]);
    $id = $_SESSION["userid"];
    $sqlcheck = "SELECT password FROM users WHERE id='$id' LIMIT 1";
    $query = mysqli_query($conn, $sqlcheck);
    $numrows = mysqli_num_rows($query);
    //echo $numrows;
    if ($numrows < 1) {
        echo "Something went wrong.";
        exit();
    }
    $row = mysqli_fetch_row($query);
    $passold = $row[0];
    //echo $o;
    //echo $passold;
    if ($o !== $passold) {
        echo "Wrong old password.";
        exit();
    } elseif ($p === $passold) {
        echo "Same password.";
        exit();
    } else {
        $sqlnew = "UPDATE users SET password='$p' WHERE id='$id' LIMIT 1";
        $query = mysqli_query($conn, $sqlnew);
        $to = "f.rose@tu-bs.de";
        $from = "cronjob@h2201857.stratoserver.net";
        $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
        $subject = "yoursite New Password";
        $msg = '<h2>Hello<p>Your password was changed successfully.[2]</p>';
        if (mail($to, $subject, $msg, $headers)) {
            echo "success";
            exit();
        } else {
            echo "email_send_failed";
            exit();
        }
    }
}


