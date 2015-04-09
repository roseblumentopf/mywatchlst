<?php

if (!isset($_SESSION["userid"])) {
    echo "Something went wrong.";
} else {
    echo "not yet.";
//    $test = $_SESSION["userid"];
//    $sql = "SELECT * FROM reminder_itunes_us WHERE user_id='$test' AND status='0'";
//    $user_query = mysqli_query($conn, $sql);
//    $numrows = mysqli_num_rows($user_query);
//
//    if ($numrows < 1) {
//        echo "You have not added a reminder yet.";
//    } else {
//        while ($rows = mysqli_fetch_row($user_query)) {
//            echo $rows[4] . "  ";
//            echo "<a href='$rows[6]' target='_blank'>Preview</a>";
//            echo "<br><br>";
//        }
//    }
}

