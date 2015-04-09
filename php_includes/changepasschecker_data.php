<?php

if (isset($_GET['p'])) {
    include_once("db.php");
    $p = ($_GET['p']);
    $sql = "SELECT user_id FROM useroptions WHERE temp_pass='$p' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($query);
    if ($numrows == 0) {
        $checker = false;
    } else {
        $checker = true;
    }
} else {
    $checker = false;
}


